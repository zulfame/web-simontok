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

        <!-- Default box -->
        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <h3 class="box-title">Surat Tugas</h3>


            </div>
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table id="example4" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">No</th>
                                <th class="text-center" width="8%">Date</th>
                                <th class="text-center">No Task</th>
                                <th class="text-center">No Credit</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Officer</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Note</th>
                                <th class="text-center" width="8%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($st as $s) :
                                $p = $s['pelaksanaan'];
                                if (!$p) {
                                    $status = "<span class='badge bg-yellow'>Progres</span>";
                                } else {
                                    $status = "<span class='badge bg-green'>Done</span>";
                                }

                                $c = $s['catatan'];
                                if (!$c) {
                                    $catatan = "<center><span class='badge bg-red'>Empty</span></center>";
                                } else {
                                    $catatan = "<center><span class='badge bg-green'>Noted</span></center>";
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $s['tgl']; ?></td>
                                    <td style="text-transform:uppercase;"><?= $s['no_st']; ?></td>
                                    <td><?= $s['kd_credit']; ?></td>
                                    <td><?= $s['nama_debitur']; ?></td>
                                    <td><?= $s['name']; ?></td>
                                    <td class="text-center"><?= $status; ?></td>
                                    <td><?= $catatan; ?></td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#modal-foto<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-primary"><i class="fa fa-image"></i></a>
                                        <a data-toggle="modal" data-target="#modal-edit<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>

                                <!-- MODAL IMAGE -->
                                <div class="modal fade" id="modal-foto<?= $s['id_st']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="border-radius: 10px;">
                                            <div class="modal-body">
                                                <img class="img-responsive" src="<?= base_url('assets/img/st/') . $s['image']; ?>" style="border-radius: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- MODAL EDIT -->
                                <div class="modal fade" id="modal-edit<?= $s['id_st']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-green">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Detail Task</h4>
                                            </div>
                                            <form action="<?= base_url('monitoring/st_edit'); ?>" method="POST">
                                                <div class="modal-body">

                                                    <input type="hidden" name="id_st" value="<?= $s['id_st']; ?>">

                                                    <div class="form-group">
                                                        <label>Peleksanaan</label>
                                                        <input class="form-control" type="text" readonly value="<?= $s['pelaksanaan']; ?>">
                                                    </div>
                                                    <div class="form-grup">
                                                        <label>Detail Pelaksanaan</label>
                                                        <textarea class="form-control" readonly><?= $s['d_pelaksanaan'] ?></textarea>
                                                    </div>
                                                    <p></p>
                                                    <div class="form-group">
                                                        <label>Hasil</label>
                                                        <input class="form-control" type="text" readonly value="<?= $s['hasil']; ?>">
                                                    </div>
                                                    <div class="form-grup">
                                                        <label>Detail Hasil</label>
                                                        <textarea class="form-control" readonly><?= $s['d_hasil'] ?></textarea>
                                                    </div>

                                                    <div class="form-grup">
                                                        <label>Note</label>
                                                        <textarea class="form-control" readonly name="catatan" id="catatan"><?= $s['catatan'] ?></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php $page; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <font class="pull-right">
                    Page rendered in <strong>{elapsed_time}</strong> seconds.
                </font>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->