<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- form start -->
          <form role="form" method="post" action="<?= base_url('debitur/proses_edit/');?><?=  $this->uri->segment('3');?>">

            <div class="box-body">
              <div class="row">

                <div class="col-xs-4">
                  <label>NO CREDIT</label>
                  <input type="text" class="form-control" required name="kd_credit" value="<?= $debitur->kd_credit;?>">
                </div>

                <div class="col-xs-4">
                  <label>NO CIF</label>
                  <input type="text" class="form-control" required name="no_cif" value="<?= $debitur->no_cif;?>">
                </div>

                <div class="col-xs-4">
                  <label>NO SPK</label>
                  <input type="text" class="form-control" required name="no_spk" value="<?= $debitur->no_spk;?>">
                </div>

                <div class="col-xs-4">
                  <label>NAMA DEBITUR</label>
                  <input type="text" class="form-control" required name="nama_debitur" value="<?= $debitur->nama_debitur;?>">
                </div>

                <div class="col-xs-8">
                  <label>ALAMAT</label>
                  <input type="text" class="form-control" required name="alamat" value="<?= $debitur->alamat;?>">
                </div>

                <div class="col-xs-4">
                  <label>DESA</label>
                  <input type="text" class="form-control" required name="desa" value="<?= $debitur->desa;?>">
                </div>

                <div class="col-xs-4">
                  <label>KECAMATAN</label>
                  <input type="text" class="form-control" required name="kecamatan" value="<?= $debitur->kecamatan;?>">
                </div>

                <div class="col-xs-4">
                  <label>WILAYAH</label>
                  <input type="text" class="form-control" required name="wilayah" value="<?= $debitur->wilayah;?>">
                </div>

                <div class="col-xs-3">
                  <label>METODE RPS</label>
                  <input type="text" class="form-control" required name="metode_rps" value="<?= $debitur->metode_rps;?>">
                </div>

                <div class="col-xs-2">
                  <label>JW</label>
                  <input type="text" class="form-control" required name="jw" value="<?= $debitur->jw;?>">
                </div>

                <div class="col-xs-1">
                  <label>RATE</label>
                  <input type="text" class="form-control" required name="rate" value="<?= $debitur->rate;?>">
                </div>

                <div class="col-xs-3">
                  <label>TGL REALISASI</label>
                  <input type="text" class="form-control" required name="tgl_realisasi" value="<?= $debitur->tgl_realisasi;?>" disabled>
                </div>

                <div class="col-xs-3">
                  <label>TGL JTH TEMPO</label>
                  <input type="text" class="form-control" required name="tgl_jth_tempo" value="<?= $debitur->tgl_jth_tempo;?>" disabled>
                </div>

                <div class="col-xs-3">
                  <label>NO ACC DROPING</label>
                  <input type="text" class="form-control" required name="noacc_droping" value="<?= $debitur->noacc_droping;?>">
                </div>

                <div class="col-xs-3">
                  <label>TELEPON</label>
                  <input type="text" class="form-control" required name="telepon" value="<?= $debitur->telepon;?>">
                </div>

                <div class="col-xs-6">
                  <label>PLAFOND</label>
                  <input type="text" class="form-control" required name="plafond" value="Rp. <?= rupiah($debitur->plafond);?>" disabled>
                </div>

              </div>
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
              <a href="<?= base_url('debitur'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>