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
                <img src="<?= base_url('assets/mobile/') ?>img/vactor/monitor.png" alt="image" class="form-image">
            </div>

            <div class="section">
                <h1>Register</h1>
                <h4>Fill the form to join us</h4>
            </div>
            <div class="section mt-2 mb-5">
                <form method="post" action="<?= base_url('mobile/auth/registration') ?>">

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('name', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('email', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= set_value('email'); ?>">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <?= form_error('password1', '<div style="text-align:left; color:red; font-size:10px;">', '</div>'); ?>
                            <input type="password" inputmode="numeric" class="form-control" id="password1" name="password1" placeholder="Password" value="<?= set_value('password1'); ?>">
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

                    <div class=" mt-1 text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customChecka1" checked required>
                            <label class="custom-control-label text-muted" for="customChecka1">I Agree <a href="javascript:;">Terms & Conditions</a></label>
                        </div>

                    </div>

                    <div class="form-group boxed" style="text-align:left ;">
                        <?= $this->session->flashdata('message'); ?>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- * App Capsule -->