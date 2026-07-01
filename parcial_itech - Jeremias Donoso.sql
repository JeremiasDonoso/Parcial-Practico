-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 05:08 PM
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
-- Database: `parcial_itech`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas_interes`
--

CREATE TABLE `areas_interes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `areas_interes`
--

INSERT INTO `areas_interes` (`id`, `nombre`) VALUES
(6, 'Big Data'),
(8, 'Blockchain'),
(3, 'Ciberseguridad'),
(5, 'Cloud Computing'),
(4, 'Desarrollo Móvil'),
(1, 'Desarrollo Web'),
(9, 'DevOps'),
(2, 'Inteligencia Artificial'),
(7, 'IoT (Internet de las Cosas)'),
(10, 'Machine Learning');

-- --------------------------------------------------------

--
-- Table structure for table `inscriptores`
--

CREATE TABLE `inscriptores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documento` varchar(30) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `pais_residencia_id` int(11) NOT NULL,
  `nacionalidad_id` int(11) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `firma` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscriptores`
--

INSERT INTO `inscriptores` (`id`, `nombre`, `apellido`, `documento`, `edad`, `sexo`, `pais_residencia_id`, `nacionalidad_id`, `correo`, `celular`, `observaciones`, `fecha_registro`, `firma`) VALUES
(7, 'Jeremias', 'Donoso', '9-234-2123', 20, 'Masculino', 1, 1, 'ejemplo@gmail.com', '63212343', 'Ejemplo1', '2026-07-01 15:08:14', 'ahGMmS+Qhb43CwdqQJMm2KAVD3aFN3Nas9nTGklumV4ZphBJtWmzeNjI6/vtGLANmRJoTtwLXwFxswksZwD5MZ4p7Pzni1mIBXcRhK7dUBO+Cc/j8IHN2VOFLKCMOndwJzEfufPD9M4ygK61c2WKQqh3cblKBdCDKphvX+r4sidnmiix7JG1AwgSv3sa9D8MUM9RxQJomy8ivHtH3wL1QvMJhzK3r1rrQ0UvTj0AUWJrdUf9NDd7JL5/SwF81o0divpt0Dbmtcy/AKqIRiZRTN0UJ3K80pWrmYiPR38iR9tMNvYVA4oY6Fy3LdHuM1BfFHKMp82odDKUVDe07p8bkg==');

-- --------------------------------------------------------

--
-- Table structure for table `inscriptor_temas`
--

CREATE TABLE `inscriptor_temas` (
  `id` int(11) NOT NULL,
  `inscriptor_id` int(11) NOT NULL,
  `area_interes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inscriptor_temas`
--

INSERT INTO `inscriptor_temas` (`id`, `inscriptor_id`, `area_interes_id`) VALUES
(28, 7, 6),
(29, 7, 8),
(30, 7, 3),
(31, 7, 5),
(32, 7, 4),
(33, 7, 1),
(34, 7, 9),
(35, 7, 2),
(36, 7, 7),
(37, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paises`
--

INSERT INTO `paises` (`id`, `nombre`) VALUES
(7, 'Argentina'),
(8, 'Chile'),
(2, 'Colombia'),
(3, 'Costa Rica'),
(6, 'España'),
(5, 'Estados Unidos'),
(4, 'México'),
(1, 'Panamá'),
(9, 'Perú'),
(10, 'Venezuela');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas_interes`
--
ALTER TABLE `areas_interes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `inscriptores`
--
ALTER TABLE `inscriptores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_documento` (`documento`),
  ADD KEY `fk_pais_residencia` (`pais_residencia_id`),
  ADD KEY `fk_nacionalidad` (`nacionalidad_id`);

--
-- Indexes for table `inscriptor_temas`
--
ALTER TABLE `inscriptor_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_area` (`area_interes_id`),
  ADD KEY `fk_inscriptor` (`inscriptor_id`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas_interes`
--
ALTER TABLE `areas_interes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inscriptores`
--
ALTER TABLE `inscriptores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inscriptor_temas`
--
ALTER TABLE `inscriptor_temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inscriptores`
--
ALTER TABLE `inscriptores`
  ADD CONSTRAINT `fk_nacionalidad` FOREIGN KEY (`nacionalidad_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pais_residencia` FOREIGN KEY (`pais_residencia_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `inscriptor_temas`
--
ALTER TABLE `inscriptor_temas`
  ADD CONSTRAINT `fk_area` FOREIGN KEY (`area_interes_id`) REFERENCES `areas_interes` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscriptor` FOREIGN KEY (`inscriptor_id`) REFERENCES `inscriptores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
