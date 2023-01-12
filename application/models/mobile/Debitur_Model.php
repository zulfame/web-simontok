<?php defined('BASEPATH') or exit('No direct script access allowed');
class Debitur_Model extends ci_Model
{
    public function GetDebitur($keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_debitur', $keyword);
        }

        $user_code  = $this->session->userdata('user_code');
        $region     = $this->session->userdata('region');

        $role_id   = $this->session->userdata('role_id');
        if ($role_id == 5 || $role_id == 6) {
            $this->db->where('kd_petugas', $user_code);
            $this->db->order_by('nama_debitur', 'ASC');
            return $this->db->get('debitur')->result_array();
        } else {
            $this->db->where('wilayah', $region);
            $this->db->or_where('bidang', $region);
            $this->db->order_by('nama_debitur', 'ASC');
            return $this->db->get('debitur')->result_array();
        }
    }

    public function GetDebiturId($id)
    {
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->where('kd_credit', $id);
        return $this->db->get('debitur')->row_array();
    }
    public function GetAgunanId($id)
    {
        return $this->db->get_where('agunan', ['debitur_id' => $id])->result_array();
    }
    public function GetStId($id)
    {
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get_where('surat_tugas', ['debitur_code' => $id])->result_array();
    }

    public function CountSt()
    {
        $user_code   = $this->session->userdata('user_code');
        $tgl         = date('Y-m-d');

        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        return $this->db->count_all_results('surat_tugas');
    }
}
