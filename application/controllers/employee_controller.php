<<<<<<< HEAD
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

=======
<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/2/14
 * Time: 12:55 PM
 */

class employee_controller extends CI_Controller
{
    /**
     * Employees home page
     */
    public function index()
    {
        $data = array(
            'title' => 'home'
        );
        $this->load->template('employeeHome', $data);
    }
    /**
     * Loads the addnew employee view
     */
    public function addNew()
    {
        $data = array(
          'title' => 'add new'
        );
        $this->load->template('addEmployee', $data);
    }

    /**
     * Creates an employee user
     */
    public function create()
    {
        $this->user->createEmployee($this->input->post(null,true));
    }

>>>>>>> f972b268a1295ea69c45347b0dd667a0d5cd7dfa
} 