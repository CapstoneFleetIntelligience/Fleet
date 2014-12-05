<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/5/14
 * Time: 8:29 PM
 */

class business_controller extends CI_Controller
{
    public function __construct()
    {
        return parent::__construct();
    }

    public function removeItem()
    {
        $data = $this->input->post(NULL, TRUE);
        $this->item->updateItem($data['id']);
    }

    public function getItemsSold()
    {
        $sql = "SELECT c.iname as item, SUM(i.qty) as qty FROM chkitem AS c, del_item AS i WHERE c.iid = i.iid AND c
        .bname = ?
        GROUP BY c.iname";
        $query = $this->db->query($sql, array($this->session->userdata('bname')));
        $items = array();
        $items['cols'][] = array(
            'id' => 'item',
            'type' => 'string'
        );
        $items['cols'][] = array(
            'id' => 'qty',
            'type' => 'number'
        );
        foreach ($query->result() as $index => $item) {
            $item->qty = (int)$item->qty;
          $items['rows'][$index]['c'] = array(array('v'=>$item->item), array('v'=>$item->qty));
        }
        $item_array = json_encode($items);
        echo $item_array;

    }

}