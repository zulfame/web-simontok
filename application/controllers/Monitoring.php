<?php defined('BASEPATH') or exit('No direct script access allowed');
class Monitoring extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Monitoring_Model');
		$this->load->model('Debitur_Model');
		$this->load->model('Petugas_Model');
		$this->load->model('Tugas_Model');
		$this->load->helper('rupiah_helper');
		if ($this->session->userdata('level') != TRUE) {
			$url = base_url();
			redirect($url);
		}
	}

	public function hapus_all()
	{
		if ($this->session->userdata('level') == 'Administrator') {
			$this->Monitoring_Model->hapus_all();
			helper_log("hapus", "menghapus semua data Monitoring");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Monitoring Berhasil di Hapus');
			redirect("config");
		} else {
			$this->load->view('templates/404.php');
		}
	}

	// QUERY FOR KKW
	public function data()
	{
		if ($this->session->userdata('level') == 'KKW' || $this->session->userdata('level') == 'Remedial') {
			$data['monitoring'] = $this->Monitoring_Model->getData();

			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
			$data['konten'] = "kkw/monitoring/data";
			$data['title'] = 'MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function histori($id)
	{
		if ($this->session->userdata('level') == 'KKW' || $this->session->userdata('level') == 'Remedial' || $this->session->userdata('level') == 'Administrator' || $this->session->userdata('level') == 'Direksi') {
			$data['debitur']	= $this->Monitoring_Model->getDataDebitur($id);
			$data['dataR']		= $this->Monitoring_Model->getDataRiwayat($id);
			$data['dataA']		= $this->Monitoring_Model->getDataAgunan($id);
			$data['konten']		= "kkw/monitoring/histori";
			$data['title'] = 'KARTU MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function cetak($id)
	{
		if ($this->session->userdata('level') == 'AO' || $this->session->userdata('level') == 'KKW') {
			$data['debitur']	= $this->Monitoring_Model->getDataDebitur($id);
			$data['dataR']		= $this->Monitoring_Model->getDataRiwayat($id);
			$data['dataA']		= $this->Monitoring_Model->getDataAgunan($id);
			$data['konten']		= "kkw/monitoring/print";
			$data['title'] 		= 'PRINT KARTU MONITORING';
			$this->load->view('templates/print', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function hapus($id)
	{
		if ($this->session->userdata('level') == 'KKW' || $this->session->userdata('level') == 'Remedial') {
			$this->Monitoring_Model->hapus($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("monitoring");
		} else {
			$this->load->view('templates/404.php');
		}
	}

	// QUERY FOR AO
	public function list()
	{
		if ($this->session->userdata('level') == 'AO') {
			$data['monitoring'] = $this->Monitoring_Model->getDataAo();
			//$data['debitur']=$this->Debitur_Model->dataPerWilayah();
			//$data['petugas']=$this->Petugas_Model->dataPerWilayah();
			$data['konten'] = "ao/monitoring/index";
			$data['title'] = 'MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function riwayat($id)
	{
		if ($this->session->userdata('level') == 'AO') {
			$data['debitur']	= $this->Monitoring_Model->getDataDebitur($id);
			$data['dataR']		= $this->Monitoring_Model->getDataRiwayat($id);
			$data['dataA']		= $this->Monitoring_Model->getDataAgunan($id);
			$data['konten']		= "ao/monitoring/riwayat";
			$data['title'] = 'KARTU MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}


	// QUERY FOR DIREKSI
	public function ao()
	{
		if ($this->session->userdata('level') == 'Direksi') {
			$data['konten']		= "direksi/laporan/kmd_ao";
			$data['title'] 		= 'KMD AO Kredit';
			//$data['petugas']	= $this->Petugas_Model->data();
			$data['petugas']	= $this->Monitoring_Model->getAOKredit();
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}

	public function remedial()
	{
		if ($this->session->userdata('level') == 'Direksi') {
			$data['konten']		= "direksi/laporan/kmd_remedial";
			$data['title'] 		= 'KMD Remdial';
			//$data['petugas']	= $this->Petugas_Model->data();
			$data['petugas']	= $this->Monitoring_Model->getRemedial();
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}

	public function report()
	{
		if ($this->session->userdata('level') == 'Direksi') {
			$data['monitoring'] = $this->Monitoring_Model->report();
			//$data['debitur']=$this->Debitur_Model->dataPerWilayah();
			//$data['petugas']=$this->Petugas_Model->dataPerWilayah();
			$data['konten'] = "direksi/laporan/kmd";
			$data['title'] = 'LAPORAN MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function detail($id)
	{
		if ($this->session->userdata('level') == 'Direksi') {
			$data['debitur']	= $this->Monitoring_Model->getDataDebitur($id);
			$data['dataR']		= $this->Monitoring_Model->getDataRiwayat($id);
			$data['dataA']		= $this->Monitoring_Model->getDataAgunan($id);
			$data['konten']		= "direksi/monitoring/riwayat";
			$data['title'] 		= 'KARTU MONITORING DEBITUR';
			$this->load->view('templates/main', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function print_out($id)
	{
		if ($this->session->userdata('level') == 'Direksi') {
			$data['debitur']	= $this->Monitoring_Model->getDataDebitur($id);
			$data['dataR']		= $this->Monitoring_Model->getDataRiwayat($id);
			$data['dataA']		= $this->Monitoring_Model->getDataAgunan($id);
			$data['konten']		= "direksi/monitoring/print";
			$data['title'] 		= 'PRINT KARTU MONITORING';
			$this->load->view('templates/print', $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}


	public function filter()
	{
		if ($this->session->userdata('level') == 'Administrator' || $this->session->userdata('level') == 'Direksi') {
			$wilayah 			= $this->input->get('wilayah');
			$petugas 			= $this->input->get('petugas');
			$coll 				= $this->input->get('coll');
			$data['petugas']	= $this->Monitoring_Model->getAOKredit();
			$data['monitoring'] = $this->Monitoring_Model->pencarian_d($wilayah, $petugas, $coll);
			$data['konten']		= "direksi/laporan/data_f_kmd";
			$data['title'] 		= 'LAPORAN MONITORING DEBITUR';
			$this->load->view("templates/main", $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function filter_r()
	{
		if ($this->session->userdata('level') == 'Administrator' || $this->session->userdata('level') == 'Direksi') {
			$petugas 			= $this->input->get('petugas');
			$coll 				= $this->input->get('coll');
			$data['petugas']	= $this->Monitoring_Model->getRemedial();
			$data['monitoring'] = $this->Monitoring_Model->pencarian_r($petugas, $coll);
			$data['konten']		= "direksi/laporan/data_f_kmd_remedial";
			$data['title'] 		= 'LAPORAN MONITORING DEBITUR';
			$this->load->view("templates/main", $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}

	public function pilih()
	{
		if ($this->session->userdata('level') == 'KKW' || $this->session->userdata('level') == 'Remedial') {
			$petugas 			= $this->input->get('petugas');
			$coll 				= $this->input->get('coll');
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['monitoring'] = $this->Monitoring_Model->pencarian_k($petugas, $coll);
			$data['konten']		= "kkw/monitoring/data_f_kmd";
			$data['title'] 		= 'LAPORAN MONITORING DEBITUR';
			$this->load->view("templates/main", $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
	public function debitur()
	{
		if ($this->session->userdata('level') == 'KKW' || $this->session->userdata('level') == 'Remedial') {
			$petugas 			= $this->input->get('petugas');
			$coll 				= $this->input->get('coll');
			//$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			//$data['no_surat']	= $this->Tugas_Model->generate();
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['monitoring'] = $this->Monitoring_Model->pencarian_k($petugas, $coll);
			$data['konten']		= "kkw/monitoring/index";
			$data['title'] 		= 'LAPORAN MONITORING DEBITUR';
			$this->load->view("templates/main", $data);
		} else {
			$this->load->view('templates/404.php');
		}
	}
}
