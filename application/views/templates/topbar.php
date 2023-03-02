<?php
  $id = $this->session->userdata('level');
  if ($id == "AO") 
  {
    $d = 'config/profile';
  }
  else
  {
    $d = 'config/profil';
  }
?>

<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K</b>MD</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIMONTOK</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Selamat Datang! <?= $this->session->userdata('nama');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url('assets/');?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('nama');?>
                  <small>Member since  <?= date('d F Y', $this->session->userdata('date_created')); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <?php
                  $level=$this->session->userdata('level');
                  if($level=="Administrator" || $level=="Direksi" || $level=="KKW" || $level=="Remedial")
                  {
                    ?>
                  <a href="<?= base_url('config/profil');?>" class="btn btn-default btn-flat">Profile</a>
                  <?php }
                  ?>

                  <?php
                  $level=$this->session->userdata('level');
                  if($level=="AO")
                  {
                    ?>
                  <a href="<?= base_url($d);?>" class="btn btn-default btn-flat">Profile</a>
                  <?php }
                  ?>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('login/logout');?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>