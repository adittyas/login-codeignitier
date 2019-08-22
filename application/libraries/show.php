<?php

class show
{
    public function print($view, $data)
    {
        $this->load->view("templates/top_html");
        $this->load->view(".$view.");
        $this->load->view("templates/bottom_html");
    }
}