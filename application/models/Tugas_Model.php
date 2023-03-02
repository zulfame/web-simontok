<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tugas_Model extends ci_Model
{
	
	public function data()
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
		$this->db->where('tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}
	public function dataToday()
	{
	    $tgl = date('Y-m-d');
		$id_user = $this->session->userdata('id');
		//$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('waktu','waktu.idwaktu = surat_tugas.idwaktu');
		$this->db->where('id_user',$id_user);
		$this->db->where('tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}
	public function dataAll()
	{
		$tgl = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->where('tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}

	public function hapus($id)
	{
		$this->db->where("id_st",$id);
		return $this->db->delete("surat_tugas");
	}

	// Menampilkan data petugas sesuai dengan kelolaan kkw
	public function dataPerWilayah()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('petugas');
		$this->db->where('wilayah',$wilayah);
		$this->db->order_by('nama', 'ACS');
		return $this->db->get()->result();
	}
	public function dataTunggakan()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('tunggakan');
		return $this->db->get()->row();
	}
	public function TotalTagihan($id)
	{
		
	}

	public function dataAO()
	{
		$tgl = date('Y-m-d');
		$kd_petugas = $this->session->userdata('kd_petugas');
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		//$this->db->join('petugas','petugas.nip = surat_tugas.id_petugas');
		//$this->db->join('debitur','debitur.id = surat_tugas.id_debitur');
		$this->db->where('id_petugas',$kd_petugas);
		$this->db->where('tgl', $tgl);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->result();
	}

	public function tambah()
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

	public function cetak($id)
	{
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('tunggakan','tunggakan.kd_credit = debitur.kd_credit');
		$this->db->where('id_st',$id);
		$this->db->order_by('tgl','DESC');
		return $this->db->get()->row();
	}

	public function edit($id)
	{
		$this->db->where("id_st",$id);
		return $this->db->get("surat_tugas")->row();
	}
	public function proses_edit($id)
	{
		$data=array(
		"id_petugas"	=>$this->input->post('id_petugas'),
		"id_debitur"	=>$this->input->post('id_debitur'),
		);
		$this->db->where("id_st",$id);
		return $this->db->update("surat_tugas",$data);
	}
	
	public function laporan($id)
	{
		$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		$this->db->join('tunggakan','tunggakan.kd_credit = debitur.kd_credit');
		$this->db->where("id_st",$id);
		return $this->db->get("surat_tugas")->row();
	}

	public function proses_laporan($id)
	{
		$petugas = $this->session->userdata('nama');
		$data=array(
		"pelaksanaan"	=> $this->input->post('pelaksanaan'),
		"hasil"			=> $this->input->post('hasil'),
		"foto"			=> $this->input->post('foto')
		);
		$this->db->where("id_st",$id);
		return $this->db->update("surat_tugas",$data);
	}

	public function report()
	{
	    //$tgl = date('Y-m-d');
		//$this->db->select('*');
		//$this->db->from('surat_tugas');
		//$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
		//$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		//$this->db->where('tgl', $tgl);
		//$this->db->order_by('tgl','DESC');
		//return $this->db->get()->result();
	}
	public function proses_catatan($id)
	{
		$petugas = $this->session->userdata('nama');
		$data=array(
		"catatan"		=> $this->input->post('catatan')
		);
		$this->db->where("id_st",$id);
		return $this->db->update("surat_tugas",$data);
	}


	function generate()
	{
        // FORMAT 001/WILAYAH/TGL/BULAN/TAHUN
        // EX : 2023/PAMANUKAN/03/JAN/2022

		$this->db->select('LEFT(no_st,6) as kode', false);
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

        $lastKode = str_pad($no_surat, 6, "0", STR_PAD_RIGHT);
        $tgl      = date("d");
        $bulan    = date("M");
        $tahun    = date("Y");
        $wilayah      = $this->session->userdata('wilayah');

        $newKode  = $lastKode."/".$wilayah."/".$tgl."/".$bulan."/".$tahun;

        return $newKode;  // return kode baru

    }


    private $table = 'surat_tugas';
    private $id = 'surat_tugas.id_st';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($data, $id)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

     public function pencarian($tgl)
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
		$this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
		return $this->db->get("")->result();
    }



    public function pencarian_st($petugas,$tgl)
    {
    	if ($petugas == "")
	    {
	    	$this->db->select('*');
			$this->db->from('surat_tugas');
			$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
			$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
		    $this->db->where("tgl",$tgl);
			$this->db->order_by('tgl','DESC');
			return $this->db->get()->result();
	    }
	    else
	    {
	    	$this->db->select('*');
			$this->db->from('surat_tugas');
			$this->db->join('petugas','petugas.kd_petugas = surat_tugas.id_petugas');
			$this->db->join('debitur','debitur.kd_credit = surat_tugas.id_debitur');
			$this->db->where("id_petugas",$petugas);
		    $this->db->where("tgl",$tgl);
			$this->db->order_by('tgl','DESC');
			return $this->db->get()->result();
	    }
    }

}
?>