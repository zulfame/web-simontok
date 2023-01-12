    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Error Page</div>
        <div class="right">
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="error-page">
            <img src="<?= base_url('assets/mobile/') ?>img/vactor/question.png" alt="alt" class="imaged square w200">
            <h1 class="title">Sorry</h1>
            <div class="text mb-5">
                The page you are looking for does not exist or is under development
            </div>

            <div class="fixed-footer">
                <div class="row">
                    <div class="col-12">
                        <a href="<?= base_url('mobile/auth'); ?>" class="btn btn-primary btn-lg btn-block">Go Back</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- * App Capsule -->