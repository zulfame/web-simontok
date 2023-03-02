<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_Model');
	}

	public function index()
	{
		$data['title'] = 'SIMONTOK - Login';

		if($this->session->userdata("level"))
		{
			redirect("masuk");
		}
		$this->load->view('templates/login', $data);
	}
	public function ceklogin()
	{
		$this->load->model("Login_Model");
		$this->Login_Model->ceklogin();
	}

	public function logout()
	{
		$this->session->sess_destroy();
		helper_log("logout", "logout");
		redirect("masuk");
	}
}
?>
