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
                    <form action="<?= base_url('master/tunggakan') ?>" method="POST">
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
                                        <th class="text-center">KD Credit</th>
                                        <th class="text-center">Debitur Name</th>
                                        <th class="text-center">Plafond</th>
                                        <th class="text-center">Call</th>
                                        <th class="text-center">Baki Debet</th>
                                        <th class="text-center">HR-P</th>
                                        <th class="text-center">Tgk. Pokok</th>
                                        <th class="text-center">HR-B</th>
                                        <th class="text-center">Tgk. Bunga</th>
                                        <th class="text-center">Tgk. Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tunggakan as $t) : ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $t['kd_credit']; ?></td>
                                            <td><?= $t['nama_debitur']; ?></td>
                                            <td>Rp. <?= rupiah($t['plafond']); ?></td>
                                            <td class="text-center"><?= $t['call']; ?></td>
                                            <td>Rp. <?= rupiah($t['baki_debet']); ?></td>
                                            <td class="text-center"><?= $t['hari_pokok']; ?></td>
                                            <td>Rp. <?= rupiah($t['tgk_pokok']); ?></td>
                                            <td class="text-center"><?= $t['hari_bunga']; ?></td>
                                            <td>Rp. <?= rupiah($t['tgk_bunga']); ?></td>
                                            <td>Rp. <?= rupiah($t['tgk_denda']); ?></td>
                                        </tr>
                                        <?php $page; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p></p>

                        <!-- Pagination -->
                        <div class="pull-left">
                            <a href="<?= base_url('master/tunggakan_delete_all'); ?>" class="btn btn-sm btn-danger delete-all">DELETE</a>
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
        <?php if (empty($tunggakan)) : ?>
            <div class="callout callout-danger">
                <p>Data <b>doesn't</b> exist!</p>
            </div>
        <?php endif; ?>
        <!-- End Alert Massage -->

    </section>
</div>