<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 9/30/14
 * Time: 11:36 PM
 */
class customer extends CI_Model
{
    /**
     * @var int $cid
     * @var string $bname
     * @var string $cname
     *
     */
    public $bname;
    public $cname;
    public $caddress;
    public $cphone;
    public $clat;
    public $clong;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Checks that customer exist
     * @param $customer params to find the customer
     */
    public function custCheck()
    {
        $query = $this->db->get_where('customer', array('cname' => $this->cname,'caddress' => $this->caddress));

        if ($query->num_rows() > 0)
        {
            $this->db->update('customer', array('cphone' => $this->cphone),array('cname' => $this->cname,
                                                                     'caddress' => $this->caddress,
                                                                     'clat' => $this->clat, 'clong' => $this->clong));
        }
        else
        {
            $busName = $this->session->userdata('bname');
            $this->bname = $busName;
            $this->db->insert('customer', $this);
        }

        $this->db->select('cid');
        $query = $this->db->get_where('customer', array('cname' => $this->cname, 'caddress' => $this->caddress));
        $data = $query->row();
        $this->cid = $data->cid;

    }

    /**
     * Sets the customer data to be inserted into the db
     * @param $cdata the data to be turned into the object
     * @return $this customer object being returned
     */
    public function setData($cdata)
    {
        foreach ($cdata as $key => $value) {
            $this->$key = $value;
        }
        $this->setLatLong($this->caddress);
        $this->custCheck();
        $this->bname = $this->session->userdata('bname');

        return $this;
    }

    /**
     * Sets the lat/long for each customer
     * @param $address the customers address to be converted
     */
    public function setLatLong($address)
    {
        $address = str_replace (" ", "+", urlencode($address));
        $location_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $location_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        if ($response['status'] != 'OK') {
        return null;
        };

        $geometry = $response['results'][0]['geometry'];

        $this->clat = $geometry['location']['lat'];
        $this->clong = $geometry['location']['lng'];

    }

    /**
     * Retrieves all customers from the database
     * @return array of all customers in the database
     */
    public function getCustomers()
    {
        //Query pulling customers without deliveries
        $business = $this->session->userdata('bname');
        $this->db->select('cid, cname, bname');
        $query = $this->db->get_where('customer',array('bname' => $business));
        $customers = array();
        foreach($query->result() as $index => $customer)
        {
            $cust = new customer();
            foreach($customer as $key => $value)
            {
                $cust->$key = $value;
            }
            $customers[$index] = $cust;
        }
        return $customers;
    }
}