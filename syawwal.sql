-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2014 at 09:43 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Table structure for table `ref_level`
--

CREATE TABLE IF NOT EXISTS `ref_level` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `groups` int(1) NOT NULL DEFAULT '1' COMMENT '0:ADMIN;1:GENERAL;2:PLANNING;3:EXECUTION;4:EVALUATION;',
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ref_level`
--

INSERT INTO `ref_level` (`id`, `name`, `role`, `groups`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 'Administrator', 'admin', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `ref_level_id`, `ref_satker_id`, `tb_employee_id`, `username`, `password`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 1, 0, 1, 'admin', '$2a$13$byV6fF7bZGd5J6k80Rzulu37cyytQIN3HzaAJuJFaUFVOJeRPKtSG', 1, NULL, NULL, '2014-04-18 10:22:14', 1, NULL, 0);

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
  `position` varchar(255) DEFAULT '-',
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_employee`
--

INSERT INTO `tb_employee` (`id`, `ref_satker_id`, `ref_unit_id`, `ref_religion_id`, `ref_rank_class_id`, `ref_graduate_id`, `ref_sta_unit_id`, `name`, `nickName`, `frontTitle`, `backTitle`, `nip`, `born`, `birthDay`, `gender`, `phone`, `email`, `address`, `married`, `photo`, `blood`, `position`, `education`, `officePhone`, `officeFax`, `officeEmail`, `officeAddress`, `document1`, `document2`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `user_id`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `bio`, `website`) VALUES
(1, 3, 0, 0, 0, 0, 10000, 'Hafid Mukhlasin', 'Hafid', 'Dr', 'MIT', '198604302009011002', 'Jember', '2014-04-11', 1, '081559915720', 'milisstudio@gmail.com', '', 1, '', '-', '-', '', '', '', '', '', '', '', 1, NULL, NULL, '2014-08-11 16:16:00', 1, NULL, NULL, 1, 'haasfasfasfis@gmail.com', '', 'd41d8cd98f00b204e9800998ecf8427e', 'asdasdasd', '', 'http://hasdasdasdafis.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_notification`
--

CREATE TABLE IF NOT EXISTS `tb_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
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
  `hours` int(5) DEFAULT NULL,
  `days` int(3) DEFAULT NULL,
  `test` tinyint(1) DEFAULT '0',
  `type` tinyint(1) DEFAULT NULL COMMENT 'tipe kelulusan (lulus/mengikuti)',
  `note` varchar(255) DEFAULT NULL,
  `validationStatus` tinyint(1) DEFAULT '0',
  `validationNote` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_program_ref_satker1` (`ref_satker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id`, `ref_satker_id`, `number`, `name`, `hours`, `days`, `test`, `type`, `note`, `validationStatus`, `validationNote`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI XX', 100, NULL, 0, 0, '', 0, '', 0, '2014-08-15 14:05:05', 1, '2014-08-15 14:08:27', 1, NULL, NULL),
(4, 3, '2.2.1.0', 'PRANATA KOMPUTER AHLI', NULL, NULL, 0, 0, '', 0, '', 1, '2014-08-20 09:42:32', 1, '2014-08-21 13:46:36', 1, NULL, NULL);

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
  `hours` int(5) DEFAULT NULL,
  `days` int(3) DEFAULT NULL,
  `test` tinyint(1) DEFAULT '0',
  `type` int(1) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `validationStatus` tinyint(1) DEFAULT '0',
  `validationNote` varchar(255) DEFAULT NULL,
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

INSERT INTO `tb_program_history` (`tb_program_id`, `revision`, `ref_satker_id`, `number`, `name`, `hours`, `days`, `test`, `type`, `note`, `validationStatus`, `validationNote`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(3, 0, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI', 100, NULL, 0, 0, '', 0, '', 0, '2014-08-15 14:05:05', 1, '2014-08-15 14:07:56', 1, NULL, NULL),
(3, 1, 1, '2.2.1.0', 'DIKLAT PRANATA KOMPUTER AHLI XX', 100, NULL, 0, 0, '', 0, '', 0, '2014-08-15 14:08:27', 1, '2014-08-15 14:08:27', 1, NULL, NULL),
(4, 0, 3, '2.2.1.0', 'PRANATA KOMPUTER AHLI', NULL, NULL, 0, 0, '', 0, '', 1, '2014-08-20 09:42:32', 1, '2014-08-21 13:46:36', 1, NULL, NULL),
(4, 1, 3, '2.2.1.0', 'PRANATA KOMPUTER AHLI', NULL, NULL, 0, 0, '', 0, '', 1, '2014-08-20 16:00:26', 1, '2014-08-20 16:00:26', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_program_subject`
--

CREATE TABLE IF NOT EXISTS `tb_program_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1: MP;2: CERAMAH;3:OJT;4:MFD;',
  `name` varchar(255) NOT NULL,
  `hours` int(3) NOT NULL COMMENT 'KAP, GBPP, SILABI',
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
  KEY `fk_tb_program_subject_tb_program1` (`tb_program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_program_subject`
--

INSERT INTO `tb_program_subject` (`id`, `tb_program_id`, `type`, `name`, `hours`, `sort`, `test`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 4, 0, 'PHP', 10, 0, 0, 1, '2014-08-20 13:20:57', 1, '2014-08-22 07:46:41', 1, NULL, NULL);

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
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1: MP;2: CERAMAH;3:OJT;4:MFD;',
  `name` varchar(255) NOT NULL,
  `hours` int(3) NOT NULL COMMENT 'KAP, GBPP, SILABI',
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

INSERT INTO `tb_program_subject_history` (`tb_program_subject_id`, `tb_program_id`, `revision`, `type`, `name`, `hours`, `sort`, `test`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`) VALUES
(1, 4, 0, 0, 'PHP', 10, 0, 0, 1, '2014-08-20 13:20:57', 1, '2014-08-20 13:20:57', 1, NULL, NULL),
(1, 4, 1, 0, 'PHP', 10, 0, 0, 1, '2014-08-20 16:00:27', 1, '2014-08-20 16:00:27', 1, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_trainer`
--

CREATE TABLE IF NOT EXISTS `tb_trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `position` varchar(255) DEFAULT NULL,
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
  KEY `fk_tb_trainer_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_trainer_ref_rank_class1` (`ref_rank_class_id`),
  KEY `fk_tb_trainer_ref_religion1` (`ref_religion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training`
--

CREATE TABLE IF NOT EXISTS `tb_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_id` int(11) NOT NULL,
  `tb_program_revision` int(11) NOT NULL,
  `ref_satker_id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` date DEFAULT NULL,
  `finish` date DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_training`
--

INSERT INTO `tb_training` (`id`, `tb_program_id`, `tb_program_revision`, `ref_satker_id`, `name`, `start`, `finish`, `note`, `studentCount`, `classCount`, `executionSK`, `resultSK`, `costPlan`, `costRealisation`, `sourceCost`, `hostel`, `reguler`, `stakeholder`, `location`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `approvedStatus`, `approvedStatusNote`, `approvedStatusDate`, `approvedStatusBy`) VALUES
(1, 4, 1, 3, 'DIKLAT PRANATA KOMPUTER AHLI AKT I', '2014-08-22', '2014-08-15', 'Oke dah', NULL, NULL, '', '', NULL, NULL, '', 0, 0, '', '', 0, '2014-08-22 11:55:15', 1, '2014-08-22 14:23:58', 1, NULL, NULL, 0, '', NULL, NULL),
(2, 4, 1, 3, 'DIKLAT PRANATA KOMPUTER AHLI KHUSUS SETJEN', '2013-08-06', '2013-08-14', '', NULL, NULL, '', '', NULL, NULL, '', 0, 0, '', '', 1, '2014-08-22 14:17:16', 1, '2014-08-22 14:23:14', 1, NULL, NULL, 0, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_certificate`
--

CREATE TABLE IF NOT EXISTS `tb_training_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `ref_unit_id` int(3) NOT NULL DEFAULT '0',
  `ref_graduate_id` int(3) NOT NULL DEFAULT '0',
  `ref_rank_class_id` int(3) NOT NULL DEFAULT '0',
  `number` varchar(50) DEFAULT NULL,
  `seri` varchar(50) DEFAULT NULL,
  `date` tinyint(1) DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_certificate_tb_training1` (`tb_training_id`),
  KEY `fk_tb_training_certificate_tb_student1` (`tb_student_id`),
  KEY `fk_tb_training_certificate_ref_unit1` (`ref_unit_id`),
  KEY `fk_tb_training_certificate_ref_graduate1` (`ref_graduate_id`),
  KEY `fk_tb_training_certificate_ref_rank_class1` (`ref_rank_class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class`
--

CREATE TABLE IF NOT EXISTS `tb_training_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training` int(11) NOT NULL,
  `class` int(3) NOT NULL DEFAULT '0' COMMENT '0-25',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_room`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `tb_room_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `createdBy` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tb_room_id` (`tb_room_id`),
  KEY `tb_training_id` (`tb_training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_student`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `activity` decimal(5,2) DEFAULT '1.00' COMMENT 'NILAI AKTIFITAS',
  `test` decimal(5,2) DEFAULT NULL COMMENT 'Nilai Ujian',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_subject_student_tb_training_assignment1` (`tb_training_class_id`),
  KEY `fk_tb_training_subject_student_tb_student1` (`tb_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_class_subject_assignment`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_subject_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `hours` int(3) NOT NULL COMMENT 'Jamlat Per Sesi',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training_class_subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Table structure for table `tb_training_class_subject_trainer`
--

CREATE TABLE IF NOT EXISTS `tb_training_class_subject_trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_class_subject_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
  `type` int(1) NOT NULL COMMENT '1:pengajar;2:penceramah;3:asisten',
  `cost` int(11) NOT NULL COMMENT 'honor perjamlat',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_assignment_tb_training_subject1` (`tb_training_class_subject_id`),
  KEY `fk_tb_training_assignment_tb_trainer1` (`tb_trainer_id`)
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
  `tb_training_student_id` int(11) NOT NULL,
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
  KEY `fk_tb_training_execution_evaluation_tb_training_student1` (`tb_training_student_id`)
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
  `name` varchar(255) NOT NULL,
  `start` date DEFAULT NULL,
  `finish` date DEFAULT NULL,
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
  `approvedStatus` tinyint(1) NOT NULL,
  `approvedStatusNote` varchar(255) NOT NULL,
  `approvedStatusDate` datetime NOT NULL,
  `approvedStatusBy` int(11) NOT NULL,
  KEY `fk_tb_training_tb_program1` (`tb_program_id`),
  KEY `fk_tb_training_ref_satker1` (`ref_satker_id`),
  KEY `tb_training_id` (`tb_training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_training_history`
--

INSERT INTO `tb_training_history` (`tb_training_id`, `tb_program_id`, `tb_program_revision`, `revision`, `ref_satker_id`, `name`, `start`, `finish`, `note`, `studentCount`, `classCount`, `executionSK`, `resultSK`, `costPlan`, `costRealisation`, `sourceCost`, `hostel`, `reguler`, `stakeholder`, `location`, `status`, `created`, `createdBy`, `modified`, `modifiedBy`, `deleted`, `deletedBy`, `approvedStatus`, `approvedStatusNote`, `approvedStatusDate`, `approvedStatusBy`) VALUES
(0, 1, 0, 0, 5, 'Diklat Intelejen Tingkat Dasar Angkatan I', '2014-04-21', '2014-04-25', '', NULL, NULL, '', '', NULL, NULL, '', 1, 1, 'BPPK', '-', 1, '2014-04-18 14:33:44', 1, NULL, NULL, NULL, NULL, 0, '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_pic`
--

CREATE TABLE IF NOT EXISTS `tb_training_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `tb_admin_id` int(11) NOT NULL,
  `type` int(3) DEFAULT '0' COMMENT '1-3:GENERAL;4-6:PLANNING;7-8:EXECUTION;9-11:EVALUATION;12:WIDYAISWARA',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_pic_tb_training1` (`tb_training_id`),
  KEY `fk_tb_training_pic_tb_admin1` (`tb_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_schedule`
--

CREATE TABLE IF NOT EXISTS `tb_training_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_assignment_id` int(11) NOT NULL,
  `tb_room_id` int(3) NOT NULL,
  `activity` varchar(255) DEFAULT NULL COMMENT 'Honor untuk PIC/JP',
  `pic` varchar(100) DEFAULT NULL COMMENT '0-25',
  `date` date DEFAULT NULL,
  `hours` int(3) DEFAULT NULL COMMENT '1JP = 45menit',
  `startTime` time DEFAULT NULL,
  `finishTime` time DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_schedule_tb_training_assignment1` (`tb_training_assignment_id`),
  KEY `fk_tb_training_schedule_tb_room1` (`tb_room_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_student`
--

CREATE TABLE IF NOT EXISTS `tb_training_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_assignment_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `ref_unit_id` int(3) NOT NULL,
  `ref_rank_class_id` int(3) NOT NULL,
  `ref_graduate_id` int(3) NOT NULL,
  `number` varchar(255) DEFAULT NULL COMMENT 'NPP',
  `class` int(3) NOT NULL DEFAULT '0',
  `headClass` tinyint(1) DEFAULT '0',
  `activity` decimal(5,2) DEFAULT NULL,
  `presence` decimal(5,2) DEFAULT NULL,
  `pretest` decimal(5,2) DEFAULT NULL,
  `posttest` decimal(5,2) DEFAULT NULL,
  `test` decimal(5,2) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `eselon2` varchar(45) DEFAULT NULL,
  `eselon3` varchar(45) DEFAULT NULL,
  `eselon4` varchar(45) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1:AKTIF;2:MENGUNDRKAN DIRI;3:DIGANTI',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_student_tb_training_assignment1` (`tb_training_assignment_id`),
  KEY `fk_tb_training_student_tb_student1` (`tb_student_id`),
  KEY `fk_tb_training_student_ref_unit1` (`ref_unit_id`),
  KEY `fk_tb_training_student_ref_rank_class1` (`ref_rank_class_id`),
  KEY `fk_tb_training_student_ref_graduate1` (`ref_graduate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_student_attendance`
--

CREATE TABLE IF NOT EXISTS `tb_training_student_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_schedule_id` int(11) NOT NULL,
  `tb_student_id` int(11) NOT NULL,
  `hours` int(3) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_student_attendance_tb_training_schedule1` (`tb_training_schedule_id`),
  KEY `fk_tb_training_student_attendance_tb_student1` (`tb_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_subject`
--

CREATE TABLE IF NOT EXISTS `tb_training_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1: MP;2: CERAMAH;3:OJT;4:MFD;',
  `name` varchar(255) NOT NULL,
  `hours` int(3) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `order` int(3) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Diujikan nggak?',
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_subject_tb_training1` (`tb_training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_subject_document`
--

CREATE TABLE IF NOT EXISTS `tb_training_subject_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_program_subject_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` int(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_subject_document_tb_training_subject1` (`tb_program_subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_subject_trainer_recommendation`
--

CREATE TABLE IF NOT EXISTS `tb_training_subject_trainer_recommendation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training` int(11) NOT NULL,
  `tb_program_subject_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1:PENGAJAR;2:PENCERAMAH;3:ASISTEN',
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
  KEY `fk_tb_training_subject_trainer_recommendation_tb_trainer1` (`tb_trainer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_trainer_attendance`
--

CREATE TABLE IF NOT EXISTS `tb_training_trainer_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_schedule_id` int(11) NOT NULL,
  `tb_trainer_id` int(11) NOT NULL,
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
  KEY `fk_tb_training_trainer_attendance_tb_training_schedule1` (`tb_training_schedule_id`),
  KEY `fk_tb_training_trainer_attendance_tb_trainer1` (`tb_trainer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_trainer_evaluation`
--

CREATE TABLE IF NOT EXISTS `tb_training_trainer_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_student_id` int(11) NOT NULL,
  `tb_training_assignment_id` int(11) NOT NULL,
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
  KEY `fk_tb_training_trainer_evaluation_tb_training_assignment1` (`tb_training_assignment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_training_unit_plan`
--

CREATE TABLE IF NOT EXISTS `tb_training_unit_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tb_training_id` int(11) NOT NULL,
  `ref_unit_id` int(3) NOT NULL,
  `spread` varchar(500) NOT NULL COMMENT 'KAP, GBPP, SILABI',
  `total` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `deletedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tb_training_student_spread_plan_tb_training1` (`tb_training_id`),
  KEY `fk_tb_training_student_spread_plan_ref_unit1` (`ref_unit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmation_token`, `confirmation_sent_at`, `confirmed_at`, `unconfirmed_email`, `recovery_token`, `recovery_sent_at`, `blocked_at`, `role`, `registered_from`, `logged_in_from`, `logged_in_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$13$xOnFV4B5NGTJpu1P/qy03Owrkx6j/35dZJR6gPNscLSV2A6kR98fa', '_ZSeDwI6bRSftr4iK42GukuBrWgvHjwz', NULL, NULL, 1405729304, NULL, NULL, NULL, NULL, '', 2130706433, 2130706433, 1408073996, 1405728264, 1408073996);

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
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `fk_tb_admin_ref_level1` FOREIGN KEY (`ref_level_id`) REFERENCES `ref_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_admin_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_admin_tb_employee1` FOREIGN KEY (`tb_employee_id`) REFERENCES `tb_employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_tb_employee_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_employee_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_employee_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_employee_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_employee_ref_sta_unit1` FOREIGN KEY (`ref_sta_unit_id`) REFERENCES `ref_sta_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_employee_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD CONSTRAINT `fk_tb_program_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_program_document`
--
ALTER TABLE `tb_program_document`
  ADD CONSTRAINT `fk_tb_program_document_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_program_subject`
--
ALTER TABLE `tb_program_subject`
  ADD CONSTRAINT `fk_tb_program_subject_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_program_subject_document`
--
ALTER TABLE `tb_program_subject_document`
  ADD CONSTRAINT `tb_program_subject_document_ibfk_1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_room`
--
ALTER TABLE `tb_room`
  ADD CONSTRAINT `fk_tb_room_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_satker_pic`
--
ALTER TABLE `tb_satker_pic`
  ADD CONSTRAINT `fk_tb_satker_pic_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD CONSTRAINT `fk_tb_student_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_student_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_student_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_student_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_trainer`
--
ALTER TABLE `tb_trainer`
  ADD CONSTRAINT `fk_tb_trainer_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_trainer_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_trainer_ref_religion1` FOREIGN KEY (`ref_religion_id`) REFERENCES `ref_religion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training`
--
ALTER TABLE `tb_training`
  ADD CONSTRAINT `fk_tb_training_ref_satker1` FOREIGN KEY (`ref_satker_id`) REFERENCES `ref_satker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_tb_program1` FOREIGN KEY (`tb_program_id`) REFERENCES `tb_program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_certificate`
--
ALTER TABLE `tb_training_certificate`
  ADD CONSTRAINT `fk_tb_training_certificate_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_certificate_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_certificate_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_certificate_tb_student1` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_certificate_tb_training1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_class_room`
--
ALTER TABLE `tb_training_class_room`
  ADD CONSTRAINT `tb_training_class_room_ibfk_2` FOREIGN KEY (`tb_room_id`) REFERENCES `tb_room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_training_class_room_ibfk_1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_class_student`
--
ALTER TABLE `tb_training_class_student`
  ADD CONSTRAINT `tb_training_class_student_ibfk_1` FOREIGN KEY (`tb_training_class_id`) REFERENCES `tb_training_class_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_training_class_student_ibfk_2` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_class_subject`
--
ALTER TABLE `tb_training_class_subject`
  ADD CONSTRAINT `fk_tb_training_assignment_tb_trainer1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_trainer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_assignment_tb_training_subject1` FOREIGN KEY (`tb_training_class_id`) REFERENCES `tb_training_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_document`
--
ALTER TABLE `tb_training_document`
  ADD CONSTRAINT `fk_tb_training_document_tb_training1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_execution_evaluation`
--
ALTER TABLE `tb_training_execution_evaluation`
  ADD CONSTRAINT `fk_tb_training_execution_evaluation_tb_training_student1` FOREIGN KEY (`tb_training_student_id`) REFERENCES `tb_training_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_pic`
--
ALTER TABLE `tb_training_pic`
  ADD CONSTRAINT `fk_tb_training_pic_tb_admin1` FOREIGN KEY (`tb_admin_id`) REFERENCES `tb_admin` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_pic_tb_training1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_student`
--
ALTER TABLE `tb_training_student`
  ADD CONSTRAINT `fk_tb_training_student_ref_graduate1` FOREIGN KEY (`ref_graduate_id`) REFERENCES `ref_graduate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_ref_rank_class1` FOREIGN KEY (`ref_rank_class_id`) REFERENCES `ref_rank_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_tb_student1` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_tb_training_assignment1` FOREIGN KEY (`tb_training_assignment_id`) REFERENCES `tb_training_class_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_student_attendance`
--
ALTER TABLE `tb_training_student_attendance`
  ADD CONSTRAINT `fk_tb_training_student_attendance_tb_student1` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_attendance_tb_training_schedule1` FOREIGN KEY (`tb_training_schedule_id`) REFERENCES `tb_training_schedule` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_subject_document`
--
ALTER TABLE `tb_training_subject_document`
  ADD CONSTRAINT `fk_tb_training_subject_document_tb_training_subject1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_training_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_subject_trainer_recommendation`
--
ALTER TABLE `tb_training_subject_trainer_recommendation`
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_1` FOREIGN KEY (`tb_program_subject_id`) REFERENCES `tb_program_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_training_subject_trainer_recommendation_ibfk_2` FOREIGN KEY (`tb_trainer_id`) REFERENCES `tb_trainer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_trainer_attendance`
--
ALTER TABLE `tb_training_trainer_attendance`
  ADD CONSTRAINT `fk_tb_training_trainer_attendance_tb_trainer1` FOREIGN KEY (`tb_trainer_id`) REFERENCES `tb_trainer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_trainer_evaluation`
--
ALTER TABLE `tb_training_trainer_evaluation`
  ADD CONSTRAINT `fk_tb_training_trainer_evaluation_tb_student1` FOREIGN KEY (`tb_student_id`) REFERENCES `tb_student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_trainer_evaluation_tb_training_assignment1` FOREIGN KEY (`tb_training_assignment_id`) REFERENCES `tb_training_class_subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_training_unit_plan`
--
ALTER TABLE `tb_training_unit_plan`
  ADD CONSTRAINT `fk_tb_training_student_spread_plan_ref_unit1` FOREIGN KEY (`ref_unit_id`) REFERENCES `ref_unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_training_student_spread_plan_tb_training1` FOREIGN KEY (`tb_training_id`) REFERENCES `tb_training` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
