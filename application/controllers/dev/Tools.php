<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
 ***************************************************
 *   SIMONTOK (SISTEM MONITORING KREDIT) v2 2023   *
 ***************************************************
 * Dikembangkan oleh : Zulfadli Rizal              *
 * Email 	: hello@zulfame.id                     *
 * Website	: https://zulfame.id                   *
 * Telegram : 0823-200-999-71					   *
 * *************************************************
*/

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tools extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_sub();

        $this->load->model('dev/Tools_Model');
    }

    public function masking()
    {
        $data['title']  = 'Masking';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $data['result'] = $this->Tools_Model->GetReportMasking();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dev/report/masking', $data);
        $this->load->view('templates/footer', $data);
    }

    public function masking_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path   = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow          = $worksheet->getHighestRow();
                $highestColumn       = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id              = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $telpon          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $status          = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $detail          = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data_masking[]  = array(
                        'id'         => $id,
                        'telpon'     => $telpon,
                        'status'     => $status,
                        'detail'     => $detail,
                        'date'       => date("Y-m-d h:i:sa")
                    );
                }
            }
            $insert = $this->Tools_Model->InsertBatchMasking($data_masking);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('dev/tools/masking');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('dev/tools/masking');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function masking_export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $title       = "Laporan Nomer Tidak Aktif";

        // Buat sebuah variabel
        $style_col = [
            'font'      => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders'   => [
                'top'   => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left'  => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel
        $style_row = [
            'alignment'    => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders'    => [
                'top'    => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right'  => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left'   => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $style_row2 = [
            'alignment'      => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders'    => [
                'top'    => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right'  => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left'   => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "LIST DEBITUR KREDIT");
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Nama Debitur");
        $sheet->setCellValue('C3', "KD Kredit");
        $sheet->setCellValue('D3', "Telpon");
        $sheet->setCellValue('E3', "Wilayah");
        $sheet->setCellValue('F3', "Bidang");
        $sheet->setCellValue('G3', "Petugas");
        $sheet->setCellValue('H3', "Status");
        $sheet->setCellValue('I3', "Detail");

        // Apply style header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);
        $sheet->getStyle('G3')->applyFromArray($style_col);
        $sheet->getStyle('H3')->applyFromArray($style_col);
        $sheet->getStyle('I3')->applyFromArray($style_col);

        // Panggil function view
        $masking = $this->Tools_Model->GetReportMasking();

        $no     = 1;
        $numrow = 4;
        foreach ($masking as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('C' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('D' . $numrow, "'" . $data['telpon']);
            $sheet->setCellValue('E' . $numrow, $data['wilayah']);
            $sheet->setCellValue('F' . $numrow, $data['bidang']);
            $sheet->setCellValue('G' . $numrow, $data['kd_petugas']);
            $sheet->setCellValue('H' . $numrow, $data['status']);
            $sheet->setCellValue('I' . $numrow, $data['detail']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row2);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row2);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(36);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(13);
        $sheet->getColumnDimension('F')->setWidth(13);
        $sheet->getColumnDimension('G')->setWidth(8);
        $sheet->getColumnDimension('H')->setWidth(10);
        $sheet->getColumnDimension('I')->setWidth(40);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$title");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="!Result_Report_Masking.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function masking_delete()
    {
        $this->Tools_Model->EmptyMasking();
        $this->session->set_flashdata('message', 'Deleted');
        redirect('dev/tools/masking');
    }
}
