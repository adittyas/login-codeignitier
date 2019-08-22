<?php
function template($direct = 'index', $data = [])
{
    $CI = get_instance();
    $CI->load->view("templates/top_html", $data);
    $CI->load->view("templates/sidebar", $data);
    $CI->load->view("templates/top_bar", $data);
    $CI->load->view($direct, $data);
    $CI->load->view("templates/footer", $data);
    $CI->load->view("templates/bottom_html", $data);
}
function auth_template($direct = 'index', $data = [])
{
    $CI = get_instance();
    $CI->load->view("templates/top_html", $data);
    $CI->load->view($direct, $data);
    $CI->load->view("templates/bottom_html", $data);
}