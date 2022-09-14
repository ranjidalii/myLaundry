<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/users/create" class="btn btn-primary mt-3">Tambah User</a>
            <h1 class="mt-2">Daftar User</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-sm table-bordered border-primary table align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Depan</th>
                        <th scope="col">Nama Belakang</th>
                        <th scope="col">Username</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Group</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody style="font-size:10pt">
                    <?php $i = 1; ?>
                    <?php foreach ($users as $u) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $u['firstname']; ?></td>
                            <td><?= $u['lastname']; ?></td>
                            <td><?= $u['username']; ?></td>
                            <td><?= $u['email']; ?></td>
                            <td><?= $u['group_name']; ?></td>
                            <td>
                                <!-- <a href="/users/<?= $u['username']; ?>" class="btn btn-success"> Detail </a> -->
                                <!-- <a href="/users/edit/<?= $u['username']; ?>" class="btn btn-warning">Edit</a> -->
                                <?php if (in_groups('Admin')) : ?>
                                    <form action="/reset-password-users/<?= $u['id']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah Anda Yakin ?')">Reset Password</button>
                                    </form>
                                    <form action="/users/<?= $u['id']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>