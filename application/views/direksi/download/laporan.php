<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="get" action="<?php echo base_url("report/filter/") ?>">
                    <div class="modal-body">

                        <div class="box-body">

                            <div class="form-group">
                                <label>DARI TANGGAL</label>
                                <input type="date" class="form-control" name="tgl1" required>
                            </div>

                            <div class="form-group">
                                <label>SAMPAI TANGGAL</label>
                                <input type="date" class="form-control" name="tgl2" required>
                            </div>
                            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-excell"></i> TAMPIL</button>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->

    </div>
    <!-- /.row -->
</section>