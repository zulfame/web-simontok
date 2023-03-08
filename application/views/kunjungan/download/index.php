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
                        <h3 class="box-title">Filter Wilayah</h3>
                    </div>

                    <form role="form" method="get" action="<?= base_url("kunjungan/export_debitur/") ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Wilayah</label>
                                <select class="form-control select2" style="width: 100%;" required name="wilayah">
                                    <?php
                                    $w = $_GET['wilayah'];
                                    if ($w == "") {
                                        $rw = "<option value=''>-- PILIH WILAYAH --</option>";
                                    } else {
                                        $rw = "<option value='$w'>$w</option>";
                                    }
                                    ?>
                                    <?= $rw; ?>
                                    <option value="CGK">JALANCAGAK</option>
                                    <option value="KJT">KALIJATI</option>
                                    <option value="PGD">PAGADEN</option>
                                    <option value="PMK">PAMANUKAN</option>
                                    <option value="PSK">PUSAKAJAYA</option>
                                    <option value="SBG">SUBANG</option>
                                    <option value="SKM">SUKAMANDI</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl1" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl2" required>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter Bidang</h3>
                    </div>

                    <form role="form" method="get" action="<?= base_url("kunjungan/export_remedial/") ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Bidang</label>
                                <select class="form-control select2" style="width: 100%;" required name="bidang">
                                    <option value="">-- PILIH BIDANG --</option>
                                    <option value="RMD">REMEDIAL</option>
                                    <option value="TBL">TELE BILLING</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl1" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl2" required>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Filter WriteOff</h3>
                    </div>

                    <form role="form" method="get" action="<?= base_url("kunjungan/export_writeoff/") ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Bidang</label>
                                <select class="form-control select2" style="width: 100%;" required name="bidang">
                                    <option value="WO">WRITEOFF</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl1" required>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl2" required>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->