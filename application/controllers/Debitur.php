<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Debitur extends CI_Controller {
	private $filename = "import_data_debitur"; // Kita tentukan nama filenya
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Debitur_Model');
		$this->load->model('RemedialModel');
		$this->load->helper('rupiah_helper');
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
			$data['debitur']	= $this->Debitur_Model->data();
			$data['konten']		= "admin/debitur/index"	;
			$data['title'] 		= 'DATA DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['debitur']=$this->Debitur_Model->edit($id);
			$data['konten']="admin/debitur/edit";
			$data['title'] = 'EDIT DATA DEBITUR';
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
			$this->Debitur_Model->proses_edit($id);
			helper_log("edit", "merubah data debitur");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect("debitur");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function detail($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "admin/debitur/detail";
			$data['title'] 		= 'DETAIL DATA DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function hapus($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Debitur_Model->hapus($id);
			helper_log("hapus", "menghapus data debitur");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("debitur");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function cetak()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='KKW')
		{
			$data['debitur']	= $this->Debitur_Model->cetak();
			$data['tunggakan']	= $this->Debitur_Model->cetak_tunggakan();
			$data['konten']		= "admin/debitur/print";
			$data['title'] 		= 'PRINT DATA DEBITUR';
			$this->load->view('templates/print',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function hapus_all()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Debitur_Model->hapus_all();
			helper_log("hapus", "menghapus semua data debitur");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Debitur Berhasil di Hapus');
			redirect("config");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	
	// QUERRY FOR DIREKSI
	public function all()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['debitur']	= $this->Debitur_Model->data();
			$data['konten']		= "direksi/debitur/index";
			$data['title'] 		= 'DATA DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
		
	}
	public function tampil($id)
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "direksi/debitur/detail";
			$data['title'] 		= 'DETAIL DATA DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	// QUERY FOR KKW
	public function data()
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data['debitur']	= $this->Debitur_Model->dataPerWilayah();
			$data['konten']		= "kkw/debitur/index"	;
			$data['title'] 		= 'LIST DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
		
	}
	public function details($id)
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "kkw/debitur/detail";
			$data['title'] 		= 'DETAIL DEBITUR';
			$this->load->view('templates/main',$data);
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
			$data['debitur']	= $this->Debitur_Model->dataPerAo();
			$data['konten']		= "ao/debitur/index"	;
			$data['title'] 		= 'LIST DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
		
	}
	public function lihat($id)
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "ao/debitur/detail";
			$data['title'] 		= 'DETAIL DEBITUR';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}


	public function filter()
	{
		if($this->session->userdata('level')=='Administrator' || $this->session->userdata('level')=='Direksi')
		{
			$wilayah 			= $this->input->get('wilayah');
		    $coll 				= $this->input->get('coll');
		    $data['debitur'] 	= $this->Debitur_Model->pencarian_d($wilayah,$coll);
			$data['konten']		= "admin/debitur/data";
			$data['title'] 		= 'DATA DEBITUR';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	
	public function mdebitur()
	{
		if($this->session->userdata('level')=='AO')
		{
			
			$data['debitur']	= $this->Debitur_Model->dataPerAo();
			$data['konten'] 	= 'mobile/list-debitur';
			$data['title'] 		= 'List Debitur';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function mdetail($id)
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "mobile/list-detail";
			$data['title'] 		= 'Detail Debitur';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}




	// QUERY FOR REMEDIAL
	public function DataRemedial()
	{
		if($this->session->userdata('level')=='Remedial')
		{
			$data['debitur']	= $this->RemedialModel->GetDebitur();
			$data['konten']		= "remedial/debitur/data-debitur"	;
			$data['title'] 		= 'Data Debitur Remedial';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
		
	}

}
?>