<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Debitur_Model extends ci_Model
{
	
	public function data()
	{
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
		$this->db->join('petugas', 'petugas.kd_petugas = debitur.kd_petugas');
		$this->db->order_by('nama_debitur', 'ACS');
		return $this->db->get()->result();
	}

	public function hapus_all()
	{
		$this->db->empty_table('debitur');
	}

	public function edit($id)
	{
		$this->db->where("kd_credit",$id);
		return $this->db->get("debitur")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"kd_credit"			=>$this->input->post('kd_credit'),
		"no_cif"			=>$this->input->post('no_cif'),
		"no_spk"			=>$this->input->post('no_spk'),
		"nama_debitur"		=>$this->input->post('nama_debitur'),
		"alamat"			=>$this->input->post('alamat'),
		"desa"				=>$this->input->post('desa'),
		"kecamatan"			=>$this->input->post('kecamatan'),
		"wilayah"			=>$this->input->post('wilayah'),
		"metode_rps"		=>$this->input->post('metode_rps'),
		"jw"				=>$this->input->post('jw'),
		"rate"				=>$this->input->post('rate'),
		"noacc_droping"		=>$this->input->post('noacc_droping'),
		"telepon"			=>$this->input->post('telepon'),
		);
		$this->db->where("kd_credit",$id);
		return $this->db->update("debitur",$data);
	}

	public function hapus($id)
	{
		$this->db->where("kd_credit",$id);
		return $this->db->delete("debitur");
	}

	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->where('kd_credit', $id);
		return $this->db->get()->row();
	}
	public function tunggakan($id)
	{
		$this->db->select('*');
		$this->db->from('tunggakan');
		$this->db->where('kd_credit', $id);
		return $this->db->get()->row();
	}

	public function cetak()
	{
		$this->db->select('*');
		$this->db->from('debitur');
		return $this->db->get()->row();
	}
	public function cetak_tunggakan()
	{
		$this->db->select('*');
		$this->db->from('tunggakan');
		return $this->db->get()->row();
	}


	public function dataPerWilayah()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit=debitur.kd_credit');
		$this->db->join('petugas', 'petugas.kd_petugas=debitur.kd_petugas');
		$this->db->where("petugas.wilayah",$wilayah);
		$this->db->order_by('nama_debitur', 'ACS');
		return $this->db->get()->result();
	}
	public function dataPerAo()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->where("kd_petugas",$kd_petugas);
		$this->db->order_by('nama_debitur', 'ACS');
		return $this->db->get()->result();
	}


	public function pencarian_d($wilayah,$coll)
	{
		$this->db->join('tunggakan','tunggakan.kd_credit = debitur.kd_credit');
		$this->db->join('petugas', 'petugas.kd_petugas = debitur.kd_petugas');
	    $this->db->where("debitur.wilayah",$wilayah);
	    $this->db->where("call",$coll);
	    return $this->db->get("debitur")->result_array();
    }
}
?>