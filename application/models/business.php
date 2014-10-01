<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/27/14
 * Time: 7:41 PM
 */

class business extends CI_Model
{
    public $name;
    public $radius;
    public $bphone;
    public $capacity;
    public $dpass;
    public $dsalt;

    public function __construct()
    {
        parent::__construct();
    }

    public function createBusiness($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
        $this->encryptPass();

    }

    public function encryptPass()
    {
        $this->dsalt = mt_rand(10000000, 99999999999);
        $this->dpass = $this->dsalt.sha1($this->dpass);
    }


}