<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/23/14
 * Time: 4:19 PM
 */

class user_registration extends CI_Model
{
    public $name;
    public $role;
    public $pass;
    public $phone;
    public $email;
    public $salt;
    public $bid;
    public $uid;

    public function __construct()
    {
        parent::__construct();
    }

    public function createAdmin($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }

        $this->encryptPass();
        $this->generateID();
        $this->role = 'A';
    }

    public function encryptPass()
    {
        $this->salt = mt_rand(10000000, 99999999999);
        $this->pass = $this->salt.sha1($this->pass);
    }

    public function generateID()
    {
        $this->bid = mt_rand(1, 1500);
        $this->uid = mt_rand(1, 1500);
    }
}

?>