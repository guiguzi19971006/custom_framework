-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 06 月 02 日 02:05
-- 伺服器版本： 10.6.3-MariaDB-log
-- PHP 版本： 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `vhost155538`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL COMMENT '產品分類編號',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品名稱',
  `price` mediumint(8) UNSIGNED NOT NULL COMMENT '產品價格',
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品圖片',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品描述',
  `remaining_qty` smallint(5) UNSIGNED NOT NULL COMMENT '產品剩餘數量',
  `is_sellable` tinyint(1) UNSIGNED NOT NULL COMMENT '產品可否銷售',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `name`, `price`, `photo`, `description`, `remaining_qty`, `is_sellable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ES759', 490, 'images/products/ES759 .gif', '這是 ES759。', 99, 1, '2024-03-02 17:30:21', '2024-05-17 15:22:07', NULL),
(2, 1, 'F0476', 590, 'images/products/F0476 .gif', '這是 F0476。', 40, 1, '2024-05-05 16:13:55', '2024-05-17 15:22:42', NULL),
(3, 1, 'F0752', 499, 'images/products/F0752 .gif', '這是 F0752。', 14, 1, '2024-05-05 16:58:09', '2024-05-17 15:23:14', NULL),
(4, 1, 'F1714', 650, 'images/products/F1714 .gif', '這是 F1714。', 11, 1, '2024-05-05 17:13:19', '2024-05-17 15:23:33', NULL),
(5, 1, 'F2734', 479, 'images/products/F2734 .gif', '這是 F2734。', 18, 1, '2024-05-11 10:41:42', '2024-05-17 15:23:57', NULL),
(6, 1, 'F5474', 749, 'images/products/F5474 .gif', '這是 F5474。', 10, 1, '2024-05-11 10:44:06', '2024-05-17 15:24:11', NULL),
(7, 1, 'F6472', 449, 'images/products/F6472 .gif', '這是 F6472。', 8, 1, '2024-05-11 11:08:28', '2024-05-17 15:24:24', NULL),
(8, 1, 'F9754', 590, 'images/products/F9754 .gif', '這是 F9754。', 17, 1, '2024-05-11 11:09:32', '2024-05-17 15:24:37', NULL),
(9, 1, 'FT476', 359, 'images/products/FT476 .gif', '這是 FT476。', 14, 1, '2024-05-11 11:10:51', '2024-05-17 15:24:48', NULL),
(10, 1, 'FT499', 389, 'images/products/FT499 .gif', '這是 FT499。', 9, 1, '2024-05-11 11:12:40', '2024-05-17 15:25:04', NULL),
(11, 1, 'FT752', 389, 'images/products/FT752 .gif', '這是 FT752。', 10, 1, '2024-05-11 11:13:40', '2024-05-17 15:25:19', NULL),
(12, 1, 'P785', 389, 'images/products/P785  .gif', '這是 P785。', 21, 1, '2024-05-11 11:15:05', '2024-05-17 15:25:34', NULL),
(13, 1, 'P789', 539, 'images/products/P789  .gif', '這是 P789。', 28, 1, '2024-05-11 11:15:48', '2024-05-17 15:25:47', NULL),
(14, 1, 'S749', 599, 'images/products/S749  .gif', '這是 S749。', 15, 1, '2024-05-11 11:16:38', '2024-05-17 15:25:59', NULL),
(15, 1, 'S752', 629, 'images/products/S752  .gif', '這是 S752。', 22, 1, '2024-05-11 11:17:32', '2024-05-17 15:26:09', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `product_category`
--

CREATE TABLE `product_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product_category`
--

INSERT INTO `product_category` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '書籍', '2024-04-20 07:20:43', '2024-04-20 07:20:43', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電子郵件',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '生理性別',
  `birthday` date NOT NULL COMMENT '生日',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手機號碼',
  `photo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '相片',
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '住址',
  `last_login_time` datetime DEFAULT NULL COMMENT '最後登入時間',
  `last_login_ip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最後登入 IP 位址',
  `registration_time` datetime NOT NULL COMMENT '註冊時間',
  `is_activated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否啟用',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `gender`, `birthday`, `phone`, `photo`, `address`, `last_login_time`, `last_login_ip`, `registration_time`, `is_activated`, `created_at`, `updated_at`, `deleted_at`) VALUES
(29, 'guiguzi19971006@gmail.com', '$2y$10$M91xmLdhHOgRSSUF3bqGee49LiQA0Y3jx0cLTvF4AxSbRWiNZZ976', 'Eric', 'M', '1997-10-06', '0912345678', NULL, '新北市', NULL, NULL, '2024-06-02 02:04:07', 0, '2024-06-01 18:04:07', '2024-06-01 18:04:07', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user_interesting_product`
--

CREATE TABLE `user_interesting_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT '使用者編號',
  `product_id` bigint(20) UNSIGNED NOT NULL COMMENT '產品編號',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user_interesting_product`
--

INSERT INTO `user_interesting_product` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '2024-05-11 15:54:50', '2024-05-11 15:54:50'),
(2, NULL, 11, '2024-05-11 15:55:19', '2024-05-11 15:55:19'),
(3, NULL, 1, '2024-05-11 15:55:28', '2024-05-11 15:55:28'),
(4, NULL, 13, '2024-05-11 15:55:28', '2024-05-11 15:55:28'),
(5, NULL, 1, '2024-05-11 15:55:44', '2024-05-11 15:55:44'),
(6, NULL, 12, '2024-05-11 15:55:54', '2024-05-11 15:55:54'),
(7, NULL, 12, '2024-05-11 15:56:00', '2024-05-11 15:56:00'),
(8, NULL, 1, '2024-05-11 15:56:10', '2024-05-11 15:56:10'),
(9, NULL, 15, '2024-05-11 15:56:11', '2024-05-11 15:56:11'),
(10, NULL, 15, '2024-05-11 15:56:30', '2024-05-11 15:56:30'),
(11, NULL, 5, '2024-05-11 15:56:42', '2024-05-11 15:56:42'),
(12, NULL, 14, '2024-05-11 15:58:40', '2024-05-11 15:58:40'),
(13, NULL, 12, '2024-05-11 15:58:49', '2024-05-11 15:58:49'),
(14, NULL, 12, '2024-05-11 15:59:29', '2024-05-11 15:59:29'),
(15, NULL, 12, '2024-05-11 15:59:35', '2024-05-11 15:59:35'),
(16, NULL, 13, '2024-05-11 15:59:42', '2024-05-11 15:59:42'),
(17, NULL, 14, '2024-05-11 16:01:14', '2024-05-11 16:01:14'),
(18, NULL, 1, '2024-05-11 16:01:21', '2024-05-11 16:01:21'),
(19, NULL, 2, '2024-05-11 16:01:28', '2024-05-11 16:01:28'),
(20, NULL, 3, '2024-05-11 16:02:34', '2024-05-11 16:02:34'),
(21, NULL, 13, '2024-05-12 08:29:13', '2024-05-12 08:29:13'),
(22, NULL, 9, '2024-05-12 08:29:36', '2024-05-12 08:29:36'),
(23, NULL, 2, '2024-05-12 08:49:30', '2024-05-12 08:49:30'),
(24, NULL, 14, '2024-05-12 09:37:16', '2024-05-12 09:37:16'),
(25, NULL, 13, '2024-05-12 09:37:39', '2024-05-12 09:37:39'),
(26, NULL, 6, '2024-05-12 09:55:36', '2024-05-12 09:55:36'),
(27, NULL, 7, '2024-05-12 12:14:16', '2024-05-12 12:14:16'),
(28, NULL, 7, '2024-05-12 12:14:24', '2024-05-12 12:14:24'),
(29, NULL, 7, '2024-05-12 12:16:01', '2024-05-12 12:16:01'),
(30, NULL, 7, '2024-05-12 12:16:08', '2024-05-12 12:16:08'),
(31, NULL, 7, '2024-05-12 12:16:18', '2024-05-12 12:16:18'),
(32, NULL, 11, '2024-05-12 12:27:41', '2024-05-12 12:27:41'),
(33, NULL, 11, '2024-05-12 12:27:47', '2024-05-12 12:27:47'),
(34, NULL, 11, '2024-05-12 12:27:51', '2024-05-12 12:27:51'),
(35, NULL, 1, '2024-05-12 16:06:23', '2024-05-12 16:06:23'),
(36, NULL, 14, '2024-05-12 16:06:39', '2024-05-12 16:06:39'),
(37, NULL, 9, '2024-05-12 16:30:37', '2024-05-12 16:30:37'),
(38, NULL, 3, '2024-05-14 10:30:17', '2024-05-14 10:30:17'),
(39, NULL, 8, '2024-05-14 17:55:44', '2024-05-14 17:55:44'),
(40, NULL, 5, '2024-05-17 08:16:47', '2024-05-17 08:16:47'),
(41, NULL, 5, '2024-05-17 08:16:50', '2024-05-17 08:16:50'),
(42, NULL, 1, '2024-05-17 14:43:43', '2024-05-17 14:43:43'),
(43, NULL, 11, '2024-05-17 14:45:31', '2024-05-17 14:45:31'),
(44, NULL, 12, '2024-05-17 14:49:04', '2024-05-17 14:49:04'),
(45, NULL, 7, '2024-05-17 15:31:59', '2024-05-17 15:31:59'),
(46, NULL, 11, '2024-05-17 16:04:31', '2024-05-17 16:04:31'),
(47, NULL, 11, '2024-05-17 16:05:00', '2024-05-17 16:05:00'),
(48, NULL, 14, '2024-05-17 16:13:33', '2024-05-17 16:13:33'),
(49, NULL, 12, '2024-05-17 16:18:33', '2024-05-17 16:18:33'),
(50, NULL, 3, '2024-05-17 16:20:57', '2024-05-17 16:20:57'),
(51, NULL, 11, '2024-05-17 18:15:48', '2024-05-17 18:15:48'),
(52, NULL, 14, '2024-05-18 12:09:00', '2024-05-18 12:09:00'),
(53, NULL, 11, '2024-05-18 17:02:52', '2024-05-18 17:02:52'),
(54, NULL, 11, '2024-05-18 17:05:51', '2024-05-18 17:05:51'),
(55, NULL, 11, '2024-05-18 17:35:08', '2024-05-18 17:35:08'),
(56, NULL, 9, '2024-05-18 17:35:41', '2024-05-18 17:35:41'),
(57, NULL, 4, '2024-05-18 17:39:55', '2024-05-18 17:39:55'),
(58, NULL, 3, '2024-05-18 17:46:04', '2024-05-18 17:46:04'),
(59, NULL, 13, '2024-05-18 17:47:37', '2024-05-18 17:47:37'),
(60, NULL, 11, '2024-05-19 09:11:03', '2024-05-19 09:11:03'),
(61, NULL, 6, '2024-05-19 09:14:39', '2024-05-19 09:14:39'),
(62, NULL, 13, '2024-05-19 09:18:24', '2024-05-19 09:18:24'),
(63, NULL, 13, '2024-05-19 09:21:08', '2024-05-19 09:21:08'),
(64, NULL, 13, '2024-05-19 09:21:21', '2024-05-19 09:21:21'),
(65, NULL, 13, '2024-05-19 09:23:30', '2024-05-19 09:23:30'),
(66, NULL, 13, '2024-05-19 09:28:40', '2024-05-19 09:28:40'),
(67, NULL, 7, '2024-05-19 10:28:09', '2024-05-19 10:28:09'),
(68, NULL, 11, '2024-05-19 10:28:34', '2024-05-19 10:28:34'),
(69, NULL, 6, '2024-05-19 15:04:53', '2024-05-19 15:04:53'),
(70, NULL, 13, '2024-05-21 06:28:28', '2024-05-21 06:28:28'),
(71, NULL, 13, '2024-05-21 06:28:49', '2024-05-21 06:28:49'),
(72, NULL, 11, '2024-05-21 06:29:18', '2024-05-21 06:29:18'),
(73, NULL, 15, '2024-05-22 02:43:57', '2024-05-22 02:43:57'),
(74, NULL, 13, '2024-05-22 03:19:07', '2024-05-22 03:19:07'),
(75, NULL, 11, '2024-05-23 18:58:52', '2024-05-23 18:58:52'),
(76, NULL, 11, '2024-05-24 07:01:12', '2024-05-24 07:01:12'),
(77, NULL, 6, '2024-05-25 16:19:19', '2024-05-25 16:19:19'),
(78, NULL, 13, '2024-05-25 17:52:21', '2024-05-25 17:52:21'),
(79, NULL, 2, '2024-05-25 17:52:38', '2024-05-25 17:52:38'),
(80, NULL, 4, '2024-05-25 19:38:02', '2024-05-25 19:38:02'),
(81, NULL, 11, '2024-05-26 10:18:31', '2024-05-26 10:18:31'),
(82, NULL, 13, '2024-05-29 07:44:34', '2024-05-29 07:44:34'),
(83, NULL, 11, '2024-05-29 23:39:02', '2024-05-29 23:39:02'),
(84, NULL, 13, '2024-05-29 23:39:16', '2024-05-29 23:39:16'),
(85, NULL, 11, '2024-05-31 08:47:42', '2024-05-31 08:47:42'),
(86, NULL, 13, '2024-05-31 08:49:29', '2024-05-31 08:49:29'),
(87, NULL, 11, '2024-05-31 08:49:37', '2024-05-31 08:49:37'),
(88, NULL, 15, '2024-05-31 08:50:11', '2024-05-31 08:50:11'),
(89, NULL, 3, '2024-05-31 08:55:08', '2024-05-31 08:55:08'),
(90, NULL, 14, '2024-06-01 17:54:51', '2024-06-01 17:54:51');

-- --------------------------------------------------------

--
-- 資料表結構 `user_registration_token`
--

CREATE TABLE `user_registration_token` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT '使用者編號',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '內容',
  `expiration_time` datetime NOT NULL COMMENT '到期時間',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user_registration_token`
--

INSERT INTO `user_registration_token` (`id`, `user_id`, `content`, `expiration_time`, `created_at`, `updated_at`) VALUES
(2, 29, '449c036ed91b1c68ef382d9c1acae4f9f27e462d62e3c7342090194d4f99019a', '2024-06-02 02:19:07', '2024-06-01 18:04:07', '2024-06-01 18:04:07');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_product_product_category_id` (`product_category_id`);

--
-- 資料表索引 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user_interesting_product`
--
ALTER TABLE `user_interesting_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_user_interesting_product_product_id` (`product_id`),
  ADD KEY `foreign_key_user_interesting_product_user_id` (`user_id`);

--
-- 資料表索引 `user_registration_token`
--
ALTER TABLE `user_registration_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_user_registration_token_user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_interesting_product`
--
ALTER TABLE `user_interesting_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_registration_token`
--
ALTER TABLE `user_registration_token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key_product_product_category_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`);

--
-- 資料表的限制式 `user_interesting_product`
--
ALTER TABLE `user_interesting_product`
  ADD CONSTRAINT `foreign_key_user_interesting_product_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `foreign_key_user_interesting_product_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- 資料表的限制式 `user_registration_token`
--
ALTER TABLE `user_registration_token`
  ADD CONSTRAINT `foreign_key_user_registration_token_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
