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

        $item = new item();
        $item->createItem($this->input->post(NULL, TRUE));
        $bname = $this->session->userdata('bname');
        $item->bname = $bname;
        if($this->db->insert('chkitem', $item))
        {
            echo $this->load->view('templates/item_table', array('bname' => $item->bname));
        }
    }

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
        //$this->db->insert('capsql.delivery', $delivery);

        if ($list == 'Yes') $this->load->view('bChkList', array('delivery' => $delivery));
        else echo 'reset';
    }

    public function bChkList($delivery)
    {
        $data = array(
            'title' => 'Build Checklist',
            'mycid' => $delivery->cid,
            'myschd' => $delivery->schd
        );

        $this->load->template('bChkList', $data);
    }

    public function addList()
    {

        $data = $this->input->post(NULL, TRUE);


        $ddata = array_slice($data, 0, 2);
        $x = array_slice($data, 2);
        var_dump($ddata);
        echo '<br/>';
        var_dump($x);
        /*$list = array_slice($x, 0, -1);

        foreach ($list as $key => $val) {
            $key = substr($key,1);
            $del_item = array(
                'cid' => $ddata['cid'],
                'ischd' => $ddata['ischd'],
                'iid' => $key,
                'qty' => $val
            );
            $this->db->insert('capsql.del_item', $del_item);
        }

        $data = array(
            'title' => 'Add New Delivery'
        );
        $this->load->template('custN',$data);*/

    }

}
