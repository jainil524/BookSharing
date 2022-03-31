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
-- Table structure for table `usermessages`
--

CREATE TABLE `usermessages` (
  `msgid` int(11) NOT NULL,
  `sender` int(255) NOT NULL,
  `receiver` int(255) NOT NULL,
  `usermsg` text NOT NULL,
  `send_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usermessages`
--

INSERT INTO `usermessages` (`msgid`, `sender`, `receiver`, `usermsg`, `send_time`) VALUES
(54, 29, 20, 'hello', '2022-03-20 17:39:16'),
(55, 29, 20, 'whats up?', '2022-03-20 17:44:27'),
(56, 29, 20, 'hii jainil', '2022-03-24 19:16:34'),
(57, 20, 29, 'hello kishan', '2022-03-24 19:16:46'),
(58, 29, 20, 'hello', '2022-03-25 10:55:39'),
(59, 29, 20, 'hey', '2022-03-25 10:55:45'),
(60, 20, 29, 'hey', '2022-03-25 11:04:53'),
(61, 20, 29, 'hi', '2022-03-25 11:10:07'),
(62, 29, 20, 'dgdh', '2022-03-25 11:10:38'),
(63, 29, 20, 'hlo sir', '2022-03-25 11:19:16'),
(64, 20, 29, 'hlo', '2022-03-25 11:22:16'),
(65, 29, 20, 'I have doubt', '2022-03-25 11:27:45'),
(66, 29, 20, 'hlo', '2022-03-25 11:30:02'),
(67, 20, 29, 'hleooooo', '2022-03-25 11:40:39'),
(68, 29, 20, 'AK pztel', '2022-03-25 11:43:55'),
(69, 29, 20, 'hjsjd', '2022-03-25 12:18:49'),
(70, 29, 20, 'fgjfg', '2022-03-25 12:40:37'),
(71, 29, 20, 'lfhg', '2022-03-25 13:12:05'),
(72, 29, 20, 'bgsfhugfusd', '2022-03-25 13:15:01'),
(73, 29, 20, 'nghnmghm', '2022-03-25 13:15:07'),
(74, 29, 20, 'kk', '2022-03-25 16:39:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`msgid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `msgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
