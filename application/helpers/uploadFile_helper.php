<?php
function do_upload()
{
    $CI = get_instance();
    $config['upload_path']          = './assets/images/profile';
    $config['file_name']            = uniqid();
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 2048;


    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload('pic')) {
        $error = array('error' => $CI->upload->display_errors());
        return $error;
    } else {
        $data = $CI->upload->data();
        return $data;
    }
}