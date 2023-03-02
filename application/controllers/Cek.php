<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek extends CI_Controller {
public function index(){
// load Cek_Model
$this->load->model('Cek_Model');
// Database 1
$data['data1'] = $this->Cek_Model->Get_Pengguna();
// Database 2
$data['data2'] = $this->Cek_Model->Get_User();

$this->load->view('Cek', $data);
}
}