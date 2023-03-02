<?php

    function helper_log($tipe = "", $str = "")
    {
        $CI =& get_instance();
     
        if (strtolower($tipe) == "login"){
            $log_tipe   = 0;
        }
        elseif(strtolower($tipe) == "logout")
        {
            $log_tipe   = 1;
        }
        elseif(strtolower($tipe) == "add"){
            $log_tipe   = 2;
        }
        elseif(strtolower($tipe) == "edit"){
            $log_tipe  = 3;
        }
        elseif(strtolower($tipe) == "hapus"){
            $log_tipe  = 4;
        }
        else{
            $log_tipe  = 5;
        }
     
        // paramter
        $param['log_user']      = $CI->session->userdata('nama');
        $param['log_tipe']      = $log_tipe;
        $param['log_desc']      = $str;
     
        //load model log
        $CI->load->model('Log_Model');
     
        //save to database
        $CI->Log_Model->save_log($param);

    }
?> 