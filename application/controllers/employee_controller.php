<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/2/14
 * Time: 12:55 PM
 */

class employee_controller extends CI_Controller
{
    public function addNew()
    {
        $data = array(
          'title' => 'add new'
        );
        $this->load->template('addEmployee', $data);
    }

    public function create()
    {
        $this->user->createEmployee($this->input->post(null,true));
    }

} 