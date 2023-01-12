    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="pageTitle">Under Construction</div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">
        <br><br>
        <div class="error-page">
            <div class="mb-2">
                <img src="<?= base_url('assets/mobile/') ?>img/vactor/monitor.png" alt="alt" class="imaged square w200">
            </div>
            <h1 class="title">Coming Soon!</h1>
            <div class="text mb-3">
                Use the monitoring system using the desktop version.
            </div>
            <div id="countDown" class="mb-5"></div>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="<?= base_url('assets/mobile/') ?>js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?= base_url('assets/mobile/') ?>js/lib/popper.min.js"></script>
    <script src="<?= base_url('assets/mobile/') ?>js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="<?= base_url('assets/mobile/') ?>js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="<?= base_url('assets/mobile/') ?>js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="<?= base_url('assets/mobile/') ?>js/base.js"></script>

    <!-- ////////////////////////////////////////////////////////// -->
    <!-- only for under construction page -->
    <!-- jQuery Countdown -->
    <script src="<?= base_url('assets/mobile/') ?>js/plugins/jquery-countdown/jquery.countdown.min.js"></script>
    <!-- jQuery Countdown Settings -->
    <script>
        var date = "2023/01/03";
        $('#countDown').countdown(date, function(event) {
            $(this).html(event.strftime(
                '<div>%D<span>Days</span></div>' +
                '<div>%H<span>Hours</span></div>' +
                '<div>%M<span>Minutes</span></div>' +
                '<div>%S<span>Seconds</span></div>'
            ));
        });
    </script>
    <!-- ////////////////////////////////////////////////////////// -->

    </body>

    </html>