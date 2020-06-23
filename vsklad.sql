-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1:3308
-- Čas generovania: Út 23.Jún 2020, 18:43
-- Verzia serveru: 8.0.18
-- Verzia PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `vsklad`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', NULL, NULL),
(2, 'Asus', '2020-06-22 12:57:13', '2020-06-22 12:57:13');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IT', '2020-06-18 12:44:27', '2020-06-18 12:44:27'),
(2, 'HR', '2020-06-18 14:07:47', '2020-06-18 14:07:47');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `inventory_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `devices`
--

INSERT INTO `devices` (`id`, `name`, `brand_id`, `type_id`, `order_id`, `serial_number`, `inventory_number`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Y530', 1, 1, 1, 'XXXXXXXXXXX', 123456, NULL, NULL, 2),
(2, 'Y730', 1, 1, 1, 'xxxxx12354', 22311335, '2020-05-23 12:44:52', '2020-05-23 12:44:52', 2),
(3, '111', 1, 2, 1, '1112244', 124, '2020-06-22 09:22:16', '2020-06-22 09:22:16', 2),
(4, 'XA02 ROG Strix SCOPE', 2, 2, 1, '1112244', 1124, '2020-06-22 13:02:25', '2020-06-22 19:31:03', 2),
(5, 'Zenbook 14 UX433FAC-A5125T Icicle Silver', 2, 1, 1, 'mmxnohdl1235', 20201, '2020-06-22 19:26:37', '2020-06-22 19:28:45', 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `device_request`
--

DROP TABLE IF EXISTS `device_request`;
CREATE TABLE IF NOT EXISTS `device_request` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_id` int(10) UNSIGNED NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `device_request`
--

INSERT INTO `device_request` (`id`, `request_id`, `device_id`) VALUES
(4, 2, 3),
(3, 2, 1),
(5, 3, 2),
(6, 4, 4),
(7, 5, 2),
(8, 7, 5),
(9, 8, 4);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_05_22_160027_create_roles_table', 1),
(10, '2020_05_22_160057_create_positions_table', 1),
(11, '2020_05_22_221716_create_brands_table', 2),
(12, '2020_05_22_224559_create_types_table', 2),
(13, '2020_05_22_224703_create_devices_table', 2),
(14, '2020_05_22_224714_create_orders_table', 2),
(15, '2020_06_18_104444_create_requests_table', 3),
(16, '2020_06_18_125954_create_request_type_table', 3),
(17, '2020_06_18_131956_create_departments_table', 3),
(18, '2020_06_18_142040_add_department_id_to_users_table', 3),
(19, '2020_06_22_103918_add_additional_columns_to_request', 4),
(20, '2020_06_22_104635_create_state_table', 4),
(23, '2020_06_22_105041_create_device_request_table', 5),
(24, '2020_06_22_143626_add_status_column_to_devices_table', 6);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  `end_of_warranty` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `delivery_date`, `end_of_warranty`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-23', '2020-07-31', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `positions`
--

INSERT INTO `positions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CEO', NULL, NULL),
(2, 'Brigadnik', NULL, NULL),
(3, 'Údržbár', '2020-05-22 16:22:40', '2020-05-22 16:22:40');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `technician_id` int(11) DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `requests`
--

INSERT INTO `requests` (`id`, `user_id`, `reason`, `created_at`, `updated_at`, `technician_id`, `state_id`) VALUES
(8, 1, 'sdafas', '2020-06-22 19:30:40', '2020-06-22 19:31:21', 1, 4),
(2, 4, 'qds', '2020-06-19 09:14:51', '2020-06-22 18:31:19', 4, 4),
(3, 4, 'Lebo leco', '2020-06-19 09:16:34', '2020-06-22 18:31:38', 4, 4),
(4, 4, 'asdawd', '2020-06-22 10:13:55', '2020-06-22 18:24:17', 4, 4),
(5, 4, 'olloiji', '2020-06-22 14:13:04', '2020-06-22 18:31:45', 4, 4),
(7, 1, 'Lebo som ho stratila.', '2020-06-22 19:28:17', '2020-06-22 19:29:02', 4, 4),
(10, 4, 'dadw', '2020-06-23 08:52:14', '2020-06-23 08:52:14', NULL, 1),
(11, 4, 'adwad', '2020-06-23 16:30:55', '2020-06-23 16:30:55', NULL, 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `request_type`
--

DROP TABLE IF EXISTS `request_type`;
CREATE TABLE IF NOT EXISTS `request_type` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `request_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `request_type`
--

INSERT INTO `request_type` (`id`, `request_id`, `type_id`) VALUES
(10, 8, 2),
(9, 7, 1),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1),
(6, 4, 2),
(7, 5, 1),
(12, 10, 2),
(13, 11, 1),
(14, 11, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL),
(2, 'Zamestnanec', 'zamestnanec', NULL, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', NULL, NULL),
(2, 'Klávesnica', '2020-06-16 08:51:46', '2020-06-16 08:51:46');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `position_id` int(11) NOT NULL DEFAULT '2',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `position_id`, `remember_token`, `created_at`, `updated_at`, `department_id`) VALUES
(1, 'Veronika', 'admin@gmail.com', NULL, '$2y$10$FcnhbB3MDSZTBxRdPe.JVu5Z7gTemEmNpDArdTGBQWPAehfXyN58i', 1, 2, NULL, NULL, '2020-06-18 13:24:13', 1),
(3, 'Fero', 'fero@fero.sk', NULL, '$2y$10$RA9AW1oq8zjWDAo84.hSAefHV6jp/WZtAasdxQF4kdKIhYCSust1m', 2, 2, NULL, '2020-05-22 15:54:03', '2020-05-22 15:54:03', 0),
(4, 'Michal Podrouzek', 'podrouzekmichal@gmail.com', NULL, '$2y$10$FcnhbB3MDSZTBxRdPe.JVu5Z7gTemEmNpDArdTGBQWPAehfXyN58i', 2, 1, NULL, '2020-06-16 07:16:04', '2020-06-22 19:50:33', 2),
(6, 'Mudr. Andrej Patka', 'patka@andrej.sk', NULL, '$2y$10$nmQyjDvAN7bTUtrY/gRHS.HTvHY96NVvoK80dJ7zq2P0NLKrA173W', 2, 3, NULL, '2020-06-18 13:27:06', '2020-06-18 13:27:06', 1),
(7, 'Ferovcik', 'michallo64@gmail.com', NULL, '$2y$10$8p0QCArsk6z6qHHdLWsE6.oWgENOyFeGIVi4od25al3PiFM6qZ0ja', 2, 3, NULL, '2020-06-22 20:03:08', '2020-06-22 20:03:45', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
