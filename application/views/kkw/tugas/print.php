<?php 
  $pokok  = $tugas->tgk_pokok;
  $bunga  = $tugas->tgk_bunga;
  $denda  = $tugas->tgk_denda;
  $total  = $pokok+$bunga+$denda;
 ?>
<section class="content" style="padding-top: -30px;">
  <img src="<?= base_url('assets/img/');?>logo.png" width="20%">
  <font style="float:right;font-weight: bold;font-size: 20px;"><?= $tugas->nama_debitur;?></font>
  <!-- title row -->

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div >
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body" style="font-size:10px;">
          <center>
            <b>
              <font>SURAT TUGAS PENAGIHAN</font></br>
              <font style="text-transform: uppercase;">No. <?= $tugas->no_st;?></font>
            </b>
          </center> 
          <table>
            <thead>
              <tr>
                <th>Yang bertanda tangan dibawah ini:</th>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td> : <?= $this->session->userdata('nama');?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                <td> : <?= $this->session->userdata('jabatan');?></td>
              </tr>
              <tr>
                <th>Dengan ini menugaskan kepada:</th>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td> : <?= $tugas->nama;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                <td> : AO Kredit</td>
              </tr>
              <tr>
                <th>Untuk melakukan penagihan kepada:</th>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td> : <?= $tugas->nama_debitur;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td> : <?= $tugas->alamat;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Telepon</td>
                <td> : <?= $tugas->telepon;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Rekening</td>
                <td> : <?= $tugas->kd_credit;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Tabungan</td>
                <td> : <?= $tugas->noacc_droping;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. Perjanjian</td>
                <td> : <?= $tugas->no_spk;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plafond</td>
                <td> : Rp. <?= rupiah($tugas->plafond);?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl Jatuh Tempo</td>
                <td> : <?= $tugas->tgl_jth_tempo;?></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Tagihan</td>
                <td> : Rp. <?= rupiah($total);?></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  Pokok : Rp. <?= rupiah($tugas->tgk_pokok);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Bunga : Rp. <?= rupiah($tugas->tgk_bunga);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  Denda : Rp. <?= rupiah($tugas->tgk_denda);?>
                </td>
              </tr>
            </thead>
          </table>
          <b>
            <font>Demikian surat tugas penagihan ini agar dapat dilaksanakan dan dipergunakan sebagaimana mestinya.</font><br>
            <center>
              <font><?= $this->session->userdata('wilayah');?>, <?= date('j F Y');?></font>
            </center>
          </b>
        </div>

        <div class="row">
          <center>
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div>
                <div class="inner">
                  <font>Pemberi Tugas,</font><br><br><br>
                  <font style="text-decoration: underline;"><?= $this->session->userdata('nama');?></font>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div>
                <div class="inner">
                  <font>Penerima Tugas,</font><br><br><br>
                  <font style="text-decoration: underline;"><?= $tugas->nama;?></font>
                </div>
              </div>
            </div>
          </center>
        </div>
      </div>
      <br>
      <center>
        <div class="inner">
          <font>Debitur,</font><br><br><br>
          <font style="text-decoration: underline;">...............................</font>
        </div>
      </center>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->

  </div>
  <!-- /.row -->
</section>

<script>
  window.print();
</script>