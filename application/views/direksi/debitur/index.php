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
                <th class="text-center">#</th>
                <th class="text-center">NO CREDIT</th>
                <th class="text-center">NAMA DEBITUR</th>
                <th class="text-center">JW</th>
                <th class="text-center">PLAFOND</th>
                <th class="text-center">METODE</th>
                <th class="text-center">PETUGAS</th>
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
                  <td class="text-center"><?= $data->jw;?></td>
                  <td>Rp. <?= rupiah($data->plafond);?></td>
                  <td><?= $data->metode_rps;?> </td>
                  <td><?= $data->kd_petugas;?></td>
                  <td class="text-center">
                    <a href="<?= base_url('debitur/tampil/');?><?= $data->kd_credit; ?>" class="btn-circle btn-sm btn-success" title="Detail Data"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>