<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example3" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">NAMA PENGGUNA</th>
                <th class="text-center">JABATAN</th>
                <th class="text-center">WILAYAH</th>
                <th class="text-center">USERNAME</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if( ! empty($pengguna))
              {
                $no=1; foreach($pengguna as $data)                              
                {
                  ?> 
                  <tr>
                    <td class="text-center"><?php echo $data->id;?></td>
                    <td><?php echo $data->nama;?></td>
                    <td><?php echo $data->jabatan;?></td>
                    <td><?php echo $data->wilayah;?></td>
                    <td><?php echo $data->username;?></td>
                    <td class="text-center">
                      <a href="<?= base_url('pengguna/edit/');?><?= $data->id; ?>" class="btn-circle btn-sm btn-info" title="Ubah"><i class="fa fa-edit"></i></a>

                      <a onclick="return confirm('Apakah anda yakin menghapus <?= $data->nama ?>?')" class="btn-circle btn-sm btn-danger" href="<?= base_url('pengguna/hapus/');?><?= $data->id; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
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
        <h4 class="modal-title">TAMBAH PENGGUNA</h4>
      </div>
      <form role="form" method="post" action="<?= base_url('pengguna/tambah');?>">
      <div class="modal-body">
        
        <div class="box-body">

          <div class="form-group">
            <label>NAMA LENGKAP</label>
            <input type="text" class="form-control" name="nama" required>
          </div>

          <div class="form-group">
            <label>JABATAN</label>
            <select class="form-control select2" style="width:100%;" name="jabatan" required>
              <option value="Direktur">Direktur</option>
              <option value="IT Support">IT Support</option>
              <option value="Kepala Seksi Kredit">Kepala Seksi Kredit</option>
            </select>
          </div>

          <div class="form-group">
            <label>WILAYAH</label>
            <select class="form-control select2" style="width:100%;" name="wilayah" required>
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
            <input type="text" class="form-control" name="user" required>
          </div>

          <div class="form-group">
            <label>HAK AKSES</label>
            <select class="form-control select2" style="width:100%;" name="level" required>
              <option value="2">Direktur</option>
              <option value="1">IT Support</option>
              <option value="3">Kepala Seksi Kredit</option>
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