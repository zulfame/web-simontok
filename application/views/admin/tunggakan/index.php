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
                <th class="text-center">No</th>
                <th class="text-center">KD KREDIT</th>
                <th class="text-center" width="15%">DEBITUR</th>
                <th class="text-center">COLL</th>
                <th class="text-center">BAKI DEBET</th>
                <th class="text-center">HR-P</th>
                <th class="text-center">TGK POKOK</th>
                <th class="text-center">HR-B</th>
                <th class="text-center">TGK BUNGA</th>
                <th class="text-center">TGK DENDA</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($tunggakan as $data)                              
              {
                $jml=+$data->tgk_pokok+$data->tgk_bunga+$data->tgk_denda;
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td><?= $data->kd_credit;?></td>
                  <td><?= $data->nama_debitur;?></td>
                  <td class="text-center"><?= $data->call;?> </td>
                  <td>Rp. <?= rupiah($data->baki_debet);?> </td>
                  <td class="text-center"><?= $data->hari_pokok;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_pokok);?> </td>
                  <td class="text-center"><?= $data->hari_bunga;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_bunga);?> </td>
                  <td>Rp. <?= rupiah($data->tgk_denda);?> </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"> <i class="fa fa-file-excel-o"></i> 
            EXPORT
          </button>
          <!-- /.box 
          <a href="<?= base_url('tunggakan/form');?>" class="btn btn-sm btn-warning"> <i class="fa fa-file-excel-o"></i> 
            IMPORT
          </a>
          -->
          <a href="<?= base_url('tunggakan/update');?>" class="btn btn-sm btn-warning"> <i class="fa fa-file-excel-o"></i> 
            UPDATE
          </a>

          <a href="<?= base_url('tunggakan/hapus_all');?>" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i> 
            DELETE
          </a>
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

  <?php if(!empty($this->session->flashdata('edit'))){ ?>
    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('edit'); ?></div>
  <?php } ?>

  <?php if(!empty($this->session->flashdata('hapus'))){ ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>

</section>
