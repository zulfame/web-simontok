<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Petugas_Model extends ci_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function data()
	{
		$this->db->select('*');
		$this->db->from('petugas');
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}

	public function dataPerWilayah()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where("wilayah",$wilayah);
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}
	
	public function tambah()
	{
		$data=array(
		"nip"			=> $this->input->post('nip'),
		"kd_petugas"	=> $this->input->post('kd_petugas'),
		"nama"			=> $this->input->post('nama'),
		"posisi"		=> $this->input->post('posisi'),
		"wilayah"		=> $this->input->post('wilayah'),
		"username"		=> $this->input->post('nip'),
		'date_created' 	=> time()
		);
		$this->db->insert("petugas",$data);
	}

	public function edit($id)
	{
		$this->db->where("nip",$id);
		return $this->db->get("petugas")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"nip"			=> $this->input->post('nip'),
		"kd_petugas"	=> $this->input->post('kd_petugas'),
		"nama"			=> $this->input->post('nama'),
		"posisi"		=> $this->input->post('posisi'),
		"wilayah"		=> $this->input->post('wilayah'),
		"username"		=> $this->input->post('user'),
		);
		$this->db->where("nip",$id);
		return $this->db->update("petugas",$data);
	}

	public function hapus($id)
	{
		$this->db->where("nip",$id);
		return $this->db->delete("petugas");
	}


	// Fungsi untuk melakukan proses upload file
	public function upload_file($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] 		= './excel/';
		$config['allowed_types']	= 'xlsx';
		$config['max_size']			= '2048';
		$config['overwrite'] 		= true;
		$config['file_name'] 		= $filename;
	
		$this->upload->initialize($config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array
			(
				'result'	=> 'success',
				'file'		=> $this->upload->data(),
				'error'		=> ''
			);
			return $return;
		}else{
			// Jika gagal :
			$return = array
			(
				'result'	=> 'failed',
				'file'		=> '',
				'error'		=> $this->upload->display_errors()
			);
			return $return;
		}
	}
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function insert_multiple($data)
	{
		$this->db->insert_batch('petugas', $data);
	}
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function update_multiple($data)
	{
		$this->db->update_batch('petugas', $data, 'nip');
	}

}
?>