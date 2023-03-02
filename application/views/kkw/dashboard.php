<section class="content-header">
  <h1>
    WELCOME TO SIMONTOK
    <small>SISTEM INFORMASI MONITORING KREDIT</small>
  </h1>
  <ol class="breadcrumb">
    <h5 class="active" style="text-transform: uppercase;"><?= date('l, j F Y');?></h5>
  </ol>
</section>

<section class="content">

  <div class="row">
    <div class="col-lg-2 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3 style="font-size:15px;">
            <?php
            foreach($jml_debitur as $data)                              
            {
              ?>
              <?= $data->hasil;?>
            <?php }?>
          </h3>

          <p>DEBITUR</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-2 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3 style="font-size:15px;">Rp. 
            <?php
            foreach($plafond as $data)                              
            {
              ?>
              <?= rupiah($data->hasil);?>
            <?php }?> 
          </h3>
          <p>PLAFOND</p>
        </div>
        <div class="icon">
          <i class="fa fa-usd"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 style="font-size:15px;">Rp. 
            <?php
            foreach($baki_debet as $data)                              
            {
              ?>
              <?= rupiah($data->hasil);?>
            <?php }?> 
          </h3>

          <p>OS AKHIR</p>
        </div>
        <div class="icon">
          <i class="fa fa-usd"></i>
        </div>
        <a href="#" class="small-box-footer">
          More info <i class="fa fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3 style="font-size:15px;">Rp. 
            <?php
            foreach($tgk_pokok as $data)                              
            {
              ?>
              <?= rupiah($data->hasil);?>
            <?php }?>  
          </h3>
        </h3>
        <p>TGK POKOK</p>
      </div>
      <div class="icon">
        <i class="fa fa-usd"></i>
      </div>
      <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-2 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
      <div class="inner">
        <h3 style="font-size:15px;">Rp. 
          <?php
          foreach($tgk_bunga as $data)                              
          {
            ?>
            <?= rupiah($data->hasil);?>
          <?php }?> 
        </h3>

        <p>TGK BUNGA</p>
      </div>
      <div class="icon">
        <i class="fa fa-usd"></i>
      </div>
      <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-2 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3 style="font-size:15px;">Rp. 
          <?php
          foreach($tgk_denda as $data)                              
          {
            ?>
            <?= rupiah($data->hasil);?>
          <?php }?> 
        </h3>

        <p>TGK DENDA</p>
      </div>
      <div class="icon">
        <i class="fa fa-usd"></i>
      </div>
      <a href="#" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  <!-- ./col -->
</div>


<!-- Main row -->
<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">
          <b>
           <?php
           foreach($jml_tugas as $data)                              
           {
            ?>
            <?= $data->hasil;?>
          <?php }?>
          </b>
          TUGAS DIBERIKAN
        </h3>
        <h3 class="box-title pull-right">
          <b>
           <?php
           foreach($jml_tugas_done as $data)                              
           {
            ?>
            <?= $data->hasil;?>
          <?php }?>
          </b>
          BELUM DIKERJAKAN
        </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-hover" id="example2">
          <thead>
            <tr>
              <th class="text-center">NO</th>
              <th class="text-center">PETUGAS</th>
              <th class="text-center">DEBITUR</th>
              <th class="text-center">PALAKSANAAN & HASIL</th>
              <th class="text-center">KETERANGAN</th>
              <th class="text-center">CATATAN</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no=1; foreach($tugas as $data)                              
            {
              ?> 
              <tr>
                <td class="text-center"><?php echo $no++?></td>
                <td style="text-transform: uppercase;"><?= $data->nama;?></td>
                <td><?= $data->nama_debitur;?></td>
                <td><?= $data->pelaksanaan;?>, <?= $data->hasil;?></td>
                <td><?= $data->lainnya;?>, <?= $data->lainnya;?></td>
                <td><?= $data->catatan;?></td>
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

</section>