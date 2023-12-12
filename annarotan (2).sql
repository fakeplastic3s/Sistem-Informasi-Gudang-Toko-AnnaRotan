-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 04:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annarotan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_supplier`, `tgl_keluar`, `jumlah`) VALUES
(6, 39, '2023-07-06', 2),
(7, 38, '2023-07-16', 5),
(8, 38, '2023-07-16', 10);

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `BK_Delete` AFTER DELETE ON `barang_keluar` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah + OLD.jumlah
WHERE stok_gudang.id_supplier = OLD.id_supplier
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BK_Insert` AFTER INSERT ON `barang_keluar` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah - NEW.jumlah
WHERE stok_gudang.id_supplier = NEW.id_supplier
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BK_Update` BEFORE UPDATE ON `barang_keluar` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah - (NEW.jumlah - OLD.jumlah)
WHERE stok_gudang.id_supplier = NEW.id_supplier
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `id_supplier`, `id_pengadaan`, `tgl_masuk`, `jumlah_masuk`) VALUES
(18, 38, 10, '2023-07-13', 20),
(19, 39, 11, '2023-07-01', 20),
(22, 39, 15, '2023-07-09', 2);

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `BM_Insert` AFTER INSERT ON `barang_masuk` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah + NEW.jumlah_masuk
WHERE stok_gudang.id_supplier = NEW.id_supplier
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BM_Update` BEFORE UPDATE ON `barang_masuk` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah + (NEW.jumlah_masuk-OLD.jumlah_masuk)
WHERE stok_gudang.id_supplier = NEW.id_supplier
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BM_delete` BEFORE DELETE ON `barang_masuk` FOR EACH ROW UPDATE stok_gudang SET stok_gudang.jumlah = stok_gudang.jumlah - OLD.jumlah_masuk
WHERE stok_gudang.id_supplier = OLD.id_supplier
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Status_pengiriman_delete` BEFORE DELETE ON `barang_masuk` FOR EACH ROW Update pengadaan SET pengadaan.status_pemesanan = "Diproses"
WHERE pengadaan.id_pengadaan = OLD.id_pengadaan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `status_pemesanan` AFTER INSERT ON `barang_masuk` FOR EACH ROW Update pengadaan SET pengadaan.status_pemesanan = "Terkirim"
WHERE pengadaan.id_pengadaan = NEW.id_pengadaan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `status_pengadaan` enum('Diajukan','Disetujui','Ditolak') NOT NULL,
  `status_pemesanan` enum('Diproses','Dibatalkan','Terkirim') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `id_supplier`, `jumlah`, `tanggal_pengadaan`, `status_pengadaan`, `status_pemesanan`) VALUES
(10, 38, 20, '2023-06-25', 'Disetujui', 'Terkirim'),
(11, 39, 20, '2023-06-27', 'Disetujui', 'Terkirim'),
(12, 40, 20, '2023-06-28', 'Disetujui', 'Diproses'),
(13, 40, 5, '2023-07-03', 'Disetujui', 'Diproses'),
(14, 40, 10, '2023-07-11', 'Disetujui', 'Diproses'),
(15, 39, 2, '2023-07-12', 'Disetujui', 'Terkirim'),
(17, 39, 2, '2023-07-13', 'Disetujui', 'Diproses'),
(18, 38, 20, '2023-07-16', 'Disetujui', 'Diproses'),
(19, 39, 20, '2023-07-16', 'Ditolak', 'Dibatalkan');

-- --------------------------------------------------------

--
-- Table structure for table `stok_gudang`
--

CREATE TABLE `stok_gudang` (
  `id_stok` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_gudang`
--

INSERT INTO `stok_gudang` (`id_stok`, `id_supplier`, `jumlah`, `harga_jual`) VALUES
(3, 39, 20, 60000),
(4, 38, 5, 40000),
(10, 40, 0, 65000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `nama_barang`, `harga_satuan`) VALUES
(38, 'Jaya Makmur', 'Jalan Urip sumoharjo', 'Kursi', 20000),
(39, 'Pak H. Sobirin', 'Cirebon', 'Meja', 40000),
(40, 'Pak Bagus', 'Cirebon', 'Ayunan Bayi', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_create_at`) VALUES
(11, 'Admin', 'admin@annarotan.com', '$2y$10$dQ6spDr3FZzP7Nl0nha/xOwnDrwOrr8frmgfnxadA2ci0B7bSbfEG', '2023-05-04 03:02:45'),
(18, 'Admin Gudang', 'admingudang@annarotan.com', '$2y$10$Ade9BXRCvYJjWmp89vyjZeMUwFrUFTud0Djtn79wI.8KkaxB9zNw6', '2023-07-12 15:10:27'),
(19, 'Admin Keuangan', 'adminkeuangan@annarotan.com', '$2y$10$fzxnn9mSqi088/0sQD3hZettuLNBKaH9PMpzRubb9i9Ke/BBESxzu', '2023-07-12 18:13:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_pengadaan` (`id_pengadaan`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `stok_gudang`
--
ALTER TABLE `stok_gudang`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stok_gudang`
--
ALTER TABLE `stok_gudang`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_pengadaan`) REFERENCES `pengadaan` (`id_pengadaan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `stok_gudang`
--
ALTER TABLE `stok_gudang`
  ADD CONSTRAINT `stok_gudang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
