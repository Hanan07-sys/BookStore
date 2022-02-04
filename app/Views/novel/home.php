<?= $this->extend('layout/templateHome'); ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1>BOOK SHOP</h1>
            <img src="<?= base_url('img/logo2.jpg')  ?>" alt="">
            <!-- <h1 class="display-4">Finestra Shop</h1> -->
            <p class="lead mt-3">Menjual novel, komik,dan aneka novel terbaru dari berbagai penerbit di Indonesia dengan harga murah.</p>
        </div>
    </div>
</div>
<!-- Judul -->
<div class="container mt-3" id="produk">
    <div class="row">
        <div class="col text-center">
            <h1>PRODUK</h1>
        </div>
    </div>
</div>
<!-- isi -->
<div class="container mt-3">
    <div class="row ">
        <?php foreach ($novel as $row) : ?>
            <div class="card ml-3" style="width: 16rem;">
                <img src="<?= base_url('img/' . $row['sampul'])  ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['judul']; ?></h5>
                    <small><?= $row['penerbit'] ?></small>
                    <br>
                    <!-- Button Detail trigger modal -->
                    <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#<?= $row['slug'] ?>">
                        <i class="fas fa-edit"></i>DETAIL
                    </button>
                    <!-- Modal Detail -->
                    <div class="modal fade" id="<?= $row['slug'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="exampleModalLabel"><?= $row['judul']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class=""><b>Penulis : </b>
                                        <?= $row['penulis'] ?>
                                    </p>
                                    <p class=""><b>Genre: </b>
                                        <?= $row['genre'] ?>
                                    </p>
                                    <p class=""><b>Sinopsis: </b>
                                        <?= $row['sinopsis'] ?>
                                    </p>
                                    <p class=""><b>Penerbit: </b>
                                        <?= $row['penerbit'] ?>
                                    </p>
                                    <p class=""><b>Tanggal Terbit: </b>
                                        <?= $row['tanggal_terbit'] ?>
                                    </p>
                                    <p class=""><b>Bahasa: </b>
                                        <?= $row['bahasa'] ?>
                                    </p>
                                    <p class=""><b>Berkas: </b>
                                    <a href="<?= base_url('berkas/' . $row['ttd']) ?>">Download</a>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-shopping-cart"></i>PESAN
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pemesanan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda ingin memesan novel  ? 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>