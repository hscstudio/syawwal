-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2014 at 05:26 AM
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
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `properties` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('PEJABAT - PROGRAM - PLANNING - PUSDIKLAT', '2', 1410406566),
('PEJABAT - PUSDIKLAT', '1', 1410385976);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/pusdiklat-general/default/index', 2, NULL, NULL, NULL, 1410390361, 1410390361),
('/pusdiklat-planning/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/default/index', 2, NULL, NULL, NULL, 1410385214, 1410385214),
('/pusdiklat-planning/program-document/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/create', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/delete', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/editable', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/import', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/status', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/update', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-document2/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history2/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history2/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history2/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history2/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-history2/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject-document/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/create', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/delete', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/editable', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/import', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/status', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/update', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-document2/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history2/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history2/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history2/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history2/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject-history2/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject2/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject2/create', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/delete', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/editable', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/import', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject2/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/status', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject2/update', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject2/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program-subject3/*', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/create', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/delete', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/editable', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/import', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/index', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/open-tbs', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/php-excel', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/status', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/update', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program-subject3/view', 2, NULL, NULL, NULL, 1410397081, 1410397081),
('/pusdiklat-planning/program/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program/create', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/delete', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/editable', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/import', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/index', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/open-tbs', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/php-excel', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/status', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/update', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program/view', 2, NULL, NULL, NULL, 1410385016, 1410385016),
('/pusdiklat-planning/program2/*', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/editable', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/index', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/open-tbs', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/php-excel', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/update', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program2/view', 2, NULL, NULL, NULL, 1410397061, 1410397061),
('/pusdiklat-planning/program3/*', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/editable', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/index', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/open-tbs', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/php-excel', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/update', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/program3/view', 2, NULL, NULL, NULL, 1410397080, 1410397080),
('/pusdiklat-planning/trainer3/*', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/create', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/delete', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/editable', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/import', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/index', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/open-tbs', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/php-excel', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/update', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/trainer3/view', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training-history/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/create', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/delete', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/editable', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/import', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/index', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/open-tbs', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/php-excel', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/update', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history/view', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/create', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/delete', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/editable', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/import', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/index', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/open-tbs', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/php-excel', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/update', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-history2/view', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/cre', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/del', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/edi', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/imp', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/ind', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/ope', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/php', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/upd', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject-trainer-recommendation3/vie', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/create', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/delete', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/editable', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/import', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/index', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/open-tbs', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/php-excel', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/status', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/update', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-subject3/view', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-unit-plan/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training-unit-plan/delete', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/editable', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/import', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/index', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/open-tbs', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/php-excel', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/update', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training-unit-plan/view', 2, NULL, NULL, NULL, 1410395781, 1410395781),
('/pusdiklat-planning/training/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training/create', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/delete', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/editable', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/import', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/index', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/index-by-program', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/open-tbs', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/php-excel', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/program-name', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/update', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training/view', 2, NULL, NULL, NULL, 1410385038, 1410385038),
('/pusdiklat-planning/training2/*', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/delete', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/editable', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/import', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/index', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/open-tbs', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/php-excel', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/update', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training2/view', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training3/*', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/delete', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/editable', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/import', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/index', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('/pusdiklat-planning/training3/open-tbs', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/php-excel', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/update', 2, NULL, NULL, NULL, 1410396063, 1410396063),
('/pusdiklat-planning/training3/view', 2, NULL, NULL, NULL, 1410396062, 1410396062),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410397004, 1410397195),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410384839, 1410384839),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410397242, 1410397242),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410397270, 1410397270),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410397208, 1410397208),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410384868, 1410384868),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', 2, NULL, NULL, NULL, 1410397259, 1410397259),
('PEJABAT - CURRICULUM - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410396585, 1410396585),
('PEJABAT - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410384451, 1410384659),
('PEJABAT - PROGRAM - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410384380, 1410384635),
('PEJABAT - PUSDIKLAT', 1, NULL, NULL, NULL, 1410384685, 1410384685),
('PEJABAT - TRAINER - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410396632, 1410396632),
('PELAKSANA - CURRICULUM - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410396779, 1410396779),
('PELAKSANA - PROGRAM - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410384435, 1410384572),
('PELAKSANA - TRAINER - PLANNING - PUSDIKLAT', 1, NULL, NULL, NULL, 1410396792, 1410396792);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('PELAKSANA - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/default/index'),
('PELAKSANA - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/default/index'),
('PELAKSANA - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/default/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/create'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/delete'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/editable'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/import'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/status'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/update'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-document2/view'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-history2/view'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/create'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/delete'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/editable'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/import'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/status'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/update'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-document2/view'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject-history2/view'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/create'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/delete'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/editable'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/import'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/status'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/update'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject2/view'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/*'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/create'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/delete'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/editable'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/import'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/index'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/open-tbs'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/php-excel'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/status'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/update'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program-subject3/view'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/*'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/create'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/delete'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/editable'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/import'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/index'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/open-tbs'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/php-excel'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/status'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/update'),
('CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program/view'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/*'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/editable'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/index'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/open-tbs'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/php-excel'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/update'),
('CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program2/view'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/*'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/editable'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/index'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/open-tbs'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/php-excel'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/update'),
('CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/program3/view'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/*'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/create'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/delete'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/editable'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/import'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/index'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/open-tbs'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/php-excel'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/update'),
('CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/trainer3/view'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/*'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/create'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/delete'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/editable'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/import'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/index'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/open-tbs'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/php-excel'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/update'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history/view'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/*'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/create'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/delete'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/editable'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/import'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/index'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/open-tbs'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/php-excel'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/update'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-history2/view'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/*'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/cre'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/del'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/edi'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/imp'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/ind'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/ope'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/php'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/upd'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject-trainer-recommendation3/vie'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/*'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/create'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/delete'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/editable'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/import'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/index'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/open-tbs'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/php-excel'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/status'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/update'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-subject3/view'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/delete'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/editable'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/import'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/index'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/open-tbs'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/php-excel'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/update'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training-unit-plan/view'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/*'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/create'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/delete'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/editable'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/import'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/index'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/index-by-program'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/open-tbs'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/php-excel'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/program-name'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/update'),
('CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training/view'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/*'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/delete'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/editable'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/import'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/index'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/open-tbs'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/php-excel'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/update'),
('CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training2/view'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/*'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/delete'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/editable'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/import'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/index'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/open-tbs'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/php-excel'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/update'),
('CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT', '/pusdiklat-planning/training3/view'),
('PELAKSANA - CURRICULUM - PLANNING - PUSDIKLAT', 'CRUD PROGRAM - CURRICULUM - PLANNING - PUSDIKLAT'),
('PELAKSANA - PROGRAM - PLANNING - PUSDIKLAT', 'CRUD PROGRAM - PROGRAM - PLANNING - PUSDIKLAT'),
('PELAKSANA - TRAINER - PLANNING - PUSDIKLAT', 'CRUD PROGRAM - TRAINER - PLANNING - PUSDIKLAT'),
('PELAKSANA - TRAINER - PLANNING - PUSDIKLAT', 'CRUD TRAINER - TRAINER - PLANNING - PUSDIKLAT'),
('PELAKSANA - CURRICULUM - PLANNING - PUSDIKLAT', 'CRUD TRAINING - CURRICULUM - PLANNING - PUSDIKLAT'),
('PELAKSANA - PROGRAM - PLANNING - PUSDIKLAT', 'CRUD TRAINING - PROGRAM - PLANNING - PUSDIKLAT'),
('PELAKSANA - TRAINER - PLANNING - PUSDIKLAT', 'CRUD TRAINING - TRAINER - PLANNING - PUSDIKLAT'),
('PEJABAT - PLANNING - PUSDIKLAT', 'PEJABAT - CURRICULUM - PLANNING - PUSDIKLAT'),
('PEJABAT - PUSDIKLAT', 'PEJABAT - PLANNING - PUSDIKLAT'),
('PEJABAT - PLANNING - PUSDIKLAT', 'PEJABAT - PROGRAM - PLANNING - PUSDIKLAT'),
('PEJABAT - PLANNING - PUSDIKLAT', 'PEJABAT - TRAINER - PLANNING - PUSDIKLAT'),
('PEJABAT - CURRICULUM - PLANNING - PUSDIKLAT', 'PELAKSANA - CURRICULUM - PLANNING - PUSDIKLAT'),
('PEJABAT - PROGRAM - PLANNING - PUSDIKLAT', 'PELAKSANA - PROGRAM - PLANNING - PUSDIKLAT'),
('PEJABAT - TRAINER - PLANNING - PUSDIKLAT', 'PELAKSANA - TRAINER - PLANNING - PUSDIKLAT');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(1, 'BPPK', NULL, NULL, NULL, NULL),
(2, 'SEKRETARIAT', 1, NULL, NULL, NULL),
(3, 'PUSDIKLAT', 1, NULL, NULL, 'return [\r\n''icon''=>''fa fa-building fa-fw''\r\n]'),
(4, 'Planning', 3, '/pusdiklat-planning/default/index', NULL, 'return [\r\n''icon''=>''fa fa-calendar fa-fw'',\r\n''path''=>''pusdiklat-planning/'',\r\n];'),
(5, 'Dashboard', 4, '/pusdiklat-planning/default/index', 1, 'return [\r\n''icon''=>''fa fa-dashboard fa-fw'',\r\n];'),
(6, 'Program -', 4, '/pusdiklat-planning/program/index', 2, 'return [\r\n	''icon''=>''fa fa-code-fork fa-fw'',\r\n	''path''=>[\r\n	]\r\n];'),
(7, 'Program', 6, '/pusdiklat-planning/program/index', NULL, 'return [\r\n	''icon''=>''fa fa-list fa-fw'',\r\n	''path''=>[\r\n		''program/'',''program-subject/'',''program-document/'',''program-history/'',''program-subject-document/'',''program-subject-history/''\r\n	]\r\n];'),
(8, 'Training', 6, '/pusdiklat-planning/training/index', NULL, 'return [\r\n	''icon''=>''fa fa-fw fa-stack-overflow'',\r\n	''path''=>[\r\n		''training/''\r\n	]\r\n];'),
(9, 'Training Unit Plan', 6, '/pusdiklat-planning/training-unit-plan/index', NULL, 'return [\r\n	''icon''=>''fa fa-fw fa-stack-overflow'',\r\n	''path''=>[\r\n		''training-unit-plan/''\r\n	]\r\n];'),
(10, 'Curriculum -', 4, '/pusdiklat-planning/program2/index', 3, 'return [\r\n    ''icon''=>''fa fa-fw fa-university'',\r\n]'),
(11, 'Trainer -', 4, '/pusdiklat-planning/program3/index', 4, 'return [\r\n    ''icon''=>''fa fa-fw fa-users''\r\n]'),
(12, 'Program', 10, '/pusdiklat-planning/program2/index', NULL, 'return [\r\n	''icon''=>''fa fa-list fa-fw'',\r\n	''path''=>[\r\n		''program2/'',''program-subject2/'',''program-document2/'',''program-history2/'',''program-subject-document2/'',''program-subject-history2/''\r\n	]\r\n];'),
(13, 'Program', 11, '/pusdiklat-planning/program3/index', NULL, 'return [\r\n	''icon''=>''fa fa-list fa-fw'',\r\n	''path''=>[\r\n		''program3/'',''program-subject3/'',''program-document3/'',''program-history3/'',''program-subject-document3/'',''program-subject-history3/''\r\n	]\r\n];'),
(14, 'Training', 11, '/pusdiklat-planning/training3/index', NULL, 'return [\r\n	''icon''=>''fa fa-fw fa-stack-exchange'',\r\n	''path''=>[\r\n		''training3/'',''training-history3/'',''training-subject3/'',''training-subject-trainer-recommendation3/'',\r\n	]\r\n];'),
(15, 'Trainer', 11, '/pusdiklat-planning/trainer3/index', NULL, 'return [\r\n	''icon''=>''fa fa-fw fa-stack-exchange'',\r\n	''path''=>[\r\n		''trainer3/'',\r\n	]\r\n];\r\n'),
(16, 'Training', 10, '/pusdiklat-planning/training2/index', NULL, 'return [\r\n	''icon''=>''fa fa-book fa-fw'',\r\n	''path''=>[\r\n		''training2/'',''training-history2/'',\r\n	]\r\n];');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1405724729),
('m130524_201442_init', 1405724732),
('m140209_132017_init', 1405724903),
('m140403_174025_create_account_table', 1405724904),
('m140506_102106_rbac_init', 1405724743),
('m140602_111327_create_menu_table', 1405725164);

-- --------------------------------------------------------

--
-- Table structure for table `ref_graduate`
--

CREATE TABLE IF NOT EXISTS `ref_graduate` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'SD - S3',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_graduate`
--

INSERT INTO `ref_graduate` (`id`, `name`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, '-', 1, NULL, NULL, '2014-04-18 12:40:31', 1, NULL, NULL),
(1, 'SD', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'SMP', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(3, 'SMA', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(4, 'D I', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(5, 'D II', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(6, 'D III', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(7, 'D IV', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(8, 'S 1', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(9, 'S 2', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL),
(10, 'S 3', 1, '2014-04-18 12:39:49', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_program_code`
--

CREATE TABLE IF NOT EXISTS `ref_program_code` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(25) NOT NULL,
  `parent_id` int(3) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ref_program_code`
--

INSERT INTO `ref_program_code` (`id`, `name`, `code`, `parent_id`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 'DIKLAT PRAJABATAN', '1.0.0.0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'DIKLAT DALAM JABATAN', '2.0.0.0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'DIKLAT KEPEMIMPINAN', '2.1.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'DIKLAT FUNGSIONAL', '2.2.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'KEAHLIAN', '2.2.1.0', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'KETERAMPILAN', '2.2.2.0', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'PEMBENTUKAN FUNGSIONAL', '2.2.3.0', 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'DIKLAT TEKNIS', '2.3.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'DIKLAT TEKNIS SUBSTANTIF', '2.3.1.0', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'DIKLAT TEKNIS SUBSTANTIF DASAR', '2.3.1.1', 9, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'DIKLAT TEKNIS SUBSTANTIF SPESIALISASI', '2.3.1.2', 9, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'DIKLAT TEKNIS UMUM', '2.3.2.0', 8, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'UJIAN DINAS', '2.4.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'UJIAN PENYESUAIN KENAIKAN PANGKAT', '2.5.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'DIKLAT PENYEGARAN', '2.6.0.0', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'SERTIFIKASI', '3.0.0.0', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_rank_class`
--

CREATE TABLE IF NOT EXISTS `ref_rank_class` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_rank_class`
--

INSERT INTO `ref_rank_class` (`id`, `name`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, '-', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'Juru Muda / I.a', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(2, 'Juru Muda Tingkat I / I.b', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(3, 'Juru / I.c', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(4, 'Juru Tingkat I / I.d', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(5, 'Pengatur Muda / II.a', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(6, 'Pengatur Muda Tingkat I / II.b', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(7, 'Pengatur / II.c', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(8, 'Pengatur Tingkat I / II.d', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(9, 'Penata Muda / III.a', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(10, 'Penata Muda Tingkat I / III.b', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(11, 'Penata / III.c', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(12, 'Penata Tingkat I / III.d', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(13, 'Pembina / IV.a', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(14, 'Pembina Tingkat I / IV.b', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(15, 'Pembina Utama Muda / IV.c', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(16, 'Pembina Utama Madya / IV.d', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL),
(17, 'Pembina Utama / IV.e', 1, '2014-04-18 13:22:51', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_religion`
--

CREATE TABLE IF NOT EXISTS `ref_religion` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_religion`
--

INSERT INTO `ref_religion` (`id`, `name`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, '-', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'Islam', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL),
(2, 'Kristen Katolik', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL),
(3, 'Kristen Protestan', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL),
(4, 'Hindu', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL),
(5, 'Budha', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL),
(6, 'Konghucu', 1, '2014-04-18 13:31:10', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_satker`
--

CREATE TABLE IF NOT EXISTS `ref_satker` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(50) DEFAULT NULL,
  `letterNumber` varchar(25) NOT NULL,
  `eselon` int(1) NOT NULL DEFAULT '0',
  `address` varchar(500) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_satker`
--

INSERT INTO `ref_satker` (`id`, `name`, `shortname`, `letterNumber`, `eselon`, `address`, `city`, `phone`, `fax`, `email`, `website`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, '-', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'Sekretariat Badan', 'SETBAN', 'PP.01', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Pusdiklat PSDM', 'PSDM', 'PP.02', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Pusdiklat AP', 'AP', 'PP.03', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Pusdiklat Pajak', 'PUSPA', 'PP.04', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Pusdiklat BC', 'BC', 'PP.05', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Pusdiklat KNPK', 'KNPK', 'PP.06', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Pusdiklat Keuangan Umum', 'KU', 'PP.07', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Sekolah Tinggi Akuntansi Negara', 'STAN', '', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Balai Diklat Keuangan Medan', 'Medan', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Balai Diklat Keuangan Palembang', 'Palembang', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Balai Diklat Keuangan Yogyakarta', 'Yogyakarta', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Balai Diklat Keuangan Malang', 'Malang', 'BPP.06', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'BDK Balikpapan', 'Balikpapan', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'BDK Makassar', 'Makasaar', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Balai Diklat Keuangan Cimahi', 'Cimahi', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Balai Diklat Keuangan Manado', 'Manado', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Balai Diklat Keuangan Pekanbaru', 'Pekanbaru', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Balai Diklat Keuangan Pontianak', 'Pontianak', 'BPP.08', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Balai Diklat Keuangan Denpasar', 'Denpasar', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Balai Diklat Keuangan Magelang', 'Magelang', '-', 3, '', '', '', '', '', '', 1, '2014-04-18 13:37:40', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_sbu`
--

CREATE TABLE IF NOT EXISTS `ref_sbu` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'standard biaya umum',
  `name` varchar(255) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ref_sbu`
--

INSERT INTO `ref_sbu` (`id`, `name`, `value`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 'honor_persiapan_mengajar', 130000, 1, '2014-04-18 14:01:01', 1, '2014-04-18 22:38:32', NULL, NULL, NULL),
(2, 'honor_pengajar_pns_internal', 100000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(3, 'honor_asisten_pns_internal', 50000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(4, 'honor_pengajar_pns_eksternal', 250000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(5, 'honor_asisten_pns_eksternal', 100000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(6, 'honor_penceramah_pns_internal_1', 550000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(7, 'honor_penceramah_pns_internal_2', 450000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(8, 'honor_penceramah_pns_internal_3', 350000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(9, 'honor_penceramah_pns_eksternal_1', 1100000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(10, 'honor_penceramah_pns_eksternal_2', 850000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(11, 'honor_penceramah_pns_eksternal_3', 700000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL),
(12, 'honor_transport_dalam_kota', 110000, 1, '2014-04-18 14:01:01', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_sta_unit`
--

CREATE TABLE IF NOT EXISTS `ref_sta_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `induk` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `eselon` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000 ;

--
-- Dumping data for table `ref_sta_unit`
--

INSERT INTO `ref_sta_unit` (`id`, `induk`, `name`, `eselon`) VALUES
(1, 0, 'KEMENKEU', 0),
(10000, 1, 'KEPALA BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN', 1),
(10010, 10000, 'SEKRETARIAT BADAN DIKLAT KEUANGAN', 2),
(10100, 10010, 'BAGIAN ORGANISASI DAN TATA LAKSANA', 3),
(10110, 10100, 'SUBBAGIAN ORGANISASI', 4),
(10120, 10100, 'SUBBAGIAN TATA LAKSANA', 4),
(10130, 10100, 'SUBBAGIAN HUKUM DAN KERJASAMA', 4),
(10200, 10010, 'BAGIAN KEPEGAWAIAN', 3),
(10210, 10200, 'SUBBAGIAN PENGEMBANGAN PEGAWAI ', 4),
(10220, 10200, 'SUBBAGIAN ADMINISTRASI JABATAN FUNGSIONAL', 4),
(10230, 10200, 'SUBBAGIAN KEPATUHAN INTERNAL', 4),
(10240, 10200, 'SUBBAGIAN UMUM KEPEGAWAIAN', 4),
(10250, 10200, 'DALAM PROSES DIBERHENTIKAN', 9),
(10260, 10200, 'TUGAS BELAJAR', 9),
(10270, 10200, 'DIPEKERJAKAN', 9),
(10300, 10010, 'BAGIAN KEUANGAN', 3),
(10310, 10300, 'SUBBAGIAN PENYUSUNAN ANGGARAN', 4),
(10320, 10300, 'SUBBAGIAN PERBENDAHARAAN', 4),
(10330, 10300, 'SUBBAGIAN AKUNTANSI DAN PELAPORAN', 4),
(10400, 10010, 'BAGIAN TEKNOLOGI INFORMASI DAN KOMUNIKASI', 3),
(10410, 10400, 'SUBBAGIAN SISTEM INFORMASI', 4),
(10420, 10400, 'SUBBAGIAN DUKUNGAN TEKNIS', 4),
(10430, 10400, 'SUBBAGIAN KOMUNIKASI PUBLIK', 4),
(10500, 10010, 'BAGIAN UMUM', 3),
(10510, 10500, 'SUBBAGIAN TATA USAHA ', 4),
(10520, 10500, 'SUBBAGIAN RUMAH TANGGA ', 4),
(10530, 10500, 'SUBBAGIAN PENGELOLAAN ASET', 4),
(20000, 10000, 'PUSDIKLAT PEGAWAI', 2),
(20100, 20000, 'BIDANG RENCANA DAN PROGRAM', 3),
(20110, 20100, 'SUBBIDANG PROGRAM BIDANG RENCANA DAN PROGRA', 4),
(20120, 20100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJ', 4),
(20130, 20100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(20140, 20100, 'SUBBIDANG TATA USAHA', 4),
(20200, 20000, 'BIDANG PENYELENGGARAAN', 3),
(20210, 20200, 'SUBBIDANG DIKLAT PENJENJANGAN JABATAN', 4),
(20220, 20200, 'SUBBIDANG DIKLAT PENJENJANGAN PANGKAT I', 4),
(20230, 20200, 'SUBBIDANG DIKLAT PENJENJANGAN PANGKAT II', 4),
(20300, 20000, 'BIDANG ADMINISTRASI PENDIDIKAN PASCA SARJANA', 3),
(20310, 20300, 'SUBBIDANG PERENCANAAN PASCA SARJANA', 4),
(20320, 20300, 'SUBBIDANG SELEKSI DAN PENEMPATAN', 4),
(20330, 20300, 'SUBBIDANG PEMANTAUAN', 4),
(20400, 20000, 'BIDANG EVALUSI DAN PELAPORAN KINERJA', 3),
(20410, 20400, 'SUBBIDANG EVALUASI DIKLAT', 4),
(20420, 20400, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT', 4),
(20430, 20400, 'SUBBIDANG INFORMASI DAN PELPORAN KINERJA', 4),
(20500, 20000, 'WIDYAISWARA PUSDIKLAT PEGAWAI', 7),
(20600, 20000, 'WIDYAISWARA PUSDIKLAT PEGAWAI-MAGELANG', 7),
(30000, 10000, 'PUSDIKLAT ANGGARAN', 2),
(30100, 30000, 'BIDANG PERENCANAAN DAN PENGEMBANGAN', 3),
(30110, 30100, 'SUBBIDANG PROGRAM DAN TEKNOLOGI INFORMASI', 4),
(30120, 30100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJARAN', 4),
(30130, 30100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(30140, 30100, 'SUBBIDANG TATA USAHA', 4),
(30200, 30000, 'BIDANG PENYELENGGARAAN', 3),
(30210, 30200, 'SUBBIDANG DIKLAT TEKNIS', 4),
(30220, 30200, 'SUBBIDANG DIKLAT SPESIALISASI', 4),
(30300, 30000, 'BIDANG EVALUASI DAN PELAPORAN KINERJA', 3),
(30310, 30300, 'SUBBIDANG EVALUASI PELAKSANAAN DIKLAT BIDAN', 4),
(30320, 30300, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT', 4),
(30330, 30300, 'SUBBIDANG INFORMASI DAN PELAPORAN KINERJA', 4),
(30500, 30000, 'WIDYAISWARA PUSDIKLAT ANGGARAN DAN PERBENDAHARAAN', 7),
(40000, 10000, 'PUSDIKLAT PERPAJAKAN', 2),
(40100, 40000, 'BIDANG PERENCANAAN DAN PENGEMBANGAN', 3),
(40110, 40100, 'SUBBIDANG PROGRAM DAN TEKNOLOGI INFORMASI', 4),
(40120, 40100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJ', 4),
(40130, 40100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(40140, 40100, 'SUBBAGIAN TATA USAHA', 4),
(40200, 40000, 'BIDANG PENYELENGGARAAN I', 3),
(40210, 40200, 'SUBBIDANG DIKLAT TEKNIS, FUNGSIONAL DAN PENATARAN', 4),
(40220, 40200, 'SUBBIDANG DIKLAT SPESIALISASI', 4),
(40230, 40200, 'SUBBIDANG SIMULASI PELAYANAN PAJAK', 4),
(40300, 40000, 'BIDANG EVALUASI DAN PELAPORAN KINERJA', 3),
(40310, 40300, 'SUBBIDANG EVALUASI DIKLAT', 4),
(40320, 40300, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT', 4),
(40330, 40300, 'SUBBIDANG INFORMASI DAN PELAPORAN KINERJA', 4),
(40500, 40000, 'WIDYAISWARA PUSDIKLAT PAJAK', 7),
(50000, 10000, 'PUSDIKLAT BEA DAN CUKAI', 2),
(50100, 50000, 'BIDANG PERENCANAAN DAN PENGEMBANGAN', 3),
(50110, 50100, 'SUBBIDANG PROGRAM DAN TEKNOLOGI INFORMASI', 4),
(50120, 50100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJ', 4),
(50130, 50100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(50140, 50100, 'SUBBIDANG TATA USAHA', 4),
(50200, 50000, 'BIDANG PENYELENGGARAAN', 3),
(50210, 50200, 'SUBBIDANG DIKLAT TEKNIS', 4),
(50220, 50200, 'SUBBIDANG DIKLAT SPESIALISASI', 4),
(50300, 50000, 'BIDANG EVALUASI DAN PELAPORAN KINERJA', 3),
(50310, 50300, 'SUBBIDANG EVALUASI PELAKSANAAN DIKLAT BIDAN', 4),
(50320, 50300, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT', 4),
(50330, 50300, 'SUBBIDANG INFORMASI DAN PELAPORAN KINERJA', 4),
(50500, 50000, 'WIDYAISWARA PUSDIKLAT BEA DAN CUKAI', 7),
(60000, 10000, 'PUSDIKLAT KEUANGAN UMUM', 2),
(60100, 60000, 'BIDANG PERENCANAAN DAN PENGEMBANGAN', 3),
(60110, 60100, 'SUBBIDANG PROGRAM DAN TEKNOLOGI INFORMASI', 4),
(60120, 60100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJ', 4),
(60130, 60100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(60140, 60100, 'SUBBIDANG TATA USAHA', 4),
(60200, 60000, 'BIDANG PENYELENGGARAAN', 3),
(60210, 60200, 'SUBBIDANG DIKLAT TEKNIS', 4),
(60220, 60200, 'SUBBIDANG DIKLAT SPESIALISASI', 4),
(60300, 60000, 'BIDANG EVALUASI DAN PELAPORAN KINERJA', 3),
(60310, 60300, 'SUBBIDANG EVALUASI PELAKSANAAN DIKLAT BIDAN', 4),
(60320, 60300, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT', 4),
(60330, 60300, 'SUBBIDANG INFORMASI DAN PELAPORAN KINERJA', 4),
(60500, 60000, 'WIDYAISWARA PUSDIKLAT KEUANGAN UMUM', 7),
(71000, 10000, 'BALAI DIKLAT KEUANGAN MEDAN', 3),
(71010, 71000, 'SUBBAGIAN UMUM', 4),
(71020, 71000, 'SEKSI PENYELENGGARAAN', 4),
(71030, 71000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(71100, 71010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(71200, 71010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(71300, 71020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(71400, 71020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(71500, 71000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN MEDAN', 7),
(71600, 71030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(71700, 71030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(72000, 10000, 'BALAI DIKLAT KEUANGAN PALEMBANG', 3),
(72010, 72000, 'SUBBAGIAN UMUM', 4),
(72020, 72000, 'SEKSI PENYELENGGARAAN', 4),
(72030, 72000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(72100, 72010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(72200, 72010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(72300, 72020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(72400, 72020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(72500, 72000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN PALEMBANG', 7),
(72600, 72030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(72700, 72030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(73000, 10000, 'BALAI DIKLAT KEUANGAN YOGYAKARTA', 3),
(73010, 73000, 'SUBBAGIAN UMUM', 4),
(73020, 73000, 'SEKSI PENYELENGGARAAN', 4),
(73030, 73000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(73100, 73010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(73200, 73010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(73300, 73020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(73400, 73020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(73500, 73000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN YOGYAKARTA', 7),
(73600, 73030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(73700, 73030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(74000, 10000, 'BALAI DIKLAT KEUANGAN MALANG', 3),
(74010, 74000, 'SUBBAGIAN UMUM', 4),
(74020, 74000, 'SEKSI PENYELENGGARAAN', 4),
(74030, 74000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(74100, 74010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(74200, 74010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(74300, 74020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(74400, 74020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(74500, 74000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN MALANG', 7),
(74600, 74030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(74700, 74030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(75000, 10000, 'BALAI DIKLAT KEUANGAN BALIKPAPAN', 3),
(75010, 75000, 'SUBBAGIAN UMUM', 4),
(75020, 75000, 'SEKSI PENYELENGGARAAN', 4),
(75030, 75000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(75100, 75010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(75200, 75010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(75300, 75020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(75400, 75020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(75500, 75000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN BALIKPAPAN', 7),
(75600, 75030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(75700, 75030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(76000, 10000, 'BALAI DIKLAT KEUANGAN MAKASSAR', 3),
(76010, 76000, 'SUBBAGIAN UMUM', 4),
(76020, 76000, 'SEKSI PENYELENGGARAAN', 4),
(76030, 76000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(76100, 76010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(76200, 76010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(76300, 76020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(76400, 76020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(76500, 76000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN MAKASSAR', 7),
(76600, 76030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(76700, 76030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(77000, 10000, 'BALAI DIKLAT KEUANGAN CIMAHI', 3),
(77010, 77000, 'SUBBAGIAN UMUM', 4),
(77020, 77000, 'SEKSI PENYELENGGARAAN', 4),
(77030, 77000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(77100, 77010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(77200, 77010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(77300, 77020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(77400, 77020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(77500, 77000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN CIMAHI', 7),
(77600, 77030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(77700, 77030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(78000, 10000, 'BALAI DIKLAT KEUANGAN MANADO', 3),
(78010, 78000, 'SUBBAGIAN UMUM', 4),
(78020, 78000, 'SEKSI PENYELENGGARAAN', 4),
(78030, 78000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(78100, 78010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(78200, 78010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(78300, 78020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(78400, 78020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(78500, 78000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN MANADO', 7),
(78600, 78030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(78700, 78030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(80000, 10000, 'SEKOLAH TINGGI AKUNTANSI NEGARA', 2),
(80100, 80000, 'SEKRETARIAT SEKOLAH TINGGI AKUNTANSI NEGARA', 3),
(80110, 80100, 'SUBBAGIAN TATA USAHA DAN KEUANGAN  SEKRETARIAT', 4),
(80120, 80100, 'SUBBAGIAN KEPEGAWAIAN DAN PERALATAN  SEKRETARIAT', 4),
(80130, 80100, 'SUBBAGIAN PERPUSTAKAAN  SEKRETARIAT', 4),
(80200, 80000, 'BIDANG PENDIDIKAN AKUNTAN', 3),
(80210, 80200, 'SUBBIDANG PENGEMBANGAN BIDANG AKUNTAN', 4),
(80220, 80200, 'SUBBIDANG TATALAKSANA BIDANG AKUNTAN', 4),
(80300, 80000, 'BIDANG PENDIDIKAN AJUN AKUNTAN', 3),
(80310, 80300, 'SUBBIDANG PENGEMBANGAN PENDIDIKAN AJUN AKUNTAN', 4),
(80320, 80300, 'SUBBIDANG TATALAKSANA BIDANG AJUN AKUNTAN', 4),
(80400, 80000, 'BIDANG PENDIDIKAN PEMBANTU AKUNTAN', 3),
(80410, 80400, 'SUBBIDANG PENGEMBANGAN BIDANG PEMBANTU AKUN', 4),
(80420, 80400, 'SUBBIDANG TATALAKSANA BIDANG PEMBANTU AKUNT', 4),
(80500, 80000, 'WIDYAISWARA SEKOLAH TINGGI AKUNTANSI NEGARA', 7),
(81000, 10000, 'PUSDIKLAT KEKAYAAN NEGARA DAN PERIMBANGAN KEUANGAN', 2),
(81100, 81000, 'BIDANG PERENCANAAN DAN PENGEMBANGAN', 3),
(81110, 81100, 'SUBBIDANG PROGRAM DAN TEKNOLOGI', 4),
(81120, 81100, 'SUBBIDANG KURIKULUM DAN METODOLOGI PEMBELAJARAN', 4),
(81130, 81100, 'SUBBIDANG TENAGA PENGAJAR', 4),
(81140, 81100, 'SUBBAGIAN TATA USAHA', 4),
(81200, 81000, 'BIDANG PENYELENGGARAAN', 3),
(81210, 81200, 'SUBBIDANG DIKLAT TEKNIS, FUNGSIONAL, DAN PENATARAN', 4),
(81220, 81200, 'SUBBIDANG DIKLAT SPESIALISASI', 4),
(81300, 81000, 'BIDANG EVALUASI DAN PELAPORAN', 3),
(81310, 81300, 'SUBBIDANG EVALUASI DIKLAT', 4),
(81320, 81300, 'SUBBIDANG PENGOLAHAN HASIL DIKLAT ', 4),
(81330, 81300, 'SUBBIDANG INFORMASI DAN PELAPORAN KINERJA', 4),
(81500, 81000, 'WIDYAISWARA PUSDIKLAT KEKAYAAN NEGARA DAN PERIMBANGAN KEUANGAN', 7),
(90000, 0, 'TIDAK AKTIF BPPK', 2),
(90010, 0, 'BELUM PEGAWAI', 9),
(90020, 0, 'BELUM PAJAK', 9),
(90100, 0, 'TUGAS BELAJAR', 9),
(90200, 0, 'DIPEKERJAKAN', 3),
(90300, 0, 'PROSES DIBERHENTIKAN', 9),
(90400, 0, 'CUTI DI LUAR TANGGUNGAN NEGARA', 9),
(90500, 0, 'DIPERBANTUKAN DARI DJBC', 9),
(90600, 0, 'DIPERBANTUKAN DARI DJP', 9),
(96000, 10000, 'BALAI DIKLAT KEUANGAN PEKANBARU', 3),
(96010, 96000, 'SUBBAGIAN UMUM', 4),
(96020, 96000, 'SEKSI PENYELENGGARAAN', 4),
(96030, 96000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(96100, 96010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(96200, 96010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(96300, 96020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(96400, 96020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(96500, 96000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN PEKANBARU', 7),
(96600, 96030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(96700, 96030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(97000, 10000, 'BALAI DIKLAT KEUANGAN PONTIANAK', 3),
(97010, 97000, 'SUBBAGIAN UMUM', 4),
(97020, 97000, 'SEKSI PENYELENGGARAAN', 4),
(97030, 97000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(97100, 97010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(97200, 97010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(97300, 97020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(97400, 97020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(97500, 97000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN PONTIANAK', 7),
(97600, 97030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(97700, 97030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(98000, 10000, 'BALAI DIKLAT KEUANGAN DENPASAR', 3),
(98010, 98000, 'SUBBAGIAN UMUM', 4),
(98020, 98000, 'SEKSI PENYELENGGARAAN', 4),
(98030, 98000, 'SEKSI EVALUASI DAN INFORMASI', 4),
(98100, 98010, 'TATA USAHA DAN KEUANGAN SEKSI UMUM', 5),
(98200, 98010, 'KEPEGAWAIAN DAN RUMAH TANGGA SEKSI UMUM', 5),
(98300, 98020, 'PENYELENGGARAAN I SEKSI PENYELENGGARAAN', 5),
(98400, 98020, 'PENYELENGGARAAN II SEKSI PENYELENGGARAAN', 5),
(98500, 98000, 'WIDYAISWARA BALAI DIKLAT KEUANGAN DENPASAR', 7),
(98600, 98030, 'EVALUASI SEKSI EVALUASI DAN INFORMASI', 5),
(98700, 98030, 'INFORMASI DAN PELAPORAN KINERJA SEKSI EVALUASI', 5),
(99999, 0, 'LAIN-LAIN', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ref_subject_type`
--

CREATE TABLE IF NOT EXISTS `ref_subject_type` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_subject_type`
--

INSERT INTO `ref_subject_type` (`id`, `name`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, 'MP', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'CERAMAH', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'MFD (MENTAL FISIK DISIPLIN)', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'OJT (ON THE JOB TRAINING)', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_trainer_type`
--

CREATE TABLE IF NOT EXISTS `ref_trainer_type` (
  `id` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_trainer_type`
--

INSERT INTO `ref_trainer_type` (`id`, `name`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, 'PENGAJAR', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'PENCERAMAH', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ASISTEN PENGAJAR', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'TEAM TEACHING', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'INSTRUKTUR MFD', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'ASISTEN INSTRUKTUR MFD', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'PEMBIMBING PKL', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ref_unit`
--

CREATE TABLE IF NOT EXISTS `ref_unit` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortname` varchar(50) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ref_unit`
--

INSERT INTO `ref_unit` (`id`, `name`, `shortname`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(0, '-', '-', 1, NULL, NULL, '2014-04-18 14:03:45', 1, NULL, NULL),
(1, 'Sekretariat Jenderal', 'Setjen', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Inspektorat Jenderal', 'Itjen', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Direktorat Jenderal Anggaran', 'DJA', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Direktorat Jenderal Pajak', 'DJP', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Direktorat Jenderal Bea dan Cukai', 'DJBC', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Direktorat Jenderal Perbendaharaan', 'DJPBn', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Direktorat Jenderal Kekayaan Negara', 'DJKN', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Direktorat Jenderal Perimbangan Keuangan', 'DJPK', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Direktorat Jenderal Pengelolaan Utang', 'DJPU', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Badan Kebijakan Fiskal', 'BKF', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Badan Pengawas Pasar Modal dan Lembaga Keuangan', 'Bapepam-LK', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Badan Pendidikan dan Pelatihan Keuangan', 'BPPK', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Non Kemenkeu', 'Lainnya', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `spg_08_unit_organisasi`
--

CREATE TABLE IF NOT EXISTS `spg_08_unit_organisasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KD_UNIT_ORG` char(10) NOT NULL,
  `KD_UNIT_ES1` char(2) NOT NULL,
  `KD_UNIT_ES2` char(2) NOT NULL,
  `KD_UNIT_ES3` char(2) NOT NULL,
  `KD_UNIT_ES4` char(2) NOT NULL,
  `KD_UNIT_ES5` char(2) NOT NULL,
  `JNS_KANTOR` int(11) NOT NULL,
  `NM_UNIT_ORG` varchar(100) NOT NULL,
  `KD_ESELON` char(2) NOT NULL,
  `KD_SURAT_ORG` varchar(100) NOT NULL,
  `TKT_ESELON` char(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=403 ;

--
-- Dumping data for table `spg_08_unit_organisasi`
--

INSERT INTO `spg_08_unit_organisasi` (`ID`, `KD_UNIT_ORG`, `KD_UNIT_ES1`, `KD_UNIT_ES2`, `KD_UNIT_ES3`, `KD_UNIT_ES4`, `KD_UNIT_ES5`, `JNS_KANTOR`, `NM_UNIT_ORG`, `KD_ESELON`, `KD_SURAT_ORG`, `TKT_ESELON`) VALUES
(1, '1200000001', '12', '00', '00', '00', '01', 1, 'BADAN PENDIDIKAN DAN PELATIHAN KEUANGAN', '1', '', '11'),
(3, '1201000000', '12', '01', '00', '00', '00', 2, 'SEKRETARIAT BADAN', '2', '', '21'),
(4, '1201010000', '12', '01', '01', '00', '00', 2, 'BAGIAN KEPEGAWAIAN', '3', '3', '31'),
(5, '1201010100', '12', '01', '01', '01', '00', 2, 'SUBBAGIAN UMUM KEPEGAWAIAN', '4', '34', '41'),
(6, '1201010201', '12', '01', '01', '02', '01', 2, 'SUBBAGIAN PENGEMBANGAN PEGAWAI', '4', '31', '41'),
(8, '1201010300', '12', '01', '01', '03', '00', 2, 'SUBBAGIAN ADMINISTRASI JABATAN FUNGSIONAL', '4', '32', '41'),
(9, '1201010400', '12', '01', '01', '04', '00', 2, 'SUBBAGIAN KEPATUHAN INTERNAL', '4', '33', '41'),
(10, '1201020002', '12', '01', '02', '00', '02', 2, 'BAGIAN ORGANISASI DAN TATALAKSANA', '3', '2', '31'),
(13, '1201020102', '12', '01', '02', '01', '02', 2, 'SUBBAGIAN ORGANISASI', '4', '', '41'),
(16, '1201020202', '12', '01', '02', '02', '02', 2, 'SUBBAGIAN TATALAKSANA', '4', '', '41'),
(19, '1201020302', '12', '01', '02', '03', '02', 2, 'SUBBAGIAN HUKUM DAN KERJASAMA', '4', '', '41'),
(22, '1201030000', '12', '01', '03', '00', '00', 2, 'BAGIAN KEUANGAN', '3', '', '31'),
(23, '1201030100', '12', '01', '03', '01', '00', 2, 'SUBBAGIAN PENYUSUNAN ANGGARAN', '4', '', '41'),
(24, '1201030201', '12', '01', '03', '02', '01', 2, 'SUBBAGIAN PERBENDAHARAAN', '4', '', '41'),
(26, '1201030302', '12', '01', '03', '03', '02', 2, 'SUBBAGIAN AKUNTANSI DAN PELAPORAN', '4', '', '41'),
(29, '1201040003', '12', '01', '04', '00', '03', 2, 'BAGIAN TEKNOLOGI DAN INFORMASI KOMUNIKASI', '3', '', '31'),
(33, '1201040103', '12', '01', '04', '01', '03', 2, 'SUBBAGIAN SISTEM INFORMASI', '4', '', '41'),
(37, '1201040203', '12', '01', '04', '02', '03', 2, 'SUBBAGIAN KOMUNIKASI PUBLIK', '4', '', '41'),
(41, '1201040302', '12', '01', '04', '03', '02', 2, 'SUBBAGIAN DUKUNGAN TEKNIS', '4', '', '41'),
(44, '1201050000', '12', '01', '05', '00', '00', 2, 'BAGIAN UMUM', '3', '', '31'),
(45, '1201050101', '12', '01', '05', '01', '01', 2, 'SUBBAGIAN TATA USAHA', '4', '', '41'),
(47, '1201050202', '12', '01', '05', '02', '02', 2, 'SUBBAGIAN PENGELOLAAN ASET', '4', '', '41'),
(50, '1201050302', '12', '01', '05', '03', '02', 2, 'SUBBAGIAN RUMAH TANGGA', '4', '', '41'),
(56, '1202000002', '12', '02', '00', '00', '02', 3, 'Pusdiklat Pengembangan Sumber Daya Manusia', '2', '', '21'),
(59, '1202010001', '12', '02', '01', '00', '01', 3, 'Bagian Tata Usaha', '3', '', '31'),
(61, '1202010101', '12', '02', '01', '01', '01', 3, 'Subbagian Tata Usaha, Kepegawaian Dan Hubungan Masyarakat', '4', '', '41'),
(63, '1202010201', '12', '02', '01', '02', '01', 3, 'Subbagian Perencanaan Dan Keuangan', '4', '', '41'),
(65, '1202010301', '12', '02', '01', '03', '01', 3, 'Subbagian Rumah Tangga Dan Pengelolaan Aset', '4', '', '41'),
(66, '1202020000', '12', '02', '02', '00', '00', 3, 'Bidang Penjenjangan Pangkat Dan Peningkatan Kompetensi', '3', '', '31'),
(67, '1202020100', '12', '02', '02', '01', '00', 3, 'Subbidang Perencanaan Dan Pengembangan', '4', '', '41'),
(68, '1202020200', '12', '02', '02', '02', '00', 3, 'Subbidang Penyelenggaraan', '4', '', '41'),
(69, '1202020300', '12', '02', '02', '03', '00', 3, 'Subbidang Evaluasi Dan Pelaporan Kinerja', '4', '', '41'),
(70, '1202030000', '12', '02', '03', '00', '00', 3, 'Bidang Pengelolaan Tes Terpadu', '3', '', '31'),
(71, '1202030100', '12', '02', '03', '01', '00', 3, 'Subbidang Perencanaan Tes', '4', '', '41'),
(72, '1202030200', '12', '02', '03', '02', '00', 3, 'Subbidang Penyelenggaraan Tes', '4', '', '41'),
(73, '1202030300', '12', '02', '03', '03', '00', 3, 'Subbidang Evaluasi Hasil Tes', '4', '', '41'),
(76, '1202040002', '12', '02', '04', '00', '02', 3, 'Bidang Pengelolaan Beasiswa', '3', '', '31'),
(79, '1202040102', '12', '02', '04', '01', '02', 3, 'Subbidang Perencanaan Beasiswa', '4', '', '41'),
(81, '1202040201', '12', '02', '04', '02', '01', 3, 'Subbidang Seleksi Dan Penempatan', '4', '', '41'),
(82, '1202040300', '12', '02', '04', '03', '00', 3, 'Subbidang Pemantauan', '4', '', '41'),
(83, '1202050000', '12', '02', '05', '00', '00', 3, 'Balai Diklat Kepemimpinan', '3', '', '31'),
(84, '1202050101', '12', '02', '05', '01', '01', 3, 'Subbagian Tata Usaha Dan Kepatuhan Internal', '4', '', '41'),
(86, '1202050200', '12', '02', '05', '02', '00', 3, 'Seksi Penyelenggaraan', '4', '', '41'),
(87, '1202050300', '12', '02', '05', '03', '00', 3, 'Seksi Evaluasi Dan Informasi', '4', '', '41'),
(343, '1200010002', '12', '00', '01', '00', '02', 10, 'Balai Pendidikan Dan Pelatihan Keuangan', '3', '', '31'),
(345, '1200010101', '12', '00', '01', '01', '01', 10, 'Subbagian Tata Usaha Dan Kepatuhan Internal', '4', '', '41'),
(346, '1200010200', '12', '00', '01', '02', '00', 10, 'Seksi Penyelenggaraan', '4', '', '41'),
(347, '1200010300', '12', '00', '01', '03', '00', 10, 'Seksi Evaluasi Dan Informasi', '4', '', '41'),
(348, '1208000000', '12', '08', '00', '00', '00', 9, 'SEKOLAH TINGGI AKUNTANSI NEGARA', '2', '', '21'),
(349, '1208010000', '12', '08', '01', '00', '00', 9, 'SEKRETARIAT SEKOLAH TINGGI AKUNTANSI NEGARA', '3', '', '31'),
(350, '1208010200', '12', '08', '01', '02', '00', 9, 'SUBBAGIAN TATA USAHA DAN KEUANGAN', '4', '', '41'),
(351, '1208010100', '12', '08', '01', '01', '00', 9, 'SUBBAGIAN KEPEGAWAIAN DAN PERALATAN', '4', '', '41'),
(352, '1208010300', '12', '08', '01', '03', '00', 9, 'SUBBAGIAN PERALATAN', '4', '', '41'),
(353, '1208020000', '12', '08', '02', '00', '00', 9, 'BIDANG AKADEMIS PENDIDIKAN PEMBANTU AKUNTAN', '3', '', '31'),
(354, '1208020100', '12', '08', '02', '01', '00', 9, 'SUBBIDANG TATA LAKSANA PEMBANTU AKUNTAN', '4', '', '41'),
(355, '1208020200', '12', '08', '02', '02', '00', 9, 'SUBBIDANG PENGEMBANGAN PEMBANTU AKUNTAN', '4', '', '41'),
(356, '1208030000', '12', '08', '03', '00', '00', 9, 'BIDANG AKADEMIS PENDIDIKAN AJUN AKUNTAN', '3', '', '31'),
(357, '1208030100', '12', '08', '03', '01', '00', 9, 'SUBBIDANG TATA LAKSANA AJUN AKUNTAN', '4', '', '41'),
(358, '1208030200', '12', '08', '03', '02', '00', 9, 'SUBBIDANG PENGEMBANGAN AJUN AKUNTAN', '4', '', '41'),
(359, '1208040000', '12', '08', '04', '00', '00', 9, 'BIDANG AKADEMIS PENDIDIKAN AKUNTAN', '3', '', '31'),
(360, '1208040100', '12', '08', '04', '01', '00', 9, 'SUBBIDANG TATA LAKSANA AKUNTAN', '4', '', '41'),
(361, '1208040200', '12', '08', '04', '02', '00', 9, 'SUBBIDANG PENGEMBANGAN AKUNTAN', '4', '', '41'),
(387, '1213000000', '12', '13', '00', '00', '00', 13, 'Pusat Pendidikan dan Pelatihan', '2', '', '21'),
(388, '1213010000', '12', '13', '01', '00', '00', 13, 'Bagian Tata Usaha', '3', '', '31'),
(389, '1213010100', '12', '13', '01', '01', '00', 13, 'Subbagian Tata Usaha, Kepegawaian Dan Hubungan Masyarakat', '4', '', '41'),
(390, '1213010200', '12', '13', '01', '02', '00', 13, 'Subbagian Perencanaan Dan Keuangan', '4', '', '41'),
(391, '1213010300', '12', '13', '01', '03', '00', 13, 'Subbagian Rumah Tangga Dan Pengelolaan Aset', '4', '', '41'),
(392, '1213020000', '12', '13', '02', '00', '00', 13, 'Bidang Perencanaan dan Pengembangan Diklat', '3', '', '31'),
(393, '1213020100', '12', '13', '02', '01', '00', 13, 'Subbidang Program', '4', '', '41'),
(394, '1213020200', '12', '13', '02', '02', '00', 13, 'Subbidang Kurikulum', '4', '', '41'),
(395, '1213020300', '12', '13', '02', '03', '00', 13, 'Subbidang Tenaga Pengajar', '4', '', '41'),
(396, '1213030000', '12', '13', '03', '00', '00', 13, 'Bidang Penyelenggaraan', '3', '', '31'),
(397, '1213030100', '12', '13', '03', '01', '00', 13, 'Subbidang Penyelenggaraan I', '4', '', '41'),
(398, '1213030200', '12', '13', '03', '02', '00', 13, 'Subbidang Penyelenggaraan II', '4', '', '41'),
(399, '1213040000', '12', '13', '04', '00', '00', 13, 'Bidang Evaluasi dan Pelaporan Kinerja', '3', '', '31'),
(400, '1213040100', '12', '13', '04', '01', '00', 13, 'Subbidang Evaluasi Diklat', '4', '', '41'),
(401, '1213040200', '12', '13', '04', '02', '00', 13, 'Subbidang Pengolahan Hasil Diklat', '4', '', '41'),
(402, '1213040300', '12', '13', '04', '03', '00', 13, 'Subbidang Informasi Dan Pelaporan Kinerja', '4', '', '41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_activity_room`
--

CREATE TABLE IF NOT EXISTS `tb_activity_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(3) NOT NULL COMMENT '0=DIKLAT',
  `activity_id` int(11) NOT NULL,
  `tb_room_id` int(11) NOT NULL,
  `startTime` datetime NOT NULL,
  `finishTime` datetime NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '0=Waiting, 1=Process, 2=Approved, 3=Rejected',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_room_id` (`tb_room_id`),
  KEY `tb_training_id` (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_activity_room`
--

INSERT INTO `tb_activity_room` (`id`, `type`, `activity_id`, `tb_room_id`, `startTime`, `finishTime`, `note`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`) VALUES
(3, 0, 9, 1, '2014-08-27 08:00:00', '2014-08-28 17:00:00', NULL, 2, '2014-09-06 10:05:32', 1, '2014-09-06 10:05:32', 1),
(5, 0, 8, 2, '2014-08-19 08:00:00', '2014-08-27 17:00:00', NULL, 2, '2014-09-08 09:43:29', 1, '2014-09-08 09:43:29', 1),
(6, 0, 8, 4, '2014-08-19 08:00:00', '2014-08-27 17:00:00', NULL, 2, '2014-09-08 09:45:09', 1, '2014-09-08 09:45:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_level_id` int(3) NOT NULL DEFAULT '0',
  `ref_satker_id` int(3) NOT NULL,
  `tb_employee_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_admin_tb_employee1` (`tb_employee_id`),
  KEY `fk_tb_admin_ref_level1` (`ref_level_id`),
  KEY `fk_tb_admin_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_authassignment`
--

CREATE TABLE IF NOT EXISTS `tb_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_authassignment`
--

INSERT INTO `tb_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `tb_authitem`
--

CREATE TABLE IF NOT EXISTS `tb_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_authitem`
--

INSERT INTO `tb_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `tb_authitemchild`
--

CREATE TABLE IF NOT EXISTS `tb_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_employee`
--

CREATE TABLE IF NOT EXISTS `tb_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_satker_id` int(3) NOT NULL DEFAULT '0',
  `ref_unit_id` int(3) NOT NULL DEFAULT '0',
  `ref_religion_id` int(3) NOT NULL DEFAULT '0',
  `ref_rank_class_id` int(3) NOT NULL DEFAULT '0',
  `ref_graduate_id` int(3) NOT NULL DEFAULT '0',
  `ref_sta_unit_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL,
  `nickName` varchar(50) DEFAULT NULL,
  `frontTitle` varchar(20) DEFAULT NULL,
  `backTitle` varchar(20) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `born` varchar(50) DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1',
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `married` tinyint(1) DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `blood` varchar(10) DEFAULT '-',
  `position` int(1) DEFAULT '5' COMMENT '[1:Es1;2:Es2;3:Es3;4:Es4;5:Pelaksana]',
  `positionDesc` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `officePhone` varchar(50) DEFAULT NULL,
  `officeFax` varchar(50) DEFAULT NULL,
  `officeEmail` varchar(100) DEFAULT NULL,
  `officeAddress` varchar(255) DEFAULT NULL,
  `document1` varchar(255) DEFAULT NULL COMMENT 'SK CPNS',
  `document2` varchar(255) DEFAULT NULL COMMENT 'SK JABATAN TERAKHIR',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `bio` text,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_employee_ref_satker1` (`ref_satker_id`),
  KEY `fk_tb_employee_ref_unit1` (`ref_unit_id`),
  KEY `fk_tb_employee_ref_religion1` (`ref_religion_id`),
  KEY `fk_tb_employee_ref_rank_class1` (`ref_rank_class_id`),
  KEY `fk_tb_employee_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_employee_ref_sta_unit1` (`ref_sta_unit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `ref_satker_id`, `ref_unit_id`, `ref_religion_id`, `ref_rank_class_id`, `ref_graduate_id`, `ref_sta_unit_id`, `name`, `nickName`, `frontTitle`, `backTitle`, `nip`, `born`, `birthDay`, `gender`, `phone`, `email`, `address`, `married`, `photo`, `blood`, `position`, `positionDesc`, `education`, `officePhone`, `officeFax`, `officeEmail`, `officeAddress`, `document1`, `document2`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `user_id`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `bio`, `website`) VALUES
(1, 3, 0, 0, 0, 0, 10000, 'Hafid Mukhlasin', 'Hafid', 'Dr', 'MIT', '198604302009011002', 'Jember', '2014-04-11', 1, '081559915720', 'milisstudio@gmail.com', '', 1, '', '-', 0, NULL, '', '', '', '', '', '', '', 1, NULL, NULL, '2014-08-11 16:16:00', 1, NULL, NULL, 1, 'haasfasfasfis@gmail.com', '', 'd41d8cd98f00b204e9800998ecf8427e', 'asdasdasd', '', 'http://hasdasdasdafis.com'),
(2, 2, 0, 0, 0, 0, 1, 'psdm', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, '-', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-04 14:46:14', 1, '2014-09-04 14:46:15', 1, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_meeting`
--

CREATE TABLE IF NOT EXISTS `tb_meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_satker_id` int(3) NOT NULL,
  `executor` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startTime` datetime NOT NULL,
  `finishTime` datetime NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `attendanceCount` int(5) DEFAULT NULL,
  `classCount` int(3) DEFAULT NULL,
  `hostel` tinyint(1) DEFAULT '0' COMMENT 'diasramakan',
  `location` varchar(255) DEFAULT '-',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tb_meeting`
--

INSERT INTO `tb_meeting` (`id`, `ref_satker_id`, `executor`, `name`, `startTime`, `finishTime`, `note`, `attendanceCount`, `classCount`, `hostel`, `location`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 3, 'GENERAL3', 'RAPAT PEMBAHASAN SIM BPPK', '2014-09-03 08:20:31', '2014-09-04 14:20:31', '', 20, 1, 0, '', 1, '2014-09-03 14:21:07', 1, '2014-09-03 14:22:33', 1, NULL, NULL),
(2, 3, 'GENERAL3', 'RAPAT MANAJEMEN MUTU', '2014-09-03 08:25:17', '2014-09-04 14:25:17', '', NULL, 1, 0, '', 1, '2014-09-03 14:25:45', 1, '2014-09-03 14:27:05', 1, NULL, NULL),
(3, 2, 'GENERAL3', 'RAPAT PEMBUBARAN BPPK (DARI PSDM)', '2014-09-03 06:05:28', '2014-09-05 06:30:28', '', NULL, 1, 0, '', 0, '2014-09-03 15:05:51', 1, '2014-09-03 16:41:39', 1, NULL, NULL),
(4, 3, 'GENERAL3', 'RAPAT APLIKASI', '2014-09-03 10:30:38', '2014-09-04 06:30:38', '', NULL, 1, 0, 'PUSDIKLAT', 1, '2014-09-03 15:31:02', 1, '2014-09-03 15:34:29', 1, NULL, NULL),
(5, 3, 'GENERAL3', 'Rapat Pembahasan Identifikasi Diklat ', '2014-09-05 09:00:06', '2014-09-05 12:00:06', 'Ruangannya yang dingin ya...', 50, 1, 0, 'Pusidklat KU', 1, '2014-09-04 14:03:48', 1, '2014-09-04 14:03:48', 1, NULL, NULL),
(6, 3, 'GENERAL3', 'Rapat Persiapan Diklat', '2014-09-05 10:00:53', '2014-09-05 10:00:53', '', NULL, 1, 0, 'Pusdiklat KU', 1, '2014-09-04 14:16:19', 1, '2014-09-04 14:16:19', 1, NULL, NULL),
(7, 3, 'GENERAL3', 'Rapat Fajar', '2014-09-05 09:20:09', '2014-09-05 14:20:09', '', NULL, 1, 0, '', 1, '2014-09-04 14:24:47', 1, '2014-09-04 14:24:47', 1, NULL, NULL),
(8, 3, 'GENERAL3', 'Rapat Hafid', '2014-09-05 14:55:43', '2014-09-05 17:55:43', '', NULL, 1, 0, '', 1, '2014-09-04 14:27:12', 1, '2014-09-04 14:27:12', 1, NULL, NULL),
(9, 2, 'GENERAL3', 'Rapat Keuangan', '2014-09-05 13:00:48', '2014-09-05 16:00:48', '', 30, 2, 0, 'Pusdiklat AP', 1, '2014-09-04 14:58:55', 2, '2014-09-04 15:00:28', 2, NULL, NULL),
(10, 3, 'GENERAL3', 'Ok', '2014-09-04 06:30:15', '2014-09-04 03:15:15', '', NULL, 1, 0, '2', 1, '2014-09-04 16:34:04', 1, '2014-09-05 06:49:25', 1, NULL, NULL),
(11, 3, 'GENERAL3', 'Rapat XXX', '2014-09-05 07:35:40', '2014-09-05 15:35:40', '', NULL, 1, 0, '3', 1, '2014-09-05 07:24:04', 1, '2014-09-05 08:43:32', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_message`
--

CREATE TABLE IF NOT EXISTS `tb_message` (
  `id` bigint(33) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `priority` int(1) DEFAULT '0' COMMENT '0:normal;1:s; 2:ss',
  `subject` varchar(255) NOT NULL,
  `messages` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification`
--

CREATE TABLE IF NOT EXISTS `tb_notification` (
  `id` bigint(33) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `type` int(1) DEFAULT '0' COMMENT '0:info, 1:warning, 2:danger',
  `messages` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE IF NOT EXISTS `tb_program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_satker_id` int(3) NOT NULL DEFAULT '0',
  `number` varchar(15) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `hours` decimal(5,2) DEFAULT NULL,
  `days` int(3) DEFAULT NULL,
  `test` tinyint(1) DEFAULT '0',
  `type` tinyint(1) DEFAULT NULL COMMENT 'tipe kelulusan (lulus/mengikuti)',
  `note` varchar(255) DEFAULT NULL,
  `validationStatus` tinyint(1) DEFAULT '0',
  `validationNote` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL COMMENT 'rumpun',
  `stage` varchar(100) NOT NULL COMMENT 'jenjang',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_program_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id`, `ref_satker_id`, `number`, `name`, `hours`, `days`, `test`, `type`, `note`, `validationStatus`, `validationNote`, `category`, `stage`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI XX', '9.99', NULL, 0, 0, '', 0, '', '', '', 0, '2014-08-15 14:05:05', 1, '2014-08-15 14:08:27', 1, NULL, NULL),
(4, 3, '', 'PRANATA KOMPUTER AHLI', '6.00', 2, 1, 0, '', 0, '', '', '', 1, '2014-08-20 09:42:32', 1, '2014-09-03 11:17:33', 1, NULL, NULL),
(5, 3, '1.0.0.0', 'Diklat Prajabatan Golongan III', '100.00', 20, 1, 0, '', 0, NULL, '', '', 1, '2014-08-26 14:02:09', 1, '2014-08-26 14:02:09', 1, NULL, NULL),
(7, 3, '2.2.2.0', 'Diklat Manajemen Rumah Tangga', '24.00', 3, 1, 1, '', 0, NULL, 'DTSD', '', 1, '2014-09-17 11:24:52', 1, '2014-09-17 11:40:26', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_document`
--

CREATE TABLE IF NOT EXISTS `tb_program_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_id` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_program_document_tb_program1` (`tb_program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_program_document`
--

INSERT INTO `tb_program_document` (`id`, `tb_program_id`, `revision`, `name`, `type`, `filename`, `description`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 4, 0, 'HALO', 'GBPP', '53f415ef836fb.pdf', '', 0, '2014-08-20 10:28:47', 1, '2014-08-22 07:47:02', 1, NULL, NULL),
(4, 4, 1, 'KAP', 'KAP', '53f58709a5068.png', '', 1, '2014-08-21 12:43:37', 1, '2014-08-21 12:43:37', 1, NULL, NULL),
(5, 4, 1, 'HAHA', 'GBPP', '53f58735360fa.jpg', '', 1, '2014-08-21 12:44:21', 1, '2014-08-21 12:44:21', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_history`
--

CREATE TABLE IF NOT EXISTS `tb_program_history` (
  `tb_program_id` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `ref_satker_id` int(3) NOT NULL DEFAULT '0',
  `number` varchar(15) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `hours` decimal(5,2) DEFAULT NULL,
  `days` int(3) DEFAULT NULL,
  `test` tinyint(1) DEFAULT '0',
  `type` int(1) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `validationStatus` tinyint(1) DEFAULT '0',
  `validationNote` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL COMMENT 'rumpun',
  `stage` varchar(100) NOT NULL COMMENT 'jenjang',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tb_program_id`,`revision`),
  KEY `fk_tb_program_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_program_history`
--

INSERT INTO `tb_program_history` (`tb_program_id`, `revision`, `ref_satker_id`, `number`, `name`, `hours`, `days`, `test`, `type`, `note`, `validationStatus`, `validationNote`, `category`, `stage`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 0, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI', '100.00', NULL, 0, 0, '', 0, '', '', '', 0, '2014-08-15 14:05:05', 1, '2014-08-15 14:07:56', 1, NULL, NULL),
(3, 1, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI XX', '100.00', NULL, 0, 0, '', 0, '', '', '', 0, '2014-08-15 14:08:27', 1, '2014-08-15 14:08:27', 1, NULL, NULL),
(4, 0, 3, '', 'PRANATA KOMPUTER AHLI', '6.00', NULL, 0, 0, '', 0, '', '', '', 1, '2014-08-20 09:42:32', 1, '2014-09-01 16:30:36', 1, NULL, NULL),
(4, 1, 3, '2.2.1.0', 'PRANATA KOMPUTER AHLI', NULL, NULL, 0, 0, '', 0, '', '', '', 1, '2014-08-20 16:00:26', 1, '2014-08-20 16:00:26', 1, NULL, NULL),
(4, 2, 3, '2.2.1.0', 'PRANATA KOMPUTER AHLI', '6.00', 2, 1, 0, '', 0, '', '', '', 1, '2014-09-03 11:17:33', 1, '2014-09-03 11:17:33', 1, NULL, NULL),
(5, 0, 3, '1.0.0.0', 'Diklat Prajabatan Golongan III', '100.00', 20, 1, 0, '', NULL, NULL, '', '', 1, '2014-08-26 14:02:09', 1, '2014-08-26 14:02:09', 1, NULL, NULL),
(7, 0, 3, '2.2.2.0', 'Diklat Manajemen Rumah Tangga', '24.00', 3, 1, 1, '', 0, NULL, 'DTSD', '', 1, '2014-09-17 11:24:52', 1, '2014-09-17 11:40:26', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_subject`
--

CREATE TABLE IF NOT EXISTS `tb_program_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_id` int(11) NOT NULL,
  `ref_subject_type_id` int(3) NOT NULL COMMENT '1: MP;2: CERAMAH;3:OJT;4:MFD;',
  `name` varchar(255) NOT NULL,
  `hours` decimal(5,2) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `sort` int(3) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_program_subject_tb_program1` (`tb_program_id`),
  KEY `ref_subject_type_id` (`ref_subject_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_program_subject`
--

INSERT INTO `tb_program_subject` (`id`, `tb_program_id`, `ref_subject_type_id`, `name`, `hours`, `sort`, `test`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 4, 0, 'PHP', '30.00', 1, 1, 1, '2014-08-20 13:20:57', 1, '2014-09-08 06:03:32', 1, NULL, NULL),
(2, 4, 0, 'MYSQL', '10.00', 2, 1, 1, '2014-09-08 04:06:58', 1, '2014-09-08 06:04:55', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_subject_document`
--

CREATE TABLE IF NOT EXISTS `tb_program_subject_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_subject_id` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_program_document_tb_program1` (`tb_program_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_program_subject_document`
--

INSERT INTO `tb_program_subject_document` (`id`, `tb_program_subject_id`, `revision`, `name`, `type`, `filename`, `description`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 1, 0, 'Bahan Ajar', 'Oke', '53f44c7b05874.pdf', '', 1, '2014-08-20 14:21:31', 1, '2014-08-22 08:04:46', 1, NULL, NULL),
(2, 1, 0, 'CMS', 'Oke', '53f45af108653.pdf', '', 0, '2014-08-20 15:23:13', 1, '2014-08-22 07:48:34', 1, NULL, NULL),
(3, 1, 1, 'Hahahahaah', 'Ok', '53f4641190ebe.pdf', '', 0, '2014-08-20 16:02:09', 1, '2014-08-22 08:03:27', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_subject_history`
--

CREATE TABLE IF NOT EXISTS `tb_program_subject_history` (
  `tb_program_subject_id` int(11) NOT NULL,
  `tb_program_id` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `ref_subject_type_id` int(3) NOT NULL COMMENT '1: MP;2: CERAMAH;3:OJT;4:MFD;',
  `name` varchar(255) NOT NULL,
  `hours` decimal(5,2) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `sort` int(3) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tb_program_subject_id`,`tb_program_id`,`revision`),
  KEY `fk_tb_program_subject_tb_program1` (`tb_program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_program_subject_history`
--

INSERT INTO `tb_program_subject_history` (`tb_program_subject_id`, `tb_program_id`, `revision`, `ref_subject_type_id`, `name`, `hours`, `sort`, `test`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 4, 0, 0, 'PHP', '30.00', 1, 1, 1, '2014-08-20 13:20:57', 1, '2014-09-08 06:02:14', 1, NULL, NULL),
(1, 4, 1, 0, 'PHP', '9.99', 0, 0, 1, '2014-08-20 16:00:27', 1, '2014-08-20 16:00:27', 1, NULL, NULL),
(1, 4, 2, 0, 'PHP', '30.00', 1, 1, 1, '2014-08-20 13:20:57', 1, '2014-09-08 06:03:32', 1, NULL, NULL),
(2, 4, 2, 0, 'MYSQL', '10.00', 2, 1, 1, '2014-09-08 04:06:58', 1, '2014-09-08 06:04:55', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_relation`
--

CREATE TABLE IF NOT EXISTS `tb_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` varchar(255) NOT NULL,
  `object_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '1-3:GENERAL;4-6:PLANNING;7-8:EXECUTION;9-11:EVALUATION;12:WIDYAISWARA',
  `value` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_pic_tb_training1` (`object`),
  KEY `fk_tb_training_pic_tb_admin1` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_room`
--

CREATE TABLE IF NOT EXISTS `tb_room` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `ref_satker_id` int(3) NOT NULL DEFAULT '0',
  `code` varchar(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(5) DEFAULT '30' COMMENT 'SISWA',
  `owner` tinyint(1) DEFAULT '1' COMMENT '1:SATKER ; 0: BUKAN SATKER',
  `computer` tinyint(1) DEFAULT '0',
  `hostel` tinyint(1) DEFAULT '0',
  `address` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_tb_room_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_room`
--

INSERT INTO `tb_room` (`id`, `ref_satker_id`, `code`, `name`, `capacity`, `owner`, `computer`, `hostel`, `address`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 3, 'RB01', 'RUANG RAPAT GEDUNG B KELAS 01', 30, 1, 0, 0, '', 1, '2014-09-01 14:54:32', 1, '2014-09-03 13:36:56', 1, NULL, NULL),
(2, 3, 'RF01', 'RUANG RAPAT GEDUNG F KELAS 01', 30, 1, 0, 0, '', 1, '2014-09-01 16:02:42', 1, '2014-09-03 13:44:09', 1, NULL, NULL),
(4, 2, 'A1', 'Gedung A Lt. 1', 60, 1, 1, 0, 'Jl. Bintaro', 1, '2014-09-04 14:51:58', 2, '2014-09-04 14:51:58', 2, NULL, NULL),
(5, 2, 'A12', 'Gedung A Lt.1 Ruang 2', 40, 1, 0, 0, 'Jl. Bintaro', 1, '2014-09-04 14:53:39', 2, '2014-09-04 14:53:39', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_satker_pic`
--

CREATE TABLE IF NOT EXISTS `tb_satker_pic` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'tb_pic = untuk menyimpan data pejabat misal PPK, KAPUS, dsb',
  `ref_satker_id` int(3) NOT NULL,
  `code` varchar(25) NOT NULL COMMENT 'PUSDIKLAT: KAPUS,KPA,PPK,BENDAHARA##BDK:KABDK,KPA,PPK,BENDAHARA##PSDM:KAPUS,KPA,PPK,BENDAHARA',
  `name` varchar(255) DEFAULT NULL,
  `value` int(11) DEFAULT '30',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_tb_satker_pic_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `password_hash` varchar(60) DEFAULT NULL,
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
  `position` int(1) DEFAULT NULL COMMENT '[1:Es1;2:Es2;3:Es3;4:Es4;5:Pelaksana]',
  `positionDesc` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `eselon2` varchar(100) DEFAULT NULL,
  `eselon3` varchar(100) DEFAULT NULL,
  `eselon4` varchar(100) DEFAULT NULL,
  `satker` enum('1','2','3','4') DEFAULT '1',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`id`, `ref_religion_id`, `ref_graduate_id`, `ref_rank_class_id`, `ref_unit_id`, `name`, `nickName`, `frontTitle`, `backTitle`, `nip`, `password_hash`, `auth_key`, `born`, `birthDay`, `gender`, `phone`, `email`, `address`, `married`, `photo`, `blood`, `position`, `positionDesc`, `education`, `eselon2`, `eselon3`, `eselon4`, `satker`, `officePhone`, `officeFax`, `officeEmail`, `officeAddress`, `noSKPangkat`, `tmtSKPangkat`, `fileSKPangkat`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(53, 0, 8, 0, 1, 'Ageng Budi Widiarto', '', '', '', '198606052007011002', '$2y$13$Qc2nFRDHOVIQwE/vCVnoC.VErptMtJ0VQIGTKSiYQrpWlD9ZRnK4e', '4v-TJRygsMJ-SfHu8elBQ7ow7bYSMvGh', '', '1986-06-05', 1, '', '', '', 0, '541a7d6e50479.png', '', 4, 'Kasubbag TI', 'TI ITB', '', '', '', '1', '', '', '', '', '', NULL, '541a7c4421a2a.pdf', 1, '2014-09-10 17:05:50', 1, '2014-09-18 13:36:30', 1, NULL, NULL),
(54, 0, 0, 0, 0, 'Agung Nana Permana', NULL, NULL, NULL, '197305071993011001', '$2y$13$iwdErYh.F40Zq2w7wPoEJuONAoj7G.sPiCNef6rIU5iP0wCjtvAYC', '9JeGrsXp0e2y4KWida47q0UH1p00ck0t', NULL, '1973-05-07', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:52', 1, '2014-09-10 17:05:52', 1, NULL, NULL),
(55, 0, 0, 0, 0, 'Andre Harahap', NULL, NULL, NULL, '198704302008121003', '$2y$13$x9Jvdyt4YJDFtF8ufxZ5au5YYr6ncMz8sv0FaYy9QwKSuq0sPmBF.', 't0HKucxD4OXLl52qf9-VU8LSCBTGhMXF', NULL, '1987-04-30', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:53', 1, '2014-09-10 17:05:53', 1, NULL, NULL),
(56, 0, 0, 0, 0, 'Anne Akbari N. H. C.', NULL, NULL, NULL, '196501011985032003', '$2y$13$FGbL5pQIWSIfHVxAarIP4e3QkYbXrmZch9cc5B92uMgq1pWukc0wG', 'zr8yHFpfBd6VACOaQfN7HiLxMnYG_6XS', NULL, '1965-01-01', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:54', 1, '2014-09-10 17:05:54', 1, NULL, NULL),
(57, 0, 0, 0, 0, 'Armanzah', NULL, NULL, NULL, '196712111988021001', '$2y$13$24pdUYTpD2Q1rumKKTL28.MShFt1rmxAPqs/le72GIrSf3jWBI3um', 'qz8K3iAbnbqx0sDLCjHdV_9DI4xP9dik', NULL, '1967-12-11', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:55', 1, '2014-09-10 17:05:55', 1, NULL, NULL),
(58, 0, 0, 0, 0, 'Bahrahmat Simamora', NULL, NULL, NULL, '197704291998031002', '$2y$13$wvAFnrHmB7aqQzhRWuDg.OYmTPYc/sEeKYPDNSF9vAbxrZdF9kemW', 's9BqFC4MiN2WKfAhzS07h7-0HcBVASY4', NULL, '1977-04-29', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:56', 1, '2014-09-10 17:05:56', 1, NULL, NULL),
(59, 0, 0, 0, 0, 'Dedyn Budi Prayoga', NULL, NULL, NULL, '196312281985031001', '$2y$13$pOf4ydL9/.0f5hIWMSfNfuCEp5.dMjKR9Ib17BH.zL/Yz2F3dxrDW', 'q7pSF5u8P05nzi3Y3F3qKDcy7Ls9vd3p', NULL, '1963-12-28', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:57', 1, '2014-09-10 17:05:57', 1, NULL, NULL),
(60, 0, 0, 0, 0, 'Didy Supriyadi', NULL, NULL, NULL, '197404131994031002', '$2y$13$VUL93RQP8GE/NQ/ZiHhmLO2jVkFncvbH8UiWSw1tQ3Q9jkGwhRvhe', 'zzh1ikwoVzKezxSDxGSDYJzI6vHaJZC_', NULL, '1974-04-13', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:58', 1, '2014-09-10 17:05:58', 1, NULL, NULL),
(61, 0, 0, 0, 0, 'Dody Widayanto', NULL, NULL, NULL, '198201062009011008', '$2y$13$1KYzdJtoTOqfxkkEASbS2uBjv/7GIXv8znfrsB0jKUXjOMXgKxanu', 'qtWBO1ct4JXknbHvcPaBbeLYpTRbTplt', NULL, '1982-01-06', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:05:59', 1, '2014-09-10 17:05:59', 1, NULL, NULL),
(62, 0, 0, 0, 0, 'Dwian Widyati Haristyani', NULL, NULL, NULL, '196704121992012001', '$2y$13$J6S.wC3j29.f6nfSB4D/JOwDXvazOSxJxUG4T1Uaj67jbzJoh5NBO', 'kjOfg-DwSJjo2G41ywrB3EaJXtAabopO', NULL, '1967-04-12', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:00', 1, '2014-09-10 17:06:00', 1, NULL, NULL),
(63, 0, 0, 0, 0, 'Edy Setiawan', NULL, NULL, NULL, '197802272000011003', '$2y$13$jC0pcJP.CJ5cZANNSMl2KO.lx3q56oEJ59.26gpIEEPM6UTqKoYe2', 'iJJW4ANX4hDnfpGUD3API-z-PpmsXcrs', NULL, '1978-02-27', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:01', 1, '2014-09-10 17:06:01', 1, NULL, NULL),
(64, 0, 0, 0, 0, 'Edy Susanto', NULL, NULL, NULL, '197406011998031001', '$2y$13$Ejw3trsWFssM1VHm2pA4X.7VBKNmHxeyAaWWL4idUODVjltLUrVZS', '0mOwiMpOLZfe_L-B1l1xcYEbezi9CenF', NULL, '1974-06-01', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:02', 1, '2014-09-10 17:06:02', 1, NULL, NULL),
(65, 0, 0, 0, 0, 'Fathonatan Dewi Nastiti', NULL, NULL, NULL, '197307021998032001', '$2y$13$RRRpkpXyW8xivQvx66bYQeQmtbn8iBs7juZOA1DdeTEaredAvOajS', '_f-r5lW4Da9hRm7ejh8Wwfgo0ma4Ow6u', NULL, '1973-07-02', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:02', 1, '2014-09-10 17:06:02', 1, NULL, NULL),
(66, 0, 0, 0, 0, 'Ferdy Alfonsus Sihotang', NULL, NULL, NULL, '196911291996031002', '$2y$13$izSIOExt9JRqFxQgVM9tD.nQ.WYJfAkm1Vn4jIPWmgkg8kl7JQhPm', 'VG1K7_sk53oyvz7KU5c7kMYKjwriYjsU', NULL, '1969-11-29', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:03', 1, '2014-09-10 17:06:03', 1, NULL, NULL),
(67, 0, 0, 0, 0, 'Hadi Setiawan', NULL, NULL, NULL, '197903152000121006', '$2y$13$t4sV8HVKbFFfO2hPQq0BheO5Cc5G44qQZVpXWEHjnHzZUAjeo8rNa', 'OsIDNUlU5GB4clw4xUk4XyRjg-Y6jCBL', NULL, '1979-03-15', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:04', 1, '2014-09-10 17:06:04', 1, NULL, NULL),
(68, 0, 0, 0, 0, 'Heny Setyawati', NULL, NULL, NULL, '198105132002122001', '$2y$13$NqRxTGTHlXhkJYuSyaBBr.vTF3akJhxHI53WHkBYnedEzoBy0h/mO', '4C6uha3zs5RFRfwPQnlnDqXjk4SPQ9S_', NULL, '1981-05-13', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:06', 1, '2014-09-10 17:06:06', 1, NULL, NULL),
(69, 0, 0, 0, 0, 'Indra Utama', NULL, NULL, NULL, '196411051986031001', '$2y$13$JbMQvMLias.qIXsaAxoyFOz7DSRQdL6Dd2lS25b7K6NiEvY72UB8u', 'Hz3t4FsWzeN-C7WFKfqDX9EO6KeBZB9b', NULL, '1964-11-05', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:08', 1, '2014-09-10 17:06:08', 1, NULL, NULL),
(70, 0, 0, 0, 0, 'Iqravid Hajat', NULL, NULL, NULL, '197111181992031001', '$2y$13$XXd7GRNV/groGHbZ4yfVQ.goXESEBRUFHPcpCx51efQI3TuRk.FSi', 'gLVCMDzQorg3NBWcylUs_umcDGraYqn6', NULL, '1971-11-18', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:09', 1, '2014-09-10 17:06:09', 1, NULL, NULL),
(71, 0, 0, 0, 0, 'Isnaidi', NULL, NULL, NULL, '196209171983021002', '$2y$13$E8iLZGnTPGVcz9iA7DUszuK9PYnbZUusZaRAW8eU834KRBrIGcdYW', 'YmHdyUmwM_Qep18X9KuOpE5zXR-fTb42', NULL, '1962-09-17', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:11', 1, '2014-09-10 17:06:11', 1, NULL, NULL),
(72, 0, 0, 0, 0, 'Jaitar Sirait', NULL, NULL, NULL, '196111051985031002', '$2y$13$hALYCTEO4S.DfrgMsv.fDuFsHXxyOM651Ncub0ZfTJvJmPirLWQWK', 'XVy-OsAf_ARwzzrdFUylYQZaXI08NmxJ', NULL, '1961-11-05', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:12', 1, '2014-09-10 17:06:12', 1, NULL, NULL),
(73, 0, 0, 0, 0, 'Jarvik Fuad Rizky', NULL, NULL, NULL, '198708302008121002', '$2y$13$ymz.SEzpUr3Y2oOjdrgqtOMl8MjhRyx.OWGD../qU.YojR0.29Q72', 'YUCsx4DcC6EnuhonqRrRaKIWs2ikjpax', NULL, '1987-08-30', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:15', 1, '2014-09-10 17:06:15', 1, NULL, NULL),
(74, 0, 0, 0, 0, 'M. Ichsan Firmansyah', NULL, NULL, NULL, '197801102002121002', '$2y$13$xCDUzUeWjcKAGNNYEj/05uxywnWLLlDthFcr0tvSLPZkprY8evfJi', '0fyOxNPsyjwsjE02MVC4ZIyin5U471IL', NULL, '1978-01-10', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:16', 1, '2014-09-10 17:06:16', 1, NULL, NULL),
(75, 0, 0, 0, 0, 'M. Kayani', NULL, NULL, NULL, '196206151983021001', '$2y$13$5Oo.SlU8/1HfCsMIQrd3y.1cRoe3QjKI4Eg.JMS4ODkKy9TmtOuwW', 'RnsL2EnYypZpb1L9OdiQX3gobumiKy81', NULL, '1962-06-15', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:41', 1, '2014-09-10 17:06:41', 1, NULL, NULL),
(76, 0, 0, 0, 0, 'Maria Yosephina Siregar', NULL, NULL, NULL, '198411052009012003', '$2y$13$YF6HFS05X/Q6jWwKE3/sCehc1Sjjal537x7jMdus5tU/6ExfZfKxy', 'D-iILolsV6c9maWx8MeEa-YKUVd-lmKd', NULL, '1984-11-05', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:43', 1, '2014-09-10 17:06:43', 1, NULL, NULL),
(77, 0, 0, 0, 0, 'Meiseno Purnawan', NULL, NULL, NULL, '198405182006021002', '$2y$13$0WQNTS1fqwBBpB4RM8B4zONCgD3VNlCbCkdx2iU5/D3YXllAi/YcG', 'bILwyCeWw57n1dYEWR2g-0L-A6LR18yn', NULL, '1984-05-18', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:44', 1, '2014-09-10 17:06:44', 1, NULL, NULL),
(78, 0, 0, 0, 0, 'Mohammad  Irwan', NULL, NULL, NULL, '196205191988101001', '$2y$13$6xy1y50cN5zZQFodtS6wK.DQiWzriG/M.IGUkFTVn.U7j1kpNhKfS', 'IhiN29Ot14s4njBYPuGppTSwna9d9A87', NULL, '1962-05-19', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:46', 1, '2014-09-10 17:06:46', 1, NULL, NULL),
(79, 0, 0, 0, 0, 'Muhaimin Zikri', NULL, NULL, NULL, '197210231993021001', '$2y$13$TSBNZ/at.UvxHOqqXLqieuyIdh5AUcCzM0AunANZwepu4Lcf7gcOO', 'MGTRakXhgBjWq1JmSSPOUuOynDP3-5SA', NULL, '1972-10-23', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:48', 1, '2014-09-10 17:06:48', 1, NULL, NULL),
(80, 0, 0, 0, 0, 'Nany Nur Aini', NULL, NULL, NULL, '196705031992012001', '$2y$13$J7luHqzFxwdVB//IXHuN..395kAt.R2MPDBBk/y9jNCCG8MisEXqu', '-MRXoX1i9Pi8l7EE8Rs3_1_N3jXvKAI1', NULL, '1967-05-03', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:50', 1, '2014-09-10 17:06:50', 1, NULL, NULL),
(81, 0, 0, 0, 0, 'Noor Cholis Yuana', NULL, NULL, NULL, '196707051998031001', '$2y$13$257/O7ZQIn7mk7VSDexRMOUvsG5CDajJXx4nAf0yAv1S1phkuwj2W', 'NM7wQsN5Xcj8slA-f7EcwBHaG4RNStPr', NULL, '1967-07-05', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:52', 1, '2014-09-10 17:06:52', 1, NULL, NULL),
(82, 0, 0, 0, 0, 'Nyamat', NULL, NULL, NULL, '196604101987031002', '$2y$13$6/oWoeTyGehqmm6ibKn6d.fAa.nttBdcxMLxMMPX9ajFIlHNluSS.', 'ZsQZI8Ss3K2_BsuE8lm0HdFp2Y81a3U0', NULL, '1966-04-10', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:53', 1, '2014-09-10 17:06:53', 1, NULL, NULL),
(83, 0, 0, 0, 0, 'Prita Anindya', NULL, NULL, NULL, '198606022010122004', '$2y$13$vF18jnbVOtp4m4JZXpfHSO64wRdMM8WvrL7Gcf9xxBAGhQwCmlTQa', 'VSvC-QOYwm1wryiavQaTpk-Ln-mYE7K5', NULL, '1986-06-02', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:55', 1, '2014-09-10 17:06:55', 1, NULL, NULL),
(84, 0, 0, 0, 0, 'Putri Sion', NULL, NULL, NULL, '198302112009012009', '$2y$13$5YL9N.GW2Aa5ub.faylWOeILvk/UDE6WtjlLzfc/veSyXXNbmIRVW', 'f6PlmmVzvPS5Tb5I0OKTBpc-LCLY4ukS', NULL, '1983-02-11', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:56', 1, '2014-09-10 17:06:56', 1, NULL, NULL),
(85, 0, 0, 0, 0, 'Randi Mesarino', NULL, NULL, NULL, '198511142009011007', '$2y$13$g52x6Y1PLzlHzeOtclbTTuPQ8LCqmT7hQqzGipZV/iBs1fqd5OHj.', 'b8g77bXfLzaefBYpXfp3u7ABQPooQUrh', NULL, '1985-11-14', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:57', 1, '2014-09-10 17:06:57', 1, NULL, NULL),
(86, 0, 0, 0, 0, 'Ratnasari', NULL, NULL, NULL, '196711221988032001', '$2y$13$c4cT.bRcnlOl4n3DS6LCfu0BSVNKVYrbTwcTeZKyf5KGHDV957IK.', 'G7UZOa-2suY6eU0BrZoos4rF5vsKBHDg', NULL, '1967-11-22', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:06:58', 1, '2014-09-10 17:06:58', 1, NULL, NULL),
(87, 0, 0, 0, 0, 'Retno Maruti', NULL, NULL, NULL, '198306222006022001', '$2y$13$STpvhLjKUb4.kXLE28acaez0g5X4sLKH89Dq9b8EGLttWRi2uDame', 'n2xePgGnReoJHOuEVSTUnv3Y2nuAPHuu', NULL, '1983-06-22', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:00', 1, '2014-09-10 17:07:00', 1, NULL, NULL),
(88, 0, 0, 0, 0, 'Ridwan Ramdhani', NULL, NULL, NULL, '198506032006021001', '$2y$13$ym5MQFjGR.m4oiTt8.pnt.qTWruIBlgm46jT2HauTqfJKDbQNKDoq', 'mTICTG_tOQGg0myQHI3p8HAXIF1RlSao', NULL, '1985-06-03', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:01', 1, '2014-09-10 17:07:01', 1, NULL, NULL),
(89, 0, 0, 0, 0, 'Ristiana Susanti', NULL, NULL, NULL, '198606052007012002', '$2y$13$HUEopKV6bYD0qkLWIKBoGeaWQnsFnttli/nhf5Z3Xv4nhNAdGqAqS', 'WfZTA9-PsHP2FiHkYWhD9Pp5IcyjOaRN', NULL, '1986-06-05', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:02', 1, '2014-09-10 17:07:02', 1, NULL, NULL),
(90, 0, 0, 0, 0, 'Rustiyono', NULL, NULL, NULL, '197004271990121001', '$2y$13$EVK05mQ27HlEbBA1iXX/RO85VRGWctXWBs3SVE8Gq7h1E8jtjClLe', 'DKHZIYW2_uSlvsAZ73o-Ub6I7Zxs9PIY', NULL, '1970-04-27', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:04', 1, '2014-09-10 17:07:04', 1, NULL, NULL),
(91, 0, 0, 0, 0, 'Saifudin', NULL, NULL, NULL, '197307051993031010', '$2y$13$pTqhSmhluPJ/q3js0wJV6.UMkKKt5ZpCvxEEAAw.nmLJeS9fY8jZa', 'IkckGQD0b72O6NJGgysbENsNBDtKMPow', NULL, '1973-07-05', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:05', 1, '2014-09-10 17:07:05', 1, NULL, NULL),
(92, 0, 0, 0, 0, 'Sri Sukesi, Ak.', NULL, NULL, NULL, '196506231986032003', '$2y$13$oI3c7k88Qlou9suPwgBLN.jlHMYFDwx22XgXUFUemrHxY56qK1XJ2', '3IFBi8UqdChECxNtAKv-ZmbFTiyrVCRd', NULL, '1965-06-23', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:07', 1, '2014-09-10 17:07:07', 1, NULL, NULL),
(93, 0, 0, 0, 0, 'Suci Lestari', NULL, NULL, NULL, '198711242010122004', '$2y$13$oXK80mDbbK/MXCXbg0sSK.3l1QIEa6u1LgBHcX5gh.Q7.TOdyf5Au', '9olLLCbd1-SNJ8BmYwPCj3Fm0G6pKaLK', NULL, '1987-11-24', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:09', 1, '2014-09-10 17:07:09', 1, NULL, NULL),
(94, 0, 0, 0, 0, 'Suhadiyan Syah Alam', NULL, NULL, NULL, '198006172001121002', '$2y$13$dG6yFYonNQeC.UwjAuyQyuZVp309RYKmjkcBrleb3d34HVCR6opLa', '5uXzXaZ93VsCLgyD6xyBLBDNTD5PZy93', NULL, '1980-06-17', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:18', 1, '2014-09-10 17:07:18', 1, NULL, NULL),
(95, 0, 0, 0, 0, 'Suparyadi', NULL, NULL, NULL, '196904181990031001', '$2y$13$o3Coln9m1nQVc5Dgg6bUP.ClS7Kq8jC5HOYG7t1zAypjNYpKiHLi2', 'Xx9wuDJgBwv57zI6SgSJmQloDY5-0RuA', NULL, '1969-04-18', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:19', 1, '2014-09-10 17:07:19', 1, NULL, NULL),
(96, 0, 0, 0, 0, 'Tirawan Mahulae', NULL, NULL, NULL, '196309191985032001', '$2y$13$YI2XEAPwnzpIcSTYxE17jeyTYOIcc4IsW/6JTFd3eDrYgudAka6F6', 'tYXYhPsX2aB-cqbnqumM5O-vHwDFo0yr', NULL, '1963-09-19', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:21', 1, '2014-09-10 17:07:21', 1, NULL, NULL),
(97, 0, 0, 0, 0, 'Tripto Tri Agustono', NULL, NULL, NULL, '196608031992011001', '$2y$13$wPYs/Dlu7DOM/wRWA2FOcet.sNzNg8y2HPvshuuNtZu.RGyUMPYEG', 'ak8bbpxLAf6JNRBEIWm3rlrNclkOL5BL', NULL, '1966-08-03', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:22', 1, '2014-09-10 17:07:22', 1, NULL, NULL),
(98, 0, 0, 0, 0, 'Untung Dwiyono', NULL, NULL, NULL, '196307181984021003', '$2y$13$YVuoiwPaVaq6.SFYLLLZ..ivW1SXJ7B.Fynyf8OX9MXH/rnTq/Vey', 'wArGM-t7hcjTW3-Qq75eXVqzaCsRDeJz', NULL, '1963-07-18', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:24', 1, '2014-09-10 17:07:24', 1, NULL, NULL),
(99, 0, 0, 0, 0, 'Wijaya Wardhani', NULL, NULL, NULL, '196602061992012001', '$2y$13$47FgdoaBMp4OMi3H4XQG.uLPbSVK1iIzBjy6JztUVkJLy1eh7A20q', '8bPCZ-UjzUMjvcafEWcN9FPHimszgx82', NULL, '1966-02-06', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:25', 1, '2014-09-10 17:07:25', 1, NULL, NULL),
(100, 0, 0, 0, 0, 'Yohana Intan Dias Sari', NULL, NULL, NULL, '199001122012122002', '$2y$13$H834oJlACZ90JBukwmqPvOZzmofNJaz4cVvcy9WvM0LfUnPkp0TsW', 'lahVXHPRmy9ZC7xV1OCOcRdnJTBg0F5V', NULL, '1990-01-12', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:28', 1, '2014-09-10 17:07:28', 1, NULL, NULL),
(101, 0, 0, 0, 0, 'Yudhistira, S.AB.', NULL, NULL, NULL, '198306162004121001', '$2y$13$7JmHomKPfzyLIFkK280yjeeuZ5Xf158Kjuw94y2.RpEJaivnk//6K', '_5xVZXO4kolpooXKiUgUGVnr7-xaq5sh', NULL, '1983-06-16', 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-09-10 17:07:30', 1, '2014-09-10 17:07:30', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_trainer`
--

CREATE TABLE IF NOT EXISTS `tb_trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idn` varchar(255) NOT NULL,
  `ref_graduate_id` int(3) NOT NULL DEFAULT '0',
  `ref_rank_class_id` int(3) NOT NULL DEFAULT '0',
  `ref_religion_id` int(3) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `nickName` varchar(50) DEFAULT NULL,
  `frontTitle` varchar(20) DEFAULT NULL,
  `backTitle` varchar(20) DEFAULT NULL,
  `nip` varchar(18) DEFAULT NULL,
  `born` varchar(50) DEFAULT NULL,
  `birthDay` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1',
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `married` tinyint(1) DEFAULT '0',
  `photo` varchar(255) DEFAULT NULL,
  `blood` varchar(10) DEFAULT NULL,
  `position` int(1) DEFAULT NULL,
  `positionDesc` varchar(255) DEFAULT NULL,
  `organization` varchar(45) DEFAULT NULL,
  `widyaiswara` tinyint(1) NOT NULL DEFAULT '0',
  `education` varchar(255) DEFAULT NULL,
  `educationHistory` varchar(1000) DEFAULT NULL,
  `trainingHistory` varchar(1000) DEFAULT NULL,
  `experience` varchar(1000) DEFAULT NULL,
  `competency` varchar(255) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `bankAccount` varchar(255) DEFAULT NULL,
  `officePhone` varchar(50) DEFAULT NULL,
  `officeFax` varchar(50) DEFAULT NULL,
  `officeEmail` varchar(100) DEFAULT NULL,
  `officeAddress` varchar(255) DEFAULT NULL,
  `document1` varchar(255) DEFAULT NULL COMMENT 'SK CPNS',
  `document2` varchar(255) DEFAULT NULL COMMENT 'SK JABATAN TERAKHIR',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idn` (`idn`),
  KEY `fk_tb_trainer_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_trainer_ref_rank_class1` (`ref_rank_class_id`),
  KEY `fk_tb_trainer_ref_religion1` (`ref_religion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_trainer`
--

INSERT INTO `tb_trainer` (`id`, `idn`, `ref_graduate_id`, `ref_rank_class_id`, `ref_religion_id`, `name`, `nickName`, `frontTitle`, `backTitle`, `nip`, `born`, `birthDay`, `gender`, `phone`, `email`, `address`, `married`, `photo`, `blood`, `position`, `positionDesc`, `organization`, `widyaiswara`, `education`, `educationHistory`, `trainingHistory`, `experience`, `competency`, `npwp`, `bankAccount`, `officePhone`, `officeFax`, `officeEmail`, `officeAddress`, `document1`, `document2`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, '198604302009011002', 8, 10, 0, 'Hafid Mukhlasin', 'Hafid', 'Dr', 'PHD', '198604302009011002', 'Jember', '1986-04-30', 1, '081559915720', 'milisstudio@gmail.com', '', 1, '', '', 0, '', 'BPPK', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2014-08-28 15:23:02', 1, '2014-09-03 11:46:21', 1, NULL, NULL),
(2, '198604302009011003', 0, 0, 0, 'Fajar Megantara', '', '', '', '', '', NULL, 1, '', '', '', 0, '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2014-08-29 17:57:57', 1, '2014-08-29 17:57:57', 1, NULL, NULL),
(3, '123456789', 0, 0, 0, 'Wida Choirunnisa', 'Wida', 'IR.', 'MMM', '199908947495859584', 'pandeglang', '1990-09-15', 1, '087776584873673', 'choirs.22@depkeu.go.id', 'padamhank', 1, '', '', 0, '', '', 1, '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '2014-09-03 11:59:06', 1, '2014-09-03 11:59:06', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training`
--

CREATE TABLE IF NOT EXISTS `tb_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_id` int(11) NOT NULL,
  `tb_program_revision` int(11) NOT NULL,
  `ref_satker_id` int(3) NOT NULL,
  `number` varchar(30) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `studentCount` int(5) DEFAULT NULL,
  `classCount` int(3) DEFAULT NULL,
  `executionSK` varchar(255) DEFAULT NULL,
  `resultSK` varchar(255) DEFAULT NULL,
  `costPlan` int(11) DEFAULT NULL,
  `costRealisation` int(11) DEFAULT NULL,
  `sourceCost` varchar(255) DEFAULT NULL,
  `hostel` tinyint(1) DEFAULT '0' COMMENT 'diasramakan',
  `reguler` tinyint(1) DEFAULT '1' COMMENT '1=REGULER;0:PARALEL',
  `stakeholder` varchar(255) DEFAULT 'BPPK' COMMENT 'INSTANSI KERJASAMA DIKLAT',
  `location` varchar(255) DEFAULT '-',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  `approvedStatus` tinyint(1) DEFAULT NULL,
  `approvedStatusNote` varchar(255) DEFAULT NULL,
  `approvedStatusDate` datetime DEFAULT NULL,
  `approvedStatusBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_tb_program1` (`tb_program_id`),
  KEY `fk_tb_training_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tb_training`
--

INSERT INTO `tb_training` (`id`, `tb_program_id`, `tb_program_revision`, `ref_satker_id`, `number`, `name`, `start`, `finish`, `note`, `studentCount`, `classCount`, `executionSK`, `resultSK`, `costPlan`, `costRealisation`, `sourceCost`, `hostel`, `reguler`, `stakeholder`, `location`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `approvedStatus`, `approvedStatusNote`, `approvedStatusDate`, `approvedStatusBy`) VALUES
(7, 4, 1, 3, '2014-03-00-2.2.1.3.1', 'DIKLAT PRANATA KOMPUTER AHLI AKT I', '2014-08-04', '2014-08-29', 'Halo', 50, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '', '', 0, '2014-08-25 10:59:34', 1, '2014-09-01 14:00:47', 1, NULL, NULL, 1, '', NULL, NULL),
(8, 4, 2, 3, '2014-03-00-2.2.1.0.2', 'DIKLAT PRANATA KOMPUTER AHLI KHUSUS SETJEN', '2014-08-19', '2014-08-27', '', 30, 1, '', NULL, NULL, NULL, '', 0, 1, '', '3', 2, '2014-08-25 11:37:50', 1, '2014-09-12 13:37:17', 1, NULL, NULL, 0, '', NULL, NULL),
(9, 4, 1, 3, '2014-03-00-.4', 'PRANATA KOMPUTER AHLI AKT I', '2014-08-27', '2014-08-28', '', NULL, 3, '', NULL, NULL, NULL, '', 0, 1, '', '3', 0, '2014-08-25 11:40:53', 1, '2014-09-08 10:58:16', 1, NULL, NULL, 0, '', NULL, NULL),
(10, 4, 1, 3, '2014-03-00-2.2.1.0.4', 'KOM', '2014-08-27', '2014-08-27', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '', 3, '2014-08-25 11:41:37', 1, '2014-08-25 11:41:37', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 5, 0, 3, '2014-03-00-1.0.0.0.2', 'Diklat Prajabatan Golongan III Angk. II', '2014-08-12', '2014-08-27', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '', 0, '2014-08-27 16:28:48', 1, '2014-08-27 16:28:48', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 1, 3, '2014-03-00-2.2.1.3.5', 'PRANATA KOMPUTER AHLI ', '2014-10-01', '2014-10-10', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 'BKF', 'Pusdiklat Keuangan Umum', 0, '2014-09-01 12:12:00', 1, '2014-09-01 12:12:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 4, 1, 3, '2014-03-00-2.2.1.3.6', 'PRANATA KOMPUTER AHLI ', '2014-10-20', '2014-10-24', '', 20, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Sekretariat Jenderal', 'Hotel Aryaduta Semanggi', 0, '2014-09-01 13:56:47', 1, '2014-09-01 13:56:47', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 5, 0, 3, '2014-03-00-1.0.0.0.5', 'Diklat Prajabatan Golongan III angkatan 1', '2014-09-15', '2014-09-26', 'diklat badan pendidikan dan pelatihankeuangan....', 100, 4, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Kementerian Keuangan', 'Hotel Aryaduta Semanggi', 0, '2014-09-01 13:58:44', 1, '2014-09-01 15:04:02', 1, NULL, NULL, 1, '', NULL, NULL),
(15, 4, 2, 3, '2014-03-00-.4', 'PRANATA KOMPUTER AHLI MUDA', '2014-09-01', '2014-09-30', '', 1000, 30, '', NULL, NULL, NULL, '', 0, 1, '', '3', 2, '2014-09-08 09:54:42', 1, '2014-09-08 09:59:07', 1, NULL, NULL, 0, '', NULL, NULL),
(16, 7, 0, 3, '2014-03-00-.8', 'Diklat Manajemen Rumah Tangga Angkatan I', '2014-11-03', '2014-11-05', '', 25, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '3', 0, '2014-09-17 11:34:24', 1, '2014-09-17 11:34:24', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class`
--

CREATE TABLE IF NOT EXISTS `tb_training_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `class` varchar(5) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tb_training_class`
--

INSERT INTO `tb_training_class` (`id`, `tb_training_id`, `class`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(2, 7, 'A', 1, '2014-09-08 03:45:52', 1, '2014-09-08 03:45:52', 1, NULL, NULL),
(5, 15, 'B', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(6, 15, 'C', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(7, 15, 'D', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(8, 15, 'E', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(9, 15, 'F', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(10, 15, 'G', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(11, 15, 'H', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(12, 15, 'I', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(13, 15, 'J', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(14, 15, 'K', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(15, 15, 'L', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(16, 15, 'M', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(17, 15, 'N', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(18, 15, 'O', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(19, 15, 'P', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(20, 15, 'Q', 1, '2014-09-08 09:59:28', 1, '2014-09-08 09:59:28', 1, NULL, NULL),
(21, 15, 'R', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(22, 15, 'S', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(23, 15, 'T', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(24, 15, 'U', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(25, 15, 'V', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(26, 15, 'W', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(27, 15, 'X', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(28, 15, 'Y', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(29, 15, 'Z', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(30, 15, 'AA', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(31, 15, 'AB', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(32, 15, 'AC', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(33, 15, 'AD', 1, '2014-09-08 09:59:29', 1, '2014-09-08 09:59:29', 1, NULL, NULL),
(34, 15, 'AD', 1, '2014-09-08 10:14:29', 1, '2014-09-08 10:14:29', 1, NULL, NULL),
(36, 9, 'B', 1, '2014-09-08 10:58:23', 1, '2014-09-08 10:58:23', 1, NULL, NULL),
(37, 9, 'C', 1, '2014-09-08 10:58:23', 1, '2014-09-08 10:58:23', 1, NULL, NULL),
(38, 9, 'C', 1, '2014-09-08 10:59:00', 1, '2014-09-08 10:59:00', 1, NULL, NULL),
(41, 8, 'A', 1, '2014-09-17 05:11:14', 1, '2014-09-17 05:11:14', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_student`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `tb_training_class_id` int(11) NOT NULL,
  `tb_training_student_id` int(11) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `headClass` tinyint(1) DEFAULT '0',
  `activity` decimal(5,2) DEFAULT '1.00' COMMENT 'NILAI AKTIFITAS',
  `presence` decimal(5,2) DEFAULT NULL,
  `pretest` decimal(5,2) DEFAULT NULL,
  `posttest` decimal(5,2) DEFAULT NULL,
  `test` decimal(5,2) DEFAULT NULL COMMENT 'Nilai Ujian',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_training_id_2` (`tb_training_id`,`tb_training_student_id`),
  KEY `fk_tb_training_subject_student_tb_training_assignment1` (`tb_training_class_id`),
  KEY `fk_tb_training_subject_student_tb_student1` (`tb_training_student_id`),
  KEY `tb_training_id` (`tb_training_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=142 ;

--
-- Dumping data for table `tb_training_class_student`
--

INSERT INTO `tb_training_class_student` (`id`, `tb_training_id`, `tb_training_class_id`, `tb_training_student_id`, `number`, `headClass`, `activity`, `presence`, `pretest`, `posttest`, `test`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(140, 8, 41, 1, NULL, 0, '1.00', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 8, 41, 2, NULL, 0, '1.00', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_student_attendance`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_student_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_schedule_id` int(11) NOT NULL,
  `tb_training_class_student_id` int(11) NOT NULL,
  `hours` decimal(5,2) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_training_schedule_id` (`tb_training_schedule_id`),
  KEY `tb_training_class_student_id` (`tb_training_class_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_student_certificate`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_student_certificate` (
  `tb_training_class_student_id` int(11) NOT NULL,
  `ref_unit_id` int(3) NOT NULL DEFAULT '0',
  `ref_graduate_id` int(3) NOT NULL DEFAULT '0',
  `ref_rank_class_id` int(3) NOT NULL DEFAULT '0',
  `number` varchar(50) DEFAULT NULL,
  `seri` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `position` int(1) DEFAULT NULL COMMENT '[1:Es1;2:Es2;3:Es3;4:Es4;5:Pelaksana]',
  `positionDesc` varchar(255) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `eselon2` varchar(100) DEFAULT NULL,
  `eselon3` varchar(100) DEFAULT NULL,
  `eselon4` varchar(100) DEFAULT NULL,
  `satker` enum('2','3','4') DEFAULT '2',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tb_training_class_student_id`),
  KEY `fk_tb_training_certificate_tb_training1` (`tb_training_class_student_id`),
  KEY `fk_tb_training_certificate_ref_unit1` (`ref_unit_id`),
  KEY `fk_tb_training_certificate_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_training_certificate_ref_rank_class1` (`ref_rank_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_training_class_student_certificate`
--

INSERT INTO `tb_training_class_student_certificate` (`tb_training_class_student_id`, `ref_unit_id`, `ref_graduate_id`, `ref_rank_class_id`, `number`, `seri`, `date`, `position`, `positionDesc`, `education`, `eselon2`, `eselon3`, `eselon4`, `satker`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(140, 0, 0, 0, '0001', '0001', '2014-09-02', 4, 'Kasubbag TI', 'TI ITB', '', '', '', '2', 1, '2014-09-17 17:26:43', 1, '2014-09-22 05:24:23', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_subject`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_id` int(11) NOT NULL,
  `tb_program_subject_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training_class_id`),
  KEY `fk_tb_training_assignment_tb_trainer1` (`tb_program_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_training_class_subject`
--

INSERT INTO `tb_training_class_subject` (`id`, `tb_training_class_id`, `tb_program_subject_id`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 41, 1, 1, '2014-09-23 14:54:00', 1, '2014-09-23 14:54:00', 1, NULL, NULL),
(2, 41, 2, 1, '2014-09-23 14:54:00', 1, '2014-09-23 14:54:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_subject_document`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_subject_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_document_tb_training1` (`tb_training_class_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_training_class_subject_document`
--

INSERT INTO `tb_training_class_subject_document` (`id`, `tb_training_class_subject_id`, `name`, `filename`, `description`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 1, 'Test', 'filename', '', 1, '2014-04-18 16:32:35', 1, '2014-04-18 16:48:16', 1, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_document`
--

CREATE TABLE IF NOT EXISTS `tb_training_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_document_tb_training1` (`tb_training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_execution_evaluation`
--

CREATE TABLE IF NOT EXISTS `tb_training_execution_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_student_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `text1` varchar(500) DEFAULT NULL,
  `text2` varchar(500) DEFAULT NULL,
  `text3` varchar(500) DEFAULT NULL,
  `text4` varchar(500) DEFAULT NULL,
  `text5` varchar(500) DEFAULT NULL,
  `overall` int(3) DEFAULT NULL,
  `comment` varchar(3000) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_execution_evaluation_tb_training_student1` (`tb_training_class_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_history`
--

CREATE TABLE IF NOT EXISTS `tb_training_history` (
  `tb_training_id` int(11) NOT NULL,
  `tb_program_id` int(11) NOT NULL,
  `tb_program_revision` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `ref_satker_id` int(3) NOT NULL,
  `number` varchar(30) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `finish` date NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `studentCount` int(5) DEFAULT NULL,
  `classCount` int(3) DEFAULT NULL,
  `executionSK` varchar(255) DEFAULT NULL,
  `resultSK` varchar(255) DEFAULT NULL,
  `costPlan` int(11) DEFAULT NULL,
  `costRealisation` int(11) DEFAULT NULL,
  `sourceCost` varchar(255) DEFAULT NULL,
  `hostel` tinyint(1) DEFAULT '0' COMMENT 'diasramakan',
  `reguler` tinyint(1) DEFAULT '1' COMMENT '1=REGULER;0:PARALEL',
  `stakeholder` varchar(255) DEFAULT 'BPPK' COMMENT 'INSTANSI KERJASAMA DIKLAT',
  `location` varchar(255) DEFAULT '-',
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  `approvedStatus` tinyint(1) DEFAULT NULL,
  `approvedStatusNote` varchar(255) DEFAULT NULL,
  `approvedStatusDate` datetime DEFAULT NULL,
  `approvedStatusBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tb_training_id`,`revision`),
  KEY `fk_tb_training_tb_program1` (`tb_program_id`),
  KEY `fk_tb_training_ref_satker1` (`ref_satker_id`),
  KEY `tb_training_id` (`tb_training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_training_history`
--

INSERT INTO `tb_training_history` (`tb_training_id`, `tb_program_id`, `tb_program_revision`, `revision`, `ref_satker_id`, `number`, `name`, `start`, `finish`, `note`, `studentCount`, `classCount`, `executionSK`, `resultSK`, `costPlan`, `costRealisation`, `sourceCost`, `hostel`, `reguler`, `stakeholder`, `location`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `approvedStatus`, `approvedStatusNote`, `approvedStatusDate`, `approvedStatusBy`) VALUES
(7, 4, 1, 0, 3, '2014-03-00-2.2.1.3.1', 'DIKLAT PRANATA KOMPUTER AHLI AKT I', '2014-08-04', '2014-08-29', 'Halo', 50, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, '', '', 0, '2014-08-25 10:59:34', 1, '2014-09-01 14:00:47', 1, NULL, NULL, 1, '', NULL, NULL),
(7, 4, 1, 1, 3, '2014-03-00-2.2.1.0.1', 'DIKLAT PRANATA KOMPUTER AHLI AKT I', '2014-08-04', '2014-08-29', 'Halo', 50, 1, NULL, NULL, NULL, NULL, NULL, 0, 1, '', '', 0, '2014-08-25 11:44:05', 1, '2014-08-25 11:44:05', 1, NULL, NULL, 0, '', NULL, NULL),
(8, 4, 1, 0, 3, '2014-03-00-2.2.1.0.2', 'DIKLAT PRANATA KOMPUTER AHLI KHUSUS SETJEN', '2014-08-19', '2014-08-27', '', 50, 1, NULL, NULL, NULL, NULL, NULL, 0, 1, '', '', 3, '2014-08-25 10:59:34', 1, '2014-08-25 11:43:48', 1, NULL, NULL, 0, '', NULL, NULL),
(8, 4, 1, 1, 3, '2014-03-00-2.2.1.0.2', 'DIKLAT PRANATA KOMPUTER AHLI KHUSUS SETJEN', '2014-08-19', '2014-08-27', '', 50, 1, NULL, NULL, NULL, NULL, NULL, 0, 1, '', '', 3, '2014-08-25 10:59:34', 1, '2014-08-25 11:43:48', 1, NULL, NULL, 0, '', NULL, NULL),
(9, 4, 1, 0, 3, '2014-03-00-.4', 'PRANATA KOMPUTER AHLI AKT I', '2014-08-27', '2014-08-28', '', NULL, 3, '', NULL, NULL, NULL, '', 0, 1, '', '3', NULL, '2014-08-25 11:40:53', 1, '2014-09-08 10:58:16', 1, NULL, NULL, 0, '', NULL, NULL),
(10, 4, 1, 0, 3, '2014-03-00-2.2.1.0.4', 'KOM', '2014-08-27', '2014-08-27', '', 50, 1, NULL, NULL, NULL, NULL, NULL, 0, 1, '', '', 3, '2014-08-25 10:59:34', 1, '2014-08-25 11:43:48', 1, NULL, NULL, 0, NULL, NULL, NULL),
(11, 5, 0, 0, 3, '2014-03-00-1.0.0.0.2', 'Diklat Prajabatan Golongan III Angk. II', '2014-08-12', '2014-08-27', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '', 0, '2014-08-27 16:28:48', 1, '2014-08-27 16:28:48', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 1, 0, 3, '2014-03-00-2.2.1.3.5', 'PRANATA KOMPUTER AHLI ', '2014-10-01', '2014-10-10', '', NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 'BKF', 'Pusdiklat Keuangan Umum', 0, '2014-09-01 12:12:00', 1, '2014-09-01 12:12:00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 4, 1, 0, 3, '2014-03-00-2.2.1.3.6', 'PRANATA KOMPUTER AHLI ', '2014-10-20', '2014-10-24', '', 20, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Sekretariat Jenderal', 'Hotel Aryaduta Semanggi', 0, '2014-09-01 13:56:47', 1, '2014-09-01 13:56:47', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 5, 0, 0, 3, '2014-03-00-1.0.0.0.5', 'Diklat Prajabatan Golongan III angkatan 1', '2014-09-15', '2014-09-26', 'diklat badan pendidikan dan pelatihankeuangan....', 100, 4, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Kementerian Keuangan', 'Hotel Aryaduta Semanggi', 0, '2014-09-01 13:58:44', 1, '2014-09-01 15:04:02', 1, NULL, NULL, 1, '', NULL, NULL),
(14, 5, 0, 1, 3, '2014-03-00-1.0.0.0.5', 'Diklat Prajabatan Golongan III ', '2014-09-15', '2014-09-26', '', 100, 4, NULL, NULL, NULL, NULL, NULL, 1, 1, 'Kementerian Keuangan', 'Hotel Aryaduta Semanggi', 0, '2014-09-01 14:01:32', 1, '2014-09-01 14:01:32', 1, NULL, NULL, 1, '', NULL, NULL),
(15, 4, 2, 0, 3, '2014-03-00-.4', 'PRANATA KOMPUTER AHLI MUDA', '2014-09-01', '2014-09-30', '', 1000, 30, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '3', 1, '2014-09-08 09:54:42', 1, '2014-09-08 09:58:21', 1, NULL, NULL, 0, '', NULL, NULL),
(16, 7, 0, 0, 3, '2014-03-00-.8', 'Diklat Manajemen Rumah Tangga Angkatan I', '2014-11-03', '2014-11-05', '', 25, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, '', '3', 0, '2014-09-17 11:34:24', 1, '2014-09-17 11:34:24', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_schedule`
--

CREATE TABLE IF NOT EXISTS `tb_training_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_id` int(11) NOT NULL,
  `tb_training_class_subject_id` int(11) NOT NULL,
  `tb_activity_room_id` int(11) NOT NULL,
  `activity` varchar(255) DEFAULT NULL COMMENT 'Honor untuk PIC/JP',
  `pic` varchar(100) DEFAULT NULL COMMENT '0-25',
  `hours` decimal(5,2) DEFAULT NULL COMMENT '1JP = 45menit',
  `startTime` datetime DEFAULT NULL,
  `finishTime` datetime DEFAULT NULL,
  `session` int(3) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_schedule_tb_room1` (`tb_activity_room_id`),
  KEY `tb_activity_room_id` (`tb_activity_room_id`),
  KEY `tb_training_class_subject_assignment_id` (`tb_training_class_subject_id`),
  KEY `tb_training_class_id` (`tb_training_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_schedule_trainer`
--

CREATE TABLE IF NOT EXISTS `tb_training_schedule_trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_schedule_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
  `ref_trainer_type_id` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tb_training_schedule_id` (`tb_training_schedule_id`,`tb_trainer_id`),
  KEY `fk_tb_training_schedule_tb_room1` (`ref_trainer_type_id`),
  KEY `tb_activity_room_id` (`ref_trainer_type_id`),
  KEY `tb_training_class_subject_assignment_id` (`tb_trainer_id`),
  KEY `tb_training_class_id` (`tb_training_schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_schedule_trainer_attendance`
--

CREATE TABLE IF NOT EXISTS `tb_training_schedule_trainer_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_schedule_trainer_id` int(11) NOT NULL,
  `hours` int(3) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_trainer_attendance_tb_training_schedule1` (`tb_training_schedule_trainer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_student`
--

CREATE TABLE IF NOT EXISTS `tb_training_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training_id`),
  KEY `tb_student_id` (`tb_student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_training_student`
--

INSERT INTO `tb_training_student` (`id`, `tb_training_id`, `tb_student_id`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 8, 53, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 8, 54, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_subject_trainer_recommendation`
--

CREATE TABLE IF NOT EXISTS `tb_training_subject_trainer_recommendation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `tb_program_subject_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
  `ref_trainer_type_id` int(3) NOT NULL COMMENT '1:PENGAJAR;2:PENCERAMAH;3:ASISTEN',
  `note` varchar(255) DEFAULT NULL,
  `sort` int(5) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_subject_trainer_recommendation_tb_training_sub1` (`tb_program_subject_id`),
  KEY `fk_tb_training_subject_trainer_recommendation_tb_trainer1` (`tb_trainer_id`),
  KEY `tb_training_id` (`tb_training_id`),
  KEY `ref_trainer_type_id` (`ref_trainer_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tb_training_subject_trainer_recommendation`
--

INSERT INTO `tb_training_subject_trainer_recommendation` (`id`, `tb_training_id`, `tb_program_subject_id`, `tb_trainer_id`, `ref_trainer_type_id`, `note`, `sort`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 7, 1, 1, 0, '', NULL, 1, NULL, NULL, '2014-09-08 06:37:40', 1, NULL, NULL),
(4, 7, 1, 2, 1, '', NULL, 0, '2014-08-31 08:09:37', 1, '2014-08-31 08:09:37', 1, NULL, NULL),
(5, 7, 1, 2, 1, 'ddd', 1, 1, '2014-08-31 08:11:26', 1, '2014-08-31 08:11:26', 1, NULL, NULL),
(6, 8, 2, 3, 0, '', 1, 1, '2014-09-08 06:12:04', 1, '2014-09-08 06:33:19', 1, NULL, NULL),
(7, 8, 2, 2, 0, '', 1, 1, '2014-09-08 06:39:58', 1, '2014-09-08 06:39:58', 1, NULL, NULL),
(8, 8, 1, 1, 0, '', 1, 1, '2014-09-08 06:40:34', 1, '2014-09-08 06:40:34', 1, NULL, NULL),
(9, 8, 1, 2, 1, '', 2, 1, '2014-09-08 06:41:01', 1, '2014-09-08 16:59:13', 1, NULL, NULL),
(10, 15, 1, 1, 0, '', 1, 1, '2014-09-08 09:56:42', 1, '2014-09-08 09:56:42', 1, NULL, NULL),
(11, 15, 2, 3, 0, '', 1, 1, '2014-09-08 09:57:27', 1, '2014-09-08 09:57:27', 1, NULL, NULL),
(12, 8, 1, 3, 2, '', NULL, 1, '2014-09-08 16:51:29', 1, '2014-09-08 16:51:29', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_unit_plan`
--

CREATE TABLE IF NOT EXISTS `tb_training_unit_plan` (
  `tb_training_id` int(11) NOT NULL,
  `ref_unit_id` int(3) DEFAULT NULL,
  `spread` varchar(500) DEFAULT NULL COMMENT 'KAP, GBPP, SILABI',
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tb_training_id`),
  KEY `fk_tb_training_student_spread_plan_tb_training1` (`tb_training_id`),
  KEY `fk_tb_training_student_spread_plan_ref_unit1` (`ref_unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_training_unit_plan`
--

INSERT INTO `tb_training_unit_plan` (`tb_training_id`, `ref_unit_id`, `spread`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(7, 3, '10|5|0|0|7|5|0|0|5|4|0|0|0', 1, NULL, NULL, '2014-09-15 00:39:15', 1, NULL, NULL),
(9, NULL, '10|0|0|0|0|0|0|0|0|0|0|0|0', 1, '2014-08-27 15:03:05', 1, '2014-08-27 15:03:14', 1, NULL, NULL),
(10, NULL, '10|0|0|0|0|0|0|0|0|0|0|10|0', 1, '2014-08-27 15:05:44', 1, '2014-08-27 15:06:02', 1, NULL, NULL),
(11, NULL, '0|0|0|0|0|0|0|0|0|0|0|0|0', 0, '2014-08-27 16:28:48', 1, '2014-08-29 16:37:27', 1, NULL, NULL),
(12, NULL, NULL, 0, '2014-09-01 12:12:00', 1, '2014-09-01 12:12:00', 1, NULL, NULL),
(13, NULL, NULL, 0, '2014-09-01 13:56:47', 1, '2014-09-01 13:56:47', 1, NULL, NULL),
(14, NULL, NULL, 0, '2014-09-01 13:58:44', 1, '2014-09-01 13:58:44', 1, NULL, NULL),
(15, NULL, NULL, 0, '2014-09-08 09:54:42', 1, '2014-09-08 09:54:42', 1, NULL, NULL),
(16, NULL, NULL, 0, '2014-09-17 11:34:25', 1, '2014-09-17 11:34:25', 1, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmation_token`, `confirmation_sent_at`, `confirmed_at`, `unconfirmed_email`, `recovery_token`, `recovery_sent_at`, `blocked_at`, `role`, `registered_from`, `logged_in_from`, `logged_in_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$13$xOnFV4B5NGTJpu1P/qy03Owrkx6j/35dZJR6gPNscLSV2A6kR98fa', '_ZSeDwI6bRSftr4iK42GukuBrWgvHjwz', NULL, NULL, 1405729304, NULL, NULL, NULL, NULL, '', 2130706433, 174333543, 1410926486, 1405728264, 1410926486),
(2, 'psdm', '', '$2y$13$ge.61GlxXqBN3xVzgEXRwO7x7uyCJLPkd42EITP60K15u4xCjfYbi', 'G9߉', NULL, NULL, 1409816772, NULL, NULL, NULL, NULL, NULL, NULL, 2130706433, 1410407790, 1409816773, 1410407790);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE IF NOT EXISTS `testing` (
  `id_training` int(11) NOT NULL AUTO_INCREMENT,
  `id_program` int(11) NOT NULL,
  `name_training` varchar(255) NOT NULL,
  `hours_training` int(11) NOT NULL,
  `revision_plan_start_training` date NOT NULL,
  `revision_plan_finish_training` date NOT NULL,
  `plan_start_training` date NOT NULL,
  `plan_finish_training` date NOT NULL,
  `start_training` date NOT NULL,
  `finish_training` date NOT NULL,
  `plan_participant_training` int(11) NOT NULL,
  `participant_training` int(11) NOT NULL,
  `location_training` varchar(255) NOT NULL,
  `note_training` varchar(255) NOT NULL,
  `update_training` datetime NOT NULL,
  `main_user` varchar(30) NOT NULL,
  `status_training` varchar(15) NOT NULL DEFAULT '[READY]',
  `certificate_type` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_training`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1196 ;

--
-- Dumping data for table `testing`
--

INSERT INTO `testing` (`id_training`, `id_program`, `name_training`, `hours_training`, `revision_plan_start_training`, `revision_plan_finish_training`, `plan_start_training`, `plan_finish_training`, `start_training`, `finish_training`, `plan_participant_training`, `participant_training`, `location_training`, `note_training`, `update_training`, `main_user`, `status_training`, `certificate_type`) VALUES
(2, 0, 'DTSS Pengelolaan Surat Berharga Negara', 0, '0000-00-00', '0000-00-00', '2010-01-25', '2010-01-29', '2010-01-25', '2010-01-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(3, 0, 'DTU TOEFL PBT (Swakelola BKF)', 0, '0000-00-00', '0000-00-00', '2010-02-03', '2010-02-16', '2010-02-03', '2010-02-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(4, 0, 'DTSS Teknik Intelijen (lanjutan) Focus surveilliance', 0, '0000-00-00', '0000-00-00', '2010-02-08', '2010-02-12', '2010-02-08', '2010-02-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(5, 0, 'DTSS ACL Basic Angkatan I', 0, '0000-00-00', '0000-00-00', '2010-02-16', '2010-02-22', '2010-02-16', '2010-02-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(6, 0, 'DTSS Manajemen Utang', 0, '0000-00-00', '0000-00-00', '2010-02-22', '2010-02-25', '2010-02-22', '2010-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(7, 0, 'DTSD Pengelolaan Diklat Gol. III', 0, '0000-00-00', '0000-00-00', '2010-02-24', '2010-03-08', '2010-02-24', '2010-03-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(8, 0, 'Placement Test TOEFL Preparation', 0, '0000-00-00', '0000-00-00', '2010-02-25', '2010-02-25', '2010-02-25', '2010-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(9, 0, 'DFP Pranata Komputer Ahli', 0, '0000-00-00', '0000-00-00', '2010-03-02', '2010-04-01', '2010-03-02', '2010-04-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(10, 0, 'Workshop Diplomasi Ekonomi', 0, '0000-00-00', '0000-00-00', '2010-03-08', '2010-03-12', '2010-03-08', '2010-03-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(11, 0, 'DTSS ACL Basic Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-03-09', '2010-03-15', '2010-03-09', '2010-03-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(12, 0, 'DTSD Pengelolaan Diklat Gol. II', 0, '0000-00-00', '0000-00-00', '2010-03-17', '2010-03-26', '2010-03-17', '2010-03-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(13, 0, 'DTU Business English: Writing Business English', 0, '0000-00-00', '0000-00-00', '2010-03-22', '2010-03-26', '2010-03-22', '2010-03-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(14, 0, 'DTSS Penyusunan Modul', 0, '0000-00-00', '0000-00-00', '2010-03-23', '2010-03-26', '2010-03-23', '2010-03-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(15, 0, 'DTU on Project Financing and Risks', 0, '0000-00-00', '0000-00-00', '2010-03-23', '2010-03-25', '2010-03-23', '2010-03-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(16, 0, 'DTSS Penyusunan dan Validasi Soal', 0, '0000-00-00', '0000-00-00', '2010-03-29', '2010-04-01', '2010-03-29', '2010-04-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(17, 0, 'DTU Pelayanan Prima', 0, '0000-00-00', '0000-00-00', '2010-04-05', '2010-04-09', '2010-04-05', '2010-04-09', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(18, 0, 'DTSS Psikologi Audit Akt. I', 0, '0000-00-00', '0000-00-00', '2010-04-05', '2010-04-08', '2010-04-05', '2010-04-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(19, 0, 'DTU Microsoft Office (Advanced)', 0, '0000-00-00', '0000-00-00', '2010-04-12', '2010-04-16', '2010-04-12', '2010-04-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(20, 0, 'DTU Kearsipan Elektronik', 0, '0000-00-00', '0000-00-00', '2010-04-12', '2010-04-16', '2010-04-12', '2010-04-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(21, 0, 'DTU Tata Naskah Dinas', 0, '0000-00-00', '0000-00-00', '2010-04-19', '2010-04-23', '2010-04-19', '2010-04-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(22, 0, 'DTSS Teknik Audit Berbantukan Komputer dengan ACL (Menengah)', 0, '0000-00-00', '0000-00-00', '2010-04-26', '2010-04-30', '2010-04-26', '2010-04-30', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(23, 0, 'DTSS Manajemen Resiko Angk I', 0, '0000-00-00', '0000-00-00', '2010-05-03', '2010-05-07', '2010-05-03', '2010-05-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(24, 0, 'DTU Legal Drafting Angk I', 0, '0000-00-00', '0000-00-00', '2010-05-03', '2010-05-07', '2010-05-03', '2010-05-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(25, 0, 'DTSS TNA Desain Diklat', 0, '0000-00-00', '0000-00-00', '2010-05-03', '2010-05-07', '2010-05-03', '2010-05-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(26, 0, 'DTSS Psikologi Audit Angk II', 0, '0000-00-00', '0000-00-00', '2010-05-03', '2010-05-06', '2010-05-03', '2010-05-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(27, 0, 'Seminar Kebijakan Perpajakan Pasar Modal dalam Rangka Peningkatan Penerimaan Negara dan Pertumbuhan Investasi', 0, '0000-00-00', '0000-00-00', '2010-05-11', '2010-05-11', '2010-05-11', '2010-05-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(28, 0, 'DTSS Teknik Intelejen (dasar)', 0, '0000-00-00', '0000-00-00', '2010-05-11', '2010-05-22', '2010-05-11', '2010-05-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(29, 0, 'DTSS Negotiation Skill (Loan Negotiation)', 0, '0000-00-00', '0000-00-00', '2010-05-24', '2010-05-26', '2010-05-24', '2010-05-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(30, 0, 'DTU Menulis Ilmiah Populer', 0, '0000-00-00', '0000-00-00', '2010-05-24', '2010-05-26', '2010-05-24', '2010-05-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(31, 0, 'Penyegaran Pengelolaan Web Dinamis untuk Pejabat', 0, '0000-00-00', '0000-00-00', '2010-05-26', '2010-05-26', '2010-05-26', '2010-05-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(32, 0, 'DTU Kepegawaian', 0, '0000-00-00', '0000-00-00', '2010-05-31', '2010-06-04', '2010-05-31', '2010-06-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(33, 0, 'DTU Jaringan Dokumentasi dan Informasi Hukum', 0, '0000-00-00', '0000-00-00', '2010-05-31', '2010-06-11', '2010-05-31', '2010-06-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(34, 0, 'DTU Analisis Jabatan', 0, '0000-00-00', '0000-00-00', '2010-06-01', '2010-06-03', '2010-06-01', '2010-06-03', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(35, 0, 'Workshop Persiapan Purnabhakti', 0, '0000-00-00', '0000-00-00', '2010-06-07', '2010-06-11', '2010-06-07', '2010-06-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(36, 0, 'Workshop Pengelolaan Diklat melalui LMS', 0, '0000-00-00', '0000-00-00', '2010-06-07', '2010-06-11', '2010-06-07', '2010-06-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(37, 0, 'DTSS TABK menggunakan ACL (lanjutan)', 0, '0000-00-00', '0000-00-00', '2010-06-07', '2010-06-11', '2010-06-07', '2010-06-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(38, 0, 'DTU Kearsipan Dinamis', 0, '0000-00-00', '0000-00-00', '2010-06-08', '2010-06-11', '2010-06-08', '2010-06-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(39, 0, 'DTSS Risk Based Audit 1', 0, '0000-00-00', '0000-00-00', '2010-06-14', '2010-06-18', '2010-06-14', '2010-06-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(40, 0, 'DTU Desain Pengelolaan Database', 0, '0000-00-00', '0000-00-00', '2010-06-21', '2010-06-25', '2010-06-21', '2010-06-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(41, 0, 'DTU Penyusunan SOP', 0, '0000-00-00', '0000-00-00', '2010-06-22', '2010-06-24', '2010-06-22', '2010-06-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(42, 0, 'Workshop Diplomasi Ekonomi', 0, '0000-00-00', '0000-00-00', '2010-06-28', '2010-07-02', '2010-06-28', '2010-07-02', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(43, 0, 'DTU TOEFL PBT Preparation Angkatan I', 0, '0000-00-00', '0000-00-00', '2010-07-05', '2010-07-23', '2010-07-05', '2010-07-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(44, 0, 'Workshop Financial Statistics', 0, '0000-00-00', '0000-00-00', '2010-07-12', '2010-07-16', '2010-07-12', '2010-07-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(45, 0, 'DTSS Risk Based Audit (Lanjutan) Angkatan I', 0, '0000-00-00', '0000-00-00', '2010-07-19', '2010-07-23', '2010-07-19', '2010-07-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(46, 0, 'DTU TOEFL PBT Preparation Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-07-19', '2010-08-06', '2010-07-19', '2010-08-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(47, 0, 'DF JFA Pembentukan Auditor Terampil', 0, '0000-00-00', '0000-00-00', '2010-07-13', '2010-08-02', '2010-07-13', '2010-08-02', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(48, 0, 'Seminar Sukuk Sebagai Alternatif Pembiayaan APBN', 0, '0000-00-00', '0000-00-00', '2010-07-20', '2010-07-20', '2010-07-20', '2010-07-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(49, 0, 'DTSS Legal Drafting for Loan Agreement', 0, '0000-00-00', '0000-00-00', '2010-07-26', '2010-07-28', '2010-07-26', '2010-07-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(50, 0, 'DTU Manajemen Risiko', 0, '0000-00-00', '0000-00-00', '2010-07-26', '2010-07-30', '2010-07-26', '2010-07-30', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(51, 0, 'DTU Balance Scorecard', 0, '0000-00-00', '0000-00-00', '2010-07-26', '2010-07-30', '2010-07-26', '2010-07-30', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(52, 0, 'DTSS Forensic Audit', 0, '0000-00-00', '0000-00-00', '2010-07-26', '2010-08-10', '2010-07-26', '2010-08-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(53, 0, 'DTU Analisis Beban Kerja', 0, '0000-00-00', '0000-00-00', '2010-08-03', '2010-08-05', '2010-08-03', '2010-08-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(54, 0, 'DTU Legal Drafting Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-08-02', '2010-08-06', '2010-08-02', '2010-08-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(55, 0, 'DTU ICT Akt. I (Digital Imaging) [...With NIA Korea Selatan...]', 0, '0000-00-00', '0000-00-00', '2010-08-02', '2010-08-13', '2010-08-02', '2010-08-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(56, 0, 'DTU ICT Ank. II (Java Programming) [...With NIA Korea Selatan...]', 0, '0000-00-00', '0000-00-00', '2010-08-16', '2010-08-30', '2010-08-16', '2010-08-30', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(57, 0, 'DFP Pranata Komputer Terampil Angkatan I', 0, '0000-00-00', '0000-00-00', '2010-08-09', '2010-09-08', '2010-08-09', '2010-09-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(58, 0, 'Workshop Pengenalan Mac OS', 0, '0000-00-00', '0000-00-00', '2010-08-23', '2010-08-27', '2010-08-23', '2010-08-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(59, 0, 'DTU Pengelolaan Website untuk Pelaksana', 0, '0000-00-00', '0000-00-00', '2010-09-20', '2010-09-24', '2010-09-20', '2010-09-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(60, 0, 'DTU TOEFL Preparation (IBT) - Non Asrama', 0, '0000-00-00', '0000-00-00', '2010-09-20', '2010-10-15', '2010-09-20', '2010-10-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(61, 0, 'DFP Pranata Komputer Terampil Angkatan II (Non - Asrama)', 0, '0000-00-00', '0000-00-00', '2010-09-20', '2010-10-22', '2010-09-20', '2010-10-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(62, 0, 'DTU Kepegawaian', 0, '0000-00-00', '0000-00-00', '2010-09-27', '2010-10-01', '2010-09-27', '2010-10-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(63, 0, 'DTSS Manajemen Resiko', 0, '0000-00-00', '0000-00-00', '2010-09-27', '2010-10-01', '2010-09-27', '2010-10-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(64, 0, 'DTSS Teknik Investigasi', 0, '0000-00-00', '0000-00-00', '2010-10-05', '2010-10-22', '2010-10-05', '2010-10-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(65, 0, 'DTU Kearsipan Dinamis Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-10-12', '2010-10-15', '2010-10-12', '2010-10-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(66, 0, 'DTU Desain Pengelolaan Database Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-10-18', '2010-10-22', '2010-10-18', '2010-10-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(67, 0, 'DTU Toefl IBT Preparation (Asrama)', 0, '0000-00-00', '0000-00-00', '2010-10-28', '2010-11-19', '2010-10-28', '2010-11-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(68, 0, 'DTU Dasar OS dan Aplikasi Linux', 0, '0000-00-00', '0000-00-00', '2010-11-01', '2010-11-04', '2010-11-01', '2010-11-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(69, 0, 'DTU Legal English', 0, '0000-00-00', '0000-00-00', '2010-11-01', '2010-11-03', '2010-11-01', '2010-11-03', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(70, 0, 'DTU Training Need Analysis', 0, '0000-00-00', '0000-00-00', '2010-11-01', '2010-11-05', '2010-11-01', '2010-11-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(71, 0, 'Workshop Persiapan Purnabakti Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-11-08', '2010-11-12', '2010-11-08', '2010-11-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(72, 0, 'Diklat Orientasi Pelaksanaan Tugas Pegawai BPPK', 0, '0000-00-00', '0000-00-00', '2010-11-08', '2010-11-15', '2010-11-08', '2010-11-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(73, 0, 'Workshop Etika Budaya Kerja', 0, '0000-00-00', '0000-00-00', '2010-11-10', '2010-11-12', '2010-11-10', '2010-11-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(74, 0, 'DTSS Performance Audit', 0, '0000-00-00', '0000-00-00', '2010-11-22', '2010-11-26', '2010-11-22', '2010-11-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(75, 0, 'Workshop Kehumasan', 0, '0000-00-00', '0000-00-00', '2010-11-23', '2010-11-25', '2010-11-23', '2010-11-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(76, 0, 'DTU Balanced Score Card Angkatan II', 0, '0000-00-00', '0000-00-00', '2010-11-29', '2010-12-03', '2010-11-29', '2010-12-03', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(77, 0, 'DTU Balanced Score Card Angkatan III', 0, '0000-00-00', '0000-00-00', '2010-12-01', '2010-12-01', '2010-12-01', '2010-12-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(78, 0, 'Seminar Menyongsong Era PSAK Konvergensi IFRS', 0, '0000-00-00', '0000-00-00', '2010-11-08', '2010-11-08', '2010-11-08', '2010-11-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(79, 0, 'ORIENTASI PELAKSANAAN TUGAS CALON PEGAWAI BPPK', 0, '0000-00-00', '0000-00-00', '2011-01-10', '2011-01-20', '2011-01-10', '2011-01-20', 0, 92, '', '', '2013-04-05 14:09:41', '', '[READY]', 1),
(80, 3, 'DF CALON WIDYAISWARA (PROGRAM UMUM &amp; KHUSUS)', 0, '0000-00-00', '0000-00-00', '2011-01-17', '2011-02-25', '2011-01-17', '2011-02-25', 0, 45, '', '', '2013-04-05 14:10:16', '', '[READY]', 1),
(81, 0, 'DTSD PENGELOLAAN DIKLAT GOL. III AKT. I', 0, '0000-00-00', '0000-00-00', '2011-01-21', '2011-02-02', '2011-01-21', '2011-02-02', 0, 35, '', '', '2013-04-05 14:11:36', '', '[READY]', 1),
(82, 0, 'DTU MANAJEMEN RISIKO (ITJEN) AKT. I', 0, '0000-00-00', '0000-00-00', '2011-01-24', '2011-01-28', '2011-01-24', '2011-01-28', 0, 29, '', '', '2013-04-05 14:12:22', '', '[READY]', 1),
(83, 0, 'DTSS STRATEGI PORTF.UTANG DAN PENGELOLAAN PHLN (LANJUTAN)', 0, '0000-00-00', '0000-00-00', '2011-01-24', '2011-01-28', '2011-01-24', '2011-01-28', 0, 29, '', '', '2013-04-05 14:12:44', '', '[READY]', 1),
(84, 0, 'DF JFA PENGENDALI TEKNIS', 0, '0000-00-00', '0000-00-00', '2011-01-24', '2011-02-09', '2011-01-24', '2011-02-09', 0, 26, '', '', '2013-04-05 14:13:10', '', '[READY]', 1),
(85, 0, 'DTU ANALISIS BEBAN KERJA AKT.I', 0, '0000-00-00', '0000-00-00', '2011-01-25', '2011-01-27', '2011-01-24', '2011-01-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(86, 0, 'DTU PENYUSUNAN STANDARD OPERATING PROCEDURE AKT.I', 0, '0000-00-00', '0000-00-00', '2011-01-31', '2011-02-02', '2011-01-31', '2011-02-02', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(87, 0, 'DTU KEPEGAWAIAN AKT.I', 0, '0000-00-00', '0000-00-00', '2011-02-07', '2011-02-11', '2011-02-07', '2011-02-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(88, 0, 'DTU MANAJEMEN RISIKO (ITJEN) AKT.II', 0, '0000-00-00', '0000-00-00', '2011-02-07', '2011-02-11', '2011-02-07', '2011-02-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(89, 0, 'PLACEMENT TEST TOEFL PREPARATION', 0, '0000-00-00', '0000-00-00', '2011-02-17', '2011-02-17', '2011-02-17', '2011-02-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(90, 0, 'DTSS PENGELOLAAN SURAT BERHARGA NEGARA (LANJUTAN)', 0, '0000-00-00', '0000-00-00', '2011-02-21', '2011-02-25', '2011-02-21', '2011-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(91, 0, 'DTU BALANCE SCORECARD AKT.I', 0, '0000-00-00', '0000-00-00', '2011-02-21', '2011-02-25', '2011-02-21', '2011-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(92, 0, 'DTU TRAINING NEED ANALYSIS (TNA)', 0, '0000-00-00', '0000-00-00', '2011-02-21', '2011-02-25', '2011-02-21', '2011-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(93, 0, 'DTU ANALISIS BEBAN KERJA AKT.II', 0, '0000-00-00', '0000-00-00', '2011-03-02', '2011-03-04', '2011-02-21', '2011-02-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(94, 0, 'DTSS MANAJEMEN UTANG', 0, '0000-00-00', '0000-00-00', '2011-02-22', '2011-02-25', '2011-02-22', '2011-02-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(95, 0, 'DTU GENERAL ENGLISH AKT.I', 0, '0000-00-00', '0000-00-00', '2011-02-28', '2011-03-18', '2011-02-28', '2011-03-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(96, 0, 'WORKSHOP MENULIS ILMIAH POPULER AKT.I', 0, '0000-00-00', '0000-00-00', '2011-03-02', '2011-03-04', '2011-02-28', '2011-03-02', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(97, 0, 'DTU ORIENTASI PEGAWAI BKF', 0, '0000-00-00', '0000-00-00', '2011-03-21', '2011-03-25', '2011-02-28', '2011-03-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(98, 0, 'DTU PENYUSUNAN STANDARD OPERATING PROCEDURE AKT.II', 0, '0000-00-00', '0000-00-00', '2011-03-02', '2011-03-04', '2011-03-01', '2011-03-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(99, 0, 'DTSS RISK BASED AUDIT (ITJEN)', 0, '0000-00-00', '0000-00-00', '2011-03-07', '2011-03-11', '2011-03-07', '2011-03-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(100, 0, 'DTU BALANCED SCORECARD AKT.II', 0, '0000-00-00', '0000-00-00', '2011-03-07', '2011-03-11', '2011-03-07', '2011-03-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(101, 0, 'DTU TOEFL iBT PREPARATION AKT.I', 0, '0000-00-00', '0000-00-00', '2011-03-07', '2011-04-01', '2011-03-07', '2011-04-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(102, 0, 'DTU MANAJEMEN RISIKO (NON ITJEN) AKT.I', 0, '0000-00-00', '0000-00-00', '2011-03-07', '2011-03-11', '2011-03-07', '2011-03-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(103, 0, 'DTU DESAIN PENGELOLAAN DATABASE AKT.I', 0, '0000-00-00', '0000-00-00', '2011-03-14', '2011-03-18', '2011-03-14', '2011-03-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(104, 0, 'DTSS TEKNIK INTELIJEN (DASAR)', 0, '0000-00-00', '0000-00-00', '2011-02-21', '2011-03-04', '2011-03-21', '2011-04-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(105, 2, 'DTU TATA NASKAH DINAS AKT.I', 0, '0000-00-00', '0000-00-00', '2011-03-21', '2011-03-25', '2011-03-21', '2011-03-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(106, 0, 'SEMINAR PERSIAPAN PENSIUN: PERSPEKTIF PSIKOLOGI DAN PERENCANAAN KEUANGAN', 0, '0000-00-00', '0000-00-00', '2011-03-29', '2011-03-29', '2011-03-29', '2011-03-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(107, 0, 'DTU BALANCED SCORECARD AKT.III', 0, '0000-00-00', '0000-00-00', '2011-04-04', '2011-04-08', '2011-04-04', '2011-04-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(108, 0, 'DTU MICROSOFT OFFICE WORD, EXCEL, DAN POWERPOINT 2007 (ADVANCED) AKT.I', 0, '0000-00-00', '0000-00-00', '2011-04-04', '2011-04-08', '2011-04-04', '2011-04-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(109, 0, 'DTSS TABK TINGKAT DASAR (ACL) AKT. I', 0, '0000-00-00', '0000-00-00', '2011-04-04', '2011-04-08', '2011-04-04', '2011-04-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(110, 0, 'DTSS TEKNIK INTELIJEN (LANJUTAN) AKT. I', 0, '0000-00-00', '0000-00-00', '2011-03-21', '2011-03-26', '2011-04-11', '2011-04-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(111, 0, 'DTU SEKRETARIS PIMPINAN', 0, '0000-00-00', '0000-00-00', '2011-04-11', '2011-04-15', '2011-04-11', '2011-04-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(112, 0, 'DTU METODOLOGI PENELITIAN', 0, '0000-00-00', '0000-00-00', '2011-04-11', '2011-04-15', '2011-04-11', '2011-04-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(113, 0, 'DTSS TABK TINGKAT DASAR (ACL) AKT. II', 0, '0000-00-00', '0000-00-00', '2011-07-11', '2011-07-15', '2011-04-11', '2011-04-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(114, 0, 'DTU MICROSOFT OFFICE WORD, EXCEL, DAN POWERPOINT 2007 (ADVANCED) AKT.II', 0, '0000-00-00', '0000-00-00', '2011-07-18', '2011-07-22', '2011-04-08', '2011-04-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(115, 0, 'DTU MICROSOFT OFFICE EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT MENENGAH AKT.I', 0, '0000-00-00', '0000-00-00', '2011-04-12', '2011-04-21', '2011-04-12', '2011-04-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(116, 0, 'WORKSHOP PENULISAN BUKU TEKS ISBN', 0, '0000-00-00', '0000-00-00', '2011-04-18', '2011-04-21', '2011-04-18', '2011-04-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(117, 0, 'WORKSHOP PERSIAPAN PURNABHAKTI AKT. I', 0, '0000-00-00', '0000-00-00', '2011-04-25', '2011-04-29', '2011-04-25', '2011-04-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(118, 0, 'DTU FREE OPEN SOURCE SOFTWARE', 0, '0000-00-00', '0000-00-00', '2011-04-25', '2011-04-29', '2011-04-25', '2011-04-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(119, 0, 'DTU SISTEM PENGENDALIAN MANAJEMEN', 0, '0000-00-00', '0000-00-00', '2011-04-25', '2011-04-29', '2011-04-25', '2011-04-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(120, 0, 'DTU TOEFL PBT PREPARATION AKT.I', 0, '0000-00-00', '0000-00-00', '2011-04-25', '2011-05-13', '2011-04-25', '2011-05-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(121, 0, 'DTU BALANCED SCORECARD AKT.IV', 0, '0000-00-00', '0000-00-00', '2011-05-02', '2011-05-06', '2011-05-02', '2011-05-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(122, 0, 'DTU LEGAL DRAFTING AKT. I', 0, '0000-00-00', '0000-00-00', '2011-05-02', '2011-05-06', '2011-05-02', '2011-05-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(123, 0, 'DTU DESAIN PENGELOLAAN DATABASE AKT. II', 0, '0000-00-00', '0000-00-00', '2011-05-02', '2011-05-06', '2011-05-02', '2011-05-06', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(124, 0, 'DTU MANAJEMEN PROYEK [...Dana Itjen...]', 0, '0000-00-00', '0000-00-00', '2011-05-09', '2011-05-13', '2011-05-09', '2011-05-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(125, 0, 'DTU MANAJEMEN RISIKO (NON ITJEN) AKT. II', 0, '0000-00-00', '0000-00-00', '2011-05-09', '2011-05-13', '2011-05-09', '2011-05-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(126, 0, 'DTU MICROSOFT OFFICE EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT MENENGAH AKT.II', 0, '0000-00-00', '0000-00-00', '2011-05-09', '2011-05-19', '2011-05-09', '2011-05-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(127, 0, 'DTSS PSIKOLOGI AUDIT', 0, '0000-00-00', '0000-00-00', '2011-05-16', '2011-05-20', '2011-05-18', '2011-05-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(128, 0, 'DTSS TABK Tingkat LANJUTAN (ACL)', 0, '0000-00-00', '0000-00-00', '2011-05-18', '2011-05-24', '2011-05-18', '2011-05-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(129, 0, 'DTU AKUNTANSI BERBASIS KONVERGEN IFRS AKT. I', 0, '0000-00-00', '0000-00-00', '2011-05-23', '2011-05-27', '2011-05-23', '2011-05-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(130, 0, 'DTU PENGELOLAAN WEBSITE UNTUK PELAKSANA AKT. I', 0, '0000-00-00', '0000-00-00', '2011-05-23', '2011-05-27', '2011-05-23', '2011-05-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(131, 0, 'DTU PEMANFAATAN TIK DALAM PEMERINTAHAN (e-GOV) AKT. I', 0, '0000-00-00', '0000-00-00', '2011-05-26', '2011-06-01', '2011-05-26', '2011-06-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(132, 0, 'DTU TOEFL iBT PREPARATION AKT. II', 0, '0000-00-00', '0000-00-00', '2011-05-30', '2011-06-27', '2011-05-30', '2011-06-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(133, 0, 'DTU MICROSOFT OFFICE WORD, EXCEL, DAN POWERPOINT 2007 (ADVANCED) AKT. III', 0, '0000-00-00', '0000-00-00', '2011-06-06', '2011-06-10', '2011-06-06', '2011-06-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(134, 0, 'DTU MICROSOFT ACCESS DASAR [...Dana Itjen...]', 0, '0000-00-00', '0000-00-00', '2011-06-06', '2011-06-10', '2011-06-06', '2011-06-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(135, 2, 'DTU TATA NASKAH DINAS AKT. II', 0, '0000-00-00', '0000-00-00', '2011-06-06', '2011-06-10', '2011-06-06', '2011-06-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(136, 0, 'DTU MANAJEMEN RISIKO (NON ITJEN) AKT. III', 0, '0000-00-00', '0000-00-00', '2011-06-06', '2011-06-10', '2011-06-06', '2011-06-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(137, 0, 'DTU CONTROL SELF ASSESSMENT (CSA)', 0, '0000-00-00', '0000-00-00', '2011-05-09', '2011-05-13', '2011-06-13', '2011-06-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(138, 0, 'DTSS EVALUASI JOB GRADING', 0, '0000-00-00', '0000-00-00', '2011-06-13', '2011-06-17', '2011-06-13', '2011-06-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(139, 0, 'DTU PEMROGRAMAN WEB DENGAN ASP', 0, '0000-00-00', '0000-00-00', '2011-06-13', '2011-06-17', '2011-06-13', '2011-06-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(140, 0, 'DTU LEGAL DRAFTING AKT. II', 0, '0000-00-00', '0000-00-00', '2011-06-13', '2011-06-17', '2011-06-13', '2011-06-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(141, 0, 'DTU AKUNTANSI KEUANGAN SYARIAH', 0, '0000-00-00', '0000-00-00', '2011-06-20', '2011-06-24', '2011-06-20', '2011-06-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(142, 0, 'WORKSHOP FINANCIAL STATISTIC (MINITAB, EXCEL, E-VIEW)', 0, '0000-00-00', '0000-00-00', '2011-06-20', '2011-06-24', '2011-06-20', '2011-06-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(143, 0, 'DTU BUSINESS ENGLISH AKT. I', 0, '0000-00-00', '0000-00-00', '2011-06-20', '2011-06-24', '2011-06-20', '2011-06-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(144, 0, 'DTSS Ms ACCESS FOR AUDITING [...Dana Itjen...]', 0, '0000-00-00', '0000-00-00', '2011-06-20', '2011-06-28', '2011-06-20', '2011-06-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(145, 0, 'DTU TOEFL PBT PREPARATION AKT. II', 0, '0000-00-00', '0000-00-00', '2011-06-23', '2011-07-14', '2011-06-23', '2011-07-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(146, 0, 'DTU MICROSOFT OFFICE EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT LANJUTAN AKT. I', 0, '0000-00-00', '0000-00-00', '2011-06-27', '2011-07-07', '2011-06-27', '2011-07-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(147, 0, 'SEMINAR SPIP: STRATEGI IMPLEMENTASI DI LINGKUNGAN KEMENTERIAN KEUANGAN', 0, '0000-00-00', '0000-00-00', '2011-05-25', '2011-05-25', '2011-06-28', '2011-06-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(148, 0, 'DTSS AUDIT SAMPLING [...Dana Itjen...]', 0, '0000-00-00', '0000-00-00', '2011-07-04', '2011-07-08', '2011-07-04', '2011-07-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(149, 0, 'DTU KEARSIPAN ELEKTRONIK AKT. I', 0, '0000-00-00', '0000-00-00', '2011-07-04', '2011-07-08', '2011-07-04', '2011-07-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(150, 0, 'DTU GENERAL ENGLISH AKT. II', 0, '0000-00-00', '0000-00-00', '2011-07-04', '2011-07-22', '2011-07-04', '2011-07-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(151, 2, 'DTU TATA NASKAH DINAS AKT. III', 0, '0000-00-00', '0000-00-00', '2011-07-11', '2011-07-15', '2011-07-11', '2011-07-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(152, 0, 'DTU LEGAL DRAFTING AKT. III', 0, '0000-00-00', '0000-00-00', '2011-07-11', '2011-07-15', '2011-07-11', '2011-07-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(153, 0, 'DTU TATA KELOLA TIK (IT GOVERNANCE)', 0, '0000-00-00', '0000-00-00', '2011-07-18', '2011-07-22', '2011-07-18', '2011-07-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(154, 0, 'DTSS TEKNIK INVESTIGASI', 0, '0000-00-00', '0000-00-00', '2011-07-20', '2011-08-05', '2011-07-20', '2011-08-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(155, 0, 'DTU ADMINISTRASI JARINGAN KOMPUTER AKT. I', 0, '0000-00-00', '0000-00-00', '2011-07-25', '2011-07-29', '2011-07-25', '2011-07-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(156, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS AKT. I', 0, '0000-00-00', '0000-00-00', '2011-07-25', '2011-07-29', '2011-07-25', '2011-08-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(157, 0, 'DTU KEARSIPAN DINAMIS AKT. I', 0, '0000-00-00', '0000-00-00', '2011-07-25', '2011-07-29', '2011-07-25', '2011-07-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(158, 0, 'DTU MICROSOFT OFFICE EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT LANJUTAN AKT. II', 0, '0000-00-00', '0000-00-00', '2011-08-01', '2011-08-10', '2011-08-01', '2011-08-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(159, 0, 'DTU ADMINISTRASI JARINGAN KOMPUTER AKT. II', 0, '0000-00-00', '0000-00-00', '2011-08-01', '2011-08-05', '2011-08-01', '2011-08-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(160, 0, 'DTSS IMPLEMENTASI BSC UNTUK FUNGSI AUDIT INTERNAL', 0, '0000-00-00', '0000-00-00', '2011-07-18', '2011-07-22', '2011-08-08', '2011-08-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(161, 0, 'DTU PEMANFAATAN TIK DALAM PEMERINTAHAN (e-GOV) AKT. II', 0, '0000-00-00', '0000-00-00', '2011-08-08', '2011-08-12', '2011-08-08', '2011-08-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(162, 1, 'DF PRANATA KOMPUTER TERAMPIL [...Dana DJPBN...]', 0, '0000-00-00', '0000-00-00', '2011-08-25', '2011-09-23', '2011-08-25', '2011-09-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(163, 0, 'DTU PENGELOLAAN WEBSITE UNTUK PELAKSANA AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-12', '2011-09-16', '2011-09-12', '2011-09-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(164, 0, 'DTU BUSINESS ENGLISH AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-12', '2011-09-16', '2011-09-12', '2011-09-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(165, 0, 'WORKSHOP PERSIAPAN PURNABHAKTI AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-12', '2011-09-16', '2011-09-12', '2011-09-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(166, 0, 'DTU TOEFL iBT PREPARATION AKT. III', 0, '0000-00-00', '0000-00-00', '2011-09-13', '2011-10-10', '2011-09-13', '2011-10-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(167, 0, 'DTU GENERAL ENGLISH AKT. III', 0, '0000-00-00', '0000-00-00', '2011-09-14', '2011-10-04', '2011-09-13', '2011-10-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(168, 0, 'DTSS INVESTIGASI (LANJUTAN)', 0, '0000-00-00', '0000-00-00', '2011-04-11', '2011-04-16', '2011-09-19', '2011-09-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(169, 0, 'DTU KNOWLEDGE MANAGEMENT UNTUK ORGANISASI AKT. I', 0, '0000-00-00', '0000-00-00', '2011-09-19', '2011-09-23', '2011-09-19', '2011-09-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(170, 0, 'DTU LEGAL ENGLISH', 0, '0000-00-00', '0000-00-00', '2011-09-20', '2011-09-23', '2011-09-20', '2011-09-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(171, 0, 'DTU ANALISIS JABATAN', 0, '0000-00-00', '0000-00-00', '2011-09-20', '2011-09-22', '2011-09-20', '2011-09-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(172, 0, 'SEMINAR PERSIAPAN PENSIUN: PERSPEKTIF PSIKOLOGI, KEUANGAN, ENTERPRENEURSHIP, DAN KESEHATAN', 0, '0000-00-00', '0000-00-00', '2011-07-21', '2011-07-21', '2011-09-22', '2011-09-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(173, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-19', '2011-09-23', '2011-09-26', '2011-10-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(174, 0, 'DTU KEARSIPAN ELEKTRONIK AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-26', '2011-09-30', '2011-09-26', '2011-09-30', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(175, 0, 'DTU KEARSIPAN DINAMIS AKT. II', 0, '0000-00-00', '0000-00-00', '2011-09-27', '2011-10-04', '2011-09-27', '2011-10-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(176, 0, 'DTSS FORENSIK AUDIT (ITJEN) [...Cancelled...]', 0, '0000-00-00', '0000-00-00', '2011-05-31', '2011-06-14', '2011-10-03', '2011-10-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(177, 0, 'DTU DESAIN MULTIMEDIA', 0, '0000-00-00', '0000-00-00', '2011-07-04', '2011-07-08', '2011-10-03', '2011-10-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(178, 0, 'DTU KNOWLEDGE MANAGEMENT UNTUK ORGANISASI AKT. II', 0, '0000-00-00', '0000-00-00', '2011-10-03', '2011-10-07', '2011-10-03', '2011-10-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(179, 0, 'DTU TOEFL PBT PREPARATION AKT. III', 0, '0000-00-00', '0000-00-00', '2011-10-10', '2011-10-28', '2011-10-10', '2011-10-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(180, 0, 'DTU KEPEGAWAIAN', 0, '0000-00-00', '0000-00-00', '2011-10-10', '2011-10-14', '2011-10-10', '2011-10-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(181, 0, 'DTSD PENGELOLAAN DIKLAT GOLONGAN II [...Optimalisasi DIPA...]', 0, '0000-00-00', '0000-00-00', '2011-10-10', '2011-10-21', '2011-10-10', '2011-10-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(182, 0, 'WORKSHOP PERSIAPAN PURNABHAKTI AKT. III', 0, '0000-00-00', '0000-00-00', '2011-10-17', '2011-10-21', '2011-10-17', '2011-10-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(183, 0, 'DTSS AUDIT TIK [...Subtitusi ACL Lanjutan...]', 0, '0000-00-00', '0000-00-00', '2011-10-17', '2011-10-21', '2011-10-17', '2011-10-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(184, 0, 'DF JFA PEMBENTUKAN AUDITOR TERAMPIL (ITJEN)', 0, '0000-00-00', '0000-00-00', '2011-09-26', '2011-10-14', '2011-10-24', '2011-11-11', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(185, 0, 'DTU BUSINESS ENGLISH AKT. III', 0, '0000-00-00', '0000-00-00', '2011-10-24', '2011-10-28', '2011-10-24', '2011-10-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(186, 0, 'DTU TRAINING OF TRAINER [...Optimalisasi DIPA...]', 0, '0000-00-00', '0000-00-00', '2011-10-24', '2011-10-26', '2011-10-24', '2011-10-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(187, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS (e-LEARNING)', 0, '0000-00-00', '0000-00-00', '2011-10-27', '2011-12-09', '2011-10-27', '2011-12-09', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(188, 0, 'DTSS PERFORMANCE AUDIT [...Dana Itjen...]', 0, '0000-00-00', '0000-00-00', '2011-07-11', '2011-07-15', '2011-10-31', '2011-11-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(189, 0, 'DTU GENERAL ENGLISH IV [...Subtitusi iBT...]', 0, '0000-00-00', '0000-00-00', '2011-10-31', '2011-11-25', '2011-10-31', '2011-11-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(190, 3, 'DF CALON WIDYAISWARA (PROGRAM UMUM &amp; KHUSUS) [...Optimalisasi Anggaran...]', 0, '0000-00-00', '0000-00-00', '2011-11-01', '2011-12-10', '2011-11-01', '2011-12-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(191, 0, 'DTU MICROSOFT OFFICE WORD, EXCEL, DAN POWERPOINT 2007 (ADVANCED) AKT. IV', 0, '0000-00-00', '0000-00-00', '2011-09-26', '2011-09-30', '2011-11-14', '2011-11-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(192, 0, 'WORKSHOP PERSIAPAN PURNABHAKTI AKT. IV', 0, '0000-00-00', '0000-00-00', '2011-11-14', '2011-11-18', '2011-11-14', '2011-11-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(193, 0, 'DTU COMPETENCY PROFILING', 0, '0000-00-00', '0000-00-00', '2011-11-14', '2011-11-17', '2011-11-14', '2011-11-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(194, 0, 'DTU PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI [...Optimalisasi DIPA...]', 0, '0000-00-00', '0000-00-00', '2011-11-14', '2011-11-18', '2011-11-14', '2011-11-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(195, 0, 'WORKSHOP MENULIS ILMIAH POPULER AKT. II', 0, '0000-00-00', '0000-00-00', '2011-11-15', '2011-11-17', '2011-11-15', '2011-11-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(196, 0, 'WORKSHOP DIPLOMASI KERJA SAMA INTERNASIONAL [... Dana DJBC...]', 0, '0000-00-00', '0000-00-00', '2011-11-16', '2011-11-18', '2011-11-16', '2011-11-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(197, 0, 'WORKSHOP PURNABHAKTI (MAKASAR) [...Optimalisasi DIPA...]', 0, '0000-00-00', '0000-00-00', '2011-11-21', '2011-11-25', '2011-11-21', '2011-11-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(198, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS DAN KAJIAN PERPAJAKAN AKT. I [...Dana DJP...]', 0, '0000-00-00', '0000-00-00', '2011-11-21', '2011-11-23', '2011-11-21', '2011-11-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(199, 0, 'WORKSHOP PELAYANAN PRIMA (ITJEN) AKT. II [...Subtitusi JFA Ahli...]', 0, '0000-00-00', '0000-00-00', '2011-11-25', '2011-11-26', '2011-11-25', '2011-11-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(200, 0, 'SEMINAR KEBIJAKAN EKONOMI MAKRO: POKOK-POKOK KEBIJAKAN EKONOMI MAKRO APBN 2012', 0, '0000-00-00', '0000-00-00', '2011-10-04', '2011-10-04', '2011-11-26', '2011-11-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(201, 0, 'DTSS PENANGANAN USM STAN [...Optimalisasi DIPA...]', 0, '0000-00-00', '0000-00-00', '2011-10-17', '2011-11-04', '2011-11-28', '2011-12-02', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(202, 0, 'DTSD PENGELOLAAN DIKLAT GOL. III AKT. II', 0, '0000-00-00', '0000-00-00', '2011-01-21', '2011-02-02', '2011-01-21', '2011-02-02', 0, 30, '', '', '2013-04-05 14:11:17', '', '[READY]', 1),
(203, 0, 'WORKSHOP PELAYANAN PRIMA (ITJEN) AKT. I [...Subtitusi JFA Ahli...]', 0, '0000-00-00', '0000-00-00', '2011-11-18', '2011-11-19', '2011-11-18', '2011-11-19', 0, 0, '', '', '2011-11-09 15:49:22', '', '[READY]', 1),
(204, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS DAN KAJIAN PERPAJAKAN AKT. II [...Dana DJP...]', 0, '0000-00-00', '0000-00-00', '2011-11-28', '2011-11-30', '2011-11-28', '2011-11-30', 0, 0, '', '', '2011-11-09 16:01:04', '', '[READY]', 1),
(205, 0, 'DTSD PENGELOLAAN DIKLAT GOL. III AKT. III', 0, '0000-00-00', '0000-00-00', '2011-01-21', '2011-02-02', '2011-01-21', '2011-02-02', 0, 30, '', '', '2013-04-05 14:11:28', '', '[READY]', 1),
(207, 0, 'DTSS FORENSIK AUDIT', 91, '2012-02-06', '2012-02-21', '2012-02-06', '2012-02-21', '2012-02-06', '2012-02-20', 35, 44, 'R703 PKU', '', '2012-04-19 15:12:28', '', '[READY]', 1),
(208, 0, 'DTU MICROSOFT ACCESS DASAR', 44, '2012-02-13', '2012-02-16', '2012-02-13', '2012-02-17', '2012-02-13', '2012-02-16', 35, 24, 'Lab Purnawarman', '', '2012-04-19 15:43:21', '', '[READY]', 1),
(209, 0, 'DTU FREE OPEN SOURCE SOFTWARE AKT. I', 44, '2012-02-13', '2012-02-17', '2012-02-13', '2012-02-17', '2012-02-13', '2012-02-17', 35, 29, 'Lab803 PKU', '', '2012-04-19 15:43:30', '', '[READY]', 1),
(210, 0, 'DTU ADMINISTRASI JARINGAN KOMPUTER AKT. I', 42, '2012-02-20', '2012-02-24', '2012-02-13', '2012-02-17', '2012-02-20', '2012-02-24', 35, 26, 'Lab801 PKU', '', '2012-04-19 14:45:28', '', '[READY]', 1),
(211, 0, 'DTSS PENYUSUNAN MODUL', 35, '2012-02-13', '2012-02-16', '2012-02-13', '2012-02-17', '2012-02-13', '2012-02-16', 35, 30, 'R701 PKU', '', '2012-04-19 15:43:11', '', '[READY]', 1),
(212, 0, 'DTSD PENGELOLAAN DIKLAT GOLONGAN II AKT. I [...Peserta BPPK...]', 80, '2012-02-20', '2012-03-01', '2012-02-20', '2012-02-24', '2012-02-20', '2012-03-01', 0, 30, 'Hotel/Eksternal', '', '2012-08-30 15:31:52', '', '[READY]', 1),
(213, 0, 'DTU KEARSIPAN DINAMIS AKT. I', 34, '2012-02-20', '2012-02-24', '2012-02-20', '2012-02-23', '2012-02-20', '2012-02-24', 35, 31, 'R601 PKU', '', '2012-04-19 14:45:14', '', '[READY]', 1),
(214, 0, 'DTU MICROSOFT EXCEL DAN POWERPOINT 2007 TINGKAT TINGGI AKT. I', 63, '2012-02-27', '2012-03-06', '2012-02-27', '2012-03-02', '2012-02-27', '2012-03-06', 35, 32, 'Lab801 PKU', '', '2012-10-23 11:22:54', '', '[READY]', 1),
(215, 2, 'DTU TATA NASKAH DINAS AKT. I', 47, '2012-02-27', '2012-03-02', '2012-02-27', '2012-03-02', '2012-02-27', '2012-03-02', 35, 34, 'R701 PKU', '', '2012-04-19 15:48:39', '', '[READY]', 1),
(216, 0, 'DTSD PENGELOLAAN DIKLAT GOLONGAN II AKT. II [...Peserta BPPK...]', 0, '2012-04-30', '2012-05-10', '2012-03-05', '2012-03-09', '2012-04-30', '2012-05-10', 0, 0, 'Hotel/Eksternal', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN', '2012-08-30 15:32:02', '', '[READY]', 1),
(218, 1, 'DFP PRANATA KOMPUTER TERAMPIL', 208, '2012-02-27', '2012-03-30', '2012-02-27', '2012-03-29', '2012-02-27', '2012-03-30', 39, 25, 'Lab803 PKU', '', '2012-04-19 14:47:16', '', '[READY]', 1),
(219, 0, 'DTU ANALISIS BEBAN KERJA AKT. I', 40, '2012-03-05', '2012-03-09', '2012-03-05', '2012-03-09', '2012-03-05', '2012-03-09', 0, 23, 'R701 PKU', '', '2012-04-19 15:51:17', '', '[READY]', 1),
(220, 0, 'DTU METODOLOGI PENELITIAN', 48, '2012-03-05', '2012-03-09', '2012-03-05', '2012-03-09', '2012-03-05', '2012-03-09', 0, 36, 'Aula PKU', '', '2012-04-19 15:50:27', '', '[READY]', 1),
(221, 0, 'DTSS DANA PENSIUN DAN ASURANSI', 36, '2012-03-05', '2012-03-08', '2012-03-05', '2012-03-09', '2012-03-05', '2012-03-08', 35, 31, 'R601 PKU', 'semula: DTSS MANAJEMEN DANA PENSIUN DAN ASURANSI', '2012-06-14 09:29:06', '', '[READY]', 1),
(222, 0, 'DTU LEGAL DRAFTING AKT. I', 37, '2012-03-12', '2012-03-16', '2012-03-12', '2012-03-16', '2012-03-12', '2012-03-16', 0, 29, 'R701 PKU', '', '2012-04-19 15:53:59', '', '[READY]', 1),
(223, 0, 'DTU PERSIAPAN PURNABHAKTI AKT. I', 42, '2012-03-12', '2012-03-16', '2012-03-12', '2012-03-16', '2012-03-12', '2012-03-16', 0, 23, 'Aula PKU', '', '2012-06-14 09:20:09', '', '[READY]', 1),
(225, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT LANJUTAN AKT. I', 60, '2012-03-12', '2012-03-20', '2012-03-12', '2012-03-20', '2012-03-12', '2012-03-20', 0, 26, 'Lab801 PKU', 'semula menengah', '2012-12-12 08:54:42', '', '[READY]', 1),
(226, 0, 'DTU MANAJEMEN SDM TINGKAT DASAR', 60, '2012-03-12', '2012-03-21', '2012-03-12', '2012-03-21', '2012-03-12', '2012-03-21', 0, 26, 'R601 PKU', '', '2012-04-19 15:56:24', '', '[READY]', 1),
(227, 0, 'DTU PENYUSUNAN SOP (STANDARD OPERATING PROCEDURED) AKT. I', 32, '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', 0, 30, 'R701 PKU', '', '2012-04-19 15:59:26', '', '[READY]', 1),
(228, 0, 'DTU COMPETENCY PROFILING AKT. I', 36, '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', 0, 29, 'Aula PKU', '', '2012-04-19 15:59:09', '', '[READY]', 1),
(229, 0, 'DTSS PERGADAIAN DAN MODAL VENTURA', 30, '2012-03-20', '2012-03-22', '2012-03-20', '2012-03-22', '2012-03-20', '2012-03-22', 0, 22, 'R703 PKU', 'semula: DTSS PEGADAIAN DAN MODAL VENTURA', '2012-06-14 09:29:25', '', '[READY]', 1),
(231, 0, 'DTU MANAJEMEN RISIKO AKT. I', 42, '2012-03-26', '2012-03-30', '2012-03-26', '2012-03-30', '2012-03-26', '2012-03-30', 0, 36, 'R703 PKU', '', '2012-04-19 16:04:14', '', '[READY]', 1),
(233, 0, 'DTU ANALISIS JABATAN AKT. I', 34, '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', 0, 0, 'R701 PKU', '', '2012-04-19 16:07:57', '', '[READY]', 1),
(234, 0, 'DTU SEKRETARIS PIMPINAN', 40, '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', 0, 0, 'R603 PKU', '', '2012-04-19 16:07:23', '', '[READY]', 1),
(235, 0, 'DTSS AUDIT SAMPLING [...Peserta ITJEN...]', 0, '2012-10-22', '2012-10-25', '2012-10-22', '2012-10-25', '0000-00-00', '0000-00-00', 0, 0, 'R701 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED', '2012-10-16 16:52:34', '', '[READY]', 1),
(236, 0, 'DFP PRANATA KOMPUTER AHLI', 214, '2012-04-02', '2012-05-10', '2012-04-02', '2012-05-10', '2012-04-02', '2012-05-10', 0, 0, 'Lab803 PKU', '', '2012-06-14 08:20:44', '', '[READY]', 1),
(237, 0, 'DTSS AUDIT IMPLEMENTASI KINERJA [...Peserta ITJEN...]', 0, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', 'semula: DTSS IMPLEMENTASI BSC UNTUK FUNGSI AUDIT INTERNAL [...Peserta ITJEN...] CANCELED-CANCELED-CANCELED', '2012-08-14 11:13:55', '', '[READY]', 1),
(238, 0, 'DTU BUSINESS ENGLISH AKT. I', 40, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', 0, 0, 'R601 PKU', '', '2012-04-19 16:14:25', '', '[READY]', 1),
(239, 0, 'DTU DESAIN PENGELOLAAN DATABASE AKT. I', 42, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', 0, 0, 'Lab801 PKU', '', '2012-04-19 16:13:26', '', '[READY]', 1),
(240, 0, 'DTU MANAJEMEN SDM TINGKAT LANJUTAN', 47, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', 0, 0, 'R701 PKU', '&gt;&gt;&gt; semula: DTU MANAJEMEN SDM TINGKAT MENENGAH', '2012-05-14 09:05:33', '', '[READY]', 1),
(241, 0, 'DTU TRAINING OF TRAINERS (TOT) AKT. I', 47, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:42:03', '', '[READY]', 1),
(242, 0, 'DTU PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI AKT. I', 44, '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', '2012-04-09', '2012-04-13', 0, 0, 'Aula PKU', '', '2012-04-19 16:10:57', '', '[READY]', 1),
(243, 0, 'DTU TOEFL PBT PREPARATION AKT. I', 135, '2012-04-09', '2012-04-27', '2012-04-09', '2012-04-27', '2012-04-09', '2012-04-27', 0, 0, 'R603 PKU', '', '2012-04-30 09:06:07', '', '[READY]', 1),
(244, 0, 'DTU MANAJEMEN RISIKO AKT. II', 0, '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', 0, 0, 'Aula PKU', '', '2012-04-30 09:16:44', '', '[READY]', 1),
(245, 0, 'DTU ANALISIS BEBAN KERJA AKT. II', 0, '2012-04-16', '2012-04-20', '2012-04-16', '2012-04-20', '2012-04-16', '2012-04-20', 0, 0, 'R701 PKU', '', '2012-04-30 10:04:54', '', '[READY]', 1),
(246, 0, 'DTU LEASING dan FACTORING', 30, '2012-04-16', '2012-04-18', '2012-04-16', '2012-04-18', '2012-04-16', '2012-04-18', 0, 0, 'Aula PKU', 'semula: DTSS PERUSAHAAN PEMBIAYAAN (LEASING, FACTORING, CC)', '2012-04-30 09:09:36', '', '[READY]', 1),
(247, 0, 'DTU TOEFL PBT PREPARATION AKT. II', 0, '2012-04-16', '2012-05-04', '2012-04-16', '2012-05-04', '2012-04-16', '2012-05-04', 0, 0, 'R601 PKU', '', '2012-05-07 11:08:23', '', '[READY]', 1),
(248, 0, 'DTU PENGELOLAAN KINERJA ORGANISASI AKT I', 0, '2012-05-28', '2012-06-01', '2012-05-07', '2012-05-11', '2012-05-28', '2012-06-01', 0, 0, 'R703 PKU', 'semula: DTU BALANCE SCORECARD AKT. I', '2012-06-13 11:17:22', '', '[READY]', 1),
(249, 2, 'DTU TATA NASKAH DINAS AKT. II', 0, '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', 0, 0, 'R701 PKU', '', '2012-04-30 09:15:44', '', '[READY]', 1),
(250, 0, 'DTSS AUDIT TIK TINGKAT DASAR AGK I [...Peserta ITJEN...]', 46, '2012-10-15', '2012-10-19', '2012-10-08', '2012-10-12', '0000-00-00', '0000-00-00', 35, 0, 'R701 PKU', '', '2012-10-11 14:38:02', '', '[READY]', 1),
(251, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT TINGGI AKT. I', 0, '2012-04-23', '2012-05-01', '2012-04-23', '2012-05-01', '2012-04-23', '2012-05-01', 0, 0, 'Lab801 PKU', 'semula lanjutan', '2012-12-12 08:54:49', '', '[READY]', 1),
(252, 0, 'DTSS TEKNIK INTELIJEN (DASAR)', 0, '2012-04-23', '2012-05-04', '2012-04-23', '2012-05-04', '2012-04-23', '2012-05-04', 0, 0, 'Others', '', '2012-05-07 11:09:14', '', '[READY]', 1),
(253, 0, 'DTU CONTROL SELF ASSESSMENT (CSA) AKT. I', 0, '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', 0, 0, 'R703 PKU', '', '2012-05-07 11:17:11', '', '[READY]', 1),
(254, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS AKT. I', 0, '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', 0, 0, 'Aula PKU', '', '2012-05-07 11:06:05', '', '[READY]', 1),
(255, 0, 'DTU ANALISIS JABATAN AKT. II', 0, '2012-05-01', '2012-05-04', '2012-05-01', '2012-05-04', '2012-05-01', '2012-05-04', 0, 0, 'R701 PKU', '', '2012-05-07 11:28:13', '', '[READY]', 1),
(256, 0, 'DTU PEMANTAUAN PENGENDALIAN INTERNAL AKT. I', 0, '2012-06-04', '2012-06-08', '2012-05-07', '2012-05-11', '2012-06-04', '2012-06-08', 0, 0, '', 'semula: DTU PENINGKATAN IMPLEMENTASI PENGENDALIAN INTERNAL AKT. I', '2012-06-13 11:18:44', '', '[READY]', 1),
(258, 0, 'DTU FREE OPEN SOURCE SOFTWARE AKT. II', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'Lab803 PKU', '', '2012-06-11 11:35:55', '', '[READY]', 1),
(259, 0, 'DTU MANAJEMEN RISIKO AKT. III', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'R601 PKU', '', '2012-06-11 11:34:07', '', '[READY]', 1),
(260, 0, 'DTU PENYUSUNAN SOP (STANDARD OPERATING PROCEDURED) AKT. II', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'R701 PKU', '', '2012-06-11 11:35:05', '', '[READY]', 1);
INSERT INTO `testing` (`id_training`, `id_program`, `name_training`, `hours_training`, `revision_plan_start_training`, `revision_plan_finish_training`, `plan_start_training`, `plan_finish_training`, `start_training`, `finish_training`, `plan_participant_training`, `participant_training`, `location_training`, `note_training`, `update_training`, `main_user`, `status_training`, `certificate_type`) VALUES
(261, 0, 'DTU PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI AKT. II', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:36:24', '', '[READY]', 1),
(262, 0, 'DTU PERSIAPAN PURNABHAKTI AKT. II', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'Aula PKU', '', '2012-06-14 09:20:27', '', '[READY]', 1),
(263, 0, 'DTU GENERAL ENGLISH AKT. I', 0, '2012-05-07', '2012-05-29', '2012-05-07', '2012-05-29', '2012-05-07', '2012-05-29', 0, 0, 'R603 PKU', '', '2012-06-11 11:39:38', '', '[READY]', 1),
(264, 0, 'DTU LEGAL ENGLISH AKT. I', 0, '2012-05-14', '2012-05-16', '2012-05-14', '2012-05-16', '2012-05-14', '2012-05-16', 0, 0, 'R703 PKU', '', '2012-06-11 11:30:37', '', '[READY]', 1),
(265, 0, 'DTU GENERAL ENGLISH AKT. II', 0, '2012-05-14', '2012-06-05', '2012-05-14', '2012-06-05', '2012-05-14', '2012-06-05', 0, 0, 'R701 PKU', '', '2012-06-11 12:03:20', '', '[READY]', 1),
(266, 0, 'DTU MANAJEMEN SDM TINGKAT TINGGI', 0, '2012-06-05', '2012-06-06', '2012-05-15', '2012-05-16', '2012-06-05', '2012-06-06', 0, 0, 'Aula PKU', '&gt;&gt;&gt; semula: DTU MANAJEMEN SDM TINGKAT LANJUTAN', '2012-06-13 11:20:51', '', '[READY]', 1),
(267, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS (E-LEARNING)', 0, '2012-06-21', '2012-09-06', '2012-05-18', '2012-06-29', '2012-06-21', '2012-09-06', 0, 0, 'Others', '', '2012-09-06 08:38:52', '', '[READY]', 1),
(268, 0, 'DTU KEARSIPAN DINAMIS AKT. II', 0, '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-26', '2012-04-23', '2012-04-27', 0, 0, 'R601 PKU', '', '2012-04-30 09:16:32', '', '[READY]', 1),
(269, 0, 'DTU MICROSOFT EXCEL DAN POWERPOINT 2007 TINGKAT TINGGI AKT. II', 0, '2012-05-21', '2012-05-29', '2012-05-21', '2012-05-29', '2012-05-21', '2012-05-29', 0, 0, 'Lab801 PKU', '', '2012-10-23 11:22:28', '', '[READY]', 1),
(270, 0, 'DTU PEMROGRAMAN WEB DASAR', 0, '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', 0, 0, 'Lab803 PKU', 'BARU-BARU-BARU-BARU-BARU', '2012-08-14 12:58:16', '', '[READY]', 1),
(271, 0, 'DTU KNOWLEDGE MANAGEMENT UNTUK ORGANISASI', 0, '2012-05-21', '2012-05-25', '2012-05-21', '2012-05-25', '2012-05-21', '2012-05-25', 0, 0, 'Aula PKU', '', '2012-06-11 11:29:11', '', '[READY]', 1),
(272, 0, 'DTSS PSIKOLOGI AUDIT', 0, '2012-05-21', '2012-05-25', '2012-05-22', '2012-05-25', '2012-05-21', '2012-05-25', 0, 0, 'R703 PKU', '', '2012-06-11 11:24:47', '', '[READY]', 1),
(273, 0, 'DTU BUSINESS ENGLISH AKT. II', 0, '2012-05-28', '2012-06-01', '2012-05-28', '2012-06-01', '2012-05-28', '2012-06-01', 0, 0, 'R601 PKU', '', '2012-06-13 11:16:47', '', '[READY]', 1),
(275, 0, 'DTSS TEKNIK INVESTIGASI DASAR', 0, '2012-05-28', '2012-06-11', '2012-05-28', '2012-06-13', '2012-05-28', '2012-06-11', 0, 0, 'R703 PKU', '', '2012-06-14 08:18:47', '', '[READY]', 1),
(276, 0, 'DTU TOEFL iBT PREPARATION AKT. I', 0, '2012-05-28', '2012-06-22', '2012-05-28', '2012-06-22', '2012-05-28', '2012-06-22', 0, 0, 'Lab803 PKU', '', '2012-06-19 18:52:15', '', '[READY]', 1),
(277, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS AKT. II', 0, '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', 0, 0, 'R603 PKU', '', '2012-06-13 11:19:06', '', '[READY]', 1),
(278, 0, 'DTU TRAINING OF TRAINERS (TOT) AKT. II', 0, '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', 0, 0, 'Hotel/Eksternal', '', '2012-06-13 11:19:28', '', '[READY]', 1),
(279, 0, 'DTU MANAJEMEN PROYEK TEKNOLOGI INFORMASI (ITPM)', 0, '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', 0, 0, 'R601 PKU', '', '2012-06-13 11:18:00', '', '[READY]', 1),
(280, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT LANJUTAN AKT. II', 0, '2012-06-04', '2012-06-12', '2012-06-04', '2012-06-12', '2012-06-04', '2012-06-12', 0, 0, 'Lab801 PKU', 'semula menengah', '2012-12-12 08:55:00', '', '[READY]', 1),
(281, 0, 'DTU COMPETENCY PROFILING AKT. II', 0, '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-14', '2012-06-11', '2012-06-15', 0, 0, 'R603 PKU', '', '2012-06-19 18:59:31', '', '[READY]', 1),
(282, 0, 'DTU TATA KELOLA TIK', 0, '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', 0, 0, 'Aula PKU', '', '2012-06-19 18:59:55', '', '[READY]', 1),
(283, 0, 'DTU ANALISIS BEBAN KERJA AKT. III', 0, '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', 0, 0, 'R701 PKU', '', '2012-06-19 19:00:22', '', '[READY]', 1),
(284, 2, 'DTU TATA NASKAH DINAS AKT. III', 0, '2012-06-18', '2012-06-22', '2012-06-18', '2012-06-22', '2012-06-18', '2012-06-22', 0, 0, 'R701 PKU', '', '2012-06-19 19:03:30', '', '[READY]', 1),
(285, 0, 'DTU AKUNTANSI KEUANGAN SYARI''AH', 0, '2012-06-18', '2012-06-22', '2012-06-18', '2012-06-22', '2012-06-18', '2012-06-22', 0, 0, 'R601 PKU', '', '2012-08-14 11:55:54', '', '[READY]', 1),
(286, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT TINGGI', 0, '2012-06-18', '2012-06-26', '2012-06-18', '2012-06-26', '2012-06-18', '2012-06-26', 0, 0, 'Lab801 PKU', 'semula Lanjutan', '2012-12-12 08:55:08', '', '[READY]', 1),
(287, 0, 'DTU TOEFL PBT PREPARATION AKT. III', 0, '2012-06-18', '2012-07-06', '2012-06-18', '2012-07-06', '2012-06-18', '2012-07-06', 0, 0, 'R603 PKU', '', '2012-06-19 19:14:15', '', '[READY]', 1),
(289, 0, 'DTU MICROSOFT EXCEL DAN POWERPOINT 2007 TINGKAT TINGGI AKT. III', 0, '2012-07-02', '2012-07-10', '2012-07-02', '2012-07-10', '2012-07-02', '2012-07-10', 0, 0, 'Lab801 PKU', '', '2012-11-12 10:39:06', '', '[READY]', 1),
(290, 0, 'DTU MANAJEMEN RISIKO AKT. IV', 42, '2012-04-09', '2012-04-13', '2012-07-02', '2012-07-06', '2012-04-09', '2012-04-13', 0, 0, '', '', '2012-08-14 13:03:29', '', '[READY]', 1),
(291, 0, 'DTU LEGAL DRAFTING AKT. II', 0, '2012-07-02', '2012-07-06', '2012-07-02', '2012-07-06', '0000-00-00', '0000-00-00', 0, 0, 'R701 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(292, 0, 'DTU TOEFL iBT PREPARATION AKT. II', 0, '2012-07-02', '2012-07-27', '2012-07-02', '2012-07-27', '2012-07-02', '2012-07-27', 0, 0, 'Lab803 PKU', '', '2012-11-12 10:36:53', '', '[READY]', 1),
(293, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS AKT. III', 0, '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-16', 0, 0, 'Aula PKU', '', '2012-08-14 12:21:20', '', '[READY]', 1),
(294, 0, 'DTU BUSINESS ENGLISH AKT. III', 0, '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-16', 0, 0, 'R601 PKU', '', '2012-08-14 12:18:56', '', '[READY]', 1),
(295, 0, 'DTU PEMANTAUAN PENGENDALIAN INTERNAL AKT.II', 0, '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-16', 0, 0, 'R701 PKU', 'semula: DTU PENINGKATAN IMPLEMENTASI PENGENDALIAN INTERNAL AKT. II', '2012-08-14 12:18:16', '', '[READY]', 1),
(296, 0, 'DTU CONTROL SELF ASSESSMENT (CSA) AKT. II', 0, '2012-04-16', '2012-04-20', '2012-04-16', '2012-04-20', '2012-04-16', '2012-04-20', 0, 0, 'R603 PKU', '', '2012-04-30 09:10:09', '', '[READY]', 1),
(297, 0, 'DTU PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI AKT. III', 0, '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-16', 0, 0, 'Hotel/Eksternal', '', '2012-08-14 12:20:21', '', '[READY]', 1),
(298, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT LANJUTAN AKT. III', 0, '2012-07-09', '2012-07-17', '2012-07-09', '2012-07-17', '2012-07-09', '2012-07-18', 0, 0, 'Lab801 PKU', 'SEMULA MENENGAH', '2012-12-12 08:55:19', '', '[READY]', 1),
(299, 0, 'DTU PENGELOLAAN KINERJA ORGANISASI AKT II', 0, '2012-06-04', '2012-06-08', '2012-07-23', '2012-07-27', '2012-06-04', '2012-06-08', 0, 0, 'R601 PKU', 'semula: DTU BALANCE SCORECARD AKT. II', '2012-06-13 11:17:30', '', '[READY]', 1),
(300, 0, 'DTU MICROSOFT EXCEL, WORD, DAN POWERPOINT 2010 TINGKAT TINGGI AKT. III', 0, '2012-09-03', '2012-09-11', '2012-09-03', '2012-09-11', '0000-00-00', '0000-00-00', 0, 0, 'Lab801 PKU', 'SEMULA LANJUTAN', '2012-12-12 08:55:36', '', '[READY]', 1),
(301, 0, 'DTU TOEFL PBT PREPARATION AKT. IV', 0, '2012-10-15', '2012-11-05', '2012-09-03', '2012-09-28', '2012-10-15', '2012-11-05', 0, 0, 'Lab803 PKU', 'semula: DTU TOEFL iBT PREPARATION AKT. III', '2012-11-12 10:28:46', '', '[READY]', 1),
(302, 0, 'DTU PENGELOLAAN KINERJA ORGANISASI AKT. III', 0, '2012-09-10', '2012-09-14', '2012-09-10', '2012-09-14', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', 'semula: DTU BALANCE SCORECARD AKT. III', '2012-04-16 15:45:03', '', '[READY]', 1),
(303, 2, 'DTU TATA NASKAH DINAS AKT. IV', 0, '2012-09-10', '2012-09-14', '2012-09-10', '2012-09-14', '0000-00-00', '0000-00-00', 0, 0, 'R701 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(304, 0, 'DTU PERSIAPAN PURNABHAKTI AKT. III', 0, '2012-09-10', '2012-09-14', '2012-09-10', '2012-09-14', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', '', '2012-06-14 09:20:40', '', '[READY]', 1),
(305, 0, 'DTU GENERAL ENGLISH AKT. IV', 0, '2012-10-22', '2012-11-12', '2012-09-10', '2012-09-28', '2012-10-22', '2012-11-12', 0, 0, 'R601 PKU', '', '2012-11-12 10:31:24', '', '[READY]', 1),
(306, 0, 'DTU PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI AKT. IV', 0, '2012-09-17', '2012-09-21', '2012-09-17', '2012-09-21', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(307, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS AKT. I', 0, '2012-05-21', '2012-06-01', '2012-09-17', '2012-09-28', '2012-05-21', '2012-06-01', 0, 0, 'Lab801 PKU', '', '2012-06-13 11:15:13', '', '[READY]', 1),
(309, 0, 'DTU PENGELOLAAN WEBSITE DINAMIS AKT. II', 0, '2012-10-01', '2012-10-12', '2012-10-01', '2012-10-12', '0000-00-00', '0000-00-00', 0, 0, 'Lab801 PKU', '', '2012-01-18 12:26:54', '', '[READY]', 1),
(310, 0, 'DTU GENERAL ENGLISH AKT. III', 0, '2012-10-01', '2012-10-19', '2012-10-01', '2012-10-19', '2012-10-01', '2012-10-19', 0, 0, 'Lab Purnawarman', '', '2012-11-12 10:30:46', '', '[READY]', 1),
(311, 0, 'DTU AKUNTANSI KEUANGAN SYARI''AH ANGKT. II', 0, '2012-10-08', '2012-10-12', '2012-10-08', '2012-10-12', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', '', '2012-01-18 12:30:20', '', '[READY]', 1),
(312, 0, 'DTU DESAIN MULTIMEDIA AKT. I', 0, '2012-10-08', '2012-10-19', '2012-10-08', '2012-10-19', '0000-00-00', '0000-00-00', 0, 0, 'Lab803 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(313, 0, 'DTSS TEKNIK INVESTIGASI LANJUTAN (khusus)', 0, '2012-10-15', '2012-10-19', '2012-10-15', '2012-10-19', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(314, 0, 'DTU PENULISAN BUKU ISBN', 0, '2012-10-22', '2012-10-25', '2012-10-22', '2012-10-25', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(315, 0, 'DTU DESAIN PENGELOLAAN DATABASE AKT. II', 0, '2012-10-29', '2012-11-01', '2012-10-29', '2012-11-01', '0000-00-00', '0000-00-00', 0, 0, 'Lab803 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(316, 0, 'DTU ADMINISTRASI JARINGAN KOMPUTER AKT. II', 0, '2012-10-29', '2012-11-02', '2012-10-29', '2012-11-02', '0000-00-00', '0000-00-00', 0, 0, 'Lab801 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(317, 0, 'DTU PERSIAPAN PURNABHAKTI AKT. IV', 0, '2012-10-29', '2012-11-02', '2012-10-29', '2012-11-02', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', '', '2012-06-14 09:20:50', '', '[READY]', 1),
(318, 0, 'DTU FINANCIAL STATISTICS (MiniTab, EXCEL, e-VIEWS)', 0, '2012-11-07', '2012-11-13', '2012-11-07', '2012-11-13', '0000-00-00', '0000-00-00', 0, 0, 'Lab803 PKU', '', '2012-11-09 14:46:55', '', '[READY]', 1),
(319, 0, 'DTU LEGAL ENGLISH AKT. II', 0, '2012-11-12', '2012-11-14', '2012-11-12', '2012-11-14', '0000-00-00', '0000-00-00', 0, 0, 'R701 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(320, 0, 'DTU MENULIS ILMIAH POPULER AGK III', 0, '2012-11-12', '2012-11-14', '2012-11-12', '2012-11-14', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', '', '2012-06-21 10:07:04', '', '[READY]', 1),
(321, 0, 'DTU DESAIN PENGELOLAAN DATABASE AKT. III', 0, '2012-11-19', '2012-11-23', '2012-11-19', '2012-11-23', '0000-00-00', '0000-00-00', 0, 0, 'Lab801 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(322, 0, 'DTU DESAIN MULTIMEDIA AKT. II', 0, '2012-11-19', '2012-11-30', '2012-11-19', '2012-11-30', '0000-00-00', '0000-00-00', 0, 0, 'Lab803 PKU', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(323, 0, 'PLACEMENT TEST TOEFL PREPARATION', 0, '2012-02-01', '2012-02-02', '2012-02-01', '2012-02-02', '2012-02-01', '2012-02-02', 0, 790, 'Others', '', '2012-04-19 14:41:36', '', '[READY]', 1),
(324, 0, 'DIKLAT COACHING AND COUNSELING [...Peserta BPPK...]', 0, '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED', '2012-04-30 11:22:30', '', '[READY]', 1),
(325, 0, 'DTSD DANA PENSIUN [...Peserta BAPEPAM-LK...]', 29, '2012-02-21', '2012-02-23', '2012-02-21', '2012-02-23', '2012-02-21', '2012-02-23', 0, 20, 'Hotel/Eksternal', 'semula: DTSD PENGETAHUAN DANA PENSIUN [...Peserta BAPEPAM-LK...]', '2012-06-14 09:28:03', '', '[READY]', 1),
(326, 0, 'DTSS AUDIT INTERNAL TINGKAT LANJUTAN AKT I [...Peserta BAPEPAM-LK...]', 0, '2012-04-30', '2012-05-02', '2012-03-04', '2012-03-05', '2012-04-30', '2012-05-02', 0, 0, 'Hotel/Eksternal', '', '2012-05-07 11:15:12', '', '[READY]', 1),
(327, 0, 'DTSS RISK BASED AUDIT [...Peserta BAPEPAM-LK...]', 0, '2012-10-01', '2012-10-05', '2012-03-05', '2012-03-09', '0000-00-00', '0000-00-00', 0, 0, 'R603 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED', '2012-10-29 11:53:56', '', '[READY]', 1),
(328, 0, 'DTSD PENGENALAN PASAR MODAL [...Peserta BAPEPAM-LK...]', 28, '2012-03-05', '2012-03-07', '2012-03-05', '2012-03-07', '2012-03-05', '2012-03-07', 0, 22, 'Hotel/Eksternal', '', '2012-04-19 15:49:29', '', '[READY]', 1),
(329, 0, 'DTSS AUDIT INTERNAL TINGKAT LANJUTAN AKT II [...Peserta BAPEPAM-LK...]', 0, '2012-05-07', '2012-05-09', '2012-03-11', '2012-03-12', '2012-05-07', '2012-05-09', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:32:40', '', '[READY]', 1),
(330, 0, 'DTSD PENGETAHUAN PERASURANSIAN [...Peserta BAPEPAM-LK...]', 28, '2012-03-12', '2012-03-14', '2012-03-12', '2012-03-14', '2012-03-12', '2012-03-14', 0, 30, 'Hotel/Eksternal', '', '2012-04-19 15:51:50', '', '[READY]', 1),
(331, 0, 'DTSS PSIKOLOGI KOMUNIKASI AUDIT [...Peserta BAPEPAM-LK...]', 0, '2012-05-29', '2012-05-31', '2012-03-15', '2012-03-16', '2012-05-29', '2012-05-31', 0, 0, 'Hotel/Eksternal', 'semula: DTU KETERAMPILAN AUDIT [...Peserta BAPEPAM-LK...]', '2012-06-13 11:15:58', '', '[READY]', 1),
(332, 0, 'DTSD MANAJEMEN DANA PENSIUN [...Peserta BAPEPAM-LK...]', 28, '2012-03-19', '2012-03-21', '2012-03-19', '2012-03-21', '2012-03-19', '2012-03-21', 0, 26, 'Hotel/Eksternal', '', '2012-04-19 15:58:25', '', '[READY]', 1),
(333, 0, 'DTSD PENGENALAN PERUSAHAAN PEMBIAYAAN [...Peserta BAPEPAM-LK...]', 0, '2012-04-25', '2012-04-27', '2012-03-26', '2012-03-28', '2012-04-25', '2012-04-27', 0, 0, 'Hotel/Eksternal', 'semula: DTSS AUDIT KEPATUHAN LEMBAGA KEUANGAN [...Peserta BAPEPAM-LK...]', '2012-05-02 12:39:55', '', '[READY]', 1),
(334, 0, 'DTU PENGENALAN AKUNTANSI [...Peserta BAPEPAM-LK...]', 30, '2012-03-26', '2012-03-28', '2012-03-26', '2012-03-28', '2012-03-26', '2012-03-28', 0, 15, 'R701 PKU', '', '2012-04-19 16:01:49', '', '[READY]', 1),
(335, 0, 'DTSS AUDIT INTERNAL TINGKAT DASAR AKT. I [...Peserta BAPEPAM-LK...]', 44, '2012-04-09', '2012-04-13', '2012-03-29', '2012-03-30', '2012-04-09', '2012-04-13', 0, 0, 'Hotel/Eksternal', '', '2012-04-19 16:09:31', '', '[READY]', 1),
(336, 0, 'DTSS AUDIT INTERNAL TINGKAT DASAR AKT. II [...Peserta BAPEPAM-LK...]', 0, '2012-04-16', '2012-04-20', '2012-04-02', '2012-04-03', '2012-04-16', '2012-04-20', 0, 0, 'Hotel/Eksternal', '', '2012-04-30 11:25:27', '', '[READY]', 1),
(337, 0, 'DTSS AUDIT INTERNAL TINGKAT DASAR AKT. III [...Peserta BAPEPAM-LK...]', 0, '2012-04-09', '2012-04-10', '2012-04-09', '2012-04-10', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'CANCELED-CANCELED-CANCELED-CANCELED &gt;&gt;&gt; UNTUK TINGKAT LANJUTAN', '2012-08-30 15:16:54', '', '[READY]', 1),
(338, 0, 'DTSS MANAJEMEN FUNGSI/ UNIT AUDIT INTERNAL [...Peserta BAPEPAM-LK...]', 0, '2012-06-05', '2012-06-06', '2012-04-16', '2012-04-17', '2012-06-05', '2012-06-06', 0, 0, 'Hotel/Eksternal', 'semula: DTSS AUDIT INTERNAL TINGKAT MANAJERIAL [...Peserta BAPEPAM-LK...]', '2012-06-19 18:57:07', '', '[READY]', 1),
(339, 0, 'DTSS PENYIDIKAN BUKTI DIGITAL FORENSIK [...Peserta BAPEPAM-LK...]', 0, '2012-04-18', '2012-04-19', '2012-04-18', '2012-04-19', '2012-04-18', '2012-04-19', 0, 0, 'Lab801 PKU', '', '2012-04-30 09:11:48', '', '[READY]', 1),
(340, 0, 'DTSD TEKNIK INTELIJEN PASAR MODAL [...Peserta BAPEPAM-LK...]', 0, '2012-04-30', '2012-05-04', '2012-04-23', '2012-04-27', '2012-04-30', '2012-05-04', 0, 0, 'Others', '', '2012-05-07 11:16:52', '', '[READY]', 1),
(341, 0, 'DTSS AUDIT PERUSAHAAN PEMBIAYAAN DAN PENJAMINAN [...Peserta BAPEPAM-LK...]', 0, '2012-06-04', '2012-06-08', '2012-04-30', '2012-05-04', '2012-06-04', '2012-06-08', 0, 0, '', 'semula: DTSS PROSEDUR AUDIT PERUSAHAAN PENJAMINAN [...Peserta BAPEPAM-LK...] - non asrama (PKU)', '2012-06-13 11:20:01', '', '[READY]', 1),
(342, 0, 'DTU ANALISIS LAPORAN KEUANGAN PERUSAHAAN PEMBIAYAAN DAN PENJAMINAN [...Peserta BAPEPAM-LK...]', 0, '2012-05-14', '2012-05-16', '2012-04-30', '2012-05-04', '2012-05-14', '2012-05-16', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:30:05', '', '[READY]', 1),
(343, 0, 'DTU LEGAL DRAFTING [...Peserta BAPEPAM-LK...]', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:35:34', '', '[READY]', 1),
(344, 0, 'DTU AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS [...Peserta BAPEPAM-LK...]', 0, '2012-05-07', '2012-05-09', '2012-05-14', '2012-05-15', '2012-05-07', '2012-05-09', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:36:50', '', '[READY]', 1),
(345, 0, 'DTSS MANAJEMEN RISIKO PEMBIAYAAN DAN PENJAMINAN [...Peserta BAPEPAM-LK...]', 0, '2012-05-21', '2012-05-22', '2012-05-21', '2012-05-23', '2012-05-21', '2012-05-22', 0, 0, 'Hotel/Eksternal', 'semula: DTU MANAJEMEN RISIKO PERUSAHAAN PEMBIAYAAN [...Peserta BAPEPAM-LK...]', '2012-06-11 11:27:02', '', '[READY]', 1),
(346, 0, 'DTU METODE RISET SURVEY [...Peserta BAPEPAM-LK...]', 0, '2012-05-23', '2012-05-25', '2012-05-23', '2012-05-25', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'CANCELED-CANCELED: DISATUKAN DALAM DTU METODOLOGI PENELITIAN [...Peserta BAPEPAM-LK...]', '2012-03-21 09:16:02', '', '[READY]', 1),
(347, 0, 'DTU ANALISIS KUALITATIF [...Peserta BAPEPAM-LK...]', 0, '2012-05-28', '2012-05-30', '2012-05-28', '2012-05-30', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'CANCELED-CANCELED: DISATUKAN DALAM DTU METODOLOGI PENELITIAN [...Peserta BAPEPAM-LK...]', '2012-03-21 09:17:27', '', '[READY]', 1),
(348, 0, 'DTU ANALISIS KUANTITATIF SPSS DAN E-VIEWS [...Peserta BAPEPAM-LK...]', 0, '2012-05-02', '2012-05-04', '2012-05-30', '2012-06-01', '2012-05-02', '2012-05-04', 0, 0, 'Hotel/Eksternal', 'CANCELED-CANCELED: DISATUKAN DALAM DTU METODOLOGI PENELITIAN [...Peserta BAPEPAM-LK...]', '2012-06-14 09:03:53', '', '[READY]', 1),
(349, 0, 'DTU PENGELOLAAN DATABASE SQL SERVER [...Peserta BAPEPAM-LK...]', 0, '2012-06-26', '2012-06-29', '2012-06-04', '2012-06-06', '2012-06-26', '2012-06-29', 0, 0, 'Lab803 PKU', 'BARU-BARU-BARU-BARU-BARU', '2012-08-30 15:19:22', '', '[READY]', 1),
(350, 0, 'DTSD PENGENALAN PERUSAHAAN PENJAMINAN [...Peserta BAPEPAM-LK...]', 0, '2012-05-02', '2012-05-03', '2012-06-07', '2012-06-08', '2012-05-02', '2012-05-03', 0, 0, 'Hotel/Eksternal', 'semula: DTU PENGENALAN USAHA PENJAMINAN [...Peserta BAPEPAM-LK...]', '2012-05-07 11:28:30', '', '[READY]', 1),
(351, 0, 'DTU METODOLOGI PENELITIAN [...Peserta BAPEPAM-LK...]', 0, '2012-04-24', '2012-05-04', '2012-06-11', '2012-06-15', '2012-04-24', '2012-05-04', 0, 0, 'Hotel/Eksternal', 'TERDAPAT JEDA DALAM PELAKSANAAN', '2012-06-14 09:05:40', '', '[READY]', 1),
(352, 0, 'DTU ANALISIS LAPORAN AKTUARIS DANA PENSIUN [...Peserta BAPEPAM-LK...]', 0, '2012-06-11', '2012-06-14', '2012-06-11', '2012-06-13', '2012-06-11', '2012-06-13', 0, 0, 'R601 PKU', 'semula: DTU ANALISIS LAPORAN AKTUARIS [...Peserta BAPEPAM-LK...]', '2012-06-19 18:58:14', '', '[READY]', 1),
(353, 0, 'DTSS AKUNTANSI FORENSIK DAN AUDIT INVESTIGATIF [...Peserta BAPEPAM-LK...]', 0, '2012-06-25', '2012-06-27', '2012-06-18', '2012-06-20', '2012-06-25', '2012-06-27', 0, 0, 'Hotel/Eksternal', '', '2012-08-14 12:02:37', '', '[READY]', 1),
(354, 0, 'DTSS LITIGASI ANGKATAN I [...Peserta BAPEPAM-LK...]', 0, '2012-06-25', '2012-06-29', '2012-06-26', '2012-06-27', '2012-06-25', '2012-06-29', 0, 0, 'Aula PKU', '', '2012-08-30 15:18:07', '', '[READY]', 1),
(355, 0, 'DTSS PEER REVIEW AUDIT [...Peserta BAPEPAM-LK...]', 0, '2012-11-19', '2012-11-21', '2012-07-02', '2012-07-06', '0000-00-00', '0000-00-00', 0, 0, '', 'semula: PELATIHAN LAPORAN ANALISIS AUDIT [...Peserta BAPEPAM-LK...] jadwal Tentative', '2012-11-07 09:31:56', '', '[READY]', 1),
(356, 0, 'PELATIHAN HUKUM ACARA PTUN [...Peserta BAPEPAM-LK...]', 0, '2012-07-09', '2012-07-13', '2012-07-09', '2012-07-13', '0000-00-00', '0000-00-00', 0, 0, 'Vendor', 'CANCELED-CANCELED: DIGABUNG DALAM DTSS LITIGASI', '2012-06-14 11:08:18', '', '[READY]', 1),
(357, 0, 'DTU PENGELOLAAN, PENGADUAN, DAN PEMBINAAN PEGAWAI [...Peserta BAPEPAM-LK...]', 39, '2012-07-09', '2012-07-12', '2012-07-16', '2012-07-20', '2012-07-09', '2012-07-13', 30, 0, 'Hotel/Eksternal', 'semula: PELATIHAN PENGELOLAAN/ PENATAAN UNIT DISIPLINER[...Peserta BAPEPAM-LK...]', '2012-08-14 12:15:02', '', '[READY]', 1),
(358, 0, 'DTSS LITIGASI ANGKATAN II [...Peserta BAPEPAM-LK...]', 0, '2012-07-02', '2012-07-06', '2012-07-23', '2012-07-27', '2012-07-02', '2012-07-06', 0, 0, 'Aula PKU', 'semula: PELATIHAN TAKTIK DAN STRATEGI BERACARA DI PENGADILAN [...Peserta BAPEPAM-LK...]', '2012-08-30 15:18:25', '', '[READY]', 1),
(359, 0, 'DTSS FUND MANAGER TRAINING [...Peserta BAPEPAM-LK...]', 0, '2012-06-11', '2012-07-03', '2012-07-30', '2012-08-03', '2012-06-11', '2012-07-03', 0, 0, 'Vendor', 'semula: PELATIHAN IDENTIFIKASI TINGKAT PELANGGARAN [...Peserta BAPEPAM-LK...]', '2012-06-19 19:00:50', '', '[READY]', 1),
(360, 0, 'DTSS FRAUD AUDITING', 28, '2012-09-03', '2012-09-05', '2012-08-06', '2012-08-08', '2012-09-03', '2012-09-05', 0, 0, 'Others', 'SEMULA: PELATIHAN FRAUD AUDITING: PREVENTION, DETECTION &amp; INVESTIGATION [...Peserta BAPEPAM-LK...]', '2012-09-06 08:37:55', '', '[READY]', 1),
(361, 0, 'DTU SELF MOTIVATION AND DEVELOPING HIGH PERFORMANCE TEAMS [...optimalisasi...]', 0, '0000-00-00', '0000-00-00', '2011-12-20', '2011-12-22', '0000-00-00', '0000-00-00', 0, 0, '', '', '2011-12-09 12:58:00', '', '[READY]', 1),
(362, 0, 'DF JFA PEMBENTUKAN AUDITOR AHLI [...Peserta ITJEN...]', 192, '2012-02-13', '2012-03-09', '2012-02-27', '2012-03-16', '2012-02-13', '2012-03-09', 0, 25, 'R703 PKU', 'semula: DF JFA PEMBENTUKAN AUDITOR TERAMPIL [...Peserta ITJEN...]', '2012-04-19 15:43:44', '', '[READY]', 1),
(363, 0, 'DTSS AUDIT TIK TINGKAT DASAR AGK II [...Peserta ITJEN...]', 46, '2012-10-29', '2012-11-02', '2012-10-15', '2012-10-19', '0000-00-00', '0000-00-00', 35, 0, 'R701 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED\r\nsemula: DTSS AUDIT TATA KELOLA TIK * [...Peserta ITJEN...]', '2012-11-05 08:57:51', '', '[READY]', 1),
(364, 0, 'DTSS TEKNIK AUDIT BERBASIS KOMPUTER (COMPUTER ASSISTED AUDIT TECHNIQUES) TK DASAR AKT I [...Peserta ITJEN...]', 42, '2012-04-09', '2012-04-13', '2012-03-26', '2012-03-30', '2012-04-09', '2012-04-13', 0, 0, '', '', '2012-04-19 16:08:54', '', '[READY]', 1),
(369, 0, 'DTSS TEKNIK AUDIT BERBASIS KOMPUTER (COMPUTER ASSISTED AUDIT TECHNIQUES) TK LANJUTAN [...Peserta ITJEN...]', 0, '2012-09-10', '2012-09-14', '2012-07-23', '2012-07-27', '0000-00-00', '0000-00-00', 0, 0, 'Lab801 PKU', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN', '2012-08-14 12:30:17', '', '[READY]', 1),
(370, 0, 'DF JFA PEMBENTUKAN AUDITOR TERAMPIL [...Peserta ITJEN...]', 0, '2012-06-18', '2012-07-06', '2012-06-18', '2012-07-17', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', 'semula: DF JFA PEMBENTUKAN AUDITOR AHLI [...Peserta ITJEN...] --&gt; CANCELED-CANCELED-CANCELED-CANCELED', '2012-08-30 15:10:50', '', '[READY]', 1),
(372, 0, 'DTSS EVALUASI DIKLAT [...Peserta BPPK...]', 47, '2012-01-16', '2012-01-20', '2012-01-16', '2012-01-20', '2012-01-16', '2012-01-20', 30, 30, 'Hotel/Eksternal', '', '2012-04-19 15:11:41', '', '[READY]', 1),
(375, 0, 'DTSS PENYUSUNAN SOAL [...Peserta BPPK...]', 32, '2012-03-26', '2012-03-29', '2012-03-26', '2012-03-29', '2012-03-26', '2012-03-29', 0, 25, 'R603 PKU', '', '2012-04-19 16:02:56', '', '[READY]', 1),
(377, 0, 'DTSS KEPANITERAAN ANGKATAN I [...Peserta SETJEN...]', 0, '2012-09-04', '2012-09-07', '2012-05-28', '2012-06-08', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', '', '2012-08-14 12:10:31', '', '[READY]', 1),
(378, 0, 'DTSD TEORI EKONOMI MAKRO AKT I [...Peserta BKF...]', 34, '2012-02-13', '2012-02-15', '2012-02-13', '2012-02-15', '2012-02-13', '2012-02-15', 15, 23, 'Hotel/Eksternal', '', '2012-06-14 09:22:29', '', '[READY]', 1),
(379, 0, 'DTSD KEBIJAKAN PUBLIK [...Peserta BKF...]', 33, '2012-02-21', '2012-02-23', '2012-02-21', '2012-02-23', '2012-02-21', '2012-02-23', 0, 20, 'Hotel/Eksternal', '', '2012-06-14 09:23:09', '', '[READY]', 1),
(380, 0, 'DTU LEGAL DRAFTING [...Peserta BKF...]', 32, '2012-03-06', '2012-03-08', '2012-03-06', '2012-03-08', '2012-03-06', '2012-03-08', 0, 20, 'Hotel/Eksternal', '', '2012-04-19 15:51:29', '', '[READY]', 1),
(381, 0, 'DIKLAT FUNGSIONAL PENELITI TK PERTAMA AGK I [... Peserta BKF...]', 0, '0000-00-00', '0000-00-00', '2012-04-26', '2012-05-16', '2012-04-26', '2012-05-16', 0, 0, 'Vendor', 'MENYESUAIKAN DENGAN PESERTA DARI BKF', '2012-11-21 08:21:17', '', '[READY]', 1),
(383, 0, 'DTSS EKONOMETRIKA TK LANJUTAN AKT I - (Time Series &amp; Tools E-Views) [...Peserta BKF...]', 0, '2012-05-14', '2012-05-16', '2012-05-14', '2012-05-16', '2012-05-14', '2012-05-16', 0, 0, 'Hotel/Eksternal', '', '2012-06-14 08:53:39', '', '[READY]', 1),
(384, 0, 'DTU MENULIS ILMIAH POPULER AGK I [...Peserta BKF...]', 0, '2012-05-28', '2012-05-30', '2012-05-28', '2012-05-30', '2012-05-28', '2012-05-30', 0, 0, 'Hotel/Eksternal', 'semula: DTU MENULIS ILMIAH [...Peserta BKF...]', '2012-06-21 10:06:21', '', '[READY]', 1),
(385, 0, 'DTSS EKONOMETRIKA TK LANJUTAN AKT II - (Simultan &amp; ECM-Tools E-Views) [...Peserta BKF...]', 0, '2012-05-21', '2012-05-23', '2012-06-04', '2012-06-06', '2012-05-21', '2012-05-23', 0, 0, 'Hotel/Eksternal', 'semula: DTSS STATA TK DASAR [...Peserta BKF...]', '2012-06-14 08:54:13', '', '[READY]', 1),
(386, 0, 'DIKLAT FUNGSIONAL PENELITI TK PERTAMA AGK II [...Peserta BKF...]', 203, '2012-06-27', '2012-07-17', '2012-06-11', '2012-07-09', '2012-06-27', '2012-07-17', 0, 6, 'Vendor', '', '2012-08-30 15:26:52', '', '[READY]', 1),
(387, 0, 'DTSS EKONOMETRIKA TK LANJUTAN AKT III - (Panel Data &amp; Eksplorasi Data SUSENAS - Tools E-Views) [...Peserta BKF...]', 0, '2012-06-19', '2012-06-21', '2012-06-18', '2012-06-20', '2012-06-13', '2012-06-15', 0, 0, 'Hotel/Eksternal', 'semula: DTSS STATA TK LANJUTAN [...Peserta BKF...]', '2012-06-19 19:03:06', '', '[READY]', 1),
(388, 0, 'DTSS INPUT OUTPUT EKONOMETRIKA [...Peserta BKF...]', 0, '2012-04-24', '2012-04-27', '2012-07-10', '2012-07-12', '2012-04-24', '2012-04-27', 0, 0, 'Hotel/Eksternal', 'semula: DTSS INPUT OUTPUT [...Peserta BKF...]', '2012-06-14 08:50:39', '', '[READY]', 1),
(389, 0, 'DTU EFFECTIVE REPORT WRITING [...Peserta BKF...]', 0, '2012-07-16', '2012-07-18', '2012-07-16', '2012-07-18', '2012-07-16', '2012-07-18', 0, 0, 'Hotel/Eksternal', '', '2012-08-14 12:23:40', '', '[READY]', 1),
(390, 0, 'DTU MENULIS ILMIAH POPULER AGK II [...Peserta BKF...]', 0, '2012-09-10', '2012-09-12', '2012-07-23', '2012-07-25', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'semula: DTSS METODE KUANTITATIF [...Peserta BKF...]', '2012-06-21 10:06:07', '', '[READY]', 1),
(391, 0, 'DTU ENGLISH FOR NEGOTIATION [...Peserta DJPU...]', 30, '2012-04-09', '2012-04-13', '2012-03-12', '2012-06-04', '2012-04-09', '2012-04-13', 0, 0, 'Vendor', '', '2012-04-19 16:13:39', '', '[READY]', 1),
(392, 0, 'DTU LEGAL ENGLISH [...Peserta DJPU...]', 29, '2012-03-12', '2012-03-16', '2012-03-12', '2012-03-14', '2012-03-12', '2012-03-16', 0, 11, 'Hotel/Eksternal', '', '2012-04-19 15:52:52', '', '[READY]', 1),
(393, 0, 'DTU ENGLISH FOR SPEECH WRITING [...Peserta DJPU...]', 0, '2012-05-07', '2012-05-11', '2012-03-13', '2012-06-11', '0000-00-00', '0000-00-00', 0, 0, 'Vendor', 'CANCELED-CANCELED &gt;&gt;&gt; semula: DTU ENGLISH FOR SPECIAL PURPOSE - SPEECH DRAFTING [...Peserta DJPU...]', '2012-08-30 15:30:39', '', '[READY]', 1),
(394, 0, 'DTU TRANSFORMASI KELEMBAGAAN [...Peserta DJPU...]', 0, '2012-04-16', '2012-04-20', '2012-04-02', '2012-04-05', '2012-04-16', '2012-04-20', 0, 0, 'Hotel/Eksternal', '', '2012-04-30 09:11:29', '', '[READY]', 1),
(395, 0, 'DTSS EKONOMETRIKA TK DASAR AKT II [...Peserta BKF...]', 30, '2012-04-09', '2012-04-12', '2012-04-09', '2012-04-12', '2012-04-09', '2012-04-12', 0, 0, 'Hotel/Eksternal', '', '2012-06-14 08:50:46', '', '[READY]', 1),
(397, 0, 'DTU TRANSFORMASI KELEMBAGAAN [...Peserta BPPK...]', 0, '2012-05-21', '2012-05-24', '2012-05-21', '2012-05-24', '2012-05-21', '2012-05-24', 0, 0, 'Hotel/Eksternal', '', '2012-06-11 11:28:28', '', '[READY]', 1),
(398, 0, 'DTSS PEMBEKALAN ILMU PENDAMPINGAN SAKSI TERKAIT TINDAK PIDANA *', 0, '2012-09-24', '2012-09-28', '2012-09-24', '2012-09-28', '0000-00-00', '0000-00-00', 0, 0, 'R701 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED', '2012-08-14 12:41:16', '', '[READY]', 1),
(399, 0, 'DTU INFORMATION DESK (CALL CENTER) [...Peserta DJKN...]', 0, '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', '0000-00-00', '0000-00-00', 0, 0, 'R601 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED', '2012-06-14 09:06:37', '', '[READY]', 1),
(400, 0, 'DTU MANAJEMEN SDM TINGKAT LANJUTAN *[...Peserta DJPK...]', 0, '2012-05-15', '2012-05-16', '2012-05-15', '2012-05-16', '0000-00-00', '0000-00-00', 0, 0, 'Aula PKU', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED digabung dengan yang reguler', '2012-04-30 12:01:29', '', '[READY]', 1),
(401, 0, 'DTU EFFECTIVE REPORT WRITING AKT I [...Peserta Itjen...]', 36, '2012-02-20', '2012-02-23', '2012-02-20', '2012-02-23', '2012-02-20', '2012-02-23', 0, 22, 'R603 PKU', '', '2012-04-19 15:44:02', '', '[READY]', 1),
(402, 0, 'DTU EFFECTIVE REPORT WRITING AKT II [...Peserta ITJEN...]', 36, '2012-03-12', '2012-03-15', '2012-03-12', '2012-03-15', '2012-03-12', '2012-03-15', 0, 26, 'R603 PKU', '', '2012-04-19 16:05:05', '', '[READY]', 1),
(403, 0, 'DTU EFFECTIVE REPORT WRITING AKT III [...Peserta ITJEN...]', 0, '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', '2012-04-02', '2012-04-05', 0, 0, 'R703 PKU', '', '2012-04-16 15:39:12', '', '[READY]', 1),
(404, 0, 'DTU MANAJEMEN UTANG LANJUTAN [...Peserta ITJEN...]', 0, '2012-04-16', '2012-04-20', '2012-04-16', '2012-04-20', '0000-00-00', '0000-00-00', 0, 0, 'R703 PKU', 'CANCELED-CANCELED-CANCELED-CANCELED', '2012-06-14 09:07:24', '', '[READY]', 1),
(405, 0, 'DTSS PENGELOLAAN DAN PENGAWASAN SURAT UTANG NEGARA [...Peserta ITJEN...]', 0, '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', '2012-04-30', '2012-05-04', 0, 0, 'R601 PKU', 'semula: DTSS PENGELOLAAN SURAT BERHARGA NEGARA [...Peserta ITJEN...]', '2012-08-30 14:23:41', '', '[READY]', 1),
(406, 0, 'DTSS PENULISAN LAPORAN HASIL AUDIT YANG EFEKTIF', 0, '2012-10-29', '2012-11-02', '2012-05-21', '2012-05-25', '0000-00-00', '0000-00-00', 0, 0, 'R601 PKU', 'semula: DTSS STRATEGI PORTOFOLIO DAN PENGELOLAAN PHLN [...Peserta ITJEN...]', '2012-10-01 10:13:39', '', '[READY]', 1),
(407, 0, 'DTSS TEKNIK AUDIT BERBASIS KOMPUTER (COMPUTER ASSISTED AUDIT TECHNIQUES) TK DASAR AKT II [...Peserta ITJEN...]', 0, '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', '2012-05-07', '2012-05-11', 0, 0, 'Lab801 PKU', '', '2012-06-14 09:08:58', '', '[READY]', 1),
(408, 0, 'DTSS TEKNIK INTELIJEN LANJUTAN PASAR MODAL (AGEN-ELISITASI) ', 0, '2012-10-29', '2012-11-02', '2012-10-29', '2012-11-02', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'semula: DTSS PENYIDIKAN BUKTI DIGITAL FORENSIK [...Peserta BAPEPAM-LK...]', '2012-10-05 10:52:38', '', '[READY]', 1),
(409, 0, 'DTSS MANAJEMEN UTANG AKT I *[...Peserta DJPU...]', 0, '2012-05-21', '2012-05-28', '2012-03-12', '2012-03-16', '2012-05-21', '2012-05-28', 0, 0, 'Hotel/Eksternal', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN - halfday', '2012-06-11 11:26:09', '', '[READY]', 1),
(410, 0, 'DTSS MANAJEMEN UTANG AKT II *[...Peserta DJPU...]', 0, '2012-06-04', '2012-06-11', '2012-03-26', '2012-03-30', '2012-06-04', '2012-06-11', 0, 0, 'Hotel/Eksternal', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN - halfday', '2012-06-13 11:10:35', '', '[READY]', 1),
(411, 0, 'DTSS MANAJEMEN UTANG AKT III *[...Peserta DJPU...]', 0, '2012-06-18', '2012-06-25', '2012-04-23', '2012-04-27', '2012-06-18', '2012-06-25', 0, 0, 'Hotel/Eksternal', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN - halfday', '2012-06-19 19:04:21', '', '[READY]', 1),
(412, 0, 'DTSS MANAJEMEN UTANG AKT IV *[...Peserta DJPU...]', 0, '2012-07-02', '2012-07-09', '2012-04-30', '2012-05-04', '2012-07-02', '2012-07-09', 0, 0, 'Hotel/Eksternal', 'MENUNGGU EFISIENSI/OPTIMALISASI ANGGARAN - halfday', '2012-08-30 15:30:07', '', '[READY]', 1),
(413, 0, 'DTU SEKRETARIS PIMPINAN AKT I * [...Peserta DJKN...]', 0, '2012-06-11', '2012-06-14', '2012-06-11', '2012-06-14', '0000-00-00', '0000-00-00', 0, 0, '', 'CANCELED-CANCELED-CANCELED-CANCELED', '2012-06-14 09:43:17', '', '[READY]', 1),
(414, 0, 'DTU SEKRETARIS PIMPINAN AKT II * [...Peserta DJKN...]', 0, '2012-06-25', '2012-06-28', '2012-06-25', '2012-06-28', '0000-00-00', '0000-00-00', 0, 0, '', 'CANCELED-CANCELED-CANCELED-CANCELED', '2012-06-14 09:43:39', '', '[READY]', 1),
(415, 0, 'TOEFL PREPARATION ANGKATAN I (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-03-24', '2008-05-09', '2008-03-24', '2008-05-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(416, 0, 'TOEFL PREPARATION ANGKATAN II (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-03-24', '2008-05-09', '2008-03-24', '2008-05-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(417, 0, 'TOEFL PREPARATION ANGKATAN III (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-07-14', '2008-08-05', '2008-07-14', '2008-08-05', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(418, 0, 'TOEFL PREPARATION ANGKATAN IV (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-08-11', '2008-09-02', '2008-08-11', '2008-09-02', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(419, 0, 'DTU LEGAL DRAFTING ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2008-10-20', '2008-10-24', '2008-10-20', '2008-10-24', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(420, 0, 'DTU LEGAL DRAFTING ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2008-11-17', '2008-11-21', '2008-11-17', '2008-11-21', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(421, 0, 'DTSD PENGELOLAAN DIKLAT ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2008-10-20', '2008-10-24', '2008-10-20', '2008-10-24', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(422, 0, 'DTSD PENGELOLAAN DIKLAT ANGKATAN II (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-11-10', '2008-11-14', '2008-11-10', '2008-11-14', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(423, 0, 'DTSD PERIMBANGAN KEUANGAN', 0, '0000-00-00', '0000-00-00', '2008-07-14', '2008-07-24', '2008-07-14', '2008-07-24', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(424, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2008-03-24', '2008-04-03', '2008-03-24', '2008-04-03', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(425, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2008-05-06', '2008-05-16', '2008-05-06', '2008-05-16', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(426, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN III', 0, '0000-00-00', '0000-00-00', '2008-05-26', '2008-06-05', '2008-05-26', '2008-06-05', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(427, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN IV', 0, '0000-00-00', '0000-00-00', '2008-07-01', '2008-07-11', '2008-07-01', '2008-07-11', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(428, 0, 'DTSS PENILAIAN USAHA DASAR', 0, '0000-00-00', '0000-00-00', '2008-03-24', '2008-04-22', '2008-03-24', '2008-04-22', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(429, 0, 'DTSS PENILAIAN USAHA LANJUTAN', 0, '0000-00-00', '0000-00-00', '2008-06-09', '2008-07-10', '2008-06-09', '2008-07-10', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(430, 0, 'DTSS PEJABAT LELANG', 0, '0000-00-00', '0000-00-00', '2008-07-15', '2008-07-29', '2008-07-15', '2008-07-29', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(431, 0, 'DTSS TEKNIK INTELIJEN LANJUTAN', 0, '0000-00-00', '0000-00-00', '2008-05-26', '2008-06-11', '2008-05-26', '2008-06-11', 0, 0, 'Pusdiklat BIN', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(432, 0, 'DTSS TEKNIK INVESTIGASI', 0, '0000-00-00', '0000-00-00', '2008-06-16', '2008-07-02', '2008-06-16', '2008-07-02', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(433, 0, 'DTSS TEKNIK PENILAIAN UNTUK AUDITOR', 0, '0000-00-00', '0000-00-00', '2008-05-07', '2008-04-17', '2008-05-07', '2008-04-17', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(434, 0, 'DTSS PENILAIAN PROPERTI DASAR', 0, '0000-00-00', '0000-00-00', '2008-04-08', '2008-05-05', '2008-04-08', '2008-05-05', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(435, 0, 'DTSS PENILAIAN PROPERTI LANJUTAN', 0, '0000-00-00', '0000-00-00', '2008-05-12', '2008-06-10', '2008-05-12', '2008-06-10', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(436, 0, 'DTSS PEMERIKSA KEKAYAAN NEGARA', 0, '0000-00-00', '0000-00-00', '2008-11-18', '2008-12-05', '2008-11-18', '2008-12-05', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(437, 0, 'PENYEGARAN DIPLOMASI EKONOMI', 0, '0000-00-00', '0000-00-00', '2008-08-11', '2008-08-15', '2008-08-11', '2008-08-15', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(438, 0, 'PENYEGARAN METODOLOGI PENELITIAN UNTUK WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2008-06-09', '2008-06-13', '2008-06-09', '2008-06-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(439, 0, 'PENYEGARAN PENGELOLAAN WEB DINAMIS UNTUK PEJABAT ATAU WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2008-06-16', '2008-06-18', '2008-06-16', '2008-06-18', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(440, 0, 'PENYEGARAN PENGELOLAAN WEB DINAMIS UNTUK PELAKSANA ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2008-06-16', '2008-06-20', '2008-06-16', '2008-06-20', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(441, 0, 'PENYEGARAN PENGELOLAAN WEB DINAMIS UNTUK PELAKSANA ANGKATAN II (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2008-11-10', '2008-11-14', '2008-11-10', '2008-11-14', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(442, 0, 'DF AUDITOR - SERTIFIKASI JENJANG FUNGSIONAL AUDITOR TERAMPIL', 0, '0000-00-00', '0000-00-00', '2008-06-23', '2008-07-09', '2008-06-23', '2008-07-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(443, 0, 'DF WIDYAISWARA - CALON WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2008-07-28', '2008-08-30', '2008-07-28', '2008-08-30', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(444, 0, 'DFP PRANATA KOMPUTER TERAMPIL', 0, '0000-00-00', '0000-00-00', '2008-11-10', '2008-12-10', '2008-11-10', '2008-12-10', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(445, 0, 'DTU EDP AUDITING I', 0, '0000-00-00', '0000-00-00', '2006-07-03', '2006-07-07', '2006-07-03', '2006-07-07', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(446, 0, 'DTU EDP AUDITING II', 0, '0000-00-00', '0000-00-00', '2006-08-07', '2006-08-11', '2006-08-07', '2006-08-11', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(447, 0, 'DTU EDP AUDITING III', 0, '0000-00-00', '0000-00-00', '2006-12-04', '2006-12-08', '2006-12-04', '2006-12-08', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(448, 0, 'DTU STATISTICAL AUDIT SAMPLING I', 0, '0000-00-00', '0000-00-00', '2006-04-17', '2006-04-21', '2006-04-17', '2006-04-21', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(449, 0, 'DTU STATISTICAL AUDIT SAMPLING II', 0, '0000-00-00', '0000-00-00', '2006-05-29', '2006-06-02', '2006-05-29', '2006-06-02', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(450, 0, 'DTU PENGELOLAAN WEB', 0, '0000-00-00', '0000-00-00', '2006-08-24', '2006-09-14', '2006-08-24', '2006-09-14', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(451, 0, 'PLACEMENT TEST DTU TOEFL', 0, '0000-00-00', '0000-00-00', '2006-03-13', '2006-03-13', '2006-03-13', '2006-03-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(452, 0, 'DTU TOEFL PREPARATION I', 0, '0000-00-00', '0000-00-00', '2006-04-03', '2006-04-28', '2006-04-03', '2006-04-28', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(453, 0, 'DTU TOEFL PREPARATION II', 0, '0000-00-00', '0000-00-00', '2006-05-09', '2006-06-05', '2006-05-09', '2006-06-05', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(454, 0, 'DTU TOEFL PREPARATION III', 0, '0000-00-00', '0000-00-00', '2006-06-05', '2006-06-23', '2006-06-05', '2006-06-23', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(455, 0, 'DTU TOEFL PREPARATION IV', 0, '0000-00-00', '0000-00-00', '2006-07-18', '2006-08-11', '2006-07-18', '2006-08-11', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(456, 0, 'DTU TOEFL PREPARATION V', 0, '0000-00-00', '0000-00-00', '2006-11-06', '2006-11-24', '2006-11-06', '2006-11-24', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(457, 0, 'DTU KEPEGAWAIAN', 0, '0000-00-00', '0000-00-00', '2006-09-25', '2006-10-06', '2006-09-25', '2006-10-06', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(458, 0, 'DTU DESAIN PENGELOLAAN DATABASE ACCESS I', 0, '0000-00-00', '0000-00-00', '2006-04-26', '2006-05-02', '2006-04-26', '2006-05-02', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(459, 0, 'DTU DESAIN PENGELOLAAN DATABASE ACCESS II', 0, '0000-00-00', '0000-00-00', '2006-09-18', '2006-09-22', '2006-09-18', '2006-09-22', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(460, 0, 'DTU SELF DEVELOPMENT I', 0, '0000-00-00', '0000-00-00', '2006-07-03', '2006-07-07', '2006-07-03', '2006-07-07', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(461, 0, 'DTU SELF DEVELOPMENT II', 0, '0000-00-00', '0000-00-00', '2006-08-24', '2006-08-30', '2006-08-24', '2006-08-30', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(462, 0, 'DTU SELF DEVELOPMENT III', 0, '0000-00-00', '0000-00-00', '2006-10-20', '2006-11-24', '2006-10-20', '2006-11-24', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(463, 0, 'DTU SELF DEVELOPMENT IV', 0, '0000-00-00', '0000-00-00', '2006-11-27', '2006-12-01', '2006-11-27', '2006-12-01', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(464, 0, 'DTU SELF DEVELOPMENT V', 0, '0000-00-00', '0000-00-00', '2006-12-04', '2006-12-08', '2006-12-04', '2006-12-08', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(465, 0, 'DTU SELF DEVELOPMENT PLUS I', 0, '0000-00-00', '0000-00-00', '2006-10-24', '2006-11-24', '2006-10-24', '2006-11-24', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(466, 0, 'DTU SELF DEVELOPMENT PLUS II', 0, '0000-00-00', '0000-00-00', '2006-12-04', '2006-12-08', '2006-12-04', '2006-12-08', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(467, 0, 'DTU MANAJEMEN STRATEGI', 0, '0000-00-00', '0000-00-00', '2006-08-28', '2006-09-13', '2006-08-28', '2006-09-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(468, 0, 'DTU TEKNISI KOMPUTER I', 0, '0000-00-00', '0000-00-00', '2006-05-15', '2006-05-19', '2006-05-15', '2006-05-19', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(469, 0, 'DTU TEKNISI KOMPUTER II', 0, '0000-00-00', '0000-00-00', '2006-06-05', '2006-06-09', '2006-06-05', '2006-06-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(470, 0, 'DTU ADMINISTRASI PERKANTORAN', 0, '0000-00-00', '0000-00-00', '2006-11-28', '2006-12-01', '2006-11-28', '2006-12-01', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(471, 0, 'DTSD PPLN TK.1 I', 0, '0000-00-00', '0000-00-00', '2006-04-04', '2006-04-26', '2006-04-04', '2006-04-26', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(472, 0, 'DTSD PPLN TK.1 II', 0, '0000-00-00', '0000-00-00', '2006-05-02', '2006-05-24', '2006-05-02', '2006-05-24', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(473, 0, 'DTSD METODE PENELITIAN', 0, '0000-00-00', '0000-00-00', '2006-08-28', '2006-09-13', '2006-08-28', '2006-09-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(474, 0, 'DTSS PEJABAT LELANG I', 0, '0000-00-00', '0000-00-00', '2006-04-20', '2006-05-24', '2006-04-20', '2006-05-24', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(475, 0, 'DTSS PEJABAT LELANG II', 0, '0000-00-00', '0000-00-00', '2006-08-23', '2006-09-26', '2006-08-23', '2006-09-26', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(476, 0, 'DTSS PENILAI DASAR', 0, '0000-00-00', '0000-00-00', '2006-07-10', '2006-08-08', '2006-07-10', '2006-08-08', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(477, 0, 'DTSS PENILAI LANJUTAN I', 0, '0000-00-00', '0000-00-00', '2006-05-29', '2006-06-21', '2006-05-29', '2006-06-21', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(478, 0, 'DTSS PENILAI LANJUTAN II', 0, '0000-00-00', '0000-00-00', '2006-07-24', '2006-08-16', '2006-07-24', '2006-08-16', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(479, 0, 'DTSS PENILAI LANJUTAN III', 0, '0000-00-00', '0000-00-00', '2006-11-16', '2006-12-06', '2006-11-16', '2006-12-06', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(480, 0, 'DTSS AUDIT PENGADAAN BARANG DAN JASA', 0, '0000-00-00', '0000-00-00', '2006-03-20', '2006-03-24', '2006-03-20', '2006-03-24', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(481, 0, 'DFP AUDITOR KETUA TIM', 0, '0000-00-00', '0000-00-00', '2006-09-18', '2006-10-05', '2006-09-18', '2006-10-05', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(482, 0, 'PLACEMENT TEST DFK PRANATA KOMPUTER', 0, '0000-00-00', '0000-00-00', '2006-09-13', '2006-09-13', '2006-09-13', '2006-09-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(483, 0, 'DFP PRANATA KOMPUTER TERAMPIL I', 0, '0000-00-00', '0000-00-00', '2006-06-26', '2006-07-21', '2006-06-26', '2006-07-21', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(484, 0, 'DFP PRANATA KOMPUTER TERAMPIL II', 0, '0000-00-00', '0000-00-00', '2006-11-06', '2006-12-06', '2006-11-06', '2006-12-06', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(485, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD I', 0, '0000-00-00', '0000-00-00', '2006-03-21', '2006-03-23', '2006-03-21', '2006-03-23', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(486, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD II', 0, '0000-00-00', '0000-00-00', '2006-08-14', '2006-08-16', '2006-08-14', '2006-08-16', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(487, 0, 'PENYEGARAN PENGENALAN INTERNET', 0, '0000-00-00', '0000-00-00', '2006-04-05', '2006-04-06', '2006-04-05', '2006-04-06', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(488, 0, 'PENYEGARAN MS-OFFICE I', 0, '0000-00-00', '0000-00-00', '2006-03-15', '2006-03-21', '2006-03-15', '2006-03-21', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(489, 0, 'PENYEGARAN MS-OFFICE II', 0, '0000-00-00', '0000-00-00', '2006-09-12', '2006-09-18', '2006-09-12', '2006-09-18', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(490, 0, 'PENYEGARAN MS-OFFICE III', 0, '0000-00-00', '0000-00-00', '2006-11-27', '2006-12-01', '2006-11-27', '2006-12-01', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(491, 0, 'PENYEGARAN BUSINESS ENGLISH FOR GOVERNMENT OFFICIALS I', 0, '0000-00-00', '0000-00-00', '2006-06-10', '2006-07-13', '2006-06-10', '2006-07-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(492, 0, 'PENYEGARAN BUSINESS ENGLISH FOR GOVERNMENT OFFICIALS II', 0, '0000-00-00', '0000-00-00', '2006-11-28', '2006-12-01', '2006-11-28', '2006-12-01', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(493, 0, 'DTU EDP AUDITING I', 0, '0000-00-00', '0000-00-00', '2005-07-18', '2005-07-22', '2005-07-18', '2005-07-22', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(494, 0, 'DTU EDP AUDITING II', 0, '0000-00-00', '0000-00-00', '2005-08-22', '2005-08-26', '2005-08-22', '2005-08-26', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(495, 0, 'DTU EDP AUDITING III', 0, '0000-00-00', '0000-00-00', '2005-11-14', '2005-11-18', '2005-11-14', '2005-11-18', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(496, 0, 'DTU STATISTICAL AUDIT SAMPLING I', 0, '0000-00-00', '0000-00-00', '2005-04-19', '2005-04-26', '2005-04-19', '2005-04-26', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1);
INSERT INTO `testing` (`id_training`, `id_program`, `name_training`, `hours_training`, `revision_plan_start_training`, `revision_plan_finish_training`, `plan_start_training`, `plan_finish_training`, `start_training`, `finish_training`, `plan_participant_training`, `participant_training`, `location_training`, `note_training`, `update_training`, `main_user`, `status_training`, `certificate_type`) VALUES
(497, 0, 'DTU STATISTICAL AUDIT SAMPLING II', 0, '0000-00-00', '0000-00-00', '2005-05-22', '2005-05-31', '2005-05-22', '2005-05-31', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(498, 0, 'DTU PENGELOLAAN WEB I', 0, '0000-00-00', '0000-00-00', '2005-07-23', '2005-08-22', '2005-07-23', '2005-08-22', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(499, 0, 'DTU PENGELOLAAN WEB II', 0, '0000-00-00', '0000-00-00', '2005-11-14', '2005-12-01', '2005-11-14', '2005-12-01', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(500, 0, 'PLACEMENT TEST TOEFL', 0, '0000-00-00', '0000-00-00', '2005-01-01', '2005-01-01', '2005-01-01', '2005-01-01', 0, 0, 'Jkt dan Balai', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(501, 0, 'DTU TOEFL I', 0, '0000-00-00', '0000-00-00', '2005-03-28', '2005-04-25', '2005-03-28', '2005-04-25', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(502, 0, 'DTU TOEFL II', 0, '0000-00-00', '0000-00-00', '2005-05-03', '2005-06-01', '2005-05-03', '2005-06-01', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(503, 0, 'DTU TOEFL III', 0, '0000-00-00', '0000-00-00', '2005-06-20', '2005-08-16', '2005-06-20', '2005-08-16', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(504, 0, 'DTU TOEFL IV', 0, '0000-00-00', '0000-00-00', '2005-07-20', '2005-08-16', '2005-07-20', '2005-08-16', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(505, 0, 'DTU TOEFL V', 0, '0000-00-00', '0000-00-00', '2005-11-16', '2005-12-13', '2005-11-16', '2005-12-13', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(506, 0, 'DTU KEPEGAWAIAN', 0, '0000-00-00', '0000-00-00', '2005-08-01', '2005-08-12', '2005-08-01', '2005-08-12', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(507, 0, 'DTU DESAIN PENGELOLAAN DATABASE I', 0, '0000-00-00', '0000-00-00', '2005-09-26', '2005-09-30', '2005-09-26', '2005-09-30', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(508, 0, 'DTU DESAIN PENGELOLAAN DATABASE II', 0, '0000-00-00', '0000-00-00', '2005-12-05', '2005-12-09', '2005-12-05', '2005-12-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(509, 0, 'DTU SELF DEVELOPMENT I', 0, '0000-00-00', '0000-00-00', '2005-05-16', '2005-05-20', '2005-05-16', '2005-05-20', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(510, 0, 'DTU SELF DEVELOPMENT II', 0, '0000-00-00', '0000-00-00', '2005-08-22', '2005-08-25', '2005-08-22', '2005-08-25', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(511, 0, 'DTU SELF DEVELOPMENT III', 0, '0000-00-00', '0000-00-00', '2005-11-21', '2005-11-25', '2005-11-21', '2005-11-25', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(512, 0, 'DTU SELF DEVELOPMENT IV', 0, '0000-00-00', '0000-00-00', '2005-12-05', '2005-12-09', '2005-12-05', '2005-12-09', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(513, 0, 'DTU TEKNISI KOMPUTER', 0, '0000-00-00', '0000-00-00', '2005-05-17', '2005-05-23', '2005-05-17', '2005-05-23', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(514, 0, 'DTSD PIUTANG DAN LELANG NEGARA TK.I', 0, '0000-00-00', '0000-00-00', '2005-03-15', '2005-04-14', '2005-03-15', '2005-04-14', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(515, 0, 'DTSS PEJABAT LELANG I', 0, '0000-00-00', '0000-00-00', '2005-04-22', '2005-04-29', '2005-04-22', '2005-04-29', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(516, 0, 'DTSS PEJABAT LELANG II', 0, '0000-00-00', '0000-00-00', '2005-05-09', '2005-06-16', '2005-05-09', '2005-06-16', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(517, 0, 'DTSS PENILAI DASAR', 0, '0000-00-00', '0000-00-00', '2005-04-12', '2005-05-23', '2005-04-12', '2005-05-23', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(518, 0, 'DTSS PENILAI LANJUTAN', 0, '0000-00-00', '0000-00-00', '2005-09-13', '2005-10-05', '2005-09-13', '2005-10-05', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(519, 0, 'DTSS JURU SITA', 0, '0000-00-00', '0000-00-00', '2005-08-23', '2005-09-23', '2005-08-23', '2005-09-23', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(520, 0, 'DTSS PEMANDU LELANG', 0, '0000-00-00', '0000-00-00', '2005-07-26', '2005-08-25', '2005-07-26', '2005-08-25', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(521, 0, 'DTSS TEKNIK IVESTIGASI', 0, '0000-00-00', '0000-00-00', '2005-05-19', '2005-06-07', '2005-05-19', '2005-06-07', 0, 0, 'Itjen', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(522, 0, 'DTSS TEKNIS INTELIJEN', 0, '0000-00-00', '0000-00-00', '2005-12-05', '2005-12-16', '2005-12-05', '2005-12-16', 0, 0, 'Itjen', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(523, 0, 'DTSS METODE PENELITIAN', 0, '0000-00-00', '0000-00-00', '2005-07-21', '2005-08-05', '2005-07-21', '2005-08-05', 0, 0, 'BAF', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(524, 0, 'DFK AUDITOR KETUA TIM', 0, '0000-00-00', '0000-00-00', '2005-07-11', '2005-07-29', '2005-07-11', '2005-07-29', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(525, 0, 'PLACEMENT TEST DFK PRANATA TERAMPIL', 0, '0000-00-00', '0000-00-00', '2005-01-01', '2005-01-01', '2005-01-01', '2005-01-01', 0, 0, 'Jkt dan Bali', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(526, 0, 'DFK PRANATA KOMPUTER TERAMPIL', 0, '0000-00-00', '0000-00-00', '2005-11-29', '2005-12-20', '2005-11-29', '2005-12-20', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(527, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD I', 0, '0000-00-00', '0000-00-00', '2005-08-09', '2005-08-11', '2005-08-09', '2005-08-11', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(528, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD II', 0, '0000-00-00', '0000-00-00', '2005-11-06', '2005-11-06', '2005-11-06', '2005-11-06', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(529, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD III', 0, '0000-00-00', '0000-00-00', '2005-10-12', '2005-10-14', '2005-10-12', '2005-10-14', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(530, 0, 'PENYEGARAN PEMANFAATAN LAPTOP DAN LCD III', 0, '0000-00-00', '0000-00-00', '2005-10-18', '2005-10-20', '2005-10-18', '2005-10-20', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(531, 0, 'PENYEGARAN PENGENALAN INTERNET BAGI PEJABAT DAN WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2005-06-14', '2005-06-15', '2005-06-14', '2005-06-15', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(532, 0, 'PENYEGARAN PENGENALAN INTERNET BAGI PEJABAT DAN WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2005-11-29', '2005-11-30', '2005-11-29', '2005-11-30', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(533, 0, 'PENYEGARAN MS-OFFICE BAGI PEJABAT/ STAF', 0, '0000-00-00', '0000-00-00', '2005-05-30', '2005-06-04', '2005-05-30', '2005-06-04', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(534, 0, 'PENYEGARAN MS-OFFICE BAGI PEJABAT/ STAF', 0, '0000-00-00', '0000-00-00', '2005-06-18', '2005-06-06', '2005-06-18', '2005-06-06', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(535, 0, 'DTSS AUDIT BARANG DAN JASA', 0, '0000-00-00', '0000-00-00', '2005-11-14', '2005-11-18', '2005-11-14', '2005-11-18', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(536, 0, 'DTU KEWIDYAISWARAAN', 0, '0000-00-00', '0000-00-00', '2005-11-14', '2005-11-26', '2005-11-14', '2005-11-26', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(537, 0, 'DTU PEMROGRAMAN KOMPUTER - TINGKAT LANJUTAN ANGKATAN XXII', 0, '0000-00-00', '0000-00-00', '2004-02-17', '2004-06-08', '2004-02-17', '2004-06-08', 0, 0, '', '', '2013-05-14 14:33:58', '', '[READY]', 1),
(538, 0, 'DTSS PENILAI ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2004-03-02', '2004-04-02', '2004-03-02', '2004-04-02', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(539, 0, 'DTU BAHASA INGGRIS ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2004-03-08', '2004-05-17', '2004-03-08', '2004-05-17', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(540, 0, 'DTSD PPLN TINGKAT I ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2004-03-09', '2004-04-07', '2004-03-09', '2004-04-07', 0, 0, '', '', '2013-05-14 14:34:18', '', '[READY]', 1),
(541, 0, 'DTU BAHASA INGGRIS ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2004-03-15', '2004-05-27', '2004-03-15', '2004-05-27', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(542, 0, 'DTSD PPLN TINGKAT I ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2004-03-16', '2004-04-15', '2004-03-16', '2004-04-15', 0, 0, '', '', '2013-05-14 14:34:32', '', '[READY]', 1),
(543, 0, 'DTSS PENILAI ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2004-04-14', '2004-05-14', '2004-04-14', '2004-05-14', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(544, 0, 'DIKLAT DIPLOMASI EKONOMI ANGKATAN III', 0, '0000-00-00', '0000-00-00', '2004-06-04', '2004-05-12', '2004-06-04', '2004-05-12', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(545, 0, 'DTU PEMROGRAMAN KOMPUTER - TINGKAT DASAR KHUSUS PEGAWAI DJP', 0, '0000-00-00', '0000-00-00', '2004-05-17', '2004-06-18', '2004-05-17', '2004-06-18', 0, 0, '', '', '2013-05-14 14:34:53', '', '[READY]', 1),
(546, 0, 'DTSS JURU SITA', 0, '0000-00-00', '0000-00-00', '2004-05-24', '2004-06-24', '2004-05-24', '2004-06-24', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(547, 0, 'DTU BAHASA INGGRIS ANGKATAN III', 0, '0000-00-00', '0000-00-00', '2004-06-07', '2004-08-16', '2004-06-07', '2004-08-16', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(548, 0, 'PENATARAN PETUGAS FO DJPLN', 0, '0000-00-00', '0000-00-00', '2004-05-07', '2004-07-09', '2004-05-07', '2004-07-09', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(549, 0, 'DTSS PEJABAT LELANG', 0, '0000-00-00', '0000-00-00', '2004-07-19', '2004-08-27', '2004-07-19', '2004-08-27', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(550, 0, 'DTU PEMROGRAMAN KOMPUTER - TINGKAT LANJUTAN ANGKATAN XXIII', 0, '0000-00-00', '0000-00-00', '2004-06-08', '2004-09-23', '2004-06-08', '2004-09-23', 0, 0, '', '', '2013-05-14 14:35:24', '', '[READY]', 1),
(551, 0, 'DTSS AUDITOR KETUA TIM', 0, '0000-00-00', '0000-00-00', '2004-09-14', '2004-10-07', '2004-09-14', '2004-10-07', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(552, 0, 'DTU PEMROGRAMAN KOMPUTER - TINGKAT LANJUTAN KHUSUS PEGAWAI DJP', 0, '0000-00-00', '0000-00-00', '2004-06-28', '2004-10-20', '2004-06-28', '2004-10-20', 0, 0, '', '', '2013-05-14 14:35:39', '', '[READY]', 1),
(553, 0, 'DTU PENGELOLAAN WEBSITE', 0, '0000-00-00', '0000-00-00', '2004-09-28', '2004-10-25', '2004-09-28', '2004-10-25', 0, 0, 'Pusdiklat Perpajakan Slipi', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(554, 0, 'DTU BAHASA INGGRIS ANGKATAN IV', 0, '0000-00-00', '0000-00-00', '2004-10-02', '2004-10-29', '2004-10-02', '2004-10-29', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(555, 0, 'DTSS TEKNIK INVESTIGASI ITJEN', 0, '0000-00-00', '0000-00-00', '2004-10-11', '2004-10-27', '2004-10-11', '2004-10-27', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(556, 0, 'DTSS PEMANDU LELANG', 0, '0000-00-00', '0000-00-00', '2004-10-04', '2004-10-28', '2004-10-04', '2004-10-28', 0, 0, 'Depkeu Itjen', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(557, 0, 'DTU PEMROGRAMAN KOMPUTER - TINGKAT DASAR', 0, '0000-00-00', '0000-00-00', '2004-11-23', '2004-12-22', '2004-11-23', '2004-12-22', 0, 0, '', '', '2013-05-14 14:36:09', '', '[READY]', 1),
(558, 0, 'DTU BAHASA INGGRIS ANGKATAN V', 0, '0000-00-00', '0000-00-00', '2004-11-24', '2004-12-21', '2004-11-24', '2004-12-21', 0, 0, 'Kampus STAN Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(559, 0, 'ELECTRONIC DATA PROCESSING (EDP) AUDITING', 0, '0000-00-00', '0000-00-00', '2004-11-29', '2004-12-03', '2004-11-29', '2004-12-03', 0, 0, '', '', '2013-05-14 14:36:32', '', '[READY]', 1),
(560, 0, 'ELECTRONIC DATA PROCESSING (EDP) AUDIT', 0, '0000-00-00', '0000-00-00', '2004-12-06', '2004-12-10', '2004-12-06', '2004-12-10', 0, 0, '', '', '2013-05-14 14:36:47', '', '[READY]', 1),
(561, 0, 'STASTITICAL AUDIT SAMPLING', 0, '0000-00-00', '0000-00-00', '2004-12-13', '2004-12-15', '2004-12-13', '2004-12-15', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(562, 0, 'STASTITICAL AUDIT SAMPLING', 0, '0000-00-00', '0000-00-00', '2004-12-20', '2004-12-22', '2004-12-20', '2004-12-22', 0, 0, 'BPPK Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(563, 0, 'DIKLAT DIPLOMASI EKONOMI ANGKATAN IV', 0, '0000-00-00', '0000-00-00', '2004-12-07', '2004-12-15', '2004-12-07', '2004-12-15', 0, 0, '', '', '2013-05-14 14:37:11', '', '[READY]', 1),
(564, 0, 'DIKLAT DI LUAR BADAN', 0, '0000-00-00', '0000-00-00', '2004-12-01', '2004-12-05', '2004-12-01', '2004-12-05', 0, 0, '', '', '2013-05-14 14:36:56', '', '[READY]', 1),
(565, 0, 'DTSS TEKNIK INVESTIGASI', 0, '0000-00-00', '0000-00-00', '2009-02-16', '2009-03-05', '2009-02-16', '2009-03-05', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(566, 0, 'WORKSHOP FISCAL RISK MANAGEMENT', 0, '0000-00-00', '0000-00-00', '2009-02-17', '2009-02-19', '2009-02-17', '2009-02-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(567, 0, 'PLACEMENT TEST TOEFL PREPARATION', 0, '0000-00-00', '0000-00-00', '2009-02-19', '2009-02-19', '2009-02-19', '2009-02-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(568, 0, 'DTSS ANALISA INTELIJEN', 0, '0000-00-00', '0000-00-00', '2009-03-10', '2009-03-24', '2009-03-10', '2009-03-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(569, 0, 'WORKSHOP FISCAL RISK: STATE OWNED COMPANY', 0, '0000-00-00', '0000-00-00', '2009-03-16', '2009-03-18', '2009-03-16', '2009-03-18', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(570, 0, 'DTU TATA NASKAH DINAS (I)', 0, '0000-00-00', '0000-00-00', '2009-03-16', '2009-03-20', '2009-03-16', '2009-03-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(571, 0, 'DTU TOEFL PREPARATION ( NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2009-03-23', '2009-04-21', '2009-03-23', '2009-04-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(572, 0, 'WORKSHOP ON PROJECT FINANCING & RISKS', 0, '0000-00-00', '0000-00-00', '2009-03-30', '2009-04-01', '2009-03-30', '2009-04-01', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(573, 0, 'DTSD PENGELOLAAN DIKLAT GOL III - NON ASRAMA AGK. I', 0, '0000-00-00', '0000-00-00', '2009-04-13', '2009-04-17', '2009-04-13', '2009-04-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(574, 0, 'WORKSHOP PURNA BHAKTI (I)', 0, '0000-00-00', '0000-00-00', '2009-04-15', '2009-04-21', '2009-04-15', '2009-04-21', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(575, 0, 'WORKSHOP PENULISAN MODUL', 0, '0000-00-00', '0000-00-00', '2009-04-20', '2009-04-22', '2009-04-20', '2009-04-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(576, 0, 'WORKSHOP LEGAL DRAFTING FOR LOAN AGREEMENT', 0, '0000-00-00', '0000-00-00', '2009-04-20', '2009-04-22', '2009-04-20', '2009-04-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(577, 0, 'DTSD PENGELOLAAN DIKLAT GOL III - NON ASRAMA AGK. II', 0, '0000-00-00', '0000-00-00', '2009-04-20', '2009-04-24', '2009-04-20', '2009-04-24', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(578, 0, 'WORKSHOP TRAINING NEEDS ANALYSIS', 0, '0000-00-00', '0000-00-00', '2009-04-21', '2009-04-23', '2009-04-21', '2009-04-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(579, 0, 'DTU TOEFL PREPARATION (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2009-04-27', '2009-05-20', '2009-04-27', '2009-05-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(580, 0, 'APPTITUTE TEST UNTUK PRANATA KOMPUTER', 0, '0000-00-00', '0000-00-00', '2009-04-28', '2009-04-28', '2009-04-28', '2009-04-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(581, 0, 'WORKSHOP TRAINING NEEDS ANALYSIS', 0, '0000-00-00', '0000-00-00', '2009-05-05', '2009-05-07', '2009-05-05', '2009-05-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(582, 0, 'DTSS FORENSIK AUDIT', 0, '0000-00-00', '0000-00-00', '2009-05-05', '2009-05-16', '2009-05-05', '2009-05-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(583, 0, 'WORKSHOP TEKNIK PENYUSUNAN SOAL', 0, '0000-00-00', '0000-00-00', '2009-05-06', '2009-05-08', '2009-05-06', '2009-05-08', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(584, 0, 'WORKSHOP PURNA BHAKTI (II)', 0, '0000-00-00', '0000-00-00', '2009-05-06', '2009-05-12', '2009-05-06', '2009-05-12', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(585, 0, 'WORKSHOP DIPLOMASI EKONOMI (I)', 0, '0000-00-00', '0000-00-00', '2009-05-11', '2009-05-15', '2009-05-11', '2009-05-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(586, 0, 'DTU KEARSIPAN ELEKTRONIK', 0, '0000-00-00', '0000-00-00', '2009-05-11', '2009-05-15', '2009-05-11', '2009-05-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(587, 0, 'WORKSHOP MICROSOFT POWER POINT &AMP; EXCEL (ADVANCED)', 0, '0000-00-00', '0000-00-00', '2009-05-12', '2009-05-14', '2009-05-12', '2009-05-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(588, 0, 'DTSD PENGELOLAAN DIKLAT GOL II', 0, '0000-00-00', '0000-00-00', '2009-05-15', '2009-05-20', '2009-05-15', '2009-05-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(589, 0, 'WORKSHOP PELAYANAN PRIMA', 0, '0000-00-00', '0000-00-00', '2009-05-18', '2009-05-20', '2009-05-18', '2009-05-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(590, 0, 'DTSS PSIKOLOGI AUDIT', 0, '0000-00-00', '0000-00-00', '2009-05-18', '2009-05-20', '2009-05-18', '2009-05-20', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(591, 0, 'DFP PRANATA KOMPUTER TERAMPIL (I)', 0, '0000-00-00', '0000-00-00', '2009-05-25', '2009-06-23', '2009-05-25', '2009-06-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(592, 0, 'WORKSHOP MENULIS ILMIAH POPULER (I)', 0, '0000-00-00', '0000-00-00', '2009-05-26', '2009-05-28', '2009-05-26', '2009-05-28', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(593, 0, 'DTSS TEKNIK INTELIJEN TINGKAT DASAR', 0, '0000-00-00', '0000-00-00', '2009-06-08', '2009-06-19', '2009-06-08', '2009-06-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(594, 0, 'DFP PRANATA KOMPUTER TERAMPIL (II)', 0, '0000-00-00', '0000-00-00', '2009-06-29', '2009-07-27', '2009-06-29', '2009-07-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(595, 0, 'DTSS MANAJEMEN RESIKO', 0, '0000-00-00', '0000-00-00', '2009-06-29', '2009-07-03', '2009-06-29', '2009-07-03', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(596, 0, 'DTU DESAIN PENGELOLAAN DATABASE', 0, '0000-00-00', '0000-00-00', '2009-06-15', '2009-06-19', '2009-06-15', '2009-06-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(597, 0, 'WORKSHOP MENULIS ILMIAH POPULER (II)', 0, '0000-00-00', '0000-00-00', '2009-06-02', '2009-06-04', '2009-06-02', '2009-06-04', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(598, 0, 'WORKSHOP DIPLOMASI EKONOMI (II)', 0, '0000-00-00', '0000-00-00', '2009-06-15', '2009-06-19', '2009-06-15', '2009-06-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(599, 0, 'W. BUSINESS ENGLISH FOR GOV. OFFICIAL: WRITING BUSINESS PROCESS', 0, '0000-00-00', '0000-00-00', '2009-06-15', '2009-06-19', '2009-06-15', '2009-06-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(600, 0, 'DTU LEGAL DRAFTING (I)', 0, '0000-00-00', '0000-00-00', '2009-06-22', '2009-06-26', '2009-06-22', '2009-06-26', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(601, 0, 'DTU TOEFL PREPARATION (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2009-06-29', '2009-07-27', '2009-06-29', '2009-07-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(602, 0, 'SEMINAR PELUANG DAN TANTANGAN BERINVESTASI DI PASAR MODAL', 0, '0000-00-00', '0000-00-00', '2009-06-23', '2009-06-23', '2009-06-23', '2009-06-23', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(603, 0, 'WORKSHOP MANAJEMEN RESIKO', 0, '0000-00-00', '0000-00-00', '2009-06-23', '2009-06-25', '2009-06-23', '2009-06-25', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(604, 0, 'DTU KEPEGAWAIAN', 0, '0000-00-00', '0000-00-00', '2009-07-13', '2009-07-17', '2009-07-13', '2009-07-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(605, 0, 'DTU LEGAL DRAFTING (II)', 0, '0000-00-00', '0000-00-00', '2009-07-13', '2009-07-17', '2009-07-13', '2009-07-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(606, 0, 'SEMINAR DERIVATIF MARKET; BEAUTY OR BEAST?', 0, '0000-00-00', '0000-00-00', '2009-07-22', '2009-07-22', '2009-07-22', '2009-07-22', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(607, 0, 'WORKSHOP EFFECTIVE NEGOTIATION SKILL', 0, '0000-00-00', '0000-00-00', '2009-07-13', '2009-07-15', '2009-07-13', '2009-07-15', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(608, 0, 'WORKSHOP COMMUNICATION SKILL AND PUBLIC SPEAKING', 0, '0000-00-00', '0000-00-00', '2009-07-07', '2009-07-10', '2009-07-07', '2009-07-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(609, 0, 'DTU TOEFL PREPARATION ( ASRAMA)', 0, '0000-00-00', '0000-00-00', '2009-07-30', '2009-08-27', '2009-07-30', '2009-08-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(610, 0, 'DF JFA PEMBENTUKAN AUDITOR AHLI (I)', 0, '0000-00-00', '0000-00-00', '2009-07-13', '2009-08-07', '2009-07-13', '2009-08-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(611, 0, 'WORKSHOP DERIVATIVE SECURITIES : PRICING AND POLICY', 0, '0000-00-00', '0000-00-00', '2009-07-27', '2009-07-27', '2009-07-27', '2009-07-27', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(612, 0, 'DIKLAT FUNGSIONAL CALON WIDYAISWARA (PROGRAM UMUM)', 0, '0000-00-00', '0000-00-00', '2009-07-14', '2009-08-17', '2009-07-14', '2009-08-17', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(613, 0, 'DIKLAT FUNGSIONAL CALON WIDYAISWARA (PROGRAM KHUSUS)', 0, '0000-00-00', '0000-00-00', '2009-07-18', '2009-07-19', '2009-07-18', '2009-07-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(614, 0, 'DTSS RISK BASED AUDIT', 0, '0000-00-00', '0000-00-00', '2009-08-03', '2009-08-07', '2009-08-03', '2009-08-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(615, 0, 'PENYEGARAN PENGELOLAAN WEB DINAMIS (PELAKSANA)', 0, '0000-00-00', '0000-00-00', '2009-08-03', '2009-08-07', '2009-08-03', '2009-08-07', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(616, 0, 'DF JFA PEMBENTUKAN AUDITOR TERAMPIL I', 0, '0000-00-00', '0000-00-00', '2009-09-29', '2009-10-19', '2009-09-29', '2009-10-19', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(617, 0, 'DF JFA PEMBENTUKAN AUDITOR AHLI (II)', 0, '0000-00-00', '0000-00-00', '2009-10-05', '2009-10-29', '2009-10-05', '2009-10-29', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(618, 0, 'DTSS MANAJEMEN RISIKO (II)', 0, '0000-00-00', '0000-00-00', '2009-10-12', '2009-10-16', '2009-10-12', '2009-10-16', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(619, 0, 'SEMINAR KEBIJAKAN PERPAJAKAN PASAR MODAL INDONESIA', 0, '0000-00-00', '0000-00-00', '2009-10-14', '2009-10-14', '2009-10-14', '2009-10-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(620, 0, 'DFP PRANATA KOMPUTER AHLI (II)', 0, '0000-00-00', '0000-00-00', '2009-11-03', '2009-12-10', '2009-11-03', '2009-12-10', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(621, 0, 'DTSS RISK BASED AUDIT (II)', 0, '0000-00-00', '0000-00-00', '2009-11-09', '2009-11-13', '2009-11-09', '2009-11-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(622, 0, 'WORKSHOP PERSIAPAN PURNABAKTI (III)', 0, '0000-00-00', '0000-00-00', '2009-11-09', '2009-11-13', '2009-11-09', '2009-11-13', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(623, 0, 'DF JFA PEMBENTUKAN AUDITOR TERAMPIL (II)', 0, '0000-00-00', '0000-00-00', '2009-11-23', '2009-12-14', '2009-11-23', '2009-12-14', 0, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(624, 0, 'DTU TOEFL PREPARATION ANGKATAN I (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-05-08', '2007-06-04', '2007-05-08', '2007-06-04', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(625, 0, 'DTU TOEFL PREPARATION ANGKATAN II (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-06-18', '2007-07-10', '2007-06-18', '2007-07-10', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(626, 0, 'DTU TOEFL PREPARATION ANGKATAN III (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-07-12', '2007-08-07', '2007-07-12', '2007-08-07', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(627, 0, 'DTU TOEFL PREPARATION ANGKATAN IV (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-08-16', '2007-09-07', '2007-08-16', '2007-09-07', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(628, 0, 'DTU TOEFL PREPARATION ANGKATAN V (NON ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-09-10', '2007-10-04', '2007-09-10', '2007-10-04', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(629, 0, 'DTU TOEFL PREPARATION ANGKATAN VI (ASRAMA)', 0, '0000-00-00', '0000-00-00', '2007-10-29', '2007-11-30', '2007-10-29', '2007-11-30', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(630, 0, 'DTU DECAIN PENGELOLAAN DATABASE', 0, '0000-00-00', '0000-00-00', '2007-04-23', '2007-04-27', '2007-04-23', '2007-04-27', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(631, 0, 'DTU ADMINISTRASI PERKANTORAN DAN KEARSIPAN', 0, '0000-00-00', '0000-00-00', '2007-03-20', '2007-03-23', '2007-03-20', '2007-03-23', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(632, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2007-06-19', '2007-06-28', '2007-06-19', '2007-06-28', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(633, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2007-08-17', '2007-07-26', '2007-08-17', '2007-07-26', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(634, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN III', 0, '0000-00-00', '0000-00-00', '2007-07-31', '2007-08-09', '2007-07-31', '2007-08-09', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(635, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN IV', 0, '0000-00-00', '0000-00-00', '2007-08-20', '2007-08-24', '2007-08-20', '2007-08-24', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(636, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN V', 0, '0000-00-00', '0000-00-00', '2007-08-27', '2007-08-31', '2007-08-27', '2007-08-31', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(637, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN VI', 0, '0000-00-00', '0000-00-00', '2007-09-04', '2007-09-13', '2007-09-04', '2007-09-13', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(638, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN VII', 0, '0000-00-00', '0000-00-00', '2007-10-30', '2007-11-07', '2007-10-30', '2007-11-07', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(639, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN VIII', 0, '0000-00-00', '0000-00-00', '2007-11-13', '2007-11-21', '2007-11-13', '2007-11-21', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(640, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA ANGKATAN IX', 0, '0000-00-00', '0000-00-00', '2007-11-27', '2007-12-05', '2007-11-27', '2007-12-05', 0, 0, 'Gadog', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(641, 0, 'DTSS PENGELOLAAN KEKAYAAN NEGARA (ITJEN)', 0, '0000-00-00', '0000-00-00', '2007-06-25', '2007-07-06', '2007-06-25', '2007-07-06', 0, 0, 'Banteng', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(642, 0, 'DTSS PENILAIAN PROPERTI DASAR ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2007-04-02', '2007-05-03', '2007-04-02', '2007-05-03', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(643, 0, 'DTSS PENILAIAN PROPERTI DASAR ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2007-05-07', '2007-06-07', '2007-05-07', '2007-06-07', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(644, 0, 'DTSS PENILAIAN PROPERTI LANJUTAN', 0, '0000-00-00', '0000-00-00', '2007-06-13', '2007-07-13', '2007-06-13', '2007-07-13', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(645, 0, 'DTSS PENILAIAN USAHA DASAR ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2007-04-03', '2007-04-27', '2007-04-03', '2007-04-27', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(646, 0, 'DTSS PENILAIAN USAHA DASAR ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2007-05-07', '2007-05-31', '2007-05-07', '2007-05-31', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(647, 0, 'DTSS PENILAIAN USAHA DASAR ANGKATAN III', 0, '0000-00-00', '0000-00-00', '2007-07-16', '2007-08-08', '2007-07-16', '2007-08-08', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(648, 0, 'DTSS PENILAIAN USAHA LANJUTAN', 0, '0000-00-00', '0000-00-00', '2007-08-13', '2007-09-12', '2007-08-13', '2007-09-12', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(649, 0, 'DTSS PEJABAT LELANG ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2007-11-05', '2007-11-17', '2007-11-05', '2007-11-17', 0, 0, 'Asrama Eksternal', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(650, 0, 'DTSS PEJABAT LELANG ANGKATAN II*', 0, '0000-00-00', '0000-00-00', '2007-11-12', '2007-11-23', '2007-11-12', '2007-11-23', 0, 0, 'Asrama Eksternal', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(651, 0, 'DTSS PEJABAT LELANG ANGKATAN III*', 0, '0000-00-00', '0000-00-00', '2007-11-19', '2007-11-30', '2007-11-19', '2007-11-30', 0, 0, 'Asrama Eksternal', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(652, 0, 'DTSS TEKNIK INVESTIGASI', 0, '0000-00-00', '0000-00-00', '2007-08-21', '2007-09-06', '2007-08-21', '2007-09-06', 0, 0, 'Banteng', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(653, 0, 'DTSS TEKNIK INTELIJEN', 0, '0000-00-00', '0000-00-00', '2007-09-03', '2007-09-14', '2007-09-03', '2007-09-14', 0, 0, 'Banteng', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(654, 0, 'DTSS PEMERIKSAAN BERBASIS RESIKO', 0, '0000-00-00', '0000-00-00', '2007-05-07', '2007-05-11', '2007-05-07', '2007-05-11', 0, 0, 'Banteng', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(655, 0, 'DFP PRANATA KOMPUTER TERAMPIL ANGKATAN I', 0, '0000-00-00', '0000-00-00', '2007-02-26', '2007-03-23', '2007-02-26', '2007-03-23', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(656, 0, 'DFP PRANATA KOMPUTER TERAMPIL ANGKATAN II', 0, '0000-00-00', '0000-00-00', '2007-08-21', '2007-09-15', '2007-08-21', '2007-09-15', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(657, 0, 'DFP PRANATA KOMPUTER AHLI', 0, '0000-00-00', '0000-00-00', '2007-08-24', '2007-08-25', '2007-08-24', '2007-08-25', 0, 0, 'Jurangmangu', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(658, 0, 'DFP AUDITOR (JFA)', 0, '0000-00-00', '0000-00-00', '2007-06-04', '2007-06-22', '2007-06-04', '2007-06-22', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(659, 0, 'DFP PERSIAPAN ORASI ILMIAH WIDYAISWARA', 0, '0000-00-00', '0000-00-00', '2007-09-10', '2007-10-08', '2007-09-10', '2007-10-08', 0, 0, 'Purnawarman', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(660, 0, 'PENYEGARAN TATA NASKAH DINAS (3 ANGKATAN)*', 0, '0000-00-00', '0000-00-00', '2007-06-11', '2007-06-13', '2007-06-11', '2007-06-13', 0, 0, 'Banteng', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(661, 0, 'PENYEGARAN KEPEGAWAIAN*', 0, '0000-00-00', '0000-00-00', '2007-11-28', '2007-11-29', '2007-11-28', '2007-11-29', 0, 0, 'Asrama Eksternal', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(662, 0, 'DTSS EKONOMETRIKA TK DASAR AKT I [...Peserta BKF...]', 30, '2012-03-26', '2012-03-29', '2012-04-09', '2012-04-11', '2012-03-26', '2012-03-29', 0, 18, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-06-14 08:50:15', '', '[READY]', 1),
(663, 0, 'DTSS ANALISIS FUNDAMENTAL PASAR MODAL [...Peserta BAPEPAM-LK...]', 21, '2012-04-16', '2012-04-17', '2012-04-16', '2012-04-17', '2012-04-16', '2012-04-17', 25, 0, 'Hotel/Eksternal', 'semula:DTU ANALISIS TEKNIKAL PASAR MODAL [...Peserta BAPEPAM-LK...]', '2012-08-14 12:06:07', '', '[READY]', 1),
(664, 0, 'BLENDED LEARNING ON SCIENCE AND POLICY OF CLIMATE CHANGE', 114, '2012-04-11', '2012-07-11', '2012-04-11', '2012-07-11', '2012-04-11', '2012-07-11', 0, 17, 'Others', '', '2012-08-14 11:15:07', '', '[READY]', 1),
(665, 0, 'DTU TOT PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI', 44, '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', '2012-04-23', '2012-04-27', 0, 0, '', 'BARU-BARU-BARU-BARU-BARU', '2012-06-14 09:10:24', '', '[READY]', 1),
(666, 0, 'DTSD TEORI EKONOMI MAKRO AKT II [...Peserta BKF...]', 34, '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', '2012-03-19', '2012-03-22', 0, 20, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-06-14 09:23:30', '', '[READY]', 1),
(667, 0, 'DTU ORIENTASI PEGAWAI BKF', 48, '2012-04-02', '2012-04-09', '2012-04-02', '2012-04-09', '2012-04-02', '2012-04-09', 0, 17, 'Lab801 PKU', 'BARU-BARU-BARU-BARU-BARU', '2012-04-30 09:08:11', '', '[READY]', 1),
(668, 0, 'SEMINAR IMPLEMENTASI SISTEM PENGAWASAN LEMBAGA KEUANGAN PASCA DISAHKANNYA UU OJK (PELUANG &amp; KENDALA)', 0, '2012-04-18', '2012-04-18', '2012-04-18', '2012-04-18', '2012-04-18', '2012-04-18', 0, 0, 'Hotel/Eksternal', 'TEMPAT: HOTEL BOROBUDUR, JAKARTA', '2012-06-14 09:15:22', '', '[READY]', 1),
(671, 0, 'DTSS ANALISIS LAPORAN KEUANGAN PERUSAHAAN ASURANSI DAN PERUSAHAAN REASURANSI [...Peserta BAPEPAM-LK...]', 0, '2012-10-23', '2012-10-25', '2012-10-23', '2012-10-25', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-10-08 20:05:35', '', '[READY]', 1),
(672, 0, 'DTSS ANALISIS LAPORAN KEUANGAN PERUSAHAAN DANA PENSIUN [...Peserta BAPEPAM-LK...]', 0, '2012-07-18', '2012-07-19', '2012-07-18', '2012-07-19', '2012-07-18', '2012-07-19', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-08-14 13:08:53', '', '[READY]', 1),
(674, 0, 'DTSS PELAYANAN KEDIKLATAN [...Peserta BPPK...]', 39, '2012-05-28', '2012-05-31', '2012-05-28', '2012-05-31', '2012-05-28', '2012-05-31', 30, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-08-30 15:32:15', '', '[READY]', 1),
(675, 0, 'DTSS TEORI EKONOMI MAKRO LANJUTAN [...Peserta BKF...]', 0, '2012-04-23', '2012-04-26', '2012-04-23', '2012-04-26', '2012-04-23', '2012-04-26', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-06-14 09:29:40', '', '[READY]', 1),
(676, 0, 'DTSS DMFAS ANGKATAN I (DJPU)', 30, '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', '2012-06-04', '2012-06-08', 30, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-07-26 09:46:08', '', '[READY]', 1),
(677, 0, 'DTSS DMFAS ANGKATAN II (DJPU)', 30, '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', '2012-06-11', '2012-06-15', 30, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-07-26 09:46:18', '', '[READY]', 1),
(678, 0, 'SEMINAR PERSIAPAN PURNABHAKTI: KIAT DAN STRATEGI MENGHADAPI PENSIUN DARI PERSPEKTIF PSIKOLOGIS, ENTREPRENEURSHIP DAN KESEHATAN', 4, '2012-04-26', '2012-04-26', '2012-04-26', '2012-04-26', '2012-04-26', '2012-04-26', 0, 0, 'Hotel/Eksternal', 'TEMPAT: HOTEL NOVOTEL, BALIKPAPAN', '2012-06-14 09:15:50', '', '[READY]', 1),
(679, 0, 'DF JFA PENJENJANGAN AUDITOR MADYA [...Peserta ITJEN...]', 120, '2012-06-18', '2012-06-30', '2012-09-17', '2012-10-02', '2012-06-18', '2012-06-30', 30, 0, 'Others', 'semula: DF PENJENJANGAN JFA PENGENDALI TEKNIS', '2012-08-30 13:03:12', '', '[READY]', 1),
(680, 0, 'DTSS KEPANITERAAN ANGKATAN II [...Peserta SETJEN...]', 0, '2012-09-11', '2012-09-14', '2012-09-11', '2012-09-14', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-08-14 12:25:56', '', '[READY]', 1),
(681, 0, 'DTSS KEPANITERAAN ANGKATAN III [...Peserta SETJEN...]', 0, '2012-09-18', '2012-09-21', '2012-09-18', '2012-09-21', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-08-14 12:25:32', '', '[READY]', 1),
(683, 0, 'DTU BUSINESS COMMUNICATION I (Reguler Class)', 52, '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', 15, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-10-17 10:45:43', '', '[READY]', 1),
(684, 0, 'DTU BUSINESS COMMUNICATION (Executive Class)', 52, '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', 15, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-10-17 10:44:19', '', '[READY]', 1),
(685, 0, 'DTU BUSINESS COMMUNICATION III (Reguler Class)', 52, '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', 15, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-10-17 10:45:50', '', '[READY]', 1),
(686, 0, 'DTU BUSINESS COMMUNICATION II (Reguler Class)', 52, '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', '2012-07-10', '2012-08-13', 15, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-10-17 10:45:57', '', '[READY]', 1),
(688, 0, 'DTSS DMFAS ANGKATAN III (DJPU)', 0, '2012-08-06', '2012-08-10', '2012-08-06', '2012-08-10', '2012-08-06', '2012-08-10', 0, 0, 'Hotel/Eksternal', 'semula: DTU ENGLISH TRAINING [...DJPU...]', '2012-08-30 14:13:51', '', '[READY]', 1),
(689, 0, 'TRAINING SAP DASHBOARD DESIGN (EXCELSIUS) [...Peserta BAPEPAM-LK...]', 0, '2012-08-29', '2012-08-31', '2012-08-29', '2012-08-31', '2012-08-29', '2012-08-31', 0, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU', '2012-08-30 15:24:33', '', '[READY]', 1),
(691, 0, 'DTU PEMROGRAMAN WEB DENGAN ASP.NET', 0, '2012-10-29', '2012-11-02', '2012-05-21', '2012-05-25', '2012-10-29', '2012-11-02', 0, 0, '', '&gt;&gt;&gt; semula: DTU PEMROGRAMAN WEB DENGAN ASP', '2012-10-23 10:00:34', '', '[READY]', 1),
(692, 0, 'DTU PENGELOLAAN KINERJA PEGAWAI', 0, '2012-11-19', '2012-11-22', '2012-11-19', '2012-11-22', '0000-00-00', '0000-00-00', 0, 0, '', 'CANCELED-CANCELED-CANCELED-CANCELED-CANCELED', '2012-11-08 17:31:52', '', '[READY]', 1),
(693, 0, 'DTU MICROSOFT EXCEL, ACCES, POWERPOINT TK. TINGGI (KHUSUS DJP)', 28, '2012-08-29', '2012-08-31', '2012-08-29', '2012-08-31', '2012-08-29', '2012-08-31', 30, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU [...Dana Swakelola...]', '2012-12-12 08:55:28', '', '[READY]', 1),
(695, 0, 'DTSS TEKNIK INTELIJEN LANJUTAN PASAR MODAL (MATBAR-PENJEJAKAN)', 0, '2012-11-26', '2012-11-30', '2012-11-26', '2012-11-30', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU [...Peserta BAPEPAM-LK...]', '2012-10-05 10:50:45', '', '[READY]', 1),
(696, 0, 'WORKSHOP INTELIJEN DASAR [...Peserta KOMWAS PERPAJAKAN...]', 0, '2012-10-29', '2012-10-31', '2012-10-29', '2012-10-31', '0000-00-00', '0000-00-00', 0, 0, 'Others', 'BARU-BARU-BARU-BARU-BARU [...Dana Swakelola...]', '2012-10-05 10:58:06', '', '[READY]', 1),
(697, 0, 'WORKSHOP ANALISIS SAHAM [...Peserta BAPEPAM-LK...]', 0, '2012-10-30', '2012-10-30', '2012-10-30', '2012-10-30', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-10-22 09:56:24', '', '[READY]', 1),
(698, 0, 'WORKSHOP KARAKTERISTIK INVESTOR KELEMBAGAAN [...Peserta BAPEPAM-LK...]', 0, '2012-11-27', '2012-11-27', '2012-12-31', '2012-12-31', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'BARU-BARU-BARU-BARU-BARU', '2012-11-19 16:20:30', '', '[READY]', 1),
(699, 0, 'SEMINAR CAPACITY BUILDING FOR GOVERNMENT OFFICIALS', 0, '2012-10-18', '2012-10-18', '2012-10-18', '2012-10-18', '0000-00-00', '0000-00-00', 0, 0, 'Others', 'TEMPAT: PURNAWARMAN [...Video Conference...]', '2012-10-05 11:11:37', '', '[READY]', 1),
(700, 0, 'SEMINAR PERSIAPAN PURNABHAKTI:KIAT DAN STRATEGI MENGHADAPI PENSIUN DARI PERSPEKTIF PSIKOLOGIS, ENTREPRENEURSHIP DAN KESEHATAN', 0, '2012-10-24', '2012-10-24', '2012-10-24', '2012-10-24', '0000-00-00', '0000-00-00', 0, 0, 'Others', 'TEMPAT: PEKANBARU', '2012-10-05 11:10:27', '', '[READY]', 1),
(701, 0, 'DTU BUSINESS COMMUNICATION IV', 0, '2012-11-19', '2012-11-27', '2012-11-19', '2012-11-27', '0000-00-00', '0000-00-00', 0, 0, '', 'BARU-BARU-BARU-BARU-BARU', '2012-10-17 10:43:57', '', '[READY]', 1),
(702, 0, 'SEMINAR FINANCING GROWTH: IMPROVING THE INVESTMENT THROUGHT INFRASTRUCTURE DEVELOPMENT', 6, '2012-10-23', '2012-10-23', '2012-10-23', '2012-10-23', '0000-00-00', '0000-00-00', 36, 0, 'Others', 'TEMPAT: SEKRETARIAT BPPK (...Video Conference Method...)', '2012-10-19 13:13:35', '', '[READY]', 1),
(703, 0, 'SEMINAR GREEN GROWTH', 4, '2012-10-31', '2012-10-31', '2012-10-31', '2012-10-31', '0000-00-00', '0000-00-00', 30, 0, 'Lab Purnawarman', '(...Video conference method...)', '2012-12-05 09:32:29', '', '[READY]', 1),
(704, 0, 'DIKLAT BAHASA PEMROGRAMAN JAVA [...Peserta BAPEPAM-LK...]', 0, '2012-12-03', '2012-12-07', '2012-12-03', '2012-12-07', '0000-00-00', '0000-00-00', 0, 0, 'Others', 'baru', '2012-12-03 17:54:34', '', '[READY]', 1),
(705, 0, 'SEMINAR SIMPHONY SINERGI MENUJU KEBERHASILAN', 6, '0000-00-00', '0000-00-00', '2012-12-06', '2012-12-06', '0000-00-00', '0000-00-00', 100, 0, 'Others', '...BARU BARU BARU... ', '2012-12-05 09:01:09', '', '[READY]', 1),
(717, 0, 'DTU TOEFL iBT PREPARATION AKT III', 0, '2012-11-01', '2012-11-30', '2012-11-01', '2012-11-30', '0000-00-00', '0000-00-00', 0, 0, 'Lab803 PKU', 'BARU-BARU-BARU-BARU-BARU', '2012-11-12 11:21:56', '', '[READY]', 1),
(718, 0, 'DIKLAT PERENCANAAN DIKLAT (ANGKT. I)', 43, '0000-00-00', '0000-00-00', '2013-01-14', '2013-01-18', '2013-01-14', '2013-01-18', 20, 18, 'R701 PKU', 'semula: MANAJEMEN PERENCANAAN DIKLAT: DESAIN PROGRAM DIKLAT', '2013-03-27 09:50:43', 'BPPK', '[READY]', 1),
(719, 0, 'DIKLAT EVALUASI AKIP', 47, '0000-00-00', '0000-00-00', '2013-01-14', '2013-01-18', '2013-01-14', '2013-01-18', 30, 42, 'Aula PKU', '', '2013-02-25 22:28:47', 'ITJEN', '[READY]', 1),
(720, 0, 'DIKLAT MANAJEMEN PENYELENGGARAAN DIKLAT (ANGKT. I)', 44, '0000-00-00', '0000-00-00', '2013-01-28', '2013-02-01', '2013-01-28', '2013-02-01', 20, 20, 'R701 PKU', '', '2013-03-27 09:26:37', 'BPPK', '[READY]', 1),
(721, 0, 'DIKLAT PENULISAN LAPORAN HASIL AUDIT YANG EFEKTIF UNTUK ANGGOTA TIM ', 47, '0000-00-00', '0000-00-00', '2013-01-28', '2013-02-01', '2013-01-28', '2013-02-01', 30, 34, 'Aula PKU', 'sebelumnya PENYUSUNAN EFEKTIF LAPORAN HASIL AUDIT', '2013-03-27 09:27:01', 'ITJEN', '[READY]', 1),
(722, 0, 'PLACEMENT TEST TOEFL PREPARATION', 3, '0000-00-00', '0000-00-00', '2013-02-04', '2013-02-05', '2013-02-04', '2013-02-05', 680, 0, 'Others', '', '2013-03-27 10:02:41', 'KEMENKEU', '[READY]', 1),
(723, 0, 'ORIENTASI TEORI EKONOMI MAKRO - TINGKAT DASAR', 34, '2013-11-04', '2013-11-09', '2013-02-05', '2013-02-07', '0000-00-00', '0000-00-00', 20, 0, 'Hotel/Eksternal', '#Sebelumnya DIKLAT TEORI EKONOMI MAKRO - TINGKAT DASAR #S-917/PP.7/2013 #S-906/KF.1/UP.6/2013', '2013-10-18 10:45:44', 'BKF', '[READY]', 1),
(724, 0, 'DIKLAT FUNGSIONAL PRANATA KOMPUTER AHLI ', 213, '2013-02-06', '2013-03-15', '2013-02-06', '2013-03-15', '2013-02-06', '2013-03-15', 25, 25, 'R701 PKU', '', '2013-03-27 10:04:13', 'KEMENKEU', '[READY]', 1),
(725, 0, 'DIKLAT DESAIN PENGELOLAAN DATABASE (ANGKT. I)', 45, '0000-00-00', '0000-00-00', '2013-02-11', '2013-02-15', '2013-02-11', '2013-02-15', 30, 38, 'Lab801 PKU', '', '2013-03-27 10:07:49', 'KEMENKEU', '[READY]', 1),
(726, 0, 'DIKLAT PERENCANAAN DIKLAT (ANGKT. II)', 44, '0000-00-00', '0000-00-00', '2013-02-11', '2013-02-15', '2013-02-11', '2013-02-15', 20, 20, 'Hotel/Eksternal', 'sebelumnya MANAJEMEN PERENCANAAN DIKLAT: DESAIN PROGRAM DIKLAT', '2013-03-27 09:28:40', 'BPPK', '[READY]', 1),
(727, 0, 'DIKLAT PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI (ANGKT. I)', 46, '0000-00-00', '0000-00-00', '2013-02-11', '2013-02-15', '2013-02-11', '2013-02-15', 30, 34, 'Aula PKU', '', '2013-03-27 09:37:05', 'KEMENKEU', '[READY]', 1),
(728, 0, 'PLACEMENT TEST MICROSOFT OFFICE', 3, '0000-00-00', '0000-00-00', '2013-02-11', '2013-02-11', '2013-02-11', '2013-02-11', 467, 0, 'Others', '', '2013-03-27 10:06:58', 'KEMENKEU', '[READY]', 1),
(729, 0, 'DIKLAT TEKNIK INVESTIGASI - TINGKAT DASAR', 107, '2013-02-11', '2013-02-25', '2013-02-11', '2013-02-27', '2013-02-11', '2013-02-25', 25, 22, 'R603 PKU', 'NR - 16 Januari 2013', '2013-03-27 10:35:24', 'ITJEN', '[READY]', 1),
(730, 0, 'DIKLAT ADMINISTRASI JARINGAN KOMPUTER', 47, '0000-00-00', '0000-00-00', '2013-02-18', '2013-02-22', '2013-02-18', '2013-02-22', 30, 38, 'Lab801 PKU', '', '2013-03-27 10:11:40', 'KEMENKEU', '[READY]', 1),
(731, 0, 'DIKLAT BUSINESS ENGLISH (ANGKT. I)', 43, '0000-00-00', '0000-00-00', '2013-02-18', '2013-02-22', '2013-02-18', '2013-02-22', 30, 34, 'R601 PKU', '', '2013-03-27 09:38:20', 'KEMENKEU', '[READY]', 1),
(732, 0, 'DIKLAT EVALUASI DIKLAT (ANGKT. I)', 44, '0000-00-00', '0000-00-00', '2013-02-18', '2013-02-22', '2013-02-18', '2013-02-22', 20, 20, 'R701 PKU', 'sebelumnya MANAJEMEN EVALUASI DIKLAT', '2013-03-27 09:38:44', 'BPPK', '[READY]', 1),
(733, 0, 'DIKLAT MENULIS UNTUK MEDIA MASSA', 29, '2013-02-26', '2013-02-28', '2013-02-19', '2013-02-21', '2013-02-26', '2013-02-28', 20, 19, '', 'ND-037/PP.72/2013', '2013-03-27 10:36:16', 'KEMENKEU', '[READY]', 1),
(734, 0, 'DIKLAT ANALISIS BEBAN KERJA (ANGKT. I)', 42, '0000-00-00', '0000-00-00', '2013-02-25', '2013-03-01', '2013-02-25', '2013-03-01', 30, 32, 'R601 PKU', '', '2013-03-27 10:14:20', 'KEMENKEU', '[READY]', 1),
(735, 0, 'DIKLAT SERVICE LEVEL AGREEMENT KEDIKLATAN (ANGKT. I)', 44, '2013-05-20', '2013-05-24', '2013-02-25', '2013-03-01', '0000-00-00', '0000-00-00', 20, 0, 'Hotel/Eksternal', 'sebelumnya DIKLAT TRAINING SERVICE LEVEL AGREEMENT (ANGKT. I) # ND-051/PP.7.2/2013 # ND-129/PP.7.2/2013', '2013-04-30 17:44:13', 'BPPK', '[READY]', 1),
(736, 0, 'DIKLAT CONTROL SELF ASSESSMENT', 46, '0000-00-00', '0000-00-00', '2013-02-25', '2013-03-01', '2013-02-25', '2013-03-01', 30, 38, 'R701 PKU', '', '2013-03-27 10:15:11', 'KEMENKEU', '[READY]', 1),
(737, 0, 'DIKLAT MANAJEMEN RISIKO (ANGKT. I)', 45, '0000-00-00', '0000-00-00', '2013-03-04', '2013-03-08', '2013-03-04', '2013-03-08', 30, 53, 'Aula PKU', '', '2013-03-27 10:18:47', 'KEMENKEU', '[READY]', 1),
(738, 0, 'DIKLAT MANAJEMEN UTANG', 30, '0000-00-00', '0000-00-00', '2013-03-04', '2013-03-11', '2013-03-04', '2013-03-11', 20, 26, 'Others', '', '2013-03-27 10:19:52', 'DJPU', '[READY]', 1),
(739, 0, 'DIKLAT MICROSOFT ACCESS - TINGKAT DASAR (ANGKT. I)', 44, '0000-00-00', '0000-00-00', '2013-03-04', '2013-03-08', '2013-03-04', '2013-03-08', 30, 31, 'Lab801 PKU', '', '2013-03-27 10:21:09', 'KEMENKEU', '[READY]', 1),
(740, 0, 'DIKLAT SEKRETARIS PIMPINAN (ANGKT. I)', 40, '0000-00-00', '0000-00-00', '2013-03-04', '2013-03-07', '2013-03-04', '2013-03-07', 30, 39, 'R601 PKU', '', '2013-03-27 10:21:43', 'KEMENKEU', '[READY]', 1),
(741, 0, 'DIKLAT TEKNIK AUDIT BERBANTUAN KOMPUTER - TINGKAT DASAR', 45, '0000-00-00', '0000-00-00', '2013-03-04', '2013-03-08', '2013-03-04', '2013-03-08', 30, 24, 'R701 PKU', '', '2013-03-27 10:22:31', 'ITJEN', '[READY]', 1),
(742, 0, 'DIKLAT LEGAL DRAFTING (BKF)', 33, '0000-00-00', '0000-00-00', '2013-03-05', '2013-03-07', '2013-03-05', '2013-03-07', 18, 27, 'Hotel/Eksternal', '', '2013-03-27 10:23:10', 'BKF', '[READY]', 1),
(743, 0, 'DIKLAT PENYUSUNAN PERJANJIAN INTERNASIONAL', 30, '0000-00-00', '0000-00-00', '2013-03-13', '2013-03-15', '2013-03-13', '2013-03-15', 30, 35, 'R603 PKU', 'sebelumnya: DIKLAT PENYUSUNAN PERJANJIAN/KONTRAK INTERNASIONAL', '2013-03-27 10:24:31', 'KEMENKEU', '[READY]', 1),
(744, 0, 'DIKLAT ISLAMIC FINANCE - TINGKAT DASAR', 32, '0000-00-00', '0000-00-00', '2013-03-13', '2013-03-15', '2013-03-13', '2013-03-15', 17, 15, 'Hotel/Eksternal', '', '2013-03-27 10:25:22', 'DJPU', '[READY]', 1),
(745, 0, 'DIKLAT ANALISIS KEUANGAN DAN BISNIS', 32, '2013-03-18', '2013-03-20', '2013-03-13', '2013-03-15', '2013-03-18', '2013-03-20', 30, 27, 'R703 PKU', 'ND-068/PP.72/2013', '2013-03-27 10:37:01', 'KEMENKEU', '[READY]', 1),
(746, 0, 'DIKLAT AUDIT TATA KELOLA TIK', 49, '0000-00-00', '0000-00-00', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 30, 20, 'R601 PKU', '', '2013-03-27 10:28:32', 'ITJEN', '[READY]', 1),
(747, 0, 'DIKLAT BUSINESS ENGLISH (ANGKT. II)', 43, '0000-00-00', '0000-00-00', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 30, 33, 'R701 PKU', '', '2013-03-27 10:29:15', 'KEMENKEU', '[READY]', 1),
(748, 0, 'DIKLAT FREE OPEN SOURCE SOFTWARE', 47, '0000-00-00', '0000-00-00', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 30, 28, 'Lab803 PKU', '', '2013-03-27 10:30:22', 'KEMENKEU', '[READY]', 1),
(749, 0, 'DIKLAT MICROSOFT EXCEL - TINGKAT LANJUTAN (ANGKT. I)', 48, '2013-05-13', '2013-05-17', '2013-03-18', '2013-03-26', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-05-13 10:14:22', 'KEMENKEU', '[READY]', 1),
(750, 0, 'DIKLAT PERSIAPAN PURNABHAKTI (ANGKT. I)', 46, '0000-00-00', '0000-00-00', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 30, 31, 'Aula PKU', '', '2013-03-27 10:31:56', 'KEMENKEU', '[READY]', 1),
(751, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT DASAR (ANGKT. I)', 63, '2013-04-01', '2013-04-10', '2013-03-18', '2013-03-27', '0000-00-00', '0000-00-00', 30, 35, 'R703 PKU', 'pengajar dari biro SDM terbatas', '2013-04-04 10:31:56', 'KEMENKEU', '[READY]', 1),
(752, 0, 'DIKLAT AUDIT TIK - TINGKAT DASAR (ANGKT. I)', 46, '0000-00-00', '0000-00-00', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 30, 19, 'R603 PKU', '', '2013-03-27 10:32:46', 'ITJEN', '[READY]', 1);
INSERT INTO `testing` (`id_training`, `id_program`, `name_training`, `hours_training`, `revision_plan_start_training`, `revision_plan_finish_training`, `plan_start_training`, `plan_finish_training`, `start_training`, `finish_training`, `plan_participant_training`, `participant_training`, `location_training`, `note_training`, `update_training`, `main_user`, `status_training`, `certificate_type`) VALUES
(753, 0, 'DIKLAT ANALISIS JABATAN (ANGKT. I)', 37, '2013-03-25', '2013-03-28', '2013-03-25', '2013-03-28', '2013-03-25', '2013-03-28', 30, 22, 'R601 PKU', '', '2013-04-04 10:23:40', 'KEMENKEU', '[READY]', 1),
(754, 0, 'DIKLAT COMPETENCY PROFILING', 46, '2013-03-25', '2013-04-01', '2013-03-25', '2013-03-28', '2013-03-25', '2013-04-01', 30, 28, 'R603 PKU', 'ND-77/PP.72/2013 - bertambah 1 hari', '2013-04-04 10:24:50', 'KEMENKEU', '[READY]', 1),
(755, 0, 'ORIENTASI DASAR-DASAR KEBIJAKAN PUBLIK', 45, '2013-04-01', '2013-04-05', '2013-03-25', '2013-03-27', '0000-00-00', '0000-00-00', 25, 0, 'Vendor', 'sebelumnya DIKLAT KEBIJAKAN PUBLIK Tk DASAR\r\nND-79/PP.72/2013 &#38; NR - 26 Feb 2013 &#38; S-197/KF/UP.6/2013 &#38; ND-91/PP.72/2013', '2013-04-05 08:34:16', 'BKF', '[READY]', 1),
(756, 0, 'DIKLAT AUDIT KINERJA (KETUA TIM)', 37, '2013-04-01', '2013-04-04', '2013-04-01', '2013-04-05', '2013-04-01', '2013-04-04', 30, 34, 'R603 PKU', 'ND-101/PP.72/2013 - berkurang 1 hari', '2013-04-04 10:31:15', 'ITJEN', '[READY]', 1),
(757, 0, 'DIKLAT GENERAL ENGLISH (ANGKT. I)', 138, '0000-00-00', '0000-00-00', '2013-04-01', '2013-04-19', '0000-00-00', '0000-00-00', 30, 30, 'R601 PKU', '', '2013-04-04 10:32:17', 'KEMENKEU', '[READY]', 1),
(758, 0, 'DIKLAT LEGAL ENGLISH (ANGKT. I)', 29, '0000-00-00', '0000-00-00', '2013-04-01', '2013-04-03', '2013-04-01', '2013-04-03', 30, 31, 'R701 PKU', '', '2013-04-04 10:25:34', 'KEMENKEU', '[READY]', 1),
(759, 0, 'DIKLAT MANAJEMEN DIKLAT', 46, '2013-04-01', '2013-04-05', '2013-04-01', '2013-04-12', '0000-00-00', '0000-00-00', 20, 0, '', 'ND-84/PP.72/2013 # perubahan kurikulum', '2013-03-27 11:27:01', 'BPPK', '[READY]', 1),
(760, 0, 'DIKLAT EKONOMETRIKA - TINGKAT DASAR', 29, '2013-04-02', '2013-04-04', '2013-04-02', '2013-04-05', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'ND-108/PP.72/2013 - berkurang 1 hari', '2013-03-27 11:41:53', 'BKF', '[READY]', 1),
(761, 0, 'DIKLAT AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS (ANGKT. I)', 45, '0000-00-00', '0000-00-00', '2013-04-08', '2013-04-12', '0000-00-00', '0000-00-00', 30, 0, 'R703 PKU', '', '2013-03-27 11:33:24', 'KEMENKEU', '[READY]', 1),
(762, 0, 'DIKLAT EVALUASI PASCA DIKLAT (ANGKT. I)', 46, '2013-04-15', '2013-04-19', '2013-04-08', '2013-04-12', '0000-00-00', '0000-00-00', 20, 0, 'R701 PKU', 'NR - 26 Maret 2013', '2013-05-16 14:51:59', 'BPPK', '[READY]', 1),
(763, 0, 'DIKLAT FINANCIAL STATISTICS', 46, '0000-00-00', '0000-00-00', '2013-04-08', '2013-04-12', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', '', '2013-04-09 15:18:35', 'ITJEN', '[READY]', 1),
(764, 0, 'DIKLAT CRITICAL THINKING FOR INTERNAL AUDITOR (ITJEN)', 29, '2013-04-29', '2013-05-01', '2013-04-09', '2013-04-11', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', 'ND-076/PP.72/2013 #ND-AKD-IKD Inspektorat Jenderal #Batal', '2013-10-07 09:48:15', 'ITJEN', '[READY]', 1),
(765, 0, 'DIKLAT BUSINESS ENGLISH (ANGKT. III)', 43, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', '', '2013-03-27 11:42:45', 'KEMENKEU', '[READY]', 1),
(766, 0, 'DIKLAT PEMROGRAMAN WEB DASAR (ANGKT. I)', 47, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', '', '2013-03-27 11:43:08', 'KEMENKEU', '[READY]', 1),
(767, 2, 'DIKLAT TATA NASKAH DINAS (ANGKT. I)', 47, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 30, 0, 'R701 PKU', '', '2013-03-27 11:43:28', 'KEMENKEU', '[READY]', 1),
(768, 0, 'DIKLAT TEKNIK CEPAT PEMBUATAN RSB DAN BAS (ANGKT. I)', 46, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 30, 0, 'Lab803 PKU', 'ND-122/PP.7.2/2013 - semula: DIKLAT TEKNIK CEPAT PEMBUATAN RISALAH SENGKETA BANDING DAN BAS (ANGKT. II)', '2013-04-25 14:50:42', 'KEMENKEU', '[READY]', 1),
(769, 0, 'DIKLAT AUDIT TIK - TINGKAT DASAR (ANGKT. II)', 46, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 28, 0, 'R703 PKU', '', '2013-03-27 11:44:28', 'ITJEN', '[READY]', 1),
(770, 0, 'DIKLAT TEORI EKONOMI MAKRO -  TINGKAT LANJUTAN', 41, '0000-00-00', '0000-00-00', '2013-04-16', '2013-04-19', '0000-00-00', '0000-00-00', 20, 0, '', '', '2012-12-17 11:36:54', 'BKF', '[READY]', 1),
(771, 0, 'DIKLAT ISLAMIC FINANCE - TINGKAT LANJUTAN', 30, '0000-00-00', '0000-00-00', '2013-04-17', '2013-04-19', '0000-00-00', '0000-00-00', 16, 0, '', '', '2013-03-19 14:09:50', 'DJPU', '[READY]', 1),
(772, 0, 'DIKLAT AKUNTANSI KEUANGAN SYARIAH (ANGKT. I)', 45, '0000-00-00', '0000-00-00', '2013-04-22', '2013-04-26', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:31:58', 'KEMENKEU', '[READY]', 1),
(773, 0, 'DIKLAT IT RISK MANAGEMENT', 39, '0000-00-00', '0000-00-00', '2013-04-22', '2013-04-25', '0000-00-00', '0000-00-00', 30, 0, '', '', '2012-12-17 11:36:18', 'KEMENKEU', '[READY]', 1),
(774, 0, 'DIKLAT TEKNIK INTELIJEN - TINGKAT DASAR (ITJEN)', 82, '0000-00-00', '0000-00-00', '2013-04-22', '2013-05-03', '0000-00-00', '0000-00-00', 30, 0, 'Pusdiklat KU 603', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(775, 0, 'DIKLAT TOEFL PBT PREPARATION (ANGKT. I)', 137, '0000-00-00', '0000-00-00', '2013-04-22', '2013-05-13', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 11:10:13', 'KEMENKEU', '[READY]', 1),
(776, 0, 'DIKLAT TRAINING NEEDS ANALYSIS (PEGAWAI BPPK)', 44, '0000-00-00', '0000-00-00', '2013-04-22', '2013-04-26', '0000-00-00', '0000-00-00', 20, 0, '', '', '2013-05-13 09:38:14', 'BPPK', '[READY]', 1),
(777, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT DASAR (ANGKT. II)', 63, '0000-00-00', '0000-00-00', '2013-04-29', '2013-05-08', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:18:17', 'KEMENKEU', '[READY]', 1),
(778, 0, 'DIKLAT MICROSOFT WORD DAN POWERPOINT - TINGKAT LANJUTAN (ANGKT. I)', 60, '2013-09-02', '2013-09-10', '2013-04-29', '2013-05-07', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-04-25 14:51:33', 'KEMENKEU', '[READY]', 1),
(779, 0, 'DIKLAT PENGELOLAAN KINERJA ORGANISASI (ANGKT. I)', 63, '2013-12-31', '2013-12-31', '2013-04-29', '2013-05-03', '0000-00-00', '0000-00-00', 30, 0, '', '# S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #DIKLAT PKO &amp; PKP DIGABUNG #BATAL', '2013-05-01 11:39:43', 'KEMENKEU', '[READY]', 1),
(780, 0, 'DIKLAT KEBIJAKAN PUBLIK: REGULATORY IMPACT ANALYSIS', 41, '2013-08-26', '2013-08-29', '2013-04-30', '2013-05-03', '0000-00-00', '0000-00-00', 20, 0, 'Vendor', 'menunggu konfirmasi dari BKF', '2013-08-15 08:41:28', 'BKF', '[READY]', 1),
(781, 0, 'DIKLAT LITIGASI (ANGKT. I)', 46, '2013-06-10', '2013-06-14', '2013-05-06', '2013-05-08', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT LITIGASI - TINGKAT LANJUTAN (ANGKT. I) # ND-162/PP.7.2/2013', '2013-04-30 18:12:25', 'KEMENKEU', '[READY]', 1),
(782, 0, 'DIKLAT PENULISAN ILMIAH POPULER (ANGKT. I)', 29, '0000-00-00', '0000-00-00', '2013-05-06', '2013-05-08', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', '', '2013-05-13 10:01:55', 'KEMENKEU', '[READY]', 1),
(783, 0, 'DIKLAT PENYIDIKAN BUKTI DIGITAL FORENSIK -  TINGKAT DASAR', 47, '2013-05-27', '2013-05-31', '2013-05-06', '2013-05-08', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'ND-168/PP.7.2/2013 # Id-SIRTII (Menara Ravindo lt 17)', '2013-05-13 10:35:05', 'KEMENKEU', '[READY]', 1),
(784, 0, 'DIKLAT AUDIT TIK - TINGKAT LANJUTAN: AUDIT DATABASE', 49, '2013-05-13', '2013-05-17', '2013-05-13', '2013-05-16', '0000-00-00', '0000-00-00', 30, 0, 'Others', '#Ruang Rapat Lt 1', '2013-05-13 10:04:34', 'ITJEN', '[READY]', 1),
(785, 0, 'DIKLAT MANAJEMEN RISIKO (ANGKT. II)', 45, '2013-04-08', '2013-04-12', '2013-05-13', '2013-05-17', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', 'ND-036/PP.72/2013 - Waktu penyelenggaraan dipercepat', '2013-05-13 10:18:59', 'KEMENKEU', '[READY]', 1),
(786, 0, 'DIKLAT MICROSOFT EXCEL - TINGKAT LANJUTAN (ANGKT. II)', 62, '2013-08-19', '2013-08-23', '2013-05-13', '2013-05-21', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-03-27 11:55:26', 'KEMENKEU', '[READY]', 1),
(787, 0, 'DIKLAT PEMROGRAMAN WEB DASAR (ANGKT. II)', 47, '0000-00-00', '0000-00-00', '2013-05-13', '2013-05-17', '0000-00-00', '0000-00-00', 30, 0, 'Lab803 PKU', '', '2013-05-13 10:20:45', 'KEMENKEU', '[READY]', 1),
(788, 0, 'TRAINING OF TRAINERS (ANGKT. I)', 47, '0000-00-00', '0000-00-00', '2013-05-13', '2013-05-17', '0000-00-00', '0000-00-00', 30, 0, 'Others', '#Purnawarman', '2013-05-13 10:22:11', 'KEMENKEU', '[READY]', 1),
(789, 0, 'DIKLAT GENERAL ENGLISH (ANGKT. II)', 138, '0000-00-00', '0000-00-00', '2013-05-13', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', '', '2013-05-13 10:22:47', 'KEMENKEU', '[READY]', 1),
(790, 0, 'DIKLAT PERENCANAAN KEUANGAN KELUARGA (ANGKT. I)', 38, '0000-00-00', '0000-00-00', '2013-05-14', '2013-05-17', '0000-00-00', '0000-00-00', 30, 0, 'Lab Purnawarman', '', '2013-05-13 10:25:49', 'KEMENKEU', '[READY]', 1),
(791, 0, 'DIKLAT ISLAMIC FINANCE - TINGKAT TINGGI', 30, '2013-06-03', '2013-06-05', '2013-05-15', '2013-05-17', '0000-00-00', '0000-00-00', 16, 0, 'Hotel/Eksternal', '#ND-179/PP.7.2/2013', '2013-05-14 14:34:24', 'DJPU', '[READY]', 1),
(792, 0, 'DIKLAT PENGELOLAAN WEBSITE DINAMIS', 73, '0000-00-00', '0000-00-00', '2013-05-20', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'Lab803 PKU', '', '2013-05-13 10:27:38', 'KEMENKEU', '[READY]', 1),
(793, 0, 'DIKLAT PENYUSUNAN SOAL (BPPK)', 35, '0000-00-00', '0000-00-00', '2013-05-20', '2013-05-23', '0000-00-00', '0000-00-00', 20, 0, 'Others', '#Ruang Rapat Lt 1', '2013-05-13 10:28:03', 'BPPK', '[READY]', 1),
(794, 0, 'DIKLAT PENGELOLAAN KINERJA PEGAWAI (ANGKT. I)', 45, '2013-12-31', '2013-12-31', '2013-05-20', '2013-05-24', '0000-00-00', '0000-00-00', 30, 0, '', 'Diundurkan pada pertengahan Semester II, menunggu PMK baru # S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #DIKLAT PKO &amp; PKP DIGABUNG #BATAL', '2013-05-01 11:40:01', 'KEMENKEU', '[READY]', 1),
(795, 0, 'DIKLAT KEBIJAKAN PUBLIK UNTUK AUDITOR ', 29, '2013-07-01', '2013-07-05', '2013-05-21', '2013-05-23', '0000-00-00', '0000-00-00', 30, 0, 'Vendor', 'sebelumnya DIKLAT AUDIT KEBIJAKAN (ITJEN) # ND-121/PP.7.2/2013 # NR 03152013 # S-372/IJ.1/UP.6/2013 #LPEM UI', '2013-06-18 16:38:43', 'ITJEN', '[READY]', 1),
(796, 0, 'DIKLAT LEGAL DRAFTING PERATURAN DI LINGKUNGAN KEMENTERIAN KEUANGAN (ANGKT. I)', 37, '0000-00-00', '0000-00-00', '2013-05-27', '2013-05-30', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', 'sebelumnya DIKLAT LEGAL DRAFTING (ANGKT. I) # ND-177/PP.7.2/2013 #Perubahan Nama Diklat', '2013-05-13 09:24:54', 'KEMENKEU', '[READY]', 1),
(797, 0, 'DIKLAT AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS (ANGKT. II)', 43, '0000-00-00', '0000-00-00', '2013-05-27', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'Others', '#Purnawarman', '2013-05-13 10:31:23', 'ITJEN', '[READY]', 1),
(798, 0, 'DIKLAT KEARSIPAN DINAMIS (ANGKT. I)', 37, '0000-00-00', '0000-00-00', '2013-05-27', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', '', '2013-05-13 10:32:23', 'KEMENKEU', '[READY]', 1),
(799, 0, 'DIKLAT MICROSOFT WORD DAN POWERPOINT - TINGKAT LANJUTAN (ANGKT. II)', 60, '2013-09-16', '2013-09-24', '2013-05-27', '2013-06-04', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-04-25 14:51:42', 'KEMENKEU', '[READY]', 1),
(800, 0, 'DIKLAT TRAINING NEEDS ANALYSIS', 36, '0000-00-00', '0000-00-00', '2013-05-27', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'R601 PKU', '', '2013-05-13 10:40:25', 'KEMENKEU', '[READY]', 1),
(801, 0, 'DIKLAT MONEY LAUNDERING DAN ASSET TRACING', 22, '0000-00-00', '0000-00-00', '2013-06-03', '2013-06-05', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', '', '2013-05-13 10:47:08', 'ITJEN', '[READY]', 1),
(802, 1, 'DIKLAT PRANATA KOMPUTER TERAMPIL', 234, '2013-06-03', '2013-07-09', '2013-06-03', '2013-07-04', '0000-00-00', '0000-00-00', 30, 0, 'Lab803 PKU', '#ND-181/PP.7.2/2013 #ND-180/PP.7.2/2013 #NR 05062013', '2013-05-14 15:06:45', 'KEMENKEU', '[READY]', 1),
(803, 0, 'DIKLAT LEGAL ENGLISH (ANGKT. II)', 29, '0000-00-00', '0000-00-00', '2013-06-03', '2013-06-05', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:20:52', 'KEMENKEU', '[READY]', 1),
(804, 0, 'DIKLAT TOEFL iBT PREPARATION (ANGKT. I)', 152, '0000-00-00', '0000-00-00', '2013-06-10', '2013-07-05', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 11:15:32', 'KEMENKEU', '[READY]', 1),
(805, 0, 'DIKLAT PENGELOLAAN WEBSITE DINAMIS (e-Learning)', 73, '2013-06-24', '2013-09-05', '2013-06-10', '2013-08-26', '0000-00-00', '0000-00-00', 30, 0, '', '#NR-05232013', '2013-06-07 14:31:42', 'KEMENKEU', '[READY]', 1),
(806, 0, 'DIKLAT AUDIT KINERJA  (ANGGOTA TIM)', 47, '0000-00-00', '0000-00-00', '2013-06-10', '2013-06-14', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(807, 0, 'DIKLAT AUDIT PELAKSANAAN PENGADAAN BARANG DAN JASA', 50, '0000-00-00', '0000-00-00', '2013-06-17', '2013-06-21', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-04-25 14:51:18', 'ITJEN', '[READY]', 1),
(808, 0, 'DIKLAT TATA KELOLA TIK', 38, '2013-06-24', '2013-06-28', '2013-06-17', '2013-06-20', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-207/PP.7.2/2013', '2013-06-10 11:22:34', 'KEMENKEU', '[READY]', 1),
(809, 2, 'DIKLAT TATA NASKAH DINAS (ANGKT. II)', 47, '0000-00-00', '0000-00-00', '2013-06-17', '2013-06-21', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:24:27', 'KEMENKEU', '[READY]', 1),
(810, 0, 'DIKLAT TOEFL PBT PREPARATION (ANGKT. II)', 138, '0000-00-00', '0000-00-00', '2013-06-17', '2013-07-05', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT GENERAL ENGLISH II (ANGKT. I)', '2013-02-25 22:35:48', 'KEMENKEU', '[READY]', 1),
(811, 0, 'DIKLAT PENULISAN LAPORAN HASIL AUDIT YANG EFEKTIF UNTUK KETUA TIM', 36, '2013-12-31', '2013-12-31', '2013-06-24', '2013-06-28', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-393/PP.7.2/2013', '2013-06-21 18:41:46', 'ITJEN', '[CANCEL]', 1),
(812, 0, 'DIKLAT DASAR-DASAR PENELITIAN (ANGK. III)', 44, '2013-10-21', '2013-10-25', '2013-06-24', '2013-06-28', '0000-00-00', '0000-00-00', 20, 0, '', '#ND-351/PP7.2/2013 #NR 10112013 #SEBELUMNYA DIKLAT METODOLOGI PENELITIAN KEDIKLATAN #ND-335/PP7.2/2013', '2013-10-07 10:04:47', 'BPPK', '[READY]', 1),
(813, 0, 'DIKLAT PERSIAPAN PURNABHAKTI (ANGKT. III)', 44, '0000-00-00', '0000-00-00', '2013-06-24', '2013-06-28', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-04-11 08:24:07', 'KEMENKEU', '[READY]', 1),
(814, 0, 'DIKLAT LEGAL DRAFTING PERATURAN PERUNDANG-UNDANGAN', 30, '2013-07-01', '2013-07-03', '2013-07-01', '2103-07-05', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', 'sebelumnya DIKLAT LEGAL DRAFTING - TINGKAT LANJUTAN # ND-177/PP.7.2/2013', '2013-06-14 11:42:43', 'KEMENKEU', '[READY]', 1),
(815, 0, 'DIKLAT PELAYANAN PRIMA (ITJEN)', 47, '0000-00-00', '0000-00-00', '2013-07-01', '2013-07-05', '0000-00-00', '0000-00-00', 25, 0, 'Pusdiklat KU Aula', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(816, 0, 'DIKLAT PENGELOLAAN KINERJA ORGANISASI (ANGKT. II)', 45, '2013-12-31', '2013-12-31', '2013-07-01', '2013-07-05', '0000-00-00', '0000-00-00', 30, 0, '', 'Diundurkan pada pertengahan Semester II, menunggu PMK baru # S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #DIKLAT PKO &amp; PKP DIGABUNG #BATAL', '2013-05-01 11:40:20', 'KEMENKEU', '[READY]', 1),
(817, 0, 'DIKLAT TEKNIK INVESTIGASI - TINGKAT LANJUTAN', 45, '0000-00-00', '0000-00-00', '2013-07-01', '2013-07-05', '0000-00-00', '0000-00-00', 20, 0, 'Pusdiklat KU 603', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(818, 0, 'DIKLAT MANAJEMEN PENYELENGGARAAN DIKLAT (ANGKT. II)', 44, '0000-00-00', '0000-00-00', '2013-07-08', '2013-07-12', '0000-00-00', '0000-00-00', 20, 0, '', '', '2013-02-01 10:05:59', 'BPPK', '[READY]', 1),
(819, 0, 'DIKLAT EVALUASI DIKLAT (ANGKT. II)', 45, '0000-00-00', '0000-00-00', '2013-07-15', '2013-07-19', '0000-00-00', '0000-00-00', 20, 0, '', 'tambah 1 jamlat', '2013-03-06 10:55:41', 'BPPK', '[READY]', 1),
(820, 0, 'DIKLAT MICROSOFT EXCEL - TINGKAT TINGGI', 48, '2013-03-18', '2013-03-22', '2013-08-19', '2013-08-27', '2013-03-18', '2013-03-22', 30, 31, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-03-27 10:38:49', 'KEMENKEU', '[READY]', 1),
(821, 0, 'DIKLAT SEKRETARIS PIMPINAN (ANGKT. II)', 40, '0000-00-00', '0000-00-00', '2013-08-19', '2013-08-23', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:15:36', 'KEMENKEU', '[READY]', 1),
(822, 0, 'DIKLAT TOEFL iBT PREPARATION (ANGKT. II)', 152, '0000-00-00', '0000-00-00', '2013-08-19', '2013-09-13', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-09-03 17:12:31', 'BPPK', '[READY]', 1),
(823, 0, 'DIKLAT SERVICE LEVEL AGREEMENT KEDIKLATAN (ANGKT. II)', 44, '2013-06-24', '2013-06-28', '2013-08-19', '2013-08-23', '0000-00-00', '0000-00-00', 20, 0, 'Others', 'sebelumnya DIKLAT TRAINING SERVICE LEVEL AGREEMENT (ANGKT. II) # ND-051/PP.7.2/2013 # ND-129/PP.7.2/2013', '2013-06-24 16:18:10', 'BPPK', '[READY]', 1),
(824, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT DASAR (ANGKT. III)', 63, '0000-00-00', '0000-00-00', '2013-08-19', '2013-08-28', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-18 11:40:53', 'KEMENKEU', '[READY]', 1),
(825, 0, 'DIKLAT MANAJEMEN INVESTASI', 8, '2013-08-28', '2013-09-05', '2013-08-19', '2013-08-21', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-253/PP.7/2013', '2013-07-19 09:20:44', 'KEMENKEU', '[READY]', 1),
(826, 0, 'DIKLAT PENGELOLAAN KINERJA ANGKT. I', 45, '2013-09-30', '2013-10-04', '2013-08-26', '2013-08-30', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT PENGELOLAAN KINERJA ORGANISASI (ANGKT. III) # S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #ND-285/PP.7.2/2013 #DIKLAT PKO &amp; PKP DIGABUNG #PARALEL 2 KELAS ', '2013-09-26 18:23:44', 'KEMENKEU', '[READY]', 1),
(827, 0, 'DIKLAT ANALISIS BEBAN KERJA (ANGKT. II)', 45, '0000-00-00', '0000-00-00', '2013-08-26', '2013-08-30', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:11:26', 'KEMENKEU', '[READY]', 1),
(828, 0, 'DIKLAT PENYUSUNAN STANDARD OPERATING PROCEDURE', 35, '0000-00-00', '0000-00-00', '2013-08-26', '2013-08-29', '0000-00-00', '0000-00-00', 30, 0, '', '', '2012-12-20 10:27:50', 'KEMENKEU', '[READY]', 1),
(829, 0, 'DIKLAT REGULASI DAN ETIKA TIK', 30, '0000-00-00', '0000-00-00', '2013-08-26', '2013-08-28', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-04-25 14:51:26', 'KEMENKEU', '[READY]', 1),
(830, 0, 'DIKLAT TEKNIK INTELIJEN - TINGKAT LANJUTAN: SURVEILANCE', 46, '0000-00-00', '0000-00-00', '2013-08-26', '2013-08-30', '0000-00-00', '0000-00-00', 20, 0, 'Others', '', '2013-08-19 14:19:36', 'ITJEN', '[READY]', 1),
(831, 0, 'DIKLAT AKUNTANSI KEUANGAN SYARIAH (ANGKT. II)', 45, '0000-00-00', '0000-00-00', '2013-09-02', '2013-09-06', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:32:05', 'KEMENKEU', '[READY]', 1),
(832, 0, 'ORIENTASI DASAR-DASAR PENELITIAN', 51, '2013-04-22', '2013-04-26', '2013-09-02', '2013-09-06', '0000-00-00', '0000-00-00', 30, 0, 'R603 PKU', 'sebelumnya: DIKLAT DASAR-DASAR PENELITIAN\r\nS-1053/KF.1/UP.6/2012 # ND-003/PP.72/2013 # ND-021/PP.72/2013 # NR - 10 Januari 2013 # S-197/KF/UP.6/2013', '2013-03-27 11:50:37', 'KEMENKEU', '[READY]', 1),
(833, 0, 'DIKLAT LEGAL DRAFTING PERATURAN DI LINGKUNGAN KEMENTERIAN KEUANGAN (ANGKT. II)', 37, '0000-00-00', '0000-00-00', '2013-09-02', '2013-09-05', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', 'sebelumnya DIKLAT LEGAL DRAFTING (ANGKT. II) # ND-177/PP.7.2/2013 # Perubahan Nama Diklat', '2013-05-13 09:25:04', 'KEMENKEU', '[READY]', 1),
(834, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT LANJUTAN (ANGKT. I)', 50, '0000-00-00', '0000-00-00', '2013-09-02', '2013-09-06', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:18:32', 'KEMENKEU', '[READY]', 1),
(835, 0, 'DIKLAT MICROSOFT WORD DAN POWERPOINT - TINGKAT TINGGI (ANGKT. I)', 60, '2013-04-29', '2013-05-07', '2013-09-02', '2013-09-10', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-04-25 14:50:59', 'KEMENKEU', '[READY]', 1),
(836, 0, 'DIKLAT MANAJEMEN RISIKO (ANGKT. III)', 46, '2013-05-13', '2013-05-17', '2013-09-09', '2013-09-13', '0000-00-00', '0000-00-00', 30, 0, '', 'Waktu penyelenggaraan dipercepat pada waktu Angk. II', '2013-02-14 12:15:30', 'KEMENKEU', '[READY]', 1),
(837, 0, 'DIKLAT PEMERIKSAAN PELANGGARAN DISIPLIN PEGAWAI (ANGKT. II)', 46, '0000-00-00', '0000-00-00', '2013-09-09', '2013-09-13', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:09:50', 'KEMENKEU', '[READY]', 1),
(838, 0, 'DIKLAT TEKNIK CEPAT PEMBUATAN RSB DAN BAS (ANGKT. II)', 46, '2013-04-22', '2013-04-26', '2013-09-09', '2013-09-13', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', 'ND-131/PP.7.2/2013 - semula: DIKLAT TEKNIK CEPAT PEMBUATAN RISALAH BANDING DAN BAS (ANGKT. II)', '2013-04-25 14:50:51', 'SETJEN', '[READY]', 1),
(839, 0, 'DIKLAT DIPLOMASI EKONOMI', 43, '0000-00-00', '0000-00-00', '2013-09-09', '2013-09-13', '0000-00-00', '0000-00-00', 30, 0, 'Others', '', '2012-12-20 10:33:10', 'KEMENKEU', '[READY]', 1),
(840, 0, 'DIKLAT AUDIT TIK - TINGKAT LANJUTAN: AUDIT SISTEM JARINGAN', 39, '0000-00-00', '0000-00-00', '2013-09-09', '2013-09-12', '0000-00-00', '0000-00-00', 30, 0, 'Pusdiklat KU 603', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(841, 0, 'DIKLAT BUSINESS ENGLISH (ANGKT. IV)', 43, '0000-00-00', '0000-00-00', '2013-09-16', '2013-09-20', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:07:21', 'KEMENKEU', '[READY]', 1),
(842, 0, 'DIKLAT DESAIN MULTIMEDIA', 83, '0000-00-00', '0000-00-00', '2013-09-16', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', '', '2012-12-20 10:34:00', 'KEMENKEU', '[READY]', 1),
(843, 0, 'DIKLAT MICROSOFT ACCESS - TINGKAT DASAR (ANGKT. II)', 44, '0000-00-00', '0000-00-00', '2013-09-16', '2013-09-20', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:15:13', 'KEMENKEU', '[READY]', 1),
(844, 0, 'DIKLAT MICROSOFT WORD DAN POWERPOINT - TINGKAT TINGGI (ANGKT. II)', 60, '2013-05-27', '2013-06-04', '2013-09-16', '2013-09-24', '0000-00-00', '0000-00-00', 30, 0, 'Lab801 PKU', 'ND-040/PP.74/2013', '2013-04-25 14:51:05', 'KEMENKEU', '[READY]', 1),
(845, 0, 'DIKLAT PEMANTAUAN PENGENDALIAN INTERNAL (ANGKT. I)', 47, '0000-00-00', '0000-00-00', '2013-09-16', '2013-09-20', '0000-00-00', '0000-00-00', 30, 0, '', '#Batal, Penghematan Anggaran #Dilebur ke AKSI UKI', '2013-08-26 16:26:09', 'KEMENKEU', '[READY]', 1),
(846, 0, 'DIKLAT PENGELOLAAN KINERJA ANGKT. II', 45, '2013-09-30', '2013-10-04', '2013-09-16', '2013-09-20', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT PENGELOLAAN KINERJA ORGANISASI (ANGKT. III) # S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #ND-285/PP.7.2/2013 #DIKLAT PKO &amp; PKP DIGABUNG #PARALEL 2 KELAS', '2013-09-26 18:23:53', 'KEMENKEU', '[READY]', 1),
(847, 0, 'DIKLAT TOEFL PBT PREPARATION (ANGKT. III)', 137, '0000-00-00', '0000-00-00', '2013-09-16', '2013-10-04', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT TOEFL PBT PREPARATION (ANGKT. II)', '2013-02-25 22:37:01', 'KEMENKEU', '[READY]', 1),
(848, 0, 'DIKLAT ANALISIS JABATAN (ANGKT. II)', 37, '0000-00-00', '0000-00-00', '2013-09-16', '2013-09-19', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:19:43', 'KEMENKEU', '[READY]', 1),
(849, 0, 'DIKLAT DESAIN PENGELOLAAN DATABASE (ANGKT. II)', 45, '0000-00-00', '0000-00-00', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:09:19', 'KEMENKEU', '[READY]', 1),
(850, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT LANJUTAN (ANGKT. II)', 50, '0000-00-00', '0000-00-00', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:18:40', 'KEMENKEU', '[READY]', 1),
(851, 0, 'DIKLAT TEKNIK AUDIT BERBANTUAN KOMPUTER - TINGKAT LANJUTAN', 45, '2013-11-30', '2013-11-30', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 15, 0, '', '#ND-335/PP7.2/2013 #S-651/IJ.1/UP.6/2013 #S-735/IJ.1/2013 #ND- 393/PP.7.2/2013', '2013-10-07 09:50:36', 'ITJEN', '[CANCEL]', 1),
(852, 0, 'DIKLAT BUSINESS ENGLISH (ANGKT. V)', 43, '0000-00-00', '0000-00-00', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-09-12 19:09:12', 'KEMENKEU', '[READY]', 1),
(853, 0, 'DIKLAT KEARSIPAN DINAMIS (ANGKT. II)', 37, '0000-00-00', '0000-00-00', '2013-09-30', '2013-10-04', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 11:15:16', 'KEMENKEU', '[READY]', 1),
(854, 0, 'DIKLAT PEMBENTUKAN AUDITOR AHLI', 201, '2013-05-27', '2013-06-20', '2013-09-30', '2013-10-21', '0000-00-00', '0000-00-00', 15, 0, 'Hotel/Eksternal', 'sebelumnya DIKLAT PEMBENTUKAN AUDITOR TERAMPIL\r\nS-251/IJ.1/2013 # S-290/PP.7/2013 #ND-183/PP7.2./2013', '2013-05-27 12:58:21', 'KEMENKEU', '[READY]', 1),
(855, 0, 'DIKLAT PENYUSUNAN MODUL ', 35, '0000-00-00', '0000-00-00', '2013-09-30', '2013-10-03', '0000-00-00', '0000-00-00', 25, 0, '', '', '2012-12-20 10:19:08', 'KEMENKEU', '[READY]', 1),
(856, 2, 'DIKLAT TATA NASKAH DINAS (ANGKT. IV)', 47, '0000-00-00', '0000-00-00', '2013-09-30', '2013-10-04', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-09-06 16:21:50', 'KEMENKEU', '[READY]', 1),
(857, 0, 'DIKLAT LEGAL ENGLISH (ANGKT. III)', 29, '0000-00-00', '0000-00-00', '2013-10-07', '2013-10-09', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:20:59', 'KEMENKEU', '[READY]', 1),
(858, 0, 'DIKLAT PENGELOLAAN KINERJA', 45, '0000-00-00', '0000-00-00', '2013-10-07', '2013-10-11', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT PENGELOLAAN KINERJA PEGAWAI (ANGKT. III) # S-261/PP.7/2013 # S-1041/SJ.5/2013 # S-333/PP.7/2013 #DIKLAT PKO &amp; PKP DIGABUNG #BATAL', '2013-07-17 10:13:03', 'KEMENKEU', '[READY]', 1),
(859, 0, 'DIKLAT TOEFL PBT PREPARATION (ANGKT. IV)', 137, '2013-10-07', '2013-10-29', '2013-10-07', '2013-10-28', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT TOEFL PBT PREPARATION (ANGKT. III)', '2013-03-01 12:06:41', 'KEMENKEU', '[READY]', 1),
(860, 0, 'DIKLAT PSIKOLOGI AUDIT INVESTIGATIF', 47, '0000-00-00', '0000-00-00', '2013-10-07', '2013-10-11', '0000-00-00', '0000-00-00', 30, 0, 'R601 PKU', 'Sebelumnya DIKLAT PSIKOLOGI AUDIT #ND 292', '2013-09-10 17:13:57', 'ITJEN', '[READY]', 1),
(861, 0, 'DIKLAT MANAJEMEN SDM - TINGKAT TINGGI', 21, '2013-12-03', '2013-12-04', '2013-10-07', '2013-10-08', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-335/PP7.2/2013 #ND-   /PP.7.2/2013', '2013-10-07 11:55:07', 'KEMENKEU', '[READY]', 1),
(862, 0, 'DIKLAT EKONOMETRIKA - TINGKAT LANJUTAN ', 31, '2013-10-16', '2013-10-18', '2013-10-07', '2013-10-09', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-335/PP7.2/2013', '2013-10-07 10:10:41', 'BKF', '[READY]', 1),
(863, 0, 'DIKLAT LITIGASI (ANGKT. II)', 46, '2013-09-30', '2013-10-04', '2013-10-16', '2013-10-18', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT LITIGASI - TINGKAT LANJUTAN (ANGKT. II) # ND-162/PP.7.2/2013', '2013-04-30 18:13:29', 'KEMENKEU', '[READY]', 1),
(864, 0, 'DIKLAT PENULISAN ILMIAH POPULER (ANGKT. II)', 30, '2013-10-28', '2013-10-30', '2013-10-16', '2013-10-18', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-335/PP7.2/2013	#ND-333/PP.7/2013	#ND-330/PP.7/2013	#NR-Jamlator', '2013-10-07 10:17:02', 'KEMENKEU', '[READY]', 1),
(865, 0, 'DIKLAT FORENSIK AUDIT', 85, '2013-10-21', '2013-10-31', '2013-10-17', '2013-10-31', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-351/PP.7.2/2013 #ND-291/PP.7.2/2013', '2013-09-10 17:14:48', 'ITJEN', '[READY]', 1),
(866, 0, 'DIKLAT PEMANTAUAN PENGENDALIAN INTERNAL (ANGKT. II)', 47, '0000-00-00', '0000-00-00', '2013-10-21', '2013-10-25', '0000-00-00', '0000-00-00', 30, 0, '', '#Batal, Penghematan Anggaran #Dilebur ke AKSI UKI', '2013-06-10 11:58:42', 'KEMENKEU', '[READY]', 1),
(867, 0, 'DIKLAT PEMROGRAMAN WEB DENGAN ASP.NET', 41, '2013-10-28', '2013-11-01', '2013-10-21', '2013-10-25', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-335/PP7.2/2013', '2013-10-07 10:13:17', 'KEMENKEU', '[READY]', 1),
(868, 0, 'DIKLAT PENULISAN BUKU TEKS', 39, '0000-00-00', '0000-00-00', '2013-10-21', '2013-10-24', '0000-00-00', '0000-00-00', 30, 0, '', '', '2012-12-20 10:11:47', 'KEMENKEU', '[READY]', 1),
(869, 0, 'DIKLAT PERSIAPAN PURNABHAKTI (ANGKT. IV)', 44, '0000-00-00', '0000-00-00', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-04-11 08:24:15', 'KEMENKEU', '[READY]', 1),
(870, 0, 'DIKLAT KNOWLEDGE MANAJEMEN', 30, '0000-00-00', '0000-00-00', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 20, 0, '', '#ND-255/PP7.2/2013 #ND-335/PP7.2/2013', '2013-10-07 10:15:02', 'KEMENKEU', '[READY]', 1),
(871, 0, 'DIKLAT PERENCANAAN KEUANGAN KELUARGA (ANGKT. II)', 38, '2013-11-18', '2013-11-22', '2013-10-28', '2013-10-31', '0000-00-00', '0000-00-00', 30, 0, '', '#Batal, Penghematan Anggaran #ND-335/PP7.2/2013	', '2013-10-07 10:21:54', 'KEMENKEU', '[READY]', 1),
(872, 0, 'DIKLAT TOEFL PBT PREPARATION ANGK. V', 138, '0000-00-00', '0000-00-00', '2013-10-28', '2013-11-18', '0000-00-00', '0000-00-00', 30, 0, '', 'sebelumnya DIKLAT GENERAL ENGLISH II (ANGKT. II) #ND-335/PP7.2/2013', '2013-10-07 10:15:51', 'KEMENKEU', '[READY]', 1),
(873, 0, 'DIKLAT FINANCIAL RISK MANAGER PREPARATION PROGRAM', 30, '0000-00-00', '0000-00-00', '2013-12-31', '2013-12-31', '0000-00-00', '0000-00-00', 5, 0, '', '', '2012-12-20 10:09:30', 'DJPU', '[READY]', 1),
(874, 0, 'DIKLAT AKUNTANSI BERBASIS PSAK KONVERGENSI IFRS (ANGKT. III)', 43, '0000-00-00', '0000-00-00', '2013-11-11', '2013-11-15', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 10:21:31', 'KEMENKEU', '[READY]', 1),
(875, 0, 'DIKLAT SISTEM PENDUKUNG KEPUTUSAN', 35, '0000-00-00', '0000-00-00', '2013-11-11', '2013-11-14', '0000-00-00', '0000-00-00', 30, 0, '', '#Batal, Penghematan Anggaran ', '2013-06-10 11:59:22', 'KEMENKEU', '[READY]', 1),
(876, 0, 'TRAINING OF TRAINERS (ANGKT. II)', 47, '0000-00-00', '0000-00-00', '2013-11-11', '2013-11-15', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-02-01 11:13:10', 'KEMENKEU', '[READY]', 1),
(877, 0, 'DIKLAT KEBIJAKAN PUBLIK: COST BENEFIT ANALYSIS', 41, '2013-05-06', '2013-05-10', '2013-11-12', '2013-11-15', '0000-00-00', '0000-00-00', 20, 0, 'Vendor', 'ND-79/PP.72/2013 # S-367/KF.1/UP.6/2013 # di LPEM FE-UI', '2013-04-24 18:32:35', 'BKF', '[READY]', 1),
(879, 0, 'ORIENTASI KETERAMPILAN DASAR (MS. EXCEL, MS. POWERPOINT, TATA NASKAH DINAS)', 48, '0000-00-00', '0000-00-00', '2013-04-15', '2013-04-19', '0000-00-00', '0000-00-00', 20, 0, 'R701 PKU', 'Diklat Baru\r\nS-1053/KF.1/UP.6/2012 # ND-003/PP.72/2013 # ND-021/PP.72/2013 # NR - 10 Januari 2013 # S-197/KF/UP.6/2013', '2013-04-03 16:19:34', 'BKF', '[READY]', 1),
(880, 0, 'DIKLAT KEWAJIBAN KONTINJENSI', 27, '0000-00-00', '0000-00-00', '2013-12-31', '2013-12-31', '0000-00-00', '0000-00-00', 15, 0, '', '', '2013-03-27 09:25:33', 'DJPU', '[READY]', 1),
(882, 0, 'DIKLAT STUDI KELAYAKAN FINANCIAL PROYEK', 27, '0000-00-00', '0000-00-00', '2013-12-31', '2013-12-31', '0000-00-00', '0000-00-00', 10, 0, '', '', '2012-12-20 10:09:06', 'KEMENKEU', '[READY]', 1),
(883, 0, 'SEMINAR HEALTH INSURANCE SYSTEM', 4, '2012-12-04', '2012-12-04', '2012-12-04', '2012-12-04', '0000-00-00', '0000-00-00', 30, 0, 'Others', '[...Video Conference...]', '2012-12-05 09:39:21', 'KEMENKEU', '[READY]', 1),
(884, 0, 'DIKLAT VALIDASI DATA DEBT MANAGEMENT AND FINANCIAL ANALYSIS SYSTEM (DMFAS)', 34, '2013-01-21', '2013-01-30', '2013-01-21', '2013-01-30', '2013-01-21', '2013-01-30', 40, 38, 'Others', 'Diklat Baru', '2013-03-27 09:53:33', 'DJPU', '[READY]', 1),
(885, 0, 'DIKLAT CALON ATASE KEUANGAN', 24, '2013-02-04', '2013-02-28', '2013-02-04', '2013-02-28', '0000-00-00', '0000-00-00', 2, 0, 'Others', 'Diklat Baru', '2013-03-27 10:03:12', 'DJBC', '[READY]', 1),
(886, 0, 'DIKLAT PENELITI TINGKAT PERTAMA (ANGK. I)', 203, '2013-03-14', '2013-04-03', '2013-03-14', '2013-04-03', '2013-03-14', '2013-04-03', 12, 11, 'Vendor', '', '2013-03-27 12:08:01', 'BKF', '[READY]', 1),
(893, 0, 'DIKLAT PENELITI TINGKAT PERTAMA (ANGK. II)', 203, '2013-06-13', '2013-07-03', '2013-06-13', '2013-07-03', '0000-00-00', '0000-00-00', 4, 0, 'Vendor', '#S-100/KF.1/UP.6/2013 #S-532/KF.1/UP.6/2013', '2013-06-10 15:06:46', 'BKF', '[READY]', 1),
(899, 0, 'DIKLAT PENELITI TINGKAT LANJUTAN ', 0, '2013-06-23', '2013-06-28', '2013-03-31', '2013-04-05', '0000-00-00', '0000-00-00', 4, 0, 'Vendor', 'S-100/KF.1/UP.6/2013 #S-532/KF.1/UP.6/2013', '2013-06-07 14:29:31', 'BKF', '[READY]', 1),
(902, 0, 'DIKLAT PELAYANAN PRIMA', 40, '2013-02-25', '2013-02-28', '2013-02-25', '2013-02-28', '2013-02-25', '2013-02-28', 27, 22, 'Aula PKU', 'Diklat baru, permintaan dari DJPB', '2013-03-27 10:17:17', 'DJPbN', '[READY]', 1),
(903, 0, 'DIKLAT AKSI UKI (KELAS TOT)', 53, '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', '2013-03-18', '2013-03-22', 40, 39, 'Hotel/Eksternal', 'diklat baru - dana ITJEN', '2013-03-27 11:09:49', 'KEMENKEU', '[READY]', 1),
(904, 0, 'DIKLAT KEBIJAKAN PUBLIK TK DASAR', 38, '2013-03-25', '2013-03-28', '2013-03-25', '2013-03-28', '0000-00-00', '0000-00-00', 35, 0, 'Vendor', 'diklat baru # hasil IKD Pusdiklat KNPK # di LPEM FE-UI # ND-119/PP6/2013 # ND-79/PP72/2013', '2013-04-04 10:28:55', 'DJPK', '[READY]', 1),
(905, 0, 'DIKLAT POLICIES AND PRACTICES FOR NATURAL RESOURCE MANAGEMENT (BLENDED LEARNING PROGRAM)', 149, '2013-03-14', '2013-05-31', '2013-03-14', '2013-05-31', '0000-00-00', '0000-00-00', 15, 0, 'Lab Purnawarman', '', '2013-03-27 10:49:46', 'ITJEN', '[READY]', 1),
(907, 0, 'WORKSHOP AKSI UKI (ANGK. VII)', 14, '2013-04-10', '2013-04-11', '2013-04-10', '2013-04-11', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'diklat baru - dana ITJEN # S-55/PP.7/2013 # S-12/IJ.8/2013', '2013-05-01 08:31:00', 'ITJEN', '[READY]', 1),
(908, 0, 'WORKSHOP AKSI UKI (ANGK. VIII)', 14, '2013-04-10', '2013-04-11', '2013-04-10', '2013-04-11', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'diklat baru - dana ITJEN # S-55/PP.7/2013 # S-12/IJ.8/2013', '2013-05-01 08:31:07', 'ITJEN', '[READY]', 1),
(909, 0, 'WORKSHOP AKSI UKI (ANGK. IX)', 14, '2013-04-10', '2013-04-11', '2013-04-10', '2013-04-11', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'diklat baru - dana ITJEN # S-55/PP.7/2013 # S-12/IJ.8/2013', '2013-05-01 08:30:52', 'ITJEN', '[READY]', 1),
(910, 0, 'WORKSHOP AKSI UKI (ANGK. XVIII)', 14, '2013-05-01', '2013-05-02', '2013-05-01', '2013-05-02', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'diklat baru - dana ITJEN # S-55/PP.7/2013 # S-12/IJ.8/2013', '2013-05-01 08:31:14', 'ITJEN', '[READY]', 1),
(911, 0, 'DIKLAT AKSI UKI (ANGK. III)', 45, '2013-05-27', '2013-05-31', '2013-05-27', '2013-05-31', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'diklat baru - dana ITJEN #Purnawarman', '2013-05-13 10:44:18', 'ITJEN', '[READY]', 1),
(921, 0, 'DIKLAT AKSI UKI (ANGK. VIII)', 45, '2013-06-24', '2013-06-28', '2013-06-24', '2013-06-28', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'diklat baru - dana ITJEN', '2013-03-27 11:10:20', 'ITJEN', '[READY]', 1),
(922, 0, 'DIKLAT AKSI UKI (ANGK. XIV)', 45, '2013-07-15', '2013-07-19', '2013-07-15', '2013-07-19', '0000-00-00', '0000-00-00', 30, 0, '', 'diklat baru - dana ITJEN', '2013-03-27 11:10:25', 'ITJEN', '[READY]', 1),
(923, 0, 'DIKLAT AKSI UKI (ANGK. XVII)', 45, '2013-08-19', '2013-08-23', '2013-08-19', '2013-08-23', '0000-00-00', '0000-00-00', 30, 0, '', 'diklat baru - dana ITJEN', '2013-03-27 11:10:29', 'ITJEN', '[READY]', 1),
(924, 0, 'DIKLAT AKSI UKI (ANGK. XX)', 45, '2013-09-02', '2013-09-06', '2013-09-02', '2013-09-06', '0000-00-00', '0000-00-00', 30, 0, '', 'diklat baru - dana ITJEN', '2013-03-27 11:10:33', 'ITJEN', '[READY]', 1),
(925, 0, 'DIKLAT AKSI UKI (ANGK. XXIV)', 45, '2013-09-23', '2013-09-27', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', 'diklat baru - dana ITJEN', '2013-03-27 11:10:38', 'ITJEN', '[READY]', 1),
(926, 0, 'DIKLAT AKSI UKI (ANGK. XXV)', 45, '2013-09-23', '2013-09-27', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 30, 0, '', 'diklat baru - dana ITJEN', '2013-03-27 11:10:42', 'ITJEN', '[READY]', 1),
(927, 0, 'DIKLAT AKSI UKI (ANGK. XXX)', 45, '2013-10-21', '2013-10-25', '2013-10-21', '2013-10-25', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'diklat baru - dana ITJEN', '2013-03-27 11:10:46', 'ITJEN', '[READY]', 1),
(928, 0, 'DIKLAT AKSI UKI (ANGK. XXXI)', 45, '2013-10-21', '2013-10-25', '2013-10-21', '2013-10-25', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'diklat baru - dana ITJEN', '2013-03-27 11:10:52', 'ITJEN', '[READY]', 1),
(929, 0, 'DIKLAT AKSI UKI (ANGK. XLI)', 45, '2013-11-18', '2013-11-22', '2013-11-18', '2013-11-22', '0000-00-00', '0000-00-00', 30, 0, 'Others', 'diklat baru - dana ITJEN', '2013-03-27 11:10:56', 'ITJEN', '[READY]', 1),
(930, 0, 'DIKLAT DASAR-DASAR PENELITIAN (ANGK. II)', 51, '2013-09-02', '2013-09-06', '2013-09-02', '2013-09-06', '0000-00-00', '0000-00-00', 30, 0, '', '', '2013-04-03 16:20:56', 'ITJEN', '[READY]', 1),
(931, 0, 'DIKLAT PERSIAPAN PURNABHAKTI (ANGKT. II)', 44, '2013-04-29', '2013-05-03', '2013-04-29', '2013-05-03', '0000-00-00', '0000-00-00', 30, 0, 'Aula PKU', '', '2013-04-11 08:24:31', 'ITJEN', '[READY]', 1),
(932, 0, 'DIKLAT LEGAL DRAFTING (DJA)', 0, '2013-05-06', '2013-05-08', '2013-05-14', '2013-05-16', '0000-00-00', '0000-00-00', 0, 0, 'Hotel/Eksternal', 'Diklat Baru - Anggaran DJA # S-99/AG.1/2013', '2013-04-24 18:33:27', 'ITJEN', '[READY]', 1),
(933, 0, 'DIKLAT PERENCANAAN SDM', 30, '2013-06-03', '2013-06-05', '2013-06-03', '2013-06-05', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'Diklat Baru #S-92/PP.1/2013 # ND-164/PP.7.2/2013 # ND-70/PP.7/2013 #Fullboard', '2013-05-14 15:07:19', 'ITJEN', '[READY]', 1),
(934, 0, 'DIKLAT PENGELOLAAN MEDIA INTERNAL', 41, '2013-07-22', '2013-07-26', '2013-07-22', '2013-07-25', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'Diklat Baru # S-92/PP.1/2013 # ND-164/PP.7.2/2013 # ND-70/PP.7/2013 #Fullboard', '2013-07-10 10:40:22', 'ITJEN', '[READY]', 1),
(935, 0, 'WORKSHOP AKSI UKI (ANGK. XVIII A)', 14, '2013-05-01', '2013-05-02', '2013-05-01', '2013-05-02', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', 'diklat baru - dana ITJEN # S-55/PP.7/2013 # S-12/IJ.8/2013', '2013-05-01 08:32:17', 'ITJEN', '[READY]', 1),
(936, 0, 'DIKLAT EVALUASI PASCA DIKLAT (ANGKT. II)', 46, '0000-00-00', '0000-00-00', '2013-07-01', '2013-07-05', '0000-00-00', '0000-00-00', 30, 0, '', 'NR-EVALUASI PASCA DIKLAT #ND-64/PP.7/2013', '2013-06-04 08:07:36', 'ITJEN', '[READY]', 1),
(937, 0, 'DIKLAT DASAR-DASAR PENELITIAN', 48, '2013-06-24', '2013-06-28', '2013-06-10', '2013-06-21', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', '#PERMINTAAN DJPbN #MUNDUR BERKAT HOTEL', '2013-06-10 15:16:51', 'ITJEN', '[READY]', 1),
(938, 0, 'DIKLAT FINANCIAL STATISTIC', 46, '2013-06-29', '2013-07-04', '2013-06-15', '2013-06-20', '0000-00-00', '0000-00-00', 30, 0, 'Hotel/Eksternal', '#PERMINTAAN DJPbN #MUNDUR BERKAT HOTEL\r\n', '2013-06-10 15:17:34', 'ITJEN', '[READY]', 1),
(939, 0, 'PELATIHAN MICROFINANCE TRAINING OF TRAINERS', 380, '2013-07-11', '2013-11-18', '2013-07-11', '2013-11-18', '0000-00-00', '0000-00-00', 10, 0, 'Others', '#GDLN #Diklat Baru #ND-155/PP.1/2013 #ND-100/PP.7/2013', '2013-07-19 08:39:34', 'ITJEN', '[READY]', 1),
(940, 0, 'DIKLAT AKSI UKI (ANGK. XLII)', 45, '2013-11-18', '2013-11-22', '2013-11-18', '2013-11-22', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:24:36', 'ITJEN', '[READY]', 1),
(941, 0, 'DIKLAT AKSI UKI (ANGK. XXXVII)', 45, '2013-11-11', '2013-11-15', '2013-11-11', '2013-11-15', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:22:51', 'ITJEN', '[READY]', 1),
(942, 0, 'DIKLAT AKSI UKI (ANGK. XXXVI)', 45, '2013-11-11', '2013-11-15', '2013-11-11', '2013-11-15', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:23:04', 'ITJEN', '[READY]', 1),
(943, 0, 'DIKLAT AKSI UKI (ANGK. XXXIII)', 45, '2013-10-28', '2013-11-01', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:23:29', 'ITJEN', '[READY]', 1),
(944, 0, 'DIKLAT AKSI UKI (ANGK. XXVIII)', 45, '2013-09-30', '2013-10-04', '2013-09-30', '2013-10-04', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:23:51', 'ITJEN', '[READY]', 1),
(945, 0, 'DIKLAT AKSI UKI (ANGK. XXVI)', 45, '2013-09-23', '2013-09-27', '2013-09-23', '2013-09-27', '0000-00-00', '0000-00-00', 25, 0, 'Lab Purnawarman', '#S-709/PP.7/2013 #S-714/PP.7/2013 #ND-294/PP.7.2/2013', '2013-09-03 15:24:23', 'ITJEN', '[READY]', 1),
(946, 0, 'DIKLAT PEMROGRAMAN WEB DASAR (ANGKT. III)', 47, '2013-09-09', '2013-09-20', '2013-09-09', '2013-09-20', '0000-00-00', '0000-00-00', 20, 0, 'Others', '#ND-295/PP7.2/2013 #S-1653/BC.1/UP.6/2013 #KPU BC', '2013-10-07 10:28:32', 'DJBC', '[READY]', 1),
(947, 2, 'DIKLAT TATA NASKAH DINAS (ANGKT. III) ', 45, '2013-09-09', '2013-09-20', '2013-09-09', '2013-09-20', '0000-00-00', '0000-00-00', 16, 0, 'Others', '#ND-295/PP7.2/2013 #S-1653/BC.1/UP.6/2013 #S-737/PP.7/2013	#S-236/KPU.01/BG.01/2013 #KPUBC', '2013-10-07 10:45:17', 'DJBC', '[READY]', 1),
(948, 0, 'DIKLAT TEORI EKONOMI MAKRO - TINGKAT DASAR', 51, '2013-10-28', '2013-11-01', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 35, 0, 'Hotel/Eksternal', '#S-6411/PB.1/2013 #S-919/PP.7/2013 #ND-335/PP7.2/2013', '2013-10-18 10:27:07', 'DJPbN', '[READY]', 1),
(949, 0, 'DIKLAT LEGAL DRAFTING PERATURAN DI LINGKUNGAN KEMENTERIAN KEUANGAN (ANGK. III)', 37, '2013-11-11', '2013-11-14', '2013-11-11', '2013-11-14', '0000-00-00', '0000-00-00', 30, 0, 'R601 PKU', '#Peserta Khusus DJPbN #S-6411/PB.1/2013 #S-919/PP.7/2013 #ND-335/PP7.2/2013', '2013-10-18 10:27:47', 'DJPbN', '[READY]', 1),
(950, 0, 'DIKLAT PERSIAPAN PURNABHAKTI ANGK. V', 44, '2013-11-11', '2013-11-15', '2013-11-11', '2013-11-15', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-335/PP7.2/2013	', '2013-10-07 10:19:02', 'ITJEN', '[READY]', 1),
(951, 0, 'DIKLAT MICROSOFT ACCESS - TINGKAT DASAR (ANGKT. III)', 44, '2013-10-21', '2013-11-01', '2013-10-21', '2013-11-01', '0000-00-00', '0000-00-00', 30, 0, 'Others', '#S-819/PP.7/2013	#ND-295/PP.7.2/2013	#S-1653/BC.1/UP.6/2013	#S-737/PP.7/2013	#S-236/KPU.01/BG.01/2013 #KPU BC', '2013-10-07 10:32:57', 'DJBC', '[READY]', 1),
(952, 0, 'DIKLAT MICROSOFT WORD, POWERPOINT DAN EXCEL TK LANJUTAN', 63, '2013-11-04', '2013-11-22', '2013-11-04', '2013-11-22', '0000-00-00', '0000-00-00', 30, 0, '', '#S-819/PP.7/2013	#ND-295/PP.7.2/2013	#S-1653/BC.1/UP.6/2013	#S-737/PP.7/2013	#S-236/KPU.01/BG.01/2013', '2013-10-07 10:47:50', 'DJBC', '[READY]', 1),
(953, 0, 'DIKLAT KEARSIPAN DINAMIS (ANGKT. III)', 37, '2013-11-25', '2013-11-29', '2013-11-25', '2013-11-29', '0000-00-00', '0000-00-00', 20, 0, 'R601 PKU', '#S-819/PP.7/2013	#ND-295/PP.7.2/2013	#S-1653/BC.1/UP.6/2013	#S-737/PP.7/2013	#S-236/KPU.01/BG.01/2013', '2013-10-07 10:50:30', 'ITJEN', '[READY]', 1),
(954, 0, 'DIKLAT MANAJEMEN RISIKO (ANGKT. IV)', 46, '2013-11-18', '2013-11-22', '2013-11-18', '2013-11-22', '0000-00-00', '0000-00-00', 30, 0, 'Others', '# ND-351/PP.7.2/2013 #ND-295/PP.7.2/2013 #S-1653/BC.1/UP.6/2013', '2013-10-07 11:26:49', 'DJBC', '[READY]', 1),
(955, 0, 'DIKLAT TEKNIK INTELIJEN - TINGKAT DASAR (ANGKT. II)', 83, '2013-10-21', '2013-11-01', '2013-10-21', '2013-11-04', '0000-00-00', '0000-00-00', 25, 0, '', '#ND-353/PP.7.2/2013 #ND-295/PP.7.2/2013 #S-1653/BC.1/UP.6/2013 # BARU #PESERTA DJBC', '2013-10-07 11:30:14', 'DJBC', '[READY]', 1),
(956, 0, 'DIKLAT MANAJEMEN RISIKO KELAS MANAJERIAL', 31, '2013-12-03', '2013-12-05', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 28, 0, '', '# ND-351/PP.7.2/2013 #ND-295/PP.7.2/2013 #S-1653/BC.1/UP.6/2013 #ND   /PP.7.2/2013', '2013-10-07 11:39:54', 'DJBC', '[READY]', 1),
(957, 0, 'HAPUS', 0, '2013-10-28', '2013-11-01', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 0, 0, 'Others', '', '2013-10-11 10:34:45', 'ITJEN', '[CANCEL]', 1),
(958, 0, 'WORKSHOP AKSI UKI KELAS KHUSUS PEIKR', 14, '2013-10-17', '2013-10-18', '2013-10-17', '2013-10-18', '0000-00-00', '0000-00-00', 30, 0, 'Others', '#S-100/IJ.8/2013 #ND-344/PP.7.2/2013', '2013-10-11 14:15:15', 'ITJEN', '[READY]', 1),
(959, 0, 'ORIENTASI KETERAMPILAN DASAR (MS. EXCEL, MS. POWERPOINT, TATA NASKAH DINAS) (ANGK. II)', 48, '0000-00-00', '0000-00-00', '2013-11-25', '2013-11-29', '0000-00-00', '0000-00-00', 30, 0, '', '#PEGAWAI BKF #S-906/KF.1/UP.6/2013 #S-917/PP.7/2013', '0000-00-00 00:00:00', '', '[READY]', 1),
(960, 0, 'DIKLAT DEBT MANAGEMENT AND FINANCIAL ANALYSIS SYSTEM (DMFAS)', 30, '0000-00-00', '0000-00-00', '2013-10-28', '2013-11-01', '0000-00-00', '0000-00-00', 20, 0, '', '#ND-351/PP.7.2/2013 #S-916/PP.7/2013 #S-590/PU.1/2013', '0000-00-00 00:00:00', '', '[READY]', 1),
(961, 0, 'Diklat Penilaian Angka Kredit untuk Jenjang Fungsional Auditor', 46, '2013-12-03', '2013-12-06', '2013-12-02', '2013-12-05', '0000-00-00', '0000-00-00', 30, 0, '', '#S-735/IJ.1/2013 #NR11202013', '0000-00-00 00:00:00', '', '[READY]', 1),
(962, 0, 'DIKLAT PELAYANAN PRIMA ANGKT. III (DJBC GOL III)', 40, '0000-00-00', '0000-00-00', '2013-12-16', '2013-12-18', '0000-00-00', '0000-00-00', 25, 0, '', '#FULLBOARD HOTEL', '0000-00-00 00:00:00', '', '[READY]', 1),
(963, 0, 'DIKLAT PELAYANAN PRIMA ANGKT. IV  (BPPK)', 40, '0000-00-00', '0000-00-00', '2013-12-17', '2013-12-19', '0000-00-00', '0000-00-00', 25, 0, '', '#FULLBOARD HOTEL', '0000-00-00 00:00:00', '', '[READY]', 1),
(964, 0, 'DIKLAT PELAYANAN PRIMA ANGKT. V (DJBC GOL II)', 40, '0000-00-00', '0000-00-00', '2013-12-19', '2013-12-21', '0000-00-00', '0000-00-00', 25, 0, '', '#FULLBOARD HOTEL', '0000-00-00 00:00:00', '', '[READY]', 1),
(965, 0, 'WORKSHOP ENGLISH COMMUNICATION SKILL', 16, '0000-00-00', '0000-00-00', '2013-12-23', '2013-12-24', '0000-00-00', '0000-00-00', 15, 0, '', '#FULLBOARD', '0000-00-00 00:00:00', '', '[READY]', 1),
(966, 0, 'Diklat Anti Money Laundering dan Asset Tracing Tingkat Dasar', 30, '0000-00-00', '0000-00-00', '2014-01-15', '2014-01-17', '2010-01-18', '2010-01-22', 37, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(967, 0, 'Diklat Penyusunan Perjanjian Internasional', 30, '0000-00-00', '0000-00-00', '2014-01-15', '2014-01-17', '2010-01-25', '2010-01-29', 35, 0, '', '', '0000-00-00 00:00:00', 'DJPU + SETJEN', '[READY]', 1),
(968, 0, 'Diklat Manajemen Diklat', 46, '0000-00-00', '0000-00-00', '2014-01-20', '2014-01-24', '2010-02-03', '2010-02-16', 21, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(969, 0, 'Diklat Evaluasi Akuntabilitas Instansi Pemerintah (AKIP)', 47, '0000-00-00', '0000-00-00', '2014-01-20', '2014-01-24', '2010-02-08', '2010-02-12', 35, 0, '', '', '0000-00-00 00:00:00', 'ITJEN + SETJEN', '[READY]', 1),
(970, 0, 'Diklat/ Orientasi Keterampilan Dasar', 48, '2014-02-03', '2014-02-07', '2014-01-20', '2014-01-24', '2010-02-16', '2010-02-22', 30, 0, '', '#S-47/KF.1/UP.6/2014', '0000-00-00 00:00:00', 'BKF', '[READY]', 1),
(971, 0, 'Training Of Trainers AKSI UKI', 48, '0000-00-00', '0000-00-00', '2014-01-20', '2014-01-24', '2010-02-22', '2010-02-25', 30, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(972, 2, 'Diklat Tata Naskah Dinas Angkt. I (Set PP)', 45, '0000-00-00', '0000-00-00', '2014-01-20', '2014-01-24', '2010-02-24', '2010-03-08', 35, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[READY]', 2),
(973, 0, 'Diklat Panitera Pengadilan Pajak', 34, '2014-03-18', '2014-03-21', '2014-01-27', '2014-01-30', '2010-02-25', '2010-02-25', 30, 0, '', 'usulan pengajar 17-20 Feb 2014', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(974, 0, 'Diklat Audit Sampling', 36, '0000-00-00', '0000-00-00', '2014-01-27', '2014-01-30', '2010-03-02', '2010-04-01', 18, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(975, 0, 'Diklat Perencanaan Keuangan Keluarga', 38, '0000-00-00', '0000-00-00', '2014-01-27', '2014-01-30', '2010-03-08', '2010-03-12', 35, 0, '', '', '0000-00-00 00:00:00', 'SETJEN + DJPB', '[READY]', 1),
(976, 0, 'Diklat Pelayanan Prima', 40, '2014-12-31', '2014-12-31', '2014-01-27', '2014-01-30', '2010-03-09', '2010-03-15', 31, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(977, 3, 'Diklat Calon Widyaiswara Angkt. I', 240, '2014-02-11', '2014-03-15', '2014-01-27', '2014-03-10', '2010-03-17', '2010-03-26', 22, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(978, 0, 'Diklat Business English Angkt. I', 43, '0000-00-00', '0000-00-00', '2014-02-03', '2014-02-07', '2010-03-22', '2010-03-26', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(979, 0, 'Diklat Penulisan Laporan Hasil Audit yang Efektif untuk Anggota Tim', 47, '2014-10-13', '2014-10-17', '2014-02-03', '2014-02-07', '2010-03-23', '2010-03-26', 32, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(980, 0, 'Diklat Manajemen Penyelenggaraan Diklat', 44, '0000-00-00', '0000-00-00', '2014-02-03', '2014-02-07', '2010-03-23', '2010-03-25', 30, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(981, 0, 'Diklat Kearsipan Dinamis Angkt. I', 37, '0000-00-00', '0000-00-00', '2014-02-03', '2014-02-07', '2010-03-29', '2010-04-01', 38, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(982, 4, 'Diklat Microsoft Access Tingkat Dasar Angkt. I', 48, '0000-00-00', '0000-00-00', '2014-02-03', '2014-02-07', '2010-04-05', '2010-04-09', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 2),
(983, 0, 'Placement Test Diklat TOEFL', 0, '2014-02-18', '2014-02-19', '2014-02-04', '2014-02-04', '2010-04-05', '2010-04-08', 406, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(984, 0, 'Diklat Training Need Analysis', 36, '0000-00-00', '0000-00-00', '2014-02-10', '2014-02-14', '2010-04-12', '2010-04-16', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(985, 0, 'Diklat Financial Statistics', 47, '0000-00-00', '0000-00-00', '2014-02-10', '2014-02-14', '2010-04-12', '2010-04-16', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1);
INSERT INTO `testing` (`id_training`, `id_program`, `name_training`, `hours_training`, `revision_plan_start_training`, `revision_plan_finish_training`, `plan_start_training`, `plan_finish_training`, `start_training`, `finish_training`, `plan_participant_training`, `participant_training`, `location_training`, `note_training`, `update_training`, `main_user`, `status_training`, `certificate_type`) VALUES
(986, 0, 'Diklat/ Orientasi Teori Ekonomi Makro Tingkat Dasar Angkt. II (BKF)', 51, '2014-04-21', '2014-04-25', '2014-02-10', '2014-02-14', '2010-04-19', '2010-04-23', 35, 0, '', '', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(987, 0, 'Diklat Free Open Source Software', 47, '0000-00-00', '0000-00-00', '2014-02-10', '2014-02-14', '2010-04-26', '2010-04-30', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(988, 0, 'Diklat Teknik Investigasi Tingkat Dasar', 107, '0000-00-00', '0000-00-00', '2014-02-10', '2014-02-24', '2010-05-03', '2010-05-07', 35, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(989, 0, 'Diklat Pranata Komputer Terampil', 234, '0000-00-00', '0000-00-00', '2014-02-10', '2014-03-17', '2010-05-03', '2010-05-07', 19, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 2),
(990, 0, 'Placement Excel, Word &#38; Powerpoint', 0, '0000-00-00', '0000-00-00', '2014-02-11', '2014-02-11', '2010-05-03', '2010-05-07', 217, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(991, 0, 'Diklat Legal Drafting Peraturan di Lingkungan Kementerian Keuangan Angkt. I', 37, '2014-04-01', '2014-04-04', '2014-02-17', '2014-02-20', '2010-05-03', '2010-05-06', 35, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(992, 4, 'Diklat Microsoft Access Tingkat Dasar Angkt. III', 48, '2014-10-06', '2014-10-10', '2014-02-17', '2014-02-21', '2010-05-11', '2010-05-11', 35, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(993, 0, 'Diklat Evaluasi Diklat', 44, '2014-03-24', '2014-03-28', '2014-02-17', '2014-02-21', '2010-05-11', '2010-05-22', 23, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(994, 0, 'Diklat Information Technology Risk Management', 38, '2014-03-24', '2014-03-27', '2014-02-17', '2014-02-21', '2010-05-24', '2010-05-26', 35, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9', '0000-00-00 00:00:00', 'SETJEN', '[READY]', 1),
(995, 0, 'Diklat Training of Trainers Angkt. I', 47, '0000-00-00', '0000-00-00', '2014-02-17', '2014-02-21', '2010-05-24', '2010-05-26', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(996, 0, 'Diklat Penyusunan RSB dan BAS Angkt. I', 46, '0000-00-00', '0000-00-00', '2014-02-17', '2014-02-21', '2010-05-26', '2010-05-26', 30, 0, '', 'semula: Diklat Teknik Cepat Pembuatan RSB dan BAS Angkt. I', '0000-00-00 00:00:00', 'SETJEN', '[READY]', 1),
(997, 0, 'Diklat Pemrograman Web Dasar', 47, '2014-10-06', '2014-10-10', '2014-02-24', '2014-02-28', '2010-05-31', '2010-06-04', 35, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(998, 0, 'Diklat Kebijakan Publik untuk Auditor', 49, '2014-10-06', '2014-10-10', '2014-02-24', '2014-02-28', '2010-05-31', '2010-06-11', 20, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(999, 0, 'Diklat Analisis Beban Kerja Angkt. I', 42, '2014-12-31', '2014-12-31', '2014-02-24', '2014-02-28', '2010-06-01', '2010-06-03', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1000, 0, 'Diklat Akuntansi Berbasis PSAK Konvergensi IFRS Angkt. I', 48, '0000-00-00', '0000-00-00', '2014-02-24', '2014-02-28', '2010-06-07', '2010-06-11', 33, 0, '', '', '0000-00-00 00:00:00', 'DJP', '[READY]', 1),
(1001, 0, 'Diklat Manajemen Risiko Angkt. I', 45, '0000-00-00', '0000-00-00', '2014-02-24', '2014-02-28', '2010-06-07', '2010-06-11', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(1002, 0, 'Diklat Persiapan Purnabhakti Angkt. I', 44, '2014-03-03', '2014-03-07', '2014-02-24', '2014-02-28', '2010-06-07', '2010-06-11', 35, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9\r\n#ND-41/PP.7.3/2014 #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(1003, 0, 'Diklat Kebijakan Publik Tingkat Lanjutan (CBA) Angk. II', 39, '2014-04-01', '2014-04-04', '2014-02-24', '2014-02-28', '2010-06-08', '2010-06-11', 25, 0, '', '#Diundur permintaan Penyelenggaraan seminggu maks 9 #ND-116/PP.7.2/2014', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1004, 0, 'Diklat Desain Pengelolaan Database Angkt. I', 45, '2014-03-24', '2014-03-28', '2014-03-03', '2014-03-07', '2010-06-14', '2010-06-18', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1005, 0, 'Diklat Penulisan Laporan Hasil Audit yang Efektif untuk Ketua Tim', 46, '0000-00-00', '0000-00-00', '2014-03-03', '2014-03-07', '2010-06-21', '2010-06-25', 17, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(1006, 0, 'Diklat Teori Ekonomi Makro Tingkat Dasar Angkt. I (DJPB)', 51, '0000-00-00', '0000-00-00', '2014-03-03', '2014-03-07', '2010-06-22', '2010-06-24', 35, 0, '', '#Angkatan Diajukan #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'DJPB', '[READY]', 1),
(1007, 0, 'Diklat Perencanaan Diklat', 43, '2014-03-10', '2014-03-14', '2014-03-03', '2014-03-07', '2010-06-28', '2010-07-02', 21, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(1008, 0, 'Diklat General English Angkt. I', 138, '2014-03-24', '2014-04-14', '2014-03-03', '2014-03-21', '2010-07-05', '2010-07-23', 30, 0, '', 'BERUBAH KARENA PENYELENGGARAAN PLACEMENT TEST TOEFL', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1009, 0, 'Diklat Human Capital Management and Organization Development', 30, '2014-03-03', '2014-03-07', '2014-03-04', '2014-04-08', '2010-07-12', '2010-07-16', 30, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[READY]', 1),
(1010, 0, 'Diklat Penyusunan Standard Operating Procedure Angkt. I', 35, '2014-12-31', '2014-12-31', '2014-03-10', '2014-03-13', '2010-07-19', '2010-07-23', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1011, 0, 'Diklat Audit Pengadaan Barang dan Jasa', 50, '0000-00-00', '0000-00-00', '2014-03-10', '2014-03-14', '2010-07-19', '2010-08-06', 31, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1012, 0, 'Diklat Teknik Audit Berbantuan Komputer Tingkat Dasar', 45, '0000-00-00', '0000-00-00', '2014-03-10', '2014-03-14', '2010-07-13', '2010-08-02', 30, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(1013, 0, 'Diklat Financial Modeling Tingkat Dasar', 36, '2014-03-10', '2014-03-13', '2014-03-10', '2014-03-14', '2010-07-20', '2010-07-20', 15, 0, '', 'semula: Diklat Financial Modelling (Basic) #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'DJPU', '[READY]', 1),
(1014, 0, 'Diklat Manajemen Sumber Daya Manusia (SDM) Tingkat Lanjutan', 48, '2014-12-31', '2014-12-31', '2014-03-10', '2014-03-14', '2010-07-26', '2010-07-28', 38, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1015, 0, 'Diklat/ Orientasi Kebijakan Publik Tingkat Dasar', 45, '2014-05-19', '2014-05-23', '2014-03-10', '2014-03-14', '2010-07-26', '2010-07-30', 30, 0, '', '#S-47/KF.1/UP.6/2014', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1016, 0, 'Diklat Microsoft Word &#38; Powerpoint Tingkat Lanjutan Angkt. I', 63, '0000-00-00', '0000-00-00', '2014-03-10', '2014-03-18', '2010-07-26', '2010-07-30', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 2),
(1017, 3, 'Diklat Calon Widyaiswara Angkt. II', 236, '2014-02-18', '2014-03-22', '2014-02-10', '2014-03-14', '2010-07-26', '2010-08-10', 22, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(1018, 0, 'Diklat Kebijakan Publik Tingkat Lanjutan (RIA)', 46, '0000-00-00', '0000-00-00', '2014-03-17', '2014-03-21', '2010-08-03', '2010-08-05', 25, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1019, 0, 'Diklat Teori Ekonomi Makro Tingkat Lanjutan', 40, '0000-00-00', '0000-00-00', '2014-03-17', '2014-03-21', '2010-08-02', '2010-08-06', 25, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1020, 0, 'Diklat Manajemen Risiko Angkt. II', 45, '0000-00-00', '0000-00-00', '2014-03-17', '2014-03-21', '2010-08-02', '2010-08-13', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(1021, 0, 'Diklat Pengelolaan Kinerja Angkt. I', 46, '0000-00-00', '0000-00-00', '2014-03-17', '2014-03-21', '2010-08-16', '2010-08-30', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1022, 0, 'Diklat Kebijakan Publik Tingkat Lanjutan (CBA) Angk. I', 36, '2014-04-01', '2014-04-04', '2014-03-17', '2014-03-21', '2010-08-09', '2010-09-08', 20, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'DJPK', '[PLAN]', 1),
(1023, 0, 'Diklat/ Orientasi Dasar-dasar Penelitian', 30, '2014-06-02', '2014-06-06', '2014-03-18', '2014-03-20', '2010-08-23', '2010-08-27', 35, 0, '', 'S-47/KF.1/UP. 6/2014', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1024, 0, 'Diklat Financial Modeling Tingkat Lanjutan', 28, '0000-00-00', '0000-00-00', '2014-03-24', '2014-03-28', '2010-09-20', '2010-09-24', 15, 0, '', 'semula: Diklat Pembuatan Modelling Yield Curve #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1025, 0, 'Diklat Teknik Intelijen Tingkat Lanjutan Angkt. I (Surveillance)', 59, '0000-00-00', '0000-00-00', '2014-03-24', '2014-03-28', '2010-09-20', '2010-10-15', 16, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[READY]', 1),
(1026, 0, 'Diklat Penyusunan RSB dan BAS Angkt. II', 46, '2014-04-28', '2014-05-03', '2014-03-24', '2014-03-28', '2010-09-20', '2010-10-22', 30, 0, '', 'semula: Diklat Teknik Cepat Pembuatan RSB dan BAS Angkt. II #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1027, 0, 'Diklat Analisis Beban Kerja Angkt. II', 42, '2014-12-31', '2014-12-31', '2014-03-24', '2014-03-28', '2010-09-27', '2010-10-01', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1028, 0, 'Diklat Knowledge Management', 43, '2014-12-31', '2014-12-31', '2014-03-24', '2014-03-28', '2010-09-27', '2010-10-01', 30, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1029, 0, 'Training Of Trainers Manajemen Risiko', 45, '2014-02-10', '2014-02-14', '2014-03-24', '2014-03-28', '2010-10-05', '2010-10-22', 30, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(1030, 0, 'Diklat Penulisan Buku Teks', 36, '0000-00-00', '0000-00-00', '2014-04-01', '2014-04-04', '2010-10-12', '2010-10-15', 25, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1031, 0, 'Diklat Audit Kinerja untuk Ketua Tim', 37, '0000-00-00', '0000-00-00', '2014-04-01', '2014-04-04', '2010-10-18', '2010-10-22', 17, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1032, 0, 'Diklat Legal Drafting Peraturan di Lingkungan Kementerian Keuangan Angkt. II (SET PP)', 37, '0000-00-00', '0000-00-00', '2014-04-01', '2014-04-04', '2010-10-28', '2010-11-19', 35, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1033, 0, 'Diklat Perencanaan SDM', 30, '2014-12-31', '2014-12-31', '2014-04-01', '2014-04-04', '2010-11-01', '2010-11-04', 24, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'DJBC', '[PLAN]', 1),
(1034, 0, 'Diklat Penyusunan Modul', 35, '0000-00-00', '0000-00-00', '2014-04-01', '2014-04-04', '2010-11-01', '2010-11-03', 30, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1035, 0, 'Diklat Manajemen Investasi', 47, '2014-04-28', '2014-05-03', '2014-04-07', '2014-04-11', '2010-11-01', '2010-11-05', 25, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1036, 0, 'Diklat Kebijakan Publik Tingkat Lanjutan (CBA) Angk. III', 36, '2014-04-28', '2014-05-02', '2014-04-07', '2014-04-11', '2010-11-08', '2010-11-12', 15, 0, '', '#Pileg 9 April\r\nsemula: Diklat Kebijakan Publik Tingkat Lanjutan (Materi Baru)\r\n#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1037, 0, 'Diklat Teknik Investigasi Tingkat Lanjutan', 45, '2014-04-28', '2014-05-03', '2014-04-07', '2014-04-11', '2010-11-08', '2010-11-15', 25, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1038, 0, 'Diklat Pemeriksaan Pelanggaran Disiplin Pegawai Angkt. I', 46, '2014-04-28', '2014-05-03', '2014-04-07', '2014-04-11', '2010-11-10', '2010-11-12', 35, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1039, 0, 'Diklat Microsoft Excel Tingkat Lanjutan Angkt. I', 48, '2014-04-28', '2014-05-03', '2014-04-07', '2014-04-11', '2010-11-22', '2010-11-26', 32, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 2),
(1040, 0, 'Diklat Administrasi Jaringan Komputer', 47, '2014-04-28', '2014-05-03', '2014-04-07', '2014-04-11', '2010-11-23', '2010-11-25', 35, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1041, 0, 'Diklat TOEFL Paper Based Test (PBT) Preparation Angkt. I', 137, '0000-00-00', '0000-00-00', '2014-04-07', '2014-04-28', '2010-11-29', '2010-12-03', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1042, 0, 'Diklat Ekonometrika Tingkat Lanjutan (Data Susenas)', 32, '2014-09-01', '2014-09-04', '2014-04-14', '2014-04-16', '2010-12-01', '2010-12-01', 15, 0, '', 'semula: Diklat Ekonometrika Tingkat Lanjutan (Materi Baru) #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1043, 0, 'Diklat Analisis Jabatan', 37, '2014-12-31', '2014-12-31', '2014-04-14', '2014-04-17', '2010-11-08', '2010-11-08', 25, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1044, 0, 'DTSS Negotiation Skill (Loan Agreement)', 29, '0000-00-00', '0000-00-00', '2014-04-14', '2014-04-17', '2011-01-10', '2011-01-20', 16, 92, '', '', '0000-00-00 00:00:01', 'DJPU', '[PLAN]', 1),
(1045, 0, 'Diklat Sekretaris Pimpinan', 40, '0000-00-00', '0000-00-00', '2014-04-14', '2014-04-17', '2011-01-17', '2011-02-25', 35, 45, '', '', '0000-00-00 00:00:02', 'KEMENKEU', '[PLAN]', 1),
(1046, 0, 'Diklat Forensik Audit', 85, '0000-00-00', '0000-00-00', '2014-04-14', '2014-04-25', '2011-01-21', '2011-02-02', 25, 35, '', '', '0000-00-00 00:00:03', 'ITJEN', '[PLAN]', 1),
(1047, 0, 'Diklat Training Need Analysis - BPPK', 44, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-25', '2011-01-24', '2011-01-28', 22, 29, '', '', '0000-00-00 00:00:04', 'BPPK', '[PLAN]', 1),
(1048, 0, 'Diklat Dasar-dasar Penelitian Angkt. I (DJPB)', 49, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-25', '2011-01-24', '2011-01-28', 35, 29, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:05', 'DJPB', '[PLAN]', 1),
(1049, 0, 'Diklat Business English Angkt. II', 43, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-25', '2011-01-24', '2011-02-09', 35, 26, '', '', '0000-00-00 00:00:06', 'KEMENKEU', '[PLAN]', 1),
(1050, 0, 'Diklat Microsoft Word &#38; Powerpoint Tingkat Lanjutan Angkt. II', 63, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-29', '2011-01-24', '2011-01-28', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 2),
(1051, 0, 'Diklat Manajemen Utang', 30, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-28', '2011-01-31', '2011-02-02', 35, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1052, 0, 'SEMINAR I', 6, '0000-00-00', '0000-00-00', '2014-04-22', '2014-04-22', '2011-02-07', '2011-02-11', 100, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1053, 0, 'Diklat Manajemen Risiko (Kelas Manajerial)', 31, '0000-00-00', '0000-00-00', '2014-04-28', '2014-04-30', '2011-02-07', '2011-02-11', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1054, 0, 'Diklat Legal Drafting Peraturan Perundang-Undangan Angkt. I', 30, '0000-00-00', '0000-00-00', '2014-04-28', '2014-04-30', '2011-02-17', '2011-02-17', 35, 0, '', '', '0000-00-00 00:00:00', 'DJA', '[PLAN]', 1),
(1055, 0, 'Diklat Fungsional Arsiparis', 46, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '2011-02-21', '2011-02-25', 21, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1056, 0, 'Diklat Akuntansi Berbasis PSAK Konvergensi IFRS Angkt. II', 48, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '2011-02-21', '2011-02-25', 35, 0, '', '', '0000-00-00 00:00:00', 'DJP', '[PLAN]', 1),
(1057, 0, 'Diklat Penulisan Risalah Rapat Pimpinan', 25, '2014-05-05', '2014-05-07', '2014-05-05', '2014-05-09', '2011-02-21', '2011-02-25', 17, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1058, 0, 'Diklat Audit Teknologi Informasi Komunikasi Tingkat Lanjutan: Audit Sistem Jaringan', 48, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '2011-02-21', '2011-02-28', 25, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1059, 0, 'Diklat Teknik Analisis Fiskal', 34, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '2011-02-22', '2011-02-25', 15, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1060, 0, 'Diklat Evaluasi Pasca Diklat', 46, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '2011-02-28', '2011-03-18', 26, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1061, 0, 'Diklat Microsoft Word &#38; Powerpoint Tingkat Lanjutan Angkt. III', 63, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-13', '2011-02-28', '2011-03-02', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 2),
(1062, 0, 'Diklat Manajemen Sumber Daya Manusia (SDM) Tingkat Dasar Angkt. I', 63, '2014-12-31', '2014-12-31', '2014-05-05', '2014-05-14', '2011-02-28', '2011-03-04', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1063, 0, 'SEMINAR II', 6, '0000-00-00', '0000-00-00', '2014-05-07', '2014-05-07', '2011-03-01', '2011-03-04', 100, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1064, 0, 'Diklat Islamic Finance-Tingkat Dasar', 32, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-07', '2011-03-11', 25, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1065, 0, 'Diklat Input Output dan Social Accounting Matrix (SAM)', 39, '2014-05-12', '2014-05-16', '2014-05-12', '2014-05-14', '2011-03-07', '2011-03-11', 20, 0, '', 'semula: Diklat Input Output #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1066, 0, 'Diklat Ekonometrika Tingkat Lanjutan (Time Series)', 32, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-07', '2011-04-01', 30, 0, '', '', '0000-00-00 00:00:00', 'BKF + DJPU', '[PLAN]', 1),
(1067, 0, 'Diklat Menulis untuk Media Massa', 27, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-07', '2011-03-11', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1068, 0, 'Diklat Analisis Keuangan dan Bisnis', 32, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-14', '2011-03-18', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1069, 0, 'Diklat Legal English Angkt. I', 29, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-21', '2011-04-01', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1070, 0, 'Diklat Anti Money Laundering dan Asset Tracing Tingkat Lanjutan', 30, '0000-00-00', '0000-00-00', '2014-05-12', '2014-05-14', '2011-03-21', '2011-03-25', 30, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1071, 0, 'Diklat Microsoft Excel Tingkat Lanjutan Angkt. II', 48, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-03-29', '2011-03-29', 32, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 2),
(1072, 0, 'Diklat Kewajiban Kontijensi', 45, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-04', '2011-04-08', 16, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1073, 0, 'Diklat Penyusunan Soal', 35, '2014-04-14', '2014-04-17', '2014-05-19', '2014-05-23', '2011-04-04', '2011-04-08', 23, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1074, 0, 'Diklat Teknik Audit Berbantuan Komputer Tingkat Lanjutan', 45, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-04', '2011-04-08', 30, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1075, 0, 'Diklat Pemeriksaan Pelanggaran Disiplin Pegawai Angkt. II', 46, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-11', '2011-04-16', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1076, 0, 'Diklat Diplomasi Ekonomi', 47, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-11', '2011-04-15', 28, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1077, 0, 'Diklat Persiapan Purnabhakti Angkt. II', 44, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-11', '2011-04-15', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1078, 2, 'Diklat Tata Naskah Dinas Angkt. II', 45, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '2011-04-11', '2011-04-15', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1079, 0, 'Diklat Pembentukan Auditor Terampil', 148, '0000-00-00', '0000-00-00', '2014-06-01', '2014-06-20', '2011-04-08', '2011-04-11', 20, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1080, 0, 'Diklat Audit Tata Kelola Teknologi Informasi dan Komunikasi (TIK)', 49, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-06', '2011-04-12', '2011-04-21', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1081, 0, 'Diklat Penyusunan Laporan yang Efektif', 32, '2014-06-02', '2014-06-05', '2014-06-02', '2014-06-06', '2011-04-18', '2011-04-21', 20, 0, '', 'semula: Diklat Penyusunan Laporan Kegiatan (nama tentatif) #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'DJA', '[PLAN]', 1),
(1082, 0, 'Diklat Manajemen Risiko Angkt. III (SET PP)', 45, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-06', '2011-04-25', '2011-04-29', 20, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1083, 0, 'Diklat Kehumasan', 44, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-06', '2011-04-25', '2011-04-29', 35, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1084, 0, 'Diklat Teknik Intelijen Tingkat Dasar', 90, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-13', '2011-04-25', '2011-04-29', 25, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1085, 0, 'Diklat General English Angkt. II', 138, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-20', '2011-04-25', '2011-05-13', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1086, 0, 'Diklat TOEFL Internet Based Test (IBT) Preparation', 152, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-27', '2011-05-02', '2011-05-06', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1087, 0, 'Diklat Call Center', 29, '2014-08-18', '2014-08-20', '2014-06-09', '2014-06-12', '2011-05-02', '2011-05-06', 28, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1088, 0, 'Diklat Audit Untuk Non PFA', 38, '2014-06-09', '2014-06-12', '2014-06-09', '2014-06-13', '2011-05-02', '2011-05-06', 26, 0, '', 'semula: Diklat Dasar Teknis Audit (Internal Kemenkeu) #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1089, 0, 'Diklat Desain Pengelolaan Database Angkt. II', 45, '0000-00-00', '0000-00-00', '2014-06-09', '2014-06-13', '2011-05-09', '2011-05-13', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1090, 0, 'Diklat Kewidyaiswaraan Berjenjang Lanjutan (Muda)', 122, '2014-02-24', '2014-03-08', '2014-06-09', '2014-06-25', '2011-05-09', '2011-05-13', 39, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[READY]', 1),
(1091, 0, 'Diklat Pengelolaan Website Dinamis (e-Learning)', 82, '0000-00-00', '0000-00-00', '2014-06-09', '2014-08-25', '2011-05-09', '2011-05-19', 26, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1092, 0, 'Diklat Legal Drafting Peraturan Perundang-Undangan Angkt. II', 30, '0000-00-00', '0000-00-00', '2014-06-10', '2014-06-12', '2011-05-18', '2011-05-23', 38, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1093, 0, 'Diklat Curriculum Design', 44, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-19', '2011-05-18', '2011-05-24', 20, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1094, 0, 'Diklat Audit Kinerja untuk Anggota Tim', 47, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-20', '2011-05-23', '2011-05-27', 27, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1095, 0, 'Diklat Analisis Laporan Keuangan', 50, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-20', '2011-05-23', '2011-05-27', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1096, 0, 'Diklat Microsoft Word &#38; Powerpoint Tingkat Tinggi', 63, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-24', '2011-05-26', '2011-06-01', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1097, 0, 'Diklat Manajemen Sumber Daya Manusia (SDM) Tingkat Dasar Angkt. II', 63, '2014-12-31', '2014-12-31', '2014-06-16', '2014-06-25', '2011-05-30', '2011-06-27', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1098, 0, 'Diklat Teknik Intelijen Tingkat Lanjutan Angkt. II (Setkomwasjak)', 28, '0000-00-00', '0000-00-00', '2014-06-20', '2014-06-23', '2011-06-06', '2011-06-10', 25, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1099, 0, 'Diklat Kearsipan Dinamis Angkt. II', 37, '0000-00-00', '0000-00-00', '2014-06-23', '2014-06-27', '2011-06-06', '2011-06-10', 37, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1100, 0, 'Diklat Audit Teknologi Informasi Komunikasi Tingkat Lanjutan: Audit Manajemen Operasional Perkantoran', 48, '0000-00-00', '0000-00-00', '2014-06-23', '2014-06-27', '2011-06-06', '2011-06-10', 18, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1101, 0, 'Diklat Teori Ekonomi Makro Tingkat Dasar Angkt. II', 51, '0000-00-00', '0000-00-00', '2014-06-23', '2014-06-27', '2011-06-06', '2011-06-10', 35, 0, '', '', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1102, 0, 'Diklat Penyusunan Standard Operating Procedure Angkt. II', 35, '2014-12-31', '2014-12-31', '2014-06-23', '2014-06-27', '2011-06-13', '2011-06-17', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1103, 0, 'Diklat Islamic Finance-Tingkat Lanjutan', 32, '0000-00-00', '0000-00-00', '2014-06-24', '2014-06-26', '2011-06-13', '2011-06-17', 25, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1104, 0, 'Diklat Contract Drafting', 26, '2014-07-07', '2014-07-09', '2014-07-07', '2014-07-11', '2011-06-13', '2011-06-17', 15, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1105, 0, 'Diklat Competency Profiling', 46, '2014-12-31', '2014-12-31', '2014-07-07', '2014-07-11', '2011-06-13', '2011-06-17', 35, 0, '', 'DILIMPAHKAN KE PUSDIKLAT PSDM', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1106, 0, 'Diklat Service Level Agreement Kediklatan', 43, '0000-00-00', '0000-00-00', '2014-07-07', '2014-07-11', '2011-06-20', '2011-06-24', 23, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1107, 0, 'Diklat Pranata Komputer Ahli', 213, '0000-00-00', '0000-00-00', '2014-08-11', '2014-09-16', '2011-06-20', '2011-06-24', 17, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1108, 0, 'Diklat Legal Drafting Peraturan di Lingkungan Kementerian Keuangan Angkt. III', 37, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-14', '2011-06-20', '2011-06-24', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1109, 0, 'Diklat Akuntansi Berbasis PSAK Konvergensi IFRS Angkt. III', 48, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-15', '2011-06-20', '2011-06-28', 35, 0, '', '', '0000-00-00 00:00:00', 'DJP', '[PLAN]', 1),
(1110, 0, 'Diklat Pengelolaan Kinerja Angkt. II', 46, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-15', '2011-06-23', '2011-07-14', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1111, 0, 'Diklat Pengelolaan Media Internal', 41, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-15', '2011-06-27', '2011-07-07', 27, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1112, 0, 'Diklat Microsoft Excel Tingkat Tinggi', 48, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-15', '2011-06-28', '2011-06-28', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1113, 0, 'Diklat General English Angkt. III', 138, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-29', '2011-07-04', '2011-07-08', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1114, 0, 'Diklat Kewidyaiswaraan Berjenjang Madya', 102, '2014-04-01', '2014-04-12', '2014-08-11', '2014-09-01', '2011-07-04', '2011-07-08', 21, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1115, 0, 'Diklat Dasar-dasar Penelitian Angkt. II', 49, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-04', '2011-07-22', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1116, 0, 'Diklat Audit Teknologi Informasi Komunikasi Tingkat Lanjutan: Audit Database', 49, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-11', '2011-07-15', 25, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1117, 0, 'Diklat Metodologi Penelitian Kediklatan', 47, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-11', '2011-07-15', 20, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[PLAN]', 1),
(1118, 0, 'Diklat Persiapan Purnabhakti Angkt. III', 44, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-18', '2011-07-22', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1119, 2, 'Diklat Tata Naskah Dinas Angkt. III', 45, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-20', '2011-08-05', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1120, 0, 'Diklat Pemrograman Web dengan ASP.net', 48, '0000-00-00', '0000-00-00', '2014-08-18', '2014-08-22', '2011-07-25', '2011-07-29', 32, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1121, 0, 'Diklat Audit Teknologi Informasi Komunikasi Tingkat Dasar', 47, '0000-00-00', '0000-00-00', '2014-08-25', '2014-08-29', '2011-07-25', '2011-08-05', 25, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1122, 0, 'Diklat Financial Risk Management', 45, '0000-00-00', '0000-00-00', '2014-08-25', '2014-08-29', '2011-07-25', '2011-07-29', 15, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1123, 0, 'Diklat Protokoler', 34, '2014-08-25', '2014-08-28', '2014-08-25', '2014-08-29', '2011-08-01', '2011-08-10', 25, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1124, 0, 'Diklat Desain Multimedia', 80, '0000-00-00', '0000-00-00', '2014-08-25', '2014-09-05', '2011-08-01', '2011-08-05', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1125, 0, 'Diklat TOEFL Paper Based Test (PBT) Preparation Angkt. II', 137, '0000-00-00', '0000-00-00', '2014-08-25', '2014-09-12', '2011-08-08', '2011-08-12', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1126, 0, 'SEMINAR III', 6, '0000-00-00', '0000-00-00', '2014-08-27', '2014-08-27', '2011-08-08', '2011-08-11', 100, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1127, 0, 'Diklat Psikologi Audit Investigatif', 47, '0000-00-00', '0000-00-00', '2014-09-01', '2014-09-05', '2011-08-25', '2011-09-23', 30, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1128, 4, 'Diklat Microsoft Access Tingkat Dasar Angkt. II', 48, '0000-00-00', '0000-00-00', '2014-09-01', '2014-09-05', '2011-09-12', '2011-09-16', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1129, 0, 'Diklat Akuntansi Keuangan Syariah', 43, '0000-00-00', '0000-00-00', '2014-09-01', '2014-09-05', '2011-09-12', '2011-09-16', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1130, 0, 'Diklat Islamic Finance-Tingkat Tinggi', 32, '0000-00-00', '0000-00-00', '2014-09-02', '2014-09-05', '2011-09-12', '2011-09-16', 25, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1131, 0, 'Diklat Legal Drafting Peraturan di Lingkungan Kementerian Keuangan Angkt. IV', 37, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-11', '2011-09-13', '2011-10-10', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1132, 0, 'Diklat Kearsipan Dinamis Angkt. III', 37, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-12', '2011-09-13', '2011-10-04', 35, 0, '', '', '0000-00-00 00:00:00', 'SETJEN', '[PLAN]', 1),
(1133, 0, 'Diklat Penyidikan Bukti Digital Forensik Tingkat Dasar', 47, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-12', '2011-09-19', '2011-09-23', 35, 0, '', '', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1134, 0, 'Diklat Training of Trainers Angkt. II', 47, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-12', '2011-09-19', '2011-09-23', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1135, 0, 'Diklat Pengelolaan Website Dinamis', 83, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-19', '2011-09-20', '2011-09-23', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1136, 0, 'Diklat General English Angkt. IV', 138, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-26', '2011-09-20', '2011-09-22', 30, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1137, 0, 'Diklat Project Management', 45, '0000-00-00', '0000-00-00', '2014-09-15', '2014-09-19', '2011-09-22', '2011-09-22', 25, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1138, 0, 'Diklat Pengelolaan Kinerja Angkt. III', 46, '0000-00-00', '0000-00-00', '2014-09-15', '2014-09-19', '2011-09-26', '2011-10-07', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1139, 0, 'Diklat Business English Angkt. III', 43, '0000-00-00', '0000-00-00', '2014-09-22', '2014-09-26', '2011-09-26', '2011-09-30', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1140, 2, 'Diklat Tata Naskah Dinas Angkt. IV', 45, '0000-00-00', '0000-00-00', '2014-09-22', '2014-09-26', '2011-09-27', '2011-10-04', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1141, 0, 'Diklat Kearsipan Elektronik', 44, '0000-00-00', '0000-00-00', '2014-09-22', '2014-09-26', '2011-10-03', '2011-10-18', 20, 0, '', 'BATAL-BATAL-BATAL', '0000-00-00 00:00:00', 'BPPK', '[CANCEL]', 1),
(1142, 0, 'Diklat Legal English Angkt. II', 29, '0000-00-00', '0000-00-00', '2014-09-29', '2014-10-01', '2011-10-03', '2011-10-14', 35, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1143, 0, 'Diklat Calon Auditor', 78, '2014-03-24', '2014-04-02', '2014-10-01', '2014-10-03', '2011-10-03', '2011-10-07', 28, 0, '', 'semula: Diklat Critical Thinking #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', 'ITJEN', '[PLAN]', 1),
(1144, 0, 'Diklat Manajemen Risiko Angkt. IV (DJPU)', 46, '0000-00-00', '0000-00-00', '2014-10-06', '2014-10-10', '2011-10-10', '2011-10-28', 15, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1145, 0, 'Diklat Persiapan Purnabhakti Angkt. IV', 44, '0000-00-00', '0000-00-00', '2014-10-06', '2014-10-10', '2011-10-10', '2011-10-14', 33, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1146, 0, 'SEMINAR IV', 6, '0000-00-00', '0000-00-00', '2014-10-15', '2014-10-15', '2011-10-10', '2011-10-21', 100, 0, '', '', '0000-00-00 00:00:00', 'KEMENKEU', '[PLAN]', 1),
(1147, 0, 'Diklat Peneliti Tingkat Pertama', 203, '0000-00-00', '0000-00-00', '2014-11-24', '2014-12-23', '2011-10-17', '2011-10-21', 20, 0, '', '', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1148, 0, 'Diklat Pembentukan Auditor Ahli', 193, '2014-02-03', '2014-02-28', '2014-11-24', '2014-12-19', '2011-10-17', '2011-10-21', 33, 0, '', 'Full Board', '0000-00-00 00:00:00', 'ITJEN', '[READY]', 1),
(1149, 0, 'Diklat Kewidyaiswaraan Berjenjang Pertama', 122, '0000-00-00', '0000-00-00', '2014-12-01', '2014-12-17', '2011-10-24', '2011-11-11', 7, 0, '', '', '0000-00-00 00:00:00', 'BPPK', '[CANCEL]', 1),
(1150, 0, 'Diklat Data Warehouse', 40, '0000-00-00', '0000-00-00', '2014-12-01', '2014-12-05', '2011-10-24', '2011-10-28', 10, 0, '', '', '0000-00-00 00:00:00', 'DJPU', '[PLAN]', 1),
(1151, 0, 'Diklat Peneliti Tingkat Lanjutan', 63, '0000-00-00', '0000-00-00', '2014-12-15', '2014-12-19', '2011-10-24', '2011-10-26', 3, 0, '', '', '0000-00-00 00:00:00', 'BKF', '[PLAN]', 1),
(1152, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. I', 15, '0000-00-00', '0000-00-00', '2014-02-05', '2014-02-07', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1153, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. II', 15, '0000-00-00', '0000-00-00', '2014-02-05', '2014-02-07', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1154, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. III', 15, '0000-00-00', '0000-00-00', '2014-02-05', '2014-02-07', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1155, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. IV', 15, '0000-00-00', '0000-00-00', '2014-02-12', '2014-02-14', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1156, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. V', 15, '0000-00-00', '0000-00-00', '2014-02-12', '2014-02-14', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1157, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. VI', 15, '0000-00-00', '0000-00-00', '2014-02-12', '2014-02-14', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1158, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. VII', 15, '0000-00-00', '0000-00-00', '2014-02-19', '2014-02-21', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1159, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. VIII', 15, '0000-00-00', '0000-00-00', '2014-02-19', '2014-02-21', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1160, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. IX', 15, '0000-00-00', '0000-00-00', '2014-02-19', '2014-02-21', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1161, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. X', 15, '0000-00-00', '0000-00-00', '2014-02-24', '2014-02-26', '0000-00-00', '0000-00-00', 28, 0, '', 'Diselenggarakan di Hotel Grand Cempaka', '0000-00-00 00:00:00', '', '[READY]', 1),
(1162, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. I', 48, '0000-00-00', '0000-00-00', '2014-03-03', '2014-03-07', '0000-00-00', '0000-00-00', 33, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1163, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. IV', 48, '0000-00-00', '0000-00-00', '2014-03-17', '2014-03-21', '0000-00-00', '0000-00-00', 33, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1164, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. VII', 48, '2014-03-24', '2014-03-28', '2014-04-07', '2014-04-11', '0000-00-00', '0000-00-00', 30, 0, '', '#ND-173/PP.7.2/2014', '0000-00-00 00:00:00', '', '[READY]', 1),
(1165, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. X', 48, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-25', '0000-00-00', '0000-00-00', 28, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1166, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XI', 48, '0000-00-00', '0000-00-00', '2014-04-21', '2014-04-25', '0000-00-00', '0000-00-00', 27, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1167, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XIII', 48, '0000-00-00', '0000-00-00', '2014-05-05', '2014-05-09', '0000-00-00', '0000-00-00', 30, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1168, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XVI', 48, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '0000-00-00', '0000-00-00', 24, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1169, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XVII', 48, '0000-00-00', '0000-00-00', '2014-05-19', '2014-05-23', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1170, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XIX', 48, '0000-00-00', '0000-00-00', '2014-06-02', '2014-06-06', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1171, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXII', 48, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-20', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1172, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXIII', 48, '0000-00-00', '0000-00-00', '2014-06-16', '2014-06-20', '0000-00-00', '0000-00-00', 29, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1173, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXV', 48, '0000-00-00', '0000-00-00', '2014-08-11', '2014-08-15', '0000-00-00', '0000-00-00', 29, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1174, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXVIII', 48, '0000-00-00', '0000-00-00', '2014-08-25', '2014-08-29', '0000-00-00', '0000-00-00', 27, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1175, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXIX', 48, '0000-00-00', '0000-00-00', '2014-08-25', '2014-08-29', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1176, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXXI', 48, '0000-00-00', '0000-00-00', '2014-09-08', '2014-09-12', '0000-00-00', '0000-00-00', 29, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1177, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXXIV', 48, '0000-00-00', '0000-00-00', '2014-09-22', '2014-09-26', '0000-00-00', '0000-00-00', 29, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1178, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXXV', 48, '0000-00-00', '0000-00-00', '2014-09-22', '2014-09-26', '0000-00-00', '0000-00-00', 29, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1179, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XXXVII', 48, '0000-00-00', '0000-00-00', '2014-10-06', '2014-10-10', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1180, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XL', 48, '0000-00-00', '0000-00-00', '2014-10-20', '2014-10-24', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1181, 0, 'Diklat AKSI UKI (Kelas Reguler) Angkt. XLI', 48, '0000-00-00', '0000-00-00', '2014-10-20', '2014-10-24', '0000-00-00', '0000-00-00', 25, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1182, 0, 'Diklat Anti Money Laundering dan Asset Tracing Tingkat Dasar Angkt. II (Itjen)', 30, '0000-00-00', '0000-00-00', '2014-02-03', '2014-02-05', '0000-00-00', '0000-00-00', 30, 0, '', '', '0000-00-00 00:00:00', '', '[READY]', 1),
(1183, 0, 'Diklat Calon Widyaiswara (Program Khusus) Angkt. II', 12, '0000-00-00', '0000-00-00', '2014-12-31', '2014-12-31', '0000-00-00', '0000-00-00', 22, 0, '', '', '0000-00-00 00:00:00', '', '[CANCEL]', 1),
(1184, 0, 'Diklat Calon Widyaiswara (Program Khusus) Angkt. II', 15, '2014-12-31', '2014-12-31', '2014-03-13', '2014-03-14', '0000-00-00', '0000-00-00', 22, 0, '', '#HAPUS', '0000-00-00 00:00:00', '', '[CANCEL]', 1),
(1185, 0, 'Workshop Lets Fly', 12, '2014-03-13', '2014-03-14', '2014-02-22', '2014-02-23', '0000-00-00', '0000-00-00', 15, 0, '', 'ND revisi 5 --&#62; nomor diupdate jo', '0000-00-00 00:00:00', '', '[READY]', 1),
(1186, 0, 'GDLN Distance Learning Seminar Series I', 16, '0000-00-00', '0000-00-00', '2014-04-19', '2014-07-26', '0000-00-00', '0000-00-00', 20, 0, '', '#4 sesi Vicon pada tanggal 19042014, 16042014, 14052014, 04062014', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1187, 0, 'GDLN Distance Learning Seminar Series I', 16, '0000-00-00', '0000-00-00', '2014-07-31', '2014-11-01', '0000-00-00', '0000-00-00', 20, 0, '', '#tanggal tentatif', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1188, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. XI', 15, '0000-00-00', '0000-00-00', '2014-02-24', '2014-02-26', '0000-00-00', '0000-00-00', 30, 0, '', 'Khusus DJP, diselenggarakan di Hotel Grand Cempaka', '0000-00-00 00:00:00', '', '[READY]', 1),
(1189, 0, 'Workshop AKSI UKI (Kelas Manajerial) Angkt. XII', 15, '0000-00-00', '0000-00-00', '2014-02-24', '2014-02-26', '0000-00-00', '0000-00-00', 30, 0, '', 'Khusus DJP, diselenggarakan di Hotel Grand Cempaka', '0000-00-00 00:00:00', '', '[READY]', 1),
(1190, 0, 'Orientasi Ekonometrika Tingkat Dasar Angk. I', 37, '0000-00-00', '0000-00-00', '2014-04-14', '2014-04-17', '0000-00-00', '0000-00-00', 20, 0, '', 'DIKLAT PERMINTAAN BARU #ND-173/PP.7.2/2014', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1191, 0, 'Orientasi Ekonometrika Tingkat Dasar Angk. II', 36, '0000-00-00', '0000-00-00', '2014-09-15', '2014-09-18', '0000-00-00', '0000-00-00', 20, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1192, 0, 'Orientasi Ekonometrika Tingkat Dasar Angk. II', 37, '0000-00-00', '0000-00-00', '2014-09-15', '2014-09-18', '0000-00-00', '0000-00-00', 20, 0, '', '#ND-173/PP.7.2/2014 Permintaan Diklat Baru', '0000-00-00 00:00:00', '', '[CANCEL]', 1),
(1193, 0, 'ddddd dfdfdfd', 0, '0000-00-00', '0000-00-00', '2014-03-01', '2014-03-01', '0000-00-00', '0000-00-00', 0, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1194, 0, 'asdasdasdasdasdasdasdasda sus', 0, '0000-00-00', '0000-00-00', '2014-03-01', '2014-03-01', '0000-00-00', '0000-00-00', 0, 0, '', '', '0000-00-00 00:00:00', '', '[PLAN]', 1),
(1195, 2147483647, 'jsdjiifjiajiabbb ', 5, '2014-09-11', '2014-08-06', '2014-09-23', '2014-09-24', '2014-09-24', '2014-09-25', 40, 35, 'bogor', 'gjguuufjjjjtjtudjxjxxjfjgjgu', '2014-09-03 01:35:49', 'wida', '', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tb_activity_room`
--
ALTER TABLE `tb_activity_room`
  ADD CONSTRAINT `tb_activity_room_ibfk_1` FOREIGN KEY (`tb_room_id`) REFERENCES `tb_room` (`id`);

--
-- Constraints for table `tb_authassignment`
--
ALTER TABLE `tb_authassignment`
  ADD CONSTRAINT `tb_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `tb_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_authitemchild`
--
ALTER TABLE `tb_authitemchild`
  ADD CONSTRAINT `tb_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tb_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tb_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_employee`
--
ALTER TABLE `tb_employee`
  ADD CONSTRAINT `fk_tb_employee_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`),
  ADD CONSTRAINT `fk_tb_employee_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`),
  ADD CONSTRAINT `fk_tb_employee_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`),
  ADD CONSTRAINT `fk_tb_employee_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`),
  ADD CONSTRAINT `fk_tb_employee_ref_sta_unit1` FOREIGN KEY (`ref_sta_unit_id`) REFERENCES `ref_sta_unit` (`id`),
  ADD CONSTRAINT `fk_tb_employee_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`);

--
-- Constraints for table `tb_meeting`
--
ALTER TABLE `tb_meeting`
  ADD CONSTRAINT `tb_meeting_ibfk_1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `fk_tb_program_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`);

--
-- Constraints for table `tb_program_document`
--
ALTER TABLE `tb_program_document`
  ADD CONSTRAINT `fk_tb_program_document_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program_history`
--
ALTER TABLE `tb_program_history`
  ADD CONSTRAINT `tb_program_history_ibfk_1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_history_ibfk_2` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`);

--
-- Constraints for table `tb_program_subject`
--
ALTER TABLE `tb_program_subject`
  ADD CONSTRAINT `fk_tb_program_subject_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_subject_ibfk_1` FOREIGN KEY (`ref_subject_type_id`) REFERENCES `ref_subject_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_program_subject_document`
--
ALTER TABLE `tb_program_subject_document`
  ADD CONSTRAINT `tb_program_subject_document_ibfk_1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program_subject_history`
--
ALTER TABLE `tb_program_subject_history`
  ADD CONSTRAINT `tb_program_subject_history_ibfk_1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_program_subject_history_ibfk_2` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_room`
--
ALTER TABLE `tb_room`
  ADD CONSTRAINT `fk_tb_room_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_satker_pic`
--
ALTER TABLE `tb_satker_pic`
  ADD CONSTRAINT `fk_tb_satker_pic_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`);

--
-- Constraints for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD CONSTRAINT `fk_tb_student_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`),
  ADD CONSTRAINT `fk_tb_student_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`);

--
-- Constraints for table `tb_trainer`
--
ALTER TABLE `tb_trainer`
  ADD CONSTRAINT `fk_tb_trainer_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`),
  ADD CONSTRAINT `fk_tb_trainer_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`),
  ADD CONSTRAINT `fk_tb_trainer_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`);

--
-- Constraints for table `tb_training`
--
ALTER TABLE `tb_training`
  ADD CONSTRAINT `fk_tb_training_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`),
  ADD CONSTRAINT `fk_tb_training_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`);

--
-- Constraints for table `tb_training_class`
--
ALTER TABLE `tb_training_class`
  ADD CONSTRAINT `tb_training_class_ibfk_1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_class_student`
--
ALTER TABLE `tb_training_class_student`
  ADD CONSTRAINT `tb_training_class_student_ibfk_3` FOREIGN KEY (`tb_training_class_id`) REFERENCES `tb_training_class` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_class_student_ibfk_5` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_class_student_ibfk_6` FOREIGN KEY (`tb_training_student_id`) REFERENCES `tb_training_student` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_class_student_attendance`
--
ALTER TABLE `tb_training_class_student_attendance`
  ADD CONSTRAINT `tb_training_class_student_attendance_ibfk_1` FOREIGN KEY (`tb_training_schedule_id`) REFERENCES `tb_training_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_class_student_attendance_ibfk_2` FOREIGN KEY (`tb_training_class_student_id`) REFERENCES `tb_training_class_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_class_student_certificate`
--
ALTER TABLE `tb_training_class_student_certificate`
  ADD CONSTRAINT `fk_tb_training_certificate_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`),
  ADD CONSTRAINT `fk_tb_training_certificate_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`),
  ADD CONSTRAINT `fk_tb_training_certificate_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`),
  ADD CONSTRAINT `fk_tb_training_certificate_tb_training1` FOREIGN KEY (`tb_training_class_student_id`) REFERENCES `tb_training_class_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_class_subject`
--
ALTER TABLE `tb_training_class_subject`
  ADD CONSTRAINT `tb_training_class_subject_ibfk_1` FOREIGN KEY (`tb_training_class_id`) REFERENCES `tb_training_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_class_subject_ibfk_2` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_document`
--
ALTER TABLE `tb_training_document`
  ADD CONSTRAINT `fk_tb_training_document_tb_training1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_execution_evaluation`
--
ALTER TABLE `tb_training_execution_evaluation`
  ADD CONSTRAINT `tb_training_execution_evaluation_ibfk_1` FOREIGN KEY (`tb_training_class_student_id`) REFERENCES `tb_training_class_student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_history`
--
ALTER TABLE `tb_training_history`
  ADD CONSTRAINT `tb_training_history_ibfk_1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_history_ibfk_2` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`),
  ADD CONSTRAINT `tb_training_history_ibfk_3` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`);

--
-- Constraints for table `tb_training_schedule`
--
ALTER TABLE `tb_training_schedule`
  ADD CONSTRAINT `tb_training_schedule_ibfk_3` FOREIGN KEY (`tb_training_class_id`) REFERENCES `tb_training_class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_schedule_trainer`
--
ALTER TABLE `tb_training_schedule_trainer`
  ADD CONSTRAINT `tb_training_schedule_trainer_ibfk_1` FOREIGN KEY (`tb_training_schedule_id`) REFERENCES `tb_training_schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_schedule_trainer_ibfk_2` FOREIGN KEY (`tb_trainer_id`) REFERENCES `tb_trainer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_schedule_trainer_ibfk_3` FOREIGN KEY (`ref_trainer_type_id`) REFERENCES `ref_trainer_type` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_schedule_trainer_attendance`
--
ALTER TABLE `tb_training_schedule_trainer_attendance`
  ADD CONSTRAINT `tb_training_schedule_trainer_attendance_ibfk_1` FOREIGN KEY (`tb_training_schedule_trainer_id`) REFERENCES `tb_training_schedule_trainer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_student`
--
ALTER TABLE `tb_training_student`
  ADD CONSTRAINT `tb_training_student_ibfk_1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_student_ibfk_2` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_training_subject_trainer_recommendation`
--
ALTER TABLE `tb_training_subject_trainer_recommendation`
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_3` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`),
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_4` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_5` FOREIGN KEY (`tb_trainer_id`) REFERENCES `tb_trainer` (`id`),
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_6` FOREIGN KEY (`ref_trainer_type_id`) REFERENCES `ref_trainer_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_unit_plan`
--
ALTER TABLE `tb_training_unit_plan`
  ADD CONSTRAINT `fk_tb_training_student_spread_plan_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_training_unit_plan_ibfk_1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
