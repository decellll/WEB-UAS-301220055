<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($mode == 'add' ? 'Tambah' : 'Update'); ?> User - Perpustakaan MA Al-Hijrah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .form-section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 32px 24px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 0;
        }

        .btn-primary {
            background: #007bff;
            border: none;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
        }

        .profile-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-preview img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0073b7;
            margin-bottom: 10px;
        }

        .form-label {
            font-weight: 500;
        }
    </style>
</head>

<body style="background:#f4f6f9;">
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0"><i class="fa fa-user-plus text-success"></i> <?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> User</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/users'); ?>">Data Anggota</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> User</li>
                        </ol>
                    </nav>
                </div>
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pengguna</label>
                                        <input type="text" name="nama" class="form-control" value="<?php echo isset($user['nama']) ? htmlspecialchars($user['nama']) : set_value('nama'); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="<?php echo isset($user['tempat_lahir']) ? htmlspecialchars($user['tempat_lahir']) : set_value('tempat_lahir'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" value="<?php echo isset($user['tgl_lahir']) ? $user['tgl_lahir'] : set_value('tgl_lahir'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="user" class="form-control" value="<?php echo isset($user['user']) ? htmlspecialchars($user['user']) : set_value('user'); ?>" <?php echo ($mode == 'edit') ? 'readonly' : 'required'; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>Password (opsional)</label>
                                        <input type="password" name="password" class="form-control" autocomplete="new-password">
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="level" class="form-control" required>
                                            <option value="">-- Pilih Level --</option>
                                            <option value="admin" <?php echo (isset($user['level']) && $user['level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            <option value="siswa" <?php echo (isset($user['level']) && $user['level'] == 'siswa') ? 'selected' : ''; ?>>Anggota</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki" <?php echo (isset($user['jenis_kelamin']) && $user['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="jk1">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan" <?php echo (isset($user['jenis_kelamin']) && $user['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="jk2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telpon</label>
                                        <input type="text" name="telpon" class="form-control" value="<?php echo isset($user['telpon']) ? htmlspecialchars($user['telpon']) : set_value('telpon'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo isset($user['email']) ? htmlspecialchars($user['email']) : set_value('email'); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Pas Foto</label>
                                        <input type="file" name="foto" class="form-control-file mb-2">
                                        <div class="text-center">
                                            <?php if (isset($user['foto']) && $user['foto']): ?>
                                                <img src="<?php echo base_url('uploads/foto/' . $user['foto']); ?>" alt="Foto Profil" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                            <?php else: ?>
                                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama'] ?? 'User'); ?>&background=0073b7&color=fff" alt="Foto Profil" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="2"><?php echo isset($user['alamat']) ? htmlspecialchars($user['alamat']) : set_value('alamat'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> <?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> Data</button>
                                <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>