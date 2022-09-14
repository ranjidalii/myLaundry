<?= $this->extend('sblayout/template_create_transaksi'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <h2 class="my-3">Laporan</h2>
                    <form action="" method="post" enctype="multipart/form-data" id="tr_form">
                        <?= csrf_field(); ?>
                        <!-- <div class="row mb-3">
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="laporan" value="<?= old('jenkel'); ?>">
                                    <option value="0">Pilih Jenis Laporan</option>
                                    <option value="1">Harian</option>
                                    <option value="2">Bulanan</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <label for="tgl_awal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                            <div class="col-sm-10">
                                <div class="input-group date" id="datePickerAwal">
                                    <input type="text" class="form-control" name="tgl_awal" value="<?= old('tgl_awal'); ?>">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tgl_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                            <div class="col-sm-10">
                                <div class="input-group date" id="datePickerAkhir">
                                    <input type="text" class="form-control" name="tgl_akhir" value="<?= old('tgl_akhir'); ?>">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- <button onclick="hitungTotal()" class="btn btn-success">Hitung</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#datePickerAwal').datepicker();
        $('#datePickerAkhir').datepicker();
    });
</script>

<?= $this->endSection(); ?>