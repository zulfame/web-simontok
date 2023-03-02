<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Export extends CI_Controller 
{
	public function __construct()
	{
    parent::__construct();
    
    $this->load->model('Debitur_Model');
  	}

  	public function export_excel()
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data = array(
				'title' => 'Data Debitur Perwilayah',
  				'debitur' => $this->Debitur_Model->dataPerWilayah()
  			);
  			$this->load->view('kkw/debitur/export',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function export_debitur()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='Direksi')
		{
			$data = array(
				'title' => 'Data Debitur',
  				'debitur' => $this->Debitur_Model->data()
  			);
  			$this->load->view('admin/debitur/export',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}