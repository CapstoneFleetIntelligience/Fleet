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

    public function addItem()
    {
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

    public function addCust()
    {
        $delivery = new delivery();
        $customer = new customer();

        $data = $this->input->post(NULL, TRUE);
        $cdata = array_slice($data, 0, 3);
        $ddata = array_slice($data, 3, 1);
        $list = $data['list'];
        $x = array_slice($data, 5, 1);

        $customer->custCheck($cdata);

        $xdata = array_merge($ddata,$x);

        $delivery->setDelv($xdata);
        $delivery->cid = $customer->cid;

        $this->db->insert('capsql.delivery', $delivery);

        if ($list == yes)
        {
            $this->bChkList($cdata);
        }
        else
        {
            $data = array(
                'title' => 'Add New Delivery'
            );
            $this->load->template('custN',$data);
        }


    }

    public function bChkList($cdata)
    {
        $data = array(
            'title' => 'Build Checklist'
        );
        $this->load->template('bChkList', $data);
    }

}
