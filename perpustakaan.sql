-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table perpustakaan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','pending','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `membership_type` enum('regular','premium') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'regular',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.users: ~11 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `status`, `membership_type`, `role`, `phone`, `address`, `email_verified_at`, `password`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Perpustakaan', 'admin@perpustakaan.test', 'active', 'regular', 'admin', '081234567890', 'Jalan Merdeka No. 1', '2026-07-16 09:01:06', '$2y$12$PlTLf9FxknW4k2dQcdpJZ.rsJZ2ybas5EOjyWScEF0m7x.fakacT.', 'tCbrtC7erRqhFfRzhBF12s4u8JnP0Eeainz74A04YbAi98xZ7OPnzM1eREDd', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(2, 'Mrs. Claudine Bogisich DVM', 'turner.dovie@example.org', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'nC2OlEcbtI', NULL, '2026-07-16 09:01:06', '2026-07-17 01:50:42'),
	(3, 'Mrs. Nikita Nienow', 'rachelle.connelly@example.org', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'K6aN1YZ60z', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(4, 'Braeden Dooley', 'rherzog@example.net', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', '69aVo9gvoT', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(5, 'Norris Heaney', 'eschmidt@example.net', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'db9dbreBpF', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(6, 'Prof. Jovan Rutherford Jr.', 'price.doug@example.com', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'UuLQdIjBc5', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(7, 'Dr. Brett Quigley', 'efren.bogan@example.org', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', '67cJQS9qpH', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(8, 'Miss Hilda Gislason', 'gusikowski.hosea@example.net', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'gw6WJ7uCSA', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(9, 'Brennon Towne', 'fabiola98@example.com', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', 'rRpxHbYgFX', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(10, 'Mr. Brannon Hayes DDS', 'mraz.mable@example.org', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', '4s3YbanY1P', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(11, 'Mrs. Danika Murazik PhD', 'rkemmer@example.org', 'active', 'regular', 'member', NULL, NULL, '2026-07-16 09:01:06', '$2y$12$mww9WGfnsWAzZaNyz0hY0.J7PTgELtf6hPZpLBWzlJp.zCEs504fe', '9Z0YIkVKMQ', NULL, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(12, 'Tesetr', '123456@perpustakaan.test', 'active', 'regular', 'member', '12345678', NULL, NULL, '$2y$12$zcJtZC6IHKW0qn/UxSUpBewwa70DY8U8PrMu5daQSVPydKo/Qde2C', NULL, NULL, '2026-07-17 01:54:18', '2026-07-17 01:54:18');

-- Dumping structure for table perpustakaan.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Teknologi', 'Buku teknologi dan pemrograman.', 1, '2026-07-16 09:01:06', '2026-07-16 17:41:46'),
	(2, 'Sains', 'Buku tentang sains dan pengetahuan.', 1, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(3, 'Novel', 'Koleksi novel fiksi populer.', 1, '2026-07-16 09:01:06', '2026-07-16 09:01:06'),
	(4, 'Pendidikan', 'Buku referensi dan pendidikan.', 1, '2026-07-16 09:01:06', '2026-07-16 09:01:06');

-- Dumping structure for table perpustakaan.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('available','borrowed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `total_copies` int unsigned NOT NULL DEFAULT '1',
  `available_copies` int unsigned NOT NULL DEFAULT '1',
  `published_year` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `books_category_id_foreign` (`category_id`),
  CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.books: ~3 rows (approximately)
INSERT INTO `books` (`id`, `title`, `author`, `category_id`, `description`, `status`, `total_copies`, `available_copies`, `published_year`, `created_at`, `updated_at`) VALUES
	(1, 'Algoritma Dasar', 'Abdul Kadir', 1, 'Pengantar algoritma dasar.', 'available', 5, 4, '2022', '2026-07-16 09:01:06', '2026-07-18 23:50:42'),
	(2, 'Basis Data', 'Rosa Shalahuddin', 1, 'Dasar-dasar basis data.', 'available', 4, 4, '2021', '2026-07-16 09:01:06', '2026-07-18 23:41:08');

-- Dumping data for table perpustakaan.borrowings: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.cache: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.fines
CREATE TABLE IF NOT EXISTS `fines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `late_days` int NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL,
  `status` enum('unpaid','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fines_user_id_foreign` (`user_id`),
  KEY `fines_book_id_foreign` (`book_id`),
  CONSTRAINT `fines_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.fines: ~0 rows (approximately)
INSERT INTO `fines` (`id`, `user_id`, `book_id`, `late_days`, `amount`, `status`, `notes`, `created_at`, `updated_at`) VALUES
	(4, 2, 1, 0, 50000.00, 'unpaid', NULL, '2026-07-18 14:20:01', '2026-07-18 14:20:01'),
	(5, 12, 2, 0, 150000.00, 'unpaid', NULL, '2026-07-18 14:21:08', '2026-07-18 14:21:08');

-- Dumping structure for table perpustakaan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.jobs: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.job_batches: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.loans
CREATE TABLE IF NOT EXISTS `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `loaned_at` date NOT NULL,
  `due_at` date NOT NULL,
  `returned_at` date DEFAULT NULL,
  `status` enum('dipinjam','selesai','terlambat') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'dipinjam',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_user_id_foreign` (`user_id`),
  KEY `loans_book_id_foreign` (`book_id`),
  CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.loans: ~2 rows (approximately)
INSERT INTO `loans` (`id`, `user_id`, `book_id`, `loaned_at`, `due_at`, `returned_at`, `status`, `notes`, `created_at`, `updated_at`) VALUES
	(4, 2, 1, '2026-07-17', '2026-07-24', '2026-07-17', 'selesai', NULL, '2026-07-17 02:34:50', '2026-07-17 02:43:16'),
	(5, 2, 1, '2026-07-17', '2026-07-24', NULL, 'selesai', NULL, '2026-07-17 02:50:06', '2026-07-18 14:20:01'),
	(6, 2, 2, '2026-07-18', '2026-07-24', NULL, 'selesai', NULL, '2026-07-17 02:56:27', '2026-07-18 14:05:08'),
	(7, 12, 2, '2026-07-18', '2026-07-18', NULL, 'dipinjam', NULL, '2026-07-18 14:20:57', '2026-07-18 14:21:08'),
	(10, 12, 1, '2026-07-19', '2026-07-26', NULL, 'dipinjam', NULL, '2026-07-18 23:50:42', '2026-07-18 23:50:42');

-- Dumping structure for table perpustakaan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.migrations: ~12 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_07_10_110417_create_categories_table', 1),
	(5, '2026_07_10_110419_create_books_table', 1),
	(6, '2026_07_10_110420_create_loans_table', 1),
	(7, '2026_07_10_110422_create_fines_table', 1),
	(8, '2026_07_10_110423_add_role_phone_address_to_users_table', 1),
	(9, '2026_07_17_081936_create_returns_table', 2),
	(10, '2026_07_17_083346_add_member_fields_to_users_table', 3),
	(11, '2026_07_17_085603_create_fines_table', 4),
	(12, '2026_07_17_092322_create_reports_table', 5),
	(13, '2026_07_17_101121_create_borrowings_table', 6),
	(14, '2026_07_17_113118_create_wishlist_table', 7);

-- Dumping structure for table perpustakaan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table perpustakaan.reports
CREATE TABLE IF NOT EXISTS `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('peminjaman','pengembalian','denda') COLLATE utf8mb4_unicode_ci NOT NULL,
  `report_date` date NOT NULL,
  `total_summary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('selesai','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'selesai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.reports: ~1 rows (approximately)
INSERT INTO `reports` (`id`, `type`, `report_date`, `total_summary`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'peminjaman', '2026-07-17', '3 Buku Dipinjam', 'selesai', '2026-07-17 02:50:06', '2026-07-17 02:56:27'),
	(2, 'pengembalian', '2026-07-18', '4 Buku Dikembalikan', 'selesai', '2026-07-18 14:05:08', '2026-07-18 14:21:08'),
	(3, 'peminjaman', '2026-07-18', '1 Buku Dipinjam', 'selesai', '2026-07-18 14:20:57', '2026-07-18 14:20:57');

-- Dumping structure for table perpustakaan.returns
CREATE TABLE IF NOT EXISTS `returns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `returned_at` date NOT NULL,
  `late_days` int NOT NULL DEFAULT '0',
  `fine` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('kembali','terlambat','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kembali',
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `returns_loan_id_foreign` (`loan_id`),
  KEY `returns_user_id_foreign` (`user_id`),
  KEY `returns_book_id_foreign` (`book_id`),
  CONSTRAINT `returns_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `returns_loan_id_foreign` FOREIGN KEY (`loan_id`) REFERENCES `loans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.returns: ~1 rows (approximately)
INSERT INTO `returns` (`id`, `loan_id`, `user_id`, `book_id`, `returned_at`, `late_days`, `fine`, `status`, `condition`, `created_at`, `updated_at`) VALUES
	(5, 5, 2, 1, '2026-07-18', 0, 50000.00, 'kembali', 'rusak', '2026-07-18 14:15:30', '2026-07-18 14:15:30'),
	(6, 5, 2, 1, '2026-07-18', 0, 50000.00, 'kembali', 'rusak', '2026-07-18 14:18:43', '2026-07-18 14:18:43'),
	(7, 5, 2, 1, '2026-07-18', 0, 50000.00, 'kembali', 'rusak', '2026-07-18 14:20:01', '2026-07-18 14:20:01'),
	(8, 7, 12, 2, '2026-07-18', 0, 150000.00, 'kembali', 'hilang', '2026-07-18 14:21:08', '2026-07-18 14:21:08');

-- Dumping structure for table perpustakaan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping structure for table perpustakaan.wishlists
CREATE TABLE IF NOT EXISTS `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `book_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlist_user_id_book_id_unique` (`user_id`,`book_id`),
  KEY `wishlist_book_id_foreign` (`book_id`),
  CONSTRAINT `wishlist_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table perpustakaan.wishlists: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
