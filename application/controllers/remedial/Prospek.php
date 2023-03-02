<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Prospek extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RemedialModel');
		$this->load->model('Prospek_Model');
		$this->load->model('Petugas_Model');
		$this->load->model('Pengguna_Model');
	}
	
	public function index()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['prospek']	= $this->RemedialModel->GetProspekKSR();
			$data['konten']		= "remedial/prospek/data-prospek";
			$data['title'] 		= 'Prospek Kepela Seksi Remedial';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}

	public function tambah()
	{
		$id = $this->session->userdata('id');
		$data = array(
			"idpengguna"		=>$id,
			"tgl"				=>date('Y-m-d'),
			"prospek"			=>$this->input->post('plan'),
			"keterangan"		=>$this->input->post('target'),
		);

		$this->RemedialModel->TambahProspekKSR($data);
		helper_log("tambah", "menambah data prospek");
		$this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
		redirect("remedial/prospek");
	}

	public function edit()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$id = $this->input->post('id');
			$data = array(
				'prospek' 		 => $this->input->post('plan'),
				'keterangan'	 => $this->input->post('target'),
			);
			$this->RemedialModel->EditProspekKSR($data,$id);
			helper_log("edit", "merubah data prospek");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect('remedial/prospek');
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function hapus($id)
	{	
		if($this->session->userdata('level')=='Remedial')
		{
			$this->RemedialModel->HapusProspek($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("remedial/prospek");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	// Prospek Staff
	public function staff()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['prospek']	= $this->RemedialModel->GetProspekStaff();
			$data['konten']		= "remedial/prospek/data-prospek-staff";
			$data['title'] 		= 'Prospek Staff Remedial';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}
	}
	public function hapus_staff($id)
	{	
		if($this->session->userdata('level')=='Remedial')
		{
			$this->RemedialModel->HapusProspek($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("remedial/prospek/staff");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>