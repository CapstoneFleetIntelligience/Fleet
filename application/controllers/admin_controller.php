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

    /**
     * Adds item to the business table.
     */
    public function addItem()
    {

        $item = new item();
        $item->createItem($this->input->post(NULL, TRUE));
        $bname = $this->session->userdata('bname');
        $item->bname = $bname;
        if($this->db->insert('chkitem', $item))
        {
            echo $this->load->view('templates/item_table', array('bname' => $item->bname));
        }
    }

    /**
     * adds customer to delivery table
     */
    public function addCust()
    {
        $delivery = new delivery();
        $customer = new customer();

        $data = $this->input->post(NULL, TRUE);

        $cdata = array_slice($data, 0, 3);
        $ddata = array_slice($data, 3, 1);
        $list = $data['list'];
        $note = array_slice($data, 5, 1);
        $customer->custCheck($cdata);
        $deliveryData = array_merge($ddata,$note);
        $delivery->setDelv($deliveryData);
        $delivery->cid = $customer->cid;
        $this->db->insert('capsql.delivery', $delivery);
        if ($list == 'Yes') $this->load->view('bChkList', array('delivery' => $delivery));
        else echo 'reset';
    }

    /**
     * Adds the customer list to delivery items
     */
    public function addList()
    {
        $this->delivery_item->insert($this->input->post(NULL, TRUE));

    }

}
