<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan MA Al-Hijrah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Perpustakaan MA Al-Hijrah</a>
        <div class="ml-auto">
            <span class="navbar-text text-white mr-3">Halo, <?php echo $this->session->userdata('nama'); ?> (<?php echo $this->session->userdata('user'); ?>)</span>
            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Selamat Datang, <?php echo $this->session->userdata('nama'); ?>!</h1>
            <p class="lead">Ini adalah dashboard admin perpustakaan MA Al-Hijrah.</p>
            <hr class="my-4">
            <p>Silakan gunakan menu di atas untuk mengelola data perpustakaan.</p>
        </div>
    </div>
</body>

</html>