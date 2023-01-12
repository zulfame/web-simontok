<!-- App Bottom Menu -->
<div class="appBottomMenu">
    <a href="<?= base_url('mobile/dashboard'); ?>" class="item 
<?php if ($this->uri->segment(2) == "dashboard") {
    echo "active";
} ?>">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="<?= base_url('mobile/debitur'); ?>" class="item 
    <?php if ($this->uri->segment(2) == "debitur") {
        echo "active";
    } ?>">
        <div class="col">
            <ion-icon name="grid-outline"></ion-icon>
            <strong>Debitur</strong>
        </div>
    </a>
    <?php $role_id = $this->session->userdata('role_id');
    if ($role_id == 3 || $role_id == 4) {
        $mod = "ks";
    } else {
        $mod = "pt";
    }
    ?>
    <a class="item" data-toggle="modal" data-target="#action-<?= $mod; ?>">
        <div class="col">
            <div class="action-button 
            <?php if ($this->uri->segment(2) == "tugas") {
                echo "bg-success";
            } ?> large">
                <ion-icon name="add-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="<?= base_url('mobile/prospek'); ?>" class="item 
    <?php if ($this->uri->segment(2) == "prospek") {
        echo "active";
    } ?>">
        <div class="col">
            <ion-icon name="document-text-outline"></ion-icon>
            <strong>Prospek</strong>
        </div>
    </a>
    <a href="<?= base_url('mobile/user/profile'); ?>" class="item 
    <?php if ($this->uri->segment(2) == "user") {
        echo "active";
    } ?>">
        <div class="col">
            <ion-icon name="person-outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->

<!-- Iconed Action Sheet -->
<div class="modal fade action-sheet" id="action-ks" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Options</h5>
            </div>
            <div class="modal-body">
                <ul class="action-button-list">
                    <li>
                        <a href="<?= base_url('mobile/tugas'); ?>" class="btn btn-list text-primary">
                            <span>
                                <ion-icon name="document-outline"></ion-icon>
                                Tugas
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('mobile/tugas/catatan'); ?>" class="btn btn-list">
                            <span>
                                <ion-icon name="bookmarks-outline"></ion-icon>
                                Catatan
                            </span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#ModalForm-ks" class="btn btn-list" data-dismiss="modal">
                            <span>
                                <ion-icon name="bookmarks-outline"></ion-icon>
                                Prospek
                            </span>
                        </a>
                    </li>
                    <li class="action-divider"></li>
                    <li>
                        <a href="#" class="btn btn-list text-danger" data-dismiss="modal">
                            <span>
                                <ion-icon name="close-outline"></ion-icon>
                                Tutup
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- * Iconed Action Sheet -->

<!-- Iconed Action Sheet -->
<div class="modal fade action-sheet" id="action-pt" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Options</h5>
            </div>
            <div class="modal-body">
                <ul class="action-button-list">
                    <li>
                        <a href="<?= base_url('mobile/tugas'); ?>" class="btn btn-list text-primary">
                            <span>
                                <ion-icon name="document-outline"></ion-icon>
                                Tugas
                            </span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#ModalForm-pt" class="btn btn-list" data-dismiss="modal">
                            <span>
                                <ion-icon name="bookmarks-outline"></ion-icon>
                                Prospek
                            </span>
                        </a>
                    </li>
                    <li class="action-divider"></li>
                    <li>
                        <a href="#" class="btn btn-list text-danger" data-dismiss="modal">
                            <span>
                                <ion-icon name="close-outline"></ion-icon>
                                Tutup
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- * Iconed Action Sheet -->

<!-- Modal Form -->
<div class="modal fade modalbox" id="ModalForm-ks" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prospek</h5>
                <a href="javascript:;" data-dismiss="modal">Close</a>
            </div>
            <div class="modal-body">

                <div class="login-form mt-1">
                    <div class="section">
                        <img src="<?= base_url('assets/mobile/') ?>img/vactor/monitor.png" alt="image" class="form-image">
                    </div>
                    <div class="section mt-1">
                        <h3>Apa prospek hari ini?</h3>
                    </div>
                </div>

                <form action="<?= base_url('mobile/prospek/prospect_ks'); ?>" method="POST">
                    <div class="mt-2 pr-2 pl-2">

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input class="form-control" type="text" name="plan" value="<?= set_value('plan'); ?>" placeholder="Plan" required>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input type="hidden" name="name" id="name" value="<?= $user['name']; ?>">
                                <textarea class="form-control" name="target" cols="30" rows="5" value="<?= set_value('target'); ?>" placeholder="Target" required></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="pr-2 pl-2">
                        <button type="submit" class="btn btn-primary btn-block">TAMBAH PROSPEK</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- * Modal Form -->

<!-- Modal Form -->
<div class="modal fade modalbox" id="ModalForm-pt" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prospek</h5>
                <a href="javascript:;" data-dismiss="modal">Close</a>
            </div>
            <div class="modal-body">

                <div class="login-form mt-1">
                    <!-- <div class="section">
                        <img src="<?= base_url('assets/mobile/') ?>img/vactor/monitor.png" alt="image" class="form-image">
                    </div> -->
                    <div class="section mt-1">
                        <h3>Apa prospek hari ini?</h3>
                    </div>
                </div>

                <form action="<?= base_url('mobile/prospek/prospect_add'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mt-2 pr-2 pl-2">
                        <?= $this->session->flashdata('message'); ?>
                        <?= $this->session->flashdata('message_failed'); ?>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <select class="form-control" name="hunting" value="<?= set_value('hunting'); ?>" required>
                                    <option value="">--Pilih Hunting--</option>
                                    <option value="Prospek">Prospek</option>
                                    <option value="Survey">Survey</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input class="form-control" type="text" name="candidate" value="<?= set_value('candidate'); ?>" placeholder="Calon Debitur" required>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input class="form-control" type="number" name="telp" value="<?= set_value('telp'); ?>" placeholder="No. Telepon" required>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <input type="hidden" name="name" id="name" value="<?= $user['name']; ?>">
                                <textarea class="form-control" name="description" cols="30" rows="3" value="<?= set_value('description'); ?>" placeholder="Keterangan" required></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="old_img" id="old_img" value="default.png">
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <div class="custom-file-upload" id="fileUpload1" style="height:120px;">
                                    <input type="file" id="UploadProspek" accept=".png, .jpg, .jpeg" name="image" id="image">
                                    <label for="UploadProspek">
                                        <span>
                                            <strong>
                                                <ion-icon name="cloud-upload-outline"></ion-icon>
                                                <i>Tap to Upload</i>
                                            </strong>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="pr-2 pl-2">
                        <button type="submit" class="btn btn-primary btn-block">TAMBAH PROSPEK</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- * Modal Form -->