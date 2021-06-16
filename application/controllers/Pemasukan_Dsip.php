<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan_Dsip extends CI_Controller
{
    public $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Pemasukan_Dsip' => 'pemasukan']);
        $this->load->library('excel');
    }

    public function index()
    {
        $data = [
            'title' => 'PT. DSIP - IT Inventory Report',
        ];

        backView('Pemasukan_Dsip/index', $data);
    }

    public function ajax_list()
    {
        $list = $this->pemasukan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->JENISDOK;
            $row[] = $value->NOMORDOK;
            $row[] = $value->TGLDOK;
            $row[] = $value->NOMSA;
            $row[] = date('Y-m-d', strtotime($value->TGLMSA));
            $row[] = $value->PEMASOK;
            $row[] = $value->KODEBARANG;
            $row[] = $value->NAMABARANG;
            $row[] = $value->QTY;
            $row[] = $value->UNIT;
            $row[] = $value->NILAIBARANG;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pemasukan->count_all(),
            "recordsFiltered" => $this->pemasukan->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function import_excel()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $jenisdok = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nomordok = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $tgldok = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $nomsa = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tglmsa = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $pemasok = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $kodebarang = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $namabarang = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $qty = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $unit = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $nilaibarang = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $temp_data[] = array(
                        'JENISDOK' => $jenisdok,
                        'NOMORDOK' => $nomordok,
                        'TGLDOK' => $tgldok,
                        'NOMSA' => $nomsa,
                        'TGLMSA' => $tglmsa,
                        'PEMASOK' => $pemasok,
                        'KODEBARANG' => $kodebarang,
                        'NAMABARANG' => $namabarang,
                        'QTY' => $qty,
                        'UNIT' => $unit,
                        'NILAIBARANG' => $nilaibarang
                    );
                }
            }
            $insert = $this->pemasukan->insert($temp_data);
            $hitung = $this->db->affected_rows();
            if ($insert) {
                $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span>Successfully Imported to Database ' . $hitung . " Data Entry");
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> An error occurred ');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            echo "No file entry ";
        }
    }
}
