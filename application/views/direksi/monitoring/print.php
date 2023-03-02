<!-- Main content -->
<section class="invoice">
  <form method="post" action="<?= base_url('monitoring/riwayat/');?><?=  $this->uri->segment('3');?>">
  <img src="<?= base_url('assets/img/');?>logo.png" width="20%">

  <p class="lead" style="float: right;font-weight: bold;">No. SPK : <?= $debitur->no_spk;?></p>
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        
      </h2>
    </div>
    <!-- /.col -->
  </div>

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <div class="table-responsive">
        <table>
          <tr>
            <th width="35%">Kode Kredit</th>
            <td> : <?= $debitur->kd_credit;?></td>
          </tr>
          <tr>
            <th>No. CIF</th>
            <td> : <?= $debitur->no_cif;?></td>
          </tr>
          <tr>
            <th>Plafon</th>
            <td> : Rp. <?= rupiah($debitur->plafond); ?></td>
          </tr>
          <tr>
            <th>Suku Bunga</th>
            <td> : <?= $debitur->rate;?> %</td>
          </tr>
          <tr>
            <th>Pembayaran</th>
            <td> : <?= $debitur->metode_rps;?></td>
          </tr>
          <tr>
            <th>Jangka Waktu</th>
            <td> : <?= $debitur->jw;?> Bulan</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <div class="table-responsive">
        <table>
          <tr>
            <th width="35%">Nama</th>
            <td> : <?= $debitur->nama_debitur;?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td> : <?= $debitur->alamat;?></td>
          </tr>
          <tr>
            <th>No. Telepon</th>
            <td> : 0<?= $debitur->telepon;?></td>
          </tr>
          <tr>
            <th>Wilayah</th>
            <td> : <?= $debitur->wilayah;?></td>
          </tr>
          <tr>
            <th>Tgl. Realisasi</th>
            <td> : <?= $debitur->tgl_realisasi;?></td>
          </tr>
          <tr>
            <th>Tgl. Jth Tempo</th>
            <td> : <?= $debitur->tgl_jth_tempo;?></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <br>

  <div class="box-body">
    <center><b><font class="lead">KARTU MONITORING DEBITUR</font></b></center><p> 
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th class="text-center" width="10%">TANGGAL</th>
          <th class="text-center" width="10%">PETUGAS</th>
          <th class="text-center">NO. SURAT</th>
          <th class="text-center">PELAKSANAAN & HASIL</th>
          <th class="text-center">KETERANGAN</th>
          <th class="text-center">CATATAN</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no=1; foreach($dataR as $data)                              
        {
          ?> 
          <tr>
            <td><?php echo $data->tgl;?></td>
            <td><?php echo $data->nama;?></td>
            <td style="text-transform: uppercase;"><?php echo $data->no_st;?></td>
            <td><?= $data->pelaksanaan;?>, <?= $data->hasil;?></td>
            <td><?= $data->lainnya;?>, <?= $data->lainnya2;?></td>
            <td><?php echo $data->catatan;?></td>
          </tr>
        <?php }?>
      </tbody>
    </table>
    <br>
    <div class="row no-print">
    <div class="col-xs-12">
      <a href="<?= base_url('monitoring');?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
    </button>
  </div>
  </div>

  <!-- this row will not appear when printing -->
</div>
</form>
</section>
<!-- /.content -->
<div class="clearfix"></div>
</div>
<script>
  window.print();
</script>