<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/27/14
 * Time: 7:58 PM
 */
class item extends CI_Model
{
    public $bname;
    public $iname;
    public $description;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Creates the item object
     * @param $data object the item data
     */
    public function createItem($data)
    {

        foreach($data as $key => $value)
        {
            $this->$key = $value;
        }
    }

    /**
     * Gets the items associated with the business
     * @param $business string the business name
     * @return array|null array of items associated with business or null.
     */
    public function getItems($business)
    {
        $query = $this->db->get_where('capsql.chkitem', array('bname' => $business));
        $items = array();
        if($query->result())
        {
            foreach($query->result() as $index => $data)
            {
                $item = new item();
                foreach ($data as $key => $value)
                {
                    $item->$key = $value;
                }
                $items[$index] = $item;
            }
            return $items;
        }
        else return null;
    }

}