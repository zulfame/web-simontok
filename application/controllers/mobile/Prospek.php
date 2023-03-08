<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prospek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mobile/Tugas_Model');
        $this->load->model('mobile/Prospek_Model');
    }

    public function index()
    {
        $data['title']    = 'Prospek';
        $data['site']     = $this->Site_Model->GetData();
        $data['user']     = $this->User_Model->GetProfile();
        $data['hitung']   = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['prospek']  = $this->Prospek_Model->GetProspect();
        $data['status']   = ['Closing', 'Progres', 'Failed'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/prospek/page-prospect', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function prospect_add()
    {
        $this->form_validation->set_rules('hunting', 'Hunting', 'required|trim');
        $this->form_validation->set_rules('candidate', 'Candidate Name', 'required|trim');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('mobile/prospect');
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

            $this->Prospek_Model->InsertProspect();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
            Added Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
            redirect('mobile/prospek');
        }
    }

    public function prospect_edit($id)
    {
        $data['title']  = 'Edit Prospek';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();

        $data['prospek']  = $this->Prospek_Model->GetProspek($id);
        $data['list']     = ['Prospek', 'Survey', 'Lainnya'];
        $data['hasil']    = ['0', '1'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/prospek/page-edit', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function prospect_update()
    {
        $this->form_validation->set_rules('hunting', 'Hunting', 'required|trim');
        $this->form_validation->set_rules('candidate', 'Candidate Name', 'required|trim');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('mobile/prospect');
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

            $this->Prospek_Model->UpdateProspek();
            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
            Saved Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
            $this->session->unset_userdata('keyword');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function prospect_delete($id)
    {
        $this->Prospek_Model->DeleteProspect($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
            Deleted Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
        redirect('mobile/prospek');
    }

    public function prospect_ks()
    {
        $this->form_validation->set_rules('plan', 'Plan', 'required|trim');
        $this->form_validation->set_rules('target', 'Target', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('mobile/prospek');
        } else {
            $this->Prospek_Model->InsertProspectKs();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
            Added Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
            redirect('mobile/prospek');
        }
    }
}
