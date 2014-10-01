<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/23/14
 * Time: 4:19 PM
 */

/**
 * Class user
 * @property string $name
 * @property string $role
 * @property string $pass
 * @property string $email
 * @property string $bname
 */

class user extends CI_Model
{
    public $uname;
    public $role;
    public $pass;
    public $uphone;
    public $email;
    public $salt;
    public $bname;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $data post data
     */
    public function createAdmin($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }

        $this->encryptPass();
        $this->role = 'A';
    }

    public function encryptPass()
    {
        $this->salt = mt_rand(10000000, 99999999999);
        $this->pass = $this->salt.sha1($this->pass);
    }

    public function authenticate($credentials)
    {
        
    }


}

?>