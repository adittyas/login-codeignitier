<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function addMenu()
    {
        $val = htmlspecialchars($this->input->post('menu', true));
        $this->db->insert('user_menu', ['menu' => $val]);
    }
    public function addSubMenu()
    {
        $menu_id = htmlspecialchars($this->input->post('menu_id', true));
        $url = htmlspecialchars($this->input->post('field_url', true));
        $menu = $this->getDataTable('user_menu');
        foreach ($menu as $val) {
            if ($val['id'] == $menu_id) {
                $field_url = $val['menu'] . '/' . $url;
            }
        }
        $data = array(
            'id' => 'default',
            'menu_id' => $menu_id,
            'title' => htmlspecialchars($this->input->post('title', true)),
            'field_url' => $field_url,
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        );
        $this->db->insert('user_sub_menu', $data);
    }
    public function deleteMenu($id, $table)
    {
        switch ($table) {
            case 'menu':
                $table = 'user_menu';
                break;
            case 'access':
                $table = 'user_access_menu';
                break;
            case 'submenu':
                $table = 'user_sub_menu';
                break;
            default:
                echo 'Error';
                break;
        }
        $this->db->delete($table, array('id' => $id));
    }
    public function userAndSub()
    {
        $this->db->select(['user_sub_menu.*', 'user_menu.menu'])
            ->from('user_sub_menu')
            ->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
        return $this->db->get()->result_array();
    }
    public function updateMenu()
    {
        $val = htmlspecialchars($this->input->post('menu', true));
        $this->db->where('id', $this->input->post('id', true));
        $this->db->update('user_menu', ['menu' => $val]);
    }

    public function updateSub()
    {
        $menu_id = htmlspecialchars($this->input->post('menu_id', true));
        $url = htmlspecialchars($this->input->post('field_url', true));
        $menu = $this->getDataTable('user_menu');
        $url = explode("/", $url);
        $url = end($url);

        foreach ($menu as $val) {
            if ($val['id'] == $menu_id) {
                $field_url = $val['menu'] . '/' . $url;
            }
        }

        $data = array(
            'menu_id' => $menu_id,
            'title' => htmlspecialchars($this->input->post('title', true)),
            'field_url' => $field_url,
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        );
        $this->db->where('id', $this->input->post('id', true));
        $this->db->update('user_sub_menu', $data);
    }
}