<?= $this->extend('layout/templateLogin'); ?>
<?= $this->section('content'); ?>

<!-- <body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div id="first">
                    <div class="myform form ">
                        <div class="logo mb-3">
                            <div class="col-md-12 text-center">
                                <h1>Login</h1>
                            </div>
                            <?php if (session()->getFlashdata('pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashData('pesan') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('msg')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashData('msg') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <form action="<?= base_url("/login/auth") ?>" method="post" name="login">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Username" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" id="password" class="form-control" aria-describedby="emailHelp" placeholder="Password">
                            </div>
                            <div class="col-md-12 text-center ">
                                <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                            </div>
                            <div class="form-group">
                                <p class="text-center">Anda Belum Punya Akun? <a href="<?= base_url("login/registrasi") ?>" id="signup">Silahkan Daftar</a></p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body> -->

<body>
    <div class="registration-form">
        <form action="<?= base_url("/login/auth") ?>" method="post">
            <?= csrf_field(); ?>
            <br>
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="col-md-12 text-center">
                <h1>Login</h1>
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashData('msg') ?>
                </div>
            <?php endif; ?>
            <br>
            <div class="form-group">
                <input type="text" class="form-control item" id="username" placeholder="Username" name="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" placeholder="Password" name="pass">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Login</button>
            </div>
            <div class="form-group">
                <p class="text-center">Anda Belum Punya Akun? <a href="<?= base_url("login/registrasi") ?>" id="signup">Sign In</a></p>
            </div>
        </form>
        <div class="social-media">
        </div>
    </div>
</body>



<?= $this->endSection(); ?>