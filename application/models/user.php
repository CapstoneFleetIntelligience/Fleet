<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 9/23/14
 * Time: 4:19 PM
 */

/**
 * Class user
 * @property string $name
 * @property string $role
 * @property string $pass
 * @property string $email
 * @property string $bname
 */
class user extends CI_Model
{
    public $uname;
    public $role;
    public $pass;
    public $uphone;
    public $email;
    public $salt;
    public $bname;

    /**
     * @method void __construct()
     * @method void createAdmin(array $data)
     * @method void encryptPass()
     * @method user|bool authenticate(array $credentials)
     * @method string checkAccess(user $user)
     */

    /**
     * Construct Method
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array $data post data
     */
    public function createAdmin($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->encryptPass();
        $this->role = 'A';
    }

    /**
     * Creates an employee of the business
     * @param array $data User email and role
     * @throw exception if insertion fails.
     */
    public function createEmployee($data)
    {

        $bname = $this->session->userdata('bname');
        $query = $this->db->get_where('business', array('name' => $bname));
        $business = new business();
        foreach ($query->row() as $key => $value) {
            $business->$key = $value;
        }

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        $this->bname = $bname;
        $this->uname = $this->createUsername($bname);
        $this->pass = $business->dpass;
        $this->salt = $business->dsalt;
        if ($this->db->insert('user', $this)) {
            return $this;
        } else throw new Exception();

    }

    /**
     * Sets each new username
     * @param string $bname name of the business
     * @return string $name username
     */
    public function createUsername($bname)
    {
        $name = str_replace(' ', '', $bname);
        $name = $name.mt_rand(100, 9999);
        return $name;
    }

    /**
     * Encrypt the user pass
     */
    public function encryptPass()
    {
        $this->salt = mt_rand(10000000, 99999999999);
        $this->pass = $this->salt . sha1($this->pass);
    }

    /**
     * Authenticates the user and returns the object
     * @param $credentials
     * @return $this|bool returns either user or false
     */
    public function authenticate($credentials)
    {

        $query = $this->db->get_where('user', array('uname' => $credentials['uname']));

        foreach ($query->row() as $key => $value) {

            $this->$key = $value;
        }
        $pass = $this->salt . sha1($credentials['pass']);

        if ($this->pass == $pass) return $this;
        else echo 'failed';
    }

    public function remove($user)
    {
        if ($this->db->delete('user', array('uname' => $user['uname']))) {
            $employees = $this->getEmployees($user['bname']);
            echo $this->load->view('editEmployee', array('employees' => $employees));

        }
    }

    public function update($user)
    {
        $update = array(
            'email' => $user['email'],
            'role' => $user['role']
        );
        $this->db->where('uname', $user['uname']);
        if ($this->db->update('user', $update)) {
            $employees = $this->getEmployees($user['bname']);
            echo $this->load->view('editEmployee', array('employees' => $employees));
        }
    }

    public function updatePass($pass)
    {
        $user = $this->session->userdata('uname');
        $this->pass = $pass;
        $this->encryptPass();
        if($this->db->update('user', array('pass' => $this->pass, 'salt' => $this->salt), array('uname' => $user)));
        else throw new Exception('failed to update', 404);
    }


    /**
     * @param $user User object
     * @return string page to be redirected too
     */
    public function checkAccess($user)
    {

        switch ($user->role) {
            case 'A':
                return '/adminH';
            case 'M':
                return '/managerOverview';
            case 'E':
                return '/overview';
            default:
                break;
        }

        return false;
    }

    /**
     * @param $id int represents the business name
     * @return array of the employees in the company.
     *
     */
    public function getEmployees($id)
    {

        $this->db->where('bname', $id);
        $this->db->where("role", 'E');
        $this->db->or_where('role', 'M');
        $this->db->where('bname', $id);
        $this->db->select('uname, bname, role, email, uphone');
        $query = $this->db->get('user');
        $employees = array();

        foreach ($query->result() as $index => $employee)
        {
           $employ = new user();

            foreach($employee as $key => $value)
            {
                $employ->$key = $value;
            }

            $employees[$index] = $employ;
        }
            return $employees;
    }

    /**
     * Finds the employee
     * @param $id the user name to be searched
     * @return object $this which is the user
     */
    public function loadModel()
    {
        $id = $this->session->userdata('uname');
        $query = $this->db->get_where('user', array('uname' => $id));

       foreach($query->row() as $key => $value)
        {
            $this->$key = $value;
        }

        return $this;

    }

}

?>