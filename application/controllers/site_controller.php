<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/7/14
 * Time: 9:51 PM
 */
class Site_controller extends CI_Controller
{

    public function index()
    {
        $data = array(
          'title' => 'home',
        );
        $this->load->template('home', $data);
    }
} 