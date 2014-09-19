-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2014 at 11:48 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sms`
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
