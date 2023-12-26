-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 02:54 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcframework`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(12, '1', 'td', 'test1232131dsad', '0000-00-00 00:00:00'),
(14, '1', 'sdfs', 'sdf', '0000-00-00 00:00:00'),
(16, '1', 'sdfsdf', 'sdf', '0000-00-00 00:00:00'),
(17, '1', 'sdfs', 'fsdf', '0000-00-00 00:00:00'),
(18, '1', 'sdfsdf', 'sdfsf', '0000-00-00 00:00:00'),
(19, '1', 'sdfsdf', 'sdfsf', '0000-00-00 00:00:00'),
(20, '1', 'sdfsdf', 'sdfdf', '0000-00-00 00:00:00'),
(21, '1', 'sfsdf', 'sdfsdf', '0000-00-00 00:00:00'),
(22, '1', 'sdfsdf', 'sdfs', '0000-00-00 00:00:00'),
(23, '1', 'sdfsd', 'fsdf', '0000-00-00 00:00:00'),
(24, '1', 'sdfsdf', 'sdf', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'ayam', 'ayam@gmail.com', '$2y$10$MBAyRvGHJb.IDzlhmc.gP.DI3hDHOGYqCQ0xnIJkKq9HAAQItJ2c6'),
(2, 'ayam2', 'ayam2@gmail.com', '$2y$10$ntRAygVnM5sH9u9iJbsInOJiGZ83z3q/0XU49DcIDJ7VzKg6rTzx6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
