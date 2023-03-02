<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Agunan_Model extends ci_Model
{

	public function data()
	{
		$this->db->select('*');
		$this->db->from('agunan');
		$this->db->join('debitur','debitur.no_cif = agunan.idagunan');      
		return $this->db->get()->result();;
	}
	public function hapus_all()
	{
		$this->db->empty_table('agunan');
	}

	public function edit($id)
	{
		$this->db->where("idagunan",$id);
		return $this->db->get("agunan")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"lokasi"	=>$this->input->post('lokasi'),
		"agunan"	=>$this->input->post('agunan'),
		);
		$this->db->where("idagunan",$id);
		return $this->db->update("agunan",$data);
	}

	public function hapus($id)
	{
		$this->db->where("idagunan",$id);
		return $this->db->delete("agunan");
	}

}
?>