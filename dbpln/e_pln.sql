-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 12:41 AM
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
-- Database: `e_pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_02_16_212917_create_pelanggans_table', 1),
(6, '2025_02_16_212936_create_tarifs_table', 1),
(7, '2025_02_16_213019_create_pemakaians_table', 1),
(8, '2025_02_16_214020_add_jenis_pelanggan_to_pelanggans_table', 2),
(11, '2025_02_16_223055_add_tanggal_bayar_to_pemakaians_table', 3),
(12, '2025_02_16_223311_fix_status_pembayaran', 3),
(13, '2025_02_16_223507_ensure_status_pembayaran_column', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggans`
--

CREATE TABLE `pelanggans` (
  `no_kontrol` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `tarif_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggans`
--

INSERT INTO `pelanggans` (`no_kontrol`, `nama`, `alamat`, `telepon`, `tarif_id`, `created_at`, `updated_at`) VALUES
('PLN001', 'niel', 'Jl ro oto Iskandardinata 42-30', '081338629066', 0, '2025-02-16 15:15:51', '2025-02-16 15:15:51'),
('PLN002', 'senja', 'JL RAYA TAJUR DS. NDAH SARI', '081338629066', 0, '2025-02-16 15:22:10', '2025-02-16 15:22:10'),
('PLN003', 'arip', 'jalan beringin no 7', '081338629066', 0, '2025-02-16 15:50:04', '2025-02-16 15:50:04'),
('PLN004', 'Alfa', 'JL RAYA TAJUR DS. NDAH SARI', '081338629066', 3, '2025-02-16 16:18:28', '2025-02-16 16:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaians`
--

CREATE TABLE `pemakaians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_kontrol` varchar(255) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL,
  `jumlah_pakai` int(11) NOT NULL,
  `biaya_pemakaian` decimal(10,2) NOT NULL,
  `biaya_beban` decimal(10,2) NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `status_pembayaran` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_bayar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemakaians`
--

INSERT INTO `pemakaians` (`id`, `no_kontrol`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`, `jumlah_pakai`, `biaya_pemakaian`, `biaya_beban`, `total_bayar`, `status_pembayaran`, `created_at`, `updated_at`, `tanggal_bayar`) VALUES
(2, 'PLN002', 1, 2025, 10, 200, 190, 950000.00, 2000.00, 952000.00, 'lunas', '2025-02-16 15:29:40', '2025-02-16 15:36:45', '2025-02-16 15:36:45'),
(4, 'PLN001', 3, 2025, 200, 500, 300, 1500000.00, 2000.00, 1502000.00, 'lunas', '2025-02-16 15:49:51', '2025-02-16 16:18:50', '2025-02-16 16:18:50'),
(5, 'PLN004', 1, 2025, 2000, 9000, 7000, 9464000.00, 5000.00, 9469000.00, 'lunas', '2025-02-16 16:18:39', '2025-02-16 16:18:52', '2025-02-16 16:18:52'),
(6, 'PLN004', 1, 2025, 3000, 4000, 1000, 1352000.00, 5000.00, 1357000.00, 'belum_bayar', '2025-02-16 16:24:16', '2025-02-16 16:24:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `tarifs`
--

CREATE TABLE `tarifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_plg` varchar(255) NOT NULL,
  `biaya_beban` decimal(10,2) NOT NULL,
  `tarif_kwh` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tarifs`
--

INSERT INTO `tarifs` (`id`, `jenis_plg`, `biaya_beban`, `tarif_kwh`, `created_at`, `updated_at`) VALUES
(2, 'R1', 2000.00, 5000.00, '2025-02-16 15:19:55', '2025-02-16 15:19:55'),
(3, '950', 5000.00, 1352.00, '2025-02-16 15:53:39', '2025-02-16 15:53:39'),
(4, '2200', 3500.00, 1300.00, '2025-02-16 16:23:03', '2025-02-16 16:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','petugas') NOT NULL DEFAULT 'petugas',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$12$eXelvagNeiYEZB1g4thQb.xvaz/w8dXqySK2fK/YjbLN5z67lf/IK', 'petugas', NULL, '2025-02-16 15:07:16', '2025-02-16 15:07:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `pelanggans`
--
ALTER TABLE `pelanggans`
  ADD PRIMARY KEY (`no_kontrol`);

--
-- Indexes for table `pemakaians`
--
ALTER TABLE `pemakaians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemakaians_no_kontrol_foreign` (`no_kontrol`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tarifs`
--
ALTER TABLE `tarifs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemakaians`
--
ALTER TABLE `pemakaians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tarifs`
--
ALTER TABLE `tarifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemakaians`
--
ALTER TABLE `pemakaians`
  ADD CONSTRAINT `pemakaians_no_kontrol_foreign` FOREIGN KEY (`no_kontrol`) REFERENCES `pelanggans` (`no_kontrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
