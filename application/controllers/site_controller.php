<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/7/14
 * Time: 9:51 PM
 */
class Site_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
          'title' => 'home',
        );
        $this->load->template('home', $data);
    }

    public function registration()
    {
        $data = array(
            'title' => 'register'
        );
        $this->load->template('registration',$data);
    }

    public function register()
    {
        $user = new user_registration();
        $data = $_POST;
        $user->createAdmin($data);
        $this->session->set_userdata('user', serialize($user));
        $this->businessRegistration();
    }

    public  function registerBusiness()
    {

        $business = new business_registration();

        $user = unserialize($this->session->userdata('user'));
        $data = $_POST;
        $business->createBusiness($data);
        $business->bid = $user->bid;

        if(isset($business->bid))
        {
            $this->db->insert('capsql.business', $business);
            $this->db->insert('capsql.user', $user);
            $this->index();
        }

    }

    public function businessRegistration()
    {
        $data = array(
            'title' => 'Almost Done',
        );
        $this->load->template('bRegistration', $data);
    }
}