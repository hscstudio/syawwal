-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2014 at 03:36 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `syawwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE IF NOT EXISTS `tb_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_religion_id` int(3) NOT NULL DEFAULT '0',
  `ref_graduate_id` int(3) NOT NULL DEFAULT '0',
  `ref_rank_class_id` int(3) NOT NULL DEFAULT '0',
  `ref_unit_id` int(3) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `nickName` varchar(50) DEFAULT NULL,
  `frontTitle` varchar(20) DEFAULT NULL,
  `backTitle` varchar(20) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `born` varchar(50) DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1',
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `married` tinyint(1) DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `blood` varchar(10) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `eselon2` varchar(100) DEFAULT NULL,
  `eselon3` varchar(100) DEFAULT NULL,
  `eselon4` varchar(100) DEFAULT NULL,
  `satker` enum('2','3','4') NOT NULL DEFAULT '2',
  `officePhone` varchar(50) DEFAULT NULL,
  `officeFax` varchar(50) DEFAULT NULL,
  `officeEmail` varchar(100) DEFAULT NULL,
  `officeAddress` varchar(255) DEFAULT NULL,
  `noSKPangkat` varchar(255) DEFAULT NULL COMMENT 'SK CPNS',
  `tmtSKPangkat` date DEFAULT NULL COMMENT 'SK JABATAN TERAKHIR',
  `fileSKPangkat` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_student_ref_religion1` (`ref_religion_id`),
  KEY `fk_tb_student_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_student_ref_rank_class1` (`ref_rank_class_id`),
  KEY `fk_tb_student_ref_unit1` (`ref_unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`id`, `ref_religion_id`, `ref_graduate_id`, `ref_rank_class_id`, `ref_unit_id`, `name`, `nickName`, `frontTitle`, `backTitle`, `nip`, `password_hash`, `auth_key`, `born`, `birthDay`, `gender`, `phone`, `email`, `address`, `married`, `photo`, `blood`, `position`, `education`, `eselon2`, `eselon3`, `eselon4`, `satker`, `officePhone`, `officeFax`, `officeEmail`, `officeAddress`, `noSKPangkat`, `tmtSKPangkat`, `fileSKPangkat`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 1, 4, 4, 1, 'Muhamad Guntur', 'Guntur', 'Mr', 'S.Kom', '198310172009011010', '$2y$13$xOnFV4B5NGTJpu1P/qy03Owrkx6j/35dZJR6gPNscLSV2A6kR98fa', NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD CONSTRAINT `fk_tb_student_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
