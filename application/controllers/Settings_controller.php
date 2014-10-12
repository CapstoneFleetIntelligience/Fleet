<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/9/14
 * Time: 12:24 PM
 */

class Settings_controller extends CI_Controller {

    public function __construct()
    {
        return parent::__construct();
    }

    public function editEmploy()
    {

    }

    public function editDelivery()
    {

    }

    public function editPass()
    {
       $this->business->changePass($this->input->post(NULL, true));
    }

    public function editRange()
    {
        $range = $this->input->post(NULL, TRUE);
        $this->business->updateRange($range);
    }
} 