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
            <!-- left column -->
            <div class="col-md-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Set Filter</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="POST" action="<?= base_url("kunjungan/debitur/") ?>">
                        <div class="modal-body">

                            <div class="box-body">

                                <div class="form-group">
                                    <label>Wilayah</label>
                                    <select class="form-control select2" style="width: 100%;" required name="wilayah">
                                        <?php
                                        $w = $_POST['wilayah'];
                                        if ($w == "") {
                                            $rw = "<option value=''>Pilih Wilayah</option>";
                                        } else {
                                            $rw = "<option value='$w'>$w</option>";
                                        }
                                        ?>
                                        <?= $rw; ?>
                                        <option value="JALANCAGAK">JALANCAGAK</option>
                                        <option value="KALIJATI">KALIJATI</option>
                                        <option value="PAGADEN">PAGADEN</option>
                                        <option value="PAMANUKAN">PAMANUKAN</option>
                                        <option value="PUSAKAJAYA">PUSAKAJAYA</option>
                                        <option value="SUBANG">SUBANG</option>
                                        <option value="SUKAMANDI">SUKAMANDI</option>
                                        <option value="REMEDIAL">REMEDIAL</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Mulai Dari</label>
                                    <input type="date" class="form-control" required name="tgl_awal">
                                </div>

                                <div class="form-group">
                                    <label>Sampai Dengan</label>
                                    <input type="date" class="form-control" required name="tgl_akhir">
                                </div>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> Filter</button>
                                <a href="<?= base_url('kunjungan/debitur'); ?>" class="btn btn-success pull-left">Berihkan</a>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->

            <!-- right column -->
            <div class="col-md-9">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Hasil</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="modal-body">
                        <div class="box-body">

                            <div class="box-body table-responsive no-padding">
                                <table id="example4" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Wilayah</th>
                                            <th class="text-center">Petugas</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Debitur</th>
                                            <th class="text-center">Penanganan</th>
                                            <th class="text-center" width="6%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($kunjungan as $k) :
                                            $p = $k['pelaksanaan'];
                                            if ($p == "") {
                                                $ket = "Kosong";
                                            } else {
                                                $ket = $p;
                                            }

                                            if ($ket == "Kosong") {
                                                $color = "red";
                                            } else {
                                                $color = "default";
                                            }
                                        ?>
                                            <tr>
                                                <td><?= $k['wilayah']; ?></td>
                                                <td><?= $k['petugas_code']; ?></td>
                                                <td><?= $k['tgl']; ?></td>
                                                <td><?= $k['nama_debitur']; ?></td>
                                                <td class="text-<?= $color; ?>"><?= $ket; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('report/kmd_card/') . $k['kd_credit']; ?>" class="btn-circle btn-sm btn-success" target="_blank"><i class="fa fa-file-text"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->

        </div>
        <!-- /.row -->
    </section>
</div>