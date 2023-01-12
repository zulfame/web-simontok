<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mobile/Tugas_Model');
    }

    public function index()
    {
        $data['title']    = 'Dashboard';
        $data['site']     = $this->Site_Model->GetData();
        $data['user']     = $this->User_Model->GetProfile();
        $data['hitung']   = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();
        $data['jb']       = $this->Tugas_Model->Jb();
        $data['jb_wo']    = $this->Tugas_Model->JbWo();
        $data['st']       = $this->Tugas_Model->GetStImage();
        $data['st_wo']    = $this->Tugas_Model->GetStWoImage();

        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/templates/menu', $data);
        $this->load->view('mobile/templates/sidebar', $data);
        $this->load->view('mobile/dashboard/page-discover', $data);
        $this->load->view('mobile/templates/footer', $data);
    }

    /*----------------------
    Function Submit Report
    ---------------------- */
    function submit_report()
    {
        $tanggal = date("d-m-Y H:i:s");
        $nama    = $this->input->post('name', true);
        $report  = $this->input->post('report', true);

        $report_data = array(
            'tanggal' => $tanggal,
            'nama'    => $nama,
            'report'  => $report
        );

        $this->db->insert('bot_report', $report_data);

        $data['title']  = 'Result Report';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();
        $data['hitung'] = $this->Tugas_Model->CountSt();
        $data['undone']   = $this->Tugas_Model->UnDone();
        $data['undonewo'] = $this->Tugas_Model->UnDoneWo();


        $this->load->view('mobile/templates/header', $data);
        $this->load->view('mobile/dashboard/page-report-result', $data);
    }

    function Bot()
    {
        $TOKEN = "5985445229:AAETSRh7-wLoUf1W9MgOt-6Lt_MXx6RmRj8";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];

        if (strpos($message, "/start") === 0) {

            file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Haloo, test webhooks dicoffeean.com.&parse_mode=HTML");
        }
    }
}
