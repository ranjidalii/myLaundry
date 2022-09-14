<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - My Laundry</title>

    <!-- <link rel="stylesheet" href="/styles.css"> -->
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <!-- <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/transaksi/cek_transaksi'); ?>">Cek Barcode</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/about'); ?>">About</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav> -->
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <!-- CONTENT -->
            <?= $this->renderSection('content'); ?>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; My Laundry 2022</div>
                        <div>
                            <a href="https://www.instagram.com/ranjid_ali/" target="blank" class="text-decoration-none">Ranjid Ali</a>
                            &middot;
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/assets/js/scripts.js"></script>
</body>

</html>