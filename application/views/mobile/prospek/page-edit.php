<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2">
        <div class="profile-head">
            <div class="avatar">
                <img src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="avatar" class="imaged w64">
            </div>
            <div class="in">
                <h3 class="name"><?= $prospek['calon_debitur']; ?></h3>
                <h5 class="subtext" style="text-transform:uppercase ;">[ <?= $prospek['prospek']; ?> ]</h5>
            </div>
        </div>
    </div>

    <div class="section mt-1 mb-2">
        <div class="profile-info">
            <div class=" bio">

            </div>
            <div class="link">
            </div>
        </div>
    </div>

    <div class="section full mb-2">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="report" role="tabpanel">
                <form action="<?= base_url('mobile/prospek/prospect_update') ?>" method="POST" enctype="multipart/form-data">

                    <div class="mt-2 pr-2 pl-2">
                        <hr>
                        <?= $this->session->flashdata('message'); ?>
                        <?= $this->session->flashdata('message_failed'); ?>

                        <h3 class="name">Edit Prospek</h3>
                        <hr>

                        <input type="hidden" name="id_prospek" value="<?= $prospek['id_prospek']; ?>">
                        <input type="hidden" name="old_img" id="old_img" value="<?= $prospek['image_prospek']; ?>">

                        <div class="input-wrapper">
                            <label class="form-label">Hunting</label>
                            <select class="form-control" name="hunting" id="hunting" required>
                                <option value="">--Action--</option>
                                <?php foreach ($list as $pr) : ?>
                                    <?php if ($pr == $prospek['prospek']) : ?>
                                        <option value="<?= $pr; ?>" selected><?= $pr; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $pr; ?>"><?= $pr; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Calon Debitur</label>
                                <input class="form-control" type="text" name="candidate" id="candidate" value="<?= $prospek['calon_debitur']; ?>">
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">No. HP</label>
                                <input class="form-control" type="number" name="telp" id="telp" value="<?= $prospek['no_hp']; ?>">
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" cols="30" rows="4" name="description" id="description"><?= $prospek['keterangan']; ?></textarea>
                            </div>
                        </div>

                        <div class="input-wrapper mb-1">
                            <label class="form-label">Status</label>


                            <?php
                            $st = $prospek['status'];
                            if ($st == "1") {
                                $ket = "Closing";
                            } else {
                                $ket = "Progres";
                            } ?>

                            <select class="form-control" name="status" id="status" required>
                                <!-- <option value="0">Progres</option>
                                <option value="1">Closing</option> -->

                                <?php foreach ($hasil as $pr) : ?>
                                    <?php if ($pr == $prospek['status']) : ?>
                                        <option value="<?= $pr; ?>" selected><?= $ket; ?></option>
                                    <?php else : ?>

                                        <?php if ($pr == "1") {
                                            $hp = "Closing";
                                        } else {
                                            $hp = "Progres";
                                        } ?>

                                        <option value="<?= $pr; ?>"><?= $hp; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="accordion" id="accordionProspek">
                            <div class="item">
                                <div class="accordion-header">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion-image">
                                        <font style="margin-left:-19px;">Foto Penanganan</font>
                                    </button>
                                </div>
                                <div id="accordion-image" class="accordion-body collapse" data-parent="#accordionProspek">
                                    <div class="accordion-content">
                                        <img src="<?= base_url('assets/img/prospek/'); ?><?= $prospek['image_prospek'] ?>" alt="image" class="imaged img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <div class="custom-file-upload" id="UploadProspek" style="height:120px;">
                                    <input type="file" id="fileuploadProspek" accept=".png, .jpg, .jpeg" name="image" id="image">
                                    <label for="fileuploadProspek">
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
                        <button type="submit" class="btn btn-primary btn-block">SIMPAN</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>