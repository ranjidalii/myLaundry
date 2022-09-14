<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar User</h1>
    <a href="/users/create" class="btn btn-primary mb-3">Tambah User</a>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table table-hover table-sm " id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Group</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Group</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
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
                                            <button type="submit" class="text-info btn-outline-danger fa-solid fa-solid fa-key p-2 rounded" onclick="return confirm('Apakah Anda Yakin untuk Reset Password ?')"></button>
                                        </form>
                                        <form action="/users/<?= $u['id']; ?>" method="post" class="d-inline">
                                            <? csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-info btn-outline-danger fa-solid fa-trash-can p-2 rounded"></button>
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