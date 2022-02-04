<?= $this->extend('layout/templatenovelUser'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mb-2" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-3 justify-content-center">
                        <img class="" src="<?= base_url('img/' . $novel['sampul'])  ?>" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body" id="isicard">
                            <h1 class="card-title"><?= $novel['judul'] ?></h5>
                                <p class="card-text"><b>Penulis : </b>
                                    <?= $novel['penulis'] ?>
                                </p>
                                <p class="card-text"><b>Genre: </b>
                                    <?= $novel['genre'] ?>
                                </p>
                                <p class="card-text"><b>Sinopsis: </b>
                                    <?= $novel['sinopsis'] ?>
                                </p>
                                <p class="card-text"><b>Penerbit: </b>
                                    <?= $novel['penerbit'] ?>
                                </p>
                                <p class="card-text"><b>Tanggal Terbit: </b>
                                    <?= $novel['tanggal_terbit'] ?>
                                </p>
                                <p class="card-text"><b>Bahasa: </b>
                                    <?= $novel['bahasa'] ?>
                                </p>
                                <p><b>Berkas : </b>
                                <td><a href="<?= base_url('berkas/' . $novel['ttd']) ?>">Download</a></td>
                                </p>
                                <!-- edit -->
                                <a href="<?= base_url('user/novel') ?>" class="btn btn-success mb-3">Kembali</a>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>