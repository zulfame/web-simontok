<section class="content">
  <div class="row">
    <!-- left column -->

    <div class="col-md-9">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form role="form" method="post" action="<?= base_url('tugas/proses_catatan/');?><?=  $this->uri->segment('3');?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>NO. SURAT</label>
                  <input type="text" class="form-control" value="<?= $laporan->no_st;?>" style="text-transform: uppercase;" disabled>
                </div>

                <div class="form-group">
                  <label>PETUGAS</label>
                  <input type="text" class="form-control" value="<?= $laporan->nama;?>" disabled>
                </div>

                <div class="form-group">
                  <label>PELAKSANAAN</label>
                  <input type="text" class="form-control" value="<?= $laporan->pelaksanaan;?>" disabled>
                </div>

                <div class="form-group">
                  <label>KETERANGAN PELAKSANAAN</label>
                  <textarea class="form-control" disabled=""><?= $laporan->lainnya;?></textarea>
                </div>
              </div>

              <div class="col-md-6">
               <div class="form-group">
                <label>KD KREDIT</label>
                <input type="text" class="form-control" value="<?= $laporan->kd_credit;?>" disabled>
              </div>

              <div class="form-group">
                <label>NAMA DEBITUR</label>
                <input type="text" class="form-control" value="<?= $laporan->nama_debitur;?>" disabled>
              </div>

              <div class="form-group">
                <label>HASIL</label>
                <input type="text" class="form-control" value="<?= $laporan->hasil;?>" disabled>
              </div>

              <div class="form-group">
                <label>KETERANGAN HASIL</label>
                <textarea class="form-control" disabled=""><?= $laporan->lainnya2;?></textarea>
              </div>
            </div>
            <div class="col-md-12">

              <div class="form-group">
                <label>CATATAN</label>
                <textarea class="form-control" name="catatan" disabled><?= $laporan->catatan;?></textarea>
              </div>
            </div>

          </div>
          <!-- /.row -->
          <div class="modal-footer">
            <a href="<?= base_url('tugas/report'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
          </div>
        </div>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
    <div class="col-md-3">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">
              <center>
                <img src="<?= base_url('uploads/');?><?= $laporan->image;?>" style="width: 200px;height: 266px;">
              </center>
            </div>

          </div>
        </div>
      </form>
    </div>
    <!-- /.box -->
  </div>

</div>
<!-- /.row -->
</section>