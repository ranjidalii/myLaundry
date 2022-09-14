<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>
    <a href="/transaksi/create" class="btn btn-primary mb-3">Transaksi Baru</a>

    <a href="/transaksi" class="btn btn-secondary mb-3">Semua Transaksi
        <span class="badge text-bg-danger"><?= $jmlSemuaTransaksi; ?></span>
    </a>
    <a href="/transaksi/open" class="btn btn-danger mb-3">Transaksi Open
        <span class="badge text-bg-danger"><?= $jmlTransaksiOpen; ?></span>
    </a>
    <a href="/transaksi/process" class="btn btn-warning mb-3">Transaksi Process
        <span class="badge text-bg-danger"><?= $jmlTransaksiProcess; ?></span>
    </a>
    <a href="/transaksi/waiting" class="btn btn-primary mb-3">Transaksi Waiting
        <span class="badge text-bg-danger"><?= $jmlTransaksiWaiting; ?></span>
    </a>
    <a href="/transaksi/success" class="btn btn-success mb-3">Transaksi Success
        <span class="badge text-bg-danger"><?= $jmlTransaksiSukses; ?></span>
    </a>

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
                            <th>Barcode</th>
                            <th>Nama</th>
                            <!-- <th scope="col">Alamat</th> -->
                            <!-- <th scope="col">No Telp</th> -->
                            <th>Tanggal Masuk</th>
                            <th>Jasa</th>
                            <th>Layanan</th>
                            <th>Qty</th>
                            <!-- <th scope="col">Harga Jasa</th> -->
                            <!-- <th scope="col">Harga Layanan</th> -->
                            <th>Estimasi</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Nama</th>
                            <!-- <th scope="col">Alamat</th> -->
                            <!-- <th scope="col">No Telp</th> -->
                            <th>Tanggal Masuk</th>
                            <th>Jasa</th>
                            <th>Layanan</th>
                            <th>Qty</th>
                            <!-- <th scope="col">Harga Jasa</th> -->
                            <!-- <th scope="col">Harga Layanan</th> -->
                            <th>Estimasi</th>
                            <th>Total</th>
                            <th>Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody style="font-size:10pt">
                        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td class="text-center"><?= $t['kode_tr']; ?></td>
                                <td><?= $t['pelanggan']; ?></td>
                                <!-- <td><?= $t['alamat_plg']; ?></td> -->
                                <!-- <td><?= $t['kontak_plg']; ?></td> -->
                                <td class="text-center"><?= date('d F Y', strtotime($t['tgl_masuk'])); ?></td>
                                <td><?= $t['jasa']; ?></td>
                                <td><?= $t['layanan']; ?></td>
                                <td class="text-center"><?= $t['qty']; ?></td>
                                <!-- <td>Harga Jasa</td> -->
                                <!-- <td>Harga Layanan</td> -->
                                <td class="text-center"><?= $t['estimasi']; ?></td>
                                <td><?= $t['total']; ?></td>
                                <?php if ($t['pembayaran'] == 1) : ?>
                                    <td>Lunas</td>
                                <?php else : ?>
                                    <td>Saat pengambilan</td>
                                <?php endif; ?>
                                <?php if ($t['status'] == 1) : ?>
                                    <td class="bg-danger text-light text-center">Open</td>
                                <?php elseif ($t['status'] == 2) : ?>
                                    <td class="bg-warning text-light text-center">Process</td>
                                <?php elseif ($t['status'] == 3) : ?>
                                    <td class="bg-primary text-light text-center">Waiting</td>
                                <?php elseif ($t['status'] == 4) : ?>
                                    <td class="bg-success text-light text-center">Close</td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <form action="/transaksi/edit/<?= $t['id_tr']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method">
                                        <i>
                                            <button type="submit" class="text-info btn-outline-primary fa-solid fa-pen p-2 rounded"></button>
                                        </i>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('tb_transaksi', 'pelanggan_pgn') ?>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>