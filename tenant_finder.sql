-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 09:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenant finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(40) NOT NULL,
  `PASSWORD` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `APPID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `OWNERID` int(11) NOT NULL,
  `HOUSEID` int(11) NOT NULL,
  `ROOMID` int(11) NOT NULL,
  `BOOKINGID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOKINGID` int(11) NOT NULL,
  `DATE` varchar(12) NOT NULL,
  `TIME` varchar(12) NOT NULL,
  `HOUSEID` int(11) NOT NULL,
  `OWNID` int(11) NOT NULL,
  `ROOMID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `ID` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `HOUSENO` varchar(6) NOT NULL,
  `STREETNAME` varchar(40) NOT NULL,
  `PROVINCE` varchar(25) NOT NULL,
  `OWNERID` varchar(13) NOT NULL,
  `CODE` varchar(4) NOT NULL,
  `ROOMID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `OWNID` int(11) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `SURNAME` varchar(20) NOT NULL,
  `IDNO` varchar(12) NOT NULL,
  `ACCNO` varchar(15) NOT NULL,
  `CONTACT` varchar(10) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `ADDRESS` varchar(50) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `TRANSID` int(11) NOT NULL,
  `CARDNO` varchar(16) NOT NULL,
  `CVVNO` varchar(3) NOT NULL,
  `CARDHOLDERNAME` varchar(60) NOT NULL,
  `HOUSEID` int(11) NOT NULL,
  `ROOMID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ROOMID` int(11) NOT NULL,
  `ROOMTYPE` varchar(60) NOT NULL,
  `ROOMDESC` text NOT NULL,
  `PRICE` double NOT NULL,
  `HOUSEID` int(11) NOT NULL,
  `BOOKINGID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `NAME` text NOT NULL,
  `SURNAME` text NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `CONTACT` varchar(10) NOT NULL,
  `BIRTHDATE` varchar(20) NOT NULL,
  `ADDRESS` varchar(100) NOT NULL,
  `PASSWORD` varchar(20) NOT NULL,
  `IDENTITYNUMBER` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `NAME`, `SURNAME`, `EMAIL`, `CONTACT`, `BIRTHDATE`, `ADDRESS`, `PASSWORD`, `IDENTITYNUMBER`) VALUES
(2, 'lehlogonolo', 'malapane', 'hlogs23@gmail.com', '0763421453', '2023-02-08', '37 plumer street', '1234', '3456780987086');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`APPID`),
  ADD KEY `BOOKINGID` (`BOOKINGID`),
  ADD KEY `HOUSEID` (`HOUSEID`),
  ADD KEY `OWNERID` (`OWNERID`),
  ADD KEY `ROOMID` (`ROOMID`),
  ADD KEY `USERID` (`USERID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOKINGID`),
  ADD KEY `HOUSEID` (`HOUSEID`),
  ADD KEY `OWNID` (`OWNID`),
  ADD KEY `ROOMID` (`ROOMID`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`OWNID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`TRANSID`),
  ADD KEY `payment_ibfk_1` (`ROOMID`),
  ADD KEY `HOUSEID` (`HOUSEID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ROOMID`),
  ADD KEY `HOUSEID` (`HOUSEID`),
  ADD KEY `BOOKINGID` (`BOOKINGID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`BOOKINGID`) REFERENCES `booking` (`BOOKINGID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`HOUSEID`) REFERENCES `house` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`OWNERID`) REFERENCES `owner` (`OWNID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`ROOMID`) REFERENCES `room` (`ROOMID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`USERID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`HOUSEID`) REFERENCES `house` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`OWNID`) REFERENCES `owner` (`OWNID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`ROOMID`) REFERENCES `room` (`ROOMID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`ROOMID`) REFERENCES `room` (`ROOMID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`HOUSEID`) REFERENCES `house` (`ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`HOUSEID`) REFERENCES `house` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`BOOKINGID`) REFERENCES `booking` (`BOOKINGID`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
