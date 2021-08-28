-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for automobile_management_system
DROP DATABASE IF EXISTS `automobile_management_system`;
CREATE DATABASE IF NOT EXISTS `automobile_management_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `automobile_management_system`;

-- Dumping structure for table automobile_management_system.accounts
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_no` varchar(40) NOT NULL,
  `holder_ref` int(11) NOT NULL,
  `holder_name` varchar(60) NOT NULL,
  `holder_type` varchar(30) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table automobile_management_system.accounts: ~5 rows (approximately)
DELETE FROM `accounts`;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `acc_no`, `holder_ref`, `holder_name`, `holder_type`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '123456789456', 3, 'Car Heaven', 'Admin', '500000', '2021-06-04 20:23:42', NULL, NULL),
	(2, '123456789123', 1, 'Dream Car', 'Admin', '1131250', '2021-06-04 20:24:07', '2021-06-05 16:43:50', NULL),
	(3, '123456789166', 2, 'Super Admin', 'Super Admin', '103750', '2021-06-04 20:28:42', '2021-06-05 16:43:50', NULL),
	(4, '123456789111', 1, 'User Holder', 'User', '500000', '2021-06-05 11:53:14', '2021-06-05 12:19:02', NULL),
	(5, '1234567895555', 2, 'User Holder two', 'User', '75000', '2021-06-05 11:53:51', '2021-06-05 16:43:50', NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `type` enum('Super Admin','Admin') COLLATE utf8mb4_unicode_ci DEFAULT 'Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.admins: ~3 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `name`, `email`, `pass`, `city`, `state`, `zip_code`, `country`, `card_holder_name`, `card_number`, `status`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Dream Car', 'dream@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'Dream Car', 123456789123, 1, 'Admin', '2021-02-17 07:20:33', '2021-02-17 07:20:33', NULL),
	(2, 'Super Admin', 'sadmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'Super Admin', 0, 1, 'Super Admin', '2021-02-16 18:00:00', '2021-02-16 18:00:00', NULL),
	(3, 'Car Heaven', 'carhaven@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, 'Car Heaven', 123456789456, 1, 'Admin', '2021-05-24 07:35:54', '2021-05-24 07:35:54', NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.categories: ~3 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `name`, `url`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 0, 'Car', 'Car', 1, NULL, '2021-05-24 07:36:35', '2021-05-24 07:36:35'),
	(2, 1, 'Mercedes-Benz', 'Mercedes-Benz', 1, NULL, '2021-05-24 07:37:10', '2021-05-24 07:37:10'),
	(3, 1, 'Toyota', 'Toyota', 1, NULL, '2021-05-24 07:42:01', '2021-05-24 07:42:01');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.checkouts
DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE IF NOT EXISTS `checkouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `card_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` bigint(20) NOT NULL,
  `showroom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_card_number` bigint(20) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkouts_admin_id_index` (`admin_id`),
  KEY `checkouts_user_id_index` (`user_id`),
  CONSTRAINT `checkouts_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.checkouts: ~0 rows (approximately)
DELETE FROM `checkouts`;
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.migrations: ~6 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(13, '2020_12_10_122054_create_admins_table', 1),
	(14, '2020_12_10_122218_create_categories_table', 1),
	(15, '2020_12_10_122307_create_vehicles_table', 1),
	(16, '2020_12_10_122509_create_vehicles_images_table', 1),
	(17, '2021_02_18_144136_create_users_table', 2),
	(18, '2021_02_18_144235_create_checkouts_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.transactions
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_account` varchar(255) NOT NULL,
  `to_account` varchar(255) NOT NULL,
  `booking_amount` varchar(255) NOT NULL,
  `tax` int(11) DEFAULT NULL COMMENT 'based on booking amount',
  `tax_amount` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) NOT NULL,
  `trans_type` varchar(255) NOT NULL,
  `amount_type` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table automobile_management_system.transactions: ~2 rows (approximately)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `from_account`, `to_account`, `booking_amount`, `tax`, `tax_amount`, `net_amount`, `trans_type`, `amount_type`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(23, '1234567895555', '123456789123', '375000', 3, '11250', '363750', 'deposit', 'cash', 'Amount deposit from: 1234567895555 To My account: 123456789123 for Booking. Booking Amount:375000Tk  Tax:3% TaxAmount:11250Tk  You paid amount: 363750Tk Admin cut: 363750 Tk', '2021-06-05 16:43:50', '2021-06-05 16:43:50', NULL),
	(24, '1234567895555', '123456789123', '375000', 0, '0', '375000', 'withdraw', 'cash', 'Amount withdraw from My account: 1234567895555 Transfer To Brand account: 123456789123 for Booking amount: 375000Tk', '2021-06-05 16:43:50', '2021-06-05 16:43:50', NULL),
	(25, '123456789123', '123456789166', '0', 0, '0', '11250', 'tax', 'cash', 'Amount deposit from: 1234567895555 To My account: 123456789166 for Booking amount: 375000Tk Tax:3% TaxAmount:11250Tk Your paid amount: 11250Tk', '2021-06-05 16:43:50', '2021-06-05 16:43:50', NULL);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.vehicles
DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `admin_id` bigint(20) unsigned NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_power` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_speed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `torque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_consumption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `door` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drive_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wheel_base` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `height` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_tank_capacity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_cylinder` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` bigint(20) NOT NULL,
  `booking_rate` int(11) NOT NULL DEFAULT 25 COMMENT 'booking rate defined only percent',
  `showroom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase` bigint(20) NOT NULL,
  `selling` bigint(20) NOT NULL DEFAULT 0,
  `booking_status` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_admin_id_index` (`admin_id`),
  CONSTRAINT `vehicles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.vehicles: ~2 rows (approximately)
DELETE FROM `vehicles`;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` (`id`, `category_id`, `admin_id`, `brand`, `model`, `year`, `mileage`, `engine_capacity`, `fuel_type`, `max_power`, `max_speed`, `torque`, `fuel_consumption`, `door`, `drive_type`, `seats`, `wheel_base`, `weight`, `length`, `width`, `height`, `fuel_tank_capacity`, `color`, `no_of_cylinder`, `description`, `price`, `booking_rate`, `showroom_name`, `address`, `contact`, `image`, `purchase`, `selling`, `booking_status`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Mercedes-Benz', 'E-Studio2303A', '2020', '20km', '20', 'Premium gasoline', '194hp@6000rpm(165kw)', '155Mph', '236LB.FT@1450-4200RP', '7.7-9.9L/100km', '4', 'Front Wheel Drive', '6', '2470', '1380', '4680', '1865', '1295', '12', 'red', '2', 'Fresh', 1500000, 25, 'Dream Car', 'Agrabadad', 99, '91986.png', 1400000, 1800000, 'booked', '2021-05-24 07:40:21', '2021-06-05 16:43:50'),
	(2, 3, 3, 'Toyota', '2018', '1997', '10km', '23', 'Octane', '194hp@6000rpm(165kw)', '155Mph', '295 LB-FT', '7.7-9.9L/100km', '4', 'easy', '6', '2470', '1380', '4680', '1877', '1295', '20', 'White', '2', 'Fresh', 2000000, 25, 'Car Heaven', 'Agrabadad', 99, '22753.jpg', 1600000, 1800000, '0', '2021-05-24 07:43:50', '2021-05-24 07:43:50');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;

-- Dumping structure for table automobile_management_system.vehicles_images
DROP TABLE IF EXISTS `vehicles_images`;
CREATE TABLE IF NOT EXISTS `vehicles_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table automobile_management_system.vehicles_images: ~0 rows (approximately)
DELETE FROM `vehicles_images`;
/*!40000 ALTER TABLE `vehicles_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles_images` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
