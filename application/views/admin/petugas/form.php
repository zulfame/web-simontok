<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
			<form method="post" action="<?php echo base_url("index.php/petugas/form"); ?>" enctype="multipart/form-data">
				<input type="file" name="file" class="form-control"><br>
				<button type="submit" name="preview" class='btn btn-success'><i class="fa fa-eye"></i> Preview</button><p>
			</form>

			<?php
			if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
				if(isset($upload_error)){ // Jika proses upload gagal
					echo " <div class='alert alert-danger' role='alert'>".$upload_error."</div>";// Muncul pesan error upload
					die; // stop skrip
				}

				// Buat sebuah tag form untuk proses import data ke database
				echo "<form method='post' action='".base_url("petugas/import")."'>";

				// Buat sebuah div untuk alert validasi kosong
				echo "<div style='color: red;' id='kosong'>
				Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
				</div>";

				echo "<table id='example' class='table table-bordered table-hover' cellpadding='8'>
				<tr>
					<th colspan='6' class='text-center'>Preview Data</th>
				</tr>
				<tr>
					<th class='text-center'>NIP</th>
					<th class='text-center'>KD Petugas</th>
					<th class='text-center'>Nama</th>
					<th class='text-center'>NIK</th>
					<th class='text-center'>Posisi</th>
					<th class='text-center'>Wilayah</th>
				</tr>";

				$numrow = 1;
				$kosong = 0;

				// Lakukan perulangan dari data yang ada di excel
				// $sheet adalah variabel yang dikirim dari controller
				foreach($sheet as $row){
					// Ambil data pada excel sesuai Kolom
					$nip = $row['A']; // Ambil data NIS
					$kd_petugas = $row['B']; // Ambil data nama
					$nama = $row['C']; // Ambil data jenis kelamin
					$nik = $row['D']; // Ambil data alamat
					$posisi = $row['E']; // Ambil data alamat
					$wilayah = $row['F']; // Ambil data alamat

					// Cek jika semua data tidak diisi
					if($nip == "" && $kd_petugas == "" && $nama == "" && $nik == "" && $posisi == "" && $wilayah == "")
						continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

					// Cek $numrow apakah lebih dari 1
					// Artinya karena baris pertama adalah nama-nama kolom
					// Jadi dilewat saja, tidak usah diimport
					if($numrow > 1){
						// Validasi apakah semua data telah diisi
						$nip_td = ( ! empty($nip))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
						$kd_petugas_td = ( ! empty($kd_petugas))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
						$nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
						$nik_td = ( ! empty($nik))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$posisi_td = ( ! empty($posisi))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$wilayah_td = ( ! empty($wilayah))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

						// Jika salah satu data ada yang kosong
						if($nip == "" or $kd_petugas == "" or $nama == "" or $nik == "" or $posisi == "" or $wilayah == ""){
							$kosong++; // Tambah 1 variabel $kosong
						}

						echo "<tr>";
						echo "<td".$nip_td.">".$nip."</td>";
						echo "<td".$kd_petugas_td.">".$kd_petugas."</td>";
						echo "<td".$nama_td.">".$nama."</td>";
						echo "<td".$nik_td.">".$nik."</td>";
						echo "<td".$posisi_td.">".$posisi."</td>";
						echo "<td".$wilayah_td.">".$wilayah."</td>";
						echo "</tr>";
					}

					$numrow++; // Tambah 1 setiap kali looping
				}

				echo "</table>";

				// Cek apakah variabel kosong lebih dari 0
				// Jika lebih dari 0, berarti ada data yang masih kosong
				if($kosong > 0){
				?>
					<script>
					$(document).ready(function(){
						// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
						$("#jumlah_kosong").html('<?php echo $kosong; ?>');

						$("#kosong").show(); // Munculkan alert validasi kosong
					});
					</script>

					<button type='submit' name='import' class='btn btn-default pull-right'><i class='fa fa-save'></i> Import</button>
					<a href='".base_url("petugas")."' class='btn btn-default pull-left'><i class='fa fa-arrow-circle-left'></i> Kembali</a>
				<?php
				}else{ // Jika semua data sudah diisi

					// Buat sebuah tombol untuk mengimport data ke database
					echo "<button type='submit' name='import' class='btn btn-default pull-right'><i class='fa fa-save'></i> Import</button>";
					echo "<a href='".base_url("petugas")."' class='btn btn-default pull-left'><i class='fa fa-arrow-circle-left'></i> Kembali</a>";
				}

				echo "</form>";
			}
			?>

        </div>
      </div>
    </div>
  </div>
</section>