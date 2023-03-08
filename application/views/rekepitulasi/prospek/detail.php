<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invalid Prospect
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-tv"></i> Monitoring</a></li>
            <li class="active"><?= $title; ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-<?= $site['line']; ?>">
            <div class="box-header with-border bg-<?= $site['color']; ?>">
                <h3 class="box-title"><?= $petugas['name']; ?></h3>
                <h3 class="box-title pull-right"><?= $this->uri->segment(4);; ?> s/d <?= $this->uri->segment(5); ?></h3>
            </div>
            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Date</th>
                                <th class="text-center">Hunting</th>
                                <th class="text-center">Calon Debitur</th>
                                <th class="text-center">No. HP</th>
                                <th class="text-center" width="30%">Keterangan</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prospek as $p) :
                                if ($p['status'] == "0") {
                                    $status = "<span class='label label-danger'>Progres</span>";
                                } else {
                                    $status = "<span class='label label-success'>Closing</span>";
                                }

                                if ($p['image_prospek'] == "default.png") {
                                    $img = "danger";
                                } else {
                                    $img = "primary";
                                }
                            ?>
                                <tr>
                                    <td class="text-center"><?= $p['tgl']; ?></td>
                                    <td><?= $p['prospek']; ?></td>
                                    <td><?= $p['calon_debitur']; ?></td>
                                    <td><?= $p['no_hp']; ?></td>
                                    <td><?= $p['keterangan']; ?></td>
                                    <td class="text-center"><?= $status; ?></td>
                                    </td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#modal-foto<?= $p['id_prospek']; ?>" class="btn-circle btn-sm btn-<?= $img; ?>"><i class="fa fa-picture-o"></i></a>
                                    </td>
                                </tr>

                                <!-- MODAL IMAGE -->
                                <div class="modal fade" id="modal-foto<?= $p['id_prospek']; ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="border-radius: 10px;">
                                            <div class="modal-body">
                                                <img class="img-responsive" src="<?= base_url('assets/img/prospek/') . $p['image_prospek']; ?>" style="border-radius: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>