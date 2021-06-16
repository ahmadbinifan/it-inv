<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
// End load library phpspreadsheet
class report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Pemasukan_Dsip' => 'pemasukan', 'M_Pengeluaran_Dsip' => 'pengeluaran', 'M_Report' => 'report']);
    }

    public function index()
    {
        $data = [
            'title' => 'PT. DSIP IT Inventory',
        ];
        backView('report/index', $data);
    }

    //PT.DSIP Export PDF
    public function pdf_pemasukan_dsip($start = null, $end = null)
    {
        $this->load->library('Pdf');
        $data['title'] = "LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA";
        $data['date'] = "Priode " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filter_pemasukan_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = date('d-F-Y H:i:s');
        $this->report->print_pemasukan_dsip($filename, $data);
        echo json_encode($data);
        $this->load->view('report/print_pemasukan_dsip', $data);
    }
    public function pdf_pengeluaran_dsip($start = null, $end = null)
    {
        $this->load->library('Pdf');
        $data['title'] = "LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA";
        $data['date'] = "Priode " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filter_pengeluaran_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = date('d-F-Y H:i:s');
        $this->report->print_pengeluaran_dsip($filename, $data);
        echo json_encode($data);
        $this->load->view('report/print_pengeluaran_dsip', $data);
    }
    //PT.DSIP Export Excel
    public function excel_pemasukan_dsip($start = null, $end = null)
    {
        $data['title'] = "LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA";
        $data['date'] = "From Date : " . date('d-M-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->excel_pemasukan_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('IT Inventory');

        // terakhir tanggal 7 juni, lanjut disini sekarang..! 
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:L4')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:L4')
            ->getBorders()
            ->getTop()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA')
            ->mergeCells('A2:E2')
            ->setCellValue('A3', $data['date'])
            ->mergeCells('A3:E3')
            ->setCellValue('A4', 'NO')
            ->setCellValue('B4', 'JENIS DOK.')
            ->setCellValue('C4', 'NOMOR DOK.')
            ->setCellValue('D4', 'TGL DOK.')
            ->setCellValue('E4', 'NO. MSA')
            ->setCellValue('F4', 'TGL. MSA')
            ->setCellValue('G4', 'PEMASOK')
            ->setCellValue('H4', 'KODE BARANG')
            ->setCellValue('I4', 'NAMA BARANG')
            ->setCellValue('J4', 'QTY')
            ->setCellValue('K4', 'UNIT')
            ->setCellValue('L4', 'NILAI BARANG');


        // Miscellaneous glyphs, UTF-8

        $i = 5;
        $count = 0;

        foreach ($data['datafilter'] as $value) {
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->JENISDOK)
                ->setCellValue('C' . $i, $value->NOMORDOK)
                ->setCellValue('D' . $i, $value->TGLDOK)
                ->setCellValue('E' . $i, $value->NOMSA)
                ->setCellValue('F' . $i, date('d-M-Y', strtotime($value->TGLMSA)))
                ->setCellValue('G' . $i, $value->PEMASOK)
                ->setCellValue('H' . $i, $value->KODEBARANG)
                ->setCellValue('I' . $i, $value->NAMABARANG)
                ->setCellValue('J' . $i, $value->QTY)
                ->setCellValue('K' . $i, $value->UNIT)
                ->setCellValue('L' . $i, $value->NILAIBARANG);
            $i++;
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:L')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PT. DSIP ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Laporan Pemasukan Barang " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
    public function excel_pengeluaran_dsip($start = null, $end = null)
    {
        $data['title'] = "LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA";
        $data['date'] = "From Date : " . date('d-M-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->excel_pengeluaran_dsip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('IT Inventory');

        // terakhir tanggal 7 juni, lanjut disini sekarang..! 
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:M4')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:M4')
            ->getBorders()
            ->getTop()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA')
            ->mergeCells('A2:E2')
            ->setCellValue('A3', $data['date'])
            ->mergeCells('A3:E3')
            ->setCellValue('A4', 'NO')
            ->setCellValue('B4', 'JENIS DOK.')
            ->setCellValue('C4', 'DOK. NO.PABEAN')
            ->setCellValue('D4', 'TGL PABEAN.')
            ->setCellValue('E4', 'NO. INVOICE')
            ->setCellValue('F4', 'TGL. INVOICE')
            ->setCellValue('G4', 'NAMA PEMBELI')
            ->setCellValue('H4', 'KODE BARANG')
            ->setCellValue('I4', 'NAMA BARANG')
            ->setCellValue('J4', 'UNIT')
            ->setCellValue('K4', 'QTY')
            ->setCellValue('L4', 'MATA UANG')
            ->setCellValue('M4', 'NILAI BARANG');


        // Miscellaneous glyphs, UTF-8

        $i = 5;
        $count = 0;

        foreach ($data['datafilter'] as $value) {
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->JENISDOK)
                ->setCellValue('C' . $i, $value->DOKNOPABEAN)
                ->setCellValue('D' . $i, $value->TGLPABEAN)
                ->setCellValue('E' . $i, $value->NOINVOICE)
                ->setCellValue('F' . $i, date('d-M-Y', strtotime($value->TGLINVOICE)))
                ->setCellValue('G' . $i, $value->NAMAPEMBELI)
                ->setCellValue('H' . $i, $value->KODEBARANG)
                ->setCellValue('I' . $i, $value->NAMABARANG)
                ->setCellValue('J' . $i, $value->UNIT)
                ->setCellValue('K' . $i, $value->QTY)
                ->setCellValue('L' . $i, $value->MATAUANG)
                ->setCellValue('M' . $i, $value->NILAIBARANG);
            $i++;
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:M')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PT. DSIP ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Laporan Pengeluaran Barang " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }

    // PT.SIP Export PDF
    public function pdf_pemasukan_sip($start = null, $end = null)
    {
        $this->load->library('Pdf');
        $data['title'] = "LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. SARANA INDUSTAMA PERKASA";
        $data['date'] = "Priode " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filter_pemasukan_sip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = date('d-F-Y H:i:s');
        $this->report->print_pemasukan_sip($filename, $data);
        echo json_encode($data);
        $this->load->view('report/print_pemasukan_sip', $data);
    }

    public function pdf_pengeluaran_sip($start = null, $end = null)
    {
        $this->load->library('Pdf');
        $data['title'] = "LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. SARANA INDUSTAMA PERKASA";
        $data['date'] = "Priode " . date('d-M-Y', strtotime($start)) . ' to ' .  date('d-M-Y', strtotime($end));
        $data['header'] = $this->report->filter_pengeluaran_sip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));
        $filename = date('d-F-Y H:i:s');
        $this->report->print_pengeluaran_sip($filename, $data);
        echo json_encode($data);
        $this->load->view('report/print_pengeluaran_sip', $data);
    }
    public function excel_pemasukan_sip($start = null, $end = null)
    {
        $data['title'] = "LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. DOMAS SAWITINTI PERDANA";
        $data['date'] = "From Date : " . date('d-M-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->excel_pemasukan_sip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('IT Inventory');

        // terakhir tanggal 7 juni, lanjut disini sekarang..! 
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:L4')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:L4')
            ->getBorders()
            ->getTop()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'LAPORAN PEMASUKAN BARANG PER DOKUMEN BARANG')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'KAWASAN BERIKAT PT. SARANA INDUSTAMA PERKASA')
            ->mergeCells('A2:E2')
            ->setCellValue('A3', $data['date'])
            ->mergeCells('A3:E3')
            ->setCellValue('A4', 'NO')
            ->setCellValue('B4', 'JENIS DOK.')
            ->setCellValue('C4', 'NOMOR DOK.')
            ->setCellValue('D4', 'TGL DOK.')
            ->setCellValue('E4', 'NO. MSA')
            ->setCellValue('F4', 'TGL. MSA')
            ->setCellValue('G4', 'PEMASOK')
            ->setCellValue('H4', 'KODE BARANG')
            ->setCellValue('I4', 'NAMA BARANG')
            ->setCellValue('J4', 'QTY')
            ->setCellValue('K4', 'UNIT')
            ->setCellValue('L4', 'NILAI BARANG');


        // Miscellaneous glyphs, UTF-8

        $i = 5;
        $count = 0;

        foreach ($data['datafilter'] as $value) {
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->JENISDOK)
                ->setCellValue('C' . $i, $value->NOMORDOK)
                ->setCellValue('D' . $i, $value->TGLDOK)
                ->setCellValue('E' . $i, $value->NOMSA)
                ->setCellValue('F' . $i, date('d-M-Y', strtotime($value->TGLMSA)))
                ->setCellValue('G' . $i, $value->PEMASOK)
                ->setCellValue('H' . $i, $value->KODEBARANG)
                ->setCellValue('I' . $i, $value->NAMABARANG)
                ->setCellValue('J' . $i, $value->QTY)
                ->setCellValue('K' . $i, $value->UNIT)
                ->setCellValue('L' . $i, $value->NILAIBARANG);
            $i++;
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:L')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PT. SIP ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Laporan Pemasukan Barang " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
    public function excel_pengeluaran_sip($start = null, $end = null)
    {
        $data['title'] = "LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG";
        $data['title2'] = "KAWASAN BERIKAT PT. SARANA INDUSTAMA PERKASA";
        $data['date'] = "From Date : " . date('d-M-Y', strtotime($start)) . ' to Date : ' .  date('d-F-Y', strtotime($end));
        $data['datafilter'] = $this->report->excel_pengeluaran_sip(date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end)));

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('IT-Dev Programming')
            ->setLastModifiedBy('IT-Dev Programming')
            ->setTitle('Office 2007 XLSX Document')
            ->setSubject('Office 2007 XLSX Document')
            ->setDescription('This Document Redirect by IT-Dev Programming.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('IT Inventory');

        // terakhir tanggal 7 juni, lanjut disini sekarang..! 
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:M4')
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A4:M4')
            ->getBorders()
            ->getTop()
            ->setBorderStyle(Border::BORDER_THIN)
            ->setColor(new Color('00000000'));
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'LAPORAN PENGELUARAN BARANG PER DOKUMEN BARANG')
            ->mergeCells('A1:E1')
            ->setCellValue('A2', 'KAWASAN BERIKAT PT. SARANA INDUSTAMA PERKASA')
            ->mergeCells('A2:E2')
            ->setCellValue('A3', $data['date'])
            ->mergeCells('A3:E3')
            ->setCellValue('A4', 'NO')
            ->setCellValue('B4', 'JENIS DOK.')
            ->setCellValue('C4', 'DOK. NO.PABEAN')
            ->setCellValue('D4', 'TGL PABEAN.')
            ->setCellValue('E4', 'NO. INVOICE')
            ->setCellValue('F4', 'TGL. INVOICE')
            ->setCellValue('G4', 'NAMA PEMBELI')
            ->setCellValue('H4', 'KODE BARANG')
            ->setCellValue('I4', 'NAMA BARANG')
            ->setCellValue('J4', 'UNIT')
            ->setCellValue('K4', 'QTY')
            ->setCellValue('L4', 'MATA UANG')
            ->setCellValue('M4', 'NILAI BARANG');


        // Miscellaneous glyphs, UTF-8

        $i = 5;
        $count = 0;

        foreach ($data['datafilter'] as $value) {
            $count = $count + 1;

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $count)
                ->setCellValue('B' . $i, $value->JENISDOK)
                ->setCellValue('C' . $i, $value->DOKNOPABEAN)
                ->setCellValue('D' . $i, $value->TGLPABEAN)
                ->setCellValue('E' . $i, $value->NOINVOICE)
                ->setCellValue('F' . $i, date('d-M-Y', strtotime($value->TGLINVOICE)))
                ->setCellValue('G' . $i, $value->NAMAPEMBELI)
                ->setCellValue('H' . $i, $value->KODEBARANG)
                ->setCellValue('I' . $i, $value->NAMABARANG)
                ->setCellValue('J' . $i, $value->UNIT)
                ->setCellValue('K' . $i, $value->QTY)
                ->setCellValue('L' . $i, $value->MATAUANG)
                ->setCellValue('M' . $i, $value->NILAIBARANG);
            $i++;
        }
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getStyle('A:M')->getAlignment()->setHorizontal('center');

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('PT. SIP ' . date('d-m-Y'));

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        $filename = "Laporan Pengeluaran Barang " . date('d-F-Y H:i:s');

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        ob_end_clean();
        $writer->save('php://output');
        exit;
    }
}



/* End of file weighbridge.php */
