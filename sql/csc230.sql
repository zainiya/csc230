-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2018 at 01:13 AM
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
(1, '2018-05-18 17:14:13', 0, '2018-04-05 18:03:35'),
(3, '2018-04-03 18:12:01', 0, '2018-04-03 18:09:08'),
(4, '2018-05-18 17:20:38', 0, '2018-05-17 18:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_documents`
--

CREATE TABLE IF NOT EXISTS `bidder_documents` (
  `dno` int(11) NOT NULL AUTO_INCREMENT,
  `bid_trans_id` int(9) DEFAULT NULL,
  `file_name` varchar(100) NOT NULL,
  `dtitle` varchar(150) NOT NULL,
  `posted_date` date NOT NULL,
  `file` text,
  PRIMARY KEY (`dno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bidder_documents`
--

INSERT INTO `bidder_documents` (`dno`, `bid_trans_id`, `file_name`, `dtitle`, `posted_date`, `file`) VALUES
(2, 1, 'Data- Centric Architecture style.pptx', 'Data- Centric Architecture style.pptx', '2018-04-28', 'uploads/Data- Centric Architecture style.pptx'),
(3, 2, 'Data- Centric Architecture style.pptx', 'Data- Centric Architecture style.pptx', '2018-04-24', 'uploads/Data- Centric Architecture style.pptx'),
(5, 3, 'csc230.sql', 'csc230.sql-987', '2018-04-25', 'uploads/csc230.sql'),
(6, 4, 'Cover Letter', 'Cover Letter', '2018-04-26', 'uploads/min-quals-CSUS-2018.docx'),
(8, 5, 'csc230.sql', 'csc230.sql-1234', '2018-04-26', 'uploads/csc230.sql'),
(9, 4, 'Minimum Qualification', 'mininum qualification', '2018-04-26', 'uploads/min-quals-CSUS-2018.docx'),
(14, 7, 'csc230.sql', 'csc230.', '2018-04-27', 'uploads/csc230-167.sql'),
(15, 4, 'Addenda', 'Addenda', '2018-04-27', 'uploads/csc230-12345.sql'),
(16, 5, 'RECURDEC.C', 'RECURDEC.C-ABCD-1234', '2018-05-31', 'uploads/RECURDEC-ABCD-1234.C'),
(17, 4, 'Fee Proposal', 'Fee Proposal', '2018-05-31', 'uploads/fee-proposal-CSUS-2018.docx'),
(18, 3, 'microsoftProof.docx', 'microsoftProof.docx-XZYR-4567', '2018-05-25', 'uploads/microsoftProof-XZYR-4567.docx'),
(19, 9, 'introduction.ppt', 'intro', '2018-05-18', 'uploads/introduction-1234-9876.ppt');

-- --------------------------------------------------------

--
-- Table structure for table `bidder_document_upload`
--

CREATE TABLE IF NOT EXISTS `bidder_document_upload` (
  `pid` int(11) NOT NULL,
  `sid` varchar(9) NOT NULL,
  `dtitle` varchar(150) NOT NULL,
  `uploaded_file` varchar(150) NOT NULL,
  `upload_date` varchar(100) DEFAULT NULL,
  UNIQUE KEY `pid` (`pid`,`sid`,`dtitle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidder_document_upload`
--

INSERT INTO `bidder_document_upload` (`pid`, `sid`, `dtitle`, `uploaded_file`, `upload_date`) VALUES
(6, '1234', 'csc230.sql-1234', '19212-accuracy.png', '2018-05-18 04:50:33am'),
(6, '1234', 'csc230-1234.sql', '86290-adding_209_issue.png', '2018-05-18 04:50:57am'),
(6, '1234', 'csc230.sql-167', '93834-accuracy.png', '2018-05-18 11:44:12am'),
(6, '12345', 'Data- Centric Architecture style.pptx', '92973-adding_209_issue.png', '2018-05-18 09:25:19am'),
(1, '987', 'Data- Centric Architecture style.pptx-987', 'File not uploaded', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bid_status`
--

CREATE TABLE IF NOT EXISTS `bid_status` (
  `pid` int(11) NOT NULL,
  `sid` varchar(9) NOT NULL,
  `stitle` varchar(100) NOT NULL,
  `bid_status` varchar(50) DEFAULT NULL,
  UNIQUE KEY `pid` (`pid`,`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid_status`
--

INSERT INTO `bid_status` (`pid`, `sid`, `stitle`, `bid_status`) VALUES
(6, '12345', 'gfdgfdfgh', 'New'),
(6, '1234', 'xyz', 'New'),
(1, '12345', 'gfdgfdfgh', 'New'),
(1, '1234', 'xyz', 'New'),
(0, '12345', 'gfdgfdfgh', 'New'),
(0, '1234', 'xyz', 'New'),
(6, '987', 'test', 'New'),
(6, 'ABCD-1234', 'ABCD TEST', 'New'),
(6, 'XZYR-4567', 'TEST ', 'New'),
(6, '9876-7563', 'TEST AGAIN', 'New'),
(6, 'CSUS-2018', 'FALL CSC 230', 'New'),
(6, 'NEWZ-7539', 'NEW FINAL TEST', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `bid_transactions`
--

CREATE TABLE IF NOT EXISTS `bid_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid_id` varchar(9) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `Date_submtd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DT_Modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eval_Status` varchar(50) NOT NULL DEFAULT 'Submitted',
  `Bid_Amount` int(11) NOT NULL DEFAULT '0',
  `Score` int(11) NOT NULL DEFAULT '0',
  `comments` varchar(250) NOT NULL,
  `Bidder_Status` varchar(50) NOT NULL DEFAULT 'Under Review',
  `ModifiedBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bid_transactions`
--

INSERT INTO `bid_transactions` (`id`, `bid_id`, `bidder_id`, `Date_submtd`, `DT_Modified`, `Eval_Status`, `Bid_Amount`, `Score`, `comments`, `Bidder_Status`, `ModifiedBy`) VALUES
(1, 'CSUS-2018', 3, '2018-03-01 03:05:04', '2018-03-19 19:33:21', 'Submitted', 50, 50, 'test1', 'Under Review', NULL),
(2, 'CSUS-2018', 2, '2018-03-02 10:09:13', '2018-03-19 19:33:21', 'Scored', 400, 50, 'test', 'Under Review', NULL),
(3, '1234', 4, '2018-03-03 07:07:14', '2018-03-19 19:33:21', 'Submitted', 582, 52, 'ENTERING DATA', 'Under Review', NULL),
(4, 'CSUS-2018', 5, '2018-03-04 04:16:18', '2018-03-19 19:33:21', 'Scored', 500, 50, '', 'Under Review', NULL),
(5, '1234', 1, '2018-03-05 07:09:00', '2018-03-19 19:33:21', 'Accepted', 23423, 2342, 'test2', 'Under Review', NULL),
(6, '987', 10, '2018-03-06 00:00:00', '2018-03-19 19:33:21', 'Submitted', 0, 0, '', 'Under Review', NULL),
(7, 'ABCD-1234', 6, '2018-03-07 06:21:29', '2018-03-19 19:33:21', 'Submitted', 10, 10, 'blah blah blah', 'Under Review', NULL),
(8, 'XZYR-4567', 5, '2018-03-07 07:16:11', '2018-03-19 19:33:21', 'Submitted', 0, 0, '', 'Under Review', NULL),
(9, 'CSUS-2018', 6, '2018-04-05 05:30:40', '2018-04-05 05:30:40', 'Accepted', 0, 0, '', 'Under Review', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `dno` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(9) DEFAULT NULL,
  `file_name` varchar(100) NOT NULL,
  `dtitle` varchar(150) NOT NULL,
  `dtype` varchar(40) DEFAULT NULL,
  `posted_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` date NOT NULL,
  `file` text,
  PRIMARY KEY (`dno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`dno`, `sid`, `file_name`, `dtitle`, `dtype`, `posted_date`, `due_date`, `file`) VALUES
(4, 'ABCD-1234', 'RECURDEC.C', 'RECURDEC.C-ABCD-1234', 'Addenda', '2018-05-31 00:00:00', '2018-05-31', 'uploads/RECURDEC-ABCD-1234.C'),
(5, '9876-7563', 'csc230.docx', 'csc230.docx-9876-7563', 'RequiredAttatchments', '2018-05-31 00:00:00', '2018-05-31', 'uploads/csc230-9876-7563.docx'),
(6, 'XZYR-4567', 'microsoftProof.docx', 'microsoftProof.docx-XZYR-4567', 'SolicitationDocument', '2018-05-25 00:00:00', '2018-05-25', 'uploads/microsoftProof-XZYR-4567.docx'),
(9, '1234-9876', 'introduction.ppt', 'intro', 'Others', '2018-05-18 00:00:00', '2018-05-18', 'uploads/introduction-1234-9876.ppt'),
(10, '1234-9876', 'GradAlgs_sample_final_questions_AlgUsage.doc', 'Algo Usage', 'Exhibits', '2018-05-17 16:21:34', '2018-05-19', 'uploads/GradAlgs_sample_final_questions_AlgUsage-1234-9876.doc'),
(13, '7538-EAST', 'ZainiyaManjiyani_Resume.pdf', 'Resume', NULL, '2018-05-18 13:25:56', '2018-05-19', 'uploads/ZainiyaManjiyani_Resume-7538-EAST.pdf'),
(15, 'NEWZ-7539', 'AirTicket_Zainiya.pdf', 'NEW FINAL', NULL, '2018-05-18 13:54:14', '2018-05-30', 'uploads/AirTicket_Zainiya-NEWZ-7539.pdf'),
(17, 'CSUS-2018', 'checklist.docx', 'checklist', NULL, '2018-05-18 14:20:08', '2018-05-18', 'uploads/checklist-CSUS-2018.docx'),
(18, 'CSUS-2018', 'fee-proposal.docx', 'fee Proposal', NULL, '2018-05-18 14:20:08', '2018-05-18', 'uploads/fee-proposal-CSUS-2018.docx'),
(19, 'CSUS-2018', 'min-quals.docx', 'min qualification', NULL, '2018-05-18 14:20:08', '2018-05-18', 'uploads/min-quals-CSUS-2018.docx'),
(20, '7538-EAST', 'Addendum-Cover-Letter.pdf', 'Addendum', NULL, '2018-05-18 16:32:06', '2018-05-18', 'uploads/Addendum-Cover-Letter-7538-EAST.pdf'),
(21, '7538-EAST', 'checklist.docx', 'Checklist', NULL, '2018-05-18 16:32:06', '2018-05-26', 'uploads/checklist-7538-EAST.docx');

-- --------------------------------------------------------

--
-- Table structure for table `eval_status`
--

CREATE TABLE IF NOT EXISTS `eval_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `eval_status`
--

INSERT INTO `eval_status` (`id`, `description`) VALUES
(1, 'Submitted'),
(2, 'Accepted'),
(3, 'Rejected'),
(4, 'Scored'),
(5, 'Award');

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
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` bigint(6) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `fax` bigint(10) DEFAULT NULL,
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

INSERT INTO `person` (`pid`, `f_name`, `m_init`, `l_name`, `email`, `address`, `city`, `state`, `zip`, `phone`, `fax`, `ssn`, `password`, `rid`, `creationDate`, `subscription_Date`, `subscription_flag`) VALUES
(1, 'zainiya', 'a', 'manjiyani', 'abc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1234, 'abcd', 1, '2018-03-30 14:22:29', NULL, 1),
(2, 'shaaz', '', 'manjiyani', 'lovelyzinu@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1234, 'shaaz', 2, '2018-03-30 14:22:29', NULL, 1),
(3, 'zohra', 'a', 'manjiyani', 'zohra@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 4567, 'zohra', 1, '2018-04-01 12:33:40', NULL, 1),
(4, 'Sneha', '', 'Manjiyani', 'sneha.manjiyani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 4567, 'sneha', 3, '2018-04-22 11:07:28', NULL, 1),
(5, 'Alim', '', 'Manjiyani', 'zaineyamanjiyani@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 7894, 'alim', 4, '2018-04-22 11:10:16', NULL, 1),
(6, 'parth', 'u', 'pachchigar', 'parthpachchigar@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 7896, 'parth', 2, '2018-04-01 13:35:54', NULL, 1);

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
(1, '1234', 'xyz', 'solicitation', 'pscc', 'Published', '2018-04-20 22:30:29', '2018-05-01 15:00:00', 'computer software engineering', 0),
(1, '1234-9876', 'TEST', 'rfp', 'pscc', 'New', '2018-05-18 13:14:08', '2018-05-18 15:00:00', '<p>TESTING IS GOING ON</p>', 0),
(1, '12345', 'gfdgfdfgh', 'solicitation', 'it', 'cancelled', '2018-03-31 11:36:16', '2018-03-31 15:00:00', '<p>fdjfgdgf</p>', 1),
(1, '167', 'ABCD', 'ifb', 'pscc', 'cancelled', '2018-04-21 14:30:39', '2018-04-01 15:00:00', 'apple banana', 1),
(3, '2334-ALIB', 'Scooby-Doo Style Detective Work Needed', 'Solicitation', 'Information Technology', 'Awarded', '2018-04-01 12:38:59', '2017-10-31 15:00:00', 'Scooby-Doo Style Detective Work Needed', 0),
(1, '7538-EAST', 'EAST', 'cn', 'pscc', 'New', '2018-05-18 13:49:03', '2018-05-31 15:00:00', '<p>TESTING</p>', 0),
(1, '987', 'test', 'cn', 'pscc', 'Published', '2018-04-21 18:30:19', '2018-04-03 15:00:00', '<p>test 2</p>', 0),
(1, '9876-7563', 'TEST AGAIN', 'rfp', 'pscc', 'Published', '2018-04-25 15:14:13', '2018-04-27 15:00:00', '<p>TESTING AGAIN!!!</p>', 0),
(1, 'ABCD-1234', 'ABCD TEST', 'ifb', 'it', 'Published', '2018-05-01 13:54:13', '2018-05-01 15:00:00', 'TEST HELLO WORLD', 0),
(1, 'CSUS-2018', 'FALL CSC 230', 'ifb', 'pscc', 'Published', '2018-05-18 14:12:21', '2018-05-17 15:00:00', '<p>Presentation Preparation</p>', 0),
(1, 'FALL-2018', 'FALL Presentation', 'ifb', 'pscc', 'Published', '2018-05-18 17:14:56', '2018-05-18 15:00:00', '<p>Presentation</p>', 0),
(1, 'NEWZ-7539', 'NEW FINAL TEST', 'ifb', 'it', 'Published', '2018-05-18 13:51:44', '2018-05-31 15:00:00', '<p>FINAL TEST</p>', 0),
(1, 'TEST-4567', 'TEST', 'cn', 'pscc', 'New', '2018-05-18 13:23:42', '2018-05-26 15:00:00', '<p>TEST TEST TEST</p>', 0),
(1, 'XZYR-4567', 'TEST ', 'ifb', 'it', 'Published', '2018-05-01 17:49:45', '2018-05-05 15:00:00', '<p>HELLO</p>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
