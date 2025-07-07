<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-money-bill text-primary"></i> Data Denda</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Denda</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <div class="alert alert-info mb-3">Denda keterlambatan adalah <b>Rp 5.000 per hari</b>. Denda akan muncul otomatis jika peminjaman terlambat dikembalikan.</div>
        <form class="form-inline mb-3 float-right" method="get">
            <input type="text" name="q" class="form-control mr-2" placeholder="Cari anggota/buku/kode pinjam" value="<?php echo htmlspecialchars($keyword); ?>">
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
                        <th>Nominal Denda</th>
                        <th>Lama (hari)</th>
                        <th>Tgl Denda</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + ($page - 1) * $limit;
                    foreach ($denda as $d): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($d['pinjam_id']); ?></td>
                            <td><?php echo htmlspecialchars($d['nama_anggota'] ?? $d['anggota_id']); ?></td>
                            <td><?php echo htmlspecialchars($d['judul_buku'] ?? '-'); ?></td>
                            <td><?php echo $d['denda'] ? 'Rp ' . number_format($d['denda'], 0, ',', '.') : '-'; ?></td>
                            <td><?php echo $d['lama_waktu'] ? $d['lama_waktu'] : '-'; ?></td>
                            <td><?php echo htmlspecialchars($d['tgl_denda'] ?? '-'); ?></td>
                            <td>
                                <?php if (isset($d['status']) && $d['status'] == 'lunas'): ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('admin/denda/detail/' . $d['id_denda']); ?>" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i> Detail</a>
                                <?php if (!isset($d['status']) || $d['status'] != 'lunas'): ?>
                                    <a href="<?php echo site_url('admin/denda/confirm/' . $d['id_denda']); ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi denda sudah dibayar?');"><i class="fa fa-check"></i> Konfirmasi</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($denda)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data denda.</td>
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