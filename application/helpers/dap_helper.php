<?php
function backView($url, $data)
{
    $ci = get_instance();
    $ci->load->view('templates/header', $data);
    $ci->load->view('templates/topbar');
    $ci->load->view('templates/sidebar');
    $ci->load->view($url);
    $ci->load->view('templates/footer');
}

function checkLogin()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('id_user'))) {
        redirect('auth');
    }
}

function adminAccess()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('user_status') == 0) || (empty($ci->session->userdata('user_status') == 1)) || (empty($ci->session->userdata('user_status') == 2))) {
    } else {
        redirect('auth');
    }
}

function superAccess()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('username') == "superuser")) {
        redirect('auth');
    }
}
function maintenance()
{
    $ci = get_instance();
    if (empty($ci->session->userdata('id_user'))) {
        redirect('http://dapdataserver1:8080/bakrieoleo1/dap');
    }
}
