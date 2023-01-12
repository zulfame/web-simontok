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
                    <td><b>Kepala Seksi Remedial</b></td>
                    <td>&nbsp; : &nbsp; <?= $user['name']; ?></td>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">No</th>
                            <th class="text-center" width="12%">Date</th>
                            <th class="text-center">No Task</th>
                            <th class="text-center">No Credit</th>
                            <th class="text-center">Debitur</th>
                            <th class="text-center">Officer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($tugas as $s) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $s['tgl']; ?></td>
                                <td style="text-transform:uppercase;"><?= $s['no_st']; ?></td>
                                <td><?= $s['kd_credit']; ?></td>
                                <td><?= $s['nama_debitur']; ?></td>
                                <td><?= $s['name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <table class="table">
                <b style="text-transform:uppercase;"><?= $user['region']; ?>, <?= format_indo(date('Y-m-d')); ?></b>
                <p></p>
                <tr>
                    <?php foreach ($ttd as $list) : ?>
                        <td class='text-center'>
                            <?= $list['role']; ?><br><br><br>
                            <?= $list['name']; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </table>
            <?= $user['role']; ?>,<br><br><br>
            <?= $user['name']; ?>
        </div>
    </section>
</body>

</html>