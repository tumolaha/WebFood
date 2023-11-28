-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 04:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodstoremanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `dexuatmonan`
--

CREATE TABLE `dexuatmonan` (
  `TenMon` varchar(255) NOT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `MaMon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dondatmon`
--

CREATE TABLE `dondatmon` (
  `MaDon` int(11) NOT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `MaMon` int(11) DEFAULT NULL,
  `NgayDat` date DEFAULT NULL,
  `TongTien` float DEFAULT NULL,
  `TrangThai` varchar(255) DEFAULT NULL,
  `DanhGia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MaMon` int(11) NOT NULL,
  `MaNL` int(11) DEFAULT NULL,
  `ngayban` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monan`
--

CREATE TABLE `monan` (
  `MaMon` int(11) NOT NULL,
  `TenMon` varchar(255) DEFAULT NULL,
  `DonGia` float DEFAULT NULL,
  `HinhMinhHoa` blob DEFAULT NULL,
  `CongThuc` text DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `ngaytao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nguyenlieu`
--

CREATE TABLE `nguyenlieu` (
  `MaNL` int(11) NOT NULL,
  `TenNL` varchar(255) DEFAULT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `NgayNhap` date DEFAULT NULL,
  `Gia` float DEFAULT NULL,
  `DonViTinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `MaTK` int(11) DEFAULT NULL,
  `TenNV` varchar(255) DEFAULT NULL,
  `SDT` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `GioiTinh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `PhanQuyen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dexuatmonan`
--
ALTER TABLE `dexuatmonan`
  ADD PRIMARY KEY (`TenMon`),
  ADD KEY `FK_dexuatmonan_nhanvien` (`MaNV`),
  ADD KEY `FK_dexuatmonan_monan` (`MaMon`);

--
-- Indexes for table `dondatmon`
--
ALTER TABLE `dondatmon`
  ADD PRIMARY KEY (`MaDon`),
  ADD KEY `MaNV` (`MaNV`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MaMon`),
  ADD KEY `FK_menu_nguyenlieu` (`MaNL`);

--
-- Indexes for table `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`MaMon`);

--
-- Indexes for table `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD PRIMARY KEY (`MaNL`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`),
  ADD KEY `MaTK` (`MaTK`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dexuatmonan`
--
ALTER TABLE `dexuatmonan`
  ADD CONSTRAINT `FK_dexuatmonan_monan` FOREIGN KEY (`MaMon`) REFERENCES `monan` (`MaMon`),
  ADD CONSTRAINT `FK_dexuatmonan_nhanvien` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Constraints for table `dondatmon`
--
ALTER TABLE `dondatmon`
  ADD CONSTRAINT `dondatmon_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_menu_nguyenlieu` FOREIGN KEY (`MaNL`) REFERENCES `nguyenlieu` (`MaNL`),
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`MaMon`) REFERENCES `monan` (`MaMon`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
