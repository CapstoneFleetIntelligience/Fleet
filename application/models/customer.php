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

    public function setData($cdata)
    {
        foreach ($cdata as $key => $value) {
            $this->$key = $value;
        }
        $this->setLatLong($this->caddress);
        $this->custCheck();

        return $this;
    }

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
}