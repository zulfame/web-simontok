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
          <form role="form" action="<?=base_url('tugas/update')?>" method="post" enctype="multipart/form-data">
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
                  <select class="form-control select2" style="width: 100%;" name="pelaksanaan" required>
                    <option value="<?= $laporan->pelaksanaan;?>"><?= $laporan->pelaksanaan;?></option>
                    <option value="Prospek">Prospek</option>
                    <option value="Penagihan ke Rumah Debitur">Penagihan ke Rumah Debitur</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>KETERANGAN PELAKSANAAN</label>
                  <textarea class="form-control" name="lainnya" placeholder="Abaikan jika tidak ada keterangan."><?= $laporan->lainnya;?></textarea>
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
                <select class="form-control select2" style="width: 100%;" name="hasil" required>
                  <option value="<?= $laporan->hasil;?>"><?= $laporan->hasil;?></option>
                  <option value="Topup">Topup</option>
                  <option value="Bayar Full Tunggakan">Bayar Full Tunggakan</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>

              <div class="form-group">
                <label>KETERANGAN HASIL</label>
                <textarea class="form-control" name="lainnya2" placeholder="Abaikan jika tidak ada keterangan."><?= $laporan->lainnya2;?></textarea>
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
            <input type="hidden" name="id" value="<?=$laporan->id_st?>">
            <a href="<?= base_url('tugas/list'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
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
          <div class="form-group">
            <input type="file" class="form-control" name="image">
          </div><br>
          <p style="color:red;"><?=$this->session->flashdata('msg') ?></p>
          <p style="color:green;"><?=$this->session->flashdata('msg_success') ?></p>

        </div>
      </div>
    </form>
  </div>
  <!-- /.box -->
</div>

</div>
<!-- /.row -->
</section>