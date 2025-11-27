-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 05:42 AM
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

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `kode_booking`, `id_car`, `id_service`, `id_mechanic`, `tanggal`, `status`) VALUES
(1, 'JDM-202311-001', 1, 1, 1, '2025-11-27', 'Pending'),
(2, 'JDM-202311-002', 2, 2, 2, '2025-11-26', 'OnProcess'),
(3, 'JDM-202310-089', 1, 2, 2, '2025-10-15', 'Done'),
(4, 'JDM-202311-003', 2, 1, 1, '2025-11-27', 'Pending');

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
(2, 2, 'Mazda RX-7', '13B-REW'),
(3, 4, 'Nissan Skyline GT-R R34 V-Spec II', 'RB26DETT'),
(4, 4, 'Toyota Supra MK4 RZ', '2JZ-GTE'),
(5, 3, 'Mazda RX-7 Veilside Fortune', '13B-REW'),
(6, 3, 'Nissan Silvia S15 Mona Lisa', 'SR20DET'),
(7, 5, 'Nissan 350Z Fairlady', 'VQ35DE'),
(8, 1, 'Subaru Impreza WRX STI Type R', 'EJ20'),
(9, 2, 'Mitsubishi Lancer Evolution IX MR', '4G63T'),
(10, 2, 'Honda Integra Type R DC5', 'K20A');

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
(2, 'Keiichi', 'Rotary', 'Busy'),
(3, 'Daigo Saito', 'Inline-6', 'Available'),
(4, 'Tarzan Yamada', 'Inline-6', 'Busy'),
(5, 'Bunta Fujiwara', 'Boxer', 'Available'),
(6, 'Akira Nakai', 'Boxer', 'Busy'),
(7, 'Mad Mike', 'Rotary', 'Available'),
(8, 'Kazuhiko \"Smokey\" II', 'V-Type', 'Available');

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
(2, 'Ryosuke', '08198765432', 'JDM_VIP'),
(3, 'Han Lue', '08123456789', 'JDM_VIP'),
(4, 'Brian OConner', '08199887766', 'Reguler'),
(5, 'DK (Drift King)', '08555556666', 'JDM_VIP');

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
(1, 'Ganti Oli High Perfomance', 'Service', 1500000.00),
(2, 'Dyno Tuning Stage 1', 'Dyno Tuning', 5000000.00),
(3, 'Ganti Oli Motul 300V Competition', 'Service', 2800000.00),
(4, 'Install Coilover (Tein/Ohlins) + Alignment', 'Service', 3500000.00),
(5, 'Brake Pad Replacement (Endless/Brembo)', 'Service', 4200000.00),
(6, 'HKS Super Fire Racing Spark Plugs (Set)', 'Service', 1800000.00),
(7, 'Titanium Exhaust Installation', 'Service', 1500000.00),
(8, 'RB26/2JZ Engine Refresh/Rebuild', 'Service', 25000000.00),
(9, 'ECU Remap Standalone (Haltech/Link)', 'Dyno Tuning', 8500000.00),
(10, 'Dyno Power Run (3 Pulls)', 'Dyno Tuning', 1500000.00),
(11, 'Boost Controller Setup (HKS EVC)', 'Dyno Tuning', 2500000.00),
(12, 'Street Tune Calibration', 'Dyno Tuning', 4500000.00),
(13, 'Pops & Bangs / Anti-Lag Setup', 'Dyno Tuning', 3000000.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
