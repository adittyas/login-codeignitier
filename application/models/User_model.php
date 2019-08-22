<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function updateProfile($data)
    {

        $email = $this->input->post('email', true);
        $username = htmlspecialchars($this->input->post('username', true));
        if ($data) {
            $this->db->set('image', $data['file_name']);
        }
        $this->db->set('username', $username)
            ->where('email', $email)
            ->update('users');
    }
    public function dataAcount()
    {
        return $this->db->get_where('users', ['email' => $this->session->userdata['acount']])->row_array();
    }
}