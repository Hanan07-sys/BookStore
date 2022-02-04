<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<div class="container" id="ts">
    <table class="table" class="kotak" name="novel" id="table">

        <thead class="thead-dark">

            <tr>
                <th scope="col">No.</th>
                <th scope="col">Sampul</th>
                <th scope="col">Nama Buku</th>
                <th scope="col">Penulis Buku</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <a href="<?= base_url("novel/create") ?>" class="btn btn-success mb-3"><i class="fas fa-book"> Tambah Produk Novel </i></a>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan') ?>
                </div>
            <?php endif; ?>
            <?php $jumlahbaris = 3 ?>
            <?php $i = 1 + ($jumlahbaris * ($currentPage - 1)); ?>
            <?php foreach ($novel as $row) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><img src="<?= base_url('img/' . $row['sampul'])  ?>" alt="" class="sampul"></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['penulis'] ?></td>
                    <td><a href="<?= base_url('novel/' . $row['slug']) ?>" class="btn btn-success btn"><i class="fas fa-info-circle"></i> DETAIL</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links('tb_buku', 'novel_pagination'); ?>
    <br><br>
</div>
<?= $this->endSection(); ?>