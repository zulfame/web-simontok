<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Task_Model');
    }

    // QUERY TASK TODAY
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
        $this->db->like('no_st', $data['keyword']);
        $this->db->from('surat_tugas');

        $config['base_url']    = site_url('task/today');
        $config['total_rows']  = $this->Task_Model->CountSt();
        $config['per_page']    = 10;
        $data['total_rows']    = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['st']         = $this->Task_Model->GetToday($config["per_page"], $data['page'], $data['keyword']);

        $data['title']          = 'Today';
        $data['site']           = $this->Site_Model->GetData();
        $data['user']           = $this->User_Model->GetProfile();
        $data['pelaksanaan']    = ['Penagihan ke Rumah Debitur', 'Lainnya'];
        $data['hasil']          = ['Bayar Full Tunggakan', 'Topup', 'Lainnya'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('task/today/index', $data);
        $this->load->view('templates/footer');
    }

    public function today_edit()
    {
        $this->form_validation->set_rules('pelaksanaan', 'Pelaksanaan', 'trim');
        $this->form_validation->set_rules('d_pelaksanaan', 'Detail Pelaksanaan', 'trim');
        $this->form_validation->set_rules('hasil', 'Hasil', 'trim');
        $this->form_validation->set_rules('d_hasil', 'Hasil', 'trim');

        if ($this->form_validation->run() == false) {
            redirect('task/today');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $debitur_name = $this->input->post('nama_debitur');
                $image_name   = $debitur_name . '-' . date("Y/m/d");

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5120';
                $config['upload_path']   = './assets/img/st/';
                $config['file_name']     = $image_name;


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $this->input->post('image');
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/st/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->Task_Model->UpdateToday();
            $this->session->set_flashdata('message', 'Changed');
            $this->session->unset_userdata('keyword');
            redirect('task/today');
        }
    }

    // QUERY LIST DEBITUR
    public function debitur()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('debitur_code', $data['keyword']);
        $this->db->from('tunggakan');

        $config['base_url']     = site_url('task/debitur');
        $config['total_rows']   = $this->Task_Model->CountDebitur();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Task_Model->GetDebitur($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Debitur';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['wilayah']    = ['KALIJATI', 'JALANCAGAK', 'PAGADEN', 'PAMANUKAN', 'PUSAKAJAYA', 'SUBANG', 'SUKAMANDI'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('task/debitur/index', $data);
        $this->load->view('templates/footer');
    }

    public function export_debitur()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $region = $this->session->userdata('name');

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

        $sheet->setCellValue('A1', "LIST DEBITUR"); // Set kolom A1 dengan tulisan "DATA SISWA"
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
        $sheet->setCellValue('H3', "Metode RPS");
        $sheet->setCellValue('I3', "JW");
        $sheet->setCellValue('J3', "Tgl. Realisasi");
        $sheet->setCellValue('K3', "Tgl. Japo");
        $sheet->setCellValue('L3', "Rate");
        $sheet->setCellValue('M3', "Plafond");
        $sheet->setCellValue('N3', "Baki Debet");
        $sheet->setCellValue('O3', "Call");
        $sheet->setCellValue('P3', "Tgk. Pokok");
        $sheet->setCellValue('Q3', "Tgk. Bunga");
        $sheet->setCellValue('R3', "Tgk. Denda");
        $sheet->setCellValue('S3', "HR-P");
        $sheet->setCellValue('T3', "HR-B");
        $sheet->setCellValue('U3', "Petugas");

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
        $sheet->getStyle('R3')->applyFromArray($style_col);
        $sheet->getStyle('S3')->applyFromArray($style_col);
        $sheet->getStyle('T3')->applyFromArray($style_col);
        $sheet->getStyle('U3')->applyFromArray($style_col);

        // Panggil function view
        $debitur = $this->Task_Model->ExportDebitur();

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
            $sheet->setCellValue('H' . $numrow, $data['metode_rps']);
            $sheet->setCellValue('I' . $numrow, $data['jw']);
            $sheet->setCellValue('J' . $numrow, $data['tgl_realisasi']);
            $sheet->setCellValue('K' . $numrow, $data['tgl_jth_tempo']);
            $sheet->setCellValue('L' . $numrow, $data['rate']);
            $sheet->setCellValue('M' . $numrow, "Rp. " . rupiah($data['plafond']));
            $sheet->setCellValue('N' . $numrow, "Rp. " . rupiah($data['baki_debet']));
            $sheet->setCellValue('O' . $numrow, $data['call']);
            $sheet->setCellValue('P' . $numrow, "Rp. " . rupiah($data['tgk_pokok']));
            $sheet->setCellValue('Q' . $numrow, "Rp. " . rupiah($data['tgk_bunga']));
            $sheet->setCellValue('R' . $numrow, "Rp. " . rupiah($data['tgk_denda']));
            $sheet->setCellValue('S' . $numrow, $data['hari_pokok']);
            $sheet->setCellValue('T' . $numrow, $data['hari_bunga']);
            $sheet->setCellValue('U' . $numrow, $data['name']);

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
            $sheet->getStyle('R' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('S' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('T' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('U' . $numrow)->applyFromArray($style_row);

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
        $sheet->getColumnDimension('I')->setWidth(4);
        $sheet->getColumnDimension('J')->setWidth(13);
        $sheet->getColumnDimension('K')->setWidth(13);
        $sheet->getColumnDimension('L')->setWidth(5);
        $sheet->getColumnDimension('M')->setWidth(20);
        $sheet->getColumnDimension('N')->setWidth(20);
        $sheet->getColumnDimension('O')->setWidth(4);
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(20);
        $sheet->getColumnDimension('R')->setWidth(20);
        $sheet->getColumnDimension('S')->setWidth(5);
        $sheet->getColumnDimension('T')->setWidth(5);
        $sheet->getColumnDimension('U')->setWidth(20);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $sheet->setTitle("$region");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="List Debitur.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // QUERY KMD
    public function card($id)
    {
        $data['title']      = 'Debitur';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Task_Model->GetDebiturId($id);
        $data['agunan']     = $this->Task_Model->GetAgunanId($id);
        $data['tugas']      = $this->Task_Model->GetStId($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('task/card/index', $data);
        $this->load->view('templates/footer');
    }

    public function card_print($id)
    {
        $data['title']      = 'Print Monitoring Card';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Task_Model->GetDebiturId($id);
        $data['agunan']     = $this->Task_Model->GetAgunanId($id);
        $data['tugas']      = $this->Task_Model->GetStId($id);

        $this->load->view('task/card/print-card', $data);
    }

    // QUERY PROSPECT
    public function prospect()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        // konfigurasi pagination
        $this->db->like('calon_debitur', $data['keyword']);
        $this->db->or_like('no_hp', $data['keyword']);
        $this->db->or_like('keterangan', $data['keyword']);
        $this->db->from('prospek');

        $config['base_url']     = site_url('task/prospect');
        $config['total_rows']   = $this->Task_Model->CountProspect();
        $config['per_page']     = 10;
        $data['total_rows']     = $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['prospect']   = $this->Task_Model->GetProspect($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Prospect';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['prospek']    = ['Prospek', 'Survey', 'Lainnya'];
        $data['status']     = ['Closing', 'Progres', 'Failed'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('task/prospect/index', $data);
        $this->load->view('templates/footer');
    }

    public function prospect_add()
    {
        $this->form_validation->set_rules('hunting', 'Hunting', 'required|trim');
        $this->form_validation->set_rules('candidate', 'Candidate Name', 'required|trim');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('task/prospect');
        } else {
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $petugas_name = $this->session->userdata('name');
                $image_name   = $petugas_name . '-' . date("Y/m/d");

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5120';
                $config['upload_path']   = './assets/img/prospek/';
                $config['file_name']     = $image_name;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_prospek', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->Task_Model->InsertProspect();
            $this->session->set_flashdata('message', 'Added');
            $this->session->unset_userdata('keyword');
            redirect('task/prospect');
        }
    }

    public function prospect_edit()
    {
        $this->form_validation->set_rules('hunting', 'Hunting', 'required|trim');
        $this->form_validation->set_rules('candidate', 'Candidate Name', 'required|trim');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('task/prospect');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $petugas_name = $this->session->userdata('name');
                $image_name   = $petugas_name . '-' . date("Y/m/d");

                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '5120';
                $config['upload_path']   = './assets/img/prospek/';
                $config['file_name']     = $image_name;


                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $this->input->post('old_img');
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/prospek/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image_prospek', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->Task_Model->UpdateProspek();
            $this->session->set_flashdata('message', 'Changed');
            $this->session->unset_userdata('keyword');
            redirect('task/prospect');
        }
    }
}
