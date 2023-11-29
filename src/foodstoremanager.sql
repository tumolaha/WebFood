-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 04:04 PM
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
  `MaMon` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dexuatmonan`
--

INSERT INTO `dexuatmonan` (`TenMon`, `MaNV`, `MaMon`, `status`) VALUES
('Bò Beefsteak', 0, 7, NULL);

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
  `DanhGia` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dondatmon`
--

INSERT INTO `dondatmon` (`MaDon`, `MaNV`, `MaMon`, `NgayDat`, `TongTien`, `TrangThai`, `DanhGia`, `soluong`) VALUES
(0, 1, 7, '2023-11-29', 200000, '0', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MaMon` int(11) DEFAULT NULL,
  `MaNL` int(11) DEFAULT NULL,
  `ngayban` date DEFAULT NULL,
  `MaMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MaMon`, `MaNL`, `ngayban`, `MaMenu`) VALUES
(2, 4, '2023-11-29', 2),
(7, 2, '2023-11-29', 9);

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

--
-- Dumping data for table `monan`
--

INSERT INTO `monan` (`MaMon`, `TenMon`, `DonGia`, `HinhMinhHoa`, `CongThuc`, `trangthai`, `ngaytao`) VALUES
(2, 'Bún chả', 60000, 0x62756e6368612e6a7067, 'Thịt heo, bún, nước mắm, rau sống', 1, '2023-11-28'),
(7, 'Bò Beefsteak', 100000, 0x443a2f6170702f646576656c6f706d656e742f78616d70702f6874646f63732f776562666f6f642f7372632f75706c6f6164732f4f49502e6a7067, 'Công thức', 1, '2023-11-29');

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

--
-- Dumping data for table `nguyenlieu`
--

INSERT INTO `nguyenlieu` (`MaNL`, `TenNL`, `SoLuong`, `NgayNhap`, `Gia`, `DonViTinh`) VALUES
(2, 'bánh mì', 20, '2023-11-28', 1000, 'kg'),
(4, 'gà móng đỏ', 10, '2023-11-28', 1000, 'kg');

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

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `MaTK`, `TenNV`, `SDT`, `Email`, `GioiTinh`) VALUES
(0, 1, 'nguyễn văn tú', '0969022375', 'admin@example.com', '1'),
(1, 2, 'nguyễn văn thanh sang', '0969022375', '20110591@student.hcmute.edu.vn', '1');

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
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `Username`, `Password`, `PhanQuyen`) VALUES
(1, 'john_doe', 'hashed_password', '1'),
(2, 'jane_smith', 'another_hashed_password', '2');

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
  ADD PRIMARY KEY (`MaMenu`),
  ADD KEY `FK_menu_nguyenlieu` (`MaNL`),
  ADD KEY `menu_ibfk_1` (`MaMon`);

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
