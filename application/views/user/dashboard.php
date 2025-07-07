<div class="container-fluid py-3">
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="mb-1">Selamat Datang, <b><?php echo htmlspecialchars($user['nama']); ?></b>!</h4>
            <p class="text-muted mb-0">Dashboard Anggota Perpustakaan MA Al-Hijrah</p>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['nama']); ?>&background=0073b7&color=fff" class="rounded-circle" width="70" height="70" alt="User">
                    </div>
                    <h6 class="mb-0"><?php echo htmlspecialchars($user['nama']); ?></h6>
                    <small class="text-muted">Username: <?php echo htmlspecialchars($user['user']); ?></small><br>
                    <small class="text-muted">Email: <?php echo htmlspecialchars($user['email'] ?? '-'); ?></small>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-primary shadow-sm">
                        <div class="card-body text-center">
                            <div class="h2 mb-0"><?php echo $total_buku; ?></div>
                            <div>Total Buku</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-warning shadow-sm">
                        <div class="card-body text-center">
                            <div class="h2 mb-0"><?php echo $dipinjam; ?></div>
                            <div>Buku Dipinjam</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body text-center">
                            <div class="h2 mb-0"><?php echo $dikembalikan; ?></div>
                            <div>Buku Dikembalikan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white"><b>Histori Peminjaman Terakhir</b></div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Kode Pinjam</th>
                                    <th>Judul Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($histori)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada histori peminjaman.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($histori as $h): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($h['kode_pinjam'] ?? $h['id_pinjam'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($h['judul_buku'] ?? '-'); ?></td>
                                            <td><?php echo htmlspecialchars($h['tgl_pinjam']); ?></td>
                                            <td><?php echo htmlspecialchars($h['tgl_kembali'] ?? '-'); ?></td>
                                            <td>
                                                <?php if ($h['status'] == 'dipinjam'): ?>
                                                    <span class="badge badge-warning">Dipinjam</span>
                                                <?php elseif ($h['status'] == 'dikembalikan'): ?>
                                                    <span class="badge badge-success">Dikembalikan</span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>