-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2025 at 03:40 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelayanandesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip_surat`
--

CREATE TABLE `arsip_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_arsip` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-anissaaafebriyaaniiu@gmail.com|127.0.0.1', 'i:1;', 1763301891),
('laravel-cache-anissaaafebriyaaniiu@gmail.com|127.0.0.1:timer', 'i:1763301891;', 1763301891);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_surat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `template_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `nama_surat`, `deskripsi`, `template_path`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 'PERMOHONAN KARTU TANDA PENDUDUK (KTP)', 'proses resmi untuk mengajukan pembuatan atau penggantian identitas diri berupa KTP Elektronik (e-KTP) yang wajib dimiliki oleh Warga Negara Indonesia (WNI) yang telah berusia 17 tahun atau telah menikah.', 'templates/3AuZdyHqI5Q9LwVcuC7q8LzXOGVz0rlqzB4FUmnD.doc', 1, '2025-11-16 05:23:21', '2025-11-25 07:39:21'),
(8, 'SUKET USAHA', 'AMSN', 'templates/IIxQEbO9vU0DM72LSSK3tZhJPhbfUqt99zk2XovH.pdf', 0, '2025-11-17 06:07:15', '2025-11-17 06:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surats`
--

CREATE TABLE `jenis_surats` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pengaduan`
--

CREATE TABLE `kategori_pengaduan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_pengaduan`
--

INSERT INTO `kategori_pengaduan` (`id`, `nama_kategori`, `deskripsi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'ahsw', 'sjwk', 1, '2025-11-14 17:58:01', '2025-11-14 17:58:01'),
(4, 'Kriminal', 'Kasus mengancam nyawa', 1, '2025-11-25 21:32:43', '2025-11-25 21:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_04_043202_create_jenis_surat_table', 1),
(5, '2025_11_05_133218_create_pengajuan_surat_table', 1),
(6, '2025_11_05_133304_create_arsip_surat_table', 1),
(7, '2025_11_05_134500_create_kategori_pengaduan_table', 1),
(8, '2025_11_05_134654_create_pengaduan_table', 1),
(9, '2025_11_05_145500_create_kartu_keluarga_table', 1),
(10, '2025_11_05_145627_create_sensus_rumah_table', 1),
(11, '2025_11_05_145700_create_sensus_penduduk_table', 1),
(12, '2025_11_06_143417_create_jenis_surats_table', 2),
(13, '2025_11_15_144923_create_petugas_table', 3),
(14, '2025_11_15_150000_update_sensus_kk_petugas_relation', 4),
(15, '2025_11_16_104230_create_pengumuman_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi_pengaduan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('baru','diproses','selesai','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baru',
  `prioritas` enum('rendah','sedang','tinggi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sedang',
  `tanggapan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `user_id`, `kategori_id`, `judul`, `isi_pengaduan`, `lokasi`, `foto_bukti`, `status`, `prioritas`, `tanggapan_admin`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'ase', 'sds sdyueuy jdiduyd iuddu idydds isdodn hjduds osod ksdiuui kiisd', 'sdhhu', 'bukti/hpQh2ZWKWx9BeAIcByx3XemZ2UIp1d3862cGrhi9.jpg', 'baru', 'sedang', NULL, '2025-11-14 19:36:08', '2025-11-14 19:36:08'),
(2, 5, 1, 'ase', 'sds sdyueuy jdiduyd iuddu idydds isdodn hjduds osod ksdiuui kiisd', 'sdhhu', 'bukti/hmnBX4SQgYl8DpuPaFJSfbZXaT0ds1l2qGhKjDyT.jpg', 'ditolak', 'rendah', NULL, '2025-11-14 19:45:18', '2025-11-15 03:19:27'),
(3, 5, 1, 'nh', 'iidkkj jhduhduj jsdjhdsd jksdiudsu jhdueiu', 'jsjiuuw', 'bukti/KKW16IavgHfRFLAzGoVoWc9u6dJAoxBJXyscd8jU.jpg', 'diproses', 'tinggi', 'sjjisk nxuud jsi', '2025-11-14 19:57:40', '2025-11-15 03:05:00'),
(5, 9, 1, 'nyoba', 'nyoba', 'semarang', 'bukti/0gaEBBZscMqxUDCZ4qv514Dts2AgQjSVye517vu4.jpg', 'selesai', 'tinggi', 'nyoba', '2025-11-25 21:31:29', '2025-11-25 21:42:44'),
(7, 9, 4, 'Pembunuhan', 'Pembunuhan ayam goreng', 'Geprek anisa', 'bukti/2Vje2Su4LUv7e8gVfuWEidrTaEykH5BU1geLWT44.jpg', 'diproses', 'tinggi', 'q', '2025-11-27 08:16:18', '2025-11-27 08:35:10');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jenis_surat_id` bigint UNSIGNED NOT NULL,
  `data_form` json NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','diproses','selesai','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `keterangan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_hasil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `user_id`, `jenis_surat_id`, `data_form`, `tanggal_pengajuan`, `status`, `keterangan_admin`, `file_hasil`, `created_at`, `updated_at`) VALUES
(1, 9, 7, '{\"nik\": \"12345678\", \"nama\": \"informatika\", \"alamat\": \"Semarang\"}', '2025-11-25 15:27:59', 'pending', NULL, NULL, '2025-11-25 08:27:59', '2025-11-25 08:27:59'),
(2, 9, 7, '{\"nik\": \"12345678\", \"nama\": \"informatika\", \"alamat\": \"Semarang\"}', '2025-11-25 15:41:10', 'selesai', NULL, NULL, '2025-11-25 08:41:10', '2025-11-25 08:46:07'),
(3, 9, 7, '{\"rt\": \"1\", \"rw\": \"1\", \"nik\": \"123456789\", \"no_kk\": \"123456789\", \"alamat\": \"semaranf\", \"kode_pos\": \"123\", \"nama_lengkap\": \"upgris\", \"jenis_permohonan\": \"upgris\"}', '2025-11-27 04:28:17', 'ditolak', NULL, NULL, '2025-11-26 21:28:17', '2025-11-26 21:29:05'),
(4, 9, 7, '{\"rt\": \"1\", \"rw\": \"1\", \"nik\": \"123456789\", \"no_kk\": \"123456789\", \"alamat\": \"Semarang\", \"kode_pos\": \"1\", \"nama_lengkap\": \"COba saja\", \"jenis_permohonan\": \"Baru\"}', '2025-11-27 15:15:43', 'selesai', NULL, NULL, '2025-11-27 08:15:43', '2025-11-27 08:34:32');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pelaksanaan` date DEFAULT NULL,
  `penulis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','publish') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `email`, `no_hp`, `jabatan`, `wilayah`, `created_at`, `updated_at`) VALUES
(2, 'anisa febriyano', 'anissaaafebriyaaniiu@gmail.com', '083176899229', 'khhh', 'nsj', '2025-11-15 08:20:40', '2025-11-15 08:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `sensus_kk`
--

CREATE TABLE `sensus_kk` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_kk` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepala_keluarga` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rt` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pendataan` date DEFAULT NULL,
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensus_kk`
--

INSERT INTO `sensus_kk` (`id`, `nomor_kk`, `kepala_keluarga`, `alamat`, `rt`, `rw`, `tanggal_pendataan`, `petugas_id`, `created_at`, `updated_at`) VALUES
(2, '12345678898', 'samsai', 'asa;lsa', '7', '8', '2025-11-16', 2, '2025-11-15 18:55:32', '2025-11-15 19:26:17'),
(3, '1234567898765345', 'jaks', 'nasl', '2', '1', '2025-11-16', 2, '2025-11-16 02:56:39', '2025-11-16 02:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `sensus_penduduk`
--

CREATE TABLE `sensus_penduduk` (
  `id` bigint UNSIGNED NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan_keluarga` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kk_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensus_penduduk`
--

INSERT INTO `sensus_penduduk` (`id`, `nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `pendidikan`, `pekerjaan`, `status_perkawinan`, `hubungan_keluarga`, `kk_id`, `created_at`, `updated_at`) VALUES
(1, '1234567890123456', 'anisa febriyan', 'pemalang', '2023-02-09', 'P', 'isd', 'sja', 'oas', 'Belum Kawin', 'sa', 2, '2025-11-15 20:17:49', '2025-11-15 21:32:33'),
(2, '1278399029112', 'anisa febriyan', 'POKJH', '2025-11-01', 'P', 'JJU', 'KII', 'KJI', 'Belum Kawin', 'KJJHUH', 2, '2025-11-15 20:26:18', '2025-11-15 20:35:46'),
(3, '12334356576756324234', 'anisa febriyan', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 2, '2025-11-15 20:27:40', '2025-11-15 20:27:40'),
(4, '12334356576756324232', 'anisa febriyan', NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, 2, '2025-11-15 20:29:40', '2025-11-15 20:29:40'),
(5, '12334356576756324237', 'HAFI', 'KKJAS', '2025-11-08', 'L', 'ISLAM', 'ASA', 'ASA', 'Belum Kawin', 'ASAW', 2, '2025-11-15 20:37:16', '2025-11-15 20:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `sensus_rumah`
--

CREATE TABLE `sensus_rumah` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_rumah` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_penghuni` int NOT NULL DEFAULT '0',
  `kepemilikan_rumah` enum('milik sendiri','sewa','kontrak','lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'milik sendiri',
  `bahan_bangunan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_air` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_listrik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kk_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensus_rumah`
--

INSERT INTO `sensus_rumah` (`id`, `kode_rumah`, `alamat`, `jumlah_penghuni`, `kepemilikan_rumah`, `bahan_bangunan`, `sumber_air`, `sumber_listrik`, `kk_id`, `created_at`, `updated_at`) VALUES
(1, '12', 'asa', 0, 'sewa', 'assasaa', 'as', 'asd', 2, '2025-11-16 00:56:02', '2025-11-16 01:58:33'),
(2, '134', 'wd', 2, 'milik sendiri', 'swded', 'we', 'dsdfr', 2, '2025-11-16 02:07:37', '2025-11-16 02:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('04jW7oN44fTJIt1gxi4y0X7cp7HN3EtGgO92FUEg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlczQkxDS0dTNndXMVBydFByUGtKMThsbHEwU3BoR2MzV0hub1VGbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1764257751),
('yTfQyBc4Qaa2KwjDb0quHA6UgYUiHhJjb5cJTrSx', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN2d0ZkN0TWdkZmN4b0VSa1VmRWFEZ3N0YnJNVWNHMFR3UkVrb2lOTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC93YXJnYS9zZW5zdXMtd2FyZ2EiO3M6NToicm91dGUiO3M6MTc6IndhcmdhLnNlbnN1c3dhcmdhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9', 1764256275);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('warga','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'warga',
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `nik`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'Anisa Febriyani', 'anisafeb@gmail.com', NULL, '$2y$12$WOuvMHyXhEEDjQvRhr6.weo6bcyggMmuylAbVWdA8pUJq.IdJfJJS', NULL, 'warga', NULL, NULL, '2025-11-12 03:11:55', '2025-11-12 03:11:55'),
(3, 'Anisa Febriyani', 'anisaaaa@gmail.com', NULL, '$2y$12$XSzV4MqGIlXt6SPUc2iwx.3GTLjzfGaWKh5tGvBCCTHByG.ocLRw6', NULL, 'warga', '1234567890', 'HKSJ,DASD', '2025-11-13 01:55:53', '2025-11-13 01:55:53'),
(4, 'anisa', 'anisafebriiii@gmail.com', NULL, '$2y$12$RyQGqQXM4Ukwu68er6/5OOtr5CiGyR6yZhjmQLjpXMSHOEsiUssUO', 'qdDUyIVhaTQI3xAjziG1ddtucZ7yDYHVIyBq0NehWTPQMxGT3ZAVqswEXla6', 'warga', '123456789', 'uyjhbnsa', '2025-11-14 06:03:33', '2025-11-14 06:03:33'),
(5, 'Admin Desa', 'admin@desa.com', NULL, '$2y$12$GpzrXgg6RplugnthXE/1c.G7IlOW68DOZNx6dqaJ6JwKcpHSYwfsW', NULL, 'admin', NULL, NULL, '2025-11-14 06:16:46', '2025-11-14 06:16:46'),
(8, 'anisaaa', 'anisaaswq@gmail.com', NULL, '$2y$12$L7R2z9RCzP744eWpLbZVZ.a/M1FX61.0PlFv4Y3QgQzWtoqDdMOmG', NULL, 'warga', '1234567890123456', 'ajks', '2025-11-16 17:32:09', '2025-11-16 17:32:09'),
(9, 'informatika', 'informatika@gmail.com', NULL, '$2y$12$8HmaPUsz0YhvAYOrO1AKbumZ.8ODZpNoH61t/40v6rQPPbQqTiUO.', NULL, 'warga', '12345678', 'Kota Semarang', '2025-11-25 07:49:27', '2025-11-25 07:49:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arsip_surat_pengajuan_id_foreign` (`pengajuan_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_pengaduan`
--
ALTER TABLE `kategori_pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_user_id_foreign` (`user_id`),
  ADD KEY `pengaduan_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_surat_user_id_foreign` (`user_id`),
  ADD KEY `pengajuan_surat_jenis_surat_id_foreign` (`jenis_surat_id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengumuman_slug_unique` (`slug`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petugas_email_unique` (`email`);

--
-- Indexes for table `sensus_kk`
--
ALTER TABLE `sensus_kk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sensus_kk_nomor_kk_unique` (`nomor_kk`),
  ADD KEY `sensus_kk_petugas_id_foreign` (`petugas_id`);

--
-- Indexes for table `sensus_penduduk`
--
ALTER TABLE `sensus_penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sensus_penduduk_nik_unique` (`nik`),
  ADD KEY `sensus_penduduk_kk_id_foreign` (`kk_id`);

--
-- Indexes for table `sensus_rumah`
--
ALTER TABLE `sensus_rumah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sensus_rumah_kode_rumah_unique` (`kode_rumah`),
  ADD KEY `sensus_rumah_kk_id_foreign` (`kk_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_surats`
--
ALTER TABLE `jenis_surats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_pengaduan`
--
ALTER TABLE `kategori_pengaduan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sensus_kk`
--
ALTER TABLE `sensus_kk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sensus_penduduk`
--
ALTER TABLE `sensus_penduduk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sensus_rumah`
--
ALTER TABLE `sensus_rumah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip_surat`
--
ALTER TABLE `arsip_surat`
  ADD CONSTRAINT `arsip_surat_pengajuan_id_foreign` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan_surat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_pengaduan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengaduan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD CONSTRAINT `pengajuan_surat_jenis_surat_id_foreign` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengajuan_surat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sensus_kk`
--
ALTER TABLE `sensus_kk`
  ADD CONSTRAINT `sensus_kk_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sensus_penduduk`
--
ALTER TABLE `sensus_penduduk`
  ADD CONSTRAINT `sensus_penduduk_kk_id_foreign` FOREIGN KEY (`kk_id`) REFERENCES `sensus_kk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sensus_rumah`
--
ALTER TABLE `sensus_rumah`
  ADD CONSTRAINT `sensus_rumah_kk_id_foreign` FOREIGN KEY (`kk_id`) REFERENCES `sensus_kk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
