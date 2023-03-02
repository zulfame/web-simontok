<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?= base_url('assets/'); ?>dist/img/user4-128x128.jpg" alt="User profile picture">

          <h3 class="profile-username text-center">
            <?= $this->session->userdata('nama');?>
          </h3>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Jabatan</b> <a class="pull-right">
                <?= $this->session->userdata('jabatan');?>
              </a>
            </li>
            <li class="list-group-item">
              <b>Wilayah</b> <a class="pull-right">
                <?= $this->session->userdata('wilayah');?>
              </a>
            </li>
          </ul>

          <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#activity" data-toggle="tab">Settings</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            <form class="form-horizontal" method="post" action="<?= base_url('config/save');?>">

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" value="<?= $this->session->userdata('nama');?>" placeholder="Nama Legkap" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Password Lama</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" placeholder="*************" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Password Lama</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="pass" placeholder="*************" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>
                </div>
              </div>
            </form>
          </div>

        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
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
<!-- /.content -->