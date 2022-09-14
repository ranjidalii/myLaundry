<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <h2 class="my-3">Informasi Laundry</h2>
                    <?php if (session()->getFlashdata('pesan')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('pesan'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($profil != null) : ?>
                        <form action="/setting/update/<?= $profil['id_sett'] ?>" method="post" enctype="multipart/form-data">
                        <?php else : ?>
                            <form action="/setting/save" method="post" enctype="multipart/form-data">
                            <?php endif; ?>
                            <?= csrf_field(); ?>

                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <?php if ($profil != null) : ?>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $profil['nama'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" id="nama" name="nama" value="">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="slogan" class="col-sm-2 col-form-label">Slogan</label>
                                <div class="col-sm-10">
                                    <?php if ($profil != null) : ?>
                                        <input type="text" class="form-control" id="slogan" name="slogan" value="<?= $profil['slogan'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" id="slogan" name="slogan" value="">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <?php if ($profil != null) : ?>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $profil['alamat'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" id="alamat" name="alamat" value="">
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                                <div class="col-sm-10">
                                    <?php if ($profil != null) : ?>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $profil['no_telp'] ?>">
                                    <?php else : ?>
                                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="">
                                    <?php endif; ?>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Apply</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>