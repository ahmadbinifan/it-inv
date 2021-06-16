<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Home extends CI_Model
{
    private $departement = 'tb_departement';
    private $division = 'tb_division';
    private $section = 'tb_section';
    private $position = 'tb_position';
    private $user = 'tb_user';
    public function statistic()
    {
        $data = [
            'departement' => $this->countDepartement(),
            'division' => $this->countDivision(),
            'section' => $this->countSection(),
            'position' => $this->countPosition(),
            'user' => $this->countUser()
        ];
        return $data;
    }

    public function countDepartement()
    {
        $this->db->select('*');
        $data = $this->db->get($this->departement)->num_rows();
        return $data;
    }

  

    public function countSection()
    {
        $this->db->select('*');
        $data = $this->db->get($this->section)->num_rows();
        return $data;
    }
    public function countPosition()
    {
        $this->db->select('*');
        $data = $this->db->get($this->position)->num_rows();
        return $data;
    }
    public function countUser()
    {
        $this->db->select('*');
        $data = $this->db->get($this->user)->num_rows();
        return $data;
    }
}
