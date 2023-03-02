<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tugas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RemedialModel');
		$this->load->model('Tugas_Model');
		$this->load->model('Debitur_Model');
		$this->load->model('Petugas_Model');
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
			$data['tugas']		= $this->RemedialModel->GetSuratTugas();
			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['no_surat']	= $this->RemedialModel->generate();
			$data['konten']		= "remedial/surat-tugas/data-tugas"	;
			$data['title'] 		= 'Data Surat Tugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	
	public function data()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['tugas']		= $this->RemedialModel->GetSuratTugasToday();
			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['no_surat']	= $this->RemedialModel->generate();
			$data['konten']		= "remedial/surat-tugas/data-tugas"	;
			$data['title'] 		= 'Data Surat Tugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function cetak($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['tugas']		= $this->RemedialModel->CetakSuratTugas($id);
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['konten']		= "remedial/surat-tugas/cetak-tugas";
			$data['title'] 		= 'Cetak Surat Tugas';
			$this->load->view('templates/print',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function catatan($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['laporan']	= $this->RemedialModel->CatatanTugas($id);
			$data['konten']		= "remedial/surat-tugas/catatan-tugas";
			$data['title'] 		= 'Catatan Surat Tugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_catatan($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$this->RemedialModel->ProsesCatatanTugas($id);
			helper_log("edit", "memberikan catatan pada surat tugas");
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Berhasil memberikan catatan');
			redirect("remedial/tugas");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function edit($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['tugas']		= $this->RemedialModel->EditTugas($id);
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['konten']		= "remedial/surat-tugas/edit-tugas";
			$data['title'] 		= 'Edit Surat Tugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_edit($id)
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$this->RemedialModel->ProsesEditTugas($id);
			helper_log("edit", "merubah data surat tugas");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect("remedial/tugas");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['tugas']	= $this->RemedialModel->TambahTugas();
			helper_log("add", "membuat surat tugas penagihan");
			$this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Surat Tugas Berhasil di Buat');
			
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function cetak_harian()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$tgl 				= $this->input->get('tgl');
		    $data['tugas'] 		= $this->RemedialModel->CetakSuratTugas($tgl);
			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['no_surat']	= $this->RemedialModel->generate();
			$data['konten']		= "remedial/surat-tugas/cetak-harian-tugas";
			$data['title'] 		= 'Cetak Tugas Hari Ini';
			$this->load->view('templates/print',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function filter()
	{
		if($this->session->userdata('level')=='Remedial')
		{
		    $tgl 				= $this->input->get('tgl');
		    $data['tugas'] 		= $this->RemedialModel->PencarianTugas($tgl);

			$data['petugas']	= $this->RemedialModel->GetPetugas();
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['no_surat']	= $this->RemedialModel->generate();

			$data['konten']		= "remedial/surat-tugas/filter-tugas";
			$data['title'] 		= 'Filter Surat Tugas';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>