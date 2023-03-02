<?php defined('BASEPATH') OR exit('No direct script access allowed');
class St_Model extends ci_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	// GetDataUser
	function GetDataUser()
	{
		$this->db2->select('*');
		$this->db2->from('petugas');
		return $this->db2->get()->result();
	}
}