  <section class="content">
    <div class="row">

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">
            <form method="get" action="<?php echo base_url("tugas/pilih/")?>">
              <div class="form-group pull-left">

                <input type="date" name="tgl" class="form-control" style="width:200px;" required="">

              </div>
              &nbsp;<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
            </form>
          </div>
        </div>  
      </div>

      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"><?= $title;?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example3" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="text-center">NO</th>
                  <th class="text-center">TANGGAL</th>
                  <th class="text-center">NO. SURAT</th>
                  <th class="text-center">PETUGAS</th>
                  <th class="text-center">KD KREDIT</th>
                  <th class="text-center">DEBITUR</th>
                  <th class="text-center">HASIL</th>
                  <th class="text-center">AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=1; foreach($tugas as $data)                              
                {
                  ?> 
                  <tr>
                    <td class="text-center"><?php echo $no++?></td>
                    <td><?php echo $data->tgl;?></td>
                    <td style="text-transform:uppercase;"><?php echo $data->no_st;?></td>
                    <td><?php echo $data->nama;?></td>
                    <td><?php echo $data->id_debitur;?></td>
                    <td><?php echo $data->nama_debitur;?></td>
                    <td><?php echo $data->hasil;?></td>
                    <td class="text-center">
                      <a href="<?= base_url('tugas/catatan/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-success" title="Catatan"><i class="fa fa-book"></i></a>

                      <a href="<?= base_url('tugas/cetak/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-primary" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>

                      <a href="<?= base_url('tugas/edit/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-warning" title="Ubah"><i class="fa fa-edit"></i></a>

                      <a onclick="return confirm('Klik oke untuk hapus <?= $data->nama_debitur ?>')" class="btn-circle btn-sm btn-danger" href="<?= base_url('tugas/hapus/');?><?= $data->id_st; ?>" title="Hapus Data"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
            
            <a href="<?= base_url('tugas/cetak_daily');?>" target="_blank" class="btn btn-sm btn-success">
              <i class="fa fa-print"></i> CETAK
            </a>
            
            
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">
              <i class="fa fa-plus-square"></i> SURAT TUGAS
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

    <?php if(!empty($this->session->flashdata('tambah'))){ ?>
      <div class="alert alert-success" role="alert"><?= $this->session->flashdata('tambah'); ?></div>
    <?php } ?>

    <?php if(!empty($this->session->flashdata('hapus'))){ ?>
      <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
    <?php } ?>

     <?php if(!empty($this->session->flashdata('edit'))){ ?>
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
        <form role="form" method="post" action="<?= base_url('tugas/tambah');?>">
        <div class="modal-body">
          
          <div class="box-body">

            <div class="form-group">
              <label>TANGGAL</label>
              <input type="date" class="form-control" name="tgl" value="<?php echo date('Y-m-d');?>" disabled>
            </div>

            <div class="form-group">
              <label>NO. SURAT</label>
              <input type="text" class="form-control" name="no_st" readonly="" value="<?= $no_surat; ?>" style="text-transform: uppercase;">
            </div>

            <div class="form-group">
              <label>DEBITUR</label>
              <select class="form-control select2" style="width: 100%;" id="id_debitur" name="id_debitur" required>
                <option value="">--Pilih Debitur--</option>
                  <?php
                  foreach ($debitur as $list) 
                  {
                    echo "<option value='$list->kd_credit'>$list->kd_credit - $list->nama_debitur [$list->nama]</option>";
                  }
                  ?>
              </select>
            </div>

            <div class="form-group">
              <label>PETUGAS</label>
              <select class="form-control select2" style="width: 100%;" name="id_petugas" required>
                <option value="">--Pilih Petugas--</option>
                  <?php
                  foreach ($petugas as $list) 
                  {
                    echo "<option value='$list->kd_petugas'>$list->nama</option>";
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

