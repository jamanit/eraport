-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 03:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eraport`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL,
  `id_jadwal_pelajaran` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Sakit','Izin','Tanpa Keterangan') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id`, `id_jadwal_pelajaran`, `id_siswa`, `tanggal`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 84, 51, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(2, 84, 52, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(3, 84, 53, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(4, 84, 54, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(5, 84, 55, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(6, 84, 56, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(7, 84, 57, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(8, 84, 58, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(9, 84, 59, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(10, 84, 60, '2024-11-13', 'Hadir', '', '2024-11-13 14:05:17', '2024-11-13 07:05:46'),
(11, 83, 51, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(12, 83, 52, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(13, 83, 53, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(14, 83, 54, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(15, 83, 55, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(16, 83, 56, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(17, 83, 57, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(18, 83, 58, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(19, 83, 59, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29'),
(20, 83, 60, '2024-11-13', 'Tanpa Keterangan', '', '2024-11-13 14:06:01', '2024-11-13 14:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekstra_kurikuler`
--

CREATE TABLE `tb_ekstra_kurikuler` (
  `id` int(11) NOT NULL,
  `id_rapor_siswa` int(11) DEFAULT NULL,
  `jenis_kegiatan_1` varchar(50) DEFAULT NULL,
  `nilai_1` varchar(20) DEFAULT NULL,
  `jenis_kegiatan_2` varchar(50) DEFAULT NULL,
  `nilai_2` varchar(20) DEFAULT NULL,
  `jenis_kegiatan_3` varchar(50) DEFAULT NULL,
  `nilai_3` varchar(20) DEFAULT NULL,
  `jenis_kegiatan_4` varchar(50) DEFAULT NULL,
  `nilai_4` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_pelajaran`
--

CREATE TABLE `tb_jadwal_pelajaran` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') DEFAULT NULL,
  `jam_ke` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jadwal_pelajaran`
--

INSERT INTO `tb_jadwal_pelajaran` (`id`, `id_kelas`, `id_mapel`, `hari`, `jam_ke`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(2, 1, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(3, 1, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(4, 1, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(5, 1, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(6, 1, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(7, 1, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(8, 1, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(9, 1, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(10, 1, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(11, 1, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(12, 1, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(13, 1, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(14, 1, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(15, 2, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(16, 2, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(17, 2, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(18, 2, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(19, 2, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(20, 2, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(21, 2, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(22, 2, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(23, 2, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(24, 2, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(25, 2, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(26, 2, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(27, 2, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(28, 2, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(29, 3, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(30, 3, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(31, 3, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(32, 3, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(33, 3, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(34, 3, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(35, 3, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(36, 3, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(37, 3, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(38, 3, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(39, 3, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(40, 3, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(41, 3, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(42, 3, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(43, 4, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(44, 4, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(45, 4, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(46, 4, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(47, 4, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(48, 4, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(49, 4, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(50, 4, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(51, 4, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(52, 4, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(53, 4, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(54, 4, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(55, 4, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(56, 4, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(57, 5, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(58, 5, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(59, 5, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(60, 5, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(61, 5, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(62, 5, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(63, 5, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(64, 5, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(65, 5, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(66, 5, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(67, 5, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(68, 5, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(69, 5, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(70, 5, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(71, 6, 1, 'Senin', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(72, 6, 2, 'Senin', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(73, 6, 3, 'Senin', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(74, 6, 4, 'Senin', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(75, 6, 5, 'Selasa', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(76, 6, 6, 'Selasa', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(77, 6, 7, 'Selasa', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(78, 6, 8, 'Selasa', 4, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(79, 6, 9, 'Rabu', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(80, 6, 10, 'Rabu', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(81, 6, 11, 'Rabu', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(82, 6, 12, 'Kamis', 1, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(83, 6, 13, 'Kamis', 2, '2024-11-13 12:54:42', '2024-11-13 12:54:42'),
(84, 6, 14, 'Kamis', 3, '2024-11-13 12:54:42', '2024-11-13 12:54:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `id_guru_wali` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id`, `id_tahun_ajaran`, `nama_kelas`, `id_guru_wali`, `created_at`, `updated_at`) VALUES
(1, 1, 'X A', 2, '2024-11-13 09:51:57', '2024-11-13 09:53:03'),
(2, 1, 'X B', 6, '2024-11-13 09:52:11', '2024-11-13 09:53:09'),
(3, 1, 'XI A', 3, '2024-11-13 09:52:31', '2024-11-13 09:52:57'),
(4, 1, 'XI B', 5, '2024-11-13 09:52:49', '2024-11-13 09:52:49'),
(5, 1, 'XII A', 4, '2024-11-13 09:53:26', '2024-11-13 09:54:14'),
(6, 1, 'XII B', 7, '2024-11-13 09:54:06', '2024-11-13 09:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kepribadian`
--

CREATE TABLE `tb_kepribadian` (
  `id` int(11) NOT NULL,
  `id_rapor_siswa` int(11) DEFAULT NULL,
  `aspek_1` varchar(100) DEFAULT NULL,
  `keterangan_1` text DEFAULT NULL,
  `aspek_2` varchar(100) DEFAULT NULL,
  `keterangan_2` text DEFAULT NULL,
  `aspek_3` varchar(100) DEFAULT NULL,
  `keterangan_3` text DEFAULT NULL,
  `aspek_4` varchar(100) DEFAULT NULL,
  `keterangan_4` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mata_pelajaran`
--

CREATE TABLE `tb_mata_pelajaran` (
  `id` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL,
  `id_guru` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_mata_pelajaran`
--

INSERT INTO `tb_mata_pelajaran` (`id`, `id_tahun_ajaran`, `nama_mapel`, `id_guru`, `created_at`, `updated_at`) VALUES
(1, 1, 'Matematika', 1, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(2, 1, 'Fisika', 1, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(3, 1, 'Bahasa Indonesia', 2, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(4, 1, 'Sejarah', 2, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(5, 1, 'Biologi', 3, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(6, 1, 'Kimia', 3, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(7, 1, 'Pendidikan Agama', 4, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(8, 1, 'Pendidikan Kewarganegaraan', 4, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(9, 1, 'Geografi', 5, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(10, 1, 'Sosiologi', 5, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(11, 1, 'Ekonomi', 6, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(12, 1, 'Seni Budaya', 6, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(13, 1, 'Olahraga', 7, '2024-11-13 12:40:05', '2024-11-13 12:40:05'),
(14, 1, 'Bahasa Inggris', 7, '2024-11-13 12:40:05', '2024-11-13 12:40:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_siswa`
--

CREATE TABLE `tb_nilai_siswa` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `kkm` varchar(10) NOT NULL,
  `nilai_hasil_pengetahuan_angka` varchar(10) NOT NULL,
  `nilai_hasil_pengetahuan_huruf` varchar(255) NOT NULL,
  `nilai_hasil_praktik_angka` varchar(10) NOT NULL,
  `nilai_hasil_praktik_huruf` varchar(255) NOT NULL,
  `sikap_efektif_predikat` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nilai_siswa`
--

INSERT INTO `tb_nilai_siswa` (`id`, `id_kelas`, `id_siswa`, `id_mapel`, `kkm`, `nilai_hasil_pengetahuan_angka`, `nilai_hasil_pengetahuan_huruf`, `nilai_hasil_praktik_angka`, `nilai_hasil_praktik_huruf`, `sikap_efektif_predikat`, `created_at`, `updated_at`) VALUES
(1, 6, 53, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:36:58', '2024-11-13 13:36:58'),
(2, 6, 54, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:37:04', '2024-11-13 13:37:04'),
(3, 6, 55, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:37:04', '2024-11-13 13:37:04'),
(4, 6, 56, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:37:04', '2024-11-13 13:37:04'),
(5, 6, 57, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:37:08', '2024-11-13 13:37:08'),
(6, 6, 58, 3, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:37:11', '2024-11-13 13:37:11'),
(7, 6, 59, 3, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:37:11', '2024-11-13 13:37:11'),
(8, 6, 60, 3, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:37:11', '2024-11-13 13:37:11'),
(9, 6, 51, 3, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:37:11', '2024-11-13 13:37:11'),
(10, 6, 52, 3, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:37:11', '2024-11-13 13:37:11'),
(11, 6, 53, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(12, 6, 54, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(13, 6, 55, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(14, 6, 56, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(15, 6, 57, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(16, 6, 58, 14, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(17, 6, 59, 14, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(18, 6, 60, 14, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(19, 6, 51, 14, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(20, 6, 52, 14, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:39:11', '2024-11-13 13:39:11'),
(21, 6, 53, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(22, 6, 54, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(23, 6, 55, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(24, 6, 56, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(25, 6, 57, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(26, 6, 58, 5, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(27, 6, 59, 5, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(28, 6, 60, 5, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(29, 6, 51, 5, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(30, 6, 52, 5, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:39', '2024-11-13 13:40:39'),
(31, 6, 53, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(32, 6, 54, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(33, 6, 55, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(34, 6, 56, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(35, 6, 57, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(36, 6, 58, 11, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(37, 6, 59, 11, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(38, 6, 60, 11, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(39, 6, 51, 11, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(40, 6, 52, 11, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:40:57', '2024-11-13 13:40:57'),
(41, 6, 53, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(42, 6, 54, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(43, 6, 55, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(44, 6, 56, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(45, 6, 57, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(46, 6, 58, 2, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(47, 6, 59, 2, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(48, 6, 60, 2, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(49, 6, 51, 2, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(50, 6, 52, 2, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:21', '2024-11-13 13:41:21'),
(51, 6, 53, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(52, 6, 54, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(53, 6, 55, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(54, 6, 56, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(55, 6, 57, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(56, 6, 58, 9, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(57, 6, 59, 9, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(58, 6, 60, 9, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(59, 6, 51, 9, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(60, 6, 52, 9, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:39', '2024-11-13 13:41:39'),
(61, 6, 53, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(62, 6, 54, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(63, 6, 55, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(64, 6, 56, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(65, 6, 57, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(66, 6, 58, 6, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(67, 6, 59, 6, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(68, 6, 60, 6, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(69, 6, 51, 6, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(70, 6, 52, 6, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:41:58', '2024-11-13 13:41:58'),
(71, 6, 53, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(72, 6, 54, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(73, 6, 55, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(74, 6, 56, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(75, 6, 57, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(76, 6, 58, 1, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(77, 6, 59, 1, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(78, 6, 60, 1, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(79, 6, 51, 1, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(80, 6, 52, 1, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:12', '2024-11-13 13:42:12'),
(81, 6, 53, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(82, 6, 54, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(83, 6, 55, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(84, 6, 56, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(85, 6, 57, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(86, 6, 58, 13, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(87, 6, 59, 13, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(88, 6, 60, 13, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(89, 6, 51, 13, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(90, 6, 52, 13, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:35', '2024-11-13 13:42:35'),
(91, 6, 53, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(92, 6, 54, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(93, 6, 55, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(94, 6, 56, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(95, 6, 57, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(96, 6, 58, 7, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(97, 6, 59, 7, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(98, 6, 60, 7, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(99, 6, 51, 7, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(100, 6, 52, 7, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:42:47', '2024-11-13 13:42:47'),
(101, 6, 53, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(102, 6, 54, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(103, 6, 55, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(104, 6, 56, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(105, 6, 57, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(106, 6, 58, 8, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(107, 6, 59, 8, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(108, 6, 60, 8, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(109, 6, 51, 8, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(110, 6, 52, 8, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:02', '2024-11-13 13:43:02'),
(111, 6, 53, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(112, 6, 54, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(113, 6, 55, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(114, 6, 56, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(115, 6, 57, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(116, 6, 58, 4, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(117, 6, 59, 4, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(118, 6, 60, 4, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(119, 6, 51, 4, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(120, 6, 52, 4, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:35', '2024-11-13 13:43:35'),
(121, 6, 53, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(122, 6, 54, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(123, 6, 55, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(124, 6, 56, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(125, 6, 57, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(126, 6, 58, 12, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(127, 6, 59, 12, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(128, 6, 60, 12, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(129, 6, 51, 12, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(130, 6, 52, 12, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:43:52', '2024-11-13 13:43:52'),
(131, 6, 53, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(132, 6, 54, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(133, 6, 55, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(134, 6, 56, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'A', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(135, 6, 57, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(136, 6, 58, 10, '70', '70', 'Tujuh Puluh', '70', 'Tujuh Puluh', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(137, 6, 59, 10, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(138, 6, 60, 10, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(139, 6, 51, 10, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08'),
(140, 6, 52, 10, '85', '85', 'Delapan Puluh Lima', '85', 'Delapan Puluh Lima', 'B', '2024-11-13 13:44:08', '2024-11-13 13:44:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_peran` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `nama`, `email`, `password`, `id_peran`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$7Ekn9az71.u04WCAb6nXGuBeoWa23BLp1xP1uSYkdcBkB0DMll6ai', 1, '2024-11-04 05:00:03', '2024-11-07 04:49:55'),
(2, 'Agung Prasetyo', 'agungprasetyo@gmail.com', '$2y$10$i6BkzzKNfSF1ocmY8H3XW.rKdElHBFO/yO/wq4jEx97sWtI.DRKqe', 2, '2024-11-07 02:03:43', '2024-11-13 09:46:47'),
(3, 'Sarlina Putri', 'sarlinaputri@gmail.com', '$2y$10$3f3B0AF/zzdMrJCFJKNmu.KydSAzQTgxQf6Ok3gU5eDHIDf2xbAfe', 2, '2024-11-07 02:04:36', '2024-11-13 09:47:04'),
(4, 'Via Okta', 'viaokta@gmail.com', '$2y$10$zQRkkIvTgiBlSPkfpbISVuCpJWtf5n57UPSPccbEAT2hRwM4Tvimy', 2, '2024-11-13 09:45:10', '2024-11-13 09:46:03'),
(5, 'Sugiyarti', 'sugiyarti@gmail.com', '$2y$10$AF1iBrvyOmeEpVoeY6RdxORErEaic7tCAOfnxbH7sNhDmP1RI38jq', 2, '2024-11-13 09:45:43', '2024-11-13 09:46:12'),
(6, 'Bagas Rindaman', 'bagasrindaman@gmail.com', '$2y$10$YeEMyvfcniP.bvMumoGxP.SvzomUUfYMH3PDLSSM31.xjrkRoInIO', 2, '2024-11-13 09:47:31', '2024-11-13 09:47:31'),
(7, 'Riki David', 'rikidavid@gmail.com', '$2y$10$c1zvKerDS1oQb.ayLrFu1OsiH8E6sg9bTK5s0Ewr5JmbTszRxvyaS', 2, '2024-11-13 09:53:52', '2024-11-13 09:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_peran`
--

CREATE TABLE `tb_peran` (
  `id` int(11) NOT NULL,
  `nama_peran` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peran`
--

INSERT INTO `tb_peran` (`id`, `nama_peran`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-11-04 03:55:10', '2024-11-04 03:55:10'),
(2, 'Guru', '2024-11-04 03:55:25', '2024-11-04 03:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rapor_siswa`
--

CREATE TABLE `tb_rapor_siswa` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `hasil_keputusan` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_rapor_siswa`
--

INSERT INTO `tb_rapor_siswa` (`id`, `id_kelas`, `id_siswa`, `catatan`, `hasil_keputusan`, `created_at`, `updated_at`) VALUES
(6, 1, 3, '43222200', 'Naik Kelas', '2024-11-13 09:33:18', '2024-11-13 09:33:18'),
(8, 5, 4, NULL, NULL, '2024-11-13 07:28:16', '2024-11-13 07:28:16'),
(9, 5, 2, NULL, NULL, '2024-11-13 07:28:16', '2024-11-13 07:28:16'),
(10, 6, 53, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(11, 6, 54, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(12, 6, 55, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(13, 6, 56, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(14, 6, 57, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(15, 6, 58, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(16, 6, 59, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(17, 6, 60, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(18, 6, 51, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25'),
(19, 6, 52, NULL, NULL, '2024-11-13 13:11:25', '2024-11-13 13:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `nisn`, `nama_siswa`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `id_kelas`, `created_at`, `updated_at`) VALUES
(1, '1234567890', 'Andi Setiawan', 'Laki-Laki', '2005-01-01', 'Jl. Merdeka No.1, Jakarta', '081234567890', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(2, '1234567891', 'Budi Santoso', 'Laki-Laki', '2005-02-02', 'Jl. Merdeka No.2, Jakarta', '081234567891', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(3, '1234567892', 'Citra Puspitasari', 'Perempuan', '2005-03-03', 'Jl. Merdeka No.3, Jakarta', '081234567892', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(4, '1234567893', 'Dian Nuryani', 'Perempuan', '2005-04-04', 'Jl. Merdeka No.4, Jakarta', '081234567893', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(5, '1234567894', 'Eko Prabowo', 'Laki-Laki', '2005-05-05', 'Jl. Merdeka No.5, Jakarta', '081234567894', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(6, '1234567895', 'Fina Indriani', 'Perempuan', '2005-06-06', 'Jl. Merdeka No.6, Jakarta', '081234567895', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(7, '1234567896', 'Gilang Nugroho', 'Laki-Laki', '2005-07-07', 'Jl. Merdeka No.7, Jakarta', '081234567896', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(8, '1234567897', 'Hilda Wati', 'Perempuan', '2005-08-08', 'Jl. Merdeka No.8, Jakarta', '081234567897', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(9, '1234567898', 'Irwan Suryo', 'Laki-Laki', '2005-09-09', 'Jl. Merdeka No.9, Jakarta', '081234567898', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(10, '1234567899', 'Jeni Maharani', 'Perempuan', '2005-10-10', 'Jl. Merdeka No.10, Jakarta', '081234567899', 1, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(11, '2234567890', 'Krisna Wijaya', 'Laki-Laki', '2005-01-01', 'Jl. Raya No.1, Surabaya', '081234567900', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(12, '2234567891', 'Lina Sari', 'Perempuan', '2005-02-02', 'Jl. Raya No.2, Surabaya', '081234567901', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(13, '2234567892', 'Maya Permata', 'Perempuan', '2005-03-03', 'Jl. Raya No.3, Surabaya', '081234567902', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(14, '2234567893', 'Nando Adi', 'Laki-Laki', '2005-04-04', 'Jl. Raya No.4, Surabaya', '081234567903', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(15, '2234567894', 'Oki Gunawan', 'Laki-Laki', '2005-05-05', 'Jl. Raya No.5, Surabaya', '081234567904', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(16, '2234567895', 'Putu Ningsih', 'Perempuan', '2005-06-06', 'Jl. Raya No.6, Surabaya', '081234567905', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(17, '2234567896', 'Qori Suci', 'Perempuan', '2005-07-07', 'Jl. Raya No.7, Surabaya', '081234567906', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(18, '2234567897', 'Randy Pranata', 'Laki-Laki', '2005-08-08', 'Jl. Raya No.8, Surabaya', '081234567907', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(19, '2234567898', 'Sari Septiani', 'Perempuan', '2005-09-09', 'Jl. Raya No.9, Surabaya', '081234567908', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(20, '2234567899', 'Tio Santosa', 'Laki-Laki', '2005-10-10', 'Jl. Raya No.10, Surabaya', '081234567909', 2, '2024-11-13 12:45:48', '2024-11-13 12:45:48'),
(21, '3234567890', 'Umar Hakim', 'Laki-Laki', '2005-01-01', 'Jl. Merdeka No.1, Bandung', '081234567910', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(22, '3234567891', 'Vina Puspitasari', 'Perempuan', '2005-02-02', 'Jl. Merdeka No.2, Bandung', '081234567911', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(23, '3234567892', 'Wahyu Saputra', 'Laki-Laki', '2005-03-03', 'Jl. Merdeka No.3, Bandung', '081234567912', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(24, '3234567893', 'Xenia Rizky', 'Perempuan', '2005-04-04', 'Jl. Merdeka No.4, Bandung', '081234567913', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(25, '3234567894', 'Yudi Saputra', 'Laki-Laki', '2005-05-05', 'Jl. Merdeka No.5, Bandung', '081234567914', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(26, '3234567895', 'Zulaikha Kurnia', 'Perempuan', '2005-06-06', 'Jl. Merdeka No.6, Bandung', '081234567915', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(27, '3234567896', 'Aditya Wijaya', 'Laki-Laki', '2005-07-07', 'Jl. Merdeka No.7, Bandung', '081234567916', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(28, '3234567897', 'Bella Desi', 'Perempuan', '2005-08-08', 'Jl. Merdeka No.8, Bandung', '081234567917', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(29, '3234567898', 'Cahya Darma', 'Laki-Laki', '2005-09-09', 'Jl. Merdeka No.9, Bandung', '081234567918', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(30, '3234567899', 'Dina Wulandari', 'Perempuan', '2005-10-10', 'Jl. Merdeka No.10, Bandung', '081234567919', 3, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(31, '4234567890', 'Eka Pratama', 'Laki-Laki', '2005-01-01', 'Jl. Raya No.1, Yogyakarta', '081234567920', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(32, '4234567891', 'Fitria Sari', 'Perempuan', '2005-02-02', 'Jl. Raya No.2, Yogyakarta', '081234567921', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(33, '4234567892', 'Gandhi Rendra', 'Laki-Laki', '2005-03-03', 'Jl. Raya No.3, Yogyakarta', '081234567922', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(34, '4234567893', 'Hilda Santika', 'Perempuan', '2005-04-04', 'Jl. Raya No.4, Yogyakarta', '081234567923', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(35, '4234567894', 'Iwan Kurniawan', 'Laki-Laki', '2005-05-05', 'Jl. Raya No.5, Yogyakarta', '081234567924', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(36, '4234567895', 'Jannah Safira', 'Perempuan', '2005-06-06', 'Jl. Raya No.6, Yogyakarta', '081234567925', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(37, '4234567896', 'Kiran Saputra', 'Laki-Laki', '2005-07-07', 'Jl. Raya No.7, Yogyakarta', '081234567926', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(38, '4234567897', 'Lina Fitria', 'Perempuan', '2005-08-08', 'Jl. Raya No.8, Yogyakarta', '081234567927', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(39, '4234567898', 'Maya Sari', 'Perempuan', '2005-09-09', 'Jl. Raya No.9, Yogyakarta', '081234567928', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(40, '4234567899', 'Niko Wijaya', 'Laki-Laki', '2005-10-10', 'Jl. Raya No.10, Yogyakarta', '081234567929', 4, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(41, '5234567890', 'Omar Farouk', 'Laki-Laki', '2005-01-01', 'Jl. Raya No.1, Semarang', '081234567930', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(42, '5234567891', 'Putu Wirawan', 'Laki-Laki', '2005-02-02', 'Jl. Raya No.2, Semarang', '081234567931', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(43, '5234567892', 'Qiana Sari', 'Perempuan', '2005-03-03', 'Jl. Raya No.3, Semarang', '081234567932', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(44, '5234567893', 'Rika Puspitasari', 'Perempuan', '2005-04-04', 'Jl. Raya No.4, Semarang', '081234567933', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(45, '5234567894', 'Sena Aditya', 'Laki-Laki', '2005-05-05', 'Jl. Raya No.5, Semarang', '081234567934', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(46, '5234567895', 'Tari Sani', 'Perempuan', '2005-06-06', 'Jl. Raya No.6, Semarang', '081234567935', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(47, '5234567896', 'Udi Septian', 'Laki-Laki', '2005-07-07', 'Jl. Raya No.7, Semarang', '081234567936', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(48, '5234567897', 'Vivi Ramadhani', 'Perempuan', '2005-08-08', 'Jl. Raya No.8, Semarang', '081234567937', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(49, '5234567898', 'Wandy Nugroho', 'Laki-Laki', '2005-09-09', 'Jl. Raya No.9, Semarang', '081234567938', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(50, '5234567899', 'Xenia Putri', 'Perempuan', '2005-10-10', 'Jl. Raya No.10, Semarang', '081234567939', 5, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(51, '6234567890', 'Yudha Rachmat', 'Laki-Laki', '2005-01-01', 'Jl. Raya No.1, Malang', '081234567940', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(52, '6234567891', 'Zahra Afifa', 'Perempuan', '2005-02-02', 'Jl. Raya No.2, Malang', '081234567941', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(53, '6234567892', 'Ari Wibowo', 'Laki-Laki', '2005-03-03', 'Jl. Raya No.3, Malang', '081234567942', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(54, '6234567893', 'Beni Ardiansyah', 'Laki-Laki', '2005-04-04', 'Jl. Raya No.4, Malang', '081234567943', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(55, '6234567894', 'Citra Anindita', 'Perempuan', '2005-05-05', 'Jl. Raya No.5, Malang', '081234567944', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(56, '6234567895', 'Dewi Sulastri', 'Perempuan', '2005-06-06', 'Jl. Raya No.6, Malang', '081234567945', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(57, '6234567896', 'Elan Pratama', 'Laki-Laki', '2005-07-07', 'Jl. Raya No.7, Malang', '081234567946', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(58, '6234567897', 'Fajar Aditya', 'Laki-Laki', '2005-08-08', 'Jl. Raya No.8, Malang', '081234567947', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(59, '6234567898', 'Gita Saraswati', 'Perempuan', '2005-09-09', 'Jl. Raya No.9, Malang', '081234567948', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53'),
(60, '6234567899', 'Haris Alfarizi', 'Laki-Laki', '2005-10-10', 'Jl. Raya No.10, Malang', '081234567949', 6, '2024-11-13 12:46:53', '2024-11-13 12:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `id` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) DEFAULT NULL,
  `semester` enum('Ganjil','Genap') DEFAULT NULL,
  `mulai` date DEFAULT NULL,
  `selesai` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`id`, `tahun_ajaran`, `semester`, `mulai`, `selesai`, `created_at`, `updated_at`) VALUES
(1, '2024/2025', 'Ganjil', '2024-06-01', '2024-12-01', '2024-11-13 09:41:11', '2024-11-13 09:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_wali_orang_tua`
--

CREATE TABLE `tb_wali_orang_tua` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `nama_wali` varchar(255) NOT NULL,
  `hubungan` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_wali_orang_tua`
--

INSERT INTO `tb_wali_orang_tua` (`id`, `id_siswa`, `nama_wali`, `hubungan`, `nomor_telepon`, `alamat`, `created_at`, `updated_at`) VALUES
(3, 1, 'Hendri Pratama', 'Ayah', '081234567980', 'Jl. Merdeka No.1, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(4, 2, 'Siti Puspitasari', 'Ibu', '081234567981', 'Jl. Merdeka No.2, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(5, 3, 'Budi Santosa', 'Ayah', '081234567982', 'Jl. Merdeka No.3, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(6, 4, 'Maya Sari', 'Ibu', '081234567983', 'Jl. Merdeka No.4, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(7, 5, 'Dwi Kurniawan', 'Ayah', '081234567984', 'Jl. Merdeka No.5, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(8, 6, 'Nina Sutrisno', 'Ibu', '081234567985', 'Jl. Merdeka No.6, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(9, 7, 'Ahmad Yulianto', 'Ayah', '081234567986', 'Jl. Merdeka No.7, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(10, 8, 'Lina Fitria', 'Ibu', '081234567987', 'Jl. Merdeka No.8, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(11, 9, 'Eka Suryani', 'Ayah', '081234567988', 'Jl. Merdeka No.9, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(12, 10, 'Rini Santika', 'Ibu', '081234567989', 'Jl. Merdeka No.10, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(13, 11, 'Sulastri Wijaya', 'Ibu', '081234567990', 'Jl. Raya No.1, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(14, 12, 'Tommy Wijaya', 'Ayah', '081234567991', 'Jl. Raya No.2, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(15, 13, 'Lilis Kurniati', 'Ibu', '081234567992', 'Jl. Raya No.3, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(16, 14, 'Benny Anggoro', 'Ayah', '081234567993', 'Jl. Raya No.4, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(17, 15, 'Dewi Nuraini', 'Ibu', '081234567994', 'Jl. Raya No.5, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(18, 16, 'Rico Satrio', 'Ayah', '081234567995', 'Jl. Raya No.6, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(19, 17, 'Hilda Wulandari', 'Ibu', '081234567996', 'Jl. Raya No.7, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(20, 18, 'Irwan Hidayat', 'Ayah', '081234567997', 'Jl. Raya No.8, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(21, 19, 'Fahmi Saputra', 'Ibu', '081234567998', 'Jl. Raya No.9, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(22, 20, 'Zainal Arifin', 'Ayah', '081234567999', 'Jl. Raya No.10, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(23, 21, 'Siti Mariam', 'Ibu', '081234568000', 'Jl. Raya No.1, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(24, 22, 'Ahmad Yadi', 'Ayah', '081234568001', 'Jl. Raya No.2, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(25, 23, 'Bambang Sutrisno', 'Ayah', '081234568002', 'Jl. Raya No.3, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(26, 24, 'Nina Hidayati', 'Ibu', '081234568003', 'Jl. Raya No.4, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(27, 25, 'Asep Hendra', 'Ayah', '081234568004', 'Jl. Raya No.5, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(28, 26, 'Lydia Wulansari', 'Ibu', '081234568005', 'Jl. Raya No.6, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(29, 27, 'Oka Lestari', 'Ayah', '081234568006', 'Jl. Raya No.7, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(30, 28, 'Cici Dian', 'Ibu', '081234568007', 'Jl. Raya No.8, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(31, 29, 'Krisna Setiawan', 'Ayah', '081234568008', 'Jl. Raya No.9, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(32, 30, 'Lia Purnama', 'Ibu', '081234568009', 'Jl. Raya No.10, Semarang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(33, 31, 'Siti Zulfahmi', 'Ibu', '081234568010', 'Jl. Raya No.1, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(34, 32, 'Farhan Iskandar', 'Ayah', '081234568011', 'Jl. Raya No.2, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(35, 33, 'Edy Saputra', 'Ayah', '081234568012', 'Jl. Raya No.3, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(36, 34, 'Winda Lestari', 'Ibu', '081234568013', 'Jl. Raya No.4, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(37, 35, 'Rudi Prakoso', 'Ayah', '081234568014', 'Jl. Raya No.5, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(38, 36, 'Citra Anindita', 'Ibu', '081234568015', 'Jl. Raya No.6, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(39, 37, 'Gilang Wijaya', 'Ayah', '081234568016', 'Jl. Raya No.7, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(40, 38, 'Zahra Safira', 'Ibu', '081234568017', 'Jl. Raya No.8, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(41, 39, 'Joni Purnama', 'Ayah', '081234568018', 'Jl. Raya No.9, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(42, 40, 'Lina Wulandari', 'Ibu', '081234568019', 'Jl. Raya No.10, Malang', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(43, 41, 'Santi Nursasi', 'Ibu', '081234568020', 'Jl. Raya No.1, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(44, 42, 'Agung Darma', 'Ayah', '081234568021', 'Jl. Raya No.2, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(45, 43, 'Lia Yuliana', 'Ibu', '081234568022', 'Jl. Raya No.3, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(46, 44, 'Dino Abdurrahman', 'Ayah', '081234568023', 'Jl. Raya No.4, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(47, 45, 'Cici Gunawan', 'Ibu', '081234568024', 'Jl. Raya No.5, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(48, 46, 'Bambang Suyanto', 'Ayah', '081234568025', 'Jl. Raya No.6, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(49, 47, 'Fajar Farhan', 'Ayah', '081234568026', 'Jl. Raya No.7, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(50, 48, 'Siti Mariam', 'Ibu', '081234568027', 'Jl. Raya No.8, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(51, 49, 'Nurul Isna', 'Ibu', '081234568028', 'Jl. Raya No.9, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(52, 50, 'Darmawi Kusuma', 'Ayah', '081234568029', 'Jl. Raya No.10, Bandung', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(53, 51, 'Rina Fitri', 'Ibu', '081234568030', 'Jl. Raya No.1, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(54, 52, 'Mimi Lestari', 'Ibu', '081234568031', 'Jl. Raya No.2, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(55, 53, 'Putra Pratama', 'Ayah', '081234568032', 'Jl. Raya No.3, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(56, 54, 'Dede Sumaryani', 'Ibu', '081234568033', 'Jl. Raya No.4, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(57, 55, 'Bimo Tanuwijaya', 'Ayah', '081234568034', 'Jl. Raya No.5, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(58, 56, 'Fadliya Yuliana', 'Ibu', '081234568035', 'Jl. Raya No.6, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(59, 57, 'Yusuf Sumantri', 'Ayah', '081234568036', 'Jl. Raya No.7, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(60, 58, 'Rani Mustika', 'Ibu', '081234568037', 'Jl. Raya No.8, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(61, 59, 'Michaela Anggraeni', 'Ibu', '081234568038', 'Jl. Raya No.9, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43'),
(62, 60, 'Eko Tjahyono', 'Ayah', '081234568039', 'Jl. Raya No.10, Yogyakarta', '2024-11-13 12:48:43', '2024-11-13 12:48:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ekstra_kurikuler`
--
ALTER TABLE `tb_ekstra_kurikuler`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jadwal_pelajaran`
--
ALTER TABLE `tb_jadwal_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_kepribadian`
--
ALTER TABLE `tb_kepribadian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mata_pelajaran`
--
ALTER TABLE `tb_mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_peran`
--
ALTER TABLE `tb_peran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`nama_peran`);

--
-- Indexes for table `tb_rapor_siswa`
--
ALTER TABLE `tb_rapor_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_wali_orang_tua`
--
ALTER TABLE `tb_wali_orang_tua`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_ekstra_kurikuler`
--
ALTER TABLE `tb_ekstra_kurikuler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jadwal_pelajaran`
--
ALTER TABLE `tb_jadwal_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kepribadian`
--
ALTER TABLE `tb_kepribadian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mata_pelajaran`
--
ALTER TABLE `tb_mata_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_peran`
--
ALTER TABLE `tb_peran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_rapor_siswa`
--
ALTER TABLE `tb_rapor_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_wali_orang_tua`
--
ALTER TABLE `tb_wali_orang_tua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
