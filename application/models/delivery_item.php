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

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->cid = $data['cid'];
        $this->ischd = $data['ischd'];
        $data = array_slice($data, 2, NULL, TRUE);
        foreach($data as $key => $value)
        {
            $this->iid = $key;
            $this->qty = $value;
            //insert here
            var_dump($this);
        }

    }
}