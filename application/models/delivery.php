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

    /**
     * Creates the delivery object
     * @param $data delivery information
     */
    public function setDelv($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    /**
     * pulls all deliveries from the database
     * @return array of all deliveries for a business
     */
    public function getDeliveries()
    {
        $business = $this->session->userdata('bname');
        $dsql = "select * from delivery as d, customer as c where d.cid = c.cid and c.bname = ?";
        $dquery = $this->db->query($dsql, array($business));
        $customer = array();
        foreach($dquery->result() as $index => $delivery)
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
            $customer[$index] = $cust;
        }
            return $customer;
    }

    /**
     * Removes a delivery from the database
     * @param $delivery information passed to the function containing customer id and delivery date
     */
    public function removeDelivery($delivery)
    {
        $this->db->delete('delivery', array('cid' => $delivery['cid'], 'schd' => $delivery['schd']));
        $deliveries = $this->getDeliveries();
        echo $this->load->view('editDelivery', array('deliveries' => $deliveries));
    }

    /**
     * Inserts the delivery object into the database
     */
    public function insert()
    {
        if($this->db->insert('delivery', $this));
        else throw new Exception('Failed to insert');
    }
}