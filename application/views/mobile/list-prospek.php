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

    <div class="listview-title mt-2">DATA PROSPEK <a href="<?= base_url('prospek/mtambah');?>">TAMBAH PROSPEK</a></div>
    <ul class="listview image-listview">

        <?php
        if( ! empty($prospek))
        {
            $no=1; foreach($prospek as $data)                              
            {
        ?>
        <li>
            <a href="<?= base_url('prospek/mdetail/');?><?= $data['idprospek']; ?>" class="item">
                <img src="<?= base_url('assets/mobile/img/sample/avatar/');?>avatar1.jpg" alt="image" class="image">
                <div class="in">
                    <div>
                        <header><?= $data['tgl'];?></header>
                        <?= $data['calon_debitur'];?>
                        <footer>[ <?= $data['prospek'];?> ]</footer>
                    </div>
                    <span class="text-muted">Edit</span>
                </div>
            </a>
        </li>
        <?php 
            }
        }else
        {
            echo "
            <li>
                <a href='#' class='item'>
                    <div class='in'>
                        <div>
                            KOSONG
                        </div>
                    </div>
                </a>
            </li>
            ";
        }
        ?>

    </ul>

</div>
    <!-- * App Capsule -->