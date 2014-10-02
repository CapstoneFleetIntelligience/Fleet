<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:58 PM
 */
class item_model extends CI_Model
{
    public $bname;
    public $iname;
    public $description;
    public $default;

    public function __construct()
    {
        parent::__construct();
    }

    public function createItem($data)
    {

        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }

    }

}