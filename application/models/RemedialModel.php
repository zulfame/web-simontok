<?php defined('BASEPATH') OR exit('No direct script access allowed');
class RemedialModel extends ci_Model
{
	
	// Remdial: Menu List Debitur //
	public function GetDebitur()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit=debitur.kd_credit');
		$this->db->join('petugas', 'petugas.kd_petugas=debitur.kd_petugas');
		$this->db->where("bidang", $wilayah);
		$this->db->order_by('nama_debitur', 'ACS');
		return $this->db->get()->result();
	}

	// Detail Data Debitur
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


	// Remdial: Menu Surat Tugas //
	function generate()
	{
        // FORMAT 001/WILAYAH/TGL/BULAN/TAHUN
        // EX : 2023/PAMANUKAN/03/JAN/2022

		$this->db->select('LEFT(no_st,5) as kode', false);
		$this->db->order_by("kode", "DESC");
		$this->db->limit(1);
		$query = $this->db->get('surat_tugas');

        // SQL QUERY
        // SELECT LEFT(no_st, 4) AS kode FROM surat_tugas
        // ORDER BY kode
        // LIMIT 1

        // CEK JIKA DATA ADA
		if($query->num_rows() <> 0)
		{
            $data       = $query->row(); // ambil satu baris data
            $no_surat  = intval($data->kode) + 1; // tambah 1
        }else{
            $no_surat  = 1; // isi dengan 1
        }

        $lastKode = str_pad($no_surat, 5, "0", STR_PAD_LEFT);
        $tgl      = date("d");
        $bulan    = date("M");
        $tahun    = date("Y");
        $wilayah      = $this->session->userdata('wilayah');

        $newKode  = $lastKode."/".$wilayah."/".$tgl."/".$bulan."/".$tahun;

        return $newKode;  // return kode baru
    }

    public function GetSuratTugas()
	{
		$id_user = $this->session->userdata('id');
		$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('waktu','waktu.idwaktu = surat_tugas.idwaktu');
		$this->db->where('id_user',$id_user);
		$this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
		//$this->db->where('surat_tugas.tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}
	
	public function GetSuratTugasToday()
	{
		$id_user = $this->session->userdata('id');
		$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('waktu','waktu.idwaktu = surat_tugas.idwaktu');
		$this->db->where('id_user',$id_user);
		//$this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
		$this->db->where('surat_tugas.tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}

	public function GetPetugas()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('petugas');
		$this->db->where('wilayah',$wilayah);
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}

	public function CetakSuratTugas($id)
	{
		$id_user = $this->session->userdata('id');
		$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('waktu','waktu.idwaktu = surat_tugas.idwaktu');
		$this->db->where('id_user',$id_user);
		$this->db->where('tgl',$tgl);
		//$this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}

	public function CatatanTugas($id)
	{
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->where("id_st",$id);
		return $this->db->get("surat_tugas")->row();
	}
	public function ProsesCatatanTugas($id)
	{
		$petugas = $this->session->userdata('nama');
		$data=array(
			"catatan"		=> $this->input->post('catatan')
		);
		$this->db->where("id_st",$id);
		return $this->db->update("surat_tugas",$data);
	}

	public function EditTugas($id)
	{
		$this->db->where("id_st",$id);
		return $this->db->get("surat_tugas")->row();
	}
	public function ProsesEditTugas($id)
	{
		$data=array(
			"id_petugas"	=>$this->input->post('id_petugas'),
			"id_debitur"	=>$this->input->post('id_debitur'),
		);
		$this->db->where("id_st",$id);
		return $this->db->update("surat_tugas",$data);
	}

	public function TambahTugas()
	{
		$tgl = date('Y-m-d');
		$data=array(
		"id_user"		=>$this->session->userdata('id'),
		"no_st"			=>$this->input->post('no_st'),
		"id_petugas"	=>$this->input->post('id_petugas'),
		"id_debitur"	=>$this->input->post('id_debitur'),
		"tgl"			=>$tgl,

		);
		$this->db->insert("surat_tugas",$data);
	}

	 public function PencarianTugas($tgl)
	{

	    $id_user = $this->session->userdata('id');
		//$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('waktu','waktu.idwaktu = surat_tugas.idwaktu');
		$this->db->where('surat_tugas.id_user',$id_user);	
		$this->db->where('surat_tugas.tgl', $tgl);
		return $this->db->get("")->result();
    }

    // Remedial: Menu Prospek KSR
    public function GetProspekKSR()
	{
		$id = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('pengguna', 'pengguna.id=prospek.idpengguna');
		$this->db->where('prospek.idpengguna', $id);
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}
	public function TambahProspekKSR($data)
	{

		$this->db->insert("prospek",$data);
	}
	function EditProspekKSR($data, $id)
	{
		$this->db->where('idprospek',$id);
		$this->db->update('prospek', $data);
		return TRUE;
	}


	// Remedial: Menu Prospek Staff
	public function GetProspekStaff()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('prospek');
		$this->db->join('petugas', 'petugas.nip=prospek.idpengguna');
		$this->db->where('petugas.wilayah', $wilayah);
		$this->db->order_by('prospek.tgl', 'DESC');
		return $this->db->get()->result_array();
	}
	public function HapusProspek($id)
	{
		$this->db->where("idprospek",$id);
		return $this->db->delete("prospek");
	}


	// Remedial: Menu Monitoring
	public function GetMonitoring()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('monitoring');
		$this->db->join('debitur','debitur.kd_credit = monitoring.id_debitur');
		$this->db->join('tunggakan','tunggakan.kd_credit = debitur.kd_credit');
		$this->db->join('petugas','petugas.kd_petugas = monitoring.id_petugas');
		$this->db->where('debitur.bidang',$wilayah);
		$this->db->order_by('nama_debitur', 'ACS');
		return $this->db->get()->result();
	}

}
?>