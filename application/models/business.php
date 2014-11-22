<?php
/**
 * Created by PhpStorm.
 * User: Clifford
 * Date: 9/27/14
 * Time: 7:41 PM
 *
 * @property string $name
 * @property string $dpass
 * @property integer $radius
 * @property integer $capacity
 * @property integer $dsalt
 * @property string $bphone
 */


class business extends CI_Model
{
    public $name;
    public $radius;
    public $bphone;
    public $capacity;
    public $dpass;
    public $dsalt;
    public $baddress;
    public $blat;
    public $blong;

    /**
     * @method void __construct()
     * @method void createBusiness(array $data)
     * @method void encryptPass()
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Creates the business object
     * @param array $data business post data
     */
    public function createBusiness($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->encryptPass();
    }

    /**
     * Encrypts the business password
     */
    public function encryptPass()
    {
        $this->dsalt = mt_rand(10000000, 99999999999);
        $this->dpass = $this->dsalt.sha1($this->dpass);
    }

    public function changePass($newPass)
    {
        $this->name = $newPass['name'];
        $this->dpass = $newPass['bpass'];
        $this->db->where('name', $this->name);
        $this->encryptPass();
        if($this->db->update('business', array('dpass' => $this->dpass, 'dsalt' => $this->dsalt))) echo 'success';
        else throw new Exception();
    }

    public function updateRange($range)
    {
        $this->name = $range['name'];
        $this->radius = $range['radius'];
       $this->db->where('name', $this->name);
        if($this->db->update('business', array('radius' => $this->radius))) echo 'success';
        else throw new Exception();
    }

    public function loadModel()
    {
        $this->name = $this->session->userdata('bname');
        $query = $this->db->get_where('business', array('name' => $this->name));

        foreach ($query->row() as $key => $value){
            $this->$key = $value;
        }
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

        $this->blat = $geometry['location']['lat'];
        $this->blong = $geometry['location']['lng'];

    }

}