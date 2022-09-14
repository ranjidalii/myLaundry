<?= $this->extend('layout/template')?>

<?= $this->section('content');?>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="/transaksi/create" class="btn btn-primary mt-3">Transaksi Baru</a>
                <h1 class="mt-2">Daftar Transaksi</h1>
                <?php if(session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                       <?= session()->getFlashdata('pesan');?>
                    </div>
                <?php endif; ?>
                <table class="table table-hover table-sm table-bordered border-primary table align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Barcode</th>
                            <th scope="col">Nama</th>
                            <!-- <th scope="col">Alamat</th> -->
                            <!-- <th scope="col">No Telp</th> -->
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Jasa</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Qty</th>
                            <!-- <th scope="col">Harga Jasa</th> -->
                            <!-- <th scope="col">Harga Layanan</th> -->
                            <th scope="col">Estimasi</th>
                            <th scope="col">Total</th>
                            <th scope="col">Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:10pt">
                    <?php $i = 1;?>
                        <?php foreach($transaksi as $t):?>
                            <tr>
                                <th scope="row"><?= $i++;?></th>
                                <td class="text-center"><?=$t['kode_tr'];?></td>
                                <td><?=$t['pelanggan'];?></td>
                                <!-- <td><?=$t['alamat_plg'];?></td> -->
                                <!-- <td><?=$t['kontak_plg'];?></td> -->
                                <td class="text-center"><?=date('d F Y', strtotime($t['tgl_masuk']));?></td>
                                <td><?=$t['jasa'];?></td>
                                <td><?=$t['layanan'];?></td>
                                <td class="text-center"><?=$t['qty'];?></td>
                                <!-- <td>Harga Jasa</td> -->
                                <!-- <td>Harga Layanan</td> -->
                                <td class="text-center"><?=$t['estimasi'];?></td>
                                <td><?=$t['total'];?></td>
                                <?php if ($t['pembayaran'] == 1): ?>
                                    <td>Lunas</td>
                                <?php else :?>
                                    <td>Saat pengambilan</td>
                                <?php endif ;?>
                                <?php if ($t['status'] == 1): ?>
                                    <td class="bg-danger text-light text-center" >Open</td>
                                <?php elseif($t['status'] == 2):?>
                                    <td class="bg-warning text-light text-center">Process</td>
                                <?php elseif($t['status'] == 3):?>
                                    <td class="bg-success text-light text-center">Close</td>
                                <?php endif ;?>
                                <td class="text-center">
                                    <a href="#" class="btn btn-success"> Detail </a>
                                </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?= $this->endSection();?>
