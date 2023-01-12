<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2">
        <div class="profile-head">
            <div class="avatar">
                <img src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="avatar" class="imaged w64">
            </div>
            <div class="in">
                <h3 class="name"><?= $debitur['nama_debitur']; ?></h3>
                <h5 class="subtext" style="text-transform:uppercase ;"><?= $debitur['alamat']; ?></h5>
            </div>
        </div>
    </div>

    <div class="section mt-1 mb-2">
        <div class="profile-info">
            <div class=" bio">

            </div>
            <div class="link">
            </div>
        </div>
    </div>

    <div class="section full">
        <div class="wide-block transparent p-0">
            <ul class="nav nav-tabs lined iconed" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#report" role="tab">
                        <ion-icon name="document-text-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#monitoring" role="tab">
                        <ion-icon name="newspaper-outline"></ion-icon>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <!-- tab content -->
    <div class="section full mb-2">
        <div class="tab-content">
            <!-- Profile -->
            <div class="tab-pane fade show active" id="report" role="tabpanel">
                <div class="mt-2 pr-2 pl-2">

                    <h3 class="name">Detail Tunggakan</h3>
                    <hr>

                    <div class="input-wrapper">
                        <label class="form-label">Tunggakan Pokok</label>
                        <input type="text" class="form-control" readonly value="<?= "Rp. " . rupiah($debitur['tgk_pokok']); ?>">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <label class="form-label">Tunggakan Bunga</label>
                                    <input type="text" class="form-control" readonly value="<?= "Rp. " . rupiah($debitur['tgk_bunga']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group boxed">
                                <div class="input-wrapper">
                                    <label class="form-label">Tunggakan Denda</label>
                                    <input type="text" class="form-control" readonly value="<?= "Rp. " . rupiah($debitur['tgk_denda']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 pr-2 pl-2">
                    <hr>
                    <h3 class="name">Detail Agunan</h3>
                    <hr>

                    <?php $no = 1;
                    foreach ($agunan as $a) : ?>
                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <textarea class="form-control" readonly cols="30" rows="3"><?= $a['agunan']; ?></textarea>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <!-- * Profile -->

            <!-- Monitoring -->
            <div class="tab-pane fade" id="monitoring" role="tabpanel">
                <div class="section inset mt-2">

                    <h3 class="name">Histori Penanganan</h3>
                    <hr>

                    <div class="accordion" id="accordionExample2">

                        <?php foreach ($tugas as $t) :
                            if (!$t['pelaksanaan']) {
                                $pelaksanaan = "Tidak ada pelaksanaan";
                            } else {
                                $pelaksanaan = "<b>" .  $t['pelaksanaan'] . "</b>" . "<br>" . $t['d_pelaksanaan'];
                            }

                            if (!$t['hasil']) {
                                $hasil = "Tidak ada hasil";
                            } else {
                                $hasil = "<b>" . $t['hasil'] . "</b>" . "<br>" . $t['d_hasil'];
                            }

                            if (!$t['catatan']) {
                                $catatan = "Tidak ada catatan";
                            } else {
                                $catatan = $t['catatan'];
                            }
                        ?>
                            <div class="item">
                                <div class="accordion-header">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion<?= $t['id_st']; ?>">
                                        <?= format_indo_full($t['tgl']); ?>
                                    </button>
                                </div>
                                <div id="accordion<?= $t['id_st']; ?>" class="accordion-body collapse" data-parent="#accordionExample2">
                                    <div class="accordion-content">
                                        <span class="badge badge-success"><?= $t['name']; ?></span><br>
                                        <?= $pelaksanaan; ?> <br>
                                        <?= $hasil; ?>
                                        <hr>
                                        <b>Tunggakan Pokok :</b> <?= $t['tgk_pokok']; ?> <br>
                                        <b>Tunggakan Bunga :</b> <?= $t['tgk_bunga']; ?> <br>
                                        <b>Tunggakan Denda :</b> <?= $t['tgk_denda']; ?>
                                        <br><br>
                                        <span class="badge badge-warning">Catatan</span></br>
                                        <?= $catatan; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Alert Massage -->
                        <?php if (empty($tugas)) : ?>
                            <div class="item">
                                <div class="accordion-header">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion">
                                        Tidak ada penanganan
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- End Alert Massage -->

                    </div>
                </div>
            </div>
            <!-- * Monitoring -->
        </div>
    </div>
    <!-- * tab content -->

</div>
<!-- * App Capsule -->