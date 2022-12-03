-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 07:58 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automobile_management_system_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `acc_no` varchar(40) NOT NULL,
  `holder_ref` int(11) NOT NULL,
  `holder_name` varchar(60) NOT NULL,
  `holder_type` varchar(30) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_no`, `holder_ref`, `holder_name`, `holder_type`, `amount`, `bank_name`, `branch_name`, `address`, `isDefault`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '123456789166', 2, 'Super Admin', 'Super Admin', '225380', 'Dutch-Bangla Bank limited', 'GEC, Chittagong', 'GEC, Chittagong', 1, '2021-06-04 14:28:42', '2021-08-31 13:04:29', NULL),
(19, 'A1207658745', 6, 'Arefin Rafi', 'User', '4746500', 'City Bank Limited', 'Probortok', 'Probortok, Panchlaish, Chittagong', 0, '2021-08-30 08:21:33', '2021-08-31 13:04:29', NULL),
(20, 'B1237894562', 6, 'Arefin Rafi', 'User', '2000000', 'Prime Bank Limited', 'GEC Chittagong', 'GEC Circle, Chittagong', 0, '2021-08-30 08:23:40', NULL, NULL),
(21, 'AC016783546', 7, 'Shajid Hassan', 'User', '8000000', 'City Bank Limited', 'GEC Chittagong', 'GEC Circle,Chittagong', 0, '2021-08-30 08:25:56', NULL, NULL),
(22, 'A0125684321', 7, 'Shajid Hassan', 'User', '2000000', 'Prime Bank Limited', 'Agrabad', 'Sheikh Mujib Road, Agrabad, Chittagong', 0, '2021-08-30 08:27:13', NULL, NULL),
(23, 'A1092567325', 9, 'Auto Heaven', 'Marchant', '12241995', 'BRAC Bank Limited', 'Agrabad', 'Agrabad, Chittagong', 0, '2021-08-30 08:32:46', '2021-08-31 13:04:29', NULL),
(24, 'B7890124567', 9, 'Auto Heaven', 'Marchant', '5000', 'Dhaka Bank Limited.', 'Agrabad', 'Agrabad, Chittagong', 0, '2021-08-30 08:34:14', NULL, NULL),
(25, 'K0001126892', 8, 'Khadija Tanis', 'User', '150000000', 'AB Bank Limited', 'GEC Chittagong', 'GEC Chittagong', 0, '2021-08-31 16:20:12', NULL, NULL),
(26, 'C8800157213', 10, 'Auto BD', 'Marchant', '50000', 'Prime Bank Limited', 'Agrabad', 'Agrabad, Chittagong', 0, '2021-08-31 17:33:07', NULL, NULL),
(27, 'K9995612342', 10, 'Auto BD', 'Marchant', '30000', 'BRAC Bank Limited', 'Agrabad', 'Agrabad, Chittagong', 0, '2021-08-31 17:34:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` bigint(20) DEFAULT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `type` enum('Super Admin','Admin') COLLATE utf8mb4_unicode_ci DEFAULT 'Admin',
  `isLogin` tinyint(1) NOT NULL DEFAULT 0,
  `gender` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `city`, `state`, `zip_code`, `country`, `card_holder_name`, `card_number`, `status`, `type`, `isLogin`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Super Admin', 'sadmin@gmail.com', '$2y$10$Gbb0Q9q2Grua6sHVx32JmOMqTXTOWh46jURRQHds1a7ZzVlMk0uHC', NULL, NULL, NULL, NULL, 'Super Admin', 0, 'pending', 'Super Admin', 1, 'male', '2021-02-16 12:00:00', '2021-02-16 12:00:00', NULL),
(9, 'Auto Heaven', 'autoheaven@gmail.com', '$2y$10$3DTdzlPKxcGR3COsef4M9ugY4qJZRq4uLte4/B0xMHRrXIH4MJ0HG', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'Admin', 0, 'male', NULL, NULL, NULL),
(10, 'Auto BD', 'autobd@gmail.com', '$2y$10$tOLdzkm12E5ghGstVhgYPuQMx5pd.qctRhvf3Kw1SN5FxQMg.wSXy', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'Admin', 1, 'male', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `url`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Car', 'Car', 1, NULL, '2021-05-24 01:36:35', '2021-08-28 04:20:50'),
(2, 1, 'Mercedes-Benz', 'Mercedes-Benz', 1, NULL, '2021-05-24 01:37:10', '2021-05-24 01:37:10'),
(3, 1, 'Toyota', 'Toyota', 1, NULL, '2021-05-24 01:42:01', '2021-05-24 01:42:01'),
(4, 1, 'Honda', 'Honda', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` bigint(20) NOT NULL,
  `showroom_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_card_number` bigint(20) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2020_12_10_122054_create_admins_table', 1),
(14, '2020_12_10_122218_create_categories_table', 1),
(15, '2020_12_10_122307_create_vehicles_table', 1),
(16, '2020_12_10_122509_create_vehicles_images_table', 1),
(17, '2021_02_18_144136_create_users_table', 2),
(18, '2021_02_18_144235_create_checkouts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `vechicle_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost_price` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `show_room_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `vechicle_id`, `owner_id`, `qty`, `cost_price`, `total_amount`, `tax`, `show_room_name`, `address`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 10, 9, 1, '1750000', '1750000', '10000.00', 'Auto Heaven', 'Agrabad, Chittagong', '01856789214', '2021-08-30 08:51:16', '2021-08-30 08:51:16', NULL),
(5, 11, 9, 1, '7000000', '7000000', '20000.00', 'Auto Heaven', 'Seikh Mujib Road, Agrabad', '01856789214', '2021-08-31 16:41:32', '2021-08-31 16:41:32', NULL),
(6, 12, 9, 1, '8000000', '8000000', '30000.00', 'Auto Heaven', 'Sheikh Mujid Road, Agrabad', '01856789214', '2021-08-31 16:57:43', '2021-08-31 16:57:43', NULL),
(7, 13, 9, 1, '7500000', '7500000', '18000.00', 'Auto Heaven', 'Seikh Mujib Road, Agrabad', '01856789214', '2021-08-31 17:29:26', '2021-08-31 17:29:26', NULL),
(8, 14, 10, 1, '11000000', '11000000', '50000.00', 'Auto BD', 'Agrabad, Chittagong', '01875698742', '2021-08-31 17:47:08', '2021-08-31 17:47:08', NULL),
(9, 15, 10, 1, '3200000', '3200000', '15000.00', 'Auto BD', 'Agrabad, Chittagong', '01875698742', '2021-08-31 17:49:57', '2021-08-31 17:49:57', NULL),
(10, 16, 10, 1, '9000000', '9000000', '35000.00', 'Auto BD', 'Agrabad, Chittagong', '01875698742', '2021-08-31 17:54:04', '2021-08-31 17:54:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `solds`
--

CREATE TABLE `solds` (
  `id` int(11) NOT NULL,
  `vechicle_id` int(11) NOT NULL,
  `marchant_id` int(11) NOT NULL,
  `diposit_account` varchar(60) DEFAULT NULL,
  `sold_qty` int(11) NOT NULL,
  `sale_price` varchar(255) DEFAULT NULL,
  `booking_rate` int(11) NOT NULL,
  `show_room` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `action` varchar(60) NOT NULL DEFAULT 'off',
  `booking_status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `solds`
--

INSERT INTO `solds` (`id`, `vechicle_id`, `marchant_id`, `diposit_account`, `sold_qty`, `sale_price`, `booking_rate`, `show_room`, `address`, `phone`, `action`, `booking_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 10, 9, 'A1092567325', 1, '1950000', 5, 'Auto Heaven', 'Sheikh mujib road chittagong', 1856789214, 'on', 'booked', '2021-08-31 12:58:36', '2021-08-31 12:58:58', NULL),
(8, 11, 9, 'A1092567325', 1, '7500000', 5, 'Auto Heaven', 'Sheikh Mujib Road, Agrabad', 1856789214, 'on', NULL, '2021-08-31 16:59:35', '2021-08-31 17:01:01', NULL),
(9, 12, 9, 'A1092567325', 1, '8500000', 5, 'Auto Heaven', 'Sheikh Mujib Road, Agrabad', 1856789214, 'on', NULL, '2021-08-31 17:00:20', '2021-08-31 17:00:43', NULL),
(10, 13, 9, 'A1092567325', 1, '7900000', 5, 'Auto Heaven', 'Seikh Mujib Road, Chittagong', 1856789214, 'on', NULL, '2021-08-31 17:30:15', '2021-08-31 17:30:27', NULL),
(11, 16, 10, 'C8800157213', 1, '9500000', 5, 'Auto BD', 'Agrabad, Chittagong', 1875698742, 'on', NULL, '2021-08-31 17:54:53', '2021-08-31 17:57:00', NULL),
(12, 15, 10, 'C8800157213', 1, '3500000', 5, 'Auto BD', 'Agrabad, Chittagong', 1875698742, 'on', NULL, '2021-08-31 17:55:35', '2021-08-31 17:56:50', NULL),
(13, 14, 10, 'C8800157213', 1, '11800000', 5, 'Auto BD', 'Agrabad, Chittagong', 1875698742, 'on', NULL, '2021-08-31 17:56:27', '2021-08-31 17:56:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `vechicle_id` int(11) DEFAULT NULL,
  `trans_by` varchar(255) DEFAULT NULL,
  `trans_by_id` int(11) DEFAULT NULL,
  `trans_for` varchar(60) DEFAULT NULL,
  `trans_for_id` int(11) DEFAULT NULL,
  `from_account` varchar(255) NOT NULL,
  `to_account` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `tax` int(11) DEFAULT NULL COMMENT 'based on booking amount',
  `tax_amount` varchar(255) DEFAULT NULL,
  `net_amount` varchar(255) NOT NULL,
  `trans_type` varchar(255) NOT NULL,
  `amount_type` varchar(120) NOT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `vechicle_id`, `trans_by`, `trans_by_id`, `trans_for`, `trans_for_id`, `from_account`, `to_account`, `amount`, `tax`, `tax_amount`, `net_amount`, `trans_type`, `amount_type`, `note`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(71, 10, 'user', 6, 'merchant', 9, 'A1207658745', 'A1092567325', '97500', 5, '4875', '92625', 'deposit', 'cash', 'Amount deposit from: A1207658745 To My account: A1092567325 for Booking. Booking Amount:97500Tk  Tax:5% TaxAmount:4875Tk  You paid amount: 92625Tk Admin cut: 4875 Tk', 'pending', '2021-08-31 13:04:29', '2021-08-31 13:04:29', NULL),
(72, 10, 'user', 6, 'user', 6, 'A1207658745', 'A1092567325', '97500', 0, '0', '97500', 'withdraw', 'cash', 'Amount withdraw from My account: A1207658745 Transfer To Brand account: A1092567325 for Booking amount: 97500Tk', 'pending', '2021-08-31 13:04:29', '2021-08-31 13:04:29', NULL),
(73, 10, 'user', 6, 'super-admin', 2, 'A1092567325', '123456789166', '0', 0, '0', '4875', 'tax', 'cash', 'Amount deposit from: A1207658745 To My account: 123456789166 for Booking amount: 97500Tk Tax:5% TaxAmount:4875Tk Your paid amount: 4875Tk', 'pending', '2021-08-31 13:04:29', '2021-08-31 13:04:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isLogin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `isLogin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'Arefin Rafi', 'arefin.rafi@gmail.com', '$2y$10$mH29m83djBUst6Pt487/h.74o3TWGb8Rx9IIMwB7WW2MddTQyyUdm', 'male', 0, NULL, NULL, NULL),
(7, 'Shajid Hassan', 'Shajid4@gmail.com', '$2y$10$V9iwJShuWKVYJ9J2tRt/DecdUh/Ve7j2hnxb2Jgwxk2QZCaJHHXpy', 'male', 0, NULL, NULL, NULL),
(8, 'Khadija Tanis', 'khadijatanis@gmail.com', '$2y$10$uNjL0GYVm7zsXCM2KbDqGOt50dRxvvLnSLJ0e6ZBw5HFwkU/TKaHe', 'female', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `category_id`, `admin_id`, `brand`, `model`, `year`, `mileage`, `engine_capacity`, `fuel_type`, `max_power`, `max_speed`, `torque`, `fuel_consumption`, `door`, `drive_type`, `seats`, `wheel_base`, `weight`, `length`, `width`, `height`, `fuel_tank_capacity`, `color`, `no_of_cylinder`, `description`, `image`, `selling`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 3, 9, 'Toyota', 'Toyota Fielder Hybrid', '2014', '23.0 Km/L', '1,496 cc', 'Petrol-Electric', '74ps(54kW)/4800rpm', '180 km/h', '111 Nm', '33 km/L', '5', 'Front-wheel drive', '5', '2,600 mm', '1,180 kg', '4360', '1695', '1475', '36 L', 'Black', '4', 'Fresh', '82760.jpg', 0, '2021-08-30 08:51:16', '2021-08-30 08:51:16', NULL),
(11, 3, 9, 'Toyota', 'Supra SZ-R', '2020', '11.3-6.3 l/100 km', '1998 cc', 'direct petrol injection', '258 PS (254.5 bhp) (190 kW) at 5000-6500 rpm', '3.8-second 0-to-60-mph', '400 Nm / 295 ft.lb / 40.8 kgm @ 1550-4400 rpm', '16.6 – 26.8 L/100km', '2', 'rear wheel drive', '2', '2,470 mm', '1,450 kg', '4,380 mm', '1,865 mm', '1,295 mm', '30L', 'White', '4 cylinder inline', 'Fresh', '83560.jpg', 0, '2021-08-31 16:41:32', '2021-08-31 16:41:32', NULL),
(12, 3, 9, 'Toyota', 'Crown Athlete', '2021', '13.4 kmpl', '2,997 cc', 'Gasoline', '217 Bhp / 5600 rpm', '210 km/h', '294 Nm / 4000 rpm. 0-100 km/h: 8.5 secs.', '12 - 12km/L', '5', 'Front-Wheel Drive', '5', '2,920 mm', '1,730 kg', '4,910 mm', '1,800 mm', '1,455 mm', '66 L', 'White', '4', 'Fresh', '2499.jpg', 0, '2021-08-31 16:57:43', '2021-08-31 16:57:43', NULL),
(13, 3, 9, 'Toyota', 'Harrier', '2020', '17.0 kmpl', '1,998 cc', 'Octane', '167.63bhp@3750rpm', '180 km/h', '350Nm@1750-2500rpm', '6.5 L/100km', '5', '4WD', '5', '2,690 mm', '1,770 kg', '4,740 mm', '1,855 mm', '1,660 mm', '50 L', 'Black', '4 Cylinders Inline', 'Fresh', '96252.jpg', 0, '2021-08-31 17:29:26', '2021-08-31 17:29:26', NULL),
(14, 4, 10, 'Honda', 'Accord', '2020', '20km', '1498 cc', 'Premium Gasoline', '306 hp @6,900 rpm (228 kW)', '169mph', '192 lb-ft @ 1600-5000 rpm', '16.6 – 26.8 L/100km', '5', 'Front-Wheel Drive', '5', '111.4 in', '3131 lbs', '192.2 in', '73.3 in', '57.1 in', '14.8 gal', 'Red Wine', '4 cylinder inline', 'Fresh', '81985.jpg', 0, '2021-08-31 17:47:08', '2021-08-31 17:47:08', NULL),
(15, 4, 10, 'Honda', 'Civic Type R', '2019', '23.0 Km/L', '1498 cc', 'Gasoline', '1,479 hp @ 6,900 rpm (1,103 kW', '3.8-second 0-to-60-mph', '111 Nm @ 3,600-4,400rpm', '6.5 – 9.8 L/100km', '5', 'Front-Wheel Drive', '5', '2,470 mm', '1,450 kg', '4,557 mm', '1,695 mm', '1,212 mm', '16 gal', 'Rallye Red', '4 Cylinders Inline', 'Fresh', '5029.jpg', 0, '2021-08-31 17:49:56', '2021-08-31 17:49:56', NULL),
(16, 2, 10, 'Mercedes-Benz', 'G-Class', '2018', '23.0 Km/L', '2,600 cc', 'Premium', '194 hp @6,000 rpm (165 kW)', '3.8-second 0-to-60-mph', '1,180 lb·ft @ 2,000 – 6,000 rp', '16.6 – 26.8 L/100km', '5', 'AWD', '5', '2,920 mm', '1,450 kg', '4,544 mm', '1,695 mm', '1,475 mm', '20 gal', 'White', '6', 'Fresh', '33851.jpg', 0, '2021-08-31 17:54:04', '2021-08-31 17:54:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles_images`
--

CREATE TABLE `vehicles_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_admin_id_index` (`admin_id`),
  ADD KEY `checkouts_user_id_index` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solds`
--
ALTER TABLE `solds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_admin_id_index` (`admin_id`);

--
-- Indexes for table `vehicles_images`
--
ALTER TABLE `vehicles_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `solds`
--
ALTER TABLE `solds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vehicles_images`
--
ALTER TABLE `vehicles_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkouts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
