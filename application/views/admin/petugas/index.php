<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">NIP</th>
                <th class="text-center">KODE</th>
                <th class="text-center">NAMA</th>
                <th class="text-center">POSISI</th>
                <th class="text-center">WILAYAH</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if( ! empty($petugas))
              {
                $no=1; foreach($petugas as $data)                              
                {
                  ?> 
                  <tr>
                    <td class="text-center"><?php echo $data->nip;?></td>
                    <td><?php echo $data->nip;?></td>
                    <td><?php echo $data->kd_petugas;?></td>
                    <td><?php echo $data->nama;?></td>
                    <td><?php echo $data->posisi;?></td>
                    <td><?php echo $data->wilayah;?></td>
                    <td class="text-center">
                      <a href="<?= base_url('petugas/edit/');?><?= $data->nip; ?>" class="btn-circle btn-sm btn-info" title="Ubah Data"><i class="fa fa-edit"></i></a>

                      <a onclick="return confirm('Klik oke untuk hapus <?= $data->nama ?>')" class="btn-circle btn-sm btn-danger" href="<?= base_url('petugas/hapus/');?><?= $data->nip; ?>" title="Hapus Data"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php 
                }
              }else
                {
                  echo "<tr><td colspan='8' class='text-center'>Data tidak ada</td></tr>";
                }
              ?>
            </tbody>
          </table>
          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">
           <i class="fa fa-plus-square"></i> TAMBAH
          </button>
          <a href="<?= base_url('petugas/form');?>" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> 
            IMPORT
          </a>
          <a href="<?= base_url('petugas/update');?>" class="btn btn-sm btn-warning"><i class="fa fa-file-excel-o"></i> 
            UPDATE
          </a>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <?php if(!empty($this->session->flashdata('status'))){ ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('status'); ?></div>
  <?php } ?>

  <?php if(!empty($this->session->flashdata('edit'))){ ?>
    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('edit'); ?></div>
  <?php } ?>

  <?php if(!empty($this->session->flashdata('hapus'))){ ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>
</section>

<div class="modal fade" id="modal-tambah">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TAMBAH PETUGAS</h4>
      </div>
      <form role="form" method="post" action="<?= base_url('petugas/tambah');?>">
      <div class="modal-body">
        
        <div class="box-body">

          <div class="form-group">
            <label>NIP</label>
            <input type="number" class="form-control" id="nip" name="nip" placeholder="118010509" required>
          </div>

          <div class="form-group">
            <label>KD Petugas</label>
            <input type="text" class="form-control" id="kd_petugas" name="kd_petugas" placeholder="PGD-HW" required>
          </div>

          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
          </div>

          <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control select2" style="width:100%;" id="posisi" name="posisi" placeholder="AO Kredit" required>
              <option value="AO Kredit">AO Kredit</option>
              <option value="Kasi Kredit">Kasi Kredit</option>
            </select>
          </div>

          <div class="form-group">
            <label>Wilayah</label>
            <select class="form-control select2" style="width:100%;" id="wilayah" name="wilayah" placeholder="wilayah" required>
              <option value="Jalancagak">Jalancagak</option>
              <option value="Kalijati">Kalijati</option>
              <option value="Pagaden">Pagaden</option>
              <option value="Pamanukan">Pamanukan</option>
              <option value="Pusakajaya">Pusakajaya</option>
              <option value="Subang">Subang</option>
              <option value="Sukamandi">Sukamandi</option>
            </select>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>