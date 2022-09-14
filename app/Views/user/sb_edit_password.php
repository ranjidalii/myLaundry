<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="my-3">Ubah Password</h2>
                    <form action="/password/<?= user_id(); ?>" method="post" enctype="multipart/form-data">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="password_lama" class="col-sm-4 col-form-label">Password Lama</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?= ($validation->hasError('password_lama')) ? 'is-invalid' : ''; ?>" id="password_lama" name="password_lama" value="">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password_lama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_baru" class="col-sm-4 col-form-label">Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?= ($validation->hasError('password_baru')) ? 'is-invalid' : ''; ?>" id="password_baru" name="password_baru" value="">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password_baru'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="konfirm_password" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?= ($validation->hasError('konfirm_password')) ? 'is-invalid' : ''; ?>" id="konfirm_password" name="konfirm_password" value="">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('konfirm_password'); ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>