<<<<<<< HEAD

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
     * Registration Page
     */
    public function registration()
    {
        $data = array(
            'title' => 'Almost Done'
        );

        $this->load->template('registration', $data);
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


        if ($this->db->insert('capsql.business', $business)) {
            $this->db->insert('capsql.user', $user);
            $sessionD = array(
                'bname' => $user->bname,
                'role' => $user->role,
                'uname' => $user->uname
            );
            $this->session->set_userdata($sessionD);
            $this->adminH();
        } else throw new Exception();
    }

    /**
     * Loads the login page
     */
    public function login()
    {
        $data = array(
            'title' => 'Login'
        );
        $this->load->template('login', $data);
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
        $data = array(
            'title' => 'Managers Home'
        );
        $this->load->template('adminH', $data);
    }

    public function adminE()
    {
        $data = array(
            'title' => 'Edit'
        );
        $this->load->template('settings', $data);
    }

    /**
     * Loads the item add page
     */
    public function itemN()
    {
        $data = array(
            'title' => 'Add New Item'
        );
        $this->load->template('itemN', $data);
    }

    public function custN()
    {
        $data = array(
            'title' => 'Add New Delivery'
        );
        $this->load->template('custN', $data);
    }
}

=======

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
     * Registration Page
     */
    public function registration()
    {
        $data = array(
            'title' => 'Almost Done'
        );

        $this->load->template('registration', $data);
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


        if ($this->db->insert('capsql.business', $business)) {
            $this->db->insert('capsql.user', $user);
            $sessionD = array(
                'bname' => $user->bname,
                'role' => $user->role,
                'uname' => $user->uname
            );

            $this->session->set_userdata($sessionD);
            $this->adminH();
        } else throw new Exception();
    }

    /**
     * Loads the login page
     */
    public function login()
    {
        $data = array(
            'title' => 'Login'
        );
        $this->load->template('login', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $data= array(
            'title' => 'Home'
        );
        $this->load->template('home', $data);
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
        $data = array(
            'title' => 'Managers Home'
        );
        $this->load->template('adminH', $data);
    }

    public function adminE()
    {

        $business= $this->business->loadModel();
        $employees = $this->user->getEmployees($business->name);
        $data = array(
            'title' => 'Edit',
            'business' => $business,
            'employees' => $employees
        );

        $this->load->template('settings', $data);
    }

    /**
     * Loads the item add page
     */
    public function itemN()
    {
        $data = array(
            'title' => 'Add New Item'
        );
        $this->load->template('templates/item_table', $data);
    }

    public function custN()
    {
        $data = array(
            'title' => 'Add New Delivery'
        );
        $this->load->template('custN', $data);
    }
}

>>>>>>> f972b268a1295ea69c45347b0dd667a0d5cd7dfa
