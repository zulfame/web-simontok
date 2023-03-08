<?php defined('BASEPATH') or exit('No direct script access allowed');
class Tugas_Model extends ci_Model
{
    public function CountSt()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code   = $this->session->userdata('user_code');
        $tgl         = date('Y-m-d');

        if ($role_id == 5 || $role_id == 6) {
            $this->db->where('petugas_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->count_all_results('surat_tugas');
        } else {
            $this->db->where('leader_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->count_all_results('surat_tugas');
        }
    }

    public function Jb()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        if ($role_id == 5 || $role_id == 6) {
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('debitur.kd_petugas', $user_code);
            $this->db->where('jb', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('leader_code', $user_code);
            $this->db->where('jb', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function JbWo()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl       = date('Y-m-d');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('petugas_code', $user_code);
            $this->db->where('jb', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('leader_code', $user_code);
            $this->db->where('jb', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function UnDone()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        if ($role_id == 5 || $role_id == 6) {
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('petugas_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('leader_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function UnDoneWo()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl       = date('Y-m-d');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('petugas_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->where('leader_code', $user_code);
            $this->db->where('pelaksanaan', NULL);
            $this->db->where('tgl', $tgl);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function GetSt()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function GetStWo()
    {
        $user_code = $this->session->userdata('user_code');
        $date_now = date('Y-m-d');
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda');
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
            $this->db->where('petugas_code', $user_code);
            $this->db->order_by('id_st', 'DESC');
            $this->db->where('tgl', $date_now);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function GetStImage()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        if ($role_id == 5 || $role_id == 6) {
            $this->db->select('id_st, surat_tugas.image, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, tunggakan.tgk_pokok, tunggakan.tgk_denda, tunggakan.tgk_bunga');
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->where('petugas_code', $user_code);
            $this->db->where('tgl', $tgl);
            $this->db->order_by('id_st', 'DESC');
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->select('id_st, surat_tugas.image, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, tunggakan.tgk_pokok, tunggakan.tgk_denda, tunggakan.tgk_bunga');
            $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->where('leader_code', $user_code);
            $this->db->where('tgl', $tgl);
            $this->db->order_by('id_st', 'DESC');
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function GetStWoImage()
    {
        $user_code = $this->session->userdata('user_code');
        $date_now = date('Y-m-d');
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 6) {
            $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda');
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
            $this->db->where('petugas_code', $user_code);
            $this->db->order_by('id_st', 'DESC');
            $this->db->where('tgl', $date_now);
            return $this->db->get('surat_tugas')->result_array();
        } else {
            $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda');
            $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
            $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
            $this->db->where('leader_code', $user_code);
            $this->db->order_by('id_st', 'DESC');
            $this->db->where('tgl', $date_now);
            return $this->db->get('surat_tugas')->result_array();
        }
    }

    public function GetStNote()
    {
        $role_id = $this->session->userdata('role_id');
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, tunggakan.tgk_pokok, tunggakan.tgk_denda, tunggakan.tgk_bunga');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('leader_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function GetStWoNote()
    {
        $user_code = $this->session->userdata('user_code');
        $date_now = date('Y-m-d');
        $role_id = $this->session->userdata('role_id');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur_wo.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, debitur_wo.os_akhir, debitur_wo.tgk_bunga, debitur_wo.tgk_denda');
        $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        $this->db->where('tgl', $date_now);
        return $this->db->get('surat_tugas')->result_array();
    }

    public function GetStReport($id)
    {
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->where('id_st', $id);
        return $this->db->get('surat_tugas')->row_array();
    }

    public function GetStReportWo($id)
    {
        $this->db->join('debitur_wo', 'debitur_wo.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->where('id_st', $id);
        return $this->db->get('surat_tugas')->row_array();
    }

    public function GetStHistory($uri4)
    {
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('debitur_code', $uri4);
        $this->db->order_by('tgl', 'DESC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function GetDebiturId($uri4)
    {
        $this->db->where('kd_credit', $uri4);
        return $this->db->get('debitur')->row_array();
    }

    public function GetDebiturIdWo($uri4)
    {
        $this->db->where('kd_credit', $uri4);
        return $this->db->get('debitur')->row_array();
    }

    public function UpdateReport()
    {
        $data = [
            "pelaksanaan"   => $this->input->post('pelaksanaan', true),
            "d_pelaksanaan" => $this->input->post('d_pelaksanaan', true),
            "hasil"         => $this->input->post('hasil', true),
            "d_hasil"       => $this->input->post('d_hasil', true),
            "jb"            => $this->input->post('jb', true),
            "tgk_pokok"     => $this->input->post('tgk_pokok', true),
            "tgk_bunga"     => $this->input->post('tgk_bunga', true),
            "tgk_denda"     => $this->input->post('tgk_denda', true),
            "status"        => 1,
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }

    public function UpdateNote()
    {
        $data = [
            "catatan"   => $this->input->post('catatan', true),
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }
}
