-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 04:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jdm_workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `kode_booking` varchar(20) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_mechanic` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Pending','OnProcess','Done') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `kode_mesin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `id_owner`, `model`, `kode_mesin`) VALUES
(1, 1, 'Toyota AE86', '4A-GE'),
(2, 2, 'Mazda RX-7', '13B-REW');

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics` (
  `id` int(11) NOT NULL,
  `nama_tuner` varchar(100) NOT NULL,
  `spesialisasi` enum('Rotary','Inline-6','Boxer','V-Type') NOT NULL,
  `status` enum('Available','Busy') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`id`, `nama_tuner`, `spesialisasi`, `status`) VALUES
(1, 'Smokey Nagata', 'V-Type', 'Available'),
(2, 'Keiichi', 'Rotary', 'Busy');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` int(11) NOT NULL,
  `nama_owner` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `membership_status` enum('Reguler','JDM_VIP') DEFAULT 'Reguler'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `nama_owner`, `kontak`, `membership_status`) VALUES
(1, 'Takumi', '08123456789', 'Reguler'),
(2, 'Ryosuke', '08198765432', 'JDM_VIP');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `nama_layanan` varchar(100) NOT NULL,
  `jenis` enum('Service','Dyno Tuning') NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `nama_layanan`, `jenis`, `harga`) VALUES
(1, 'Ganti Oli High Perf', 'Service', 1500000.00),
(2, 'Dyno Tuning Stage 1', 'Dyno Tuning', 5000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` int(11) NOT NULL,
  `id_booking` int(11) NOT NULL,
  `catatan_teknis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_car` (`id_car`),
  ADD KEY `id_service` (`id_service`),
  ADD KEY `id_mechanic` (`id_mechanic`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_owner` (`id_owner`);

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_booking` (`id_booking`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`id_mechanic`) REFERENCES `mechanics` (`id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD CONSTRAINT `service_logs_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
