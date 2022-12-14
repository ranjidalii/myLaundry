<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
                <a class="navbar-brand" href="<?= base_url('/');?>">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('/dasboard');?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/pelanggan');?>">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/transaksi');?>">Transaksi</a>
                    </li>                   
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/laporan');?>">Laporan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/about');?>">About</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    