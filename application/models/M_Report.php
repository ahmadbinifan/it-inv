<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Report extends CI_Model
{
    private $pemasukan_dsip = 'tb_pemasukan_dsip';
    private $pengeluaran_dsip = 'tb_pengeluaran_dsip';
    private $pemasukan_sip = 'tb_pemasukan_sip';
    private $pengeluaran_sip = 'tb_pengeluaran_sip';


    //PT.DSIP Filter,excel,pdf
    public function filter_pemasukan_dsip($start, $end)
    {
        $this->db->select('*')->from($this->pemasukan_dsip);
        $this->db->where('TGLMSA >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLMSA <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result_array();
        return $result;
    }
    public function filter_pengeluaran_dsip($start, $end)
    {
        $this->db->select('*')->from($this->pengeluaran_dsip);
        $this->db->where('TGLINVOICE >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLINVOICE <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result_array();
        return $result;
    }
    public function excel_pemasukan_dsip($start, $end)
    {
        $this->db->select('*')->from($this->pemasukan_dsip);
        $this->db->where('TGLMSA >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLMSA <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result();
        return $result;
    }
    public function excel_pengeluaran_dsip($start, $end)
    {
        $this->db->select('*')->from($this->pengeluaran_dsip);
        $this->db->where('TGLINVOICE >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLINVOICE <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result();
        return $result;
    }

    public function print_pemasukan_dsip($fileName, $data)
    {
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_pemasukan_dsip', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_pengeluaran_dsip($fileName, $data)
    {
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_pengeluaran_dsip', $data, TRUE);
        $this->pdf->generate($html);
    }

    //PT.DSIP Filter,excel,pdf
    public function filter_pemasukan_sip($start, $end)
    {
        $this->db->select('*')->from($this->pemasukan_sip);
        $this->db->where('TGLMSA >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLMSA <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result_array();
        return $result;
    }
    public function filter_pengeluaran_sip($start, $end)
    {
        $this->db->select('*')->from($this->pengeluaran_sip);
        $this->db->where('TGLINVOICE >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLINVOICE <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result_array();
        return $result;
    }
    public function excel_pemasukan_sip($start, $end)
    {
        $this->db->select('*')->from($this->pemasukan_sip);
        $this->db->where('TGLMSA >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLMSA <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result();
        return $result;
    }
    public function excel_pengeluaran_sip($start, $end)
    {
        $this->db->select('*')->from($this->pengeluaran_sip);
        $this->db->where('TGLINVOICE >=', date('Y-m-d', strtotime($start)));
        $this->db->where('TGLINVOICE <=', date('Y-m-d', strtotime($end)));

        $result = $this->db->get()->result();
        return $result;
    }
    public function print_pemasukan_sip($fileName, $data)
    {
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_pemasukan_sip', $data, TRUE);
        $this->pdf->generate($html);
    }
    public function print_pengeluaran_sip($fileName, $data)
    {
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName . ".pdf";
        $ci = get_instance();
        $html = $ci->load->view('report/print_pengeluaran_sip', $data, TRUE);
        $this->pdf->generate($html);
    }
}

/* End of file M_Report.php */
