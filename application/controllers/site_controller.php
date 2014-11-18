<?php

/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/7/14
 * Time: 9:51 PM
 */
class Site_controller extends CI_Controller
{
    /**
     * @method void index()
     * @method void registration()
     * @method void register()
     * @method void login()
     * @method void|bool authenticate()
     * @method void adminH()
     * @method void itemN()
     * @method void addItem()
     */
    public function __construct()
    {
        return parent::__construct();
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
     * Registers new admin User and Business
     */
    public function register()
    {

        $user = new user();
        $business = new business();

        $data = $this->input->post(NULL, TRUE);
        $userData = array_chunk($data, 6, TRUE);

        $business->createBusiness($userData[0]);
        $business->setLatLong($business->baddress);
        $user->createAdmin($userData[1]);
        $user->bname = $business->name;
        if ($this->db->insert('capsql.business', $business)) {
            $this->db->insert('capsql.user', $user);
            $sessionD = array(
                'bname' => $user->bname,
                'role' => $user->role,
                'uname' => $user->uname
            );

            $this->session->set_userdata($sessionD);
            redirect('getStarted');
        } else throw new Exception();
    }

    public function getStarted()
    {
        $data = array(
          'title' => 'Lets get started'
        );
        $this->load->template('getStarted', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $data= array(
            'title' => 'Home'
        );
        redirect('');
    }

    /**
     * Authenticates and redirects user
     * Sets user session data
     */
    public function authenticate()
    {
        $user = $this->user->authenticate($this->input->post(NULL, TRUE));
        if ($user) {
            $index = $this->user->checkAccess($user);

            $sessionD = array(
                'bname' => $user->bname,
                'role' => $user->role,
                'uname' => $user->uname
            );

            $this->session->set_userdata($sessionD);
            redirect($index);
        } else return $user;
    }

    /**
     * Loads admin/managers home
     */
    public function adminH()
    {
        $role = $this->session->userdata('role');

       if($role == 'A')
       {
           $business = $this->business->loadModel();
           $customers = $this->customer->getCustomers();
           $items = $this->item->getItems($business->name);
           $deliveries = $this->delivery->getDeliveries($business->name);
           $employees = $this->user->getEmployees($business->name);

           $data = array(
               'title' => 'Managers Home',
               'customers' => $customers,
               'items' => $items,
               'deliveries' => $deliveries,
               'employees' => $employees,
               'business' => $business
           );

           $this->load->template('adminH', $data);
       }
        else redirect('');

    }

    public function analytics()
    {
        $role = $this->session->userdata('role');

        if($role)
        {
        $business = $this->business->loadModel();
        $employees = $this->user->getEmployees($business->name);
        $deliveryCount = $this->delivery->getCompleted();
        $user = $this->session->userdata('uname');
        $customers = $this->customer->getCustomers();
        $items = $this->item->getItems($business->name);
        $deliveries = $this->delivery->getDeliveries($business->name);
        $data = array(
            'title' => 'analytics',
            'employees'=> $employees,
            'customers' => $customers,
            'business' => $business,
            'count' => $deliveryCount,
            'user' => $user,
            'deliveries' => $deliveries,
            'items' => $items
        );
        $this->load->template('analytics', $data);
        }
        else redirect('');
    }


/*    public function adminE()
    {

        $business= $this->business->loadModel();
        $employees = $this->user->getEmployees($business->name);
        $deliveries = $this->delivery->getDeliveries($business->name);
        $data = array(
            'title' => 'Edit',
            'business' => $business,
            'employees' => $employees,
            'deliveries' => $deliveries,
        );

        $this->load->template('settings', $data);
    }*/

    /**
     * Render the item table for a business
     */
    public function itemTable()
    {
        $this->load->view('templates/item_table');
    }
}

