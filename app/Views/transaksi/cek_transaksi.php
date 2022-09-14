<?= $this->extend('layout/template');?>

<?= $this->section('content');?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Cek Transaksi</h2>
            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesan');?>
                    <?= session()->destroy();?>
                </div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data" >
                <?= csrf_field();?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukan No Transaksi" id="no_tr" name="no_tr">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
                    </div>
                </div>               
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>

<?= $this->endSection();?>