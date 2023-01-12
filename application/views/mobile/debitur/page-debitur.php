<!-- App Capsule -->
<div id="appCapsule">
    <p></p>
    <div class="section full">
        <div class="wide-block pt-2 pb-2">
            <form class="search-form" action="<?= base_url('mobile/debitur/index') ?>" method="POST">
                <div class="form-group searchbox">
                    <input type="text" name="keyword" class="form-control" placeholder="Search...">
                    <i class="input-icon">
                        <ion-icon name="search-outline"></ion-icon>
                    </i>
                    &nbsp;
                    <input type="submit" class="btn btn-primary btn-default" style="border-radius: 10px;" name="submit" value="Search">
                </div>
            </form>
        </div>
    </div>

    <div class="section full mt-2">

        <ul class="listview image-listview">
            <?php foreach ($debitur as $d) : ?>
                <li>
                    <a href="<?= base_url('mobile/debitur/detail/') . $d['kd_credit']; ?>" class="item">
                        <div class="icon-box bg-secondary">
                            <ion-icon name="person-outline"></ion-icon>
                        </div>
                        <div class="in">
                            <div><?= $d['nama_debitur']; ?></div>
                            <span class="text-muted">Detail</span>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>

            <!-- Alert Massage -->
            <?php if (empty($debitur)) : ?>
                <li>
                    <a href='#' class='item'>
                        <div class='icon-box bg-secondary'>
                            <ion-icon name='sad-outline'></ion-icon>
                        </div>
                        <div class='in'>
                            <div>Hasil pencarian tidak ada!</div>
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