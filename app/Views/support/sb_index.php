<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h2 class="my-3">Kiritik & Saran</h2>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <form action="/support/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama'); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= old('no_telp'); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="feedback" class="col-sm-2 form-label">Feedback</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="feedback" name="feedback" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>