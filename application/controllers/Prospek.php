<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prospek extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Prospek_Model');
    }
}
