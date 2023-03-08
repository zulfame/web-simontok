<div class="content-wrapper">

    <section class="content-header">
        <h1 class="text-capitalize">
            <?= $this->uri->segment(1); ?>
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
                <h3 class="box-title"><?= $title; ?></h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <a href="<?= base_url('monitoring/export_debitur'); ?>" class="btn btn-sm btn-default pull-right">EXPORT</a>

                    </div>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" id="example1" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No Credit</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Coll</th>
                                        <th class="text-center">OS Akhir</th>
                                        <th class="text-center">Pokok</th>
                                        <th class="text-center">Bunga</th>
                                        <th class="text-center">Denda</th>
                                        <th class="text-center">Hari</th>
                                        <th class="text-center">Officer</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($debitur as $d) : ?>
                                        <tr>
                                            <td><?= $d['kd_credit']; ?></td>
                                            <td><?= $d['nama_debitur']; ?></td>
                                            <td class="text-center"><?= $d['call']; ?></td>
                                            <td>Rp. <?= rupiah($d['os_akhir']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_p']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_b']); ?></td>
                                            <td>Rp. <?= rupiah($d['tunggakan_d']); ?></td>
                                            <td class="text-center"><?= $d['tunggakan_h']; ?></td>
                                            <td class="text-center"><?= $d['kd_petugas']; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-tambah<?= $d['kd_credit']; ?>" class="btn-circle btn-sm btn-primary"><i class="fa fa-plus"></i></a>
                                                <a href="<?= base_url('monitoring/card/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-success" target="_blank"><i class="fa fa-file-text"></i></a>
                                                <a href="<?= base_url('monitoring/card_print/') . $d['kd_credit']; ?>" class="btn-circle btn-sm btn-warning" target="_blank"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL TAMBAH -->
                                        <div class="modal fade" id="modal-tambah<?= $d['kd_credit']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-blue">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Buat Surat Tugas</h4>
                                                    </div>
                                                    <form action="<?= base_url('monitoring/st_add'); ?>" method="POST">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="debitur_code" value="<?= $d['kd_credit']; ?>" class="form-control">
                                                            <input type="hidden" name="tunggakan_p" value="<?= $d['tunggakan_p']; ?>" class="form-control">
                                                            <input type="hidden" name="tunggakan_b" value="<?= $d['tunggakan_b']; ?>" class="form-control">
                                                            <input type="hidden" name="tunggakan_d" value="<?= $d['tunggakan_d']; ?>" class="form-control">

                                                            <div class="form-grup">
                                                                <label>Debitur</label>
                                                                <input type="text" readonly class="form-control" value="<?= $d['nama_debitur']; ?>">
                                                            </div>

                                                            <div class="form-grup">
                                                                <label>Petugas</label>
                                                                <select class="form-control select2" style="width: 100%;" name="petugas_code" require>
                                                                    <option value="">--Pilih Petugas--</option>
                                                                    <?php foreach ($petugas as $p) : ?>
                                                                        <?php if ($d['kd_petugas'] == $p['user_code']) : ?>
                                                                            <option value="<?= $p['user_code']; ?>" selected><?= $p['name']; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $p['user_code']; ?>"><?= $p['name']; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th class="text-center" colspan="3">Total</th>
                                        <th class="text-center">OS Akhir</th>
                                        <th class="text-center">Pokok</th>
                                        <th class="text-center">Bunga</th>
                                        <th class="text-center">Denda</th>
                                        <th class="text-center" colspan="3"></th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
</div>