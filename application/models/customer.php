<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 9/30/14
 * Time: 11:36 PM
 */
class customer extends CI_Model
{
    public $cid;
    public $bname;
    public $cname;
    public $caddress;
    public $cphone;
    public $clat;
    public $clong;

    public function __construct()
    {
        parent::__construct();
    }

    public function custCheck($data)
    {
        $query = $this->db->get_where('customer', array('cname' => $data['cname'],'caddress' => $data['caddress']));

        if ($query->num_rows() > 0)
        {

            $this->db->update('customer', array('cphone' => $data['cphone']),array('cname' => $data['cname'],'caddress' => $data['caddress']));

        }
        else
        {
            ?><script
            <?php

            $x = array('bname' => $this->session->userdata('bname'));
            $xdata = array_merge($data,$x);

            $this->db->insert('capsql.customer', $xdata);

        }

        $query = $this->db->get_where('customer', array('cname' => $data['cname'],'caddress' => $data['caddress']));

        foreach ($query->row() as $key => $value) {

            $this->$key = $value;
        }

    }

}