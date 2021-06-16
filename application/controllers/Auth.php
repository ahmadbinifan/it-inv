<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User', 'user');
    }
    public function index()
    {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }
        $data['title'] = "Login - IT Inventory Report";
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/index');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    public function _login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->user->account($username, $password);
        if ($user) {
            $data = [
                'id_user' => $user['id_user'],
                'fullname' => $user['fullname'],
                'username' => $user['username'],
                'password' => $user['password'],
                'user_status' => $user['user_status'],
                'pdf' => $user['pdf'],
                'excel' => $user['excel'],
                'import' => $user['import'],
            ];

            $this->session->set_userdata($data);
            redirect('home');
        } else {
            $message = "Wrong Password/Username";
            echo "<script type='text/javascript'>alert('$message');";
            echo "window.location.href = window.location.href;</script>";
        }
    }
    public function logout()
    {
        $data = [
            'id_user', 'fullname', 'username', 'password', 'user_status', 'pdf', 'excel', 'periode',
        ];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        redirect('auth');
    }
}
