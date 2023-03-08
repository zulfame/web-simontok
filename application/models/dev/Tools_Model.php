<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
 ***************************************************
 *   SIMONTOK (SISTEM MONITORING KREDIT) v2 2023   *
 ***************************************************
 * Dikembangkan oleh : Zulfadli Rizal              *
 * Email 	: hello@zulfame.id                     *
 * Website	: https://zulfame.id                   *
 * Telegram : 0823-200-999-71					   *
 * *************************************************
*/

class Tools_Model extends ci_Model
{
    public function GetReportMasking()
    {
        $this->db->select('nama_debitur, kd_credit, telpon, wilayah, bidang, kd_petugas, status, detail, date');
        $this->db->join('debitur', 'debitur.`telepon`=zfm_tools_masking.`telpon`');
        $this->db->order_by('wilayah', 'ASC');
        return $this->db->get('zfm_tools_masking')->result_array();
    }

    public function InsertBatchMasking($data)
    {
        $insert = $this->db->insert_batch('zfm_tools_masking', $data);
        if ($insert) {
            return true;
        }
    }

    public function EmptyMasking()
    {
        $this->db->empty_table('zfm_tools_masking');
    }
}
