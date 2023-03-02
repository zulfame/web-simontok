<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?=base_url('tugas/mtugas')?>" class="headerButton goBack">
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
    <form action="<?=base_url('mobile/update')?>" method="post" enctype="multipart/form-data">
        <div class="section full mt-2 mb-2">
            <div class="section-title">Informasi Tunggakan</div>
            <div class="wide-block pb-1 pt-2">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Tunggakan Pokok</label>
                        <input type="text" class="form-control" name="tgk_pokok" readonly value="Rp. <?= rupiah($laporan->tgk_pokok);?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Tunggakan Bunga</label>
                        <input type="text" class="form-control" name="tgk_bunga" readonly value="Rp. <?= rupiah($laporan->tgk_bunga);?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Tunggakan Denda</label>
                        <input type="text" class="form-control" name="tgk_denda" readonly value="Rp. <?= rupiah($laporan->tgk_denda);?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Alamat</label>
                        <input type="text" class="form-control" readonly value="<?= $laporan->alamat;?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>
            </div>

            <div class="section-title">Entry Laporan</div>
            <div class="wide-block pb-1 pt-2">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Nama Debitur</label>
                        <input type="text" class="form-control"  disabled value="<?= $laporan->nama_debitur;?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="city5">Pelaksanaan</label>
                        <select class="form-control custom-select" id="city5" name="pelaksanaan" required>
                            <option value="<?= $laporan->pelaksanaan;?>"><?= $laporan->pelaksanaan;?></option>
                            <option value="Prospek">Prospek</option>
                            <option value="Penagihan ke Rumah Debitur">Penagihan ke Rumah Debitur</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="address5">Keterangan</label>
                        <textarea id="address5" rows="2" class="form-control" name="lainnya" required><?= $laporan->lainnya;?></textarea>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="city5">Hasil</label>
                        <select class="form-control custom-select" id="city5" name="hasil" required>
                            <option value="<?= $laporan->hasil;?>"><?= $laporan->hasil;?></option>
                            <option value="Topup">Topup</option>
                            <option value="Bayar Full Tunggakan">Bayar Full Tunggakan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="address5">Keterangan</label>
                        <textarea id="address5" rows="2" class="form-control" name="lainnya2" required><?= $laporan->lainnya2;?></textarea>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="name5">Catatan KSK</label>
                        <input type="text" class="form-control"  disabled value="<?= $laporan->catatan;?>">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>


                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <label class="label" for="address5">Foto</label>
                        <div class="custom-file-upload">
                            <input type="file" id="fileuploadInput" name="image" accept=".png, .jpg, .jpeg">
                            <label for="fileuploadInput">
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

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <img src="<?= base_url('uploads/');?><?= $laporan->image;?>" alt="image" class="imaged img-fluid">
                    </div>
                </div>

        <input type="hidden" name="id" value="<?=$laporan->id_st?>">
        <button type="submit" class="btn btn-primary" style="width:100%;">SIMPAN</button>
    </form>
</div>