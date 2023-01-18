<div class="content-wrapper">

    <section class="content-header">
        <h1>
            TeleBilling <?= $title; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li><a href="#" style="text-transform:capitalize ;"> <?= $this->uri->segment(1); ?></a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <div class="box-tools pull-left">
                    <a href="<?= base_url('telebilling/export_today'); ?>" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-file-excel-o"></i>&nbsp; EXPORT</a>
                    <a href="<?= base_url('telebilling/report_today'); ?>" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i>&nbsp; PRINT</a>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('telebilling/today') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="date" name="keyword" class="form-control pull-right">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-default" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Telp</th>
                                        <th class="text-center">Result</th>
                                        <th class="text-center">Descripsion</th>
                                        <th class="text-center">Region</th>
                                        <th class="text-center" width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($st as $s) :
                                        $p = $s['jb'];
                                        if ($p == "0000-00-00" || $p == "") {
                                            $jb = "";
                                        } else {
                                            $jb = "⇒ $p";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $s['nama_debitur']; ?></td>
                                            <td><?= $s['telepon']; ?></td>
                                            <td><?= $s['hasil']; ?></td>
                                            <td><?= $s['d_hasil']; ?> <?= $jb; ?></td>
                                            <td><?= $s['wilayah']; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-tambah<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('telebilling/today_delete/') . $s['id_st']; ?>" class="btn-circle btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="modal-tambah<?= $s['id_st']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-yellow">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Change Report Telebilling</h4>
                                                    </div>
                                                    <form action="<?= base_url('telebilling/today_edit'); ?>" method="POST">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id_st" value="<?= $s['id_st']; ?>" class="form-control">

                                                            <div class="form-grup">
                                                                <label>Result</label>
                                                                <select class="form-control" name="hasil" id="hasil" require>
                                                                    <option value="">Select Option</option>
                                                                    <?php foreach ($hasil as $h) : ?>
                                                                        <?php if ($h == $s['hasil']) : ?>
                                                                            <option value="<?= $h ?>" selected><?= $h ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $h ?>"><?= $h ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Pay Promise</label>
                                                                <input type="date" class="form-control" name="jb" id="jb" value="<?= $s['jb']; ?>">
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="d_hasil" id="d_hasil" required><?= $s['d_hasil']; ?></textarea>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-warning">Change</button>
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
                        <p></p>

                        <!-- Pagination -->
                        <?php echo $pagination; ?>
                        <!-- / End Pagination -->

                    </div>
                </div>
            </div>

            <div class="box-footer">
                <font class="pull-left">Total Rows <strong><?= $total_rows; ?></strong></font>
                <font class="pull-right">Rendered in <strong>{elapsed_time}</strong></font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?php if (empty($st)) : ?>
            <div class="callout callout-danger">
                <p><?= $title; ?> <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>