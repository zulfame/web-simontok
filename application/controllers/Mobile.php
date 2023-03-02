<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Mobile extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('rupiah_helper');
		$this->load->model('Dashboard_Model');
		$this->load->model('Tugas_Model');
		$this->load->model('Tunggakan_Model');
		$this->load->model('Debitur_Model');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect('login');
        }
	}

	public function dashboard()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['plafond']		= $this->Dashboard_Model->plafond3();
			$data['baki_debet']		= $this->Dashboard_Model->baki_debet3();
			$data['tgk_pokok']		= $this->Dashboard_Model->tgk_pokok3();
			$data['tgk_bunga']		= $this->Dashboard_Model->tgk_bunga3();
			$data['tgk_denda']		= $this->Dashboard_Model->tgk_denda3();
			$data['jml_debitur']		= $this->Dashboard_Model->debitur3();
			$data['log']			= $this->Dashboard_Model->log();

			$data['tugas']			=$this->Tugas_Model->dataAO();
			$data['petugas']		=$this->Tugas_Model->dataPerWilayah();
			$data['debitur']		=$this->Debitur_Model->dataPerWilayah();

			$data['jml_tugas']		=$this->Dashboard_Model->jmlTugas();
			$data['jml_tugas_done']	=$this->Dashboard_Model->jmlTugasDone();

			$data['konten'] 		= 'ao/dashboard';
			$data['title'] 			= 'Dashboard';

			$data['browser'] 		 = $this->agent->browser();
			$data['browser_version'] = $this->agent->version();
			$data['os'] 			 = $this->agent->platform();
			$data['ip_address'] 	 = $this->input->ip_address();

			$this->load->view('m_templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function debitur()
	{
		if($this->session->userdata('level')=='AO')
		{
			
			$data['debitur']	= $this->Debitur_Model->dataPerAo();
			$data['konten'] 	= 'ao/list-debitur';
			$data['title'] 		= 'List Debitur';
			$this->load->view('m_templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function detail($id)
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['debitur']	= $this->Debitur_Model->detail($id);
			$data['tunggakan']	= $this->Debitur_Model->tunggakan($id);
			$data['konten']		= "ao/debitur/detail";
			$data['title'] 		= 'DETAIL DEBITUR';
			$this->load->view('m_templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function tugas()
	{
		if($this->session->userdata('level')=='AO')
		{
			$data['tugas']	 = $this->Tugas_Model->dataAO();
			$data['debitur'] = $this->Debitur_Model->dataPerWilayah();
			$data['pegawai'] = $this->Tugas_Model->dataPerWilayah();
			$data['konten']	 = "ao/tugas";
			$data['title'] 	 = 'List Tugas';
			$this->load->view('m_templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function laporan($id)
    {
    	if($this->session->userdata('level')=='AO')
		{
			$data['laporan']	= $this->Tugas_Model->laporan($id);
			$data['konten']		= "ao/laporan-tugas";
			$data['title'] 		= 'Laporan Tugas';
			$this->load->view('m_templates/main',$data);
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
    			"lainnya2"		=> $this->input->post('lainnya2'),
    			"tgk_pokok"		=> $this->input->post('tgk_pokok'),
    			"tgk_bunga"		=> $this->input->post('tgk_bunga'),
    			"tgk_denda"		=> $this->input->post('tgk_denda')
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
    public function do_upload()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['max_width']            = 5000;
		$config['max_height']           = 5000;

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
}
?>