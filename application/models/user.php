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

        $query = $this->db->get_where('user', array('email' => $credentials['email']));

        foreach ($query->row() as $key => $value) {

            $this->$key = $value;
        }
        $pass = $this->salt . sha1($credentials['pass']);

        if ($this->pass == $pass) return $this;
        else return false;
    }

    /**
     * @param $user User object
     * @return string page to be redirected too
     * @todo choose between views or controller functions.
     */
    public function checkAccess($user)
    {

        switch ($user->role) {
            case 'A':
                return 'adminH';
            case 'M':
                return 'managerOverview';
            case 'E':
                return 'overview';
            default:
                break;
        }

    }


}

?>