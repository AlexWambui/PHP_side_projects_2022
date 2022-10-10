-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 03:54 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wanderis_animal_feed_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(6) NOT NULL,
  `category` int(2) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `product_name`, `price`, `product_image`, `date_created`) VALUES
(4, 1, 'Chicken Mash.', 1000, 'uploads/65238chicken mash.jpg', '2022-10-05 16:45:04'),
(5, 3, 'Josera Salmon & Potato.', 1500, 'uploads/23588download.jpg', '2022-10-05 16:45:47'),
(7, 4, 'Fish fingers.', 900, 'uploads/77367download (3).jpg', '2022-10-06 07:01:06'),
(8, 2, 'Pasupati Milk Concentrate.', 1350, 'uploads/51706Milk-Concentrate.jpg', '2022-10-10 12:55:52'),
(9, 4, 'Friskies Gravy Swiriers.', 1400, 'uploads/90538download (3).jpg', '2022-10-10 12:57:01'),
(10, 1, 'Chick Starter Grower', 1100, 'uploads/37509download (2).jpg', '2022-10-10 12:57:51'),
(11, 4, 'Meow Mix', 1500, 'uploads/23142download (1).jpg', '2022-10-10 12:58:15'),
(12, 2, 'Agrofeed Super Mix.', 1150, 'uploads/25525agrofeed super mix.jpg', '2022-10-10 13:09:45'),
(13, 2, 'Producer\'s Pride Cattle Cubes.', 1560, 'uploads/19679Cattle Cubes.jpg', '2022-10-10 13:10:34'),
(14, 2, 'Nutri Rich', 1650, 'uploads/44172Nutri Rich.jpg', '2022-10-10 13:10:54'),
(15, 1, 'Egg Makers 15 Pellets', 1850, 'uploads/80689egg maker.jpg', '2022-10-10 13:13:15'),
(16, 1, 'Layers Mash', 1230, 'uploads/73835layers mash.jpg', '2022-10-10 13:14:36'),
(17, 1, 'Starter Crumbles', 1480, 'uploads/64852Starter Crumbles.jpg', '2022-10-10 13:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(6) NOT NULL,
  `product_id` int(6) NOT NULL,
  `amount_in_kgs` float NOT NULL,
  `payment_method` int(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `amount_in_kgs`, `payment_method`, `date_created`, `date`) VALUES
(4, 5, 4, 2, '2022-10-06 09:17:26', '2022-10-06'),
(5, 4, 5, 1, '2022-10-05 22:32:30', '2022-10-05'),
(6, 7, 10, 1, '2022-10-06 07:01:36', '2022-10-06'),
(7, 11, 4, 2, '2022-10-10 13:31:55', '2022-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_level` int(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `password`, `user_level`, `date_created`) VALUES
(1, 'Admin', 'DBAdmin', 'admin@gmail.com', '0746 055 476', 'admin.', 3, '2022-09-30 13:41:59'),
(2, 'user', 'user_test', 'user@gmail.com', '0789 765 564', 'user.', 1, '2022-09-30 13:42:45'),
(3, 'Aaqil', 'Dequantes', 'aaqil@gmail.com', '0746 055 487', 'aaqil.', 2, '2022-10-06 00:30:20'),
(4, 'Hellen', 'Wahome', 'hellen@gmail.com', '0787 654 321', 'hellen', 1, '2022-10-06 07:04:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
