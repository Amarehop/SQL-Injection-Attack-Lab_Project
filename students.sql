-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 16, 2024 at 05:23 PM
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
-- Database: `student_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `email`, `phone`, `address`, `city`, `state`, `zip`, `country`, `created_at`) VALUES
(1, 'Amare_Hope', '12345', 'john.doe@example.com', '555-1234', '123 Main St', 'Anytown', 'CA', '12345', 'USA', '2024-06-06 15:25:17'),
(2, 'Destaye_alemnew', 'qwerty456', 'jane.smith@example.com', '555-5678', '456 Oak Rd', 'Somewhere', 'NY', '67890', 'USA', '2024-06-06 15:25:17'),
(3, 'Moges_Tsega', 'abc123def', 'bob.johnson@example.com', '555-9012', '789 Elm St', 'Elsewhere', 'TX', '54321', 'USA', '2024-06-06 15:25:17'),
(4, 'Sarah_Lee', 'password789', 'sarah.lee@example.com', '555-3456', '321 Pine Ave', 'Somewhere Else', 'FL', '98765', 'USA', '2024-06-06 15:25:17'),
(5, 'Tom_Wilson', 'qwer1234', 'tom.wilson@example.com', '555-7890', '159 Oak Ln', 'Another Place', 'IL', '43210', 'USA', '2024-06-06 15:25:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
