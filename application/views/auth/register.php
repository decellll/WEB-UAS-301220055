<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Perpustakaan MA Al-Hijrah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Register Anggota/Admin</h4>
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form method="post" action="<?php echo site_url('auth/register'); ?>">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user">Username</label>
                                    <input type="text" class="form-control" id="user" name="user" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="level">Level</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">-- Pilih Level --</option>
                                        <option value="admin">Admin</option>
                                        <option value="siswa">Siswa</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telpon">Telpon</label>
                                    <input type="text" class="form-control" id="telpon" name="telpon">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                            <a href="<?php echo site_url('auth'); ?>" class="btn btn-link btn-block">Sudah punya akun? Login</a>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-muted">&copy; <?php echo date('Y'); ?> MA Al-Hijrah</p>
            </div>
        </div>
    </div>
</body>

</html>