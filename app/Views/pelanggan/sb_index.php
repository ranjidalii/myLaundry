<?= $this->extend('sblayout/template') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
    <a href="/pelanggan/create" class="btn btn-primary mb-3">Tambah Pelanggan</a>
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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>JK</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>JK</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                        <?php foreach ($pelanggan as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['alamat']; ?></td>
                                <td><?= $p['no_telp']; ?></td>
                                <?php if ($p['jenkel'] == 1) : ?>
                                    <td>Lk</td>
                                <?php else : ?>
                                    <td>Pr</td>
                                <?php endif; ?>
                                <td><?= date("d F Y", strtotime($p['tgl_lahir'])); ?></td>
                                <td>
                                    <!-- <a href="/pelanggan/<?= $p['slug']; ?>" class="btn btn-outline-primary">Detail</a>
                                    <a href="/pelanggan/edit/<?= $p['slug']; ?>" class="btn btn-outline-warning">Edit</a> -->
                                    <!-- DETAILS -->
                                    <form action="/pelanggan/<?= $p['slug']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method">

                                        <i>
                                            <button type="submit" class="text-info btn-outline-primary fa-solid fa-circle-info p-2 rounded"></button>
                                        </i>

                                    </form>
                                    <!-- EDIT -->
                                    <form action="/pelanggan/edit/<?= $p['slug']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method">
                                        <?php if (in_groups('Admin')) : ?>
                                            <i>
                                                <button type="submit" class="text-info btn-outline-warning fa-solid fa-pen p-2 rounded"></button>
                                            </i>
                                        <?php endif; ?>
                                    </form>
                                    <!-- HAPUS -->
                                    <form action="/pelanggan/<?= $p['id_plg']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?php if (in_groups('Admin')) : ?>
                                            <i>
                                                <button type="submit" class="text-info btn-outline-danger fa-solid fa-trash-can p-2 rounded"></button>
                                            </i>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('tb_pelanggan', 'pelanggan_pgn') ?>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>