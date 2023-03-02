<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Debitur extends CI_Controller {
	private $filename = "import_data_debitur"; // Kita tentukan nama filenya
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RemedialModel');
		$this->load->model('Debitur_Model');
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
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['konten']		= "remedial/debitur/data-debitur"	;
			$data['title'] 		= 'Data Debitur Remedial';
			$this->load->view('templates/main',$data);
		}
		else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function detail($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['debitur']	= $this->RemedialModel->detail($id);
			$data['tunggakan']	= $this->RemedialModel->tunggakan($id);
			$data['konten']		= "remedial/debitur/detail-debitur";
			$data['title'] 		= 'Detail Data Debitur';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>