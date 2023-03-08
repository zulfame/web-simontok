<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Report_Model');
    }


    /*------------------
    Form Input Laporan
    ------------------*/
    function index()
    {
        $data['title'] = 'Telegram';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('views_laporan_harian');
        $this->load->view('templates/footer', $data);
    }


    /*----------------------
    Function Submit Laporan
    ---------------------- */
    function submit_report()
    {
        $tanggal = date("Y-m-d H:i:s");
        $nama = $this->input->post('nama');
        $penjualan = $this->input->post('sales');

        $report_data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'penjualan' => $penjualan
        );

        $this->db->insert('bot_report', $report_data);

        $data['title'] = 'Result Telegram';
        $data['site']   = $this->Site_Model->GetData();
        $data['user']   = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('views_laporan_harian_result', $data);
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
