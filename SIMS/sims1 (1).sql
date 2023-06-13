-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2023 at 05:05 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sims1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Aid` varchar(35) NOT NULL,
  `Apass` varchar(35) NOT NULL,
  PRIMARY KEY (`Aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Aid`, `Apass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bit`
--

DROP TABLE IF EXISTS `bit`;
CREATE TABLE IF NOT EXISTS `bit` (
  `Eno` int(11) NOT NULL,
  `Sname` varchar(30) DEFAULT NULL,
  `IIT` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT NULL,
  `Digital_logic` int(11) DEFAULT NULL,
  `Sociology` int(11) DEFAULT NULL,
  `Math` int(11) DEFAULT NULL,
  `absences` int(11) DEFAULT '0',
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Eno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bit`
--

INSERT INTO `bit` (`Eno`, `Sname`, `IIT`, `C`, `Digital_logic`, `Sociology`, `Math`, `absences`, `status`) VALUES
(2, 'Ram', 13, 78, 22, 46, 56, 5, 'Fail');

-- --------------------------------------------------------

--
-- Table structure for table `csit`
--

DROP TABLE IF EXISTS `csit`;
CREATE TABLE IF NOT EXISTS `csit` (
  `Eno` int(11) NOT NULL,
  `Sname` varchar(30) DEFAULT NULL,
  `IIT` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT NULL,
  `Digital_logic` int(11) DEFAULT NULL,
  `Math` int(11) DEFAULT NULL,
  `Physics` int(11) DEFAULT NULL,
  `absences` int(11) DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Eno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csit`
--

INSERT INTO `csit` (`Eno`, `Sname`, `IIT`, `C`, `Digital_logic`, `Math`, `Physics`, `absences`, `status`) VALUES
(1, 'Sam', 11, 15, 11, 15, 11, 11, 'First'),
(3, 'Rabin', NULL, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `Eno` bigint(20) NOT NULL,
  `Eid` varchar(35) NOT NULL,
  `Course` varchar(35) NOT NULL,
  `ExId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ExamName` varchar(20) NOT NULL,
  `Q1` text NOT NULL,
  `Q2` text NOT NULL,
  `Q3` text NOT NULL,
  `Q4` text NOT NULL,
  `Q5` text NOT NULL,
  PRIMARY KEY (`ExId`)
) ENGINE=InnoDB AUTO_INCREMENT=532 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Eno`, `Eid`, `Course`, `ExId`, `ExamName`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`) VALUES
(146891650, 'harsh@ica.com', 'MCA', 528, 'PHP', 'o1', 'o1', 'o1', 'o1', 'o1'),
(146891650, 'harsh@ica.com', 'MCA', 529, ' PHP', 'o1', 'o1', 'o1', 'o1', 'o1'),
(146891654, 'vishal@ica.com', 'MCA', 530, ' PHP', 'o1', 'o2', 'o3', 'o1', 'o2'),
(146891658, 'priya@ics.com', 'B.Com', 531, ' PHP', 'o3', 'o2', 'o3', 'o1', 'o2');

-- --------------------------------------------------------

--
-- Table structure for table `facutlytable`
--

DROP TABLE IF EXISTS `facutlytable`;
CREATE TABLE IF NOT EXISTS `facutlytable` (
  `FID` int(10) NOT NULL AUTO_INCREMENT,
  `FName` varchar(50) NOT NULL,
  `FaName` varchar(30) NOT NULL,
  `Addrs` text NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `JDate` date NOT NULL,
  `City` varchar(10) NOT NULL,
  `Pass` varchar(10) NOT NULL,
  `PhNo` bigint(10) NOT NULL,
  `course` varchar(20) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facutlytable`
--

INSERT INTO `facutlytable` (`FID`, `FName`, `FaName`, `Addrs`, `Gender`, `JDate`, `City`, `Pass`, `PhNo`, `course`, `rating`) VALUES
(107, 'jeevan vandari', 'sabin vandari', 'Kathmandu,Nepal', 'Male', '2023-04-14', 'Kathmandu', 'jeevan123', 3457897653, 'csit', NULL),
(109, 'shahid mallya', 'a mallya', 'Kathmandu,Nepal', 'Male', '2023-04-14', 'Kathmandu', 'shahid123', 3457897651, 'bit', 2);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `GuEid` varchar(35) NOT NULL,
  `Gname` varchar(35) NOT NULL,
  PRIMARY KEY (`Gname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`GuEid`, `Gname`) VALUES
('Anil21@gmail.com', 'Anil Rawat'),
('g10093k@gmail.com', 'Gunjan'),
('lalit66@gmail.com', 'lalit kumar');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

DROP TABLE IF EXISTS `query`;
CREATE TABLE IF NOT EXISTS `query` (
  `Query` text NOT NULL,
  `Ans` text NOT NULL,
  `Eid` varchar(35) NOT NULL,
  `Qid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Qid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `query`
--

INSERT INTO `query` (`Query`, `Ans`, `Eid`, `Qid`) VALUES
('							Can i do BCA. ', '				no									', 'Anil21@gmail.com', 5),
('							hello sir you are core. ', '			what you are saying\r\n										', 'Raj1220@rr.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `registrationtable`
--

DROP TABLE IF EXISTS `registrationtable`;
CREATE TABLE IF NOT EXISTS `registrationtable` (
  `RegID` int(50) NOT NULL AUTO_INCREMENT,
  `FName` varchar(30) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `FaName` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `Addrs` text NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `PhNo` bigint(10) NOT NULL,
  `Eid` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Course` varchar(50) NOT NULL,
  PRIMARY KEY (`RegID`),
  UNIQUE KEY `Eid` (`Eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store Regestration Details';

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `RsID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Eno` varchar(20) NOT NULL,
  `Course` varchar(30) NOT NULL,
  `Marks` varchar(20) NOT NULL,
  PRIMARY KEY (`RsID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studenttable`
--

DROP TABLE IF EXISTS `studenttable`;
CREATE TABLE IF NOT EXISTS `studenttable` (
  `Eno` bigint(20) NOT NULL AUTO_INCREMENT,
  `FName` varchar(30) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `FaName` varchar(30) NOT NULL,
  `Addrs` text NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Course` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `PhNo` bigint(10) NOT NULL,
  `Pass` varchar(20) NOT NULL,
  `Eid` varchar(50) NOT NULL,
  `SRegID` int(50) NOT NULL,
  `G1` float DEFAULT NULL,
  `G2` float DEFAULT NULL,
  `G3` float DEFAULT NULL,
  `failures` int(11) DEFAULT '0',
  PRIMARY KEY (`Eno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studenttable`
--

INSERT INTO `studenttable` (`Eno`, `FName`, `LName`, `FaName`, `Addrs`, `Gender`, `Course`, `DOB`, `PhNo`, `Pass`, `Eid`, `SRegID`, `G1`, `G2`, `G3`, `failures`) VALUES
(1, 'Sam', 'jain', 'ram jain', 'ktm,nepal', 'Male', 'csit', '1999-12-30', 9856743610, 'Sam123', 'abcd@gmail.com', 1, 12.6, NULL, NULL, 0),
(2, 'Ram', 'Regmi', 'Hari Regmi', 'Kathmandu,Nepal', 'Male', 'bit', '1999-12-31', 3457897654, 'Ram123', 'abc.ab@gmail.com', 2, 43, NULL, NULL, 0),
(3, 'Rabin', 'Gaire', 'Robin Gaire', 'ktm,nepal', 'Male', 'csit', '1999-12-30', 9856743210, 'Rabin123', 'abc@gmail.com', 3, NULL, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
