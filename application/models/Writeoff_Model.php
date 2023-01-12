<?php defined('BASEPATH') or exit('No direct script access allowed');
class Writeoff_Model extends ci_Model
{

    // QUERY DEBITUR
    public function GetDebitur($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_debitur', $keyword);
            $this->db->or_like('kd_petugas', $keyword);
            $this->db->or_like('kd_credit', $keyword);
            $this->db->or_like('wilayah', $keyword);
        }

        $user_code = $this->session->userdata('user_code');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->join('user', 'user.`user_code`=debitur_wo.`kd_petugas`');
            $this->db->where('kd_petugas', $user_code);
            $this->db->order_by('wilayah', 'ASC');
            return $this->db->get('debitur_wo', $limit, $start)->result_array();
        } else {
            $this->db->join('user', 'user.`user_code`=debitur_wo.`kd_petugas`');
            $this->db->order_by('wilayah', 'ASC');
            return $this->db->get('debitur_wo', $limit, $start)->result_array();
        }
    }

    public function CountDebitur()
    {
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $user_code = $this->session->userdata('user_code');

            $this->db->join('user', 'user.`user_code`=debitur_wo    .`kd_petugas`');
            $this->db->where('debitur_wo.`kd_petugas`', $user_code);
            return $this->db->count_all_results();
        } else {
            return $this->db->count_all_results();
        }
    }

    public function ExportDebitur()
    {
        $user_code = $this->session->userdata('user_code');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->join('user', 'user.`user_code`=debitur_wo.`kd_petugas`');
            $this->db->where('kd_petugas', $user_code);
            return $this->db->get('debitur_wo')->result_array();
        } else {
            $this->db->join('user', 'user.`user_code`=debitur_wo.`kd_petugas`');
            return $this->db->get('debitur_wo')->result_array();
        }
    }

    public function GetDebiturId($id)
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

    // QUERY FOT SURAT TUGAS
    public function GetSt($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('debitur_code', $keyword);
            $this->db->or_like('no_st', $keyword);
            $this->db->or_like('tgl', $keyword);
        }

        $user_code = $this->session->userdata('user_code');
        $date_now = date('Y-m-d');
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 4) {
            $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
            $this->db->where('leader_code', $user_code);
            $this->db->order_by('id_st', 'DESC');
            $this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
            return $this->db->get('surat_tugas', $limit, $start)->result_array();
        } else {
            $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda');
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
            $this->db->where('petugas_code', $user_code);
            $this->db->order_by('id_st', 'DESC');
            $this->db->where('tgl', $date_now);
            $this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
            return $this->db->get('surat_tugas', $limit, $start)->result_array();
        }
    }

    public function ListDebiturWo()
    {
        $this->db->order_by('nama_debitur', 'ASC');
        return $this->db->get('debitur_wo')->result_array();
    }

    public function UpdateSt()
    {
        $data = [
            "debitur_code" => $this->input->post('debitur_code', true),
            "petugas_code" => $this->input->post('petugas_code', true),
            "catatan"      => $this->input->post('catatan', true),
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }

    public function UpdateStOfficer()
    {
        $data = [
            "pelaksanaan"   => $this->input->post('pelaksanaan', true),
            "d_pelaksanaan" => $this->input->post('d_pelaksanaan', true),
            "hasil"         => $this->input->post('hasil', true),
            "d_hasil"       => $this->input->post('d_hasil', true),
            "tgk_pokok"     => $this->input->post('tgk_pokok', true),
            "tgk_bunga"     => $this->input->post('tgk_bunga', true),
            "tgk_denda"     => $this->input->post('tgk_denda', true),
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }

    public function DeleteSt($id)
    {
        $this->db->where("id_st", $id);
        return $this->db->delete("surat_tugas");
    }

    public function PrintSt()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        $this->db->where('tgl', $tgl);
        return $this->db->get('surat_tugas')->result_array();
    }

    public function PrintStOfficer()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda, alamat, role, plafond, tgl_jth_tempo, tgk_pokok, os_akhir');
        $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->join('user_role', 'user_role.`id`=user.`role_id`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        $this->db->where('tgl', $tgl);
        return $this->db->get('surat_tugas')->result_array();
    }

    public function TtdSt()
    {
        $region = $this->session->userdata('region');

        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->where('region', $region);
        $this->db->where('role_id', 6);
        $this->db->where('is_active', 1);
        return $this->db->get('user')->result_array();
    }

    public function CountSt()
    {
        $user_code   = $this->session->userdata('user_code');
        $tgl         = date('Y-m-d');

        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('surat_tugas.petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        return $this->db->count_all_results();
    }

    public function ListOfficer()
    {
        $region = $this->session->userdata('region');

        $this->db->join('region', 'region.id=user.region_id');
        $this->db->where('region', $region);
        $this->db->where('is_active', '1');
        $this->db->order_by('name', 'ASC');
        return $this->db->get('user')->result_array();
    }

    public function InsertSt()
    {
        $lastKode    = substr(md5(microtime()), rand(0, 26), 6);
        $tgl         = date("d/m/Y");
        $newKode     = "ST" . "/" . $lastKode . "/" . "WO" . "/" . $tgl;
        $leader_code = $this->session->userdata('user_code');

        $data = [
            "no_st"         => $newKode,
            "leader_code"   => $leader_code,
            "debitur_code"  => $this->input->post('debitur_code', true),
            "petugas_code"  => $this->input->post('petugas_code', true),
            "tgl"           => date('Y-m-d')
        ];

        $this->db->insert('surat_tugas', $data);
    }
}
