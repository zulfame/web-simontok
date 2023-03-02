<?php
  if ($pengguna->level == "1")
  {
    $hak = "IT Support";
  }
  elseif ($pengguna->level == "2")
  {
    $hak = "Direktur";
  }
  else
  {
    $hak = "Kepala Seksi Kredit";
  }
?>

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
        <form role="form" method="post" action="<?= base_url('pengguna/proses_edit/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>NAMA LENGKAP</label>
                <input type="text" class="form-control" name="nama" value="<?= $pengguna->nama;?>" required>
              </div>

              <div class="form-group">
                <label>JABATAN</label>
                <select class="form-control select2" style="width:100%;" name="jabatan" required>
                  <option value="<?= $pengguna->jabatan;?>"><?= $pengguna->jabatan;?></option>
                  <option value="Direktur">Direktur</option>
                  <option value="IT Support">IT Support</option>
                  <option value="Kepala Seksi Kredit">Kepala Seksi Kredit</option>
                </select>
              </div>

              <div class="form-group">
                <label>WILAYAH</label>
                <select class="form-control select2" style="width:100%;" name="wilayah" required>
                  <option value="<?= $pengguna->wilayah;?>"><?= $pengguna->wilayah;?></option>
                  <option value="Jalancagak">Jalancagak</option>
                  <option value="Kalijati">Kalijati</option>
                  <option value="Pagaden">Pagaden</option>
                  <option value="Pamanukan">Pamanukan</option>
                  <option value="Pusakajaya">Pusakajaya</option>
                  <option value="Pusat">Pusat</option>
                  <option value="Subang">Subang</option>
                  <option value="Sukamandi">Sukamandi</option>
                </select>
              </div>

              <div class="form-group">
                <label>USERNAME</label>
                <input type="text" class="form-control" name="user" value="<?= $pengguna->username;?>" required>
              </div>

              <div class="form-group">
                <label>HAK AKSES</label>
                <select class="form-control select2" style="width:100%;" name="level" required>
                  <option value="<?= $pengguna->level;?>"><?= $hak;?></option>
                  <option value="2">Direktur</option>
                  <option value="1">IT Support</option>
                  <option value="3">Kepala Seksi Kredit</option>
                </select>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <a href="<?= base_url('pengguna'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
