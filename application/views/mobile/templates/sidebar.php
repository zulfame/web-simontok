    <!-- App Sidebar -->
    <div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">

                    <!-- profile box -->
                    <div class="profileBox">
                        <div class="image-wrapper">
                            <img src="<?= base_url('assets/'); ?>img/profile/<?= $user['image']; ?>" alt="image" class="imaged rounded">
                        </div>
                        <div class="in">
                            <strong><?= $user['name']; ?></strong>
                            <div class="text-muted">
                                <ion-icon name="location"></ion-icon>
                                <?= $user['region']; ?>
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
                            <a href="<?= base_url('mobile/dashboard'); ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Discover
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('mobile/prospek'); ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="stats-chart-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Prospek
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('mobile/debitur'); ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="people-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    List Debitur
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('mobile/tugas'); ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Surat Tugas
                                </div>
                            </a>
                        </li>
                        <hr>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="moon-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Dark Mode</div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodesidebar">
                                        <label class="custom-control-label" for="darkmodesidebar"></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- sidebar buttons -->
                <div class="sidebar-buttons">
                    <a href="<?= base_url('mobile/user/profile'); ?>" class="button btn-primary">
                        <ion-icon name="information-circle-outline"></ion-icon>
                    </a>
                    <a href="<?= base_url('mobile/auth/logout'); ?>" class="button btn-warning">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </a>
                </div>
                <!-- * sidebar buttons -->
            </div>
        </div>
    </div>
    <!-- * App Sidebar -->