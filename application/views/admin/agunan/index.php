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
                <th class="text-center" width="12%">AKSI</th>
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
                  <td class="text-center">
                    
                    <a href="<?= base_url('agunan/edit/');?><?= $data->idagunan; ?>" class="btn-circle btn-sm btn-info" title="Ubah Data"><i class="fa fa-edit"></i></a>

                    <a onclick="return confirm('Apakah anda yakin untuk menghapus?')" class="btn-circle btn-sm btn-danger" href="<?= base_url('agunan/hapus/');?><?= $data->idagunan; ?>" title="Hapus Data"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah"> <i class="fa fa-file-excel-o"></i> 
            IMPORT
          </button>
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


<div class="modal fade" id="modal-tambah">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">IMPORT DATA AGUNAN</h4>
      </div>
      <form role="form" action="<?= base_url('Import/import_agunan'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        
        <div class="box-body">

          <div class="form-group">
            <label>Select File .xlsx</label>
            <input type="file" id="myDropify" name="fileExcel" class="border" required />
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>