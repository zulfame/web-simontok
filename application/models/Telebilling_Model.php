<?php defined('BASEPATH') or exit('No direct script access allowed');
class Telebilling_Model extends ci_Model
{
    // QUERY DEBITUR BERDASARKAN WILAYAH
    public function GetDebiturKalijati($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "KALIJATI";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturKalijati()
    {
        $region = "KALIJATI";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturSubang($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "SUBANG";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturSubang()
    {
        $region = "SUBANG";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturPagaden($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "PAGADEN";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturPagaden()
    {
        $region = "PAGADEN";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturSukamandi($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "SUKAMANDI";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturSukamandi()
    {
        $region = "SUKAMANDI";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturJalancagak($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "JALANCAGAK";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturJalancagak()
    {
        $region = "JALANCAGAK";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturPusakajaya($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "PUSAKAJAYA";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturPusakajaya()
    {
        $region = "PUSAKAJAYA";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    public function GetDebiturPamanukan($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('hari_pokok', $keyword);
        }

        $region = "PAMANUKAN";

        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, kd_petugas, wilayah, telepon');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        // $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->order_by('hari_pokok', 'ACS');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function CountDebiturPamanukan()
    {
        $region = "PAMANUKAN";

        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->where('debitur.wilayah', $region);
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        return $this->db->count_all_results();
    }

    // QUERY KMD
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
        $role_id = 7;

        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('debitur_code', $id);
        $this->db->where('role_id', $role_id);
        return $this->db->get_where('surat_tugas')->result_array();
    }

    // QUERY GET TODAY
    public function GetToday($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tgl', $keyword);
        }

        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        $this->db->select('id_st, petugas_code, tgl, debitur.kd_credit, nama_debitur, no_st, user.name, pelaksanaan, d_pelaksanaan, hasil, d_hasil, catatan, tunggakan.tgk_pokok, tunggakan.tgk_denda, tunggakan.tgk_bunga, telepon, debitur.wilayah, tgl_awal, tgl_akhir, jb');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        //$this->db->where('tgl', $tgl);
        $this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas', $limit, $start)->result_array();
    }

    public function CountToday()
    {
        $tgl = date('Y-m-d');
        $user_code = $this->session->userdata('user_code');

        $this->db->join('waktu', 'waktu.`idwaktu`=surat_tugas.`idwaktu`');
        $this->db->where('petugas_code', $user_code);
        //$this->db->where('tgl', $tgl);
        $this->db->where("tgl BETWEEN tgl_awal AND tgl_akhir");
        return $this->db->count_all_results();
    }

    public function InsertToday()
    {
        $lastKode    = substr(md5(microtime()), rand(0, 26), 6);
        $tgl         = date("d/m/Y");
        $newKode     = "ST" . "/" . $lastKode . "/" . "TBL" . "/" . $tgl;
        $user_code   = $this->session->userdata('user_code');
        $leader_code = "THT";

        $data = [
            "no_st"         => $newKode,
            "leader_code"   => $leader_code,
            "petugas_code"  => $user_code,
            "tgl"           => date('Y-m-d'),
            "debitur_code"  => $this->input->post('kd_credit', true),
            "tgk_pokok"     => $this->input->post('tgk_pokok', true),
            "tgk_bunga"     => $this->input->post('tgk_bunga', true),
            "tgk_denda"     => $this->input->post('tgk_denda', true),
            "pelaksanaan"   => $this->input->post('pelaksanaan', true),
            "d_pelaksanaan" => $this->input->post('d_pelaksanaan', true),
            "hasil"         => $this->input->post('hasil', true),
            "d_hasil"       => $this->input->post('d_hasil', true),
            "jb"            => $this->input->post('jb', true),
        ];

        $this->db->insert('surat_tugas', $data);
    }

    public function UpdateToday()
    {
        $data = [
            "hasil"         => $this->input->post('hasil', true),
            "d_hasil"       => $this->input->post('d_hasil', true),
            "jb"            => $this->input->post('jb', true),
        ];

        $this->db->where("id_st", $this->input->post('id_st', true));
        return $this->db->update("surat_tugas", $data);
    }

    public function DeleteToday($id)
    {
        $this->db->where("id_st", $id);
        return $this->db->delete("surat_tugas");
    }

    // QUERY REPORT
    public function GetReport()
    {
        $user_code = $this->session->userdata('user_code');
        $tgl = date('Y-m-d');

        //$this->db->select('tgl, no_st, debitur.kd_credit, nama_debitur, telepon, debitur.wilayah,  hasil, d_hasil, catatan, jb, user.name, kd_petugas, name');
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->join('tunggakan', 'tunggakan.`debitur_code`=debitur.`kd_credit`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('wilayah', 'ASC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function ExportDebitur()
    {
        $this->db->select('debitur.`kd_credit`, nama_debitur, tunggakan.`call`, baki_debet, tgk_pokok, tgk_bunga, tgk_denda, hari_pokok, hari_bunga, tgl_realisasi, tgl_jth_tempo, user.`name`, no_cif, no_spk, alamat, metode_rps, jw, rate, plafond, telepon, name, wilayah');
        $this->db->join('debitur', 'debitur.`kd_credit`=tunggakan.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=debitur.`kd_petugas`');
        $this->db->where("hari_pokok BETWEEN '1' AND '30'");
        $this->db->order_by('hari_pokok', 'ACS');
        $this->db->order_by('wilayah', 'ACS');
        return $this->db->get('tunggakan')->result_array();
    }
}
