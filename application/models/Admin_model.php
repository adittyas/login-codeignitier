<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getRole()
    {
        return $this->db->get('users_role')->result_array();
    }
    public function addRole()
    {
        $val = htmlspecialchars($this->input->post('role', true));
        $this->db->insert('users_role', ['role' => $val]);
    }
    public function deleteRole($id, $table)
    {
        switch ($table) {
            case 'role':
                $table = 'users_role';
                break;
            default:
                echo 'Error';
                break;
        }
        $this->db->delete($table, array('id' => $id));
    }
    public function updateRole()
    {
        $val = htmlspecialchars($this->input->post('role', true));
        $this->db->where('id', $this->input->post('id', true));
        $this->db->update('users_role', ['role' => $val]);
    }
}