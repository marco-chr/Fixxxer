-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2014 at 03:47 AM
-- Server version: 5.5.32-MariaDB
-- PHP Version: 5.5.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fixxer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(3, 'oqtest4', '$2y$10$ZTNlNDI2YjcxNjZhZDNjMeZgoFD9icf2IalJHqEFA3WS59HYdOx/G'),
(4, 'oqtest6', '$2y$10$ODE5MTFkOTgxOTQ1NGFkMe0EWDQ9jcNdR'),
(6, 'user01', '$2y$10$NjA4ZDg1YWVhN2ViODY2N.u3IleJgcDaXOZo35aI2IwVhLxH/4jFy'),
(7, 'jharvard', '$2y$10$YWQxNmM0ODhiZjViODQxOOA.czOFtSbr2eJCCC/NgLqsyn9FnzZl.');

-- --------------------------------------------------------

--
-- Table structure for table `equip_subtypes`
--

CREATE TABLE IF NOT EXISTS `equip_subtypes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `equip_subtype` varchar(25) NOT NULL,
  `description` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `equip_subtypes`
--

INSERT INTO `equip_subtypes` (`id`, `parent_id`, `equip_subtype`, `description`) VALUES
(1, 1, 'flowtransmitter', 'test'),
(2, 1, 'ft2', 'coriolis'),
(3, 1, 'ft3', 'magnetic flowmeter'),
(4, 3, 'aisi1', 'vertical 100 lt'),
(5, 3, 'aisi2', 'horizontal 500lt'),
(6, 3, 'aisi3', 'vertical 1000lt'),
(7, 6, 'centrifugal', 'centrifugal pump'),
(8, 6, 'magnetic', 'magnetic pump'),
(9, 6, 'sandpiper', 'sandpiper pump'),
(10, 6, 'dosing', 'dosing pump'),
(11, 7, 'steamgen1', 'steam generator1');

-- --------------------------------------------------------

--
-- Table structure for table `equip_types`
--

CREATE TABLE IF NOT EXISTS `equip_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `equip_type` varchar(25) NOT NULL,
  `description` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `equip_types`
--

INSERT INTO `equip_types` (`id`, `equip_type`, `description`) VALUES
(1, 'flowtransmitter', 'flow transmitter 0-10V'),
(3, 'aisi tank', 'tank in aisi316'),
(6, 'Pump', 'eletrical pump'),
(7, 'steamgen', 'steam generator');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`userid`, `username`, `password`) VALUES
(1, 'oquser', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `maint_master`
--

CREATE TABLE IF NOT EXISTS `maint_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `master` varchar(15) NOT NULL,
  `rev` varchar(3) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `equip_type` varchar(25) NOT NULL,
  `sop` varchar(25) NOT NULL,
  `details` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `effective` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `maint_master`
--

INSERT INTO `maint_master` (`id`, `master`, `rev`, `active`, `equip_type`, `sop`, `details`, `remarks`, `effective`) VALUES
(7, 'vg1', '12', 1, 'steamgen', 'vmt20001', 'maintenance record for steam generator', '3000 Kg-h capacity 73.9mq surface max pressure 11.76', '2014-01-12');

-- --------------------------------------------------------

--
-- Table structure for table `serials`
--

CREATE TABLE IF NOT EXISTS `serials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_code` int(10) NOT NULL,
  `family` varchar(15) NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `vendor` varchar(25) DEFAULT NULL,
  `model` varchar(25) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `serials`
--

INSERT INTO `serials` (`id`, `ser_code`, `family`, `description`, `vendor`, `model`, `tag_id`) VALUES
(1, 102040, 'pumps', 'centrifugal pump', 'bosch', 'brcpe001xa', 1),
(2, 121, 'flowmeter', 'coriolis', 'pfuchs', 'a1000', 0),
(3, 102002, 'temp transmitte', '', 'pf', '100a', 0),
(4, 102020, 'flow transmitte', 'coriolis', 'aa', '3003', 10),
(5, 1020102, 'inox tanks', 'vertical inox tank', 'acme', 't001', 5),
(6, 42, 'flowmeters', 'magnetic flowmeter', 'pf', 'mf000', 6),
(7, 10101001, 'underwater pump', 'underwater pump', 'ktb', '2514503', 0),
(8, 345694, 'pumps', 'centrifugal pump', 'rossi', 'mxp1000', 11),
(9, 1, 'PLC', 'CPU', 'Siemens', 'S7300-14', 9),
(10, 748279, 'utility skid', 'steam generator', 'bono', '2203', 7),
(11, 300456, 'plc', 'cpu', 'siemens', 's7-300-16', NULL),
(12, 300457, 'plc', 'io board', 'siemens', 'ets200', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_call`
--

CREATE TABLE IF NOT EXISTS `service_call` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `whours` int(4) DEFAULT NULL,
  `owner` varchar(15) DEFAULT NULL,
  `closedate` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `service_call`
--

INSERT INTO `service_call` (`id`, `tag`, `date`, `opened`, `whours`, `owner`, `closedate`, `comment`) VALUES
(33, 'vg-1', '2014-06-01', 1, NULL, NULL, NULL, NULL),
(34, 'vg-1', '2014-07-01', 1, NULL, NULL, NULL, NULL),
(35, 'vg-1', '2014-08-01', 1, NULL, NULL, NULL, NULL),
(36, 'vg-1', '2014-09-01', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_wins`
--

CREATE TABLE IF NOT EXISTS `service_wins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `wins` varchar(25) NOT NULL,
  `service_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `service_wins`
--

INSERT INTO `service_wins` (`id`, `tag`, `date`, `wins`, `service_id`) VALUES
(63, 'vg-1', '2014-06-01', 'clean air inlet', 33),
(64, 'vg-1', '2014-07-01', 'clean air inlet', 34),
(65, 'vg-1', '2014-08-01', 'clean air inlet', 35),
(66, 'vg-1', '2014-09-01', 'clean air inlet', 36),
(67, 'vg-1', '2014-07-01', 'air circulation check', 34),
(68, 'vg-1', '2014-07-01', 'electrical cabinet check', 34),
(69, 'vg-1', '2014-07-01', 'check burner', 34),
(70, 'vg-1', '2014-07-01', 'check motor absorption', 34);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) NOT NULL,
  `description` varchar(25) NOT NULL,
  `plant` varchar(10) NOT NULL,
  `area` varchar(10) NOT NULL,
  `equip_type` varchar(25) DEFAULT NULL,
  `equip_subtype` varchar(25) DEFAULT NULL,
  `owner` varchar(15) DEFAULT NULL,
  `critical` tinyint(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `basedate` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `description`, `plant`, `area`, `equip_type`, `equip_subtype`, `owner`, `critical`, `created`, `basedate`, `active`, `position`) VALUES
(6, 'ft-121', 'city water inlet', 'duff plant', 'utilities', 'flowtransmitter', 'flowtransmitter', 'mike smith', 0, '2013-01-01', '2013-01-01', 1, 'building a'),
(7, 'vg-2', 'steam generator', 'duff plant', 'utilities', 'steamgen', '', 'maintenance', 1, '2014-10-01', '2014-01-01', 1, 'utilities'),
(11, 'T-101', 'Process Tank', 'ACME Pilot', 'Process', NULL, NULL, 'john doe', 1, '2014-01-01', '2014-01-01', 1, 'building b');

-- --------------------------------------------------------

--
-- Table structure for table `work_ins`
--

CREATE TABLE IF NOT EXISTS `work_ins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `equip_subtype` varchar(25) NOT NULL,
  `freq` enum('2Y','Y','6M','3M','M','W','D') NOT NULL,
  `instruction` varchar(25) NOT NULL,
  `section` int(99) NOT NULL,
  `master_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `work_ins`
--

INSERT INTO `work_ins` (`id`, `equip_subtype`, `freq`, `instruction`, `section`, `master_id`) VALUES
(66, 'steamgen1', 'M', 'clean air inlet', 0, 7),
(67, 'steamgen1', '3M', 'air circulation check', 1, 7),
(68, 'steamgen1', '3M', 'electrical cabinet check', 2, 7),
(69, 'steamgen1', '3M', 'check burner', 3, 7),
(70, 'steamgen1', '6M', 'check motor absorption', 4, 7);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
