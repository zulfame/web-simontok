    <!-- App Header -->
    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle"></div>
        <div class="right">
            <a href="<?= base_url('mobile/auth'); ?>" class="headerButton">
                Login
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="login-form">
            <div class="section">
                <img src="<?= base_url('assets/mobile/') ?>img/vactor/login.png" alt="image" class="form-image">
            </div>

            <div class="section">
                <h1>Forgot Password</h1>
                <h4>Type your email to reset your password</h4>
            </div>
            <div class="section mt-2 mb-5">
                <form class="user" method="post" action="<?= base_url('mobile/auth/forgotpassword'); ?>">

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('email', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= set_value('email'); ?>">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed" style="text-align:left ;">
                        <?= $this->session->flashdata('message'); ?>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Reset</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->