<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="pageTitle">
        <?= $title; ?>
    </div>
</div>
<!-- * App Header -->

<!-- App Capsule -->
<div id="appCapsule" style="margin: 100px auto;">
    <div class="error-page">
        <div class="icon-box text-success">
            <ion-icon name="checkmark-circle-outline"></ion-icon>
        </div>
        <h1 class="title">Thanks You</h1>
        <div class="text mb-5">
            Your report will be processed immediately.
        </div>

        <form id="telegramForm" method="POST">
            <div class="mt-2 pr-2 pl-2">
                <?= $this->session->flashdata('message'); ?>
                <?= $this->session->flashdata('message_failed'); ?>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input id="telegram_id" class="form-control" name="chat_id" type="hidden" value="-673449738" />
                        <input class="form-control" name="text" type="hidden" value='*REPORT SISTEM FROM USER*<?php echo "\n"; ?><?= "========================"; ?><?php echo "\n"; ?>*Tanggal*<?php echo "\n"; ?><?= date('d-m-Y H:i:s'); ?><?php echo "\n\n"; ?>*Pelapor* <?php echo "\n"; ?><?= $user['name']; ?><?php echo "\n\n"; ?>*Laporan*<?php echo "\n"; ?><?php echo $this->input->post('report'); ?>' />
                    </div>
                </div>
            </div>

            <div class="fixed-footer">
                <div class="row">
                    <button type="submit" id="sendToGroup" class="btn btn-primary btn-block btn-lg">Back to Home</button>
                </div>
            </div>
        </form>
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

<script>
    $(document).on('click', '#sendToGroup', function(e) {
        SwalTelegram();
        e.preventDefault();
    });

    function SwalTelegram() {
        if ($("#telegram_id").val()) {
            return new Promise(function(resolve) {
                $.ajax({
                        url: 'https://api.telegram.org/bot5985445229:AAETSRh7-wLoUf1W9MgOt-6Lt_MXx6RmRj8/sendMessage?parse_mode=Markdown',
                        type: 'POST',
                        data: $('#telegramForm').serialize(),
                        dataType: 'html'
                    })
                    .done(function(response) {
                        document.location.href = "<?= base_url('mobile/dashboard'); ?>";
                    })

                    .fail(function() {
                        Swal.fire('Oops...', 'Ada kesalahan &#x2639;&#xfe0f;', 'error');
                    });
            });
        } else {
            Swal.fire({
                title: "Warning!",
                html: "Ooops ada kesalahan system!",
                type: "warning",
                allowOutsideClick: false,
                timer: 3000,
                showConfirmButton: false
            });
        }
    }
</script>

</body>

</html>