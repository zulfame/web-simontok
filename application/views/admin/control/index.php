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

        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-danger">
                        <li class="active"><a href="#monitoring" data-toggle="tab">Monitoring</a></li>
                        <li><a href="#master-data" data-toggle="tab">Master Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="monitoring">
                            <section id="new">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Online <span class="badge bg-green"><?= $c_online; ?></span></h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <table id="example3" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Name</th>
                                                            <th class="text-center" width="10%">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach (array_slice($online, 0, 10) as $o) : ?>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $o['name']; ?></td>
                                                                <td class="text-center"><span class="badge bg-green">Online</span></td>
                                                            </tr>
                                                        </tbody>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Suspicious Activity</h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <table id="example2" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Time</th>
                                                            <th class="text-center">Desc</th>
                                                            <th class="text-center">Loc</th>
                                                            <th class="text-center">IP</th>
                                                            <th class="text-center">Device</th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach (array_slice($activity, 0, 10) as $a) : ?>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $a['log_time']; ?></td>
                                                                <td><span class="badge bg-red"><?= $a['log_desc']; ?></span></td>
                                                                <td><?= $a['log_city']; ?></td>
                                                                <td><?= $a['log_ip']; ?></td>
                                                                <td><?= $a['log_device']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </div>

                        <div class="tab-pane" id="master-data">
                            <section id="new">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Debitur Active</h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <form action="<?= base_url('master/debitur_import'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Upload File | <a href="#">Format_Excel</a></label>
                                                            <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                                                        </div>
                                                        <center>
                                                            <button type="submit" class="btn btn-sm btn-success">IMPORT</button>
                                                        </center>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Debitur WO</h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <form action="<?= base_url('master/debitur_wo_import'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Upload File | <a href="#">Format_Excel</a></label>
                                                            <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                                                        </div>
                                                        <center>
                                                            <button type="submit" class="btn btn-sm btn-success">IMPORT</button>
                                                        </center>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Agunan</h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <form action="<?= base_url('master/agunan_import'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Upload File | <a href="#">Format_Excel</a></label>
                                                            <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                                                        </div>
                                                        <center>
                                                            <button type="submit" class="btn btn-sm btn-success">IMPORT</button>
                                                        </center>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Tunggakan</h3>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                <form action="<?= base_url('master/tunggakan_debitur'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label>Upload File | <a href="#">Format_Excel</a></label>
                                                            <input type="file" class="form-control" name="fileExcel" id="fileExcel" accept=".xlsx" required>
                                                        </div>
                                                        <center>
                                                            <button type="submit" class="btn btn-sm btn-success">IMPORT</button>
                                                        </center>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                            </section>
                            <center>
                                <div class="box-footer">
                                    <a href="<?= base_url('admin/clear'); ?>" class="btn btn-sm btn-danger delete-all">CLEAR ALL</a>
                                    <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-time">INTERVAL TIME</a>
                                </div>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<div class="modal fade" id="modal-time">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Set Interval Time</h4>
            </div>
            <form action="<?= base_url('admin/time_update'); ?>" method="POST">
                <div class="modal-body">

                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $time['idwaktu']; ?>">

                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="date" class="form-control" name="date1" id="date1" value="<?= $time['tgl_awal']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="date" class="form-control" name="date2" id="date2" value="<?= $time['tgl_akhir']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>