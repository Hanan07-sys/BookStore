<?= $this->extend('layout/templateLogin'); ?>
<?= $this->section('content'); ?>

<body>
    <div class="registration-form">
        <form action="<?= base_url("/login/save") ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="col-md-12 text-center">
                <h1>Registrasi</h1>
            </div>
            <br>
            <div class="form-group">
                <input type="text" class="form-control item <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" name="username" value="<?= old('username') ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('username'); ?>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item <?= ($validation->hasError('pass')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" name="pass"value="<?= old('pass') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('pass'); ?>
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control item <?= ($validation->hasError('confirm_pass')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Confrim Password" name="confirm_pass"value="<?= old('confirm_pass') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('confirm_pass'); ?>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account ">Create Account</button>
            </div>
            <div class="form-group">
                <p class="text-center">Anda sudah Punya Akun? <a href="<?= base_url("login") ?>" id="signup">Log In</a></p>
            </div>
        </form>
        <div class="social-media">
        </div>
    </div>
</body>


<?= $this->endSection(); ?>