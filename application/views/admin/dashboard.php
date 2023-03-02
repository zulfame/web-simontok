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
            foreach($debitur as $data)                              
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


<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-file-o"></i> Surat Tugas</a></li>
        <li><a href="#tab_2" data-toggle="tab"><i class="ion ion-clipboard"></i> Log Activity</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1" style="overflow-x: scroll;">
          <table class="table table-bordered table-hover" id="example3">
          <thead>
            <tr>
              <th class="text-center">NO</th>
              <th class="text-center">PETUGAS</th>
              <th class="text-center">DEBITUR</th>
              <th class="text-center">PELAKSANAAN & HASIL</th>
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
                <td><?= $data->nama;?></td>
                <td><?= $data->nama_debitur;?></td>
                <td><?= $data->pelaksanaan;?>, <?= $data->hasil;?></td>
                <td><?= $data->lainnya;?>, <?= $data->lainnya;?></td>
                <td><?= $data->catatan;?></td>
              </tr>
            <?php }?>
          </tbody>
        </table>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <table id="example1" class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($log as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++;?></td>
                  <td><?= $data->log_time;?> <a><?= $data->log_user;?></a> <?= $data->log_desc;?></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>

</section>