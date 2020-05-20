-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 11:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `url_shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `short`
--

CREATE TABLE `short` (
  `id` int(11) NOT NULL,
  `alias` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `date` datetime NOT NULL,
  `expire` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `short`
--

INSERT INTO `short` (`id`, `alias`, `url`, `date`, `expire`) VALUES
(1, 'a', 'https://github.com/FahrulID/', '2020-05-20 15:52:17', '0000-00-00 00:00:00'),
(2, 'b', 'https://github.com/FahrulID/', '2020-05-20 08:50:51', '2020-05-20 16:10:00'),
(3, 'c', 'https://github.com/FahrulID/', '2020-05-20 08:59:34', '2020-05-20 09:09:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `short`
--
ALTER TABLE `short`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `short`
--
ALTER TABLE `short`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
