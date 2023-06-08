-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 11:47 AM
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
-- Database: `auction_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `status`, `image`) VALUES
(14, 'Xbox 1', 'Dual Controller, 1TB, Black', '500.00', 'Limiited Stock', 'xbox1.jpg'),
(15, 'Sony PlayStation 5', 'Dual Controller, 1TB, white', '1000.00', 'Limiited Stock', 'PS5.jpg'),
(16, 'ASUS S 13 OLED', '32GD RAM, 1TB, GREY', '10000.00', 'Limiited Stock', 'asus.jpg'),
(17, 'Blow Keyboard', 'Bluetooth, Wireless, Batteries', '800.00', 'Limiited Stock', 'blow.jpg'),
(18, 'Acer Aspire', '16GB, 512RAM, Corei7', '5000.00', 'Available', 'Acer.jpg'),
(19, 'LG Gram Ultraslim', '16GB, 512RAM, Corei7', '7000.00', 'Available', 'lg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone_number`, `address`) VALUES
(6, 'lucky', 'nmose', 'lucky.N', 'LN1@gmail.com', 'LN1000@23', '7283968344', 'Warsaw'),
(7, 'kevin', 'Muyanja', 'Kevin.M', 'MK1@gmail.com', 'MK001@23', '7283968300', 'Warsaw'),
(8, 'Sarah', 'Ahmed', 'Sarah.A', 'SA1@gmail.com', 'SA00F@23', '727796830', 'Warsaw'),
(9, 'Jubril', 'Abdulazeez', 'Jubril.A', 'AJ1@gmail.com', 'AJ00M@23', '727720830', 'Warsaw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
