<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Petugas extends CI_Controller {

	private $filename = "import_data_petugas"; // Kita tentukan nama filenya
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas_Model');
		if($this->session->userdata('level') != TRUE)
		{
            $url=base_url();
            redirect($url);
        }
	}
	
	// QUERY FOR ADMIN
	public function index()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['petugas']	= $this->Petugas_Model->data();
			$data['konten']		= "admin/petugas/index"	;
			$data['title'] 		= 'DATA PETUGAS';
			$data['judul'] 		= 'Data Petugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function tambah()
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['petugas']	= $this->Petugas_Model->tambah();
			helper_log("add", "menambahkan data petugas");
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Tambah');
			redirect("petugas");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$data['petugas']	= $this->Petugas_Model->edit($id);
			$data['konten']		= "admin/petugas/edit";
			$data['title'] 		= 'EDIT DATA PETUGAS';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}
	public function proses_edit($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Petugas_Model->proses_edit($id);
			helper_log("edit", "merubah data petugas");
			$this->session->set_flashdata('edit', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Ubah');
			redirect("petugas");
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

	public function hapus($id)
	{
		if($this->session->userdata('level')=='Administrator')
		{
			$this->Petugas_Model->hapus($id);
			helper_log("hapus", "menghapus data petugas");
			$this->session->set_flashdata('hapus', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Hapus');
			redirect("petugas");
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
				// lakukan upload file dengan memanggil function upload yang ada di Petugas_Model.php
				$upload = $this->Petugas_Model->upload_file($this->filename);
				
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

			$data['konten']	= "admin/petugas/form"	;
			$data['title']	= 'IMPORT DATA PETUGAS';
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
						'nip'			=>$row['A'], // Insert data nis dari kolom A di excel
						'kd_petugas'	=>$row['B'], // Insert data nama dari kolom B di excel
						'nama'			=>$row['C'], // Insert data jenis kelamin dari kolom C di excel
						'nik'			=>$row['D'], // Insert data alamat dari kolom D di excel
						'posisi'		=>$row['E'], // Insert data alamat dari kolom D di excel
						'wilayah'		=>$row['F'], // Insert data alamat dari kolom D di excel
						'username'		=>$row['A'], // Insert data alamat dari kolom D di excel
						'date_created' 	=> time(),
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->Petugas_Model->insert_multiple($data);
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import');
			helper_log("add", "mengimport data petugas");
			redirect("petugas"); // Redirect ke halaman awal (ke controller siswa fungsi index)
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
				// lakukan upload file dengan memanggil function upload yang ada di Petugas_Model.php
				$upload = $this->Petugas_Model->upload_file($this->filename);
				
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

			$data['konten']	= "admin/petugas/update";
			$data['title']	= 'UPDATE DATA PETUGAS';
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
			
			$excelreader 	= new PHPExcel_Reader_Excel2007();
			$loadexcel 		= $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
			$sheet 			= $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
			$data	= array();
			$numrow = 1;
			foreach($sheet as $row){
				// Cek $numrow apakah lebih dari 1
				// Artinya karena baris pertama adalah nama-nama kolom
				// Jadi dilewat saja, tidak usah diimport
				if($numrow > 1){
					// Kita push (add) array data ke variabel data
					array_push($data, array(
						'nip'			=> $row['A'], // Insert data nis dari kolom A di excel
						'kd_petugas'	=> $row['B'], // Insert data nama dari kolom B di excel
						'nama'			=> $row['C'], // Insert data jenis kelamin dari kolom C di excel
						'nik'			=> $row['D'], // Insert data alamat dari kolom D di excel
						'posisi'		=> $row['E'], // Insert data alamat dari kolom D di excel
						'wilayah'		=> $row['F'], // Insert data alamat dari kolom D di excel
					));
				}
				
				$numrow++; // Tambah 1 setiap kali looping
			}

			// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
			$this->Petugas_Model->update_multiple($data);
			$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data update Berhasil di Import');
			helper_log("add", "mengimport data update petugas");
			redirect("petugas"); // Redirect ke halaman awal (ke controller siswa fungsi index)
		}else
		{
			$this->load->view('templates/404.php');
		}
	}


	// QUERY FOR DIREKSI
	public function all()
	{
		if($this->session->userdata('level')=='Direksi')
		{
			$data['petugas']	= $this->Petugas_Model->data();
			$data['konten']		= "direksi/petugas/index"	;
			$data['title'] 		= 'DATA PETUGAS';
			$data['judul'] 		= 'Data Petugas';
			$this->load->view('templates/main',$data);
		} else
		{
			$this->load->view('templates/404.php');
		}
	}

}
?>