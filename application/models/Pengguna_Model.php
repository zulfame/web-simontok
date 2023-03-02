<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pengguna_Model extends ci_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function data()
	{
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}

	public function dataKsk()
	{
		$ksk = 'Kepala Seksi Kredit';
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->where('jabatan', $ksk);
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}
	
	public function tambah()
	{
		$pass = $this->input->post('user');
		$data=array(
		"nama"			=> $this->input->post('nama'),
		"jabatan"		=> $this->input->post('jabatan'),
		"wilayah"		=> $this->input->post('wilayah'),
		"username"		=> $this->input->post('user'),
		"password"		=> md5($pass),
		"level"			=> $this->input->post('level'),
		'date_created' 	=> time()
		);
		$this->db->insert("pengguna",$data);
	}

	public function edit($id)
	{
		$this->db->where("id",$id);
		return $this->db->get("pengguna")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"nama"			=> $this->input->post('nama'),
		"jabatan"		=> $this->input->post('jabatan'),
		"wilayah"		=> $this->input->post('wilayah'),
		"username"		=> $this->input->post('user'),
		"level"			=> $this->input->post('level'),
		);
		$this->db->where("id",$id);
		return $this->db->update("pengguna",$data);
	}

	public function hapus($id)
	{
		$this->db->where("id",$id);
		return $this->db->delete("pengguna");
	}


}
?>