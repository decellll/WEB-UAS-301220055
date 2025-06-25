-- Database: perpustakaan_ma_alhijrah

-- Tabel: tb_admin
CREATE TABLE `tb_admin` (
  `id_login` INT AUTO_INCREMENT PRIMARY KEY,
  `anggota` VARCHAR(75),
  `user` VARCHAR(75) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `level` VARCHAR(75) NOT NULL,
  `nama` VARCHAR(75),
  `tempat_lahir` VARCHAR(75),
  `tgl_lahir` DATE,
  `jenis_kelamin` VARCHAR(75),
  `alamat` TEXT,
  `telpon` VARCHAR(75),
  `email` VARCHAR(75),
  `tgl_bergabung` DATE,
  `foto` VARCHAR(75)
);

-- Password hash untuk 'admin' (password: admin)
-- $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
INSERT INTO `tb_admin` (`anggota`, `user`, `password`, `level`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `telpon`, `email`, `tgl_bergabung`, `foto`) VALUES
('admin', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrator', 'Jakarta', '1990-01-01', 'Laki-laki', 'Jl. Raya', '08123456789', 'admin@ma-alhijrah.sch.id', '2024-06-01', 'admin.jpg');

-- Tabel: tb_kategori
CREATE TABLE `tb_kategori` (
  `id_kategori` INT AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` VARCHAR(75) NOT NULL
);

INSERT INTO `tb_kategori` (`kategori_id`) VALUES ('Fiksi'), ('Non-Fiksi'), ('Pelajaran');

-- Tabel: tb_rak
CREATE TABLE `tb_rak` (
  `id_rak` INT AUTO_INCREMENT PRIMARY KEY,
  `nama_rak` VARCHAR(75) NOT NULL
);

INSERT INTO `tb_rak` (`nama_rak`) VALUES ('Rak 1'), ('Rak 2'), ('Rak 3');

-- Tabel: tb_buku
CREATE TABLE `tb_buku` (
  `id_buku` INT AUTO_INCREMENT PRIMARY KEY,
  `buku_id` VARCHAR(75) NOT NULL,
  `id_kategori` INT,
  `id_rak` INT,
  `sampul` VARCHAR(125),
  `isbn` VARCHAR(75),
  `lampiran` VARCHAR(75),
  `title` VARCHAR(75) NOT NULL,
  `penerbit` VARCHAR(75),
  `pengarang` VARCHAR(75),
  `tahun_buku` VARCHAR(75),
  `isi` TEXT,
  `jumlah` INT,
  `tgl_masuk` DATE,
  FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori`(`id_kategori`) ON DELETE SET NULL,
  FOREIGN KEY (`id_rak`) REFERENCES `tb_rak`(`id_rak`) ON DELETE SET NULL
);

INSERT INTO `tb_buku` (`buku_id`, `id_kategori`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `tahun_buku`, `isi`, `jumlah`, `tgl_masuk`) VALUES
('BK001', 1, 1, 'cover1.jpg', '9786020321234', 'lampiran1.pdf', 'Buku Fiksi 1', 'Penerbit A', 'Pengarang A', '2020', 'Deskripsi buku fiksi 1', 5, '2024-06-01'),
('BK002', 2, 2, 'cover2.jpg', '9786020325678', 'lampiran2.pdf', 'Buku Non-Fiksi 1', 'Penerbit B', 'Pengarang B', '2021', 'Deskripsi buku non-fiksi 1', 3, '2024-06-01');

-- Tabel: tb_pinjam
CREATE TABLE `tb_pinjam` (
  `id_pinjam` INT AUTO_INCREMENT PRIMARY KEY,
  `pinjam_id` VARCHAR(75) NOT NULL,
  `anggota_id` VARCHAR(75) NOT NULL,
  `buku_id` VARCHAR(75) NOT NULL,
  `status` VARCHAR(75),
  `tgl_pinjam` DATE,
  `lama_pinjam` INT,
  `tgl_balik` DATE,
  `tgl_kembali` DATE
);

INSERT INTO `tb_pinjam` (`pinjam_id`, `anggota_id`, `buku_id`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`) VALUES
('PJ001', 'admin', 'BK001', 'dipinjam', '2024-06-01', 7, '2024-06-08', NULL);

-- Tabel: tb_denda
CREATE TABLE `tb_denda` (
  `id_denda` INT AUTO_INCREMENT PRIMARY KEY,
  `pinjam_id` VARCHAR(75) NOT NULL,
  `denda` VARCHAR(75),
  `lama_waktu` INT,
  `tgl_denda` DATE
);

INSERT INTO `tb_denda` (`pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
('PJ001', '5000', 2, '2024-06-10'); 