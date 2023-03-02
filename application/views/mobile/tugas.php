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
        if( ! empty($tugas))
        {
            $no=1; foreach($tugas as $data)                              
            {

            $ket = $data->pelaksanaan;
            if ($ket == "Kosong")
              {
                $hasil = "danger";
            }
            else
            {
                $hasil = "success";
            }

        ?>
        <li>
            <a href="<?= base_url('tugas/mlaporan/');?><?= $data->id_st; ?>" class="item">
                <div class="icon-box bg-secondary">
                    <ion-icon name="person-outline"></ion-icon>
                </div>
                <div class="in">
                    <div><?= $data->nama_debitur;?></div>
                    <span class="badge badge-<?= $hasil;?> badge-empty"></span>
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
                    <div class='icon-box bg-secondary'>
                        <ion-icon name='happy-outline'></ion-icon>
                    </div>
                    <div class='in'>
                        <div>Tidak ada surat tugas!</div>
                        <span class='text-muted'></span>
                    </div>
                </a>
            </li>
            ";
        }
        ?>

    </ul>

</div>
    <!-- * App Capsule -->