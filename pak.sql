-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2026 at 03:28 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@provsu.go.id', 'admin', 'admin', 1, '2026-01-10 08:44:09', '2026-01-10 08:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `ak_jenjang_jabatan`
--

CREATE TABLE `ak_jenjang_jabatan` (
  `kode` varchar(3) NOT NULL,
  `jenjang_jabatan` varchar(50) NOT NULL,
  `ak_min_pangkat` int(11) NOT NULL,
  `ak_min_jenjang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ak_jenjang_jabatan`
--

INSERT INTO `ak_jenjang_jabatan` (`kode`, `jenjang_jabatan`, `ak_min_pangkat`, `ak_min_jenjang`) VALUES
('AK1', 'Ahli Utama', 200, NULL),
('AK2', 'Ahli Madya', 150, 450),
('AK3', 'Ahli Muda', 100, 200),
('AK4', 'Ahli Pertama', 50, 100),
('AK5', 'Penyelia', 100, NULL),
('AK6', 'Mahir', 50, 100),
('AK7', 'Terampil', 20, 60),
('AK8', 'Pemula', 15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_penilaian_ak`
--

CREATE TABLE `hasil_penilaian_ak` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `pangkat` varchar(50) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `unit_kerja` varchar(100) DEFAULT NULL,
  `predikat_kinerja` varchar(30) DEFAULT NULL,
  `persentase_kinerja` decimal(5,2) DEFAULT NULL,
  `koefisien_ak` decimal(6,2) DEFAULT NULL,
  `faktor_periode` decimal(5,3) DEFAULT NULL,
  `bulan_awal` varchar(20) DEFAULT NULL,
  `bulan_akhir` varchar(20) DEFAULT NULL,
  `ak_lama` decimal(10,3) DEFAULT NULL,
  `ak_periode` decimal(10,3) DEFAULT NULL,
  `ak_tambahan` decimal(10,3) DEFAULT NULL,
  `total_ak` decimal(10,3) DEFAULT NULL,
  `tujuan_usulan` varchar(50) DEFAULT NULL,
  `status_hasil` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_pengajuan` enum('Diajukan','Disetujui','Ditolak') DEFAULT 'Diajukan',
  `approved_by` varchar(50) DEFAULT NULL,
  `nip_penilai` bigint(20) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_penilaian_ak`
--

INSERT INTO `hasil_penilaian_ak` (`id`, `nama`, `nip`, `pangkat`, `golongan`, `jabatan`, `unit_kerja`, `predikat_kinerja`, `persentase_kinerja`, `koefisien_ak`, `faktor_periode`, `bulan_awal`, `bulan_akhir`, `ak_lama`, `ak_periode`, `ak_tambahan`, `total_ak`, `tujuan_usulan`, `status_hasil`, `created_at`, `status_pengajuan`, `approved_by`, `nip_penilai`, `approved_at`, `alasan`) VALUES
(1, 'berliana', '1234567891099', 'Pengatur', 'II/c', 'Pemula', 'Pemerintah Provinsi Sumatera Utara', 'Baik', '100.00', '3.75', '1.000', 'Januari', 'Januari', '0.000', '3.750', '3.750', '7.500', 'Kenaikan Jabatan', 'Dapat dipertimbangkan kenaikan jenjang jabatan fungsional setingkat lebih tinggi', '2026-01-08 23:50:37', 'Disetujui', NULL, 0, '2026-01-10 09:54:36', NULL),
(2, 'berliana', '1234567891099', 'Pengatur', 'II/c', 'Pemula', 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '15.000', '5.625', '3.750', '3.750', 'Kenaikan Pangkat', 'Dapat dipertimbangkan kenaikan pangkat setingkat lebih tinggi', '2023-01-01 23:23:30', 'Disetujui', 'Ibunda', 1125234231, '2023-01-09 06:30:40', NULL),
(3, 'berliana', '1234567891099', 'Pengatur', 'II/c', 'Pemula', 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '15.000', '5.625', '3.750', '3.750', 'Kenaikan Jabatan', 'Dapat dipertimbangkan kenaikan jenjang jabatan fungsional setingkat lebih tinggi', '2022-01-10 00:07:18', 'Disetujui', 'ibunda', 1241241411, '2022-01-10 07:14:20', NULL),
(4, 'berliana', '1234567891099', 'Pengatur', 'II/c', 'Pemula', 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '15.000', '5.625', '3.750', '24.375', 'Kenaikan Jabatan', 'Dapat dipertimbangkan kenaikan jenjang jabatan fungsional setingkat lebih tinggi', '2026-01-10 00:08:37', 'Ditolak', NULL, NULL, '2026-01-10 09:54:51', 'Tidak Sesuai'),
(10, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '0.000', '5.625', 'Kenaikan Pangkat', 'Dapat dipertimbangkan kenaikan pangkat setingkat lebih tinggi', '2026-01-12 00:43:23', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL),
(11, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '0.000', '5.625', 'Kenaikan Pangkat', 'Dapat dipertimbangkan kenaikan pangkat setingkat lebih tinggi', '2026-01-12 00:44:00', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL),
(12, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '0.000', '5.625', 'Kenaikan Pangkat', 'Dapat dipertimbangkan kenaikan pangkat setingkat lebih tinggi', '2026-01-12 00:45:30', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL),
(13, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '3.750', '9.375', 'Kenaikan Pangkat', 'Belum dapat dipertimbangkan', '2026-01-12 00:50:08', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL),
(14, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '0.917', 'Januari', 'Desember', '0.000', '5.156', '3.750', '8.906', 'Kenaikan Pangkat', 'Belum dapat dipertimbangkan', '2026-01-12 00:51:13', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL),
(15, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', NULL, 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '3.750', '9.375', 'Kenaikan Pangkat', 'Belum dapat dipertimbangkan', '2026-01-12 00:52:27', 'Disetujui', 'ibunda', 12980024242424, '2026-01-12 03:13:58', NULL),
(16, 'BERLIANA', '1234567891099', 'Pemula', 'II/c', 'Pranata Komputer Terampil', 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '3.75', '1.000', 'Januari', 'Desember', '0.000', '5.625', '3.750', '9.375', 'Kenaikan Pangkat', 'Belum dapat dipertimbangkan', '2026-01-12 00:52:50', 'Disetujui', 'ibunda', 12980024242424, '2026-01-12 03:13:01', NULL),
(17, 'SUBUKHI SIMBOLON', '197404271994021002', 'Penata Tingkat I', 'III/d', 'Analis Sumber Daya Manusia Aparatur Ahli Muda', 'Pemerintah Provinsi Sumatera Utara', 'Sangat Baik', '150.00', '12.50', '1.000', 'Januari', 'Januari', '0.000', '18.750', '25.000', '43.750', 'Kenaikan Pangkat', 'Belum dapat dipertimbangkan', '2026-01-12 01:49:43', 'Diajukan', 'ibunda', 12980024242424, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenjang_jabatan`
--

CREATE TABLE `jenjang_jabatan` (
  `kode` varchar(2) NOT NULL,
  `jenjang_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenjang_jabatan`
--

INSERT INTO `jenjang_jabatan` (`kode`, `jenjang_jabatan`) VALUES
('J1', 'Ahli Utama'),
('J2', 'Ahli Madya'),
('J3', 'Ahli Muda'),
('J4', 'Ahli Pertama'),
('J5', 'Penyelia'),
('J6', 'Mahir'),
('J7', 'Terampil'),
('J8', 'Pemula');

-- --------------------------------------------------------

--
-- Table structure for table `koefisien_jabatan`
--

CREATE TABLE `koefisien_jabatan` (
  `kode` varchar(3) NOT NULL,
  `jenjang_jabatan` varchar(50) NOT NULL,
  `koefisien` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `koefisien_jabatan`
--

INSERT INTO `koefisien_jabatan` (`kode`, `jenjang_jabatan`, `koefisien`) VALUES
('KF1', 'Ahli Utama', '50.00'),
('KF2', 'Ahli Madya', '37.50'),
('KF3', 'Ahli Muda', '25.00'),
('KF4', 'Ahli Pertama', '12.50'),
('KF5', 'Penyelia', '25.00'),
('KF6', 'Mahir', '12.50'),
('KF7', 'Terampil', '5.00'),
('KF8', 'Pemula', '3.75');

-- --------------------------------------------------------

--
-- Table structure for table `parameter_jenjang_awal`
--

CREATE TABLE `parameter_jenjang_awal` (
  `kode` varchar(3) NOT NULL,
  `tujuan_usulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter_jenjang_awal`
--

INSERT INTO `parameter_jenjang_awal` (`kode`, `tujuan_usulan`) VALUES
('JA1', 'Terampil'),
('JA2', 'Ahli Pertama');

-- --------------------------------------------------------

--
-- Table structure for table `parameter_pangkat_awal`
--

CREATE TABLE `parameter_pangkat_awal` (
  `kode` varchar(3) NOT NULL,
  `tujuan_usulan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parameter_pangkat_awal`
--

INSERT INTO `parameter_pangkat_awal` (`kode`, `tujuan_usulan`) VALUES
('PA1', 'II/c'),
('PA2', 'III/b');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idprimary` int(11) NOT NULL,
  `NIP` bigint(20) NOT NULL,
  `nomor_kartu` bigint(20) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `instansipendidikan` varchar(255) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `tmt_pangkat` date NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `jenjang` varchar(255) DEFAULT NULL,
  `tmt_jabatan` date NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `tanggal_gabung` date DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_gelar` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nomor_telepon` bigint(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idprimary`, `NIP`, `nomor_kartu`, `tempat_lahir`, `tanggal_lahir`, `pendidikan_terakhir`, `instansipendidikan`, `prodi`, `pangkat`, `golongan`, `tmt_pangkat`, `jabatan`, `jenjang`, `tmt_jabatan`, `unit_kerja`, `instansi`, `tanggal_gabung`, `nama`, `nama_gelar`, `alamat`, `nomor_telepon`, `username`, `password`, `jenis_kelamin`) VALUES
(1, 1234567891099, 5546, 'kario', '1990-10-01', 'D3', 'Universitas', 'Program', 'Pemula', 'II/c', '2024-01-10', 'Pranata Komputer Terampil', 'Ahli Utama', '2024-01-10', 'Pengembangan', 'Pemerintah Provinsi Sumatera Utara', NULL, 'berliana', NULL, NULL, NULL, 'berliana', 'berliana', 'perempuan'),
(2, 199110242019032017, NULL, 'TANAH DATAR', '1991-10-24', NULL, NULL, NULL, 'Penata Muda', 'III/a', '2025-11-01', 'Arsiparis Terampil', 'Ahli Madya', '2021-12-21', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'LAILATUL RAHMI', NULL, NULL, NULL, 'laila', 'laila', 'Wanita'),
(3, 199609052020121009, NULL, 'LANGKAT', '1996-09-05', NULL, NULL, NULL, 'Pengatur Tingkat I', 'II/d', '2025-11-01', 'Pranata Komputer Terampil', 'Ahli Muda', '2022-05-31', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'IMAM MA\'ARIF HASIBUAN', NULL, NULL, NULL, 'imam', 'imam', 'Laki-Laki'),
(4, 197404271994021002, NULL, 'MEDAN', '1974-04-27', NULL, NULL, NULL, 'Penata Tingkat I', 'III/d', '2015-10-01', 'Analis Sumber Daya Manusia Aparatur Ahli Muda', 'Ahli Pertama', '2021-12-30', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'SUBUKHI SIMBOLON', NULL, NULL, NULL, 'subu', 'subu', 'Laki-Laki'),
(5, 197512022007011003, NULL, 'MEDAN', '1975-12-02', NULL, NULL, NULL, 'Pembina', 'IV/a', '2022-10-01', 'Analis Sumber Daya Manusia Aparatur Ahli Madya', 'Penyelia', '2025-01-30', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'MUHAMMAD ARSYAD SIREGAR', NULL, NULL, NULL, 'muhammad', 'muhammad', 'Laki-Laki'),
(6, 197209301993032001, NULL, 'NIAS', '1972-09-30', NULL, NULL, NULL, 'Pembina', 'IV/a', '2025-10-01', 'Analis Sumber Daya Manusia Aparatur Ahli Madya', 'Mahir', '2025-06-10', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'SERIAWATI ZAMASI', NULL, NULL, NULL, 'seriawati', 'seriawati', 'Wanita'),
(7, 198410022011011004, NULL, 'HALONGONAN', '1984-10-02', NULL, NULL, NULL, 'Penata Tingkat I', 'III/d', '2024-12-01', 'Analis Sumber Daya Manusia Aparatur Ahli Muda', 'Terampil', '2021-12-31', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'IRPAN HAMONANGAN SIREGAR', NULL, NULL, NULL, 'irpan', 'irpan', 'Laki-Laki'),
(8, 197402151993031002, NULL, 'MEDAN', '1974-02-15', NULL, NULL, NULL, 'Penata Tingkat I', 'III/d', '2013-04-01', 'Analis Sumber Daya Manusia Aparatur Ahli Muda', 'Pemula', '2021-12-30', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'DADANG ANSARI', NULL, NULL, NULL, 'dadang', 'dadang', 'Laki-Laki'),
(9, 197909052008011002, NULL, 'DELI SERDANG', '1979-09-05', NULL, NULL, NULL, 'Penata Muda Tingkat I', 'III/b', '2025-02-01', 'Analis Sumber Daya Manusia Aparatur Ahli Pertama', 'Ahli Utama', '2022-11-17', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'BUDI RAIS', NULL, NULL, NULL, 'budi', 'budi', 'Laki-Laki'),
(15, 198601102020121007, NULL, 'SIBOLGA', '1986-01-10', NULL, NULL, NULL, 'Pengatur Tingkat I', 'II/d', '2025-02-01', 'Pranata Komputer Terampil', 'Ahli Madya', '2022-09-09', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'RAHMAD RUDIANSYAH SIREGAR', NULL, NULL, NULL, 'rahmad', 'rahmad', 'Laki-Laki'),
(16, 198405242009032007, NULL, 'TANJUNG ANOM', '1984-05-24', NULL, NULL, NULL, 'Penata Muda Tingkat I', 'III/b', '2021-04-01', 'Asesor Sumber Daya Manusia Aparatur Ahli Pertama', 'Ahli Muda', '2025-01-30', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'YAYUK SURYANINGSIH', NULL, NULL, NULL, 'yayuk', 'yayuk', 'Wanita'),
(17, 199508142016092001, NULL, 'OGAN KOMERING ULU', '1995-08-14', NULL, NULL, NULL, 'Penata Muda Tingkat I', 'III/b', '2020-10-01', 'Analis Sumber Daya Manusia Aparatur Ahli Pertama', 'Ahli Pertama', '2023-01-20', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'AGINTA CAROLINA GINTING', NULL, NULL, NULL, 'aginta', 'aginta', 'Wanita'),
(18, 197403301994021002, NULL, 'SIMALUNGUN', '1974-03-30', NULL, NULL, NULL, 'Pembina Utama Muda', 'IV/c', '2026-01-01', 'Asesor Sumber Daya Manusia Aparatur Ahli Madya', 'Penyelia', '2024-08-27', 'BPSDM', 'Pemerintah Provinsi Sumatera Utara', NULL, 'ALIA GANI MANURUNG', NULL, NULL, NULL, 'alia', 'alia', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_lebih_tinggi`
--

CREATE TABLE `pendidikan_lebih_tinggi` (
  `kode` varchar(3) NOT NULL,
  `pendidikan` varchar(10) NOT NULL,
  `nilai_tambahan` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan_lebih_tinggi`
--

INSERT INTO `pendidikan_lebih_tinggi` (`kode`, `pendidikan`, `nilai_tambahan`) VALUES
('PD1', 'Ya', '25.00'),
('PD2', 'Tidak', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `periode_penilaian`
--

CREATE TABLE `periode_penilaian` (
  `kode` varchar(3) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `faktor` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode_penilaian`
--

INSERT INTO `periode_penilaian` (`kode`, `periode`, `faktor`) VALUES
('PP1', 'Tahunan (12 bulan)', '1.00'),
('PP2', 'Periodik (<12 bulan)', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `predikat_kinerja`
--

CREATE TABLE `predikat_kinerja` (
  `kode` varchar(2) NOT NULL,
  `predikat` varchar(50) NOT NULL,
  `presentase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predikat_kinerja`
--

INSERT INTO `predikat_kinerja` (`kode`, `predikat`, `presentase`) VALUES
('P1', 'Sangat Baik', 150),
('P2', 'Baik', 100),
('P3', 'Butuh Perbaikan', 75),
('P4', 'Kurang', 50),
('P5', 'Sangat Kurang', 25);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan_pangkat`
--

CREATE TABLE `riwayat_jabatan_pangkat` (
  `id` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `pangkat_lama` varchar(50) DEFAULT NULL,
  `golongan_lama` varchar(20) DEFAULT NULL,
  `jabatan_lama` varchar(100) DEFAULT NULL,
  `tmt_pangkat_lama` date DEFAULT NULL,
  `tmt_jabatan_lama` date DEFAULT NULL,
  `jenis_usulan` varchar(50) DEFAULT NULL,
  `pak_id` int(11) DEFAULT NULL,
  `disetujui_pada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_kelayakan`
--

CREATE TABLE `status_kelayakan` (
  `kode` varchar(2) NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_kelayakan`
--

INSERT INTO `status_kelayakan` (`kode`, `status`) VALUES
('H1', 'Dapat dipertimbangkan kenaikan pangkat setingkat lebih tinggi'),
('H2', 'Dapat dipertimbangkan kenaikan jenjang jabatan fungsional setingkat lebih tinggi'),
('H3', 'Belum dapat dipertimbangkan');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan_usulan`
--

CREATE TABLE `tujuan_usulan` (
  `kode` varchar(2) NOT NULL,
  `tujuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tujuan_usulan`
--

INSERT INTO `tujuan_usulan` (`kode`, `tujuan`) VALUES
('T1', 'Kenaikan Pangkat'),
('T2', 'Kenaikan Jenjang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ak_jenjang_jabatan`
--
ALTER TABLE `ak_jenjang_jabatan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `hasil_penilaian_ak`
--
ALTER TABLE `hasil_penilaian_ak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenjang_jabatan`
--
ALTER TABLE `jenjang_jabatan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `koefisien_jabatan`
--
ALTER TABLE `koefisien_jabatan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `parameter_jenjang_awal`
--
ALTER TABLE `parameter_jenjang_awal`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `parameter_pangkat_awal`
--
ALTER TABLE `parameter_pangkat_awal`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idprimary`),
  ADD UNIQUE KEY `UNIQUE` (`idprimary`),
  ADD UNIQUE KEY `NIP` (`NIP`);

--
-- Indexes for table `pendidikan_lebih_tinggi`
--
ALTER TABLE `pendidikan_lebih_tinggi`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `periode_penilaian`
--
ALTER TABLE `periode_penilaian`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `predikat_kinerja`
--
ALTER TABLE `predikat_kinerja`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `riwayat_jabatan_pangkat`
--
ALTER TABLE `riwayat_jabatan_pangkat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_kelayakan`
--
ALTER TABLE `status_kelayakan`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tujuan_usulan`
--
ALTER TABLE `tujuan_usulan`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hasil_penilaian_ak`
--
ALTER TABLE `hasil_penilaian_ak`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idprimary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `riwayat_jabatan_pangkat`
--
ALTER TABLE `riwayat_jabatan_pangkat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
