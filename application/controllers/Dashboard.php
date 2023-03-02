<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('rupiah_helper');
		$this->load->model('Dashboard_Model');
		$this->load->model('Tugas_Model');
		$this->load->model('Debitur_Model');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect('login');
        }
	}

	public function index()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='Direksi')
		{
			//$data['jml_pegawai']	=$this->Dashboard_Model->dataPegawai();
			//$data['jml_agunan']		=$this->Dashboard_Model->dataAgunan();
			//$data['jml_debitur']	=$this->Dashboard_Model->dataDebitur();
			//$data['jml_monitoring']	=$this->Dashboard_Model->dataMonitoring();
			$data['plafond']		= $this->Dashboard_Model->plafond();
			$data['baki_debet']		= $this->Dashboard_Model->baki_debet();
			$data['tgk_pokok']		= $this->Dashboard_Model->tgk_pokok();
			$data['tgk_bunga']		= $this->Dashboard_Model->tgk_bunga();
			$data['tgk_denda']		= $this->Dashboard_Model->tgk_denda();
			$data['debitur']		= $this->Dashboard_Model->debitur();
			$data['log']			= $this->Dashboard_Model->log();
			$data['konten']			= "admin/dashboard";
			$data['title'] 			= 'DASHBOARD';

			$data['tugas']				= $this->Tugas_Model->dataAll();
			$data['browser'] 			= $this->agent->browser();
			$data['browser_version'] 	= $this->agent->version();
			$data['os'] 				= $this->agent->platform();
			$data['ip_address'] 		= $this->input->ip_address();
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function ksk()
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data['plafond']		= $this->Dashboard_Model->plafond2();
			$data['baki_debet']		= $this->Dashboard_Model->baki_debet2();
			$data['tgk_pokok']		= $this->Dashboard_Model->tgk_pokok2();
			$data['tgk_bunga']		= $this->Dashboard_Model->tgk_bunga2();
			$data['tgk_denda']		= $this->Dashboard_Model->tgk_denda2();
			$data['jml_debitur']	= $this->Dashboard_Model->debitur2();
			$data['log']			= $this->Dashboard_Model->log();

			$data['tugas']			= $this->Tugas_Model->dataToday();
			$data['petugas']		= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']		= $this->Debitur_Model->dataPerWilayah();

			$data['jml_tugas']		= $this->Dashboard_Model->jmlTugas();
			$data['jml_tugas_done']	= $this->Dashboard_Model->jmlTugasDone();

			$data['konten']			= "kkw/dashboard";
			$data['title'] 			= 'DASHBOARD';

			$data['browser'] 			= $this->agent->browser();
			$data['browser_version'] 	= $this->agent->version();
			$data['os'] 				= $this->agent->platform();
			$data['ip_address'] 		= $this->input->ip_address();
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function ao()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['plafond']		= $this->Dashboard_Model->plafond3();
			$data['baki_debet']		= $this->Dashboard_Model->baki_debet3();
			$data['tgk_pokok']		= $this->Dashboard_Model->tgk_pokok3();
			$data['tgk_bunga']		= $this->Dashboard_Model->tgk_bunga3();
			$data['tgk_denda']		= $this->Dashboard_Model->tgk_denda3();
			$data['jml_debitur']	= $this->Dashboard_Model->debitur3();
			$data['log']			= $this->Dashboard_Model->log();

			$data['tugas']			= $this->Tugas_Model->dataAO();
			$data['petugas']		= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']		= $this->Debitur_Model->dataPerWilayah();

			$data['jml_tugas']		= $this->Dashboard_Model->jmlTugas();
			$data['jml_tugas_done']	= $this->Dashboard_Model->jmlTugasDone();

			$data['konten'] 		= 'mobile/dashboard';
			$data['title'] 			= 'Dashboard';

			$data['browser'] 		 = $this->agent->browser();
			$data['browser_version'] = $this->agent->version();
			$data['os'] 			 = $this->agent->platform();
			$data['ip_address'] 	 = $this->input->ip_address();

			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function remedial()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['konten']			 = 'remedial/dashboard';
			$data['title'] 			 = 'Dashboard Remedial';

			$data['browser'] 		 = $this->agent->browser();
			$data['browser_version'] = $this->agent->version();
			$data['os'] 			 = $this->agent->platform();
			$data['ip_address'] 	 = $this->input->ip_address();

			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
}
?>