<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mobile/Tugas_Model');
    }

    public function profile()
    {
        $data['title']   = 'Profile';
        $data['site']    = $this->Site_Model->GetData();
        $data['user']    = $this->User_Model->GetProfile();
        $data['hitung']  = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('mobile/templates/header', $data);
            $this->load->view('mobile/templates/menu', $data);
            $this->load->view('mobile/templates/sidebar', $data);
            $this->load->view('mobile/user/page-profile', $data);
            $this->load->view('mobile/templates/footer', $data);
        } else {

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {

                $image_name = $this->input->post('name');

                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = '2048';
                $config['upload_path']   = './assets/img/profile/';
                $config['file_name']     = $image_name;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . './assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->dispay_errors();
                }
            }

            $this->User_Model->UpdateProfile();
            $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
            Changed Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <ion-icon name="close-outline"></ion-icon>
            </button>
            </div>');
            redirect('mobile/user/profile');
        }
    }

    public function password()
    {
        $data['title']  = 'Password';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();

        $this->form_validation->set_rules('current_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('mobile/templates/header', $data);
            $this->load->view('mobile/templates/menu', $data);
            $this->load->view('mobile/templates/sidebar', $data);
            $this->load->view('mobile/user/page-password', $data);
            $this->load->view('mobile/templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message_failed', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
                Wrong current password!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <ion-icon name="close-outline"></ion-icon>
                </button>
                </div>');
                redirect('mobile/user/password');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message_failed', '<div class="alert alert-danger mb-2 alert-dismissible fade show" role="alert">
                    New password cannot be the same as current password!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    </div>');
                    redirect('mobile/user/password');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success mb-2 alert-dismissible fade show" role="alert">
                    Changed Successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <ion-icon name="close-outline"></ion-icon>
                    </button>
                    </div>');
                    redirect('mobile/user/password');
                }
            }
        }
    }
}
