<?php defined('BASEPATH') or exit('No direct script access allowed');
class Master_Model extends ci_Model
{
    // QUERY USERS
    public function GetUser($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('name', $keyword);
            $this->db->or_like('email', $keyword);
            $this->db->or_like('role', $keyword);
            $this->db->or_like('region', $keyword);
            $this->db->or_like('user_code', $keyword);
        }
        $this->db->select('user.id, name, email, role, region, user_code, is_active, m_access, date_created');
        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        return $this->db->get('user', $limit, $start)->result_array();
    }

    public function GetUserEdit()
    {
        return $this->db->get('user')->result_array();
    }

    public function ListRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function ListRegion()
    {
        return $this->db->get('region')->result_array();
    }

    public function ListPetugas()
    {
        $this->db->where('role_id', '5');
        $this->db->where('is_active', '1');
        return $this->db->get('user')->result_array();
    }

    public function UpdateUser()
    {
        $data = [
            "id"            => $this->input->post('id', true),
            "email"         => $this->input->post('email', true),
            "role_id"       => $this->input->post('role_id', true),
            "region_id"     => $this->input->post('region_id', true),
            "user_code"     => $this->input->post('user_code', true),
            "is_active"     => $this->input->post('is_active', true),
            "m_access"      => $this->input->post('m_access', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("user", $data);
    }

    public function DeleteUser($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user");
    }

    public function UserImport($data)
    {
        $insert = $this->db->insert_batch('user', $data);
        if ($insert) {
            return true;
        }
    }

    // QUERY DEBITUR
    public function GetDebitur($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kd_credit', $keyword);
            $this->db->or_like('no_cif', $keyword);
            $this->db->or_like('no_spk', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
            $this->db->or_like('alamat', $keyword);
            $this->db->or_like('noacc_droping', $keyword);
            $this->db->or_like('telepon', $keyword);
            $this->db->or_like('bidang', $keyword);
            $this->db->or_like('name', $keyword);
        }
        $this->db->select('debitur.id, kd_credit, nama_debitur, wilayah, plafond, jw, metode_rps, name');
        $this->db->join('user', 'user.user_code=debitur.kd_petugas');
        return $this->db->get('debitur', $limit, $start)->result_array();
    }

    public function DebiturImport($data)
    {
        $insert = $this->db->insert_batch('debitur', $data);
        if ($insert) {
            return true;
        }
    }

    public function GetDebiturId($id)
    {
        return $this->db->get_where('debitur', ['id' => $id])->row_array();
    }

    public function UpdateDebitur()
    {
        $data = [
            "wilayah"    => $this->input->post('wilayah', true),
            "bidang"     => $this->input->post('bidang', true),
            "kd_petugas" => $this->input->post('kd_petugas', true),
        ];

        $this->db->where("id", $this->input->post('id', true));
        return $this->db->update("debitur", $data);
    }

    public function DeleteAllDebitur()
    {
        $this->db->empty_table('debitur');
    }

    // QUERY DEBITUR WO
    public function GetDebiturWo($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('kd_credit', $keyword);
            $this->db->or_like('no_cif', $keyword);
            $this->db->or_like('no_spk', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
            $this->db->or_like('alamat', $keyword);
            $this->db->or_like('wilayah', $keyword);
            $this->db->or_like('name', $keyword);
        }
        $this->db->select('debitur_wo.id, kd_credit, nama_debitur, wilayah, plafond, jw, metode_rps, os_sebelumnya, os_akhir, tgk_denda, tgk_bunga, penyelesaian, name');
        $this->db->join('user', 'user.user_code=debitur_wo.kd_petugas');
        return $this->db->get('debitur_wo', $limit, $start)->result_array();
    }

    public function DebiturWoImport($data)
    {
        $insert = $this->db->insert_batch('debitur_wo', $data);
        if ($insert) {
            return true;
        }
    }

    public function DeleteAllDebiturWo()
    {
        $this->db->empty_table('debitur_wo');
    }

    // QUERY TUNGGAKAN
    public function GetTunggakan($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_debitur', $keyword);
            $this->db->or_like('kd_credit', $keyword);
        }
        $this->db->join('debitur', 'debitur.kd_credit=tunggakan.debitur_code');
        return $this->db->get('tunggakan', $limit, $start)->result_array();
    }

    public function TunggakanImport($data)
    {
        $insert = $this->db->insert_batch('tunggakan', $data);
        if ($insert) {
            return true;
        }
    }

    public function TunggakanUpdate($data)
    {
        $update = $this->db->update_batch('tunggakan', $data, 'debitur_code');
        if ($update) {
            return true;
        }
    }

    public function TunggakanDebitur($data)
    {
        $update = $this->db->update_batch('debitur', $data, 'kd_credit');
        if ($update) {
            return true;
        }
    }

    public function DeleteAllTunggakan()
    {
        $this->db->empty_table('tunggakan');
    }

    // QUERY FOR AGUNAN
    public function GetAgunan($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('debitur_id', $keyword);
            $this->db->or_like('nama_debitur', $keyword);
        }
        $this->db->select('agunan.id, debitur_id, nama_debitur, agunan');
        $this->db->join('debitur', 'debitur.kd_credit=agunan.debitur_id');
        return $this->db->get('agunan', $limit, $start)->result_array();
    }

    public function AgunanImport($data)
    {
        $insert = $this->db->insert_batch('agunan', $data);
        if ($insert) {
            return true;
        }
    }

    public function DeleteAllAgunan()
    {
        $this->db->empty_table('agunan');
    }
}
