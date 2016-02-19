-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2016 at 07:28 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1-log
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `type_input` varchar(32) NOT NULL,
  `required` text,
  `placeholder` varchar(30) NOT NULL,
  `show_in_greed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `contacts_attribute`
--

INSERT INTO `contacts_attribute` (`id`, `name`, `type_input`, `required`, `placeholder`, `show_in_greed`) VALUES
(12, 'First name', 'text', 'required', 'Your first name', 1),
(13, 'email', 'email', NULL, 'your email', 0),
(14, 'Phone', 'text', 'required', 'Your phone number', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `contacts_entity`
--

CREATE TABLE IF NOT EXISTS `contacts_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
