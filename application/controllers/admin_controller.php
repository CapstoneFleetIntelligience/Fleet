<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/30/14
 * Time: 4:17 PM
 */

class admin_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addItem(){
        $data = $_POST;

        createItem($data);
    }

    public function addCust(){
        $data = $_POST;
        print_r($_POST) ;

        //createCust($data);
    }

}
