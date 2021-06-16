<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // checkLogin();
        $this->load->model(['M_Home' => 'home']);
    }

    public function index()
    {
        // $data = $this->home->statistic();
        // $data['timbangan'] = $this->weighbridge->statistic();
        // $data['timbangan_dsip'] = $this->weighbridge_dsip->statistic();
        $data['title'] = 'Dashboard';
        backView('home/index', $data);
    }
}
