<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Prospek extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Prospek_Model');
		$this->load->model('Petugas_Model');
		$this->load->model('Pengguna_Model');
	}
	

	// access for ao
	public function list()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['prospek']	= $this->Prospek_Model->Get();
			$data['konten']		= "ao/prospek/data";
			$data['title'] 		= 'Prospek Petugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}
	public function tambah()
	{
		$id = $this->session->userdata('nip');
		$data = array(
			"idpengguna"		=>$id,
			"tgl"				=>date('Y-m-d'),
			"prospek"			=>$this->input->post('prospek'),
			"calon_debitur"		=>$this->input->post('debitur'),
			"keterangan"		=>$this->input->post('keterangan'),
			"no_hp"				=>$this->input->post('no_hp'),
			"image"				=>$this->input->post('image'),
		);

		if (!empty($_FILES['image']['name'])) {
			$image = $this->_do_upload();
			$data['image'] = $image;
		}

		$this->Prospek_Model->Add($data);
		helper_log("tambah", "menambah data prospek");
		$this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
		redirect("prospek/list");
	}
	public function ubah()
	{
		$id = $this->input->post('id');
		$data = array(
			'prospek' 		 => $this->input->post('prospek'),
			'calon_debitur'  => $this->input->post('debitur'),
			'keterangan'	 => $this->input->post('keterangan'),
			'no_hp'			 => $this->input->post('nohp'),
		);
		$this->Prospek_Model->ubah($data,$id);
		helper_log("edit", "merubah data prospek");
		$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
		redirect('prospek/list');
	}
	public function hapus($id)
	{	
		if($this->session->userdata('level')=='AO')
		{
			$this->Prospek_Model->hapus($id);
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("prospek/list");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}


	// access for kkw
	public function data()
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data['prospek']	= $this->Prospek_Model->GetData();
			$data['konten']		= "kkw/prospek/data";
			$data['title'] 		= 'Prospek Petugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}
	public function ksk()
	{
		if($this->session->userdata('level')=='KKW')
		{
			$data['prospek']	= $this->Prospek_Model->GetDataKsk();
			$data['konten']		= "kkw/prospek/data_ksk";
			$data['title'] 		= 'Prospek KSK';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}


	// access for direksi
	public function report_ao()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['prospek']	= $this->Prospek_Model->ProspekAO();
			$data['petugas']	= $this->Petugas_Model->data();
			$data['konten']		= "direksi/prospek/data_ao";
			$data['title'] 		= 'Laporan Prospek Petugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}
	public function report_ksk()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['ksk']		= $this->Pengguna_Model->dataKsk();
			$data['prospek']	= $this->Prospek_Model->ProspekKsk();
			$data['konten']		= "direksi/prospek/data_ksk";
			$data['title'] 		= 'Laporan Prospek KSK';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}


	public function update()
	{
		$id = $this->input->post('id');
		$data = array(
			"nama_jenis"	=>$this->input->post('jenis'),
			"image"			=>$this->input->post('image'),
		);

		if (!empty($_FILES['image']['name'])) {
			$image = $this->_do_upload();

			$upload = $this->Prospek_Model->GetID($id);
			if (file_exists('uploads/prospek/'.$upload->image) && $upload->image) {
				unlink('uploads/prospek/'.$upload->image);
			}

			$data['image'] = $image;
		}

		$this->Prospek_Model->update($data, $id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	// query uploads
	public function do_upload()
	{
		$config['upload_path']          = './uploads/prospek/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
			$this->load->view('kkw/prospek/add', $data);
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

        $config['upload_path'] 		= 'uploads/prospek/';
        $config['allowed_types'] 	= 'gif|jpg|png';
        $config['max_size']         = 5000;
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


    public function pilih()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$petugas 			= $this->input->get('petugas');
		    $tgl 				= $this->input->get('tgl');
			$data['petugas']	= $this->Petugas_Model->data();
		    $data['prospek'] 	= $this->Prospek_Model->pencarian_p($petugas,$tgl);
			$data['konten']		= "direksi/prospek/data_f_ao";
			$data['title'] 		= 'Laporan Prospek Petugas';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function filter()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$ksk 				= $this->input->get('ksk');
		    $tgl 				= $this->input->get('tgl');
			$data['ksk']		= $this->Pengguna_Model->dataKsk();
		    $data['prospek'] 	= $this->Prospek_Model->pencarian_k($ksk,$tgl);
			$data['konten']		= "direksi/prospek/data_f_ksk";
			$data['title'] 		= 'Laporan Prospek KSK';
		    $this->load->view("templates/main",$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}



	public function mprospek()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['prospek']	= $this->Prospek_Model->Get();
			$data['konten']		= "mobile/list-prospek";
			$data['title'] 		= 'List Prospek';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}
    public function mdetail($id)
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['prospek']	= $this->Prospek_Model->mdetail($id);
			$data['konten']		= "mobile/detail-prospek";
			$data['title'] 		= 'Detail Prospek';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function mproses($id)
	{
		if($this->session->userdata('level')=='AO')
		{
			$this->Prospek_Model->mproses($id);
			helper_log("edit", "mengisi laporan surat tugas");
			$this->session->set_flashdata('msg_success', 'Berhasil di Simpan');
			redirect($_SERVER['HTTP_REFERER']);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function mtambah()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['konten']		= "mobile/tambah-prospek";
			$data['title'] 		= 'Tambah Prospek';
			$this->load->view('mtemplates/main',$data);
		} else
		{
			$this->load->view('templates/main',$data);
		}	
	}
	public function mproses_tambah()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['prospek']	= $this->Prospek_Model->mproses_tambah();
			helper_log("add", "menambahkan data prospek");
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
			redirect("prospek/mprospek");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	
	
	
	
	 public function index()
    {
        if ($this->session->userdata('level') == 'KKW') {
            $data['prospek']    = $this->Prospek_Model->GetDataKsk();
            $data['konten']        = "kkw/prospek/data_ksk";
            $data['title']         = 'Prospek KSK';
            $this->load->view('templates/main', $data);
        } else {
            $this->load->view('templates/main', $data);
        }
    }
    public function tambah_ksk()
    {
        $id = $this->session->userdata('id');
        $data = array(
            "idpengguna"        => $id,
            "tgl"                => date('Y-m-d'),
            "prospek"            => $this->input->post('plan'),
            "keterangan"        => $this->input->post('target'),
        );

        $this->Prospek_Model->Add($data);
        helper_log("tambah", "menambah data prospek");
        $this->session->set_flashdata('tambah', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
        redirect("prospek");
    }
    public function ubah_ksk()
    {
        if ($this->session->userdata('level') == 'KKW') {
            $id = $this->input->post('id');
            $data = array(
                'prospek'          => $this->input->post('plan'),
                'keterangan'     => $this->input->post('target'),
            );
            $this->Prospek_Model->ubah($data, $id);
            helper_log("edit", "merubah data prospek");
            $this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
            redirect('prospek');
        } else {
            $this->load->view('templates/404.php');
        }
    }
    public function hapus_ksk($id)
    {
        if ($this->session->userdata('level') == 'KKW') {
            $this->Prospek_Model->hapus($id);
            $this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
            redirect("prospek");
        } else {
            $this->load->view('templates/404.php');
        }
    }

}
?>