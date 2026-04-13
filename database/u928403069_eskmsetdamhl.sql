-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 09 Apr 2026 pada 13.21
-- Versi server: 11.8.6-MariaDB-log
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u928403069_eskmsetdamhl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `2023`
--

CREATE TABLE `2023` (
  `no` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `jenkel` varchar(15) NOT NULL,
  `usia` int(11) NOT NULL,
  `nohp` varchar(16) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `u1` int(11) NOT NULL,
  `u2` int(11) NOT NULL,
  `u3` int(11) NOT NULL,
  `u4` int(11) NOT NULL,
  `u5` int(11) NOT NULL,
  `u6` int(11) NOT NULL,
  `u7` int(11) NOT NULL,
  `u8` int(11) NOT NULL,
  `u9` int(11) NOT NULL,
  `saran` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `2024`
--

CREATE TABLE `2024` (
  `id` int(11) NOT NULL,
  `kodeUnik` varchar(6) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `jenkel` varchar(15) DEFAULT NULL,
  `usia` int(11) DEFAULT NULL,
  `nohp` varchar(16) DEFAULT NULL,
  `pendidikan` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `u1` int(11) DEFAULT NULL,
  `u2` int(11) DEFAULT NULL,
  `u3` int(11) DEFAULT NULL,
  `u4` int(11) DEFAULT NULL,
  `u5` int(11) DEFAULT NULL,
  `u6` int(11) DEFAULT NULL,
  `u7` int(11) DEFAULT NULL,
  `u8` int(11) DEFAULT NULL,
  `u9` int(11) DEFAULT NULL,
  `u10` int(11) DEFAULT NULL,
  `u11` int(11) DEFAULT NULL,
  `u12` int(11) DEFAULT NULL,
  `u13` int(11) DEFAULT NULL,
  `u14` int(11) DEFAULT NULL,
  `u15` int(11) DEFAULT NULL,
  `saran` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` varchar(100) DEFAULT '0000-00-00 00:00:00',
  `jenisPelayanan` varchar(100) DEFAULT NULL,
  `id_sub_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `2024`
--

INSERT INTO `2024` (`id`, `kodeUnik`, `nama`, `alamat`, `pekerjaan`, `jenkel`, `usia`, `nohp`, `pendidikan`, `nik`, `u1`, `u2`, `u3`, `u4`, `u5`, `u6`, `u7`, `u8`, `u9`, `u10`, `u11`, `u12`, `u13`, `u14`, `u15`, `saran`, `created_at`, `updated_at`, `jenisPelayanan`, `id_sub_jenis`) VALUES
(11, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-12 05:45:53', '2025-11-12 13:45:53', 'organisasi', 34),
(12, NULL, NULL, 'samarinda', 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'update', '2025-11-16 05:45:20', '2025-11-16 13:45:20', 'adbang', 24),
(13, NULL, NULL, NULL, 'Lainnya', 'Laki - Laki', 30, NULL, 'S1 / Setara', NULL, 4, 4, 4, 4, 4, 4, 4, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:19:53', '2025-11-17 03:19:53', 'organisasi', 32),
(14, NULL, NULL, 'Ujoh Bilang RT.005 Kecamatan Long Bagun Kabupaten Mahakam Ulu.', 'ASN', 'Laki - Laki', 41, NULL, 'S1 / Setara', NULL, 3, 3, 3, 4, 3, 3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:25:10', '2025-11-17 03:25:10', 'organisasi', 32),
(15, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'mantab', '2025-11-17 03:29:46', '2025-11-17 03:29:46', 'organisasi', 33),
(16, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 41, NULL, 'S1 / Setara', NULL, 3, 3, 3, 4, 3, 3, 3, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'semoga kedepannya bisa lebih ditingkatkan', '2025-11-17 03:34:05', '2025-11-17 03:34:05', 'organisasi', 31),
(17, NULL, NULL, NULL, 'Lainnya', 'Perempuan', 30, NULL, 'S1 / Setara', NULL, 3, 4, 3, 4, 4, 3, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:34:09', '2025-11-17 03:34:09', 'organisasi', 32),
(18, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 41, NULL, 'S1 / Setara', NULL, 3, 3, 3, 3, 3, 3, 3, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:35:02', '2025-11-17 03:35:02', 'organisasi', 34),
(19, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 41, NULL, 'S1 / Setara', NULL, 3, 3, 3, 4, 3, 3, 3, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:35:56', '2025-11-17 03:35:56', 'organisasi', 33),
(20, NULL, NULL, NULL, 'Lainnya', 'Perempuan', 30, NULL, 'S1 / Setara', NULL, 4, 3, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:37:04', '2025-11-17 03:37:04', 'organisasi', 31),
(21, NULL, NULL, NULL, 'Lainnya', 'Perempuan', 30, NULL, 'S1 / Setara', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:40:21', '2025-11-17 03:40:21', 'organisasi', 34),
(22, NULL, NULL, NULL, 'Lainnya', 'Perempuan', 30, NULL, 'S1 / Setara', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-17 03:41:13', '2025-11-17 03:41:13', 'organisasi', 33),
(23, NULL, NULL, NULL, 'ASN', 'Perempuan', 30, NULL, 'S1 / Setara', NULL, 3, 3, 4, 4, 3, 3, 4, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Agar lebih ditingkatkan pelayanan kepada masyarakat', '2025-11-17 04:25:16', '2025-11-17 04:25:16', 'ekosda', 27),
(24, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 30, NULL, 'S1 / Setara', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-20 05:22:29', '2025-11-20 05:22:29', 'hukum', 50),
(25, NULL, NULL, NULL, 'Lainnya', 'Laki - Laki', 41, NULL, 'SMA / SMK', NULL, 3, 3, 3, 4, 3, 3, 4, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Harapan saya kedepannya pelayanannya lebih baik dan maksimal lagi', '2025-11-24 05:22:52', '2025-11-24 05:22:52', 'organisasi', 31),
(26, NULL, NULL, NULL, 'Lainnya', 'Perempuan', 30, NULL, 'SMA / SMK', NULL, 3, 3, 3, 4, 3, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-24 05:30:47', '2025-11-24 05:30:47', 'organisasi', 33),
(27, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 41, NULL, 'S2 / S3', NULL, 3, 3, 3, 4, 3, 3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-26 04:22:43', '2025-11-26 04:22:43', 'prokopim', 40),
(28, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 30, NULL, 'S2 / S3', NULL, 4, 4, 3, 4, 3, 3, 3, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Semoga dapat ditingkatkan lebih baik lagi', '2025-11-26 04:24:08', '2025-11-26 04:24:08', 'prokopim', 40),
(29, NULL, NULL, NULL, 'ASN', 'Laki - Laki', 30, NULL, 'S1 / Setara', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Semoga bisa lebih baik', '2025-11-26 12:51:25', '2025-11-26 12:51:25', 'umum', 45),
(30, NULL, NULL, NULL, 'ASN', 'Perempuan', 30, NULL, 'SMA / SMK', NULL, 2, 3, 2, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Harap teliti dan dikerjakan tepat waktu', '2025-12-17 02:48:36', '2025-12-17 02:48:36', 'hukum', 52),
(31, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 03:36:19', '2026-01-06 03:36:19', 'organisasi', NULL),
(32, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 04:17:58', '2026-01-06 04:17:58', 'organisasi', 32),
(33, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 04:20:12', '2026-01-06 04:20:12', 'organisasi', 32),
(34, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Bagus', '2026-01-06 04:22:34', '2026-01-06 04:22:34', 'organisasi', 32),
(35, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'Pelayanan yang baik, semoga lebih baik kedepannya.', '2026-01-06 06:27:26', '2026-01-06 06:27:26', 'organisasi', NULL),
(36, NULL, NULL, NULL, 'Swasta', 'Laki - Laki', 29, NULL, 'SMA / SMK', NULL, 4, 4, 4, 4, 4, 4, 4, 4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 'pelayanan yang baik, semoga kedepannya lebih baik.', '2026-01-06 08:34:49', '2026-01-06 08:34:49', 'organisasi', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukutamu`
--

CREATE TABLE `bukutamu` (
  `no` int(11) NOT NULL,
  `kodeUnik` varchar(6) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `jenkel` varchar(15) NOT NULL,
  `usia` int(11) NOT NULL,
  `nohp` varchar(16) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `keperluan` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `jenisPelayanan` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_11_10_094615_add_bidang_and_rename_nama_sub_on_sub_jenis', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaiunsur`
--

CREATE TABLE `nilaiunsur` (
  `no` int(11) NOT NULL,
  `kodeUnik` varchar(10) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `jenkel` varchar(15) NOT NULL,
  `usia` int(11) NOT NULL,
  `nohp` varchar(16) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `u1` int(11) NOT NULL,
  `u2` int(11) NOT NULL,
  `u3` int(11) NOT NULL,
  `u4` int(11) NOT NULL,
  `u5` int(11) NOT NULL,
  `u6` int(11) NOT NULL,
  `u7` int(11) NOT NULL,
  `u8` int(11) NOT NULL,
  `u9` int(11) NOT NULL,
  `saran` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_jenis`
--

CREATE TABLE `sub_jenis` (
  `id` int(11) NOT NULL,
  `bagian` int(11) NOT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  `jenis` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `sub_jenis`
--

INSERT INTO `sub_jenis` (`id`, `bagian`, `bidang`, `jenis`, `created_at`, `updated_at`) VALUES
(7, 6, 'Perpustakaan dan Arsip', 'Pelayanan Pembuatan Akun dan Struktur Srikandi', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(8, 6, 'Perpustakaan dan Arsip', 'Pelayanan data TGM dan IPLM Perpustakaan', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(9, 6, 'Perpustakaan dan Arsip', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(10, 6, 'Perpustakaan dan Arsip', 'Pelayanan Pengaduan, sebagaimana tercantum dalam Lampiran I Keputusan ini', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(11, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Konsultasi Tenaga Kerja', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(12, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Penerima Laporan Tenaga Kerja Dari Perusahaan', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(13, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Pengaduan Perusahaan yang Terjadi di Perusahaan Antara Karyawan dan Pimpinan', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(14, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Kunjungan ke Perusahaan - Perusahaan yang Beroperasi di Wilayah Kabupaten Mahakam Ulu', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(15, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(16, 6, 'Transmigrasi dan Ketenagakerjaan', 'Pelayanan Pengaduan, sebagaimana tercantum dalam Lampiran I Keputusan ini', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(17, 6, 'Bina Mental dan Spiritual', 'Pelayanan Konsultasi Bantuan Hibah', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(18, 6, 'Bina Mental dan Spiritual', 'Pelayanan Penerima Proposal Usulan / Pencairan Bantuan Hibah', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(19, 6, 'Bina Mental dan Spiritual', 'Pelayanan Fasilitasi Kegiatan Sosial Keagamaan', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(20, 6, 'Bina Mental dan Spiritual', 'Pelayanan Bantuan Pendidikan / Beasiswa Gerbang Cerdas Mahulu (GCM)', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(21, 6, 'Bina Mental dan Spiritual', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(22, 6, 'Bina Mental dan Spiritual', 'Pelayanan Pengaduan, sebagaimana tercantum dalam Lampiran I Keputusan ini', '2025-11-11 01:45:31', '2025-11-11 01:45:31'),
(24, 4, 'Bidang Fasilitasi Penyusunan Program Pembangunan', 'Pengumpulan Data Base Pembangunan Sarana dan Prasarana Kabupaten Mahakam Ulu.', '2025-11-11 01:49:17', '2025-11-21 05:24:14'),
(27, 8, '*', 'Pelayanan Konsultasi', '2025-11-11 01:49:17', '2025-11-11 01:49:17'),
(28, 8, '*', 'Pelayanan data, Laporan, dan Informasi', '2025-11-11 01:49:17', '2025-11-11 01:49:17'),
(29, 8, '*', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 01:49:17', '2025-11-11 01:49:17'),
(30, 8, '*', 'Pelayanan Pengaduan', '2025-11-11 01:49:17', '2025-11-11 00:35:45'),
(31, 1, '*', 'Pelayanan Konsultasi', '2025-11-11 08:25:25', '2025-11-11 08:25:25'),
(32, 1, '*', 'Pelayanan data, Laporan, dan Informasi', '2025-11-11 08:25:25', '2025-11-11 08:25:25'),
(33, 1, '*', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 08:25:25', '2025-11-11 08:25:25'),
(34, 1, '*', 'Pelayanan Pengaduan', '2025-11-11 08:25:25', '2025-11-11 00:36:24'),
(35, 3, '*', 'Pelayanan Konsultasi dan Fasilitasi', '2025-11-11 08:26:19', '2025-11-11 00:27:16'),
(36, 3, '*', 'Pelayanan Dokumen Kerja Sama', '2025-11-11 08:26:19', '2025-11-12 01:33:40'),
(37, 3, '*', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-11 08:26:19', '2025-11-11 08:26:19'),
(38, 3, '*', 'Pelayanan Pengaduan', '2025-11-11 08:26:19', '2025-11-11 00:37:16'),
(39, 3, '*', 'Laporan Penyelenggaraan Pemerintah', '2025-11-11 00:28:51', '2025-11-11 00:29:01'),
(40, 5, '*', 'Pelayanan Penjadwalan Kegiatan Pimpinan', '2025-11-11 00:29:27', '2025-11-11 00:29:27'),
(41, 5, '*', 'Pelayanan Komunikasi Pimpinan', '2025-11-11 00:29:42', '2025-11-11 00:29:42'),
(42, 5, '*', 'Pelayanan Dokumentasi Pimpinan', '2025-11-11 00:29:58', '2025-11-11 00:37:41'),
(43, 2, '*', 'Pelayanan Konsultasi', '2025-11-12 01:35:20', '2025-11-12 01:35:20'),
(44, 2, '*', 'Pelayanan data, Laporan, dan Informasi', '2025-11-12 01:35:29', '2025-11-12 01:35:29'),
(45, 2, '*', 'Pelayanan Rapat/Audiensi Instansi Pemerintah, Pemerintah Daerah dan Lembaga lain', '2025-11-12 01:38:05', '2025-11-12 01:38:05'),
(46, 2, '*', 'Pelayanan Penomoran Surat Administrasi Pemerintah', '2025-11-12 01:38:14', '2025-11-12 01:38:14'),
(47, 2, '*', 'Pelayanan Pengaduan', '2025-11-12 01:38:24', '2025-11-12 01:38:24'),
(48, 9, 'Bidang Produk Hukum dan Bantuan Hukum (Advokasi)', 'Pelayanan Konsultasi Hukum dan Bantuan Hukum (Advokasi)', '2025-11-20 04:52:52', '2025-11-20 04:53:43'),
(50, 9, 'Bidang Produk Hukum dan Bantuan Hukum (Advokasi)', 'Pelayanan Produk Hukum Daerah', '2025-11-20 04:55:18', '2025-11-20 05:05:05'),
(51, 9, 'Bidang Produk Hukum dan Bantuan Hukum (Advokasi)', 'Pelayanan Informasi Hukum', '2025-11-20 04:55:42', '2025-11-20 05:04:51'),
(52, 9, 'Bidang Produk Hukum dan Bantuan Hukum (Advokasi)', 'Pelayanan Pengaduan', '2025-11-20 04:56:11', '2025-11-20 05:05:00'),
(53, 4, 'Bidang Fasilitasi Penyusunan Program Pembangunan', 'Koordinasi dan monitoring Data Base Pembangunan di 5 Kecamatan', '2025-11-21 05:23:21', '2025-11-21 05:24:25'),
(55, 4, 'Bidang Fasilitasi Penyusunan Program Pembangunan', 'Koordinasi dan Konsultasi ke Biro Administrasi Pembangunan Provinsi Kalimantan Timur terkait kegiatan Fasilitasi Penyusunan Program Pembangunan .', '2025-11-21 05:24:00', '2025-11-21 05:24:32'),
(57, 4, 'Bidang Pengendalian dan Evaluasi Program Pembangunan', 'Mengumpulkan data Pembangunan yang bersumber dari dana BANKEU dan DAK dari OPD teknis.', '2025-11-21 05:29:07', '2025-11-21 05:29:52'),
(58, 4, 'Bidang Pengendalian dan Evaluasi Program Pembangunan', 'Monitoring dan Evaluasi Pembangunan yang bersumber dari dana BANKEU dan DAK di 50 kampung dari 5 kecamatan.', '2025-11-21 05:29:41', '2025-11-21 05:30:09'),
(59, 4, 'Bidang Pengendalian dan Evaluasi Program Pembangunan', 'Koordinasi dan Konsultasi ke Biro Administrasi Pembangunan Provinsi Kalimantan Timur terkait kegiatan Pengendalian dan Evaluasi Program Pembangunan', '2025-11-21 05:31:25', '2025-11-21 05:31:38'),
(60, 4, 'Bidang Pengendalian dan Evaluasi Program Pembangunan', 'Melaksanakan Radalok Bankeu, APBD dan DAK', '2025-11-21 05:32:45', '2025-11-21 05:32:45'),
(61, 4, 'Bidang Pengelolaan Evaluasi dan Pelaporan Pelaksanaan Pembangunan', 'Mengumpulkan data Pembangunan yang bersumber dari dana APBD dari OPD teknis.', '2025-11-21 05:33:48', '2025-11-21 05:33:58'),
(62, 4, 'Bidang Pengelolaan Evaluasi dan Pelaporan Pelaksanaan Pembangunan', 'Monitoring dan Evaluasi Pembangunan yang bersumber dari dana APBD di 50 kampung dari 5 kecamatan.', '2025-11-21 05:34:43', '2025-11-21 05:34:51'),
(63, 4, 'Bidang Pengelolaan Evaluasi dan Pelaporan Pelaksanaan Pembangunan', 'Koordinasi dan Konsultasi ke Biro Administrasi Pembangunan Provinsi Kalimantan Timur terkait kegiatan Pengelolaan Evaluasi dan Pelaporan Pelaksanaan Pembangunan.', '2025-11-21 05:35:16', '2025-11-21 05:35:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `2023`
--
ALTER TABLE `2023`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `2024`
--
ALTER TABLE `2024`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilaiunsur`
--
ALTER TABLE `nilaiunsur`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `sub_jenis`
--
ALTER TABLE `sub_jenis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_jenis_bagian_bidang_index` (`bagian`,`bidang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `2023`
--
ALTER TABLE `2023`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `2024`
--
ALTER TABLE `2024`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `nilaiunsur`
--
ALTER TABLE `nilaiunsur`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sub_jenis`
--
ALTER TABLE `sub_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
