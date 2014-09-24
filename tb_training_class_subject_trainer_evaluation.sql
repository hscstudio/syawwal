-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2014 at 11:02 AM
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
-- Table structure for table `tb_training_class_subject_trainer_evaluation`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_subject_trainer_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_subject_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `comment` varchar(3000) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_trainer_evaluation_tb_student1` (`tb_student_id`),
  KEY `tb_training_class_subject_id` (`tb_training_class_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_training_class_subject_trainer_evaluation`
--

INSERT INTO `tb_training_class_subject_trainer_evaluation` (`id`, `tb_training_class_subject_id`, `tb_trainer_id`, `tb_student_id`, `value`, `comment`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(2, 5, 1, 55, '4|4|3|3|5|5|5|3|2|1|4|4', 'Good Lucky', 1, '2014-09-18 15:28:11', 55, '2014-09-18 15:28:11', 55, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_training_class_subject_trainer_evaluation`
--
ALTER TABLE `tb_training_class_subject_trainer_evaluation`
  ADD CONSTRAINT `fk_tb_training_trainer_evaluation_tb_student1` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`),
  ADD CONSTRAINT `tb_training_class_subject_trainer_evaluation_ibfk_1` FOREIGN KEY (`tb_training_class_subject_id`) REFERENCES `tb_training_class_subject` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
