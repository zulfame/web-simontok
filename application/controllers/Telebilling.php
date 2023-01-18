<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Telebilling extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Telebilling_Model');
    }


    // DEBITR BERDASARKAN WILAYAH
    public function kalijati()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/kalijati');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturKalijati();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturKalijati($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Kalijati';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/kalijati', $data);
        $this->load->view('templates/footer', $data);
    }

    public function subang()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/subang');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturSubang();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturSubang($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Subang';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/subang', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pagaden()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/pagaden');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturPagaden();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturPagaden($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Pagaden';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/pagaden', $data);
        $this->load->view('templates/footer', $data);
    }

    public function sukamandi()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/sukamandi');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturSukamandi();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturSukamandi($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Sukamandi';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/sukamandi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function jalancagak()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/jalancagak');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturJalancagak();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturJalancagak($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Jalancagak';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/jalancagak', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pusakajaya()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/pusakajaya');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturPusakajaya();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturPusakajaya($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Pusakajaya';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/pusakajaya', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pamanukan()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tunggakan_h', $data['keyword']);
        $this->db->from('debitur');

        $config['base_url']     = site_url('telebilling/pamanukan');
        $config['total_rows']   = $this->Telebilling_Model->CountDebiturPamanukan();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Telebilling_Model->GetDebiturPamanukan($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Pamanukan';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/pamanukan', $data);
        $this->load->view('templates/footer', $data);
    }

    // QUERY KMD
    public function card($id)
    {
        $data['title']      = 'History Handeling';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Telebilling_Model->GetDebiturId($id);
        $data['agunan']     = $this->Telebilling_Model->GetAgunanId($id);
        $data['tugas']      = $this->Telebilling_Model->GetStId($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/card/index', $data);
        $this->load->view('templates/footer');
    }

    public function card_print($id)
    {
        $data['title']      = 'Print Monitoring Card';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Telebilling_Model->GetDebiturId($id);
        $data['agunan']     = $this->Telebilling_Model->GetAgunanId($id);
        $data['tugas']      = $this->Telebilling_Model->GetStId($id);

        $this->load->view('telebilling/card/print-card', $data);
    }

    // QUERY REPORT
    public function today()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('tgl', $data['keyword']);
        $this->db->from('surat_tugas');

        $config['base_url']     = site_url('telebilling/today');
        $config['total_rows']   = $this->Telebilling_Model->CountToday();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['st']         = $this->Telebilling_Model->GetToday($config["per_page"], $data['page'], $data['keyword']);

        $data['title']  = 'Today';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hasil']  = ['Janji Bayar', 'Telpon Tidak Aktif', 'Telpon Tidak Aktif (FU AO)', 'Telpon Tidak Diangkat', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('telebilling/today', $data);
        $this->load->view('templates/footer');
    }

    public function today_add()
    {
        $this->form_validation->set_rules('hasil', 'Result', 'required|trim');
        $this->form_validation->set_rules('d_hasil', 'Detail Result', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->Telebilling_Model->InsertToday();
            $this->session->set_flashdata('message', 'Added');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function today_edit()
    {
        $this->form_validation->set_rules('hasil', 'Hasil', 'trim');
        $this->form_validation->set_rules('d_hasil', 'Hasil', 'trim');

        if ($this->form_validation->run() == false) {
            redirect('telebilling/today');
        } else {
            $this->Telebilling_Model->UpdateToday();
            $this->session->set_flashdata('message', 'Changed');
            redirect('telebilling/today');
        }
    }

    public function today_delete($id)
    {
        $this->Telebilling_Model->DeleteToday($id);
        $this->session->set_flashdata('message', 'Deleted');
        redirect('telebilling/today');
    }

    // QUERY REPORT
    public function report_today()
    {
        $data['title']      = 'Today';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['laporan']    = $this->Telebilling_Model->GetReport();

        $this->load->view('telebilling/report/index', $data);
    }

    public function export_today()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $tgl         = format_indo_full(date('Y-m-d'));

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
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

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
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

        $sheet->setCellValue('A1', "TeleBilling Today"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "Date");
        $sheet->setCellValue('C3', "No Task");
        $sheet->setCellValue('D3', "No Credit");
        $sheet->setCellValue('E3', "Debitur");
        $sheet->setCellValue('F3', "HR-T");
        $sheet->setCellValue('G3', "Tgk. Pokok");
        $sheet->setCellValue('H3', "Tgk. Bunga");
        $sheet->setCellValue('I3', "Tgk. Denda");
        $sheet->setCellValue('J3', "Result");
        $sheet->setCellValue('K3', "Wilayah");
        $sheet->setCellValue('L3', "Officer");

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
        $sheet->getStyle('L3')->applyFromArray($style_col);

        // Panggil function view
        $debitur = $this->Telebilling_Model->GetReport();

        $no = 1;
        $numrow = 4;
        foreach ($debitur as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, format_indo_full($data['tgl']));
            $sheet->setCellValue('C' . $numrow, $data['no_st']);
            $sheet->setCellValue('D' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('E' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('F' . $numrow, $data['tunggakan_h']);
            $sheet->setCellValue('G' . $numrow, "Rp. " . rupiah($data['tgk_pokok']));
            $sheet->setCellValue('H' . $numrow, "Rp. " . rupiah($data['tgk_bunga']));
            $sheet->setCellValue('I' . $numrow, "Rp. " . rupiah($data['tgk_denda']));

            $p = $data['jb'];
            if ($p == "0000-00-00" || $p == "") {
                $jb = "";
            } else {
                $jb = " ⇒ $p";
            }

            $sheet->setCellValue('J' . $numrow, $data['hasil'] . " ⇒ " . $data['d_hasil'] . $jb);
            $sheet->setCellValue('K' . $numrow, $data['wilayah']);
            $sheet->setCellValue('L' . $numrow, $data['kd_petugas']);

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
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(36);
        $sheet->getColumnDimension('F')->setWidth(5);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(50);
        $sheet->getColumnDimension('K')->setWidth(15);
        $sheet->getColumnDimension('L')->setWidth(7);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$tgl");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="TeleBilling Today.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function export_debitur()
    {
        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $tgl         = format_indo_full(date('Y-m-d'));

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
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

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
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

        $sheet->setCellValue('A1', "TeleBilling"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1

        // Buat header tabel
        $sheet->setCellValue('A3', "No");
        $sheet->setCellValue('B3', "No Credit");
        $sheet->setCellValue('C3', "No CIF");
        $sheet->setCellValue('D3', "No SPK");
        $sheet->setCellValue('E3', "Nama Debitur");
        $sheet->setCellValue('F3', "Alamat");
        $sheet->setCellValue('G3', "Telpon");
        $sheet->setCellValue('H3', "Plafond");
        $sheet->setCellValue('I3', "Wilayah");
        $sheet->setCellValue('J3', "Petugas");
        $sheet->setCellValue('K3', "HR-P");
        $sheet->setCellValue('L3', "Tgk. Pokok");
        $sheet->setCellValue('M3', "HR-B");
        $sheet->setCellValue('N3', "Tgk. Bunga");
        $sheet->setCellValue('O3', "Tgk. Denda");
        $sheet->setCellValue('P3', "HR-T");
        $sheet->setCellValue('Q3', "Sisa OS");

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
        $sheet->getStyle('L3')->applyFromArray($style_col);
        $sheet->getStyle('M3')->applyFromArray($style_col);
        $sheet->getStyle('N3')->applyFromArray($style_col);
        $sheet->getStyle('O3')->applyFromArray($style_col);
        $sheet->getStyle('P3')->applyFromArray($style_col);
        $sheet->getStyle('Q3')->applyFromArray($style_col);

        // Panggil function view
        $debitur = $this->Telebilling_Model->ExportDebitur();

        $no = 1;
        $numrow = 4;
        foreach ($debitur as $data) {
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['kd_credit']);
            $sheet->setCellValue('C' . $numrow, $data['no_cif']);
            $sheet->setCellValue('D' . $numrow, $data['no_spk']);
            $sheet->setCellValue('E' . $numrow, $data['nama_debitur']);
            $sheet->setCellValue('F' . $numrow, $data['alamat']);
            $sheet->setCellValue('G' . $numrow, $data['telepon']);
            $sheet->setCellValue('H' . $numrow, "Rp. " . rupiah($data['plafond']));
            $sheet->setCellValue('I' . $numrow, $data['wilayah']);
            $sheet->setCellValue('J' . $numrow, $data['name']);
            $sheet->setCellValue('K' . $numrow, $data['hari_pokok']);
            $sheet->setCellValue('L' . $numrow, "Rp. " . rupiah($data['tgk_pokok']));
            $sheet->setCellValue('M' . $numrow, $data['hari_bunga']);
            $sheet->setCellValue('N' . $numrow, "Rp. " . rupiah($data['tgk_bunga']));
            $sheet->setCellValue('O' . $numrow, "Rp. " . rupiah($data['tgk_denda']));
            $sheet->setCellValue('P' . $numrow, $data['hari_pokok']);
            $sheet->setCellValue('Q' . $numrow, "Rp. " . rupiah($data['baki_debet']));

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
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('Q' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(19);
        $sheet->getColumnDimension('C')->setWidth(13);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(36);
        $sheet->getColumnDimension('F')->setWidth(76);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(20);
        $sheet->getColumnDimension('K')->setWidth(5);
        $sheet->getColumnDimension('L')->setWidth(15);
        $sheet->getColumnDimension('M')->setWidth(5);
        $sheet->getColumnDimension('N')->setWidth(15);
        $sheet->getColumnDimension('O')->setWidth(15);
        $sheet->getColumnDimension('P')->setWidth(5);
        $sheet->getColumnDimension('Q')->setWidth(15);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$tgl");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="TeleBilling.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
