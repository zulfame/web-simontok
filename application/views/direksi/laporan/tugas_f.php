<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("tugas/filter/")?>">
            <div class="form-group pull-left">

              <table>
                <tr>
                  <td>
                    <input type="date" name="tgl" class="form-control" style="width:150px;" required="" value="<?= $_GET['tgl']?>">
                  </td>
                  <td>
                    &nbsp;<select class="form-control select2" style="width:200px;" name="petugas">
                      <option value="">--Pilih Petugas--</option>
                      <?php
                      foreach ($petugas as $list) 
                      {
                        echo "<option value='$list->kd_petugas'>$list->nama</option>";
                      }
                      ?>
                    </select> 
                  </td>
                  <td>
                    &nbsp;<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
                  </td>
                </tr>
              </table>

            </div>
          </form>

          <div class="form-group pull-right">
            <a href="<?= base_url('tugas/report');?>" class="btn btn-primary"><i class="fa fa-bookmark"></i> TAMPIL SEMUA</a>
          </div>
          
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
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th class="text-center">TANGGAL</th>
                <th class="text-center">PETUGAS</th>
                <th class="text-center">KD KREDIT</th>
                <th class="text-center">DEBITUR</th>
                <th class="text-center">PELAKSANAAN & HASIL</th>
                <th class="text-center">KETERANGAN</th>
                <th class="text-center">CATATAN</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($tugas as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td><?= $data->tgl;?></td>
                  <td><?= $data->nama;?></td>
                  <td><?= $data->id_debitur;?></td>
                  <td><?= $data->nama_debitur;?></td>
                  <td><?= $data->pelaksanaan;?>, <?= $data->hasil;?></td>
                  <td><?= $data->lainnya;?>, <?= $data->lainnya2;?></td>
                  <td><?= $data->catatan;?></td>
                  <td class="text-center">
                    <a href="<?= base_url('tugas/monitor/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-success" title="Monitor"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
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