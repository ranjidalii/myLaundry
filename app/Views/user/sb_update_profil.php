<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <h2 class="my-3">Update Profile</h2>
                    <form action="/profil/<?= user_id(); ?>" method="post" enctype="multipart/form-data">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="firstname" class="col-sm-2 col-form-label">Nama Depan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $profil['firstname'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname" class="col-sm-2 col-form-label">Nama Belakang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $profil['lastname'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autofocus value="<?= $profil['username'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="<?= $profil['email'] ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>