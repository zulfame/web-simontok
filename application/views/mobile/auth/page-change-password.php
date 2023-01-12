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
                <h1>Reset Password</h1>
                <h4>Create a new password for <b><?= $this->session->userdata('reset_email'); ?></b></h4>
            </div>
            <div class="section mt-2 mb-5">
                <form class="user" method="post" action="<?= base_url('mobile/auth/changepassword'); ?>">

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('password1', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="password" inputmode="numeric" class="form-control" id="password1" name="password1" placeholder="New Password" value="<?= set_value('password1'); ?>">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('password2', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="password" inputmode="numeric" class="form-control" id="password2" name="password2" placeholder="Password (again)" value="<?= set_value('password2'); ?>">
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