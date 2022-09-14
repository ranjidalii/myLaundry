<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/layanan/create" class="btn btn-primary mt-3">Tambah Layanan</a>
            <h1 class="mt-2">Daftar Layanan</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Estimasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($layanan as $l) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $l['layanan']; ?></td>
                            <td><?= "Rp " . $l['harga']; ?></td>
                            <?php if ($l['st_esti'] == 1) : ?>
                                <td><?= $l['estimasi'] . " Jam"; ?></td>
                            <?php else : ?>
                                <td><?= $l['estimasi'] . " Hari"; ?></td>
                            <?php endif; ?>
                            <td>
                                <a href="/layanan/edit/<?= $l['slug']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/layanan/<?= $l['id_lyn']; ?>" method="post" class="d-inline">
                                    <? csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if (in_groups('Admin')) : ?>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>