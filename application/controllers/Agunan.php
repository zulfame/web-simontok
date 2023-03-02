<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 ***************************************************
 * SIMONTOK (SISTEM MONITORING KREDIT) v1.0. 2022  *
 ***************************************************
 * Dikembangkan oleh : Zulfadli Rizal              *
 * Email 	: zulfadlirizal@gmail.com              *
 * Facebook	: https://fb.com/zulfames      		   *
 * Website	: https://antiskill.com                *
 * Telegram : 0823-200-999-71					   *
 * *************************************************
 */
class Agunan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Agunan_Model');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect($url);
        }
	}
	
	// QUERY FOR ADMIN
	public function index()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['agunan']=$this->Agunan_Model->data();
			$data['konten']="admin/agunan/index"	;
			$data['title'] = 'DATA AGUNAN';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function hapus_all()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Agunan_Model->hapus_all();
			helper_log("hapus", "menghapus semua data agunan");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Agunan Berhasil di Hapus');
			redirect("config");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['agunan']=$this->Agunan_Model->edit($id);
			$data['konten']="admin/agunan/edit";
			$data['title'] = 'EDIT DATA AGUNAN';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Agunan_Model->proses_edit($id);
			helper_log("edit", "merubah data agunan");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect("agunan");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function hapus($id)
	{	
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Agunan_Model->hapus($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("agunan");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	// QUERY FOR DIREKSI
	public function all()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['agunan']=$this->Agunan_Model->data();
			$data['konten']="direksi/agunan/index"	;
			$data['title'] = 'DATA AGUNAN';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>