<?php defined('BASEPATH') or exit('No direct script access allowed');
class Telebilling_Model extends ci_Model
{
    // QUERY DEBITUR BERDASARKAN WILAYAH
    public function GetDebiturKalijati($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "KALIJATI";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturKalijati()
    {
        $region = "KALIJATI";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturSubang($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "SUBANG";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturSubang()
    {
        $region = "SUBANG";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturPagaden($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "PAGADEN";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturPagaden()
    {
        $region = "PAGADEN";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturSukamandi($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "SUKAMANDI";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturSukamandi()
    {
        $region = "SUKAMANDI";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturJalancagak($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "JALANCAGAK";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturJalancagak()
    {
        $region = "JALANCAGAK";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturPusakajaya($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "PUSAKAJAYA";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturPusakajaya()
    {
        $region = "PUSAKAJAYA";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        return $this->db->count_all_results();
    }

    public function GetDebiturPamanukan($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('tunggakan_h', $keyword);
        }

        $region = "PAMANUKAN";
        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
        $this->db->order_by('tunggakan_h', 'ACS');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function CountDebiturPamanukan()
    {
        $region = "PAMANUKAN";

        $this->db->where("tunggakan_h BETWEEN '1' AND '30'");
        $this->db->where('wilayah', $region);
        $this->db->where_not_in('jenis_id', '7');
        $this->db->where_not_in('jenis_id', '10');
        $this->db->where_not_in('jenis_id', '14');
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

        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('id_st', 'DESC');
        return $this->db->get('surat_tugas', $limit, $start)->result_array();
    }

    public function CountToday()
    {
        $tgl = date('Y-m-d');
        $user_code = $this->session->userdata('user_code');

        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
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

        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('wilayah', 'ASC');
        return $this->db->get('surat_tugas')->result_array();
    }

    public function ExportDebitur()
    {
        $this->db->join('debitur', 'debitur.`kd_credit`=surat_tugas.`debitur_code`');
        $this->db->join('user', 'user.`user_code`=surat_tugas.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->where('tgl', $tgl);
        $this->db->order_by('wilayah', 'ASC');
        return $this->db->get('tunggakan')->result_array();
    }
}
