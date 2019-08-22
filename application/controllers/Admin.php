<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Admin_model");
        check_login();
    }
    public function index()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();

        $data['title'] = "Dashboard";

        template("admin/index", $data);
    }
    public function role()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();
        $data['title'] = "Role";
        $data['role'] = $this->Admin_model->getRole();


        $this->form_validation->set_rules('role', 'Role title', 'required|alpha_numeric_spaces|is_unique[users_role.role]', [
            'is_unique' => 'Role title is already in use'
        ]);

        if ($this->form_validation->run() == FALSE) {
            template("admin/role", $data);
        } else {
            $this->Admin_model->addRole();
            $this->session->set_flashdata('flash', flashMessage("Role successfully added", 'success'));
            redirect('admin/role');
        }
    }
    public function roleAccess($id = -1)
    {
        $data['title'] = "Role Access";

        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();
        $data['userMenu'] =
            $this->db->where('id !=', 1)
            ->get("user_menu")->result_array();

        $data['menu_role'] = $this->Admin_model->getRole();
        $arr = [];
        foreach ($data['menu_role'] as $val) {
            $arr[] = $val['id'];
        }
        if ($id != -1) {
            if (in_array($id, $arr)) {
                $data['role'] = $this->db->get_where('users_role', ['id' => $id])->row_array();
                template('admin/role_access', $data);
            } else {
                redirect('admin/role');
            }
        } else {
            redirect('admin/role');
        }
    }
    public function delete($id = -1, $table = 'admin')
    {
        $data['menu_role'] = $this->Admin_model->getRole();
        $arr = [];
        foreach ($data['menu_role'] as $val) {
            $arr[] = $val['id'];
        }
        if ($id != -1) {
            if (in_array($id, $arr)) {
                $this->Admin_model->deleteRole($id, $table);
                if ($table == 'admin') {
                    redirect($table);
                } else {
                    redirect("admin/" . $table);
                }
            } else {
                redirect('admin/role');
            }
        } else {
            redirect('admin/role');
        }
    }
    public function getAjax_role()
    {
        echo json_encode($this->Query_model->dataById('users_role'));
    }
    public function updateRole()
    {
        $this->form_validation->set_rules('role', 'Role name', 'required|alpha_numeric_spaces');
        if ($this->form_validation->run() == FALSE) {
            redirect('admin/role');
        } else {
            $this->Admin_model->updateRole();
            $this->session->set_flashdata('flash', flashMessage("Role has been update", 'success'));
            redirect('admin/role');
        }
    }

    public function changeAccess()
    {
        $role_id = $this->input->post('role_id', true);
        $menu_id = $this->input->post('menu_id', true);
        $where = [
            "role_id" => $role_id,
            "menu_id" => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $where);
        if ($result->num_rows() > 0) {
            $this->db->delete('user_access_menu', $where);
        } else {
            $this->db->insert('user_access_menu', [
                "id" => 'default',
                "role_id" => $role_id,
                "menu_id" => $menu_id
            ]);
        }
    }
}