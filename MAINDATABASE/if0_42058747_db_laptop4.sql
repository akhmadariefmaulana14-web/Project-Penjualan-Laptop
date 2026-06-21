-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql301.infinityfree.com
-- Generation Time: Jun 17, 2026 at 11:22 PM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_42058747_db_laptop4`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `password_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `password_admin`) VALUES
(2, 'admin', '$2y$10$HVNTCdcaStt9vIvPqP95..PM98V0yYQ08Yx/qK22b7XcZ8loepXuG');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `id_transaksi` int(11) NOT NULL,
  `id_laptop` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `id_promo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `tgl_transaksi`, `id_transaksi`, `id_laptop`, `jumlah`, `bukti_pembayaran`, `subtotal`, `id_promo`) VALUES
(39, '2026-05-18 13:53:37', 5, 18, 1, '', 12000000, NULL),
(40, '2026-05-18 15:21:13', 6, 14, 1, '', 18000000, NULL),
(42, '2026-06-05 07:10:39', 8, 14, 1, '', 18000000, NULL),
(43, '2026-06-05 07:55:03', 9, 15, 1, '', 13000000, NULL),
(44, '2026-06-09 05:52:57', 10, 14, 1, '', 18000000, NULL),
(45, '2026-06-15 05:10:20', 11, 18, 1, '', 12000000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(4, 'Surabaya'),
(6, 'Klaten'),
(7, 'Solo'),
(8, 'Yogyakarta'),
(9, 'Palangkaraya');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `nama_kurir`) VALUES
(2, 'J&T'),
(5, 'JNE'),
(6, 'Ninja Express'),
(7, 'Shoppe');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

CREATE TABLE `laptop` (
  `id_laptop` int(11) NOT NULL,
  `img_laptop` varchar(50) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `jenis_laptop` varchar(50) NOT NULL,
  `desc_laptop` varchar(200) NOT NULL,
  `harga_laptop` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`id_laptop`, `img_laptop`, `id_merk`, `jenis_laptop`, `desc_laptop`, `harga_laptop`, `stok`) VALUES
(14, '755dfb2bd62fbfbf830db4c79130bf91.png', 8, 'MSI', 'MSI', 18000000, 10),
(15, '436674a9acd09411cafb928eabf508b2.png', 6, 'Ideapad Gaming', 'Ideapad Gaming', 13000000, 10),
(16, '0f298bf7868828594ad11d7b33033ea9.png', 6, 'Ideapad', 'Ideapad', 14000000, 15),
(17, 'e19677dcba354b546ec554eef8eae9ed.png', 6, 'Ideapad', 'Ideapad', 18000000, 10),
(18, '07aab38b1978cc4bbbba659c6bfdd80c.png', 10, 'TUF', 'ASUS TUF', 12000000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id_merk` int(11) NOT NULL,
  `nama_merk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES
(6, 'Lenovo'),
(8, 'MSI'),
(9, 'Acer'),
(10, 'ASUS');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `id_kota_asal` int(11) NOT NULL,
  `id_kota_tujuan` int(11) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `id_kurir`, `id_kota_asal`, `id_kota_tujuan`, `biaya`) VALUES
(6, 2, 4, 6, 56000);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `kode_promo` varchar(300) NOT NULL,
  `nilai` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `kode_promo`, `nilai`) VALUES
(1, 'AAA', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment_settings`
--

CREATE TABLE `tb_payment_settings` (
  `id` int(11) NOT NULL,
  `payment_type` varchar(50) NOT NULL COMMENT 'bank_transfer / qris',
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_holder` varchar(150) DEFAULT NULL,
  `qris_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_payment_settings`
--

INSERT INTO `tb_payment_settings` (`id`, `payment_type`, `bank_name`, `account_number`, `account_holder`, `qris_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'bank_transfer', 'BCA', '012387321', 'Akhmad Arief Maulana', NULL, 1, '2026-05-19 19:57:18', '2026-05-19 21:57:22'),
(2, 'bank_transfer', 'BRI', '1122334455', 'Akhmad Arief Maulana', NULL, 1, '2026-05-19 19:57:18', '2026-05-19 21:57:03'),
(3, 'bank_transfer', 'Mandiri', '3721784313', 'Akhmad Arief Maulana', NULL, 1, '2026-05-19 19:57:18', '2026-05-19 21:57:17'),
(4, 'qris', NULL, NULL, NULL, '56a876cf8ee114d14d62cdc6f316b459.png', 1, '2026-05-19 19:57:18', '2026-05-30 20:13:16');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'N',
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(20) DEFAULT 'QRIS'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgl_transaksi`, `status`, `bukti_bayar`, `metode_pembayaran`) VALUES
(5, 10, '2026-05-18', 'N', 'bukti_5_1779091535.png', 'Transfer'),
(6, 10, '2026-05-19', 'N', 'bukti_6_1779198105.png', 'Transfer'),
(8, 11, '2026-06-05', 'Y', 'bukti_8_1780668663.png', 'QRIS'),
(9, 11, '2026-06-05', 'N', NULL, 'QRIS'),
(10, 11, '2026-06-09', 'N', NULL, 'QRIS'),
(11, 11, '2026-06-15', 'N', NULL, 'QRIS');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `alamat_user` varchar(100) NOT NULL,
  `status_user` varchar(5) NOT NULL DEFAULT 'Y',
  `password_user` varchar(100) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email_user`, `alamat_user`, `status_user`, `password_user`, `no_hp`) VALUES
(9, 'hmmm', 'hmmm', 'hmmm@gmail.com', 'Indonesia', 'Y', '$2y$10$cQJ1q00AJzj/x/1a40Pj/.EZVstbdoA5vMmM6uPK7nbOMDwzU.I8C', NULL),
(10, 'cus', 'cus', 'cus1@gmail.com', 'cus', 'Y', '$2y$10$CglLqR2B3V5UilNkaVXIGOQbrIUwvVliXElnBvONf3EpNnnpcWKna', NULL),
(11, 'cus2', 'cus2', 'cus2@gmail.com', 'disini', 'Y', '$2y$10$uVVGvi58GUfhuhJPe/HTReGlVWbMj3H28cFjSjZGuoAqCRWD0DOse', '085751329343');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id_wishlist` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_laptop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id_wishlist`, `id_user`, `id_laptop`) VALUES
(3, 10, 14),
(4, 10, 15),
(5, 10, 16),
(7, 10, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`,`id_laptop`),
  ADD KEY `id_laptop` (`id_laptop`),
  ADD KEY `id_promo` (`id_promo`) USING BTREE;

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id_laptop`),
  ADD KEY `merk_laptop` (`id_merk`) USING BTREE;

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`),
  ADD UNIQUE KEY `id_kurir` (`id_kurir`,`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `id_kota_asal` (`id_kota_asal`),
  ADD KEY `id_kota_tujuan` (`id_kota_tujuan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `tb_payment_settings`
--
ALTER TABLE `tb_payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id_wishlist`),
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `id_laptop` (`id_laptop`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id_laptop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_payment_settings`
--
ALTER TABLE `tb_payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id_wishlist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_laptop`) REFERENCES `laptop` (`id_laptop`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`);

--
-- Constraints for table `laptop`
--
ALTER TABLE `laptop`
  ADD CONSTRAINT `laptop_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `merk` (`id_merk`);

--
-- Constraints for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD CONSTRAINT `ongkir_ibfk_1` FOREIGN KEY (`id_kota_asal`) REFERENCES `kota` (`id_kota`),
  ADD CONSTRAINT `ongkir_ibfk_2` FOREIGN KEY (`id_kota_tujuan`) REFERENCES `kota` (`id_kota`),
  ADD CONSTRAINT `ongkir_ibfk_3` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_laptop`) REFERENCES `laptop` (`id_laptop`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
