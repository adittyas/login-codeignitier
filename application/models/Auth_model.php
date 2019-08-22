<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $table = "users";

    public function login()
    {
        $user = $this->db->get_where($this->table, ['email' => $this->input->post('email', true)])->row_array();

        if ($user['email']) {
            if ($user['is_active'] == 1) {
                if (password_verify($_POST['pass'], $user['password'])) {
                    return [
                        'confirm' => 'success',
                        'acount' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                } else {
                    return [
                        'confirm' => 'failed',
                        'error' => 'Incorrect password!'
                    ];
                }
            } else {
                return [
                    'confirm' => 'failed',
                    'error' => 'Email has not been activated!'
                ];
            }
        } else {
            return [
                'confirm' => 'failed',
                'error' => 'Email not registered!'
            ];
        }
    }

    public function new()
    {
        $email = $this->input->post('email', true);
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('pass', true), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 0,
            'date_created' => time()
        ];

        $token = base64_encode(random_bytes(32));
        $token_config = [
            'email' => $email,
            'token' => $token,
            'date' => time()
        ];
        $this->_sendEmail($token, 'verify');

        $this->db->insert($this->table, $data);
        $this->db->insert('token', $token_config);
    }
    public function forgot()
    {
        $email = $this->input->post('email', true);
        $token = base64_encode(random_bytes(32));
        $token_config = [
            'email' => $email,
            'token' => $token,
            'date' => time()
        ];
        $this->db->insert('token', $token_config);
        $this->_sendEmail($token, 'forgot');
    }
    private function _sendEmail($token, $type)
    {
        $email = $this->input->post('email', true);
        $username = htmlspecialchars($this->input->post('username', true));
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'haccess.ads@gmail.com',
            'smtp_pass' => 'antiplaque',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'chartype' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('haccess.ads@gmail.com', 'aditya programming');
        $this->email->to($email);
        if ($type == 'verify') {
            $this->email->subject('Acount Verification');
            $this->email->message('
                <div>
                <h4>hello ' . $username . '</h4>
                <p>Click the link to actived your acount</p>
                <a style="display:block; text-decoration: none; padding: 4px; background-color: #64c4ed;  font-family: Arial, Helvetica, sans-serif; color: #ffffff; text-align: center;" href="' . base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . '"><h3>Actived!!</h3></a></div>
            ');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('
            <div>
            <p>Click the link to reset your password</p>
            <a style="display:block; text-decoration: none; padding: 4px; background-color: #64c4ed;  font-family: Arial, Helvetica, sans-serif; color: #ffffff; text-align: center;" href="' . base_url() . 'auth/reset_password?email=' . $email . '&token=' . urlencode($token) . '"><h3>Reset Password!!</h3></a></div>
        ');
        }


        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            $token_user = $this->db->get_where('token', ['token' => $token])->row_array();
            if ($token) {
                if (time() - $token_user['date'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1)
                        ->where('email', $email)
                        ->update('users');
                    $this->db->delete('token', ['email' => $email]);
                    // kasih pesan
                    redirect('auth');
                } else {
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('token', ['token' => $email]);
                    $this->session->set_flashdata('flash', 'gagal');
                }
            } else {


                $this->session->set_flashdata('flash', 'gagal');
                return false;
            }
        } else {
            $this->session->set_flashdata('flash', 'gagal');
            return false;
        }
    }

    public function reset_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        if ($user) {
            $token_user = $this->db->get_where('token', ['token' => $token])->row_array();
            if ($token) {
                if (time() - $token_user['date'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    redirect('auth/changePassword');
                } else {
                    $this->db->delete('users', ['email' => $email]);
                    $this->db->delete('token', ['token' => $email]);

                    $this->session->set_flashdata('flash', flashMessage("Activation expired", 'error'));
                    redirect('auth/forgot');
                }
            } else {
                $this->session->set_flashdata('flash', flashMessage("Token failed", 'error'));
                redirect('auth/forgot');
            }
        } else {
            $this->session->set_flashdata('flash', flashMessage("Reset password failed", 'error'));
            redirect('auth/forgot');
        }
    }

    public function getSingleData($table, $clause)
    {
        return $this->db->get_where($table, $clause)->result_array();
    }
    public function updPass()
    { }
}