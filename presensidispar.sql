-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Agu 2025 pada 03.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensidispar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `schedule_latitude` double NOT NULL,
  `schedule_longitude` double NOT NULL,
  `schedule_start_time` time NOT NULL,
  `schedule_end_time` time NOT NULL,
  `start_latitude` double NOT NULL,
  `start_longitude` double NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `is_leave` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `end_latitude` double DEFAULT NULL,
  `end_longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('056fc329aaaa757d31db450f525da23fde4d1b36', 'i:1;', 1754917898),
('056fc329aaaa757d31db450f525da23fde4d1b36:timer', 'i:1754917898;', 1754917898),
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1756265616),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1756265615;', 1756265616),
('livewire-rate-limiter:056fc329aaaa757d31db450f525da23fde4d1b36', 'i:1;', 1756342570),
('livewire-rate-limiter:056fc329aaaa757d31db450f525da23fde4d1b36:timer', 'i:1756342570;', 1756342570),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:79:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"view_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"update_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"delete_any_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:15:\"view_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:19:\"view_any_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"create_attendance\";s:1:\"c\";s:3:\"web\";}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"update_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:18:\"restore_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:22:\"restore_any_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:20:\"replicate_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:18:\"reorder_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:17:\"delete_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:21:\"delete_any_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:23:\"force_delete_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:27:\"force_delete_any_attendance\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"view_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:14:\"view_any_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:12:\"create_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"update_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"restore_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:17:\"restore_any_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:15:\"replicate_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:13:\"reorder_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:12:\"delete_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:16:\"delete_any_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:18:\"force_delete_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:22:\"force_delete_any_leave\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:11:\"view_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"view_any_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:13:\"create_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:13:\"update_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:14:\"restore_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:35;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:18:\"restore_any_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:36;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:16:\"replicate_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:37;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:14:\"reorder_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:38;a:4:{s:1:\"a\";i:39;s:1:\"b\";s:13:\"delete_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:39;a:4:{s:1:\"a\";i:40;s:1:\"b\";s:17:\"delete_any_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:40;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:19:\"force_delete_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:41;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:23:\"force_delete_any_office\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:42;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:13:\"view_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:43;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:17:\"view_any_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:44;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:15:\"create_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:45;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:15:\"update_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:46;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:16:\"restore_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:47;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:20:\"restore_any_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:48;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:18:\"replicate_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:49;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:16:\"reorder_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:50;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:15:\"delete_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:51;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:19:\"delete_any_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:52;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:21:\"force_delete_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:53;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:25:\"force_delete_any_schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:54;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:10:\"view_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:55;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:14:\"view_any_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:56;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:12:\"create_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:57;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:12:\"update_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:13:\"restore_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:17:\"restore_any_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:15:\"replicate_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:13:\"reorder_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:12:\"delete_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:16:\"delete_any_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:18:\"force_delete_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:22:\"force_delete_any_shift\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:13:\"view_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:11:\"update_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:12:\"restore_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:16:\"restore_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:14:\"replicate_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:12:\"reorder_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:15:\"delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:17:\"force_delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:21:\"force_delete_any_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:12:\"page_MapPage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Pegawai\";s:1:\"c\";s:3:\"web\";}}}', 1756347757);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_25_062004_create_offices_table', 1),
(5, '2024_06_25_062224_create_shifts_table', 1),
(6, '2024_06_25_062414_create_schedules_table', 1),
(7, '2024_06_25_063427_create_attendances_table', 1),
(8, '2024_06_25_074635_add_radius_to_office_table', 1),
(9, '2024_06_26_225701_add_is_wfa_to_schedule_table', 1),
(10, '2024_06_27_225449_change_attendance_table', 1),
(11, '2024_07_01_235626_create_personal_access_tokens_table', 1),
(12, '2024_07_20_043909_add_is_banned_to_schedule', 1),
(13, '2024_07_25_044208_create_leaves_table', 1),
(14, '2024_07_26_223656_add_is_leave_to_attendances_table', 1),
(15, '2024_08_02_062949_add_photo_profile_to_user_table', 1),
(17, '2024_09_03_140504_create_permission_tables', 2),
(18, '2025_08_26_143851_add_allowed_days_to_schedules_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25),
(2, 'App\\Models\\User', 26),
(2, 'App\\Models\\User', 27),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 33),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 35),
(2, 'App\\Models\\User', 36),
(2, 'App\\Models\\User', 37),
(2, 'App\\Models\\User', 38),
(2, 'App\\Models\\User', 39),
(2, 'App\\Models\\User', 40),
(2, 'App\\Models\\User', 41),
(2, 'App\\Models\\User', 42),
(2, 'App\\Models\\User', 43),
(2, 'App\\Models\\User', 44),
(2, 'App\\Models\\User', 45),
(2, 'App\\Models\\User', 46),
(2, 'App\\Models\\User', 47),
(2, 'App\\Models\\User', 48),
(2, 'App\\Models\\User', 49),
(2, 'App\\Models\\User', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `offices`
--

CREATE TABLE `offices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `radius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `offices`
--

INSERT INTO `offices` (`id`, `name`, `latitude`, `longitude`, `created_at`, `updated_at`, `deleted_at`, `radius`) VALUES
(1, 'Dinas Pariwisata dan Ekonomi Kreatif', -4.8100240849244, 122.40553309797, '2025-08-11 04:13:09', '2025-08-11 04:13:51', NULL, 100);

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
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(2, 'view_any_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(3, 'create_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(4, 'update_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(5, 'delete_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(6, 'delete_any_role', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(7, 'view_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(8, 'view_any_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(9, 'create_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(10, 'update_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(11, 'restore_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(12, 'restore_any_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(13, 'replicate_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(14, 'reorder_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(15, 'delete_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(16, 'delete_any_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(17, 'force_delete_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(18, 'force_delete_any_attendance', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(19, 'view_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(20, 'view_any_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(21, 'create_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(22, 'update_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(23, 'restore_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(24, 'restore_any_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(25, 'replicate_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(26, 'reorder_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(27, 'delete_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(28, 'delete_any_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(29, 'force_delete_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(30, 'force_delete_any_leave', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(31, 'view_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(32, 'view_any_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(33, 'create_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(34, 'update_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(35, 'restore_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(36, 'restore_any_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(37, 'replicate_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(38, 'reorder_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(39, 'delete_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(40, 'delete_any_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(41, 'force_delete_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(42, 'force_delete_any_office', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(43, 'view_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(44, 'view_any_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(45, 'create_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(46, 'update_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(47, 'restore_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(48, 'restore_any_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(49, 'replicate_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(50, 'reorder_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(51, 'delete_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(52, 'delete_any_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(53, 'force_delete_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(54, 'force_delete_any_schedule', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(55, 'view_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(56, 'view_any_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(57, 'create_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(58, 'update_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(59, 'restore_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(60, 'restore_any_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(61, 'replicate_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(62, 'reorder_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(63, 'delete_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(64, 'delete_any_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(65, 'force_delete_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(66, 'force_delete_any_shift', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(67, 'view_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(68, 'view_any_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(69, 'create_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(70, 'update_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(71, 'restore_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(72, 'restore_any_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(73, 'replicate_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(74, 'reorder_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(75, 'delete_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(76, 'delete_any_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(77, 'force_delete_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(78, 'force_delete_any_user', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15'),
(79, 'page_MapPage', 'web', '2025-08-11 03:53:15', '2025-08-11 03:53:15');

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

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'API Token', '9794be694b8de32180f77e804de84498f67949aa14ea40c450407b0fbf9a8564', '[\"*\"]', '2025-08-27 02:34:08', NULL, '2025-08-27 02:31:20', '2025-08-27 02:34:08'),
(2, 'App\\Models\\User', 18, 'API Token', 'd4b890e7fe2dec4e30b17ff3ca06fb305dcd4c0c9cd81d1b9f4d943e8bf14f1a', '[\"*\"]', '2025-08-27 03:55:44', NULL, '2025-08-27 03:54:21', '2025-08-27 03:55:44'),
(3, 'App\\Models\\User', 2, 'API Token', 'a667b2ad54e3c21ce7c9cbc1d8d2e8fb948aa6d10f3b28e94a5dd2d79e64e9f7', '[\"*\"]', '2025-08-27 07:31:54', NULL, '2025-08-27 05:59:27', '2025-08-27 07:31:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', 'web', '2025-08-11 03:52:35', '2025-08-11 03:52:35'),
(2, 'Pegawai', 'web', '2025-08-11 03:55:21', '2025-08-11 03:55:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `office_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_wfa` tinyint(1) NOT NULL DEFAULT 0,
  `is_banned` tinyint(1) NOT NULL DEFAULT 0,
  `allowed_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`allowed_days`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`id`, `user_id`, `shift_id`, `office_id`, `created_at`, `updated_at`, `is_wfa`, `is_banned`, `allowed_days`) VALUES
(2, 2, 1, 1, '2025-08-27 02:26:57', '2025-08-27 02:32:19', 1, 0, '[\"3\",\"5\"]'),
(3, 42, 1, 1, '2025-08-27 03:38:11', '2025-08-27 03:38:11', 0, 0, '[\"1\",\"5\"]'),
(4, 46, 1, 1, '2025-08-27 03:38:30', '2025-08-27 03:38:30', 0, 0, '[\"1\",\"5\"]'),
(5, 30, 1, 1, '2025-08-27 03:38:55', '2025-08-27 03:38:55', 0, 0, '[\"1\",\"5\"]'),
(6, 41, 1, 1, '2025-08-27 03:39:12', '2025-08-27 03:39:12', 0, 0, '[\"1\",\"5\"]'),
(7, 36, 1, 1, '2025-08-27 03:39:44', '2025-08-27 03:39:44', 0, 0, '[\"1\",\"5\"]'),
(8, 37, 1, 1, '2025-08-27 03:39:59', '2025-08-27 03:39:59', 0, 0, '[\"1\",\"5\"]'),
(9, 17, 1, 1, '2025-08-27 03:40:14', '2025-08-27 03:40:14', 0, 0, '[\"1\",\"5\"]'),
(10, 20, 1, 1, '2025-08-27 03:40:30', '2025-08-27 03:40:30', 0, 0, '[\"1\",\"5\"]'),
(11, 49, 1, 1, '2025-08-27 03:40:51', '2025-08-27 03:40:51', 0, 0, '[\"1\",\"5\"]'),
(12, 40, 1, 1, '2025-08-27 03:42:40', '2025-08-27 03:42:40', 0, 0, '[\"1\",\"5\"]'),
(13, 48, 1, 1, '2025-08-27 03:43:01', '2025-08-27 03:43:01', 0, 0, '[\"2\",\"5\"]'),
(14, 19, 1, 1, '2025-08-27 03:43:16', '2025-08-27 03:43:16', 0, 0, '[\"2\",\"5\"]'),
(15, 24, 1, 1, '2025-08-27 03:43:32', '2025-08-27 03:43:32', 0, 0, '[\"2\",\"5\"]'),
(16, 38, 1, 1, '2025-08-27 03:43:49', '2025-08-27 03:43:49', 0, 0, '[\"2\",\"5\"]'),
(17, 50, 1, 1, '2025-08-27 03:44:03', '2025-08-27 03:44:03', 0, 0, '[\"2\",\"5\"]'),
(18, 29, 1, 1, '2025-08-27 03:44:23', '2025-08-27 03:44:23', 0, 0, '[\"2\",\"5\"]'),
(19, 35, 1, 1, '2025-08-27 03:44:38', '2025-08-27 03:44:38', 0, 0, '[\"2\",\"5\"]'),
(20, 34, 1, 1, '2025-08-27 03:44:53', '2025-08-27 03:44:53', 0, 0, '[\"2\",\"5\"]'),
(21, 32, 1, 1, '2025-08-27 03:45:08', '2025-08-27 03:45:08', 0, 0, '[\"2\",\"5\"]'),
(22, 45, 1, 1, '2025-08-27 03:45:51', '2025-08-27 03:45:51', 0, 0, '[\"3\",\"5\"]'),
(23, 25, 1, 1, '2025-08-27 03:46:10', '2025-08-27 03:46:10', 0, 0, '[\"3\",\"5\"]'),
(24, 43, 1, 1, '2025-08-27 03:46:33', '2025-08-27 03:46:33', 0, 0, '[\"3\",\"5\"]'),
(25, 27, 1, 1, '2025-08-27 03:46:52', '2025-08-27 03:46:52', 0, 0, '[\"3\",\"4\"]'),
(26, 28, 1, 1, '2025-08-27 03:47:18', '2025-08-27 03:47:18', 0, 0, '[\"3\",\"5\"]'),
(27, 33, 1, 1, '2025-08-27 03:47:32', '2025-08-27 03:47:32', 0, 0, '[\"3\",\"5\"]'),
(28, 47, 1, 1, '2025-08-27 03:47:51', '2025-08-27 03:47:51', 0, 0, '[\"3\",\"5\"]'),
(29, 44, 1, 1, '2025-08-27 03:48:27', '2025-08-27 03:48:27', 0, 0, '[\"3\",\"5\"]'),
(30, 22, 1, 1, '2025-08-27 03:48:57', '2025-08-27 03:48:57', 0, 0, '[\"4\",\"5\"]'),
(31, 39, 1, 1, '2025-08-27 03:49:10', '2025-08-27 03:49:10', 0, 0, '[\"4\",\"5\"]'),
(32, 23, 1, 1, '2025-08-27 03:49:28', '2025-08-27 03:49:28', 0, 0, '[\"4\",\"5\"]'),
(33, 21, 1, 1, '2025-08-27 03:49:40', '2025-08-27 03:49:40', 0, 0, '[\"4\",\"5\"]'),
(34, 18, 1, 1, '2025-08-27 03:50:02', '2025-08-27 03:50:02', 0, 0, '[\"4\",\"5\"]'),
(35, 31, 1, 1, '2025-08-27 03:50:20', '2025-08-27 03:50:20', 0, 0, '[\"4\",\"5\"]'),
(36, 26, 1, 1, '2025-08-27 03:50:36', '2025-08-27 03:50:36', 0, 0, '[\"4\",\"5\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JX8vwHoVHG47I3DtyxNJgvTkiyZcqEPfQlVYNphu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiSm5nYzJhbGZscGFzaTdyS0owT09zNWk4Q0hCa2haclpWeE9xM3BZWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6ODoiZmlsYW1lbnQiO2E6MDp7fXM6MTE6ImltcGVyc29uYXRlIjthOjE6e3M6NToiZ3VhcmQiO3M6Mzoid2ViIjt9czoxMjoicmVtZW1iZXJfd2ViIjthOjI6e2k6MDtzOjUzOiJyZW1lbWJlcl93ZWJfM2RjN2E5MTNlZjVmZDRiODkwZWNhYmUzNDg3MDg1NTczZTE2Y2Y4MiI7aToxO3M6MTIzOiIxfGFoMUxSbGNVWWlFcUFZYjY5UW1pSHVESlVpZUJueGl5SFM5QlREUnNkdXd5NkFzYmM1YnAzZHFrelB4T3wkMnkkMTIkdEQ2WEVhczVJMzcxbDhDSlJvbUZjT2NOS3pvOXpsY2ZQV05XS05HRFFrcU5WSHlPUXQ0a0ciO31zOjUwOiJsb2dpbl93ZWJfM2RjN2E5MTNlZjVmZDRiODkwZWNhYmUzNDg3MDg1NTczZTE2Y2Y4MiI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkdEQ2WEVhczVJMzcxbDhDSlJvbUZjT2NOS3pvOXpsY2ZQV05XS05HRFFrcU5WSHlPUXQ0a0ciO30=', 1756343142),
('PDaqiVePXTT97mI3dNQOBltIIFHUhqJhb0WCcoPc', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6Imt1M3pWNFJuOVU1NkhLcTRvN2R6bFBSTGtweHc0WnlYNzJNSE02ZW0iO3M6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjY6InRhYmxlcyI7YToxOntzOjQ4OiI4MzMyYWRjYjBlMmU1NWU2ZDk3ZjYyY2NlZTI1ZjEyOV90b2dnbGVkX2NvbHVtbnMiO2E6Mzp7czo0OiJ1c2VyIjthOjE6e3M6NToiZW1haWwiO2I6MDt9czoxMDoiY3JlYXRlZF9hdCI7YjowO3M6MTA6InVwZGF0ZWRfYXQiO2I6MDt9fXM6ODoiZmlsYW1lbnQiO2E6MDp7fXM6NDA6IjQ4MDQwZWY3ZjI1NDJiMzliOWJhOWE3Mjk4M2IwZDg4X2ZpbHRlcnMiO2E6Mjp7czo5OiJzdGFydERhdGUiO047czo3OiJlbmREYXRlIjtOO31zOjExOiJpbXBlcnNvbmF0ZSI7YToxOntzOjU6Imd1YXJkIjtzOjM6IndlYiI7fXM6MTI6InJlbWVtYmVyX3dlYiI7YToyOntpOjA7czo1MzoicmVtZW1iZXJfd2ViXzNkYzdhOTEzZWY1ZmQ0Yjg5MGVjYWJlMzQ4NzA4NTU3M2UxNmNmODIiO2k6MTtzOjEyMzoiMXxhaDFMUmxjVVlpRXFBWWI2OVFtaUh1REpVaWVCbnhpeUhTOUJURFJzZHV3eTZBc2JjNWJwM2Rxa3pQeE98JDJ5JDEyJHRENlhFYXM1STM3MWw4Q0pSb21GY09jTkt6bzl6bGNmUFdOV0tOR0RRa3FOVkh5T1F0NGtHIjt9czo1MDoibG9naW5fd2ViXzNkYzdhOTEzZWY1ZmQ0Yjg5MGVjYWJlMzQ4NzA4NTU3M2UxNmNmODIiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEyJHRENlhFYXM1STM3MWw4Q0pSb21GY09jTkt6bzl6bGNmUFdOV0tOR0RRa3FOVkh5T1F0NGtHIjt9', 1756306350);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pagi-Sore', '08:00:00', '16:00:00', '2025-08-11 04:15:38', '2025-08-11 04:15:38', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
(1, 'super admim', 'admin@admin.com', NULL, '$2y$12$tD6XEas5I371l8CJRomFcOcNKzo9zlcfPWNWKNGDQkqNVHyOQt4kG', 'ah1LRlcUYiEqAYb69QmiHuDJUieBnxiyHS9BTDRsduwy6Asbc5bp3dqkzPxO', '2025-08-11 03:48:58', '2025-08-11 03:48:58', NULL),
(2, 'Muhammad Adi Rezky', 'muhammadadirezky@gmail.com', NULL, '$2y$12$5m4rvy/5jrdqd30GIbUkduzKt8g5ZewXpi/0v6HUtC44V86T7CMX2', '5GdKaw9s57ItnNTIe2cXSnYdYyLuzFT1Ixf0gyIx3pFUgULxNVnkA5CV4Roe', '2025-08-11 03:58:13', '2025-08-27 02:26:28', '01K3MNJ6Q0FEA40S159BTBFTZC.jpg'),
(17, 'LA ODE RISMAN JUAN ', 'rismanjuan17@gmail.com', NULL, '$2y$12$KywRTIlohf81Uv6VLt/yWOYucHPbl4SEw9H1PMbigKT6e2HrHbhMC', NULL, '2025-08-27 02:37:43', '2025-08-27 02:37:43', '01K3MP6T41N9CZD3MYSWAW15AT.jpg'),
(18, 'SITI SALMA,SE', 'salmakola203@gmail.com', NULL, '$2y$12$daeOZqBIa4kx1HI43w9yQOuIseRlCCalTh6IauODlC7fwBq3Dvu1W', NULL, '2025-08-27 02:38:58', '2025-08-27 02:38:58', '01K3MP93HRKEYA8A1HQ2D1XWEX.jpeg'),
(19, 'Suharmono', 'monosuhar239@gmail.com', NULL, '$2y$12$NnS6BneDQJF4cdbQak0Mc.cEO2hWuMTNLoXSZA1j6KCoWhjUWL7a6', NULL, '2025-08-27 02:42:01', '2025-08-27 02:42:01', '01K3MPEPB9NB0GS4Y1H9S77R8T.jpg'),
(20, 'HASRIANI,S.S', 'hasrianiss95@gmail.com', NULL, '$2y$12$yYXhxv6O3wFAjKEzCqOnce.Flb78nQ/p2bjaq.2zr1VY.gaTQfPNm', NULL, '2025-08-27 02:43:13', '2025-08-27 02:43:13', '01K3MPGWA1QYR8H3Q6TR0107HE.jpg'),
(21, 'La Ode Duma', 'dumalaodefika@gmail.com', NULL, '$2y$12$GB8txElpXqbG0GlhDI/nl.RsgCs2eu2qmvmICvoLWEWB.zc8gOXzi', NULL, '2025-08-27 02:51:11', '2025-08-27 02:51:11', '01K3MPZFCY1SS3XZTKQ2YJRRDE.jpg'),
(22, 'JAIMIN ', 'jaiminimin8@gmail.com', NULL, '$2y$12$Ga0bltVg68jj6OpjEL04FeLeM0cr9uqbJzqrj1AU0d1JC42ZIMgVq', NULL, '2025-08-27 02:52:30', '2025-08-27 02:52:30', '01K3MQ1WCWEN7ABC4Y0N200Y3X.jpg'),
(23, 'Jamilah Harwati', 'jamilaharsyil1996@gmail.com', NULL, '$2y$12$avxUGtF/XWFRdjovFvkNOO49uyEEM.EUuVWISTcA5mKBUTZjrE3Hm', NULL, '2025-08-27 02:53:36', '2025-08-27 02:53:36', '01K3MQ3WQ525N12DH0A82FD5CY.jpg'),
(24, 'WA NAUMA', 'umamarobea82@gmail.com', NULL, '$2y$12$d8Pb/Fji8aDGHqKE1Xhnh.P/m.O3/cuGK4xtZrnz.suL4fxFbC.n2', NULL, '2025-08-27 02:55:37', '2025-08-27 02:55:37', '01K3MQ7K1FEN6JWBR4YXA88RPC.jpg'),
(25, 'Nofrianto', 'nofrianto558@gmail.com', NULL, '$2y$12$8gPJpoN2U0JX/mMu6M/QOev2V7AVeoXTn.w3Pay0dkrxTKT5YRi/m', NULL, '2025-08-27 02:58:19', '2025-08-27 02:58:19', '01K3MQCHR1QVQQ24WHD6TCP11F.jpg'),
(26, 'USMARADIN ', 'telematcoeew@gmail.com', NULL, '$2y$12$J/QVUP26q6PJxJBm78RLBugvnXTpoQCAuzWYqP.1Ivi28Y8J19MPG', NULL, '2025-08-27 02:59:33', '2025-08-27 02:59:33', '01K3MQESKBPKPVV68BYK9CX1RK.jpg'),
(27, 'Karmilawati ', 'karmilawati011294@gmail.com', NULL, '$2y$12$8V8WdjiawZoRvOMGnjj0lu3BePvXlJbFO/06R.eZQ5QtOVefK8oay', NULL, '2025-08-27 03:00:22', '2025-08-27 03:00:22', '01K3MQG97XJR4KA792HWVQPWYE.jpg'),
(28, 'WA ODE JUMIATI RAMADHAN', 'waodejum@gmail.com', NULL, '$2y$12$Im6gQeSZyQct6zxh6cTrY.TfxlvqFQBqjODCsDakrA2NJNVtwGsju', NULL, '2025-08-27 03:01:13', '2025-08-27 03:01:13', '01K3MQHV23NR3ZK8BPP599QPKX.jpg'),
(29, 'Bagus sulasti karuneng', 'bagussulasti8@gmail.com', NULL, '$2y$12$llGWQGH1lxfoAR5Cwsqe5uOqey3Yfq09YQ5xqfoTkqX/CzTicZpOa', NULL, '2025-08-27 03:02:26', '2025-08-27 03:02:26', '01K3MQM2V5H5172JX51EX81ADS.jpg'),
(30, 'Sri Martia Handa ', 'srimartiahanda4@gmail.com', NULL, '$2y$12$ewMaesQdt20cj1zmSFssS.V78fBaSI0gtN6jn5n0BhU6gLZ/pfIk2', NULL, '2025-08-27 03:05:51', '2025-08-27 03:05:51', '01K3MQTAHCK2C07S1GR9TWFHJG.jpg'),
(31, 'LAODE MUHAMMAD RAMADDAN', 'laoderamadan94@gmail.com', NULL, '$2y$12$PPXEoA1IAWgHsJqVrPaUUOQzHZdog8kbIWRalwhmGQP8vap13WLra', NULL, '2025-08-27 03:08:42', '2025-08-27 03:08:42', '01K3MQZJA2WN5NRDP5BGKWQSC7.jpg'),
(32, 'Ade syahrul', 'syahruladhe88@gmail.com', NULL, '$2y$12$qoSf2/6RkOqfgi0AyeOhouMFcrgT5iP5NkAePTFXYm1KY7mDZtIVi', NULL, '2025-08-27 03:10:20', '2025-08-27 03:13:57', '01K3MR2HYW2TWX03CWVDT1C9CT.jpg'),
(33, 'Meri Hasnawati', 'meryhasnawati5@gmail.com', NULL, '$2y$12$LhD/WpT7gP6U0htN/J9Kmuzd93muZDEi8Ytu064Fsv.dGXVHUQP1a', NULL, '2025-08-27 03:11:29', '2025-08-27 03:11:29', '01K3MR4N03E8MCJ9PN7HT589GQ.jpg'),
(34, 'LA FUJI', 'lafujifuji@gmail.com', NULL, '$2y$12$EyXQmN35gICJMtR9gB4r.uN1tkCiT9pBvGp9GdU/9FdVNOGDstOCS', NULL, '2025-08-27 03:12:28', '2025-08-27 03:12:28', '01K3MR6EZJKZS2KHHE2TVW97PK.jpg'),
(35, 'MASRUN', 'masrunbangmas@gmail.com', NULL, '$2y$12$ccZ4m3wUni04l6M3ucuLze.Pxh04Ls0iD5j48DOUUEra8UXyIpuBi', NULL, '2025-08-27 03:13:27', '2025-08-27 03:14:22', '01K3MR88N1ZDSD303V3Y46V6KM.jpg'),
(36, 'Laode Amrin Gani ', 'laode.241269@gmail.com', NULL, '$2y$12$32vYcDPGAMBZ.BRT3BU8DuaEl60IrfAmxu1ZDtLgIb7sKq9Jqb2TK', NULL, '2025-08-27 03:15:18', '2025-08-27 03:15:18', '01K3MRBMP3FRD35Q977FM5CVEK.jpg'),
(37, 'La Ode Alibaba', 'alibaba063.rr@gmail.com', NULL, '$2y$12$ZCZyFUzUJxLXz.bJewGWuOjrORkrEdJ73vwvALAuxbdj6DDz0ofl.', NULL, '2025-08-27 03:16:32', '2025-08-27 03:16:32', '01K3MRDX9Q9YWW8QA5VEMV281G.jpg'),
(38, 'Fitrawati', 'Fhitrawati028@gmail.com', NULL, '$2y$12$rRiGIWKSd3V7tabqkbu.w.wDYL8SNgN4eiKfTECMOzsAsamMtOg6i', NULL, '2025-08-27 03:18:49', '2025-08-27 03:18:49', '01K3MRJ2R2N4YK0DNWG4YTWE02.jpg'),
(39, 'Wa Ode Haripa', 'waodeharipa688@mail.com', NULL, '$2y$12$I3vI5ZYv9TPX2ybQH2SL5uwzcSR4ccedmwOi2SN2rSqfLyvmjnWVu', NULL, '2025-08-27 03:19:51', '2025-08-27 03:19:51', '01K3MRKYWQ1BF7HF4DTRP97WEA.jpg'),
(40, 'Siti Nurahmi', 'nurahmisiti094@gmail.com', NULL, '$2y$12$JiovSi1i22etDIAvZKTLcug6P0hzslRXm0zONKMmHkI7hEOizhN1W', NULL, '2025-08-27 03:20:48', '2025-08-27 03:20:48', '01K3MRNQCGXVTQNFHN188RENZ5.jpg'),
(41, 'Mirnawati', 'mhyirnatourism@gmail.com', NULL, '$2y$12$V0oxeos522BYmhCbdcOMn.k5Vj9dYtGWDCuGBXxahZ17wS56d4ACm', NULL, '2025-08-27 03:22:10', '2025-08-27 03:22:10', '01K3MRR704F972HP8VDZZC20QG.jpg'),
(42, 'Asrah Yani, S.Psi', 'asrahyani.88@gmail.com', NULL, '$2y$12$/YStZ0oDrojYZJX6IAg2/uTR6aY0E8VqZaZLT8oH.TYM3MS5g3Cti', NULL, '2025-08-27 03:22:48', '2025-08-27 03:22:48', '01K3MRSCEVFXZPGY16F1K5E1Y1.jpg'),
(43, 'LA ODE JAMILATIF', 'laodejamilatif78@gmail.com', NULL, '$2y$12$QehA33Zq8oG0XcOzoLoI4eFI1mLoDLRxe8KrsPDjPvJxj9Jo7Sswe', NULL, '2025-08-27 03:24:02', '2025-08-27 03:24:02', '01K3MRVMFGQCGP6E2XCMYFZ8N9.jpg'),
(44, 'LA ODE MUHAMMAD ARIANTO ZENTIARAS', 'laode.muh.arianto.z@gmail.com', NULL, '$2y$12$VTSXO8xOibE9XO.K7l/7zOaa8srucsBEOP8t./IqIPAbcI7kxbmYO', NULL, '2025-08-27 03:25:14', '2025-08-27 03:25:14', '01K3MRXTEBZKSCYAAZ8S7TKKDB.jpg'),
(45, 'SATMAN RICA BUANA MANAN', 'rihan.2007.rh@gmail.com', NULL, '$2y$12$JsZpZfIYilDFs.toMX4QNeWbhQ6.traoG3lV6UqjhYeX7nLUDX1zi', NULL, '2025-08-27 03:26:00', '2025-08-27 03:26:00', '01K3MRZ82QW6YR404DF6CRFDM9.jpg'),
(46, 'La Nintabe', 'anintabe9@gmail.com', NULL, '$2y$12$Y1dJlGqmlL/OQBD4KUw3g.xTJpMdqSrVx0X6yRZCCTUsoRBdBtGY6', NULL, '2025-08-27 03:27:47', '2025-08-27 03:27:47', '01K3MS2G2RVHG8Z0665DA6W6TT.jpg'),
(47, 'Siti Mariana', 'marianahasanudin@gmail.com', NULL, '$2y$12$ebcv/PDshchcTojM8fftyOe3dp1xk1NMwC9C492ChwtcB3I7syLwO', NULL, '2025-08-27 03:29:49', '2025-08-27 03:29:49', '01K3MS675H38E022HPG9NQCCBV.jpg'),
(48, 'LM.HARUNZAIN.HATU', 'Harunzain70@gmail.com', NULL, '$2y$12$r1mS6ivgEsolhU.DFLPcVenjyuFwR9a2Ummdh6RsX9Ygob8eMa2aq', NULL, '2025-08-27 03:30:51', '2025-08-27 03:30:51', '01K3MS83YQHQZJ7GBWT2BAYDWR.jpeg'),
(49, 'Zamrul', 'basecampemerald@gmail.com', NULL, '$2y$12$V9fS.ZcdEUcfk9hHQ32fR.HpgDizsoqE8stSRxqzLXtNyY62Pfw1e', NULL, '2025-08-27 03:31:46', '2025-08-27 03:31:46', '01K3MS9SEAQXDZ559J6NQ11DT3.jpg'),
(50, 'WA ODE RAHMINA, S.Pd', 'waoderahmina782@gmail.com', NULL, '$2y$12$jIjg3EUya4IAcejWA1rZuOEP9hjx0k052Kr2DJOixju1twHOJ5xNq', NULL, '2025-08-27 03:32:44', '2025-08-27 03:32:44', '01K3MSBHZ74T81EN1PZ8Z16SKS.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedules_user_id_unique` (`user_id`),
  ADD KEY `schedules_shift_id_foreign` (`shift_id`),
  ADD KEY `schedules_office_id_foreign` (`office_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `offices`
--
ALTER TABLE `offices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_office_id_foreign` FOREIGN KEY (`office_id`) REFERENCES `offices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
