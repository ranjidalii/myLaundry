<?= $this->extend('sblayout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h2 class="my-3">Tambah Data Jasa</h2>
                    <form action="/jasa/save" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row mb-3">
                            <label for="jasa" class="col-sm-2 col-form-label">Jasa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control <?= ($validation->hasError('jasa')) ? 'is-invalid' : ''; ?>" id="jasa" name="jasa" autofocus value="<?= old('jasa'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jasa'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" value="<?= old('harga'); ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="satuan" value="<?= old('satuan'); ?>">
                                    <option value="1">Kg</option>
                                    <option value="2">Pcs</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>