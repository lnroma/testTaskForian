-- phpMyAdmin SQL Dump
-- version 4.3.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2016 at 10:32 AM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts_attribute`
--

CREATE TABLE IF NOT EXISTS `contacts_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type_input` varchar(32) NOT NULL,
  `required` text,
  `placeholder` varchar(30) NOT NULL,
  `show_in_greed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_attribute`
--

INSERT INTO `contacts_attribute` (`id`, `name`, `type_input`, `required`, `placeholder`, `show_in_greed`) VALUES
(12, 'First name', 'text', 'required', 'Your first name', 1),
(13, 'email', 'email', NULL, 'your email', 0),
(14, 'Phone', 'text', 'required', 'Your phone number', 1),
(28, '234234', 'text', 'required', '', 1),
(29, 'stnstnstn', 'text', 'required', '', 1),
(30, 'undefined', 'text', 'required', 'snt', 1),
(31, 'undefined', 'text', 'required', '', 1),
(32, 'undefined', 'text', 'required', '', 1),
(33, 'undefined', 'text', 'required', '', 1),
(34, 'undefined', 'text', 'required', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts_attribute_value`
--

CREATE TABLE IF NOT EXISTS `contacts_attribute_value` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `id_attribute` int(11) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_attribute_value`
--

INSERT INTO `contacts_attribute_value` (`id`, `id_contact`, `id_attribute`, `value`) VALUES
(0, 18, 12, 'testing'),
(0, 18, 13, 'testng@mail.ru'),
(0, 18, 14, '12321313'),
(0, 19, 12, 'testing'),
(0, 19, 13, 'testng@mail.ru'),
(0, 19, 14, '12321313'),
(0, 20, 12, 'Test contact description'),
(0, 20, 13, 'testing@mail.ru'),
(0, 20, 14, '2345234534'),
(0, 21, 12, 'Naumov'),
(0, 21, 13, 'Family_89@mail.ru'),
(0, 21, 14, '1213123'),
(0, 22, 12, 'satoena'),
(0, 22, 13, 'satona@otsean.ru'),
(0, 22, 14, 'steona'),
(0, 22, 19, 'seotanoesa'),
(0, 22, 20, 'stnaeo');

-- --------------------------------------------------------

--
-- Table structure for table `contacts_entity`
--

CREATE TABLE IF NOT EXISTS `contacts_entity` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts_entity`
--

INSERT INTO `contacts_entity` (`id`, `name`) VALUES
(1, 'Testing contact'),
(2, 'Testing contact'),
(3, 'Testing contact'),
(4, 'Testing contact'),
(5, 'Testing contact'),
(6, 'Testing contact'),
(7, 'Testing contact'),
(8, 'Testing contact'),
(9, 'Testing contact'),
(10, 'Testing contact'),
(11, 'Testing contact'),
(12, 'Testing contact'),
(18, 'Testing contact'),
(19, 'Testing contact'),
(20, 'Test contact description'),
(21, 'Roman'),
(22, 'Testing mesting');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts_attribute`
--
ALTER TABLE `contacts_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts_entity`
--
ALTER TABLE `contacts_entity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts_attribute`
--
ALTER TABLE `contacts_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `contacts_entity`
--
ALTER TABLE `contacts_entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
