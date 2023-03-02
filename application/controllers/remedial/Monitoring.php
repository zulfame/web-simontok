<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Monitoring extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RemedialModel');
		$this->load->model('Monitoring_Model');
		$this->load->model('Debitur_Model');
		$this->load->model('Petugas_Model');
		$this->load->model('Tugas_Model');
		$this->load->helper('rupiah_helper');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect($url);
        }
	}

	public function index()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$petugas 			= $this->input->get('petugas');
		    $coll 				= $this->input->get('coll');
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
		    $data['petugas']	= $this->Tugas_Model->dataPerWilayah();
		    $data['monitoring'] = $this->Monitoring_Model->pencarian_k($petugas,$coll);
			$data['konten']		= "remedial/monitoring/filter-monitoring";
			$data['title'] 		= 'Monitoring Debitur Remedial';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function data()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['monitoring'] = $this->RemedialModel->GetMonitoring();
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
			$data['konten']		= "remedial/monitoring/data-monitoring"	;
			$data['title'] 		= 'Monitoring Debitur Remedial';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function filter()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$petugas 			= $this->input->get('petugas');
		    $coll 				= $this->input->get('coll');
		    $data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
		    $data['petugas']	= $this->Tugas_Model->dataPerWilayah();
		    $data['monitoring'] = $this->Monitoring_Model->pencarian_k($petugas,$coll);
			$data['konten']		= "remedial/monitoring/data-monitoring";
			$data['title'] 		= 'Monitoring Debitur Remedial';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>