CREATE DATABASE IF NOT EXISTS jdm_workshop;
USE jdm_workshop;

-- 1. Owners (Member Community logic)
CREATE TABLE IF NOT EXISTS `owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) NOT NULL,
  `membership_status` enum('Reguler','JDM_VIP') DEFAULT 'Reguler',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- 2. Mechanics (Spesialisasi engine)
CREATE TABLE IF NOT EXISTS `mechanics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tuner` varchar(100) NOT NULL,
  `spesialisasi` enum('Rotary','Inline-6','Boxer','V-Type') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- 3. Cars (Relasi ke Owner)
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_owner` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `kode_mesin` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_owner`) REFERENCES `owners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Services (Katalog)
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(100) NOT NULL,
  `jenis` enum('Service','Dyno Tuning') NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- 5. Bookings (Tabel Transaksi Utama)
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(20) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_mechanic` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Pending','OnProcess','Done') DEFAULT 'Pending',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`),
  FOREIGN KEY (`id_service`) REFERENCES `services` (`id`),
  FOREIGN KEY (`id_mechanic`) REFERENCES `mechanics` (`id`)
) ENGINE=InnoDB;

-- 6. Service Logs (Riwayat Modifikasi - Fitur Spesifik)
CREATE TABLE IF NOT EXISTS `service_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` int(11) NOT NULL,
  `catatan_teknis` text NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_booking`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DUMMY DATA
INSERT INTO owners VALUES (1, 'Takumi', 'Reguler'), (2, 'Ryosuke', 'JDM_VIP');
INSERT INTO mechanics VALUES (1, 'Smokey Nagata', 'V-Type'), (2, 'Keiichi', 'Rotary');
INSERT INTO cars VALUES (1, 1, 'Toyota AE86', '4A-GE'), (2, 2, 'Mazda RX-7', '13B-REW');
INSERT INTO services VALUES (1, 'Ganti Oli High Perf', 'Service', 1500000), (2, 'Dyno Tuning Stage 1', 'Dyno Tuning', 5000000);