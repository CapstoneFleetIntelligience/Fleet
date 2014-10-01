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

    /**
     * Home Page
     */
    public function index()
    {
        $data = array(
          'title' => 'home',
        );
        $this->load->template('home', $data);
    }

    /**
     * Registration Page
     */
    public function registration()
    {
        $data = array(
            'title' => 'Almost Done'
        );
        $this->load->template('registration',$data);
    }

    /**
     * Registers new admin User and Business
     */
    public function register()
    {
        $user = new user();
        $business = new business();

        $data = $this->input->post(NULL, TRUE);
        $userData = array_chunk($data, 6, TRUE);

        $business->createBusiness($userData[0]);
        $user->createAdmin($userData[1]);
        $user->bname = $business->name;

        if($this->db->insert('capsql.business', $business))
        {
            $this->db->insert('capsql.user', $user);
            $this->adminH();
        }
        else throw new Exception();
    }

    public function login()
    {
        $data = array(
            'title' => 'Login'
        );
        $this->load->template('login', $data);
    }

    public function authenticate()
    {
        $this->user->authenticate($this->input->post(NULL, TRUE));
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