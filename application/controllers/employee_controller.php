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
        $user = $this->user->loadModel();
        $business = $this->business->loadModel();

        $data = array(
            'title' => 'home',
            'user' => $user,
            'business' => $business
        );

         $this->load->template('employeeHome', $data);
    }

    public function changePass()
    {
        $this->user->updatePass($_POST['pass']);
    }

    /**
     * Loads the contact view
     */
    public function contact()
    {
        $data = array(
          'title' => 'Contact'
        );

        $this->load->template('contact', $data);
    }

    /**
     * Loads the assignment view
     */
    public function assignment()
    {
        $data = array(
            'title' => 'assignments'
        );

        $this->load->template('assignment', $data);
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

    public function removeEmployee()
    {
        $data = $this->input->post(NULL, TRUE);
        $this->user->remove($data);
    }

    public function updateEmployee()
    {
        $data = $this->input->post(NULL, TRUE);
        $this->user->update($data);

    }


    /**
     * Creates an employee user
     */
    public function create()
    {
       $user = $this->user->createEmployee($this->input->post(null,true));
        $this->sendEmail($user);
        echo $this->load->view('templates/success', array('user' => $user));
    }

    /**
     * Sends an email to the newly registered user
     * @param $user the user object being sent
     */
    public function sendEmail($user)
    {
        $this->load->library('email');

       $message = 'This email contains information regarding your recent registration to Fleet Intelligience. To log
         in use your user id '.$user->uname.' finally use the password which your boss should provide you with to log
          in for the first time';
        $this->email->from('Fleetintelligience0@gmail.com', 'Fleet Intelligience');
        $this->email->to($user->email);
        $this->email->subject('Welcome to Fleet Intelligience');
        $this->email->message($message);
        if(!$this->email->send()) echo $this->email->print_debugger();

    }
} 