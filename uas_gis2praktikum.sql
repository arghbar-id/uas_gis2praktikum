-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 08:29 AM
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
-- Database: `uas_gis2praktikum`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `warna` varchar(100) NOT NULL,
  `poligon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `warna`, `poligon`) VALUES
(3, 'Fakultas Peternakan', '#921c1c', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.898755,-0.840351],[119.89913,-0.840351],[119.899087,-0.840898],[119.898793,-0.84092],[119.898755,-0.840351]]]}}]}'),
(4, 'Fakultas Keguruan dan Ilmu Pendidikan', '#99007d', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.892281,-0.831544],[119.893804,-0.831452],[119.893927,-0.832573],[119.892168,-0.832461],[119.892281,-0.831544]]]}}]}'),
(5, 'Fakultas Hukum', '#2b00ff', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.896593,-0.833142],[119.897059,-0.833142],[119.897129,-0.833909],[119.896587,-0.833947],[119.896593,-0.833142]]]}}]}'),
(6, 'Fakultas Ilmu Sosial dan Ilmu Politik', '#00ffee', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.89296,-0.833756],[119.894247,-0.83353],[119.894623,-0.834882],[119.893271,-0.835461],[119.89296,-0.833756]]]}}]}'),
(7, 'Fakultas Ekonomi', '#cc6d00', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.896271,-0.831249],[119.897467,-0.831324],[119.897446,-0.831876],[119.896936,-0.831892],[119.896271,-0.831249]]]}}]}'),
(8, 'Fakultas Pertanian', '#6fa664', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.896341,-0.838999],[119.897086,-0.838887],[119.897343,-0.839654],[119.896491,-0.839622],[119.896341,-0.838999]]]}}]}'),
(9, 'Fakultas Teknik', '#000000', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.892308,-0.840546],[119.89412,-0.840267],[119.894152,-0.84266],[119.892383,-0.843196],[119.892308,-0.840546]]]}}]}'),
(11, 'Fakultas Matematika dan Ilmu Pengetahuan Alam', '#ca7272', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.893723,-0.837358],[119.894147,-0.837326],[119.894291,-0.837932],[119.893798,-0.838146],[119.893723,-0.837358]]]}}]}'),
(12, 'Fakultas Kehutanan', '#00ff40', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.897811,-0.837364],[119.899205,-0.837364],[119.899376,-0.838351],[119.898357,-0.83877],[119.897811,-0.837364]]]}}]}'),
(13, 'Fakultas Kedokteran', '#2a0755', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.895857,-0.840932],[119.898195,-0.840675],[119.898227,-0.84149],[119.896093,-0.841769],[119.895857,-0.840932]]]}}]}'),
(14, 'Fakultas Kesehatan Masyarakat', '#06a77f', '{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[119.897972,-0.840464],[119.897864,-0.841805],[119.898508,-0.84181],[119.898476,-0.840426],[119.897972,-0.840464]]]}}]}');

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--

CREATE TABLE `rumah` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `Nim` varchar(150) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rumah`
--

INSERT INTO `rumah` (`id`, `nama`, `Nim`, `alamat`, `fakultas`, `latitude`, `longitude`) VALUES
(3, 'M. Arya Rivalda', 'F55119136', 'BTN BUMI RIVIGA', 'Fakultas Teknik', '-0.8450255364685808', '119.90480670498955'),
(4, 'Andi Nurun Muh Akbar', 'F55119093', 'Bantilan', 'Fakultas Teknik', '-0.8924699686787158', '119.85061499319332');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah`
--
ALTER TABLE `rumah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rumah`
--
ALTER TABLE `rumah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
