-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2016 at 08:51 PM
-- Server version: 5.5.48-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sahifedp_aja2`
--

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'شناسه',
  `date` date DEFAULT NULL COMMENT 'تاریخ',
  `visit` int(10) unsigned DEFAULT NULL COMMENT 'تعداد بازدید',
  `visitor` int(10) unsigned DEFAULT NULL COMMENT 'تعداد کاربر',
  `most_hour` text CHARACTER SET utf8 COMMENT 'ساعات اوج بازدید',
  `visit_in_hour` text CHARACTER SET utf8 COMMENT 'بازدید در هر ساعت',
  `interface` text COLLATE utf8_persian_ci NOT NULL COMMENT 'واسط کاربر',
  `download` int(10) unsigned DEFAULT NULL COMMENT 'تعداد دانلود',
  `comment` int(10) unsigned DEFAULT NULL COMMENT 'تعداد نظر',
  `like` int(10) unsigned DEFAULT NULL COMMENT 'تعداد لایک',
  `rate` int(10) unsigned DEFAULT NULL COMMENT 'تعداد امتیاز',
  `most_visited_action` text CHARACTER SET utf8 COMMENT 'بیشترین اکشنهای بازدید شده',
  `most_visitor_user` text COLLATE utf8_persian_ci COMMENT 'بیشترین کاربران بازدید کننده',
  `agents` text CHARACTER SET utf8 COMMENT 'مرورگر ها',
  `utms` text COLLATE utf8_persian_ci COMMENT 'utms',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stat_dailies`
--

CREATE TABLE IF NOT EXISTS `stat_dailies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'شناسه',
  `time` int(11) DEFAULT NULL COMMENT 'تاریخ',
  `user_id` int(10) unsigned DEFAULT '0' COMMENT 'شناسه کاربر',
  `request` varchar(31) CHARACTER SET utf8 DEFAULT NULL COMMENT 'صفحه درخواستی',
  `status_code` int(11) DEFAULT NULL,
  `agent` text CHARACTER SET utf8 COMMENT 'مرورگر کاربر',
  `ip` varchar(45) CHARACTER SET utf8 DEFAULT NULL COMMENT 'آی پی',
  `request_type` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نوع درخواست',
  `utm` text COLLATE utf8_persian_ci COMMENT 'utm',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=92 ;

--
-- Dumping data for table `stat_dailies`
--

INSERT INTO `stat_dailies` (`id`, `time`, `user_id`, `request`, `status_code`, `agent`, `ip`, `request_type`, `utm`) VALUES
(2, 1453120826, 1, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::145', 'normal/GET:80', ''),
(3, 1453120826, 1, 'http://localhost/aja/?page=2', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(4, 1453120826, 1, 'http://localhost/aja/?page=2', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(5, 1453207479, 1, 'http://localhost/aja/?page=2', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(6, 1453207494, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(7, 1453207528, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::5', 'normal/GET:80', ''),
(8, 1453207583, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(9, 1450528826, 2, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::14', 'normal/GET:80', ''),
(10, 1453207632, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(11, 1453208375, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(12, 1453208612, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(13, 1453208635, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(14, 1453208684, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(15, 1453208742, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(16, 1453208753, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(17, 1453208857, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(18, 1453208907, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(19, 1453209054, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(20, 1453209093, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(21, 1453209318, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(22, 1453209373, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(23, 1453209668, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(24, 1453209695, 0, 'http://localhost/aja/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '::1', 'normal/GET:80', ''),
(25, 1453216250, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '151.238.113.197', 'normal/GET:80', ''),
(26, 1453216276, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '151.238.113.197', 'normal/GET:80', ''),
(27, 1453216288, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '151.238.113.197', 'normal/GET:80', ''),
(28, 1453220238, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.225.213', 'normal/GET:80', ''),
(29, 1453224192, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.225.213', 'normal/GET:80', ''),
(30, 1453290633, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.144.232', 'normal/GET:80', ''),
(31, 1453293417, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.3.158', 'normal/GET:80', ''),
(32, 1453293536, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.3.158', 'normal/GET:80', ''),
(33, 1453293571, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.3.158', 'normal/GET:80', ''),
(34, 1453293693, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.3.158', 'normal/GET:80', ''),
(35, 1453293717, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.3.158', 'normal/GET:80', ''),
(36, 1453293725, 11, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '5.232.3.158', 'normal/GET:80', ''),
(37, 1453293731, 11, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '5.232.3.158', 'normal/GET:80', ''),
(38, 1453294023, 11, 'http://aja2.sahifedp.ir/gii', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '5.232.3.158', 'normal/GET:80', ''),
(39, 1453294028, 11, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0', '5.232.3.158', 'normal/GET:80', ''),
(40, 1453294502, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1; rv:6.0) Gecko/20110814 Firefox/6.0 Google Favicon', '66.249.93.163', 'normal/GET:80', ''),
(41, 1453348722, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(42, 1453348750, 0, 'http://aja2.sahifedp.ir/login', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(43, 1453454954, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1; rv:6.0) Gecko/20110814 Firefox/6.0 Google Favicon', '66.249.93.163', 'normal/GET:80', ''),
(44, 1453530192, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1; rv:6.0) Gecko/20110814 Firefox/6.0 Google Favicon', '66.249.93.160', 'normal/GET:80', ''),
(45, 1453536052, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(46, 1453536592, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(47, 1453537968, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(48, 1453537968, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(49, 1453538141, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(50, 1453538545, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(51, 1453538574, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(52, 1453538593, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(53, 1453539253, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(54, 1453540202, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(55, 1453540255, 0, 'http://aja2.sahifedp.ir/login', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(56, 1453540267, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(57, 1453540317, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(58, 1453540527, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(59, 1453540569, 0, 'http://aja2.sahifedp.ir/login', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(60, 1453540632, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(61, 1453541372, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(62, 1453541512, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.61.175', 'normal/GET:80', ''),
(63, 1453542158, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(64, 1453542228, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(65, 1453542928, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.61.175', 'normal/GET:80', ''),
(66, 1453542958, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36', '5.232.61.175', 'normal/GET:80', ''),
(67, 1453542970, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(68, 1453543060, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(69, 1453543202, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(70, 1453543360, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '151.238.232.218', 'normal/GET:80', ''),
(71, 1453543396, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(72, 1453543710, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36', '217.218.75.250', 'normal/GET:80', ''),
(73, 1453544911, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(74, 1453544961, 0, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(75, 1453544979, 0, 'http://aja2.sahifedp.ir/login', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(76, 1453545001, 0, 'http://aja2.sahifedp.ir/login', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(77, 1453545140, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(78, 1453545186, 1, 'http://aja2.sahifedp.ir/profile', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(79, 1453545243, 1, 'http://aja2.sahifedp.ir/profile', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(80, 1453545374, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(81, 1453545540, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(82, 1453545828, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(83, 1453545876, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(84, 1453546301, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(85, 1453549597, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(86, 1453549655, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(87, 1453549708, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(88, 1453549853, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(89, 1453549864, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(90, 1453550439, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', ''),
(91, 1453550660, 1, 'http://aja2.sahifedp.ir/', NULL, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/47.0.2526.106 Chrome/47.0.2526.106 Safari/537.36', '151.238.65.49', 'normal/GET:80', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
