<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("prospek/filter/")?>">
            <div class="form-group pull-left">

              <table>
                <tr>
                  <td>
                    <input type="date" name="tgl" class="form-control" style="width:150px;" required="">
                  </td>
                  <td>
                    &nbsp;<select class="form-control select2" style="width:200px;" name="ksk">
                      <option value="">--Pilih KSK--</option>
                      <?php
                      foreach ($ksk as $list) 
                      {
                        echo "<option value='$list->id'>$list->nama</option>";
                      }
                      ?>
                    </select> 
                  </td>
                  <td>
                    &nbsp;<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
                  </td>
                </tr>
              </table>

            </div>
          </form>
        </div>
      </div>  
    </div>

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
                <th class="text-center">TANGGAL</th>
                <th class="text-center">LEADER</th>
                <th class="text-center">PLAN</th>
                <th class="text-center">TARGET</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($prospek as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?php echo $no++?></td>
                  <td><?php echo $data['tgl'];?></td>
                  <td><?php echo $data['nama'];?></td>
                  <td><?php echo $data['prospek'];?></td>
                  <td><?php echo $data['keterangan'];?></td>
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
