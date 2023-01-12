<!doctype html>
<html lang="en">

<head>
  <title><?= $title; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="theme-color" content="#000000">
  <meta name="description" content="Sistem Informasi Monitoring Kredit">
  <meta name="keywords" content="Sistem Informasi Monitoring Kredit" />
  <link rel="icon" type="image/png" href="<?= base_url('assets/mobile/') ?>img/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/mobile/') ?>img/icon/192x192.png">

  <link rel="stylesheet" href="<?= base_url('assets/css/'); ?>font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/mobile/') ?>css/style.css">
  <link rel="manifest" href="__manifest.json">
</head>

<body>

  <!-- loader -->
  <div id="loader">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
  <!-- * loader -->

  <!-- App Header -->
  <div class="appHeader">
    <div class="left">
      <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
        <ion-icon name="menu-outline"></ion-icon>
      </a>
    </div>
    <div class="pageTitle">
      <img src="<?= base_url('assets/mobile/') ?>/img/logo.png" alt="logo" style="width:130px;height:31px;">
    </div>
    <?php


    if ($hitung == 0) {
      $n = "success";
    } else {
      $n = "danger";
    }
    ?>
    <div class="right">
      <a data-toggle="modal" data-target="#ModalListview" class="headerButton">
        <ion-icon name="notifications-outline"></ion-icon>
        <span class="badge badge-<?= $n; ?>"><?= $hitung; ?></span>
      </a>
    </div>
  </div>
  <!-- * App Header -->

  <!-- Modal Listview -->
  <div class="modal fade modalbox" id="ModalListview" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Belum Dikerjakan</h5>
          <a href="javascript:;" data-dismiss="modal">Close</a>
        </div>
        <div class="modal-body p-0">

          <ul class="listview image-listview flush mb-2">

            <?php foreach ($undone as $u) : ?>
              <li>
                <a href="<?= base_url('mobile/tugas/report/') . $u['id_st'] . "/" . $u['kd_credit']; ?>">
                  <div class="item">
                    <div class="icon-box bg-primary">
                      <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                    <div class="in">
                      <div><?= $u['nama_debitur']; ?> - <?= $u['petugas_code']; ?></div>
                    </div>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>
            <?php if (empty($undone || $undonewo)) : ?>
              <li>
                <a href="#">
                  <div class="item">
                    <div class='icon-box bg-primary'>
                      <ion-icon name='happy-outline'></ion-icon>
                    </div>
                    <div class="in">
                      <div>ALL DONE</div>
                    </div>
                  </div>
                </a>
              </li>
            <?php endif; ?>

            <?php foreach ($undonewo as $u) : ?>
              <li>
                <a href="<?= base_url('mobile/tugas/report_wo/') . $u['id_st'] . "/" . $u['kd_credit']; ?>">
                  <div class="item">
                    <div class="icon-box bg-primary">
                      <ion-icon name="document-text-outline"></ion-icon>
                    </div>
                    <div class="in">
                      <div><?= $u['nama_debitur']; ?> - <?= $u['petugas_code']; ?></div>
                    </div>
                  </div>
                </a>
              </li>
            <?php endforeach; ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- * Modal Listview -->