<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT a.*, b.menu
                  FROM `USER_SUB_MENU` a JOIN USER_MENU b
                  ON a.menu_id = b.id
                ";
        return $this->db->query($query)->result_array();
    }
}
