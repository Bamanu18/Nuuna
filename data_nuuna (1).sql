-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 08:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_nuuna`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Admin1');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Herbal'),
(2, 'Pereda Nyeri'),
(3, 'Flu & Batuk'),
(4, 'Demam');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `notlp_pelanggan` varchar(15) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `foto_pelanggan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `notlp_pelanggan`, `alamat_pelanggan`, `nama_pelanggan`, `foto_pelanggan`) VALUES
(5, 'rikijo123@gmail.com', 'ce705bb7bc3af9b05fe12caf3afab378f56b3ba6', '08571234567', 'Jl. Suka suka', 'Rikijo', 'Universitas-Pamulang.png'),
(8, 'siausiau@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0897575757', 'hhhdhahda', 'siausiau', 'hi.jpg'),
(9, 'jinjui@outlook.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123', 'jinjui komporment', 'jinjui', 'hi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `via_pembayaran` varchar(50) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `midtrans_status` varchar(100) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `raw_response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `order_id`, `nama`, `via_pembayaran`, `jumlah`, `transaction_id`, `midtrans_status`, `tanggal`, `raw_response`) VALUES
(13, 26, '0', 'xiao ling', 'qris', 24000, '35711fa7-9a6c-44fa-8e02-9f7311fa21b5', 'expire', '0000-00-00 00:00:00', ''),
(14, 27, '0', 'wang', 'qris', 24000, '35711fa7-9a6c-44fa-8e02-9f7311fa21b5', 'expire', '0000-00-00 00:00:00', ''),
(15, 28, '0', 'wang', 'qris', 24000, '35711fa7-9a6c-44fa-8e02-9f7311fa21b5', 'expire', '0000-00-00 00:00:00', ''),
(16, 29, '0', 'agenpetang', 'qris', 24000, '35711fa7-9a6c-44fa-8e02-9f7311fa21b5', 'expire', '0000-00-00 00:00:00', ''),
(17, 41, 'INV-20251128132808-1688', '', 'qris', 20000, 'dc03d4b5-1c88-4e0e-9f10-de96712a9f5e', 'settlement', '2025-11-28 19:28:24', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2025-11-28 19:28:24\",\"transaction_status\":\"settlement\",\"transaction_id\":\"dc03d4b5-1c88-4e0e-9f10-de96712a9f5e\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"3b59bc8dba4426d40011a5645b83c96f018c0cf8d37f4c3991c8bfbde60e6ed93e9681824afafb7e5aa4869b33abcf88c6601cb82031b7982a1b2939e8a04315\",\"settlement_time\":\"2025-11-28 19:29:22\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20251128132808-1688\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"d00565c9-7b78-4dc2-83ba-f5b2d646cc0d\",\"issuer\":\"gopay\",\"gross_amount\":\"20000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2025-11-28 19:43:24\",\"customer_details\":{\"phone\":\"+62897575757\",\"full_name\":\"siausiau\",\"email\":\"siausiau@gmail.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}'),
(18, 44, 'INV-20251128133646-2870', '', 'qris', 25000, '2360cd7f-72a9-438b-9f9f-db744f2351c2', 'settlement', '2025-11-28 19:37:07', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2025-11-28 19:37:07\",\"transaction_status\":\"settlement\",\"transaction_id\":\"2360cd7f-72a9-438b-9f9f-db744f2351c2\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"fb960f964406f99b32c0982c605d272c5c431061fdb163a30abaeae00b3a1da9750efe2365eb42384ec7f004291c4811200deb9759389e3b4b84f82f2e4e82f3\",\"settlement_time\":\"2025-11-28 19:37:26\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20251128133646-2870\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"d00565c9-7b78-4dc2-83ba-f5b2d646cc0d\",\"issuer\":\"gopay\",\"gross_amount\":\"25000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2025-11-28 19:52:07\",\"customer_details\":{\"phone\":\"+62897575757\",\"full_name\":\"siausiau\",\"email\":\"siausiau@gmail.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}'),
(19, 45, 'INV-20251128154142-2488', '', 'qris', 29000, '9235910f-c1ca-47c1-bb3d-f5703d2235e9', 'settlement', '2025-11-28 21:42:05', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2025-11-28 21:42:05\",\"transaction_status\":\"settlement\",\"transaction_id\":\"9235910f-c1ca-47c1-bb3d-f5703d2235e9\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"8495ec14da7bdaf449d3106d515422cc26dc1d1c45ae89fe50a1c572bd7aa9fea6b01349751892a32146605393b6d74c43fcd2107fb0c1a16565285cb80facca\",\"settlement_time\":\"2025-11-28 21:42:24\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20251128154142-2488\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"d00565c9-7b78-4dc2-83ba-f5b2d646cc0d\",\"issuer\":\"gopay\",\"gross_amount\":\"29000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2025-11-28 21:57:05\",\"customer_details\":{\"phone\":\"+62897575757\",\"full_name\":\"siausiau\",\"email\":\"siausiau@gmail.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}'),
(20, 48, 'INV-20260116184640-8704', '', 'qris', 9000, 'ddfb75a2-b371-487c-b327-3f1ac31f1cdc', 'settlement', '2026-01-17 03:39:01', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2026-01-17 03:39:01\",\"transaction_status\":\"settlement\",\"transaction_id\":\"ddfb75a2-b371-487c-b327-3f1ac31f1cdc\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"3baa1b156153530d978e782ee3e55b219bedd783ea3d1fe8b8dd3ab140f2b2d2fbe659153811e8b9692536273e55debeef861908e79fcc51567ae54cfb8c3550\",\"settlement_time\":\"2026-01-17 03:40:03\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20260116184640-8704\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"5b8a4133-ad79-4b43-b9b1-d74c14bf89c6\",\"issuer\":\"gopay\",\"gross_amount\":\"9000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2026-01-17 03:54:01\",\"customer_details\":{\"phone\":\"123\",\"full_name\":\"jinjui\",\"email\":\"jinjui@outlook.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}'),
(21, 47, 'INV-20260116182632-3624', '', 'qris', 9000, '4df6c810-6400-4ad5-996e-886e52b29db3', 'settlement', '2026-01-17 03:40:25', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2026-01-17 03:40:25\",\"transaction_status\":\"settlement\",\"transaction_id\":\"4df6c810-6400-4ad5-996e-886e52b29db3\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"92e903ac4e4b262102bdf7c6c0f485a79b9a10d0c1aa70458006471193906fe45366ab1d3d01f392e7fa5935444e6766e886efe064ce6de2b4ede3160397f60e\",\"settlement_time\":\"2026-01-17 03:40:49\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20260116182632-3624\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"5b8a4133-ad79-4b43-b9b1-d74c14bf89c6\",\"issuer\":\"gopay\",\"gross_amount\":\"9000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2026-01-17 03:55:25\",\"customer_details\":{\"phone\":\"123\",\"full_name\":\"jinjui\",\"email\":\"jinjui@outlook.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}'),
(22, 49, 'INV-20260116214124-2322', '', 'qris', 9000, '01bf0cb9-bf9c-44f3-b5e7-44c7b9b0deb5', 'settlement', '2026-01-17 03:41:35', '{\"transaction_type\":\"on-us\",\"transaction_time\":\"2026-01-17 03:41:35\",\"transaction_status\":\"settlement\",\"transaction_id\":\"01bf0cb9-bf9c-44f3-b5e7-44c7b9b0deb5\",\"status_message\":\"midtrans payment notification\",\"status_code\":\"200\",\"signature_key\":\"4f36f3418f00055b299855024b57d1abf229ffd6c1eacad382e906a9813da04f0cb6811ced8766bd13656e492bbd27e8a1ff293c9f97456f34524e028f6ba4e6\",\"settlement_time\":\"2026-01-17 03:41:59\",\"pop_id\":\"d031834d-166d-41b0-941c-d3a0aa40d453\",\"payment_type\":\"qris\",\"order_id\":\"INV-20260116214124-2322\",\"merchant_id\":\"G475786299\",\"merchant_cross_reference_id\":\"5b8a4133-ad79-4b43-b9b1-d74c14bf89c6\",\"issuer\":\"gopay\",\"gross_amount\":\"9000.00\",\"fraud_status\":\"accept\",\"expiry_time\":\"2026-01-17 03:56:35\",\"customer_details\":{\"phone\":\"123\",\"full_name\":\"jinjui\",\"email\":\"jinjui@outlook.com\"},\"currency\":\"IDR\",\"acquirer\":\"gopay\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `pengiriman` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `alamat_lengkap` text NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kodepos` varchar(25) NOT NULL,
  `pesan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `order_id`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `pengiriman`, `status`, `alamat_lengkap`, `provinsi`, `kota`, `kodepos`, `pesan`) VALUES
(26, '', 7, '2024-06-16', 54000, 'Ambil Di Tempat', 'dibatalkan', '', '', '', '', 'gg'),
(27, '', 7, '2024-06-24', 6000, 'Ambil Di Tempat', 'pembayaran dikonfirmasi', '', '', '', '', ''),
(28, '', 7, '2024-06-24', 6000, 'Ambil Di Tempat', 'pembayaran dikonfirmasi', '', '', '', '', ''),
(29, '', 8, '2025-11-23', 27000, 'Ambil Di Tempat', 'pembayaran dikonfirmasi', '', '', '', '', 'siap diantar mase'),
(30, '', 8, '2025-11-24', 79500, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(31, 'INV-20251128051900-5981', 8, '2025-11-28', 1500, '', 'pending', '', '', '', '', ''),
(32, 'INV-20251128073846-8920', 8, '2025-11-28', 20000, '', 'pending', '', '', '', '', ''),
(33, 'INV-20251128074121-7164', 8, '2025-11-28', 1500, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(34, 'INV-20251128095435-4812', 8, '2025-11-28', 73000, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(35, 'INV-20251128101005-4315', 8, '2025-11-28', 20000, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(36, 'INV-20251128102108-7794', 8, '2025-11-28', 20000, '', 'pending', '', '', '', '', ''),
(37, 'INV-20251128103240-5986', 8, '2025-11-28', 9000, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(38, 'INV-20251128104337-4370', 8, '2025-11-28', 24000, 'Ambil Di Tempat', 'Sudah lewat waktu pembayaran', '', '', '', '', ''),
(39, 'INV-20251128105911-6703', 8, '2025-11-28', 29000, 'Ambil Di Tempat', 'sudah dibayar', '', '', '', '', ''),
(40, 'INV-20251128132340-6463', 8, '2025-11-28', 21500, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(41, 'INV-20251128132808-1688', 8, '2025-11-28', 20000, 'Ambil Di Tempat', 'sudah dibayar', '', '', '', '', ''),
(42, 'INV-20251128133028-4726', 8, '2025-11-28', 9000, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(43, 'INV-20251128133423-9000', 8, '2025-11-28', 24000, 'Ambil Di Tempat', 'pending', '', '', '', '', ''),
(44, 'INV-20251128133646-2870', 8, '2025-11-28', 25000, 'Ambil Di Tempat', 'sudah dibayar', '', '', '', '', ''),
(45, 'INV-20251128154142-2488', 8, '2025-11-28', 29000, 'J&T Exspress', 'sudah dibayar', '', '1888', '', '', ''),
(46, '', 2, '2026-01-01', 21, 'jnt', 'pending', 'ttt', 'ttttt', 'tt', '111', 'ttt'),
(47, 'INV-20260116182632-3624', 9, '2026-01-16', 9000, '', 'sudah dibayar', '', '', '', '', ''),
(48, 'INV-20260116184640-8704', 9, '2026-01-16', 9000, '', 'sudah dibayar', '', '', '', '', ''),
(49, 'INV-20260116214124-2322', 9, '2026-01-16', 9000, '', 'pembayaran dikonfirmasi', '', '', '', '', 'ok'),
(50, 'INV-20260202085408-7269', 9, '2026-02-02', 9000, '', 'pending', '', '', '', '', ''),
(51, 'INV-20260202103108-1181', 9, '2026-02-02', 7500, '', 'pending', '', '', '', '', ''),
(52, 'INV-20260205075520-4576', 9, '2026-02-05', 9000, '', 'pending', '', '', '', '', ''),
(53, 'INV-20260205083239-7449', 9, '2026-02-05', 3500, 'Anteraja', 'pending', 'aa', 'aa', 'aa', 'aa', 'aa'),
(54, 'INV-20260205083707-7276', 9, '2026-02-05', 20000, 'Anteraja', 'pending', 'aa', 'aa', 'aa', 'aa', 'aa'),
(55, 'INV-20260205103043-2459', 9, '2026-02-05', 20000, 'Anteraja', 'pending', 'kl', 'wa', 'wa', 'aa', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(29, 26, 14, 4, 'Pop Ice Vanilla Blue', 6000, 24000),
(30, 26, 17, 3, 'Paket Komplit', 10000, 30000),
(31, 27, 13, 1, 'Pop Ice Durian', 6000, 6000),
(32, 28, 1, 1, 'Pop Ice Coklat', 6000, 6000),
(33, 29, 2, 3, 'Laserin Sirup 30ml (per Botol)', 9000, 27000),
(34, 30, 5, 3, 'Obh Combi Batuk Berd', 20000, 60000),
(35, 30, 2, 2, 'Laserin Sirup 30ml (per Botol)', 9000, 18000),
(36, 30, 3, 1, 'Inzana Tablet (per S', 1500, 1500),
(37, 31, 3, 1, 'Inzana Tablet (per S', 1500, 1500),
(38, 32, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(39, 33, 3, 1, 'Inzana Tablet (per S', 1500, 1500),
(40, 34, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(41, 34, 6, 1, 'Mixagrip Flu & Batuk', 4000, 4000),
(42, 34, 5, 3, 'Obh Combi Batuk Berd', 20000, 60000),
(43, 35, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(44, 36, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(45, 37, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(46, 38, 6, 1, 'Mixagrip Flu & Batuk', 4000, 4000),
(47, 38, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(48, 39, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(49, 39, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(50, 40, 3, 1, 'Inzana Tablet (per S', 1500, 1500),
(51, 40, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(52, 41, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(53, 42, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(54, 43, 6, 1, 'Mixagrip Flu & Batuk', 4000, 4000),
(55, 43, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(56, 44, 3, 1, 'Inzana Tablet (per S', 1500, 1500),
(57, 44, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(58, 44, 4, 1, 'Paramex Flu Batuk 1 ', 3500, 3500),
(59, 45, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(60, 45, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(61, 47, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(62, 48, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(63, 49, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(64, 50, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(65, 51, 6, 1, 'Mixagrip Flu & Batuk', 4000, 14000),
(66, 51, 4, 1, 'Paramex Flu Batuk 1 ', 3500, 13500),
(67, 52, 2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 9000),
(68, 53, 4, 1, 'Paramex Flu Batuk 1 ', 3500, 3500),
(69, 54, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000),
(70, 55, 5, 1, 'Obh Combi Batuk Berd', 20000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(5) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(2, 1, 'Laserin Sirup 30ml (per Botol)', 9000, 'LaserinSirup30ml.png', 'Laserin Syrup merupakan obat tradisional yang diformulasikan dari sari-sari tumbuhan berkhasiat obat yang ada di indonesia. Berfungsi untuk meredakan batuk, melegakan pernafasan serta mengatasi gejala masuk angin. Beli Laserin Syr 30ml di Toko Nuuna dan dapatkan berbagai manfaatnya. ', 0),
(3, 4, 'Inzana Tablet (per S', 1500, 'Inzana Tablet (per Strip).png', 'Inzana adalah tablet kunyah penurun panas, demam dan pereda nyeri pada anak, dengan rasa jeruk yang disukai anak', 5),
(4, 3, 'Paramex Flu Batuk 1 ', 3500, 'Paramex Flu Batuk 1 Strip Isi 4 Tablet (per Strip).png', 'Paramex Flu dan Batuk merupakan obat untuk meringankan gejala flu seperti demam, sakit kepala, hidung tersumbat dan bersin-bersin yang disertai batuk kering atau tidak berdahak.  Paramex Flu dan Batuk mengandung kombinasi zat aktif yaitu : 1. Paracetamol yang memiliki aktivitas sebagai penurun demam/antipiretik dan pereda nyeri/analgesik dengan menghambat pembentukan prostaglandin (zat yang dilepaskan tubuh sebagai reaksi terhadap kerusakan jaringan dan memicu terjadinya demam, peradangan, dan rasa nyeri).  2. Pseudoephedrine HCl adalah zat aktif golongan amina simpatomimetik agonis adrenoseptor beta selektif parsial yang digunakan sebagai bronkodilator pada obat flu.  3. Dextromethorphan HBr adalah zat aktif yang digunakan sebagai obat penekan batuk, terutama batuk karena iritasi tenggorokan dan bronkial ringan. Efek yang ditimbulkan dari zat aktif golongan morphin ini adalah disosiatif, penenang, dan stimulan.', 17),
(5, 3, 'Obh Combi Batuk Berd', 20000, 'Obh Combi Batuk Berdahak Menthol Sirup 100ml Gepeng (per Botol).png', 'OBH Combi Batuk Berdahak merupakan obat untuk mengatasi gejala flu seperti pilek, hidung tersumbat, demam, sakit kepala, bersin disertai oleh batuk.     Setiap 5 ml OBH Combi Batuk Berdahak mengandung:        Liquorice succus merupakan salah satu komponen obat batuk hitam (OBH) yang diperoleh dari sari akar tanaman Glycyrrhiza liquiritiae dan memberikan efek ekspektoran.          Amonium Klorida bersifat sebagai agen ekspektoran dalam obat batuk. Efek ekspektoran akan bekerja dengan cara mengiritasi mukosa bronkial yang mempermudah pengeluaran dahak. Mentahunol adalah senyawa organik sintetis yang diperoleh dari peppermint atau minyak mint lainnya dan dapat memberikan sensasi rasa segar di tenggorokan. Peppermint oil merupakan minyak esensial yang diekstrak dari tumbuhan Mentahuna X Piperita. Biasa digunakan sebagai bahan aromatik dan penambah rasa, serta sebagai terapi dalam mengobati nyeri pada saluran pernafasan dan saluran pencernaan. ', 22),
(6, 3, 'Mixagrip Flu & Batuk', 4000, 'Mixagrip Flu & Batuk Tablet (per Strip).png', 'Mixagrip Flu & Batuk mengandung bahan aktif parasetamol, dextromethorphan HBr, Pseudoefedrin HCl. Kandungan bahan aktif tersebut bekerja sebagai analgesik- antipiretik, antitusif dan dekongestan hidung, yang digunakan untuk meringankan gejala-gejala flu seperti demam, sakit kepala, hidung tersumbat dan bersin-bersin yang disertai dengan batuk. Mixagrip Flu & Batuk tidak boleh digunakan pada penderita tekanan darah tinggi berat, dan bagi pasien yang menerima terapi obat anti depresan golongan penghambat Monoamin Oksidase (MAO). Hentikan penggunaan jika mengalami susah tidur, jantung berdebar dan pusing selama penggunaan Mixagrip Flu & Batuk.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(4) NOT NULL,
  `nama_produk_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_produk_foto`) VALUES
(1, 7, '5.png'),
(2, 8, '200.png'),
(3, 2, '20260116180400LaserinSirup30ml-removebg-preview.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
