  <section class="content">

  <div class="row">

    <div class="col-md-5">
      <!-- Application buttons -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Application Buttons</h3>
        </div>
        <div class="box-body">
          <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a></code> tag to achieve the following:</p>
          <button class="btn btn-app" data-toggle="modal" data-target="#import-debitur">
            <span class="badge bg-teal">
              <?php
              foreach($debitur as $data)                              
              {
                ?>
                <?= $data->hasil;?>
              <?php }?>
            </span>
            <i class="fa fa-users"></i> Debitur
          </button>
          <button class="btn btn-app" data-toggle="modal" data-target="#hapus-debitur">
            <i class="fa fa-repeat"></i> Debitur
          </button>
          <button class="btn btn-app" data-toggle="modal" data-target="#import-tunggakan">
            <i class="fa fa-usd"></i> Tunggakan
          </button>
          <button class="btn btn-app"  data-toggle="modal" data-target="#hapus-tunggakan">
            <i class="fa fa-repeat"></i> Tunggakan
          </button>
          <button class="btn btn-app"  data-toggle="modal" data-target="#hapus-monitoring">
            <i class="fa fa-laptop"></i> Monitoring
          </button>
          <button class="btn btn-app"  data-toggle="modal" data-target="#hapus-agunan">
            <i class="fa fa-book"></i> Agunan
          </button>
          <button class="btn btn-app"  data-toggle="modal" data-target="#update-st">
            <i class="fa fa-files-o"></i> Surat Tugas
          </button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-xs-7">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Waktu Penampilan Surat Tugas</h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-hover" id="example">
            <thead>
              <tr>
                <th class="text-center">TANGGAL AWAL</th>
                <th class="text-center">TANGGAL AKHIR</th>
                <th class="text-center">UBAH</th>
                <th class="text-center" width="10%">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($waktu as $data)                              
              {
                ?> 
                <tr>
                  <td><?php echo $data['tgl_awal'];?></td>
                  <td><?php echo $data['tgl_akhir'];?></td>
                  <td class="text-center">
                    <a href="<?= base_url('config/update_tanggal/');?><?= $data['idwaktu']; ?>" class="btn-circle btn-sm btn-info" title="Ubah"><i class="fa fa-clock-o"></i></a>
                  </td>
                  <td class="text-center">
                    <a  href="javascript:;" 
                    data-id="<?php echo $data['idwaktu'] ?>" 
                    data-tgl_awal="<?php echo $data['tgl_awal'] ?>" 
                    data-tgl_akhir="<?php echo $data['tgl_akhir'] ?>" 
                    data-toggle="modal" data-target="#edit-data" data-toggle="modal" data-target="#ubah-data" class="btn-circle btn-sm btn-warning"> <i class="fa fa-edit"></i>
                    </a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>  
    </div>
  </div>
  <!-- ./row -->


  <?php if(!empty($this->session->flashdata('status'))){ ?>
    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('status'); ?></div>
  <?php } ?>

  <?php if(!empty($this->session->flashdata('hapus'))){ ?>
    <div class="alert alert-danger" role="alert"><?= $this->session->flashdata('hapus'); ?></div>
  <?php } ?>

</section>


<div class="modal fade" id="import-debitur">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">IMPORT DATA DEBITUR</h4>
        </div>
        <form role="form" action="<?= base_url('Import/import_debutur'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>Select File .xlsx</label>
                <input type="file" id="myDropify" name="fileExcel" class="border" required />
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<div class="modal modal-danger fade" id="hapus-debitur">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin menghapus semua data debitur?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TIDAK</button>
          <a href="<?= base_url('debitur/hapus_all');?>" class="btn btn-outline"><i class="fa fa-save"></i> SIMPAN</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<div class="modal fade" id="import-tunggakan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">UPDATE DATA TUNGGAKAN</h4>
        </div>
        <form role="form" action="<?= base_url('import/update_tunggakan'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>Select File .xlsx</label>
                <input type="file" id="myDropify" name="fileExcel" class="border" required />
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<div class="modal modal-danger fade" id="hapus-tunggakan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin menghapus semua data tunggakan?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TIDAK</button>
          <a href="<?= base_url('tunggakan/hapus_all');?>" class="btn btn-outline"><i class="fa fa-save"></i> SIMPAN</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<div class="modal modal-danger fade" id="hapus-monitoring">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin menghapus semua data monitoring?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TIDAK</button>
          <a href="<?= base_url('monitoring/hapus_all');?>" class="btn btn-outline"><i class="fa fa-save"></i> SIMPAN</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<div class="modal modal-danger fade" id="hapus-agunan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin menghapus semua data agunan?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TIDAK</button>
          <a href="<?= base_url('agunan/hapus_all');?>" class="btn btn-outline"><i class="fa fa-save"></i> SIMPAN</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>


<div class="modal fade" id="edit-data">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Waktu</h4>
      </div>
      <form role="form" action="<?php echo base_url('config/ubah_waktu')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        
        <div class="box-body">

          <div class="form-group">
            <label>TANGGAL AWAL</label>
            <input type="hidden" id="id" name="id">
            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
          </div>

          <div class="form-group">
            <label>TANGGAL AKHIR</label>
            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TUTUP</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal modal-success fade" id="update-st">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Update No. Surat Tugas!</h4>
        </div>
        
        <form role="form" action="<?= base_url('import/update_st'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>Select File .xlsx</label>
                <input type="file" id="myDropify" name="fileExcel" class="border" required />
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times-circle"></i> TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
          </div>
        </form>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>

<script>
   $(document).ready(function() {
       // Untuk sunting
       $('#edit-data').on('show.bs.modal', function (event) {
           var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
           var modal          = $(this)

           // Isi nilai pada field
           modal.find('#id').attr("value",div.data('id'));
           modal.find('#tgl_awal').attr("value",div.data('tgl_awal'));
           modal.find('#tgl_akhir').attr("value",div.data('tgl_akhir'));
       });
   });
 </script>