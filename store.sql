-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 05 月 11 日 23:49
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
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品圖片',
  `remaining_qty` smallint(5) UNSIGNED NOT NULL COMMENT '產品剩餘數量',
  `is_sellable` tinyint(3) UNSIGNED NOT NULL COMMENT '產品可否銷售',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `name`, `price`, `photo`, `remaining_qty`, `is_sellable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ES759', 490, 'images/products/ES759 .gif', 99, 1, '2024-03-02 17:30:21', '2024-04-20 13:44:15', NULL),
(2, 1, 'F0476 ', 590, 'images/products/F0476 .gif', 40, 1, '2024-05-05 16:13:55', '2024-05-05 16:13:55', NULL),
(3, 1, 'F0752 ', 499, 'images/products/F0752 .gif', 14, 1, '2024-05-05 16:58:09', '2024-05-05 16:58:09', NULL),
(4, 1, 'F1714 ', 650, 'images/products/F1714 .gif', 11, 1, '2024-05-05 17:13:19', '2024-05-05 17:13:19', NULL),
(5, 1, 'F2734 ', 479, 'images/products/F2734 .gif', 18, 1, '2024-05-11 10:41:42', '2024-05-11 10:41:42', NULL),
(6, 1, 'F5474 ', 749, 'images/products/F5474 .gif', 10, 1, '2024-05-11 10:44:06', '2024-05-11 10:44:06', NULL),
(7, 1, 'F6472 ', 449, 'images/products/F6472 .gif', 8, 1, '2024-05-11 11:08:28', '2024-05-11 11:08:28', NULL),
(8, 1, 'F9754 ', 590, 'images/products/F9754 .gif', 17, 1, '2024-05-11 11:09:32', '2024-05-11 11:09:32', NULL),
(9, 1, 'FT476 ', 359, 'images/products/FT476 .gif', 14, 1, '2024-05-11 11:10:51', '2024-05-11 11:10:51', NULL),
(10, 1, 'FT499 ', 389, 'images/products/FT499 .gif', 9, 1, '2024-05-11 11:12:40', '2024-05-11 11:12:40', NULL),
(11, 1, 'FT752 ', 389, 'images/products/FT752 .gif', 10, 1, '2024-05-11 11:13:40', '2024-05-11 11:13:40', NULL),
(12, 1, 'P785  ', 389, 'images/products/P785  .gif', 21, 1, '2024-05-11 11:15:05', '2024-05-11 11:15:05', NULL),
(13, 1, 'P789  ', 539, 'images/products/P789  .gif', 28, 1, '2024-05-11 11:15:48', '2024-05-11 11:15:48', NULL),
(14, 1, 'S749  ', 599, 'images/products/S749  .gif', 15, 1, '2024-05-11 11:16:38', '2024-05-11 11:16:38', NULL),
(15, 1, 'S752  ', 629, 'images/products/S752  .gif', 22, 1, '2024-05-11 11:17:32', '2024-05-11 11:17:32', NULL);

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
(1, NULL, 1, '2024-05-11 15:39:34', '2024-05-11 15:39:34'),
(2, NULL, 12, '2024-05-11 15:39:48', '2024-05-11 15:39:48'),
(3, NULL, 12, '2024-05-11 15:40:05', '2024-05-11 15:40:05'),
(4, NULL, 1, '2024-05-11 15:40:14', '2024-05-11 15:40:14'),
(5, NULL, 9, '2024-05-11 15:42:41', '2024-05-11 15:42:41'),
(6, NULL, 11, '2024-05-11 15:43:01', '2024-05-11 15:43:01'),
(7, NULL, 11, '2024-05-11 15:43:22', '2024-05-11 15:43:22'),
(8, NULL, 11, '2024-05-11 15:43:37', '2024-05-11 15:43:37'),
(9, NULL, 1, '2024-05-11 15:43:44', '2024-05-11 15:43:44'),
(10, NULL, 12, '2024-05-11 15:43:46', '2024-05-11 15:43:46'),
(11, NULL, 12, '2024-05-11 15:44:19', '2024-05-11 15:44:19'),
(12, NULL, 1, '2024-05-11 15:44:32', '2024-05-11 15:44:32'),
(13, NULL, 2, '2024-05-11 15:44:34', '2024-05-11 15:44:34'),
(14, NULL, 2, '2024-05-11 15:47:24', '2024-05-11 15:47:24'),
(15, NULL, 4, '2024-05-11 15:48:05', '2024-05-11 15:48:05'),
(16, NULL, 4, '2024-05-11 15:48:13', '2024-05-11 15:48:13'),
(17, NULL, 7, '2024-05-11 15:49:12', '2024-05-11 15:49:12');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
