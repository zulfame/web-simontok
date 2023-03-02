<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-4">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?= base_url('config/proses_tanggal/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>TANGGAL AWAL</label>
                <input type="date" class="form-control" name="tgl_awal" value="<?= $waktu->tgl_awal;?>" required>
              </div>

              <div class="form-group">
                <label>TANGGAL AKHIR</label>
                <input type="date" class="form-control" name="tgl_akhir" value="<?= $waktu->tgl_akhir;?>" required>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <a href="<?= base_url('config'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->

  </div>
  <!-- /.row -->

  <?php if(!empty($this->session->flashdata('edit'))){ ?>
    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('edit'); ?></div>
  <?php } ?>
</section>