<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Perpustakaan MA Al-Hijrah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: #3c8dbc;
            color: #fff;
        }

        .sidebar .nav-link,
        .sidebar .navbar-brand {
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #367fa9;
        }

        .stat-box {
            border-radius: 8px;
            color: #fff;
            padding: 24px 16px;
            margin-bottom: 24px;
        }

        .stat-anggota {
            background: #00c0ef;
        }

        .stat-kategori {
            background: #0073b7;
        }

        .stat-pinjam {
            background: #00a65a;
        }

        .stat-kembali {
            background: #dd4b39;
        }

        .stat-box .icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 16px;
            top: 16px;
        }

        .stat-box .more {
            color: #fff;
            text-decoration: underline;
        }

        .sidebar .user-panel {
            padding: 16px;
        }

        .sidebar .user-panel .image {
            float: left;
            margin-right: 10px;
        }

        .sidebar .user-panel .info {
            float: left;
        }

        .sidebar .user-panel:after {
            content: "";
            display: block;
            clear: both;
        }
    </style>
</head>

<body>
    <div class="d-flex">

        <!-- Main Content -->
        <div class="flex-grow-1">
            <div class="container-fluid mt-4">
                <h4 class="mb-4">Dashboard <small class="text-muted">Control panel</small></h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="stat-box stat-anggota position-relative" style="background:#00c0ef; color:#fff; border-radius:8px; padding:24px 16px; margin-bottom:24px;">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h2><?php echo $total_anggota; ?></h2>
                                    <p>Anggota</p>
                                </div>
                                <span class="icon" style="font-size:2.5rem; opacity:0.3; position:absolute; right:16px; top:16px;"><i class="fa fa-users"></i></span>
                            </div>
                            <a href="#" class="more" style="color:#fff; text-decoration:underline;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-box stat-kategori position-relative" style="background:#0073b7; color:#fff; border-radius:8px; padding:24px 16px; margin-bottom:24px;">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h2><?php echo $total_kategori; ?></h2>
                                    <p>Jenis Buku</p>
                                </div>
                                <span class="icon" style="font-size:2.5rem; opacity:0.3; position:absolute; right:16px; top:16px;"><i class="fa fa-book"></i></span>
                            </div>
                            <a href="#" class="more" style="color:#fff; text-decoration:underline;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-box stat-pinjam position-relative" style="background:#00a65a; color:#fff; border-radius:8px; padding:24px 16px; margin-bottom:24px;">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h2><?php echo $total_pinjam; ?></h2>
                                    <p>Pinjam</p>
                                </div>
                                <span class="icon" style="font-size:2.5rem; opacity:0.3; position:absolute; right:16px; top:16px;"><i class="fa fa-exchange-alt"></i></span>
                            </div>
                            <a href="#" class="more" style="color:#fff; text-decoration:underline;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-box stat-kembali position-relative" style="background:#dd4b39; color:#fff; border-radius:8px; padding:24px 16px; margin-bottom:24px;">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h2><?php echo $total_kembali; ?></h2>
                                    <p>Di Kembalikan</p>
                                </div>
                                <span class="icon" style="font-size:2.5rem; opacity:0.3; position:absolute; right:16px; top:16px;"><i class="fa fa-undo"></i></span>
                            </div>
                            <a href="#" class="more" style="color:#fff; text-decoration:underline;">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="text-center mt-5 mb-3 text-muted">
                <small>Copyright &copy; <?php echo date('Y'); ?> Sistem Informasi Perpustakaan All rights | Page rendered in {elapsed_time} seconds.</small>
            </footer>
        </div>
    </div>
</body>

</html>