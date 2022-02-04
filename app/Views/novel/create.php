<?= $this->extend('layout/templateinput'); ?>
<?= $this->section('content'); ?>

<h4 data-v-b6b838ec="" class="card-title" data-v-ec91271c="" id="form">
    <strong data-v-b6b838ec="">FORM DATA NOVEL</strong>
</h4>
<div class="kotak">
    <form action="<?= base_url("/novel/save") ?>" method="post" name="form" enctype="multipart/form-data">
    <?= csrf_field(); ?>
        <!-- Judul -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('judul'); ?>
                </div>
            </div>
        </div>
        <!-- Penulis Buku -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Penulis Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penulis'); ?>
                </div>
            </div>
        </div>
        <!-- Genre -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Genre</label>
            </div>
            <select required class="custom-select" name="genre" id="genre" value="<?= old('id_genre') ?>">
                <option disable>Silahkan Pilih...</option>
                <?php foreach ($genre as $row) : ?>
                    <option value="<?= $row['id_genre'] ?>"><?= $row['genre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Sinopsis -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label mt-4">Sinopsis</label>
            <div class="form-floating">
                <textarea class="form-control ml-3 <?= ($validation->hasError('sinopsis')) ? 'is-invalid' : ''; ?>" id="floatingTextarea2" name="sinopsis" style="width:615px;height:100px" value="<?= old('sinopsis') ?>"></textarea>
                <div class="invalid-feedback">
                    <?= $validation->getError('sinopsis'); ?>
                </div>
            </div>
        </div>
        <!-- Penerbit -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penerbit'); ?>
                </div>
            </div>
        </div>
        <!-- Tahun -->
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Terbit</label>
            <div class="col-sm-10">
                <input required type="date" class="form-control" name="tanggal_terbit" id="tanggal_terbit" value="<?= old('tanggal_terbit') ?>">
            </div>
        </div>

        <!-- Bahasa-->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Bahasa</label>
            </div>
            <select required class="custom-select" name="bahasa" id="bahasa" value="<?= old('id_bahasa') ?>">
                <option disable>Silahkan Pilih...</option>
                <?php foreach ($bahasa as $row) : ?>
                    <option value="<?= $row['id_bahasa'] ?>"><?= $row['bahasa'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- sampul -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Sampul</span>
            </div>
            <div class="col-sm-2">
                <img src="<?= base_url('img/default.png')  ?>" class="img-thumbnail img-preview">
            </div>
            <div class="custom-file">
                <input type="file" name="sampul" id="sampul" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" onchange="previewImg()">
                <div class="invalid-feedback">
                    <?= $validation->getError('sampul'); ?>
                </div>
                <label class="custom-file-label" for="sampul">Pilih Gambar </label>
            </div>
        </div>
        <!-- berkas -->
        <!-- <div class="form-group">
            <label for="exampleFormControlFile1">Pilih Berkas</label>
            <input type="file" id="exampleFormControlFile1" name="ttd" class="form-control-file <?= ($validation->hasError('ttd')) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('ttd'); ?>
            </div>
        </div> -->
        <div class="row mb-3">
            <label for="ttd" class="col-sm-4 col-form-label">Berkas</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control <?= ($validation->hasError('detail_lengkap')) ? 'is-invalid' : ''; ?> " id="sampul" name="ttd" onchange="previewImg()">
                <label class="input-group-text " for="ttd">Upload</label>
                <div class="invalid-feedback">
                    <?= $validation->getError('ttd'); ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success" id="tombol">Submit</button>
    </form>
</div>
<?= $this->endSection(); ?>