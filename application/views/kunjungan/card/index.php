<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Monitoring Card
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"> <?= $this->uri->segment(1); ?></a></li>
            <li class="active">Card</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <div class="box-tools pull-left">
                    <a href="<?= base_url('kunjungan/kmd_kredit'); ?>" class="btn btn-sm btn-default">BACK</a>
                </div>

                <div class="box-tools">
                    <a href="<?= base_url('kunjungan/kmd_card_print/') . $debitur['kd_credit']; ?>" class="btn btn-sm btn-default pull-left"><i class="fa fa-print"></i> PRINT</a>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <img src="<?= base_url('assets/img/'); ?>banner.png" style="height:35px;">
                            <p class="pull-right" style="margin-top: 7px;">NO. <?= $debitur['no_spk']; ?></p>
                        </h2>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <td><b>Name</b></td>
                                    <td>&nbsp; : &nbsp; <?= $debitur['nama_debitur']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>No. Telp</b></td>
                                    <td>&nbsp; : &nbsp; <?= $debitur['telepon']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Region</b></td>
                                    <td>&nbsp; : &nbsp; <?= $debitur['wilayah']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Realization</b></td>
                                    <td>&nbsp; : &nbsp; <?= $debitur['tgl_realisasi']; ?></td>
                                </tr>
                                <tr>
                                    <td><b>Due Data</b></td>
                                    <td>&nbsp; : &nbsp; <?= $debitur['tgl_jth_tempo']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <table>
                            <tr>
                                <td><b>No. Credit</b></td>
                                <td>&nbsp; : &nbsp; <?= $debitur['kd_credit']; ?></td>
                            </tr>
                            <tr>
                                <td><b>No. CIF</b></td>
                                <td>&nbsp; : &nbsp; <?= $debitur['no_cif']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Plafond</b></td>
                                <td>&nbsp; : &nbsp; Rp. <?= rupiah($debitur['plafond']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Metode</b></td>
                                <td>&nbsp; : &nbsp; <?= $debitur['metode_rps']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Rate</b></td>
                                <td>&nbsp; : &nbsp; <?= $debitur['rate']; ?>%</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <div class="table-responsive">
                            <table>
                                <tr>
                                    <td><b>Periode :</b></td>
                                </tr>
                                <tr>
                                    <td><?= $debitur['jw']; ?> Month</td>
                                </tr>
                                <tr>
                                    <td><b>Address :</b></td>
                                </tr>
                                <tr>
                                    <td><?= $debitur['alamat']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <p></p>

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <p class="text-center" style="font-weight:bold;font-size:15px;">GUARANTEE</p>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <tbody>
                                <?php $no = 1;
                                foreach ($agunan as $a) : ?>
                                    <tr>
                                        <td class="text-center" width="5%"><?= $no++; ?></td>
                                        <td><?= $a['agunan']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <p class="text-center" style="font-weight:bold;font-size:15px;">MONITORING</p>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">Date</th>
                                    <th class="text-center" width="13%">Officer</th>
                                    <th class="text-center">Implementation</th>
                                    <th class="text-center" width="25%">Result</th>
                                    <th class="text-center" width="25%">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tugas as $st) :
                                    if (!$st['pelaksanaan']) {
                                        $pelaksanaan = "Kosong";
                                    } else {
                                        $pelaksanaan = $st['pelaksanaan'] . " ⇒ " . $st['d_pelaksanaan'];
                                    }

                                    if (!$st['hasil']) {
                                        $hasil = "Kosong";
                                    } else {
                                        $hasil = $st['hasil'] . " ⇒ " . $st['d_hasil'];
                                    }

                                    if (!$st['catatan']) {
                                        $catatan = "Kosong";
                                    } else {
                                        $catatan = $st['catatan'];
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $st['tgl']; ?></td>
                                        <td><?= $st['name']; ?></td>
                                        <td><?= $pelaksanaan; ?></td>
                                        <td><?= $hasil; ?></td>
                                        <td><?= $catatan; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (!$tugas) : ?>
                                    <tr>
                                        <td class="text-center" colspan="5">No Handling History</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>