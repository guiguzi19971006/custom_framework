-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 05 月 18 日 00:07
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
  `is_sellable` tinyint(3) UNSIGNED NOT NULL COMMENT '產品可否銷售',
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
-- 資料表結構 `token`
--

CREATE TABLE `token` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_category_id` bigint(20) UNSIGNED NOT NULL COMMENT '權杖分類編號',
  `secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Secret 字串',
  `expired_time` datetime NOT NULL COMMENT '到期時間',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `token_category`
--

CREATE TABLE `token_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名稱',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間	',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 傾印資料表的資料 `token_category`
--

INSERT INTO `token_category` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JWT', '2024-04-28 13:36:16', '2024-04-28 13:36:16', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '電子郵件',
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '密碼',
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '姓名',
  `gender` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '生理性別',
  `birthday` date NOT NULL COMMENT '生日',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '手機號碼',
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '相片',
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '住址',
  `last_login_time` datetime DEFAULT NULL COMMENT '最後登入時間',
  `last_login_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '最後登入 IP 位址',
  `registration_time` datetime NOT NULL COMMENT '註冊時間',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(47, NULL, 11, '2024-05-17 16:05:00', '2024-05-17 16:05:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_product_category_id` (`product_category_id`);

--
-- 資料表索引 `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_token_category_id` (`token_category_id`);

--
-- 資料表索引 `token_category`
--
ALTER TABLE `token_category`
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
  ADD KEY `foreign_key_user_id` (`user_id`),
  ADD KEY `foreign_key_product_id` (`product_id`);

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `token`
--
ALTER TABLE `token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `token_category`
--
ALTER TABLE `token_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_interesting_product`
--
ALTER TABLE `user_interesting_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key_product_category_id` FOREIGN KEY (`product_category_id`) REFERENCES `product_category` (`id`);

--
-- 資料表的限制式 `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `foreign_key_token_category_id` FOREIGN KEY (`token_category_id`) REFERENCES `token_category` (`id`);

--
-- 資料表的限制式 `user_interesting_product`
--
ALTER TABLE `user_interesting_product`
  ADD CONSTRAINT `foreign_key_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `foreign_key_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
