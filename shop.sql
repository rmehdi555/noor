-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 01:42 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_codes`
--

CREATE TABLE `activation_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activation_codes`
--

INSERT INTO `activation_codes` (`id`, `user_id`, `code`, `used`, `expire`, `created_at`, `updated_at`, `deleted_at`) VALUES
(68, 39, '17748', 0, '2020-11-15 06:40:31', '2020-11-15 08:25:31', '2020-11-15 08:25:31', NULL),
(69, 39, '53089', 1, '2020-11-15 11:56:53', '2020-11-15 08:26:39', '2020-11-15 08:26:53', NULL),
(70, 40, 'val1EHxfZw6235xLgEWrKjcSWdI6oqdaz55Ct3EQ1WVXNKOEFWhHNe2BDnwC', 0, '2020-11-28 22:05:19', '2020-11-28 21:50:19', '2020-11-28 21:50:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `family`, `email`, `phone`, `body`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'تست 1', 'رضایی', 's@m.com', '09185507245', 'fggg', 0, '2020-11-11 04:08:03', '2020-11-11 04:08:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `family`, `email`, `phone`, `body`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'تست 1', 'رضایی', 's@m.com', '09185507245', 'لات', 0, '2020-11-10 09:39:23', '2020-11-10 09:39:23', NULL),
(2, 'sf', 'fdg', 'abas.alishirvani@yahoo.com', '09185507245', 'dfsgsdf', 0, '2020-11-10 10:18:52', '2020-11-10 10:18:52', NULL),
(3, 'fgh', 'fgh', 'eli5555555eli@gmail.com', '09185507245', 'fgh', 0, '2020-11-10 10:24:16', '2020-11-10 10:24:16', NULL),
(4, 'تست 1', 'رضایی', 'eli5555555eli@gmail.com', '09185507245', 'fdgh', 0, '2020-11-10 10:25:05', '2020-11-10 10:25:05', NULL),
(5, 'تست', 'تست', 'rezaie.mehdi555@gmail.com', '09185597245', 'تست', 0, '2020-12-01 08:57:50', '2020-12-01 08:57:50', NULL),
(6, 'تست', 'تست', 'rezaie.mehdi555@gmail.com', '09185557245', 'sdfsdaf', 0, '2020-12-01 09:10:09', '2020-12-01 09:10:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency_converts`
--

CREATE TABLE `currency_converts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `exFrom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'IRR',
  `exTo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'EUR',
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_converts`
--

INSERT INTO `currency_converts` (`id`, `user_id`, `exFrom`, `exTo`, `rate`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'IRR', 'IRR', '1', 1, '2020-04-21 19:30:00', NULL, NULL),
(2, 1, 'IRR', 'EUR', '0.00000289855', 1, NULL, NULL, NULL),
(3, 1, 'EUR', 'IRR', '345000', 0, NULL, NULL, NULL),
(4, 1, 'USD', 'IRR', '291000', 0, NULL, NULL, NULL),
(5, 1, 'IRR', 'USD', '0.00000343642', 1, NULL, NULL, NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_categories_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `user_id`, `menu_categories_id`, `parent_id`, `link`, `icon`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'صفحه اصلی', 'صفحه-اصلی', 5, 1, 0, '/', 'i', 1, 1, '2020-11-10 05:43:58', '2020-11-10 05:43:58', NULL),
(2, 'سخنی با ما', 'سخنی-با-ما', 5, 1, 0, '/contact-us', 'i', 6, 1, '2020-11-10 05:44:49', '2020-12-01 03:53:28', NULL),
(3, 'دسته اصلی 1', 'دسته-اصلی-1', 5, 1, 0, 'https://www.maj.ir/', 'i', 3, 1, '2020-11-10 05:45:32', '2020-12-01 03:53:34', '2020-12-01 03:53:34'),
(4, 'دسته فرعی 1-1', 'دسته-فرعی-1-1', 5, 1, 3, '#', 'i', 1, 1, '2020-11-10 05:45:59', '2020-12-01 03:53:37', '2020-12-01 03:53:37'),
(5, 'دسته فرعی 2-1', 'دسته-فرعی-2-1', 5, 1, 3, 'http://isti.ir/', 'i', 2, 1, '2020-11-10 05:46:20', '2020-12-01 03:53:39', '2020-12-01 03:53:39'),
(6, 'سایت آهن آنلاین', 'سایت-آهن-آنلاین', 5, 2, 0, 'https://ahanonline.com/', 'i', 1, 1, '2020-11-10 08:23:46', '2020-12-01 03:53:43', '2020-12-01 03:53:43'),
(7, 'ورود به حساب کاربری', 'ورود-به-حساب-کاربری', 5, 3, 0, 'http://www.assen.ir/login', 'i', 1, 1, '2020-11-10 08:25:27', '2020-12-01 03:53:45', '2020-12-01 03:53:45'),
(8, 'آشنایی با ما', 'آشنایی-با-ما', 40, 1, 0, '/show/page/2', 'i', 5, 1, '2020-12-01 03:56:56', '2020-12-01 04:20:55', NULL),
(9, 'ارتباط با ما', 'ارتباط-با-ما', 40, 1, 0, '/show/page/3', 'i', 4, 1, '2020-12-01 04:24:27', '2020-12-01 04:24:27', NULL),
(10, 'دفتر نهاد رهبری', 'دفتر-نهاد-رهبری', 40, 2, 0, 'http://www.nahad.ir/', 'i', 1, 1, '2020-12-01 04:34:07', '2020-12-01 04:34:07', NULL),
(11, 'پارس قرآن : جستجوي قرآن', 'پارس-قرآن-جستجوي-قرآن', 40, 2, 0, 'http://www.parsquran.com/', 'i', 2, 1, '2020-12-01 04:35:51', '2020-12-01 04:35:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`id`, `title`, `slug`, `user_id`, `description`, `icon`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'منو اصلی هدر سایت', 'منو-اصلی-هدر-سایت', 5, 'منو اصلی هدر سایت', 'i', 1, 1, '2020-11-10 05:43:37', '2020-11-10 05:43:37', NULL),
(2, 'فوتر سایت - پیوندها', 'فوتر-سایت-پیوندها', 5, 'فوتر سایت - پیوندها', 'i', 1, 1, '2020-11-10 08:22:08', '2020-11-10 08:22:08', NULL),
(3, 'فوتر سایت - خدمات مشتریان', 'فوتر-سایت-خدمات-مشتریان', 5, 'فوتر سایت - خدمات مشتریان', 'i', 1, 1, '2020-11-10 08:22:30', '2020-11-10 08:22:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_04_09_134204_create_product_categories_table', 1),
(4, '2020_04_09_134236_create_products_table', 1),
(5, '2020_04_09_134307_create_product_images_table', 1),
(6, '2020_04_09_134439_create_site_details_table', 1),
(8, '2020_04_09_163121_create_sliders_table', 1),
(9, '2020_04_22_095407_create_currency_converts_table', 2),
(10, '2014_10_12_100000_create_password_resets_table', 3),
(11, '2020_10_04_082501_create_activation_codes_table', 4),
(17, '2020_04_09_141145_create_menu_categories_table', 5),
(18, '2020_04_09_141147_create_menus_table', 5),
(19, '2020_10_28_083606_create_web_pages_table', 5),
(20, '2020_11_10_122006_create_contact_us_table', 6),
(22, '2020_11_11_070609_create_complaints_table', 7),
(23, '2020_11_29_090440_create_news_categories_table', 8),
(24, '2020_11_29_090455_create_news_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `news_categories_id` bigint(20) UNSIGNED NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `user_id`, `news_categories_id`, `slug`, `description`, `body`, `type`, `images`, `tags`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'رونمایی از سایت جامع قرآنکده نور موعود (عج)', 40, 3, 'رونمایی-از-سایت-جامع-قرآنکده-نور-موعود-عج', 'رونمایی از سایت جامع قرآنکده نور موعود (عج)', '<p>به زودی سایت جامع قرآنکده نور موعود (عج) رونمایی و برای عموم قابل استفاده خواهد شد .</p>', 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/12\\/news\\/5fc5f9ee6d45a.png\",\"50\":\"\\/upload\\/images\\/2020\\/12\\/news\\/50_5fc5f9ee6d45a.png\",\"66\":\"\\/upload\\/images\\/2020\\/12\\/news\\/66_5fc5f9ee6d45a.png\",\"200\":\"\\/upload\\/images\\/2020\\/12\\/news\\/200_5fc5f9ee6d45a.png\",\"350\":\"\\/upload\\/images\\/2020\\/12\\/news\\/350_5fc5f9ee6d45a.png\",\"500\":\"\\/upload\\/images\\/2020\\/12\\/news\\/500_5fc5f9ee6d45a.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/12\\/news\\/50_5fc5f9ee6d45a.png\"}', 'تگ خبری', 16, 1, '2020-11-29 17:49:54', '2020-12-01 04:38:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_categories`
--

CREATE TABLE `news_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_categories`
--

INSERT INTO `news_categories` (`id`, `title`, `slug`, `user_id`, `description`, `body`, `parent_id`, `images`, `tags`, `icon`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'خبر1 1', 'خبر1-1', 40, 'خلاصه خبر 1', '<p>متن خبر 11</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost/userfiles/files/591f796e.jpg\" style=\"height:200px; width:100px\" /></p>', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/5fc36c279991e.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/300_5fc36c279991e.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/600_5fc36c279991e.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/900_5fc36c279991e.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/300_5fc36c279991e.jpg\"}', 'تگ', 'i', 3, 1, '2020-11-29 17:38:29', '2020-12-01 04:36:21', '2020-12-01 04:36:21'),
(2, 'دسته خبر 1-1', 'دسته-خبر-1-1', 40, 'خلاصه دسته', '<p>متن دسته</p>', 1, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/5fc36cc7f0b10.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/300_5fc36cc7f0b10.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/600_5fc36cc7f0b10.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/900_5fc36cc7f0b10.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/11\\/newsCategories\\/300_5fc36cc7f0b10.jpg\"}', 'هزرزرطظریظطبر', 'i', 1, 1, '2020-11-29 17:41:28', '2020-12-01 04:36:19', '2020-12-01 04:36:19'),
(3, 'خبرهای عمومی', 'خبرهای-عمومی', 40, 'خبرهای عمومی', '<p>خبرهای عمومی</p>', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/12\\/newsCategories\\/5fc5f99fd1b24.png\",\"300\":\"\\/upload\\/images\\/2020\\/12\\/newsCategories\\/300_5fc5f99fd1b24.png\",\"600\":\"\\/upload\\/images\\/2020\\/12\\/newsCategories\\/600_5fc5f99fd1b24.png\",\"900\":\"\\/upload\\/images\\/2020\\/12\\/newsCategories\\/900_5fc5f99fd1b24.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/12\\/newsCategories\\/300_5fc5f99fd1b24.png\"}', 'i', 'i', 1, 1, '2020-12-01 04:36:56', '2020-12-01 04:36:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('eli5555555eli@gmail.com', '$2y$10$O3xyJAEojzHxpz9AJi/GLuHIGIYUfh.JeNBUdbT7pwczy.q.wDfea', '2020-09-27 09:43:14'),
('rezaie.mehdi555@gmail.com', '$2y$10$BA7uaNABjDTlyCWGer3QZ.iQjPd05Ap0gQMBPr8GJFIYX/giX3Wyy', '2020-11-11 07:42:37'),
('abas.ali999irvani@yahoo.com', '$2y$10$qNCcuRTvARcohKEf79XseOt7ie.cMaokQfwJTZ9Vqot9L2YDE7rsq', '2020-11-11 08:51:28'),
('admin@admin.com', '$2y$10$wALh6JiftUyLV7XYnKj3ne2.6nfkuXyG4JhkOTyayD9gDX6KOYufy', '2020-11-15 02:57:40'),
('09185507245', '47518', '2020-11-16 03:20:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_categories_id` int(11) NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double NOT NULL DEFAULT 0,
  `type` varchar(50) NOT NULL DEFAULT 'normal',
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `user_id`, `product_categories_id`, `slug`, `description`, `body`, `price`, `discount`, `type`, `images`, `tags`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(18, 'fa==سینک عنوان@@en==sinc title', 1, 10, 'fa-سینک-عنوان-en-sinc-title', 'fa==سینک خلاصه@@en==sinc de', 'fa==سینک متن@@en==sinc body', '12000000', 12, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/5\\/products\\/5eac4847984e6.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4847984e6.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/5\\/products\\/66_5eac4847984e6.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/5\\/products\\/200_5eac4847984e6.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/5\\/products\\/350_5eac4847984e6.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/5\\/products\\/500_5eac4847984e6.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4847984e6.jpg\"}', 'ss', 1, 0, '2020-05-01 05:47:02', '2020-10-25 06:00:35', NULL),
(19, 'fa==سینک ویژه@@en==s vip', 1, 10, 'fa-سینک-ویژه-en-s-vip', 'fa==سینک ویژه خ@@en==svip d', 'fa==سینک ویژه متن@@en==s vip en', '1230000', 20, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/5\\/products\\/5eac483ee79c3.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac483ee79c3.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/5\\/products\\/66_5eac483ee79c3.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/5\\/products\\/200_5eac483ee79c3.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/5\\/products\\/350_5eac483ee79c3.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/5\\/products\\/500_5eac483ee79c3.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac483ee79c3.jpg\"}', 't', 2, 0, '2020-05-01 05:48:30', '2020-10-25 06:00:45', NULL),
(20, 'fa==سینک رو کار@@en==s r t', 1, 11, 'fa-سینک-رو-کار-en-s-r-t', 'fa==سینک رو کار خلاصه@@en==srd', 'fa==سینک رو کار متن@@en==s r b', '20000000', 0, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/5\\/products\\/5eac4854258ec.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4854258ec.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/5\\/products\\/66_5eac4854258ec.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/5\\/products\\/200_5eac4854258ec.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/5\\/products\\/350_5eac4854258ec.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/5\\/products\\/500_5eac4854258ec.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4854258ec.jpg\"}', 'jj', 5, 0, '2020-05-01 05:50:28', '2020-10-25 06:00:54', NULL),
(21, 'fa==سینک تو کار@@en==s t t', 1, 12, 'fa-سینک-تو-کار-en-s-t-t', 'fa==سینک تو کار خلاصه@@en==std', 'fa==سینک تو کار بدنه@@en==stb', '30000000', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/5\\/products\\/5eac4831ee4f1.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4831ee4f1.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/5\\/products\\/66_5eac4831ee4f1.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/5\\/products\\/200_5eac4831ee4f1.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/5\\/products\\/350_5eac4831ee4f1.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/5\\/products\\/500_5eac4831ee4f1.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/5\\/products\\/50_5eac4831ee4f1.jpg\"}', 'ا', 8, 0, '2020-05-01 05:51:48', '2020-10-25 06:01:04', NULL),
(22, 'fa==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه', 1, 20, 'fa-میلگرد-آجدار-10-میانه-شاخه-A3-کارخانه-en-میلگرد-آجدار-10-میانه-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه', 'fa==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه\r\n\r\nسایز : 10\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم@@en==میلگرد آجدار 10 میانه  شاخه   A3 کارخانه\r\n\r\nسایز : 10\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم', '134200', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f95438dd42e6.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f95438dd42e6.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f95438dd42e6.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f95438dd42e6.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f95438dd42e6.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f95438dd42e6.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f95438dd42e6.jpg\"}', 'میلگرد آجدار 10 میانه  شاخه   A3 کارخانه', 1, 1, '2020-10-25 05:51:18', '2020-10-25 05:51:18', NULL),
(23, 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه', 1, 20, 'fa-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-میانه-en-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-میانه', 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه', 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه\r\n\r\nسایز : 12\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری میانه\r\n\r\nسایز : 12\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم', '133200', 0, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f954488c7f32.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f954488c7f32.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f954488c7f32.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f954488c7f32.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f954488c7f32.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f954488c7f32.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f954488c7f32.jpg\"}', '133,200', 2, 1, '2020-10-25 05:55:29', '2020-10-25 05:55:29', NULL),
(24, 'fa==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه', 5, 20, 'fa-میلگرد-آجدار-14-میانه-شاخه-A3-کارخانه-en-میلگرد-آجدار-14-میانه-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه', 'fa==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه\r\n\r\nسایز : 14\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم@@en==میلگرد آجدار 14 میانه  شاخه   A3 کارخانه\r\n\r\nسایز : 14\r\nحالت شاخه : 12 متری\r\nاستاندارد : A3\r\nبرند : میانه\r\nواحد : کیلوگرم', '125900', 0, 'offer', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f9545a28b2de.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9545a28b2de.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f9545a28b2de.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f9545a28b2de.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f9545a28b2de.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f9545a28b2de.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9545a28b2de.jpg\"}', '125,900', 1, 1, '2020-10-25 06:00:10', '2020-10-25 06:00:10', NULL),
(25, 'fa==میلگرد آجدار 18 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 18 میانه  شاخه   A3 کارخانه', 5, 20, 'fa-میلگرد-آجدار-18-میانه-شاخه-A3-کارخانه-en-میلگرد-آجدار-18-میانه-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 18 میانه  شاخه   A3 کارخانه@@en==میلگرد آجدار 18 میانه  شاخه   A3 کارخانه', 'fa==<p>میلگرد آجدار 18 میانه &nbsp;شاخه &nbsp; A3 کارخانه</p>\r\n\r\n<p>سایز : 18</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : میانه</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<p>میلگرد آجدار 18 میانه &nbsp;شاخه &nbsp; A3 کارخانه</p>\r\n\r\n<p>سایز : 18</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : میانه</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '125900', 0, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f956d1fe826f.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f956d1fe826f.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f956d1fe826f.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f956d1fe826f.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f956d1fe826f.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f956d1fe826f.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f956d1fe826f.jpg\"}', 'میلگرد آجدار 18 میانه  شاخه   A3 کارخانه', 2, 1, '2020-10-25 08:48:40', '2020-10-25 08:48:40', NULL),
(26, 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری ذوب آهن@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری ذوب آهن', 5, 21, 'fa-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-ذوب-آهن-en-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-ذوب-آهن', 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری ذوب آهن@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری ذوب آهن', 'fa==<h1>12میلگرد آجدار کارخانهA3شاخه 12 متری&nbsp;ذوب آهن</h1>\r\n\r\n<p>سایز&nbsp;: 12&nbsp; &nbsp;</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>12میلگرد آجدار کارخانهA3شاخه 12 متری&nbsp;ذوب آهن</h1>\r\n\r\n<p>سایز&nbsp;: 12&nbsp; &nbsp;</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '128500', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f957f1eb5d64.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f957f1eb5d64.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f957f1eb5d64.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f957f1eb5d64.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f957f1eb5d64.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f957f1eb5d64.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f957f1eb5d64.jpg\"}', '12میلگرد آجدار کارخانهA3شاخه 12 متری ذوب آهن', 2, 1, '2020-10-25 10:05:27', '2020-10-25 10:05:27', NULL),
(27, 'fa==میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه@@en==میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه', 5, 21, 'fa-میلگرد-آجدار-22-ذوب-آهن-شاخه-A3-کارخانه-en-میلگرد-آجدار-22-ذوب-آهن-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه@@en==میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه', 'fa==<h1>میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز : 22&nbsp;</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز : 22&nbsp;</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '128500', 0, 'offer', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f957f932e591.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f957f932e591.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f957f932e591.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f957f932e591.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f957f932e591.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f957f932e591.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f957f932e591.jpg\"}', 'میلگرد آجدار 22 ذوب آهن شاخه A3 کارخانه', 1, 1, '2020-10-25 10:07:23', '2020-10-25 10:10:55', NULL),
(28, 'fa==میلگرد آجدار 32 ذوب آهن  شاخه   A3 کارخانه@@en==میلگرد آجدار 32 ذوب آهن  شاخه   A3 کارخانه', 5, 21, 'fa-میلگرد-آجدار-32-ذوب-آهن-شاخه-A3-کارخانه-en-میلگرد-آجدار-32-ذوب-آهن-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 32 ذوب آهن  شاخه   A3 کارخانه@@en==میلگرد آجدار 32 ذوب آهن  شاخه   A3 کارخانه', 'fa==<h1>میلگرد آجدار&nbsp;32&nbsp;ذوب آهن&nbsp;&nbsp;شاخه&nbsp;&nbsp;&nbsp;A3&nbsp;کارخانه</h1>\r\n\r\n<p>سایز : 32</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند&nbsp;: ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار&nbsp;32&nbsp;ذوب آهن&nbsp;&nbsp;شاخه&nbsp;&nbsp;&nbsp;A3&nbsp;کارخانه</h1>\r\n\r\n<p>سایز : 32</p>\r\n\r\n<p>حالت شاخه : 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند&nbsp;: ذوب آهن اصفهان</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '128500', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f958034dc419.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f958034dc419.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f958034dc419.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f958034dc419.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f958034dc419.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f958034dc419.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f958034dc419.jpg\"}', 'میلگرد آجدار 32 ذوب آهن  شاخه   A3 کارخانه', 2, 1, '2020-10-25 10:10:05', '2020-10-25 10:10:05', NULL),
(29, 'fa==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب@@en==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 5, 22, 'fa-8میلگرد-آجدار-کارخانهA2شاخه-12-متری-ظفر-بناب-en-8میلگرد-آجدار-کارخانهA2شاخه-12-متری-ظفر-بناب', 'fa==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب@@en==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 'fa==<h1>8میلگرد آجدار کارخانهA2شاخه 12 متری&nbsp;ظفر بناب</h1>\r\n\r\n<p>سایز: 8</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A2</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>8میلگرد آجدار کارخانهA2شاخه 12 متری&nbsp;ظفر بناب</h1>\r\n\r\n<p>سایز: 8</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A2</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '141000', 0, 'offer', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f96744fd6cd0.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96744fd6cd0.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f96744fd6cd0.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f96744fd6cd0.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f96744fd6cd0.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f96744fd6cd0.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96744fd6cd0.jpg\"}', '8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 1, 1, '2020-10-26 03:31:38', '2020-10-26 03:31:38', NULL),
(30, 'fa==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب@@en==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 5, 22, 'fa-8میلگرد-آجدار-کارخانهA2شاخه-12-متری-ظفر-بناب-en-8میلگرد-آجدار-کارخانهA2شاخه-12-متری-ظفر-بناب-1', 'fa==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب@@en==8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 'fa==<h1>8میلگرد آجدار کارخانهA2شاخه 12 متری&nbsp;ظفر بناب</h1>\r\n\r\n<p>سایز: 8</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A2</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>8میلگرد آجدار کارخانهA2شاخه 12 متری&nbsp;ظفر بناب</h1>\r\n\r\n<p>سایز: 8</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A2</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '141000', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f96840d40129.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96840d40129.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f96840d40129.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f96840d40129.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f96840d40129.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f96840d40129.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96840d40129.jpg\"}', '8میلگرد آجدار کارخانهA2شاخه 12 متری ظفر بناب', 0, 1, '2020-10-26 04:38:47', '2020-10-26 04:38:47', NULL),
(31, 'fa==میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه@@en==میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه', 5, 22, 'fa-میلگرد-آجدار-28-ظفر-بناب-شاخه-A3-کارخانه-en-میلگرد-آجدار-28-ظفر-بناب-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه@@en==میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه', 'fa==<h1>میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز: 28</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز: 28</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '138000', 0, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f968473801ee.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f968473801ee.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f968473801ee.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f968473801ee.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f968473801ee.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f968473801ee.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f968473801ee.jpg\"}', 'میلگرد آجدار 28 ظفر بناب شاخه A3 کارخانه', 1, 1, '2020-10-26 04:40:27', '2020-10-26 04:40:27', NULL),
(32, 'fa==میلگرد آجدار 25  ظفر بناب  شاخه 12 متری  A3  کارخانه@@en==میلگرد آجدار 25  ظفر بناب  شاخه 12 متری  A3  کارخانه', 5, 22, 'fa-میلگرد-آجدار-25-ظفر-بناب-شاخه-12-متری-A3-کارخانه-en-میلگرد-آجدار-25-ظفر-بناب-شاخه-12-متری-A3-کارخانه', 'fa==میلگرد آجدار 25  ظفر بناب  شاخه 12 متری  A3  کارخانه@@en==میلگرد آجدار 25  ظفر بناب  شاخه 12 متری  A3  کارخانه', 'fa==<h1>میلگرد آجدار&nbsp;25&nbsp; ظفر بناب&nbsp; شاخه 12 متری&nbsp; A3&nbsp; کارخانه</h1>\r\n\r\n<p>سایز: 25</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار&nbsp;25&nbsp; ظفر بناب&nbsp; شاخه 12 متری&nbsp; A3&nbsp; کارخانه</h1>\r\n\r\n<p>سایز: 25</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : ظفر بناب</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '138000', 0, 'offer', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f9684cd2fcdb.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9684cd2fcdb.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f9684cd2fcdb.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f9684cd2fcdb.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f9684cd2fcdb.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f9684cd2fcdb.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9684cd2fcdb.jpg\"}', 'میلگرد آجدار 25  ظفر بناب  شاخه 12 متری  A3  کارخانه', 0, 1, '2020-10-26 04:41:57', '2020-10-26 04:41:57', NULL),
(33, 'fa==میلگرد آجدار 10  نیشابور  شاخه  A3  کارخانه@@en==میلگرد آجدار 10  نیشابور  شاخه  A3  کارخانه', 5, 23, 'fa-میلگرد-آجدار-10-نیشابور-شاخه-A3-کارخانه-en-میلگرد-آجدار-10-نیشابور-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 10  نیشابور  شاخه  A3  کارخانه@@en==میلگرد آجدار 10  نیشابور  شاخه  A3  کارخانه', 'fa==<h1>میلگرد آجدار&nbsp;10&nbsp; نیشابور&nbsp; شاخه&nbsp; A3&nbsp; کارخانه</h1>\r\n\r\n<p>سایز : 10</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار&nbsp;10&nbsp; نیشابور&nbsp; شاخه&nbsp; A3&nbsp; کارخانه</h1>\r\n\r\n<p>سایز : 10</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '110900', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f9686b2559a8.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9686b2559a8.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f9686b2559a8.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f9686b2559a8.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f9686b2559a8.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f9686b2559a8.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f9686b2559a8.jpg\"}', 'میلگرد آجدار 10  نیشابور  شاخه  A3  کارخانه', 1, 1, '2020-10-26 04:50:02', '2020-10-26 04:50:02', NULL),
(34, 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری نیشابور@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری نیشابور', 5, 23, 'fa-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-نیشابور-en-12میلگرد-آجدار-کارخانهA3شاخه-12-متری-نیشابور', 'fa==12میلگرد آجدار کارخانهA3شاخه 12 متری نیشابور@@en==12میلگرد آجدار کارخانهA3شاخه 12 متری نیشابور', 'fa==<h1>12میلگرد آجدار کارخانهA3شاخه 12 متری&nbsp;نیشابور</h1>\r\n\r\n<p>سایز: 12</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>12میلگرد آجدار کارخانهA3شاخه 12 متری&nbsp;نیشابور</h1>\r\n\r\n<p>سایز: 12</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '131900', 0, 'special', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f968711ae077.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f968711ae077.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f968711ae077.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f968711ae077.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f968711ae077.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f968711ae077.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f968711ae077.jpg\"}', '12میلگرد آجدار کارخانهA3شاخه 12 متری نیشابور', 1, 1, '2020-10-26 04:51:37', '2020-10-26 04:53:26', NULL),
(35, 'fa==میلگرد آجدار 14 نیشابور شاخه A3 کارخانه@@en==میلگرد آجدار 14 نیشابور شاخه A3 کارخانه', 5, 23, 'fa-میلگرد-آجدار-14-نیشابور-شاخه-A3-کارخانه-en-میلگرد-آجدار-14-نیشابور-شاخه-A3-کارخانه', 'fa==میلگرد آجدار 14 نیشابور شاخه A3 کارخانه@@en==میلگرد آجدار 14 نیشابور شاخه A3 کارخانه', 'fa==<h1>میلگرد آجدار 14 نیشابور شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز: 14</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار 14 نیشابور شاخه A3 کارخانه</h1>\r\n\r\n<p>سایز: 14</p>\r\n\r\n<p>حالت : شاخه 12 متری</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '120400', 0, 'normal', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f96876f4a1ac.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96876f4a1ac.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f96876f4a1ac.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f96876f4a1ac.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f96876f4a1ac.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f96876f4a1ac.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96876f4a1ac.jpg\"}', 'میلگرد آجدار 14 نیشابور شاخه A3 کارخانه', 1, 1, '2020-10-26 04:53:11', '2020-10-26 04:53:11', NULL),
(36, 'fa==میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران@@en==میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران', 5, 23, 'fa-میلگرد-آجدار-16-نیشابور-شاخه-A3-بنگاه-تهران-en-میلگرد-آجدار-16-نیشابور-شاخه-A3-بنگاه-تهران', 'fa==میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران@@en==میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران', 'fa==<h1>میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>سایز : 16</p>\r\n\r\n<p>حالت : شاخه</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>@@en==<h1>میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>سایز : 16</p>\r\n\r\n<p>حالت : شاخه</p>\r\n\r\n<p>استاندارد : A3</p>\r\n\r\n<p>برند : نیشابور</p>\r\n\r\n<p>واحد : کیلوگرم</p>', '128500', 0, 'offer', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/products\\/5f96b9415e74e.jpg\",\"50\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96b9415e74e.jpg\",\"66\":\"\\/upload\\/images\\/2020\\/10\\/products\\/66_5f96b9415e74e.jpg\",\"200\":\"\\/upload\\/images\\/2020\\/10\\/products\\/200_5f96b9415e74e.jpg\",\"350\":\"\\/upload\\/images\\/2020\\/10\\/products\\/350_5f96b9415e74e.jpg\",\"500\":\"\\/upload\\/images\\/2020\\/10\\/products\\/500_5f96b9415e74e.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/products\\/50_5f96b9415e74e.jpg\"}', 'میلگرد آجدار 16 نیشابور شاخه A3 بنگاه تهران', 1, 1, '2020-10-26 08:25:47', '2020-10-26 08:25:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `title`, `slug`, `user_id`, `description`, `body`, `parent_id`, `images`, `tags`, `icon`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'sef', 'sef', 1, 'srf', 'sr', 1, '[]', 'r', 'e', 1, 1, '2020-04-17 10:22:39', '2020-04-17 10:43:46', '2020-04-17 10:43:46'),
(2, 'fa==qq@@en==q', 'fa-qq-en-q', 1, 'fa==sdf@@en==s', 'fa==sdfsdf@@en==sdf', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/product\\/5ea092ff74044.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/product\\/300_5ea092ff74044.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/product\\/600_5ea092ff74044.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/product\\/900_5ea092ff74044.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/product\\/300_5ea092ff74044.png\"}', 'sdf', 'sdf', 1, 1, '2020-04-17 10:32:22', '2020-04-23 04:43:32', '2020-04-23 04:43:32'),
(3, 'fa==aa@@en==ee', 'fa-aa-en-ee', 1, 'fa==a@@en==e', 'fa==aaaaaaaaaaa@@en==eeeeeeeeeee', 0, '{}', 'e', 'e', 1, 1, '2020-04-22 14:02:38', '2020-04-22 14:09:51', '2020-04-22 14:09:51'),
(4, 'fa==ت@@en==t', 'fa-ت-en-t', 1, 'fa==تست@@en==test', 'fa==تست م@@en==test b', 0, '{}', 'ت', '1', 1, 1, '2020-04-22 14:11:55', '2020-04-23 04:43:34', '2020-04-23 04:43:34'),
(5, 'fa==همه سرویس ها@@en==eeeee', 'fa-همه-سرویس-ها-en-eeeee', 1, 'fa==ههه@@en==eeeeeeee', 'fa==هههههه@@en==eee', 1, '{}', 'e', 'e', 1, 1, '2020-04-22 14:17:12', '2020-04-23 04:43:36', '2020-04-23 04:43:36'),
(6, 'fa==e@@en==ee', 'fa-e-en-ee', 1, 'fa==f@@en==ff', 'fa==r@@en==rr', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea09365e5572.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea09365e5572.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea09365e5572.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea09365e5572.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea09365e5572.jpg\"}', 'e', 'e', 1, 1, '2020-04-22 14:26:27', '2020-04-23 04:43:38', '2020-04-23 04:43:38'),
(7, 'fa==چینی و بهداشتی@@en==Chinese and sanitary', 'fa-چینی-و-بهداشتی-en-Chinese-and-sanitary', 1, 'fa==چینی و بهداشتی@@en==Chinese and sanitary', 'fa==چینی و بهداشتی@@en==Chinese and sanitary', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea15cc1f1295.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea15cc1f1295.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea15cc1f1295.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea15cc1f1295.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea15cc1f1295.png\"}', 'Chinese and sanitary', 'e', 1, 0, '2020-04-23 04:45:46', '2020-10-25 06:13:01', NULL),
(8, 'fa==روشویی@@en==wash basin', 'fa-روشویی-en-wash-basin', 1, 'fa==روشویی@@en==wash basin', 'fa==روشویی@@en==wash basin', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea15d4a284b6.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea15d4a284b6.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea15d4a284b6.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea15d4a284b6.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea15d4a284b6.png\"}', 'wash basin', 'wash basin', 1, 0, '2020-04-23 04:48:02', '2020-10-25 06:13:10', NULL),
(9, 'fa==کالای آشپزخانه@@en==Kitchen goods', 'fa-کالای-آشپزخانه-en-Kitchen-goods', 1, 'fa==کالای آشپزخانه@@en==Kitchen goods', 'fa==کالای آشپزخانه@@en==Kitchen goods', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea161734b234.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161734b234.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea161734b234.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea161734b234.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161734b234.jpg\"}', 'Kitchen goods', 'Kitchen goods', 1, 0, '2020-04-23 05:05:47', '2020-10-25 06:13:57', NULL),
(10, 'fa==سینک@@en==Kitchen sink', 'fa-سینک-en-Kitchen-sink', 1, 'fa==سینک@@en==Kitchen sink', 'fa==سینک@@en==Kitchen sink', 9, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea161b95e3ca.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161b95e3ca.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea161b95e3ca.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea161b95e3ca.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161b95e3ca.png\"}', 'Kitchen sink', 'Kitchen sink', 1, 1, '2020-04-23 05:06:57', '2020-04-23 05:06:57', NULL),
(11, 'fa==سینک روکار@@en==Surface sink', 'fa-سینک-روکار-en-Surface-sink', 1, 'fa==سینک روکار@@en==Surface sink', 'fa==سینک روکار@@en==Surface sink', 10, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea161fcc1a1f.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161fcc1a1f.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea161fcc1a1f.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea161fcc1a1f.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea161fcc1a1f.png\"}', 'Surface sink', 'Surface sink', 1, 1, '2020-04-23 05:08:05', '2020-04-23 05:08:05', NULL),
(12, 'fa==سینک توکار@@en==Built-in sink', 'fa-سینک-توکار-en-Built-in-sink', 1, 'fa==سینک توکار@@en==Built-in sink', 'fa==سینک توکار@@en==Built-in sink', 10, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea16232c9098.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea16232c9098.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea16232c9098.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea16232c9098.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea16232c9098.png\"}', 'سینک توکار', 'سینک توکار', 1, 1, '2020-04-23 05:08:59', '2020-04-23 05:08:59', NULL),
(13, 'fa==هود@@en==Hood', 'fa-هود-en-Hood', 1, 'fa==هود@@en==Hood', 'fa==هود@@en==Hood', 9, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea162886b020.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162886b020.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea162886b020.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea162886b020.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162886b020.png\"}', 'Hood', 'i', 1, 1, '2020-04-23 05:10:24', '2020-04-23 05:10:24', NULL),
(14, 'fa==فر@@en==the oven', 'fa-فر-en-the-oven', 1, 'fa==فر@@en==the oven', 'fa==فر@@en==the oven', 9, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea162b285cd1.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162b285cd1.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea162b285cd1.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea162b285cd1.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162b285cd1.png\"}', 'the oven', 'i', 1, 1, '2020-04-23 05:11:06', '2020-04-23 05:11:06', NULL),
(15, 'fa==لوله و اتصالات@@en==Pipes and fittings', 'fa-لوله-و-اتصالات-en-Pipes-and-fittings', 1, 'fa==لوله و اتصالات@@en==Pipes and fittings', 'fa==لوله و اتصالات@@en==Pipes and fittings', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea162de74ebe.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162de74ebe.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea162de74ebe.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea162de74ebe.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea162de74ebe.png\"}', 'لوله و اتصالات', 'i', 1, 0, '2020-04-23 05:11:50', '2020-10-25 06:13:36', NULL),
(16, 'fa==پنج لایه@@en==Five layers', 'fa-پنج-لایه-en-Five-layers', 1, 'fa==پنج لایه@@en==Five layers', 'fa==پنج لایه@@en==Five layers', 15, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/5ea1631eeb22f.png\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea1631eeb22f.png\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/600_5ea1631eeb22f.png\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/900_5ea1631eeb22f.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/productCategories\\/300_5ea1631eeb22f.png\"}', 'Five layers', 'i', 1, 1, '2020-04-23 05:12:55', '2020-04-23 05:12:55', NULL),
(17, 'fa==لوله های فلزی@@en==Metal pipes', 'fa-لوله-های-فلزی-en-Metal-pipes', 1, 'fa==لوله های فلزی@@en==Metal pipes', 'fa==لوله های فلزی@@en==Metal pipes', 15, '[]', 'لوله های فلزی', 'i', 1, 1, '2020-04-23 05:17:02', '2020-04-23 05:17:02', NULL),
(18, 'fa==آهن@@en==آهن', 'fa-آهن-en-آهن', 5, 'fa==آهن@@en==آهن', 'fa==آهن@@en==آهن', 0, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f954123dd0d3.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f954123dd0d3.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f954123dd0d3.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f954123dd0d3.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f954123dd0d3.jpg\"}', 'آهن', 'i', 1, 1, '2020-10-25 05:41:00', '2020-10-25 05:41:00', NULL),
(19, 'fa==میلگرد@@en==میلگرد', 'fa-میلگرد-en-میلگرد', 5, 'fa==میلگرد@@en==میلگرد', 'fa==میلگرد@@en==میلگرد', 18, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f9541773a1db.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9541773a1db.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f9541773a1db.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f9541773a1db.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9541773a1db.jpg\"}', 'میلگرد', 'i', 1, 1, '2020-10-25 05:42:23', '2020-10-25 05:42:23', NULL),
(20, 'fa==میلگرد میانه@@en==میلگرد میانه', 'fa-میلگرد-میانه-en-میلگرد-میانه', 5, 'fa==میلگرد میانه@@en==میلگرد میانه', 'fa==میلگرد میانه@@en==میلگرد میانه', 19, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f9541f808ddf.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9541f808ddf.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f9541f808ddf.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f9541f808ddf.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9541f808ddf.jpg\"}', 'میلگرد میانه', 'i', 1, 1, '2020-10-25 05:44:32', '2020-10-25 05:44:32', NULL),
(21, 'fa==میلگرد ذوب آهن اصفهان@@en==میلگرد ذوب آهن اصفهان', 'fa-میلگرد-ذوب-آهن-اصفهان-en-میلگرد-ذوب-آهن-اصفهان', 5, 'fa==میلگرد ذوب آهن اصفهان@@en==میلگرد ذوب آهن اصفهان', 'fa==میلگرد ذوب آهن اصفهان@@en==میلگرد ذوب آهن اصفهان', 19, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f954247a232c.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f954247a232c.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f954247a232c.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f954247a232c.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f954247a232c.jpg\"}', 'میلگرد ذوب آهن اصفهان', 'i', 1, 1, '2020-10-25 05:45:52', '2020-10-25 05:46:13', NULL),
(22, 'fa==میلگرد ظفر بناب@@en==میلگرد ظفر بناب', 'fa-میلگرد-ظفر-بناب-en-میلگرد-ظفر-بناب', 5, 'fa==میلگرد ظفر بناب@@en==میلگرد ظفر بناب', 'fa==میلگرد ظفر بناب@@en==میلگرد ظفر بناب', 19, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f95428e43689.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f95428e43689.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f95428e43689.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f95428e43689.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f95428e43689.jpg\"}', 'میلگرد ظفر بناب', 'i', 1, 1, '2020-10-25 05:47:02', '2020-10-25 05:47:02', NULL),
(23, 'fa==میلگرد نیشابور@@en==میلگرد نیشابور', 'fa-میلگرد-نیشابور-en-میلگرد-نیشابور', 5, 'fa==میلگرد نیشابور@@en==میلگرد نیشابور', 'fa==<p>میلگرد نیشابور</p>@@en==<p>میلگرد نیشابور</p>', 19, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/5f9686476b44d.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9686476b44d.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/600_5f9686476b44d.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/900_5f9686476b44d.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/productCategories\\/300_5f9686476b44d.jpg\"}', 'میلگرد نیشابور', 'i', 1, 1, '2020-10-26 04:48:15', '2020-10-26 04:48:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `images` text CHARACTER SET utf8 DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_details`
--

CREATE TABLE `site_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_details`
--

INSERT INTO `site_details` (`id`, `title`, `key`, `user_id`, `value`, `images`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'logo', 'image_logo', 1, 'fa==rr@@en==rr', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/product\\/5ea1b774e1954.jpg\",\"300\":\"\\/upload\\/images\\/2020\\/4\\/product\\/300_5ea1b774e1954.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/product\\/600_5ea1b774e1954.jpg\",\"900\":\"\\/upload\\/images\\/2020\\/4\\/product\\/900_5ea1b774e1954.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/product\\/300_5ea1b774e1954.jpg\"}', 'image', 1, '2020-04-17 13:05:04', '2020-04-23 11:12:45', NULL),
(5, 'site_name', 'site_name', 1, 'قرآنکده نور موعود (عج)', '[]', 'text', 1, '2020-04-17 14:52:44', '2020-12-01 03:48:16', NULL),
(9, 'آدرس', 'address', 5, 'آدرس : استان فارس، شهرستان ارسنجان، خیابان سعیدیه کوچه مهدیه طبقه پایین مهدیه مؤسسه فرهنگی قرآن و عترت گلشن نور موعود (عج) کد پستی: 7376161359', '[]', 'text', 1, '2020-11-10 07:59:15', '2020-12-01 03:45:22', NULL),
(10, 'تلفن ثابت', 'phone', 5, 'شماره ثابت قرآنکده: 07143529198', '[]', 'text', 1, '2020-11-10 07:59:46', '2020-12-01 03:45:47', NULL),
(11, 'تلفن همراه', 'mobile', 5, 'مدیریت: 09171260316\r\n<br>\r\nمعاونت: 09365366538\r\n<br>\r\nپشتیبان ثبت نام و کلاسداری آنلاین: 09176849783\r\n<br>\r\nمهد الرضا: 09338437102', '[]', 'text', 1, '2020-11-10 08:00:30', '2020-12-01 03:46:56', NULL),
(12, 'ایمیل', 'email', 5, 'پست الکترونیکی: gnm.9198@gmail.com', '[]', 'text', 1, '2020-11-10 08:00:55', '2020-12-01 03:47:19', NULL),
(13, 'تلگرام', 'telegram', 5, 'آدرس تلگرام', '[]', 'text', 1, '2020-11-10 08:01:20', '2020-11-10 08:01:20', NULL),
(14, 'اینستاگرام', 'instagram', 5, 'https://www.instagram.com/quran.golshannoormouood/', '[]', 'text', 1, '2020-11-10 08:01:46', '2020-12-01 03:44:52', NULL),
(15, 'تست', 'df', 5, 'ddd', '[]', 'text', 1, '2020-11-10 09:03:27', '2020-11-10 09:04:36', '2020-11-10 09:04:36'),
(16, 'تصویر بسم نور', 'image_header', 40, '', '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/11\\/product\\/5fc39828954f2.png\",\"300\":\"\\/upload\\/images\\/2020\\/11\\/product\\/300_5fc39828954f2.png\",\"600\":\"\\/upload\\/images\\/2020\\/11\\/product\\/600_5fc39828954f2.png\",\"900\":\"\\/upload\\/images\\/2020\\/11\\/product\\/900_5fc39828954f2.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/11\\/product\\/300_5fc39828954f2.png\"}', 'image', 1, '2020-11-29 20:46:33', '2020-11-29 20:46:33', NULL),
(17, 'عنوان حدیث روز', 'hadis_roz_title', 40, 'حدیث روز', '[]', 'text', 1, '2020-11-29 21:25:41', '2020-11-29 21:25:41', NULL),
(18, 'متن حدیث روز', 'hadis_roz_body', 40, 'جایگاه علما بر روی زمین\r\n<br>\r\nامام علی علیه السلام:\r\n<br>\r\nالعُلَماءُ حُکّامٌ عَلَی النّاسِ\r\n<br>\r\nعالمان، فرمانروای بر مردمند.', '[]', 'text', 1, '2020-11-29 21:27:18', '2020-11-29 21:27:18', NULL),
(19, 'عنوان باکس معرفی', 'box_info_title', 40, 'قرآنکده نور موعود (عج)', '[]', 'text', 1, '2020-11-29 21:32:56', '2020-11-29 21:35:17', NULL),
(20, 'متن باکس معرفی', 'box_info_body', 40, 'نام کامل قرآنکده نور موعود (عج)، مؤسسه فرهنگی قرآن و عترت گلشن نور موعود (عج) است، که در استناد گلشن به نور موعود نیز، لطایفی نهفته شده که بر صاحبان بینش، پوشیده نیست.', '[]', 'text', 1, '2020-11-29 21:33:44', '2020-11-29 21:33:44', NULL),
(21, 'عنوان باکس 1', 'box_1_title', 40, 'کلاس ها و طرح های آموزشی', '[]', 'text', 1, '2020-12-01 04:39:55', '2020-12-01 04:39:55', NULL),
(22, 'لینک باکس 1', 'box_1_link', 40, '#', '[]', 'text', 1, '2020-12-01 04:40:24', '2020-12-01 04:40:24', NULL),
(27, 'عنوان باکس 2', 'box_2_title', 40, 'ثبت نام در قرآنکده آنلاین و حضوری', '[]', 'text', 1, '2020-12-01 04:39:55', '2020-12-01 04:39:55', NULL),
(28, 'لینک باکس 2', 'box_2_link', 40, '#', '[]', 'text', 1, '2020-12-01 04:40:24', '2020-12-01 04:40:24', NULL),
(29, 'عنوان باکس 3', 'box_3_title', 40, 'دوره تخصصی معلم القرآن', '[]', 'text', 1, '2020-12-01 04:39:55', '2020-12-01 04:39:55', NULL),
(30, 'لینک باکس 3', 'box_3_link', 40, '#', '[]', 'text', 1, '2020-12-01 04:40:24', '2020-12-01 04:40:24', NULL),
(31, 'عنوان باکس 4', 'box_4_title', 40, 'سهمی از نور', '[]', 'text', 1, '2020-12-01 04:39:55', '2020-12-01 04:39:55', NULL),
(32, 'لینک باکس 4', 'box_4_link', 40, '#', '[]', 'text', 1, '2020-12-01 04:40:24', '2020-12-01 04:40:24', NULL),
(33, 'عنوان معرفی سایت در فوتر', 'footer_about_title', 40, 'مختصری از قرآنکده نور موعود (عج)', '[]', 'text', 1, '2020-12-01 07:36:24', '2020-12-01 07:36:24', NULL),
(34, 'متن معرفی سایت در فوتر', 'footer_about_body', 40, 'نام کامل قرآنکده نور موعود (عج)، <br>مؤسسه فرهنگی قرآن و عترت گلشن نور موعود (عج) است،<br> که در استناد گلشن به نور موعود نیز، لطایفی<br> نهفته شده که بر صاحبان بینش، پوشیده نیست', '[]', 'text', 1, '2020-12-01 07:38:46', '2020-12-01 07:41:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'index',
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `user_id`, `images`, `link`, `type`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'fa==1@@en==11', 1, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/5f957dc9e60da.jpg\",\"920-380\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920-380_5f957dc9e60da.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/600_5f957dc9e60da.jpg\",\"920\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920_5f957dc9e60da.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920-380_5f957dc9e60da.jpg\"}', '#', 'index', 1, 1, '2020-04-22 15:55:07', '2020-10-25 09:59:49', NULL),
(2, 'fa==slider@@en==slider', 1, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/4\\/slider\\/5ea1b1b8e6459.jpg\",\"920-380\":\"\\/upload\\/images\\/2020\\/4\\/slider\\/920-380_5ea1b1b8e6459.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/4\\/slider\\/600_5ea1b1b8e6459.jpg\",\"920\":\"\\/upload\\/images\\/2020\\/4\\/slider\\/920_5ea1b1b8e6459.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/4\\/slider\\/920-380_5ea1b1b8e6459.jpg\"}', '#', 'index', 6, 1, '2020-04-23 10:36:59', '2020-04-23 10:53:21', NULL),
(3, 'fa==2@@en==2', 1, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/5f957dfd4e890.jpg\",\"920-380\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920-380_5f957dfd4e890.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/600_5f957dfd4e890.jpg\",\"920\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920_5f957dfd4e890.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/10\\/slider\\/920-380_5f957dfd4e890.jpg\"}', '#', 'index', 2, 1, '2020-04-23 10:54:47', '2020-10-25 10:00:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `active`, `level`, `email`, `phone`, `email_verified_at`, `phone_verified_at`, `password`, `priority`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'admin', 0, 'user', 'admin@gmail.com', '1', NULL, NULL, '1', 0, 0, NULL, NULL, NULL, NULL),
(5, 'مهدی', 'رضایی', 1, 'admin', 'rezaie.mehdi5@gmail.com', '0918550', NULL, NULL, '$2y$10$fznpAGfU3pszNZzY6Ilate//yHph0AZjKF576pdru037QImyvPlXu', 0, 0, 'BWIorqzmLRwFUSkNkmQRSomvuV1pfjrGZfIVCuS5nXvSRefAripIXddR9n1h', '2020-09-27 04:44:36', '2020-09-27 04:44:36', NULL),
(14, 'افتر افکت', 'dsfgh', 0, 'user', 'admin@admin.com', '09', NULL, NULL, '$2y$10$fznpAGfU3pszNZzY6Ilate//yHph0AZjKF576pdru037QImyvPlXu', 0, 0, 'TaHDBRp1FqCv96CI3FCRt3yU6gp5AH54Uk7mICJAPqzz1nGRR4DY8m3TXQsi', '2020-11-11 08:09:26', '2020-11-11 09:22:38', NULL),
(39, 'm', 'hg', 1, 'user', '', '09185507245', NULL, NULL, '$2y$10$x3jrBMsgww9/jTH8G9BU1OJRu1QjySEttE5u1WURzNR/lgXkYXQ5m', 0, 0, 'p6zOdiFYPsMZeiIUsgC8B0DdRrFWjm6P9GbtUCA9GiYWdESLhxH8TTD6QKnR', '2020-11-15 07:37:34', '2020-11-16 03:23:11', NULL),
(40, 'vfgh', 'ghg', 1, 'admin', 'rezaie.mehdi555@gmail.com', '09185597245', NULL, NULL, '$2y$10$y1aQH6JKDBuTKz0l64POkuq1.i9samuOopZhf06LND0jR9mpkYD0q', 0, 0, NULL, '2020-11-28 21:50:19', '2020-11-28 21:50:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `web_pages`
--

CREATE TABLE `web_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'index',
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_pages`
--

INSERT INTO `web_pages` (`id`, `title`, `slug`, `body`, `user_id`, `images`, `link`, `type`, `priority`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dfg', 'dfg', '<p>cfd</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<figure class=\"easyimage easyimage-full\"><img alt=\"\" src=\"blob:http://127.0.0.1:8000/143a84dc-82c6-4d20-8f8d-e12314ed936f\" width=\"341\" />\r\n<figcaption></figcaption>\r\n</figure>\r\n\r\n<p>&nbsp;</p>', 5, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/5fb23a243ae3c.jpg\",\"920-380\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920-380_5fb23a243ae3c.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/600_5fb23a243ae3c.jpg\",\"920\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920_5fb23a243ae3c.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920-380_5fb23a243ae3c.jpg\"}', 'https://www.maj.ir/', 'index', 5, 1, '2020-11-16 05:06:53', '2020-11-16 05:06:56', '2020-11-16 05:06:56'),
(2, 'آشنایی با ما', 'آشنایی-با-ما', '<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">بسم الله الرحمن الرحیم</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">قرآنکده نور موعود (عج)</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">ذات اقدس الهی در کتاب عزیزش، خود را نور معرفی کرده: &laquo;الله نور السماوات و الارض) و از نور محض، نور ساتع و نازل می گردد، بدین جهت است که قرآنی که حبل الله المتین است، نوریست که که به صوی عالم ما نازل گردیده: &laquo;انزلنا الیکم نور مبینا&raquo; و طبق فراز پر از راز زیارت جامعه کبیره، ذوات مقدسه معصومین علیهم السلام نیز نور هستند: &laquo;انتم نور&raquo; و شما خود حدیث مفصل بخوان از این مجمل که چرا نام قرآنکده، نور گشته و نام شریف حضرت موعود ارواحنا له الفداء، نور علی نور آن قرار گرفته است.</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">البته نام کامل قرآنکده نور موعود (عج)، مؤسسه فرهنگی قرآن و عترت گلشن نور موعود (عج) است، که در استناد گلشن به نور موعود نیز، لطایفی نهفته شده که بر صاحبان بینش، پوشیده نیست. </span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">بنابراین آستان مقدس و نورانی قرآن و عترت، گلشن و بهشتی هستند از جنس نور، که ندایشان، رهایی جهانیان است، از تاریکی های حاکم بر جهان و تعلق یافتن به عالم نور.</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">اصولا قرآن، کتابیست زندگی بخش که برای زنده ها نازل شده &laquo;لینذر من کان حی&raquo; و این کتاب عزیز همان است که به انسان، زیبایی های عالم درون و بیرون انسان را می شناساند، تا از زندگی خود بیشترین لذت را برده و به کم ها قانع نگردند. </span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">این بود نمایی کلی از جنس قرآنکده، تا قرآن آموزان بدانند که به کجا پا می نهند و قرار است به کجا پر کشند.</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\">&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"blob:http://127.0.0.1:8000/a752e63a-81f8-483c-a8ae-2d00375532e5\" style=\"width:284px\" /></p>\r\n\r\n<p>&nbsp;</p>', 5, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/5fb23a39d5133.jpg\",\"920-380\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920-380_5fb23a39d5133.jpg\",\"600\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/600_5fb23a39d5133.jpg\",\"920\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920_5fb23a39d5133.jpg\"},\"thumb\":\"\\/upload\\/images\\/2020\\/11\\/webPages\\/920-380_5fb23a39d5133.jpg\"}', '/show/page/2', 'index', 3, 1, '2020-11-16 05:07:14', '2020-12-01 04:20:12', NULL),
(3, 'ارتباط با ما', 'ارتباط-با-ما', '<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">بسم الله الرحمن الرحیم</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">کاربر گرامی شما می توانید، از طرق ذیل با ما در ارتباط باشید:</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">آدرس: استان فارس، شهرستان ارسنجان، خیابان سعیدیه کوچه مهدیه طبقه پایین مهدیه مؤسسه فرهنگی قرآن و عترت گلشن نور موعود (عج) کد پستی: 7376161359</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">شماره ثابت قرآنکده: 07143529198</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">مدیریت: 09171260316</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">معاونت: 09365366538</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">پشتیبان ثبت نام و کلاسداری آنلاین: 09176849783</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">مهد الرضا: 09338437102</span></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">پست الکترونیکی:</span> <a href=\"mailto:gnm.9198@gmail.com\" style=\"color:#0563c1; text-decoration:underline\">gnm.9198@gmail.com</a></span></span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:right\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">اینستاگرام: </span><a href=\"https://www.instagram.com/quran.golshannoormouood/\" target=\"_blank\">quran.golshannoormouood</a></span></span></p>', 40, '{\"images\":{\"original\":\"\\/upload\\/images\\/2020\\/12\\/webPages\\/5fc5f69a36e8d.png\",\"920-380\":\"\\/upload\\/images\\/2020\\/12\\/webPages\\/920-380_5fc5f69a36e8d.png\",\"600\":\"\\/upload\\/images\\/2020\\/12\\/webPages\\/600_5fc5f69a36e8d.png\",\"920\":\"\\/upload\\/images\\/2020\\/12\\/webPages\\/920_5fc5f69a36e8d.png\"},\"thumb\":\"\\/upload\\/images\\/2020\\/12\\/webPages\\/920-380_5fc5f69a36e8d.png\"}', '#', 'index', 2, 1, '2020-12-01 04:24:03', '2020-12-01 04:26:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activation_codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_converts`
--
ALTER TABLE `currency_converts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `currency_converts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_user_id_foreign` (`user_id`),
  ADD KEY `menus_menu_categories_id_foreign` (`menu_categories_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`),
  ADD KEY `news_news_categories_id_foreign` (`news_categories_id`);

--
-- Indexes for table `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `site_details`
--
ALTER TABLE `site_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_details_key_unique` (`key`),
  ADD KEY `site_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `web_pages`
--
ALTER TABLE `web_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `web_pages_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_codes`
--
ALTER TABLE `activation_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currency_converts`
--
ALTER TABLE `currency_converts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_details`
--
ALTER TABLE `site_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `web_pages`
--
ALTER TABLE `web_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD CONSTRAINT `activation_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `currency_converts`
--
ALTER TABLE `currency_converts`
  ADD CONSTRAINT `currency_converts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_menu_categories_id_foreign` FOREIGN KEY (`menu_categories_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD CONSTRAINT `menu_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_news_categories_id_foreign` FOREIGN KEY (`news_categories_id`) REFERENCES `news_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `news_categories`
--
ALTER TABLE `news_categories`
  ADD CONSTRAINT `news_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `site_details`
--
ALTER TABLE `site_details`
  ADD CONSTRAINT `site_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `web_pages`
--
ALTER TABLE `web_pages`
  ADD CONSTRAINT `web_pages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
