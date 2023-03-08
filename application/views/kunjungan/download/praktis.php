<?php error_reporting(0); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-tv"></i> Monitoring</a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter Tanggal</h3>
                    </div>

                    <form role="form" method="POST" action="<?= base_url("rekapitulasi/tugas/") ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl1" value="<?= $_POST['tgl1'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl2" value="<?= $_POST['tgl2'] ?>" required>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hasil</h3>
                    </div>

                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">No</th>
                                        <th class="text-center">Nama Petugas</th>
                                        <th class="text-center">Wilayah</th>
                                        <th class="text-center" width="10%">TTL</th>
                                        <th class="text-center" width="10%">DKJ</th>
                                        <th class="text-center" width="10%">TDKJ</th>
                                    </tr>
                                </thead>
                                <!-- <tbody>
                                    <?php $no = 1;
                                    foreach ($rekap as $r) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $r['name']; ?></td>
                                            <td><?= $r['region']; ?></td>
                                            <td class="text-center"><span class="badge bg-green"><?= $r['jumlah']; ?></span></td>
                                            <td class="text-center"><span class="badge bg-blue"><?= $r['dikerjakan']; ?></span></td>
                                            <td class="text-center"><span class="badge bg-red"><?= $r['tidakdikerjakan']; ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody> -->
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->