<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 11/11/14
 * Time: 10:08 AM
 */

/**
 * Class deliverer
 * @property string $uname
 * @property string $bname
 */
class deliverer extends CI_Model
{
    public $uname;
    public $bname;
    public $dist;
    public $routes;
    public $rcount;
    public $dcount;
    public $icount;

    public function __construct()
    {
        parent::__construct();
    }

    public function getDeliverer(){
        //store user name
        $this->uname = $this->session->userdata('uname');

        //store business name
        $this->db->select('bname');
        $query1 = $this->db->get_where('capsql.user',array('uname' => $this->uname));
        $result1 = $query1->result();
        $this->bname = $result1[0]->bname;

        //get routes information
        $sql1 = "SELECT * FROM capsql.route WHERE bname = ? AND schd = ? AND uname = ?";
        $result1 = $this->db->query($sql1, array($this->bname,date("Y-m-d"),$this->uname) );
        //store count of total routes
        $this->rcount = $result1->num_rows();
        if ($this->rcount == 0) return false;
        //store route information
        $this->routes['route'] = $result1->result();

        //store total distance of routes
        $this->dist = 0;
        foreach ($result1->result() as $row){
            $this->dist += $row->dist;
        }
        $this->dist = $this->dist * 0.00062137;



        //query to get delivery data
        $sql2 =  "SELECT * FROM capsql.delivery AS d, capsql.route AS r WHERE r.schd = d.schd AND r.rid = d.rid AND r.schd = ? AND r.uname = ? AND d.cid IN (SELECT cid FROM capsql.customer WHERE bname = ?)";
        $result2 = $this->db->query($sql2, array(date("Y-m-d"),$this->uname,$this->bname));
        //get count of all deliveries
        $this->dcount = $result2->num_rows();

        //query to get delivery item data
        $sql3 = "SELECT i.qty FROM capsql.customer AS c, capsql.del_item AS i WHERE i.cid = c.cid AND c.bname = ? AND i.ischd = ? AND c.cid IN (SELECT d.cid FROM capsql.delivery AS d, capsql.route AS r WHERE r.schd = d.schd AND r.rid = d.rid AND r.schd = ? AND r.uname = ?)";
        $result3 = $this->db->query($sql3,array($this->bname,date("Y-m-d"),date("Y-m-d"),$this->uname));
        //get total delivery items
        $this->icount = 0;
        foreach ($result3->result() as $row){
            $this->icount += $row->qty;
        }
        //get the waypoints for the routes
        //loop through all routes
        foreach ($this->routes['route'] as $row){
            //query to get delivery data
            $sql4 =  "SELECT * FROM capsql.delivery AS d, capsql.route AS r, capsql.customer AS c WHERE r.schd = d.schd AND r.rid = d.rid AND d.cid = c.cid AND r.schd = ? AND r.uname = ? AND r.rid = ? AND d.cid IN (SELECT cid FROM capsql.customer WHERE bname = ?) ORDER BY d.position";
            $result4 = $this->db->query($sql4 ,array(date("Y-m-d"),$this->uname,$row->rid,$this->bname));
            //assemble waypoint as a single string
            if ($result4->num_rows() != 0){
                foreach ($result4->result() as $drow)
                {
                    $address = str_replace('%2C',',',$drow->caddress);
                    $waypoint[] = "{location:\"".$address."\"}";
                }
                $waypoints = implode(",",$waypoint);
            }
            else $waypoints = "";
            //store waypoints
            $this->routes['waypoints'][] = $waypoints;
            unset($waypoint);
        }
        return $this;
    }




} 