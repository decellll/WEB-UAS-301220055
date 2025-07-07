<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-history text-primary"></i> Riwayat Peminjaman</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Riwayat Peminjaman</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Pinjam</th>
                        <th>Judul Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($r['pinjam_id']); ?></td>
                            <td><?php echo htmlspecialchars($r['judul_buku'] ?? '-'); ?></td>
                            <td><?php echo htmlspecialchars($r['tgl_pinjam']); ?></td>
                            <td><?php echo htmlspecialchars($r['tgl_kembali'] ?? '-'); ?></td>
                            <td>
                                <?php if ($r['status'] == 'dipinjam'): ?>
                                    <span class="badge badge-warning">Dipinjam</span>
                                <?php elseif ($r['status'] == 'dikembalikan'): ?>
                                    <span class="badge badge-success">Dikembalikan</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($riwayat)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada riwayat peminjaman.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>