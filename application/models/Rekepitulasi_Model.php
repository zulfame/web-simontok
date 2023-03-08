<?php defined('BASEPATH') or exit('No direct script access allowed');
class Rekepitulasi_Model extends ci_Model
{
    public function Filter($tgl1, $tgl2)
    {
        return $this->db->query("SELECT user.name, region, petugas_code, COUNT(petugas_code) jumlah, SUM(IF(STATUS=1, 1, 0)) dikerjakan, SUM(IF(STATUS=0, 1, 0)) tidakdikerjakan
        FROM USER
        JOIN surat_tugas ON surat_tugas.`petugas_code`=user.`user_code`
        JOIN region ON region.`id`=user.`region_id`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY user.`name`")->result_array();
    }

    public function FilterWilayah($tgl1, $tgl2)
    {
        return $this->db->query("SELECT region, COUNT(region) jumlah, SUM(IF(STATUS=1, 1, 0)) dikerjakan, SUM(IF(STATUS=0, 1, 0)) tidakdikerjakan
        FROM USER
        JOIN region ON region.`id`=user.`region_id`
        JOIN surat_tugas ON surat_tugas.`petugas_code`=user.`user_code`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY region")->result_array();
    }

    public function DetailTugas($id, $tgl1, $tgl2)
    {
        return $this->db->query("SELECT tgl, NAME, nama_debitur, alamat, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan
        FROM surat_tugas
        JOIN user ON user.`user_code`=surat_tugas.`petugas_code`
        JOIN debitur ON debitur.`kd_credit`=surat_tugas.`debitur_code`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        AND petugas_code='$id'
        AND STATUS='0'")->result_array();
    }
    public function PetugasId($id)
    {
        return $this->db->get_where('user', ['user_code' => $id])->row_array();
    }

    public function DetailWilayah($id, $tgl1, $tgl2)
    {
        return $this->db->query("SELECT tgl, name, region, kd_credit, nama_debitur, alamat, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan
        FROM surat_tugas
        JOIN user ON user.`user_code`=surat_tugas.`petugas_code`
        JOIN region ON region.`id`=user.`region_id`
        JOIN debitur ON debitur.`kd_credit`=surat_tugas.`debitur_code`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        AND region='$id'
        AND STATUS='0'")->result_array();
    }
    public function WilayahId($id)
    {
        return $this->db->get_where('region', ['region' => $id])->row_array();
    }

    public function FilterProspek($tgl1, $tgl2)
    {
        return $this->db->query("SELECT user.name, region, petugas_code, COUNT(petugas_code) jumlah, SUM(IF(STATUS=1, 1, 0)) closing, SUM(IF(STATUS=0, 1, 0)) invalid
        FROM USER
        JOIN prospek ON prospek.`petugas_code`=user.`user_code`
        JOIN region ON region.`id`=user.`region_id`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY user.`name`")->result_array();
    }
    public function DetailProspek($id, $tgl1, $tgl2)
    {
        return $this->db->query("SELECT id_prospek, tgl, NAME, prospek, calon_debitur, no_hp, keterangan, image_prospek, status
        FROM prospek
        JOIN USER ON user.`user_code`=prospek.`petugas_code`
        WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
        AND petugas_code='$id'
        ORDER BY tgl DESC")->result_array();
    }
}
