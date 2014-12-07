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
        if ($this->db->insert('chkitem', $item)) {
            $items = $this->item->getItems($bname);
            echo $this->load->view('templates/item_table', array('items' => $items));
        }
    }

    /**
     * adds customer to delivery table
     */
    public function addCust()
    {
        $delivery = new delivery();
        $customer = new customer();

        $data = $this->input->post(NULL, true);

        $cdata = array(
            'cname' => $data['cname'],
            'caddress' => $data['address'] . ', ' . $data['city'] . ',' . $data['state'] . ' ' . $data['zip'],
            'cphone' => $data['cphone']
        );
        $ddata = array(
            'schd' => $data['schd'],
            'note' => $data['note']
        );
        $list = $this->input->post('list');
        $customer->setData($cdata);
        $delivery->setDelv($ddata);
        $delivery->cid = $customer->cid;
        $items = $this->item->getItems($customer->bname);
        if ($list == 'Yes') $this->load->view('bChkList', array('delivery' => $delivery, 'items' => $items));
        else echo 'reset';

        $this->db->insert('capsql.delivery', $delivery);
    }

    /**
     * Removes delivery from the database
     */
    function removeDelivery()
    {
        $data = $this->input->post(NULL, TRUE);
        $this->delivery->removeDelivery($data);
    }

    /**
     * Creates new delivery for current customer
     */
    function newDelivery()
    {
        $data = $this->input->post(NULL, TRUE);

        $delData = array(
            'cid' => $data['cid'],
            'schd' => $data['ischd'],
            'note' => $data['note'],
        );
        array_pop($data);
        $delivery = new delivery();
        $delivery->setDelv($delData);
        $delivery->insert();
        $this->delivery_item->insert($data);
        $deliveries = $this->delivery->getDeliveries($this->session->userdata('bname'));
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
    }

    /**
     * Adds the customer list to delivery items
     */
    public function addList()
    {
        $this->delivery_item->insert($this->input->post(NULL, TRUE));
        $deliveries = $this->delivery->getDeliveries($this->session->userdata('bname'));
        $this->load->view('editDelivery', array('deliveries' => $deliveries));
    }

}
