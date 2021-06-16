<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_Sip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Pengeluaran_Sip' => 'pengeluaran']);
        $this->load->library('excel');
    }

    public function index()
    {
        adminAccess();
        $data = [
            'title' => 'PT. SIP - IT Inventory Report',
        ];

        backView('Pengeluaran_Sip/index', $data);
    }

    public function ajax_list()
    {
        adminAccess();
        $list = $this->pengeluaran->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value->JENISDOK;
            $row[] = $value->DOKNOPABEAN;
            $row[] = $value->TGLPABEAN;
            $row[] = $value->NOINVOICE;
            $row[] = date('Y-m-d', strtotime($value->TGLINVOICE));
            $row[] = $value->NAMAPEMBELI;
            $row[] = $value->KODEBARANG;
            $row[] = $value->NAMABARANG;
            $row[] = $value->UNIT;
            $row[] = $value->QTY;
            $row[] = $value->MATAUANG;
            $row[] = $value->NILAIBARANG;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pengeluaran->count_all(),
            "recordsFiltered" => $this->pengeluaran->count_filtered(),
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
                    $doknopabean = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $tglpabean = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $noinvoice = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tglinvoice = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $namapembeli = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $kodebarang = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $namabarang = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $unit = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $qty = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $matauang = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $nilaibarang = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $temp_data[] = array(
                        'JENISDOK' => $jenisdok,
                        'DOKNOPABEAN' => $doknopabean,
                        'TGLPABEAN' => $tglpabean,
                        'NOINVOICE' => $noinvoice,
                        'TGLINVOICE' => $tglinvoice,
                        'NAMAPEMBELI' => $namapembeli,
                        'KODEBARANG' => $kodebarang,
                        'NAMABARANG' => $namabarang,
                        'UNIT' => $unit,
                        'QTY' => $qty,
                        'MATAUANG' => $matauang,
                        'NILAIBARANG' => $nilaibarang
                    );
                }
            }
            $insert = $this->pengeluaran->insert($temp_data);
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

/* End of file Weighbridge_priode.php */
