<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("tugas/pilih/")?>">
            <div class="form-group pull-left">

              <input type="date" name="tgl" class="form-control" style="width:200px;">

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
                      <a href="<?= base_url('tugas/catatan/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-success" title="Catatan"><i class="fa fa-book"></i></a>

                      <a href="<?= base_url('tugas/cetak/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-primary" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
            
          </table>

        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
