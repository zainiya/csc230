-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2018 at 11:23 PM
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
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`rid`, `role`) VALUES
(1, 'superuser'),
(2, 'Bidder'),
(3, 'Evaluator'),
(4, 'Subscribed User');

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
(1, '2018-04-30 15:43:51', 0, '2018-04-05 18:03:35'),
(3, '2018-04-03 18:12:01', 0, '2018-04-03 18:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `bid_transaction`
--

CREATE TABLE IF NOT EXISTS `bid_transaction` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(9) NOT NULL,
  `pid` int(11) NOT NULL,
  `application_date` date NOT NULL,
  `last_updated` date NOT NULL,
  `eval_status` varchar(30) DEFAULT NULL,
  `fee` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `bidder_status` varchar(50) DEFAULT NULL,
  `Modified_pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bid_transaction`
--

INSERT INTO `bid_transaction` (`bid`, `sid`, `pid`, `application_date`, `last_updated`, `eval_status`, `fee`, `score`, `bidder_status`, `Modified_pid`) VALUES
(1, '1234', 2, '2018-04-22', '2018-04-22', 'Submitted', 100, 0, 'Under Review', 4),
(2, '167', 6, '2018-04-22', '2018-04-22', 'Submitted', 500, 0, 'Under Review', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `subscription_Date` datetime DEFAULT CURRENT_TIMESTAMP,
  `subscription_flag` int(1) DEFAULT '1',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`pid`, `f_name`, `m_init`, `l_name`, `email`, `ssn`, `password`, `rid`, `creationDate`, `subscription_Date`, `subscription_flag`) VALUES
(1, 'zainiya', 'a', 'manjiyani', 'abc@gmail.com', 1234, 'abcd', 1, '2018-03-30 14:22:29', NULL, 1),
(2, 'shaaz', '', 'manjiyani', 'lovelyzinu@gmail.com', 1234, 'shaaz', 2, '2018-03-30 14:22:29', NULL, 1),
(3, 'zohra', 'a', 'manjiyani', 'zohra@gmail.com', 4567, 'zohra', 1, '2018-04-01 12:33:40', NULL, 1),
(4, 'Sneha', '', 'Manjiyani', 'sneha.manjiyani@gmail.com', 4567, 'sneha', 3, '2018-04-22 11:07:28', NULL, 1),
(5, 'Alim', '', 'Manjiyani', 'zaineyamanjiyani@gmail.com', 7894, 'alim', 4, '2018-04-22 11:10:16', NULL, 1),
(6, 'parth', 'u', 'pachchigar', 'parthpachchigar@gmail.com', 7896, 'parth', 2, '2018-04-01 13:35:54', NULL, 1);

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
  `cancelflag` int(1) DEFAULT '0',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solicitation`
--

INSERT INTO `solicitation` (`pid`, `sid`, `stitle`, `type`, `category`, `status`, `last_updated`, `final_filing_date`, `description`, `cancelflag`) VALUES
(1, '1234', 'xyz', 'solicitation', 'pscc', 'Published', '2018-04-20 22:30:29', '2018-03-31 15:00:00', 'computer software engineering', 0),
(1, '1234-9876', 'TEST', 'rfp', 'pscc', 'New', '2018-04-25 15:10:00', '2018-04-25 15:00:00', '<p>TESTING IS GOING ON</p>', 0),
(1, '12345', 'gfdgfdfgh', 'solicitation', 'it', 'created', '2018-03-31 11:36:16', '2018-03-31 15:00:00', '<p>fdjfgdgf</p>', 0),
(1, '167', 'ABCD', 'ifb', 'pscc', 'cancelled', '2018-04-21 14:30:39', '2018-04-01 15:00:00', 'apple banana', 1),
(3, '2334-ALIB', 'Scooby-Doo Style Detective Work Needed', 'Solicitation', 'Information Technology', 'Awarded', '2018-04-01 12:38:59', '2017-10-31 15:00:00', 'Scooby-Doo Style Detective Work Needed', 0),
(1, '987', 'test', 'cn', 'pscc', 'Published', '2018-04-21 18:30:19', '2018-04-03 15:00:00', '<p>test 2</p>', 0),
(1, '9876-7563', 'TEST AGAIN', 'rfp', 'pscc', 'New', '2018-04-25 15:14:13', '2018-04-27 15:00:00', '<p>TESTING AGAIN!!!</p>', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
