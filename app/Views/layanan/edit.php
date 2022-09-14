<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="my-3">Edit Data Layanan</h2>
                <form action="/layanan/update/<?= $layanan['id_lyn']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field();?>
                    <input type="hidden" name="slug" value="<?= $layanan['slug']; ?>"> 
                    <div class="row mb-3">
                        <label for="layanan" class="col-sm-2 col-form-label">Layanan</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('layanan')) ? 'is-invalid' : '' ; ?>" id="layanan" name="layanan" autofocus value="<?= (old('layanan')) ? old('layanan') : $layanan['layanan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('layanan');?>
                        </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="harga" name="harga" value="<?= (old('harga')) ? old('harga') : $layanan['harga']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="estimasi" class="col-sm-2 col-form-label">Estimasi</label>
                        <div class="col-5">
                            <input type="text" class="form-control" id="estimasi" name="estimasi" value="<?= (old('estimasi')) ? old('estimasi') : $layanan['estimasi'];?>">
                        </div>
                        <div class="col-5">
                        <select class="form-select" aria-label="Default select example" name="st_esti" value="<?= old('st_esti');?>">
                            <?php if ($layanan['st_esti'] == 1): ?>
                                <option selected value="1">Jam</option>
                                <option value="2">Hari</option>
                            <?php else :?>
                                <option value="1">Jam</option>
                                <option selected value="2">Hari</option>
                            <?php endif ;?>
                            </select>
                        </div>
                    </div>

                    <a href="/layanan/" class="btn btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection();?>