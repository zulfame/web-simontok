<?php defined('BASEPATH') or exit('No direct script access allowed');
class Report_Model extends ci_Model
{
    public function GetDebitur($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kd_credit', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
        }

        $this->db->where_not_in('bidang', 'REMEDIAL');
        $this->db->order_by('tunggakan_h', 'DESC');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebitur()
    {
        $this->db->where_not_in('bidang', 'REMEDIAL');
        return $this->db->count_all_results();
    }

    public function GetDebiturId($id)
    {
        return $this->db->get_where('debitur', ['kd_credit' => $id])->row_array();
    }
    public function GetDebiturWoId($id)
    {
        return $this->db->get_where('debitur_wo', ['kd_credit' => $id])->row_array();
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

    public function GetDebiturRemedial($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kd_credit', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
        }

        $this->db->where('bidang', 'REMEDIAL');
        $this->db->order_by('tunggakan_h', 'DESC');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturRemedial()
    {
        $this->db->where('bidang', 'REMEDIAL');
        return $this->db->count_all_results();
    }

    public function GetDebiturWo($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kd_credit', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
        }

        $this->db->order_by('nama_debitur', 'ASC');
        return $this->db->get('debitur_wo', $limit, $start)->result_array();
    }

    public function CountDebiturWo()
    {
        return $this->db->count_all_results();
    }
}
