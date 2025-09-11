-- Adminer 4.8.1 MySQL 10.6.23-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employeement_type_preferences`;
CREATE TABLE `employeement_type_preferences` (
  `emp_prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_type` text NOT NULL,
  `sub_prefer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`emp_prefer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `employeement_type_preferences` (`emp_prefer_id`, `emp_type`, `sub_prefer_id`, `created_at`, `updated_at`) VALUES
(1,	'Permanent',	0,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(2,	'Temporary',	0,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(3,	'Permanent & Temporary',	0,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(4,	'Full-time (Permanent)',	1,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(5,	'Part-time (Permanent)',	1,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(6,	'Agency Nurse / Midwife (Permanent)',	1,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(7,	'Staffing Agency Nurse (Permanent)',	1,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(8,	'Private Healthcare Agency Nurse (Permanent)',	1,	'2025-03-27 09:58:25',	'2025-03-27 09:58:25'),
(9,	'Freelance (Permanent)',	1,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(10,	'Self-Employed (Permanent)',	1,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(11,	'Private Practice (Permanent)',	1,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(12,	'Volunteer (Permanent)',	1,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(13,	'Full-time (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(14,	'Part-time (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(15,	'Agency Nurse/Midwife (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(16,	'Staffing Agency Nurse (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(17,	'Private Healthcare Agency Nurse (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(18,	'Travel',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(19,	'Per Diem (Daily Basis)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(20,	'Float Pool & Relief Nursing (Multi-Department Work)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(21,	'On-Call (Immediate Availability)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(22,	'PRN (Pro Re Nata /As Needed)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(23,	'Casual',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(24,	'Locum tenens (temporary substitute)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(25,	'Seasonal (Short-Term for Peak Demand)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(26,	'Freelance (Temporary)',	2,	'2025-03-27 09:58:26',	'2025-03-27 09:58:26'),
(27,	'Self-Employed (Temporary)',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(28,	'Private Practice (Temporary)',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(29,	'Internship',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(30,	'Apprenticeship',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(31,	'Residency',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(32,	'Volunteer (Temporary)',	2,	'2025-03-27 09:58:27',	'2025-03-27 09:58:27'),
(33,	'Full-time (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(34,	'Part-time (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(35,	'Full-time (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(36,	'Part-time (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(37,	'Agency Nurse / Midwife (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(38,	'Staffing Agency Nurse (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(39,	'Private Healthcare Agency Nurse (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(40,	'Agency Nurse/Midwife (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(41,	'Staffing Agency Nurse (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(42,	'Private Healthcare Agency Nurse (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(43,	'Travel',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(44,	'Per Diem (Daily Basis)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(45,	'Float Pool & Relief Nursing (Multi-Department Work)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(46,	'On-Call (Immediate Availability)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(47,	'PRN (Pro Re Nata /As Needed)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(48,	'Casual',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(49,	'Locum tenens (temporary substitute)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(50,	'Seasonal (Short-Term for Peak Demand)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(51,	'Freelance (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(52,	'Self-Employed (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(53,	'Private Practice (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(54,	'Freelance (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(55,	'Self-Employed (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(56,	'Private Practice (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(57,	'Internship',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(58,	'Apprenticeship',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(59,	'Residency',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(60,	'Volunteer (Permanent)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21'),
(61,	'Volunteer (Temporary)',	3,	'2025-03-28 08:37:21',	'2025-03-28 08:37:21');

-- 2025-09-11 05:47:30
