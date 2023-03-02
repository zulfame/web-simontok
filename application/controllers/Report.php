<?php defined('BASEPATH') or exit('No direct script access allowed');
class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_Model');
        if ($this->session->userdata('level') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Direksi') {
            $data['konten']     = "direksi/download/laporan";
            $data['title']      = 'Download Laporan';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/404.php');
        }
    }

    public function filter()
    {
        if ($this->session->userdata('level') == 'Direksi') {
            $tgl1                = $this->input->get('tgl1');
            $tgl2               = $this->input->get('tgl2');
            $data['kunjungan']  = $this->Report_Model->pencarian_st($tgl1, $tgl2);
            $data['konten']     = "direksi/download/f_laporan";
            $data['title']      = 'Download Laporan';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/404.php');
        }
    }

    public function kunjungan()
    {
        if ($this->session->userdata('level') == 'Direksi') {
            $data['konten']            = "direksi/download/laporan";
            $data['title']             = 'Download Laporan';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/404.php');
        }
    }
}
