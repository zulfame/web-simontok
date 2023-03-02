<section class="content">
  <div class="row">

    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example3" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th class="text-center">TANGGAL</th>
                <th class="text-center">PETUGAS</th>
                <th class="text-center">HUNTING</th>
                <th class="text-center">CALON DEBITUR</th>
                <th class="text-center">NO. HP</th>
                <th class="text-center">KETERANGAN</th>
                <th class="text-center">AKSI</th>
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
                  <td class="text-center">
                    <a class="btn-circle btn-sm btn-success" href="#" title="detail"><i class="fa fa-eye"></i></a>

                    <a onclick="return confirm('Apakah anda yakin menghapus?')" class="btn-circle btn-sm btn-danger" href="<?= base_url('remedial/prospek/hapus_staff/');?><?= $data['idprospek']; ?>" title="Hapus"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </td>
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

  <?php if(!empty($this->session->flashdata('tambah'))){ ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('tambah'); ?></div>
  <?php } ?>

  <?php if(!empty($this->session->flashdata('hapus'))){ ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>

   <?php if(!empty($this->session->flashdata('edit'))){ ?>
    <div class="alert alert-warning" role="alert"><?= $this->session->flashdata('edit'); ?></div>
  <?php } ?>

</section>