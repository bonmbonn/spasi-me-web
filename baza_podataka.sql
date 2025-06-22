-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2025 at 12:11 PM
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
-- Database: `animals`
--

-- --------------------------------------------------------

--
-- Table structure for table `added_animals`
--

CREATE TABLE `added_animals` (
  `id` int(11) NOT NULL,
  `naziv` text NOT NULL,
  `vrsta` text NOT NULL,
  `starost` text NOT NULL,
  `kontakt` text NOT NULL,
  `lokacija` text NOT NULL,
  `detalji` text NOT NULL,
  `slika` text NOT NULL,
  `aktivno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `added_animals`
--

INSERT INTO `added_animals` (`id`, `naziv`, `vrsta`, `starost`, `kontakt`, `lokacija`, `detalji`, `slika`, `aktivno`) VALUES
(0, 'test', 'mačka', '1', '1', '1', '1', 'uploads/testicon.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `prezime` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `username`, `lozinka`, `razina`) VALUES
(124, 'admin', 'admin', 'admin', '$2y$10$jhYUyMU2NZOUwFkJrKmp8.R6bJR6rR3e//szu/ME6FZi1dp025bdK', 0),
(125, 'admin1', 'admin1', 'admin1', '$2y$10$gyImWszEiUFwTHfibUeHReii/A0wiXwJfOZ8PjqppLsyddnONRurC', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
