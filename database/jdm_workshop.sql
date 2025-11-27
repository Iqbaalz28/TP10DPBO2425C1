CREATE DATABASE IF NOT EXISTS jdm_workshop;
USE jdm_workshop;

-- 1. Tabel Owners (Pelanggan)
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `membership_status` enum('Reguler','JDM_Community_VIP') DEFAULT 'Reguler',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel Mechanics (Tuner/Mekanik)
CREATE TABLE IF NOT EXISTS `mechanics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tuner` varchar(100) NOT NULL,
  `spesialisasi` enum('Rotary','Inline-6','Boxer','General') NOT NULL,
  `status` enum('Available','Busy') DEFAULT 'Available',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Cars (Mobil - Relasi ke Owner)
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_owner` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `kode_sasis` varchar(20) NOT NULL,
  `kode_mesin` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_owner` (`id_owner`),
  CONSTRAINT `fk_owner` FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Services (Katalog Layanan/Parts)
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(100) NOT NULL,
  `jenis` enum('Service','Dyno Tuning','Part Install') NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Bookings (Transaksi Utama)
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(20) NOT NULL UNIQUE,
  `id_car` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_mechanic` int(11) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `status` enum('Pending','In_Progress','Completed') DEFAULT 'Pending',
  `total_biaya` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_car` (`id_car`),
  KEY `fk_service` (`id_service`),
  KEY `fk_mechanic` (`id_mechanic`),
  CONSTRAINT `fk_car` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`),
  CONSTRAINT `fk_service` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`),
  CONSTRAINT `fk_mechanic` FOREIGN KEY (`id_mechanic`) REFERENCES `mechanics` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Tabel Service_Logs (Riwayat Modifikasi)
CREATE TABLE IF NOT EXISTS `service_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) NOT NULL,
  `catatan_teknis` text,
  `tanggal_selesai` date,
  PRIMARY KEY (`id`),
  KEY `fk_booking` (`id_booking`),
  CONSTRAINT `fk_booking` FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Dummy Data
INSERT INTO `owners` (`nama_owner`, `kontak`, `membership_status`) VALUES
('Takumi Fujiwara', '081111111', 'Reguler'),
('Ryosuke Takahashi', '082222222', 'JDM_Community_VIP');

INSERT INTO `mechanics` (`nama_tuner`, `spesialisasi`) VALUES
('Smokey Nagata', 'Inline-6'),
('Keiichi Tsuchiya', 'General');

INSERT INTO `services` (`nama_layanan`, `jenis`, `harga`) VALUES
('Ganti Oli High Performance', 'Service', 1500000.00),
('Dyno Tuning Session (2 Jam)', 'Dyno Tuning', 3500000.00);