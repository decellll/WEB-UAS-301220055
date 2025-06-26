<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna - Perpustakaan MA Al-Hijrah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Data Pengguna</h4>
            <a href="<?php echo site_url('admin/users/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah User</a>
        </div>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <form class="form-inline mb-3" method="get">
            <input type="text" name="q" class="form-control mr-2" placeholder="Cari nama/username/email" value="<?php echo htmlspecialchars($keyword); ?>">
            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th>Telpon</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($u['nama']); ?></td>
                            <td><?php echo htmlspecialchars($u['user']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo ucfirst($u['level']); ?></td>
                            <td><?php echo htmlspecialchars($u['telpon']); ?></td>
                            <td>
                                <?php if ($u['foto']): ?>
                                    <img src="<?php echo base_url('uploads/foto/' . $u['foto']); ?>" width="40" class="rounded-circle">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('admin/users/edit/' . $u['id_login']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo site_url('admin/users/delete/' . $u['id_login']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>