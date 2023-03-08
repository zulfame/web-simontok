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
                            <table class="table table-bordered" id="example4" style="font-size: 13px;">
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
                                    <?php $no = 1;
                                    foreach ($st as $s) :
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
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center"><?= $s['tgl']; ?></td>
                                            <td style="text-transform:uppercase;"><?= $s['no_st']; ?></td>
                                            <td><?= $s['kd_credit']; ?></td>
                                            <td><?= $s['nama_debitur']; ?></td>
                                            <td><?= $s['petugas_code']; ?></td>
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
                                                                <select class="form-control" name="debitur_code" required>
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

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <a href="<?= base_url('monitoring/st_print'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; REPORT</a>
                        <a href="<?= base_url('monitoring/st_print_officer'); ?>" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i>&nbsp; TASK TODAY</a>

                    </div>
                </div>
            </div>

        </div>

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
                        <select class="form-control" name="debitur_code" id="debitur_code" required>
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