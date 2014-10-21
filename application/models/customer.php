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
    public $cid;
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
     * @param $data params to find the customer
     */
    public function custCheck($data)
    {
        $query = $this->db->get_where('customer', array('cname' => $data['cname'],'caddress' => $data['caddress']));

        if ($query->num_rows() > 0)
        {

            $this->db->update('customer', array('cphone' => $data['cphone']),array('cname' => $data['cname'],'caddress' => $data['caddress']));

        }
        else
        {

            $busName = array('bname' => $this->session->userdata('bname'));
            $custData = array_merge($data,$busName);
            $this->db->insert('capsql.customer', $custData);

        }

        $query = $this->db->get_where('customer', array('cname' => $data['cname'],'caddress' => $data['caddress']));

        foreach ($query->row() as $key => $value) {
            $this->$key = $value;
        }
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