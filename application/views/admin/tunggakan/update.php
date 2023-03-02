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
			<form method="post" action="<?php echo base_url("index.php/tunggakan/update"); ?>" enctype="multipart/form-data">
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
				echo "<form method='post' action='".base_url("tunggakan/import_update")."'>";

				// Buat sebuah div untuk alert validasi kosong
				echo "<div style='color: red;' id='kosong'>
				Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
				</div>";

				echo "<table id='example' class='table table-bordered table-hover' cellpadding='8'>
				<tr>
					<th colspan='8' class='text-center'>Preview Data</th>
				</tr>
				<tr>
					<th class='text-center'>NO CREDIT</th>
					<th class='text-center'>CALL</th>
					<th class='text-center'>BAKI DEBET</th>
					<th class='text-center'>HARI POKOK</th>
					<th class='text-center'>TGK POKOK</th>
					<th class='text-center'>HARI BUNGA</th>
					<th class='text-center'>TGK BUNGA</th>
					<th class='text-center'>TGK DENDA</th>
				</tr>";

				$numrow = 1;
				$kosong = 0;

				// Lakukan perulangan dari data yang ada di excel
				// $sheet adalah variabel yang dikirim dari controller
				foreach($sheet as $row){
					// Ambil data pada excel sesuai Kolom
					$kd_credit = $row['C'];
					$call = $row['AQ'];
					$baki_debet = $row['Y'];
					$hari_pokok = $row['AA'];
					$tgk_pokok = $row['AC'];
					$hari_bunga = $row['AE'];
					$tgk_bunga = $row['AG'];
					$tgk_denda = $row['AI'];

					// Cek jika semua data tidak diisi
					if($kd_credit == "" && $call == "" && $baki_debet == "" && $hari_pokok == "" && $tgk_pokok == "" && $hari_bunga == "" && $tgk_bunga == "" && $tgk_denda == "")
						continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

					// Cek $numrow apakah lebih dari 1
					// Artinya karena baris pertama adalah nama-nama kolom
					// Jadi dilewat saja, tidak usah diimport
					if($numrow > 1){
						// Validasi apakah semua data telah diisi
						$kd_credit_td = ( ! empty($kd_credit))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
						$call_td = ( ! empty($call))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
						$baki_debet_td = ( ! empty($baki_debet))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
						$hari_pokok_td = ( ! empty($hari_pokok))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$tgk_pokok_td = ( ! empty($tgk_pokok))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$hari_bunga_td = ( ! empty($hari_bunga))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$tgk_bunga_td = ( ! empty($tgk_bunga))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
						$tgk_denda_td = ( ! empty($tgk_denda))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

						// Jika salah satu data ada yang kosong
						if($kd_credit == "" or $call == "" or $baki_debet == "" or $hari_pokok == "" or $tgk_pokok == "" or $hari_bunga == "" or $tgk_bunga == "" or $tgk_denda == ""){
							$kosong++; // Tambah 1 variabel $kosong
						}

						echo "<tr>";
						echo "<td".$kd_credit_td.">".$kd_credit."</td>";
						echo "<td".$call_td.">".$call."</td>";
						echo "<td".$baki_debet_td.">".$baki_debet."</td>";
						echo "<td".$hari_pokok_td.">".$hari_pokok."</td>";
						echo "<td".$tgk_pokok_td.">".$tgk_pokok."</td>";
						echo "<td".$hari_bunga_td.">".$hari_bunga."</td>";
						echo "<td".$tgk_bunga_td.">".$tgk_bunga."</td>";
						echo "<td".$tgk_denda_td.">".$tgk_denda."</td>";
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
					<a href='".base_url("tunggakan")."' class='btn btn-default pull-left'><i class='fa fa-arrow-circle-left'></i> Kembali</a>
				<?php
				}else{ // Jika semua data sudah diisi

					// Buat sebuah tombol untuk mengimport data ke database
					echo "<button type='submit' name='import' class='btn btn-default pull-right'><i class='fa fa-save'></i> Import</button>";
					echo "<a href='".base_url("tunggakan")."' class='btn btn-default pull-left'><i class='fa fa-arrow-circle-left'></i> Kembali</a>";
				}

				echo "</form>";
			}
			?>

        </div>
      </div>
    </div>
  </div>
</section>