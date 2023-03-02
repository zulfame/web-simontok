<?php defined('BASEPATH') or exit('No direct script access allowed');
class Monitoring_Model extends ci_Model
{

	public function hapus_all()
	{
		$this->db->empty_table('monitoring');
	}

	public function getData()
	{
		$wilayah = $this->session->userdata('wilayah');
		$this->db->select('*');
		$this->db->from('monitoring');
		$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
		$this->db->where('debitur.wilayah', $wilayah);
		return $this->db->get()->result();
	}

	public function getAOKredit()
	{
		$kon1 = 'Staff Remedial';
		$kon2 = 'Kepala Seksi Kredit';
		$this->db->select('*');
		$this->db->from('petugas');
		$this->db->where_not_in('posisi', $kon1);
		$this->db->where_not_in('posisi', $kon2);
		$this->db->order_by('petugas.nama', 'ASC');
		return $this->db->get()->result();
	}
	public function getRemedial()
	{
		$kon1 = 'Staff Remedial';
		$this->db->select('*');
		$this->db->from('petugas');
		$this->db->order_by('petugas.nama', 'ASC');
		$this->db->where('posisi', $kon1);
		return $this->db->get()->result();
	}

	public function getDataAo()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		$this->db->select('*');
		$this->db->from('monitoring');
		$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
		//$this->db->join('petugas','petugas.kd_petugas = monitoring.id_petugas');
		$this->db->where('debitur.kd_petugas', $kd_petugas);
		return $this->db->get()->result();
	}

	public function getDebitur()
	{
		$id_petugas = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('monitoring');
		$this->db->join('pegawai', 'pegawai.id = monitoring.id_petugas');
		$this->db->join('kmd', 'kmd.id_debitur = monitoring.id_debitur');
		$this->db->where('id_petugas', $id_petugas);
		return $this->db->get()->result();
	}

	public function dataAll()
	{
		return $this->db->query("select * from monitoring_detail
		join monitoring on monitoring.`id_monitoring`=monitoring_detail.`id_monitoring`
		join kmd on kmd.`id_debitur`=monitoring.`id_debitur`
		join pegawai on pegawai.`id`=monitoring_detail.`id_petugas`
		where monitoring_detail.`tgl`=DATE(NOW())
		order by tgl desc")->result();
	}

	public function tambahData()
	{
		$id_user = $this->session->userdata('id');
		$data = array(
			"id_user"		=> $id_user,
			"id_petugas"	=> $this->input->post('id_petugas'),
			"id_debitur"	=> $this->input->post('id_debitur'),

		);
		$this->db->insert("monitoring", $data);
	}

	public function hapus($id)
	{
		$this->db->where("id_monitoring", $id);
		return $this->db->delete("monitoring");
	}

	public function tambahLaporan()
	{
		$id_petugas = $this->session->userdata('id');
		$data = array(
			"id_petugas"	=> $id_petugas,
			"id_monitoring"	=> $this->input->post('id_monitoring'),
			"tgl"			=> $this->input->post('tgl'),
			"tunggakan"		=> $this->input->post('tunggakan'),
			"pelaksanaan"	=> $this->input->post('pelaksanaan'),
			"catatan"		=> $this->input->post('catatan'),
		);
		$this->db->insert("monitoring_detail", $data);
	}

	public function getDataDebitur($id)
	{
		$this->db->select('*');
		$this->db->from('debitur');
		$this->db->where('kd_credit', $id);
		return $this->db->get()->row();
	}
	public function getDataRiwayat($id)
	{
		$this->db->select('*');
		$this->db->from('surat_tugas');
		$this->db->join('petugas', 'petugas.kd_petugas = surat_tugas.id_petugas');
		$this->db->where('id_debitur', $id);
		return $this->db->get()->result();
	}
	public function getDataAgunan($id)
	{
		$this->db->select('*');
		$this->db->from('agunan');
		$this->db->join('debitur', 'debitur.no_cif = agunan.idagunan');
		$this->db->where('kd_credit', $id);
		return $this->db->get()->result();
	}


	public function report()
	{
		$this->db->select('*');
		$this->db->from('monitoring');
		$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
		$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
		return $this->db->get()->result();
	}

	public function pencarian_st($petugas, $tgl)
	{
		if ($petugas == "") {
			$this->db->select('*');
			$this->db->from('surat_tugas');
			$this->db->join('petugas', 'petugas.kd_petugas = surat_tugas.id_petugas');
			$this->db->join('debitur', 'debitur.kd_credit = surat_tugas.id_debitur');
			$this->db->where("tgl", $tgl);
			$this->db->order_by('tgl', 'DESC');
			return $this->db->get()->result();
		} else {
			$this->db->select('*');
			$this->db->from('surat_tugas');
			$this->db->join('petugas', 'petugas.kd_petugas = surat_tugas.id_petugas');
			$this->db->join('debitur', 'debitur.kd_credit = surat_tugas.id_debitur');
			$this->db->where("id_petugas", $petugas);
			$this->db->where("tgl", $tgl);
			$this->db->order_by('tgl', 'DESC');
			return $this->db->get()->result();
		}
	}

	public function pencarian_d($wilayah, $petugas, $coll)
	{
		if ($petugas == "") {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->where("debitur.wilayah", $wilayah);
			$this->db->where("call", $coll);
			return $this->db->get("")->result();
		}
		if ($coll == "") {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->where("debitur.wilayah", $wilayah);
			$this->db->where("debitur.kd_petugas", $petugas);
			return $this->db->get("")->result();
		} else {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->where("debitur.kd_petugas", $petugas);
			$this->db->where("call", $coll);
			$this->db->where("debitur.wilayah", $wilayah);
			return $this->db->get("")->result();
		}
	}

	public function pencarian_r($petugas, $coll)
	{
		if ($coll == "") {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->join('petugas', 'petugas.kd_petugas = monitoring.id_petugas');
			$this->db->where("debitur.kd_petugas", $petugas);
			return $this->db->get("")->result();
		} else {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->join('petugas', 'petugas.kd_petugas = monitoring.id_petugas');
			$this->db->where("debitur.kd_petugas", $petugas);
			$this->db->where("call", $coll);
			return $this->db->get("")->result();
		}
	}

	public function pencarian_k($petugas, $coll)
	{
		if ($coll == "") {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->join('petugas', 'petugas.kd_petugas = monitoring.id_petugas');
			$this->db->where("debitur.kd_petugas", $petugas);
			return $this->db->get("")->result();
		} else {
			$this->db->select('*');
			$this->db->from('monitoring');
			$this->db->join('debitur', 'debitur.kd_credit = monitoring.id_debitur');
			$this->db->join('tunggakan', 'tunggakan.kd_credit = debitur.kd_credit');
			$this->db->join('petugas', 'petugas.kd_petugas = monitoring.id_petugas');
			$this->db->where("debitur.kd_petugas", $petugas);
			$this->db->where("call", $coll);
			return $this->db->get("")->result();
		}
	}
}
