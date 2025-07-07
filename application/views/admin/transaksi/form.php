<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-plus text-primary"></i> Tambah Transaksi Peminjaman</h4>
    <a href="<?php echo site_url('admin/transaksi'); ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/transaksi'); ?>">Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
</nav>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <form method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label>Anggota</label>
                        <select name="anggota_id" class="form-control" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach ($anggota as $a): ?>
                                <option value="<?php echo $a['user']; ?>" <?php echo set_select('anggota_id', $a['user']); ?>><?php echo htmlspecialchars($a['nama']) . ' (' . $a['user'] . ')'; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Buku</label>
                        <select name="buku_id" class="form-control" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php foreach ($buku as $b): ?>
                                <option value="<?php echo $b['buku_id']; ?>" <?php echo set_select('buku_id', $b['buku_id']); ?>><?php echo htmlspecialchars($b['title']); ?> (Stok: <?php echo $b['jumlah']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control" value="<?php echo set_value('tgl_pinjam', date('Y-m-d')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Lama Pinjam (hari)</label>
                        <input type="number" name="lama_pinjam" class="form-control" value="<?php echo set_value('lama_pinjam', 7); ?>" min="1" required>
                    </div>
                </div>
            </div>
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Simpan</button>
                <a href="<?php echo site_url('admin/transaksi'); ?>" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>