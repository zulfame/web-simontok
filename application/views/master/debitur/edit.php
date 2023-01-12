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
        <div class="box box-warning">
            <div class="box-header with-border bg-yellow">
                <h3 class="box-title">Update <?= $title; ?></h3>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="">
                            <!--ID MENU-->
                            <input type="hidden" class="form-control" name="id" id="id" value="<?= $debitur['id']; ?>">

                            <div class="form-group">
                                <label>KD Kredit</label>
                                <input type="text" class="form-control" readonly value="<?= $debitur['kd_credit']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Nama Debitur</label>
                                <input type="text" class="form-control" readonly value="<?= $debitur['nama_debitur']; ?>">
                            </div>

                            <div class="form-group">
                                <label>Wilayah</label>
                                <select class="form-control select2" style="width: 100%;" name="wilayah" id="wilayah">
                                    <?php foreach ($wilayah as $w) : ?>
                                        <?php if ($w == $debitur['wilayah']) : ?>
                                            <option value="<?= $w; ?>" selected><?= $w; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $w; ?>"><?= $w; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Bidang</label>
                                <select class="form-control select2" style="width: 100%;" name="bidang" id="bidang">
                                    <?php foreach ($bidang as $b) : ?>
                                        <?php if ($b == $debitur['bidang']) : ?>
                                            <option value="<?= $b; ?>" selected><?= $b; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $b; ?>"><?= $b; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Petugas</label>
                                <select class="form-control select2" style="width: 100%;" name="kd_petugas" id="kd_petugas">
                                    <?php foreach ($petugas as $p) : ?>
                                        <?php if ($p['user_code'] == $debitur['kd_petugas']) : ?>
                                            <option value="<?= $p['user_code']; ?>" selected><?= $p['name']; ?></option>
                                        <?php else : ?>
                                            <option value="<?= $p['user_code']; ?>"><?= $p['name']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <a href="<?= base_url('master/debitur'); ?>" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <font class="pull-right">
                    Page rendered in <strong>{elapsed_time}</strong>
                </font>
            </div>

        </div>

        <!-- Alert Massage -->
        <?= $this->session->flashdata('message'); ?>
        <?= form_error('wilayah', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('bidang', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <?= form_error('kd_petugas', '<div class="callout callout-danger"><p>', '</p></div>'); ?>
        <!-- End Alert Massage -->

    </section>
</div>