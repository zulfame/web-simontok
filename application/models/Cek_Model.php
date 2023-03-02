<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_Model extends CI_Model {
 // db2 digunakan untuk mengakses database ke-2
 private $db2;

 public function __construct()
 {
  parent::__construct();
         $this->db2 = $this->load->database('sqlsrv', TRUE);
 }
 public function Get_Pengguna()
 {
  return $this->db->get('pengguna');
 }
 public function Get_User()
 {
  return $this->db2->get('userprofile');
 }
} 