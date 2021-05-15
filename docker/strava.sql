-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: May 15, 2021 at 03:02 PM
-- Server version: 10.6.0-MariaDB-1:10.6.0+maria~focal
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strava`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `clientId` int(11) NOT NULL DEFAULT 0,
  `refreshToken` varchar(50) NOT NULL DEFAULT '0',
  `accessToken` varchar(50) DEFAULT NULL,
  `clientSecret` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`clientId`, `refreshToken`, `accessToken`, `clientSecret`) VALUES
(123, 'Refresh', 'auth', 'secret'),
(52753, '780372a3a3bb4a6fe56b143df30923db40c085af', 'aee2ea5dd5cba36462e0f986787b596fa5712c0c', '63c0d4c5e6662fef0d2474921f1b9f9bf7b1a289');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
