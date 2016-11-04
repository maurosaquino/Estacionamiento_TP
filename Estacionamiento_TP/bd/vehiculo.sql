-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2016 at 06:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehiculos`
--

-- --------------------------------------------------------

--
-- Table structure for table `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id` int(10) NOT NULL,
  `patente` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `ingreso` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `egreso` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `importe_abonado` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `patente`, `ingreso`, `egreso`, `importe_abonado`) VALUES
(4, 'AAASSS', '02-11-16 15:11:11', '02-11-16 16:17:25', '8'),
(5, 'AAABBB', '02-11-16 15:11:45', '02-11-16 16:38:17', '115.38'),
(6, 'JAF334', '02-11-16 16:11:42', '02-11-16 16:40:45', '38.73'),
(7, 'YUN124', '02-11-16 16:11:49', '02-11-16 16:38:51', '36.04'),
(8, 'MIL172', '02-11-16 16:11:38', '02-11-16 16:40:43', '38.78'),
(9, 'JAF112', '02-11-16 16:40:50', '02-11-16 16:46:32', '7.6'),
(10, 'JAF334', '02-11-16 16:41:05', '02-11-16 16:41:15', '0.22'),
(11, 'YUH123', '02-11-16 16:47:09', '02-11-16 16:47:11', '0.04'),
(12, 'AAAVED', '03-11-16 11:09:39', '03-11-16 11:40:45', '41.47'),
(13, 'CVR567', '03-11-16 11:09:47', '03-11-16 11:09:58', '0.24'),
(14, 'ADF123', '03-11-16 11:41:18', '03-11-16 13:59:28', '184.22'),
(15, 'AA344', '03-11-16 11:41:55', '03-11-16 14:00:15', '184.44'),
(16, 'ASDXZX', '03-11-16 11:41:59', '03-11-16 14:00:36', '184.82'),
(17, '23456', '03-11-16 11:42:03', '03-11-16 14:18:25', '208.49'),
(19, 'THY234', '03-11-16 14:13:35', NULL, NULL),
(20, 'FRT555', '03-11-16 14:17:19', '03-11-16 14:17:28', '0.2'),
(21, '456TYG', '03-11-16 14:17:38', '03-11-16 14:21:46', '5.51'),
(22, 'AAASSS', '03-11-16 14:20:24', '03-11-16 14:21:59', '2.11'),
(23, 'TYG345', '03-11-16 14:20:30', '03-11-16 14:21:05', '0.78'),
(24, 'AAABBB', '03-11-16 14:20:38', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
