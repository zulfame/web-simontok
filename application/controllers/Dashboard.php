<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != TRUE) {
            $url = base_url();
            redirect($url);
        }
        $this->load->model('Dashboard_Model');
    }

    public function index()
    {
        $id = $this->session->userdata('role_id');
        if ($id == '1' || $id == '2' || $id == '9') {
            $data['title']  = 'Dashboard';
            $data['site']   = $this->Site_Model->GetData();
            $data['user']   = $this->User_Model->GetProfile();

            $data['st']     = $this->Dashboard_Model->GetSt();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/analytic', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('blocked');
        }
    }

    public function analytic()
    {
        $id = $this->session->userdata('role_id');
        if ($id == '3' || $id == '4') {
            $data['title']  = 'KSK & KSR';
            $data['site']   = $this->Site_Model->GetData();
            $data['user']   = $this->User_Model->GetProfile();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/welcome', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('blocked');
        }
    }

    public function officer()
    {
        $id = $this->session->userdata('role_id');
        if ($id == '5' || $id == '6') {
            $data['title']  = 'AO & Remedial';
            $data['site']   = $this->Site_Model->GetData();
            $data['user']   = $this->User_Model->GetProfile();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/welcome', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('blocked');
        }
    }

    public function welcome()
    {
        $id = $this->session->userdata('role_id');
        if ($id == '7' || $id == '8') {
            $data['title']  = 'CC & Pengunjung';
            $data['site']   = $this->Site_Model->GetData();
            $data['user']   = $this->User_Model->GetProfile();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/welcome', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('blocked');
        }
    }
}
