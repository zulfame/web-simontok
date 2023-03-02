<section class="content">
  <div class="row">
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
                <th class="text-center">BAKI DEBET</th>
                <th class="text-center">HR-P</th>
                <th class="text-center">TGK POKOK</th>
                <th class="text-center">HR-B</th>
                <th class="text-center">TGK BUNGA</th>
                <th class="text-center">TGK DENDA</th>
                <th class="text-center">TGK-HR</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no =1;
              
              foreach($monitoring as $data)                              
              {
                $a = $data->hari_pokok;
                $b = $data->hari_bunga;
                if ($a > $b) 
                {
                  $tgk_hr = $a;
                }
                else
                {
                  $tgk_hr = $b;
                }
                ?> 
                <tr>
                  <td class="text-center"><?php echo $no++?></td>
                  <td><?php echo $data->id_debitur;?></td>
                  <td><?php echo $data->nama_debitur;?></td>
                  <td class="text-center"><?= $data->call;?> </td>
                  <td>Rp. <?= rupiah($data->baki_debet);?> </td>
                  <td class="text-center"><?= $data->hari_pokok;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_pokok);?> </td>
                  <td class="text-center"><?= $data->hari_bunga;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_bunga);?> </td>
                  <td>Rp. <?= rupiah($data->tgk_denda);?> </td>
                  <td class="text-center"><?= $tgk_hr;?></td>
                   <td class="text-center">
                    <a href="<?= base_url('monitoring/riwayat/');?><?= $data->id_debitur; ?>" class="btn-circle btn-sm btn-warning" title="Riwayat"><i class="fa fa-history"></i></a>

                    <a class="btn-circle btn-sm btn-primary" href="<?= base_url('monitoring/cetak/');?><?= $data->id_debitur; ?>" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>
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

  <?php if(!empty($this->session->flashdata('hapus'))){ ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>

</section>
