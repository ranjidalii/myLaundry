    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand text-light" href="<?= base_url('/'); ?>">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/pelanggan'); ?>">Pelanggan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/transaksi'); ?>">Transaksi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/jasa'); ?>">Jasa</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/layanan'); ?>">Layanan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/laporan'); ?>">Laporan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/transaksi/cek_transaksi'); ?>">Cek Barcode</a>
                    </li>

                    <?php if (in_groups('Admin')) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= base_url('/users'); ?>">User</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?= base_url('/about'); ?>">About</a>
                    </li>

                    <?php if (user()) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-light"> Hi : <?= user()->firstname; ?> </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <?php if (logged_in()) : ?>
                            <a class="nav-link btn btn-outline-light rounded-pill" href="<?= base_url('/logout'); ?>">Logout</a>
                        <?php else : ?>
                            <a class="nav-link btn btn-outline-success rounded-pill" href="<?= base_url('/login'); ?>">Login</a>
                        <?php endif; ?>
                    </li>

                </ul>
            </div>
        </div>
    </nav>