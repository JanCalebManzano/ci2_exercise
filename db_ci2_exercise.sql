-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2019 at 03:54 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ci2_exercise`
--
CREATE DATABASE IF NOT EXISTS `db_ci2_exercise` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_ci2_exercise`;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('f28ddfe1583c859d497633884498ff25', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36', 1551412353, ''),
('a7f4d3d6e07bc6f10b508d02f132acac', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36', 1551411419, 'a:5:{s:9:"user_data";s:0:"";s:2:"ID";s:1:"3";s:5:"email";s:23:"jcmanzano_007@yahoo.com";s:8:"isActive";s:1:"1";s:10:"isLoggedIn";b:1;}'),
('2de1a8ad6bd8d67f3f9996b7c3f39a26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36', 1551497979, 'a:5:{s:9:"user_data";s:0:"";s:2:"ID";s:1:"3";s:5:"email";s:23:"jcmanzano_007@yahoo.com";s:8:"isActive";s:1:"1";s:10:"isLoggedIn";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `ID` int(11) NOT NULL,
  `scheduledAt` datetime DEFAULT NULL,
  `description` text,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdBy` int(11) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`ID`, `scheduledAt`, `description`, `createdAt`, `createdBy`, `isActive`) VALUES
(1, '2019-02-28 18:30:00', 'asdaa', '2019-02-28 18:42:23', 2, 1),
(2, '2019-02-28 19:00:00', 'asdfgaa', '2019-02-28 18:43:39', 2, 0),
(3, '2019-02-28 18:30:00', 'qweqweq', '2019-02-28 18:21:32', 1, 1),
(4, '2019-02-28 18:30:00', 'Pack up things', '2019-02-28 16:08:53', 1, 1),
(5, '2019-02-28 19:30:00', 'Pack up my things', '2019-02-28 16:09:15', 1, 1),
(6, '2019-02-28 20:30:00', 'Pack up my things', '2019-02-28 18:36:37', 2, 1),
(7, '2019-02-28 21:59:00', 'latest', '2019-02-28 17:47:10', 1, 1),
(8, '2019-03-01 12:00:00', 'Submit exer', '2019-03-01 11:33:46', 3, 1),
(9, '2019-03-01 12:30:00', 'Have lunch', '2019-03-01 11:37:13', 3, 1),
(10, '2019-03-02 08:30:00', 'Edit weekly report', '2019-03-02 11:40:25', 3, 1),
(11, '2019-03-02 12:00:00', 'asdasd qweqwe', '2019-03-02 11:41:04', 3, 0),
(12, '2019-03-01 12:00:00', 'Submit mini exercise', '2019-03-01 11:50:31', 5, 1),
(13, '2019-03-01 11:50:00', 'Chech code', '2019-03-01 11:50:56', 5, 1),
(14, '2019-03-01 11:55:00', 'Finalize code', '2019-03-01 11:51:19', 5, 1),
(15, '2019-03-01 13:59:59', 'qweqwe ewew', '2019-03-01 11:52:18', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `ID` int(11) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `email`, `password`, `isActive`) VALUES
(1, 'jcmanzano37@gmail.com', 'c628ad1f926f2e4a64749c68a3e25526', 1),
(2, 'jcmanzano_07@yahoo.com', 'c628ad1f926f2e4a64749c68a3e25526', 1),
(3, 'jcmanzano_007@yahoo.com', 'c628ad1f926f2e4a64749c68a3e25526', 1),
(4, 'jcmanzano_08@yahoo.com', 'c628ad1f926f2e4a64749c68a3e25526', 1),
(5, 'jcmanzano_008@yahoo.com', 'c628ad1f926f2e4a64749c68a3e25526', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
