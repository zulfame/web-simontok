<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $judul;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- form start -->
          <form role="form" method="post" action="<?= base_url('debitur/proses_edit/');?><?=  $this->uri->segment('3');?>">

            <div class="box-body">
              <div class="row">

                <div class="col-xs-4">
                  <label>Kode Nasabah</label>
                  <input type="text" class="form-control" required name="kode_nasabah" value="<?= $debitur->kode_nasabah;?>">
                </div>

                <div class="col-xs-4">
                  <label>Nama Debitur</label>
                  <input type="text" class="form-control" required name="nama_debitur" value="<?= $debitur->nama_debitur;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. Telpon</label>
                  <input type="text" class="form-control" required name="no_telp" value="<?= $debitur->no_telp;?>">
                </div>

                <div class="col-xs-12">
                  <label>Alamat</label>
                  <input type="text" class="form-control" required name="alamat" value="<?= $debitur->alamat;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. SPK</label>
                  <input type="text" class="form-control" required name="no_spk" value="<?= $debitur->no_spk;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. Loan</label>
                  <input type="text" class="form-control" required name="no_loan" value="<?= $debitur->no_loan;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. CIFK</label>
                  <input type="text" class="form-control" required name="no_cif" value="<?= $debitur->no_cif;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. Rekening</label>
                  <input type="text" class="form-control" required name="no_rek" value="<?= $debitur->no_rek;?>">
                </div>

                <div class="col-xs-4">
                  <label>No. Plafon</label>
                  <input type="text" class="form-control" required name="plafon" value="<?= $debitur->plafon;?>">
                </div>

                <div class="col-xs-4">
                  <label>Suku Bunga</label>
                  <input type="text" class="form-control" required name="suku_bunga" value="<?= $debitur->suku_bunga;?>">
                </div>

                <div class="col-xs-4">
                  <label>Pembayaran</label>
                  <input type="text" class="form-control" required name="jenis_pembayaran" value="<?= $debitur->jenis_pembayaran;?>">
                </div>

                <div class="col-xs-4">
                  <label>Jangka Waktu</label>
                  <input type="text" class="form-control" required name="jk_waktu" value="<?= $debitur->jk_waktu;?>">
                </div>

                <div class="col-xs-4">
                  <label>Wilayah</label>
                  <input type="text" class="form-control" required name="wilayah" value="<?= $debitur->wilayah;?>">
                </div>

                <div class="col-xs-3">
                  <label>Tgl. Realisasi</label>
                  <input type="text" class="form-control" required name="tgl_realisasi" value="<?= $debitur->tgl_realisasi;?>">
                </div>

                <div class="col-xs-3">
                  <label>Tgl. JAPO</label>
                  <input type="text" class="form-control" required name="tgl_jth_tempo" value="<?= $debitur->tgl_jth_tempo;?>">
                </div>

                <div class="col-xs-6">
                  <label>Penggunaan</label>
                  <input type="text" class="form-control" required name="jenis_penggunaan" value="<?= $debitur->jenis_penggunaan;?>">
                </div>

              </div>
            </div>
            <!-- /.box-body -->
            <div class="modal-footer">
              <a href="<?= base_url('debitur'); ?>" class="btn btn-default pull-left">Tutup</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
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