<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th class="text-center">NO. SURAT</th>
                <th class="text-center">DEBITUR</th>
                <th class="text-center">ALAMAT</th>
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
                  <td><?php echo $data->no_st;?></td>
                  <td><?php echo $data->nama_debitur;?></td>
                  <td><?php echo $data->alamat;?></td>
                  <td><?php echo $data->hasil;?></td>
                  <td class="text-center">
                    <a href="<?= base_url('tugas/laporan/');?><?= $data->id_st; ?>" class="btn-circle btn-sm btn-info" title="Laporan"><i class="fa fa-file-o"></i></a>
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

</section>