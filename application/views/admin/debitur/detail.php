<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-user"></i> <?= $debitur->nama_debitur; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>NO CREDIT</th>
                <td> : <?= $debitur->kd_credit; ?></td>
              </tr>
              <tr>
                <th>NO CIF</th>
                <td> : <?= $debitur->no_cif; ?></td>
              </tr>
              <tr>
                <th>NO SPK</th>
                <td> : <?= $debitur->no_spk; ?></td>
              </tr>
              <tr>
                <th>NAMA DEBITUR</th>
                <td> : <?= $debitur->nama_debitur; ?></td>
              </tr>
              <tr>
                <th>ALAMAT</th>
                <td> : <?= $debitur->alamat; ?></td>
              </tr>
                <th>TELPON</th>
                <td> : <?= $debitur->telepon; ?></td>
              </tr>
              <tr>
                <th>METODE RPS</th>
                <td> : <?= $debitur->metode_rps; ?></td>
              </tr>
              <tr>
                <th>JANGKA WAKTU</th>
                <td> : <?= $debitur->jw; ?> Bulan</td>
              </tr>
              <tr>
                <th>TGL REALISASI</th>
                <td> : <?= $debitur->tgl_realisasi; ?></td>
              </tr>
              <tr>
                <th>TGL JTH TEMPO</th>
                <td> : <?= $debitur->tgl_jth_tempo; ?></td>
              </tr>
              <tr>
                <th>RATE</th>
                <td> : <?= $debitur->rate; ?></td>
              </tr>
              <tr>
                <th>NOACC DROPING</th>
                <td> : <?= $debitur->noacc_droping; ?></td>
              </tr>
              <tr>
                <th>PLAFOND</th>
                <td> : Rp. <?= rupiah($debitur->plafond); ?></td>
              </tr>
              <tr>
                <th>BAKI DEBET</th>
                <td> : Rp. <?= rupiah($tunggakan->baki_debet); ?></td>
              </tr>
              <tr>
                <th>HARI POKOK</th>
                <td> : <?= $tunggakan->hari_pokok; ?></td>
              </tr>
              <tr>
                <th>TUNGGAKAN POKOK</th>
                <td> : Rp. <?= rupiah($tunggakan->tgk_pokok); ?></td>
              </tr>
              <tr>
                <tr>
                <th>HARI BUNGA</th>
                <td> : <?= $tunggakan->hari_bunga; ?></td>
              </tr>
              <tr>
                <th>TUNGGAKAN BUNGA</th>
                <td> : Rp. <?= rupiah($tunggakan->tgk_bunga); ?></td>
              </tr>
              <tr>
                <th>TUNGGAKAN DENDA</th>
                <td> : Rp. <?= rupiah($tunggakan->tgk_denda); ?></td>
              </tr>
              <tr>
            </tbody>
          </table><hr>
          <div class="row no-print">
            <div class="col-xs-12">
              <a href="<?= base_url('debitur');?>" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
              <a href="<?= base_url('debitur/cetak');?>" target="_blank" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
