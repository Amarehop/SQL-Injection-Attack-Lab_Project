-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2024 at 05:26 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `ssn` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `name`, `password`, `salary`, `birthday`, `ssn`, `address`, `email`, `nickname`, `phone`) VALUES
(1, 'Admin', '1234abc', 10000.00, '1943-05-03', '43254314', 'Admin Address', 'admin@example.com', 'AdminNick', '1234567890'),
(2, 'Alice', '1244abc&#039;, salary=10000', 6789.00, '1989-09-20', '10211002', 'Alice Address', 'alice@example.com', 'AliceNick', '0987654321'),
(3, 'Boby', '125abc', 10130.00, '1982-04-20', '10213352', 'Boby Address', 'boby@example.com', 'BobyNick', '1122334455'),
(4, 'Ryan', '126abc', 15000.00, '1980-04-10', '32193525', 'Ryan Address', 'ryan@example.com', 'RyanNick', '2233445566'),
(5, 'Samy', '127abc', 13000.00, '1991-01-11', '32111111', 'Samy Address', 'samy@example.com', 'SamyNick', '3344556677'),
(6, 'Ted', '128abc', 12890.00, '1963-11-03', '24343244', 'Ted Address', 'ted@example.com', 'TedNick', '4455667788');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
