<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('excel','session'));
	}

	public function index()
	{
		$this->load->model('Import_Model');
		$data = array(
			'list_data'	=> $this->Import_Model->getData()
		);
		$this->load->view('import_excel.php',$data);
	}

	public function import_debutur(){
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$id			 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$kd_credit	 		= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$no_cif 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$no_spk 			= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$nama_debitur 		= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$alamat			 	= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$kd_petugas 		= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$metode_rps 		= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$jw 				= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$tgl_realisasi 		= $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$tgl_jth_tempo 		= $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$rate 				= $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$noacc_droping 		= $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$telepon 			= $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$plafond			= $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$wilayah			= $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					$bidang				= $worksheet->getCellByColumnAndRow(21, $row)->getValue();
					$os_akhir			= $worksheet->getCellByColumnAndRow(22, $row)->getValue();
					$temp_data[] 		= array(
						'id'			=> $id,
						'kd_credit'		=> $kd_credit,
						'no_cif'		=> $no_cif,
						'no_spk'		=> $no_spk,
						'nama_debitur'	=> $nama_debitur,
						'alamat'		=> $alamat,
						'kd_petugas'	=> $kd_petugas,
						'metode_rps'	=> $metode_rps,
						'jw'			=> $jw,
						'tgl_realisasi'	=> $tgl_realisasi,
						'tgl_jth_tempo'	=> $tgl_jth_tempo,
						'rate'			=> $rate,
						'noacc_droping'	=> $noacc_droping,
						'telepon'		=> $telepon,
						'plafond'		=> $plafond,
						'wilayah'		=> $wilayah,
						'bidang'		=> $bidang,
						'os_akhir'		=> $os_akhir,
					);
					$temp_data2[] 		= array(
						'idtunggakan'	=> $id,
						'kd_credit'		=> $kd_credit
					);
					$temp_data3[] 		= array(
						'id_monitoring'	=> $id,
						'id_debitur'	=> $kd_credit,
						'id_petugas'	=> $kd_petugas
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->insert_debitur($temp_data);
			$insert2 = $this->Import_Model->insert_tunggakan2($temp_data2);
			$insert3 = $this->Import_Model->insert_monitoring($temp_data3);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
				helper_log("add", "mengimport data debitur");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

	public function update_tunggakan()
	{
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$kd_credit	 	= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$call 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$baki_debet 	= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$hari_pokok 	= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$tgk_pokok		= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$hari_bunga 	= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$tgk_bunga 		= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$tgk_denda 		= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$temp_data[] 		= array(
						'kd_credit'		=> $kd_credit,
						'call'			=> $call,
						'baki_debet'	=> $baki_debet,
						'hari_pokok'	=> $hari_pokok,
						'tgk_pokok'		=> $tgk_pokok,
						'hari_bunga'	=> $hari_bunga,
						'tgk_bunga'		=> $tgk_bunga,
						'tgk_denda'		=> $tgk_denda,
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->update_tunggakan($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Tunggakan Berhasil Update');
				helper_log("add", "mengupdate data petugas");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}


	public function update_st()
	{
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$id_st	 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$no_st 			= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$id_user 		= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$id_petugas 	= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$id_debitur		= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$temp_data[] 		= array(
						'id_st'			=> $id_st,
						'no_st'			=> $no_st,
						'id_user'		=> $id_user,
						'id_petugas'	=> $id_petugas,
						'id_debitur'	=> $id_debitur,
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->update_st($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Tunggakan Berhasil Update');
				helper_log("add", "mengupdate data petugas");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}


	public function import_petugas()
	{
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$nip 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$kd_petugas	= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$nama 		= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$nik 		= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$posisi 	= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$wilayah 	= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$username 	= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$temp_data[] 		= array(
						'nip'			=> $nip,
						'kd_petugas'	=> $kd_petugas,
						'nama'			=> $nama,
						'nik'			=> $nik,
						'posisi'		=> $posisi,
						'wilayah'		=> $wilayah,
						'username'		=> $nip,
						'date_created' 	=> time(),
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->insert_petugas($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
				helper_log("add", "mengimport data petugas");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

	public function update_petugas()
	{
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$nip 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$kd_petugas	= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$nama 		= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$nik 		= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$posisi 	= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$wilayah 	= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$username 	= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$temp_data[] 		= array(
						'nip'			=> $nip,
						'kd_petugas'	=> $kd_petugas,
						'nama'			=> $nama,
						'nik'			=> $nik,
						'posisi'		=> $posisi,
						'wilayah'		=> $wilayah,
						'username'		=> $nip,
						'date_created' 	=> time(),
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->update_petugas($temp_data);
			if($insert){
				$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Update');
				helper_log("add", "mengupdate data petugas");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

	public function import_excel(){
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$kode_nasabah 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nama_debitur 		= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$alamat 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$no_telp 			= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$no_spk			 	= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$no_loan 			= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$no_cif 			= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$no_rek 			= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$plafon 			= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$suku_bunga 		= $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$jenis_pembayaran 	= $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$jk_waktu 			= $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$wilayah 			= $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$tgl_realisasi 		= $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$tgl_jth_tempo 		= $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$jenis_penggunaan 	= $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					$temp_data[] 		= array(
						'kode_nasabah'		=> $kode_nasabah,
						'nama_debitur'		=> $nama_debitur,
						'alamat'			=> $alamat,
						'no_telp'			=> $no_telp,
						'no_spk'			=> $no_spk,
						'no_loan'			=> $no_loan,
						'no_cif'			=> $no_cif,
						'no_rek'			=> $no_rek,
						'plafon'			=> $plafon,
						'suku_bunga'		=> $suku_bunga,
						'jenis_pembayaran'	=> $jenis_pembayaran,
						'jk_waktu'			=> $jk_waktu,
						'wilayah'			=> $wilayah,
						'tgl_realisasi'		=> $tgl_realisasi,
						'tgl_jth_tempo'		=> $tgl_jth_tempo,
						'jenis_penggunaan'	=> $jenis_penggunaan
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->insert($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
				helper_log("add", "mengimport data debitur");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

	public function import_agunan()
	{
		if (isset($_FILES["fileExcel"]["name"])) {
			$path 	= $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow 	= $worksheet->getHighestRow();
				$highestColumn 	= $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$idagunan	 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$lokasi 			= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$agunan 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$temp_data[] 		= array(
						'idagunan'		=> $idagunan,
						'lokasi'		=> $lokasi,
						'agunan'		=> $agunan,
					); 	
				}
			}
			$this->load->model('Import_Model');
			$insert = $this->Import_Model->insert_agunan($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
				helper_log("add", "mengimport data agunan");
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

}