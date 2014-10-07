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
        $cdata = array_slice($data, 0, 5);
        $ddata = array_slice($data, 5, 1);
        $list = $data['list'];
        $x = array_slice($data, 7, 1);

        $cdata['caddress'] = str_replace (" ", "+", urlencode($cdata['caddress']));
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$cdata['caddress']."&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        if ($response['status'] != 'OK') {
            return null;
        };
        $geometry = $response['results'][0]['geometry'];

        $cdata['clat'] = $geometry['location']['lat'];
        $cdata['clong'] = $geometry['location']['lng'];

        $customer->custCheck($cdata);

        $xdata = array_merge($ddata,$x);

        $delivery->setDelv($xdata);
        $delivery->cid = $customer->cid;

        $this->db->insert('capsql.delivery', $delivery);

        if ($list == 'Yes')
        {
            $this->bChkList($delivery);
        }
        else
        {
            $data = array(
                'title' => 'Add New Delivery'
            );
            $this->load->template('custN',$data);
        }


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
        $list = array_slice($x, 0, -1);

        foreach ($list as $key => $val) {
            if ($val == '0') continue;
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
        $this->load->template('custN',$data);

    }

}
