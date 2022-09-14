<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <h2 class="my-3">Tambah User Baru</h2>
            <form action="/users/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="firstname" class="col-sm-2 col-form-label">Nama Depan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= old('firstname'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="lastname" class="col-sm-2 col-form-label">Nama Belakang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= old('lastname'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" autofocus value="<?= old('username'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email'); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="group" class="col-sm-2 col-form-label">Group</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="group" value="<?= old('group'); ?>">
                            <?php foreach ($groups as $g) : ?>
                                <option value="<?= $g['name']; ?>"><?= $g['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>