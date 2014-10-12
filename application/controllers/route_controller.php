<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/11/14
 * Time: 8:00 PM
 */
class route_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function routeN()
    {
        $data = array(
            'title' => 'Setup Route'
        );

        $this->load->template('routeN', $data);
    }


}