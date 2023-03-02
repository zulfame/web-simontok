<!doctype html>
<html lang="en">

<head>
    <title><?php echo $title;?></title>
    <?php $this->load->view('mtemplates/header.php')?>
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <?php $this->load->view($konten)?>


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="<?= base_url('dashboard/ao');?>" class="item <?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
            </div>
        </a>
        <a href="<?= base_url('debitur/mdebitur');?>" class="item <?php if($this->uri->segment(1)=="debitur"){echo "active";}?>">
            <div class="col">
                <ion-icon name="people-outline"></ion-icon>
            </div>
        </a>
        <a class="item" type="submit" value="Refresh" onClick="document.location.reload(true)">
            <div class="col">
                <ion-icon name="refresh-outline"></ion-icon>
            </div>
        </a>
        <a href="<?= base_url('tugas/mtugas');?>" class="item <?php if($this->uri->segment(1)=="tugas"){echo "active";}?>">
            <div class="col">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
        </a>
        <a href="<?= base_url('prospek/mprospek');?>" class="item <?php if($this->uri->segment(1)=="prospek"){echo "active";}?>">
            <div class="col">
                <ion-icon name="stats-chart-outline"></ion-icon>
            </div>
        </a>
        <a href="javascript:;" class="item" data-toggle="modal" data-target="#sidebarPanel">
            <div class="col">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

    <!-- App Sidebar -->
    <?php $this->load->view('mtemplates/sidebar.php')?>
    <!-- * App Sidebar -->

    <?php $this->load->view('mtemplates/footer.php')?>

</body>

</html>