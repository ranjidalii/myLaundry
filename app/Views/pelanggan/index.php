<?= $this->extend('layout/template') ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/pelanggan/create" class="btn btn-primary mt-3">Tambah Pelanggan</a>
            <h1 class="mt-2">Daftar Pelanggan</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover table-sm table-bordered border-primary table align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody style="font-size:10pt">
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($pelanggan as $p) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td><?= $p['no_telp']; ?></td>
                            <?php if ($p['jenkel'] == 1) : ?>
                                <td>Laki - Laki</td>
                            <?php else : ?>
                                <td>Perempuan</td>
                            <?php endif; ?>
                            <td><?= date("d F Y", strtotime($p['tgl_lahir'])); ?></td>
                            <td>
                                <a href="/pelanggan/<?= $p['slug']; ?>" class="btn btn-success"> Detail </a>
                                <a href="/pelanggan/edit/<?= $p['slug']; ?>" class="btn btn-warning">Edit</a>
                                <form action="/pelanggan/<?= $p['id_plg']; ?>" method="post" class="d-inline">
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
            <?= $pager->links('tb_pelanggan', 'pelanggan_pgn') ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>