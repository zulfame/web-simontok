<!-- App Capsule -->
<div id="appCapsule">

    <p></p>

    <div class="mt-2 pr-2 pl-2">
        <?= $this->session->flashdata('message'); ?>
    </div>

    <div class="section full mt-2">

        <ul class="listview image-listview">
            <?php foreach ($prospek as $p) :

                if ($p['status'] == '1') {
                    $sts = "<span class='badge badge-success'>Closing</span>";
                } else {
                    $sts = "<span class='badge badge-warning'>Progres</span>";
                }
            ?>
                <li>
                    <a data-toggle="modal" data-target="#actionSheetIconed<?= $p['id_prospek']; ?>" class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="happy-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div><?= $p['calon_debitur'];?></div>
                            <?= $sts; ?>
                        </div>
                    </a>
                </li>

                <!-- Iconed Action Sheet -->
                <div class="modal fade action-sheet" id="actionSheetIconed<?= $p['id_prospek']; ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Action Sheet Title</h5>
                            </div>
                            <div class="modal-body">
                                <ul class="action-button-list">
                                    <li>
                                        <a href="<?= base_url('mobile/prospek/prospect_edit/') . $p['id_prospek']; ?>" class="btn btn-list text-primary">
                                            <span>
                                                <ion-icon name="document-outline"></ion-icon>
                                                Buka
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= base_url('mobile/prospek/prospect_delete/') . $p['id_prospek']; ?>" class="btn btn-list">
                                            <span>
                                                <ion-icon name="trash-outline"></ion-icon>
                                                Hapus
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

            <?php endforeach; ?>

            <!-- Alert Massage -->
            <?php if (empty($prospek)) : ?>
                <li>
                    <a href='#' class='item'>
                        <div class='icon-box bg-secondary'>
                            <ion-icon name='sad-outline'></ion-icon>
                        </div>
                        <div class='in'>
                            <div>Tidak ada prospek!</div>
                            <span class='text-muted'></span>
                        </div>
                    </a>
                </li>
            <?php endif; ?>
            <!-- End Alert Massage -->

        </ul>
    </div>
</div>
<!-- * App Capsule -->