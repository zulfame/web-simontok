<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LAPORAN PEMBERIAN SURAT TUGAS</title>
</head>
<body>
	<center>
		<b>
			<font>PT. BPR BANGUNARTA</font></br>
			<font>DAFTAR PENANGANAN KREDIT</font>
		</b><br><br>
	</center>
	<table>
		<tr>
			<td>WILAYAH</td>
			<td> : </td>
			<td style="text-transform: uppercase;"><?= $this->session->userdata('wilayah');?></td>
		</tr>
		<tr>
			<td>TANGGAL</td>
			<td> : </td>
			<td style="text-transform: uppercase;"><?= date('j F Y');?></td>
		</tr>
	</table><br>
	<table id="example3" class="table table-bordered table-hover">
		<thead>
			<tr>
				<th class="text-center">NO</th>
				<th class="text-center">TANGGAL</th>
				<th class="text-center">NO. SURAT</th>
				<th class="text-center">KD KREDIT</th>
				<th class="text-center">DEBITUR</th>
				<th class="text-center">PETUGAS</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1; foreach($tugas as $data)                              
			{
				?> 
				<tr>
					<td class="text-center"><?php echo $no++?></td>
					<td><?php echo $data->tgl;?></td>
					<td style="text-transform:uppercase;"><?php echo $data->no_st;?></td>
					<td><?php echo $data->id_debitur;?></td>
					<td><?php echo $data->nama_debitur;?></td>
					<td><?php echo $data->nama;?></td>
				</tr>
			<?php }?>
		</tbody>
	</table>

	<table class="table table-hover">
		<tr>
			<td class="text-center">
				Leader,<br><br><br>
				<?= $this->session->userdata('nama');?>
			</td>
			<?php
			foreach ($petugas as $list) 
			{
				echo "<td class='text-center'>
				$list->posisi,<br><br><br>
				$list->nama
				</td>";
			}
			?>
		</tr>
	</table>
</body>
</html>
<script>
  window.print();
</script>