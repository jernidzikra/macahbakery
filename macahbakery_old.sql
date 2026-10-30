-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2026 at 05:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `macah_bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_admin` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `no_telp`) VALUES
('ADM001', 'Admin Macah', 'admin', '$2y$12$Jk13xuMQjbW3zh0.jalGueyqeHagvTv4eFS8IX4MCUXWWRd7iDKkG', '0812-1122-1984');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_bahan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `stok_bahan` decimal(10,2) NOT NULL DEFAULT '0.00',
  `satuan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_pembelian` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_bahan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` decimal(10,2) NOT NULL DEFAULT '0.00',
  `harga_beli` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(15,2) GENERATED ALWAYS AS ((`jumlah` * `harga_beli`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_pesanan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_produk` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sub_total` decimal(15,2) GENERATED ALWAYS AS ((`jumlah` * `harga`)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_pesanan`, `id_produk`, `jumlah`, `harga`) VALUES
('PSN001', 'PRD011', 3, '4000.00'),
('PSN002', 'PRD011', 3, '4000.00'),
('PSN003', 'PRD020', 1, '55000.00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id_komplain` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pesanan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_komplain` date NOT NULL,
  `jenis_komplain` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desk_komplain` text COLLATE utf8mb4_general_ci,
  `status_komplain` enum('open','proses','closed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_06_25_091203_add_kategori_and_terjual_to_produk_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pelanggan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_pelanggan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `no_telp`, `tipe_pelanggan`) VALUES
('PEL001', 'deswi', 'jakpus', '085880059548', 'regular'),
('PEL002', 'deswi', 'jakpus', '085880059548', 'regular'),
('PEL003', 'deswi', 'jakpus', '085880059548', 'regular'),
('PEL004', 'deswi', 'jakpu', '085880059548', 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pesanan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_bayar` date NOT NULL,
  `metode_bayar` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_bayar` decimal(15,2) NOT NULL DEFAULT '0.00',
  `bukti_bayar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_pembayaran` enum('menunggu','lunas','gagal') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_supplier` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pelanggan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `id_admin` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `alamat_pengiriman` text COLLATE utf8mb4_general_ci,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status_pesanan` enum('pending','diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `id_admin`, `tgl_pesanan`, `alamat_pengiriman`, `total`, `status_pesanan`) VALUES
('PSN001', 'PEL002', 'ADM001', '2026-06-26', 'jakpus', '12000.00', 'pending'),
('PSN002', 'PEL003', 'ADM001', '2026-06-26', 'jakpus', '12000.00', 'pending'),
('PSN003', 'PEL004', 'ADM001', '2026-06-26', 'jakpu', '55000.00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_produk` decimal(15,2) NOT NULL DEFAULT '0.00',
  `stok_produk` int NOT NULL DEFAULT '0',
  `terjual` int NOT NULL DEFAULT '0',
  `desk_produk` text COLLATE utf8mb4_general_ci,
  `foto_produk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga_produk`, `stok_produk`, `terjual`, `desk_produk`, `foto_produk`) VALUES
('PRD001', 'Bolu Gulung Batik', 'Bolu', '80000.00', 100, 150, 'Bolu gulung dengan motif batik.', 'images/products/bolu gulung batik.jpg'),
('PRD002', 'Bolu Gulung Coklat', 'Bolu', '80000.00', 80, 120, 'Bolu gulung rasa coklat dengan isian cream.', 'images/products/bolu gulung coklat.jpg'),
('PRD003', 'Bolu Gulung Pandan', 'Bolu', '80000.00', 60, 90, 'Bolu gulung rasa pandan dengan isian cream.', 'images/products/bolu gulung pandan.jpg'),
('PRD004', 'Bolu Gulung Vanilla', 'Bolu', '80000.00', 75, 85, 'Bolu gulung rasa vanila dengan isian cream.', 'images/products/bolu gulung vanilla.png'),
('PRD005', 'Bolu Pandan Keju', 'Bolu', '80000.00', 75, 85, 'Bolu rasa pandan dengan topping keju.', 'images/products/pandan keju.jpg'),
('PRD006', 'Bolu Tape Keju', 'Bolu', '80000.00', 75, 85, 'Bolu rasa tape dengan topping keju.', 'images/products/bolu tape keju.jpg'),
('PRD007', 'Lapis Surabaya', 'Bolu', '200000.00', 75, 85, 'Bolu lapis lembut dengan perpaduan rasa vanila dan cokelat serta lapisan selai di tengahnya.', 'images/products/lapis surabaya.jpg'),
('PRD008', 'Chifon Cake', 'Roti-Kue', '40000.00', 90, 40, 'Chifon cake yang lembut.', 'images/products/chifon cake.jpg'),
('PRD009', 'Donat Ring', 'Roti-Kue', '4000.00', 60, 30, 'Donat bulat dengan topping yang bervariasi.', 'images/products/donat ring.jpg'),
('PRD010', 'Donat', 'Roti-Kue', '4000.00', 70, 45, 'Donat bulat dengan isian yang bervariasi.', 'images/products/donat.png'),
('PRD011', 'Kue Sus', 'Roti-Kue', '4000.00', 70, 40, 'Kue sus dengan isian cream.', 'images/products/kue sus.jpg'),
('PRD012', 'Kue Tart Potong', 'Roti-Kue', '4000.00', 90, 50, 'Kue tart dengan topping yang bervariasi.', 'images/products/kue tart.jpg'),
('PRD013', 'Roti Kopi Mocca', 'Roti-Kue', '4000.00', 85, 35, 'Roti manis dengan rasa kopi mocca.', 'images/products/roti boy.jpg'),
('PRD014', 'Roti Manis', 'Roti-Kue', '4000.00', 75, 35, 'Roti manis dengan topping yang bervariasi.', 'images/products/roti manis.jpg'),
('PRD015', 'Chiffon Cake', 'Roti-Kue', '40000.00', 90, 40, 'Chifon cake yang lembut.', 'images/products/chifon cake.jpg'),
('PRD016', 'Chocochip Cookies', 'Kue Lebaran', '55000.00', 75, 110, 'Chocochips coklat yang renyah.', 'images/products/chocochip cookies.jpg'),
('PRD017', 'Kastangel', 'Kue Lebaran', '55000.00', 90, 70, 'Kastangel keju yang renyah.', 'images/products/kastangel.jpg'),
('PRD018', 'Nastar', 'Kue Lebaran', '55000.00', 85, 80, 'Nastar dengan selai nanas.', 'images/products/nastar.jpg'),
('PRD019', 'Putri Salju', 'Kue Lebaran', '55000.00', 80, 75, 'Putri salju yang lembut.', 'images/products/putri salju.jpg'),
('PRD020', 'Semprit', 'Kue Lebaran', '55000.00', 90, 65, 'Kue semprit dengan taburan keju.', 'images/products/semprit.jpg'),
('PRD021', 'Hampers Paket 1', 'Hampers', '150000.00', 30, 15, 'Paket hampers spesial.', 'images/products/hempers 1.png'),
('PRD022', 'Hampers Paket 2', 'Hampers', '300000.00', 25, 10, 'Paket hampers premium.', 'images/products/hempers.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_supplier` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `no_telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_produk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `tgl_ulasan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_pesanan`, `id_produk`, `id_pelanggan`, `rating`, `komentar`, `tgl_ulasan`) VALUES
('UL001', 'PES001', 'PRD004', '1', 5, 'Enak banget loh', '2026-06-26'),
('UL002', 'PES001', 'PRD001', '1', 5, 'Hmmm Yummmyyy!!!', '2026-06-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'jikra', 'jikrajikra@gmail.com', NULL, '$2y$12$XrJXjsFLQG9uWJrnL9sdluCHUhhvDCaIfIXI8olRVxZhgm/D0P50y', NULL, '2026-06-26 03:52:01', '2026-06-26 03:52:01'),
(2, 'deswi', 'jaieachoi301@gmail.com', NULL, '$2y$12$VYdqc0NjWbfx5lRgbWFcrOk93EvuBYampVXKhb2CU2dNhmHz476Qm', NULL, '2026-06-26 04:02:49', '2026-06-26 04:02:49'),
(3, 'Admin Macah', 'admin@gmail.com', NULL, '$2y$12$TZjt.lFqaaBpoT/CLAhb3u2D8LcJJXfxKlIyXVp0t9hr.h9e8Kwha', NULL, '2026-07-06 04:29:55', '2026-07-06 04:29:55'),
(4, 'Admin Macah', 'admin@macahbakery.com', NULL, '$2y$12$epKxYWoAjALk72ACF09eNOO6GJ04eL4AEiZbbJ7iYxXC3.9G1Elo2', NULL, '2026-07-06 05:18:20', '2026-07-06 05:18:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_pembelian`,`id_bahan`),
  ADD KEY `fk_detpembelian_bahan` (`id_bahan`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_pesanan`,`id_produk`),
  ADD KEY `fk_detpesanan_produk` (`id_produk`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id_komplain`),
  ADD KEY `fk_komplain_pesanan` (`id_pesanan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_pesanan` (`id_pesanan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_pembelian_supplier` (`id_supplier`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_pesanan_pelanggan` (`id_pelanggan`),
  ADD KEY `fk_pesanan_admin` (`id_admin`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `fk_detpembelian_bahan` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id_bahan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detpembelian_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `fk_detpesanan_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detpesanan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Constraints for table `komplain`
--
ALTER TABLE `komplain`
  ADD CONSTRAINT `fk_komplain_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `fk_pembelian_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_pesanan_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pesanan_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
