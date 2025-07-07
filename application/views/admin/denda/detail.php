<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-info-circle text-primary"></i> Detail Denda</h4>
    <a href="<?php echo site_url('admin/denda'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/denda'); ?>">Denda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
</nav>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <?php if (!$denda): ?>
            <div class="alert alert-danger">Data denda tidak ditemukan.</div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Data Anggota</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama: <b><?php echo htmlspecialchars($denda['nama_anggota']); ?></b></li>
                        <li class="list-group-item">Username: <?php echo htmlspecialchars($denda['username']); ?></li>
                        <li class="list-group-item">Email: <?php echo htmlspecialchars($denda['email']); ?></li>
                        <li class="list-group-item">Level: <?php echo htmlspecialchars($denda['level']); ?></li>
                    </ul>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Data Buku</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Judul: <b><?php echo htmlspecialchars($denda['judul_buku']); ?></b></li>
                        <li class="list-group-item">ISBN: <?php echo htmlspecialchars($denda['isbn']); ?></li>
                        <li class="list-group-item">Penerbit: <?php echo htmlspecialchars($denda['penerbit']); ?></li>
                        <li class="list-group-item">Pengarang: <?php echo htmlspecialchars($denda['pengarang']); ?></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Status Peminjaman</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Kode Pinjam: <b><?php echo htmlspecialchars($denda['pinjam_id']); ?></b></li>
                        <li class="list-group-item">Status Pinjam: <?php if ($denda['tgl_kembali']): ?><span class="badge badge-success">Dikembalikan</span><?php else: ?><span class="badge badge-warning">Dipinjam</span><?php endif; ?></li>
                        <li class="list-group-item">Tanggal Pinjam: <?php echo htmlspecialchars($denda['tgl_pinjam']); ?></li>
                        <li class="list-group-item">Tanggal Kembali: <?php echo htmlspecialchars($denda['tgl_kembali'] ?? '-'); ?></li>
                        <li class="list-group-item">Tanggal Harus Kembali: <?php echo htmlspecialchars($denda['tgl_balik'] ?? '-'); ?></li>
                    </ul>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="text-muted">Denda</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nominal Denda: <b><?php echo $denda['denda'] ? 'Rp ' . number_format($denda['denda'], 0, ',', '.') : '-'; ?></b></li>
                        <li class="list-group-item">Lama Waktu: <?php echo $denda['lama_waktu'] ? $denda['lama_waktu'] . ' hari' : '-'; ?></li>
                        <li class="list-group-item">Tanggal Denda: <?php echo $denda['tgl_denda'] ?? '-'; ?></li>
                        <li class="list-group-item">Status Denda: <?php if (isset($denda['status']) && $denda['status'] == 'lunas'): ?><span class="badge badge-success">Lunas</span><?php else: ?><span class="badge badge-warning">Belum Lunas</span><?php endif; ?></li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>