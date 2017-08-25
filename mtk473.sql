-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2017 at 08:22 PM
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
CREATE DATABASE IF NOT EXISTS `mtk473` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mtk473`;

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
-- Table structure for table `assigned_course_data`
--

CREATE TABLE `assigned_course_data` (
  `acd_id` int(11) NOT NULL,
  `assigned_course` int(11) NOT NULL,
  `type` char(1) NOT NULL COMMENT '1: teorik ; 2: pratik'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assigned_course_data`
--

INSERT INTO `assigned_course_data` (`acd_id`, `assigned_course`, `type`) VALUES
(57, 45, '1'),
(58, 45, '1'),
(59, 45, '1'),
(60, 45, '2'),
(61, 45, '2'),
(62, 46, '1'),
(63, 46, '1'),
(64, 46, '1'),
(65, 46, '2'),
(66, 46, '2'),
(67, 47, '1'),
(68, 47, '1'),
(69, 47, '1'),
(70, 47, '2'),
(71, 47, '2');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_courses`
--

CREATE TABLE `assigned_courses` (
  `assign_id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `teacher` int(11) NOT NULL,
  `subclass` int(11) NOT NULL COMMENT 'ders subesi anlamina geliyor. 0 ise ortak sinif.',
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assigned_courses`
--

INSERT INTO `assigned_courses` (`assign_id`, `course`, `teacher`, `subclass`, `semester`) VALUES
(45, 14, 128, 1, 4),
(46, 14, 128, 2, 4),
(47, 18, 128, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `att_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `state` char(1) NOT NULL DEFAULT '0',
  `assigned_course_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `student_id`, `date`, `hour`, `state`, `assigned_course_data`) VALUES
(156, 130, '2017-09-11', '09:00:00', '1', 57),
(170, 130, '2017-09-11', '10:00:00', '1', 58),
(184, 130, '2017-09-11', '13:00:00', '1', 60),
(198, 130, '2017-09-11', '14:00:00', '1', 61),
(268, 130, '2017-09-15', '12:00:00', '1', 59),
(282, 130, '2017-09-22', '12:00:00', '1', 59),
(296, 130, '2017-09-29', '12:00:00', '1', 59),
(311, 130, '2017-09-18', '09:00:00', '0', 57),
(312, 130, '2017-09-18', '10:00:00', '0', 58),
(313, 130, '2017-09-18', '13:00:00', '0', 60),
(314, 130, '2017-09-18', '14:00:00', '0', 61),
(315, 130, '2017-09-25', '09:00:00', '0', 57),
(316, 130, '2017-09-25', '10:00:00', '0', 58),
(317, 130, '2017-09-25', '13:00:00', '0', 60),
(318, 130, '2017-09-25', '14:00:00', '0', 61);

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
  `practice_hours` tinyint(4) NOT NULL,
  `theoric_hours` tinyint(4) NOT NULL,
  `akts` tinyint(4) NOT NULL,
  `department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`lesson_id`, `lesson_code`, `lesson_name`, `practice_hours`, `theoric_hours`, `akts`, `department`) VALUES
(14, '223', 'Doğa Bilimi', 2, 3, 5, 18),
(15, '654', 'ASDFASF', 3, 3, 6, 1),
(16, '421', 'denemeeee', 2, 3, 5, 16),
(18, '432', 'deneme dersi sonnnnnn', 2, 3, 5, 18);

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
  `assigned_course` int(11) NOT NULL,
  `course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolments`
--

INSERT INTO `enrolments` (`enrol_id`, `student`, `assigned_course`, `course`) VALUES
(23, 130, 45, 14),
(24, 130, 47, 18);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `result_id` int(11) NOT NULL,
  `exam` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `result` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`result_id`, `exam`, `student`, `result`) VALUES
(141, 11, 130, 100);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `assigned_course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_name`, `assigned_course`) VALUES
(11, 'deneme sınavııı', 45);

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message_content` varchar(400) NOT NULL,
  `state` char(1) NOT NULL DEFAULT '1' COMMENT '1:okunmadi | 0:okundu',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `receiver`, `message_content`, `state`, `timestamp`) VALUES
(29, 128, 128, 'fhfdjhdfjfd', '0', '2017-08-22 02:19:53'),
(37, 130, 128, 'bak bakalım', '0', '2017-08-22 19:34:22'),
(45, 130, 128, 'selam hocaaa', '0', '2017-08-24 19:14:45'),
(47, 128, 130, 'deneme sonnn', '0', '2017-08-24 19:15:56'),
(48, 130, 128, 'sonn', '0', '2017-08-24 19:17:51'),
(49, 130, 128, 'asdfff', '0', '2017-08-24 19:17:56'),
(50, 130, 128, 'gsdagsadga', '0', '2017-08-24 19:17:58'),
(51, 128, 130, 'afdsas', '0', '2017-08-24 19:19:18'),
(52, 130, 128, 'asdsafasdg', '0', '2017-08-24 19:19:32'),
(53, 130, 128, 'safsadf', '0', '2017-08-24 19:19:35'),
(55, 130, 128, 'sfasfsdagsa', '0', '2017-08-24 20:32:54');

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
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `courses_start_date` date NOT NULL,
  `courses_end_date` date NOT NULL,
  `end_date` date NOT NULL,
  `semester_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `start_date`, `courses_start_date`, `courses_end_date`, `end_date`, `semester_name`) VALUES
(4, '2017-08-03', '2017-09-11', '2018-01-12', '2018-01-26', '2017 - 2018 Güz Dönemi');

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
(130, '23333232', 6);

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
(128, 'özgeçmiş deneme', 9, 18);

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
(97, 'yonetici@deneme.com', 'c21f969b5f03d33d43e04f8f136e7682', 1, 'Deneme YÖNETİCİ', '1'),
(128, 'ogretmen@deneme.com', 'c21f969b5f03d33d43e04f8f136e7682', 2, 'Deneme ÖĞRETMEN', '0'),
(130, 'ogrenci@deneme.com', 'c21f969b5f03d33d43e04f8f136e7682', 3, 'Deneme ÖĞRENCİ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_program_data`
--

CREATE TABLE `weekly_program_data` (
  `p_data_id` int(11) NOT NULL,
  `program` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `assigned_course_data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_program_data`
--

INSERT INTO `weekly_program_data` (`p_data_id`, `program`, `day`, `hour`, `assigned_course_data`) VALUES
(170, 24, 0, 0, 57),
(171, 24, 0, 1, 58),
(172, 24, 0, 4, 60),
(173, 24, 0, 5, 61),
(174, 24, 1, 3, 62),
(175, 24, 2, 2, 63),
(176, 24, 2, 3, 64),
(177, 24, 2, 5, 65),
(178, 24, 2, 6, 66),
(179, 24, 3, 1, 67),
(180, 24, 3, 2, 68),
(181, 24, 3, 3, 69),
(182, 24, 3, 5, 70),
(183, 24, 3, 6, 71),
(184, 24, 4, 3, 59);

-- --------------------------------------------------------

--
-- Table structure for table `weekly_programs`
--

CREATE TABLE `weekly_programs` (
  `prog_id` int(11) NOT NULL,
  `teacher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weekly_programs`
--

INSERT INTO `weekly_programs` (`prog_id`, `teacher`) VALUES
(24, 128);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD KEY `user` (`user`);

--
-- Indexes for table `assigned_course_data`
--
ALTER TABLE `assigned_course_data`
  ADD PRIMARY KEY (`acd_id`),
  ADD KEY `assigned_course` (`assigned_course`);

--
-- Indexes for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  ADD PRIMARY KEY (`assign_id`),
  ADD KEY `lesson` (`course`),
  ADD KEY `teacher` (`teacher`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `assigned_course_data` (`assigned_course_data`);

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
  ADD KEY `assigned_course` (`assigned_course`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `exam` (`exam`),
  ADD KEY `student` (`student`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `assigned_course` (`assigned_course`);

--
-- Indexes for table `honours`
--
ALTER TABLE `honours`
  ADD PRIMARY KEY (`honour_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `receiver` (`receiver`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `notice_sender` (`notice_sender`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`);

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
-- Indexes for table `weekly_program_data`
--
ALTER TABLE `weekly_program_data`
  ADD PRIMARY KEY (`p_data_id`),
  ADD KEY `assigned_course` (`program`),
  ADD KEY `assigned_course_2` (`assigned_course_data`);

--
-- Indexes for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  ADD PRIMARY KEY (`prog_id`),
  ADD KEY `lesson` (`teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_course_data`
--
ALTER TABLE `assigned_course_data`
  MODIFY `acd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;
--
-- AUTO_INCREMENT for table `auths`
--
ALTER TABLE `auths`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `enrolments`
--
ALTER TABLE `enrolments`
  MODIFY `enrol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `honours`
--
ALTER TABLE `honours`
  MODIFY `honour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `weekly_program_data`
--
ALTER TABLE `weekly_program_data`
  MODIFY `p_data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  MODIFY `prog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD CONSTRAINT `activation_codes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigned_course_data`
--
ALTER TABLE `assigned_course_data`
  ADD CONSTRAINT `assigned_course_data_ibfk_1` FOREIGN KEY (`assigned_course`) REFERENCES `assigned_courses` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigned_courses`
--
ALTER TABLE `assigned_courses`
  ADD CONSTRAINT `assigned_courses_ibfk_1` FOREIGN KEY (`course`) REFERENCES `courses` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_courses_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigned_courses_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `semesters` (`semester_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`assigned_course_data`) REFERENCES `assigned_course_data` (`acd_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `enrolments_ibfk_3` FOREIGN KEY (`assigned_course`) REFERENCES `assigned_courses` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrolments_ibfk_4` FOREIGN KEY (`course`) REFERENCES `courses` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_3` FOREIGN KEY (`exam`) REFERENCES `exams` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_results_ibfk_4` FOREIGN KEY (`student`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`assigned_course`) REFERENCES `assigned_courses` (`assign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`notice_sender`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `weekly_program_data`
--
ALTER TABLE `weekly_program_data`
  ADD CONSTRAINT `weekly_program_data_ibfk_1` FOREIGN KEY (`program`) REFERENCES `weekly_programs` (`prog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `weekly_program_data_ibfk_2` FOREIGN KEY (`assigned_course_data`) REFERENCES `assigned_course_data` (`acd_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `weekly_programs`
--
ALTER TABLE `weekly_programs`
  ADD CONSTRAINT `weekly_programs_ibfk_1` FOREIGN KEY (`teacher`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
