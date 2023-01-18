<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Region: <?= $title; ?>
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
                    <form action="<?= base_url('telebilling/subang') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="number" name="keyword" class="form-control pull-right" placeholder="Hari Tunggakan">
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
                                        <th class="text-center">No. Tabungan</th>
                                        <th class="text-center">Telp</th>
                                        <th class="text-center">OS Akhir</th>
                                        <th class="text-center">Pokok</th>
                                        <th class="text-center">Bunga</th>
                                        <th class="text-center">Denda</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center" width="12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($debitur as $d) :
                                        $tp = $d['tunggakan_p'];
                                        $tb = $d['tunggakan_b'];
                                        $td = $d['tunggakan_d'];
                                        $total = $tp + $tb + $td;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td><?= $d['nama_debitur']; ?></td>
                                            <td><?= $d['noacc_droping']; ?></td>
                                            <td><?= $d['telepon']; ?></td>
                                            <td>Rp. <?= rupiah($d['os_akhir']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_p']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_b']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_d']); ?></td>
                                            <td class="text-center"><?= $d['tunggakan_h']; ?></td>
                                            <td>Rp. <?= rupiah($total); ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-tambah<?= $d['kd_credit']; ?>" class="btn-circle btn-sm btn-primary" target="_blank"><i class="fa fa-plus"></i></a>
                                                <a href="https://api.whatsapp.com/send?phone=<?= $d['telepon']; ?>&text=Yth.%20Bpk/Ibu%20<?= $d['nama_debitur']; ?>%20kami%20dr%20BPR%20BANGUNARTA,%20kredit%20anda%20sdh%20Jt%20Tempo%20<?= $d['tunggakan_h']; ?>%20hari.%20Lakukan%20pembayaran%20tunggakan%20sebesar%20Rp.%20<?= rupiah($total); ?>%20melalui%20Virtual%20Account/kantor%20BPR%20BANGUNARTA%20terdekat.%20Terima%20kasih." class="btn-circle btn-sm btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                                <a href="<?= base_url('telebilling/card/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-warning" target="_blank"><i class="fa fa-file-text"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL TAMBAH -->
                                        <div class="modal fade" id="modal-tambah<?= $d['kd_credit']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Add Report Telebilling</h4>
                                                        </div>
                                                        <form action="<?= base_url('telebilling/today_add'); ?>" method="POST">
                                                            <div class="modal-body">

                                                                <input type="hidden" name="kd_credit" value="<?= $d['kd_credit']; ?>" class="form-control">
                                                                <input type="hidden" name="tgk_pokok" value="<?= $d['tunggakan_p']; ?>" class="form-control">
                                                                <input type="hidden" name="tgk_bunga" value="<?= $d['tunggakan_b']; ?>" class="form-control">
                                                                <input type="hidden" name="tgk_denda" value="<?= $d['tunggakan_d']; ?>" class="form-control">

                                                                <input type="hidden" class="form-control" name="pelaksanaan" id="pelaksanaan" value="Tele Billing">
                                                                <input type="hidden" class="form-control" name="d_pelaksanaan" id="d_pelaksanaan" value="Penagihan melalui telepon">

                                                                <div class="form-grup">
                                                                    <label>Result</label>
                                                                    <select class="form-control" name="hasil" id="hasil" require>
                                                                        <option value="">Select Option</option>
                                                                        <?php foreach ($hasil as $h) : ?>
                                                                            <option value="<?= $h ?>"><?= $h ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-grup">
                                                                    <label>Pay Promise</label>
                                                                    <input type="date" class="form-control" name="jb" id="jb">
                                                                </div>

                                                                <div class="form-grup">
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" name="d_hasil" id="d_hasil"></textarea>
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