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
                    <a  href="javascript:;" 
                    data-id="<?php echo $data['idprospek'] ?>" 
                    data-prospek="<?php echo $data['prospek'] ?>" 
                    data-debitur="<?php echo $data['calon_debitur'] ?>" 
                    data-nohp="<?php echo $data['no_hp'] ?>" 
                    data-keterangan="<?php echo $data['keterangan'] ?>" 
                    data-toggle="modal" data-target="#edit-data" data-toggle="modal" data-target="#ubah-data" class="btn-circle btn-sm btn-success"> <i class="fa fa-eye"></i>
                    </a> &nbsp;
                    <a onclick="return confirm('Apakah anda yakin menghapus?')" class="btn-circle btn-sm btn-danger" href="<?= base_url('prospek/hapus/');?><?= $data['idprospek']; ?>" title="Hapus"><i class="fa fa-trash"></i></a>
                    </td>
                  </td>
              <?php }?>
            </tbody>
          </table>
                    
          <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-tambah">
            <i class="fa fa-plus-square"></i> TAMBAH
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


<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">TAMBAH PROSPEK</h4>
        </div>
        <form role="form" method="post" action="<?= base_url('prospek/tambah');?>" enctype="multipart/form-data">
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
                <label>ACTIVITY</label>
                <select class="form-control select2" style="width: 100%;" name="prospek">
                  <option value="PROSPEK">PROSPEK</option>
                  <option value="SURVEY">SURVEY</option>
                  <option value="LAINNYA">LAINNYA</option>
                </select>
              </div>

              <div class="form-group">
                <label>CALON DEBITUR</label>
                <input type="text" class="form-control" name="debitur" required>
              </div>

              <div class="form-group">
                <label>NO. TELPON</label>
                <input type="number" class="form-control" name="no_hp" required>
              </div>

              <div class="form-group">
                <label>KETERANGAN</label>
                <input type="text" class="form-control" name="keterangan" required>
              </div>

              <div class="form-group">
                <label>FOTO</label>
                <input type="file" class="form-control" name="image">
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


<div class="modal fade" id="edit-data">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Prospek</h4>
      </div>
      <form role="form" action="<?php echo base_url('prospek/ubah')?>" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        
        <div class="box-body">

          <div class="form-group">
            <label>PROSPEK</label>
            <input type="hidden" id="id" name="id">
            <input type="text" class="form-control" id="prospek" name="prospek" placeholder="Prospek">
          </div>

          <div class="form-group">
            <label>CALON DEBITUR</label>
            <input type="text" class="form-control" id="debitur" name="debitur" placeholder="Calon Debitur">
          </div>

          <div class="form-group">
            <label>NO. TELPON</label>
            <input type="number" class="form-control" id="nohp" name="nohp">
          </div>


          <div class="form-group">
            <label>KETERANGAN</label>
            <input class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
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

<script>
   $(document).ready(function() {
       // Untuk sunting
       $('#edit-data').on('show.bs.modal', function (event) {
           var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
           var modal          = $(this)

           // Isi nilai pada field
           modal.find('#id').attr("value",div.data('id'));
           modal.find('#prospek').attr("value",div.data('prospek'));
           modal.find('#keterangan').attr("value",div.data('keterangan'));
           modal.find('#debitur').attr("value",div.data('debitur'));
           modal.find('#nohp').attr("value",div.data('nohp'));
           //modal.find('#debitur').html(div.data('debitur')); // untuk textarea
       });
   });
 </script>