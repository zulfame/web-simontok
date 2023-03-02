<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="get" action="<?php echo base_url("monitoring/filter_r/") ?>">

                        <table>
                            <tr>
                                <td>
                                    <select class="form-control select2" style="width:150px;">
                                        <option value="Remedial">Remedial</option>
                                    </select>
                                </td>
                                <td>
                                    &nbsp;
                                    <select class="form-control select2" style="width:200px;" name="petugas" required>
                                        <option value="">--Pilih Petugas--</option>
                                        <?php
                                        foreach ($petugas as $list) {
                                            echo "<option value='$list->kd_petugas'>$list->nama</option>";
                                        }
                                        ?>
                                </td>
                                <td>
                                    &nbsp;
                                    <select class="form-control select2" style="width:70px;" name="coll">
                                        <option value="">Coll</option>
                                        <option value="3">1</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </td>
                                <td>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> FILTER</button>
                                </td>
                                <td>
                                    &nbsp;
                                    <a href="<?= base_url('monitoring/report'); ?>" class="btn btn-success"><i class="fa fa-bookmark"></i> TAMPIL SEMUA</a>
                                </td>
                            </tr>
                        </table>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?= $title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th class="text-center">KD KREDIT</th>
                            <th class="text-center">NAMA DEBITUR</th>
                            <th class="text-center">COLL</th>
                            <th class="text-center">BAKI DEBET</th>
                            <th class="text-center">HR-P</th>
                            <th class="text-center">TGK POKOK</th>
                            <th class="text-center">HR-B</th>
                            <th class="text-center">TGK BUNGA</th>
                            <th class="text-center">TGK DENDA</th>
                            <th class="text-center">TGK-HR</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>