<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mobile/Tugas_Model');
    }

    public function index()
    {
        $data['title']  = 'Surat Tugas';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();

        $data['st']       = $this->Tugas_Model->GetSt();
        $data['st_wo']    = $this->Tugas_Model->GetStWo();

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-tugas', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function report($id, $uri4)
    {
        $id   = $this->uri->segment(4);
        $uri4 = $this->uri->segment(5);

        $data['title']  = 'Surat Tugas';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['tugas']  = $this->Tugas_Model->GetStReport($id);
        $data['riwayat']        = $this->Tugas_Model->GetStHistory($uri4);
        $data['debitur']        = $this->Tugas_Model->GetDebiturId($uri4);
        $data['pelaksanaan']    = ['Penagihan ke Rumah Debitur', 'Lainnya'];
        $data['hasil']          = ['Bayar Full Tunggakan', 'Janji Bayar', 'Topup', 'Lainnya'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-report', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function report_wo($id, $uri4)
    {
        $id   = $this->uri->segment(4);
        $uri4 = $this->uri->segment(5);

        $data['title']  = 'Surat Tugas';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['tugas']  = $this->Tugas_Model->GetStReportWo($id);
        $data['riwayat']        = $this->Tugas_Model->GetStHistory($uri4);
        $data['debitur']        = $this->Tugas_Model->GetDebiturIdWo($uri4);
        $data['pelaksanaan']    = ['Penagihan ke Rumah Debitur', 'Lainnya'];
        $data['hasil']          = ['Bayar Full Tunggakan', 'Janji Bayar', 'Topup', 'Lainnya'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-report-wo', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function report_edit()
    {
        $this->form_validation->set_rules('pelaksanaan', 'Pelaksanaan', 'trim');
        $this->form_validation->set_rules('d_pelaksanaan', 'Detail Pelaksanaan', 'trim');
        $this->form_validation->set_rules('hasil', 'Hasil', 'trim');
        $this->form_validation->set_rules('d_hasil', 'Hasil', 'trim');

        if ($this->form_validation->run() == false) {
            redirect('mobile/tugas');
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

            $this->Tugas_Model->UpdateReport();
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

    public function catatan()
    {
        $data['title']  = 'Surat Tugas';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();

        $data['st']       = $this->Tugas_Model->GetStNote();
        $data['st_wo']    = $this->Tugas_Model->GetStWoNote();

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-catatan', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function catatan_st($id, $uri4)
    {
        $id   = $this->uri->segment(4);
        $uri4 = $this->uri->segment(5);

        $data['title']  = 'Catatan';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['tugas']  = $this->Tugas_Model->GetStReport($id);
        $data['riwayat']        = $this->Tugas_Model->GetStHistory($uri4);
        $data['debitur']        = $this->Tugas_Model->GetDebiturId($uri4);
        $data['pelaksanaan']    = ['Penagihan ke Rumah Debitur', 'Lainnya'];
        $data['hasil']          = ['Bayar Full Tunggakan', 'Janji Bayar', 'Topup', 'Lainnya'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-catatan-st', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function catatan_wo($id, $uri4)
    {
        $id   = $this->uri->segment(4);
        $uri4 = $this->uri->segment(5);

        $data['title']  = 'Catatan';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['tugas']  = $this->Tugas_Model->GetStReportWo($id);
        $data['riwayat']        = $this->Tugas_Model->GetStHistory($uri4);
        $data['debitur']        = $this->Tugas_Model->GetDebiturIdWo($uri4);
        $data['pelaksanaan']    = ['Penagihan ke Rumah Debitur', 'Lainnya'];
        $data['hasil']          = ['Bayar Full Tunggakan', 'Janji Bayar', 'Topup', 'Lainnya'];

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/tugas/page-catatan-wo', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    public function catatan_edit()
    {
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim');

        if ($this->form_validation->run() == false) {
            redirect('mobile/tugas');
        } else {

            $this->Tugas_Model->UpdateNote();
            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
            Saved Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
