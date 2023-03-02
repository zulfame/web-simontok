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
                <th class="text-center" width="10%">NO CIF</th>
                <th class="text-center" width="15%">LOKASI</th>
                <th class="text-center">AGUNAN</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($agunan as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td><?= $data->idagunan;?></td>
                  <td><?= $data->lokasi;?></td>
                  <td><?= $data->agunan;?> </td>
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