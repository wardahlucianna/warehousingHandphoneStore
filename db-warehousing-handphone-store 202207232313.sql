-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2022 pada 18.12
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-warehousing-handphone-store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hs_imei`
--

CREATE TABLE `hs_imei` (
  `hs_imei_id` int(11) NOT NULL,
  `t_imei_id` int(11) NOT NULL,
  `hs_imei_status` varchar(100) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `map_feature`
--

CREATE TABLE `map_feature` (
  `map_feature_id` int(11) NOT NULL,
  `m_user_group_id` int(11) DEFAULT NULL,
  `m_feature_id` int(11) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `map_feature`
--

INSERT INTO `map_feature` (`map_feature_id`, `m_user_group_id`, `m_feature_id`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 1, 1, 1, '2019-10-02 05:25:12', 1, '2022-07-22 21:13:39'),
(4, 1, 17, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(9, 1, 6, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(10, 1, 2, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(11, 1, 8, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(15, 1, 5, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(23, 1, 4, 1, '2019-10-02 05:28:06', 1, '2022-07-22 21:13:39'),
(25, 1, 22, 1, '2022-06-28 16:50:46', 1, '2022-07-22 21:13:39'),
(26, 1, 18, 1, '2022-06-28 18:20:47', 1, '2022-07-22 21:13:39'),
(27, 1, 19, 1, '2022-06-28 18:20:47', 1, '2022-07-22 21:13:39'),
(28, 1, 25, 1, '2022-06-28 18:39:03', 1, '2022-07-22 21:13:39'),
(29, 1, 26, 1, '2022-06-29 09:09:20', 1, '2022-07-22 21:13:39'),
(30, 1, 27, 1, '2022-06-29 10:11:46', 1, '2022-07-22 21:13:39'),
(31, 1, 28, 1, '2022-06-29 16:09:04', 1, '2022-07-22 21:13:39'),
(32, 1, 29, 1, '2022-06-29 17:01:14', 1, '2022-07-22 21:13:39'),
(33, 1, 30, 1, '2022-07-04 22:16:30', 1, '2022-07-22 21:13:39'),
(34, 1, 31, 1, '2022-07-04 22:16:30', 1, '2022-07-22 21:13:39'),
(35, 1, 32, 1, '2022-07-04 22:16:30', 1, '2022-07-22 21:13:39'),
(36, 1, 33, 3, '2022-07-05 17:16:43', 1, '2022-07-22 21:13:39'),
(37, 1, 34, 3, '2022-07-05 17:37:33', 1, '2022-07-22 21:13:39'),
(38, 1, 35, 3, '2022-07-08 19:54:23', 1, '2022-07-22 21:13:39'),
(39, 1, 36, 1, '2022-07-18 15:12:26', 1, '2022-07-22 21:13:39'),
(40, 1, 37, 1, '2022-07-22 21:13:39', NULL, NULL),
(41, 2, 17, 1, '2022-07-22 22:22:55', NULL, NULL),
(42, 2, 18, 1, '2022-07-22 22:22:55', NULL, NULL),
(43, 2, 30, 1, '2022-07-22 22:22:55', NULL, NULL),
(44, 2, 5, 1, '2022-07-22 22:22:55', NULL, NULL),
(45, 2, 19, 1, '2022-07-22 22:22:55', NULL, NULL),
(46, 2, 36, 1, '2022-07-22 22:22:55', NULL, NULL),
(47, 2, 37, 1, '2022-07-22 22:22:55', NULL, NULL),
(48, 2, 31, 1, '2022-07-22 22:22:55', NULL, NULL),
(49, 2, 32, 1, '2022-07-22 22:22:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_color`
--

CREATE TABLE `m_color` (
  `m_color_id` int(11) NOT NULL,
  `m_color_name` varchar(50) NOT NULL,
  `m_color_status` varchar(50) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_color`
--

INSERT INTO `m_color` (`m_color_id`, `m_color_name`, `m_color_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'White', 'Active', 3, '2022-06-29 00:00:52', NULL, NULL),
(2, 'Black', 'Active', 3, '2022-06-29 00:00:52', NULL, NULL),
(3, 'Blue', 'Active', 3, '2022-06-29 00:00:52', NULL, NULL),
(4, 'Yellow', 'Active', 3, '2022-06-29 00:00:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_employee`
--

CREATE TABLE `m_employee` (
  `m_employee_id` int(11) NOT NULL,
  `m_position_id` int(11) NOT NULL,
  `m_user_group_id` int(11) NOT NULL,
  `m_warehouse_id` int(11) DEFAULT NULL,
  `m_employee_full_name` varchar(50) NOT NULL,
  `m_employee_sort_name` varchar(10) NOT NULL,
  `m_employee_email` varchar(50) DEFAULT NULL,
  `m_employee_email_verification` tinyint(1) DEFAULT NULL,
  `m_employee_username` varchar(50) NOT NULL,
  `m_employee_password` varchar(20) NOT NULL,
  `m_employee_status` varchar(20) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `m_employee`
--

INSERT INTO `m_employee` (`m_employee_id`, `m_position_id`, `m_user_group_id`, `m_warehouse_id`, `m_employee_full_name`, `m_employee_sort_name`, `m_employee_email`, `m_employee_email_verification`, `m_employee_username`, `m_employee_password`, `m_employee_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 2, 1, 2, 'Admin', 'admin', 'yonatan@street88shop.com', 1, 'admin', 'MTExMTEx', 'Active', NULL, NULL, 1, '2022-06-29 00:04:36'),
(3, 2, 1, 9, 'Wardah Lucianna Suhalim', 'Wardah', NULL, 1, 'wardah', 'MTExMTEx', 'Active', 1, '2020-02-24 14:06:51', 1, '2022-07-02 19:54:12'),
(101, 4, 2, NULL, 'Rosealina', 'Rose', NULL, NULL, 'rose', 'MTExMTEx', 'Active', 1, '2022-07-22 22:21:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_feature`
--

CREATE TABLE `m_feature` (
  `m_feature_id` int(11) NOT NULL,
  `m_feature_group_id` int(11) DEFAULT NULL,
  `m_feature_name` varchar(50) DEFAULT NULL,
  `m_feature_url` varchar(50) DEFAULT NULL,
  `m_feature_icon` varchar(20) DEFAULT NULL,
  `m_feature_visible` double DEFAULT NULL,
  `m_feature_squance` int(11) DEFAULT NULL,
  `m_feature_menu_type` varchar(30) DEFAULT NULL,
  `m_feature_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `m_feature`
--

INSERT INTO `m_feature` (`m_feature_id`, `m_feature_group_id`, `m_feature_name`, `m_feature_url`, `m_feature_icon`, `m_feature_visible`, `m_feature_squance`, `m_feature_menu_type`, `m_feature_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 1, 'Feature Group', 'm_feature_group_controller/index', '', 1, 2, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 17:58:08'),
(2, 1, 'Feature', 'm_feature_controller/index', '', 1, 1, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:14:09'),
(4, 1, 'User Group', 'm_user_group_controller/index', '', 1, 4, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:28:33'),
(5, 4, 'Log Out', 's_login_controller/index', 'fa fa-sign-out', 1, 4, 'Top menu', 'Active', NULL, NULL, 1, '2022-06-29 09:08:15'),
(6, 2, 'Employee', 'm_employee_controller/index', '', 1, 1, 'Left menu', 'Active', NULL, NULL, 1, '2022-06-29 09:08:47'),
(8, 1, 'Feature Map', 'map_feature_controller/index', '', 1, 3, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:28:18'),
(17, 4, 'Change Password', 's_change_password_controller/index', 'fa fa-key', 1, 2, 'Top menu', 'Active', 1, '2019-06-26 17:01:37', 1, '2019-07-07 17:30:44'),
(18, 5, 'Home', 'h_home_controller/index', '', 0, 1, 'Left menu', 'Active', 1, '2019-06-26 18:46:21', 1, '2019-06-26 19:06:38'),
(19, 4, 'Profile', 's_profile_controller/index', 'fa fa-user', 1, 3, 'Top menu', 'Active', 1, '2019-06-26 19:11:58', 1, '2019-07-07 17:31:19'),
(22, 4, 'Change Logo', 's_change_logo_controller/index', 'fa fa-picture-o', 1, 1, 'Top menu', 'Active', 1, '2019-07-07 17:28:13', 1, '2019-07-07 17:40:43'),
(25, 2, 'Position', 'm_position_controller/index', '', 1, 2, 'Left menu', 'Active', 1, '2022-06-28 18:38:48', 1, '2022-06-29 09:08:59'),
(26, 2, 'Product Type', 'm_product_type_controller/index', '', 1, 3, 'Left menu', 'Active', 1, '2022-06-29 09:07:50', 1, '2022-06-29 09:09:09'),
(27, 2, 'Product', 'm_product_controller/index', '', 1, 4, 'Left menu', 'Active', 1, '2022-06-29 10:11:35', NULL, NULL),
(28, 7, 'Warehouse', 'm_warehouse_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2022-06-29 16:08:48', NULL, NULL),
(29, 8, 'Stock In', 't_stock_in_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2022-06-29 17:01:04', 3, '2022-07-05 17:14:08'),
(30, 8, 'Imei', 't_imei_controller/index', '', 1, 2, 'Left menu', 'Active', 1, '2022-07-04 22:15:21', NULL, NULL),
(31, 8, 'Stock', 't_stock_controller/index', '', 1, 3, 'Left menu', 'Active', 1, '2022-07-04 22:15:54', NULL, NULL),
(32, 8, 'Tracking', 't_tracking_controller/index', '', 1, 5, 'Left menu', 'Active', 1, '2022-07-04 22:16:18', NULL, NULL),
(33, 8, 'Stock Out', 't_stock_out_controller/index', '', 1, 2, 'Left menu', 'Active', 3, '2022-07-05 17:16:30', NULL, NULL),
(34, 7, 'Shop', 'm_shop_controller/index', '', 1, 2, 'Left menu', 'Active', 3, '2022-07-05 17:37:26', NULL, NULL),
(35, 8, 'Return Stock Out', 't_return_stock_out_controller/index', '', 1, 5, 'Left menu', 'Active', 3, '2022-07-08 19:54:14', 3, '2022-07-08 20:24:05'),
(36, 9, 'Report Stock In', 'r_stock_in_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2022-07-18 15:12:06', NULL, NULL),
(37, 9, 'Report Stock Out', 'r_stock_out_controller/index', '', 1, 2, 'Left menu', 'Active', 1, '2022-07-22 21:13:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_feature_group`
--

CREATE TABLE `m_feature_group` (
  `m_feature_group_id` int(11) NOT NULL,
  `m_feature_group_name` varchar(50) DEFAULT NULL,
  `m_feature_group_url` varchar(50) DEFAULT NULL,
  `m_feature_group_icon` varchar(20) DEFAULT NULL,
  `m_feature_group_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `m_feature_group`
--

INSERT INTO `m_feature_group` (`m_feature_group_id`, `m_feature_group_name`, `m_feature_group_url`, `m_feature_group_icon`, `m_feature_group_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Access', '', 'fa fa-key', 'Active', NULL, NULL, 1, '2022-06-29 00:06:19'),
(2, 'General', '', 'fa fa-book', 'Active', NULL, NULL, 1, '2019-06-25 19:12:04'),
(4, 'Setting', '', '', 'Active', NULL, NULL, 1, '2019-06-26 18:43:19'),
(5, 'Home', 'h_home_email_controller/index', 'fa fa-home', 'Active', NULL, NULL, 1, '2019-06-26 19:00:53'),
(7, 'Building', '', 'fa fa-building', 'Active', 1, '2022-06-29 16:07:59', 1, '2022-06-29 16:56:43'),
(8, 'Transaction', '', 'fa fa-list', 'Active', 1, '2022-06-29 16:56:00', 1, '2022-06-29 16:57:51'),
(9, 'Report', '', 'fa fa-file', 'Active', 1, '2022-07-18 15:08:39', 1, '2022-07-18 15:09:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_position`
--

CREATE TABLE `m_position` (
  `m_position_id` int(11) NOT NULL,
  `m_position_name` varchar(50) DEFAULT NULL,
  `m_position_status` varchar(20) DEFAULT NULL,
  `m_position_top_manager` varchar(50) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `m_position`
--

INSERT INTO `m_position` (`m_position_id`, `m_position_name`, `m_position_status`, `m_position_top_manager`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(2, 'Adminstrator', 'Active', '1', 1, '2019-06-12 18:23:07', 1, '2019-07-16 16:17:26'),
(3, 'Staff', 'Active', '2', 1, '2019-07-23 09:39:47', NULL, NULL),
(4, 'Owner', 'Active', NULL, 1, '2022-07-22 22:17:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_product`
--

CREATE TABLE `m_product` (
  `m_product_id` int(11) NOT NULL,
  `m_product_name` varchar(100) NOT NULL,
  `m_product_status` varchar(50) NOT NULL,
  `m_product_type_id` int(11) NOT NULL,
  `m_size_id` int(11) NOT NULL,
  `m_color_id` int(11) NOT NULL,
  `m_product_limit` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_product`
--

INSERT INTO `m_product` (`m_product_id`, `m_product_name`, `m_product_status`, `m_product_type_id`, `m_size_id`, `m_color_id`, `m_product_limit`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'type 2 128GB Blue', 'Active', 7, 2, 3, 10, '2022-06-29 11:03:39', 1, '2022-07-04 22:36:47', 1),
(4, 'type 2 64GB Yellow', 'Active', 7, 1, 4, 4, '2022-06-30 15:42:57', 1, '2022-07-01 12:03:10', 1),
(5, 'type3 64GB Blue', 'Active', 9, 1, 3, 3, '2022-07-05 11:23:41', 3, NULL, NULL),
(6, 'type3 64GB White', 'Not Active', 9, 1, 1, 0, '2022-07-08 10:32:25', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_product_type`
--

CREATE TABLE `m_product_type` (
  `m_product_type_id` int(11) NOT NULL,
  `m_product_type_name` varchar(100) NOT NULL,
  `m_product_type_status` varchar(500) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_product_type`
--

INSERT INTO `m_product_type` (`m_product_type_id`, `m_product_type_name`, `m_product_type_status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(7, 'type 2', 'Active', '2022-06-29 10:22:21', 1, NULL, NULL),
(9, 'type3', 'Active', '2022-07-01 12:08:32', 1, '2022-07-05 11:23:05', 3),
(10, 'a', 'Not Active', '2022-07-05 11:23:10', 3, '2022-07-05 11:23:26', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_shop`
--

CREATE TABLE `m_shop` (
  `m_shop_id` int(11) NOT NULL,
  `m_shop_name` varchar(100) DEFAULT NULL,
  `m_shop_telp` varchar(20) DEFAULT NULL,
  `m_shop_status` varchar(20) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_shop`
--

INSERT INTO `m_shop` (`m_shop_id`, `m_shop_name`, `m_shop_telp`, `m_shop_status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(2, 'Shop 1', '00000', 'Active', '2022-07-05 17:40:29', 3, '2022-07-05 17:41:17', 3),
(3, 'Shop 2', '00001', 'Active', '2022-07-05 17:40:50', 3, NULL, NULL),
(4, 'shop 3', '0', 'Not Active', '2022-07-08 10:40:52', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_size`
--

CREATE TABLE `m_size` (
  `m_size_id` int(11) NOT NULL,
  `m_size_name` varchar(10) NOT NULL,
  `m_size_status` varbinary(50) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_size`
--

INSERT INTO `m_size` (`m_size_id`, `m_size_name`, `m_size_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, '64GB', 0x416374697665, 3, '2022-06-29 00:00:52', NULL, NULL),
(2, '128GB', 0x416374697665, 3, '2022-06-29 00:00:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user_group`
--

CREATE TABLE `m_user_group` (
  `m_user_group_id` int(11) NOT NULL,
  `m_user_group_name` varchar(50) DEFAULT NULL,
  `m_user_group_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `m_user_group`
--

INSERT INTO `m_user_group` (`m_user_group_id`, `m_user_group_name`, `m_user_group_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Admin', 'Active', NULL, NULL, 1, '2019-06-25 17:48:12'),
(2, 'Owner', 'Active', 1, '2022-07-22 22:16:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_warehouse`
--

CREATE TABLE `m_warehouse` (
  `m_warehouse_id` int(11) NOT NULL,
  `m_warehouse_name` varchar(100) DEFAULT NULL,
  `m_warehouse_telp` varchar(20) DEFAULT NULL,
  `m_warehouse_status` varchar(20) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_warehouse`
--

INSERT INTO `m_warehouse` (`m_warehouse_id`, `m_warehouse_name`, `m_warehouse_telp`, `m_warehouse_status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(2, 'Warehouse 2', '00000002', 'Active', '2022-06-29 16:25:18', 1, '2022-06-29 16:26:47', 1),
(9, 'Warehouse 3', '00000002', 'Active', '2022-06-29 16:25:18', 1, '2022-06-29 16:26:47', 1),
(11, 'Warehouse 1', '0', 'Not Active', '2022-07-08 10:31:46', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_imei`
--

CREATE TABLE `t_imei` (
  `t_imei_id` int(11) NOT NULL,
  `t_imei_number` varchar(15) NOT NULL,
  `t_imei_status` varchar(50) NOT NULL,
  `m_product_id` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `m_warehouse_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_income_goods_entry`
--

CREATE TABLE `t_income_goods_entry` (
  `t_income_goods_entry_id` int(11) NOT NULL,
  `t_income_goods_entry_code` varchar(255) NOT NULL,
  `t_imei_id` int(11) NOT NULL,
  `m_warehouse_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_outcome_goods_entry`
--

CREATE TABLE `t_outcome_goods_entry` (
  `t_outcome_goods_entry_Id` int(11) NOT NULL,
  `m_shop_id` int(11) DEFAULT NULL,
  `t_imei_id` int(11) DEFAULT NULL,
  `t_outcome_goods_entry_code` varchar(255) DEFAULT NULL,
  `m_warehouse_id` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_return_stock_in`
--

CREATE TABLE `t_return_stock_in` (
  `t_return_stock_in_id` int(11) NOT NULL,
  `m_shop_id` int(11) NOT NULL,
  `t_imei_id_return` int(11) NOT NULL,
  `t_imei_id_replacement` int(11) NOT NULL,
  `m_warehouse_id` int(11) NOT NULL,
  `t_return_stock_in_note` varchar(255) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_stock`
--

CREATE TABLE `t_stock` (
  `t_stock_id` int(11) NOT NULL,
  `t_stock_total` int(11) NOT NULL,
  `m_warehouse_id` int(11) NOT NULL,
  `m_product_id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hs_imei`
--
ALTER TABLE `hs_imei`
  ADD PRIMARY KEY (`hs_imei_id`),
  ADD KEY `t_imei_id` (`t_imei_id`);

--
-- Indeks untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  ADD PRIMARY KEY (`map_feature_id`) USING BTREE,
  ADD KEY `fk_map_feature_m_user_group1_idx` (`m_user_group_id`) USING BTREE,
  ADD KEY `fk_map_feature_m_feature1_idx` (`m_feature_id`) USING BTREE;

--
-- Indeks untuk tabel `m_color`
--
ALTER TABLE `m_color`
  ADD PRIMARY KEY (`m_color_id`) USING BTREE;

--
-- Indeks untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`m_employee_id`) USING BTREE,
  ADD KEY `m_user_group_id` (`m_user_group_id`) USING BTREE,
  ADD KEY `m_position_id` (`m_position_id`) USING BTREE,
  ADD KEY `m_warehouse_id` (`m_warehouse_id`);

--
-- Indeks untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  ADD PRIMARY KEY (`m_feature_id`) USING BTREE,
  ADD KEY `m_feature_group_id` (`m_feature_group_id`) USING BTREE;

--
-- Indeks untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  ADD PRIMARY KEY (`m_feature_group_id`) USING BTREE;

--
-- Indeks untuk tabel `m_position`
--
ALTER TABLE `m_position`
  ADD PRIMARY KEY (`m_position_id`) USING BTREE,
  ADD KEY `m_position_id` (`m_position_id`) USING BTREE;

--
-- Indeks untuk tabel `m_product`
--
ALTER TABLE `m_product`
  ADD PRIMARY KEY (`m_product_id`),
  ADD KEY `m_color_id` (`m_color_id`),
  ADD KEY `m_size_id` (`m_size_id`);

--
-- Indeks untuk tabel `m_product_type`
--
ALTER TABLE `m_product_type`
  ADD PRIMARY KEY (`m_product_type_id`) USING BTREE;

--
-- Indeks untuk tabel `m_shop`
--
ALTER TABLE `m_shop`
  ADD PRIMARY KEY (`m_shop_id`);

--
-- Indeks untuk tabel `m_size`
--
ALTER TABLE `m_size`
  ADD PRIMARY KEY (`m_size_id`);

--
-- Indeks untuk tabel `m_user_group`
--
ALTER TABLE `m_user_group`
  ADD PRIMARY KEY (`m_user_group_id`) USING BTREE;

--
-- Indeks untuk tabel `m_warehouse`
--
ALTER TABLE `m_warehouse`
  ADD PRIMARY KEY (`m_warehouse_id`) USING BTREE,
  ADD KEY `m_warehouse_status` (`m_warehouse_status`);

--
-- Indeks untuk tabel `t_imei`
--
ALTER TABLE `t_imei`
  ADD PRIMARY KEY (`t_imei_id`),
  ADD KEY `m_product_id` (`m_product_id`),
  ADD KEY `m_warehouse_id` (`m_warehouse_id`);

--
-- Indeks untuk tabel `t_income_goods_entry`
--
ALTER TABLE `t_income_goods_entry`
  ADD PRIMARY KEY (`t_income_goods_entry_id`),
  ADD KEY `t_imei_id` (`t_imei_id`),
  ADD KEY `m_warehouse_id` (`m_warehouse_id`);

--
-- Indeks untuk tabel `t_outcome_goods_entry`
--
ALTER TABLE `t_outcome_goods_entry`
  ADD PRIMARY KEY (`t_outcome_goods_entry_Id`) USING BTREE,
  ADD KEY `m_shop_id` (`m_shop_id`),
  ADD KEY `t_imei_id` (`t_imei_id`);

--
-- Indeks untuk tabel `t_return_stock_in`
--
ALTER TABLE `t_return_stock_in`
  ADD PRIMARY KEY (`t_return_stock_in_id`),
  ADD KEY `m_shop_id` (`m_shop_id`),
  ADD KEY `t_imei_id_return` (`t_imei_id_return`),
  ADD KEY `t_imei_id_replacement` (`t_imei_id_replacement`),
  ADD KEY `m_warehouse_id` (`m_warehouse_id`);

--
-- Indeks untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  ADD PRIMARY KEY (`t_stock_id`),
  ADD KEY `m_product_id` (`m_product_id`),
  ADD KEY `m_warehouse_id` (`m_warehouse_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hs_imei`
--
ALTER TABLE `hs_imei`
  MODIFY `hs_imei_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;

--
-- AUTO_INCREMENT untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  MODIFY `map_feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `m_color`
--
ALTER TABLE `m_color`
  MODIFY `m_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  MODIFY `m_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  MODIFY `m_feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  MODIFY `m_feature_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `m_position`
--
ALTER TABLE `m_position`
  MODIFY `m_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_product`
--
ALTER TABLE `m_product`
  MODIFY `m_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_product_type`
--
ALTER TABLE `m_product_type`
  MODIFY `m_product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `m_shop`
--
ALTER TABLE `m_shop`
  MODIFY `m_shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_size`
--
ALTER TABLE `m_size`
  MODIFY `m_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_user_group`
--
ALTER TABLE `m_user_group`
  MODIFY `m_user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_warehouse`
--
ALTER TABLE `m_warehouse`
  MODIFY `m_warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_imei`
--
ALTER TABLE `t_imei`
  MODIFY `t_imei_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT untuk tabel `t_income_goods_entry`
--
ALTER TABLE `t_income_goods_entry`
  MODIFY `t_income_goods_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT untuk tabel `t_outcome_goods_entry`
--
ALTER TABLE `t_outcome_goods_entry`
  MODIFY `t_outcome_goods_entry_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `t_return_stock_in`
--
ALTER TABLE `t_return_stock_in`
  MODIFY `t_return_stock_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  MODIFY `t_stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hs_imei`
--
ALTER TABLE `hs_imei`
  ADD CONSTRAINT `hs_imei_ibfk_1` FOREIGN KEY (`t_imei_id`) REFERENCES `t_imei` (`t_imei_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  ADD CONSTRAINT `map_feature_ibfk_1` FOREIGN KEY (`m_feature_id`) REFERENCES `m_feature` (`m_feature_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `map_feature_ibfk_2` FOREIGN KEY (`m_user_group_id`) REFERENCES `m_user_group` (`m_user_group_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  ADD CONSTRAINT `m_employee_ibfk_1` FOREIGN KEY (`m_position_id`) REFERENCES `m_position` (`m_position_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_employee_ibfk_2` FOREIGN KEY (`m_user_group_id`) REFERENCES `m_user_group` (`m_user_group_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_employee_ibfk_3` FOREIGN KEY (`m_warehouse_id`) REFERENCES `m_warehouse` (`m_warehouse_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  ADD CONSTRAINT `m_feature_ibfk_1` FOREIGN KEY (`m_feature_group_id`) REFERENCES `m_feature_group` (`m_feature_group_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_product`
--
ALTER TABLE `m_product`
  ADD CONSTRAINT `m_product_ibfk_1` FOREIGN KEY (`m_color_id`) REFERENCES `m_color` (`m_color_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_product_ibfk_2` FOREIGN KEY (`m_size_id`) REFERENCES `m_size` (`m_size_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_imei`
--
ALTER TABLE `t_imei`
  ADD CONSTRAINT `t_imei_ibfk_1` FOREIGN KEY (`m_product_id`) REFERENCES `m_product` (`m_product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_imei_ibfk_2` FOREIGN KEY (`m_warehouse_id`) REFERENCES `m_warehouse` (`m_warehouse_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_income_goods_entry`
--
ALTER TABLE `t_income_goods_entry`
  ADD CONSTRAINT `t_income_goods_entry_ibfk_1` FOREIGN KEY (`t_imei_id`) REFERENCES `t_imei` (`t_imei_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_income_goods_entry_ibfk_2` FOREIGN KEY (`m_warehouse_id`) REFERENCES `m_warehouse` (`m_warehouse_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_outcome_goods_entry`
--
ALTER TABLE `t_outcome_goods_entry`
  ADD CONSTRAINT `t_outcome_goods_entry_ibfk_1` FOREIGN KEY (`m_shop_id`) REFERENCES `m_shop` (`m_shop_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_outcome_goods_entry_ibfk_2` FOREIGN KEY (`t_imei_id`) REFERENCES `t_imei` (`t_imei_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_return_stock_in`
--
ALTER TABLE `t_return_stock_in`
  ADD CONSTRAINT `t_return_stock_in_ibfk_1` FOREIGN KEY (`m_shop_id`) REFERENCES `m_shop` (`m_shop_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_return_stock_in_ibfk_2` FOREIGN KEY (`t_imei_id_return`) REFERENCES `t_imei` (`t_imei_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_return_stock_in_ibfk_3` FOREIGN KEY (`t_imei_id_replacement`) REFERENCES `t_imei` (`t_imei_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_return_stock_in_ibfk_4` FOREIGN KEY (`m_warehouse_id`) REFERENCES `m_warehouse` (`m_warehouse_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_stock`
--
ALTER TABLE `t_stock`
  ADD CONSTRAINT `t_stock_ibfk_1` FOREIGN KEY (`m_product_id`) REFERENCES `m_product` (`m_product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_stock_ibfk_2` FOREIGN KEY (`m_warehouse_id`) REFERENCES `m_warehouse` (`m_warehouse_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
