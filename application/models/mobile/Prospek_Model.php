<?php defined('BASEPATH') or exit('No direct script access allowed');
class Prospek_Model extends ci_Model
{
    public function GetProspect()
    {
        $user_code  = $this->session->userdata('user_code');

        $this->db->join('user', 'user.`user_code`=prospek.`petugas_code`');
        $this->db->where('petugas_code', $user_code);
        $this->db->order_by('id_prospek', 'DESC');
        return $this->db->get('prospek')->result_array();
    }

    public function InsertProspect()
    {
        $petugas_code = $this->session->userdata('user_code');

        $data = [
            "tgl"           => date('Y-m-d'),
            "petugas_code"  => $petugas_code,
            "prospek"       => $this->input->post('hunting', true),
            "calon_debitur" => $this->input->post('candidate', true),
            "no_hp"         => $this->input->post('telp', true),
            "keterangan"    => $this->input->post('description', true),
        ];

        $this->db->insert('prospek', $data);
    }

    public function GetProspek($id)
    {
        $this->db->where('id_prospek', $id);
        return $this->db->get('prospek')->row_array();
    }

    public function UpdateProspek()
    {
        $data = [
            "prospek"       => $this->input->post('hunting', true),
            "calon_debitur" => $this->input->post('candidate', true),
            "no_hp"         => $this->input->post('telp', true),
            "keterangan"    => $this->input->post('description', true),
            "status"        => $this->input->post('status', true),
        ];

        $this->db->where("id_prospek", $this->input->post('id_prospek', true));
        return $this->db->update("prospek", $data);
    }

    public function DeleteProspect($id)
    {
        $this->db->where("id_prospek", $id);
        return $this->db->delete("prospek");
    }

    public function InsertProspectKs()
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
}
