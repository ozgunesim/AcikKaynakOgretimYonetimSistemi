-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2017 at 12:32 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtk473`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_codes`
--

CREATE TABLE `activation_codes` (
  `activation_code` char(32) NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_courses`
--

CREATE TABLE `assigned_courses` (
  `assign_id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auths`
--

CREATE TABLE `auths` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auths`
--

INSERT INTO `auths` (`auth_id`, `auth_name`) VALUES
(1, 'Sistem Yöneticisi'),
(2, 'Öğretmen'),
(3, 'Öğrenci');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `lesson_id` int(11) NOT NULL,
  `lesson_code` char(3) NOT NULL,
  `lesson_name` varchar(120) NOT NULL,
  `practice_hours` int(11) NOT NULL,
  `theoric_hours` int(11) NOT NULL,
  `akts` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`lesson_id`, `lesson_code`, `lesson_name`, `practice_hours`, `theoric_hours`, `akts`, `department`) VALUES
(13, '222', 'özgün bilimi', 2, 3, 5, 18),
(14, '223', 'özgün bilimi 2', 2, 3, 5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_code` int(11) NOT NULL,
  `department_acronym` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_code`, `department_acronym`) VALUES
(1, 341, 'ADE'),
(2, 451, 'ADÖ'),
(3, 359, 'AEM'),
(4, 305, 'AİT'),
(5, 391, 'AKE'),
(6, 381, 'AKT'),
(7, 302, 'ALM'),
(8, 410, 'AMY'),
(9, 304, 'ANA'),
(10, 533, 'ANE'),
(11, 352, 'ANT'),
(12, 502, 'ARK'),
(13, 372, 'ARŞ'),
(14, 396, 'BBY'),
(15, 530, 'BED'),
(16, 361, 'BES'),
(17, 314, 'BİK'),
(18, 356, 'BİL'),
(19, 321, 'BİO'),
(20, 443, 'BİO'),
(21, 516, 'BİS'),
(22, 456, 'BTÖ'),
(23, 390, 'BUS'),
(24, 425, 'BYS'),
(25, 366, 'ÇGE'),
(26, 315, 'ÇİN'),
(27, 312, 'DİŞ'),
(28, 432, 'DKM'),
(29, 371, 'DOK'),
(30, 416, 'DPT'),
(31, 452, 'EBB'),
(32, 313, 'ECF'),
(33, 374, 'ECO'),
(34, 347, 'EKO'),
(35, 357, 'ELE'),
(36, 431, 'ELK'),
(37, 437, 'ELT'),
(38, 430, 'EMY'),
(39, 445, 'EÖD'),
(40, 448, 'EPÖ'),
(41, 485, 'ETM'),
(42, 565, 'EVE'),
(43, 365, 'EVİ'),
(44, 447, 'EYD'),
(45, 316, 'FAR'),
(46, 457, 'FBÖ'),
(47, 342, 'FDE'),
(48, 450, 'FDÖ'),
(49, 453, 'FEB'),
(50, 354, 'FEL'),
(51, 441, 'FİÖ'),
(52, 334, 'DİZ'),
(53, 512, 'FMT'),
(54, 303, 'FRA'),
(55, 362, 'FTR'),
(56, 340, 'FZY'),
(57, 373, 'GMÜ'),
(58, 462, 'GRA'),
(59, 532, 'GSM'),
(60, 382, 'HAS'),
(61, 438, 'HBR'),
(62, 363, 'HEM'),
(63, 463, 'HEY'),
(64, 358, 'HİD'),
(65, 438, 'HBR'),
(66, 363, 'HEM'),
(67, 463, 'HEY'),
(68, 358, 'HİD'),
(69, 360, 'HİS'),
(70, 429, 'HKT'),
(71, 415, 'HRK'),
(72, 497, 'INR'),
(73, 465, 'İÇT'),
(74, 351, 'İDB'),
(75, 449, 'İDÖ'),
(76, 343, 'İED'),
(77, 458, 'İMÖ'),
(78, 511, 'İMT'),
(79, 301, 'İNG'),
(80, 412, 'İNŞ'),
(81, 426, 'İNT'),
(82, 497, 'İNR'),
(83, 455, 'İSÖ'),
(84, 329, 'İST'),
(85, 434, 'İŞL'),
(86, 433, 'İŞT'),
(87, 355, 'İYB'),
(88, 337, 'JEO'),
(89, 496, 'KAY'),
(90, 333, 'KİM'),
(91, 442, 'KİÖ'),
(92, 591, 'KMG'),
(93, 592, 'KMİ'),
(94, 593, 'KMM'),
(95, 594, 'KMS'),
(96, 335, 'KMÜ'),
(97, 590, 'KMY'),
(98, 470, 'KON'),
(99, 370, 'KÜT'),
(100, 495, 'MAB'),
(101, 338, 'MAD'),
(102, 394, 'MAK'),
(103, 804, 'MAT'),
(104, 393, 'MDM'),
(105, 388, 'MEB'),
(106, 436, 'MHB'),
(107, 309, 'MİK'),
(108, 328, 'MTK'),
(109, 444, 'MTÖ'),
(110, 428, 'MUB'),
(111, 414, 'MUH'),
(112, 386, 'NEM'),
(113, 542, 'ODY'),
(114, 492, 'OFM'),
(115, 491, 'OKL'),
(116, 387, 'PAT'),
(117, 571, 'PDP'),
(118, 446, 'PDR'),
(119, 581, 'PİN'),
(120, 582, 'PMU'),
(121, 580, 'PMY'),
(122, 543, 'PRO'),
(123, 570, 'PSH'),
(124, 344, 'PSİ'),
(125, 572, 'PTD'),
(126, 541, 'RAD'),
(127, 461, 'RES'),
(128, 404, 'RST'),
(129, 503, 'SAN'),
(130, 522, 'SBB'),
(131, 521, 'SBE'),
(132, 523, 'SBR'),
(133, 459, 'SBT'),
(134, 411, 'SEK'),
(135, 464, 'SER'),
(136, 546, 'SHH'),
(137, 395, 'SHO'),
(138, 375, 'SİD'),
(139, 402, 'SMY'),
(140, 345, 'SOS'),
(141, 353, 'TAR'),
(142, 349, 'TDE'),
(143, 544, 'TDS'),
(144, 501, 'THB'),
(145, 311, 'TIP'),
(146, 490, 'TKD'),
(147, 545, 'TLA'),
(148, 403, 'TOR'),
(149, 427, 'TRO'),
(150, 413, 'TUR'),
(151, 531, 'YDE'),
(152, 424, 'YHÖ'),
(153, 422, 'YİŞ'),
(154, 421, 'YMD'),
(155, 423, 'YMH'),
(156, 420, 'ZMY'),
(158, 901, '???');

-- --------------------------------------------------------

--
-- Table structure for table `enrolments`
--

CREATE TABLE `enrolments` (
  `enrol_id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `assigned_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `assigned_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `result_id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `honours`
--

CREATE TABLE `honours` (
  `honour_id` int(11) NOT NULL,
  `honour_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `honours`
--

INSERT INTO `honours` (`honour_id`, `honour_name`) VALUES
(1, 'Araştırma Görevlisi'),
(2, 'Doçent'),
(3, 'Profesör'),
(4, 'Yardımcı Doçent'),
(5, 'Ordinaryus'),
(7, 'Çevirmen'),
(8, 'Okutman'),
(9, 'Öğretim Görevlisi'),
(10, 'Uzman');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(11) NOT NULL,
  `notice_text` varchar(400) NOT NULL,
  `notice_sender` int(11) NOT NULL,
  `notice_type` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `notice_text`, `notice_sender`, `notice_type`) VALUES
(31, 'deneme duuyuasursa', 97, '2'),
(32, 'duyuru 2', 97, '1');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `teacher` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `q_parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `s_user_id` int(11) NOT NULL,
  `number` char(8) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`s_user_id`, `number`, `department`) VALUES
(76, '21221437', 108),
(77, '21228602', 18),
(78, '21320664', 108),
(79, '21320736', 108),
(80, '21321053', 108),
(81, '21321177', 108),
(82, '21321182', 108),
(83, '21321273', 108),
(84, '21321307', 108),
(85, '21346157', 77),
(86, '21420807', 108),
(88, '21500652', 108),
(89, '21520643', 108),
(90, '21608491', 77),
(91, '29952129', 158),
(92, '29960124', 158),
(127, '21420864', 108);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `t_user_id` int(11) NOT NULL,
  `biography` text NOT NULL,
  `honour` int(11) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`t_user_id`, `biography`, `honour`, `department`) VALUES
(97, 'deneme bio', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_mail` varchar(100) NOT NULL,
  `user_pw` char(32) NOT NULL,
  `user_auth` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `isActive` char(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_mail`, `user_pw`, `user_auth`, `user_name`, `isActive`) VALUES
(76, 'ozlem_ucyildiz@hotmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'ÖZLEM ÜÇYILDIZ', '1'),
(77, 'hiledinozer@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'HİLEDİN ÖZER', '1'),
(78, 'birsen.can@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'BİRSEN YAĞAN', '1'),
(79, 'busra.celik@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'BÜŞRA ÇELİK', '1'),
(80, 'mervenur.kuyumcu@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'MERVENUR KUYUMCU', '1'),
(81, 'burcu.393@hotmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'ASENA BURCU ÖZSÖYLER', '1'),
(82, 'gamze.ozturk@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'GAMZE NAZ ÖZTÜRK', '1'),
(83, 'fatma.tok@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'FATMA TOK', '1'),
(84, 'merve_tunc29@hotmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'MERVE TUNÇ', '1'),
(85, 'zeynep.turan@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'ZEYNEP TURAN', '1'),
(86, 'rabia.gunduz@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'RABİA GÜNDÜZ', '1'),
(88, 'aybek.muradov.ma@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'AIBEK MURADOV', '1'),
(89, 'ezgimgsli@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'EZGİ HAN ERYÜKSEL', '1'),
(90, 'meyma.krdmr@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'ŞEYMA KIRDEMİR', '1'),
(91, 'ggzderdogan@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'GÖZDE ERDOĞAN', '1'),
(92, 'koray.danisma@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'KORAY SEYFULLAH DANIŞMA', '1'),
(97, 'ozgunesim@gmail.com', 'c21f969b5f03d33d43e04f8f136e7682', 1, 'Salazar Slytherin', '0'),
(127, 'ethem.ilhan@hacettepe.edu.tr', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'ETHEM EMİR İLHAN', '1');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_programs`
--

CREATE TABLE `weekly_programs` (
  `prog_id` int(11) NOT NULL,
  `lesson` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `week_count` int(11) NOT NULL DEFAULT '12'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD KEY `user` (`user`);

--
-- Indexes for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `lesson` (`course`),
  ADD KEY `teacher` (`teacher`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `auths`
--
ALTER TABLE `auths`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`lesson_id`),
  ADD UNIQUE KEY `lesson_code` (`lesson_code`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD PRIMARY KEY (`enrol_id`),
  ADD KEY `student` (`student`),
  ADD KEY `assigned_course` (`assigned_course`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `assigned_course` (`assigned_course`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `exam` (`exam`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `honours`
--
ALTER TABLE `honours`
  ADD PRIMARY KEY (`honour_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `notice_sender` (`notice_sender`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD KEY `s_user_id` (`s_user_id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD KEY `t_user_id` (`t_user_id`),
  ADD KEY `honour` (`honour`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`),
  ADD KEY `user_auth` (`user_auth`);

--
-- Indexes for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  ADD PRIMARY KEY (`prog_id`),
  ADD KEY `lesson` (`lesson`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auths`
--
ALTER TABLE `auths`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `enrolments`
--
ALTER TABLE `enrolments`
  MODIFY `enrol_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `honours`
--
ALTER TABLE `honours`
  MODIFY `honour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  MODIFY `prog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD CONSTRAINT `activation_codes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  ADD CONSTRAINT `assigned_courses_ibfk_1` FOREIGN KEY (`course`) REFERENCES `courses` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_courses_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`att_id`) REFERENCES `weekly_programs` (`prog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department`) REFERENCES `departments` (`department_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `enrolments`
--
ALTER TABLE `enrolments`
  ADD CONSTRAINT `enrolments_ibfk_2` FOREIGN KEY (`student`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolments_ibfk_3` FOREIGN KEY (`assigned_course`) REFERENCES `assigned_courses` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`assigned_course`) REFERENCES `assigned_courses` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_2` FOREIGN KEY (`student`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_results_ibfk_3` FOREIGN KEY (`exam`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`notice_sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`student`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `student_info_ibfk_2` FOREIGN KEY (`department`) REFERENCES `departments` (`department_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `student_info_ibfk_3` FOREIGN KEY (`s_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD CONSTRAINT `teacher_info_ibfk_1` FOREIGN KEY (`honour`) REFERENCES `honours` (`honour_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_info_ibfk_2` FOREIGN KEY (`department`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_info_ibfk_3` FOREIGN KEY (`t_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_auth`) REFERENCES `auths` (`auth_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  ADD CONSTRAINT `weekly_programs_ibfk_1` FOREIGN KEY (`lesson`) REFERENCES `courses` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
