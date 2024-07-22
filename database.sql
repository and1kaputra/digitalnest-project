-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 01:39 PM
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
-- Database: `digitalnestest`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ebook', 'ebook', 'images/ic_ebook.svg', NULL, '2024-07-09 02:05:20', '2024-07-09 02:05:20'),
(2, 'Course', 'course', 'images/ic_course.svg', NULL, '2024-07-09 02:05:20', '2024-07-09 02:05:20'),
(3, 'Template', 'template', 'images/ic_template.svg', NULL, '2024-07-09 02:05:20', '2024-07-09 02:05:20'),
(4, '3D Design', '3d-design', 'images/ic_font.svg', NULL, '2024-07-09 02:05:20', '2024-07-15 02:04:58');

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
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(21, '2024_04_09_090035_create_tools_table', 1),
(22, '2024_05_09_151246_create_categories_table', 1),
(23, '2024_05_09_160146_create_products_table', 1),
(24, '2024_05_09_163631_create_product_orders_table', 1),
(25, '2024_05_22_091942_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ikadekandikadwiputrak@gmail.com', '$2y$10$miwpIFyY6PDC0hTWdK87zuKMHX65GTYk5DuSP3T3O/I7QSxu06T9C', '2024-07-17 23:20:58');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `about` varchar(500) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `tool_id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `cover`, `price`, `about`, `path_file`, `category_id`, `tool_id`, `creator_id`, `deleted_at`, `created_at`, `updated_at`, `type`) VALUES
(1, 'SAAS Website', 'saas-website', 'product_covers/QRxdVwn7XKp4cghU39kdP1iykNvgQi8itbstLlJy.png', 1485000, 'High Quality', 'product_files/L1g4068jcgXpgGFBH53xquV1UqO6vTdfDHZkNWwG.zip', 3, 2, 2, NULL, '2024-07-09 02:38:55', '2024-07-19 04:03:43', '.Zip'),
(2, 'Real Estate App Mobile Kit', 'real-estate-app-mobile-kit', 'product_covers/PvFHe80YAdxEzP5FOnZIi5gn2Mg59t29oGFajpVc.png', 3750000, 'High Quality', 'product_files/5OXwLcSu0FcLXeBcwXAOUWVryh7jnyRNwfRC2Dtv.zip', 3, 9, 2, NULL, '2024-07-15 01:21:44', '2024-07-15 01:21:44', '.Fig'),
(3, 'AI Telehealth & Telemedicene Website', 'ai-telehealth-telemedicene-website', 'product_covers/8RuYTjeudoEYakQ1OajbIlUaSvVTkya77uhKLK5n.png', 15875000, 'High Quality design', 'product_files/aSWxlojt7QyhSygHpmmvXB7LnrSdlhonWRJZx2oE.zip', 3, 9, 2, '2024-07-15 01:28:45', '2024-07-15 01:28:36', '2024-07-15 01:28:45', '.Zip'),
(4, 'AI Telehealth & Telemedicene Website', 'ai-telehealth-telemedicene-website', 'product_covers/IqILrXJJe38sbr5pp2IVw6Vc75OreZQzKAatK0zf.png', 10760000, 'High Quality Design', 'product_files/CGAB6QbjRp4gYABdPX1rF8lXAimqfzzonQpJN9Gd.zip', 3, 9, 2, NULL, '2024-07-15 01:29:38', '2024-07-15 01:29:38', '.Fig'),
(5, 'Task Management UI', 'task-management-ui', 'product_covers/d8I0BTDpPJJ7XeIVjXS5FhUYkQLMyaCiegXZ3GTM.png', 1758000, 'High Quality design', 'product_files/HzYoTgbSvs76ylshuktLr7DVLllgELcgiqLvs5Kx.zip', 3, 9, 2, NULL, '2024-07-15 01:55:22', '2024-07-15 01:55:22', '.Zip'),
(6, 'Bento 3D Design', 'bento-3d-design', 'product_covers/OvxOyUdoX5fD27IjwltN5s6y9UOYvy8guCYNwR7j.png', 550000, 'High Quality icons', 'product_files/kputzf5dDaAfYqjlKxsA3wO3OBhKqwVvzpoTgfPQ.zip', 4, 2, 2, NULL, '2024-07-15 02:08:11', '2024-07-15 02:08:11', '.Fig'),
(7, 'Keap Cookbook', 'keap-cookbook', 'product_covers/023wLboSn8je35sDi05LyvmeFNWD4DZ1Mb8N8JCT.jpg', 350000, 'Say goodbye to feeling overwhelmed by Keap Pro/Max! This guide is your ultimate companion, taking you from the initial setup to daily usage and routine maintenance, showing you how to leverage the system’s features for business success.', 'product_files/Na6xyefTsfeUEd2SgCN2OOm4cSj8CrPWV6rKzjlk.zip', 1, 3, 2, NULL, '2024-07-15 02:21:16', '2024-07-15 02:21:16', '.PDF'),
(8, 'Google Machine Learning and Generative AI for Solutions Architects', 'google-machine-learning-and-generative-ai-for-solutions-architects', 'product_covers/YobAb8QOeW1jSCgP9By8l7eltdpiTCtdIpVVhZ6p.png', 750000, 'This book shows you exactly how to design and run AI/ML workloads successfully using years of experience some of the world’s leading tech companies have to offer.', 'product_files/bxJC4gL6GRomSziwR01cUKSmT0WwcG6hZSw4Fqrl.pdf', 1, 2, 2, NULL, '2024-07-15 02:36:02', '2024-07-15 02:36:02', '.PDF'),
(9, 'Building Modern SaaS Applications with C# and .NET By Andy Watt', 'building-modern-saas-applications-with-c-and-net-by-andy-watt', 'product_covers/MgRvHrcPcxHZEet3uvWhRQr0himqJ8lCioZKh1rf.png', 650000, 'This book is perfect for developers and teams with experience in traditional application development looking to switch to SaaS and deliver slick and modern applications. You‘ll start with a general overview of SaaS as a concept and learn with the help of an example throughout the book to bring life to the technical descriptions.', 'product_files/2DyjcRb8Fzo5THOyrx5Ckb9R2PjPL7lF6sHzCjEg.pdf', 1, 5, 2, NULL, '2024-07-15 02:44:59', '2024-07-15 07:50:59', '.PDF'),
(10, 'testststs', 'testststs', 'product_covers/odcG9bsj0ZYsIh6rlPPzsMjSSzPnn5flulSXjidJ.png', 34134134, 'dadsa', 'product_files/GM6s71ML8RsvrL6ZOtWDmT85RuD8EGVlJAVjKm3x.zip', 1, 2, 3, '2024-07-21 07:25:31', '2024-07-19 05:47:51', '2024-07-21 07:25:31', '.Zip');

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` bigint(20) UNSIGNED NOT NULL,
  `is_paid` varchar(255) NOT NULL DEFAULT 'pending',
  `proof` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_orders`
--

INSERT INTO `product_orders` (`id`, `creator_id`, `product_id`, `buyer_id`, `total_price`, `is_paid`, `proof`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 1485000, 'declined', 'payment_proofs/fhTZS7BAeGPjMgrzvRyH0cAFzkQo5SWYD04R6FlU.jpg', NULL, '2024-07-14 04:50:13', '2024-07-15 01:40:38'),
(2, 2, 4, 3, 10760000, 'success', 'payment_proofs/6qlvlp7MKVSdRjpnfmMUw3yJ0W3s2hUdS8WNalZR.jpg', NULL, '2024-07-15 01:31:17', '2024-07-15 01:40:31'),
(3, 2, 6, 3, 550000, 'pending', 'payment_proofs/sRiXzexw5QyyvmZ2rF0bUBY28DRr5QSPQomMg6rI.jpg', NULL, '2024-07-15 02:08:59', '2024-07-15 02:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_tools`
--

CREATE TABLE `product_tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tool_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tools`
--

INSERT INTO `product_tools` (`id`, `product_id`, `tool_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-07-14 07:40:56', '2024-07-14 07:32:48', '2024-07-14 07:40:56'),
(2, 1, 2, '2024-07-14 07:41:03', '2024-07-14 07:41:01', '2024-07-14 07:41:03'),
(3, 1, 2, NULL, '2024-07-14 07:42:31', '2024-07-14 07:42:31'),
(4, 1, 3, NULL, '2024-07-14 07:47:00', '2024-07-14 07:47:00'),
(5, 1, 4, NULL, '2024-07-14 07:47:04', '2024-07-14 07:47:04'),
(6, 1, 5, NULL, '2024-07-14 07:47:08', '2024-07-14 07:47:08'),
(7, 1, 10, NULL, '2024-07-14 08:17:25', '2024-07-14 08:17:25'),
(8, 1, 6, NULL, '2024-07-14 08:17:50', '2024-07-14 08:17:50'),
(9, 1, 7, NULL, '2024-07-15 01:08:03', '2024-07-15 01:08:03'),
(10, 6, 9, NULL, '2024-07-15 02:08:20', '2024-07-15 02:08:20'),
(11, 9, 9, NULL, '2024-07-15 07:51:18', '2024-07-15 07:51:18'),
(12, 1, 9, NULL, '2024-07-19 04:03:23', '2024-07-19 04:03:23'),
(13, 10, 2, NULL, '2024-07-19 05:48:08', '2024-07-19 05:48:08'),
(14, 10, 3, NULL, '2024-07-19 05:48:12', '2024-07-19 05:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `reviewer_id` bigint(20) UNSIGNED NOT NULL,
  `stars` bigint(20) UNSIGNED NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `reviewer_id`, `stars`, `review`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 3, 5, 'Really Nice Product!', '2024-07-15 01:41:17', '2024-07-15 01:41:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `name`, `slug`, `icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Flutter', 'flutter', 'tools/pKC59f7LItDJmKAN2A3Qv8sxkiSsXrNFUBDOWMVp.svg', NULL, '2024-07-09 02:34:06', '2024-07-09 02:34:06'),
(3, 'Kotlin', 'kotlin', 'tools/1TseC1pzROC3smOqIF5fSBgdHewctg36iXnaUtIR.svg', NULL, '2024-07-14 07:46:02', '2024-07-14 07:46:02'),
(4, 'blender', 'blender', 'tools/9Zc9JJYbxJ4GvfMPXc85LIOLdASLqTnrKQdFplRb.svg', NULL, '2024-07-14 07:46:13', '2024-07-14 07:46:13'),
(5, 'React Js', 'react-js', 'tools/B4aWT3VgDDuhIfdqpCTzoXXDox5LpWNyHhvrUN0H.svg', NULL, '2024-07-14 07:46:25', '2024-07-14 07:46:25'),
(6, 'Laravel', 'laravel', 'tools/JxzZBTpe2rbl9Ew7fOYf0zymxk3HMFyFIWPAdly2.svg', NULL, '2024-07-14 08:14:51', '2024-07-14 08:14:51'),
(7, 'Vue Js', 'vue-js', 'tools/uT5enSpGxGZPamBhmkVIdbSB5XWBxfLPjEsLaxHJ.svg', NULL, '2024-07-14 08:15:04', '2024-07-14 08:15:04'),
(9, 'Figma', 'figma', 'tools/6UH4TOhuetKGq563kCEqB2tCdL3BoJnZrvo1KOHn.svg', NULL, '2024-07-14 08:15:34', '2024-07-14 08:15:34'),
(10, 'Golang', 'golang', 'tools/4E0sKmb5zu44Ox96OqatB77wymvgqcNqe0dBixTL.svg', NULL, '2024-07-14 08:15:48', '2024-07-14 08:15:48'),
(11, 'Python', 'python', 'tools/UtBlWyhuLECCgRwfVjk40zmQHMLBQ95zf2Ln8tp7.svg', NULL, '2024-07-14 08:16:49', '2024-07-14 08:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `bank_account_number` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `suspanded` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `occupation`, `bank_account`, `bank_name`, `role`, `bank_account_number`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `description`, `suspanded`) VALUES
(1, 'superadmin', 'avatars/WzQGzPiWwqnvh3gxbQUjnEd3qq39W9MRUHPjZ99q.png', 'admin', 'admin', 'BCA', 'admin', 121323214, 'superadmin@gmail.com', NULL, '$2y$10$M.lVa8iYq/mhPOrWMksIu.dRDMFaeVe1HB6DQGDS3mOHPgZQG99rC', NULL, '2024-07-09 02:14:03', '2024-07-21 07:47:00', NULL, 0),
(2, 'I Kadek Andika Dwi Putra', 'avatars/6R3KwZRvgAku4Yz3JPfXajElyPyuWwVNVdMfiFwr.png', 'Full Stack Developer', 'I Kadek Andika Dwi Putra', 'BCA', 'user', 11234352, 'ikadekandikadwiputrad@gmail.com', NULL, '$2y$10$d9wdZrphpbwyWxJEldtEl.UmB9y68NbXrJY2kYv9kjZfwhn9FhzQW', NULL, '2024-07-09 02:36:53', '2024-07-22 00:22:12', 'Competent Full Stack Developer', 0),
(3, 'Andika Juliantara', 'avatars/TfnJuh0EY8tkXDjiOixouq0IKGogeDhPjmEzejVq.jpg', 'Manager', 'I KADEK ANDIKA DWI PUTRA', 'BCA', 'user', 22328431, 'ikadekandikadwiputrak@gmail.com', NULL, '$2y$10$Ijhg/hppD0rep3n.aUJVnuj5HOiJV3USyM4xMipmygyls70ni6YZe', NULL, '2024-07-09 02:42:27', '2024-07-19 07:41:22', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_tool_id_foreign` (`tool_id`),
  ADD KEY `products_creator_id_foreign` (`creator_id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_orders_product_id_foreign` (`product_id`),
  ADD KEY `product_orders_creator_id_foreign` (`creator_id`),
  ADD KEY `product_orders_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `product_tools`
--
ALTER TABLE `product_tools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_tools_product_id_foreign` (`product_id`),
  ADD KEY `project_tools_tool_id_foreign` (`tool_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_tools`
--
ALTER TABLE `product_tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD CONSTRAINT `product_orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_orders_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tools`
--
ALTER TABLE `product_tools`
  ADD CONSTRAINT `project_tools_project_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_tools_tool_id_foreign` FOREIGN KEY (`tool_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
