-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 07:03 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmcit`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_avt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no_avt.png',
  `phone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'User',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buoi_th`
--

CREATE TABLE `buoi_th` (
  `id_buoi` int(11) NOT NULL,
  `ten_buoi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_lophp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `can_bo`
--

CREATE TABLE `can_bo` (
  `id_canbo` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `ma_cb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_cb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_vao_lam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitiet_yc`
--

CREATE TABLE `chitiet_yc` (
  `id_chitietyc` int(11) NOT NULL,
  `id_canbo` int(11) NOT NULL,
  `id_yeucau` int(11) NOT NULL,
  `id_lophp` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  `thu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buoi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_danh`
--

CREATE TABLE `diem_danh` (
  `id_dd` int(11) NOT NULL,
  `ngay_dd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_sv` int(11) NOT NULL,
  `id_lophp` int(11) NOT NULL,
  `id_canbo` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoc_ky`
--

CREATE TABLE `hoc_ky` (
  `id_hk` int(11) NOT NULL,
  `ten_hk` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_bd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_kt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lop`
--

CREATE TABLE `lop` (
  `id_lop` int(11) NOT NULL,
  `ma_lop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_lop` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_nganh` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lop_hp`
--

CREATE TABLE `lop_hp` (
  `id_lophp` int(11) NOT NULL,
  `id_canbo` int(11) NOT NULL,
  `id_monhoc` int(11) NOT NULL,
  `ma_lhp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_lophp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_buoi` int(11) NOT NULL,
  `soluong_sv` int(11) NOT NULL,
  `id_hk` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `id_monhoc` int(11) NOT NULL,
  `ma_mon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_mon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tin_chi` int(11) NOT NULL,
  `so_tiet_lt` int(11) NOT NULL,
  `so_tiet_th` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `id_nganh` int(11) NOT NULL,
  `ma_nganh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_nganh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phan_hoi`
--

CREATE TABLE `phan_hoi` (
  `id_phanhoi` int(11) NOT NULL,
  `id_sv` int(11) NOT NULL,
  `id_lophp` int(11) NOT NULL,
  `ten_phanhoi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noidung_phanhoi` text COLLATE utf8_unicode_ci NOT NULL,
  `mau_don` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phan_mem`
--

CREATE TABLE `phan_mem` (
  `id_pm` int(11) NOT NULL,
  `ten_pm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `id_phong` int(11) NOT NULL,
  `ten_phong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_bm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `soluong_may` int(11) NOT NULL,
  `hdh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ram` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pm_thuoc_phong`
--

CREATE TABLE `pm_thuoc_phong` (
  `id_pm_p` int(11) NOT NULL,
  `id_pm` int(11) NOT NULL,
  `id_phong` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sap_xep`
--

CREATE TABLE `sap_xep` (
  `id_sx` int(11) NOT NULL,
  `id_chitietyc` int(11) NOT NULL,
  `id_phong` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `id_sv` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `mssv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `khoa_hoc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_lop` int(11) NOT NULL,
  `id_lophp` int(11) NOT NULL,
  `ten_sv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gioi_tinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tuan_th`
--

CREATE TABLE `tuan_th` (
  `id_tuan` int(11) NOT NULL,
  `stt_tuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_hk` int(11) NOT NULL,
  `ngay_bd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_kt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tuan_theo_yc`
--

CREATE TABLE `tuan_theo_yc` (
  `id_tuanyc` int(11) NOT NULL,
  `id_chitietyc` int(11) NOT NULL,
  `id_tuan` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yeucau_lth`
--

CREATE TABLE `yeucau_lth` (
  `id_yeucau` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buoi_th`
--
ALTER TABLE `buoi_th`
  ADD PRIMARY KEY (`id_buoi`),
  ADD KEY `id_lophp` (`id_lophp`);

--
-- Indexes for table `can_bo`
--
ALTER TABLE `can_bo`
  ADD PRIMARY KEY (`id_canbo`),
  ADD KEY `id_account` (`id_account`);

--
-- Indexes for table `chitiet_yc`
--
ALTER TABLE `chitiet_yc`
  ADD PRIMARY KEY (`id_chitietyc`),
  ADD KEY `id_lophp` (`id_lophp`),
  ADD KEY `id_pm` (`id_pm`),
  ADD KEY `id_yeucau` (`id_yeucau`),
  ADD KEY `id_canbo` (`id_canbo`);

--
-- Indexes for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD PRIMARY KEY (`id_dd`),
  ADD KEY `id_sv` (`id_sv`),
  ADD KEY `id_lophp` (`id_lophp`),
  ADD KEY `id_canbo` (`id_canbo`);

--
-- Indexes for table `hoc_ky`
--
ALTER TABLE `hoc_ky`
  ADD PRIMARY KEY (`id_hk`);

--
-- Indexes for table `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`id_lop`),
  ADD KEY `id_nganh` (`id_nganh`);

--
-- Indexes for table `lop_hp`
--
ALTER TABLE `lop_hp`
  ADD PRIMARY KEY (`id_lophp`),
  ADD KEY `id_monhoc` (`id_monhoc`),
  ADD KEY `id_canbo` (`id_canbo`),
  ADD KEY `id_hk` (`id_hk`);

--
-- Indexes for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`id_monhoc`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`id_nganh`);

--
-- Indexes for table `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD PRIMARY KEY (`id_phanhoi`),
  ADD KEY `id_sv` (`id_sv`),
  ADD KEY `id_lophp` (`id_lophp`);

--
-- Indexes for table `phan_mem`
--
ALTER TABLE `phan_mem`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`id_phong`);

--
-- Indexes for table `pm_thuoc_phong`
--
ALTER TABLE `pm_thuoc_phong`
  ADD PRIMARY KEY (`id_pm_p`),
  ADD KEY `id_pm` (`id_pm`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `sap_xep`
--
ALTER TABLE `sap_xep`
  ADD PRIMARY KEY (`id_sx`),
  ADD KEY `id_chitietyc` (`id_chitietyc`),
  ADD KEY `id_phong` (`id_phong`);

--
-- Indexes for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`id_sv`),
  ADD KEY `id_lop` (`id_lop`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_lophp` (`id_lophp`);

--
-- Indexes for table `tuan_th`
--
ALTER TABLE `tuan_th`
  ADD PRIMARY KEY (`id_tuan`),
  ADD KEY `id_hk` (`id_hk`);

--
-- Indexes for table `tuan_theo_yc`
--
ALTER TABLE `tuan_theo_yc`
  ADD PRIMARY KEY (`id_tuanyc`),
  ADD KEY `id_chitietyc` (`id_chitietyc`),
  ADD KEY `id_tuan` (`id_tuan`);

--
-- Indexes for table `yeucau_lth`
--
ALTER TABLE `yeucau_lth`
  ADD PRIMARY KEY (`id_yeucau`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `buoi_th`
--
ALTER TABLE `buoi_th`
  MODIFY `id_buoi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `can_bo`
--
ALTER TABLE `can_bo`
  MODIFY `id_canbo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitiet_yc`
--
ALTER TABLE `chitiet_yc`
  MODIFY `id_chitietyc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_danh`
--
ALTER TABLE `diem_danh`
  MODIFY `id_dd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoc_ky`
--
ALTER TABLE `hoc_ky`
  MODIFY `id_hk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lop`
--
ALTER TABLE `lop`
  MODIFY `id_lop` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lop_hp`
--
ALTER TABLE `lop_hp`
  MODIFY `id_lophp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mon_hoc`
--
ALTER TABLE `mon_hoc`
  MODIFY `id_monhoc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nganh`
--
ALTER TABLE `nganh`
  MODIFY `id_nganh` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phan_hoi`
--
ALTER TABLE `phan_hoi`
  MODIFY `id_phanhoi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phan_mem`
--
ALTER TABLE `phan_mem`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `id_phong` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pm_thuoc_phong`
--
ALTER TABLE `pm_thuoc_phong`
  MODIFY `id_pm_p` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sap_xep`
--
ALTER TABLE `sap_xep`
  MODIFY `id_sx` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  MODIFY `id_sv` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuan_th`
--
ALTER TABLE `tuan_th`
  MODIFY `id_tuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuan_theo_yc`
--
ALTER TABLE `tuan_theo_yc`
  MODIFY `id_tuanyc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yeucau_lth`
--
ALTER TABLE `yeucau_lth`
  MODIFY `id_yeucau` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buoi_th`
--
ALTER TABLE `buoi_th`
  ADD CONSTRAINT `buoi_th_ibfk_1` FOREIGN KEY (`id_lophp`) REFERENCES `lop_hp` (`id_lophp`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `can_bo`
--
ALTER TABLE `can_bo`
  ADD CONSTRAINT `can_bo_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `chitiet_yc`
--
ALTER TABLE `chitiet_yc`
  ADD CONSTRAINT `chitiet_yc_ibfk_1` FOREIGN KEY (`id_lophp`) REFERENCES `lop_hp` (`id_lophp`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiet_yc_ibfk_2` FOREIGN KEY (`id_pm`) REFERENCES `phan_mem` (`id_pm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiet_yc_ibfk_3` FOREIGN KEY (`id_yeucau`) REFERENCES `yeucau_lth` (`id_yeucau`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `chitiet_yc_ibfk_4` FOREIGN KEY (`id_canbo`) REFERENCES `can_bo` (`id_canbo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD CONSTRAINT `diem_danh_ibfk_1` FOREIGN KEY (`id_sv`) REFERENCES `sinh_vien` (`id_sv`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `diem_danh_ibfk_2` FOREIGN KEY (`id_lophp`) REFERENCES `lop_hp` (`id_lophp`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `diem_danh_ibfk_3` FOREIGN KEY (`id_canbo`) REFERENCES `can_bo` (`id_canbo`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lop`
--
ALTER TABLE `lop`
  ADD CONSTRAINT `lop_ibfk_1` FOREIGN KEY (`id_nganh`) REFERENCES `nganh` (`id_nganh`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lop_hp`
--
ALTER TABLE `lop_hp`
  ADD CONSTRAINT `lop_hp_ibfk_1` FOREIGN KEY (`id_monhoc`) REFERENCES `mon_hoc` (`id_monhoc`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `lop_hp_ibfk_2` FOREIGN KEY (`id_canbo`) REFERENCES `can_bo` (`id_canbo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `lop_hp_ibfk_3` FOREIGN KEY (`id_hk`) REFERENCES `hoc_ky` (`id_hk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD CONSTRAINT `phan_hoi_ibfk_1` FOREIGN KEY (`id_sv`) REFERENCES `sinh_vien` (`id_sv`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `phan_hoi_ibfk_2` FOREIGN KEY (`id_lophp`) REFERENCES `lop_hp` (`id_lophp`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pm_thuoc_phong`
--
ALTER TABLE `pm_thuoc_phong`
  ADD CONSTRAINT `pm_thuoc_phong_ibfk_1` FOREIGN KEY (`id_pm`) REFERENCES `phan_mem` (`id_pm`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pm_thuoc_phong_ibfk_2` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id_phong`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sap_xep`
--
ALTER TABLE `sap_xep`
  ADD CONSTRAINT `sap_xep_ibfk_1` FOREIGN KEY (`id_chitietyc`) REFERENCES `chitiet_yc` (`id_chitietyc`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sap_xep_ibfk_2` FOREIGN KEY (`id_phong`) REFERENCES `phong` (`id_phong`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD CONSTRAINT `sinh_vien_ibfk_1` FOREIGN KEY (`id_lop`) REFERENCES `lop` (`id_lop`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sinh_vien_ibfk_2` FOREIGN KEY (`id_account`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sinh_vien_ibfk_3` FOREIGN KEY (`id_lophp`) REFERENCES `lop_hp` (`id_lophp`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tuan_th`
--
ALTER TABLE `tuan_th`
  ADD CONSTRAINT `tuan_th_ibfk_1` FOREIGN KEY (`id_hk`) REFERENCES `hoc_ky` (`id_hk`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tuan_theo_yc`
--
ALTER TABLE `tuan_theo_yc`
  ADD CONSTRAINT `tuan_theo_yc_ibfk_1` FOREIGN KEY (`id_chitietyc`) REFERENCES `chitiet_yc` (`id_chitietyc`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tuan_theo_yc_ibfk_2` FOREIGN KEY (`id_tuan`) REFERENCES `tuan_th` (`id_tuan`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
