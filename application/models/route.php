<?php

/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/13/14
 * Time: 11:18 PM
 */
class route extends CI_Model
{
    public $bname;
    public $uname;
    public $schd;
    public $cmplt;
    public $start;
    public $rid;

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


        //round
        $P = round($y);
        if ($P > $y) $P--;

        //get remainder
        $R = $y - $P;

        //add to array the number and size of partial routes
        for ($i = 1; $i <= $D; $i++) {
            $rarray[] = $P;
        }

        //identify the number remaining deliveries to be distributed to the partial routes
        $L = $R * $D;

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

        //return rarray
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
        $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '" . $pdata['schd'] . "' and c.bname = '" . $business . "'");

        //set position lat and long of business
        $CX = $bdata->blat;
        $CY = $bdata->blong;

        //increase the radius to compensate for margin of error
        $R = $bdata->radius * 1.002;

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

    //function to optimize the order of deliveries in all routes for a given day
    public function optimizeR($pdata, $rarray)
    {
        //set business name to variable
        $business = $this->session->userdata('bname');

        //gather business's data as results object
        $bquery = $this->db->get_where('capsql.business', array('name' => $business));
        foreach ($bquery->result() as $row) {
            $bdata = $row;
        }

        //set parts of the url
        $url1 = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $bdata->baddress . "&destination=" . $bdata->baddress . "&waypoints=optimize:true|";
        $url3 = "&key=AIzaSyBsl9m5vNRyfN_82WPuUUDpycK6FjwcPEY";
        //get size of route array
        $tR = count($rarray);
        //loop through all routes deliveries to build url string
        for ($i = 0; $i < $tR; $i++) {
            //gather delivery data
            $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '" . $pdata['schd'] . "' and c.bname = '" . $business . "' and d.rid = " . $i . "");
            //loop through all of route's deliveries to build url string
            foreach ($dquery->result() as $row) {
                $address = str_replace('%2C', ',', $row->caddress);
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

    public function updateRoute($pdata)
    {
        $i = 0;
        foreach (array_slice($pdata, 1) as $value) {
            $this->db->where('schd', $pdata['schd']);
            $this->db->where('bname', $this->session->userdata('bname'));
            $this->db->where('rid', $i);
            $this->db->update('capsql.route', array('uname' => $value));
            $i++;
        }
    }
}