<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna extends CI_Controller {

	private $filename = "import_data_petugas"; // Kita tentukan nama filenya
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengguna_Model');
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
			$data['pengguna']	= $this->Pengguna_Model->data();
			$data['konten']		= "admin/pengguna/index"	;
			$data['title'] 		= 'DATA PENGGUNA';
			$data['judul'] 		= 'Data Pengguna';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function tambah()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['pengguna']	= $this->Pengguna_Model->tambah();
			helper_log("add", "menambahkan data pengguna");
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
			redirect("pengguna");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['pengguna']	= $this->Pengguna_Model->edit($id);
			$data['konten']		= "admin/pengguna/edit";
			$data['title'] 		= 'EDIT DATA PENGGUNA';
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
			$this->Pengguna_Model->proses_edit($id);
			helper_log("edit", "merubah data pengguna");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function hapus($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Pengguna_Model->hapus($id);
			helper_log("hapus", "menghapus data petugas");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("pengguna");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>