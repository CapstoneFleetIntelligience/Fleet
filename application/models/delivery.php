<?php
/**
 * Created by PhpStorm.
 * User: Bcolemutech
 * Date: 10/1/14
 * Time: 11:11 PM
 */

class delivery extends CI_Model
{
    public $cid;
    public $schd;
    public $note;

    public function __construct()
    {
        parent::__construct();
    }

    public function setDelv($data)
    {

        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }

    }
}