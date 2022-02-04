<?= $this->extend('layout/template'); ?>
<?= $this->section('content') ?>
<div class="container" id="ts">
    <table class="table" class="kotak" name="novel">

        <thead class="thead-dark">

            <tr>
                <th scope="col">No.</th>
                <th scope="col">ID Pengguna</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <a href="<?= base_url("pengguna/createPengguna") ?>" class="btn btn-success mb-3"  ><i class="fas fa-user">Tambah Pengguna</i></a>   
            <a href="<?= base_url("pengguna/createAdmin") ?>" class="btn btn-success mb-3"><i class="fas fa-user-lock"></i> Tambah Admin</i></a>
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
            <?php $jumlahbaris = 3 ?>
            <?php $i = 1 + ($jumlahbaris * ($currentPage - 1)); ?>
            <?php foreach ($pengguna as $row) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['id_pengguna'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <!-- edit -->
                        <a href="<?= base_url('pengguna/editPengguna/' . $row['id_pengguna']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i> EDIT</a>
                        <!-- hapus -->
                        <form action="<?= base_url('pengguna/deletePengguna/' . $row['id_pengguna']) ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus ?');"><i class="fas fa-trash-alt"></i> HAPUS</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links('pengguna', 'novel_pagination'); ?>
    <br><br>
</div>
<?= $this->endSection(); ?>