<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-info-circle text-primary"></i> Detail Transaksi</h4>
    <a href="<?php echo site_url('admin/transaksi'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/transaksi'); ?>">Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
</nav>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <?php if (!$transaksi): ?>
            <div class="alert alert-danger">Data transaksi tidak ditemukan.</div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Data Anggota</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama: <b><?php echo htmlspecialchars($transaksi['nama_anggota']); ?></b></li>
                        <li class="list-group-item">Username: <?php echo htmlspecialchars($transaksi['username']); ?></li>
                        <li class="list-group-item">Email: <?php echo htmlspecialchars($transaksi['email']); ?></li>
                        <li class="list-group-item">Level: <?php echo htmlspecialchars($transaksi['level']); ?></li>
                    </ul>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Data Buku</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Judul: <b><?php echo htmlspecialchars($transaksi['judul_buku']); ?></b></li>
                        <li class="list-group-item">ISBN: <?php echo htmlspecialchars($transaksi['isbn']); ?></li>
                        <li class="list-group-item">Penerbit: <?php echo htmlspecialchars($transaksi['penerbit']); ?></li>
                        <li class="list-group-item">Pengarang: <?php echo htmlspecialchars($transaksi['pengarang']); ?></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Status Peminjaman</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Kode Pinjam: <b><?php echo htmlspecialchars($transaksi['pinjam_id']); ?></b></li>
                        <li class="list-group-item">Status: <?php if ($transaksi['status'] == 'dipinjam'): ?><span class="badge badge-warning">Dipinjam</span><?php elseif ($transaksi['status'] == 'dikembalikan'): ?><span class="badge badge-success">Dikembalikan</span><?php else: ?><span class="badge badge-secondary">-</span><?php endif; ?></li>
                        <li class="list-group-item">Tanggal Pinjam: <?php echo htmlspecialchars($transaksi['tgl_pinjam']); ?></li>
                        <li class="list-group-item">Tanggal Kembali: <?php echo htmlspecialchars($transaksi['tgl_kembali'] ?? '-'); ?></li>
                        <li class="list-group-item">Tanggal Harus Kembali: <?php echo htmlspecialchars($transaksi['tgl_balik'] ?? '-'); ?></li>
                    </ul>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Denda</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nominal Denda: <b><?php echo $transaksi['denda'] ? 'Rp ' . number_format($transaksi['denda'], 0, ',', '.') : '-'; ?></b></li>
                        <li class="list-group-item">Lama Waktu: <?php echo $transaksi['lama_waktu'] ? $transaksi['lama_waktu'] . ' hari' : '-'; ?></li>
                        <li class="list-group-item">Tanggal Denda: <?php echo $transaksi['tgl_denda'] ?? '-'; ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>