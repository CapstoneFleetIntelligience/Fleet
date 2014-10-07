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


}