<!-- App Header -->
<div class="appHeader bg-primary text-light">
<div class="left">
    <a href="<?=base_url('prospek/mprospek')?>" class="headerButton goBack">
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
<div class="section full mt-2 mb-2">
    <div class="section-title">Detail Prospek</div>
    <div class="wide-block pb-1 pt-2">
        <form action="<?=base_url('prospek/mproses/')?><?=  $this->uri->segment('3');?>" method="post" enctype="multipart/form-data">

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label class="label" for="city5">Hunting</label>
                    <select class="form-control custom-select" id="city5" name="hunting" required>
                        <option value="<?= $prospek->prospek;?>"><?= $prospek->prospek;?></option>
                        <option value="Prospek">Prospek</option>
                        <option value="Survey">Survey</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label class="label" for="name5">Calon Debitur</label>
                    <input type="text" class="form-control" name="calon_debitur" value="<?= $prospek->calon_debitur;?>">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label class="label" for="name5">No. Telepon</label>
                    <input type="number" class="form-control"  name="no_hp" value="<?= $prospek->no_hp;?>">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>

            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label class="label" for="address5">Keterangan</label>
                    <textarea id="address5" rows="2" class="form-control" name="keterangan" required><?= $prospek->keterangan;?></textarea>
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>


            <input type="hidden" name="id" value="<?=$prospek->idprospek?>">
            <button type="submit" class="btn btn-primary" style="width:100%;">SIMPAN</button>
        </form>
    </div>
</div>



