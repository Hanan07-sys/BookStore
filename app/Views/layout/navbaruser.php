<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark" id="navb">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <!-- user -->
        <a class="navbar-brand">
            <i class="fas fa-user">
                <?= session()->username ?>
                (<?= session()->role ?>)
            </i>
        </a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url("/user") ?>">Home <span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url("/user/novel") ?>">Novel <span class="sr-only"></span></a>
            </li>
            <a href="<?= base_url("/login/logout") ?>">
                <button class="btn btn-dark" type="button">Logout</button>
            </a>
        </ul>

    </div>
</nav>