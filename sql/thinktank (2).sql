-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2018 at 01:39 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thinktank`
--
CREATE DATABASE IF NOT EXISTS `thinktank` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `thinktank`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'Tim', 'Taylor', 'ttaylor@calpers.com', 'tt'),
(2, 'Jessy', 'Heinz', 'jheinz@calpers.com', 'jh'),
(3, 'Ahmed', 'Salem', 'Asalem@calpers.com', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(9) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` varchar(15) DEFAULT 'New',
  `DT_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DT_Modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `title`, `status`, `DT_created`, `DT_Modified`) VALUES
(1, 'Business Opportunity', 'New', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(2, 'Into the Stars', 'Rejected', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(3, 'Legal Services', 'Published', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(4, 'Stay Healthy', 'Under Review', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(5, 'Electrical Services', 'New', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(6, 'Electrical Services', 'New', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(7, 'Stay Healthy', 'Approved', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(8, 'Speed Post', 'New', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(9, 'Stay Healthy', 'Under Review', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(10, 'Real Estate', 'Published', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(11, 'Legal Services', 'Under Review', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(12, 'Photography', 'New', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(13, 'Best Infrastructure', 'Rejected', '2018-03-19 19:23:33', '2018-03-19 19:31:21'),
(14, 'Architecture Plan', 'Approved', '2018-03-19 19:23:33', '2018-03-19 19:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `bidder`
--

DROP TABLE IF EXISTS `bidder`;
CREATE TABLE IF NOT EXISTS `bidder` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` bigint(6) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `fax` bigint(20) DEFAULT NULL,
  `lastupdated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bidder`
--

INSERT INTO `bidder` (`id`, `firstname`, `lastname`, `dob`, `email`, `password`, `address`, `city`, `state`, `zip`, `phone`, `fax`, `lastupdated`) VALUES
(1, 'Aishwarya', 'Pendyala', '2018-03-14', 'ap@thinktank.com', 'ap', 'Sac State', 'Sacramento', 'CA', 95825, 9988776655, 9988776655, '2018-03-14'),
(2, 'Aishwarya', 'Pendyala', '2018-03-14', 'ap@thinktank.com', 'ap', 'Sac State', 'Sacramento', 'CA', 95825, 9988776655, 9988776655, '2018-03-14'),
(3, 'Reka', 'Supraja', '2018-03-14', 'rs@thinktank.com', 'rs', 'Sac State', 'Sacramento', 'CA', 95825, 9988776655, 9988776655, '2018-03-14'),
(4, 'Riddhi', 'Shah', '2018-03-14', 'rs@thinktank.com', 'rs', 'Sac State', 'Sacramento', 'CA', 95825, 9988776655, 9988776655, '2018-03-14'),
(5, 'Zaineya', 'Manjiyani', '2018-03-14', 'zm@thinktank.com', 'zm', 'Sac State', 'Sacramento', 'CA', 95825, 9988776655, 9988776655, '2018-03-14'),
(6, 'Elon', 'Musk', '2018-03-14', 'em@spacex.com', 'em', 'Kennedy Island', 'Kennedy Space Center', 'FL', 32899, 9876543210, 9876543210, '2018-03-14'),
(7, 'Arnold', 'Schwarzenegger', '2018-03-14', 'as@as.com', 'as', 'Los Angeles', 'LA', 'CA', 95825, 9933776655, 9933776655, '2018-03-14'),
(8, 'Sylvester', 'Stallone', '2018-03-14', 'ss@ss.com', 'ss', 'Beverly Hills', 'BH', 'CA', 94325, 9933772255, 9933772255, '2018-03-14'),
(9, 'Leonardo', 'DiCaprio', '2018-03-14', 'ld@ld.com', 'ld', 'Battery Park City', 'BCP', 'NY', 61325, 4433772255, 4433772255, '2018-03-14'),
(10, 'Thomas', 'Edison', '2018-03-14', 'te@te.com', 'te', 'Milan', 'Milan', 'OH', 51325, 2233772255, 2233772255, '2018-03-14'),
(11, 'Nikola', 'Tesla', '2018-03-14', 'nt@nt.com', 'nt', 'NewYork', 'NewYork', 'NY', 62325, 2211772255, 2211772255, '2018-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `bid_transactions`
--

DROP TABLE IF EXISTS `bid_transactions`;
CREATE TABLE IF NOT EXISTS `bid_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `Date_submtd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DT_Modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eval_Status` varchar(50) NOT NULL DEFAULT 'Submitted',
  `Bid_Amount` int(11) NOT NULL DEFAULT '0',
  `Score` int(11) NOT NULL DEFAULT '0',
  `Bidder_Status` varchar(50) NOT NULL DEFAULT 'Under Review',
  `ModifiedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bid_transactions`
--

INSERT INTO `bid_transactions` (`id`, `bid_id`, `bidder_id`, `Date_submtd`, `DT_Modified`, `Eval_Status`, `Bid_Amount`, `Score`, `Bidder_Status`, `ModifiedBy`) VALUES
(1, 1, 3, '2018-03-01 03:05:04', '2018-03-19 19:33:21', 'Accepted', 0, 0, 'Under Review', NULL),
(2, 1, 2, '2018-03-02 10:09:13', '2018-03-19 19:33:21', 'Rejected', 0, 0, 'Under Review', NULL),
(3, 1, 4, '2018-03-03 07:07:14', '2018-03-19 19:33:21', 'Accepted', 0, 0, 'Under Review', NULL),
(4, 1, 5, '2018-03-04 04:16:18', '2018-03-19 19:33:21', 'Accepted', 0, 0, 'Under Review', NULL),
(5, 2, 1, '2018-03-05 07:09:00', '2018-03-19 19:33:21', 'Submitted', 0, 0, 'Under Review', NULL),
(6, 2, 10, '2018-03-06 00:00:00', '2018-03-19 19:33:21', 'Submitted', 0, 0, 'Under Review', NULL),
(7, 3, 6, '2018-03-07 06:21:29', '2018-03-19 19:33:21', 'Submitted', 0, 0, 'Under Review', NULL),
(8, 3, 5, '2018-03-07 07:16:11', '2018-03-19 19:33:21', 'Submitted', 0, 0, 'Under Review', NULL),
(9, 1, 6, '2018-04-05 05:30:40', '2018-04-05 05:30:40', 'Accepted', 0, 0, 'Under Review', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `title`, `description`) VALUES
(1, 'Cover Letter', 'Cover Letter'),
(2, 'Fee Proposal', 'Fee Proposal'),
(3, 'Att-C-Tax Payer', 'California Taxpayer and Shareholder Protection Act Declaration'),
(4, 'Proposed Contract', 'Proposed Contract'),
(5, 'Proposal Certificate', 'Proposal Certificate'),
(6, 'Engagement Letter', 'Letter of Engagement'),
(7, 'Notice of Intent', 'Notice of Intent to Participate'),
(8, 'MinQualCert', 'Minimum Qualification Certificate'),
(9, 'Contracting Act Declaration', 'Contracting Act Declaration'),
(10, 'Proposed Subcontractors', 'List of Proposed Subcontractors'),
(11, 'Required Attachments Certification Checklist', 'Required Attachments Certification Checklist'),
(12, 'Client Rating Form', 'Client Rating and Instructions Form');

-- --------------------------------------------------------

--
-- Table structure for table `eval_status`
--

DROP TABLE IF EXISTS `eval_status`;
CREATE TABLE IF NOT EXISTS `eval_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eval_status`
--

INSERT INTO `eval_status` (`id`, `description`) VALUES
(1, 'Submitted'),
(2, 'Accepted'),
(3, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `solicitation`
--

DROP TABLE IF EXISTS `solicitation`;
CREATE TABLE IF NOT EXISTS `solicitation` (
  `id` varchar(9) NOT NULL,
  `title` varchar(40) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `finalFilingDate` date DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `category` varchar(40) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `minscore` int(4) DEFAULT NULL,
  `maxscore` int(4) DEFAULT NULL,
  `documents` varchar(200) DEFAULT NULL,
  `lastUpdated` date DEFAULT NULL,
  `updatedBy` varchar(40) DEFAULT NULL,
  `reviewedBy` varchar(50) DEFAULT NULL,
  `approvedBy` varchar(50) DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solicitation`
--

INSERT INTO `solicitation` (`id`, `title`, `status`, `finalFilingDate`, `type`, `category`, `description`, `minscore`, `maxscore`, `documents`, `lastUpdated`, `updatedBy`, `reviewedBy`, `approvedBy`, `createdBy`) VALUES
('1111-1111', 'Real Estate', 'Approved', '2018-06-01', 'Solicitation', 'General Technology', 'This is Solicitation', 40, 80, '000100001010', '2018-03-19', NULL, NULL, NULL, 0),
('2712-2000', 'Mission Mars', 'Under Review', '2018-05-01', 'Solicitation', 'Space Technology', 'This is Mission Mars', 50, 75, '010000001110', '2018-03-19', NULL, NULL, NULL, 0),
('0707-MSDR', 'Nuke the Moon', 'Rejected', '2018-05-05', 'Solicitation', 'Astro Technology', 'This will Nuke the Moon', 60, 80, '100000001010', '2018-03-19', NULL, NULL, NULL, 0),
('1305-LVNY', 'Into the Stars', 'Approved', '2018-04-04', 'Solicitation', 'Space Technology', 'This will take you into Stars', 50, 80, '010101011010', '2018-03-19', NULL, NULL, NULL, 0),
('1110-JYKM', 'Stingers Up', 'Published', '2018-04-04', 'Solicitation', 'Sac State Technology', 'Stingers Up. We do it.', 55, 75, '101010101010', '2018-03-19', NULL, NULL, NULL, 0),
('2712-HT00', 'Hornet Time', 'Approved', '2018-06-06', 'Solicitation', 'Sac State Technology', 'Its Hornet Student Time', 60, 75, '010101011000', '2018-03-19', NULL, NULL, NULL, 0),
('2011-MP12', 'Mission Peace', 'Under Review', '2018-07-07', 'Solicitation', 'Peace Technology', 'This is Mission Peace', 55, 75, '001100111010', '2018-03-19', NULL, NULL, NULL, 0),
('1010-SM27', 'Super Mario', 'Rejected', '2018-08-08', 'Solicitation', 'Video Game Technology', 'This is Super Mario', 65, 80, '111000110011', '2018-03-19', NULL, NULL, NULL, 0),
('1110-GW12', 'Global Warming', 'New', '2018-09-09', 'Solicitation', 'Universal Technology', 'This is global warming solicitation', 60, 75, '010101011011', '2018-03-19', NULL, NULL, NULL, 0),
('2712-BO12', 'Business Opportunity', 'Approved', '2018-09-09', 'Solicitation', 'Business Technology', 'This is Business Technology solicitation', 65, 80, '110011001011', '2018-03-19', NULL, NULL, NULL, 0),
('5110-SP12', 'Speed Post', 'Approved', '2018-09-09', 'Solicitation', 'Mailing', 'This is Mailing solicitation.', 55, 80, '101101010101', '2018-03-19', NULL, NULL, NULL, 0),
('1110-SH12', 'Stay Healthy', 'Approved', '2018-09-09', 'Solicitation', 'Health Technology', 'This is Health Technology solicitation', 55, 75, '101101010101', '2018-03-19', NULL, NULL, NULL, 0),
('2712-CO12', 'Consulting Opportunity', 'Awarded', '2018-09-09', 'Solicitation', 'Consulting Technology', 'This is Business Technology solicitation', 45, 70, '101010101011', '2018-03-19', NULL, NULL, NULL, 0),
('1110-PT12', 'Photography', 'Approved', '2018-09-09', 'Solicitation', 'Mailing', 'This is Photography solicitation.', 50, 75, '101101010101', '2018-03-19', NULL, NULL, NULL, 0),
('4110-LS12', 'Legal Services', 'Approved', '2018-09-09', 'Solicitation', 'Legal Services', 'This is Health Technology solicitation', 55, 80, '110011001011', '2018-03-19', NULL, NULL, NULL, 0),
('9110-ET12', 'Electrical Services', 'Approved', '2018-09-09', 'Solicitation', 'Electrical Technology', 'This is Electrical Technology solicitation', 65, 80, '101010101011', '2018-03-19', NULL, NULL, NULL, 0),
('1110-HT12', 'Health time', 'Archived', '2018-09-09', 'Solicitation', 'Health Technology', 'This is Health Technology solicitation', 55, 80, '101100110011', '2018-03-19', NULL, NULL, NULL, 0),
('5110-SP99', 'Registered Post', 'Cancelled', '2018-09-09', 'Solicitation', 'Mailing', 'This is Registered Mailing solicitation.', 60, 75, '101101010101', '2018-03-19', NULL, NULL, NULL, 0),
('1110-BIVK', 'Best Infrastructure', 'Published', '2018-04-04', 'Solicitation', 'Infrastructure Technology', 'Infrastructure. We do it.', 60, 80, '101011001100', '2018-03-19', NULL, NULL, NULL, 0),
('2712-ARCH', 'Architecture Plan', 'Published', '2018-04-04', 'Solicitation', 'Architecture Technology', 'Architecture. We do it.', 60, 80, '001011001100', '2018-03-19', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(2) DEFAULT NULL,
  `title` varchar(20) NOT NULL,
  `description` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `title`, `description`) VALUES
(1, 'Approved', 'This is Approved'),
(2, 'New', 'This is New or Submitted'),
(3, 'Published', 'This is Published'),
(4, 'Rejected', 'This is Rejected'),
(5, 'Under Review', 'This is Under Review'),
(6, 'Awarded', 'This is Awarded'),
(7, 'Cancelled', 'This is Cancelled'),
(8, 'Archived', 'This is Archived');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
