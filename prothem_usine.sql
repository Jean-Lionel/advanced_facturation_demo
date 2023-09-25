-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 05:21 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prothem_usine`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`, `stock_id`) VALUES
(1, 'THE', 'THE', '2022-10-21 02:37:01', '2022-10-21 02:37:01', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_TIN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_customer_payer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `telephone`, `addresse`, `description`, `customer_TIN`, `vat_customer_payer`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '', '2022-11-03 09:08:34', '2022-11-03 09:08:34', NULL),
(2, 'BIZIMANA SALVATOR', '0000', '', '', '', '', '2022-11-03 09:11:12', '2022-11-03 09:11:12', NULL),
(3, 'BIZIMANA SALVATOR', '79614036', 'BUJA', '', '', '', '2022-11-03 09:33:04', '2022-11-03 09:33:04', NULL),
(4, 'TEST 1', '79625825', 'KANYOSHA', '', '', '', '2022-11-03 09:33:50', '2022-11-03 09:33:50', NULL),
(5, 'BURUNDI X', '45222', 'KANYOSHA', '', '', '', '2022-11-03 09:37:10', '2022-11-03 09:55:01', '2022-11-03 09:55:01'),
(6, 'BURUNDI X', '+16452089497', 'KANYOSHA', '', '', '', '2022-11-03 09:39:02', '2022-11-03 09:54:48', '2022-11-03 09:54:48'),
(7, 'BIZIMANA SALVATOR', '0000', 'KANYOSHA', '', '4000129009', '', '2022-11-03 10:00:12', '2022-11-03 10:00:12', NULL),
(8, 'BIZIMANA SALVATOR', '0000', 'KANYOSHA', '', '4000129009', 'on', '2022-11-03 10:34:33', '2022-11-03 10:34:33', NULL),
(9, 'BIZIMANA SALVATOR', '0000', 'KANYOSHA', '', '4000129009', '', '2022-11-03 10:40:53', '2022-11-03 10:40:53', NULL),
(10, 'BIZIMANA SALVATOR', '0000', 'KANYOSHA', '', '4000129009', '', '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(11, 'Quia doloribus labor', '13613881082', 'Incidunt dolor culp', '', '', 'on', '2022-11-14 09:00:55', '2022-11-14 09:00:55', NULL),
(12, 'Nininahazwe Jean', '+14214792186', 'Incidunt dolor culp', '', '', '1', '2022-11-14 09:04:05', '2022-11-14 09:04:05', NULL),
(15, 'NININAHAZWE JEAN LIONEL', '+14214792186', 'Asperiores et est re', '', '', '1', '2022-11-21 11:34:38', '2022-11-21 11:34:38', NULL),
(16, 'Quia doloribus labor', '13613881082', 'Incidunt dolor culp', '', '', '1', '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(17, 'TEST 1', '79625825', 'KANYOSHA', '', '', '0', '2022-11-21 18:16:58', '2022-11-21 18:16:58', NULL),
(20, 'Quia doloribus labor', '13613881082', 'Incidunt dolor culp', '', '', '0', '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(21, 'NININAHAZWE JEAN LIONEL', '+14214792186', 'Asperiores et est re', '', '', '0', '2022-11-21 18:22:19', '2022-11-21 18:22:19', NULL),
(22, 'BIZIMANA SALVATOR', '0000', '', '', '', '0', '2022-11-22 07:02:37', '2022-11-22 07:02:37', NULL),
(23, 'BIZIMANA SALVATOR', '0000', '', '', '', '0', '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(24, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-05 15:38:59', '2022-12-05 15:38:59', NULL),
(25, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-08 15:32:54', '2022-12-08 15:32:54', NULL),
(26, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-08 15:39:54', '2022-12-08 15:39:54', NULL),
(27, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-08 16:21:14', '2022-12-08 16:21:14', NULL),
(28, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-08 16:23:46', '2022-12-08 16:23:46', NULL),
(29, 'BIZIMANA SALVATOR', '+16452089497', 'KANYOSHA', '', '', '0', '2022-12-08 16:37:00', '2022-12-08 16:37:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `depenses`
--

CREATE TABLE `depenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(64,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantite` double(62,2) NOT NULL,
  `quantite_stock` double(62,2) NOT NULL,
  `price_unitaire` double(62,2) NOT NULL,
  `embalage` double(62,2) DEFAULT NULL,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite_mesure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_expiration` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_orders`
--

INSERT INTO `detail_orders` (`id`, `product_id`, `quantite`, `quantite_stock`, `price_unitaire`, `embalage`, `code_product`, `name`, `unite_mesure`, `date_expiration`, `order_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 2.00, 79998.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 1, 1, '2022-11-03 09:08:34', '2022-11-03 09:08:34', NULL),
(2, 4, 2.00, 79998.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 1, 1, '2022-11-03 09:08:34', '2022-11-03 09:08:34', NULL),
(3, 5, 1.00, 79997.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 2, 1, '2022-11-03 09:11:12', '2022-11-03 09:11:12', NULL),
(4, 5, 1000.00, 78997.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 3, 1, '2022-11-03 09:33:04', '2022-11-03 09:33:04', NULL),
(5, 4, 10000.00, 69998.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 3, 1, '2022-11-03 09:33:04', '2022-11-03 09:33:04', NULL),
(6, 5, 1.00, 78996.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 4, 1, '2022-11-03 09:33:50', '2022-11-03 09:33:50', NULL),
(7, 4, 1.00, 69997.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 4, 1, '2022-11-03 09:33:50', '2022-11-03 09:33:50', NULL),
(8, 5, 1.00, 78995.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 5, 1, '2022-11-03 09:37:10', '2022-11-03 09:37:10', NULL),
(9, 5, 1.00, 78994.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 6, 1, '2022-11-03 09:39:02', '2022-11-03 09:39:02', NULL),
(10, 4, 1.00, 69996.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 6, 1, '2022-11-03 09:39:02', '2022-11-03 09:39:02', NULL),
(11, 3, 3000.00, 97002.00, 1016.40, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 7, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(12, 5, 4800.00, 74194.00, 1567.80, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 7, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(13, 2, 2200.00, 77803.00, 2288.14, NULL, 'LOT DE BP1', 'LOT DE BP1', 'KG', '2050-03-04', 7, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(14, 3, 3000.00, 94002.00, 1016.95, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 8, 3, '2022-11-03 10:34:33', '2022-11-03 10:34:33', NULL),
(15, 5, 4800.00, 69394.00, 1567.80, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 8, 3, '2022-11-03 10:34:34', '2022-11-03 10:34:34', NULL),
(16, 2, 2200.00, 75603.00, 2288.14, NULL, 'LOT DE BP1', 'LOT DE BP1', 'KG', '2050-03-04', 8, 3, '2022-11-03 10:34:34', '2022-11-03 10:34:34', NULL),
(17, 3, 3000.00, 91002.00, 1016.95, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 9, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(18, 5, 4800.00, 64594.00, 1567.80, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 9, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(19, 2, 2200.00, 73403.00, 2288.14, NULL, 'LOT DE BP1', 'LOT DE BP1', 'KG', '2050-03-04', 9, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(20, 5, 1000.00, 63594.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 10, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(21, 4, 1120.00, 68876.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 10, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(22, 3, 141.00, 90861.00, 1016.00, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 10, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(23, 5, 1.00, 63593.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 11, 1, '2022-11-14 09:00:55', '2022-11-14 09:00:55', NULL),
(24, 4, 1.00, 68875.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 11, 1, '2022-11-14 09:00:55', '2022-11-14 09:00:55', NULL),
(25, 5, 1.00, 63592.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 12, 1, '2022-11-14 09:04:05', '2022-11-14 09:04:05', NULL),
(26, 5, 1.00, 63591.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 13, 1, '2022-11-21 11:34:38', '2022-11-21 11:34:38', NULL),
(27, 4, 1.00, 68874.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 13, 1, '2022-11-21 11:34:38', '2022-11-21 11:34:38', NULL),
(28, 5, 1.00, 63590.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 14, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(29, 4, 1.00, 68873.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 14, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(30, 3, 1.00, 90860.00, 1016.00, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 14, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(31, 5, 45.00, 63545.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 15, 1, '2022-11-21 18:16:58', '2022-11-21 18:16:58', NULL),
(32, 4, 60.00, 68813.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 15, 1, '2022-11-21 18:16:58', '2022-11-21 18:16:58', NULL),
(39, 5, 1.00, 63544.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 18, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(40, 4, 1.00, 68812.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 18, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(41, 2, 1.00, 73402.00, 2542.00, NULL, 'LOT DE BP1', 'LOT DE BP1', 'KG', '2050-03-04', 18, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(42, 5, 1.00, 63543.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 19, 1, '2022-11-21 18:22:19', '2022-11-21 18:22:19', NULL),
(43, 4, 1.00, 68811.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 19, 1, '2022-11-21 18:22:19', '2022-11-21 18:22:19', NULL),
(44, 5, 100.00, 63443.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 20, 1, '2022-11-22 07:02:37', '2022-11-22 07:02:37', NULL),
(45, 4, 100.00, 68711.00, 1694.00, NULL, 'LOT DE D1', 'LOT DE D1', 'KG', '2050-10-21', 20, 1, '2022-11-22 07:02:37', '2022-11-22 07:02:37', NULL),
(46, 5, 10.00, 63433.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 21, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(47, 3, 10.00, 90850.00, 1016.00, NULL, 'Lot de F1', 'Lot de F1', 'KG', '1975-01-24', 21, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(48, 2, 10.00, 73392.00, 2542.00, NULL, 'LOT DE BP1', 'LOT DE BP1', 'KG', '2050-03-04', 21, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(49, 5, 63433.00, 0.00, 2288.00, NULL, 'LOT DE PF1', 'LOT DE PF1', 'KG', '2050-10-21', 22, 1, '2022-12-05 15:38:59', '2022-12-05 15:38:59', NULL),
(50, 1, 5600.00, 794432.00, 1694.00, NULL, 'LOT DE PD', 'LOT DE PD', 'KG', '2050-03-02', 23, 1, '2022-12-08 15:32:54', '2022-12-08 15:32:54', NULL),
(51, 1, 1.00, 794431.00, 1694.00, NULL, 'LOT DE PD', 'LOT DE PD', 'KG', '2050-03-02', 24, 1, '2022-12-08 15:39:54', '2022-12-08 15:39:54', NULL),
(52, 1, 5600.00, 788831.00, 1694.92, NULL, 'LOT DE PD', 'LOT DE PD', 'KG', '2050-03-02', 25, 1, '2022-12-08 16:21:14', '2022-12-08 16:21:14', NULL),
(53, 1, 5600.00, 783231.00, 1694.92, NULL, 'LOT DE PD', 'LOT DE PD', 'KG', '2050-03-02', 26, 1, '2022-12-08 16:23:46', '2022-12-08 16:23:46', NULL),
(54, 1, 5600.00, 777631.00, 1694.92, NULL, 'LOT DE PD', 'LOT DE PD', 'KG', '2050-03-02', 27, 1, '2022-12-08 16:37:00', '2022-12-08 16:37:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_paiment_dettes`
--

CREATE TABLE `detail_paiment_dettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paiement_dette_id` bigint(20) UNSIGNED NOT NULL,
  `montant` double(64,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_TIN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_trade_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_postal_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_privonce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_commune` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_address_quartier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_avenue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_rue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ct_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tl_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_fiscal_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_activity_sector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_legal_form` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `tp_name`, `tp_type`, `tp_TIN`, `tp_trade_number`, `tp_postal_number`, `tp_phone_number`, `tp_address_privonce`, `tp_address_commune`, `tp_address_quartier`, `tp_address_avenue`, `tp_address_rue`, `tp_address_number`, `vat_taxpayer`, `ct_taxpayer`, `tl_taxpayer`, `tp_fiscal_center`, `tp_activity_sector`, `tp_legal_form`, `payment_type`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PROTHEM-USINE', '2', '4000004806', '64503', '176', '+257 22 22 07 80', ' BUJUMBURA-MAIRIE', 'MUKAZA', 'Rohero II', 'BLV DE L\'UPRONA', 'BLV DE L\'UPRONA', '97', '1', '0', '0', 'DGC', 'INDUSTRIEL', 'SA', '2', 1, '2022-11-03 09:17:39', '2022-11-03 09:17:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entreprise_histories`
--

CREATE TABLE `entreprise_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_TIN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tp_trade_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_postal_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_privonce` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_commune` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_quartier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_avenue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_rue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_address_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ct_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tl_taxpayer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_fiscal_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_activity_sector` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tp_legal_form` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_products`
--

CREATE TABLE `follow_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `follow_products`
--

INSERT INTO `follow_products` (`id`, `action`, `quantite`, `details`, `product_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ENTRE', '8000000', '{\"id\":3,\"code_product\":\"Architecto qui volup\",\"name\":\"Wilma Mcguire\",\"marque\":\"Consequatur Cumque\",\"unite_mesure\":\"Sint et laboriosam\",\"quantite\":8000015,\"quantite_alert\":49,\"price\":965,\"price_max\":224,\"price_min\":848,\"date_expiration\":\"1975-01-24\",\"description\":\"Est dolor non dolore\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T04:38:55.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 04:39:14', '2022-10-21 04:39:14', NULL),
(2, 'VENTE', '1', '{\"id\":3,\"code_product\":\"Architecto qui volup\",\"name\":\"Wilma Mcguire\",\"marque\":\"Consequatur Cumque\",\"unite_mesure\":\"Sint et laboriosam\",\"quantite\":8000014,\"quantite_alert\":49,\"price\":965,\"price_max\":224,\"price_min\":848,\"date_expiration\":\"1975-01-24\",\"description\":\"Est dolor non dolore\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T04:47:07.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 04:47:07', '2022-10-21 04:47:07', NULL),
(3, 'VENTE', '1', '{\"id\":2,\"code_product\":\"Perspiciatis eos qu\",\"name\":\"Dakota Mccoy\",\"marque\":\"Autem veritatis dese\",\"unite_mesure\":\"Consectetur impedit\",\"quantite\":5,\"quantite_alert\":35,\"price\":981,\"price_max\":804,\"price_min\":232,\"date_expiration\":\"1977-03-04\",\"description\":\"Obcaecati assumenda\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-21T04:47:07.000000Z\",\"deleted_at\":null}', 2, 1, '2022-10-21 04:47:07', '2022-10-21 04:47:07', NULL),
(4, 'VENTE', '1', '{\"id\":1,\"code_product\":\"Optio dolorum eu as\",\"name\":\"Ora West\",\"marque\":\"Aut quisquam consect\",\"unite_mesure\":\"Ullam ut proident c\",\"quantite\":39,\"quantite_alert\":68,\"price\":120,\"price_max\":817,\"price_min\":38,\"date_expiration\":\"2018-03-02\",\"description\":\"Duis voluptatem et\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-21T04:47:07.000000Z\",\"deleted_at\":null}', 1, 1, '2022-10-21 04:47:07', '2022-10-21 04:47:07', NULL),
(5, 'VENTE', '1', '{\"id\":2,\"code_product\":\"Perspiciatis eos qu\",\"name\":\"Dakota Mccoy\",\"marque\":\"Autem veritatis dese\",\"unite_mesure\":\"Consectetur impedit\",\"quantite\":4,\"quantite_alert\":35,\"price\":981,\"price_max\":804,\"price_min\":232,\"date_expiration\":\"1977-03-04\",\"description\":\"Obcaecati assumenda\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-21T04:52:32.000000Z\",\"deleted_at\":null}', 2, 1, '2022-10-21 04:52:32', '2022-10-21 04:52:32', NULL),
(6, 'VENTE', '1', '{\"id\":1,\"code_product\":\"Optio dolorum eu as\",\"name\":\"Ora West\",\"marque\":\"Aut quisquam consect\",\"unite_mesure\":\"Ullam ut proident c\",\"quantite\":38,\"quantite_alert\":68,\"price\":120,\"price_max\":817,\"price_min\":38,\"date_expiration\":\"2018-03-02\",\"description\":\"Duis voluptatem et\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-21T04:52:32.000000Z\",\"deleted_at\":null}', 1, 1, '2022-10-21 04:52:32', '2022-10-21 04:52:32', NULL),
(7, 'VENTE', '1', '{\"id\":3,\"code_product\":\"Architecto qui volup\",\"name\":\"Wilma Mcguire\",\"marque\":\"Consequatur Cumque\",\"unite_mesure\":\"Sint et laboriosam\",\"quantite\":8000013,\"quantite_alert\":49,\"price\":965,\"price_max\":224,\"price_min\":848,\"date_expiration\":\"1975-01-24\",\"description\":\"Est dolor non dolore\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T04:52:32.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 04:52:32', '2022-10-21 04:52:32', NULL),
(8, 'VENTE', '1', '{\"id\":2,\"code_product\":\"Perspiciatis eos qu\",\"name\":\"BONJOUR\",\"marque\":\"Autem veritatis dese\",\"unite_mesure\":\"Consectetur impedit\",\"quantite\":3,\"quantite_alert\":35,\"price\":981,\"price_max\":20,\"price_min\":120,\"date_expiration\":\"1977-03-04\",\"description\":\"Obcaecati assumenda\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-21T09:09:19.000000Z\",\"deleted_at\":null}', 2, 1, '2022-10-21 09:09:19', '2022-10-21 09:09:19', NULL),
(9, 'VENTE', '30', '{\"id\":1,\"code_product\":\"Optio dolorum eu as\",\"name\":\"Ora West\",\"marque\":\"Aut quisquam consect\",\"unite_mesure\":\"Ullam ut proident c\",\"quantite\":8,\"quantite_alert\":68,\"price\":120,\"price_max\":817,\"price_min\":38,\"date_expiration\":\"2018-03-02\",\"description\":\"Duis voluptatem et\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-21T09:09:19.000000Z\",\"deleted_at\":null}', 1, 1, '2022-10-21 09:09:19', '2022-10-21 09:09:19', NULL),
(10, 'VENTE', '1', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":99999,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T09:28:11.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 09:28:11', '2022-10-21 09:28:11', NULL),
(11, 'VENTE', '2400', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77600,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T09:42:27.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 09:42:27', '2022-10-21 09:42:27', NULL),
(12, 'VENTE', '3000', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77000,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:38:30.000000Z\",\"updated_at\":\"2022-10-21T09:42:27.000000Z\",\"deleted_at\":null}', 4, 1, '2022-10-21 09:42:27', '2022-10-21 09:42:27', NULL),
(13, 'VENTE', '7000', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":92999,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T09:42:27.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 09:42:27', '2022-10-21 09:42:27', NULL),
(14, 'VENTE', '2200', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77800,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"1977-03-04\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-21T09:42:27.000000Z\",\"deleted_at\":null}', 2, 1, '2022-10-21 09:42:27', '2022-10-21 09:42:27', NULL),
(15, 'VENTE', '2800', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":797200,\"quantite_alert\":68,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-21T09:42:27.000000Z\",\"deleted_at\":null}', 1, 1, '2022-10-21 09:42:27', '2022-10-21 09:42:27', NULL),
(16, 'VENTE', '5000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":72600,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T09:49:33.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 09:49:33', '2022-10-21 09:49:33', NULL),
(17, 'VENTE', '5200', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":71800,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:38:30.000000Z\",\"updated_at\":\"2022-10-21T09:49:33.000000Z\",\"deleted_at\":null}', 4, 1, '2022-10-21 09:49:33', '2022-10-21 09:49:33', NULL),
(18, 'VENTE', '52', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":92947,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T09:49:33.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 09:49:34', '2022-10-21 09:49:34', NULL),
(19, 'VENTE', '85', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77715,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"1977-03-04\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-21T09:49:33.000000Z\",\"deleted_at\":null}', 2, 1, '2022-10-21 09:49:34', '2022-10-21 09:49:34', NULL),
(20, 'VENTE', '45', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":797155,\"quantite_alert\":68,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-21T09:49:33.000000Z\",\"deleted_at\":null}', 1, 1, '2022-10-21 09:49:34', '2022-10-21 09:49:34', NULL),
(21, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":72599,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T10:08:20.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 10:08:20', '2022-10-21 10:08:20', NULL),
(22, 'VENTE', '1', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":92946,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-21T10:09:18.000000Z\",\"deleted_at\":null}', 3, 1, '2022-10-21 10:09:18', '2022-10-21 10:09:18', NULL),
(23, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":72598,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T10:09:18.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 10:09:18', '2022-10-21 10:09:18', NULL),
(24, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":72597,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T10:11:38.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 10:11:38', '2022-10-21 10:11:38', NULL),
(25, 'VENTE', '1500', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":71097,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-21T10:15:03.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-21 10:15:03', '2022-10-21 10:15:03', NULL),
(26, 'VENTE', '8000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63097,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-24T08:54:29.000000Z\",\"deleted_at\":null}', 5, 1, '2022-10-24 08:54:29', '2022-10-24 08:54:29', NULL),
(27, 'VENTE', '1200', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":70600,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T09:38:30.000000Z\",\"updated_at\":\"2022-10-24T08:54:29.000000Z\",\"deleted_at\":null}', 4, 1, '2022-10-24 08:54:29', '2022-10-24 08:54:29', NULL),
(28, 'VENTE', '5000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":58097,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-24T08:56:51.000000Z\",\"deleted_at\":null}', 5, 2, '2022-10-24 08:56:51', '2022-10-24 08:56:51', NULL),
(29, 'VENTE', '200', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":70400,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T09:38:30.000000Z\",\"updated_at\":\"2022-10-24T08:56:51.000000Z\",\"deleted_at\":null}', 4, 2, '2022-10-24 08:56:51', '2022-10-24 08:56:51', NULL),
(30, 'VENTE', '200', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":92746,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-24T08:56:51.000000Z\",\"deleted_at\":null}', 3, 2, '2022-10-24 08:56:51', '2022-10-24 08:56:51', NULL),
(31, 'VENTE', '100', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":57997,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":5,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-25T10:17:05.000000Z\",\"deleted_at\":null}', 5, 5, '2022-10-25 10:17:05', '2022-10-25 10:17:05', NULL),
(32, 'VENTE', '1000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":56997,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T09:39:24.000000Z\",\"updated_at\":\"2022-10-27T07:28:59.000000Z\",\"deleted_at\":null}', 5, 2, '2022-10-27 07:28:59', '2022-10-27 07:28:59', NULL),
(33, 'VENTE', '11200', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":59200,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T09:38:30.000000Z\",\"updated_at\":\"2022-10-27T07:28:59.000000Z\",\"deleted_at\":null}', 4, 2, '2022-10-27 07:28:59', '2022-10-27 07:28:59', NULL),
(34, 'VENTE', '150', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77565,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"1977-03-04\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:52.000000Z\",\"updated_at\":\"2022-10-27T07:28:59.000000Z\",\"deleted_at\":null}', 2, 2, '2022-10-27 07:28:59', '2022-10-27 07:28:59', NULL),
(35, 'VENTE', '130', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":797025,\"quantite_alert\":68,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:48.000000Z\",\"updated_at\":\"2022-10-27T07:28:59.000000Z\",\"deleted_at\":null}', 1, 2, '2022-10-27 07:28:59', '2022-10-27 07:28:59', NULL),
(36, 'VENTE', '300', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":92446,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T04:38:55.000000Z\",\"updated_at\":\"2022-10-27T07:28:59.000000Z\",\"deleted_at\":null}', 3, 2, '2022-10-27 07:28:59', '2022-10-27 07:28:59', NULL),
(37, 'VENTE', '2', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":79998,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:08:34.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:08:34', '2022-11-03 09:08:34', NULL),
(38, 'VENTE', '2', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":79998,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-03T09:08:34.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-03 09:08:35', '2022-11-03 09:08:35', NULL),
(39, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":79997,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:11:12.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:11:12', '2022-11-03 09:11:12', NULL),
(40, 'VENTE', '1000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":78997,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:33:04.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:33:04', '2022-11-03 09:33:04', NULL),
(41, 'VENTE', '10000', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":69998,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-03T09:33:04.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-03 09:33:04', '2022-11-03 09:33:04', NULL),
(42, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":78996,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:33:50.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:33:50', '2022-11-03 09:33:50', NULL),
(43, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":69997,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-03T09:33:50.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-03 09:33:50', '2022-11-03 09:33:50', NULL),
(44, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":78995,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:37:10.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:37:10', '2022-11-03 09:37:10', NULL),
(45, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":78994,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T09:39:02.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-03 09:39:02', '2022-11-03 09:39:02', NULL),
(46, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":69996,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-03T09:39:02.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-03 09:39:02', '2022-11-03 09:39:02', NULL),
(47, 'VENTE', '3000', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":97002,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-11-03T10:00:12.000000Z\",\"deleted_at\":null}', 3, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(48, 'VENTE', '4800', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":74194,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T10:00:12.000000Z\",\"deleted_at\":null}', 5, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(49, 'VENTE', '2200', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":77803,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"2050-03-04\",\"description\":\"THE SEC\",\"user_id\":2,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:52.000000Z\",\"updated_at\":\"2022-11-03T10:00:12.000000Z\",\"deleted_at\":null}', 2, 2, '2022-11-03 10:00:13', '2022-11-03 10:00:13', NULL),
(50, 'VENTE', '3000', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":94002,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-11-03T10:34:33.000000Z\",\"deleted_at\":null}', 3, 3, '2022-11-03 10:34:34', '2022-11-03 10:34:34', NULL),
(51, 'VENTE', '4800', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":69394,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T10:34:33.000000Z\",\"deleted_at\":null}', 5, 3, '2022-11-03 10:34:34', '2022-11-03 10:34:34', NULL),
(52, 'VENTE', '2200', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":75603,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"2050-03-04\",\"description\":\"THE SEC\",\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:52.000000Z\",\"updated_at\":\"2022-11-03T10:34:33.000000Z\",\"deleted_at\":null}', 2, 3, '2022-11-03 10:34:34', '2022-11-03 10:34:34', NULL),
(53, 'VENTE', '3000', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":91002,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-11-03T10:40:53.000000Z\",\"deleted_at\":null}', 3, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(54, 'VENTE', '4800', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":64594,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T10:40:53.000000Z\",\"deleted_at\":null}', 5, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(55, 'VENTE', '2200', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":73403,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"2050-03-04\",\"description\":\"THE SEC\",\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:52.000000Z\",\"updated_at\":\"2022-11-03T10:40:53.000000Z\",\"deleted_at\":null}', 2, 3, '2022-11-03 10:40:54', '2022-11-03 10:40:54', NULL),
(56, 'VENTE', '1000', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63594,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-03T10:53:25.000000Z\",\"deleted_at\":null}', 5, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(57, 'VENTE', '1120', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68876,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-03T10:53:25.000000Z\",\"deleted_at\":null}', 4, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(58, 'VENTE', '141', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":90861,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":3,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-11-03T10:53:25.000000Z\",\"deleted_at\":null}', 3, 3, '2022-11-03 10:53:25', '2022-11-03 10:53:25', NULL),
(59, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63593,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-14T09:00:55.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-14 09:00:55', '2022-11-14 09:00:55', NULL),
(60, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68875,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-14T09:00:55.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-14 09:00:55', '2022-11-14 09:00:55', NULL),
(61, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63592,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-14T09:04:05.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-14 09:04:05', '2022-11-14 09:04:05', NULL),
(62, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63591,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-21T11:34:38.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-21 11:34:38', '2022-11-21 11:34:38', NULL),
(63, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68874,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-21T11:34:38.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-21 11:34:38', '2022-11-21 11:34:38', NULL),
(64, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63590,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-21T18:05:51.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(65, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68873,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-21T18:05:51.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(66, 'VENTE', '1', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":90860,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-11-21T18:05:51.000000Z\",\"deleted_at\":null}', 3, 1, '2022-11-21 18:05:51', '2022-11-21 18:05:51', NULL),
(67, 'VENTE', '45', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63545,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-21T18:16:58.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-21 18:16:58', '2022-11-21 18:16:58', NULL),
(68, 'VENTE', '60', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68813,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-21T18:16:58.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-21 18:16:58', '2022-11-21 18:16:58', NULL),
(75, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63544,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-21T18:20:53.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(76, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68812,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-21T18:20:53.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(77, 'VENTE', '1', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":73402,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"2050-03-04\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:52.000000Z\",\"updated_at\":\"2022-11-21T18:20:53.000000Z\",\"deleted_at\":null}', 2, 1, '2022-11-21 18:20:53', '2022-11-21 18:20:53', NULL),
(78, 'VENTE', '1', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63543,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-21T18:22:19.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-21 18:22:19', '2022-11-21 18:22:19', NULL),
(79, 'VENTE', '1', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68811,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-21T18:22:19.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-21 18:22:19', '2022-11-21 18:22:19', NULL),
(80, 'VENTE', '100', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63443,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-11-22T07:02:37.000000Z\",\"deleted_at\":null}', 5, 1, '2022-11-22 07:02:37', '2022-11-22 07:02:37', NULL),
(81, 'VENTE', '100', '{\"id\":4,\"code_product\":\"LOT DE D1\",\"name\":\"LOT DE D1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":68711,\"quantite_alert\":50,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:38:30.000000Z\",\"updated_at\":\"2022-11-22T07:02:37.000000Z\",\"deleted_at\":null}', 4, 1, '2022-11-22 07:02:37', '2022-11-22 07:02:37', NULL),
(82, 'VENTE', '10', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":63433,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-12-05T15:37:14.000000Z\",\"deleted_at\":null}', 5, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(83, 'VENTE', '10', '{\"id\":3,\"code_product\":\"Lot de F1\",\"name\":\"Lot de F1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":90850,\"quantite_alert\":10,\"price\":1016,\"price_max\":1016,\"price_min\":1016,\"date_expiration\":\"1975-01-24\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:55.000000Z\",\"updated_at\":\"2022-12-05T15:37:14.000000Z\",\"deleted_at\":null}', 3, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(84, 'VENTE', '10', '{\"id\":2,\"code_product\":\"LOT DE BP1\",\"name\":\"LOT DE BP1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":73392,\"quantite_alert\":10,\"price\":2542,\"price_max\":2542,\"price_min\":2542,\"date_expiration\":\"2050-03-04\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:52.000000Z\",\"updated_at\":\"2022-12-05T15:37:14.000000Z\",\"deleted_at\":null}', 2, 1, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL),
(85, 'VENTE', '63433', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":0,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-12-05T15:38:59.000000Z\",\"deleted_at\":null}', 5, 1, '2022-12-05 15:38:59', '2022-12-05 15:38:59', NULL),
(86, 'ENTRE', '500', '{\"id\":5,\"code_product\":\"LOT DE PF1\",\"name\":\"LOT DE PF1\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":500,\"quantite_alert\":100,\"price\":2288,\"price_max\":2288,\"price_min\":2288,\"date_expiration\":\"2050-10-21\",\"description\":null,\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T07:39:24.000000Z\",\"updated_at\":\"2022-12-05T15:38:59.000000Z\",\"deleted_at\":null}', 5, 1, '2022-12-05 15:40:46', '2022-12-05 15:40:46', NULL),
(87, 'VENTE', '5600', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":794432,\"quantite_alert\":68,\"price\":1694,\"price_max\":1694,\"price_min\":1694,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:48.000000Z\",\"updated_at\":\"2022-12-08T15:32:54.000000Z\",\"deleted_at\":null}', 1, 1, '2022-12-08 15:32:54', '2022-12-08 15:32:54', NULL),
(88, 'VENTE', '1', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":794431,\"quantite_alert\":68,\"price\":1694,\"price_max\":1694,\"price_min\":1694.92,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:48.000000Z\",\"updated_at\":\"2022-12-08T15:39:54.000000Z\",\"deleted_at\":null}', 1, 1, '2022-12-08 15:39:54', '2022-12-08 15:39:54', NULL),
(89, 'VENTE', '5600', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":788831,\"quantite_alert\":68,\"price\":1694.92,\"price_max\":1694.92,\"price_min\":1694.92,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:48.000000Z\",\"updated_at\":\"2022-12-08T16:21:14.000000Z\",\"deleted_at\":null}', 1, 1, '2022-12-08 16:21:14', '2022-12-08 16:21:14', NULL),
(90, 'VENTE', '5600', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":783231,\"quantite_alert\":68,\"price\":1694.92,\"price_max\":1694.92,\"price_min\":1694.92,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:48.000000Z\",\"updated_at\":\"2022-12-08T16:23:46.000000Z\",\"deleted_at\":null}', 1, 1, '2022-12-08 16:23:46', '2022-12-08 16:23:46', NULL),
(91, 'VENTE', '5600', '{\"id\":1,\"code_product\":\"LOT DE PD\",\"name\":\"LOT DE PD\",\"marque\":\"THE SEC\",\"unite_mesure\":\"KG\",\"quantite\":777631,\"quantite_alert\":68,\"price\":1694.92,\"price_max\":1694.92,\"price_min\":1694.92,\"date_expiration\":\"2050-03-02\",\"description\":\"THE SEC\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2022-10-21T02:38:48.000000Z\",\"updated_at\":\"2022-12-08T16:37:00.000000Z\",\"deleted_at\":null}', 1, 1, '2022-12-08 16:37:00', '2022-12-08 16:37:00', NULL);

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
(85, '2014_10_12_000000_create_users_table', 1),
(86, '2014_10_12_100000_create_password_resets_table', 1),
(87, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(88, '2019_08_19_000000_create_failed_jobs_table', 1),
(89, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(90, '2020_05_21_100000_create_teams_table', 1),
(91, '2020_05_21_200000_create_team_user_table', 1),
(92, '2020_11_24_051629_stockes', 1),
(93, '2020_11_25_030235_create_sessions_table', 1),
(94, '2020_11_25_045137_create_categories_table', 1),
(95, '2020_11_25_045154_create_products_table', 1),
(96, '2020_11_26_052858_create_clients_table', 1),
(97, '2020_11_27_045033_create_orders_table', 1),
(98, '2020_11_29_060103_create_detail_orders_table', 1),
(99, '2020_12_04_083706_create_depenses_table', 1),
(100, '2020_12_06_043719_create_follow_products_table', 1),
(101, '2020_12_09_043956_create_roles_table', 1),
(102, '2020_12_09_044905_create_role_users_table', 1),
(103, '2020_12_27_101655_create_paiement_dettes_table', 1),
(104, '2020_12_27_145440_create_detail_paiment_dettes_table', 1),
(105, '2021_03_25_043343_create_services_table', 1),
(106, '2022_10_21_061625_create_entreprises_table', 1),
(107, '2022_10_21_062333_create_entreprise_histories_table', 1),
(108, '2022_10_21_062724_create_product_histories_table', 1),
(115, '2014_10_12_000000_create_users_table', 1),
(116, '2014_10_12_100000_create_password_resets_table', 1),
(117, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(118, '2019_08_19_000000_create_failed_jobs_table', 1),
(119, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(120, '2020_05_21_100000_create_teams_table', 1),
(121, '2020_05_21_200000_create_team_user_table', 1),
(122, '2020_11_24_051629_stockes', 1),
(123, '2020_11_25_030235_create_sessions_table', 1),
(124, '2020_11_25_045137_create_categories_table', 1),
(125, '2020_11_25_045154_create_products_table', 1),
(126, '2020_11_26_052858_create_clients_table', 1),
(127, '2020_11_27_045033_create_orders_table', 1),
(128, '2020_11_29_060103_create_detail_orders_table', 1),
(129, '2020_12_04_083706_create_depenses_table', 1),
(130, '2020_12_06_043719_create_follow_products_table', 1),
(131, '2020_12_09_043956_create_roles_table', 1),
(132, '2020_12_09_044905_create_role_users_table', 1),
(133, '2020_12_27_101655_create_paiement_dettes_table', 1),
(134, '2020_12_27_145440_create_detail_paiment_dettes_table', 1),
(135, '2021_03_25_043343_create_services_table', 1),
(136, '2022_10_21_061625_create_entreprises_table', 1),
(137, '2022_10_21_062333_create_entreprise_histories_table', 1),
(138, '2022_10_21_062724_create_product_histories_table', 1),
(139, '2022_10_23_051420_create_obr_declarations_table', 1),
(140, '2022_10_23_051526_create_obr_pointers_table', 1),
(141, '2022_10_23_052309_add_is_sended_to_obr_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obr_declarations`
--

CREATE TABLE `obr_declarations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obr_pointers`
--

CREATE TABLE `obr_pointers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `obr_pointers`
--

INSERT INTO `obr_pointers` (`id`, `order_id`, `invoice_signature`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, '4000004806//20221103000000/000002', '1', '2022-11-03 09:31:13', '2022-11-03 09:31:13', NULL),
(2, 1, '4000004806//20221103000000/000001', '1', '2022-11-03 09:31:21', '2022-11-03 09:31:21', NULL),
(3, 4, '4000004806//20221103000000/000004', '1', '2022-11-03 09:34:12', '2022-11-03 09:34:12', NULL),
(4, 3, '4000004806//20221103000000/000003', '1', '2022-11-03 09:35:26', '2022-11-03 09:35:26', NULL),
(5, 6, '4000004806/ws400000480600270/20221103000000/000006', '1', '2022-11-03 09:40:32', '2022-11-03 09:40:32', NULL),
(6, 5, '4000004806/ws400000480600270/20221103000000/000005', '1', '2022-11-03 09:40:39', '2022-11-03 09:40:39', NULL),
(7, 7, '4000004806/ws400000480600270/20221103000000/000007', '1', '2022-11-03 10:04:01', '2022-11-03 10:04:01', NULL),
(8, 9, '4000004806/ws400000480600270/20190809000000/000009', '1', '2022-11-03 10:41:12', '2022-11-03 10:41:12', NULL),
(9, 10, '4000004806/ws400000480600270/20221103000000/000010', '1', '2022-11-03 10:54:18', '2022-11-03 10:54:18', NULL),
(10, 12, '4000004806/ws400000480600270/20221114110405/000012', '1', '2022-11-14 09:04:31', '2022-11-14 09:04:31', NULL),
(11, 15, '4000004806/ws400000480600270/20221121201658/000015', '1', '2022-11-21 18:17:16', '2022-11-21 18:17:16', NULL),
(12, 19, '4000004806/ws400000480600270/20221121202219/000019', '1', '2022-11-21 18:25:39', '2022-11-21 18:25:39', NULL),
(13, 20, '4000004806/ws400000480600270/20221122090237/000020', '1', '2022-11-22 07:02:44', '2022-11-22 07:02:44', NULL),
(14, 23, '4000004806/wsl400000480600187/20221208173254/000023', '1', '2022-12-08 15:32:58', '2022-12-08 15:32:58', NULL),
(15, 24, '4000004806/wsl400000480600187/20221208173954/000024', '1', '2022-12-08 15:40:03', '2022-12-08 15:40:03', NULL),
(16, 25, '4000004806/ws400000480600270/20221208182114/000025', '1', '2022-12-08 16:21:16', '2022-12-08 16:21:16', NULL),
(17, 26, '4000004806/ws400000480600270/20221208182346/000026', '1', '2022-12-08 16:23:48', '2022-12-08 16:23:48', NULL),
(18, 27, '4000004806/ws400000480600270/20221208183700/000027', '1', '2022-12-08 16:37:04', '2022-12-08 16:37:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double(60,2) NOT NULL,
  `tax` double(60,2) NOT NULL,
  `total_quantity` double(60,2) NOT NULL,
  `total_sacs` double(60,2) NOT NULL,
  `amount_tax` double(60,2) NOT NULL,
  `type_paiement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addresse_client` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `envoye_obr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `envoye_par` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `envoye_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_facturation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `amount`, `tax`, `total_quantity`, `total_sacs`, `amount_tax`, `type_paiement`, `products`, `client`, `addresse_client`, `user_id`, `client_id`, `is_cancelled`, `created_at`, `updated_at`, `deleted_at`, `envoye_obr`, `envoye_par`, `envoye_time`, `invoice_signature`, `date_facturation`) VALUES
(1, 9397.52, 1433.52, 4.00, 0.08, 7964.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:1:\"2\";s:10:\"nombre_sac\";d:0.04;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:4576;s:3:\"vat\";d:823.68;s:15:\"item_price_wvat\";d:5399.68;s:17:\"item_total_amount\";d:5399.68;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";s:1:\"2\";s:10:\"nombre_sac\";d:0.04;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:3388;s:3:\"vat\";d:609.84;s:15:\"item_price_wvat\";d:3997.84;s:17:\"item_total_amount\";d:3997.84;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:08:34.000000Z\",\"created_at\":\"2022-11-03T09:08:34.000000Z\",\"id\":1}', 'KANYOSHA', 1, NULL, 1, '2022-11-03 09:08:34', '2022-11-21 18:37:34', NULL, '1', '1', '2022-11-03 11:31:21', '4000004806//20221103000000/000001', '2022-11-03'),
(2, 2699.84, 411.84, 1.00, 0.02, 2288.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:11:12.000000Z\",\"created_at\":\"2022-11-03T09:11:12.000000Z\",\"id\":2}', NULL, 1, NULL, 1, '2022-11-03 09:11:12', '2022-11-21 18:37:38', NULL, '1', '1', '2022-11-03 11:31:13', '4000004806//20221103000000/000002', '2022-11-03'),
(3, 22689040.00, 3461040.00, 11000.00, 220.00, 19228000.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:4:\"1000\";s:10:\"nombre_sac\";i:20;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288000;s:3:\"vat\";d:411840;s:15:\"item_price_wvat\";d:2699840;s:17:\"item_total_amount\";d:2699840;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";s:5:\"10000\";s:10:\"nombre_sac\";i:200;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:16940000;s:3:\"vat\";d:3049200;s:15:\"item_price_wvat\";d:19989200;s:17:\"item_total_amount\";d:19989200;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"79614036\",\"description\":\"\",\"addresse\":\"BUJA\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:33:04.000000Z\",\"created_at\":\"2022-11-03T09:33:04.000000Z\",\"id\":3}', 'BUJA', 1, NULL, 1, '2022-11-03 09:33:04', '2022-11-21 18:37:42', NULL, '1', '1', '2022-11-03 11:35:26', '4000004806//20221103000000/000003', '2022-11-03'),
(4, 4698.76, 716.76, 2.00, 0.04, 3982.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"TEST 1\",\"telephone\":\"79625825\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:33:50.000000Z\",\"created_at\":\"2022-11-03T09:33:50.000000Z\",\"id\":4}', 'KANYOSHA', 1, NULL, 1, '2022-11-03 09:33:50', '2022-11-21 18:37:44', NULL, '1', '1', '2022-11-03 11:34:12', '4000004806//20221103000000/000004', '2022-11-03'),
(5, 2699.84, 411.84, 1.00, 0.02, 2288.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}}', '{\"name\":\"BURUNDI X\",\"telephone\":\"45222\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:37:10.000000Z\",\"created_at\":\"2022-11-03T09:37:10.000000Z\",\"id\":5}', 'KANYOSHA', 1, NULL, 1, '2022-11-03 09:37:10', '2022-11-21 18:37:48', NULL, '1', '1', '2022-11-03 11:40:39', '4000004806/ws400000480600270/20221103000000/000005', '2022-11-03'),
(6, 4698.76, 716.76, 2.00, 0.04, 3982.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"BURUNDI X\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T09:39:02.000000Z\",\"created_at\":\"2022-11-03T09:39:02.000000Z\",\"id\":6}', 'KANYOSHA', 1, NULL, 1, '2022-11-03 09:39:02', '2022-11-03 09:47:24', NULL, '1', '1', '2022-11-03 11:40:32', '4000004806/ws400000480600270/20221103000000/000006', '2022-11-03'),
(7, 18418072.00, 2809524.00, 10000.00, 200.00, 15608548.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";s:6:\"1016.4\";s:8:\"quantite\";s:4:\"3000\";s:10:\"nombre_sac\";i:60;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:3049200;s:3:\"vat\";d:548856;s:15:\"item_price_wvat\";d:3598056;s:17:\"item_total_amount\";d:3598056;}i:1;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";s:7:\"1567.80\";s:8:\"quantite\";s:4:\"4800\";s:10:\"nombre_sac\";i:96;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:7525440;s:3:\"vat\";d:1354579.2;s:15:\"item_price_wvat\";d:8880019.2;s:17:\"item_total_amount\";d:8880019.2;}i:2;a:13:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"LOT DE BP1\";s:5:\"rowId\";s:32:\"516ab23e7d50400377192ea1ac7500a5\";s:5:\"price\";s:7:\"2288.14\";s:8:\"quantite\";s:4:\"2200\";s:10:\"nombre_sac\";i:44;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:5033908;s:3:\"vat\";d:906103.44;s:15:\"item_price_wvat\";d:5940011.4399999995;s:17:\"item_total_amount\";d:5940011.4399999995;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"4000129009\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T10:00:12.000000Z\",\"created_at\":\"2022-11-03T10:00:12.000000Z\",\"id\":7}', 'KANYOSHA', 2, NULL, 1, '2022-11-03 10:00:12', '2022-11-03 10:04:37', NULL, '1', '2', '2022-11-03 12:04:00', '4000004806/ws400000480600270/20221103000000/000007', '2022-11-03'),
(8, 18420022.00, 2809824.00, 10000.00, 200.00, 15610198.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";s:7:\"1016.95\";s:8:\"quantite\";s:4:\"3000\";s:10:\"nombre_sac\";i:60;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:3050850;s:3:\"vat\";d:549153;s:15:\"item_price_wvat\";d:3600003;s:17:\"item_total_amount\";d:3600003;}i:1;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";s:7:\"1567.80\";s:8:\"quantite\";s:4:\"4800\";s:10:\"nombre_sac\";i:96;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:7525440;s:3:\"vat\";d:1354579.2;s:15:\"item_price_wvat\";d:8880019.2;s:17:\"item_total_amount\";d:8880019.2;}i:2;a:13:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"LOT DE BP1\";s:5:\"rowId\";s:32:\"516ab23e7d50400377192ea1ac7500a5\";s:5:\"price\";s:7:\"2288.14\";s:8:\"quantite\";s:4:\"2200\";s:10:\"nombre_sac\";i:44;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:5033908;s:3:\"vat\";d:906103.44;s:15:\"item_price_wvat\";d:5940011.4399999995;s:17:\"item_total_amount\";d:5940011.4399999995;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"4000129009\",\"vat_customer_payer\":\"on\",\"updated_at\":\"2022-11-03T10:34:33.000000Z\",\"created_at\":\"2022-11-03T10:34:33.000000Z\",\"id\":8}', 'KANYOSHA', 3, NULL, 1, '2022-11-03 10:34:33', '2022-11-03 10:39:01', NULL, NULL, NULL, NULL, NULL, '2019-08-09'),
(9, 18420022.00, 2809824.00, 10000.00, 200.00, 15610198.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";s:7:\"1016.95\";s:8:\"quantite\";s:4:\"3000\";s:10:\"nombre_sac\";i:60;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:3050850;s:3:\"vat\";d:549153;s:15:\"item_price_wvat\";d:3600003;s:17:\"item_total_amount\";d:3600003;}i:1;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";s:7:\"1567.80\";s:8:\"quantite\";s:4:\"4800\";s:10:\"nombre_sac\";i:96;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:7525440;s:3:\"vat\";d:1354579.2;s:15:\"item_price_wvat\";d:8880019.2;s:17:\"item_total_amount\";d:8880019.2;}i:2;a:13:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"LOT DE BP1\";s:5:\"rowId\";s:32:\"516ab23e7d50400377192ea1ac7500a5\";s:5:\"price\";s:7:\"2288.14\";s:8:\"quantite\";s:4:\"2200\";s:10:\"nombre_sac\";i:44;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:5033908;s:3:\"vat\";d:906103.44;s:15:\"item_price_wvat\";d:5940011.4399999995;s:17:\"item_total_amount\";d:5940011.4399999995;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"4000129009\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T10:40:53.000000Z\",\"created_at\":\"2022-11-03T10:40:53.000000Z\",\"id\":9}', 'KANYOSHA', 3, NULL, 1, '2022-11-03 10:40:53', '2022-11-03 10:43:02', NULL, '1', '3', '2022-11-03 12:41:12', '4000004806/ws400000480600270/20190809000000/000009', '2019-08-09'),
(10, 5107672.48, 779136.48, 2261.00, 45.22, 4328536.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:4:\"1000\";s:10:\"nombre_sac\";i:20;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288000;s:3:\"vat\";d:411840;s:15:\"item_price_wvat\";d:2699840;s:17:\"item_total_amount\";d:2699840;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";s:4:\"1120\";s:10:\"nombre_sac\";d:22.4;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1897280;s:3:\"vat\";d:341510.4;s:15:\"item_price_wvat\";d:2238790.4;s:17:\"item_total_amount\";d:2238790.4;}i:2;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";d:1016;s:8:\"quantite\";s:3:\"141\";s:10:\"nombre_sac\";d:2.82;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:143256;s:3:\"vat\";d:25786.08;s:15:\"item_price_wvat\";d:169042.08000000002;s:17:\"item_total_amount\";d:169042.08000000002;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"4000129009\",\"vat_customer_payer\":\"\",\"updated_at\":\"2022-11-03T10:53:25.000000Z\",\"created_at\":\"2022-11-03T10:53:25.000000Z\",\"id\":10}', 'KANYOSHA', 3, NULL, 1, '2022-11-03 10:53:25', '2022-11-03 10:54:27', NULL, '1', '3', '2022-11-03 12:54:18', '4000004806/ws400000480600270/20221103000000/000010', '2022-11-03'),
(11, 4698.76, 716.76, 2.00, 0.04, 3982.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"Quia doloribus labor\",\"telephone\":\"13613881082\",\"description\":\"\",\"addresse\":\"Incidunt dolor culp\",\"customer_TIN\":\"\",\"vat_customer_payer\":\"on\",\"updated_at\":\"2022-11-14T09:00:55.000000Z\",\"created_at\":\"2022-11-14T09:00:55.000000Z\",\"id\":11}', 'Incidunt dolor culp', 1, NULL, 1, '2022-11-14 09:00:55', '2022-11-21 18:42:35', NULL, NULL, NULL, NULL, NULL, '2022-11-15'),
(12, 2699.84, 411.84, 1.00, 0.02, 2288.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}}', '{\"name\":\"Nininahazwe Jean\",\"telephone\":\"+14214792186\",\"description\":\"\",\"addresse\":\"Incidunt dolor culp\",\"customer_TIN\":\"\",\"vat_customer_payer\":1,\"updated_at\":\"2022-11-14T09:04:05.000000Z\",\"created_at\":\"2022-11-14T09:04:05.000000Z\",\"id\":12}', 'Incidunt dolor culp', 1, NULL, 1, '2022-11-14 09:04:05', '2022-11-21 18:42:32', NULL, '1', '1', '2022-11-14 11:04:31', '4000004806/ws400000480600270/20221114110405/000012', '2022-11-14'),
(13, 4698.76, 716.76, 2.00, 0.04, 3982.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"NININAHAZWE JEAN LIONEL\",\"telephone\":\"+14214792186\",\"description\":\"\",\"addresse\":\"Asperiores et est re\",\"customer_TIN\":\"\",\"vat_customer_payer\":1,\"updated_at\":\"2022-11-21T11:34:38.000000Z\",\"created_at\":\"2022-11-21T11:34:38.000000Z\",\"id\":15}', 'Asperiores et est re', 1, NULL, 1, '2022-11-21 11:34:38', '2022-11-21 18:42:29', NULL, NULL, NULL, NULL, '4000004806/ws400000480600270/20221121133438/000013', '2022-11-21'),
(14, 5897.64, 899.64, 3.00, 0.06, 4998.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}i:2;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";d:1016;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1016;s:3:\"vat\";d:182.88;s:15:\"item_price_wvat\";d:1198.88;s:17:\"item_total_amount\";d:1198.88;}}', '{\"name\":\"Quia doloribus labor\",\"telephone\":\"13613881082\",\"description\":\"\",\"addresse\":\"Incidunt dolor culp\",\"customer_TIN\":\"\",\"vat_customer_payer\":1,\"updated_at\":\"2022-11-21T18:05:51.000000Z\",\"created_at\":\"2022-11-21T18:05:51.000000Z\",\"id\":16}', 'Incidunt dolor culp', 1, NULL, 1, '2022-11-21 18:05:51', '2022-11-21 18:42:27', NULL, NULL, NULL, NULL, '4000004806/ws400000480600270/20221121200551/000014', '2022-11-21'),
(15, 241428.00, 36828.00, 105.00, 2.10, 204600.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:2:\"45\";s:10:\"nombre_sac\";d:0.9;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:102960;s:3:\"vat\";d:18532.8;s:15:\"item_price_wvat\";d:121492.8;s:17:\"item_total_amount\";d:121492.8;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";s:2:\"60\";s:10:\"nombre_sac\";d:1.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:101640;s:3:\"vat\";d:18295.2;s:15:\"item_price_wvat\";d:119935.2;s:17:\"item_total_amount\";d:119935.2;}}', '{\"name\":\"TEST 1\",\"telephone\":\"79625825\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-11-21T18:16:58.000000Z\",\"created_at\":\"2022-11-21T18:16:58.000000Z\",\"id\":17}', 'KANYOSHA', 1, NULL, 1, '2022-11-21 18:16:58', '2022-11-21 18:37:59', NULL, '1', '1', '2022-11-21 20:17:16', '4000004806/ws400000480600270/20221121201658/000015', '2022-11-21'),
(18, 7698.32, 1174.32, 3.00, 0.06, 6524.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}i:2;a:13:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"LOT DE BP1\";s:5:\"rowId\";s:32:\"516ab23e7d50400377192ea1ac7500a5\";s:5:\"price\";d:2542;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2542;s:3:\"vat\";d:457.56;s:15:\"item_price_wvat\";d:2999.56;s:17:\"item_total_amount\";d:2999.56;}}', '{\"name\":\"Quia doloribus labor\",\"telephone\":\"13613881082\",\"description\":\"\",\"addresse\":\"Incidunt dolor culp\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-11-21T18:20:53.000000Z\",\"created_at\":\"2022-11-21T18:20:53.000000Z\",\"id\":20}', 'Incidunt dolor culp', 1, NULL, 1, '2022-11-21 18:20:53', '2022-11-21 18:42:24', NULL, NULL, NULL, NULL, '4000004806/ws400000480600270/20221121202053/000018', '2022-11-21'),
(19, 4698.76, 716.76, 2.00, 0.04, 3982.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:2288;s:3:\"vat\";d:411.84;s:15:\"item_price_wvat\";d:2699.84;s:17:\"item_total_amount\";d:2699.84;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"NININAHAZWE JEAN LIONEL\",\"telephone\":\"+14214792186\",\"description\":\"\",\"addresse\":\"Asperiores et est re\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-11-21T18:22:19.000000Z\",\"created_at\":\"2022-11-21T18:22:19.000000Z\",\"id\":21}', 'Asperiores et est re', 1, NULL, 1, '2022-11-21 18:22:19', '2022-11-21 18:37:24', NULL, '1', '1', '2022-11-21 20:25:39', '4000004806/ws400000480600270/20221121202219/000019', '2022-11-01'),
(20, 469876.00, 71676.00, 200.00, 4.00, 398200.00, 'CACHE', 'a:2:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:3:\"100\";s:10:\"nombre_sac\";i:2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:228800;s:3:\"vat\";d:41184;s:15:\"item_price_wvat\";d:269984;s:17:\"item_total_amount\";d:269984;}i:1;a:13:{s:2:\"id\";i:4;s:4:\"name\";s:9:\"LOT DE D1\";s:5:\"rowId\";s:32:\"c50bae4f9c18dd7f6d3a5042a4d034e2\";s:5:\"price\";d:1694;s:8:\"quantite\";s:3:\"100\";s:10:\"nombre_sac\";i:2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:169400;s:3:\"vat\";d:30492;s:15:\"item_price_wvat\";d:199892;s:17:\"item_total_amount\";d:199892;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-11-22T07:02:37.000000Z\",\"created_at\":\"2022-11-22T07:02:37.000000Z\",\"id\":22}', NULL, 1, NULL, 1, '2022-11-22 07:02:37', '2022-12-02 07:56:02', NULL, '1', '1', '2022-11-22 09:02:44', '4000004806/ws400000480600270/20221122090237/000020', '2022-11-22'),
(21, 68982.80, 10522.80, 30.00, 0.60, 58460.00, 'CACHE', 'a:3:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:2:\"10\";s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:22880;s:3:\"vat\";d:4118.4;s:15:\"item_price_wvat\";d:26998.4;s:17:\"item_total_amount\";d:26998.4;}i:1;a:13:{s:2:\"id\";i:3;s:4:\"name\";s:9:\"Lot de F1\";s:5:\"rowId\";s:32:\"240d090d45bb0fece5a78392d5b0080a\";s:5:\"price\";d:1016;s:8:\"quantite\";s:2:\"10\";s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:10160;s:3:\"vat\";d:1828.8;s:15:\"item_price_wvat\";d:11988.8;s:17:\"item_total_amount\";d:11988.8;}i:2;a:13:{s:2:\"id\";i:2;s:4:\"name\";s:10:\"LOT DE BP1\";s:5:\"rowId\";s:32:\"516ab23e7d50400377192ea1ac7500a5\";s:5:\"price\";d:2542;s:8:\"quantite\";s:2:\"10\";s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:25420;s:3:\"vat\";d:4575.6;s:15:\"item_price_wvat\";d:29995.6;s:17:\"item_total_amount\";d:29995.6;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"0000\",\"description\":\"\",\"addresse\":\"\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-05T15:37:14.000000Z\",\"created_at\":\"2022-12-05T15:37:14.000000Z\",\"id\":23}', NULL, 1, NULL, 0, '2022-12-05 15:37:14', '2022-12-05 15:37:14', NULL, NULL, NULL, NULL, '4000004806/wsl400000480600187/20221205173714/000021', '2022-12-05'),
(22, 171258950.72, 26124246.72, 63433.00, 1268.66, 145134704.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:5;s:4:\"name\";s:10:\"LOT DE PF1\";s:5:\"rowId\";s:32:\"f55fc290bc321a238968dd335b6af89c\";s:5:\"price\";d:2288;s:8:\"quantite\";s:5:\"63433\";s:10:\"nombre_sac\";d:1268.66;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:145134704;s:3:\"vat\";d:26124246.72;s:15:\"item_price_wvat\";d:171258950.72;s:17:\"item_total_amount\";d:171258950.72;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-05T15:38:59.000000Z\",\"created_at\":\"2022-12-05T15:38:59.000000Z\",\"id\":24}', 'KANYOSHA', 1, NULL, 0, '2022-12-05 15:38:59', '2022-12-05 15:38:59', NULL, NULL, NULL, NULL, '4000004806/wsl400000480600187/20221205173859/000022', '2022-12-05'),
(23, 11193952.00, 1707552.00, 5600.00, 112.00, 9486400.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"LOT DE PD\";s:5:\"rowId\";s:32:\"97386e421a3fc10b0b6791928de787ef\";s:5:\"price\";d:1694;s:8:\"quantite\";s:4:\"5600\";s:10:\"nombre_sac\";i:112;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:9486400;s:3:\"vat\";d:1707552;s:15:\"item_price_wvat\";d:11193952;s:17:\"item_total_amount\";d:11193952;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-08T15:32:54.000000Z\",\"created_at\":\"2022-12-08T15:32:54.000000Z\",\"id\":25}', 'KANYOSHA', 1, NULL, 0, '2022-12-08 15:32:54', '2022-12-08 15:32:58', NULL, '1', '1', '2022-12-08 17:32:58', '4000004806/wsl400000480600187/20221208173254/000023', '2022-12-08'),
(24, 1998.92, 304.92, 1.00, 0.02, 1694.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"LOT DE PD\";s:5:\"rowId\";s:32:\"97386e421a3fc10b0b6791928de787ef\";s:5:\"price\";d:1694;s:8:\"quantite\";i:1;s:10:\"nombre_sac\";d:0.02;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1694;s:3:\"vat\";d:304.92;s:15:\"item_price_wvat\";d:1998.92;s:17:\"item_total_amount\";d:1998.92;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-08T15:39:54.000000Z\",\"created_at\":\"2022-12-08T15:39:54.000000Z\",\"id\":26}', 'KANYOSHA', 1, NULL, 0, '2022-12-08 15:39:54', '2022-12-08 15:40:03', NULL, '1', '1', '2022-12-08 17:40:03', '4000004806/wsl400000480600187/20221208173954/000024', '2022-12-08'),
(25, 11200056.00, 1708479.00, 5600.00, 112.00, 9491552.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"LOT DE PD\";s:5:\"rowId\";s:32:\"97386e421a3fc10b0b6791928de787ef\";s:5:\"price\";d:1694.92;s:8:\"quantite\";s:4:\"5600\";s:10:\"nombre_sac\";i:112;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:9491552;s:3:\"vat\";d:1708479.36;s:15:\"item_price_wvat\";d:11200031.36;s:17:\"item_total_amount\";d:11200031.36;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-08T16:21:14.000000Z\",\"created_at\":\"2022-12-08T16:21:14.000000Z\",\"id\":27}', 'KANYOSHA', 1, NULL, 0, '2022-12-08 16:21:14', '2022-12-08 16:21:16', NULL, '1', '1', '2022-12-08 18:21:16', '4000004806/ws400000480600270/20221208182114/000025', '2022-12-08'),
(26, 11200031.00, 1708479.00, 5600.00, 112.00, 9491552.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"LOT DE PD\";s:5:\"rowId\";s:32:\"97386e421a3fc10b0b6791928de787ef\";s:5:\"price\";d:1694.92;s:8:\"quantite\";s:4:\"5600\";s:10:\"nombre_sac\";i:112;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:9491552;s:3:\"vat\";d:1708479.36;s:15:\"item_price_wvat\";d:11200031.36;s:17:\"item_total_amount\";d:11200031.36;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-08T16:23:46.000000Z\",\"created_at\":\"2022-12-08T16:23:46.000000Z\",\"id\":28}', 'KANYOSHA', 1, NULL, 0, '2022-12-08 16:23:46', '2022-12-08 16:23:48', NULL, '1', '1', '2022-12-08 18:23:48', '4000004806/ws400000480600270/20221208182346/000026', '2022-12-01'),
(27, 11200031.00, 1708479.00, 5600.00, 112.00, 9491552.00, 'CACHE', 'a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"LOT DE PD\";s:5:\"rowId\";s:32:\"97386e421a3fc10b0b6791928de787ef\";s:5:\"price\";d:1694.92;s:8:\"quantite\";s:4:\"5600\";s:10:\"nombre_sac\";i:112;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:9491552;s:3:\"vat\";d:1708479.36;s:15:\"item_price_wvat\";d:11200031.36;s:17:\"item_total_amount\";d:11200031.36;}}', '{\"name\":\"BIZIMANA SALVATOR\",\"telephone\":\"+16452089497\",\"description\":\"\",\"addresse\":\"KANYOSHA\",\"customer_TIN\":\"\",\"vat_customer_payer\":0,\"updated_at\":\"2022-12-08T16:37:00.000000Z\",\"created_at\":\"2022-12-08T16:37:00.000000Z\",\"id\":29}', 'KANYOSHA', 1, NULL, 0, '2022-12-08 16:37:00', '2022-12-08 16:37:04', NULL, '1', '1', '2022-12-08 18:37:04', '4000004806/ws400000480600270/20221208183700/000027', '2022-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `paiement_dettes`
--

CREATE TABLE `paiement_dettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant` double(64,2) DEFAULT NULL,
  `montant_restant` double(64,2) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NON PAYE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite_mesure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` double(62,2) DEFAULT NULL,
  `quantite_alert` double(62,2) DEFAULT NULL,
  `price` double(62,2) DEFAULT NULL,
  `price_max` double(62,2) DEFAULT NULL,
  `price_min` double(62,2) DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code_product`, `name`, `marque`, `unite_mesure`, `quantite`, `quantite_alert`, `price`, `price_max`, `price_min`, `date_expiration`, `description`, `user_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'LOT DE PD', 'LOT DE PD', 'THE SEC', 'KG', 777631.00, 68.00, 1694.92, 1694.92, 1694.92, '2050-03-02', 'THE SEC', 1, 1, '2022-10-21 02:38:48', '2022-12-08 16:37:00', NULL),
(2, 'LOT DE BP1', 'LOT DE BP1', 'THE SEC', 'KG', 73392.00, 10.00, 2542.00, 2542.00, 2542.00, '2050-03-04', 'THE SEC', 1, 1, '2022-10-21 02:38:52', '2022-12-05 15:37:14', NULL),
(3, 'Lot de F1', 'Lot de F1', 'THE SEC', 'KG', 90850.00, 10.00, 1016.00, 1016.00, 1016.00, '1975-01-24', 'THE SEC', 1, 1, '2022-10-21 02:38:55', '2022-12-05 15:37:14', NULL),
(4, 'LOT DE D1', 'LOT DE D1', 'THE SEC', 'KG', 68711.00, 50.00, 1694.00, 1694.00, 1694.00, '2050-10-21', NULL, 1, 1, '2022-10-21 07:38:30', '2022-11-22 07:02:37', NULL),
(5, 'LOT DE PF1', 'LOT DE PF1', 'THE SEC', 'KG', 500.00, 100.00, 2288.00, 2288.00, 2288.00, '2050-10-21', NULL, 1, 1, '2022-10-21 07:39:24', '2022-12-05 15:40:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_histories`
--

CREATE TABLE `product_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `code_product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite_mesure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` double(62,2) DEFAULT NULL,
  `quantite_alert` double(62,2) DEFAULT NULL,
  `price` double(62,2) DEFAULT NULL,
  `price_max` double(62,2) DEFAULT NULL,
  `price_min` double(62,2) DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_histories`
--

INSERT INTO `product_histories` (`id`, `product_id`, `code_product`, `name`, `marque`, `unite_mesure`, `quantite`, `quantite_alert`, `price`, `price_max`, `price_min`, `date_expiration`, `description`, `user_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'LOT DE BP1', 'LOT DE BP1', 'THE SEC', 'KG', 80003.00, 10.00, 2542.00, 2542.00, 2542.00, '1977-03-04', 'THE SEC', 2, 1, '2022-10-21 00:38:52', '2022-10-27 03:34:24', NULL),
(2, 1, 'LOT DE PD', 'LOT DE PD', 'THE SEC', 'KG', 794432.00, 68.00, 1694.00, 1694.00, 1694.00, '2050-03-02', 'THE SEC', 1, 1, '2022-10-21 00:38:48', '2022-12-08 13:32:54', NULL),
(3, 1, 'LOT DE PD', 'LOT DE PD', 'THE SEC', 'KG', 794431.00, 68.00, 1694.00, 1694.00, 1694.92, '2050-03-02', 'THE SEC', 1, 1, '2022-10-21 00:38:48', '2022-12-08 13:39:54', NULL),
(4, 1, 'LOT DE PD', 'LOT DE PD', 'THE SEC', 'KG', 794431.00, 68.00, 1694.00, 1694.00, 1694.92, '2050-03-02', 'THE SEC', 1, 1, '2022-10-21 00:38:48', '2022-12-08 13:39:54', NULL),
(5, 1, 'LOT DE PD', 'LOT DE PD', 'THE SEC', 'KG', 794431.00, 68.00, 1694.00, 1694.00, 1694.92, '2050-03-02', 'THE SEC', 1, 1, '2022-10-21 00:38:48', '2022-12-08 13:39:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMINISTRATEUR', '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(2, 'CONTROLLEUR', '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(3, 'COMPTABLE', '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(4, 'VENTE', '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(5, 'ENTRE DES PRODUITS EN STOCK', '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(6, 'ADMINISTRATEUR', '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(7, 'CONTROLLEUR', '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(8, 'COMPTABLE', '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(9, 'VENTE', '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(10, 'ENTRE DES PRODUITS EN STOCK', '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(11, 'ADMINISTRATEUR', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL),
(12, 'CONTROLLEUR', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL),
(13, 'COMPTABLE', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL),
(14, 'VENTE', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL),
(15, 'ENTRE DES PRODUITS EN STOCK', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 2, 1, NULL, NULL, NULL),
(3, 3, 1, NULL, NULL, NULL),
(4, 4, 1, NULL, NULL, NULL),
(5, 5, 1, NULL, NULL, NULL),
(6, 6, 1, NULL, NULL, NULL),
(7, 7, 1, NULL, NULL, NULL),
(8, 8, 1, NULL, NULL, NULL),
(9, 9, 1, NULL, NULL, NULL),
(10, 10, 1, NULL, NULL, NULL),
(11, 11, 1, NULL, NULL, NULL),
(12, 12, 1, NULL, NULL, NULL),
(13, 13, 1, NULL, NULL, NULL),
(14, 14, 1, NULL, NULL, NULL),
(15, 15, 1, NULL, NULL, NULL),
(16, 1, 2, NULL, NULL, NULL),
(17, 2, 2, NULL, NULL, NULL),
(18, 3, 2, NULL, NULL, NULL),
(19, 4, 2, NULL, NULL, NULL),
(20, 5, 2, NULL, NULL, NULL),
(21, 6, 2, NULL, NULL, NULL),
(22, 7, 2, NULL, NULL, NULL),
(23, 8, 2, NULL, NULL, NULL),
(24, 9, 2, NULL, NULL, NULL),
(25, 10, 2, NULL, NULL, NULL),
(26, 11, 2, NULL, NULL, NULL),
(27, 12, 2, NULL, NULL, NULL),
(28, 13, 2, NULL, NULL, NULL),
(29, 14, 2, NULL, NULL, NULL),
(30, 15, 2, NULL, NULL, NULL),
(31, 1, 3, NULL, NULL, NULL),
(32, 2, 3, NULL, NULL, NULL),
(33, 3, 3, NULL, NULL, NULL),
(34, 4, 3, NULL, NULL, NULL),
(35, 5, 3, NULL, NULL, NULL),
(36, 6, 3, NULL, NULL, NULL),
(37, 7, 3, NULL, NULL, NULL),
(38, 8, 3, NULL, NULL, NULL),
(39, 9, 3, NULL, NULL, NULL),
(40, 10, 3, NULL, NULL, NULL),
(41, 11, 3, NULL, NULL, NULL),
(42, 12, 3, NULL, NULL, NULL),
(43, 13, 3, NULL, NULL, NULL),
(44, 14, 3, NULL, NULL, NULL),
(45, 15, 3, NULL, NULL, NULL),
(46, 1, 4, NULL, NULL, NULL),
(47, 2, 4, NULL, NULL, NULL),
(48, 3, 4, NULL, NULL, NULL),
(49, 4, 4, NULL, NULL, NULL),
(50, 5, 4, NULL, NULL, NULL),
(51, 6, 4, NULL, NULL, NULL),
(52, 7, 4, NULL, NULL, NULL),
(53, 8, 4, NULL, NULL, NULL),
(54, 9, 4, NULL, NULL, NULL),
(55, 10, 4, NULL, NULL, NULL),
(56, 11, 4, NULL, NULL, NULL),
(57, 12, 4, NULL, NULL, NULL),
(58, 13, 4, NULL, NULL, NULL),
(59, 14, 4, NULL, NULL, NULL),
(60, 15, 4, NULL, NULL, NULL),
(64, 4, 5, NULL, NULL, NULL),
(68, 8, 5, NULL, NULL, NULL),
(69, 9, 5, NULL, NULL, NULL),
(70, 10, 5, NULL, NULL, NULL),
(71, 11, 5, NULL, NULL, NULL),
(72, 12, 5, NULL, NULL, NULL),
(73, 13, 5, NULL, NULL, NULL),
(74, 14, 5, NULL, NULL, NULL),
(75, 15, 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2022-10-20 02:53:00', '2022-10-20 02:53:00', NULL),
(2, 1, 1, '2022-10-20 02:53:56', '2022-10-20 02:53:56', NULL),
(3, 1, 1, '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(64,2) NOT NULL,
  `quantite` double(64,2) NOT NULL,
  `total` double(64,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('O12leJOPR2SH9k2aYKxWHzpAGRzRWVJurSjcqHnC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoieEFNTmEyYmNoS25LbHlZcW9vRkxtbmV6OXppNmZiZ3hhTFlpajhBNSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcGFuaWVyL2luZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJGdXTnp2U2tqSmtUTHNTV3g3RVA3YXUzTUdMUG5qLzBQVjVqdHJoenV0b3UzYkt3WjZsZlhPIjtzOjQ6ImNhcnQiO2E6MDp7fX0=', 1670517424),
('qxKqqIH9XuXD97SIVAKpDkA5IuJHBbFSdvRjFwjF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUldMMTh2cURUanhWWG9sQmJaVUpobnFGU0dnVEhKdjRzTHc5ajA5dCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdmVudGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJEdDU09ZcXNRSS53anp6MHBLUXpSNE9sU3dYa3FCR25md0g2UnhsZTk1UDZVRmRoU3ZXTk55Ijt9', 1677039407),
('ulAaDjQeqF95HNMQDL2kPxFy7sk8D5ALsinh9loA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiU0U4UVpHaU1qUTFjVXZDQTNKQzNuQUY2TFp3bTd5eDVBYkt3cEZYMiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY2xpZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRHQ1NPWXFzUUkud2p6ejBwS1F6UjRPbFN3WGtxQkduZndINlJ4bGU5NVA2VUZkaFN2V05OeSI7fQ==', 1676634023);

-- --------------------------------------------------------

--
-- Table structure for table `stockes`
--

CREATE TABLE `stockes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockes`
--

INSERT INTO `stockes` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'STOCK PRINCIPAL', 'STOCK PRINCIPAL DE BASE', '2022-10-21 04:35:47', '2022-10-21 04:35:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Jean Lionnel', 'nijeanlionel@gmail.com', '2022-10-21 04:35:47', '$2y$10$GCSOYqsQI.wjzz0pKQzR4OlSwXkqBGnfwH6Rxle95P6UFdhSvWNNy', NULL, NULL, '1SYY8Om0QHGiGfCVuM8U4G2CNUyJrw5lYqU8nsiGgcjJVd2wN6tHx7KGrK75', NULL, NULL, '2022-10-21 04:35:47', '2022-10-21 09:31:17'),
(2, 'Mashaza Alain Prosper', 'alain@prothem.bi', NULL, '$2y$10$75MBJPlZ/2pKFxqF6Z9IN.qSp2NmHdGroYiZOdwcrLFhjfKc27kKC', NULL, NULL, 'bOdSP0p5GFNHnmJMlD4EpAwr8z3lxDt5swdhbUEBw8aUp7RzWEAWK4TRkpip', NULL, NULL, '2022-10-21 09:36:21', '2022-10-31 09:02:00'),
(3, 'Ntawigirira Blaise', 'blaise@prothem.bi', NULL, '$2y$10$gIQwqpsCa7Q80A7X0DyhBOdGkApVR3KpKeFOu7ZfVSXjrIlSHWY0y', NULL, NULL, NULL, NULL, NULL, '2022-10-21 09:38:45', '2022-11-03 10:07:04'),
(4, 'Hicuburundi Tangy', 'tangy@prothem.bi', NULL, '$2y$10$xOFskwyvZAGCPYkZTLCMLerqDjVdpPkfA6iCR2PkAaILK4o955RfC', NULL, NULL, NULL, NULL, NULL, '2022-10-21 09:39:55', '2022-11-03 10:07:17'),
(5, 'Gatore Florence', 'florence@prothem.bi', NULL, '$2y$10$ormSjpk2hGx/UXYv35ZQWODswMkCmPwlCJxgZ/38W7DUOPXq4QrrC', NULL, NULL, NULL, NULL, NULL, '2022-10-25 09:34:00', '2022-11-03 10:07:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_stock_id_foreign` (`stock_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_paiment_dettes`
--
ALTER TABLE `detail_paiment_dettes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprise_histories`
--
ALTER TABLE `entreprise_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `follow_products`
--
ALTER TABLE `follow_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obr_declarations`
--
ALTER TABLE `obr_declarations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `obr_pointers`
--
ALTER TABLE `obr_pointers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paiement_dettes`
--
ALTER TABLE `paiement_dettes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_histories`
--
ALTER TABLE `product_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_histories_category_id_foreign` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stockes`
--
ALTER TABLE `stockes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `detail_paiment_dettes`
--
ALTER TABLE `detail_paiment_dettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `entreprise_histories`
--
ALTER TABLE `entreprise_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_products`
--
ALTER TABLE `follow_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `obr_declarations`
--
ALTER TABLE `obr_declarations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obr_pointers`
--
ALTER TABLE `obr_pointers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `paiement_dettes`
--
ALTER TABLE `paiement_dettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_histories`
--
ALTER TABLE `product_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockes`
--
ALTER TABLE `stockes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stockes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_histories`
--
ALTER TABLE `product_histories`
  ADD CONSTRAINT `product_histories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
