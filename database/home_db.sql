-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 10:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
('glkuxCM0An8Dr7nkey02', 'candra', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('QgM3rjqr1GGFH8XHXW27', 'wisnawa', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
('FXqCLctFEUlJBgJohgTT', 'kusuma coba message', 'kusuma@gmail.com', '0888888888', 'ujicoba kirim message');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `property_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `offer` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `furnished` varchar(50) NOT NULL,
  `bhk` varchar(10) NOT NULL,
  `deposite` varchar(10) NOT NULL,
  `bedroom` varchar(10) NOT NULL,
  `bathroom` varchar(10) NOT NULL,
  `balcony` varchar(10) NOT NULL,
  `carpet` varchar(10) NOT NULL,
  `age` varchar(2) NOT NULL,
  `total_floors` varchar(2) NOT NULL,
  `room_floors` varchar(2) NOT NULL,
  `loan` varchar(50) NOT NULL,
  `lift` varchar(3) NOT NULL,
  `security_guard` varchar(3) NOT NULL,
  `play_ground` varchar(3) NOT NULL,
  `garden` varchar(3) NOT NULL,
  `water_supply` varchar(3) NOT NULL,
  `power_backup` varchar(3) NOT NULL,
  `parking_area` varchar(3) NOT NULL,
  `gym` varchar(3) NOT NULL,
  `shopping_mall` varchar(3) NOT NULL,
  `hospital` varchar(3) NOT NULL,
  `school` varchar(3) NOT NULL,
  `market_area` varchar(3) NOT NULL,
  `image_01` varchar(50) NOT NULL,
  `image_02` varchar(50) NOT NULL,
  `image_03` varchar(50) NOT NULL,
  `image_04` varchar(50) NOT NULL,
  `image_05` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` varchar(20) NOT NULL,
  `property_id` varchar(20) NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE `saved` (
  `id` varchar(20) NOT NULL,
  `property_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `number`, `email`, `password`) VALUES
('jeb6Hibm2XpDcsY6U24z', 'putu wisnawa', '081999977969', 'putu.wisnawa@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
('msPU78VhOEWvntW5b3Zv', 'user B', '098299289828', 'user_b@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
