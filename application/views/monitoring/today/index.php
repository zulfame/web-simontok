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

        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <div class="box-tools pull-left">
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i>&nbsp; REFRESH</button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('monitoring/today') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
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
                            <table class="table table-bordered">
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
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($st as $s) :
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
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td class="text-center"><?= $s['tgl']; ?></td>
                                            <td style="text-transform:uppercase;"><?= $s['no_st']; ?></td>
                                            <td><?= $s['kd_credit']; ?></td>
                                            <td><?= $s['nama_debitur']; ?></td>
                                            <td><?= $s['name']; ?></td>
                                            <td class="text-center"><?= $status; ?></td>
                                            <td><?= $catatan; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-foto<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-primary"><i class="fa fa-image"></i></a>
                                                <a data-toggle="modal" data-target="#modal-edit<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
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
                                                    <div class="modal-header bg-yellow">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Change Task</h4>
                                                    </div>
                                                    <form action="<?= base_url('monitoring/today_edit'); ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id_st" value="<?= $s['id_st']; ?>">
                                                            <input type="hidden" name="nama_debitur" value="<?= $s['nama_debitur']; ?>">
                                                            <input type="hidden" name="image" value="<?= $s['image']; ?>">

                                                            <div class="form-grup">
                                                                <label>Implementation</label>
                                                                <select class="form-control" name="pelaksanaan" id="pelaksanaan" required>
                                                                    <option value="">Select Option</option>
                                                                    <?php foreach ($pelaksanaan as $p) : ?>
                                                                        <?php if ($p == $s['pelaksanaan']) : ?>
                                                                            <option value="<?= $p; ?>" selected><?= $p; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $p; ?>"><?= $p; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="d_pelaksanaan" id="d_pelaksanaan"><?= $s['d_pelaksanaan'] ?></textarea>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Result</label>
                                                                <select class="form-control" name="hasil" id="hasil">
                                                                    <option value="">Select Option</option>
                                                                    <?php foreach ($hasil as $h) : ?>
                                                                        <?php if ($h == $s['hasil']) : ?>
                                                                            <option value="<?= $h; ?>" selected><?= $h; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $h; ?>"><?= $h; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Tanggal JB</label>
                                                                <input type="date" class="form-control" name="jb" id="jb" value="<?= $s['jb'] ?>">
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="d_hasil" id="d_hasil"><?= $s['d_hasil'] ?></textarea>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Note</label>
                                                                <textarea class="form-control" name="catatan" id="catatan"><?= $s['catatan'] ?></textarea>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Image</label>
                                                                <input type="hidden" name="old_img" id="old_img" value="<?= $s['image']; ?>">
                                                                <input type="file" class="form-control custom-file-input" id="image" name="image" accept=".png, .jpg, .jpeg">
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
                <!-- <font class="pull-left">Total Rows <strong><?= $total_rows; ?></strong></font> -->
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