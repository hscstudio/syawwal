-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2014 at 11:41 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `heart2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmation_token` varchar(32) DEFAULT NULL,
  `confirmation_sent_at` int(11) DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `recovery_token` varchar(32) DEFAULT NULL,
  `recovery_sent_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `registered_from` int(11) DEFAULT NULL,
  `logged_in_from` int(11) DEFAULT NULL,
  `logged_in_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_confirmation` (`id`,`confirmation_token`),
  UNIQUE KEY `user_recovery` (`id`,`recovery_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmation_token`, `confirmation_sent_at`, `confirmed_at`, `unconfirmed_email`, `recovery_token`, `recovery_sent_at`, `blocked_at`, `role`, `registered_from`, `logged_in_from`, `logged_in_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$13$xOnFV4B5NGTJpu1P/qy03Owrkx6j/35dZJR6gPNscLSV2A6kR98fa', '_ZSeDwI6bRSftr4iK42GukuBrWgvHjwz', NULL, NULL, 1405729304, NULL, NULL, NULL, NULL, '', 2130706433, 2130706433, 1407744311, 1405728264, 1407744311),
(2, 'guntur', 'muhamadg@gmail.com', '$2y$13$A9P983LHjqD./2ECgD9Cx.eBKxwangC3VSUpVNiAxd.NMEz/ozxlK', '', NULL, NULL, 1407743815, NULL, NULL, NULL, NULL, NULL, NULL, 2130706433, 1407743857, 1407743815, 1407743857),
(3, 'fajar', 'fajar@gmail.com', '$2y$13$7MO.Mv6G3F672USoK2sjEuFjLsml/LC3H0B/7W/a4YO3Bh.blW9em', ';H', NULL, NULL, 1407744051, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1407744051, 1407744051),
(4, 'hafid', 'hafid@gmail.com', '$2y$13$511yyIWHFo6QaaU2pOcpuenv21LwWq1U7EghrnsCjPABCh91yWvhO', '', NULL, NULL, 1407744065, NULL, NULL, NULL, NULL, NULL, NULL, 2130706433, 1407744077, 1407744066, 1407744077),
(5, 'ahmad', 'ahmad@gmail.com', '$2y$13$TRbAZByrOZcR8G5benx5nOyL9jyCKiv9lQSTNesYSUw7w/UdYV8A.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2130706433, 2130706433, 1407744130, 1407744118, 1407744130);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
