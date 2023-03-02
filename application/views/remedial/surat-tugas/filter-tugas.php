<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("remedial/tugas/filter/")?>">
            <div class="form-group pull-left">

              <input type="date" name="tgl" class="form-control" style="width:200px;" value="<?= $_GET['tgl']?>">

            </div>
            &nbsp;<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
          
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
                <th class="text-center">NO. SURAT</th>
                <th class="text-center">PETUGAS</th>
                <th class="text-center">KD KREDIT</th>
                <th class="text-center">DEBITUR</th>
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
                  <td class="text-center">
                      <a href="<?= base_url('tugas/cetak/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-primary" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>

                      <a href="<?= base_url('remedial/tugas/catatan/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-success" title="Catatan"><i class="fa fa-book"></i></a>

                    </td>
                </tr>
              <?php }?>
            </tbody>
            
          </table>

          <a href="<?= base_url('remedial/tugas'); ?>" class="btn btn-default pull-left"><i class="fa fa-arrow-circle-left"></i> KEMBALI</a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>



<div class="modal fade" id="modal-tambah">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">TAMBAH SURAT TUGAS</h4>
      </div>
      <form role="form" method="post" action="<?= base_url('remedial/tugas/tambah');?>">
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
              <option>--Pilih Debitur--</option>
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
              <option>--Pilih Petugas--</option>
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
