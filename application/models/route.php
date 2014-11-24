<?php

/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/13/14
 * Time: 11:18 PM
 */
class route extends CI_Model
{
    public $uname;
    public $bname;
    public $dist;
    public $schd;
    public $start;
    public $cmplt;
    public $rid;
    public $deliveries;
    public $dcount;
    public $icount;
    public $gmapsite;

    /**
     * Construct Method
     */
    public function __construct()
    {
        parent::__construct();
    }

    //function to create routes, assign deliverers to those routes and produce an array to facilitate proper distribution of deliveries to routes
    /**
     * @param $pdata
     * @return array
     */
    public function rarray($pdata)
    {

        $business = $this->session->userdata('bname');


        //gather business's data
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));

        foreach ($bquery->result() as $row) {
            $bdata = $row;
        }

        //gather delivery data
        $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '" . $pdata['schd'] . "' and c.bname = '" . $business . "'");

        //get number of deliveries
        $A = $dquery->num_rows();

        //exit if there are no deliveries
        if ($A < 1) return FALSE;

        //get number of deliverers
        $D = count($pdata['users']);

        //get maximum delivery capacity
        $C = $bdata->capacity;

        //get number of at capacity routes each deliverer gets
        $x = ($A / $C) / $D;

        //get the exact amount of at capacity routes per deliverer
        $W = round($x);
        if ($W > $x) $W--;


        //get remainder
        $R = $x - $W;

        //total number of at capacity routes
        $F = $W * $D;

        //create array to track the size and number of routes to be created
        for ($i = 1; $i <= $F; $i++) {
            $rarray[] = $C;
        }

        //get size of partial routes
        $y = $R * $C;

        //round down to get size of partial routes
        $P = floor($y);

        //get remainder
        $R = $y - $P;

        //add to array the number and size of partial routes
        for ($i = 1; $i <= $D; $i++) {
            $rarray[] = $P;
        }

        //identify the number remaining deliveries to be distributed to the partial routes
        $L = $R * $D;

        //mitigate php math flaw by rounding up
        $L = ceil($L);

        //distribute the remaining delivers to the partial routes
        $count = 1;
        $i = 0;
        foreach ($rarray as $z) {
            if ($count > $L) break;
            if ($z == $P) {
                $rarray[$i] = $z + 1;
                $count++;
            }
            $i++;
        }

        //clean up
        $i = 0;
        foreach ($rarray as $z) {
            if ($z == 0) unset($rarray[$i]);
            $i++;
        }

        //create routes based on the route array and assign users to routes
        //shuffle user list to avoid consistent route assignment
        shuffle($pdata['users']);
        $i = 0;
        $count = 0;
        foreach ($rarray as $size) {
            if ($count == $D) $count = 0;
            $insert = array(
                'bname' => $business,
                'uname' => $pdata['users'][$count],
                'schd' => $pdata['schd'],
                'rid' => $i
            );
            $this->db->insert('capsql.route', $insert);
            $i++;
            $count++;
        }

        return $rarray;
    }

    //function to calculate and assign delivery's to routes based on degrees around the business location
    public function setRoute($pdata, $rarray)
    {
        //set business name to variable
        $business = $this->session->userdata('bname');

        //gather business's data as results object
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));
        foreach ($bquery->result() as $row) {
            $bdata = $row;
        }

        //gather delivery data
        $dsql = "select * from delivery as d, customer as c where d.cid = c.cid and d.schd = ? and c.bname = ?";
        $dquery = $this->db->query($dsql, array($pdata['schd'],$business));

        //set position lat and long of business
        $CX = $bdata->blat;
        $CY = $bdata->blong;

        //calculate the radius of great circle
        $R = $this->getRadius($dquery);
        //increase the radius to compensate for margin of error
        $R = round($R,5) * 1.005;

        //get latitude and longitude of point at 360 degrees as starting and ending point
        $sLatLng = $this->ComputeLatLng($CX, $CY, 360, $R);
        $pX = $sLatLng[0];
        $pY = $sLatLng[1];

        //get size of route array
        $tR = count($rarray) - 1;

        //set counter for route array
        $cR = 0;

        //set counter for the current route size
        $cS = 1;

        //loop through 359 degrees to build triangles for the entire delivery area
        for ($i = 1; $i < 359; $i++) {
            //get the angle of the next point in radians
            $nLatLng = $this->ComputeLatLng($CX, $CY, $i, $R);
            //store current triangle vertices in three separate arrays
            $v1 = array($CX, $CY);
            $v2 = array($pX, $pY);
            $v3 = array($nLatLng[0], $nLatLng[1]);

            //loop through all deliveries checking if they are in the triangle
            foreach ($dquery->result() as $row) {
                //check if current route is full if so move to next route
                if ($cS > $rarray[$cR]) {
                    //reset current rote size counter
                    $cS = 1;
                    //bump the current route counter
                    $cR++;
                }
                //check if all routes are full if so exit inner loop
                if ($cR > $tR) break;
                //store current delivery's position in array
                $pt = array($row->clat, $row->clong);

                //check if the point is in the triangle
                //if true then assign current delivery to current route
                if ($this->isPointInTri($pt, $v1, $v2, $v3) == 1) {
                    $data = array(
                        'rid' => $cR
                    );
                    $this->db->where('schd', $row->schd);
                    $this->db->where('cid', $row->cid);
                    $this->db->update('capsql.delivery', $data);
                    //increase counter for current route size
                    $cS++;
                }
            }
            //set previous point to new point
            $pX = $nLatLng[0];
            $pY = $nLatLng[1];
            //check if all routes are full if so exit outer loop
            if ($cR > $tR) break;
        }

        //check if all routes are full if not then create final triangle and check deliveries against it
        if ($cR <= $tR) {
            //store vertices for final loop setting new point to the starting point
            $v1 = array($CX, $CY);
            $v2 = array($pX, $pY);
            $v3 = array($sLatLng[0], $sLatLng[1]);

            //loop through all deliveries checking if they are in the triangle
            foreach ($dquery->result() as $row) {
                //check if current route is full if so increase counter as usual to break out of loop
                if ($cS > $rarray[$cR]) {
                    //reset current rote size counter
                    $cS = 1;
                    //bump the current route counter
                    $cR++;
                }
                //check if all routes are full if so exit loop
                if ($cR > $tR) break;
                //store current delivery's position in array
                $pt = array($row->clat, $row->clong);
                //check if the point is in the triangle
                //if true then assign current delivery to current route
                if ($this->isPointInTri($pt, $v1, $v2, $v3) == 1) {
                    $data = array(
                        'rid' => $cR
                    );
                    $this->db->where('schd', $row->schd);
                    $this->db->where('cid', $row->cid);
                    $this->db->update('capsql.delivery', $data);
                    //increase counter for current route size
                    $cS++;
                }
            }
        }
    }

    //function to calculate the latitude and longitude of a point given an origin, bering, and distance
    //Haversine Formula
    public function ComputeLatLng($X, $Y, $A, $D)
    {
        //divide the distance by the radius on the earth in miles
        $D = $D / 3963.1676;

        //get the angle of the next point in radians
        $A = $A * pi() / 180;

        //convert latitude and longitude to radians
        $lat = $X * pi() / 180;
        $long = $Y * pi() / 180;

        //get latitude of new point in radians
        $nLat = asin(sin($lat) * cos($D) + cos($lat) * sin($D) * cos($A));

        //get longitude of new point in radians
        $nlong = $long + atan2(sin($A) * sin($D) * cos($lat), cos($D) - sin($lat) * sin($nLat));

        //error check
        if (is_nan($nLat) || is_nan($nlong)) return null;

        //convert new latitude and longitude back from radians and store in array
        $nLatLong[] = $nLat * 180 / pi();
        $nLatLong[] = $nlong * 180 / pi();

        //return new point
        return $nLatLong;
    }

    //function to identify if a point is in side of a triangle
    public function isPointInTri($pt, $v1, $v2, $v3)
    {
        //get the area of all possible triangle
        $tarea = $this->calcTriArea($v1, $v2, $v3);
        $area1 = $this->calcTriArea($pt, $v2, $v3);
        $area2 = $this->calcTriArea($pt, $v1, $v3);
        $area3 = $this->calcTriArea($pt, $v1, $v2);

        //check if area of all triangles using the given point is greater than the area of the given triangle
        if (($area1 + $area2 + $area3) > $tarea) return false;
        else return true;
    }

    //function to calculate the area of a triangle
    public function calcTriArea($v1, $v2, $v3)
    {
        //modify vertices to a usable integer for more precision
        $v1[0] = intval($v1[0] * 10000000);
        $v1[1] = intval($v1[1] * 10000000);
        $v2[0] = intval($v2[0] * 10000000);
        $v2[1] = intval($v2[1] * 10000000);
        $v3[0] = intval($v3[0] * 10000000);
        $v3[1] = intval($v3[1] * 10000000);
        //calculate area of the triangle using Shoelace Formula
        $det = abs($v1[0] * $v2[1] + $v2[0] * $v3[1] + $v3[0] * $v1[1] - $v1[0] * $v3[1] - $v3[0] * $v2[1] - $v2[0] * $v1[1]) / 2;
        //convert to integer
        $det = intval($det);
        //return the area
        return $det;
    }

    /**
     * function to optimize the order of deliveries in all routes for a given day
     */
    public function optimizeR($pdata, $rarray)
    {
        //set business name to variable
        $business = $this->session->userdata('bname');

        //gather business's data as results object
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));
        foreach ($bquery->result() as $row) {
            $bdata = $row;
        }
        $baddress = str_replace (" ", "+", $bdata->baddress);
        //set parts of the url
        $url1 = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $baddress . "&destination=" . $baddress . "&waypoints=optimize:true|";
        $url3 = "&key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY";
        //get size of route array
        $tR = count($rarray);
        //loop through all routes deliveries to build url string
        for ($i = 0; $i < $tR; $i++) {
            //gather delivery data
            $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '" . $pdata['schd'] . "' and c.bname = '" . $business . "' and d.rid = " . $i . "");
            //loop through all of route's deliveries to build url string
            foreach ($dquery->result() as $row) {
                $address = str_replace (" ", "+", $row->caddress);
                $x[] = $address;
            }
            //build final piece of url
            $url2 = implode("|", $x);
            //destroy $x for reuse
            unset($x);
            //build url for optimization query
            $direction_url = $url1 . $url2 . $url3;
            //get json object from google directions
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $direction_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = json_decode(curl_exec($ch), true);

            //error check
            if ($response['status'] != 'OK') {
                return null;
            };

            //setup variable for distance
            $distance = 0;

            //loop through api returned json to get diatance of each leg
            foreach ($response['routes'][0]['legs'] as $leg){
                //add distance to total
                $distance += $leg['distance']['value'];
            }

            //update current route with the distance
            $this->db->where('bname', $business);
            $this->db->where('schd', $pdata['schd']);
            $this->db->where('rid', $i);
            $this->db->update('capsql.route', array('dist' => $distance));

            //store optimized waypoint order from json
            $order = $response['routes'][0]['waypoint_order'];
            //set counter for order position
            $oS = 0;

            //loop through deliveries setting position based on waypoint order
            foreach ($dquery->result() as $row) {
                $data = array(
                    'position' => $order[$oS]
                );
                $this->db->where('schd', $row->schd);
                $this->db->where('cid', $row->cid);
                $this->db->update('capsql.delivery', $data);
                //increase counter for order position
                $oS++;
            }
        }
    }

    /**
     * update routes with new users from post
     */
    public function updateRoute($pdata)
    {
        foreach (array_slice($pdata, 1) as $key =>$value) {
            //get rid from post key
            $rid = ltrim($key,"rid");
            //set array for db query on current route
            $rary = array(
                'schd' => $pdata['schd'],
                'bname' => $this->session->userdata('bname'),
                'rid' => $rid
            );
            //execute query
            $rquery = $this->db->get_where('capsql.route',$rary);
            //store query results
            $route = $rquery->result();
            //check if the route has been started
            if ($route[0]->start){
                //if route has been started perform hand off
                $this->handoff($route[0],$value);
            }
            else{
                //if route hasn't been started replace assigned user
                $this->db->where('schd', $pdata['schd']);
                $this->db->where('bname', $this->session->userdata('bname'));
                $this->db->where('rid', $rid);
                $this->db->update('capsql.route', array('uname' => $value));
            }
        }
    }

    /**
     * Delete routes and update associated deliveries for the given date
     */
    public function destNclnR($schd)
    {
        //set business name to variable
        $business = $this->session->userdata('bname');

        //delete the routes
        $this->db->delete('capsql.route', array('schd' => $schd , 'bname' => $business));

        //update deliveries
        $this->db->query("update delivery set rid = NULL, position = 0 where schd = '".$schd."' and cid in (select cid from customer where bname = '".$business."')");
    }

    /**
     * perform a hand off operation splitting a route in to two separate routes with a deffest user assigned
     * to the second route.
     */
    public function handoff($route,$uname)
    {
        //get number of routes
        $rary = array(
            $route->schd,
            $route->bname
        );
        $sql1 = "SELECT MAX(rid) FROM route WHERE schd = ? AND bname = ?";
        //execute query
        $rquery = $this->db->query($sql1,$rary);
        $rResults = $rquery->result();
        $rid = $rResults[0]->max;
        $rid = $rid + 1;

        $rupdate = array(
            'cmplt' => date("c")
        );
        $this->db->where('schd', $route->schd);
        $this->db->where('bname', $route->bname);
        $this->db->where('rid', $route->rid);
        $this->db->update('capsql.route',$rupdate);

        //create new route and insert into database
        $rupdate = array(
            'schd' => $route->schd,
            'bname' => $route->bname,
            'rid' => $rid,
            'uname' => $uname
        );
        $this->db->insert('capsql.route',$rupdate);

        //get all deliveries for existing route that haven't been delivered to and assign them to the new route
        //set business name to variable
        $business = $this->session->userdata('bname');
        $this->db->query("update delivery set rid = ".$rid.", position = 0 where schd = '".$route->schd."' and rid = ".$route->rid." and isdlv = false and cid in (select cid from customer where bname = '".$business."')");
        //optimize new route
        //gather business's data as results object
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));
        foreach ($bquery->result() as $row) {
            $bdata = $row;
        }

        $baddress = str_replace (" ", "+", $bdata->baddress);
        //set parts of the url
        $url1 = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $baddress . "&destination=" . $baddress . "&waypoints=optimize:true|";
        $url3 = "&key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY";
        $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '" . $route->schd . "' and c.bname = '" . $business . "' and d.rid = " . $rid . "");
        //loop through all of route's deliveries to build url string
        foreach ($dquery->result() as $row) {
            $address = str_replace (" ", "+", $row->caddress);
            $x[] = $address;
        }
        //build final piece of url
        $url2 = implode("|", $x);
        //build url for optimization query
        $direction_url = $url1 . $url2 . $url3;

        //get json object from google directions
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $direction_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);


        //error check
        if ($response['status'] != 'OK') {
            echo "we have a problem!!";
            return null;
        };

        //setup variables for distance
        $distance = 0;
        $distance2 = 0;

        //loop through api returned json to get distance of each leg
        foreach ($response['routes'][0]['legs'] as $leg){
            //add distance to total
            $distance += $leg['distance']['value'];
        }

        //set counter
        $z = 1;
        //get distance to be removed from previous route
        foreach ($response['routes'][0]['legs'] as $leg){
            if ($z == 1){
                $z++;
                continue;
            }
            //add distance to total
            $distance2 += $leg['distance']['value'];
        }

        //check if any progress has been made on previous route
        //this indirectly indicates if a delivery has been made
        if ($route->dist == $distance){
            //delete previous route if no deliveries have been made
            $this->db->where('bname', $business);
            $this->db->where('schd',$route->schd);
            $this->db->where('rid', $route->rid);
            $this->db->delete('route');
        }
        else{
            //calculate new distance
            $distance2 = $route->dist - $distance2;

            //update previous route with the new distance
            $this->db->where('bname', $business);
            $this->db->where('schd',$route->schd);
            $this->db->where('rid', $route->rid);
            $this->db->update('capsql.route', array('dist' => $distance2));
        }

        //update current route with the distance
        $this->db->where('bname', $business);
        $this->db->where('schd',$route->schd);
        $this->db->where('rid', $rid);
        $this->db->update('capsql.route', array('dist' => $distance));

        //store optimized waypoint order from json
        $order = $response['routes'][0]['waypoint_order'];
        //set counter for order position
        $oS = 0;

        //loop through deliveries setting position based on waypoint order
        foreach ($dquery->result() as $row) {
            $data = array(
                'position' => $order[$oS]
            );
            $this->db->where('schd', $row->schd);
            $this->db->where('cid', $row->cid);
            $this->db->update('capsql.delivery', $data);
            //increase counter for order position
            $oS++;
        }


    }

    /**
     * @param $rid
     * @return $this (the route object)
     * function to build a route object with various information used for delivery actions
     */
    public function getRoute($rid)
    {
        //store rid
        $this->rid = $rid;
        //store user name
        $this->uname = $this->session->userdata('uname');

        //store business name
        $this->bname = $this->session->userdata('bname');

        //get business address
        $sql1 = "SELECT * FROM business WHERE name = ?";
        $query1 = $this->db->query($sql1,array($this->bname));
        $result1 = $query1->result();
        $origin = str_replace(' ','+',$result1[0]->baddress);

        //store date
        $this->schd = date("Y-m-d");

        //get and store route data
        $sql2 = "SELECT * FROM capsql.route WHERE bname = ? AND schd = ? AND uname = ? AND rid = ?";
        $query2 = $this->db->query($sql2, array($this->bname,$this->schd,$this->uname,$rid) );
        $result2 = $query2->result();
        $this->dist = $result2[0]->dist * 0.00062137;
        $this->start = $result2[0]->start;
        $this->cmplt = $result2[0]->cmplt;

        //query to get delivery data
        $sql3 =  "SELECT * FROM capsql.delivery AS d, capsql.route AS r, capsql.customer AS c WHERE r.schd = d.schd AND r.rid = d.rid AND d.cid = c.cid AND r.schd = ? AND r.uname = ? AND r.rid = ? AND d.cid IN (SELECT cid FROM capsql.customer WHERE bname = ?) ORDER BY d.position";
        $result3 = $this->db->query($sql3 ,array($this->schd,$this->uname,$rid,$this->bname));
        //get count of all deliveries
        $this->dcount = $result3->num_rows();

        //delivery url
        foreach ($result3->result() as $drow)
        {
            $address[] = str_replace(' ','+',$drow->caddress);
        }
        $addresses = implode("+to:",$address);
        $this->gmapsite = "https://maps.google.com/maps?saddr=".$origin."&daddr=".$addresses."+to:".$origin;

        //store delivery data
        $this->deliveries['deliveries'] = $result3->result();

        //calculate number of all items
        $count = 0;
        foreach ($this->deliveries['deliveries'] as $row){
            $sql3 = "SELECT * FROM capsql.del_item AS d, capsql.chkitem AS i WHERE d.iid = i.iid AND d.cid = ? AND d.ischd = ?";
            $result3 = $this->db->query($sql3,array($row->cid,$this->schd));
            $temp = $result3->result();
            $this->deliveries['checklist'][] = $temp;
            foreach ($temp as $row2){
                $count += $row2->qty;
            }

        }
        $this->icount = $count;

        return $this;

    }

    /**
     * @param $data
     * Function to set delivery as completed
     */
    public function cmpltD($data)
    {
        if ($data['check'] == 'true'){
            $sql = "UPDATE delivery SET isdlv = 't' WHERE cid = ? AND schd = ?";
        }
        else{
            $sql = "UPDATE delivery SET isdlv = 'f' WHERE cid = ? AND schd = ?";
        }
        $result = $this->db->query($sql,array($data['cid'],date("Y-m-d")));
    }

    /**
     * @param $data
     * function to set delivery item as checked
     */
    public function checkI($data)
    {
        if ($data['check'] == 'true'){
            $sql = "UPDATE del_item SET ischk = 't' WHERE cid = ? AND ischd = ? AND iid = ?";
        }
        else{
            $sql = "UPDATE del_item SET ischk = 'f' WHERE cid = ? AND ischd = ? AND iid = ?";
        }
        $result = $this->db->query($sql,array($data['cid'],date("Y-m-d"),$data['iid']));
    }

    /**
     * @param $data
     * function to set start time for route or unset start time if stopped
     */
    public function startR($data)
    {
        if ($data['state'] == "start"){
            $sql = "UPDATE route SET start = current_timestamp WHERE bname = ? AND schd = ? AND rid = ?";
        }
        else{
            $sql = "UPDATE route SET start = NULL WHERE bname = ? AND schd = ? AND rid = ?";
        }
        $result = $this->db->query($sql,array($this->session->userdata('bname'),date("Y-m-d"),$data['rid']));
    }

    /**
     * @param $data
     * function to set route as completed by setting timestamp
     */
    public function cmpltR($data)
    {
        $sql = "UPDATE route SET cmplt = current_timestamp WHERE bname = ? AND schd = ? AND rid = ?";
        $result = $this->db->query($sql,array($this->session->userdata('bname'),date("Y-m-d"),$data['rid']));
    }

    /**
     * @param $data
     * function to unset timestamp if route is undone
     */
    public function uncmpltR($data)
    {
        $sql = "UPDATE route SET cmplt = NULL WHERE bname = ? AND schd = ? AND rid = ?";
        $result = $this->db->query($sql,array($this->session->userdata('bname'),date("Y-m-d"),$data['rid']));
    }

    /**
     * @param $query (database query with all deliveries to be checked against)
     * @return float (The radius)
     * Function to calculate radius based on delivery farthest from origin
     * Haversine formula
     */
    public function getRadius($query)
    {
        //set business name to variable
        $business = $this->session->userdata('bname');

        //gather business's data as results object
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));
        $bdata = $bquery->row();

        $R = 0.0;
        foreach($query->result() as $row){
            $dlon = deg2rad($bdata->blong - $row->clong);
            $dlat = deg2rad($bdata->blat - $row->clat);

            $a = (sin($dlat/2)) * (sin($dlat/2)) + cos(deg2rad($row->clat)) * cos(deg2rad($bdata->blat)) * (sin($dlon/2)) * (sin($dlon/2));
            $c = 2 * atan2(sqrt($a),sqrt(1-$a));
            $d = 3961 * $c;

            if ($d > $R)$R = $d;
        }
        return $R;
    }

}