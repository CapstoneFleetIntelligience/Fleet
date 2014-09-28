<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:58 PM
 */
class item_model extends CI_Model
{

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function createItem($data)
    {
        $iID = generateRandomString(20);

        $bID = $this->session->userdata('bID');

        $data[] = array("iid" => $iID, "bid" => $bID);

        $this->db->insert('capsql.chkitem', $data);

    }

}