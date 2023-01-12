<?php defined('BASEPATH') or exit('No direct script access allowed');
class Admin_Model extends ci_Model
{
    public function GetTime()
    {
        $id = 1;

        $this->db->where("idwaktu", $id);
        return $this->db->get('waktu')->row_array();
    }

    public function GetActivity()
    {
        $this->db->order_by('log_time', 'DESC');
        return $this->db->get('_log_auth')->result_array();
    }

    public function GetOnline()
    {
        $id = 1;

        $this->db->where("is_online", $id);
        return $this->db->get('user')->result_array();
    }

    public function CountOnline()
    {
        $id = 1;

        $this->db->where("is_online", $id);
        $this->db->from('user');
        return $this->db->count_all_results();
    }

    public function TimeUpdate()
    {
        $data = [
            "tgl_awal"  => $this->input->post('date1', true),
            "tgl_akhir" => $this->input->post('date2', true),
        ];

        $this->db->where("idwaktu", $this->input->post('id', true));
        return $this->db->update("waktu", $data);
    }
}
