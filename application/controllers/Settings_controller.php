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

    /**
     * @todo function edits the employee information
     */
    public function editEmploy()
    {

    }

    /**
     * @todo setup editing the deliveries
     */
    public function editDelivery()
    {

    }

    /**
     * Allows the admin to change the business password
     */
    public function editPass()
    {
       $this->business->changePass($this->input->post(NULL, true));
    }

    /**
     * Edit the range of the business
     */
    public function editRange()
    {
        $range = $this->input->post(NULL, TRUE);
        $this->business->updateRange($range);
    }
} 