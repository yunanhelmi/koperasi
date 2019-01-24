-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 24 Jan 2019 pada 06.45
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_angsuran`
--

CREATE TABLE `detail_angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `angsuran` double DEFAULT NULL,
  `jasa` double DEFAULT NULL,
  `denda` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bulan_ke` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_angsuran`
--

INSERT INTO `detail_angsuran` (`id`, `id_pinjaman`, `waktu`, `jenis`, `angsuran`, `jasa`, `denda`, `total`, `bulan_ke`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-01-02', 'Pinjaman', NULL, NULL, NULL, 1000000, NULL, 1, '22', '23'),
(2, 1, '2018-02-02', 'Angsuran', 100000, 20000, 0, 120000, 1, 1, '24,26', '25,27'),
(3, 1, '2018-03-02', 'Angsuran', 900000, 60000, 0, 960000, 10, 1, '28,30', '29,31'),
(4, 2, '2018-02-09', 'Pinjaman', NULL, NULL, NULL, 10000000, NULL, 1, '40', '41'),
(5, 2, '2018-02-09', 'Angsuran', 0, 2000000, 0, 2000000, 0, 1, '42,44', '43,45'),
(6, 3, '2017-10-05', 'Pinjaman', NULL, NULL, NULL, 1000000, NULL, NULL, NULL, NULL),
(7, 3, '2017-11-09', 'Angsuran', 100000, 20000, 0, 120000, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jasa_simpanan3th`
--

CREATE TABLE `detail_jasa_simpanan3th` (
  `id` int(11) NOT NULL,
  `id_simpanan3th` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(32) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_jasa_simpanan3th`
--

INSERT INTO `detail_jasa_simpanan3th` (`id`, `id_simpanan3th`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-12-30', 'Penyesuaian Jasa', '', 50000, 1, '54', '55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpanan3th`
--

CREATE TABLE `detail_simpanan3th` (
  `id` int(11) NOT NULL,
  `id_simpanan3th` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_simpanan3th`
--

INSERT INTO `detail_simpanan3th` (`id`, `id_simpanan3th`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-01-16', 'Setoran', '2018-01', 100000, 1, '52', '53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpanandanasosial`
--

CREATE TABLE `detail_simpanandanasosial` (
  `id` int(11) NOT NULL,
  `id_simpanandanasosial` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpanankanzun`
--

CREATE TABLE `detail_simpanankanzun` (
  `id` int(11) NOT NULL,
  `id_simpanankanzun` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpanankhusus`
--

CREATE TABLE `detail_simpanankhusus` (
  `id` int(11) NOT NULL,
  `id_simpanankhusus` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpananpihakketiga`
--

CREATE TABLE `detail_simpananpihakketiga` (
  `id` int(11) NOT NULL,
  `id_simpananpihakketiga` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_simpananwajib`
--

CREATE TABLE `detail_simpananwajib` (
  `id` int(11) NOT NULL,
  `id_simpananwajib` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_simpananwajib`
--

INSERT INTO `detail_simpananwajib` (`id`, `id_simpananwajib`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-01-03', 'Setoran', '2019-01', 600000, 1, '32', '33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_akun`
--

CREATE TABLE `kode_akun` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(32) DEFAULT NULL,
  `nama_akun` varchar(128) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_akun`
--

INSERT INTO `kode_akun` (`id`, `kode_akun`, `nama_akun`, `keterangan`) VALUES
(1, '101', 'Kas', ''),
(2, '102', 'Bank', ''),
(3, '103', 'Pembiayaan (Piutang) diberikan', ''),
(4, '104', 'Peralatan Kantor', ''),
(5, '105', 'Akumulasi Penyusutan Peralatan', ''),
(6, '201', 'Dana Perjuangan', ''),
(7, '202', 'Dana Pendidikan & Sosial', ''),
(8, '203', 'Hutang Kanzunt Toyibah', ''),
(9, '204', 'Jasa Pengurus', ''),
(10, '205', 'Jasa Pinjaman & Modal', ''),
(13, '211', 'Simpanan 3 th ke 16', ''),
(14, '212', 'Hutang jasa 3 th  ke 16', ''),
(15, '213', 'Simpanan  3 th  ke 17', ''),
(16, '214', 'Hutang jasa 3 th  ke 17', ''),
(17, '215', 'Simpanan  3 th  ke 18', ''),
(18, '216', 'Hutang jasa 3 th  ke 18', ''),
(19, '227', 'Kwajiban lain-lain (PIHAK 3)', ''),
(20, '301', 'Simpanan Pokok', ''),
(21, '302', 'Simpanan Wajib', ''),
(22, '303', 'Simpanan Kusus', ''),
(23, '304', 'Cadangan', ''),
(24, '305', 'SHU sedang berjalan', ''),
(25, '401', 'Pendapatan jasa', ''),
(26, '501', 'Biaya Konsumsi RK & RAT', ''),
(27, '502', 'Pembuatan laporan', ''),
(28, '503', 'Uang Hadir RK & RAT', ''),
(29, '504', 'Rapat pengurus & BP', ''),
(30, '505', 'Akomodasi RK & R A T', ''),
(31, '506', 'Hr Pengurus,Pembina,penga', ''),
(32, '507', 'Biaya silaturahmi / buka bersama', ''),
(33, '508', 'Biaya Pembinaan', ''),
(34, '511', 'Biaya Jasa Pihak Ketiga', ''),
(35, '512', 'Biaya Jasa 3 TH 15', ''),
(36, '513', 'Biaya Jasa 3 TH 16', ''),
(37, '514', 'Biaya Jasa 3 TH 17', ''),
(38, '515', 'Biaya Jasa 3 TH 18', ''),
(39, '531', 'Biaya Ziarah & Silaturahmi TTBH', ''),
(40, '532', 'ATK Koperasi', ''),
(41, '533', 'Zakat Koperasi & Sodaqoh', ''),
(42, '534', 'Sodaqoh Istianah', ''),
(43, '535', 'UNDIAN RK & RAT', ''),
(44, '536', 'Biaya Penyusutan Peralatan ', ''),
(45, '537', 'Biaya Listrik Kantor & Telp', ''),
(46, '538', 'PONDOK & THGB', ''),
(47, '539', 'JMD 2000', ''),
(48, '540', 'HR Karyawan', ''),
(49, '541', 'HR Petugas Penagihan', ''),
(50, '542', 'Biaya Lembur, Transport & Konsumsi', ''),
(51, '543', 'MASJID BAITUS SHIDDIQIN', ''),
(52, '544', 'THR Idul Fitri', ''),
(53, '545', 'Kurban IduL Adha', ''),
(54, '546', 'Kalender', ''),
(55, '547', 'TASYAKURAN JKP', ''),
(56, '548', 'Rumah Layak Huni & Santunan Nasional', ''),
(57, '217', 'simpanan 3th ke 19', ''),
(58, '206', 'simpanan dansos anggota', ''),
(59, '218', 'hutang jasa 3th ke 19', ''),
(60, '516', 'Biaya jasa 3 th 19', ''),
(61, '306', 'SHU', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapping_kode_akun`
--

CREATE TABLE `mapping_kode_akun` (
  `id` int(11) NOT NULL,
  `nama_transaksi` varchar(128) DEFAULT NULL,
  `kode_debet` varchar(32) DEFAULT NULL,
  `kode_kredit` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapping_kode_akun`
--

INSERT INTO `mapping_kode_akun` (`id`, `nama_transaksi`, `kode_debet`, `kode_kredit`) VALUES
(1, 'penerimaan piutang', '101', '103'),
(4, 'pemberian pinjaman', '103', '101'),
(5, 'penerimaan jasa', '101', '401'),
(6, 'penerimaan simp 3 th 17', '101', '213'),
(7, 'penerimaan simp 3 th 18', '101', '215'),
(8, 'penerimaan simp 3th 19', '101', '217'),
(9, 'penerimaan simp wajib', '101', '302'),
(10, 'penerimaan simp pokok', '101', '301'),
(11, 'penerimaan tabungan pihak 3', '101', '227'),
(12, 'penerimaan simp dansos anggota', '101', '206'),
(13, 'penerimaan sisa shu anggota', '306', '303'),
(14, 'penerimaan kanzun', '101', '203'),
(15, 'pencairan dana perjuangan', '201', '101'),
(16, 'pencairan dana pendidikan & sosial', '202', '101'),
(17, 'pencairan jasa pengurus', '204', '101'),
(18, 'pencairan jasa pinjaman dan modal', '205', '101'),
(19, 'pencairan simp dansos anggota', '206', '101'),
(20, 'pencairan simp 3th 18', '215', '101'),
(21, 'pencairan simp 3th 17', '213', '101'),
(22, 'pencairan simp 3th 19', '217', '101'),
(23, 'pencairan hutang jasa 3th 17', '214', '101'),
(24, 'pencairan hutang jasa 3th 18', '216', '101'),
(25, 'pencairan hutang jasa 3th 19', '218', '101'),
(26, 'pembelian peralatan kantor', '104', '101'),
(27, 'disetor ke bank', '102', '101'),
(28, 'pengambilan uang dari bank', '101', '102'),
(29, 'pembayaran biaya konsumsi RK & RAT', '501', '101'),
(30, 'pembayaran biaya pembuatan laporan', '502', '101'),
(31, 'pembayaran uang hadir RK & RAT', '503', '101'),
(32, 'pembayaran biaya rapat pengurus & BP', '504', '101'),
(33, 'pembayaran biaya akomodasi RK & RAT', '505', '101'),
(34, 'pembayaran hr pengurus, pembina & bp', '506', '101'),
(35, 'pembayaran biaya silaturahmi / buka bersama', '507', '101'),
(36, 'pembayaran biaya pembinaan', '508', '101'),
(37, 'pembayaran biaya jasa pihak 3', '511', '101'),
(38, 'pembayaran biaya jasa 3th 17', '514', '101'),
(39, 'pembayaran biaya jasa 3th 18', '515', '101'),
(40, 'pembayaran biaya jasa 3th 19', '516', '101'),
(41, 'pembayaran biaya ziarah & silaturahmi TTBH', '531', '101'),
(42, 'pembelian ATK', '532', '101'),
(43, 'pembayaran zakat & sodaqoh', '533', '101'),
(44, 'pembayaran biaya undian RK & RAT', '535', '101'),
(45, 'pembayaran listrik & telepon', '537', '101'),
(46, 'pembayaran biaya untuk Pondok & THGB', '538', '101'),
(47, 'pembayaran biaya utk JMD 2000', '539', '101'),
(48, 'pembayaran hr karyawan', '540', '101'),
(49, 'pembayaran hr petugas penagihan', '541', '101'),
(50, 'pembayaran biaya lembur, transport & konsumsi', '542', '101'),
(51, 'pembayaran biaya rumah layak huni & santunan nasional', '548', '101'),
(52, 'pembayaran thr idul fitri', '544', '101'),
(53, 'pembayaran utk biaya kurban idul adha', '545', '101'),
(54, 'pembelian kalender', '546', '101'),
(55, 'penyusutan peralatan akhir tahun', '536', '105'),
(56, 'penerimaan dana perjuangan', '306', '201'),
(57, 'penerimaan dana pendidikan & sosial', '306', '202'),
(58, 'penerimaan jasa pengurus', '306', '204'),
(59, 'penerimaan jasa pinjaman dan modal', '306', '205'),
(60, 'penerimaan dana cadangan', '306', '304'),
(61, 'pencairan dana cadangan', '304', '101'),
(62, 'pencairan simpanan kusus', '303', '101'),
(63, 'penerimaan jasa pihak 3', '101', '303'),
(64, 'pencairan hutang kanzun', '203', '101'),
(65, 'pencairan tabungan pihak 3', '227', '101'),
(66, 'pencairan simpanan pokok', '301', '101'),
(67, 'pencairan simpanan wajib', '302', '101'),
(68, 'penyesuaian jasa 3 th 17', '514', '214'),
(69, 'penyesuaian jasa 3th 18', '515', '216'),
(70, 'penyesuaian jasa 3th 19', '516', '218'),
(71, 'penyesuaian shu akhir tahun', '305', '306'),
(72, 'pembayaran biaya sodaqoh istianah', '534', '101'),
(73, 'penyesuaian pendapatan jasa', '401', '227');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `id` int(11) NOT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `jenis_nasabah` int(11) DEFAULT NULL,
  `nomor_koperasi` varchar(32) DEFAULT NULL,
  `nama` varchar(128) NOT NULL,
  `nik` varchar(32) DEFAULT NULL,
  `telpon` varchar(32) DEFAULT NULL,
  `file_foto` text,
  `alamat` varchar(128) DEFAULT NULL,
  `kota` varchar(32) DEFAULT NULL,
  `kecamatan` varchar(32) DEFAULT NULL,
  `kelurahan` varchar(32) DEFAULT NULL,
  `dusun` varchar(32) DEFAULT NULL,
  `rw` varchar(16) DEFAULT NULL,
  `rt` varchar(16) DEFAULT NULL,
  `pekerjaan` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`id`, `nomor_nasabah`, `jenis_nasabah`, `nomor_koperasi`, `nama`, `nik`, `telpon`, `file_foto`, `alamat`, `kota`, `kecamatan`, `kelurahan`, `dusun`, `rw`, `rt`, `pekerjaan`) VALUES
(1, 1, 1, '100001', 'Yunan Helmi Mahendra', '3576010910940001', '', './files/uploads/foto_nasabah/15322051881.jpeg', 'Jl. Suromulang Barat XI No. 14', 'Kota Mojokerto', 'Prajuritkulon', 'Surodinawan', '', '8', '34', ''),
(2, 2, 1, '100002', 'Arzak', '3576010807920001', '', './files/uploads/foto_nasabah/15322055012.jpeg', 'Surodinawan No. 46', 'Kota Mojokerto', 'Prajuritkulon', 'Surodinawan', '-', '12', '5', ''),
(3, 3, 1, '100003', 'Dimas Arif', '3576010910940002', '081252026883', './files/uploads/foto_nasabah/15330842523.jpeg', 'Jl. Sumbing 34', 'Sidoarjo', 'Sukodono', 'Sukodono', 'Sukodono', '1', '2', 'Petani'),
(4, 4, 1, '100004', 'Firman Bagus', '3676010909910001', '081243567896', './files/uploads/foto_nasabah/15379740224.jpeg', 'Jl. Karimata 67', 'Bojoneogoro', 'Jatirogo', 'Soko', 'Grenjeng', '09', '12', 'Guru'),
(5, 1, 2, '200001', 'Rangga Pradana', '3212010908890002', '085732657745', './files/uploads/foto_nasabah/15379742655.jpeg', 'Jl. Bali No.45', 'Bojonegoro', 'Kranggan', 'Miji', 'Singogalih', '2', '8', 'TNI'),
(6, 2, 2, '200002', 'Rahma Nabala', '3576010809010002', '086743657865', NULL, 'Jl. KH. Wahid 12', 'Kota Malang', 'Lowokwaru', 'Lowokwaru', 'Waru', '1', '1', 'Swasta'),
(7, 3, 2, '200003', 'Amir', '42225245225', '0989898808', NULL, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) NOT NULL,
  `jenis_pinjaman` varchar(64) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `alamat_nasabah` varchar(128) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `jaminan` varchar(128) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jatuh_tempo` varchar(32) DEFAULT NULL,
  `jumlah_pinjaman` double DEFAULT NULL,
  `jumlah_angsuran` int(11) DEFAULT NULL,
  `angsuran_perbulan` double DEFAULT NULL,
  `jasa_perbulan` double DEFAULT NULL,
  `total_angsuran_perbulan` double DEFAULT NULL,
  `sisa_angsuran` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_nasabah`, `jenis_pinjaman`, `nama_nasabah`, `nomor_nasabah`, `alamat_nasabah`, `nik_nasabah`, `jaminan`, `waktu`, `jatuh_tempo`, `jumlah_pinjaman`, `jumlah_angsuran`, `angsuran_perbulan`, `jasa_perbulan`, `total_angsuran_perbulan`, `sisa_angsuran`, `status`) VALUES
(1, 1, 'Angsuran', 'Yunan Helmi Mahendra', 100001, NULL, '3576010910940001', 'STNK Motor', '2018-01-02', '2', 1000000, 10, 100000, 20000, 120000, 0, NULL),
(2, 2, 'Musiman', 'Arzak', 100002, NULL, '3576010807920001', 'STNK Motor', '2018-02-09', '9', 10000000, 0, 0, 300000, 300000, 10000000, NULL),
(3, 3, 'Angsuran', 'Dimas Arif', 100003, NULL, '3576010910940002', 'STNK', '2017-10-05', '5', 1000000, 10, 100000, 20000, 120000, 900000, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan3th`
--

CREATE TABLE `simpanan3th` (
  `id` int(11) NOT NULL,
  `id_master` int(11) NOT NULL,
  `nama_simpanan` varchar(64) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `jasa_total` double DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `simpanan3th`
--

INSERT INTO `simpanan3th` (`id`, `id_master`, `nama_simpanan`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `total`, `jasa_total`, `waktu`) VALUES
(1, 1, 'Simpanan 3 TH Tahun Ke-16', 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 100000, 50000, '2018-01-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan3th_master`
--

CREATE TABLE `simpanan3th_master` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `kode_debet_penerimaan_simp` varchar(32) DEFAULT NULL,
  `kode_kredit_penerimaan_simp` varchar(32) DEFAULT NULL,
  `kode_debet_pencairan_simp` varchar(32) DEFAULT NULL,
  `kode_kredit_pencairan_simp` varchar(32) DEFAULT NULL,
  `kode_debet_pencairan_hutang_jasa` varchar(32) DEFAULT NULL,
  `kode_kredit_pencairan_hutang_jasa` varchar(32) DEFAULT NULL,
  `kode_debet_pembayaran_jasa` varchar(32) DEFAULT NULL,
  `kode_kredit_pembayaran_jasa` varchar(32) DEFAULT NULL,
  `kode_debet_penyesuaian_jasa` varchar(32) DEFAULT NULL,
  `kode_kredit_penyesuaian_jasa` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `simpanan3th_master`
--

INSERT INTO `simpanan3th_master` (`id`, `nama`, `kode_debet_penerimaan_simp`, `kode_kredit_penerimaan_simp`, `kode_debet_pencairan_simp`, `kode_kredit_pencairan_simp`, `kode_debet_pencairan_hutang_jasa`, `kode_kredit_pencairan_hutang_jasa`, `kode_debet_pembayaran_jasa`, `kode_kredit_pembayaran_jasa`, `kode_debet_penyesuaian_jasa`, `kode_kredit_penyesuaian_jasa`) VALUES
(1, 'Simpanan 3 TH Tahun Ke-16', '101', '211', '211', '101', '212', '101', '513', '101', '513', '212');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanandanasosial`
--

CREATE TABLE `simpanandanasosial` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanankanzun`
--

CREATE TABLE `simpanankanzun` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanankhusus`
--

CREATE TABLE `simpanankhusus` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpananpihakketiga`
--

CREATE TABLE `simpananpihakketiga` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `nik` varchar(32) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `kota` varchar(32) DEFAULT NULL,
  `kecamatan` varchar(32) DEFAULT NULL,
  `kelurahan` varchar(32) DEFAULT NULL,
  `dusun` varchar(32) DEFAULT NULL,
  `rw` varchar(16) DEFAULT NULL,
  `rt` varchar(16) DEFAULT NULL,
  `telpon` varchar(32) DEFAULT NULL,
  `pekerjaan` varchar(64) DEFAULT NULL,
  `file_foto` text,
  `waktu` date DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpananpokok`
--

CREATE TABLE `simpananpokok` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `jenis` varchar(16) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpananwajib`
--

CREATE TABLE `simpananwajib` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `simpananwajib`
--

INSERT INTO `simpananwajib` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `waktu`, `total`) VALUES
(1, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', '2018-01-03', 600000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_transaksi` varchar(128) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `kode_debet` varchar(32) DEFAULT NULL,
  `kode_kredit` varchar(32) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` int(11) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `nama_transaksi`, `keterangan`, `kode_debet`, `kode_kredit`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, '2018-01-05', 'pembelian ATK', '', '532', '101', 50000, 1, 34, 35),
(2, '2018-01-03', 'pengambilan uang dari bank', '', '101', '102', 10000000, 1, 36, 37),
(3, '2018-01-06', 'pencairan dana perjuangan', '', '201', '101', 500000, 1, 38, 39),
(4, '2018-12-30', 'pembayaran biaya jasa pihak 3', '', '511', '101', 500000, 1, 46, 47),
(5, '2018-12-30', 'pembayaran biaya rumah layak huni & santunan nasional', '', '548', '101', 500000, 1, 48, 49),
(6, '2018-12-30', 'pencairan tabungan pihak 3', '', '227', '101', 500000, 1, 50, 51);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_akuntansi`
--

CREATE TABLE `transaksi_akuntansi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_akun` varchar(64) DEFAULT NULL,
  `nama_akun` varchar(64) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `debet` double DEFAULT NULL,
  `kredit` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_akuntansi`
--

INSERT INTO `transaksi_akuntansi` (`id`, `tanggal`, `kode_akun`, `nama_akun`, `keterangan`, `jumlah`, `debet`, `kredit`) VALUES
(1, '2018-01-01', '101', 'Kas', 'Saldo Awal Kas Tahun 2018', 1118000, 1118000, 0),
(2, '2018-01-01', '102', 'Bank', 'Saldo Awal Bank Tahun 2018', 139000000, 139000000, 0),
(3, '2018-01-01', '103', 'Pembiayaan (Piutang) diberikan', 'Saldo Awal Pembiayaan (Piutang) diberikan Tahun 2018', 4163762643, 4163762643, 0),
(4, '2018-01-01', '104', 'Peralatan Kantor', 'Saldo Awal Peralatan Kantor Tahun 2018', 74486000, 74486000, 0),
(5, '2018-01-01', '105', 'Akumulasi Penyusutan Peralatan', 'Saldo Awal Akumulasi Penyusutan Peralatan Tahun 2018', 36910000, 0, 36910000),
(6, '2018-01-01', '201', 'Dana Perjuangan', 'Saldo Awal Dana Perjuangan Tahun 2018', 124471885, 0, 124471885),
(7, '2018-01-01', '202', 'Dana Pendidikan & Sosial', 'Saldo Awal Dana Pendidikan & Sosial Tahun 2018', 57739042, 0, 57739042),
(8, '2018-01-01', '203', 'Hutang Kanzunt Toyibah', 'Saldo Awal Hutang Kanzunt Toyibah Tahun 2018', 7772758, 0, 7772758),
(9, '2018-01-01', '204', 'Jasa Pengurus', 'Saldo Awal Jasa Pengurus Tahun 2018', 50771000, 0, 50771000),
(10, '2018-01-01', '205', 'Jasa Pinjaman & Modal', 'Saldo Awal Jasa Pinjaman & Modal Tahun 2018', 135390000, 0, 135390000),
(11, '2018-01-01', '211', 'Simpanan 3 th ke 16', 'Saldo Awal Tahun 2018 Simpanan 3 th ke 16', 123500000, 0, 123500000),
(12, '2018-01-01', '212', 'Hutang jasa 3 th ke 16', 'Saldo Awal tahun 2018 Hutang jasa 3 th ke 16', 73246652, 0, 73246652),
(13, '2018-01-01', '213', 'Simpanan 3 th ke 17', 'Saldo Awal tahun 2018 Simpanan 3 th ke 17', 122320000, 0, 122320000),
(14, '2018-01-01', '214', 'Hutang jasa 3 th ke 17', 'Saldo Awal tahun 2018 Hutang jasa 3 th ke 17', 27017616, 0, 27017616),
(15, '2018-01-01', '215', 'Simpanan 3 th ke 18', 'Saldo Awal Tahun 2018 Simpanan 3 th ke 18', 113720000, 0, 113720000),
(16, '2018-01-01', '216', 'Hutang jasa 3 th ke 18', 'Saldo Awal tahun 2018 Hutang jasa 3 th ke 18', 11117087, 0, 11117087),
(17, '2018-01-01', '227', 'Kwajiban lain-lain (PIHAK 3)', 'Saldo Awal Tahun 2018 Kwajiban lain-lain (PIHAK 3)', 2277476500, 0, 2277476500),
(18, '2018-01-01', '301', 'Simpanan Pokok', 'Saldo Awal Tahun 2018 Simpanan Pokok', 9700000, 0, 9700000),
(19, '2018-01-01', '302', 'Simpanan Wajib', 'Saldo Awal tahun 2018 Simpanan Wajib', 367774814, 0, 367774814),
(20, '2018-01-01', '303', 'Simpanan Kusus', 'Saldo Awal Tahun 2018 Simpanan Kusus', 214165356, 0, 214165356),
(21, '2018-01-01', '304', 'Cadangan', 'Saldo Awal Tahun 2018 Cadangan', 625273933, 0, 625273933),
(22, '2018-01-02', '103', 'Pembiayaan (Piutang) diberikan', 'Pemberian Pinjaman kepada Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 1000000, 1000000, 0),
(23, '2018-01-02', '101', 'Kas', 'Pemberian Pinjaman kepada Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 1000000, 0, 1000000),
(24, '2018-02-02', '101', 'Kas', 'Pembayaran Angsuran Pinjaman Bulan ke-1 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 100000, 100000, 0),
(25, '2018-02-02', '103', 'Pembiayaan (Piutang) diberikan', 'Pembayaran Angsuran Pinjaman Bulan ke-1 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 100000, 0, 100000),
(26, '2018-02-02', '101', 'Kas', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-1 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 20000, 20000, 0),
(27, '2018-02-02', '401', 'Pendapatan jasa', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-1 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 20000, 0, 20000),
(28, '2018-03-02', '101', 'Kas', 'Pembayaran Angsuran Pinjaman Bulan ke-10 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 900000, 900000, 0),
(29, '2018-03-02', '103', 'Pembiayaan (Piutang) diberikan', 'Pembayaran Angsuran Pinjaman Bulan ke-10 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 900000, 0, 900000),
(30, '2018-03-02', '101', 'Kas', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-10 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 60000, 60000, 0),
(31, '2018-03-02', '401', 'Pendapatan jasa', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-10 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 60000, 0, 60000),
(32, '2018-01-03', '101', 'Kas', 'Simpanan Wajib Bulan Jan-2019 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 600000, 600000, 0),
(33, '2018-01-03', '302', 'Simpanan Wajib', 'Simpanan Wajib Bulan Jan-2019 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 600000, 0, 600000),
(34, '2018-01-05', '532', 'ATK Koperasi', '', 50000, 50000, 0),
(35, '2018-01-05', '101', 'Kas', '', 50000, 0, 50000),
(36, '2018-01-03', '101', 'Kas', '', 10000000, 10000000, 0),
(37, '2018-01-03', '102', 'Bank', '', 10000000, 0, 10000000),
(38, '2018-01-06', '201', 'Dana Perjuangan', '', 500000, 500000, 0),
(39, '2018-01-06', '101', 'Kas', '', 500000, 0, 500000),
(40, '2018-02-09', '103', 'Pembiayaan (Piutang) diberikan', 'Pemberian Pinjaman kepada Anggota a.n. Arzak Nomor Anggota: 100002', 10000000, 10000000, 0),
(41, '2018-02-09', '101', 'Kas', 'Pemberian Pinjaman kepada Anggota a.n. Arzak Nomor Anggota: 100002', 10000000, 0, 10000000),
(42, '2018-02-09', '101', 'Kas', 'Pembayaran Angsuran Pinjaman Bulan ke-0 Anggota a.n. Arzak Nomor Anggota: 100002', 0, 0, 0),
(43, '2018-02-09', '103', 'Pembiayaan (Piutang) diberikan', 'Pembayaran Angsuran Pinjaman Bulan ke-0 Anggota a.n. Arzak Nomor Anggota: 100002', 0, 0, 0),
(44, '2018-02-09', '101', 'Kas', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-0 Anggota a.n. Arzak Nomor Anggota: 100002', 2000000, 2000000, 0),
(45, '2018-02-09', '401', 'Pendapatan jasa', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-0 Anggota a.n. Arzak Nomor Anggota: 100002', 2000000, 0, 2000000),
(46, '2018-12-30', '511', 'Biaya Jasa Pihak Ketiga', '', 500000, 500000, 0),
(47, '2018-12-30', '101', 'Kas', '', 500000, 0, 500000),
(48, '2018-12-30', '548', 'Rumah Layak Huni & Santunan Nasional', '', 500000, 500000, 0),
(49, '2018-12-30', '101', 'Kas', '', 500000, 0, 500000),
(50, '2018-12-30', '227', 'Kwajiban lain-lain (PIHAK 3)', '', 500000, 500000, 0),
(51, '2018-12-30', '101', 'Kas', '', 500000, 0, 500000),
(52, '2018-01-16', '101', 'Kas', 'Simpanan 3 TH Tahun Ke-16 Bulan Jan-2018 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 100000, 100000, 0),
(53, '2018-01-16', '211', 'Simpanan 3 th ke 16', 'Simpanan 3 TH Tahun Ke-16 Bulan Jan-2018 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 100000, 0, 100000),
(54, '2018-12-30', '513', 'Biaya Jasa 3 TH 16', 'Penyesuaian Jasa Simpanan 3 TH Tahun Ke-16 Bulan Jan-1970 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 50000, 50000, 0),
(55, '2018-12-30', '212', 'Hutang jasa 3 th  ke 16', 'Penyesuaian Jasa Simpanan 3 TH Tahun Ke-16 Bulan Jan-1970 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 50000, 0, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `email`) VALUES
(1, 'yunanhm', 'yunanhm', 'administrator', 'yunan4635@gmail.com'),
(2, 'admin', 'admin', 'administrator', 'admin@gmail.com'),
(3, 'admin1', 'admin1', 'administrator', 'admin1@gmail.com'),
(4, 'admin12345', 'admin', 'Administrator', 'admin3@gmail.com'),
(5, 'yuni', 'yuni', 'Administrator', 'yuni@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_angsuran`
--
ALTER TABLE `detail_angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_jasa_simpanan3th`
--
ALTER TABLE `detail_jasa_simpanan3th`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpanan3th`
--
ALTER TABLE `detail_simpanan3th`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpanandanasosial`
--
ALTER TABLE `detail_simpanandanasosial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpanankanzun`
--
ALTER TABLE `detail_simpanankanzun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpanankhusus`
--
ALTER TABLE `detail_simpanankhusus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpananpihakketiga`
--
ALTER TABLE `detail_simpananpihakketiga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_simpananwajib`
--
ALTER TABLE `detail_simpananwajib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kode_akun`
--
ALTER TABLE `kode_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapping_kode_akun`
--
ALTER TABLE `mapping_kode_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan3th`
--
ALTER TABLE `simpanan3th`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan3th_master`
--
ALTER TABLE `simpanan3th_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanandanasosial`
--
ALTER TABLE `simpanandanasosial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanankanzun`
--
ALTER TABLE `simpanankanzun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanankhusus`
--
ALTER TABLE `simpanankhusus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpananpihakketiga`
--
ALTER TABLE `simpananpihakketiga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpananpokok`
--
ALTER TABLE `simpananpokok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpananwajib`
--
ALTER TABLE `simpananwajib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_akuntansi`
--
ALTER TABLE `transaksi_akuntansi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_angsuran`
--
ALTER TABLE `detail_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `detail_jasa_simpanan3th`
--
ALTER TABLE `detail_jasa_simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_simpanan3th`
--
ALTER TABLE `detail_simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_simpanandanasosial`
--
ALTER TABLE `detail_simpanandanasosial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_simpanankanzun`
--
ALTER TABLE `detail_simpanankanzun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_simpanankhusus`
--
ALTER TABLE `detail_simpanankhusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_simpananpihakketiga`
--
ALTER TABLE `detail_simpananpihakketiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_simpananwajib`
--
ALTER TABLE `detail_simpananwajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kode_akun`
--
ALTER TABLE `kode_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `mapping_kode_akun`
--
ALTER TABLE `mapping_kode_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `simpanan3th`
--
ALTER TABLE `simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `simpanan3th_master`
--
ALTER TABLE `simpanan3th_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `simpanandanasosial`
--
ALTER TABLE `simpanandanasosial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simpanankanzun`
--
ALTER TABLE `simpanankanzun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simpanankhusus`
--
ALTER TABLE `simpanankhusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simpananpihakketiga`
--
ALTER TABLE `simpananpihakketiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simpananpokok`
--
ALTER TABLE `simpananpokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `simpananwajib`
--
ALTER TABLE `simpananwajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaksi_akuntansi`
--
ALTER TABLE `transaksi_akuntansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
