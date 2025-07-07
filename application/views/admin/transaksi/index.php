<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-exchange-alt text-primary"></i> Transaksi Peminjaman</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <a href="<?php echo site_url('admin/transaksi/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Transaksi</a>
        <form class="form-inline mb-3 float-right" method="get">
            <input type="text" name="q" class="form-control mr-2" placeholder="Cari anggota/buku/status" value="<?php echo htmlspecialchars($keyword); ?>">
            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Pinjam</th>
                        <th>Anggota</th>
                        <th>Judul Buku</th>
                        <th>Status</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + ($page - 1) * $limit;
                    foreach ($transaksi as $t): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($t['pinjam_id']); ?></td>
                            <td><?php echo htmlspecialchars($t['nama_anggota'] ?? $t['anggota_id']); ?></td>
                            <td><?php echo htmlspecialchars($t['judul_buku'] ?? $t['buku_id']); ?></td>
                            <td>
                                <?php if ($t['status'] == 'dipinjam'): ?>
                                    <span class="badge badge-warning">Dipinjam</span>
                                <?php elseif ($t['status'] == 'dikembalikan'): ?>
                                    <span class="badge badge-success">Dikembalikan</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($t['tgl_pinjam']); ?></td>
                            <td><?php echo htmlspecialchars($t['tgl_kembali'] ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/transaksi/detail/' . $t['id_pinjam']); ?>" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i> Detail</a>
                                <?php if ($t['status'] == 'dipinjam'): ?>
                                    <a href="<?php echo site_url('admin/transaksi/return/' . $t['id_pinjam']); ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pengembalian buku?');"><i class="fa fa-undo"></i> Kembalikan</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($transaksi)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-end">
                <?php
                $total_pages = ceil($total / $limit);
                for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?q=<?php echo urlencode($keyword); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>