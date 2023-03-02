<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Prospek_Model extends ci_Model
{
	
	public function Get()
	{
		$id = $this->session->userdata('nip');
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
		$this->db->where('prospek.idpengguna', $id);
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}

	public function GetData()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
		$this->db->where('petugas.wilayah', $wilayah);
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}

	public function GetDataKsk()
	{
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('pengguna', 'pengguna.id=prospek.idpengguna');
		$this->db->where('prospek.idpengguna', $id);
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}

	public function ProspekAO()
	{
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}

	public function ProspekKsk()
	{
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('pengguna', 'pengguna.id=prospek.idpengguna');
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}

	public function mdetail($id)
	{
		$this->db->where("idprospek",$id);
		return $this->db->get("prospek")->row();
	}

	public function update($data, $id)
	{
		$this->db->where("idjenis",$id);
		$this->db->update("jenis",$data);
		return $this->db->affected_rows();
	}

	public function Add($data)
	{

		$this->db->insert("prospek",$data);
	}

	public function Delete($id)
	{
		$this->db->where("idjenis",$id);
		return $this->db->delete("jenis");
	}

	// percobaan edit menggunakan modal
	function ubah($data, $id)
	{
		$this->db->where('idprospek',$id);
		$this->db->update('prospek', $data);
		return TRUE;
	}

	public function hapus($id)
	{
		$this->db->where("idprospek",$id);
		return $this->db->delete("prospek");
	}

	public function pencarian_p($petugas,$tgl)
	{
		if ($petugas == "")
		{
			$this->db->select('*');
			$this->db->from('prospek');
			$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
		    $this->db->where("prospek.tgl",$tgl);
			$this->db->order_by('prospek.tgl', 'DESC');
			return $this->db->get()->result_array();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('prospek');
			$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
			$this->db->where("prospek.idpengguna",$petugas);
		    $this->db->where("prospek.idpengguna",$petugas);
		    $this->db->where("prospek.tgl",$tgl);
			$this->db->order_by('prospek.tgl', 'DESC');
			return $this->db->get()->result_array();
		}
    }

    public function pencarian_k($ksk,$tgl)
	{
		if ($ksk == "")
		{
			$this->db->select('*');
			$this->db->from('prospek');
			$this->db->join('pengguna', 'pengguna.id=prospek.idpengguna');
		    $this->db->where("prospek.tgl",$tgl);
			$this->db->order_by('prospek.tgl', 'DESC');
			return $this->db->get()->result_array();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('prospek');
			$this->db->join('pengguna', 'pengguna.id=prospek.idpengguna');
			$this->db->where("prospek.idpengguna",$ksk);
		    $this->db->where("prospek.tgl",$tgl);
			$this->db->order_by('prospek.tgl', 'DESC');
			return $this->db->get()->result_array();
		}
    }


    public function mproses($id)
	{
		$data=array(
			"prospek"			=> $this->input->post('hunting'),
			"calon_debitur"		=> $this->input->post('calon_debitur'),
			"no_hp"				=> $this->input->post('no_hp'),
			"keterangan"		=> $this->input->post('keterangan')
		);
		$this->db->where("idprospek",$id);
		return $this->db->update("prospek",$data);
	}
	public function mproses_tambah()
	{
		$tgl = date('Y-m-d');
		$nip = $this->session->userdata('nip');
		$data=array(
			"prospek"			=> $this->input->post('hunting'),
			"calon_debitur"		=> $this->input->post('calon_debitur'),
			"no_hp"				=> $this->input->post('no_hp'),
			"keterangan"		=> $this->input->post('keterangan'),
			"idpengguna"		=> $nip,
			"tgl"				=> $tgl,
		);
		$this->db->insert("prospek",$data);
	}

}
?>