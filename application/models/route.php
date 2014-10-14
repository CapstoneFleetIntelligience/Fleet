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

    public function rarray($pdata)
    {

        $business = $this->session->userdata('bname');


        //gather business's data
        $bquery = $this->db->get_where('capsql.business', array('name' => $business) );

        foreach ($bquery->result() as $row)
        {
            $bdata = $row;
        }

        //gather delivery data
        $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and d.schd = '".$pdata['schd']."' and c.bname = '".$business."'");

        //get number of deliveries
        $A = $dquery->num_rows();

        //exit if there are no deliveries
        if ($A < 1 ) return FALSE;

        //get number of deliverers
        $D = count($pdata['users']);

        //get maximum delivery capacity
        $C = $bdata->capacity;

        //get number of at capacity routes each deliverer gets
        $x = ($A / $C) / $D;

        //get the exact amount of at capacity routes per deliverer
        $W = round($x);
        if ($W > $x)$W--;


        //get remainder
        $R = $x - $W;

        //total number of at capacity routes
        $F = $W * $D;

        //create array to track the size and number of routes to be created
        for ($i = 1; $i <= $F; $i++)
        {
            $rarray[] = $C;
        }

        //get size of partial routes
        $y = $R * $C;


        //round
        $P = round($y);
        if ($P > $y)$P--;

        //get remainder
        $R = $y - $P;

        //add to array the number and size of partial routes
        for ($i = 1; $i <= $D; $i++)
        {
            $rarray[] = $P;
        }

        //identify the number remaining deliveries to be distributed to the partial routes
        $L = $R * $D;

        //distribute the remaining delivers to the partial routes
        $count = 1;
        $i = 0;
        foreach ($rarray as $z)
        {
            if ($count > $L)break;
            if ($z == $P)
            {
                $rarray[$i] = $z +1;
                $count++;
            }
            $i++;
        }

        //clean up
        $i = 0;
        foreach ($rarray as $z)
        {
            if($z == 0)unset($rarray[$i]);
            $i++;
        }

        //create routes based on the route array and assign users to routes
        //shuffle user list to avoid consistent route assignment
        shuffle($pdata['users']);
        $i = 0;
        $count = 0;
        foreach ($rarray as $size)
        {
            if ($count == $D)$count = 0;
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

    public function setRoute($pdata)
    {

    }
}