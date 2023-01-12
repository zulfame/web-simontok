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
                    <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-default">ADD TASK</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('monitoring/st') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="date" name="keyword" class="form-control pull-right" value="<?= date('Y-m-d'); ?>">
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
                                        <th class="text-center" width="12%">Action</th>
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
                                                <a href="<?= base_url('monitoring/st_delete') ?>/<?= $s['id_st']; ?>" class="btn-circle btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
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
                                                    <form action="<?= base_url('monitoring/st_edit'); ?>" method="POST">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id_st" value="<?= $s['id_st']; ?>">

                                                            <div class="form-group">
                                                                <label>Debitur</label>
                                                                <select class="form-control" style="width: 100%;" name="debitur_code" id="select2" required>
                                                                    <option value="">Select Debitur</option>
                                                                    <?php foreach ($debitur as $d) : ?>
                                                                        <?php if ($d['kd_credit'] == $s['kd_credit']) : ?>
                                                                            <option value="<?= $d['kd_credit']; ?>" selected><?= $d['nama_debitur']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $d['kd_credit']; ?>"><?= $d['nama_debitur']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Officer</label>
                                                                <select class="form-control" name="petugas_code" required>
                                                                    <option value="">Select Officer</option>
                                                                    <?php foreach ($petugas as $p) : ?>
                                                                        <?php if ($p['user_code'] == $s['petugas_code']) : ?>
                                                                            <option value="<?= $p['user_code']; ?>" selected><?= $p['name']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $p['user_code']; ?>"><?= $p['name']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Implementation</label>
                                                                <textarea class="form-control" readonly><?= $s['pelaksanaan'] ?> ⇒ <?= $s['d_pelaksanaan'] ?></textarea>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Result</label>
                                                                <textarea class="form-control" readonly><?= $s['hasil'] ?> ⇒ <?= $s['d_hasil'] ?></textarea>
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Note</label>
                                                                <textarea class="form-control" name="catatan" id="catatan"><?= $s['catatan'] ?></textarea>
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
                        <a href="<?= base_url('monitoring/st_print'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; REPORT</a>
                        <a href="<?= base_url('monitoring/st_print_officer'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; TASK TODAY</a>

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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <form action="<?= base_url('monitoring/st_add'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Debitur</label>
                        <select class="form-control select2" style="width: 100%;" name="debitur_code" id="debitur_code" required>
                            <option value="">Select Debitur</option>
                            <?php foreach ($debitur as $d) : ?>
                                <option value="<?= $d['kd_credit']; ?>"><?= $d['nama_debitur']; ?> - <?= $d['kd_credit']; ?> - [<?= $d['kd_petugas']; ?>]</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Officer</label>
                        <select class="form-control" name="petugas_code" required>
                            <option value="">Select Officer</option>
                            <?php foreach ($petugas as $p) : ?>
                                <option value="<?= $p['user_code']; ?>"><?= $p['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH WO -->
<div class="modal fade" id="modal-tambah-wo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Task Writeoff</h4>
            </div>
            <form action="<?= base_url('monitoring/st_add_wo'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Debitur</label>
                        <select class="form-control select2" style="width: 100%;" name="debitur_code" id="debitur_code" required>
                            <option value="">Select Debitur</option>
                            <?php foreach ($debitur_wo as $d) : ?>
                                <option value="<?= $d['kd_credit']; ?>"><?= $d['nama_debitur']; ?> - <?= $d['kd_credit']; ?> - [<?= $d['kd_petugas']; ?>]</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Officer</label>
                        <select class="form-control" name="petugas_code" required>
                            <option value="">Select Officer</option>
                            <?php foreach ($petugas as $p) : ?>
                                <option value="<?= $p['user_code']; ?>"><?= $p['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>