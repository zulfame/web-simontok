<!-- App Capsule -->
<div id="appCapsule">

    <p></p>

    <div class="mt-2 pr-2 pl-2">
        <?= $this->session->flashdata('message'); ?>
    </div>

    <div class="section full mt-2">

        <ul class="listview image-listview">
            <?php foreach ($prospek as $p) :
                $calon = $p['calon_debitur'];
                if ($calon == NULL) {
                    $hasil = $p['prospek'];
                } else {
                    $hasil = $p['calon_debitur'];
                }

                if ($p['status'] == 'Closing') {
                    $sts = "<span class='badge badge-success'>Closing</span>";
                } elseif ($p['status'] == 'Failed') {
                    $sts = "<span class='badge badge-danger'>Failed</span>";
                } else {
                    $sts = "<span class='badge badge-warning'>Progres</span>";
                }
            ?>
                <li>
                    <a href="#" class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="happy-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div><?= $hasil; ?></div>
                            <?= $sts; ?>
                        </div>
                    </a>
                </li>
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