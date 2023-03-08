<?php defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard_Model extends ci_Model
{
    // QUERY FOT SURAT TUGAS
    public function GetSt()
    {
        $date_now = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('tgl', $date_now);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }
}
