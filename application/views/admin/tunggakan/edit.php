<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $judul; ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?= base_url('agunan/proses_edit/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>Agunan</label>
                <textarea class="form-control" id="nik" name="agunan" id="agunan" required><?= $agunan->agunan;?></textarea>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <a href="<?= base_url('agunan'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->

  </div>
  <!-- /.row -->
</section>