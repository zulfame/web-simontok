<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?> Kosong
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-tv"></i> Monitoring</a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <h3 class="box-title"><?= $petugas['name']; ?></h3>
                <h3 class="box-title pull-right"><?= $this->uri->segment(4);; ?> s/d <?= $this->uri->segment(5); ?></h3>
            </div>
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Date</th>
                                <th class="text-center">Debitur</th>
                                <th class="text-center" width="20%">Implementation</th>
                                <th class="text-center" width="20%">Result</th>
                                <th class="text-center" width="20%">Note</th>
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
                                    <td><?= $st['nama_debitur']; ?></td>
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

    </section>
</div>