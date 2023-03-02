<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-body">
          <form method="get" action="<?php echo base_url("prospek/pilih/")?>">
            <div class="form-group pull-left">

              <table>
                <tr>
                  <td>
                    <input type="date" name="tgl" class="form-control" style="width:150px;" required="">
                  </td>
                  <td>
                    &nbsp;<select class="form-control select2" style="width:200px;" name="petugas">
                      <option value="">--Pilih Petugas--</option>
                      <?php
                      foreach ($petugas as $list) 
                      {
                        echo "<option value='$list->nip'>$list->nama</option>";
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
                <th class="text-center">PETUGAS</th>
                <th class="text-center">HUNTING</th>
                <th class="text-center">CALON DEBITUR</th>
                <th class="text-center">NO. HP</th>
                <th class="text-center">KETERANGAN</th>
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
                  <td><?php echo $data['calon_debitur'];?></td>
                  <td><?php echo $data['no_hp'];?></td>
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