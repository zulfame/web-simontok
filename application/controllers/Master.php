<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != TRUE) {
            $url = base_url();
            redirect($url);
        }

        is_logged_in();
        $this->load->model('Master_Model');
    }

    // QUERY USERS
    public function user()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword', true);
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('name', $data['keyword']);
        $this->db->or_like('email', $data['keyword']);
        $this->db->or_like('role', $data['keyword']);
        $this->db->or_like('region', $data['keyword']);
        $this->db->or_like('user_code', $data['keyword']);
        $this->db->join('region', 'region.id=user.region_id');
        $this->db->join('user_role', 'user_role.id=user.role_id');
        $this->db->from('user');

        $config['base_url']     = site_url('master/user');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $choice                 = $config["total_rows"] / $config["per_page"];
        $config["num_links"]    = floor($choice);
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['all_user']   = $this->Master_Model->GetUser($config["per_page"], $data['page'], $data['keyword']);

        $data['active']     = ['1', '0'];
        $data['m_access']   = ['1', '0'];
        $data['edit']       = $this->Master_Model->GetUserEdit();

        $data['title']      = 'Data User';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['position']   = $this->Master_Model->ListRole();
        $data['wilayah']    = $this->Master_Model->ListRegion();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/user/index', $data);
        $this->load->view('templates/footer');
        //$this->session->unset_userdata('keyword');
    }

    public function user_edit()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');
        $this->form_validation->set_rules('region_id', 'Region', 'required|trim');
        $this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message_failed', 'Failed to Change');
            redirect('master/user');
        } else {
            $this->Master_Model->UpdateUser();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function user_delete($id)
    {
        $this->Master_Model->DeleteUser($id);
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function user_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id              = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $name            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $email           = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $image           = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $password        = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $role_id         = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $region_id       = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $user_code       = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $is_active       = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $m_access        = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $data_user[]       = array(
                        'id'           => $id,
                        'name'         => $name,
                        'email'        => $email,
                        'image'        => $image,
                        'password'     => $password,
                        'role_id'      => $role_id,
                        'region_id'    => $region_id,
                        'user_code'    => $user_code,
                        'is_active'    => $is_active,
                        'm_access'     => $m_access,
                        'date_created' => time()
                    );
                }
            }
            $insert = $this->Master_Model->UserImport($data_user);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/user');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/user');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    // QUERY DEBITUR
    public function debitur()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('kd_credit', $data['keyword']);
        $this->db->or_like('no_cif', $data['keyword']);
        $this->db->or_like('no_spk', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->or_like('alamat', $data['keyword']);
        $this->db->or_like('noacc_droping', $data['keyword']);
        $this->db->or_like('telepon', $data['keyword']);
        $this->db->or_like('bidang', $data['keyword']);
        $this->db->or_like('name', $data['keyword']);
        $this->db->select('debitur.id, kd_credit, nama_debitur, wilayah, plafond, jw, metode_rps, name');
        $this->db->join('user', 'user.user_code=debitur.kd_petugas');
        $this->db->from('debitur');

        $config['base_url']     = site_url('master/debitur');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur']    = $this->Master_Model->GetDebitur($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Data Debitur';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['wilayah']    = ['KALIJATI', 'JALANCAGAK', 'PAGADEN', 'PAMANUKAN', 'PUSAKAJAYA', 'SUBANG', 'SUKAMANDI'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/debitur/index', $data);
        $this->load->view('templates/footer');
    }

    public function debitur_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id                 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $kd_credit          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $no_cif             = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $no_spk             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jenis_id           = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $nama_debitur       = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $alamat             = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $wilayah            = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $bidang             = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $kd_petugas         = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $plafond            = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $os_akhir           = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $metode_rps         = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $jw                 = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $tgl_realisasi      = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $tgl_jth_tempo      = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $rate               = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $call               = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $noacc_droping      = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $kd_resort          = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $hr_p               = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
                    $tunggakan_p        = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
                    $hr_b               = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
                    $tunggakan_b        = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
                    $tunggakan_d        = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
                    $tunggakan_h        = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
                    $telepon            = $worksheet->getCellByColumnAndRow(27, $row)->getValue();
                    $telepon2           = $worksheet->getCellByColumnAndRow(28, $row)->getValue();
                    $japo               = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
                    $data_debitur[]     = array(
                        'id'            => $id,
                        'kd_credit'     => $kd_credit,
                        'no_cif'        => $no_cif,
                        'no_spk'        => $no_spk,
                        'jenis_id'      => $jenis_id,
                        'nama_debitur'  => $nama_debitur,
                        'alamat'        => $alamat,
                        'wilayah'       => $wilayah,
                        'bidang'        => $bidang,
                        'kd_petugas'    => $kd_petugas,
                        'plafond'       => $plafond,
                        'os_akhir'      => $os_akhir,
                        'metode_rps'    => $metode_rps,
                        'jw'            => $jw,
                        'tgl_realisasi' => $tgl_realisasi,
                        'tgl_jth_tempo' => $tgl_jth_tempo,
                        'rate'          => $rate,
                        'call'          => $call,
                        'noacc_droping' => $noacc_droping,
                        'kd_resort'     => $kd_resort,
                        'hr_p'          => $hr_p,
                        'tunggakan_p'   => $tunggakan_p,
                        'hr_b'          => $hr_b,
                        'tunggakan_b'   => $tunggakan_b,
                        'tunggakan_d'   => $tunggakan_d,
                        'tunggakan_h'   => $tunggakan_h,
                        'telepon'       => $telepon,
                        'telepon2'      => $telepon2,
                        'japo'          => $japo,
                    );
                    $data_tunggakan[]   = array(
                        'idtunggakan'   => $id,
                        'debitur_code'  => $kd_credit,
                        'call'          => 1,
                    );
                }
            }
            $insert = $this->Master_Model->DebiturImport($data_debitur);
            $this->Master_Model->TunggakanImport($data_tunggakan);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/debitur');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/debitur');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function debitur_edit($id)
    {
        $data['title']      = 'Data Debitur';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();
        $data['debitur']    = $this->Master_Model->GetDebiturId($id);
        $data['petugas']    = $this->Master_Model->ListPetugas();
        $data['wilayah']    = ['JALANCAGAK', 'KALIJATI', 'PAGADEN', 'PAMANUKAN', 'PUSAKAJAYA', 'SUBANG', 'SUKAMANDI'];
        $data['bidang']     = ['JALANCAGAK', 'KALIJATI', 'PAGADEN', 'PAMANUKAN', 'PUSAKAJAYA', 'REMEDIAL', 'SUBANG', 'SUKAMANDI'];


        $this->form_validation->set_rules('wilayah', 'Wilayah', 'required|trim');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required|trim');
        $this->form_validation->set_rules('kd_petugas', 'KD Petugas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('master/debitur/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Master_Model->UpdateDebitur();
            $this->session->unset_userdata('keyword');
            $this->session->set_flashdata('message', 'Changed');
            redirect('master/debitur');
        }
    }

    public function dabitur_delete_all()
    {
        $this->Master_Model->DeleteAllDebitur();
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect('master/debitur');
    }

    // QUERY DEBITUR WO
    public function debitur_wo()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('kd_credit', $data['keyword']);
        $this->db->or_like('no_cif', $data['keyword']);
        $this->db->or_like('no_spk', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->or_like('alamat', $data['keyword']);
        $this->db->or_like('wilayah', $data['keyword']);
        $this->db->or_like('name', $data['keyword']);

        $this->db->select('debitur_wo.id, kd_credit, nama_debitur, wilayah, plafond, jw, metode_rps, os_sebelumnya, os_akhir, tgk_denda, tgk_bunga, penyelesaian, name');
        $this->db->join('user', 'user.user_code=debitur_wo.kd_petugas');
        $this->db->from('debitur_wo');

        $config['base_url']     = site_url('master/debitur_wo');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['debitur_wo'] = $this->Master_Model->GetDebiturWo($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Data Debitur WO';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/debitur/debitur_wo', $data);
        $this->load->view('templates/footer');
    }

    public function debitur_wo_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id                 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $kd_credit          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $no_cif             = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $no_spk             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $nama_debitur       = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $alamat             = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $wilayah            = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $kd_petugas         = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $plafond            = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $os_akhir           = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $metode_rps         = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $jw                 = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $tgl_realisasi      = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                    $tgl_jth_tempo      = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
                    $rate               = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                    $call               = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
                    $os_sebelumnya      = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
                    $tgk_bunga          = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
                    $tgk_denda          = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
                    $penyelesaian       = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
                    $data_debitur[]     = array(
                        'id'            => $id,
                        'kd_credit'     => $kd_credit,
                        'no_cif'        => $no_cif,
                        'no_spk'        => $no_spk,
                        'nama_debitur'  => $nama_debitur,
                        'alamat'        => $alamat,
                        'kd_petugas'    => $kd_petugas,
                        'metode_rps'    => $metode_rps,
                        'jw'            => $jw,
                        'tgl_realisasi' => $tgl_realisasi,
                        'tgl_jth_tempo' => $tgl_jth_tempo,
                        'rate'          => $rate,
                        'call'          => $call,
                        'wilayah'       => $wilayah,
                        'plafond'       => $plafond,
                        'os_sebelumnya' => $os_sebelumnya,
                        'tgk_bunga'     => $tgk_bunga,
                        'tgk_denda'     => $tgk_denda,
                        'penyelesaian'  => $penyelesaian,
                        'os_akhir'      => $os_akhir,
                    );
                }
            }
            $insert = $this->Master_Model->DebiturWoImport($data_debitur);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/debitur_wo');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/debitur_wo');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function debitur_wo_delete_all()
    {
        $this->Master_Model->DeleteAllDebiturWo();
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect('master/debitur_wo');
    }

    // QUERY TUNGGAKAN
    public function tunggakan()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword', true);
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('nama_debitur', $data['keyword']);
        $this->db->or_like('kd_credit', $data['keyword']);
        $this->db->join('debitur', 'debitur.kd_credit=tunggakan.debitur_code');
        $this->db->from('tunggakan');

        $config['base_url']     = site_url('master/tunggakan');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['tunggakan']  = $this->Master_Model->GetTunggakan($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Data Tunggakan';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/tunggakan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tunggakan_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $debitur_code   = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $call           = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $baki_debet     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $hari_pokok     = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tgk_pokok      = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $hari_bunga     = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $tgk_bunga      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $tgk_denda      = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $data_tunggakan[]    = array(
                        'debitur_code' => $debitur_code,
                        'call'         => $call,
                        'baki_debet'   => $baki_debet,
                        'hari_pokok'   => $hari_pokok,
                        'tgk_pokok'    => $tgk_pokok,
                        'hari_bunga'   => $hari_bunga,
                        'tgk_bunga'    => $tgk_bunga,
                        'tgk_denda'    => $tgk_denda,
                    );
                }
            }
            $insert = $this->Master_Model->TunggakanUpdate($data_tunggakan);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/tunggakan');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/tunggakan');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function tunggakan_debitur()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $debitur_code   = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $call           = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $baki_debet     = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $hari_pokok     = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tgk_pokok      = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $hari_bunga     = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $tgk_bunga      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $tgk_denda      = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $data_tunggakan[]    = array(
                        'kd_credit'     => $debitur_code,
                        'call'          => $call,
                        'os_akhir'      => $baki_debet,
                        'hr_p'          => $hari_pokok,
                        'tunggakan_p'   => $tgk_pokok,
                        'hr_b'          => $hari_bunga,
                        'tunggakan_b'   => $tgk_bunga,
                        'tunggakan_d'   => $tgk_denda,
                    );
                }
            }
            $insert = $this->Master_Model->TunggakanDebitur($data_tunggakan);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/debitur');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/debitur');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function tunggakan_delete_all()
    {
        $this->Master_Model->DeleteAllTunggakan();
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect('master/tunggakan');
    }

    // QUERY FOR AGUNAN
    public function agunan()
    {
        // SEARCH
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        //konfigurasi pagination
        $this->db->like('debitur_id', $data['keyword']);
        $this->db->or_like('nama_debitur', $data['keyword']);
        $this->db->select('agunan.id, debitur_id, nama_debitur, agunan');
        $this->db->join('debitur', 'debitur.kd_credit=agunan.debitur_id');
        $this->db->from('agunan');

        $config['base_url']     = site_url('master/agunan');
        $config['total_rows']   = $this->db->count_all_results();
        $config['per_page']     = 10;
        $data['total_rows']     =  $config['total_rows'];

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $data['page']       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['agunan']     = $this->Master_Model->GetAgunan($config["per_page"], $data['page'], $data['keyword']);

        $data['title']      = 'Data Agunan';
        $data['site']       = $this->Site_Model->GetData();
        $data['user']       = $this->User_Model->GetProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('master/agunan/index', $data);
        $this->load->view('templates/footer');
    }

    public function agunan_import()
    {
        if (isset($_FILES["fileExcel"]["name"])) {
            $path     = $_FILES["fileExcel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow        = $worksheet->getHighestRow();
                $highestColumn     = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $id                 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $debitur_id       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $agunan             = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $data_agunan[]     = array(
                        'id'            => $id,
                        'debitur_id'  => $debitur_id,
                        'agunan'        => $agunan,
                    );
                }
            }
            $insert = $this->Master_Model->AgunanImport($data_agunan);
            if ($insert) {
                $this->session->set_flashdata('message', 'Imported');
                redirect('master/agunan');
            } else {
                $this->session->set_flashdata('message_failed', 'Import Failed');
                redirect('master/agunan');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }

    public function agunan_delete_all()
    {
        $this->Master_Model->DeleteAllAgunan();
        $this->session->unset_userdata('keyword');
        $this->session->set_flashdata('message', 'Deleted');
        redirect('master/agunan');
    }
}
