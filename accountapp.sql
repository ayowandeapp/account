-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 12:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `acc_type_id` bigint(20) DEFAULT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `acc_type_id`, `acc_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Ashir Ali Butt', '2020-09-28 01:33:55', '2020-09-28 23:47:34'),
(3, NULL, 'Usman Butt', '2020-09-28 01:38:49', '2020-09-28 23:48:43'),
(5, NULL, 'Ali Usman', '2020-09-29 00:20:37', '2020-09-29 00:20:37'),
(6, NULL, 'daniyal', '2020-11-02 18:48:36', '2020-11-02 18:48:36'),
(7, NULL, 'shoaib Zafar', '2020-11-03 15:44:33', '2020-11-03 15:44:33'),
(8, NULL, 'daniyal khan', '2020-11-10 19:12:14', '2020-11-10 19:12:14'),
(9, NULL, 'jamshed', '2020-11-10 19:15:47', '2020-11-10 19:15:47'),
(10, NULL, 'Nawaz', '2020-11-10 19:26:33', '2020-11-10 19:26:33'),
(11, NULL, 'daniyal awan', '2020-11-13 18:21:14', '2020-11-13 18:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 'Office Expensices', '2020-09-29 00:25:16', '2020-09-29 01:07:43'),
(3, 'Material', '2020-11-10 19:27:33', '2020-11-10 19:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mustaneer ALi', '2020-09-28 02:11:38', '2020-09-29 00:18:06'),
(2, 'Hamza', '2020-09-29 00:18:19', '2020-09-29 00:18:19'),
(5, 'Asif Ali', '2020-11-10 19:24:35', '2020-11-10 19:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_vouchers`
--

CREATE TABLE `journal_vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `paycat_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `account_id`, `paycat_id`, `sub_category_id`, `description`, `payment_date`, `amount`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'jamshed mama ko diya hai kharcha ka liya', '2020-11-02', '100', 'expense', '2020-11-02 18:51:51', '2020-11-02 18:51:51'),
(2, 7, 1, 2, 'Salary of the month OCT-2020', '2020-11-03', '30000', 'expense', '2020-11-03 15:47:19', '2020-11-03 15:47:19'),
(3, 7, NULL, 1, 'jlkhjukh', '2020-11-04', '100', 'dasti', '2020-11-03 15:49:55', '2020-11-03 15:49:55'),
(4, 7, NULL, 1, 'jkjkjk', '2020-11-03', '100', NULL, '2020-11-03 15:50:55', '2020-11-03 15:50:55'),
(5, 7, NULL, NULL, 'sssss', '2020-11-03', '100000', 'dasti', '2020-11-03 15:53:16', '2020-11-03 15:53:16'),
(6, 7, 1, 2, 'salary advance', '2020-11-03', '35000', 'expense', '2020-11-03 15:53:50', '2020-11-03 15:53:50'),
(7, 7, NULL, NULL, 'dasti ma diya hain wapis jo 200 liya the', '2020-11-02', '200', 'dasti', '2020-11-03 16:02:54', '2020-11-03 16:02:54'),
(8, 7, NULL, NULL, 'abi ya testing hai balance ki', '2020-11-05', '200', 'dasti', '2020-11-05 16:22:28', '2020-11-05 16:22:28'),
(9, 6, NULL, NULL, 'ya is ka balance check hai', '2020-11-05', '200', 'dasti', '2020-11-05 16:23:50', '2020-11-05 16:23:50'),
(10, 8, NULL, NULL, 'daniyal ko dasti salery karza ma wapis deya', '2020-11-10', '200000', 'dasti', '2020-11-10 19:15:10', '2020-11-10 19:15:10'),
(11, 9, 1, 2, 'office staff salery ma diya', '2020-11-10', '300000', 'expense', '2020-11-10 19:16:40', '2020-11-10 19:16:40'),
(12, 9, NULL, NULL, 'jamshed ko dasti karza diya hai', '2020-11-10', '200000', 'dasti', '2020-11-10 19:18:36', '2020-11-10 19:18:36'),
(13, 10, 3, 4, 'nawaz ko jamshed ka hatho diya hai', '2020-11-10', '100000', 'expense', '2020-11-10 19:28:39', '2020-11-10 19:28:39'),
(14, 11, NULL, NULL, 'daniyal ko dasti khata ma wapis diya hai bank transfer account number 121212', '2020-11-13', '100000', 'dasti', '2020-11-13 18:22:35', '2020-11-13 18:22:35'),
(15, 9, 1, 2, 'office sallery for staff', '2020-11-13', '300000', 'expense', '2020-11-13 18:24:37', '2020-11-13 18:24:37'),
(16, 5, NULL, NULL, 'dasti ma diya office ma bhata tha', '2020-11-13', '5000', 'dasti', '2020-11-13 19:45:19', '2020-11-13 19:45:19'),
(17, 5, 1, 1, 'kabau ka liya diya', '2020-11-13', '5000', 'expense', '2020-11-13 19:45:57', '2020-11-13 19:45:57'),
(18, 5, 1, 2, 'tafseel', '2020-11-13', '20000', 'expense', '2020-11-13 19:46:31', '2020-11-13 19:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(11) DEFAULT NULL,
  `account_id` bigint(20) DEFAULT NULL,
  `registration_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marla` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plot_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inv` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`id`, `customer_id`, `account_id`, `registration_no`, `marla`, `block`, `sector`, `plot_no`, `amount`, `inv`, `receipt_date`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 6, NULL, NULL, NULL, NULL, NULL, '200', NULL, '2020-11-02', 'daniyal sa ghr ma liya leya', '2020-11-02 18:49:36', '2020-11-02 18:49:36'),
(2, NULL, 7, NULL, NULL, NULL, NULL, NULL, '200', NULL, '2020-11-03', 'ugyjgiutgytgy', '2020-11-03 15:49:17', '2020-11-03 15:49:17'),
(3, NULL, 7, NULL, NULL, NULL, NULL, NULL, '200000', NULL, '2020-11-03', 'dsdsds', '2020-11-03 15:52:39', '2020-11-03 15:52:39'),
(4, NULL, 7, NULL, NULL, NULL, NULL, NULL, '200', NULL, '2020-11-03', 'bs diya hain na', '2020-11-03 16:00:28', '2020-11-03 16:00:28'),
(5, NULL, 8, NULL, NULL, NULL, NULL, NULL, '300000', NULL, '2020-11-10', 'daniyal sa office saleries ka liya leeya tha', '2020-11-10 19:12:48', '2020-11-10 19:12:48'),
(6, NULL, 11, NULL, NULL, NULL, NULL, NULL, '200000', NULL, '2020-11-13', 'daniyal sa dasti ma liya hai office ma', '2020-11-13 18:21:42', '2020-11-13 18:21:42'),
(7, NULL, 9, NULL, NULL, NULL, NULL, NULL, '100000', NULL, '2020-11-13', 'jamshed ko dasti ma wapis diya hia', '2020-11-13 18:25:29', '2020-11-13 18:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_cat_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_cat_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'kitchen and food', '2020-11-02 18:50:50', '2020-11-02 18:50:50'),
(2, 1, 'Salaries', '2020-11-03 15:46:19', '2020-11-03 15:46:19'),
(4, 3, 'Shingal', '2020-11-10 19:27:50', '2020-11-10 19:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Akbar Mughal', 'admin@admin.com', NULL, '$2y$12$/zFc6dp/WGPEu8c2Zgpx7Oo9THBig4z5oNv.KipQJ2m089fC1nDaG', NULL, '2020-09-02 13:44:14', '2020-11-13 18:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_transactions`
--

CREATE TABLE `voucher_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_voucher_id` int(11) NOT NULL,
  `account_id_debit` int(11) NOT NULL,
  `account_id_credit` int(11) NOT NULL,
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
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_vouchers`
--
ALTER TABLE `journal_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `voucher_transactions`
--
ALTER TABLE `voucher_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_vouchers`
--
ALTER TABLE `journal_vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher_transactions`
--
ALTER TABLE `voucher_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
