<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Menu_model");

        check_login();
    }
    public function index()
    {

        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();

        $data['managementMenu'] = $this->Query_model->allData('user_menu');
        $data['title'] = "Menu Management";

        $this->form_validation->set_rules('menu', 'Menu', 'required|alpha_numeric_spaces|is_unique[user_menu.menu]', [
            'is_unique' => 'Menu name is already in use'
        ]);

        if ($this->form_validation->run() == FALSE) {
            template("menu/index", $data);
        } else {
            $this->Menu_model->addMenu();
            $this->session->set_flashdata('flash', flashMessage("Menu has been added", 'success'));
            redirect('menu');
        }
    }
    public function submenu()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();

        $data['subMenu'] = $this->Menu_model->userAndSub();
        $data['userMenu'] = $this->Query_model->allData('user_menu');

        $data['title'] = "Submenu Management";

        $this->form_validation->set_rules('title', 'Menu', 'required|alpha_numeric_spaces|is_unique[user_sub_menu.title]', [
            'is_unique' => 'Submenu name is already in use'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('field_url', 'Menu', 'required');
        $this->form_validation->set_rules('is_active', 'Menu', 'required|numeric');
        $this->form_validation->set_rules('icon', 'Menu', 'required');

        if ($this->form_validation->run() == FALSE) {
            template("menu/submenu", $data);
        } else {
            $this->Menu_model->addSubMenu();
            $this->session->set_flashdata('flash', flashMessage("Submenu has been added", 'success'));
            redirect('menu/submenu');
        }
    }
    public function delete($id = -1, $table = 'menu')
    {
        if ($table == 'menu') {
            $go = 'menu/index';
        } else if ($table == 'submenu') {
            $go = 'menu/submenu';
        }
        $data['managementMenu'] = $this->Query_model->allData('user_menu');
        $arr = [];
        foreach ($data['managementMenu'] as $val) {
            $arr[] = $val['id'];
        }
        if ($id != -1) {
            if (in_array($id, $arr)) {
                $this->Menu_model->deleteMenu($id, $table);
                redirect($go);
            } else {
                redirect($go);
            }
        } else {
            redirect($go);
        }
    }
    public function getAjax_menu()
    {
        echo json_encode($this->Query_model->dataById('user_menu'));
    }
    public function getAjax_submenu()
    {
        echo json_encode($this->Query_model->dataById('user_sub_menu'));
    }
    public function updateMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == FALSE) {
            redirect('menu');
        } else {
            $this->Menu_model->updateMenu();
            $this->session->set_flashdata('flash', flashMessage("Menu has been update", 'success'));
            redirect('menu');
        }
    }
    public function updateSub()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('menu_id', 'Menu ID', 'required');
        $this->form_validation->set_rules('field_url', 'URL', 'required');
        $this->form_validation->set_rules('is_active', 'Status', 'required|numeric');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect("menu/submenu");
        } else {

            $this->Menu_model->updateSub();
            $this->session->set_flashdata('flash', flashMessage("Submenu has been update", 'success'));
            redirect('menu/submenu');
        }
    }
}