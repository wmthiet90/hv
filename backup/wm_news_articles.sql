-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 17, 2016 at 05:51 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hoaviet`
--

-- --------------------------------------------------------

--
-- Table structure for table `wm_news_articles`
--

CREATE TABLE IF NOT EXISTS `wm_news_articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(225) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `viewed` int(11) NOT NULL DEFAULT '0',
  `login_to_view` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wm_news_articles`
--

INSERT INTO `wm_news_articles` (`article_id`, `author_id`, `date_added`, `date_modified`, `image`, `sort_order`, `status`, `viewed`, `login_to_view`) VALUES
(1, 1, '2016-01-10 16:50:30', '2016-01-12 00:05:22', 'catalog/demo/tintuc/tintuc1.jpg', 1, 1, 34, 0),
(2, 1, '2016-01-10 23:48:43', '2016-01-10 23:48:43', 'catalog/demo/tintuc/tintuc1.jpg', 1, 1, 33, 0),
(3, 1, '2016-01-12 00:13:15', '2016-01-12 00:23:53', 'catalog/demo/tintuc/IMG_3432.png', 0, 1, 27, 0),
(4, 1, '2016-01-12 00:30:04', '2016-01-12 00:35:50', 'catalog/demo/tintuc/DSC_1025.jpg', 1, 1, 9, 0),
(5, 1, '2016-01-12 00:41:40', '2016-01-12 00:43:07', 'catalog/demo/tintuc/EXPO2.jpg', 0, 1, 4, 0),
(6, 1, '2016-01-16 01:13:17', '2016-01-16 01:13:17', '', 1, 1, 22, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
