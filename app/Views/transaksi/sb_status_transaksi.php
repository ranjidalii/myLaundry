<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2 class="my-3">Status Transaksi</h2>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">No Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_tr" name="no_tr" value="<?= $cek_tr['kode_tr']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $cek_tr['pelanggan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" id="status" name="status" <?php if ($cek_tr['status'] == 1) : ?> value="Open - Transaksi dibuat" class="form-control text-light bg-danger" <?php elseif ($cek_tr['status'] == 2) : ?> value="Process - Sedang dikerjakan" class="form-control text-light bg-warning" <?php elseif ($cek_tr['status'] == 3) : ?> value="Waiting - Menunggu pengambilan" class="form-control text-light bg-primary" <?php elseif ($cek_tr['status'] == 4) : ?> value="Close - Transaksi selesai" class="form-control text-light bg-success" <?php endif; ?> readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>