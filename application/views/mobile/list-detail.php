<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="<?= base_url('debitur/mdebitur/');?>" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Detail Debitur</div>
    <div class="right">
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule">

    <div class="listview-title mt-2">DETAIL DEBITUR</div>
    <ul class="listview link-listview">
        <li><a href="#"><?= $debitur->kd_credit; ?> <span class="text-muted">No. Kredit</span></a></li>
        <li><a href="#"><?= $debitur->nama_debitur; ?> <span class="text-muted">Nama</span></a></li>
        <li><a href="#"><?= $debitur->alamat; ?></a></li>
        <li><a href="#"><?= $debitur->telepon; ?> <span class="text-muted">No. Telp</span></a></li>
        <li><a href="#"><?= $debitur->no_spk; ?> <span class="text-muted">No. SPK</span></a></li>
        <li><a href="#"><?= $debitur->no_cif; ?> <span class="text-muted">No. CIF</span></a></li>
        <li><a href="#"><?= $debitur->noacc_droping; ?> <span class="text-muted">No. REK</span></a></li>
        <li><a href="#">Rp. <?= rupiah($debitur->plafond); ?> <span class="text-muted">Plafon</span></a></li>
        <li><a href="#"><?= $debitur->rate; ?>% <span class="text-muted">SK Bunga</span></a></li>
        <li><a href="#"><?= $debitur->metode_rps; ?> <span class="text-muted">Pembayaran</span></a></li>
        <li><a href="#"><?= $debitur->jw; ?> Bulan <span class="text-muted">JK Waktu</span></a></li>
        <li><a href="#"><?= $debitur->tgl_realisasi; ?> <span class="text-muted">Tgl. Realisasi</span></a></li>
        <li><a href="#"><?= $debitur->tgl_jth_tempo; ?> <span class="text-muted">Tgl. JAPO</span></a></li>

    </ul>

</div>
<!-- * App Capsule -->
