<?= $this->extend('sblayout/template_create_transaksi'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="my-3"><b> Transaksi | <?= $transaksi['kode_tr']; ?> </b></h2>
                    <h6> <small> dibuat oleh : <?= $transaksi['create_by']; ?> </small></h6>
                    <h6> <small> update terkahir : <?= $transaksi['update_by']; ?> </small></h6>
                    <hr class="border border-primary border-2 opacity-50">
                    <form action="/transaksi/update/<?= $transaksi['id_tr']; ?>" method="post" enctype="multipart/form-data" id="tr_form">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id_tr" value="<?= $transaksi['id_tr']; ?>">
                        <div class="row mb-3 ">
                            <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $transaksi['pelanggan']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $transaksi['alamat_plg']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_telp" class="col-sm-4 col-form-label">No Telp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $transaksi['kontak_plg']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_telp" class="col-sm-4 col-form-label">Tanggal Masul</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $transaksi['tgl_masuk']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="qty" class="col-sm-4 col-form-label">Qty (Kg/Pcs) </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="qty" name="qty" value="<?= $transaksi['qty']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jasa" class="col-sm-4 col-form-label">Jasa</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="jasa" name="jasa" value="<?= $transaksi['jasa']; ?>" readonly>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="hrg_jsa" name="hrg_jsa" value="<?= $transaksi['hrg_jsa']; ?> / Qty" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="layanan" class="col-sm-4 col-form-label">Layanan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="layanan" name="layanan" value="<?= $transaksi['layanan']; ?>" readonly>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="hrg_lyn" name="hrg_lyn" value="<?= $transaksi['hrg_lyn']; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Pembayaran" class="col-sm-4 col-form-label">Pembayaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pembayaran" name="pembayaran" <?php if ($transaksi['pembayaran'] === "1") : ?> value="Lunas" class="form-control text-light bg-danger" <?php elseif ($transaksi['pembayaran'] === "2") : ?> value="Saat Pengambilan" <?php endif; ?> readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="status" class="col-sm-4 col-form-label">Status</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <?php if ($transaksi['status'] === "1") : ?>
                                        <option selected value="1">Open (Transaksi dibuat)</option>
                                        <option value="2">Proces (Sedang dikerjakan)</option>
                                        <!-- <option value="3">Waiting (Menunggu Pengambilan)</option>
                                        <option value="4">Close (Selesai)</option> -->
                                    <?php elseif ($transaksi['status'] === "2") : ?>
                                        <!-- <option value="1">Open (Transaksi dibuat)</option> -->
                                        <option selected value="2">Proces (Sedang dikerjakan)</option>
                                        <option value="3">Waiting (Menunggu Pengambilan)</option>
                                        <!-- <option value="4">Close (Selesai)</option> -->
                                    <?php elseif ($transaksi['status'] === "3") : ?>
                                        <!-- <option value="1">Open (Transaksi dibuat)</option>
                                        <option value="2">Proces (Sedang dikerjakan)</option> -->
                                        <option selected value="3">Waiting (Menunggu Pengambilan)</option>
                                        <option value="4">Close (Selesai)</option>
                                    <?php elseif ($transaksi['status'] === "4") : ?>
                                        <!-- <option value="1">Open (Transaksi dibuat)</option>
                                        <option value="2">Proces (Sedang dikerjakan)</option>
                                        <option value="3">Waiting (Menunggu Pengambilan)</option> -->
                                        <option selected value="4">Close (Selesai)</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="total" class="col-sm-4 col-form-label">Total</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="total" name="total" value="<?= $transaksi['total']; ?>" readonly>
                            </div>
                        </div>
                        <a href="/transaksi/" class="btn btn-warning"> Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>