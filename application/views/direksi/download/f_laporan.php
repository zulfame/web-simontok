<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NAMA DEBITUR</th>
                                <th class="text-center">KD. KREDIT</th>
                                <th class="text-center">WILAYAH</th>
                                <th class="text-center">PETUGAS</th>
                                <th class="text-center">TANGGAL</th>
                                <th class="text-center">PELAKSANAAN</th>
                                <th class="text-center">HASIL</th>
                                <th class="text-center">KET. PELAKSANAAN</th>
                                <th class="text-center">KET. HASIL</th>
                                <th class="text-center">CATATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kunjungan as $data) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $data->nama_debitur; ?></td>
                                    <td><?= $data->id_debitur; ?></td>
                                    <td class="text-center"><?= $data->wilayah; ?></td>
                                    <td><?= $data->petugas; ?> </td>
                                    <td><?= $data->tgl; ?></td>
                                    <td><?= $data->pelaksanaan; ?></td>
                                    <td><?= $data->hasil; ?></td>
                                    <td><?= $data->ket_pelaksanaan; ?></td>
                                    <td><?= $data->ket_hasil; ?></td>
                                    <td><?= $data->catatan; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>