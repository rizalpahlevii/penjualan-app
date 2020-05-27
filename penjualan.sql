-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2020 at 03:25 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `stok_masuk` int(11) NOT NULL,
  `stok_akhir` int(11) NOT NULL,
  `stok_keluar` int(11) NOT NULL,
  `satuan_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga_beli`, `harga_jual`, `stok_awal`, `stok_masuk`, `stok_akhir`, `stok_keluar`, `satuan_id`, `kategori_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('BRG0000001', 'Komputer', 1000000, 2000000, 50, 0, 48, 2, 1, 1, '2020-05-13 03:20:05', '2020-05-13 03:22:25', NULL),
('BRG0000002', 'Laptop', 2000000, 3000000, 30, 0, 28, 2, 1, 1, '2020-05-13 03:20:59', '2020-05-13 03:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_transaksi`
--

CREATE TABLE `cart_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('checkout','cart') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pembelian_id` int(10) UNSIGNED NOT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_return_jual`
--

CREATE TABLE `detail_return_jual` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_jual_id` int(10) UNSIGNED NOT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_return_pembelian`
--

CREATE TABLE `detail_return_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `return_beli_id` int(10) UNSIGNED NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `barang_id`, `jumlah_beli`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 'BRG0000001', 2, 2000000, 4000000, '2020-05-13 03:22:25', '2020-05-13 03:22:25'),
(2, 1, 'BRG0000002', 2, 3000000, 6000000, '2020-05-13 03:22:25', '2020-05-13 03:22:25');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_gaji` date NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `total_gaji` int(11) NOT NULL,
  `potongan` int(11) NOT NULL DEFAULT '0',
  `gaji_bersih` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_masuk`
--

CREATE TABLE `history_stok_barang_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `suplier_id` int(10) UNSIGNED DEFAULT NULL,
  `barang_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_hutang` date NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `suplier_id` int(10) UNSIGNED NOT NULL,
  `pembelian_id` int(10) UNSIGNED NOT NULL,
  `total_hutang` int(11) NOT NULL,
  `pembayaran_hutang` int(11) NOT NULL,
  `sisa_hutang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `lain_lain` int(11) NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` enum('pendapatan','pengeluaran') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('penjualan','return penjualan','pembelian','return pembelian','bayar piutang','bayar hutang','kas awal','kas akhir','pengeluaran lain','biaya','pemasukan awal','penggajian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemasukan` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2020-05-13 03:19:38', '2020-05-13 03:19:45');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_27_042616_create_kategori_table', 1),
(5, '2020_04_27_042617_create_satuan_table', 1),
(6, '2020_04_27_042619_create_barang_table', 1),
(7, '2020_04_27_043839_create_pelanggan_table', 1),
(8, '2020_04_27_044314_create_transaksi_table', 1),
(9, '2020_04_27_050409_create_detail_transaksi_table', 1),
(10, '2020_04_27_050941_create_return_penjualan_table', 1),
(11, '2020_04_27_051228_create_detail_return_jual_table', 1),
(12, '2020_04_27_051501_create_piutang_table', 1),
(13, '2020_04_27_051918_create_suplier_table', 1),
(14, '2020_04_27_052113_create_hutang_table', 1),
(15, '2020_04_27_052319_create_pembelian_table', 1),
(16, '2020_04_27_052458_create_detail_pembelian_table', 1),
(17, '2020_04_27_052628_create_return_pembelian_table', 1),
(18, '2020_04_27_052753_create_detail_return_pembelian_table', 1),
(19, '2020_04_29_105107_create_history_stok_barang_masuk_table', 1),
(20, '2020_04_29_183613_create_cart_transaksi_table', 1),
(21, '2020_05_05_093010_create_kas_table', 1),
(22, '2020_05_06_123451_create_pegawai_table', 1),
(23, '2020_05_06_123651_create_jabatan_table', 1),
(24, '2020_05_06_123846_create_gaji_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Pelanggan rizal', 'Mojo cluwak pati', '01238971983', 'pelanggan@gmail.com', '2020-05-13 03:20:36', '2020-05-13 03:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `suplier_id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_piutang` date NOT NULL,
  `total_hutang` int(11) NOT NULL,
  `piutang_terbayar` int(11) NOT NULL,
  `tanggal_tempo` date NOT NULL,
  `sisa_piutang` int(11) NOT NULL,
  `pelanggan_id` int(10) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id`, `faktur`, `tanggal_piutang`, `total_hutang`, `piutang_terbayar`, `tanggal_tempo`, `sisa_piutang`, `pelanggan_id`, `transaksi_id`, `created_at`, `updated_at`) VALUES
(1, 'PTG00000001', '2020-05-13', 10000000, 0, '2020-05-28', 10000000, 1, 1, '2020-05-13 03:22:25', '2020-05-13 03:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `return_pembelian`
--

CREATE TABLE `return_pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembelian_id` int(10) UNSIGNED NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `tanggal_return_pembelian` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_penjualan`
--

CREATE TABLE `return_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faktur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_return_jual` date NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` enum('cart','finish') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cart',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Unit', '2020-05-13 03:19:31', '2020-05-13 03:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `pph` int(11) NOT NULL,
  `status` enum('hutang','tunai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelanggan_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode`, `tanggal_transaksi`, `total`, `diskon`, `ppn`, `pph`, `status`, `pelanggan_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'TRK00000001', '2020-05-13', 10000000, 0, 0, 0, 'hutang', 1, 1, '2020-05-13 03:22:25', '2020-05-13 03:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Admin','Manager','Petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$10$PE5foZbYbUCrDPzZCzLyke5OMnGNdsi0cdWUOAPHGN/5CE5IriF1q', 'Admin', '2020-05-13 03:17:41', '2020-05-13 03:17:41'),
(2, 'Manager', 'manager', 'manager@gmail.com', '$2y$10$tC2pzRAPYKFgkDEZ5xWJteXOfRfqw4xqCwBUGy0Yg5uSquAKG07MO', 'Manager', '2020-05-13 03:17:41', '2020-05-13 03:17:41'),
(3, 'Petugas', 'petugas', 'petugas@gmail.com', '$2y$10$4uG/EfnNpllz.fAWCJYmtOl.rYkIRhVyX4mxAdCKahy3XIulMZ7/y', 'Petugas', '2020-05-13 03:17:41', '2020-05-13 03:17:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_transaksi`
--
ALTER TABLE `cart_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_return_jual`
--
ALTER TABLE `detail_return_jual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_return_pembelian`
--
ALTER TABLE `detail_return_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gaji_faktur_unique` (`faktur`);

--
-- Indexes for table `history_stok_barang_masuk`
--
ALTER TABLE `history_stok_barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hutang_faktur_unique` (`faktur`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggan_no_hp_unique` (`no_hp`),
  ADD UNIQUE KEY `pelanggan_email_unique` (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembelian_faktur_unique` (`faktur`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `piutang_faktur_unique` (`faktur`);

--
-- Indexes for table `return_pembelian`
--
ALTER TABLE `return_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_pembelian_faktur_unique` (`faktur`);

--
-- Indexes for table `return_penjualan`
--
ALTER TABLE `return_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `return_penjualan_faktur_unique` (`faktur`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suplier_email_unique` (`email`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_kode_unique` (`kode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_transaksi`
--
ALTER TABLE `cart_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_return_jual`
--
ALTER TABLE `detail_return_jual`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_return_pembelian`
--
ALTER TABLE `detail_return_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_stok_barang_masuk`
--
ALTER TABLE `history_stok_barang_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hutang`
--
ALTER TABLE `hutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_pembelian`
--
ALTER TABLE `return_pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_penjualan`
--
ALTER TABLE `return_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
