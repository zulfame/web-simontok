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
                    <a href="<?= base_url('monitoring/prospect'); ?>" class="btn btn-sm btn-default">PROSPECT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('monitoring/prospect_officer') ?>" method="POST">
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
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center" width="8%">Date</th>
                                    <th class="text-center" width="10%">Hunting</th>
                                    <th class="text-center">Candidate</th>
                                    <th class="text-center" width="10%">Telp</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Officer</th>
                                    <th class="text-center" width="8%">Status</th>
                                    <th class="text-center" width="5%">Action</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($prospek as $p2) :
                                        if ($p2['status'] == 'Closing') {
                                            $sts = "success";
                                        } elseif ($p2['status'] == 'Failed') {
                                            $sts = "danger";
                                        } else {
                                            $sts = "warning";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $p2['tgl']; ?></td>
                                            <td><?= $p2['prospek']; ?></td>
                                            <td><?= $p2['calon_debitur']; ?></td>
                                            <td><?= $p2['no_hp']; ?></td>
                                            <td><?= $p2['keterangan']; ?></td>
                                            <td><?= $p2['name']; ?></td>
                                            <td class="text-center">
                                                <a href="#" class="btn-circle btn-sm btn-<?= $sts; ?>"><?= $p2['status']; ?></a>
                                            </td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-foto<?= $p2['id_prospek']; ?>" class="btn-circle btn-sm btn-primary"><i class="fa fa-picture-o"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL IMAGE -->
                                        <div class="modal fade" id="modal-foto<?= $p2['id_prospek']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="border-radius: 10px;">
                                                    <div class="modal-body">
                                                        <img class="img-responsive" src="<?= base_url('assets/img/prospek/') . $p2['image_prospek']; ?>" style="border-radius: 10px;">
                                                    </div>
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