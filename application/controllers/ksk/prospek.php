<?php defined('BASEPATH') or exit('No direct script access allowed');
class Prospek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Prospek_Model');
        $this->load->model('Petugas_Model');
        $this->load->model('Pengguna_Model');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'KKW') {
            $data['prospek']    = $this->Prospek_Model->GetDataKsk();
            $data['konten']        = "kkw/prospek/data_ksk";
            $data['title']         = 'Prospek KSK';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/main', $data);
        }
    }
    public function tambah()
    {
        $id = $this->session->userdata('id');
        $data = array(
            "idpengguna"        => $id,
            "tgl"                => date('Y-m-d'),
            "prospek"            => $this->input->post('plan'),
            "keterangan"        => $this->input->post('target'),
        );

        $this->Prospek_Model->Add($data);
        helper_log("tambah", "menambah data prospek");
        $this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
        redirect("ksk/prospek");
    }
    public function ubah()
    {
        if ($this->session->userdata('level') == 'KKW') {
            $id = $this->input->post('id');
            $data = array(
                'prospek'          => $this->input->post('plan'),
                'keterangan'     => $this->input->post('target'),
            );
            $this->Prospek_Model->ubah($data, $id);
            helper_log("edit", "merubah data prospek");
            $this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
            redirect('ksk/prospek');
        } else {
            $this->load->view('templates/404.php');
        }
    }
    public function hapus($id)
    {
        if ($this->session->userdata('level') == 'KKW') {
            $this->Prospek_Model->hapus($id);
            $this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
            redirect("ksk/prospek");
        } else {
            $this->load->view('templates/404.php');
        }
    }

    public function ao()
    {
        if ($this->session->userdata('level') == 'KKW') {
            $data['prospek']    = $this->Prospek_Model->GetData();
            $data['konten']        = "kkw/prospek/data";
            $data['title']         = 'Prospek Petugas';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/main', $data);
        }
    }
}
