<!-- App Header -->
<div class="appHeader bg-primary scrolled">
    <div class="left">
        <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        SIMONTOK
    </div>
    <div class="right">
        <a href="javascript:;" class="headerButton toggle-searchbox">
            <ion-icon name="search-outline"></ion-icon>
        </a>
    </div>
</div>
<!-- * App Header -->

<!-- Search Component -->
<div id="search" class="appHeader">
    <form class="search-form">
        <div class="form-group searchbox">
            <input type="text" class="form-control" placeholder="Search...">
            <i class="input-icon">
                <ion-icon name="search-outline"></ion-icon>
            </i>
            <a href="javascript:;" class="ml-1 close toggle-searchbox">
                <ion-icon name="close-circle"></ion-icon>
            </a>
        </div>
    </form>
</div>
<!-- * Search Component -->

<!-- App Capsule -->
<div id="appCapsule">

    <div class="header-large-title">
        <h3 class="title">Dashboard.</h3>
    </div>

    <div class="section mt-3 mb-3">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-end">
                <div>
                    <h6 class="card-subtitle">SURAT TUGAS</h6>
                    <h5 class="card-title mb-0 d-flex align-items-center justify-content-between">
                        <?php
                         foreach($jml_tugas as $data)                              
                         {
                         ?>
                         <?= $data->hasil;?>
                         <?php }?>
                     </h5>
                 </div>
                 <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch" disabled>
                    <label class="custom-control-label" for="darkmodeswitch"></label>
                </div>
            </div>
        </div></p>

        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-end">
                <div>
                    <h6 class="card-subtitle">BELUM DIKERJAKAN</h6>
                    <h5 class="card-title mb-0 d-flex align-items-center justify-content-between">
                        <?php
                         foreach($jml_tugas_done as $data)                              
                         {
                         ?>
                         <?= $data->hasil;?>
                         <?php }?>
                     </h5>
                 </div>
                 <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch" disabled>
                    <label class="custom-control-label" for="darkmodeswitch"></label>
                </div>
            </div>
        </div>
    </div>


    <div class="section mt-3 mb-3">
        <div class="card">
            <img src="<?= base_url('assets/mobile/img/');?>cs.png" class="card-img-top" alt="image">
            <div class="card-body">
                <p class="card-text">
                    Jika terjadi error pada sistem segera hubungi tim IT untuk perbaikan secapatnya. Terimakasih.
                </p>
                <a href="https://api.whatsapp.com/send?phone=6282320099971&text=Halo%2C%20terjadi%20kesalahan%20pada%20aplikasi%20SIMONTOK!" class="btn btn-success">
                    <ion-icon name="logo-whatsapp"></ion-icon>
                    Kirim Pesan
                </a>
            </div>
        </div>
    </div>


    <!-- app footer -->
    <div class="appFooter">
        <img src="<?= base_url('assets/mobile/');?>img/pba.png" style="width:250px;height: 35px;" alt="icon" class="footer-logo mb-2">
        <div class="footer-title">
          SIMONTOK Beta v1.0
      </div>

      <div>Versi Mobile dari sistem monitoring kredit</div>
      Untuk mempermudah petugas dalam memberikan laporan.

      <div class="mt-2">
        <a href="https://bprbangunarta.co.id" class="btn btn-icon btn-sm btn-secondary goTop">
            <ion-icon name="globe-outline"></ion-icon>
        </a>
        <a href="https://www.facebook.com/bangunarta.official" class="btn btn-icon btn-sm btn-facebook">
            <ion-icon name="logo-facebook"></ion-icon>
        </a>
        <a href="https://www.instagram.com/bprbangunarta/" class="btn btn-icon btn-sm btn-instagram">
            <ion-icon name="logo-instagram"></ion-icon>
        </a>
        <a href="https://api.whatsapp.com/send?phone=6282316285552" class="btn btn-icon btn-sm btn-whatsapp">
            <ion-icon name="logo-whatsapp"></ion-icon>
        </a>
    </div>

</div>
<!-- * app footer -->

</div>
<!-- * App Capsule -->

<!-- welcome notification  -->
<div id="notification-welcome" class="notification-box">
    <div class="notification-dialog android-style">
        <div class="notification-header">
            <div class="in">
                <img src="<?= base_url('assets/mobile/');?>img/icons/72x72.png" alt="image" class="imaged w24">
                <strong>SIMONTOK</strong>
                <span>just now</span>
            </div>
            <a href="#" class="close-button">
                <ion-icon name="close"></ion-icon>
            </a>
        </div>
        <div class="notification-content">
            <div class="in">
                <h3 class="subtitle">Selamat Datang!</h3>
                <div class="text">
                    Sistem informasi monitoring kredit debitur.
                    A great way to make monitoring your work easier.
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- * welcome notification -->