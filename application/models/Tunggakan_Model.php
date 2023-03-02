<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tunggakan_Model extends ci_Model
{

	public function data()
	{
		$this->db->select('*');
		$this->db->from('tunggakan');
		$this->db->join('debitur','debitur.kd_credit = tunggakan.kd_credit');      
		return $this->db->get()->result();;
	}

	public function hapus_all()
	{
		$this->db->empty_table('tunggakan');
	}

	public function edit($id)
	{
		$this->db->where("id",$id);
		return $this->db->get("kmd_agunan")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"agunan"	=>$this->input->post('agunan'),
		);
		$this->db->where("id",$id);
		return $this->db->update("kmd_agunan",$data);
	}

	public function hapus($id)
	{
		$this->db->where("id",$id);
		return $this->db->delete("kmd_agunan");
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
		$this->db->insert_batch('tunggakan', $data);
	}
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function update_multiple($data)
	{
		$this->db->update_batch('tunggakan', $data, 'kd_credit');
	}
	// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
	public function update_debitur($data_d)
	{
		$this->db->update_batch('debitur', $data_d, 'kd_credit');
	}
}
?>