<!-- App Capsule -->
<div id="appCapsule">

    <div class="section mt-2">
        <div class="profile-head">
            <div class="avatar">
                <img src="<?= base_url('assets/img/profile/'); ?>default.jpg" alt="avatar" class="imaged w64">
            </div>
            <div class="in">
                <h3 class="name"><?= $tugas['nama_debitur']; ?></h3>
                <h5 class="subtext" style="text-transform:uppercase ;"><?= $tugas['alamat']; ?></h5>
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
                <form action="<?= base_url('mobile/tugas/catatan_edit') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mt-2 pr-2 pl-2">

                        <?= $this->session->flashdata('message'); ?>
                        <?= $this->session->flashdata('message_failed'); ?>

                        <h3 class="name">Informasi Tunggakan</h3>
                        <hr>

                        <div class="input-wrapper">
                            <label class="form-label">Tunggakan Pokok</label>
                            <input type="text" class="form-control" name="tgk_pokok" readonly value="<?= "Rp. " . rupiah($tugas['os_akhir']); ?>">
                        </div>

                        <div class=" row">
                            <div class="col-6">
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label">Tunggakan Bunga</label>
                                        <input type="text" class="form-control" name="tgk_bunga" readonly value="<?= "Rp. " . rupiah($tugas['tgk_bunga']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="form-label">Tunggakan Denda</label>
                                        <input type="text" class="form-control" name="tgk_denda" readonly value="<?= "Rp. " . rupiah($tugas['tgk_denda']); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 pr-2 pl-2">
                        <hr>
                        <h3 class="name">Inputs Report</h3>
                        <hr>

                        <input type="hidden" name="id_st" value="<?= $tugas['id_st']; ?>">

                        <div class="input-wrapper">
                            <label class="form-label">Pelaksanaan</label>
                            <select class="form-control" readonly>
                                <option value="<?= $tugas['pelaksanaan']; ?>"><?= $tugas['pelaksanaan']; ?></option>
                            </select>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" cols="30" rows="4" readonly><?= $tugas['d_pelaksanaan']; ?></textarea>
                            </div>
                        </div>

                        <div class="input-wrapper">
                            <label class="form-label">Hasil Pelaksanaan</label>
                            <select class="form-control" readonly>
                                <option value="<?= $tugas['hasil']; ?>"><?= $tugas['hasil']; ?></option>
                            </select>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Janji Bayar</label>
                                <input class="form-control" type="date" readonly value="<?= $tugas['jb']; ?>">
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" cols="30" rows="4" readonly><?= $tugas['d_hasil']; ?></textarea>
                            </div>
                        </div>

                        <div class="accordion" id="accordionExample2">
                            <div class="item">
                                <div class="accordion-header">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion-image">
                                        <font style="margin-left:-19px;">Foto Penanganan</font>
                                    </button>
                                </div>
                                <div id="accordion-image" class="accordion-body collapse" data-parent="#accordionExample2">
                                    <div class="accordion-content">
                                        <img src="<?= base_url('assets/img/st/'); ?><?= $tugas['image'] ?>" alt="image" class="imaged img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group boxed">
                            <div class="input-wrapper">
                                <label class="form-label">Keterangan</label>
                                <textarea class="form-control" cols="30" rows="4" name="catatan" id="catatan"><?= $tugas['catatan']; ?></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="pr-2 pl-2">
                        <button type="submit" class="btn btn-primary btn-block">SAVE NOTE</button>
                    </div>
                </form>
            </div>
            <!-- * Profile -->

            <!-- Monitoring -->
            <div class="tab-pane fade" id="monitoring" role="tabpanel">
                <div class="section inset mt-2">

                    <h3 class="name">Histori Penanganan</h3>
                    <hr>

                    <div class="accordion" id="accordionExample2">

                        <?php foreach ($riwayat as $t) :
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

                        <?php if (empty($riwayat)) : ?>
                            <div class="item">
                                <div class="accordion-header">
                                    <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#accordion0">
                                        Tidak ada riwayat penanganan
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

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