<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Admin - Perpustakaan MA Al-Hijrah'; ?></title>
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
        <!-- Sidebar -->
        <nav class="sidebar p-0">
            <div class="navbar-brand px-3 py-3 mb-2">Perpus MA Al-Hijrah</div>
            <div class="user-panel d-flex align-items-center mb-3">
                <div class="image">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($this->session->userdata('nama')); ?>&background=0073b7&color=fff" class="img-circle" width="40" alt="User Image">
                </div>
                <div class="info ml-2">
                    <span><?php echo $this->session->userdata('nama'); ?></span><br>
                    <small><i class="fa fa-circle text-success"></i> Online</small>
                </div>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'dashboard') ? ' active' : ''; ?>" href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-tachometer-alt mr-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'users') ? ' active' : ''; ?>" href="<?php echo site_url('admin/users'); ?>"><i class="fa fa-users mr-2"></i> Data Pengguna</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'books') ? ' active' : ''; ?>" href="<?php echo site_url('admin/books'); ?>"><i class="fa fa-book mr-2"></i> Data</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'transaksi') ? ' active' : ''; ?>" href="<?php echo site_url('admin/transaksi'); ?>"><i class="fa fa-exchange-alt mr-2"></i> Transaksi</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'denda') ? ' active' : ''; ?>" href="<?php echo site_url('admin/denda'); ?>"><i class="fa fa-money-bill mr-2"></i> Denda</a></li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-text ml-auto">
                        Welcome, <b><?php echo $this->session->userdata('nama'); ?></b> | (<?php echo ucfirst($this->session->userdata('level')); ?>)
                        <a href="<?php echo site_url('auth/logout'); ?>" class="ml-3 btn btn-sm btn-outline-danger">Sign out</a>
                    </span>
                </div>
            </nav>
            <div class="container-fluid mt-4">
                <?php $this->load->view($content_view); ?>
            </div>
        </div>
    </div>
</body>

</html>