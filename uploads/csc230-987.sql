-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2018 at 05:07 AM
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
(1, '2018-04-14 22:21:53', 0, '2018-04-05 18:03:35'),
(3, '2018-04-03 18:12:01', 0, '2018-04-03 18:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `dno` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) NOT NULL,
  `dtitle` varchar(150) NOT NULL,
  `posted_date` date NOT NULL,
  `due_date` date NOT NULL,
  `file` text,
  PRIMARY KEY (`dno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitation`
--

INSERT INTO `solicitation` (`pid`, `sid`, `stitle`, `type`, `category`, `status`, `last_updated`, `final_filing_date`, `description`) VALUES
(1, '1234', 'xyz', 'solicitation', 'pscc', 'created', '2018-04-05 18:05:48', '2018-03-31 15:00:00', 'computer software engineeringrtht'),
(1, '12345', 'gfdgfdfgh', 'solicitation', 'it', 'created', '2018-03-31 11:36:16', '2018-03-31 15:00:00', '<p>fdjfgdgf</p>'),
(1, '167', 'ABCD', 'solicitation', 'it', 'New', '2018-03-31 23:03:30', '2018-04-01 15:00:00', 'apple banana'),
(3, '2334-ALIB', 'Scooby-Doo Style Detective Work Needed', 'Solicitation', 'Information Technology', 'Published', '2018-04-01 12:38:59', '2017-10-31 15:00:00', 'Scooby-Doo Style Detective Work Needed'),
(1, '987', 'test', 'cn', 'pscc', 'New', '2018-04-04 20:43:43', '2018-04-03 15:00:00', '<p>test</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
