-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 09:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `warn_user_delivery_guy`
--

CREATE TABLE `warn_user_delivery_guy` (
  `wanr_id` int(255) NOT NULL,
  `warn_user_id` int(255) NOT NULL,
  `warning_message` text NOT NULL,
  `warn_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warn_user_delivery_guy`
--

INSERT INTO `warn_user_delivery_guy` (`wanr_id`, `warn_user_id`, `warning_message`, `warn_time`) VALUES
(1, 20, 'fg grfbeb nngf gtrfb bgfb g fbgv gf fv f f   ', '2022-03-22 22:01:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `warn_user_delivery_guy`
--
ALTER TABLE `warn_user_delivery_guy`
  ADD PRIMARY KEY (`wanr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `warn_user_delivery_guy`
--
ALTER TABLE `warn_user_delivery_guy`
  MODIFY `wanr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
