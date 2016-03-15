-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2016 at 07:39 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoaviet`
--

-- --------------------------------------------------------

--
-- Table structure for table `wm_manufacturer_description`
--

DROP TABLE IF EXISTS `wm_manufacturer_description`;
CREATE TABLE `wm_manufacturer_description` (
  `manufacturer_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wm_manufacturer_description`
--

INSERT INTO `wm_manufacturer_description` (`manufacturer_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(12, 1, 'Atago - Japanese', 'Atago - Japanese', 'Atago - Japanese', 'Atago - Japanese', 'Atago - Japanese'),
(12, 2, 'Atago - Nhat Ban', 'Atago - Nhật Bản', 'Atago - Nhat Ban', 'Atago - Nhat Ban', 'Atago - Nhat Ban'),
(13, 1, 'Aptaca - Ý', 'Đại lý độc quyền', 'Aptaca - Ý', 'Đại lý độc quyền', 'Aptaca - Ý'),
(13, 2, 'Aptaca - Ý', 'Đại lý độc quyền', 'Aptaca - Ý', 'Đại lý độc quyền', 'Aptaca - Ý'),
(14, 1, 'Binder – Đức', 'Đại lý cấp I', 'Binder – Đức', 'Đại lý cấp I', 'Binder – Đức'),
(14, 2, 'Binder – Đức', 'Đại lý cấp I', 'Binder – Đức', 'Đại lý cấp I', 'Binder – Đức'),
(11, 1, 'Alla France - Pháp', 'Đại lý độc quyền', 'Alla France - Pháp', 'Đại lý độc quyền', 'Alla France - Pháp'),
(11, 2, 'Alla France - Pháp', 'Đại lý độc quyền', 'Alla France - Pháp', 'Đại lý độc quyền', 'Alla France - Pháp'),
(15, 1, 'Hirayama - Nhật Bản', 'Đại lý cấp I', 'Hirayama - Nhật Bản', 'Đại lý cấp I', 'Hirayama - Nhật Bản'),
(15, 2, 'Hirayama - Nhật Bản', 'Đại lý cấp I', 'Hirayama - Nhật Bản', 'Đại lý cấp I', 'Hirayama - Nhật Bản'),
(16, 1, 'Vitlab – Đức', 'Đại lý độc quyền', 'Vitlab – Đức', 'Đại lý độc quyền', 'Vitlab – Đức'),
(16, 2, 'Vitlab – Đức', 'Đại lý độc quyền', 'Vitlab – Đức', 'Đại lý độc quyền', 'Vitlab – Đức'),
(17, 1, 'Kimble Chase - Mỹ', 'Đại lý độc quyền', 'Kimble Chase - Mỹ', 'Đại lý độc quyền', 'Kimble Chase - Mỹ'),
(17, 2, 'Kimble Chase - Mỹ', 'Đại lý độc quyền', 'Kimble Chase - Mỹ', 'Đại lý độc quyền', 'Kimble Chase - Mỹ'),
(18, 1, 'Munktell Ahlstrom - Thụy Điển', 'Đại lý độc quyền', 'Munktell Ahlstrom - Thụy Điển', 'Đại lý độc quyền', 'Munktell Ahlstrom - Thụy Điển'),
(18, 2, 'Munktell Ahlstrom - Thụy Điển', 'Đại lý độc quyền', 'Munktell Ahlstrom - Thụy Điển', 'Đại lý độc quyền', 'Munktell Ahlstrom - Thụy Điển'),
(19, 1, 'Ysi – Mỹ', 'Đại lý cấp I', 'Ysi – Mỹ', 'Đại lý cấp I', 'Ysi – Mỹ'),
(19, 2, 'Ysi – Mỹ', 'Đại lý cấp I', 'Ysi – Mỹ', 'Đại lý cấp I', 'Ysi – Mỹ'),
(20, 1, 'Hirschmann - Đức', 'Đại lý cấp I', 'Hirschmann - Đức', 'Đại lý cấp I', 'Hirschmann - Đức'),
(20, 2, 'Hirschmann - Đức', 'Đại lý cấp I', 'Hirschmann - Đức', 'Đại lý cấp I', 'Hirschmann - Đức'),
(21, 1, 'Interscience - Pháp', 'Đại lý cấp I', 'Interscience - Pháp', 'Đại lý cấp I', 'Interscience - Pháp'),
(21, 2, 'Interscience - Pháp', 'Đại lý cấp I', 'Interscience - Pháp', 'Đại lý cấp I', 'Interscience - Pháp'),
(22, 1, 'Hettich - Đức', 'Đại lý cấp I', 'Hettich - Đức', 'Đại lý cấp I', 'Hettich - Đức'),
(22, 2, 'Hettich - Đức', 'Đại lý cấp I', 'Hettich - Đức', 'Đại lý cấp I', 'Hettich - Đức'),
(23, 1, 'Worlwide Glass - Mỹ', 'Đại lý độc quyền', 'Worlwide Glass - Mỹ', 'Đại lý độc quyền', 'Worlwide Glass - Mỹ'),
(23, 2, 'Worlwide Glass - Mỹ', 'Đại lý độc quyền', 'Worlwide Glass - Mỹ', 'Đại lý độc quyền', 'Worlwide Glass - Mỹ'),
(24, 1, 'Eberbach - Mỹ', 'Đại lý độc quyền', 'Eberbach - Mỹ', 'Đại lý độc quyền', 'Eberbach - Mỹ'),
(24, 2, 'Eberbach - Mỹ', 'Đại lý độc quyền', 'Eberbach - Mỹ', 'Đại lý độc quyền', 'Eberbach - Mỹ'),
(25, 1, 'Nippon Denshoku - Nhật Bản', 'Đại lý cấp I', 'Nippon Denshoku - Nhật Bản', 'Đại lý cấp I', 'Nippon Denshoku - Nhật Bản'),
(25, 2, 'Nippon Denshoku - Nhật Bản', 'Đại lý cấp I', 'Nippon Denshoku - Nhật Bản', 'Đại lý cấp I', 'Nippon Denshoku - Nhật Bản'),
(26, 1, 'Jipo - CH Séc', 'Đại lý cấp I', 'Jipo - CH Séc', 'Đại lý cấp I', 'Jipo - CH Séc'),
(26, 2, 'Jipo - CH Séc', 'Đại lý cấp I', 'Jipo - CH Séc', 'Đại lý cấp I', 'Jipo - CH Séc'),
(27, 1, 'Merch - Đức', 'Merch - Đức', 'Merch - Đức', 'Merch - Đức', 'Merch - Đức'),
(27, 2, 'Merch - Đức', 'Merch - Đức', 'Merch - Đức', 'Merch - Đức', 'Merch - Đức'),
(28, 1, 'Thermconcept - Đức', 'Đại lý cấp I', 'Thermconcept - Đức', 'Đại lý cấp I', 'Thermconcept - Đức'),
(28, 2, 'Thermconcept - Đức', 'Đại lý cấp I', 'Thermconcept - Đức', 'Đại lý cấp I', 'Thermconcept - Đức'),
(29, 1, 'JP Selecta - Tây Ban Nha', 'Đại lý cấp I', 'JP Selecta - Tây Ban Nha', 'Đại lý cấp I', 'JP Selecta - Tây Ban Nha'),
(29, 2, 'JP Selecta - Tây Ban Nha', 'Đại lý cấp I', 'JP Selecta - Tây Ban Nha', 'Đại lý cấp I', 'JP Selecta - Tây Ban Nha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wm_manufacturer_description`
--
ALTER TABLE `wm_manufacturer_description`
  ADD PRIMARY KEY (`manufacturer_id`,`language_id`),
  ADD KEY `name` (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
