<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 10/7/14
 * Time: 12:01 PM
 */

class delivery_item extends CI_Model
{
    public $cid;
    public $iid;
    public $ischd;
    public $qty;

    /**
     * Standard construct function
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Creates the delivery item and inserts into delitem table.
     * @param array $data item to be inserted into the db
     */
    public function insert($data)
    {
        $this->cid = $data['cid'];
        $this->ischd = $data['ischd'];
        $data = array_slice($data, 2, NULL, TRUE);
        foreach($data as $key => $value)
        {
            $this->iid = $key;
            $this->qty = $value;
            $this->db->insert('del_item', $this);
        }
    }
}