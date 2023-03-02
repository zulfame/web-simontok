<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function index ()
    {
        if($this->session->userdata('level')=='Administrator')
        {
            // Load the DB utility class
        $this->load->dbutil();

        // Backup database dan dijadikan variable
        $backup = $this->dbutil->backup();
        $namafile = "backup_simontok". "_" . date("Ymd") . ".gz";

        // Load file helper dan menulis ke server untuk keperluan restore
        $this->load->helper('file');
        write_file(FCPATH .'database/'.$namafile, $backup);

        // Load the download helper dan melalukan download ke komputer
        $this->load->helper('download');
        force_download($namafile, $backup);
        } else
        {
            $this->load->view('templates/404.php');
        } 
    }

}
