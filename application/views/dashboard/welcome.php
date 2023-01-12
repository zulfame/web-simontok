<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $title; ?>
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
                <h3 class="box-title"><?= $title; ?></h3>


            </div>
            <div class="box-body">
                Start creating your amazing application!<br>
                <?php
                $this->load->library('user_agent');

                if ($this->agent->is_browser()) {
                    $agent = $this->agent->browser() . ' ' . $this->agent->version();
                } elseif ($this->agent->is_robot()) {
                    $agent = $this->agent->robot();
                } elseif ($this->agent->is_mobile()) {
                    $agent = $this->agent->mobile();
                } else {
                    $agent = 'Unidentified User Agent';
                }

                ?>

                <?= $this->input->ip_address(); ?> <br>
                <?= $this->agent->platform(); ?> <br>
                <?= $agent; ?> <br>
                <?= $_SERVER['HTTP_USER_AGENT']; ?> <br>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <font class="pull-right">
                    Page rendered in <strong>{elapsed_time}</strong> seconds.
                </font>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->