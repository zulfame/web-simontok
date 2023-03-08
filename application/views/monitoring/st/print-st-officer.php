<!DOCTYPE html>
<html>

<head>
    <title><?= $title; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/') ?>img/favicon.png" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/'); ?>bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/'); ?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/'); ?>Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/AdminLTE.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">
    <?php foreach ($tugas as $t) :
        $pokok  = $t['tunggakan_p'];
        $bunga  = $t['tunggakan_b'];
        $denda  = $t['tunggakan_d'];
        $total  = $pokok + $bunga + $denda;
    ?>
        <section class="content">
            <img src="<?= base_url('assets/img/'); ?>banner.png" width="20%">
            <font style="float:right;font-weight: bold;font-size: 15px;"><?= $t['nama_debitur']; ?></font>

            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="box-body" style="font-size:10px;">
                            <center>
                                <b>
                                    <font>SURAT TUGAS PENAGIHAN</font></br>
                                    <font style="text-transform: uppercase;">NO. <?= $t['no_st']; ?></font>
                                </b>
                            </center>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Yang bertanda tangan dibawah ini:</th>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                                        <td> : <?= $user['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                                        <td> : <?= $user['role']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Dengan ini menugaskan kepada:</th>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                                        <td> : <?= $t['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                                        <td> : <?= $t['role']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Untuk melakukan penagihan kepada:</th>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                                        <td> : <?= $t['nama_debitur']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Telepon</td>
                                        <td> : <?= $t['telepon']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                                        <td> : <?= $t['alamat']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Rekening</td>
                                        <td> : <?= $t['kd_credit']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Tabungan</td>
                                        <td> : <?= $t['noacc_droping']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plafond</td>
                                        <td> : Rp. <?= rupiah($t['plafond']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl Jatuh Tempo</td>
                                        <td> : <?= $t['tgl_jth_tempo']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Tagihan</td>
                                        <td> : Rp. <?= rupiah($total); ?> (&nbsp;
                                            Pokok : Rp. <?= rupiah($t['tunggakan_p']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Bunga : Rp. <?= rupiah($t['tunggakan_b']); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            Denda : Rp. <?= rupiah($t['tunggakan_d']); ?> &nbsp;)</td>
                                    </tr>
                                </thead>
                            </table>
                            <b>
                                <font>Demikian surat tugas penagihan ini agar dapat dilaksanakan dan dipergunakan sebagaimana mestinya.</font><br>
                                <center>
                                    <font style="text-transform:uppercase;"><?= $user['region']; ?>, <?= format_indo(date('Y-m-d')); ?></font>
                                </center>
                            </b>
                        </div>

                        <div class="row" style="font-size:12px;">
                            <center>
                                <div class="col-lg-6 col-xs-6">
                                    <div>
                                        <div class="inner">
                                            <font>Pemberi Tugas</font><br><br><br>
                                            <font><?= $user['name']; ?></font>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-xs-6">
                                    <div>
                                        <div class="inner">
                                            <font>Penerima Tugas</font><br><br><br>
                                            <font><?= $t['name'] ?></font>
                                        </div>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <br>
                    <center>
                        <div class="inner">
                            <font>Debitur</font><br><br><br>
                            <font>...............................</font>
                        </div>
                    </center>
                    <p></p>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

</body>

</html>