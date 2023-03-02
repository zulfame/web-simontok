<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tugas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
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

	// QUERY FOR KKW
	public function data()
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['tugas']		= $this->Tugas_Model->data();
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
			$data['konten']		= "kkw/tugas/index"	;
			$data['title'] 		= 'DATA SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function pilih()
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
		    $tgl 				= $this->input->get('tgl');
		    $data['tugas'] 		= $this->Tugas_Model->pencarian($tgl);
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['konten']		= "kkw/tugas/data_f_tugas";
			$data['title'] 		= 'DATA SURAT TUGAS';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function tambah()
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['tugas']=$this->Tugas_Model->tambah();
			helper_log("add", "membuat surat tugas penagihan");
			$this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Surat Tugas Berhasil di Buat');
			
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function cetak($id)
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['tugas']=$this->Tugas_Model->cetak($id);
			$data['debitur']=$this->Debitur_Model->dataPerWilayah();
			$data['petugas']=$this->Tugas_Model->dataPerWilayah();
			$data['tagihan']=$this->Tugas_Model->TotalTagihan($id);
			$data['konten']="kkw/tugas/print";
			$data['title'] = 'PRINT SURAT TUGAS';
			$this->load->view('templates/print',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['tugas']=$this->Tugas_Model->edit($id);
			$data['debitur']=$this->Debitur_Model->dataPerWilayah();
			$data['petugas']=$this->Tugas_Model->dataPerWilayah();
			$data['konten']="kkw/tugas/edit";
			$data['title'] = 'SIMONTOK - Edit Surat Tugas';
			$data['judul'] = 'Edit Surat Tugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_edit($id)
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$this->Tugas_Model->proses_edit($id);
			helper_log("edit", "merubah data surat tugas");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect("tugas/data");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function hapus($id)
	{	
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$this->Tugas_Model->hapus($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di hapus dari Database');
			redirect("tugas/data");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function catatan($id)
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$data['laporan']=$this->Tugas_Model->laporan($id);
			$data['konten']="kkw/tugas/catatan";
			$data['title'] = 'CATATAN SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_catatan($id)
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$this->Tugas_Model->proses_catatan($id);
			helper_log("edit", "memberikan catatan pada surat tugas");
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Berhasil memberikan catatan');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function cetak_daily()
	{
		if($this->session->userdata('level')=='KKW' || $this->session->userdata('level')=='Remedial')
		{
			$tgl 				= $this->input->get('tgl');
		    $data['tugas'] 		= $this->Tugas_Model->pencarian($tgl);
			$data['tugas']		= $this->Tugas_Model->data();
			$data['petugas']	= $this->Tugas_Model->dataPerWilayah();
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['no_surat']	= $this->Tugas_Model->generate();
			$data['konten']		= "kkw/tugas/cetak_daily";
			$data['title'] 		= 'DATA SURAT TUGAS';
			$this->load->view('templates/print',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	// QUERY FOR AO
	public function list()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['tugas']=$this->Tugas_Model->dataAO();
			$data['debitur']=$this->Debitur_Model->dataPerWilayah();
			$data['pegawai']=$this->Tugas_Model->dataPerWilayah();
			$data['konten']="ao/tugas/index"	;
			$data['title'] = 'LIST SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edita($id)
    {
    	if($this->session->userdata('level')=='AO')
		{
			$data['laporan']=$this->Tugas_Model->laporan($id);
			$data['konten']="ao/tugas/laporan";
			$data['title'] = 'LAPORAN SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
    }

    public function update()
    {
    	if($this->session->userdata('level')=='AO')
    	{
    		$id = $this->input->post('id');
    		$data = array(
    			"pelaksanaan"	=> $this->input->post('pelaksanaan'),
    			"hasil"			=> $this->input->post('hasil'),
    			"lainnya"		=> $this->input->post('lainnya'),
    			"lainnya2"		=> $this->input->post('lainnya2')
    		);

    		if (!empty($_FILES['image']['name'])) {
    			$image = $this->_do_upload();

    			$upload = $this->Tugas_Model->get_by_id($id);
    			if (file_exists('uploads/'.$upload->image) && $upload->image) {
    				unlink('uploads/'.$upload->image);
    			}

    			$data['image'] = $image;
    		}

    		$this->Tugas_Model->update($data, $id);
    		helper_log("edit", "mengisi laporan surat tugas");
    		$this->session->set_flashdata('msg_success', 'Berhasil di Simpan');
    		redirect($_SERVER['HTTP_REFERER']);
    	} else
    	{
    		$this->load->view('templates/404.php');
    	}
    }

	// QUERY FOR DIREKSI
	public function report()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['petugas']	= $this->Petugas_Model->data();
			$data['tugas']		= $this->Tugas_Model->report();
			$data['konten']		= "direksi/laporan/tugas"	;
			$data['title'] 		= 'LAPORAN SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function monitor($id)
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['laporan']=$this->Tugas_Model->laporan($id);
			$data['konten']="direksi/tugas/monitor";
			$data['title'] = 'MONITOR SURAT TUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function do_upload()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 7000;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000

		;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
			$this->load->view('ao/tugas/laporan', $data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}

    private function _do_upload()
    {
        $image_name = time().'-'.$_FILES["image"]['name'];

        $config['upload_path'] 		= 'uploads/';
        $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
        $config['max_size']         = 7000;
        $config['max_width']        = 5000;
        $config['max_height']       = 5000;
        $config['file_name'] 		= $image_name;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
            redirect($_SERVER['HTTP_REFERER']);
        }
        return $this->upload->data('file_name');
    }

    public function filter()
    {
    	if($this->session->userdata('level')=='Direksi')
    	{
    		$petugas 			= $this->input->get('petugas');
    		$tgl 				= $this->input->get('tgl');
    		$data['petugas']	= $this->Petugas_Model->data();
    		$data['tugas'] 		= $this->Tugas_Model->pencarian_st($petugas,$tgl);
    		$data['konten']		= "direksi/laporan/tugas_f";
    		$data['title'] 		= 'Laporan Surat Tugas';
    		$this->load->view("templates/main",$data);
    	} else
    	{
    		$this->load->view('templates/404.php');
    	}
    }




    public function mtugas()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['tugas']	 = $this->Tugas_Model->dataAO();
			$data['debitur'] = $this->Debitur_Model->dataPerWilayah();
			$data['pegawai'] = $this->Tugas_Model->dataPerWilayah();
			$data['konten']	 = "mobile/tugas";
			$data['title'] 	 = 'List Tugas';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function mlaporan($id)
    {
    	if($this->session->userdata('level')=='AO')
		{
			$data['laporan']	= $this->Tugas_Model->laporan($id);
			$data['konten']		= "mobile/laporan-tugas";
			$data['title'] 		= 'Laporan Tugas';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
    }

    public function mupdate()
    {
    	if($this->session->userdata('level')=='AO')
    	{
    		$id = $this->input->post('id');
    		$data = array(
    			"pelaksanaan"	=> $this->input->post('pelaksanaan'),
    			"hasil"			=> $this->input->post('hasil'),
    			"lainnya"		=> $this->input->post('lainnya'),
    			"lainnya2"		=> $this->input->post('lainnya2'),
    		);

    		if (!empty($_FILES['image']['name'])) {
    			$image = $this->_do_upload();

    			$upload = $this->Tugas_Model->get_by_id($id);
    			if (file_exists('uploads/'.$upload->image) && $upload->image) {
    				unlink('uploads/'.$upload->image);
    			}

    			$data['image'] = $image;
    		}

    		$this->Tugas_Model->update($data, $id);
    		helper_log("edit", "mengisi laporan surat tugas");
    		$this->session->set_flashdata('msg_success', 'Berhasil di Simpan');
    		redirect($_SERVER['HTTP_REFERER']);
    	} else
    	{
    		$this->load->view('templates/404.php');
    	}
    }

}
?>