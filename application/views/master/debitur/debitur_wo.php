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
                    <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-import">IMPORT</a>
                    <a href="#" class="btn btn-sm btn-default">EXPORT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('master/debitur_wo') ?>" method="POST">
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
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">No Credit</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Plafond</th>
                                        <th class="text-center">OS Akhir</th>
                                        <th class="text-center">Tgk. Bunga</th>
                                        <th class="text-center">JW</th>
                                        <th class="text-center">Metode</th>
                                        <th class="text-center">Officer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($debitur_wo as $dw) : ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $dw['kd_credit']; ?></td>
                                            <td><?= $dw['nama_debitur']; ?></td>
                                            <td>Rp. <?= rupiah($dw['plafond']); ?></td>
                                            <td>Rp. <?= rupiah($dw['os_akhir']); ?></td>
                                            <td>Rp. <?= rupiah($dw['tgk_bunga']); ?></td>
                                            <td class="text-center"><?= $dw['jw']; ?></td>
                                            <td><?= $dw['metode_rps']; ?></td>
                                            <td><?= $dw['name']; ?></td>
                                        </tr>
                                        <?php $page; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p></p>

                        <!-- Pagination -->
                        <div class="pull-left">
                            <a href="<?= base_url('master/debitur_wo_delete_all'); ?>" class="btn btn-sm btn-danger delete-all">DELETE</a>
                        </div>

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
        <?php if (empty($debitur_wo)) : ?>
            <div class="callout callout-danger">
                <p>Data <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>

<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Debitur WO</h4>
            </div>
            <form action="<?= base_url('master/debitur_wo_import'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload File <a href="#">| Format_Excel</a></label>
                        <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>