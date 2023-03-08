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
                    <form action="<?= base_url('kunjungan/kmd_writeoff') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 200px;">
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
                                        <th class="text-center">KD Credit</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Baki Bln Lalu</th>
                                        <th class="text-center">Baki Bln Ini</th>
                                        <th class="text-center">Tgk. Bunga</th>
                                        <th class="text-center">Tgk. Denda</th>
                                        <th class="text-center">Penyelesaian</th>
                                        <th class="text-center">Wilayah</th>
                                        <th class="text-center" width="8%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($debitur as $d) : ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $d['kd_credit']; ?></td>
                                            <td><?= $d['nama_debitur']; ?></td>
                                            <td>Rp. <?= rupiah($d['os_sebelumnya']); ?></td>
                                            <td>Rp. <?= rupiah($d['os_akhir']); ?></td>
                                            <td>Rp. <?= rupiah($d['tgk_bunga']); ?></td>
                                            <td>Rp. <?= rupiah($d['tgk_denda']); ?></td>
                                            <td>Rp. <?= rupiah($d['penyelesaian']); ?></td>
                                            <td><?= $d['wilayah']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('kunjungan/kmd_card_wo/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-success" target="_blank"><i class="fa fa-file-text"></i></a>
                                                <a href="<?= base_url('kunjungan/kmd_card_wo_print/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i></a>
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