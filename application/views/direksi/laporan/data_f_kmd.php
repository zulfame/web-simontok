<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("monitoring/filter/")?>">

            <table>
                <tr>
                  <td>
                    <select class="form-control select2" style="width:150px;" name="wilayah" required="">
                      <option value="<?= $_GET['wilayah']?>"><?= $_GET['wilayah']?></option>
                      <option value="Jalancagak">Jalancagak</option>
                      <option value="Kalijati">Kalijati</option>
                      <option value="Pagaden">Pagaden</option>
                      <option value="Pamanukan">Pamanukan</option>
                      <option value="Pusakajaya">Pusakajaya</option>
                      <option value="Subang">Subang</option>
                      <option value="Sukamandi">Sukamandi</option>
                      <option value="Remedial">Remedial</option>
                    </select>
                  </td>
                  <td>
                    &nbsp;
                    <select class="form-control select2" style="width:200px;" name="petugas">
                      <option value="">--Pilih Petugas--</option>
                      <?php
                      foreach ($petugas as $list) 
                      {
                        echo "<option value='$list->kd_petugas'>$list->nama</option>";
                      }
                      ?>
                  </td>
                  <td>
                    &nbsp;
                    <select class="form-control select2" style="width:70px;" name="coll">
                      <option value="">Coll</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </td>
                  <td>
                    &nbsp;
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
                  </td>
                  <td>
                    &nbsp;
                    <a href="<?= base_url('monitoring/report');?>" class="btn btn-success"><i class="fa fa-bookmark"></i> TAMPIL SEMUA</a>
                  </td>
                </tr>
              </table>
            </div>
          </form>
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
                <th class="text-center">WILAYAH</th>
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
              $no=1; foreach($monitoring as $data)                              
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
                  <td><?php echo $data->wilayah;?></td>
                  <td class="text-center"><?= $data->call;?> </td>
                  <td>Rp. <?= rupiah($data->baki_debet);?> </td>
                  <td class="text-center"><?= $data->hari_pokok;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_pokok);?> </td>
                  <td class="text-center"><?= $data->hari_bunga;?> </td>
                  <td>Rp. <?= rupiah($data->tgk_bunga);?> </td>
                  <td>Rp. <?= rupiah($data->tgk_denda);?> </td>
                  <td class="text-center"><?= $tgk_hr;?></td>
                   <td class="text-center">
                    <a href="<?= base_url('monitoring/detail/');?><?= $data->id_debitur; ?>" class="btn-circle btn-sm btn-warning" title="Riwayat"><i class="fa fa-history"></i></a>

                    <a class="btn-circle btn-sm btn-primary" href="<?= base_url('monitoring/print_out/');?><?= $data->id_debitur; ?>" target="_blank" title="Cetak"><i class="fa fa-print"></i></a>
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
