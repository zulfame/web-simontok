<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Config_Model extends ci_Model 
{
	
	public function dataDebitur()
	{
		return $this->db->query("SELECT COUNT(kd_credit) AS hasil FROM debitur")->result();
	}

	public function update($data, $id)
	{
		$this->db->where("id",$id);
		$this->db->update("pengguna",$data);
		return $this->db->affected_rows();
	}
	public function ubah($data, $id)
	{
		$this->db->where("nip",$id);
		$this->db->update("petugas",$data);
		return $this->db->affected_rows();
	}
	public function waktu()
	{
		$this->db->select('*');
		$this->db->from('waktu');
		return $this->db->get()->result_array();
	}

	function ubah_waktu($data, $id)
	{
		$this->db->where('idwaktu',$id);
		$this->db->update('waktu', $data);
		return TRUE;
	}



	public function GetWaktu($id)
	{
		$this->db->where("idwaktu",$id);
		return $this->db->get("waktu")->row();
	}
	public function proses_tanggal($id)
	{
		$data=array(
		"tgl_awal"			=> $this->input->post('tgl_awal'),
		"tgl_akhir"			=> $this->input->post('tgl_akhir'),
		);
		$this->db->where("idwaktu",$id);
		return $this->db->update("waktu",$data);
	}
}
?>