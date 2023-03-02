<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Config extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Config_Model');
		$this->load->model('Dashboard_Model');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect('login');
        }
	}

	public function index()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['waktu']			= $this->Config_Model->waktu();
			$data['debitur']		= $this->Dashboard_Model->debitur();
			$data['konten']			= "admin/config/index";
			$data['title'] 			= 'CONFIG DATA MASTER';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function profil()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['konten']			= "templates/profil";
			$data['title'] 			= 'EDIT PROFIL';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function save()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='KKW')
		{
			$id   = $this->session->userdata('id');
			$pass = $this->input->post('pass');
			$data = array(
				'nama' 		 => $this->input->post('nama'),
				'password'	 => md5($pass),
			);
			$this->Config_Model->update($data,$id);
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah, Logout dan Login kembali untuk menerapkan perubahan');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function profile()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['konten']			= "templates/profil2";
			$data['title'] 			= 'EDIT PROFIL';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function save2()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='AO')
		{
			$id   = $this->session->userdata('id');
			$pass = $this->input->post('pass');
			$data = array(
				'nama' 		 => $this->input->post('nama'),
				'password'	 => md5($pass),
			);
			$this->Config_Model->update($data,$id);
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah, Logout dan Login kembali untuk menerapkan perubahan');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function ubah_waktu()
	{
		$id = $this->input->post('id');
		$data = array(
			'tgl_awal' 		 => $this->input->post('tgl_awal'),
			'tgl_akhir' 	 => $this->input->post('tgl_akhir'),
		);
		$this->Config_Model->ubah_waktu($data,$id);
		$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_tanggal($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['waktu']	= $this->Config_Model->GetWaktu($id);
			$data['konten']		= "admin/config/edit-tanggal";
			$data['title'] 		= 'Edit Interval Waktu';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_tanggal($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Config_Model->proses_tanggal($id);
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Waktu Berhasil di Ubah');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}


}
?>