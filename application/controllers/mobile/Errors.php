<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Errors extends CI_Controller
{
    public function index()
    {
        $data['title'] = '404';
        $this->load->view('mobile/templates/auth_header', $data);
        $this->load->view('mobile/auth/page-blocked');
        $this->load->view('mobile/templates/auth_footer');
    }

    public function maintenance()
    {
        $data['title'] = '404';
        $this->load->view('mobile/templates/auth_header', $data);
        $this->load->view('mobile/auth/page-under-construction');
    }
}
