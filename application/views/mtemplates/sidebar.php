<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">

                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                        <img src="<?= base_url('assets/mobile/');?>img/icons/72x72.png" alt="image" class="imaged rounded">
                    </div>
                    <div class="in">
                        <strong><?= $this->session->userdata('nama');?></strong>
                        <div class="text-muted">
                            <ion-icon name="location"></ion-icon>
                            <?= $this->session->userdata('wilayah');?>
                        </div>
                    </div>
                    <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <ul class="listview flush transparent no-line image-listview mt-2">
                    <div class="listview-title mt-2 mb-1">
                        <span>MAIN MENU</span>
                    </div>
                    <li>
                        <a href="<?= base_url('prospek/mprospek');?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="stats-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Prospek
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('debitur/mdebitur');?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="people-outline"></ion-icon>
                            </div>
                            <div class="in">
                                List Debitur
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('tugas/mtugas');?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Surat Tugas
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="moon-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Dark Mode</div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input dark-mode-switch"
                                    id="darkmodesidebar">
                                    <label class="custom-control-label" for="darkmodesidebar"></label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="<?= base_url('login/logout');?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="arrow-undo-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Keluar
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- sidebar buttons -->
            <div class="sidebar-buttons">
                <a href="javascript:;" class="button">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            </div>
            <!-- * sidebar buttons -->
        </div>
    </div>
</div>