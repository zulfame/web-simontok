<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kunjungan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Kunjungan_Model');
    }

    public function debitur()
    {
        $data['title']      = 'Debitur Kredit';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $wilayah            = $this->input->post('wilayah');
        $tgl_awal           = $this->input->post('tgl_awal');
        $tgl_akhir          = $this->input->post('tgl_akhir');
        $data['kunjungan']  = $this->Kunjungan_Model->LikeDebitur($wilayah, $tgl_awal, $tgl_akhir);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/debitur/index', $data);
        $this->load->view('templates/footer');
    }

    public function export_debitur()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $region      =  $this->input->get('wilayah');

        // Buat sebuah variabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "DETAIL LAPORAN $region");
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Kode Kredit");
        $sheet->setCellValue('C3', "Nama Debitur");
        $sheet->setCellValue('D3', "Wilayah");
        $sheet->setCellValue('E3', "Petugas");
        $sheet->setCellValue('F3', "Tanggal");
        $sheet->setCellValue('G3', "Pelaksanaan");
        $sheet->setCellValue('H3', "Detial Pelaksanaan");
        $sheet->setCellValue('I3', "Hasil");
        $sheet->setCellValue('J3', "Detail Hasil");
        $sheet->setCellValue('K3', "Catatan");

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
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);

        // Ambil data
        $wilayah =  $this->input->get('wilayah');
        $tgl1    = $this->input->get('tgl1');
        $tgl2    = $this->input->get('tgl2');
        $debitur = $this->Kunjungan_Model->LikeSt($wilayah, $tgl1, $tgl2);

        $no = 1;
        $numrow = 4;
        foreach ($debitur as $data) {
            $c = $data['catatan'];
            if ($c == null) {
                $catatan = "Kosong";
            } else {
                $catatan = $data['catatan'];
            }

            $p = $data['pelaksanaan'];
            if ($p == null) {
                $pelaksanaan = "Kosong";
            } else {
                $pelaksanaan = $data['pelaksanaan'];
            }

            $h = $data['hasil'];
            if ($h == null) {
                $hasil = "Kosong";
            } else {
                $hasil = $data['hasil'];
            }

            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('C' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('D' . $numrow, $data['wilayah']);
            $sheet->setCellValue('E' . $numrow, $data['name']);
            $sheet->setCellValue('F' . $numrow, $data['tgl']);
            $sheet->setCellValue('G' . $numrow, $pelaksanaan);
            $sheet->setCellValue('H' . $numrow, $data['d_pelaksanaan']);
            $sheet->setCellValue('I' . $numrow, $hasil);
            $sheet->setCellValue('J' . $numrow, $data['d_hasil']);
            $sheet->setCellValue('K' . $numrow, $catatan);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(19);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(13);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(80);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(80);
        $sheet->getColumnDimension('K')->setWidth(30);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$region");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Kunjungan Wilayah.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_remedial()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $region      =  $this->input->get('bidang');

        // Buat sebuah variabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "DETAIL LAPORAN $region");
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Kode Kredit");
        $sheet->setCellValue('C3', "Nama Debitur");
        $sheet->setCellValue('D3', "Wilayah");
        $sheet->setCellValue('E3', "Petugas");
        $sheet->setCellValue('F3', "Tanggal");
        $sheet->setCellValue('G3', "Pelaksanaan");
        $sheet->setCellValue('H3', "Detial Pelaksanaan");
        $sheet->setCellValue('I3', "Hasil");
        $sheet->setCellValue('J3', "Detail Hasil");
        $sheet->setCellValue('K3', "Catatan");

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
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);

        // Ambil data
        $bidang  =  $this->input->get('bidang');
        $tgl1    = $this->input->get('tgl1');
        $tgl2    = $this->input->get('tgl2');
        $debitur = $this->Kunjungan_Model->LikeStRemedial($bidang, $tgl1, $tgl2);

        $no = 1;
        $numrow = 4;
        foreach ($debitur as $data) {
            $c = $data['catatan'];
            if ($c == null) {
                $catatan = "Kosong";
            } else {
                $catatan = $data['catatan'];
            }

            $p = $data['pelaksanaan'];
            if ($p == null) {
                $pelaksanaan = "Kosong";
            } else {
                $pelaksanaan = $data['pelaksanaan'];
            }

            $h = $data['hasil'];
            if ($h == null) {
                $hasil = "Kosong";
            } else {
                $hasil = $data['hasil'];
            }

            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('C' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('D' . $numrow, $data['wilayah']);
            $sheet->setCellValue('E' . $numrow, $data['name']);
            $sheet->setCellValue('F' . $numrow, $data['tgl']);
            $sheet->setCellValue('G' . $numrow, $pelaksanaan);
            $sheet->setCellValue('H' . $numrow, $data['d_pelaksanaan']);
            $sheet->setCellValue('I' . $numrow, $hasil);
            $sheet->setCellValue('J' . $numrow, $data['d_hasil']);
            $sheet->setCellValue('K' . $numrow, $catatan);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(19);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(13);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(80);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(80);
        $sheet->getColumnDimension('K')->setWidth(30);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$region");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Kunjungan Bidang.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_writeoff()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $region      =  $this->input->get('bidang');

        // Buat sebuah variabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', "DETAIL LAPORAN $region");
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1')->getFont()->setBold(true);

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Kode Kredit");
        $sheet->setCellValue('C3', "Nama Debitur");
        $sheet->setCellValue('D3', "Wilayah");
        $sheet->setCellValue('E3', "Petugas");
        $sheet->setCellValue('F3', "Tanggal");
        $sheet->setCellValue('G3', "Pelaksanaan");
        $sheet->setCellValue('H3', "Detial Pelaksanaan");
        $sheet->setCellValue('I3', "Hasil");
        $sheet->setCellValue('J3', "Detail Hasil");
        $sheet->setCellValue('K3', "Catatan");

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
        $sheet->getStyle('J3')->applyFromArray($style_col);
        $sheet->getStyle('K3')->applyFromArray($style_col);

        // Ambil data
        $bidang  =  $this->input->get('bidang');
        $tgl1    = $this->input->get('tgl1');
        $tgl2    = $this->input->get('tgl2');
        $debitur = $this->Kunjungan_Model->LikeStWriteoff($bidang, $tgl1, $tgl2);

        $no = 1;
        $numrow = 4;
        foreach ($debitur as $data) {
            $c = $data['catatan'];
            if ($c == null) {
                $catatan = "Kosong";
            } else {
                $catatan = $data['catatan'];
            }

            $p = $data['pelaksanaan'];
            if ($p == null) {
                $pelaksanaan = "Kosong";
            } else {
                $pelaksanaan = $data['pelaksanaan'];
            }

            $h = $data['hasil'];
            if ($h == null) {
                $hasil = "Kosong";
            } else {
                $hasil = $data['hasil'];
            }

            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('C' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('D' . $numrow, $data['wilayah']);
            $sheet->setCellValue('E' . $numrow, $data['name']);
            $sheet->setCellValue('F' . $numrow, $data['tgl']);
            $sheet->setCellValue('G' . $numrow, $pelaksanaan);
            $sheet->setCellValue('H' . $numrow, $data['d_pelaksanaan']);
            $sheet->setCellValue('I' . $numrow, $hasil);
            $sheet->setCellValue('J' . $numrow, $data['d_hasil']);
            $sheet->setCellValue('K' . $numrow, $catatan);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(19);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(13);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(80);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(80);
        $sheet->getColumnDimension('K')->setWidth(30);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$region");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Laporan Kunjungan Writeoff.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function unduh()
    {
        $data['title']      = 'Download Laporan';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/download/index', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_kredit()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('kd_credit', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('kunjungan/kmd_kredit');
        $config['total_rows']   = $this->Kunjungan_Model->CountDebitur();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Kunjungan_Model->GetDebitur($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Debitur Kredit';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/kmd/kmd_kredit', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_card($id)
    {
        $data['title']      = 'Debitur Kredit';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturId($id);
        $data['agunan']     = $this->Kunjungan_Model->GetAgunanId($id);
        $data['tugas']      = $this->Kunjungan_Model->GetStId($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/card/index', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_card_print($id)
    {
        $data['title']      = 'Print Monitoring Card';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturId($id);
        $data['agunan']     = $this->Kunjungan_Model->GetAgunanId($id);
        $data['tugas']      = $this->Kunjungan_Model->GetStId($id);

        $this->load->view('kunjungan/card/print-card', $data);
    }

    public function kmd_remedial()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('kd_credit', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('kunjungan/kmd_remedial');
        $config['total_rows']   = $this->Kunjungan_Model->CountDebiturRemedial();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturRemedial($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Debitur Remedial';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/kmd/kmd_remedial', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_card_remedial($id)
    {
        $data['title']      = 'Debitur Remedial';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturId($id);
        $data['agunan']     = $this->Kunjungan_Model->GetAgunanId($id);
        $data['tugas']      = $this->Kunjungan_Model->GetStId($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/card/remedial', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_writeoff()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('kd_credit', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->from('debitur_wo');

        $config['base_url']     = site_url('kunjungan/kmd_writeoff');
        $config['total_rows']   = $this->Kunjungan_Model->CountDebiturWo();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturWo($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Debitur Writeoff';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/kmd/kmd_writeoff', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_card_wo($id)
    {
        $data['title']      = 'Debitur Writeoff';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturWoId($id);
        $data['agunan']     = $this->Kunjungan_Model->GetAgunanId($id);
        $data['tugas']      = $this->Kunjungan_Model->GetStId($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/card/writeoff', $data);
        $this->load->view('templates/footer');
    }

    public function kmd_card_wo_print($id)
    {
        $data['title']      = 'Print Monitoring Card';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Kunjungan_Model->GetDebiturWoId($id);
        $data['agunan']     = $this->Kunjungan_Model->GetAgunanId($id);
        $data['tugas']      = $this->Kunjungan_Model->GetStId($id);

        $this->load->view('kunjungan/card/print-card-wo', $data);
    }

    public function preview()
    {
        $data['title']      = 'Pertinjau Laporan';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1               = $this->input->post('tgl1');
        $tgl2               = $this->input->post('tgl2');
        $petugas            = $this->input->post('petugas');
        $data['filter']     = $this->Kunjungan_Model->PreviewSt($petugas, $tgl1, $tgl2);
        $data['list']       = $this->Kunjungan_Model->ListPetugas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kunjungan/preview/index', $data);
        $this->load->view('templates/footer');
    }
}
