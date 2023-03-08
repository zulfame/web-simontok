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
                    <a href="<?= base_url('task/export_debitur'); ?>" class="btn btn-sm btn-default">EXPORT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('task/debitur') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Code Credit">
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
                                        <th class="text-center">No Credit</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Call</th>
                                        <th class="text-center">Baki Debet</th>
                                        <th class="text-center">Tgk. Pokok</th>
                                        <th class="text-center">Tgk. Bunga</th>
                                        <th class="text-center">Tgk. Denda</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Officer</th>
                                        <th class="text-center" width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($debitur as $d) : ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $d['kd_credit']; ?></td>
                                            <td><?= $d['nama_debitur']; ?></td>
                                            <td class="text-center"><?= $d['call']; ?></td>
                                            <td>Rp. <?= rupiah($d['os_akhir']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_p']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_b']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_d']); ?></td>
                                            <td class="text-center"><?= $d['tunggakan_h']; ?></td>
                                            <td><?= $d['name']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('task/card/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-success" target="_blank"><i class="fa fa-file-text"></i></a>
                                                <a href="<?= base_url('task/card_print/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
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
        <?php if (empty($debitur)) : ?>
            <div class="callout callout-danger">
                <p>Debitur <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>