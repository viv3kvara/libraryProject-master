-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 27, 2023 at 10:47 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` varchar(10) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` bigint NOT NULL,
  `password` varchar(15) NOT NULL,
  `activation` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `first_name`, `last_name`, `email`, `contact`, `password`, `activation`) VALUES
('denis', 'denis', 'ruparel', 'deniskalpeshbhai436@gmail.com', 8866637550, '123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` varchar(20) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `catagory` varchar(100) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `publication` varchar(100) NOT NULL,
  `purchase_date` date NOT NULL,
  `edition` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `semester` varchar(5) NOT NULL,
  `availability` enum('Available','Not Available') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `book_updated_on` varchar(30) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `catagory`, `author_name`, `price`, `publication`, `purchase_date`, `edition`, `semester`, `availability`, `book_updated_on`) VALUES
('1.1.1', 'Programming in c', 'Programming', 'Atul', 100, 'Mahajan publicing house ', '0000-00-00', '2010', '1', 'Not Available', '2023-03-22 12:50:40'),
('1.1.2', 'Computer Programming and utilization', 'Programming', 'Atul', 150, 'Atul Prakashan', '0000-00-00', '2010', '1', 'Not Available', '2023-03-22 12:50:59'),
('1.1.3', 'The \"C\" Book', 'Programming', 'Atul', 200, 'Nirav Prakashan', '0000-00-00', '2011', '1', 'Available', '2023-03-22 14:03:11'),
('1.1.4', 'Computer Programming', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2013', '1', 'Available', '2023-03-22 14:05:40'),
('1.1.5', 'Programming in c', 'Programming', 'Atul', 150, 'Mahajan publicing house ', '0000-00-00', '2013', '1', 'Not Available', '2023-03-22 14:09:30'),
('1.1.6', 'computer Programming', 'Programming', 'Atul', 150, 'Gujarat techincal Publishers', '0000-00-00', '2014', '1', 'Available', '-2010'),
('1.1.7', 'computer programming', 'Programming', 'Atul', 150, 'Gujarat techincal Publishers', '0000-00-00', '2015', '1', 'Available', '-2010'),
('1.1.8', 'Computer Programming', 'Programming', 'Atul', 150, 'Atul Prakashan', '0000-00-00', '2021', '1', 'Available', '-2010'),
('1.2.1', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2012', '1', 'Available', '-2010'),
('1.2.2', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2012', '1', 'Available', '-2010'),
('1.2.3', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2013', '1', 'Available', '-2010'),
('1.2.4', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2015', '1', 'Available', '-2010'),
('1.2.5', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Gujarat techincal Publishers', '0000-00-00', '2015', '1', 'Available', '-2010'),
('1.2.6', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2016', '1', 'Available', '-2010'),
('1.2.7', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2019', '1', 'Available', '-2010'),
('1.2.8', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2021', '1', 'Available', '-2010'),
('1.2.9', 'Fundamental Of Digital Electronics', 'Programming', 'Atul', 100, 'Atul Prakashan', '0000-00-00', '2021', '1', 'Available', '-2010'),
('1.3.1', 'essential of environment & seismic engineering', 'Programming', 'Atul', 250, 'Atul Prakashan', '0000-00-00', '2005', '1', 'Available', '-2010'),
('1.3.2', 'essential of environment & seismic engineering', 'Programming', 'Atul', 250, 'Atul Prakashan', '0000-00-00', '2006', '1', 'Available', '-2010'),
('1.3.3', 'Environmental conservation & hazard management ', 'Programming', 'Atul', 160, 'Atul Prakashan', '0000-00-00', '2012', '1', 'Available', '-2010'),
('1.3.4', 'Environmental conservation & hazard management ', 'Programming', 'Atul', 160, 'Atul Prakashan', '0000-00-00', '2016', '1', 'Available', '-2010'),
('1.3.5', 'Environmental conservation & hazard management ', 'Programming', 'Atul', 160, 'Atul Prakashan', '0000-00-00', '2020', '1', 'Available', '-2010'),
('1.4.1', 'Polytechnic Mathamatics-1', 'Programming', 'Atul', 170, 'Mahajan publicing house ', '0000-00-00', '2010', '1', 'Available', '-2010');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `f_id` varchar(15) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` bigint NOT NULL,
  `password` varchar(15) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`f_id`, `f_name`, `l_name`, `email`, `contact`, `password`, `avatar`) VALUES
('CVN', 'Chirag', 'Nathvani', 'chiragnathvani@gmail.com', 3245617890, '123', 'avatar/1677944049.png'),
('IHP', 'Imran', 'Pathan', 'imranpathan@gmail.com', 9512618990, '6916', 'avatar/1677944094.png'),
('SDG', 'Sagar', 'Gajera', 'sagargajera@gmail.com', 7854123690, '123', 'avatar/1677944261.png'),
('DKR', 'denis', 'ruparel', 'kalpeshruparel97@gmail.com', 8866637550, 'vivek6916', 'avatar/1679221241.png');

-- --------------------------------------------------------

--
-- Table structure for table `f_issue_book`
--

DROP TABLE IF EXISTS `f_issue_book`;
CREATE TABLE IF NOT EXISTS `f_issue_book` (
  `issue_book_id` int NOT NULL AUTO_INCREMENT,
  `book_id` varchar(20) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `issue_date_time` varchar(30) NOT NULL,
  `expected_return_date` varchar(30) NOT NULL,
  `return_date_time` varchar(30) NOT NULL,
  `book_issue_status` enum('Issue','Return','Not Return') NOT NULL,
  PRIMARY KEY (`issue_book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `f_issue_book`
--

INSERT INTO `f_issue_book` (`issue_book_id`, `book_id`, `user_id`, `issue_date_time`, `expected_return_date`, `return_date_time`, `book_issue_status`) VALUES
(9, 'CE001', 'VND', '2023-03-16 08:06:32', '2023-03-21 08:06:32', '2023-03-16 08:06:56', 'Return'),
(8, 'CE001', 'VUV', '2023-03-15 14:44:19', '2023-03-20 14:44:19', '2023-03-16 09:12:25', 'Return'),
(7, 'CE003', 'IHP', '2023-03-14 16:04:46', '2023-03-19 16:04:46', '2023-03-20 16:04:58', 'Return'),
(6, 'CE001', 'VND', '2023-03-14 16:02:43', '2023-03-19 16:02:43', '2023-03-14 16:02:50', 'Return'),
(11, '1.2.1', 'CVN', '2023-03-19 05:23:47', '2023-03-24 05:23:47', '2023-03-19 05:48:25', 'Return'),
(12, '1.1.3', 'DKR', '2023-03-22 14:03:11', '2023-03-27 14:03:11', '2023-03-27 14:10:30', 'Return'),
(13, '1.1.5', 'DKR', '2023-03-22 14:09:30', '2023-03-27 14:09:30', '', 'Issue');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

DROP TABLE IF EXISTS `issue_book`;
CREATE TABLE IF NOT EXISTS `issue_book` (
  `issue_book_id` int NOT NULL AUTO_INCREMENT,
  `book_id` varchar(20) NOT NULL,
  `user_id` bigint NOT NULL,
  `issue_date_time` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expected_return_date` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `return_date_time` varchar(30) NOT NULL,
  `book_issue_status` enum('Issue','Return','Late Return') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`issue_book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`issue_book_id`, `book_id`, `user_id`, `issue_date_time`, `expected_return_date`, `return_date_time`, `book_issue_status`) VALUES
(96, '1.1.1', 206270307066, '2023-03-19 09:23:34', '2023-03-24 09:23:34', '2023-03-25 09:26:03', 'Return'),
(99, '1.1.4', 206270307066, '2023-03-22 14:05:40', '2023-03-27 14:05:40', '2023-03-30 14:05:40', 'Return');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `enrollment_number` bigint NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` bigint NOT NULL,
  `password` varchar(15) NOT NULL,
  `user_avatar` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`enrollment_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`enrollment_number`, `first_name`, `last_name`, `email`, `contact`, `password`, `user_avatar`, `date`) VALUES
(206270307020, 'uday', 'odedara', 'uday2004@gmail.com', 2147483647, 'u', 'avatar/1678769443.png', '2023-03-14 10:20:43'),
(206270307024, 'vivek', 'vara', 'vivekvara2004@gmail.com', 2147483647, '6916', 'avatar/1675691422.png', '2023-02-06 19:20:22'),
(206270307066, 'denis', 'ruparel', 'deniskalpeshbhai436@gmail.com', 8866637550, '12345678', 'avatar/1675691384.png', '2023-02-06 19:19:44'),
(206270307083, 'shanti', 'agath', 'shantiagath@gmail.com', 1234567890, '123', 'avatar/1675691456.png', '2023-02-06 19:20:56'),
(206270307093, 'nidhi', 'solanki', 'nidhisolanki@gmail.com', 2147483647, '123', 'avatar/1677916332.png', '2023-03-04 13:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `enrollment_number` bigint NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` int NOT NULL,
  `password` varchar(15) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `user_avatar` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`enrollment_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `library_admin` varchar(50) NOT NULL,
  `library_contact` bigint NOT NULL,
  `library_email` varchar(50) NOT NULL,
  `library_total_book_issue_day` int NOT NULL,
  `library_one_day_fine` decimal(4,2) NOT NULL,
  `library_issue_total_book_per_user` int NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `library_admin`, `library_contact`, `library_email`, `library_total_book_issue_day`, `library_one_day_fine`, `library_issue_total_book_per_user`) VALUES
(0, 'denis', 8866637550, 'deniskalpeshbhai436@gmail.com', 5, '10.00', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
