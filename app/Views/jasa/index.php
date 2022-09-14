<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/jasa/create" class="btn btn-primary mt-3">Tambah Jasa</a>
            <h1 class="mt-2">Daftar Jasa</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jasa</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($jasa as $j) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $j['jasa']; ?></td>
                            <td><?= $j['harga']; ?></td>
                            <?php if ($j['satuan'] == 1) : ?>
                                <td>Kg</td>
                            <?php else : ?>
                                <td>Pcs</td>
                            <?php endif; ?>
                            <td>
                                <a href="/jasa/edit/<?= $j['slug']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/jasa/<?= $j['id_jsa']; ?>" method="post" class="d-inline">
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