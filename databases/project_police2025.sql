-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 05:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_police2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`d_id`, `d_name`, `user_id`) VALUES
(1, 'ກົມໃຫຍ່ພາລາທິການ', 4),
(2, 'ກົມໃຫຍ່ການເມືອງ', 4),
(44, 'ກອງພັນ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `distict`
--

CREATE TABLE `distict` (
  `dis_id` int(5) NOT NULL,
  `dis_name` varchar(50) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `distict`
--

INSERT INTO `distict` (`dis_id`, `dis_name`, `pro_id`, `user_id`) VALUES
(1, 'ປະທຸມພອນ', 1, 1),
(4, 'ໄຊທານີ', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `ed_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `name_level` varchar(100) NOT NULL,
  `paiy_in` varchar(100) NOT NULL,
  `kanangvixah` varchar(100) NOT NULL,
  `ladub` varchar(100) NOT NULL,
  `live_study` varchar(100) NOT NULL,
  `study_year` varchar(100) NOT NULL,
  `year_to_year` varchar(100) NOT NULL,
  `lang_english` varchar(100) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`ed_id`, `officer_id`, `name_level`, `paiy_in`, `kanangvixah`, `ladub`, `live_study`, `study_year`, `year_to_year`, `lang_english`, `user_id`) VALUES
(1, 1, 'a', 'a', 'a', 'ກໍ່ສ້າງ', 'a', 'a', 'a', 'a', 1),
(2, 1, 'b', 'b', 'b', 'ບຳລຸງ', 'b', 'b', 'b', 'b', 1),
(3, 1, 'c', 'c', 'c', 'ກໍ່ສ້າງ', 'c', 'c', 'c', 'c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `family_relations`
--

CREATE TABLE `family_relations` (
  `relation_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `pro_id` int(5) NOT NULL,
  `dis_id` int(5) NOT NULL,
  `v_id` int(5) NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `workplace` varchar(100) DEFAULT NULL,
  `number_of_children` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_pgks` tinyint(1) DEFAULT NULL,
  `transfer_date` date DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `department_center` varchar(100) DEFAULT NULL,
  `graduation_date` date DEFAULT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `father_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `pro_id` int(5) NOT NULL,
  `dis_id` int(5) NOT NULL,
  `v_id` int(5) NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `workplace` varchar(100) DEFAULT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level_up`
--

CREATE TABLE `level_up` (
  `level_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `level_date` date NOT NULL,
  `date_office` date NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `level_up`
--

INSERT INTO `level_up` (`level_id`, `officer_id`, `l_id`, `o_id`, `pk_id`, `u_id`, `pt_id`, `level_date`, `date_office`, `user_id`) VALUES
(1, 13, 6, 1, 1, 1, 3, '2024-08-01', '2025-08-29', 1),
(2, 13, 7, 1, 1, 1, 1, '2025-08-29', '2025-08-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mothers`
--

CREATE TABLE `mothers` (
  `father_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `pro_id` int(5) NOT NULL,
  `dis_id` int(5) NOT NULL,
  `v_id` int(5) NOT NULL,
  `occupation` varchar(100) DEFAULT NULL,
  `workplace` varchar(100) DEFAULT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `office`
--

CREATE TABLE `office` (
  `o_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `o_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `office`
--

INSERT INTO `office` (`o_id`, `d_id`, `o_name`, `user_id`) VALUES
(1, 1, 'ຫ້ອງການ', 4),
(2, 2, 'ກົມການເມືອງ/', 4),
(3, 44, 'ພາລາ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `officer_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `full_lastname` varchar(100) NOT NULL,
  `alias_name` varchar(50) DEFAULT NULL,
  `gender` enum('ຊາຍ','ຍິງ') DEFAULT 'ຊາຍ',
  `status_persions` varchar(30) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `date_level` datetime NOT NULL,
  `serial_number` varchar(50) DEFAULT NULL,
  `pro_id` int(5) NOT NULL,
  `dis_id` int(5) NOT NULL,
  `v_id` int(5) NOT NULL,
  `numberphone` varchar(40) NOT NULL,
  `current_village` varchar(50) DEFAULT NULL,
  `current_district` varchar(50) DEFAULT NULL,
  `current_province` varchar(50) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `road` varchar(100) DEFAULT NULL,
  `block` varchar(50) DEFAULT NULL,
  `id_card_number` varchar(20) DEFAULT NULL,
  `ethnicity` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `confirm_number` varchar(20) DEFAULT NULL,
  `date_join_revolution` date DEFAULT NULL,
  `date_join_police` date DEFAULT NULL,
  `date_join_army` date DEFAULT NULL,
  `date_join_party` date DEFAULT NULL,
  `backup_party_id` varchar(20) DEFAULT NULL,
  `date_join` date DEFAULT NULL,
  `full_party_id` varchar(20) DEFAULT NULL,
  `date_join_youth` date DEFAULT NULL,
  `date_join_women` date DEFAULT NULL,
  `date_join_union` date DEFAULT NULL,
  `party_position` varchar(100) DEFAULT NULL,
  `state_position` varchar(100) DEFAULT NULL,
  `culture_level` varchar(100) DEFAULT NULL,
  `foreign_language` varchar(100) DEFAULT NULL,
  `lalup_pks` varchar(100) DEFAULT NULL,
  `paiyin` varchar(100) DEFAULT NULL,
  `kananghien` varchar(100) DEFAULT NULL,
  `labup` varchar(100) DEFAULT NULL,
  `school_one` varchar(100) DEFAULT NULL,
  `pihien` varchar(20) DEFAULT NULL,
  `p_p` varchar(20) DEFAULT NULL,
  `level_as` varchar(100) DEFAULT NULL,
  `language_as` varchar(100) DEFAULT NULL,
  `kananghien_as` varchar(100) DEFAULT NULL,
  `labup_as` varchar(100) DEFAULT NULL,
  `school_as` varchar(100) DEFAULT NULL,
  `pihien_as` varchar(20) DEFAULT NULL,
  `p_p_as` varchar(20) DEFAULT NULL,
  `level_m` varchar(100) DEFAULT NULL,
  `kananghien_m` varchar(100) DEFAULT NULL,
  `labup_m` varchar(100) DEFAULT NULL,
  `school_m` varchar(100) DEFAULT NULL,
  `pihien_m` varchar(20) DEFAULT NULL,
  `p_p_m` varchar(20) DEFAULT NULL,
  `system_status` varchar(50) DEFAULT NULL,
  `file_document` varchar(50) DEFAULT NULL,
  `photo_img` text NOT NULL,
  `ffull_name` varchar(100) DEFAULT NULL,
  `fage` int(11) DEFAULT NULL,
  `fproname` varchar(100) NOT NULL,
  `fdisname` varchar(100) NOT NULL,
  `fvillagename` varchar(100) NOT NULL,
  `foccupation` varchar(100) DEFAULT NULL,
  `fworkplace` varchar(100) DEFAULT NULL,
  `fzonpao` varchar(50) NOT NULL,
  `mfull_name` varchar(100) DEFAULT NULL,
  `mage` int(11) DEFAULT NULL,
  `mproname` varchar(100) NOT NULL,
  `mdisname` varchar(100) NOT NULL,
  `mvillagename` varchar(100) NOT NULL,
  `moccupation` varchar(100) DEFAULT NULL,
  `mworkplace` varchar(100) DEFAULT NULL,
  `mzonpao` varchar(50) NOT NULL,
  `falyfull_name` varchar(100) DEFAULT NULL,
  `falybirth_date` date DEFAULT NULL,
  `falyages` varchar(30) NOT NULL,
  `falyzonpao` varchar(20) NOT NULL,
  `falyzozun` varchar(30) NOT NULL,
  `falyzadsana` varchar(30) NOT NULL,
  `falyproname` varchar(100) NOT NULL,
  `falydisname` varchar(100) NOT NULL,
  `falyvillagename` varchar(100) NOT NULL,
  `falyoccupation` varchar(100) DEFAULT NULL,
  `falylive` varchar(100) NOT NULL,
  `falyworkplace` varchar(100) DEFAULT NULL,
  `family_date` date NOT NULL,
  `falynumber_of_children` int(11) DEFAULT NULL,
  `falyphone` varchar(20) DEFAULT NULL,
  `falynotes` text DEFAULT NULL,
  `is_pgks` varchar(100) DEFAULT NULL,
  `office_date` date DEFAULT NULL,
  `reference_number` varchar(50) DEFAULT NULL,
  `department_center` varchar(100) DEFAULT NULL,
  `graduation_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`officer_id`, `d_id`, `u_id`, `pk_id`, `o_id`, `l_id`, `pt_id`, `national_id`, `full_name`, `full_lastname`, `alias_name`, `gender`, `status_persions`, `birth_date`, `age`, `date_level`, `serial_number`, `pro_id`, `dis_id`, `v_id`, `numberphone`, `current_village`, `current_district`, `current_province`, `house_number`, `road`, `block`, `id_card_number`, `ethnicity`, `religion`, `confirm_number`, `date_join_revolution`, `date_join_police`, `date_join_army`, `date_join_party`, `backup_party_id`, `date_join`, `full_party_id`, `date_join_youth`, `date_join_women`, `date_join_union`, `party_position`, `state_position`, `culture_level`, `foreign_language`, `lalup_pks`, `paiyin`, `kananghien`, `labup`, `school_one`, `pihien`, `p_p`, `level_as`, `language_as`, `kananghien_as`, `labup_as`, `school_as`, `pihien_as`, `p_p_as`, `level_m`, `kananghien_m`, `labup_m`, `school_m`, `pihien_m`, `p_p_m`, `system_status`, `file_document`, `photo_img`, `ffull_name`, `fage`, `fproname`, `fdisname`, `fvillagename`, `foccupation`, `fworkplace`, `fzonpao`, `mfull_name`, `mage`, `mproname`, `mdisname`, `mvillagename`, `moccupation`, `mworkplace`, `mzonpao`, `falyfull_name`, `falybirth_date`, `falyages`, `falyzonpao`, `falyzozun`, `falyzadsana`, `falyproname`, `falydisname`, `falyvillagename`, `falyoccupation`, `falylive`, `falyworkplace`, `family_date`, `falynumber_of_children`, `falyphone`, `falynotes`, `is_pgks`, `office_date`, `reference_number`, `department_center`, `graduation_date`, `user_id`) VALUES
(1, 1, 1, 1, 1, 1, 1, '8888', 'ສົມສຸກ ', 'ສຸວັນນະລາດ', 'fgfd', 'ຊາຍ', 'ໂສດ', '2015-06-11', 0, '0000-00-00 00:00:00', 'fdg', 4, 4, 2, 'dfg', 'dfg', 'fdg', '', 'fgfd', 'dfg', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 'ປະຖົມ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ON', '68abd58d81767.pdf', '1271583343.jpg', '', 0, '0', '0', '0', '', '', '', '', 0, '0', '0', '0', '', '', '', '', '0000-00-00', '', '', '', '', '0', '0', '0', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 1),
(11, 44, 1, 1, 1, 10, 1, 'ຸຸ123', 'ສຸກ', 'ແສງວິຫານ', 'k', 'ຊາຍ', 'ໂສດ', '2025-08-28', 2025, '2019-01-23 00:00:00', '56676565', 4, 4, 2, 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', 'k', '', '', '2025-08-28', '2025-08-14', '2025-08-01', '2025-08-13', 's', '2025-08-14', 'k', '2025-08-03', '2025-08-12', '2025-08-14', 'k', 'k', 'ປະຖົມ', 'k', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'OUT', 'file_68afbfaaecc25.docx', '1312463460.jpg', '', 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', 'k', '2025-08-28', 1),
(12, 1, 1, 7, 2, 10, 1, '111', 'ແວວຕາ', '', '', 'ຍິງ', 'ໂສດ', '0000-00-00', 0, '0000-00-00 00:00:00', '', 4, 4, 2, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 'ປະຖົມ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ON', 'file_68b0408b47c2b.docx', '882033655.jpg', '', 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 1),
(13, 1, 1, 1, 1, 7, 1, '222', 'ແດງ', 'ພົມມະຈັນ', '', 'ຊາຍ', 'ໂສດ', '0000-00-00', 0, '0000-00-00 00:00:00', '', 4, 4, 2, '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '0000-00-00', '', '0000-00-00', '0000-00-00', '0000-00-00', '', '', 'ປະຖົມ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ON', 'file_68b09cfc0f800.pdf', '143060957.jpg', '', 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0, '', '', '', '0000-00-00', '', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `panak`
--

CREATE TABLE `panak` (
  `pk_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `pk_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `panak`
--

INSERT INTO `panak` (`pk_id`, `o_id`, `d_id`, `pk_name`, `user_id`) VALUES
(1, 1, 1, 'ຄະນະຫ້ອງການ', 4),
(2, 1, 1, 'ຄົ້ນຄວ້າສັງລວມ-ພົວພັນຕ່າງປະເທດ', 4),
(3, 1, 1, 'ຄຸ້ມຄອງເອກະສານແລະຂາເຂົ້າ-ຂາອອກ', 4),
(4, 1, 1, 'ບໍລິຫານ-ຈັດຕັ້ງ', 4),
(5, 1, 1, 'ການເງິນ', 4),
(6, 1, 1, 'ຄຸ້ມຄອງຊັບສິນ,ກໍ່ສ້າງ-ສ້ອມແປງ ແລະ ເຕັກນິກ', 4),
(7, 1, 1, 'ການຜະລິດ', 4),
(8, 1, 1, 'ສູນຮັບຕອນ ແລະ ຝຶກອົບຮົມວິຊາສະເພາະ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `pt_id` int(11) NOT NULL,
  `pt_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`pt_id`, `pt_name`, `user_id`) VALUES
(1, 'ຫົວໜ້າການທະຫານ', 1),
(2, 'ຫົວໜ້າການເມືອງ', 1),
(3, 'ຫົວໜ້າການທະຫານກ້ອງຮ້ອຍ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `positions_level`
--

CREATE TABLE `positions_level` (
  `l_id` int(11) NOT NULL,
  `l_name` varchar(250) NOT NULL,
  `l_img` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `positions_level`
--

INSERT INTO `positions_level` (`l_id`, `l_name`, `l_img`, `user_id`) VALUES
(1, 'ຊັ້ນII', 'user_68abcf56424ef4.15025577.jpg', 1),
(6, 'ຊັ້ນI', 'user_68afb6e0565445.49563942.jpg', 1),
(7, 'ສຕ', 'user_68afcc854a5196.69776071.jpg', 1),
(8, 'ສທ', 'user_68afcd9dc92d41.98572264.jpg', 1),
(9, 'ສອ', 'user_68b0401c1e8a65.39561372.jpg', 1),
(10, 'ວທ', 'user_68b040c039b0c7.68494196.jpg', 1),
(11, 'ຮຕ', 'user_68b053a350b3d3.88169878.jpg', 1),
(12, 'ຮທ', 'user_68b05747c13220.16473950.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `pro_id` int(5) NOT NULL,
  `pro_name` varchar(50) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`pro_id`, `pro_name`, `user_id`) VALUES
(1, ' ຈຳປາສັກ', 1),
(4, 'ນະຄອນຫລວງ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rank_position`
--

CREATE TABLE `rank_position` (
  `r_id` int(11) NOT NULL,
  `l_id` int(11) NOT NULL,
  `r_years` int(11) NOT NULL,
  `r_month` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rank_position`
--

INSERT INTO `rank_position` (`r_id`, `l_id`, `r_years`, `r_month`, `user_id`) VALUES
(1, 1, 0, 3, 1),
(2, 2, 2, 6, 1),
(3, 6, 1, 6, 1),
(4, 2, 1, 6, 1),
(5, 7, 1, 6, 1),
(6, 8, 1, 6, 1),
(7, 9, 2, 0, 1),
(8, 10, 2, 6, 1),
(9, 11, 3, 0, 1),
(10, 12, 3, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_records`
--

CREATE TABLE `transfer_records` (
  `tran_id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `transfer_tyep` enum('IN','OUT') DEFAULT NULL,
  `radson` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `transfer_date` date NOT NULL,
  `phone` varchar(30) NOT NULL,
  `remark` varchar(30) NOT NULL,
  `approved_by` varchar(100) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transfer_records`
--

INSERT INTO `transfer_records` (`tran_id`, `officer_id`, `transfer_tyep`, `radson`, `number`, `transfer_date`, `phone`, `remark`, `approved_by`, `user_id`) VALUES
(1, 11, 'OUT', '', '', '2025-08-28', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `u_id` int(11) NOT NULL,
  `pk_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `u_name` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`u_id`, `pk_id`, `o_id`, `d_id`, `u_name`, `user_id`) VALUES
(1, 1, 1, 1, 'ຄະນະຫ້ອງການ', 4),
(2, 2, 1, 1, 'ຄົ້ນຄວ້າ', 4),
(3, 17, 3, 44, 'ທົດສອບ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `dob_date` date NOT NULL,
  `gender` varchar(30) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `dis_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usphone` varchar(30) NOT NULL,
  `img` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `name`, `dob_date`, `gender`, `pro_id`, `dis_id`, `v_id`, `email`, `usphone`, `img`, `created_at`) VALUES
(1, 'p', '929872838cb9cfe6578e11f0a323438aee5ae7f61d41412d62db72b25dac52019de2d6a355eb2d033336fb70e73f0ec0afeca3ef36dd8a90d83f998fee23b78d', 'admin', 'p', '2025-07-10', 'ຊາຍ', 1, 3, 1, 'a@s', 'ດກເ', 'img_6873cdd1ce462.jpg', '2025-07-13 16:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `village`
--

CREATE TABLE `village` (
  `v_id` int(5) NOT NULL,
  `pro_id` int(5) NOT NULL,
  `dis_id` int(5) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `village`
--

INSERT INTO `village` (`v_id`, `pro_id`, `dis_id`, `v_name`, `user_id`) VALUES
(1, 1, 1, 'ນາກະສັງ', 1),
(2, 4, 4, 'ນາ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `distict`
--
ALTER TABLE `distict`
  ADD PRIMARY KEY (`dis_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`ed_id`);

--
-- Indexes for table `family_relations`
--
ALTER TABLE `family_relations`
  ADD PRIMARY KEY (`relation_id`);

--
-- Indexes for table `level_up`
--
ALTER TABLE `level_up`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`officer_id`);

--
-- Indexes for table `panak`
--
ALTER TABLE `panak`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`pt_id`);

--
-- Indexes for table `positions_level`
--
ALTER TABLE `positions_level`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `rank_position`
--
ALTER TABLE `rank_position`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `transfer_records`
--
ALTER TABLE `transfer_records`
  ADD PRIMARY KEY (`tran_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `village`
--
ALTER TABLE `village`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `distict`
--
ALTER TABLE `distict`
  MODIFY `dis_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `ed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `family_relations`
--
ALTER TABLE `family_relations`
  MODIFY `relation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level_up`
--
ALTER TABLE `level_up`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `officer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `panak`
--
ALTER TABLE `panak`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `pt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `positions_level`
--
ALTER TABLE `positions_level`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `pro_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rank_position`
--
ALTER TABLE `rank_position`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transfer_records`
--
ALTER TABLE `transfer_records`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `village`
--
ALTER TABLE `village`
  MODIFY `v_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
