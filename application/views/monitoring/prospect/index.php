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
                    <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-default">ADD PROSPECT</a>
                    <a href="<?= base_url('monitoring/prospect_officer'); ?>" class="btn btn-sm btn-default">OFFICER</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('monitoring/prospect') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="date" name="keyword" class="form-control pull-right" placeholder="Code Credit">
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
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center" width="12%">Date</th>
                                        <th class="text-center">Plan</th>
                                        <th class="text-center">Target</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($prospek as $p) :
                                        if ($p['status'] == 'Closing') {
                                            $sts = "success";
                                        } elseif ($p['status'] == 'Failed') {
                                            $sts = "danger";
                                        } else {
                                            $sts = "warning";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $p['tgl']; ?></td>
                                            <td><?= $p['prospek']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td class="text-center"><a class='btn-circle btn-sm btn-<?= $sts; ?>'><?= $p['status']; ?></a></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-edit<?= $p['id_prospek']; ?>" class="btn-circle btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('monitoring/prospect_delete/') . $p['id_prospek']; ?>" class="btn-circle btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="modal-edit<?= $p['id_prospek']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-yellow">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Change Prospect</h4>
                                                    </div>
                                                    <form action="<?= base_url('monitoring/prospect_edit'); ?>" method="POST">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id_prospek" value="<?= $p['id_prospek']; ?>">

                                                            <div class="form-group">
                                                                <label>Plan</label>
                                                                <input type="text" name="plan" id="plan" class="form-control" value="<?= $p['prospek']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Target</label>
                                                                <textarea name="target" id="target" class="form-control"><?= $p['keterangan']; ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="form-control select2" style="width: 100%;" name="status" id="status" required>
                                                                    <?php foreach ($status as $s) : ?>
                                                                        <?php if ($s == $p['status']) : ?>
                                                                            <option value="<?= $s; ?>" selected><?= $s; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $s; ?>"><?= $s; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
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
        <?php if (empty($prospek)) : ?>
            <div class="callout callout-danger">
                <p>Prospect <b>doesn't</b> exist!</p>
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
                <h4 class="modal-title">Add Prospect</h4>
            </div>
            <form action="<?= base_url('monitoring/prospect_add'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Plan</label>
                        <input type="text" name="plan" id="plan" class="form-control" value="<?= set_value('plan'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <textarea name="target" id="target" class="form-control" value="<?= set_value('target'); ?>"></textarea>
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