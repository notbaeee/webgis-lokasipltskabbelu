-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2025 at 06:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'dion', '123');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `detaillokasi` text NOT NULL,
  `gambar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `latitude` decimal(10,6) NOT NULL,
  `longitude` decimal(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `detaillokasi`, `gambar`, `latitude`, `longitude`) VALUES
(34, 'Lokasi PLTS 1.', 'luas lokasi : -+ 83 Ha\r\nSlope : 0 -8 % (datar)\r\nGHI : > 5 Kwh/m2/hari\r\nJarak ke pemukiman : -+ 2 km\r\njarak ke jalan : -+ 1,5 km\r\nTitik Koordinat : -9.062964, 124.947296\r\nBerada Pada Lahan Kosong Dan Berada di Kecamatan Tasifeto Timur', '68147076c2c39_wilayah1.png', -9.062964, 124.947296),
(39, 'Lokasi PLTS 2.', 'luas lokasi : -+ 131 Ha\r\nSlope : 0 -8 % datar\r\nGHI : > 5 Kwh/m2/hari\r\nJarak ke pemukiman : -+ 2 km\r\njarak ke jalan : -+ 1,5 km\r\nTitik Koordinat : -9.076005, 124.868962\r\nBerada Pada Lahan Kosong Dan Berada di Kecatamtan Atambua Barat', '6817b159d0807_wilayah2.png', -9.076005, 124.868962),
(40, 'Lokasi PLTS 3.', 'luas lokasi : -+ 236 Ha\r\nSlope : 0 -8 % datar\r\nGHI : > 5 Kwh/m2/hari\r\nJarak ke pemukiman : -+ 2 km\r\njarak ke jalan : -+ 1,5 km\r\nTitik Koordinat : -9.121784, 124.839786\r\nBerada Pada Lahan Kosong Dan Berada di Kecatamtan Tasifeto Barat', '6817b1ea82c3e_wilayah3.png', -9.121784, 124.839786),
(41, 'Lokasi PLTS 4.', 'luas lokasi : -+ 168 Ha\r\nSlope : 0 -8 % datar\r\nGHI : > 5 Kwh/m2/hari\r\nJarak ke pemukiman : -+ 2 km\r\njarak ke jalan : -+ 1,5 km\r\nTitik Koordinat : -9.195849, 124.904009\r\nBerada Pada Lahan Kosong Dan Berada di Kecatamtan Tasifeto Barat', '6817b24398ca7_wilayah4.png', -9.195849, 124.904009);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
