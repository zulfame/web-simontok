<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">No. SPK : <?= $debitur->no_spk;?></p>
            <div class="table-responsive">
              <table class="table">
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
            <p class="lead" style="color: white;">Amount Due 2/22/2014</p>

            <div class="table-responsive">
              <table class="table">
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

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-12">
            <p class="lead">Detail Agunan</p>
            <div class="table-responsive">
              <table class="table">
                <?php
                $no=1; foreach($dataA as $data)                              
                {
                  ?> 
                  <tr>
                    <td width="1%"><?= $no++;?>. </td>
                    <td> <?= $data->agunan;?></td>
                  </tr>
                <?php }?>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>

          <center><b><font class="lead">KARTU MONITORING DEBITUR</font></b></center><p> 
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="15%">TANGGAL</th>
                <th class="text-center" width="15%">PETUGAS</th>
                <th class="text-center" width="20%" >NO. SURAT</th>
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
                  <td><?= $data->tgl;?></td>
                  <td><?= $data->nama;?></td>
                  <td style="text-transform: uppercase;"><?= $data->no_st;?></td>
                  <td><?= $data->pelaksanaan;?>, <?= $data->hasil;?></td>
                  <td><?= $data->lainnya;?>, <?= $data->lainnya2;?></td>
                  <td><?= $data->catatan;?></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          <div class="modal-footer">
            <a href="<?= base_url('monitoring/list'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i>  KEMBALI</a>
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