-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2016 at 12:05 AM
-- Server version: 5.6.28-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('f8cb7980426cbd7720a8f5f95ee1489a', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/48.0.2564.116 Chrome/48.0.2564.11', 1459750039, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:2:{s:2:"id";s:2:"17";s:8:"username";s:5:"admin";}}');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `tag` varchar(100) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `tag`, `tag_id`, `date_time`) VALUES
(1, 17, 'WOW', 'timeline', 1, '2016-03-21 22:52:26'),
(2, 17, 'oy ', 'timeline', 2, '2016-03-24 15:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `tag`, `tag_id`, `title`, `value`) VALUES
(1, '', 17, 'Mobile', '09175818162s'),
(2, '', 17, 'Email', 'Supahacker21@gmail.com\r\n'),
(5, '', 25, 'Mobile', '09256785643'),
(6, '', 33, 'Mobile', '0213213464102'),
(7, '', 34, 'Mobile', '021255');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_code`, `name`) VALUES
(2, '112-44', 'BSIT'),
(4, '112-44465', 'HRS'),
(5, '1-3912039', 'BSCS'),
(6, '', 'ITP');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `event_date` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `course_id`, `year_id`, `event_date`, `action`, `user_id`, `date_time`) VALUES
(1, 'awdadsadsad', '<p><strong>LIST OF ACTIVITIES</strong></p><ol><li>&nbsp;Activiy 1</li><li>2&nbsp;</li><li>3</li><li>&nbsp;4</li><li>5</li><li>6</li><li>&nbsp;</li></ol>', 2, 1, '9 March, 2016', 'Updated', 17, '2016-03-22 04:14:41'),
(2, 'afsafsafsafsafsafs', '<p>aasafsafsafsafs</p>', 5, 1, '11 March, 2016', 'Published', 17, '2016-03-31 06:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `tag_id`, `tag`, `icon`, `action`, `date_time`, `ip_address`) VALUES
(1, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Updated a Status', '2016-03-21 14:52:21', '::1'),
(2, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Commented on an Announcement', '2016-03-21 14:52:26', '::1'),
(3, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Published New Event', '2016-03-22 04:13:57', '::1'),
(4, '17', 0, 'user', '<i class="fa fa-fw fa-flask"></i>', 'Updated an Event', '2016-03-22 04:14:41', '::1'),
(5, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Updated a Status', '2016-03-24 07:50:18', '::1'),
(6, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Commented on an Announcement', '2016-03-24 07:50:23', '::1'),
(7, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Registered New Alumni Account', '2016-03-31 06:24:35', '::1'),
(8, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Published New Event', '2016-03-31 06:26:47', '::1'),
(9, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Registered New Alumni Account', '2016-04-02 09:58:33', '::1'),
(10, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Updated a Status', '2016-04-03 09:27:01', '::1'),
(11, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Registered New Alumni Account', '2016-04-04 05:57:25', '::1'),
(12, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Registered New Alumni Account', '2016-04-04 05:58:44', '::1'),
(13, '17', 0, 'user', '<i class="mdi-content-flag"></i>', 'Registered New Batch Year', '2016-04-04 06:06:07', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

CREATE TABLE IF NOT EXISTS `message_thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recepient_status` varchar(100) NOT NULL,
  `sender_status` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_field` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_field`, `value`) VALUES
(1, 'site_name', 'STI Dipolog Alumni');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `user_id`, `post`, `date_time`) VALUES
(1, 17, 'coooooooooooooooooool!!!', '2016-03-21 22:52:21'),
(2, 17, 'oy', '2016-03-24 15:50:18'),
(3, 17, 'sasadsadsadadadasdasd', '2016-04-03 17:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) NOT NULL,
  `name` varchar(80) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usertype` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `cover_img` varchar(100) NOT NULL,
  `last_login` varchar(15) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_activity` varchar(100) NOT NULL,
  `last_activity_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `student_id`, `name`, `middlename`, `lastname`, `course_id`, `year_id`, `username`, `password`, `usertype`, `status`, `img`, `cover_img`, `last_login`, `date_registered`, `last_activity`, `last_activity_stamp`, `description`) VALUES
(17, '', 'Maco', '', 'Cortes', NULL, NULL, 'admin', '$2y$10$CI8swJ8CHj6w3M4GXQKs2etDFSFtege2UmGZTRwcgX4pij8yhWPBK', 'Administrator', 'Activated', '', '', '1459748649', '2016-03-21 17:02:13', 'Registered', '2016-04-04 05:44:09', ''),
(24, '1010333', 'Jane', 'Alpha', 'Lol', 5, 4, '1010333', '$2y$10$wsr7w30Gf2SPhNryij9EGOsL3kgcIBPDn7gzGdRclMe885iJl7I/6', 'Alumni', 'Activated', '', '', '', '2016-03-21 09:32:20', 'Registered', '2016-03-21 01:32:20', ''),
(25, '', 'Marnie', '', 'Enero', NULL, NULL, 'marnie', '$2y$10$15JDGFks9eTKdPRokY4vyuqP5VAu2uTxqr7Xz0QN47jlbqx.7Qf.W', 'Administrator', 'Activated', '', '', '1458551281', '2016-03-21 09:48:08', 'Registered', '2016-03-21 09:08:01', ''),
(26, '', 'Rebilyn', '', 'Cabigon', NULL, NULL, 'rebilyn@yahoo.com', '$2y$10$SVhySBoyi.D4f69mrOM3uuOx7hqYInZzCsHric5GaAFOBHZfjh8Ka', 'Alumni', 'Activated', '', '', '1458551839', '2016-03-21 09:49:09', 'Registered', '2016-03-21 09:17:19', ''),
(27, '135-2014-0100', 'Baby Jane ', 'C.', 'Cuevas', 2, 1, '135-2014-0100', '$2y$10$7/Pz2h.O./7iWtAs9XQSEOsAaZ9kYEx0ynPNVdLOuK7CE3dvgXie6', 'Alumni', 'Activated', '', '', '1458551082', '2016-03-21 16:16:38', 'Registered', '2016-03-21 09:04:42', ''),
(29, '135-2014-0003', 'Marnie', 'L', 'Enero', 2, 1, '135-2014-0003', '$2y$10$qjLEneMrvSPk0KX/2fFya.sd6VRPcWfto81DRu5RFmA/E0uhs2KKS', 'Alumni', 'Activated', '', '', '', '2016-03-21 16:22:14', 'Registered', '2016-03-21 08:22:14', ''),
(30, '135-2014-013', 'Jennelyn', 'E', 'Jimeno', 2, 1, '135-2014-013', '$2y$10$ZeZiHMRfEj7mMtnvOV9/We7lu6RUXw8ZzzKzRnN9P5mnXOTjIRvdK', 'Alumni', 'Activated', '', '', '', '2016-03-21 16:23:28', 'Registered', '2016-03-21 08:23:28', ''),
(31, '23456789', 'Joseph', 'Flores', 'Reyes', 2, 1, '23456789', '$2y$10$tNm1Mx2g51H.9kUsyjqQCesCVFu6Vh0qE.Xb8myOOQg7adg2jCxxq', 'Alumni', 'Activated', '', '', '1459405569', '2016-03-31 14:24:35', 'Registered', '2016-03-31 06:26:09', ''),
(32, '123456', 'Test', 'Test', 'Test', 2, 1, '123456', '$2y$10$HVOdT95cxuBDMwZA/hhTZ.Ig6ydLDAbAupGQMYh1bhZhgHS6UMiqO', 'Alumni', 'Activated', '', '', '1459591155', '2016-04-02 17:58:33', 'Registered', '2016-04-02 09:59:15', ''),
(33, '45465465465465456', 'Ahahahahaha', 'Hdshsdhsadhsd', 'Saasdasdhj', 2, 1, '45465465465465456', '$2y$10$rWn4GctC/iXjuNH2wakzc.MQ2DEjjMKrW4wGwNCmCjhexd4Au4DXS', 'Alumni', 'Activated', '', '', '', '2016-04-04 13:57:25', 'Registered', '2016-04-04 05:57:25', ''),
(34, '4545456564', 'Asdasdasdsad', 'Asdsadsad', 'Asdasdsda', 0, 0, '4545456564', '$2y$10$zHZES4ARwPfI8/K7Dhzxb.HVUbr/38v.bVRkD8guOpEvimtgG4Yhm', 'Alumni', 'Activated', '', '', '', '2016-04-04 13:58:43', 'Registered', '2016-04-04 05:58:43', '');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `badge` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `title`, `badge`) VALUES
(1, 'Administrator', '<span class="label label-danger">Administrator</span>'),
(2, 'Moderator', '<span class="label label-success">Moderator</span>'),
(3, 'Alumni', '<span class="label label-success">Alumni</span>');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_started` varchar(100) NOT NULL,
  `date_ended` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `user_id`, `job_title`, `company`, `address`, `date_started`, `date_ended`) VALUES
(1, 17, 'Web Developer', 'TECHDEPOT PH', 'Zamboanga City, Philippines', 'November 8, 2016', 'Present'),
(5, 17, 'asdasdasd', 'asdasdasd', 'adsasdadasd', '1 March, 2016', '2 March, 2016');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `name`) VALUES
(1, 'S.Y 2015 - 2016'),
(2, 'S.Y 2014 - 2015'),
(4, 'S.Y 2003 - 2004'),
(5, 'S.Y 2013-2014'),
(6, 'S.Y 2015 - 2016');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
