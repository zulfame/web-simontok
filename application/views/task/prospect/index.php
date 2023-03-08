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
                    <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-tambah">ADD PROSPECT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-spin fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('task/prospect') ?>" method="POST">
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
                                        <th class="text-center" width="4%">No</th>
                                        <th class="text-center" width="12%">Date</th>
                                        <th class="text-center">Candidate Name</th>
                                        <th class="text-center">Hunting</th>
                                        <th class="text-center">No. Telp</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center" width="10%">Status</th>
                                        <th class="text-center" width="12%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($prospect as $p) :
                                        if ($p['status'] == '0') {
                                            $sts = "<span class='label label-warning'>Progres</span>";
                                        } else {
                                            $sts = "<span class='label label-success'>Closing</span>";
                                        }

                                        if ($p['image_prospek'] == 'default.png') {
                                            $img = "danger";
                                        } else {
                                            $img = "primary";
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= ++$page; ?></td>
                                            <td class="text-center"><?= format_indo($p['tgl']); ?></td>
                                            <td><?= $p['calon_debitur']; ?></td>
                                            <td><?= $p['prospek']; ?></td>
                                            <td><?= $p['no_hp']; ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td class="text-center"><?= $sts; ?></td>
                                            <td class="text-center">
                                                <a data-toggle="modal" data-target="#modal-foto<?= $p['id_prospek']; ?>" class="btn-circle btn-sm btn-<?= $img; ?>"><i class="fa fa-picture-o"></i></a>
                                                <a class="btn-circle btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit<?= $p['id_prospek']; ?>"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url('task/prospect_delete/') . $p['id_prospek']; ?>" class="btn-circle btn-sm btn-danger tombol-hapus"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>

                                        <!-- MODAL IMAGE -->
                                        <div class="modal fade" id="modal-foto<?= $p['id_prospek']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content" style="border-radius: 10px;">
                                                    <div class="modal-body">
                                                        <img class="img-responsive" src="<?= base_url('assets/img/prospek/') ?><?= $p['image_prospek']; ?>" style="border-radius: 10px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- MODAL EDIT -->
                                        <div class="modal fade" id="modal-edit<?= $p['id_prospek']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-yellow">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Change Prospect</h4>
                                                    </div>
                                                    <form action="<?= base_url('task/prospect_edit'); ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">

                                                            <input type="hidden" name="id_prospek" value="<?= $p['id_prospek']; ?>">

                                                            <div class="form-group">
                                                                <label>Hunting</label>
                                                                <select class="form-control select2" style="width: 100%;" name="hunting" id="hunting" required>
                                                                    <option value="">Select Option</option>
                                                                    <?php foreach ($prospek as $pr) : ?>
                                                                        <?php if ($pr == $p['prospek']) : ?>
                                                                            <option value="<?= $pr; ?>" selected><?= $pr; ?></option>
                                                                        <?php else : ?>
                                                                            <option value="<?= $pr; ?>"><?= $pr; ?></option>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Candidate Name</label>
                                                                <input type="text" name="candidate" id="candidate" class="form-control" value="<?= $p['calon_debitur']; ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>No. Telp</label>
                                                                <input type="number" name="telp" id="telp" class="form-control" value="<?= $p['no_hp']; ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="description" id="description" cols="30" class="form-control" required><?= $p['keterangan']; ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <input type="hidden" name="old_img" id="old_img" value="<?= $p['image_prospek']; ?>">
                                                                <input type="file" class="form-control custom-file-input" id="image" name="image" accept=".png, .jpg, .jpeg">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="form-control select2" style="width: 100%;" name="status" id="status" required>
                                                                    <option value="2">Progres</option>
                                                                    <option value="1">Closing</option>
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
                <!-- <font class="pull-left">Total Rows <strong><?= $total_rows; ?></strong></font> -->
                <font class="pull-right">Rendered in <strong>{elapsed_time}</strong></font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?php if (empty($prospect)) : ?>
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
            <form action="<?= base_url('task/prospect_add'); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Hunting</label>
                        <select class="form-control select2" style="width: 100%;" name="hunting" id="hunting" value="<?= set_value('hunting'); ?>" required>
                            <option value="">Select Option</option>
                            <?php foreach ($prospek as $p) : ?>
                                <option value="<?= $p; ?>"><?= $p; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Candidate Name</label>
                        <input type="text" name="candidate" id="candidate" class="form-control" value="<?= set_value('candidate'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>No. Telp</label>
                        <input type="number" name="telp" id="telp" class="form-control" value="<?= set_value('telp'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" cols="30" class="form-control" value="<?= set_value('description'); ?>" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="hidden" name="old_img" id="old_img" value="default.png">
                        <input type="file" class="form-control custom-file-input" id="image" name="image" accept=".png, .jpg, .jpeg">
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