<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");

        check_login();
    }
    public function index()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();
        $data['title'] = "My Profile";
        template("user/index", $data);
    }
    public function edit()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();
        $data['title'] = "Edit profile";

        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric_spaces');

        if ($this->form_validation->run() == FALSE) {
            template("user/edit_profile", $data);
        } else {
            $files = $_FILES['pic']['name'];
            if ($files) {
                $checkFile = do_upload();
                if (!empty($checkFile['file_name'])) {
                    $this->User_model->updateProfile($checkFile);
                    $old_image = $data['acount']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/images/profile/' . $old_image);
                    }
                    $this->session->set_flashdata('flash', flashMessage("Profile has been update", 'success'));
                    redirect('user');
                } else {
                    $err = str_replace('<p>', '', $checkFile['error']);
                    $err = str_replace('</p>', '', $err);
                    $this->session->set_flashdata('flash', flashMessage($err, 'success'));
                    redirect('user/edit');
                }
            } else {
                $this->User_model->updateProfile(null);
                $this->session->set_flashdata('flash', flashMessage("Profile has been update", 'success'));
                redirect('user');
            }
        }
    }
    public function pass()
    {
        $data['acount'] = $this->User_model->dataAcount();
        $data['menu'] = $this->Navigation_model->menu();
        $data['title'] = "Change password";

        $this->form_validation->set_rules('currentPass', 'Current Password', 'required|exact_length[6]', [
            'exact_length' => 'Password must 6 characther!'
        ]);
        $this->form_validation->set_rules('newPass1', 'New Password', 'required|exact_length[6]|matches[newPass2]', [
            'exact_length' => 'Password must 6 characther!',
            'matches' => "Password doesn't match"
        ]);
        $this->form_validation->set_rules('newPass2', 'Confirm New Password', 'required|exact_length[6]|matches[newPass1]', [
            'exact_length' => 'Password must 6 characther!',
            'matches' => "Password doesn't match"
        ]);
        if ($this->form_validation->run() == FALSE) {
            template("user/pass_profile", $data);
        } else {
            $currentPass = $this->input->post('currentPass');
            $newPass = $this->input->post('newPass1');

            if (!password_verify($currentPass, $data['acount']['password'])) {
                $this->session->set_flashdata('flash', flashMessage("Password dont match", 'error'));

                template("user/pass_profile", $data);
            } else if ($currentPass === $newPass) {
                $this->session->set_flashdata('flash', flashMessage("Password cannot be the same", 'error'));

                redirect("user/pass");
            } else {
                $pass_hash  = password_hash($newPass, PASSWORD_DEFAULT);
                $this->db->set('password', $pass_hash)
                    ->where('email', $data['acount']['email'])
                    ->update(users);
                $this->session->set_flashdata('flash', flashMessage("Password has been change", 'success'));
                redirect("user/pass");
            }
        }
    }
}