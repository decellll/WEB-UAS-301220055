<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-user text-primary"></i> Profil Saya</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil</li>
    </ol>
</nav>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center mb-3">
                <?php if (!empty($user['foto'])): ?>
                    <img src="<?php echo base_url('uploads/foto/' . $user['foto']); ?>" class="rounded-circle mb-2" style="width:120px;height:120px;object-fit:cover;">
                <?php else: ?>
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama'] ?? $user['user']); ?>&background=0073b7&color=fff" class="rounded-circle mb-2" style="width:120px;height:120px;object-fit:cover;">
                <?php endif; ?>
                <h5 class="mt-2 mb-0"><?php echo htmlspecialchars($user['nama']); ?></h5>
                <small class="text-muted">Anggota</small>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th>Username</th>
                        <td><?php echo htmlspecialchars($user['user']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td><?php echo htmlspecialchars($user['level']); ?></td>
                    </tr>
                    <tr>
                        <th>Tempat, Tgl Lahir</th>
                        <td><?php echo htmlspecialchars($user['tempat_lahir']); ?>, <?php echo htmlspecialchars($user['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td><?php echo htmlspecialchars($user['jenis_kelamin']); ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?php echo htmlspecialchars($user['alamat']); ?></td>
                    </tr>
                    <tr>
                        <th>Telpon</th>
                        <td><?php echo htmlspecialchars($user['telpon']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>