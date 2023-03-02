<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="<?= base_url('agunan/proses_edit/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>LOKASI</label>
                <textarea class="form-control" name="lokasi" required><?= $agunan->lokasi;?></textarea>
              </div>

              <div class="form-group">
                <label>AGUNAN</label>
                <textarea class="form-control" name="agunan" required><?= $agunan->agunan;?></textarea>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <a href="<?= base_url('agunan'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->

  </div>
  <!-- /.row -->
</section>