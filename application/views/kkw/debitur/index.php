<section class="content">
  <div class="row">
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
                <th class="text-center">KD KREDIT</th>
                <th class="text-center">NAMA DEBITUR</th>
                <th class="text-center">PLAFOND</th>
                <th class="text-center">%</th>
                <th class="text-center">METODE</th>
                <th class="text-center">JW</th>
                <th class="text-center">REALISAI</th>
                <th class="text-center">WILAYAH</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($debitur as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td><?= $data->kd_credit;?></td>
                  <td><?= $data->nama_debitur;?></td>
                  <td><?= $data->plafond;?> </td>
                  <td class="text-center"><?= $data->rate;?></td>
                  <td><?= $data->metode_rps;?></td>
                  <td class="text-center"><?= $data->jw;?> Bln</td>
                  <td><?= $data->tgl_realisasi;?></td>
                  <td><?= $data->wilayah;?></td>
                  <td class="text-center">
                    <a href="<?= base_url('debitur/details/');?><?= $data->kd_credit; ?>" class="btn-circle btn-sm btn-success" title="Detail"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          <div class="form-group pull-left">
            <a href="<?= base_url('export/export_excel');?>" class="btn btn-success" target="_blank"> <i class="fa fa-download"></i> 
              EXPORT
            </a>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
