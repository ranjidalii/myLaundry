<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="my-3">Edit Data Pelanggan</h2>
                <form action="/pelanggan/update/<?= $pelanggan['id_plg']; ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field();?>
                    <input type="hidden" name="slug" value="<?= $pelanggan['slug']; ?>"> 
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ; ?>" id="nama" name="nama" autofocus value="<?= (old('nama')) ? old('nama') : $pelanggan['nama']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama');?>
                        </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $pelanggan['alamat']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $pelanggan['no_telp']; ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="jenkel" value="<?= old('jenkel');?>">
                            <?php if ($pelanggan['jenkel'] == 1): ?>
                                <option selected value="1">Laki - laki</option>
                                <option value="2">Perempuan</option>
                            <?php else :?>
                                <option value="1">Laki - laki</option>
                                <option selected value="2">Perempuan</option>
                            <?php endif ;?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal lahir</label>
                        <div class="col-sm-10">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="tgl_lahir"  value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : date("d/m/Y",strtotime($pelanggan['tgl_lahir'])); ?>">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <a href="/pelanggan/<?= $pelanggan['slug'];?>" class="btn btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('#datepicker').datepicker();
        });
    </script>

<?= $this->endSection();?>