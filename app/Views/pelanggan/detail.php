<?= $this->extend('layout/template'); ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Pelanggan</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $pelanggan['nama']; ?></h5>
                            <p class="card-text"><b>Alamat: </b><?= $pelanggan['alamat']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Kontak : </b><?= $pelanggan['no_telp']; ?></small></p>
                            <a href="/pelanggan/edit/<?= $pelanggan['slug']; ?>" class="btn btn-warning">Edit</a>
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

<?= $this->endSection(); ?>