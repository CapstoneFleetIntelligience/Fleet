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

        $user = new registration_model;
        $data = $_POST;
        $user->createUser($data);

        $this->db->insert('capsql.user', $user);
    }

    public function adminH()
    {
        $data = array(
            'title' => 'Managers Home'
        );
        $this->load->template('adminH',$data);
    }

    public function itemN(){
        $data = array(
            'title' => 'Add New Item'
        );
        $this->load->template('itemN',$data);
    }

    public function addItem(){
        $data = $_POST;

        createItem($data);
    }
}