<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                   FROM `user_sub_menu` JOIN `user_menu`
                   ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getJoin($t, $tj, $on)
    {
        $this->db->join($tj, $on, 'left');
        return $this->db->get($t);
    }
    public function getJoinW($t, $tj, $on, $w)
    {
        $this->db->join($tj, $on, 'left');
        $this->db->where($w);
        return $this->db->get($t);
    }
    public function getW($t, $w)
    {
        $this->db->where($w);
        return $this->db->get($t);
    }
    public function getWO($t, $w, $o)
    {
        $this->db->where($w);
        $this->db->order_by($o, 'desc');
        return $this->db->get($t);
    }
}
