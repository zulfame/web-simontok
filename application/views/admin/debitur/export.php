 <?php
 
 header("Content-type: application/vnd-ms-excel");
 
 header("Content-Disposition: attachment; filename=$title.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>

<section class="content-header">
<div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center">NO</th>
                <th class="text-center">KD KREDIT</th>
                <th class="text-center">NAMA DEBITUR</th>
                <th class="text-center">PLAFOND</th>
                <th class="text-center">%</th>
                <th class="text-center">METODE</th>
                <th class="text-center">JW</th>
                <th class="text-center">REALISAI</th>
                <th class="text-center">WILAYAH</th>
                <th class="text-center">COLL</th>
                <th class="text-center">BAKI DEBET</th>
                <th class="text-center">HARI POKOK</th>
                <th class="text-center">TGK POKOK</th>
                <th class="text-center">HARI BUNGA</th>
                <th class="text-center">TGK BUNGA</th>
                <th class="text-center">TGK DENDA</th>
                <th class="text-center">NOACC DROPING</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1; foreach($debitur as $data)                              
              {
                ?> 
                <tr>
                  <td class="text-center"><?= $no++?></td>
                  <td>'<?= $data->kd_credit;?></td>
                  <td><?= $data->nama_debitur;?></td>
                  <td><?= $data->plafond;?> </td>
                  <td class="text-center"><?= $data->rate;?></td>
                  <td><?= $data->metode_rps;?></td>
                  <td class="text-center"><?= $data->jw;?> Bln</td>
                  <td><?= $data->tgl_realisasi;?></td>
                  <td><?= $data->wilayah;?></td>
                  <td><?= $data->call;?></td>
                  <td><?= $data->baki_debet;?></td>
                  <td><?= $data->hari_pokok;?></td>
                  <td><?= $data->tgk_pokok;?></td>
                  <td><?= $data->hari_bunga;?></td>
                  <td><?= $data->tgk_bunga;?></td>
                  <td><?= $data->tgk_denda;?></td>
                  <td>'<?= $data->noacc_droping;?></td>
                </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
</section>
