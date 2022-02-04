<?= $this->extend('layout/templateadd'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <form action="<?= base_url("/bahasa/simpanBahasa") ?>" method="post" name="form">
    <?= csrf_field(); ?>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('pesan') ?>
            </div>
        <?php endif; ?>
        <table class="table" class="kotak">
            <div id="genre">
                <input type="text" class="form-control <?= ($validation->hasError('bahasa')) ? 'is-invalid' : ''; ?>" id="exampleFormControlInput1" placeholder="Bahasa" style="width: 200px;" name="bahasa" autofocus value="<?= old('bahasa') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('bahasa'); ?>
                </div>
                <button type="submit" class="btn btn-dark" id="tulisgenre"><i class="fas fa-plus"></i></button>
                <a href="<?= base_url("novel") ?>/" class="btn btn-dark" role="button" aria-pressed="true" id="kembali">Kembali</a>
    </form>
</div>
<thead class="thead-dark">
    <tr>
        <th scope="col">No.</th>
        <th scope="col">Bahasa</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
<?php $jumlahbaris = 8 ?>
<?php $i = 1 + ($jumlahbaris * ($currentPage - 1)); ?>
    <?php foreach ($bahasa as $row) : ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $row['bahasa'] ?></td>
            <td>
                <a href="<?= base_url('bahasa/deleteBahasa/' . $row['id_bahasa']) ?>" onclick="return confirm('apakah anda yakin ingin menghapus ?');" class="btn btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?= $pager->links('tb_bahasa', 'novel_pagination'); ?>

<br><br>
<?= $this->endSection(); ?>