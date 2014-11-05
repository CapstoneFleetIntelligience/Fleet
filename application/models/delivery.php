<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/1/14
 * Time: 11:11 PM
 */

class delivery extends CI_Model
{
    public $cid;
    public $schd;
    public $note;

    public function __construct()
    {
        parent::__construct();
    }

    public function setDelv($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    public function getDeliveries()
    {
        $business = $this->session->userdata('bname');
        $dquery = $this->db->query("select * from delivery as d, customer as c where d.cid = c.cid and c.bname = '".$business."'");
        $customer = array();
        foreach($dquery->result() as $delivery)
        {
            $cust = new delivery();
            $cust->cid = $delivery->cid;
            $cust->schd = $delivery->schd;
            $cust->note = $delivery->note;
            $cust->address = $delivery->caddress;
            $cust->name = $delivery->cname;
            $cust->iname = null;
            $cust->qty = null;
            if($delivery->cid)
            {
                $this->db->select('qty, iname');
                $this->db->from('del_item');
                $this->db->where(array('cid' => $delivery->cid));
                $this->db->join('chkitem', 'del_item.iid = chkitem.iid');
                $query = $this->db->get();
                foreach($query->result() as $del_item)
                {
                    $cust->iname = $del_item->iname;
                    $cust->qty = $del_item->qty;
                }
            }
            $customer["$cust->cid"] = $cust;
        }
            return $customer;
    }
}