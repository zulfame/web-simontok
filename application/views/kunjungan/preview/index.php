<?php error_reporting(0) ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"> <?= $this->uri->segment(1); ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="form-group pull-left">
                            <form method="post" action="<?= base_url('kunjungan/preview'); ?>">
                                <table>
                                    <tr>
                                        <td>
                                            <input type="date" name="tgl1" class="form-control" style="width:150px;" value="<?= $_POST['tgl1'] ?>" required>
                                        </td>
                                        <td>
                                            <input type="date" name="tgl2" class="form-control" style="width:150px;margin-left:3px;" value="<?= $_POST['tgl2'] ?>" required>
                                        </td>
                                        <td>
                                            &nbsp;<select class="form-control select2" style="width:200px;" name="petugas" required>
                                                <?php $p = $_POST['petugas']; ?>

                                                <?php foreach ($list as $l) : ?>
                                                    <?php if (!$p) : ?>
                                                        <option value="<?= $l['user_code']; ?>"><?= $l['name']; ?></option>
                                                    <?php elseif ($p == $l['user_code']) : ?>
                                                        <option value="<?= $l['user_code']; ?>" selected><?= $l['name']; ?></option>
                                                    <?php else : ?>
                                                        <option value="<?= $l['user_code']; ?>"><?= $l['name']; ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            &nbsp;<button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" id="example1" style="font-size:12px ;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Debitur</th>
                                        <th class="text-center">Coll</th>
                                        <th class="text-center" width="10%">Baki Debet</th>
                                        <th class="text-center" width="12%">Tunggakan</th>
                                        <th class="text-center" width="7%">Tanggal</th>
                                        <th class="text-center">Pelaksanaan</th>
                                        <th class="text-center">Hasil</th>
                                        <th class="text-center">Catatan</th>
                                        <th class="text-center">Img</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($filter as $f) :
                                        $c = $f['catatan'];
                                        if (!$c) {
                                            $catatan = "Kosong";
                                        } else {
                                            $catatan = $c;
                                        }

                                        $p = $f['pelaksanaan'];
                                        if (!$p) {
                                            $pelaksanaan = "Kosong";
                                        } else {
                                            $pelaksanaan = $p;
                                        }

                                        $h = $f['hasil'];
                                        if (!$h) {
                                            $hasil = "Kosong";
                                        } else {
                                            $hasil = $h;
                                        }

                                        $i = $f['image'];
                                        if ($i == "default.png") {
                                            $image = "danger";
                                        } else {
                                            $image = "success";
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <b><?= $f['nama_debitur']; ?></b><br>
                                                <?= $f['debitur_code']; ?>
                                            </td>
                                            <td class="text-center"><?= $f['call']; ?></td>
                                            <td>Rp. <?= rupiah($f['os_akhir']); ?></td>
                                            <td>
                                                <b>Pokok :</b> Rp. <?= rupiah($f['tunggakan_p']); ?><br>
                                                <b>Bunga :</b> Rp. <?= rupiah($f['tunggakan_b']); ?><br>
                                                <b>Denda :</b> Rp. <?= rupiah($f['tunggakan_d']); ?>
                                            </td>
                                            <td class="text-center"><?= format_indo($f['tgl']); ?></td>
                                            <td>
                                                <b><?= $pelaksanaan; ?></b><br>
                                                <?= $f['d_pelaksanaan']; ?>
                                            </td>
                                            <td>
                                                <b><?= $hasil; ?></b><br>
                                                <?= $f['d_hasil']; ?>
                                            </td>
                                            <td><?= $catatan; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-foto<?= $f['id_st']; ?>" class="btn-circle btn-sm btn-<?= $image; ?>"><i class="fa fa-image"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL IMAGE -->
                                        <div class="modal fade" id="modal-foto<?= $f['id_st']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="border-radius: 10px;">
                                                    <div class="modal-body">
                                                        <img class="img-responsive" src="<?= base_url('assets/img/st/') . $f['image']; ?>" style="border-radius: 10px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>