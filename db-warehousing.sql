-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2020 pada 15.12
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-warehousing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `map_contact`
--

CREATE TABLE `map_contact` (
  `map_contact_id` int(11) NOT NULL,
  `m_contact_id` int(11) DEFAULT NULL,
  `m_contact_type_id` int(11) DEFAULT NULL,
  `map_contact_note` varchar(50) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `map_contact`
--

INSERT INTO `map_contact` (`map_contact_id`, `m_contact_id`, `m_contact_type_id`, `map_contact_note`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 1, 5, '02130056132', '2019-10-17 07:58:58', 1, '2019-11-03 06:57:51', 1),
(2, 1, 1, '02130056133', '2019-10-17 07:58:58', 1, '2019-11-03 06:57:51', 1),
(3, 1, 1, '02130056233', '2019-10-17 07:58:58', 1, '2019-11-03 06:57:51', 1),
(4, 2, 2, '081228180812', '2019-10-17 08:32:21', 1, '2019-10-17 09:45:39', 1),
(5, 2, 5, '082281808122', '2019-10-17 09:45:39', 1, NULL, NULL),
(6, 3, 1, '1234', '2019-11-03 06:24:50', 1, NULL, NULL),
(7, 1, 2, '123', '2019-11-03 06:57:51', 1, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `map_feature`
--

INSERT INTO `map_feature` (`map_feature_id`, `m_user_group_id`, `m_feature_id`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 1, 1, 1, '2019-10-02 05:25:12', 1, '2019-10-02 05:28:06'),
(2, 1, 13, 1, '2019-10-02 05:28:06', NULL, NULL),
(3, 1, 22, 1, '2019-10-02 05:28:06', NULL, NULL),
(4, 1, 17, 1, '2019-10-02 05:28:06', NULL, NULL),
(5, 1, 21, 1, '2019-10-02 05:28:06', NULL, NULL),
(6, 1, 10, 1, '2019-10-02 05:28:06', NULL, NULL),
(7, 1, 16, 1, '2019-10-02 05:28:06', NULL, NULL),
(8, 1, 15, 1, '2019-10-02 05:28:06', NULL, NULL),
(9, 1, 6, 1, '2019-10-02 05:28:06', NULL, NULL),
(10, 1, 2, 1, '2019-10-02 05:28:06', NULL, NULL),
(11, 1, 8, 1, '2019-10-02 05:28:06', NULL, NULL),
(12, 1, 12, 1, '2019-10-02 05:28:06', NULL, NULL),
(13, 1, 18, 1, '2019-10-02 05:28:06', NULL, NULL),
(14, 1, 14, 1, '2019-10-02 05:28:06', NULL, NULL),
(15, 1, 5, 1, '2019-10-02 05:28:06', NULL, NULL),
(16, 1, 3, 1, '2019-10-02 05:28:06', NULL, NULL),
(17, 1, 19, 1, '2019-10-02 05:28:06', NULL, NULL),
(18, 1, 20, 1, '2019-10-02 05:28:06', NULL, NULL),
(19, 1, 11, 1, '2019-10-02 05:28:06', NULL, NULL),
(20, 1, 23, 1, '2019-10-02 05:28:06', NULL, NULL),
(21, 1, 7, 1, '2019-10-02 05:28:06', NULL, NULL),
(22, 1, 9, 1, '2019-10-02 05:28:06', NULL, NULL),
(23, 1, 4, 1, '2019-10-02 05:28:06', NULL, NULL),
(24, 1, 24, 1, '2019-10-02 05:28:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_building`
--

CREATE TABLE `m_building` (
  `m_building_id` int(11) NOT NULL,
  `m_building_name` varchar(50) DEFAULT NULL,
  `m_building_address` varchar(200) DEFAULT NULL,
  `m_building_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_building`
--

INSERT INTO `m_building` (`m_building_id`, `m_building_name`, `m_building_address`, `m_building_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Axa Tower', 'AXA Tower Kuningan City Lt. 33 Suite 01,07\r\nJl. Prof. Dr. Satrio Kav. 18 Karet Kuningan\r\nSetiabudi – Jakarta Selatan 12940\r\nTelp: 021- 30056133, 30056233\r\nFax : 021- 30056132', 'Active', 1, '2019-07-23 10:06:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_company`
--

CREATE TABLE `m_company` (
  `m_company_id` int(11) NOT NULL,
  `m_company_name` varchar(50) DEFAULT NULL,
  `m_company_address` varchar(200) DEFAULT NULL,
  `m_company_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_company`
--

INSERT INTO `m_company` (`m_company_id`, `m_company_name`, `m_company_address`, `m_company_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'PT. Mitra Cakrawala International', 'AXA Tower Kuningan City Lt. 33 Suite 01,07\r\nJl. Prof. Dr. Satrio Kav. 18 Karet Kuningan\r\nSetiabudi – Jakarta Selatan 12940', 'Active', 1, '2019-10-17 07:58:58', 1, '2019-11-03 06:34:53'),
(2, 'qww', 'qww', 'Not Active', 1, '2019-11-03 06:24:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_contact`
--

CREATE TABLE `m_contact` (
  `m_contact_id` int(11) NOT NULL,
  `m_contact_name` varchar(50) DEFAULT NULL,
  `m_contact_company` varchar(50) DEFAULT NULL,
  `m_contact_position` varchar(50) DEFAULT NULL,
  `m_contact_type_ref` varchar(50) NOT NULL,
  `m_contact_ref` int(11) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_contact`
--

INSERT INTO `m_contact` (`m_contact_id`, `m_contact_name`, `m_contact_company`, `m_contact_position`, `m_contact_type_ref`, `m_contact_ref`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'PT. Mitra Cakrawala International', 'PT. Mitra Cakrawala International', '', 'Company', 1, 1, '2019-10-17 07:58:58', 1, '2019-11-03 06:57:51'),
(2, 'Wardah LS', 'UD. Aneka Karya Makmur', 'Sales', 'Vendor', 1, 1, '2019-10-17 08:32:21', 1, '2019-10-17 09:45:39'),
(3, 'qww', 'qww', NULL, 'Company', 2, 1, '2019-11-03 06:24:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_contact_type`
--

CREATE TABLE `m_contact_type` (
  `m_contact_type_id` int(11) NOT NULL,
  `m_contact_type_name` varchar(50) DEFAULT NULL,
  `m_contact_type_text` varchar(200) DEFAULT NULL,
  `m_contact_type_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_contact_type`
--

INSERT INTO `m_contact_type` (`m_contact_type_id`, `m_contact_type_name`, `m_contact_type_text`, `m_contact_type_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Telepon', 'Number', 'Active', NULL, NULL, 1, '2019-06-26 15:46:03'),
(2, 'Handphone', 'Number', 'Active', 1, '2019-06-22 09:23:45', 1, '2019-07-31 15:37:53'),
(3, 'Email', 'Alfabeth & number', 'Active', 1, '2019-06-22 09:23:51', 1, '2019-07-31 15:37:47'),
(4, 'Website', 'Alfabeth & number', 'Active', 1, '2019-07-31 15:37:10', NULL, NULL),
(5, 'Fax', 'Number', 'Active', 1, '2019-10-17 08:03:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_device`
--

CREATE TABLE `m_device` (
  `m_device_id` int(11) NOT NULL,
  `m_device_type_id` int(11) DEFAULT NULL,
  `m_location_id` int(11) DEFAULT NULL,
  `m_vendor_id` int(11) DEFAULT NULL,
  `m_device_date` date NOT NULL,
  `m_device_code` varchar(20) DEFAULT NULL,
  `m_device_name` varchar(50) DEFAULT NULL,
  `m_device_brand` varchar(20) DEFAULT NULL,
  `m_device_model` varchar(20) DEFAULT NULL,
  `m_device_color` varchar(20) DEFAULT NULL,
  `m_device_serial_number` varchar(50) DEFAULT NULL,
  `m_device_description` varchar(1000) DEFAULT NULL,
  `m_device_file` varchar(200) NOT NULL,
  `m_device_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_device`
--

INSERT INTO `m_device` (`m_device_id`, `m_device_type_id`, `m_location_id`, `m_vendor_id`, `m_device_date`, `m_device_code`, `m_device_name`, `m_device_brand`, `m_device_model`, `m_device_color`, `m_device_serial_number`, `m_device_description`, `m_device_file`, `m_device_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 3, 8, 1, '0000-00-00', 'SCR/2019.07.0001', 'Screen', '-', '', '', '', '', '', 'Active', 1, '2019-07-23 11:27:00', 1, '2019-10-17 08:49:05'),
(2, 1, 8, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV', 'Samsung', '', 'Black', '', '', '', 'Active', 1, '2019-07-23 11:28:21', NULL, NULL),
(3, 4, 8, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer', 'Epson', 'L120', 'Black', '', '', '', 'Active', 1, '2019-07-23 11:28:49', NULL, NULL),
(4, 5, 8, 1, '0000-00-00', 'PJR/2019.07.0001', 'Projector', 'Hitachi', '', 'White', '', '', '', 'Active', 1, '2019-07-23 11:29:16', NULL, NULL),
(5, 6, 8, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan', 'Eubiq', 'Kotak', 'Silver', '', '', '', 'Active', 1, '2019-07-23 11:30:02', NULL, NULL),
(6, 1, 7, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:34:52', NULL, NULL),
(7, 1, 7, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV', 'Toshiba', '', '', '', '', '', 'Active', 1, '2019-07-23 11:44:04', NULL, NULL),
(8, 3, 7, 1, '0000-00-00', 'SCR/2019.07.0001', 'Screen', '--', '', '', '', '', '', 'Active', 1, '2019-07-23 11:44:46', NULL, NULL),
(9, 5, 7, 1, '0000-00-00', 'PJR/2019.07.0001', 'Projector', 'Infocus', '', '', '', '', '', 'Active', 1, '2019-07-23 11:45:14', NULL, NULL),
(10, 6, 7, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:46:06', NULL, NULL),
(11, 6, 9, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan.', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:46:52', NULL, NULL),
(12, 5, 9, 1, '0000-00-00', 'PJR/2019.07.0001', 'Projector.', 'Infocus', '', '', '', '', '', 'Active', 1, '2019-07-23 11:47:57', NULL, NULL),
(13, 6, 3, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan..', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:48:47', NULL, NULL),
(14, 10, 3, 1, '0000-00-00', 'SMB/2019.07.0001', 'Smartboard', 'Newline', '', '', '', '', '', 'Active', 1, '2019-07-23 11:49:26', NULL, NULL),
(15, 7, 3, 1, '0000-00-00', 'TLP/2019.07.0001', 'Telephone', 'Panasonic', '', '', '', '', '', 'Active', 1, '2019-07-23 11:50:03', NULL, NULL),
(16, 1, 6, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV.', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:50:59', NULL, NULL),
(17, 6, 6, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan...', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:51:48', NULL, NULL),
(18, 1, 1, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV..', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:52:36', NULL, NULL),
(19, 6, 1, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan....', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:53:39', NULL, NULL),
(20, 1, 2, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV...', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:54:05', NULL, NULL),
(21, 6, 2, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan.....', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:54:35', NULL, NULL),
(22, 1, 5, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV....', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:55:02', NULL, NULL),
(23, 6, 5, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan......', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:55:23', NULL, NULL),
(24, 1, 4, 1, '0000-00-00', 'TV/2019.07.0001', 'Flat TV.....', 'LG', '', '', '', '', '', 'Active', 1, '2019-07-23 11:55:47', NULL, NULL),
(25, 6, 4, 1, '0000-00-00', 'PLG/2019.07.0001', 'Colokan.......', 'Eubiq', '', '', '', '', '', 'Active', 1, '2019-07-23 11:56:18', NULL, NULL),
(26, 11, 10, 1, '0000-00-00', 'FGR/2019.07.0001', 'Fingerprint', 'Fingerspot', '', '', '', '', '', 'Active', 1, '2019-07-23 11:58:20', NULL, NULL),
(27, 4, 11, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer', 'Epson', 'L355', '', '', '', '', 'Active', 1, '2019-07-23 11:59:54', NULL, NULL),
(28, 4, 12, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer', 'Epson', 'L365', '', '', '', '', 'Active', 1, '2019-07-23 12:00:19', NULL, NULL),
(29, 4, 11, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer.', 'Epson', 'L355', '', '', '', '', 'Active', 1, '2019-07-23 12:00:57', NULL, NULL),
(30, 4, 11, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer', 'Epson', 'L385', '', '', '', '', 'Active', 1, '2019-07-23 12:01:21', NULL, NULL),
(31, 4, 10, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer.', 'Epson', 'L385', '', '', '', '', 'Active', 1, '2019-07-23 12:02:04', NULL, NULL),
(32, 4, 10, 1, '0000-00-00', 'PRT/2019.07.0001', 'Printer..', 'Epson', 'L385', '', '', '', '', 'Active', 1, '2019-07-23 12:02:50', NULL, NULL),
(33, 9, 11, 1, '0000-00-00', 'MFP/2019.07.0001', 'Mesin Foto Copy', 'Samsung', 'SCX-8128NX', '', '', '', '', 'Active', 1, '2019-07-23 12:04:10', NULL, NULL),
(34, 8, 11, 1, '0000-00-00', 'NB/2019.07.0001', 'Laptop', 'Lenovo', 'G480', '', '', '', '', 'Active', 1, '2019-07-23 12:04:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_device_type`
--

CREATE TABLE `m_device_type` (
  `m_device_type_id` int(11) NOT NULL,
  `m_device_type_code` varchar(5) DEFAULT NULL,
  `m_device_type_name` varchar(50) DEFAULT NULL,
  `m_device_type_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_device_type`
--

INSERT INTO `m_device_type` (`m_device_type_id`, `m_device_type_code`, `m_device_type_name`, `m_device_type_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'TV', 'Televisi', 'Active', 1, '2019-06-27 14:48:31', 1, '2019-07-23 11:02:30'),
(2, 'Hdr', 'Hardisk', 'Active', 1, '2019-07-23 10:04:47', NULL, NULL),
(3, 'SCR', 'Screen', 'Active', 1, '2019-07-23 11:02:43', NULL, NULL),
(4, 'PRT', 'Printer', 'Active', 1, '2019-07-23 11:02:56', NULL, NULL),
(5, 'PJR', 'Projector', 'Active', 1, '2019-07-23 11:03:06', NULL, NULL),
(6, 'PLG', 'Plugs', 'Active', 1, '2019-07-23 11:03:18', NULL, NULL),
(7, 'TLP', 'Telephone', 'Active', 1, '2019-07-23 11:03:31', NULL, NULL),
(8, 'NB', 'Notebook', 'Active', 1, '2019-07-23 11:03:52', 1, '2019-07-23 11:04:03'),
(9, 'MFP', 'Mesin Foto Copy', 'Active', 1, '2019-07-23 11:04:36', NULL, NULL),
(10, 'SMB', 'Smartboard', 'Active', 1, '2019-07-23 11:05:00', NULL, NULL),
(11, 'FGR', 'Fingerprint', 'Active', 1, '2019-07-23 11:57:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_email_setting`
--

CREATE TABLE `m_email_setting` (
  `m_email_setting_id` int(11) NOT NULL,
  `m_email_setting_name` varchar(100) DEFAULT NULL,
  `m_company_id` int(11) DEFAULT NULL,
  `m_email_setting_crypto` varchar(5) DEFAULT NULL,
  `m_email_setting_host` varchar(100) DEFAULT NULL,
  `m_email_setting_port` int(11) DEFAULT NULL,
  `m_email_setting_user` varchar(50) DEFAULT NULL,
  `m_email_setting_password` varchar(20) DEFAULT NULL,
  `m_email_setting_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_email_setting`
--

INSERT INTO `m_email_setting` (`m_email_setting_id`, `m_email_setting_name`, `m_company_id`, `m_email_setting_crypto`, `m_email_setting_host`, `m_email_setting_port`, `m_email_setting_user`, `m_email_setting_password`, `m_email_setting_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Mitra Cakrawala International', 1, 'tls', 'wpiix9.rumahweb.com', 587, 'Yonatan@street88shop.com', 'TmF2aTA4MTE=', 'Active', 1, '2019-07-23 16:22:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_employee`
--

CREATE TABLE `m_employee` (
  `m_employee_id` int(11) NOT NULL,
  `m_position_id` int(11) DEFAULT NULL,
  `m_user_group_id` int(11) DEFAULT NULL,
  `m_employee_full_name` varchar(50) DEFAULT NULL,
  `m_employee_sort_name` varchar(10) NOT NULL,
  `m_employee_email` varchar(50) DEFAULT NULL,
  `m_employee_email_verification` tinyint(1) DEFAULT NULL,
  `m_employee_username` varchar(50) DEFAULT NULL,
  `m_employee_password` varchar(20) DEFAULT NULL,
  `m_employee_status` varchar(20) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_employee`
--

INSERT INTO `m_employee` (`m_employee_id`, `m_position_id`, `m_user_group_id`, `m_employee_full_name`, `m_employee_sort_name`, `m_employee_email`, `m_employee_email_verification`, `m_employee_username`, `m_employee_password`, `m_employee_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 2, 1, 'Admin', 'admin', 'yonatan@street88shop.com', 1, 'admin', 'MTExMTEx', 'Active', NULL, NULL, 1, '2019-07-23 16:23:55'),
(3, 2, 1, 'Wardah Lucianna Suhalim', 'Wardah', 'wardah.rose123@gmail.com', 1, 'wardah', 'MDAwMDAw', 'Active', 1, '2020-02-24 14:06:51', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_feature`
--

INSERT INTO `m_feature` (`m_feature_id`, `m_feature_group_id`, `m_feature_name`, `m_feature_url`, `m_feature_icon`, `m_feature_visible`, `m_feature_squance`, `m_feature_menu_type`, `m_feature_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 1, 'Feature Group', 'm_feature_group_controller/index', '', 1, 2, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 17:58:08'),
(2, 1, 'Feature', 'm_feature_controller/index', '', 1, 1, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:14:09'),
(3, 2, 'Position', 'm_position_controller/index', '', 1, 4, 'Left menu', 'Active', NULL, NULL, 1, '2019-07-06 16:02:20'),
(4, 1, 'User Group', 'm_user_group_controller/index', '', 1, 4, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:28:33'),
(5, 4, 'Log Out', 's_login_controller/index', 'fa fa-sign-out', 1, 5, 'Top menu', 'Active', NULL, NULL, 1, '2019-07-07 17:30:59'),
(6, 2, 'Employee', 'm_employee_controller/index', '', 1, 3, 'Left menu', 'Active', NULL, NULL, 1, '2019-07-06 16:02:16'),
(7, 4, 'Setting Email', 's_email_setting_controller/index', 'fa fa-cogs', 1, 4, 'Top menu', 'Active', NULL, NULL, 1, '2019-07-07 17:31:24'),
(8, 1, 'Feature Map', 'map_feature_controller/index', '', 1, 3, 'Left menu', 'Active', NULL, NULL, 1, '2019-06-25 19:28:18'),
(9, 2, 'Type Contact', 'm_contact_type_controller/index', '', 1, 5, 'Left menu', 'Active', NULL, NULL, 1, '2019-07-06 16:02:25'),
(10, 2, 'Contact', 'm_contact_controller/index', '', 1, 2, 'Left menu', 'Active', 1, '2019-06-17 15:19:45', 1, '2019-07-06 16:02:09'),
(11, 3, 'Room', 'm_room_controller/index', '', 1, 6, 'Left menu', 'Active', 1, '2019-06-22 20:00:09', 1, '2019-06-26 16:43:10'),
(12, 3, 'Floor', 'm_floor_controller/index', '', 1, 4, 'Left menu', 'Active', 1, '2019-06-23 04:53:00', 1, '2019-06-26 16:43:52'),
(13, 3, 'Building', 'm_building_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2019-06-23 05:12:43', 1, '2019-06-26 16:41:04'),
(14, 3, 'Location', 'm_location_controller/index', '', 1, 5, 'Left menu', 'Active', 1, '2019-06-23 07:53:00', 1, '2019-06-26 16:44:09'),
(15, 3, 'Device Type', 'm_device_type_controller/index', '', 1, 3, 'Left menu', 'Active', 1, '2019-06-23 09:14:32', 1, '2019-06-26 16:43:42'),
(16, 3, 'Device', 'm_device_controller/index', '', 1, 2, 'Left menu', 'Active', 1, '2019-06-23 09:15:10', 1, '2019-06-26 16:43:31'),
(17, 4, 'Change Password', 's_change_password_controller/index', 'fa fa-key', 1, 2, 'Top menu', 'Active', 1, '2019-06-26 17:01:37', 1, '2019-07-07 17:30:44'),
(18, 5, 'Home', 'h_home_controller/index', '', 0, 1, 'Left menu', 'Active', 1, '2019-06-26 18:46:21', 1, '2019-06-26 19:06:38'),
(19, 4, 'Profile', 's_profile_controller/index', 'fa fa-user', 1, 3, 'Top menu', 'Active', 1, '2019-06-26 19:11:58', 1, '2019-07-07 17:31:19'),
(20, 6, 'Report Asset', 'r_asset_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2019-06-30 13:38:03', 1, '2019-06-30 15:51:25'),
(21, 2, 'Company', 'm_company_controller/index', '', 1, 1, 'Left menu', 'Active', 1, '2019-07-06 15:53:29', 1, '2019-10-17 07:57:05'),
(22, 4, 'Change Logo', 's_change_logo_controller/index', 'fa fa-picture-o', 1, 1, 'Top menu', 'Active', 1, '2019-07-07 17:28:13', 1, '2019-07-07 17:40:43'),
(23, 4, 'Scan QR Code', 's_scan_qr_controller/index', '', 0, 6, 'Top menu', 'Active', 1, '2019-07-09 15:52:02', 1, '2019-07-09 15:55:53'),
(24, 2, 'Vendor', 'm_vendor_controller/index', '', 1, 6, 'Left menu', 'Active', 1, '2019-09-25 16:27:06', 1, '2019-09-25 16:28:56');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_feature_group`
--

INSERT INTO `m_feature_group` (`m_feature_group_id`, `m_feature_group_name`, `m_feature_group_url`, `m_feature_group_icon`, `m_feature_group_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Access', '', 'fa fa-key', 'Active', NULL, NULL, 1, '2019-06-25 19:14:25'),
(2, 'General', '', 'fa fa-book', 'Active', NULL, NULL, 1, '2019-06-25 19:12:04'),
(3, 'Asset', '', 'fa fa-tv', 'Active', NULL, NULL, 1, '2019-06-25 19:12:57'),
(4, 'Setting', '', '', 'Active', NULL, NULL, 1, '2019-06-26 18:43:19'),
(5, 'Home', 'h_home_email_controller/index', 'fa fa-home', 'Active', NULL, NULL, 1, '2019-06-26 19:00:53'),
(6, 'Report', '', ' fa fa-file-text', 'Active', NULL, NULL, 1, '2019-06-30 13:43:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_floor`
--

CREATE TABLE `m_floor` (
  `m_floor_id` int(11) NOT NULL,
  `m_floor_name` varchar(20) DEFAULT NULL,
  `m_floor_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_floor`
--

INSERT INTO `m_floor` (`m_floor_id`, `m_floor_name`, `m_floor_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Lt 33', 'Active', 1, '2019-07-23 10:05:14', NULL, NULL),
(2, 'Lt 32', 'Active', 1, '2019-07-23 10:05:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_location`
--

CREATE TABLE `m_location` (
  `m_location_id` int(11) NOT NULL,
  `m_location_name` varchar(200) DEFAULT NULL,
  `m_building_id` int(11) DEFAULT NULL,
  `m_floor_id` int(11) DEFAULT NULL,
  `m_room_id` int(11) DEFAULT NULL,
  `m_location_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_location`
--

INSERT INTO `m_location` (`m_location_id`, `m_location_name`, `m_building_id`, `m_floor_id`, `m_room_id`, `m_location_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Binuang', 1, 2, 1, 'Active', 1, '2019-07-23 10:07:12', 1, '2019-07-23 11:09:00'),
(2, 'Energy', 1, 2, 1, 'Active', 1, '2019-07-23 11:09:43', NULL, NULL),
(3, 'WIN', 1, 2, 1, 'Active', 1, '2019-07-23 11:09:57', NULL, NULL),
(4, 'Finance', 1, 2, 1, 'Active', 1, '2019-07-23 11:10:12', NULL, NULL),
(5, 'Linton', 1, 2, 1, 'Active', 1, '2019-07-23 11:10:25', NULL, NULL),
(6, 'KM 12', 1, 2, 1, 'Active', 1, '2019-07-23 11:10:39', NULL, NULL),
(7, 'Warroom', 1, 1, 1, 'Active', 1, '2019-07-23 11:11:17', NULL, NULL),
(8, 'Meeting Besar', 1, 1, 1, 'Active', 1, '2019-07-23 11:11:39', NULL, NULL),
(9, 'Meeting Depan', 1, 1, 1, 'Active', 1, '2019-07-23 11:11:54', NULL, NULL),
(10, 'SGFI Room', 1, 2, 2, 'Active', 1, '2019-07-23 11:57:29', NULL, NULL),
(11, 'MCI', 1, 1, 2, 'Active', 1, '2019-07-23 11:58:48', NULL, NULL),
(12, 'BMB', 1, 1, 2, 'Active', 1, '2019-07-23 11:59:16', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_position`
--

INSERT INTO `m_position` (`m_position_id`, `m_position_name`, `m_position_status`, `m_position_top_manager`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Root', 'Active', '1', 1, '2019-06-12 18:23:07', 1, '2019-06-25 20:21:42'),
(2, 'Adminstrator', 'Active', '1', 1, '2019-06-12 18:23:07', 1, '2019-07-16 16:17:26'),
(3, 'Staff', 'Active', '2', 1, '2019-07-23 09:39:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_room`
--

CREATE TABLE `m_room` (
  `m_room_id` int(11) NOT NULL,
  `m_room_name` varchar(50) DEFAULT NULL,
  `m_room_status` varchar(20) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_room`
--

INSERT INTO `m_room` (`m_room_id`, `m_room_name`, `m_room_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Meeting Room', 'Active', 1, '2019-07-23 11:08:43', 1, '2019-07-23 11:09:27'),
(2, 'Office Room', 'Active', 1, '2019-07-23 11:09:19', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_user_group`
--

INSERT INTO `m_user_group` (`m_user_group_id`, `m_user_group_name`, `m_user_group_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'Admin', 'Active', NULL, NULL, 1, '2019-06-25 17:48:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_vendor`
--

CREATE TABLE `m_vendor` (
  `m_vendor_id` int(11) NOT NULL,
  `m_vendor_name` varchar(100) NOT NULL,
  `m_vendor_person` varchar(50) NOT NULL,
  `m_vendor_person_position` varchar(50) NOT NULL,
  `m_vendor_address` varchar(1000) NOT NULL,
  `m_vendor_status` varchar(20) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_vendor`
--

INSERT INTO `m_vendor` (`m_vendor_id`, `m_vendor_name`, `m_vendor_person`, `m_vendor_person_position`, `m_vendor_address`, `m_vendor_status`, `create_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, 'UD. Aneka Karya Makmur', 'Wardah LS', 'Sales', 'Dusun Wonokoyo Kulon No.53', 'Active', 1, '2019-10-17 08:32:21', 1, '2019-10-17 09:45:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `map_contact`
--
ALTER TABLE `map_contact`
  ADD PRIMARY KEY (`map_contact_id`),
  ADD KEY `fk_map_contact_person_m_contact_person1_idx` (`m_contact_id`),
  ADD KEY `fk_map_contact_person_m_type_contact_person1_idx` (`m_contact_type_id`);

--
-- Indeks untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  ADD PRIMARY KEY (`map_feature_id`),
  ADD KEY `fk_map_feature_m_user_group1_idx` (`m_user_group_id`),
  ADD KEY `fk_map_feature_m_feature1_idx` (`m_feature_id`);

--
-- Indeks untuk tabel `m_building`
--
ALTER TABLE `m_building`
  ADD PRIMARY KEY (`m_building_id`);

--
-- Indeks untuk tabel `m_company`
--
ALTER TABLE `m_company`
  ADD PRIMARY KEY (`m_company_id`);

--
-- Indeks untuk tabel `m_contact`
--
ALTER TABLE `m_contact`
  ADD PRIMARY KEY (`m_contact_id`);

--
-- Indeks untuk tabel `m_contact_type`
--
ALTER TABLE `m_contact_type`
  ADD PRIMARY KEY (`m_contact_type_id`);

--
-- Indeks untuk tabel `m_device`
--
ALTER TABLE `m_device`
  ADD PRIMARY KEY (`m_device_id`),
  ADD KEY `m_device_type_id` (`m_device_type_id`,`m_location_id`),
  ADD KEY `m_location_id` (`m_location_id`),
  ADD KEY `m_vendor_id` (`m_vendor_id`);

--
-- Indeks untuk tabel `m_device_type`
--
ALTER TABLE `m_device_type`
  ADD PRIMARY KEY (`m_device_type_id`);

--
-- Indeks untuk tabel `m_email_setting`
--
ALTER TABLE `m_email_setting`
  ADD PRIMARY KEY (`m_email_setting_id`),
  ADD KEY `m_company_id` (`m_company_id`);

--
-- Indeks untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`m_employee_id`),
  ADD KEY `m_position_id` (`m_position_id`),
  ADD KEY `m_user_group_id` (`m_user_group_id`);

--
-- Indeks untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  ADD PRIMARY KEY (`m_feature_id`),
  ADD KEY `m_feature_group_id` (`m_feature_group_id`);

--
-- Indeks untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  ADD PRIMARY KEY (`m_feature_group_id`);

--
-- Indeks untuk tabel `m_floor`
--
ALTER TABLE `m_floor`
  ADD PRIMARY KEY (`m_floor_id`);

--
-- Indeks untuk tabel `m_location`
--
ALTER TABLE `m_location`
  ADD PRIMARY KEY (`m_location_id`),
  ADD KEY `m_building_id` (`m_building_id`,`m_floor_id`,`m_room_id`),
  ADD KEY `m_floor_id` (`m_floor_id`),
  ADD KEY `m_room_id` (`m_room_id`);

--
-- Indeks untuk tabel `m_position`
--
ALTER TABLE `m_position`
  ADD PRIMARY KEY (`m_position_id`),
  ADD KEY `m_position_id` (`m_position_id`);

--
-- Indeks untuk tabel `m_room`
--
ALTER TABLE `m_room`
  ADD PRIMARY KEY (`m_room_id`);

--
-- Indeks untuk tabel `m_user_group`
--
ALTER TABLE `m_user_group`
  ADD PRIMARY KEY (`m_user_group_id`);

--
-- Indeks untuk tabel `m_vendor`
--
ALTER TABLE `m_vendor`
  ADD PRIMARY KEY (`m_vendor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `map_contact`
--
ALTER TABLE `map_contact`
  MODIFY `map_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  MODIFY `map_feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `m_building`
--
ALTER TABLE `m_building`
  MODIFY `m_building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_company`
--
ALTER TABLE `m_company`
  MODIFY `m_company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_contact`
--
ALTER TABLE `m_contact`
  MODIFY `m_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_contact_type`
--
ALTER TABLE `m_contact_type`
  MODIFY `m_contact_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `m_device`
--
ALTER TABLE `m_device`
  MODIFY `m_device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `m_device_type`
--
ALTER TABLE `m_device_type`
  MODIFY `m_device_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `m_email_setting`
--
ALTER TABLE `m_email_setting`
  MODIFY `m_email_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  MODIFY `m_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  MODIFY `m_feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `m_feature_group`
--
ALTER TABLE `m_feature_group`
  MODIFY `m_feature_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_floor`
--
ALTER TABLE `m_floor`
  MODIFY `m_floor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_location`
--
ALTER TABLE `m_location`
  MODIFY `m_location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `m_position`
--
ALTER TABLE `m_position`
  MODIFY `m_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_room`
--
ALTER TABLE `m_room`
  MODIFY `m_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_user_group`
--
ALTER TABLE `m_user_group`
  MODIFY `m_user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_vendor`
--
ALTER TABLE `m_vendor`
  MODIFY `m_vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `map_contact`
--
ALTER TABLE `map_contact`
  ADD CONSTRAINT `map_contact_ibfk_1` FOREIGN KEY (`m_contact_type_id`) REFERENCES `m_contact_type` (`m_contact_type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `map_contact_ibfk_2` FOREIGN KEY (`m_contact_id`) REFERENCES `m_contact` (`m_contact_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `map_feature`
--
ALTER TABLE `map_feature`
  ADD CONSTRAINT `map_feature_ibfk_1` FOREIGN KEY (`m_feature_id`) REFERENCES `m_feature` (`m_feature_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `map_feature_ibfk_2` FOREIGN KEY (`m_user_group_id`) REFERENCES `m_user_group` (`m_user_group_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_device`
--
ALTER TABLE `m_device`
  ADD CONSTRAINT `m_device_ibfk_1` FOREIGN KEY (`m_device_type_id`) REFERENCES `m_device_type` (`m_device_type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_device_ibfk_2` FOREIGN KEY (`m_location_id`) REFERENCES `m_location` (`m_location_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_device_ibfk_3` FOREIGN KEY (`m_vendor_id`) REFERENCES `m_vendor` (`m_vendor_id`);

--
-- Ketidakleluasaan untuk tabel `m_email_setting`
--
ALTER TABLE `m_email_setting`
  ADD CONSTRAINT `m_email_setting_ibfk_1` FOREIGN KEY (`m_company_id`) REFERENCES `m_company` (`m_company_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_employee`
--
ALTER TABLE `m_employee`
  ADD CONSTRAINT `m_employee_ibfk_1` FOREIGN KEY (`m_position_id`) REFERENCES `m_position` (`m_position_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_employee_ibfk_2` FOREIGN KEY (`m_user_group_id`) REFERENCES `m_user_group` (`m_user_group_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_feature`
--
ALTER TABLE `m_feature`
  ADD CONSTRAINT `m_feature_ibfk_1` FOREIGN KEY (`m_feature_group_id`) REFERENCES `m_feature_group` (`m_feature_group_id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `m_location`
--
ALTER TABLE `m_location`
  ADD CONSTRAINT `m_location_ibfk_1` FOREIGN KEY (`m_building_id`) REFERENCES `m_building` (`m_building_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_location_ibfk_2` FOREIGN KEY (`m_floor_id`) REFERENCES `m_floor` (`m_floor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `m_location_ibfk_3` FOREIGN KEY (`m_room_id`) REFERENCES `m_room` (`m_room_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
