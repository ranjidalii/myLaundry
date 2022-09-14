<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="my-3">Transaksi Baru</h2>
            <form action="/transaksi/save" method="post" enctype="multipart/form-data" id="tr_form">
                <?= csrf_field(); ?>
                <div class="row mb-3 ">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="nama" name="nama">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <a href="/pelanggan/create" class="btn btn-success pull-right"> Tambah Baru </a>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_telp" name="no_telp" readonly>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="qty" class="col-sm-2 col-form-label">Qty (Kg/Pcs) </label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="qty" name="qty" onkeyup="ambilQty()">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jasa" class="col-sm-2 col-form-label">Jasa</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="jasa" id="jasa">">
                            <option data-hrg_jsa="0"> Pilih Jasa</option>
                            <?php foreach ($jasa as $j) : ?>
                                <option data-hrg_jsa="<?= $j['harga']; ?>" value="<?= $j['jasa']; ?>|<?= $j['harga']; ?>|<?= $j['satuan'] ?>"><?= $j['jasa']; ?> [ <?= $j['harga']; ?> / <?= $j['satuan'] == 1 ? "Kg" : "Pcs"; ?> ]</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="layanan" class="col-sm-2 col-form-label">Layanan</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="layanan" id="layanan">
                            <option data-hrg_lyn="0"> Pilih Layanan</option>
                            <?php foreach ($layanan as $l) : ?>
                                <option data-hrg_lyn="<?= $l['harga']; ?>" value="<?= $l['layanan']; ?>|<?= $l['estimasi']; ?>|<?= $l['st_esti'] ?>|<?= $l['harga']; ?>"><?= $l['layanan']; ?> - <?= $l['harga']; ?> - [ <?= $l['estimasi']; ?> <?= $l['st_esti'] == 1 ? "Jam" : "Hari"; ?> ]</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="row mb-3">
                    <label for="Pembayaran" class="col-sm-2 col-form-label">Pembayaran</label>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pembayaran" id="lunas" value="1">
                            <label class="form-check-label" for="lunas">
                                Lunas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pembayaran" id="pengambilan" value="2">
                            <label class="form-check-label" for="pengambilan">
                                Saat Pengambilan
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="total" class="col-sm-2 col-form-label">Total</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="total" name="total" readonly>
                    </div>
                </div>

                <button onclick="hitungTotal()" type="button" class="btn btn-success">Hitung</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <button onclick="formReset()" type="button" class="btn btn-danger">Reset</button>
            </form>
            <!-- <button onclick="hitungTotal()" class="btn btn-success">Hitung</button> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    // var array_ku = ["ranjid", "Rani", "rana", "Reni", "Deni", "Dani", "joko", "dori", "beno"];
    let qty;
    let hrgJsa;
    let hrgLyn;
    let totalHarga;
    let estimasi

    $(document).ready(function() {
        $('#nama').autocomplete({
            source: "<?= base_url('/transaksi/get_nama/?'); ?>",
            // source : array_ku               
            select: function(event, ui) {
                $('[name="nama"]').val(ui.item.label);
                $('[name="alamat"]').val(ui.item.alamat);
                $('[name="no_telp"]').val(ui.item.no_telp);
            }
        });
    });

    // Ambil qty 
    function ambilQty() {
        $('input:radio').prop('checked', false);
        qty = 0
        qty = document.getElementById("qty").value;
        if (qty == "") {
            qty = 0;
        }
        qty = parseInt(qty);
        // console.log(qty); 
    }

    const data = $('#main').data('loading');

    // Ambil harga layanan
    $('#layanan').on('click', function() {
        $('input:radio').prop('checked', false);
        hrgLyn = parseInt($('#layanan option:selected').data('hrg_lyn'));
        // console.log(hrgLyn);
    });

    // Ambil harga jasa
    $('#jasa').on('click', function() {
        $('input:radio').prop('checked', false);
        hrgJsa = parseInt($('#jasa option:selected').data('hrg_jsa'));
        // console.log(hrgJsa);
    });

    // Hitung total
    function hitungTotal() {
        console.log(qty);
        totalHarga;
        totalHarga = (qty * hrgJsa) + hrgLyn;
        document.getElementById("total").value = totalHarga;
        //  console.log(totalHarga);
    }

    // Fungsi form reset
    function formReset() {
        document.getElementById("tr_form").reset();
    }
</script>
<!-- relokasi disi -->
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<?= $this->endSection(); ?>