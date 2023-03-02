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
        <form role="form" method="post" action="<?= base_url('tugas/proses_edit/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>NO. SURAT</label>
                <input type="text" class="form-control" name="no_st" value="<?= $tugas->no_st;?>" style="text-transform: uppercase;" disabled>
              </div>

              <div class="form-group">
                <label>TANGGAL</label>
                <input type="date" class="form-control" name="tgl" value="<?= $tugas->tgl;?>" disabled>
              </div>

              <div class="form-group">
                <label>PETUGAS</label>
                <select class="form-control select2" style="width: 100%;" name="id_petugas" required>
                  <option>--Pilih Petugas--</option>
                  <?php
                  foreach ($petugas as $list)
                  {
                    ?>
                    <option value="<?php echo $list->kd_petugas; ?>" 
                      <?php if($list->kd_petugas==$tugas->id_petugas){echo "selected='selected'";} ?>>
                      <?php echo $list->nama; ?></option>
                      <?php
                    }
                    ?>
                </select>
              </div>

              <div class="form-group">
                <label>DEBITUR</label>
                <select class="form-control select2" style="width: 100%;" name="id_debitur" required>
                  <option>--Pilih Debitur--</option>
                  <?php
                  foreach ($debitur as $list)
                  {
                    ?>
                    <option value="<?php echo $list->kd_credit; ?>" 
                      <?php if($list->kd_credit==$tugas->id_debitur){echo "selected='selected'";} ?>>
                       <?php echo $list->kd_credit; ?> - <?php echo $list->nama_debitur; ?> [<?php echo $list->nama; ?>]</option>
                      <?php
                    }
                    ?>
                </select>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <a href="<?= base_url('tugas/data'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
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