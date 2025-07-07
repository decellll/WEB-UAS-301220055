<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Perpustakaan MA Al-Hijrah'; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            min-width: 220px;
            background: #0073b7;
            color: #fff;
            min-height: 100vh;
        }

        .sidebar .nav-link,
        .sidebar .navbar-brand {
            color: #fff;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #005fa3;
            color: #fff;
        }

        .sidebar .user-panel {
            padding: 1.5rem 1rem 1rem 1rem;
        }

        .sidebar .user-panel img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .sidebar .user-panel .info {
            margin-left: 12px;
        }

        .main-content {
            flex: 1;
            padding: 0;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                min-width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-flex flex-column p-0">
            <div class="navbar-brand px-3 py-3 mb-2">Perpus MA Al-Hijrah</div>
            <div class="user-panel d-flex align-items-center mb-3">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($this->session->userdata('nama')); ?>&background=0073b7&color=fff" alt="User Image">
                <div class="info">
                    <span><?php echo $this->session->userdata('nama'); ?></span><br>
                    <small><i class="fa fa-circle text-success"></i> Anggota</small>
                </div>
            </div>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'dashboard') ? ' active' : ''; ?>" href="<?php echo site_url('user/dashboard'); ?>"><i class="fa fa-tachometer-alt mr-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'books') ? ' active' : ''; ?>" href="<?php echo site_url('user/books'); ?>"><i class="fa fa-book mr-2"></i> Data Buku</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'borrowing') ? ' active' : ''; ?>" href="<?php echo site_url('user/borrowing'); ?>"><i class="fa fa-history mr-2"></i> Riwayat Pinjam</a></li>
                <li class="nav-item"><a class="nav-link<?php echo (isset($active_menu) && $active_menu == 'profile') ? ' active' : ''; ?>" href="<?php echo site_url('user/profile'); ?>"><i class="fa fa-user mr-2"></i> Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('auth/logout'); ?>"><i class="fa fa-sign-out-alt mr-2"></i> Logout</a></li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="main-content w-100">
            <nav class="navbar navbar-light bg-white shadow-sm mb-3">
                <span class="navbar-text ml-auto">
                    <i class="fa fa-user-circle mr-2"></i> <?php echo $this->session->userdata('nama'); ?>
                </span>
            </nav>
            <div class="container-fluid">
                <?php $this->load->view($content_view); ?>
            </div>
        </div>
    </div>
</body>

</html>