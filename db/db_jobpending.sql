-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 04:50 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jobpending`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id`, `jabatan`) VALUES
(1, 'Spv'),
(2, 'Foreman');

-- --------------------------------------------------------

--
-- Table structure for table `tb_job`
--

CREATE TABLE `tb_job` (
  `id_job` int(11) NOT NULL,
  `lokasi` varchar(15) NOT NULL,
  `cnunit` varchar(13) NOT NULL,
  `aktivitas` varchar(25) NOT NULL,
  `sketsa_` varchar(150) DEFAULT NULL,
  `eviden` varchar(255) DEFAULT NULL,
  `status_ikh` varchar(10) NOT NULL,
  `problem` varchar(50) NOT NULL,
  `tindakan_perbaikan` varchar(150) NOT NULL,
  `aproved_by` varchar(35) DEFAULT NULL,
  `status` varchar(8) NOT NULL,
  `ket` varchar(500) NOT NULL,
  `progress` int(11) NOT NULL,
  `di_tujukan` int(15) NOT NULL,
  `create_job` datetime NOT NULL,
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_job`
--

INSERT INTO `tb_job` (`id_job`, `lokasi`, `cnunit`, `aktivitas`, `sketsa_`, `eviden`, `status_ikh`, `problem`, `tindakan_perbaikan`, `aproved_by`, `status`, `ket`, `progress`, `di_tujukan`, `create_job`, `update_at`) VALUES
(52, 'Tiwa', '', 'xxxxxxx xxxxx xx', 'medium_19-02-2019-10-46-26-4221.jfif', '460642031428.jpg', 'xxxxxxxxxx', 'xxxxx xxxxxxxxxx', 'xxxxxxx xxxxxxxxxxxxxxx', 'Riyan', 'Done', 'xxxxxxx', 100, 10033433, '2023-06-16 17:21:17', '2023-06-20 11:42:11'),
(53, 'Panel 2', '', 'xxxxxxx xxxxx xx', '460642031428.jpg', '6f04ce83-eee7-44e2-9e61-eda6cfa81d54-768x768.jpg', 'xxxxxxxxxx', 'xxxxx xxxxxxxxxx', 'xxxxxxx xxxxxxxxxxxxxxx', 'Guntur', 'Done', 'xxxxx xxxxxxxx xxxxxxxxxxxx', 100, 10034344, '2023-06-17 18:25:10', '2023-06-20 11:27:14'),
(55, 'Panel 2', '', 'xxxxx xxxxxx xxxxxxxxxxxx', '6f04ce83-eee7-44e2-9e61-eda6cfa81d54-768x768.jpg', 'browser-market-shares-ja.png', 'xxxxx xxxx', 'ccccccccccccccccc', 'xxxxxxxxxxxxxxx xxxxxxxxxxxxx sssss', 'Riyan', 'Done', ' ', 100, 10036666, '2023-06-18 21:09:13', '2023-06-20 11:45:37'),
(56, 'Tiwa', '', 'xxxxx xxxxxx xxxxxxxxxxxx', 'browser-market-shares-in.png', NULL, 'aaaaaaaaaa', 'sssssssssssssss', 'dddddddddddddddddddddddddddddd', NULL, 'Progress', ' ', 50, 10034344, '2023-06-20 12:02:27', '2023-06-20 12:05:05'),
(59, 'Panel 1', '', 'loading OB', '', 'Annotation 2023-06-22 104109.jpg', 'Loading el', 'Area development', 'diperlukan unit support PC400', 'Rendy', 'Done', '', 100, 10036666, '2023-06-23 09:55:53', '2023-06-23 10:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `nik` int(15) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `section` int(15) NOT NULL,
  `id_jab` int(25) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`nik`, `nama`, `no_telp`, `section`, `id_jab`, `password`, `create_at`) VALUES
(10032222, 'Roy', '', 2, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(10032422, 'Rendy', '', 2, 1, '21232f297a57a5a743894a0e4a801fc3', '2023-05-04'),
(10032433, 'Budi', '', 1, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-04'),
(10032533, 'Reza', '', 2, 1, '21232f297a57a5a743894a0e4a801fc3', '2023-05-04'),
(10033333, 'Yogi Danara', '', 2, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(10033433, 'Zafran', '', 1, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-04'),
(10034344, 'Boy', '', 1, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(10036666, 'Muh Affan', '', 1, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(10036767, 'Riyan', '', 2, 1, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(10037878, 'Guntur', '', 2, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-05-05'),
(100233433, 'Moh Faizal', '082239394848', 1, 2, '21232f297a57a5a743894a0e4a801fc3', '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ket`
--

CREATE TABLE `tb_ket` (
  `id` int(11) NOT NULL,
  `id_job` int(11) NOT NULL,
  `ket` varchar(350) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ket`
--

INSERT INTO `tb_ket` (`id`, `id_job`, `ket`, `create_at`) VALUES
(1, 11, 'test', '2023-01-24 11:20:33'),
(2, 12, 'untuk bagian timur Kurang geser', '2023-01-25 01:28:50'),
(3, 44, 'test', '2023-05-06 22:17:49'),
(5, 42, 'hhh', '2023-06-15 10:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lok` int(11) NOT NULL,
  `lokasi_1` varchar(50) NOT NULL,
  `lokasi_2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lok`, `lokasi_1`, `lokasi_2`) VALUES
(1, 'Panel 1', ''),
(2, 'Panel 2', ''),
(3, 'Panel 3', ''),
(4, 'Tiwa', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_revisi`
--

CREATE TABLE `tb_revisi` (
  `id_rev` int(11) NOT NULL,
  `id_job` int(11) NOT NULL,
  `ket_revisi` varchar(150) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_revisi`
--

INSERT INTO `tb_revisi` (`id_rev`, `id_job`, `ket_revisi`, `create_at`) VALUES
(2, 3, 'asdasas', '2023-01-21 17:45:00'),
(3, 3, 'sssss', '2023-01-21 17:54:48'),
(4, 3, 'xcvxcvxcvxcvxcv', '2023-01-21 17:58:44'),
(5, 9, 'hdhfjshfjshdf', '2023-01-22 07:37:10'),
(6, 1, 'Hanya contoh', '2023-01-25 00:03:23'),
(7, 40, 'xxxxx xxxxx xxx xxxxx', '2023-05-06 15:19:22'),
(8, 41, 'Revisi 1', '2023-06-15 10:38:32'),
(9, 52, 'revisi', '2023-06-19 17:06:05'),
(10, 55, 'Revisi 1', '2023-06-20 08:18:13'),
(11, 58, 'Masih ada yg kurang', '2023-06-22 11:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_section`
--

CREATE TABLE `tb_section` (
  `id_sec` int(11) NOT NULL,
  `nama_section` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_section`
--

INSERT INTO `tb_section` (`id_sec`, `nama_section`) VALUES
(1, 'PRODUKSI'),
(2, 'ENGINEER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_job`
--
ALTER TABLE `tb_job`
  ADD PRIMARY KEY (`id_job`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_ket`
--
ALTER TABLE `tb_ket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lok`);

--
-- Indexes for table `tb_revisi`
--
ALTER TABLE `tb_revisi`
  ADD PRIMARY KEY (`id_rev`);

--
-- Indexes for table `tb_section`
--
ALTER TABLE `tb_section`
  ADD PRIMARY KEY (`id_sec`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_job`
--
ALTER TABLE `tb_job`
  MODIFY `id_job` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tb_ket`
--
ALTER TABLE `tb_ket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_revisi`
--
ALTER TABLE `tb_revisi`
  MODIFY `id_rev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_section`
--
ALTER TABLE `tb_section`
  MODIFY `id_sec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
