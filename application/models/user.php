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

        $this->db->select('uname, role, pass, salt, email, bname, uphone');
        $query = $this->db->get_where('user', array('uname' => $credentials['uname']));

        foreach ($query->row() as $key => $value) {

            $this->$key = $value;
        }
        $pass = $this->salt . sha1($credentials['pass']);

        if ($this->pass == $pass) return $this;
        else return false;
    }

    /**
     * Removes a user from the db
     * @param $user array user information
     */
    public function remove($user)
    {
        if ($this->db->delete('user', array('uname' => $user['uname']))) {
            $employees = $this->getEmployees($user['bname']);
            echo $this->load->view('editEmployee', array('employees' => $employees));

        }
    }

    /**
     * Updates the user in the db
     * @param $user array user information
     */
    public function update($user)
    {
        $update = array(
            'email' => $user['email'],
            'role' => $user['role'],
            'uphone' => $user['uphone']
        );
        $this->db->where('uname', $user['uname']);
        if ($this->db->update('user', $update)) {
            return true;
        }
        else throw new Exception('Failed to update user');
    }

    /**
     * Updates the users password in the database
     * @param $pass string new password
     * @throws Exception
     */
    public function updatePass($pass)
    {
        $user = $this->session->userdata('uname');
        $this->pass = $pass;
        $this->encryptPass();
        if($this->db->update('user', array('pass' => $this->pass, 'salt' => $this->salt), array('uname' => $user)));
        else throw new Exception('failed to update', 404);
    }

    public function changePass($passData)
    {
        $passData['uname'] = $this->session->userdata('uname');
        $user = $this->authenticate($passData);
        if($user)
        {
            $user->pass = $passData['newPass'];
            $user->encryptPass();
            $this->db->update('user', $user, "uname = '$user->uname'");
            return true;
        }
        else
            return false;
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
        $this->db->select('uname, bname, role, email, uphone, avgtime');
        //$this->db->select('uname, bname, role, email, uphone, tdist, avgtime, titems');
        $query = $this->db->get('user');
        $employees = array();

        foreach ($query->result() as $index => $employee)
        {
           $employ = new user();

            foreach($employee as $key => $value)
            {
                $employ->$key = $value;
            }
            //query to get total deliveries
            $sql1 = "SELECT count(*) FROM delivery AS d, route AS r, customer AS c WHERE r.schd = d.schd AND r.rid = d.rid AND d.cid = c.cid AND r.uname = ? AND d.cid IN (SELECT cid FROM capsql.customer WHERE bname = ?)";
            $result1 = $this->db->query($sql1 ,array($employ->uname,$employ->bname));
            $tdelivery = $result1->row();
            $employ->tdelivery = $tdelivery->count;

            //query to get total distance
            $sql2 = "SELECT sum(dist) FROM route WHERE uname = ?";
            $result2 = $this->db->query($sql2, array($employ->uname));
            $tdist = $result2->row();
            $employ->tdist = round($tdist->sum * 0.00062137 , 2);

            //query to get total items
            $sql3 = "SELECT sum(di.qty) FROM delivery AS d, route AS r, customer AS c, del_item AS di, chkitem AS i WHERE r.schd = d.schd AND r.rid = d.rid AND d.cid = c.cid AND di.iid = i.iid AND di.cid = c.cid AND di.ischd = d.schd AND r.uname = ? AND d.cid IN (SELECT cid FROM capsql.customer WHERE bname = ?)";
            $result3 = $this->db->query($sql3 ,array($employ->uname,$employ->bname));
            $titems = $result3->row();
            $employ->titems = $titems->sum;

            //query to get average time
            $sql4 = "SELECT AVG(cmplt - start) as avgtime FROM route WHERE uname = ?";
            $result4 = $this->db->query($sql4, array($employ->uname));
            $avgtime = $result4->row();
            if ($avgtime->avgtime)$seconds = strtotime($avgtime->avgtime);

            else $seconds = 0;

            $employ->avgtime = $seconds;

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