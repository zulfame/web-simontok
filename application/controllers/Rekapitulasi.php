<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class rekapitulasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Rekepitulasi_Model');
    }

    public function tugas()
    {
        $data['title']      = 'Surat Tugas';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1           = $this->input->post('tgl1');
        $tgl2           = $this->input->post('tgl2');
        $data['rekap']  = $this->Rekepitulasi_Model->Filter($tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/tugas/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail_tugas($id, $tgl1, $tgl2)
    {
        $data['title']      = 'Surat Tugas';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1               = $this->uri->segment(4);
        $tgl2               = $this->uri->segment(5);
        $data['petugas']    = $this->Rekepitulasi_Model->PetugasId($id);
        $data['tugas']      = $this->Rekepitulasi_Model->DetailTugas($id, $tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/tugas/detail-tugas', $data);
        $this->load->view('templates/footer');
    }

    public function wilayah()
    {
        $data['title']      = 'Per Wilayah';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1           = $this->input->post('tgl1');
        $tgl2           = $this->input->post('tgl2');
        $data['rekap']  = $this->Rekepitulasi_Model->FilterWilayah($tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/tugas/wilayah', $data);
        $this->load->view('templates/footer');
    }
    public function detail_wilayah($id, $tgl1, $tgl2)
    {
        $data['title']      = 'Surat Tugas';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1               = $this->uri->segment(4);
        $tgl2               = $this->uri->segment(5);
        $data['wilayah']    = $this->Rekepitulasi_Model->WilayahId($id);
        $data['tugas']      = $this->Rekepitulasi_Model->DetailWilayah($id, $tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/tugas/detail-wilayah', $data);
        $this->load->view('templates/footer');
    }

    public function prospek()
    {
        $data['title']      = 'All Prospek';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1           = $this->input->post('tgl1');
        $tgl2           = $this->input->post('tgl2');
        $data['rekap']  = $this->Rekepitulasi_Model->FilterProspek($tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/prospek/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail_prospek($id, $tgl1, $tgl2)
    {
        $data['title']      = 'All Prospek';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $tgl1               = $this->uri->segment(4);
        $tgl2               = $this->uri->segment(5);
        $data['petugas']    = $this->Rekepitulasi_Model->PetugasId($id);
        $data['prospek']    = $this->Rekepitulasi_Model->DetailProspek($id, $tgl1, $tgl2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('rekepitulasi/prospek/detail', $data);
        $this->load->view('templates/footer');
    }
}
