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
                    <a href="<?= base_url('dev/tools/masking_export'); ?>" class="btn btn-sm btn-primary">EXPORT</a>
                </div>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 180px;">
                        <a href="<?= base_url('dev/tools/masking_delete'); ?>" class="btn btn-sm btn-danger pull-right delete-all"">HAPUS</a>
                        <a class=" btn btn-sm btn-warning pull-right" data-toggle="modal" data-target="#modal-import" style="margin-right: 3px;">IMPORT</a>
                    </div>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Nama Debitur</th>
                                        <th class="text-center">KD Kredit</th>
                                        <th class="text-center">Telpon</th>
                                        <th class="text-center">Wilayah</th>
                                        <th class="text-center">Bidang</th>
                                        <th class="text-center">Petugas</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($result as $r) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td><?= $r['nama_debitur']; ?></td>
                                            <td><?= $r['kd_credit']; ?></td>
                                            <td class="text-red"><?= $r['telpon']; ?></td>
                                            <td><?= $r['wilayah']; ?></td>
                                            <td><?= $r['bidang']; ?></td>
                                            <td class="text-center"><?= $r['kd_petugas']; ?></td>
                                            <td class="text-red"><?= $r['status']; ?></td>
                                            <td><?= $r['date']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p></p>

                    </div>
                </div>
            </div>

        </div>

    </section>
</div>

<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import Laporan Masking</h4>
            </div>
            <form action="<?= base_url('dev/tools/masking_import'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Upload File <a href="#">| Format_Excel</a></label>
                        <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>