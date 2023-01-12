<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Debitur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mobile/Debitur_Model');
        $this->load->model('mobile/Tugas_Model');
    }

    public function index()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama_debitur', $data['keyword']);
        $this->db->from('debitur');

        $data['title']   = 'Debitur';
        $data['site']    = $this->Site_Model->GetData();
        $data['user']    = $this->User_Model->GetProfile();
        $data['hitung']  = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['debitur'] = $this->Debitur_Model->GetDebitur($data['keyword']);

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/debitur/page-debitur', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function detail($id)
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama_debitur', $data['keyword']);
        $this->db->from('debitur');

        $data['title']   = 'Debitur';
        $data['site']    = $this->Site_Model->GetData();
        $data['user']    = $this->User_Model->GetProfile();
        $data['hitung']  = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['debitur'] = $this->Debitur_Model->GetDebiturId($id);
        $data['agunan']  = $this->Debitur_Model->GetAgunanId($id);
        $data['tugas']   = $this->Debitur_Model->GetStId($id);

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/debitur/page-debitur-detail', $data);
        $this->load->view('mobile/templates/footer', $data);
    }
}
