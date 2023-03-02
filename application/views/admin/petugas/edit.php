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
        <form role="form" method="post" action="<?= base_url('petugas/proses_edit/');?><?=  $this->uri->segment('3');?>">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" placeholder="118010509" value="<?= $petugas->nip;?>" required>
              </div>

              <div class="form-group">
                <label>KD Petugas</label>
                <input type="text" class="form-control" id="kd_petugas" name="kd_petugas" placeholder="PGD-HW" value="<?= $petugas->kd_petugas;?>" required>
              </div>

              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $petugas->nama;?>" required>
              </div>

              <div class="form-group">
                <label>Posisi</label>
                <select class="form-control select2" style="width:100%;" id="posisi" name="posisi" placeholder="AO Kredit" required>
                  <option value="<?= $petugas->posisi;?>"><?= $petugas->posisi;?></option>
                  <option value="AO Kredit">AO Kredit</option>
                  <option value="Kasi Kredit">Kasi Kredit</option>
                </select>
              </div>

              <div class="form-group">
                <label>Wilayah</label>
                <select class="form-control select2" style="width:100%;" id="wilayah" name="wilayah" placeholder="wilayah" required>
                  <option value="<?= $petugas->wilayah;?>"><?= $petugas->wilayah;?></option>
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
                <label>Username</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="Username" value="<?= $petugas->username;?>" required>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <div class="modal-footer">
              <a href="<?= base_url('petugas'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->

  </div>
  <!-- /.row -->
</section>