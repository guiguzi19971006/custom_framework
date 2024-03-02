-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： mysql
-- 產生時間： 2024 年 03 月 02 日 18:22
-- 伺服器版本： 5.7.43
-- PHP 版本： 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `store`
--

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_category_id` int(10) UNSIGNED NOT NULL COMMENT '產品分類編號',
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品名稱',
  `price` mediumint(8) UNSIGNED NOT NULL COMMENT '產品價格',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品圖片',
  `remaining_qty` smallint(5) UNSIGNED NOT NULL COMMENT '產品剩餘數量',
  `is_sellable` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '產品可否銷售',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '建立時間',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最後更新時間',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT '刪除時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`id`, `product_category_id`, `name`, `price`, `photo`, `remaining_qty`, `is_sellable`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ES759', 490, '/public/images/products/ES759 .gif', 99, 'Yes', '2024-03-02 17:30:21', '2024-03-02 17:30:21', NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
