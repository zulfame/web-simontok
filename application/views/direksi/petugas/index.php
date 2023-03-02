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
                <th class="text-center">NIP</th>
                <th class="text-center">KODE</th>
                <th class="text-center">NAMA</th>
                <th class="text-center">POSISI</th>
                <th class="text-center">WILAYAH</th>
              </tr>
            </thead>
            <tbody>

              <?php
              if( ! empty($petugas))
              {
                $no=1; foreach($petugas as $data)                              
                {
                  ?> 
                  <tr>
                    <td class="text-center"><?php echo $no++?></td>
                    <td><?php echo $data->nip;?></td>
                    <td><?php echo $data->kd_petugas;?></td>
                    <td><?php echo $data->nama;?></td>
                    <td><?php echo $data->posisi;?></td>
                    <td><?php echo $data->wilayah;?></td>
                  </tr>
                  <?php 
                }
              }else
                {
                  echo "<tr><td colspan='8' class='text-center'>Data tidak ada</td></tr>";
                }
              ?>
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