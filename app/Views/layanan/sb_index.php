<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Layanan</h1>
    <a href="/layanan/create" class="btn btn-primary mb-3">Tambah Layanan</a>
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
                            <th scope="col">#</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Estimasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Estimasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </tfoot>
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
                                    <!-- <a href="/layanan/edit/<?= $l['slug']; ?>" class="btn btn-warning">Edit</a> -->
                                    <form action="/layanan/edit/<?= $l['slug']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <?php if (in_groups('Admin')) : ?>
                                            <input type="hidden" name="_method">
                                            <button type="submit" class="text-info btn-outline-warning fa-solid fa-pen p-2 rounded"></button>
                                        <?php endif; ?>
                                    </form>
                                    <form action="/layanan/<?= $l['id_lyn']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <?php if (in_groups('Admin')) : ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-info btn-outline-danger fa-solid fa-trash-can p-2 rounded"></button>
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