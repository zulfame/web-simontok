<?php defined('BASEPATH') or exit('No direct script access allowed');
class Monitoring_Model extends ci_Model
{
    // QUERY DEBITUR
    public function GetDebitur($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('debitur_code', $keyword);
        }

        $region    = $this->session->userdata('region');
        $role_id   = $this->session->userdata('role_id');
        if ($role_id == 3) {
            $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, user.`name`');
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
            $this->db->where('debitur.`wilayah`', $region);
            $this->db->where('debitur.`bidang`', $region);
            $this->db->order_by('hari_pokok', 'DESC');
            return $this->db->get('tunggakan', $limit, $start)->result_array();
        } else {
            $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, user.`name`');
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
            $this->db->where('debitur.`bidang`', $region);
            $this->db->order_by('hari_pokok', 'DESC');
            return $this->db->get('tunggakan', $limit, $start)->result_array();
        }
    }

    public function ExportDebitur()
    {
        $region    = $this->session->userdata('region');
        $role_id   = $this->session->userdata('role_id');
        if ($role_id == 3) {
            $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, user.`name`, no_cif, no_spk, alamat, metode_rps, jw, rate, plafond, telepon');
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
            $this->db->where('debitur.`wilayah`', $region);
            $this->db->where('debitur.`bidang`', $region);
            $this->db->order_by('hari_pokok', 'DESC');
            return $this->db->get('tunggakan')->result_array();
        } else {
            $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, user.`name`, no_cif, no_spk, alamat, metode_rps, jw, rate, plafond, telepon');
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
            $this->db->where('debitur.`bidang`', $region);
            $this->db->order_by('hari_pokok', 'DESC');
            return $this->db->get('tunggakan')->result_array();
        }
    }

    public function GetDebiturId($id)
    {
        return $this->db->get_where('debitur', ['kd_credit' => $id])->row_array();
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

    public function CountDebitur()
    {
        $region    = $this->session->userdata('region');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 3) {
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->where('debitur.`wilayah`', $region);
            $this->db->where('debitur.`bidang`', $region);
            return $this->db->count_all_results();
        } else {
            $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
            $this->db->where('debitur.`bidang`', $region);
            return $this->db->count_all_results();
        }
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

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, tgl_awal, tgl_akhir, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        //$this->db->where("surat_tugas.tgl BETWEEN tgl_awal AND tgl_akhir");
        $this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
        return $this->db->get('surat_tugas', $limit, $start)->result_array();
    }

    public function PrintSt()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
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

        //$this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->join('user_role', 'user_role.`id`=user.`role_id`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        $this->db->where('tgl', $tgl);
        return $this->db->get('surat_tugas')->result_array();
    }

    public function TtdSt()
    {
        $role_id   = $this->session->userdata('role_id');
        $region = $this->session->userdata('region');

        if ($role_id == 3) {
            $this->db->join('region', 'region.id=user.region_id');
            $this->db->join('user_role', 'user_role.id=user.role_id');
            $this->db->where('region', $region);
            $this->db->where('role_id', 5);
            $this->db->where('is_active', 1);
            return $this->db->get('user')->result_array();
        } else {
            $this->db->join('region', 'region.id=user.region_id');
            $this->db->join('user_role', 'user_role.id=user.role_id');
            $this->db->where('region', $region);
            $this->db->where('role_id', 6);
            $this->db->where('is_active', 1);
            return $this->db->get('user')->result_array();
        }
    }

    public function CountSt()
    {
        $user_code   = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, leader_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('leader_code', $user_code);
        $this->db->order_by('id_st', 'DESC');
        //$this->db->where('tgl', $tgl);
        return $this->db->count_all_results();
    }

    public function ListDebitur()
    {
        $region    = $this->session->userdata('region');
        $role_id   = $this->session->userdata('role_id');

        if ($role_id == 3) {
            $this->db->where('wilayah', $region);
            $this->db->where('bidang', $region);
            $this->db->order_by('nama_debitur', 'ASC');
            return $this->db->get('debitur')->result_array();
        } else {
            $this->db->where('bidang', $region);
            $this->db->order_by('nama_debitur', 'ASC');
            return $this->db->get('debitur')->result_array();
        }
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
        $wilayah     = $this->session->userdata('alias');
        $newKode     = "ST" . "/" . $lastKode . "/" . $wilayah . "/" . $tgl;
        $leader_code = $this->session->userdata('user_code');

        $data = [
            "no_st"         => $newKode,
            "leader_code"   => $leader_code,
            "debitur_code"  => $this->input->post('debitur_code', true),
            "petugas_code"  => $this->input->post('petugas_code', true),
            "tgl"           => date('Y-m-d'),
        ];

        $this->db->insert('surat_tugas', $data);
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

    public function DeleteSt($id)
    {
        $this->db->where("id_st", $id);
        return $this->db->delete("surat_tugas");
    }

    // QUERY TASK TODAY
    public function GetToday($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('debitur_code', $keyword);
            $this->db->or_like('no_st', $keyword);
        }

        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, surat_tugas.image, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas', $limit, $start)->result_array();
    }

    public function CountStToday()
    {
        $user_code   = $this->session->userdata('user_code');
        $tgl         = date('Y-m-d');

        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        return $this->db->count_all_results();
    }

    public function UpdateToday()
    {
        $data = [
            "pelaksanaan"   => $this->input->post('pelaksanaan', true),
            "d_pelaksanaan" => $this->input->post('d_pelaksanaan', true),
            "hasil"         => $this->input->post('hasil', true),
            "d_hasil"       => $this->input->post('d_hasil', true),
            "catatan"       => $this->input->post('catatan', true),
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }

    // QUERY PROSPECT
    public function GetProspect($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tgl', $keyword);
        }

        $user_code = $this->session->userdata('user_code');

        $this->db->where('petugas_code', $user_code);
        $this->db->order_by('id_prospek', 'DESC');
        return $this->db->get('prospek', $limit, $start)->result_array();
    }

    public function CountProspect()
    {
        $user_code = $this->session->userdata('user_code');

        $this->db->where('petugas_code', $user_code);
        return $this->db->count_all_results();
    }

    public function GetProspectOfficer($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tgl', $keyword);
        }

        $region = $this->session->userdata('region');
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 3) {
            $this->db->join('user', 'user.user_code=prospek.petugas_code');
            $this->db->join('region', 'region.id=user.region_id');
            $this->db->join('user_role', 'user_role.id=user.role_id');
            $this->db->where('region', $region);
            $this->db->where('role_id', 5);
            $this->db->order_by('id_prospek', 'DESC');
            return $this->db->get('prospek', $limit, $start)->result_array();
        } else {
            $this->db->join('user', 'user.user_code=prospek.petugas_code');
            $this->db->join('region', 'region.id=user.region_id');
            $this->db->join('user_role', 'user_role.id=user.role_id');
            $this->db->where('region', $region);
            $this->db->where('role_id', 6);
            $this->db->order_by('id_prospek', 'DESC');
            return $this->db->get('prospek', $limit, $start)->result_array();
        }
    }

    public function CountProspectOfficer()
    {
        $region  = $this->session->userdata('region');
        $role_id = 3;

        $this->db->join('user', 'user.user_code=prospek.petugas_code');
        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->where('region', $region);
        $this->db->where('role_id !=', 3);
        $this->db->where('role_id !=', 4);
        return $this->db->count_all_results();
    }

    public function InsertProspect()
    {
        $user_code = $this->session->userdata('user_code');

        $data = [
            "tgl"           => date('Y-m-d'),
            "petugas_code"  => $user_code,
            "prospek"       => $this->input->post('plan', true),
            "keterangan"    => $this->input->post('target', true)
        ];

        $this->db->insert('prospek', $data);
    }

    public function UpdateProspect()
    {
        $data = [
            "prospek"     => $this->input->post('plan', true),
            "keterangan"  => $this->input->post('target', true),
            "status"      => $this->input->post('status', true)
        ];

        $this->db->where("id_prospek", $this->input->post('id_prospek', true));
        return $this->db->update("prospek", $data);
    }

    public function DeleteProspect($id)
    {
        $this->db->where("id_prospek", $id);
        return $this->db->delete("prospek");
    }
}
