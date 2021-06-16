<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('M_User', 'user');
    }

    public function index()
    {
        $data['title'] = 'Account';
        $data['user'] = $this->session->userdata();
        backView('account/index', $data);
    }

    public function get()
    {
        $id = $this->input->post('id');
        $data = $this->user->get($id);
        echo json_encode($data);
    }

    public function changePass()
    {
        $data['user'] = $this->session->userdata('id_user');
        $current_password = $this->input->post('current_password');
        $newPassword1 = $this->input->post('newPassword1');

        if ($current_password == $newPassword1) {
            echo "Password masih sama cok, coba ganti yang lain";
        } else {
            $hash = md5($this->$data['password']);
        }
        $this->db->set('password', $hash);
        $this->db->where('id_user', $this->session->userdata('id_user'));
        $this->db->update('user');

        echo json_encode($data);
    }

    public function cekAkun()
    {
        $id = $this->session->userdata('id_user');
        $password = md5($this->input->post('current_password'));
        $data = [
            'id_user' => $id,
            'password' => $password
        ];

        $res = $this->user->get($id, $data);
        echo json_encode($res);
    }

    public function changePw()
    {
        $id = $this->session->userdata('id_user');
        $password = $this->input->post('password');
        // $nik = $this->input->post('nik');
        $data = [
            'password' => md5($password),
        ];
        $this->user->update($id, $data);
    }

    public function updateNik()
    {
        $id = $this->session->userdata('id_user');
        $section = $this->input->post('section');
        $data = [
            'id_user' => $id,
            'section' => $section
        ];
        $res = $this->user->update($id, $data);
        echo json_encode($res);
    }
}
