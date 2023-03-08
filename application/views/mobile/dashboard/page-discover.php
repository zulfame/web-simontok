 <!-- App Capsule -->
 <div id="appCapsule">

     <div class="header-large-title mt-2 mb-2">
         <h2 class="title">Discover</h2>
     </div>

     <div class="section mt-3 mb-3">
         <div class="card">
             <div class="card-body d-flex justify-content-between align-items-end">
                 <div>
                     <h5 class="card-title mb-0 d-flex align-items-center text-primary justify-content-between">
                         SURAT TUGAS
                     </h5>
                 </div>
                 <div class="custom-control custom-switch">
                     <h5 class="card-title mb-0 d-flex align-items-center text-primary justify-content-between">
                         <?= $hitung; ?>
                     </h5>
                 </div>

             </div>
         </div>

         <div class="alert alert-danger mb-2 mt-2 alert-dismissible fade show" role="alert">
             Berikan keterangan <b>status</b> untuk setiap <b>prospek</b>. <a href="<?= base_url('mobile/prospek'); ?>">Buka Prospek</a>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <ion-icon name="close-outline"></ion-icon>
             </button>
         </div>

     </div>

     <div class="section full mt-3 mb-3">
         <div class="carousel-multiple owl-carousel owl-theme">

             <?php foreach ($st as $s) : ?>
                 <div class="item">
                     <div class="card">
                         <img src="<?= base_url('assets/img/st/') . $s['image']; ?>" class="card-img-top" alt="image">
                         <div class="card-body pt-2">
                             <h5 class="mb-0"><?= $s['nama_debitur']; ?></h5>
                         </div>
                     </div>
                 </div>
             <?php endforeach; ?>

             <?php foreach ($st_wo as $s) : ?>
                 <div class="item">
                     <div class="card">
                         <img src="<?= base_url('assets/img/st/') . $s['image']; ?>" class="card-img-top" alt="image">
                         <div class="card-body pt-2">
                             <h5 class="mb-0"><?= $s['nama_debitur']; ?></h5>
                         </div>
                     </div>
                 </div>
             <?php endforeach; ?>

             <?php if (empty($st || $st_wo)) : ?>
                 <div class="item">
                     <div class="card">
                         <img src="<?= base_url('assets/img/st/'); ?>default.png" class="card-img-top" alt="image">
                         <div class="card-body pt-2">
                             <h5 class="mb-0">NO TASK TODAY</h5>
                         </div>
                     </div>
                 </div>
             <?php endif; ?>

         </div>
     </div>

     <?php
        $ip = $_SERVER['REMOTE_ADDR'];
        ?>

     <div class="section mt-3 mb-3">
         <div class="alert alert-primary mb-2 fade show" role="alert">
             <center>
                 <font style="font-weight:bold ;font-size:15px;">DEBITUR JANJI BAYAR</font>
             </center>
         </div>

         <div class="section full mt-2">

             <ul class="listview image-listview">
                 <?php foreach ($jb as $j) : ?>
                     <li>
                         <a href="<?= base_url('mobile/debitur/detail/') . $j['kd_credit']; ?>" class="item">
                             <div class="icon-box bg-success">
                                 <ion-icon name="alarm-outline"></ion-icon>
                             </div>
                             <div class="in">
                                 <div><?= $j['nama_debitur']; ?></div>
                                 <span class="text-muted">Detail</span>
                             </div>
                         </a>
                     </li>
                 <?php endforeach; ?>
                 <?php foreach ($jb_wo as $j) : ?>
                     <li>
                         <a href="<?= base_url('mobile/debitur/detail_wo/') . $j['kd_credit']; ?>" class="item">
                             <div class="icon-box bg-success">
                                 <ion-icon name="alarm-outline"></ion-icon>
                             </div>
                             <div class="in">
                                 <div><?= $j['nama_debitur']; ?></div>
                                 <span class="text-muted">Detail</span>
                             </div>
                         </a>
                     </li>
                 <?php endforeach; ?>

                 <!-- Alert Massage -->
                 <?php if (empty($jb || $jb_wo)) : ?>
                     <li>
                         <a href='#' class='item'>
                             <div class='icon-box bg-primary'>
                                 <ion-icon name='happy-outline'></ion-icon>
                             </div>
                             <div class='in'>
                                 <div>Debitur janji bayar tidak ada!</div>
                                 <span class='text-muted'></span>
                             </div>
                         </a>
                     </li>
                 <?php endif; ?>
                 <!-- End Alert Massage -->

             </ul>
         </div>

     </div>

     <div class="section mt-3 mb-3">
         <div class="card">
             <img src="<?= base_url('assets/mobile/img/'); ?>cs.png" class="card-img-top" alt="image">
             <div class="card-body">
                 <p class="card-text">
                     Jika terjadi error pada sistem segera hubungi tim IT untuk perbaikan secapatnya. Terimakasih.
                 </p>
                 <button data-toggle="modal" data-target="#ModalForm" class="btn btn-primary">
                     <ion-icon name="send-outline"></ion-icon>
                     Kirim Pesan
                 </button>
             </div>
         </div>
     </div>

     <!-- app footer -->
     <div class="appFooter">
         <div class="footer-title">
             <h3>SIMONTOK v2.0</h3>
         </div>

         <div>Mobile Version Sistem Monitoring kredit</div>
         To make it easier for officers to provide reports.

         <div class="mt-2">
             <span class="badge badge-dark">IP Address : <?= $_SERVER['REMOTE_ADDR']; ?></span>
         </div>
     </div>
     <!-- * app footer -->
 </div>
 <!-- * App Capsule -->

 <!-- Modal Form -->
 <div class="modal fade modalbox" id="ModalForm" data-backdrop="static" tabindex="-1" role="dialog">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Report</h5>
                 <a href="javascript:;" data-dismiss="modal">Close</a>
             </div>
             <div class="modal-body">

                 <div class="login-form mt-1">
                     <div class="section">
                         <img src="<?= base_url('assets/mobile/') ?>img/vactor/register.png" alt="image" class="form-image">
                     </div>
                     <div class="section mt-1">
                         <h3>What's your problem?</h3>
                     </div>
                 </div>

                 <form action="<?= base_url('mobile/dashboard/submit_report'); ?>" method="POST">
                     <div class="mt-2 pr-2 pl-2">
                         <?= $this->session->flashdata('message'); ?>
                         <?= $this->session->flashdata('message_failed'); ?>

                         <div class="form-group boxed">
                             <div class="input-wrapper">
                                 <input type="hidden" name="name" id="name" value="<?= $user['name']; ?>">
                                 <textarea class="form-control" name="report" id="report" cols="30" rows="5" required></textarea>
                             </div>
                         </div>
                     </div>

                     <div class="pr-2 pl-2">
                         <button type="submit" class="btn btn-primary btn-block">Send Report</button>
                     </div>
                 </form>

             </div>
         </div>
     </div>
 </div>
 <!-- * Modal Form -->