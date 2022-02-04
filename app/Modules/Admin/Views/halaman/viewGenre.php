<?= $this->extend('layout/templateadd'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <form action="<?= base_url("/genre/simpanGenre") ?>" method="post" name="form">
    <?= csrf_field(); ?>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('pesan') ?>
            </div>
        <?php endif; ?>
        <table class="table" class="kotak">
            <div id="genre">
                <input type="text" class="form-control <?= ($validation->hasError('genre')) ? 'is-invalid' : ''; ?>" id="exampleFormControlInput1" placeholder="Genre" style="width: 200px;" name="genre" autofocus value="<?= old('genre') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('genre'); ?>
                </div>
                <button type="submit" class="btn btn-dark" id="tulisgenre"><i class="fas fa-plus"></i></button>
                <a href="<?= base_url("novel") ?>" class="btn btn-dark" role="button" aria-pressed="true" id="kembali">Kembali</a>
    </form>
</div>

<thead class="thead-dark">
    <tr>
        <th scope="col">No.</th>
        <th scope="col">Genre</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    <?php $jumlahbaris = 8 ?>
    <?php $i = 1 + ($jumlahbaris * ($currentPage - 1)); ?>
    <?php foreach ($genre as $row) : ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['genre'] ?></td>
            <td>
                <a href="<?= base_url('genre/deleteGenre/' . $row['id_genre']) ?>" onclick="return confirm('apakah anda yakin ingin menghapus ?');" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?= $pager->links('tb_genre', 'novel_pagination'); ?>
<br><br>
<?= $this->endSection(); ?>