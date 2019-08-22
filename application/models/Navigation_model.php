<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Navigation_model extends CI_Model
{
    public function menu()
    {
        $x = $this->db->select(['user_menu.id', 'menu'])
            ->from('user_menu')
            ->join('user_access_menu', 'user_menu.id = user_access_menu.menu_id')
            ->where('user_access_menu.role_id', $this->session->userdata('role_id'))
            ->order_by('user_access_menu.menu_id', 'ASC')
            ->get()->result_array();
        $qty = count($x);
        for ($i = 0; $i < $qty; $i++) {
            $x[$i] += ["submenu" => $this->subMenu($x[$i]['id'])];
        }
        return $x;
    }

    public function subMenu($id)
    {
        $this->db->select('*')
            ->from('user_sub_menu')
            ->where('menu_id', $id)
            ->where('is_active', 1);
        return $this->db->get()->result_array();
    }
}