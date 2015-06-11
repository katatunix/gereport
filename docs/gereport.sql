-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2015 at 10:27 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gereport`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
`id` int(11) NOT NULL,
  `title` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `projectId` int(11) NOT NULL,
  `authorId` int(11) NOT NULL,
  `createdTime` datetime NOT NULL,
  `lastEditorId` int(11) NOT NULL,
  `lastEditedTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`id` int(11) NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'gameloft',
  `group` int(11) NOT NULL DEFAULT '2'
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberproject`
--

CREATE TABLE IF NOT EXISTS `memberproject` (
  `memberId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
`id` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `dateFor` date NOT NULL,
  `datetimeAdd` datetime NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=611 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `memberproject`
--
ALTER TABLE `memberproject`
 ADD PRIMARY KEY (`memberId`,`projectId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=611;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
