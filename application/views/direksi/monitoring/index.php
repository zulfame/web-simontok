<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $judul; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Petugas</th>
                <th class="text-center">Debitur</th>
                <th class="text-center">Tunggakan</th>
                <th class="text-center">Pelaksanaan</th>
                <th class="text-center">Catatan</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($monitoring as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?php echo $no++?></td>
                  <td><?php echo $data->tgl;?></td>
                  <td><?php echo $data->nama;?></td>
                  <td><?php echo $data->nama_debitur;?></td>
                  <td><?php echo $data->tunggakan;?></td>
                  <td><?php echo $data->pelaksanaan;?></td>
                  <td><?php echo $data->catatan;?></td>
                   <td class="text-center">
                    <a href="<?= base_url('monitoring/hasil/');?><?= $data->id_monitoring; ?>" class="btn-circle btn-sm btn-warning" title="Riwayat"><i class="fa fa-history"></i></a>
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
</section>