<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa fa-book text-primary"></i> Data Buku</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo site_url('user/dashboard'); ?>">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Buku</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
        <form class="form-inline mb-3 float-right" method="get">
            <input type="text" name="q" class="form-control mr-2" placeholder="Cari buku..." value="<?php echo htmlspecialchars($keyword); ?>">
            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Sampul</th>
                        <th>Judul</th>
                        <th>ISBN</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + ($page - 1) * $limit;
                    foreach ($books as $b): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php if ($b['sampul']): ?>
                                    <img src="<?php echo base_url('uploads/sampul/' . $b['sampul']); ?>" width="40" height="55" style="object-fit:cover;">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($b['title']); ?></td>
                            <td><?php echo htmlspecialchars($b['isbn']); ?></td>
                            <td><?php echo htmlspecialchars($b['penerbit']); ?></td>
                            <td><?php echo htmlspecialchars($b['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($b['tahun_buku']); ?></td>
                            <td><?php echo htmlspecialchars($b['jumlah']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data buku.</td>
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