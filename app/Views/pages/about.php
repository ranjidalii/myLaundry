<?=  $this->extend('layout/template');?>

<?= $this->section('content');?>
    <div class="container">
        <div class="row">
            <div class="coll">
                <h1>About</h1>
                <p><?= $name;?></p>
            </div>
        </div>
    </div>
<?= $this->endSection();?>