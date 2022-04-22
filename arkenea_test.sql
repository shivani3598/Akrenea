-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 07:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arkenea_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`id`, `name`, `address`, `email`, `phone`, `dob`, `image`, `create_date`, `update_date`) VALUES
(1, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Shivani Rajendra Pathak', '6, Jhanvi Row Houses, 100ft Road, Sarthak Nagar, Indira Nagar, Nashik-422009', 'shivanipathak3598@gmail.com', 7798580813, '1997-05-03', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
