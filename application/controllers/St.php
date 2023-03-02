<?php defined('BASEPATH') OR exit('No direct script access allowed');
class St extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->db2 = $this->load->database('simontok_online', TRUE);
		$this->load->model('St_Model');
	}

	// KELOLA USER
	public function index()
	{
		$data['user']=$this->St_Model->GetDataUser();
		$this->load->view('cek_db',$data);
	}



}
?>