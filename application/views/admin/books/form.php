<?php /* Tidak perlu tag <html> dan <body> karena sudah di-include di admin_layout */ ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0"><i class="fa fa-book text-primary"></i> <?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> Buku</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('admin/books'); ?>">Data Buku</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> Buku</li>
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
                                    <label>Judul Buku</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo isset($book['title']) ? htmlspecialchars($book['title']) : set_value('title'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" name="isbn" class="form-control" value="<?php echo isset($book['isbn']) ? htmlspecialchars($book['isbn']) : set_value('isbn'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" name="penerbit" class="form-control" value="<?php echo isset($book['penerbit']) ? htmlspecialchars($book['penerbit']) : set_value('penerbit'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control" value="<?php echo isset($book['pengarang']) ? htmlspecialchars($book['pengarang']) : set_value('pengarang'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Buku</label>
                                    <input type="number" name="tahun_buku" class="form-control" value="<?php echo isset($book['tahun_buku']) ? htmlspecialchars($book['tahun_buku']) : set_value('tahun_buku'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" name="jumlah" class="form-control" value="<?php echo isset($book['jumlah']) ? htmlspecialchars($book['jumlah']) : set_value('jumlah'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $k): ?>
                                            <option value="<?php echo $k['id_kategori']; ?>" <?php echo (isset($book['id_kategori']) && $book['id_kategori'] == $k['id_kategori']) ? 'selected' : set_select('id_kategori', $k['id_kategori']); ?>><?php echo htmlspecialchars($k['nama_kategori']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Rak</label>
                                    <select name="id_rak" class="form-control" required>
                                        <option value="">-- Pilih Rak --</option>
                                        <?php foreach ($rak as $r): ?>
                                            <option value="<?php echo $r['id_rak']; ?>" <?php echo (isset($book['id_rak']) && $book['id_rak'] == $r['id_rak']) ? 'selected' : set_select('id_rak', $r['id_rak']); ?>><?php echo htmlspecialchars($r['nama_rak']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control" value="<?php echo isset($book['tgl_masuk']) ? $book['tgl_masuk'] : set_value('tgl_masuk'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Sampul Buku (opsional)</label>
                                    <input type="file" name="sampul" class="form-control-file mb-2">
                                    <div class="text-center">
                                        <?php if (isset($book['sampul']) && $book['sampul']): ?>
                                            <img src="<?php echo base_url('uploads/sampul/' . $book['sampul']); ?>" alt="Sampul Buku" class="rounded" style="width:100px;height:140px;object-fit:cover;">
                                        <?php else: ?>
                                            <img src="https://ui-avatars.com/api/?name=Buku&background=0073b7&color=fff" alt="Sampul Buku" class="rounded" style="width:100px;height:140px;object-fit:cover;">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi/Isi Buku</label>
                                    <textarea name="isi" class="form-control" rows="3"><?php echo isset($book['isi']) ? htmlspecialchars($book['isi']) : set_value('isi'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> <?php echo ($mode == 'add' ? 'Tambah' : 'Edit'); ?> Buku</button>
                            <a href="<?php echo site_url('admin/books'); ?>" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>