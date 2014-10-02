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
        $item = new item_model();

        $data = $this->input->post(NULL, TRUE);
        $userData = array_chunk($data, 3, TRUE);
        $item->createItem($userData[0]);
        $item->bname = $this->session->userdata('bname');

        $this->db->insert('capsql.chkitem', $item);

        $data = array(
            'title' => 'Managers Home'
        );
        $this->load->template('adminH',$data);
    }

    public function addCust(){
        print_r($_POST) ;

        //createCust($data);
    }

}
