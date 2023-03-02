<?php
$level = $this->session->userdata('level');
$nama = $this->session->userdata('nama');
if ($level == "Administrator") {
?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                  echo "active";
                } ?>"><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="header">MAIN MENU</li>

    <li class="
  <?php
  if ($this->uri->segment(1) == "backup") {
    echo "active";
  } elseif ($this->uri->segment(1) == "config") {
    echo "active";
  }
  ?>
  treeview">
      <a href="#">
        <i class="fa fa-gears"></i> <span>Config</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ($this->uri->segment(1) == "config") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('config'); ?>"><i class="fa fa-cubes"></i> <span>Master</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "backup") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('backup/index'); ?>"><i class="fa fa-cloud-download"></i> <span>Backup</span></a>
        </li>
      </ul>
    </li>

    <li class="
  <?php
  if ($this->uri->segment(1) == "petugas") {
    echo "active";
  } elseif ($this->uri->segment(1) == "tunggakan") {
    echo "active";
  } elseif ($this->uri->segment(1) == "agunan") {
    echo "active";
  } elseif ($this->uri->segment(1) == "pengguna") {
    echo "active";
  } elseif ($this->uri->segment(1) == "debitur") {
    echo "active";
  }
  ?>
  treeview">
      <a href="#">
        <i class="fa fa-database"></i> <span>Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ($this->uri->segment(1) == "agunan") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('agunan'); ?>"><i class="fa fa-area-chart"></i> <span>Data Agunan</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "debitur") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('debitur'); ?>"><i class="fa fa-users"></i> <span>Data Debitur</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "petugas") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('petugas'); ?>"><i class="fa fa-user-plus"></i> <span>Data Petugas</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "pengguna") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('pengguna'); ?>"><i class="fa fa-user-plus"></i> <span>Data Pengguna</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "tunggakan") {
                      echo "active";
                    } ?>">
          <a href="<?= base_url('tunggakan'); ?>"><i class="fa fa-money"></i> <span>Data Tunggakan</span></a>
        </li>
      </ul>
    </li>
  </ul>

<?php }
?>


<?php
$level = $this->session->userdata('level');
$nama = $this->session->userdata('nama');
if ($level == "Direksi") {
?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                  echo "active";
                } ?>"><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="header">MAIN</li>

    <li class="
  <?php
  if ($this->uri->segment(1) == "petugas") {
    echo "active";
  } elseif ($this->uri->segment(1) == "agunan") {
    echo "active";
  } elseif ($this->uri->segment(1) == "debitur") {
    echo "active";
  }
  ?>
  treeview">
      <a href="#">
        <i class="fa fa-gears"></i> <span>Master</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ($this->uri->segment(1) == "agunan") {
                      echo "active";
                    } ?>"><a href="<?= base_url('agunan/all'); ?>"><i class="fa fa-area-chart"></i> <span>Data Agunan</span></a></li>
        <li class="<?php if ($this->uri->segment(1) == "debitur") {
                      echo "active";
                    } ?>"><a href="<?= base_url('debitur/all'); ?>"><i class="fa fa-users"></i> <span>Data Debitur</span></a></li>
        <li class="<?php if ($this->uri->segment(1) == "petugas") {
                      echo "active";
                    } ?>"><a href="<?= base_url('petugas/all'); ?>"><i class="fa fa-user-plus"></i> <span>Data Petugas</span></a></li>
      </ul>
    </li>

    <li class="header">REPORT</li>

    <li class="
  <?php
  if ($this->uri->segment(1) == "tugas") {
    echo "active";
  } elseif ($this->uri->segment(1) == "monitoring") {
    echo "active";
  }
  ?>
  treeview">
      <a href="#">
        <i class="fa fa-book"></i> <span>Laporan</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ($this->uri->segment(1) == "tugas") {
                      echo "active";
                    } ?>"><a href="<?= base_url('tugas/report'); ?>">
            <i class="fa fa-file-o"></i> <span>Surat Tugas</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "monitoring") {
                      echo "active";
                    } ?>"><a href="<?= base_url('monitoring/remedial'); ?>">
            <i class="fa fa-laptop"></i> <span>KMD Remedial</span></a>
        </li>
        <li class="<?php if ($this->uri->segment(1) == "monitoring") {
                      echo "active";
                    } ?>"><a href="<?= base_url('monitoring/ao'); ?>">
            <i class="fa fa-laptop"></i> <span>KMD AO Kredit</span></a>
        </li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-book"></i> <span>Prospek</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?= base_url('prospek/report_ao'); ?>">
            <i class="fa fa-file-o"></i> <span>Prospek AO</span></a>
        </li>
        <li><a href="<?= base_url('prospek/report_ksk'); ?>">
            <i class="fa fa-file-o"></i> <span>Prospek KSK</span></a>
        </li>
      </ul>
    </li>

    <li class="header">DOWNLOAD</li>
    <li><a href="<?= base_url('report'); ?>">
        <i class="fa fa-file-o"></i> <span>DATA KUNJUNGAN</span></a>
    </li>
  </ul>

<?php }
?>


<?php
$level = $this->session->userdata('level');
$nama = $this->session->userdata('nama');
if ($level == "KKW") {
?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                  echo "active";
                } ?>"><a href="<?= base_url('dashboard/ksk'); ?>">
        <i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a>
    </li>

    <li class="header">MONITORING</li>

    <li><a href="<?= base_url('prospek/data'); ?>">
        <i class="fa fa-folder"></i> <span>PROSPEK AO</span></a>
    </li>
    <li><a href="<?= base_url('prospek'); ?>">
        <i class="fa fa-folder"></i> <span>PROSPEK KSK</span></a>
    </li>
    <li><a href="<?= base_url('debitur/data'); ?>">
        <i class="fa fa-folder"></i> <span>LIST DEBITUR</span></a>
    </li>
    <li><a href="<?= base_url('tugas/data'); ?>">
        <i class="fa fa-folder"></i> <span>SURAT TUGAS</span></a>
    </li>
    <li><a href="<?= base_url('monitoring/debitur'); ?>">
        <i class="fa fa-folder"></i> <span>KARTU MONITORING</span></a>
    </li>

  </ul>

<?php }
?>


<?php
$level = $this->session->userdata('level');
$nama = $this->session->userdata('nama');
if ($level == "AO") {
?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="<?php if ($this->uri->segment(1) == "dashboard") {
                  echo "active";
                } ?>"><a href="<?= base_url('dashboard/ao'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="header">MONITORING</li>

    <li class="
  <?php
  if ($this->uri->segment(1) == "debitur") {
    echo "active";
  } elseif ($this->uri->segment(1) == "tugas") {
    echo "active";
  } elseif ($this->uri->segment(1) == "monitoring") {
    echo "active";
  } elseif ($this->uri->segment(1) == "prospek") {
    echo "active";
  }
  ?>
  treeview">
      <a href="#">
        <i class="fa fa-laptop"></i> <span>Monitoring</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if ($this->uri->segment(1) == "prospek") {
                      echo "active";
                    } ?>"><a href="<?= base_url('prospek/list'); ?>"><i class="fa fa-book"></i> <span>Prospek</span></a></li>

        <li class="<?php if ($this->uri->segment(1) == "debitur") {
                      echo "active";
                    } ?>"><a href="<?= base_url('debitur/list'); ?>"><i class="fa fa-navicon"></i> <span>List Debitur</span></a></li>

        <li class="<?php if ($this->uri->segment(1) == "tugas") {
                      echo "active";
                    } ?>"><a href="<?= base_url('tugas/list'); ?>"><i class="fa fa-plus-square"></i> <span>Surat Tugas</span></a></li>

        <li class="<?php if ($this->uri->segment(1) == "monitoring") {
                      echo "active";
                    } ?>"><a href="<?= base_url('monitoring/list'); ?>"><i class="fa fa-credit-card"></i> <span>Kartu Monitoring</span></a></li>
      </ul>
    </li>
  </ul>

<?php }
?>



<?php
$level = $this->session->userdata('level');
if ($level == "Remedial") {
?>
  <ul class="sidebar-menu" data-widget="tree">
    <li class="<?php if ($this->uri->segment(1) == "remedial") {
                  echo "active";
                } ?>"><a href="<?= base_url('remedial'); ?>">
        <i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a>
    </li>

    <li class="header">MONITORING</li>

    <li>
      <a href="<?= base_url('remedial/prospek'); ?>"><i class="fa fa-folder"></i> <span>PROSPEK KSR</span></a>
    </li>

    <li>
      <a href="<?= base_url('remedial/debitur'); ?>"><i class="fa fa-folder"></i> <span>LIST DEBITUR</span></a>
    </li>

    <li>
      <a href="<?= base_url('remedial/tugas/data'); ?>"><i class="fa fa-folder"></i> <span>SURAT TUGAS</span></a>
    </li>

    <li>
      <a href="<?= base_url('remedial/prospek/staff'); ?>"><i class="fa fa-folder"></i> <span>PROSPEK STAFF</span></a>
    </li>

    <li>
      <a href="<?= base_url('remedial/monitoring'); ?>"><i class="fa fa-folder"></i> <span>KARTU MONITORING</span></a>
    </li>

  </ul>

<?php }
?>