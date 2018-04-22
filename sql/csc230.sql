-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2018 at 12:01 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csc230`
--
CREATE DATABASE IF NOT EXISTS `csc230` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `csc230`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `rid` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`rid`, `role`) VALUES
(1, 'superuser'),
(2, 'user'),
(3, 'Evaluator');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogs`
--

CREATE TABLE IF NOT EXISTS `adminlogs` (
  `pid` int(11) NOT NULL,
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `incorrectcnt` int(11) NOT NULL,
  `lastincorrect` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogs`
--

INSERT INTO `adminlogs` (`pid`, `lastlogin`, `incorrectcnt`, `lastincorrect`) VALUES
(1, '2018-04-20 22:40:07', 0, '2018-04-05 18:03:35'),
(3, '2018-04-03 18:12:01', 0, '2018-04-03 18:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `dno` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(9) DEFAULT NULL,
  `file_name` varchar(100) NOT NULL,
  `dtitle` varchar(150) NOT NULL,
  `posted_date` date NOT NULL,
  `due_date` date NOT NULL,
  `file` text,
  PRIMARY KEY (`dno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`dno`, `sid`, `file_name`, `dtitle`, `posted_date`, `due_date`, `file`) VALUES
(2, '12345', 'Data- Centric Architecture style.pptx', 'Data- Centric Architecture style.pptx', '2018-04-28', '2018-04-28', 'uploads/Data- Centric Architecture style.pptx'),
(3, '167', 'Data- Centric Architecture style.pptx', 'Data- Centric Architecture style.pptx', '2018-04-24', '2018-04-24', 'uploads/Data- Centric Architecture style.pptx'),
(5, '987', 'csc230.sql', 'csc230.sql-987', '2018-04-25', '2018-04-25', 'uploads/csc230.sql'),
(6, '987', 'Data- Centric Architecture style.pptx', 'Data- Centric Architecture style.pptx-987', '2018-04-26', '2018-04-26', 'uploads/Data- Centric Architecture style.pptx'),
(8, '1234', 'csc230.sql', 'csc230.sql-1234', '2018-04-26', '2018-04-26', 'uploads/csc230.sql'),
(9, '1234', 'csc230.sql', 'uploads/csc230-1234.sql', '2018-04-26', '2018-04-26', 'uploads/csc230.sql'),
(12, '1234', 'csc230.sql', 'csc230.sql-1234', '0000-00-00', '0000-00-00', 'uploads/csc230-1234.sql'),
(14, '167', 'csc230.sql', 'csc230.sql-167', '2018-04-27', '2018-04-27', 'uploads/csc230-167.sql');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(25) NOT NULL,
  `m_init` varchar(1) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ssn` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rid` int(11) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`pid`, `f_name`, `m_init`, `l_name`, `email`, `ssn`, `password`, `rid`, `creationDate`) VALUES
(1, 'zainiya', 'a', 'manjiyani', 'abc@gmail.com', 1234, 'abcd', 1, '2018-03-30 14:22:29'),
(2, 'shaaz', '', 'manjiyani', 'shaaz@gmail.com', 1234, 'shaaz', 2, '2018-03-30 14:22:29'),
(3, 'zohra', 'a', 'manjiyani', 'zohra@gmail.com', 4567, 'zohra', 1, '2018-04-01 12:33:40'),
(6, 'parth', 'u', 'pachchigar', 'parth@gmail.com', 7896, 'parth', 2, '2018-04-01 13:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `solicitation`
--

CREATE TABLE IF NOT EXISTS `solicitation` (
  `pid` int(11) NOT NULL,
  `sid` varchar(9) NOT NULL,
  `stitle` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `final_filing_date` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `cancelflag` int(1) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitation`
--

INSERT INTO `solicitation` (`pid`, `sid`, `stitle`, `type`, `category`, `status`, `last_updated`, `final_filing_date`, `description`, `cancelflag`) VALUES
(1, '1234', 'xyz', 'solicitation', 'pscc', 'Published', '2018-04-20 22:30:29', '2018-03-31 15:00:00', 'computer software engineering', 0),
(1, '12345', 'gfdgfdfgh', 'solicitation', 'it', 'created', '2018-03-31 11:36:16', '2018-03-31 15:00:00', '<p>fdjfgdgf</p>', 0),
(1, '167', 'ABCD', 'ifb', 'pscc', 'cancelled', '2018-04-21 14:30:39', '2018-04-01 15:00:00', 'apple banana', 1),
(3, '2334-ALIB', 'Scooby-Doo Style Detective Work Needed', 'Solicitation', 'Information Technology', 'Published', '2018-04-01 12:38:59', '2017-10-31 15:00:00', 'Scooby-Doo Style Detective Work Needed', 0),
(1, '987', 'test', 'cn', 'pscc', 'New', '2018-04-21 16:11:00', '2018-04-03 15:00:00', '<p>test</p>', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
