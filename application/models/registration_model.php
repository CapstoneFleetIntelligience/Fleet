<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/23/14
 * Time: 4:19 PM
 */

class registration_model extends CI_Model
{
    public $email;
    public $managerName;
    public $businessName;
    public $maxDeliveryRange;

    public function __construct()
    {
        parent::__construct();
    }

    public function createUser($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

}

?>