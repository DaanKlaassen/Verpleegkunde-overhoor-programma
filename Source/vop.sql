-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:43 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vop`
--

-- --------------------------------------------------------

--
-- Table structure for table `inlog&register`
--

CREATE TABLE `inlog&register` (
  `ID` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inlog&register`
--

INSERT INTO `inlog&register` (`ID`, `username`, `password`, `email`) VALUES
(3, 'daan klaassen', '$2y$10$asi27ETIo2GDHTVdZqsSXu8OWEyibPeF.y6Th9G19Kh7jnxuWAPbK', 'daan.klaassen@student.gildeopleidingen.nl'),
(4, 'daan klaassen', '$2y$10$WI4n1p6M/jeNvp6nU4D5Yu/u9yuEWj1KIDN9tpRXZr/K0Bw..XBjW', 'daan.klaassen@student.gildeopleidingen.nl');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(255) UNSIGNED NOT NULL,
  `woord` varchar(30) NOT NULL,
  `voor_achtervoegsel` varchar(30) DEFAULT NULL,
  `betekenis` varchar(50) DEFAULT NULL,
  `zin_voor` varchar(100) DEFAULT NULL,
  `zin_achter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `woord`, `voor_achtervoegsel`, `betekenis`, `zin_voor`, `zin_achter`) VALUES
(17, 'osteo', 'Voorvoegsel', 'bot', 'ik heb een', 'in mijn lichaam'),
(19, 'HHH', 'Achtervoegsel', '2+2=4', 'Da', '');

-- --------------------------------------------------------

--
-- Table structure for table `test2`
--

CREATE TABLE `test2` (
  `id` int(255) NOT NULL,
  `woord` varchar(30) NOT NULL,
  `voor_achtervoegsel` varchar(30) DEFAULT NULL,
  `betekenis` varchar(50) DEFAULT NULL,
  `zin_voor` varchar(100) DEFAULT NULL,
  `zin_achter` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inlog&register`
--
ALTER TABLE `inlog&register`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test2`
--
ALTER TABLE `test2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inlog&register`
--
ALTER TABLE `inlog&register`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `test2`
--
ALTER TABLE `test2`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
