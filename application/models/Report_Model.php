<?php defined('BASEPATH') or exit('No direct script access allowed');
class Report_Model extends ci_Model
{

    public function pencarian_st($tgl1, $tgl2)
    {
        return $this->db->query("SELECT nama_debitur, id_debitur, pengguna.wilayah, petugas.nama AS petugas, tgl, pelaksanaan, hasil, lainnya AS ket_pelaksanaan, lainnya2 AS ket_hasil, catatan
            FROM surat_tugas
            JOIN petugas ON petugas.`kd_petugas`=surat_tugas.`id_petugas`
            JOIN debitur ON surat_tugas.id_debitur=debitur.kd_credit
            JOIN pengguna ON pengguna.`id`=surat_tugas.`id_user`
            WHERE tgl BETWEEN '$tgl1' AND '$tgl2'
            ORDER BY wilayah ASC
            ")->result();
    }

    // -------------------------------------------//   
    public function dataDebitur()
    {
        return $this->db->query("SELECT COUNT(kd_credit) AS hasil FROM debitur")->result();
    }

    public function update($data, $id)
    {
        $this->db->where("id", $id);
        $this->db->update("pengguna", $data);
        return $this->db->affected_rows();
    }
    public function ubah($data, $id)
    {
        $this->db->where("nip", $id);
        $this->db->update("petugas", $data);
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
        $this->db->where('idwaktu', $id);
        $this->db->update('waktu', $data);
        return TRUE;
    }



    public function GetWaktu($id)
    {
        $this->db->where("idwaktu", $id);
        return $this->db->get("waktu")->row();
    }
    public function proses_tanggal($id)
    {
        $data = array(
            "tgl_awal"            => $this->input->post('tgl_awal'),
            "tgl_akhir"            => $this->input->post('tgl_akhir'),
        );
        $this->db->where("idwaktu", $id);
        return $this->db->update("waktu", $data);
    }
}
