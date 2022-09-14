<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Jasa</h1>
    <a href="/jasa/create" class="btn btn-primary mb-3">Tambah Jasa</a>
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
                            <th>Jasa</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Jasa</th>
                            <th>Harga</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
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
                                    <!-- <a href="/jasa/edit/<?= $j['slug']; ?>" class="btn btn-warning">Edit</a> -->
                                    <form action="/jasa/edit/<?= $j['slug']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method">
                                        <?php if (in_groups('Admin')) : ?>
                                            <button type="submit" class="text-info btn-outline-warning fa-solid fa-pen p-2 rounded"></button>
                                        <?php endif; ?>
                                    </form>
                                    <form action="/jasa/<?= $j['id_jsa']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?php if (in_groups('Admin')) : ?>
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