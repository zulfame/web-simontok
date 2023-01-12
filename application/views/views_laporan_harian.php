<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bot Telegram
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-tv"></i> Dashboard</a></li>
            <li class="active">Bot Telegram</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <div class="box-tools pull-left">
                    <a href="#" class="btn btn-sm btn-success">EXPORT</a>
                    <button type="button" class="btn btn-default btn-sm" value="Refresh" onClick="document.location.reload(true)"><i class="fa fa-refresh"></i></button>
                </div>

                <div class="box-tools">
                    <form action="<?= base_url('menu') ?>" method="POST">
                        <div class="input-group input-group-sm" style="width: 180px;">
                            <input type="text" name="keyword" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-success" name="submit" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="box-body" style="margin-top:-5px ;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th class="text-center">Menu Name</th>
                                        <th class="text-center" width="10%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <p></p>

                        <!-- Pagination -->
                        <div class="pull-left">
                            <a data-toggle="modal" data-target="#modal-tambah" class="btn btn-sm btn-primary">ADD MENU</a>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="ui">
                    <button class="show-example-btn" aria-label="Try me! Example: A basic message" onclick="Swal.fire({
                    title: 'Posting ke group?',
                    text: 'Pastikan Laporan anda sudah benar',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3FC3EE',
                    cancelButtonColor: '#E91E63',
                    confirmButtonText: 'Ya!',
                    showLoaderOnConfirm: true,
                    })">
                        Try me!
                    </button>
                </div>
            </div>

        </div>

        <!-- Alert Massage -->
        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

        <?php if ($this->session->flashdata('message')) : ?>
            <!-- <div class="callout callout-success">
                <p>Menu <strong><?= $this->session->flashdata('message'); ?></strong> Successfully</p>
            </div> -->
        <?php endif; ?>

        <?= form_error('menu', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <!-- End Alert Massage -->

    </section>
</div>

<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Menu</h4>
            </div>
            <form action="<?= base_url('report/submit_report'); ?>" method="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="sales" id="sales" required>
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