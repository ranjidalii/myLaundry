<?= $this->extend('sblayout/template') ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h2 class="mt-2">Detail Pelanggan</h2>
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?= $pelanggan['nama']; ?></b> |
                                        <?php if ($pelanggan['jenkel'] == 1) : ?>
                                            <small>Laki - laki</small>
                                        <?php else : ?>
                                            <small>Perempuan</small>
                                        <?php endif; ?>
                                    </h5>
                                    <p class="card-text"><b>Alamat : </b><?= $pelanggan['alamat']; ?></p>
                                    <p class="card-text"><b>Tanggal Lahir : </b><?= date("d F Y", strtotime($pelanggan['tgl_lahir'])); ?></p>
                                    <p class="card-text"><b>Kontak : </b><?= $pelanggan['no_telp']; ?></p>
                                    <?php if (in_groups('Admin')) : ?>
                                        <a href="/pelanggan/edit/<?= $pelanggan['slug']; ?>" class="btn btn-warning">Edit</a>
                                    <?php endif; ?>
                                    <form action="/pelanggan/<?= $pelanggan['id_plg']; ?>" method="post" class="d-inline">
                                        <? csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <?php if (in_groups('Admin')) : ?>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        <?php endif; ?>
                                    </form>
                                    <a href="/pelanggan" class="btn btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>