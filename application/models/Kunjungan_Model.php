<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kunjungan_Model extends ci_Model
{
    public function LikeDebitur($wilayah = null, $tgl_awal = null, $tgl_akhir = null)
    {
        if ($wilayah || $tgl_awal || $tgl_akhir) {
            $this->db->join('debitur', 'debitur.kd_credit=surat_tugas.debitur_code');
            $this->db->where('wilayah', $wilayah);
            $this->db->where("tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'");
            $this->db->where_not_in('petugas_code', 'IDJ');
            $this->db->order_by('tgl', 'DESC');
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->where('tgl', 'Kosong');
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function LikeSt($wilayah, $tgl1, $tgl2)
    {
        $this->db->join('debitur', 'debitur.kd_credit=surat_tugas.debitur_code');
        $this->db->join('user', 'user.user_code=surat_tugas.petugas_code');
        $this->db->like('no_st', $wilayah);
        $this->db->where("tgl BETWEEN '$tgl1' AND '$tgl2'");
        $this->db->where_not_in('petugas_code', 'IDJ');
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function LikeStRemedial($bidang, $tgl1, $tgl2)
    {
        $this->db->join('debitur', 'debitur.kd_credit=surat_tugas.debitur_code');
        $this->db->join('user', 'user.user_code=surat_tugas.petugas_code');
        $this->db->like('no_st', $bidang);
        $this->db->where("tgl BETWEEN '$tgl1' AND '$tgl2'");
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function LikeStWriteoff($bidang, $tgl1, $tgl2)
    {
        $this->db->join('debitur_wo', 'debitur_wo.kd_credit=surat_tugas.debitur_code');
        $this->db->join('user', 'user.user_code=surat_tugas.petugas_code');
        $this->db->like('no_st', $bidang);
        $this->db->where("tgl BETWEEN '$tgl1' AND '$tgl2'");
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }


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

    public function ListPetugas()
    {
        $this->db->select("user_code, name");
        $this->db->where_not_in("role_id", "1");
        $this->db->where_not_in("role_id", "2");
        $this->db->where_not_in("role_id", "9");
        $this->db->where("is_active", "1");
        $this->db->order_by("name", "ASC");
        return $this->db->get("user")->result_array();
    }

    public function PreviewSt($petugas, $tgl1, $tgl2)
    {
        $this->db->select('id_st, debitur_code, nama_debitur, debitur.`call`, os_akhir, tunggakan_p, tunggakan_b, tunggakan_d, petugas_code, tgl, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, image');
        $this->db->join('debitur', 'debitur.kd_credit=surat_tugas.debitur_code');
        $this->db->where("tgl BETWEEN '$tgl1' AND '$tgl2'");
        $this->db->where('petugas_code', $petugas);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }
}
