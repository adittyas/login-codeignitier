<?php

function check_login()
{
    $CI = get_instance();
    if (!$CI->session->userdata('acount') && !$CI->session->userdata('role_id') && !$CI->session->userdata('confirm') !== 'success') {
        redirect('auth');
    } else {
        $role_id = $CI->session->userdata['role_id'];
        $menu = $CI->uri->segment(1);
        $query_menu = $CI->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $id_menu = $query_menu['id'];
        $usserAccess = $CI->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $id_menu
        ]);
        if ($usserAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function checkedAccess($role_id, $menu_id)
{
    $CI = get_instance();
    // $accessMenu = $CI->db->get('user-access-menu')->result_array();
    $result =
        $CI->db->get_where('user_access_menu', [
            "role_id" => $role_id,
            "menu_id" => $menu_id
        ]);

    if ($result->num_rows() > 0) {
        return 'checked="checked"';
    }
}