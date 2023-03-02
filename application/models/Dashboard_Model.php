<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_Model extends ci_Model 
{
	
	public function dataDebitur()
	{
		return $this->db->query("SELECT COUNT(kd_credit) AS hasil FROM debitur")->result();
	}

	public function dataMonitoring()
	{
		return $this->db->query("SELECT COUNT(ID) AS hasil FROM monitoring_detail WHERE tgl=DATE(NOW())")->result();
	}

	public function log()
	{
		return $this->db->query("SELECT * FROM log ORDER BY log_time DESC")->result();
	}


	public function plafond()
	{
		return $this->db->query("SELECT SUM(plafond) AS hasil FROM debitur;")->result();
	}

	public function baki_debet()
	{
		return $this->db->query("SELECT SUM(os_akhir) AS hasil FROM debitur;")->result();
	}
	public function tgk_pokok()
	{
		return $this->db->query("SELECT SUM(tgk_pokok) AS hasil FROM tunggakan;")->result();
	}
	public function tgk_bunga()
	{
		return $this->db->query("SELECT SUM(tgk_bunga) AS hasil FROM tunggakan;")->result();
	}
	public function tgk_denda()
	{
		return $this->db->query("SELECT SUM(tgk_denda) AS hasil FROM tunggakan;")->result();
	}

	public function debitur()
	{
		return $this->db->query("SELECT count(kd_credit) AS hasil FROM debitur;")->result();
	}


	// QUERY FOR DASHBOARD KKW
	public function plafond2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT SUM(plafond) AS hasil FROM debitur WHERE wilayah ='$wilayah';")->result();
	}
	
	public function baki_debet2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT SUM(baki_debet) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE wilayah = '$wilayah';")->result();
	}
	public function tgk_pokok2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT SUM(tgk_pokok) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE wilayah = '$wilayah';")->result();
	}
	public function tgk_bunga2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT SUM(tgk_bunga) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE wilayah = '$wilayah';")->result();;
	}
	public function tgk_denda2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT SUM(tgk_denda) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE wilayah = '$wilayah';")->result();
	}

	public function debitur2()
	{
		$wilayah = $this->session->userdata('wilayah');
		return $this->db->query("SELECT count(kd_credit) AS hasil FROM debitur WHERE wilayah = '$wilayah';")->result();
	}


	public function jmlTugas()
	{
		$tgl = date('Y-m-d');
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("
			SELECT COUNT(id_st) AS hasil FROM surat_tugas
			JOIN pengguna ON pengguna.`id`=surat_tugas.`id_user`
			WHERE tgl = '$tgl' AND id_petugas = '$kd_petugas'
		")->result();
	}
	public function jmlTugasDone()
	{
		$tgl = date('Y-m-d');
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("
			SELECT COUNT(id_st) AS hasil FROM surat_tugas
			JOIN pengguna ON pengguna.`id`=surat_tugas.`id_user`
			WHERE tgl = '$tgl' AND id_petugas = '$kd_petugas' AND pelaksanaan = 'kosong'
		")->result();
	}


	// QUERY FOR DASHBOARD AO
	public function plafond3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT SUM(plafond) AS hasil FROM debitur WHERE kd_petugas ='$kd_petugas';")->result();
	}
	
	public function baki_debet3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT SUM(baki_debet) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE kd_petugas = '$kd_petugas';")->result();
	}
	public function tgk_pokok3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT SUM(tgk_pokok) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE kd_petugas = '$kd_petugas';")->result();
	}
	public function tgk_bunga3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT SUM(tgk_bunga) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE kd_petugas = '$kd_petugas';")->result();;
	}
	public function tgk_denda3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT SUM(tgk_denda) AS hasil FROM tunggakan
		JOIN debitur ON debitur.kd_credit=tunggakan.kd_credit
		WHERE kd_petugas = '$kd_petugas';")->result();
	}

	public function debitur3()
	{
		$kd_petugas = $this->session->userdata('kd_petugas');
		return $this->db->query("SELECT count(kd_credit) AS hasil FROM debitur WHERE kd_petugas = '$kd_petugas';")->result();
	}
}
?>