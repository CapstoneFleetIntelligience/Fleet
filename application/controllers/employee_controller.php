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
       $user = $this->user->createEmployee($this->input->post(null,true));
        $this->sendEmail($user);
        echo $this->load->view('templates/success', array('user' => $user));
    }

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