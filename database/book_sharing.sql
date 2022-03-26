-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 11:21 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(60) NOT NULL COMMENT 'This is admin id',
  `admin_name` varchar(255) NOT NULL COMMENT 'this is admin name',
  `admin_email` varchar(255) NOT NULL COMMENT 'This is admin email id',
  `password` varchar(255) NOT NULL COMMENT 'this is admin password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `password`) VALUES
(1, 'jainil', 'jainiladmin@gmail.com', '1eeb65bae656479467f57b9e690549df26c12b60');

-- --------------------------------------------------------

--
-- Table structure for table `book_transaction`
--

CREATE TABLE `book_transaction` (
  `book_id` int(255) NOT NULL COMMENT 'This is book id',
  `book_name` varchar(255) NOT NULL COMMENT 'This is book name',
  `book_price` int(255) NOT NULL COMMENT 'This is book price',
  `book_author` varchar(255) NOT NULL COMMENT 'This is book publisher name',
  `book_coverpage` text DEFAULT NULL COMMENT 'This is image of book cover',
  `book_publish_year` year(4) NOT NULL COMMENT 'This is book publish date',
  `book_description` text NOT NULL COMMENT 'This is book description',
  `seller_id` int(255) NOT NULL COMMENT 'This is seller id',
  `buyer_id` int(11) DEFAULT NULL,
  `delivery_guy_id` int(60) DEFAULT NULL,
  `upload_time` datetime NOT NULL DEFAULT current_timestamp(),
  `BookPin` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_transaction`
--

INSERT INTO `book_transaction` (`book_id`, `book_name`, `book_price`, `book_author`, `book_coverpage`, `book_publish_year`, `book_description`, `seller_id`, `buyer_id`, `delivery_guy_id`, `upload_time`, `BookPin`) VALUES
(3, 'C++', 320, 'Ashok kamthene', 'media/Book_cover_image/c++.png', 2004, 'c++ is the advance level of c with classes and objects ', 20, 29, 1, '2022-02-22 14:12:24', 10560),
(4, 'Android ', 592, 'Google', 'media/Book_cover_image/Andriod.png', 2006, 'Android is the os for the mobile phone', 20, 29, 1, '2022-02-22 14:14:15', 11799),
(12, 'java', 214, 'kishan', 'media/Book_cover_image/logo_without_text30651.png', 2000, 'this java book for beginners                                         ', 20, 29, 2, '2022-03-23 16:07:37', 6621),
(13, 'php', 333, 're', 'media/Book_cover_image/php15267.png', 2003, 'jhgfhj', 29, NULL, NULL, '2022-03-25 11:09:15', 1934),
(14, 'fgh', 678, 'rty', 'media/Book_cover_image/Inkeddashed ovel_LI50067.jpg', 2000, 'dfgh', 29, 20, NULL, '2022-03-25 11:21:31', 15434),
(15, 'erg', 788, 'erherh5', 'media/Book_cover_image/stock-photo-6460160927501.jpg', 2005, 'tyjuu', 29, 20, NULL, '2022-03-25 11:27:06', 15774),
(16, 'c++', 200, 'abc', 'media/Book_cover_image/c++3422240245.png', 2000, 'kissjksa', 20, NULL, NULL, '2022-03-25 11:54:10', NULL),
(17, 'java', 1900, 'anshraj', 'media/Book_cover_image/java23643.png', 2022, 'atmakatha written by anshraj', 29, NULL, NULL, '2022-03-25 12:30:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_guy`
--

CREATE TABLE `delivery_guy` (
  `delivery_guy_id` int(255) NOT NULL COMMENT 'This is delivery guy id',
  `delivery_guy_name` varchar(255) NOT NULL COMMENT 'This is delivery guy name',
  `delivery_guy_email` varchar(255) NOT NULL COMMENT 'This is delivery guy email',
  `delivery_guy_dob` date NOT NULL COMMENT 'This is delivery guy date of birth',
  `Profile_photo` varchar(70) NOT NULL,
  `delivery_guy_address` varchar(255) NOT NULL,
  `delivery_guy_pincode` int(255) NOT NULL COMMENT 'This is delivery guy pincode',
  `delivery_guy_password` varchar(255) NOT NULL COMMENT 'This is delivery guy password',
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_guy`
--

INSERT INTO `delivery_guy` (`delivery_guy_id`, `delivery_guy_name`, `delivery_guy_email`, `delivery_guy_dob`, `Profile_photo`, `delivery_guy_address`, `delivery_guy_pincode`, `delivery_guy_password`, `status`) VALUES
(1, 'kishan', 'kishan118@gmail.com', '0000-00-00', '', 'rfbg vsvfbevf ', 235542, '', 1),
(2, 'jainil prajapati b', 'ramu@celaeno.com', '0000-00-00', '', ' df fdvwd fvc', 588727, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `Report_id` int(12) NOT NULL,
  `Report_msg` text NOT NULL,
  `reporter_user` int(12) NOT NULL,
  `reported_user` int(12) NOT NULL,
  `report_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`Report_id`, `Report_msg`, `reporter_user`, `reported_user`, `report_time`) VALUES
(1, 'bttrbgfrbr 4reb4 rtgf', 29, 20, '2022-03-03 15:25:33'),
(2, 'Spam or misleading', 29, 20, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `fname` varchar(190) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `email` varchar(90) NOT NULL,
  `Profile_photo` varchar(255) NOT NULL DEFAULT 'media/profile_photos/default_photo.svg',
  `address` text NOT NULL,
  `pincode` int(20) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `IsRestricted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `user_name`, `email`, `Profile_photo`, `address`, `pincode`, `create_date`, `password`, `IsRestricted`) VALUES
(20, 'jainil', 'jainil112', 'jainil112@gmail.com', 'media/profile_photos/default_photo.svg', '103,ambikadham-1', 37445, '2022-03-02', '1eeb65bae656479467f57b9e690549df26c12b60', 1),
(29, 'jainil prajapati', 'sfdg', 'jainil@gmail.com', 'media/profile_photos/default_photo.svg', '103,Ambikadham-1 sector-15,gandhinager', 382016, '2022-03-04', '1eeb65bae656479467f57b9e690549df26c12b60', 0);

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
(73, 29, 20, 'nghnmghm', '2022-03-25 13:15:07');

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `book_transaction`
--
ALTER TABLE `book_transaction`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `Book` (`BookPin`);

--
-- Indexes for table `delivery_guy`
--
ALTER TABLE `delivery_guy`
  ADD PRIMARY KEY (`delivery_guy_id`),
  ADD UNIQUE KEY `delivery_guy_email` (`delivery_guy_email`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`Report_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`msgid`);

--
-- Indexes for table `warn_user_delivery_guy`
--
ALTER TABLE `warn_user_delivery_guy`
  ADD PRIMARY KEY (`wanr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(60) NOT NULL AUTO_INCREMENT COMMENT 'This is admin id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_transaction`
--
ALTER TABLE `book_transaction`
  MODIFY `book_id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'This is book id', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery_guy`
--
ALTER TABLE `delivery_guy`
  MODIFY `delivery_guy_id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'This is delivery guy id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `Report_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `msgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `warn_user_delivery_guy`
--
ALTER TABLE `warn_user_delivery_guy`
  MODIFY `wanr_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
