<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("monitoring/pilih/") ?>">
            <div class="form-group pull-left">
              <select class="form-control select2" style="width:200px;" name="petugas" required>
                <option value="">--Pilih Petugas--</option>
                <?php
                foreach ($petugas as $list) {
                  echo "<option value='$list->kd_petugas'>$list->nama</option>";
                }
                ?>
              </select>

              <select class="form-control select2" style="width:70px;" name="coll">
                <option value="">Coll</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>

              <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
            </div>
          </form>
          <div class="form-group pull-right">
            <a href="<?= base_url('monitoring/data'); ?>" class="btn btn-primary"><i class="fa fa-bookmark"></i> TAMPIL SEMUA</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover responsive">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th class="text-center">KD KREDIT</th>
                <th class="text-center">NAMA DEBITUR</th>
                <th class="text-center">COLL</th>
                <th class="text-center">PETUGAS</th>
                <th class="text-center">BAKI DEBET</th>
                <th class="text-center">TGK POKOK</th>
                <th class="text-center">TGK BUNGA</th>
                <th class="text-center">TGK DENDA</th>
                <th class="text-center">TGK-HR</th>
                <th class="text-center">TGLEFF</th>
                <th class="text-center">TGLJTEMPO</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($monitoring as $data) {
                $a = $data->hari_pokok;
                $b = $data->hari_bunga;
                if ($a > $b) {
                  $tgk_hr = $a;
                } else {
                  $tgk_hr = $b;
                }
              ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td><?php echo $data->id_debitur; ?></td>
                  <td><?php echo $data->nama_debitur; ?></td>
                  <td class="text-center"><?= $data->call; ?> </td>
                  <td><?= $data->nama; ?> </td>
                  <td>Rp. <?= rupiah($data->baki_debet); ?> </td>
                  <td>Rp. <?= rupiah($data->tgk_pokok); ?> </td>
                  <td>Rp. <?= rupiah($data->tgk_bunga); ?> </td>
                  <td>Rp. <?= rupiah($data->tgk_denda); ?> </td>
                  <td class="text-center"><?= $tgk_hr; ?></td>
                  <td class="text-center"><?= $data->tgl_realisasi; ?></td>
                  <td class="text-center"><?= $data->tgl_jth_tempo; ?></td>
                  <td class="text-center">
                    <a href="<?= base_url('monitoring/histori/'); ?><?= $data->id_debitur; ?>" class="btn-circle btn-sm btn-warning" title="Riwayat"><i class="fa fa-history"></i></a>

                    <a class="btn-circle btn-sm btn-primary" href="<?= base_url('monitoring/cetak/'); ?><?= $data->id_debitur; ?>" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">
            <i class="fa fa-plus-square"></i> TAMBAH
          </button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <?php if (!empty($this->session->flashdata('status'))) { ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('status'); ?></div>
  <?php } ?>

  <?php if (!empty($this->session->flashdata('tambah'))) { ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('tambah'); ?></div>
  <?php } ?>

  <?php if (!empty($this->session->flashdata('hapus'))) { ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>

  <?php if (!empty($this->session->flashdata('edit'))) { ?>
    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('edit'); ?></div>
  <?php } ?>

</section>

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TAMBAH SURAT TUGAS</h4>
      </div>
      <form role="form" method="post" action="<?= base_url('tugas/tambah'); ?>">
        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
              <label>TANGGAL</label>
              <input type="date" class="form-control" name="tgl" value="<?php echo date('Y-m-d'); ?>" disabled>
            </div>

            <div class="form-group">
              <label>NO. SURAT</label>
              <input type="text" class="form-control" name="no_st" readonly="" value="<?= $no_surat; ?>" style="text-transform: uppercase;">
            </div>

            <div class="form-group">
              <label>PETUGAS</label>
              <select class="form-control select2" style="width: 100%;" name="id_petugas" required>
                <option>--Pilih Petugas--</option>
                <?php
                foreach ($petugas as $list) {
                  echo "<option value='$list->kd_petugas'>$list->nama</option>";
                }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label>DEBITUR</label>
              <select class="form-control select2" style="width: 100%;" id="id_debitur" name="id_debitur" required>
                <option>--Pilih Debitur--</option>
                <?php
                foreach ($debitur as $list) {
                  echo "<option value='$list->kd_credit'>$list->kd_credit - $list->nama_debitur [$list->nama]</option>";
                }
                ?>
              </select>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TUTUP</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->session->flashdata("pesan"); ?>