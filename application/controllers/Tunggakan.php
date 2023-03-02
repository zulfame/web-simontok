<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tunggakan extends CI_Controller {

	private $filename = "import_tunggakan"; // Kita tentukan nama filenya
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tunggakan_Model');
		$this->load->helper('rupiah_helper');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect($url);
        }
	}
	
	// Read
	public function index()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['tunggakan']=$this->Tunggakan_Model->data();
			$data['konten']="admin/tunggakan/index"	;
			$data['title'] = 'DATA TUNGGAKAN';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}

	}
	public function hapus_all()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Tunggakan_Model->hapus_all();
			helper_log("hapus", "menghapus semua data tunggakan");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Tunggakan Berhasil di Hapus');
			redirect("config");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function form()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data = array(); // Buat variabel $data sebagai array
			
			if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
				// lakukan upload file dengan memanggil function upload yang ada di Tunggakan_Model.php
				$upload = $this->Tunggakan_Model->upload_file($this->filename);
				
				if($upload['result'] == "success"){ // Jika proses upload sukses
					// Load plugin PHPExcel nya
					include APPPATH.'third_party/PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					
					// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
					// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
					$data['sheet'] = $sheet; 
				}else{ // Jika proses upload gagal
					$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				}
			}

			$data['konten']	= "admin/tunggakan/form"	;
			$data['title'] 	= 'List Petugas';
			$data['title'] = 'IMPORT DATA TUNGGAKAN';
			$this->load->view('templates/main', $data);
		}else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function import()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data = array();
			
			$numrow = 1;
			foreach($sheet as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					// Kita push (add) array data ke variabel data
					array_push($data, array(
						'kd_credit'			=>$row['C'],
						'call'	=>$row['AQ'],
						'baki_debet'			=>$row['Y'],
						'hari_pokok'			=>$row['AA'],
						'tgk_pokok'		=>$row['AC'],
						'hari_bunga'		=>$row['AE'],
						'tgk_bunga'		=>$row['AG'],
						'tgk_denda'		=>$row['AI'],
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->Tunggakan_Model->insert_multiple($data);
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
			helper_log("add", "mengimport data tunggakan");
			redirect("tunggakan"); // Redirect ke halaman awal (ke controller siswa fungsi index)
		}else
		{
			$this->load->view('templates/404.php');
		}
	}


	public function update()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data = array(); // Buat variabel $data sebagai array
			
			if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
				// lakukan upload file dengan memanggil function upload yang ada di Tunggakan_Model.php
				$upload = $this->Tunggakan_Model->upload_file($this->filename);
				
				if($upload['result'] == "success"){ // Jika proses upload sukses
					// Load plugin PHPExcel nya
					include APPPATH.'third_party/PHPExcel/PHPExcel.php';
					
					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
					
					// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
					// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
					$data['sheet'] = $sheet; 
				}else{ // Jika proses upload gagal
					$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				}
			}

			$data['konten']	= "admin/tunggakan/update"	;
			$data['title'] 	= 'List Petugas';
			$data['title'] = 'UPDATE DATA TUNGGAKAN';
			$this->load->view('templates/main', $data);
		}else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function import_update()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data = array();
			$data_d = array();
			
			$numrow = 1;
			foreach($sheet as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					// Kita push (add) array data ke variabel data
					array_push($data, array(
						'kd_credit'		=>$row['C'],
						'call'			=>$row['AQ'],
						'baki_debet'	=>$row['Y'],
						'hari_pokok'	=>$row['AA'],
						'tgk_pokok'		=>$row['AC'],
						'hari_bunga'	=>$row['AE'],
						'tgk_bunga'		=>$row['AG'],
						'tgk_denda'		=>$row['AI'],
					));

					array_push($data_d, array(
						'kd_credit'		=>$row['C'],
						'telepon'		=>$row['AO'],
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->Tunggakan_Model->update_multiple($data);
			$this->Tunggakan_Model->update_debitur($data_d);
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
			helper_log("add", "mengimport data tunggakan");
			redirect("tunggakan"); // Redirect ke halaman awal (ke controller siswa fungsi index)
		}else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>