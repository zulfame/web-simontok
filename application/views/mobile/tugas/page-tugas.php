<!-- App Capsule -->
<div id="appCapsule">

    <p></p>

    <div class="section full mt-2">
        <ul class="listview image-listview">

            <?php foreach ($st as $s) :
                $ket = $s['pelaksanaan'];
                if ($ket == NULL) {
                    $hasil = "<span class='badge badge-danger'>Empty</span>";
                } else {
                    $hasil = "<span class='badge badge-success'>Done</span>";
                }
            ?>
                <li>
                    <a href="<?= base_url('mobile/tugas/report/') . $s['id_st'] . "/" . $s['kd_credit']; ?>" class="item">
                        <div class="icon-box bg-secondary">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div><?= $s['nama_debitur']; ?></div>
                            <?= $hasil; ?>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>

            <!-- <?php foreach ($st_wo as $s) : ?>
                <li>
                    <a href="<?= base_url('mobile/tugas/report_wo/') . $s['id_st'] . "/" . $s['kd_credit']; ?>" class=" item">
                        <div class="icon-box bg-secondary">
                            <ion-icon name="document-text-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div><?= $s['nama_debitur']; ?></div>
                            <?= $hasil; ?>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?> -->

            <!-- Alert Massage -->
            <?php if (empty($st || $st_wo)) : ?>
                <li>
                    <a href='#' class='item'>
                        <div class='icon-box bg-secondary'>
                            <ion-icon name='sad-outline'></ion-icon>
                        </div>
                        <div class='in'>
                            <div>Tidak ada tugas!</div>
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