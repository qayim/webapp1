-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2021 at 01:04 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` varchar(40) NOT NULL,
  `apass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `apass`) VALUES
('Muqriez', 'dc1dd16f48c67dce6f875c9b7aad1401'),
('Pipah', 'dc1dd16f48c67dce6f875c9b7aad1401'),
('Qayim', 'dc1dd16f48c67dce6f875c9b7aad1401'),
('Syah', 'dc1dd16f48c67dce6f875c9b7aad1401');

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `claimid` int(11) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claim`
--

INSERT INTO `claim` (`claimid`, `phone`, `rid`) VALUES
(7, 8921348, 1),
(8, 11234567, 1),
(9, 19876545, 1),
(10, 19996578, 1),
(11, 601234445, 1),
(12, 1413542321, 2);

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `did` int(11) NOT NULL,
  `dname` varchar(128) DEFAULT NULL,
  `dcompany` varchar(128) DEFAULT NULL,
  `dlogo` varchar(128) DEFAULT NULL,
  `dcode` varchar(128) DEFAULT NULL,
  `daddress` varchar(128) DEFAULT NULL,
  `dpostal` varchar(128) DEFAULT NULL,
  `dcountry` varchar(128) DEFAULT NULL,
  `dtagline` varchar(200) DEFAULT NULL,
  `ddesc` varchar(200) DEFAULT NULL,
  `damount` int(11) DEFAULT NULL,
  `dunit` varchar(20) DEFAULT NULL,
  `popularitycounter` int(11) DEFAULT NULL,
  `dcomment` varchar(1600) DEFAULT 'no comment',
  `duploaddate` date DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `dcountrysupp` varchar(300) DEFAULT NULL,
  `dactivate` varchar(20) DEFAULT 'deactive',
  `dverify` varchar(20) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `aid` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`did`, `dname`, `dcompany`, `dlogo`, `dcode`, `daddress`, `dpostal`, `dcountry`, `dtagline`, `ddesc`, `damount`, `dunit`, `popularitycounter`, `dcomment`, `duploaddate`, `start`, `end`, `dcountrysupp`, `dactivate`, `dverify`, `phone`, `aid`) VALUES
(6, 'Raya', 'Wowwww', '127412.png', '10692NGFX', 'No. 5, Jalan P9A/5, Presint 9', '62250', 'Malaysia', 'Wowww', 'Meow', 30, 'Giftcard', 5, 'no comment', '2021-07-24', '2021-06-28', '2021-08-05', 'Brunei', 'active', 'approve', 1413542321, 'Qayim'),
(7, 'Raya', 'Rain', '153295.jpg', '2952KBPY', 'Indonesia', '67770', 'Singapore', 'Wowww', 'Meow', 30, 'Giftcard', 30, 'no comment', '2021-07-24', '2021-06-29', '2021-07-29', 'Brunei', 'active', 'approve', 1413542321, 'Qayim'),
(14, 'Avatar dergsertg', 'Rain', '383606.png', '780MYAS', 'Indonesia', '67770', 'Singapore', 'ewfdscaes', 'ewfdsca', 10, 'Giftcard', 2, 'Nice deal', '2021-07-26', '2021-07-12', '2021-07-31', 'Brunei', 'active', 'approve', 8921348, 'Qayim'),
(15, 'arfaewrsdgvaes', 'qgrvdaer', '517239.jpeg', '1092VNDJ', 'qrwegdvae', 'arewvae', 'Malaysia', 'eragvae', 'agersv', 12, '%', 9, 'No comment', '2021-07-26', '2021-07-06', '2021-08-06', 'Singapore', 'active', 'approve', 8921348, 'Qayim'),
(16, 'werdfcaers', 'regvae', '125913.png', '72PWYK', 'aredvac', 'aergvaer', 'Indonesia', 'rewdsca', 'arwedvc', 14, '%', 7, 'No comment', '2021-07-26', '2021-06-29', '2021-07-29', 'Brunei', 'active', 'approve', 8921348, 'Qayim'),
(17, 'Avatar dergsertg', 'aregdvsretdf', '126297.jpeg', '9720BAGQ', 'No. 8, Jalan P8E/2, Presint 8, Putrajaya', '62253', 'Singapore', 'hsrtdhfbsbr', 'srtngb sfxg', 45, 'RM', NULL, 'Fix the name', '2021-07-26', '2021-07-06', '2021-08-04', 'Brunei', 'deactive', 'rejected', 1413542321, 'Qayim'),
(18, 'Susss', 'sthbfvsrtdf', '797016.jpeg', '12528ABWV', 'tsbdv srdt', 'tsrbdv srtdf', 'Indonesia', 'stehbfsrf', 'strdbf srf', 32432, 'RM', NULL, 'Good deal!', '2021-07-26', '2021-07-15', '2021-08-04', 'Brunei', 'active', 'approve', 1413542321, 'Qayim'),
(19, 'Web Deal', 'Amazon', '948620.jpg', '7920NOMW', 'Somewhere', '112233', 'Malaysia', 'We have all the deals', '50% discount on items online', 50, '%', NULL, 'Good deal!', '2021-07-28', '2021-06-01', '2021-09-08', 'Malaysia', 'deactive', 'pending', 1244444, 'Qayim'),
(20, 'Nezuko deals', 'VNY', '92795.jpg', '2604HRLI', 'Somewhere', '12345', 'Singapore', 'Deals for some', '30% off every purchase', 30, '%', NULL, 'Nice deal', '2021-07-28', '2021-06-29', '2021-08-06', 'Malaysia', 'active', 'pending', 19996578, 'Qayim'),
(21, 'Nezuko deals', 'GGG', '241245.jpg', '2760FOJE', 'No. 8, Jalan P8E/2, Presint 8, Putrajaya', '62253', 'Indonesia', 'For all deals', '20% discount for all purchases', 20, '%', NULL, 'No comment', '2021-07-28', '2021-06-29', '2021-08-05', 'Brunei', 'deactive', 'pending', 601234445, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gen`
--

CREATE TABLE `gen` (
  `genid` int(11) NOT NULL,
  `firstgen` int(11) DEFAULT NULL,
  `secondgen` int(11) DEFAULT NULL,
  `thirdgen` int(11) DEFAULT NULL,
  `thirdhalfgen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gen`
--

INSERT INTO `gen` (`genid`, `firstgen`, `secondgen`, `thirdgen`, `thirdhalfgen`) VALUES
(1, 1413542321, 8921348, NULL, 0),
(2, 1413542321, 8921348, NULL, 0),
(3, 1413542321, 8921348, NULL, 0),
(4, 1413542321, 8921348, NULL, 0),
(5, 1413542321, 8921348, NULL, 0),
(6, 1413542321, 8921348, NULL, 0),
(7, 1413542321, 8921348, NULL, 0),
(8, 1413542321, 8921348, NULL, 0),
(9, 1413542321, 8921348, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `id` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `time` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `nid` int(11) NOT NULL,
  `noti` varchar(200) DEFAULT NULL,
  `time` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`nid`, `noti`, `time`) VALUES
(1, 'SECURITY WARNING: Exessive log in attempt on email: luigi@gmail.com', 'Europe/Berlin 10:28:24'),
(2, 'SECURITY WARNING: Exessive log in attempt on email: luigi@gmail.com', 'Europe/Berlin 10:28:29'),
(3, 'SECURITY WARNING: Exessive log in attempt on email: luigi@gmail.com', 'Europe/Berlin 10:47:13'),
(4, 'SECURITY WARNING: Exessive log in attempt on email: luigi@gmail.com', 'Europe/Berlin 07:25:48'),
(5, 'SECURITY WARNING: Exessive log in attempt on email: luigi@gmail.com', 'Europe/Berlin 07:25:56'),
(6, 'SECURITY WARNING: Exessive log in attempt on email: webapptest@gmail.com', 'Europe/Berlin 09:37:39'),
(7, 'SECURITY WARNING: Exessive log in attempt on email: qayimtest@gmail.com', 'Europe/Berlin 11:25:49'),
(8, 'SECURITY WARNING: Exessive log in attempt on email: qayimtest@gmail.com', 'Europe/Berlin 11:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `referid` int(11) NOT NULL,
  `channel` varchar(128) DEFAULT NULL,
  `ipadd` varchar(128) DEFAULT NULL,
  `referalcode` varchar(128) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referal`
--

INSERT INTO `referal` (`referid`, `channel`, `ipadd`, `referalcode`, `phone`) VALUES
(8, 'website', '::1', 'F37008', 11234567),
(10, 'website', '::1', 'F33642', 1413542321),
(12, 'website', '::1', 'F326100', 1234567),
(27, 'website', '::1', '12345', 8921348),
(28, 'website', '::1', 'F170328', 11234567),
(29, 'website', '::1', 'F46300', 19876545),
(30, 'website', '::1', 'F22272', 1244444),
(32, 'website', '::1', 'F561420', 19996578),
(33, 'website', '::1', 'F250950', 601234445);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `rid` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `rname` varchar(128) DEFAULT NULL,
  `coinprice` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rdesc` varchar(128) DEFAULT NULL,
  `rcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`rid`, `type`, `rname`, `coinprice`, `status`, `rdesc`, `rcode`) VALUES
(1, 'Voucher', 'Cash prizes', 60, 'active', 'RM60 cash vouchers for all malls', 'SMH'),
(2, 'Discount', 'Clothing discounts', 500, 'active', '60% discount for clothes at the nearest mall', 'WWW123'),
(3, 'Cash', 'Cash prizes', 40, 'active', 'RM60 cash vouchers for all malls', 'WWW123');

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `sid` int(11) NOT NULL,
  `platform` varchar(16) DEFAULT NULL,
  `did` int(11) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `share`
--

INSERT INTO `share` (`sid`, `platform`, `did`, `phone`) VALUES
(22, 'whatsapp', 15, 1413542321),
(23, 'facebook', 15, 1413542321),
(24, 'twitter', 15, 1413542321),
(25, 'email', 15, 1413542321),
(26, 'whatsapp', 7, 1413542321),
(27, 'twitter', 6, 1413542321),
(28, 'facebook', 16, 1413542321),
(29, 'whatsapp', 7, 1244444),
(30, 'whatsapp', 6, 1244444),
(31, 'facebook', 7, 1244444),
(32, 'twitter', 7, 1244444),
(33, 'email', 7, 1244444),
(34, 'whatsapp', 16, 19876545),
(35, 'facebook', 16, 19876545),
(36, 'twitter', 16, 19876545),
(37, 'email', 16, 19876545),
(38, 'whatsapp', 7, 19996578),
(39, 'facebook', 7, 19996578),
(40, 'twitter', 7, 19996578),
(41, 'email', 7, 19996578),
(42, 'whatsapp', 14, 19996578),
(43, 'whatsapp', 7, 601234445),
(44, 'facebook', 7, 601234445),
(45, 'twitter', 7, 601234445),
(46, 'email', 7, 601234445),
(47, 'whatsapp', 15, 601234445);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `phone` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `postal` varchar(20) DEFAULT NULL,
  `country` varchar(128) DEFAULT NULL,
  `gender` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT 'peasant',
  `stats` varchar(128) DEFAULT 'active',
  `referalcode` varchar(128) DEFAULT NULL,
  `refertype` varchar(128) DEFAULT NULL,
  `referalcounter` varchar(128) DEFAULT NULL,
  `coinamount` int(11) DEFAULT NULL,
  `aid` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`phone`, `name`, `pass`, `email`, `address`, `postal`, `country`, `gender`, `category`, `stats`, `referalcode`, `refertype`, `referalcounter`, `coinamount`, `aid`) VALUES
(122222, 'qayim67', '03ed41c240df6490d39981eb2ad2ea94', 'qayim67@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'other', 'peasant', 'active', 'F359440', 'first', NULL, 0, NULL),
(1234567, 'Qayim', '03ed41c240df6490d39981eb2ad2ea94', 'qayim5@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'male', 'king', 'active', 'F326100', 'first', '2', 100, NULL),
(1244444, 'Web App Test', 'b6920d9083c8e76685bcc8db34b8c9bb', 'webapptest@gmail.com', 'UPM Serdang', '1122334', 'Malaysia', 'other', '', 'active', 'F22855', 'second', NULL, 100, 'Qayim'),
(8921348, 'Qayim', '03ed41c240df6490d39981eb2ad2ea94', 'qayim123@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'male', 'King', 'deactive', 'F46300', 'second', '2', 350, 'Qayim'),
(11234567, 'Qayim', '03ed41c240df6490d39981eb2ad2ea94', 'qayim2@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'male', '', 'deactive', 'F37008', 'second', '4', 538, 'Qayim'),
(19876545, 'Qayim', '03ed41c240df6490d39981eb2ad2ea94', 'qayimcute@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'male', 'peasant', 'active', 'F22272', 'third', '1', 15, NULL),
(19996578, 'Nezuko', '03ed41c240df6490d39981eb2ad2ea94', 'qayimtest@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'female', '', 'active', 'F35280', 'second', NULL, 15, 'Qayim'),
(113313124, 'Qayim', '03ed41c240df6490d39981eb2ad2ea94', 'qayim1@gmail.com3', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'female', 'peasant', 'active', 'F250950', 'first', '2', 100, NULL),
(123141232, 'qayim', 'dc1dd16f48c67dce6f875c9b7aad1401', 'mario@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '62250', 'Malaysia', 'female', 'duke', 'block', 'F561420', 'first', '3', 204, NULL),
(601234445, 'nezuko', '83be32aa81db5fdce7ded8d0a1dd863c', 'nezuko@gmail.com', 'No. 5, Jalan P8E/2, Presint 8, Putrajaya', '12233', 'Malaysia', 'other', '', 'active', 'F170226', 'second', NULL, 15, 'Qayim'),
(1133418165, 'qayim', 'qayim', 'qayim1@gmail.com', 'No.5', '62250', 'Malaysia', 'Male', 'duke', 'active', '12345', 'first', '3', 180, 'Qayim'),
(1413542321, 'Luigi', 'e9da82f4c252e7f1745ae88f2624fc07', 'luigi@gmail.com', 'No. 8, Jalan P8E/2, Presint 8, Putrajaya', '62253', 'Singapore', 'male', 'King', 'deactive', 'F33642', 'first', '14', 270, 'Qayim'),
(2147483647, 'Luigi', 'e9da82f4c252e7f1745ae88f2624fc07', 'luigi12@gmail.com', 'No. 8, Jalan P8E/2, Presint 8, Putrajaya', '62253', 'Singapore', 'male', 'king', 'active', 'F170328', 'first', '1', 75, 'Qayim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`claimid`),
  ADD KEY `claim_fk1` (`phone`),
  ADD KEY `claim_fk2` (`rid`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`did`),
  ADD KEY `deal_fk` (`phone`);

--
-- Indexes for table `gen`
--
ALTER TABLE `gen`
  ADD PRIMARY KEY (`genid`);

--
-- Indexes for table `loginlogs`
--
ALTER TABLE `loginlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`referid`),
  ADD KEY `referal_fk` (`phone`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `share_fk` (`phone`),
  ADD KEY `share_fk2` (`did`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`phone`),
  ADD KEY `users_fk` (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `claimid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gen`
--
ALTER TABLE `gen`
  MODIFY `genid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loginlogs`
--
ALTER TABLE `loginlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `referal`
--
ALTER TABLE `referal`
  MODIFY `referid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim`
--
ALTER TABLE `claim`
  ADD CONSTRAINT `claim_fk1` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`),
  ADD CONSTRAINT `claim_fk2` FOREIGN KEY (`rid`) REFERENCES `reward` (`rid`);

--
-- Constraints for table `deal`
--
ALTER TABLE `deal`
  ADD CONSTRAINT `deal_fk` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`);

--
-- Constraints for table `referal`
--
ALTER TABLE `referal`
  ADD CONSTRAINT `referal_fk` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`);

--
-- Constraints for table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `share_fk` FOREIGN KEY (`phone`) REFERENCES `users` (`phone`),
  ADD CONSTRAINT `share_fk2` FOREIGN KEY (`did`) REFERENCES `deal` (`did`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
