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
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header" style="border-bottom: solid #034871 2px ;">
                    <img src="<?= base_url('assets/img/'); ?>banner.png" style="height:35px;">
                </h2>
            </div>
        </div>
        <br>
        <div style="margin-top: -100px;">
            <table>
                <tr>
                    <td><b>Kasi Customer Care</b></td>
                    <td>&nbsp; : &nbsp; Trio Hermanto</td>
                </tr>
                <tr>
                    <td><b>Wilayah Operasional</b></td>
                    <td>&nbsp; : &nbsp; <?= $user['region']; ?></td>
                </tr>
            </table>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered" style="font-size: 10px;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center" width="6%">Date</th>
                            <th class="text-center">No Task</th>
                            <th class="text-center">No Credit</th>
                            <th class="text-center">Debitur</th>
                            <th class="text-center" width="4%">HR-T</th>
                            <th class="text-center" width="7%">Tgk. Pokok</th>
                            <th class="text-center" width="7%">Tgk. Bunga</th>
                            <th class="text-center" width="7%">Tgk. Denda</th>
                            <th class="text-center">Result</th>
                            <th class="text-center">Wilayah</th>
                            <th class="text-center">Officer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($laporan as $s) :
                            $p = $s['jb'];
                            if ($p == "0000-00-00" || $p == "") {
                                $jb = "";
                            } else {
                                $jb = " ⇒ $p";
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $s['tgl']; ?></td>
                                <td style="text-transform:uppercase;"><?= $s['no_st']; ?></td>
                                <td><?= $s['kd_credit']; ?></td>
                                <td><?= $s['nama_debitur']; ?></td>
                                <td class="text-center"><?= $s['tunggakan_h']; ?></td>
                                <td>Rp. <?= rupiah($s['tgk_pokok']); ?></td>
                                <td>Rp. <?= rupiah($s['tgk_bunga']); ?></td>
                                <td>Rp. <?= rupiah($s['tgk_denda']); ?></td>
                                <td><?= $s['hasil'] . " ⇒ " . $s['d_hasil'] . $jb; ?></td>
                                <td><?= $s['wilayah']; ?></td>
                                <td class="text-center"><?= $s['kd_petugas']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <table class="table">
                <b>Pamanukan, <?= format_indo(date('Y-m-d')); ?></b>
                <p></p>
                <tr>
                    <td class='text-center'>
                        Kasi Customer Care<br><br><br>
                        Trio Hermanto
                    </td>
                    <td>
                        <?= $user['role']; ?><br><br><br>
                        <?= $user['name']; ?>
                    </td>
                </tr>
            </table>
        </div>
    </section>
</body>

</html>