<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= $title;?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <form method="get" action="<?php echo base_url("debitur/filter/")?>">
            <div class="form-group pull-left">
              <select class="form-control select2" style="width:200px;" name="wilayah">
                <option>--Pilih Wilayah--</option>
                <option value="Jalancagak">Jalancagak</option>
                <option value="Kalijati">Kalijati</option>
                <option value="Pagaden">Pagaden</option>
                <option value="Pamanukan">Pamanukan</option>
                <option value="Pusakajaya">Pusakajaya</option>
                <option value="Subang">Subang</option>
                <option value="Sukamandi">Sukamandi</option>
              </select>

              <select class="form-control select2" style="width:70px;" name="coll">
                <option>Coll</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>

              <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
            </div>
          </form>

          <div class="form-group pull-right">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah"> <i class="fa fa-upload"></i> 
              IMPORT
            </button>
            <a href="<?= base_url('export/export_debitur');?>" class="btn btn-default" target="_blank"> <i class="fa fa-download"></i> 
              EXPORT
            </a>
          </div>

          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">NO CREDIT</th>
                <th class="text-center">NAMA DEBITUR</th>
                <th class="text-center">JW</th>
                <th class="text-center">PLAFOND</th>
                <th class="text-center">METODE</th>
                <th class="text-center">PETUGAS</th>
                <th class="text-center">COLL</th>
                <th class="text-center">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($debitur as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td><?= $data['kd_credit']?></td>
                  <td><?= $data['nama_debitur']?></td>
                  <td class="text-center"><?= $data['jw']?></td>
                  <td>Rp. <?= rupiah($data['plafond']);?></td>
                  <td><?= $data['metode_rps'];?> </td>
                  <td><?= $data['nama'];?></td>
                  <td class="text-center"><?= $data['call'];?></td>
                  <td class="text-center">
                    <a href="<?= base_url('debitur/detail/');?><?= $data['kd_credit']; ?>" class="btn-circle btn-sm btn-success" title="Detail Data"><i class="fa fa-eye"></i></a>
                    
                    <a href="<?= base_url('debitur/edit/');?><?= $data['kd_credit']; ?>" class="btn-circle btn-sm btn-info" title="Ubah Data"><i class="fa fa-edit"></i></a>

                    <a onclick="return confirm('Klik oke untuk hapus <?= $data['nama_debitur'] ?>')" class="btn-circle btn-sm btn-danger" href="<?= base_url('debitur/hapus/');?><?= $data['kd_credit']; ?>" title="Hapus Data"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
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
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">TUTUP</button>
        <button type="submit" class="btn btn-primary">SIMPAN</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>