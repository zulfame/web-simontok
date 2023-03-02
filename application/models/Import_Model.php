<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Import_Model extends CI_Model
{

	public function insert($data)
	{
		$insert = $this->db->insert_batch('kmd', $data);
		if($insert)
		{
			return true;
		}
	}

	public function insert_debitur($data)
	{
		$insert = $this->db->insert_batch('debitur', $data);
		if($insert)
		{
			return true;
		}
	}
	public function insert_tunggakan2($data)
	{
		$insert = $this->db->insert_batch('tunggakan', $data);
		if($insert)
		{
			return true;
		}
	}
	public function insert_monitoring($data)
	{
		$insert = $this->db->insert_batch('monitoring', $data);
		if($insert)
		{
			return true;
		}
	}

	public function update_tunggakan($data)
	{
		$update = $this->db->update_batch('tunggakan', $data, 'kd_credit');
		if($update)
		{
			return true;
		}
	}

	public function update_st($data)
	{
		$update = $this->db->update_batch('surat_tugas', $data, 'id_st');
		if($update)
		{
			return true;
		}
	}

	public function insert_agunan($data)
	{
		$insert = $this->db->insert_batch('agunan', $data);
		if($insert)
		{
			return true;
		}
	}

	public function insert_petugas($data)
	{
		$insert = $this->db->insert_batch('petugas', $data);
		if($insert)
		{
			return true;
		}
	}
	public function update_petugas($data)
	{
		$update = $this->db->update_batch('petugas', $data, 'nip');
		if($update)
		{
			return true;
		}
	}

	public function getData()
	{
		$this->db->select('*');
		return $this->db->get('kmd')->result_array();
	}

}