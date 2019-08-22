<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Auth_model");
		$this->load->library('show');
	}

	public function index()
	{
		if ($this->session->userdata('acount') || $this->session->userdata('role_id')) {
			redirect('user');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|exact_length[6]', [
			'exact_length' => 'Password must 6 characther!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Login Page";
			auth_template("auth/login", $data);
		} else {
			$data = $this->Auth_model->login();

			if ($data['confirm'] == 'success') {
				$this->session->set_userdata($data);
				if ($data['role_id'] == 1) {
					redirect('admin');
				}
				if ($data['role_id'] == 2) {
					redirect('user');
				}
			} else if ($data['confirm'] == 'failed') {
				$this->session->set_flashdata('flash', flashMessage($data['error'], 'error'));
				redirect('auth/');
			}
		}
	}
	public function registration()
	{
		if ($this->session->userdata('acount') || $this->session->userdata('role_id')) {
			redirect('user');
		}
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'is_unique' => 'Username already used!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[users.email]', [
			'is_unique' => 'Email already used!'
		]);
		$this->form_validation->set_rules('pass', 'Password', 'required|exact_length[6]', [
			'exact_length' => 'Password must 6 characther!'
		]);
		$this->form_validation->set_rules('pass-conf', 'Password Confirmation', 'required|exact_length[6]|matches[pass]', [
			'matches' => 'Password dont match!',
			'exact_length' => 'Password must 6 characther!'
		]);
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = "Registration Page";
			auth_template("auth/registration", $data);
		} else {
			$this->Auth_model->new();
			$this->session->set_flashdata('flash', flashMessage("successful registration, immediately activate your email", 'success'));
			redirect('auth');
		}
	}
	public function forgot()
	{
		$data['title'] = "Forgot Password";
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');


		if ($this->form_validation->run() == FALSE) {
			auth_template("auth/forgot", $data);
		} else {
			$email = $this->input->post('email', true);
			$acount = $this->Auth_model->getSingleData('users', [
				'email' => $email,
				'is_active' => 1
			]);
			if ($acount) {
				$this->Auth_model->forgot();
				$this->session->set_flashdata(
					'flash',
					flashMessage("checkout your email", 'info')
				);
				redirect('auth/');
			} else {
				$this->session->set_flashdata(
					'flash',
					flashMessage("Email has not been registered or activated", 'error')
				);
				redirect('auth/forgot');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
	public function blocked()
	{
		$data['title'] = "Access Blocked";
		auth_template("auth/blocked", $data);
	}
	public function verify()
	{
		$this->Auth_model->verify();
	}
	public function reset_password()
	{
		$this->Auth_model->reset_password();
	}
	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$data['title'] = "Reset Password";
		$password = $this->input->post('password', true);
		$password2 = $this->input->post('password2', true);
		$this->form_validation->set_rules('password', 'Password', 'required|exact_length[6]|matches[password2]', [
			'exact_length' => 'Password must 6 characther!',
			'matches' => 'Password doesnt match'
		]);
		$this->form_validation->set_rules('password2', 'Confirm Password', 'required|exact_length[6]|matches[password]', [
			'exact_length' => 'Password must 6 characther!',
			'matches' => 'Password doesnt match'
		]);
		if ($this->form_validation->run() == FALSE) {
			auth_template("auth/reset_password", $data);
		} else {
			$pass_hash = password_hash($password, PASSWORD_DEFAULT);
			$email = $this->session->userdata(reset_email);
			$this->db->set('password', $pass_hash)
				->where('email', $email)
				->update(users);
			$this->session->set_flashdata('flash', flashMessage("Password has been reset", 'success'));
			$this->session->sess_destroy();
			redirect("auth/");
		}
	}
}