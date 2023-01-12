    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="<?= base_url('assets/mobile/') ?>img/vactor/login.png" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Get started</h1>
                <h4>Fill the form to log in</h4>
            </div>
        </div>

        <div class="section mt-1 mb-5">
            <form method="post" action="<?= base_url('mobile/auth'); ?>">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <?= form_error('email', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <?= form_error('password', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                        <input type="password" inputmode="numeric" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed" style="text-align:left ;">
                    <?= $this->session->flashdata('message'); ?>
                </div>

                <div class="form-links mt-2">
                    <div>
                        <a href="<?= base_url('mobile/auth/registration') ?>">Register Now</a>
                    </div>
                    <div><a href="<?= base_url('mobile/auth/forgotpassword') ?>" class="text-muted">Forgot Password?</a></div>
                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>

            </form>
        </div>
    </div>
    </div>
    </div>
    <!-- * App Capsule -->