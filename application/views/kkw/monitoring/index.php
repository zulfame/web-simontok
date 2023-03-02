<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("monitoring/pilih/")?>">
            <div class="form-group pull-left">
              <select class="form-control select2" style="width:200px;" name="petugas" required="">
                <option value="">--Pilih Petugas--</option>
                <?php
                foreach ($petugas as $list) 
                {
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
            <a href="<?= base_url('monitoring/data');?>" class="btn btn-primary"><i class="fa fa-bookmark"></i> TAMPIL SEMUA</a>
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
          <table id="example1" class="table table-bordered table-hover">
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

<?= $this->session->flashdata("pesan"); ?>