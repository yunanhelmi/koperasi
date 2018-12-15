-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 11:31 AM
-- Server version: 10.1.16-MariaDB
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
-- Table structure for table `detail_angsuran`
--

CREATE TABLE `detail_angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `angsuran` int(11) DEFAULT NULL,
  `jasa` double DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bulan_ke` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_angsuran`
--

INSERT INTO `detail_angsuran` (`id`, `id_pinjaman`, `waktu`, `jenis`, `angsuran`, `jasa`, `denda`, `total`, `bulan_ke`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-06-02', 'Angsuran', 1000000, 200000, 0, 1200000, 1, NULL, NULL, NULL),
(2, 1, '2018-06-02', 'Angsuran', 1000000, 200000, 10000, 1210000, 0, NULL, NULL, NULL),
(32, 2, '2018-08-23', 'Pinjaman', 0, 0, 0, 1000000, 0, 1, '9', '10'),
(33, 2, '2018-08-23', 'Pinjaman', 0, 0, 0, 1000000, 0, NULL, NULL, NULL),
(35, 2, '2018-08-23', 'Angsuran', 500000, 60000, 0, 560000, 1, NULL, NULL, NULL),
(36, 2, '2018-09-15', 'Angsuran', 200000, 45000, 0, 245000, 2, NULL, NULL, NULL),
(37, 2, '2018-08-23', 'Pinjaman', 0, 0, 0, 1000000, 0, NULL, NULL, NULL),
(38, 3, '2018-09-15', 'Pinjaman', NULL, NULL, NULL, 10000000, NULL, NULL, NULL, NULL),
(39, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 1, NULL, NULL, NULL),
(40, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 2, NULL, NULL, NULL),
(41, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 3, NULL, NULL, NULL),
(42, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 4, NULL, NULL, NULL),
(43, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 5, NULL, NULL, NULL),
(44, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 6, NULL, NULL, NULL),
(45, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 7, NULL, NULL, NULL),
(46, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 8, NULL, NULL, NULL),
(47, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 9, NULL, NULL, NULL),
(48, 3, '2018-09-15', 'Angsuran', 1000000, 200000, 0, 1200000, 10, NULL, NULL, NULL),
(49, 3, '2018-09-15', 'Angsuran', 0, -300000, 0, -300000, 0, NULL, NULL, NULL),
(50, 2, '2018-08-23', 'Angsuran', 162500, 39000, 10000, 211500, 3, 1, '11,13', '12,14'),
(51, 4, '2018-12-12', 'Pinjaman', NULL, NULL, NULL, 2000000, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jasa_simpanan3th`
--

CREATE TABLE `detail_jasa_simpanan3th` (
  `id` int(11) NOT NULL,
  `id_simpanan3th` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(32) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jasa_simpanan3th`
--

INSERT INTO `detail_jasa_simpanan3th` (`id`, `id_simpanan3th`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(2, 1, '2018-12-15', 'Penyesuaian Jasa', '2018-09', 20000, 0, '0', '0'),
(4, 1, '2018-12-15', 'Pencairan Hutang Jasa', '2018-10', 20000, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpanan3th`
--

CREATE TABLE `detail_simpanan3th` (
  `id` int(11) NOT NULL,
  `id_simpanan3th` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpanan3th`
--

INSERT INTO `detail_simpanan3th` (`id`, `id_simpanan3th`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-12-15', 'Setoran', '2018-09', 200000, 0, '0', '0'),
(2, 1, '2018-12-15', 'Tarikan', '2018-10', 200000, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpanandanasosial`
--

CREATE TABLE `detail_simpanandanasosial` (
  `id` int(11) NOT NULL,
  `id_simpanandanasosial` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpanandanasosial`
--

INSERT INTO `detail_simpanandanasosial` (`id`, `id_simpanandanasosial`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-08-08', 'Setoran', '2018-08', 100000, 0, '0', '0'),
(2, 1, '2018-09-09', 'Setoran', '2018-09', 90000, NULL, NULL, NULL),
(3, 1, '2018-11-18', 'Setoran', '2018-09', 100000, NULL, NULL, NULL),
(4, 1, '2018-11-25', 'Setoran', '2018-11', 300000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpanankanzun`
--

CREATE TABLE `detail_simpanankanzun` (
  `id` int(11) NOT NULL,
  `id_simpanankanzun` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpanankanzun`
--

INSERT INTO `detail_simpanankanzun` (`id`, `id_simpanankanzun`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-08-12', 'Setoran', NULL, 100000, NULL, NULL, NULL),
(2, 2, '2018-09-02', 'Setoran', '2018-09', 100000, 0, '0', '0'),
(3, 2, '2018-09-27', 'Setoran', '2018-09', 210000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpanankhusus`
--

CREATE TABLE `detail_simpanankhusus` (
  `id` int(11) NOT NULL,
  `id_simpanankhusus` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpanankhusus`
--

INSERT INTO `detail_simpanankhusus` (`id`, `id_simpanankhusus`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 2, '2018-09-27', 'Setoran', '2018-09', 300000, 0, '0', '0'),
(2, 2, '2018-09-27', 'Tarikan', NULL, 100000, NULL, NULL, NULL),
(3, 2, '2018-11-18', 'Setoran', '2018-10', 400000, NULL, NULL, NULL),
(4, 4, '2018-12-14', 'Setoran', '2018-12', 200000, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpananpihakketiga`
--

CREATE TABLE `detail_simpananpihakketiga` (
  `id` int(11) NOT NULL,
  `id_simpananpihakketiga` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpananpihakketiga`
--

INSERT INTO `detail_simpananpihakketiga` (`id`, `id_simpananpihakketiga`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-08-01', 'Setoran', '2018-08', 1000000, NULL, NULL, NULL),
(2, 1, '2018-09-01', 'Setoran', '2018-09', 500000, NULL, NULL, NULL),
(3, 2, '2018-12-14', 'Setoran', '2018-12', 200000, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_simpananwajib`
--

CREATE TABLE `detail_simpananwajib` (
  `id` int(11) NOT NULL,
  `id_simpananwajib` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `jenis` varchar(32) DEFAULT NULL,
  `bulan_tahun` varchar(64) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_simpananwajib`
--

INSERT INTO `detail_simpananwajib` (`id`, `id_simpananwajib`, `waktu`, `jenis`, `bulan_tahun`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, '2018-07-18', 'Setoran', '2018-07', 200000, 0, '0', '0'),
(2, 1, '2018-07-22', 'Setoran', '2018-08', 50000, NULL, NULL, NULL),
(3, 1, '2018-08-26', 'Setoran', '2018-08', 100000, NULL, NULL, NULL),
(6, 1, '2018-08-26', 'Tarikan', '', 250000, NULL, NULL, NULL),
(7, 1, '2018-09-15', 'Setoran', '2018-09', 600000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kode_akun`
--

CREATE TABLE `kode_akun` (
  `id` int(11) NOT NULL,
  `kode_akun` varchar(32) DEFAULT NULL,
  `nama_akun` varchar(128) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kode_akun`
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
-- Table structure for table `mapping_kode_akun`
--

CREATE TABLE `mapping_kode_akun` (
  `id` int(11) NOT NULL,
  `nama_transaksi` varchar(128) DEFAULT NULL,
  `kode_debet` varchar(32) DEFAULT NULL,
  `kode_kredit` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapping_kode_akun`
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
(13, 'penerimaan simp kusus (shu)', '306', '303'),
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
(63, 'penerimaan simp kusus (phak 3)', '101', '303'),
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
-- Table structure for table `nasabah`
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
-- Dumping data for table `nasabah`
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
-- Table structure for table `pinjaman`
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
  `jumlah_pinjaman` int(11) DEFAULT NULL,
  `jumlah_angsuran` int(11) DEFAULT NULL,
  `angsuran_perbulan` int(11) DEFAULT NULL,
  `jasa_perbulan` double DEFAULT NULL,
  `total_angsuran_perbulan` double DEFAULT NULL,
  `sisa_angsuran` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_nasabah`, `jenis_pinjaman`, `nama_nasabah`, `nomor_nasabah`, `alamat_nasabah`, `nik_nasabah`, `jaminan`, `waktu`, `jatuh_tempo`, `jumlah_pinjaman`, `jumlah_angsuran`, `angsuran_perbulan`, `jasa_perbulan`, `total_angsuran_perbulan`, `sisa_angsuran`, `status`) VALUES
(1, 2, 'Angsuran', 'Arzak', 100002, NULL, '3576010807920001', 'BPKB Motor Vario 125 S 6576 BA', '2018-06-02', '2', 10000000, 10, 1000000, 200000, 1200000, 8000000, NULL),
(2, 1, 'Musiman', 'Yunan Helmi Mahendra', 100001, NULL, '3576010910940001', 'STNK Mobil', '2018-08-23', '23', 2000000, 10, 162500, 34125, 196625, 1137500, NULL),
(3, 1, 'Musiman', 'Yunan Helmi Mahendra', 100001, NULL, '3576010910940001', 'STNK Mobil Jazz', '2018-09-15', '15', 10000000, 10, 1000000, 300000, 1300000, 0, NULL),
(4, 1, 'Musiman', 'Yunan Helmi Mahendra', 100001, NULL, '3576010910940001', 'STNK Motor Vario S2345BV', '2018-12-12', '2', 2000000, 10, 200000, 60000, 260000, 2000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan3th`
--

CREATE TABLE `simpanan3th` (
  `id` int(11) NOT NULL,
  `id_master` int(11) NOT NULL,
  `nama_simpanan` varchar(64) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `jasa_total` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanan3th`
--

INSERT INTO `simpanan3th` (`id`, `id_master`, `nama_simpanan`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `total`, `jasa_total`, `waktu`) VALUES
(1, 1, 'Simpanan 3 Th Ke 17', 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 0, 0, '2018-09-02'),
(3, 1, 'Simpanan 3 Th Ke 17', 2, 'Arzak', 100002, '3576010807920001', 0, NULL, '2018-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan3th_master`
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
-- Dumping data for table `simpanan3th_master`
--

INSERT INTO `simpanan3th_master` (`id`, `nama`, `kode_debet_penerimaan_simp`, `kode_kredit_penerimaan_simp`, `kode_debet_pencairan_simp`, `kode_kredit_pencairan_simp`, `kode_debet_pencairan_hutang_jasa`, `kode_kredit_pencairan_hutang_jasa`, `kode_debet_pembayaran_jasa`, `kode_kredit_pembayaran_jasa`, `kode_debet_penyesuaian_jasa`, `kode_kredit_penyesuaian_jasa`) VALUES
(1, 'Simpanan 3 Th Ke 17', '101', '211', '213', '101', '214', '101', '514', '101', '514', '214');

-- --------------------------------------------------------

--
-- Table structure for table `simpanandanasosial`
--

CREATE TABLE `simpanandanasosial` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanandanasosial`
--

INSERT INTO `simpanandanasosial` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `total`, `waktu`) VALUES
(1, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 590000, '2018-08-08');

-- --------------------------------------------------------

--
-- Table structure for table `simpanankanzun`
--

CREATE TABLE `simpanankanzun` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanankanzun`
--

INSERT INTO `simpanankanzun` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `total`, `waktu`) VALUES
(1, 2, 'Arzak', 100002, '3576010807920001', 100000, '2018-08-12'),
(2, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 310000, '2018-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `simpanankhusus`
--

CREATE TABLE `simpanankhusus` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpanankhusus`
--

INSERT INTO `simpanankhusus` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `total`, `waktu`) VALUES
(2, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 600000, '2018-08-27'),
(3, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 0, '2018-11-23'),
(4, 5, 'Rangga Pradana', 200001, '3212010908890002', 200000, '2018-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `simpananpihakketiga`
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
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpananpihakketiga`
--

INSERT INTO `simpananpihakketiga` (`id`, `id_nasabah`, `nomor_nasabah`, `nama`, `nik`, `alamat`, `kota`, `kecamatan`, `kelurahan`, `dusun`, `rw`, `rt`, `telpon`, `pekerjaan`, `file_foto`, `waktu`, `total`) VALUES
(1, 1, 100001, 'Yunan Helmi Mahendra', '3576010910940001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-01', 1500000),
(2, 5, 200001, 'Rangga Pradana', '3212010908890002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-14', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `simpananpokok`
--

CREATE TABLE `simpananpokok` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `jenis` varchar(16) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` varchar(8) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpananpokok`
--

INSERT INTO `simpananpokok` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `jenis`, `jumlah`, `waktu`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', 'Setoran', 500000, '2018-07-19', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `simpananwajib`
--

CREATE TABLE `simpananwajib` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simpananwajib`
--

INSERT INTO `simpananwajib` (`id`, `id_nasabah`, `nama_nasabah`, `nomor_nasabah`, `nik_nasabah`, `waktu`, `total`) VALUES
(1, 1, 'Yunan Helmi Mahendra', 100001, '3576010910940001', '2018-07-19', 700000);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) NOT NULL,
  `id_nasabah` int(11) DEFAULT NULL,
  `nama_nasabah` varchar(128) DEFAULT NULL,
  `nomor_nasabah` int(11) DEFAULT NULL,
  `nik_nasabah` varchar(32) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_transaksi` varchar(128) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `kode_debet` varchar(32) DEFAULT NULL,
  `kode_kredit` varchar(32) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status_post` int(11) DEFAULT NULL,
  `id_debet_transaksi_akuntansi` int(11) DEFAULT NULL,
  `id_kredit_transaksi_akuntansi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `nama_transaksi`, `keterangan`, `kode_debet`, `kode_kredit`, `jumlah`, `status_post`, `id_debet_transaksi_akuntansi`, `id_kredit_transaksi_akuntansi`) VALUES
(1, '2018-12-11', 'pembelian ATK', 'Bulan Desember 2018', '532', '101', 1000000, 1, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_akuntansi`
--

CREATE TABLE `transaksi_akuntansi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `kode_akun` varchar(64) DEFAULT NULL,
  `nama_akun` varchar(64) DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `debet` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_akuntansi`
--

INSERT INTO `transaksi_akuntansi` (`id`, `tanggal`, `kode_akun`, `nama_akun`, `keterangan`, `jumlah`, `debet`, `kredit`) VALUES
(1, '2018-09-14', '101', 'Kas', 'Pemberian Pinjaman Anggota 100001', 1000000, 0, 1000000),
(2, '2018-09-14', '103', 'Pembiayaan (Piutang) diberikan', 'Pemberian Pinjaman Anggota 100001', 1000000, 1000000, 0),
(3, '2018-11-28', '101', 'Kas', 'Pembayaran Angsuran Anggota 100001', 500000, 500000, 0),
(4, '2018-11-28', '103', 'Pembiayaan (Piutang) diberikan', 'Pembayaran Angsuran Anggota 100001', 500000, 0, 500000),
(5, '2018-12-02', '531', 'Biaya Ziarah & Silaturahmi TTBH', 'Biaya Ziarah & Silaturahmi TTBH', 1000000, 1000000, 0),
(6, '2018-12-02', '101', 'Kas', 'Biaya Ziarah & Silaturahmi TTBH', 1000000, 0, 1000000),
(7, '2018-12-11', '532', 'ATK Koperasi', 'Bulan Desember 2018', 1000000, 1000000, 0),
(8, '2018-12-11', '101', 'Kas', 'Bulan Desember 2018', 1000000, 0, 1000000),
(9, '2018-08-23', '103', 'Pembiayaan (Piutang) diberikan', 'Pemberian Pinjaman kepada Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 1000000, 1000000, 0),
(10, '2018-08-23', '101', 'Kas', 'Pemberian Pinjaman kepada Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 1000000, 0, 1000000),
(11, '2018-08-23', '101', 'Kas', 'Pembayaran Angsuran Pinjaman Bulan ke-3 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 162500, 162500, 0),
(12, '2018-08-23', '103', 'Pembiayaan (Piutang) diberikan', 'Pembayaran Angsuran Pinjaman Bulan ke-3 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 162500, 0, 162500),
(13, '2018-08-23', '101', 'Kas', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-3 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 49000, 49000, 0),
(14, '2018-08-23', '401', 'Pendapatan jasa', 'Jasa Pembayaran Angsuran Pinjaman Bulan ke-3 Anggota a.n. Yunan Helmi Mahendra Nomor Anggota: 100001', 49000, 0, 49000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `detail_jasa_simpanan3th`
--
ALTER TABLE `detail_jasa_simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `detail_simpanan3th`
--
ALTER TABLE `detail_simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_simpanandanasosial`
--
ALTER TABLE `detail_simpanandanasosial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `detail_simpanankanzun`
--
ALTER TABLE `detail_simpanankanzun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detail_simpanankhusus`
--
ALTER TABLE `detail_simpanankhusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `detail_simpananpihakketiga`
--
ALTER TABLE `detail_simpananpihakketiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detail_simpananwajib`
--
ALTER TABLE `detail_simpananwajib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `simpanan3th`
--
ALTER TABLE `simpanan3th`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `simpanan3th_master`
--
ALTER TABLE `simpanan3th_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `simpanandanasosial`
--
ALTER TABLE `simpanandanasosial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `simpanankanzun`
--
ALTER TABLE `simpanankanzun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `simpanankhusus`
--
ALTER TABLE `simpanankhusus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `simpananpihakketiga`
--
ALTER TABLE `simpananpihakketiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `simpananpokok`
--
ALTER TABLE `simpananpokok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaksi_akuntansi`
--
ALTER TABLE `transaksi_akuntansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
