<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('dashboard/ao');?>" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle"><?php  echo $title;?></div>
    <div class="right">
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">

    <div class="listview-title mt-2">DATA DEBITUR</div>
    <ul class="listview image-listview">
        <?php
        foreach($debitur as $data)                              
        {
            ?> 
        <li>
            <a href="<?= base_url('debitur/mdetail/');?><?= $data->kd_credit; ?>" class="item">
                <div class="icon-box bg-secondary">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
                <div class="in">
                    <div><?= $data->nama_debitur;?></div>
                    <span class="text-muted">Detail</span>
                </div>
            </a>
        </li>
        <?php }?>

    </ul>

</div>
    <!-- * App Capsule -->