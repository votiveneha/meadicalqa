-- Adminer 4.8.1 MySQL 10.6.23-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `additional_information`;
CREATE TABLE `additional_information` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `additional_info_language` text NOT NULL,
  `volunteer_experience` text NOT NULL,
  `hobbies_interests` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `additional_training`;
CREATE TABLE `additional_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `awards_recognitions`;
CREATE TABLE `awards_recognitions` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_name` text NOT NULL,
  `sub_award_id` int(11) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `awards_recognition_submission`;
CREATE TABLE `awards_recognition_submission` (
  `award_reg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `award_id` int(11) DEFAULT NULL,
  `sub_award_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`award_reg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `benefits_preferences`;
CREATE TABLE `benefits_preferences` (
  `benefits_id` int(11) NOT NULL AUTO_INCREMENT,
  `benefits_name` text DEFAULT NULL,
  `subbenefit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`benefits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_code_id` int(11) NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  `other` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numeric_code` char(3) DEFAULT NULL,
  `iso2` char(2) DEFAULT NULL,
  `phonecode` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `tld` varchar(255) DEFAULT NULL,
  `native` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `subregion` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `timezones` text DEFAULT NULL,
  `translations` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `emoji` varchar(191) DEFAULT NULL,
  `emojiU` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `degree`;
CREATE TABLE `degree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `edu_fields`;
CREATE TABLE `edu_fields` (
  `edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `acls_imgs` text DEFAULT NULL,
  `bls_imgs` text DEFAULT NULL,
  `cpr_imgs` text NOT NULL,
  `nrp_imgs` text DEFAULT NULL,
  `pls_imgs` text DEFAULT NULL,
  `rn_imgs` text DEFAULT NULL,
  `np_imgs` text DEFAULT NULL,
  `cn_imgs` text DEFAULT NULL,
  `lpn_imgs` text DEFAULT NULL,
  `crna_imgs` text DEFAULT NULL,
  `cnm_imgs` text DEFAULT NULL,
  `ons_imgs` text DEFAULT NULL,
  `msw_imgs` text DEFAULT NULL,
  `ain_imgs` text DEFAULT NULL,
  `rpn_imgs` text DEFAULT NULL,
  `well_imgs` text DEFAULT NULL,
  `tech_innvo_imgs` text DEFAULT NULL,
  `leader_pro_imgs` text NOT NULL,
  `mid_spec_imgs` text NOT NULL,
  `clinic_skill_imgs` text DEFAULT NULL,
  `eme_topic_imgs` text DEFAULT NULL,
  `safety_com_imgs` text DEFAULT NULL,
  `spec_area_imgs` text DEFAULT NULL,
  `mid_spe_imgs` text DEFAULT NULL,
  `core_man_imgs` text DEFAULT NULL,
  `other_tran_img` text DEFAULT NULL,
  `ano_education_imgs` text DEFAULT NULL,
  `ano_certifi_imgs` text DEFAULT NULL,
  PRIMARY KEY (`edu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `eligibility_to_work`;
CREATE TABLE `eligibility_to_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `residency` varchar(64) NOT NULL,
  `support_document` varchar(64) NOT NULL,
  `original_file_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `evidence_type` varchar(256) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `visa_subclass` int(11) DEFAULT NULL,
  `other_visa_type` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `visa_grant_number` varchar(255) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `emergency_contact`;
CREATE TABLE `emergency_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `emergency_contact` varchar(50) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `emergency_contact_code` varchar(10) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `employeement_type_preferences`;
CREATE TABLE `employeement_type_preferences` (
  `emp_prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_type` text NOT NULL,
  `sub_prefer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`emp_prefer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `employee_positions`;
CREATE TABLE `employee_positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` text NOT NULL,
  `subposition_id` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `evidance_file`;
CREATE TABLE `evidance_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vcc_front_id` int(11) NOT NULL,
  `original_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `file_name` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `evidence_type`;
CREATE TABLE `evidence_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `type` varchar(255) DEFAULT NULL,
  `dose` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `imm_status`;
CREATE TABLE `imm_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `interview_references`;
CREATE TABLE `interview_references` (
  `interview_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `interview_availablity` datetime NOT NULL,
  `reference_name` text NOT NULL,
  `reference_email` text NOT NULL,
  `contact_country_code` text NOT NULL,
  `contact_country_iso` text NOT NULL,
  `reference_contact` text NOT NULL,
  `reference_relationship` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`interview_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `job_apply`;
CREATE TABLE `job_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `job_boxes`;
CREATE TABLE `job_boxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nurse_type` text NOT NULL,
  `typeofspeciality` text DEFAULT NULL,
  `sector` text NOT NULL,
  `location_name` text DEFAULT NULL,
  `agency_name` text DEFAULT NULL,
  `experience_level` text DEFAULT NULL,
  `emplyeement_positions` text DEFAULT NULL,
  `emplyeement_type` text DEFAULT NULL,
  `shift_type` text DEFAULT NULL,
  `work_environment` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `salary` text DEFAULT NULL,
  `urgent_hire` int(11) DEFAULT NULL,
  `application_submission_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` text NOT NULL,
  `language_field` text NOT NULL,
  `sub_language_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `language_skills`;
CREATE TABLE `language_skills` (
  `language_skills_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `langprof_level` text DEFAULT NULL,
  `english_prof_cert` text DEFAULT NULL,
  `other_prof_cert` text DEFAULT NULL,
  `specialized_lang_skills` text DEFAULT NULL,
  `declare_info` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`language_skills_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `level_year`;
CREATE TABLE `level_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `mandatory_courses`;
CREATE TABLE `mandatory_courses` (
  `courses_id` int(11) NOT NULL AUTO_INCREMENT,
  `courses_certifications` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`courses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `mandatory_sub_courses`;
CREATE TABLE `mandatory_sub_courses` (
  `subcourses_id` int(11) NOT NULL AUTO_INCREMENT,
  `mandatory_courses_id` int(11) DEFAULT NULL,
  `subcourses` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`subcourses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `mandatory_training`;
CREATE TABLE `mandatory_training` (
  `train_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `institutions` text DEFAULT NULL,
  `continuing_education` text DEFAULT NULL,
  `man_training` text DEFAULT NULL,
  `man_education` text DEFAULT NULL,
  `well_sel_data` text DEFAULT NULL,
  `tech_innvo_data` text DEFAULT NULL,
  `leader_pro_data` text DEFAULT NULL,
  `mid_spec_data` text DEFAULT NULL,
  `clinic_skill_data` text DEFAULT NULL,
  `other_tra_data` text DEFAULT NULL,
  `emerg_topic_data` text DEFAULT NULL,
  `safety_com_data` text DEFAULT NULL,
  `spec_area_data` text DEFAULT NULL,
  `mid_spe_data` text DEFAULT NULL,
  `core_man_data` text DEFAULT NULL,
  `other_edu_data` text DEFAULT NULL,
  `training_data` text DEFAULT NULL,
  `education_data` text DEFAULT NULL,
  `declaration_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`train_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `man_training_category`;
CREATE TABLE `man_training_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `membership_type`;
CREATE TABLE `membership_type` (
  `membership_id` int(11) NOT NULL AUTO_INCREMENT,
  `membership_name` text NOT NULL,
  `submember_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`membership_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `ndis_screening_check`;
CREATE TABLE `ndis_screening_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `clearance_number` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `evidence_file` varchar(64) NOT NULL,
  `original_file_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `other_evidance`;
CREATE TABLE `other_evidance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `other_vcc_id` int(11) NOT NULL,
  `evidance_file` varchar(64) NOT NULL,
  `original_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `other_vaccine`;
CREATE TABLE `other_vaccine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vaccination_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `immunization_status` int(11) NOT NULL,
  `evidence_type` text NOT NULL,
  `evidence_file` varchar(64) NOT NULL,
  `is_declare` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_preferences`;
CREATE TABLE `personal_preferences` (
  `prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `preferred_work_schedule` text NOT NULL,
  `country` text NOT NULL,
  `state` int(11) NOT NULL,
  `specific_facilities` text NOT NULL,
  `work_environment` text NOT NULL,
  `shift_preferences` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`prefer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `police_check`;
CREATE TABLE `police_check` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `issuance_date` date DEFAULT NULL,
  `evidence_file` varchar(64) DEFAULT NULL,
  `original_file_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1-approve/2-reject',
  `is_declare` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `practitioner_type`;
CREATE TABLE `practitioner_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` varchar(255) NOT NULL DEFAULT '0' COMMENT 'if parent 0 speciality  else  sub speciality',
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `nurse_level_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `profession`;
CREATE TABLE `profession` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profession` int(11) NOT NULL,
  `practitioner_type` int(11) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `evidence_type` int(11) NOT NULL,
  `evidence_of_year_level` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('2','1','0') NOT NULL DEFAULT '0',
  `reason` varchar(250) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `professional_certificate`;
CREATE TABLE `professional_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordering_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `professional_certificate_table`;
CREATE TABLE `professional_certificate_table` (
  `professionalcert_id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`professionalcert_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `professional_membership`;
CREATE TABLE `professional_membership` (
  `membership_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `membership_question` text DEFAULT NULL,
  `award_question` text NOT NULL,
  `award_status` text DEFAULT NULL,
  `organization_data` text DEFAULT NULL,
  `organization_country` int(11) DEFAULT NULL,
  `country_organization` int(11) DEFAULT NULL,
  `subcountry_organization` int(11) DEFAULT NULL,
  `membership_type` int(11) DEFAULT NULL,
  `submembership_type` int(11) DEFAULT NULL,
  `des_profession_association` text DEFAULT NULL,
  `date_joined` text DEFAULT NULL,
  `membership_status` text DEFAULT NULL,
  `award_recognitions` text DEFAULT NULL,
  `evidence_imgs` text DEFAULT NULL,
  `award_evidence_imgs` text DEFAULT NULL,
  `declare_info` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`membership_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `professional_organization`;
CREATE TABLE `professional_organization` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_country` text NOT NULL,
  `organization_name` text DEFAULT NULL,
  `country_organiztions` text DEFAULT NULL,
  `sub_organiztions` text DEFAULT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `referee`;
CREATE TABLE `referee` (
  `referee_id` int(11) NOT NULL AUTO_INCREMENT,
  `referee_no` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone_no` text NOT NULL,
  `relationship` text NOT NULL,
  `worked_together` text DEFAULT NULL,
  `position_with_referee` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `still_working` int(11) NOT NULL,
  `is_declare` tinyint(4) NOT NULL COMMENT '0-no/1-yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`referee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `salary_expectation`;
CREATE TABLE `salary_expectation` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_frequency` text DEFAULT NULL,
  `salary_range` text DEFAULT NULL,
  `fixed_salary` float DEFAULT NULL,
  `negotiable_salary` text DEFAULT NULL,
  `hourly_salary` text DEFAULT NULL,
  `weekly_salary` text DEFAULT NULL,
  `monthly_salary` text DEFAULT NULL,
  `annual_salary` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `saved_searches`;
CREATE TABLE `saved_searches` (
  `searches_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text DEFAULT NULL,
  `alert` text NOT NULL,
  `delivery` text NOT NULL,
  `location` text DEFAULT NULL,
  `filters` text DEFAULT NULL,
  `daily_cap` text DEFAULT NULL,
  `quite_hours_start` text DEFAULT NULL,
  `quite_hours_end` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`searches_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `saved_searches` (`searches_id`, `user_id`, `name`, `type`, `alert`, `delivery`, `location`, `filters`, `daily_cap`, `quite_hours_start`, `quite_hours_end`, `notes`, `created_at`, `updated_at`) VALUES
(15,	210,	'dfd dfd',	NULL,	'Realtime',	'In-app',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-29 08:12:17',	'2025-10-29 08:12:17'),
(23,	210,	'cvdert4r',	NULL,	'Realtime',	'In-app',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-29 09:48:07',	'2025-10-29 09:48:07'),
(25,	210,	'ds',	NULL,	'Realtime',	'Email',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-29 10:10:39',	'2025-10-29 10:10:39'),
(29,	210,	'cvdert4r Copydse',	NULL,	'Realtime',	'In-app',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-29 10:59:22',	'2025-10-29 10:59:22'),
(32,	213,	'dsgdgsdg',	NULL,	'Realtime',	'SMS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 05:53:22',	'2025-10-30 05:53:22'),
(33,	213,	'dsgdgsdg Copy',	NULL,	'Realtime',	'SMS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 06:47:45',	'2025-10-30 06:47:45'),
(34,	213,	'dsgdgsdg Copy',	NULL,	'Realtime',	'SMS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 06:47:45',	'2025-10-30 06:47:45'),
(35,	213,	'dsgdgsdg Copy',	NULL,	'Realtime',	'SMS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 06:48:42',	'2025-10-30 06:48:42'),
(36,	213,	'new_add',	NULL,	'Realtime',	'SMS',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 06:49:53',	'2025-10-30 06:49:53'),
(40,	213,	'ss',	NULL,	'Daily',	'In-app',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 08:54:00',	'2025-10-30 08:54:00'),
(42,	212,	'My Preferences',	'dynamic',	'Off',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 13:39:19',	'2025-10-30 13:39:19'),
(43,	212,	'Educational & Training',	NULL,	'Realtime',	'Email',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-10-30 13:40:24',	'2025-10-30 13:40:24'),
(44,	212,	'Educational & Training',	NULL,	'Off',	'Email',	NULL,	'{\"sector\":\"Public Government & Private\",\"employment_type\":[\"Fixed-term\"],\"work_shift\":[\"Work Schedule Preferences\",\"Fixed Part-Time Schedule (Set working days each week, e.g., Monday, Wednesday, Friday only)\",\"Flexible Part-Time (Availability varies week to week)\"],\"work_environment\":[\"Aged care facilities\",\"Residential Aged Care Home (Nursing Homes)\",\"Memory Care & Dementia Units\",\"Palliative & End-of-Life Care Facility\"],\"employee_positions\":[\"Educational & Training\",\"Clinical Instructor\",\"Lecturer\"],\"benefits_preferences\":[\"Insurance\",\"Disability Insurance\",\"Life Insurance\",\"Workers’ Compensation Insurance\"],\"nurse_type\":[\"Enrolled Nurse (EN)\",\"Enrolled Nurse (Notation)\",\"Enrolled Nurse (Medication Endorsed/EEN)\"],\"speciality\":[\"Maternity / OB-GYN / MFM\",\"Postnatal Home Visiting / Early Parenting Support\",\"Perinatal Nurse / Perinatal Mental Health Nurse\"],\"years_of_experience\":\"4\",\"salary_range\":{\"min\":37000,\"max\":120000}}',	NULL,	NULL,	NULL,	NULL,	'2025-10-30 13:43:20',	'2025-11-03 13:31:15'),
(45,	213,	'My Preferences',	'dynamic',	'Off',	'',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2025-11-01 12:34:54',	'2025-11-01 12:34:54');

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) NOT NULL,
  `meta_des` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `speacilaized_clearance`;
CREATE TABLE `speacilaized_clearance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `clearance_state` int(11) NOT NULL,
  `clearance_type` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `clearance_number` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `clearance_expiry_date` date NOT NULL,
  `clearance_evidence` varchar(64) NOT NULL,
  `clearance_original_name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `speciality`;
CREATE TABLE `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `is_featured` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `specialty_level_order` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_code` varchar(100) NOT NULL,
  `country_code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sub_job_specialities`;
CREATE TABLE `sub_job_specialities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` varchar(255) NOT NULL DEFAULT '0' COMMENT 'if parent 0 speciality  else  sub speciality',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `updated_tab_name`;
CREATE TABLE `updated_tab_name` (
  `tab_id` int(11) NOT NULL AUTO_INCREMENT,
  `tab_name` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`tab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` text DEFAULT NULL,
  `profile_img` varchar(255) NOT NULL DEFAULT 'nurse/assets/imgs/nurse06.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `emailToken` text DEFAULT NULL,
  `email_verify` int(11) NOT NULL DEFAULT 0,
  `emailVerified` enum('0','1') NOT NULL DEFAULT '0',
  `work_right` enum('0','1') NOT NULL DEFAULT '1',
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `specialties` text DEFAULT NULL,
  `nurseType` text NOT NULL,
  `nurseTypeJob` text NOT NULL,
  `nurse_practitioner_speciality` text DEFAULT NULL,
  `assistent_level` varchar(255) NOT NULL,
  `subSpecialties` text NOT NULL,
  `Sub-Speciality-One` text DEFAULT NULL,
  `Sub-Speciality-Two` text DEFAULT NULL,
  `degree` text NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `ahpra_code` varchar(10) DEFAULT NULL,
  `ahpra_number` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_stage` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT '0 : verification Done || 1 : admin || 2 : Approved || 3 : reject || 4 : complete || 5 : In Progress	',
  `type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1 : merchant || 2 : ambasdor',
  `medical_facilities` enum('Yes','No') NOT NULL DEFAULT 'No',
  `agencies` enum('Yes','No') NOT NULL DEFAULT 'No',
  `profile_status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `individuals` enum('Yes','No') NOT NULL DEFAULT 'No',
  `unavailable_profile_status` enum('Yes','No') NOT NULL DEFAULT 'No',
  `country_code` varchar(11) DEFAULT NULL,
  `country_iso` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ps` varchar(255) DEFAULT NULL,
  `country` varchar(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `personal_website` varchar(255) DEFAULT NULL,
  `completed_date` timestamp NULL DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `date_of_birth` text DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `emergency_conact_numeber` text DEFAULT NULL,
  `emegency_country_code` text DEFAULT NULL,
  `emergency_country_iso` text DEFAULT NULL,
  `emergergency_contact_email` text DEFAULT NULL,
  `entry_level_nursing` text DEFAULT NULL,
  `registered_nurses` text DEFAULT NULL,
  `advanced_practioner` text DEFAULT NULL,
  `nurse_prac` text DEFAULT NULL,
  `adults` text DEFAULT NULL,
  `maternity` text DEFAULT NULL,
  `paediatrics_neonatal` text DEFAULT NULL,
  `community` text DEFAULT NULL,
  `surgical_preoperative` text DEFAULT NULL,
  `operating_room` text DEFAULT NULL,
  `operating_room_scout` text DEFAULT NULL,
  `operating_room_scrub` text DEFAULT NULL,
  `surgical_obstrics_gynacology` text DEFAULT NULL,
  `neonatal_care` text DEFAULT NULL,
  `paedia_surgical_preoperative` text DEFAULT NULL,
  `pad_op_room` text DEFAULT NULL,
  `pad_qr_scout` text DEFAULT NULL,
  `pad_qr_scrub` text DEFAULT NULL,
  `current_employee_status` text DEFAULT NULL,
  `permanent_status` text DEFAULT NULL,
  `temporary_status` text DEFAULT NULL,
  `basic_info_status` int(11) DEFAULT NULL,
  `professional_info_status` int(11) DEFAULT NULL,
  `nationality` text DEFAULT NULL,
  `profile_status1` int(11) DEFAULT NULL,
  `available_date` text DEFAULT NULL,
  `declaration_status` int(11) DEFAULT NULL,
  `unemployeed_status` text DEFAULT NULL,
  `unemployeed_reason` text DEFAULT NULL,
  `long_unemplyeed` text DEFAULT NULL,
  `start_job_dropdown` text DEFAULT NULL,
  `any_help` text DEFAULT NULL,
  `career_advancement_goals` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user_education_cerification`;
CREATE TABLE `user_education_cerification` (
  `education_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `degrees` text DEFAULT NULL,
  `institution` text DEFAULT NULL,
  `most_relevant` text DEFAULT NULL,
  `graduate_start_date` text DEFAULT NULL,
  `degree_transcript` text DEFAULT NULL,
  `graduate_end_date` text DEFAULT NULL,
  `professional_certifications` text DEFAULT NULL,
  `licence_number` text NOT NULL,
  `country` text DEFAULT NULL,
  `state` int(11) NOT NULL,
  `expiration_date` text NOT NULL,
  `training_courses` text DEFAULT NULL,
  `training_workshops` text DEFAULT NULL,
  `additional_training_data` text DEFAULT NULL,
  `complete_status` int(11) DEFAULT NULL,
  `declaration_status` int(11) DEFAULT NULL,
  `acls_data` text DEFAULT NULL,
  `bls_data` text DEFAULT NULL,
  `cpr_data` text DEFAULT NULL,
  `nrp_data` text DEFAULT NULL,
  `pals_data` text DEFAULT NULL,
  `rn_data` text DEFAULT NULL,
  `np_data` text DEFAULT NULL,
  `cna_data` text DEFAULT NULL,
  `lpn_data` text DEFAULT NULL,
  `crna_data` text DEFAULT NULL,
  `cnm_data` text DEFAULT NULL,
  `ons_data` text DEFAULT NULL,
  `msw_data` text DEFAULT NULL,
  `ain_data` text DEFAULT NULL,
  `rpn_data` text DEFAULT NULL,
  `nl_data` text DEFAULT NULL,
  `additional_certification` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`education_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `user_experience`;
CREATE TABLE `user_experience` (
  `experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `facility_workplace_type` text NOT NULL,
  `facility_workplace_name` text DEFAULT NULL,
  `employer_name` text NOT NULL,
  `position_held` text DEFAULT NULL,
  `employeement_start_date` date NOT NULL,
  `employeement_end_date` date NOT NULL,
  `employeement_type` text DEFAULT NULL,
  `present_status` int(11) DEFAULT NULL,
  `responsiblities` text DEFAULT NULL,
  `achievements` text DEFAULT NULL,
  `skills_compantancies` text NOT NULL,
  `work_experience` text DEFAULT NULL,
  `complete_status` int(11) DEFAULT NULL,
  `evidence_type` text DEFAULT NULL,
  `upload_evidence` text DEFAULT NULL,
  `entry_level_nursing` text DEFAULT NULL,
  `nurseType` text DEFAULT NULL,
  `nurse_prac` text DEFAULT NULL,
  `specialties` text DEFAULT NULL,
  `adults` text DEFAULT NULL,
  `maternity` text DEFAULT NULL,
  `paediatrics_neonatal` text DEFAULT NULL,
  `community` text DEFAULT NULL,
  `registered_nurses` text DEFAULT NULL,
  `advanced_practioner` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `surgical_preoperative` text DEFAULT NULL,
  `operating_room` text DEFAULT NULL,
  `operating_room_scout` text DEFAULT NULL,
  `operating_room_scrub` text DEFAULT NULL,
  `neonatal_care` text DEFAULT NULL,
  `paedia_surgical_preoperative` text DEFAULT NULL,
  `pad_op_room` text DEFAULT NULL,
  `pad_qr_scout` text DEFAULT NULL,
  `pad_qr_scrub` text DEFAULT NULL,
  `current_employee_status` text DEFAULT NULL,
  `temporary_status` text DEFAULT NULL,
  `permanent_status` text DEFAULT NULL,
  `pre_box_status` int(11) DEFAULT NULL,
  `sub_skills_compantancies` text DEFAULT NULL,
  `surgical_obstrics_gynacology` text DEFAULT NULL,
  `assistent_level` varchar(255) DEFAULT NULL,
  `inter_and_em_skill` text DEFAULT NULL,
  `org_and_any_skill` text DEFAULT NULL,
  `lead_and_ment_skill` text DEFAULT NULL,
  `tech_and_soft_pro` text DEFAULT NULL,
  `declaration_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`experience_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `user_licenses_details`;
CREATE TABLE `user_licenses_details` (
  `licenses_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ahpra_registration_status` text DEFAULT NULL,
  `aphra_registration_no` text DEFAULT NULL,
  `aphra_verifying_checkbox` text DEFAULT NULL,
  `api_verify` int(11) DEFAULT NULL,
  `ahpra_reverify` int(11) DEFAULT NULL,
  `register_division` text DEFAULT NULL,
  `register_endorsements` text DEFAULT NULL,
  `register_reg_type` text DEFAULT NULL,
  `register_reg_status` text DEFAULT NULL,
  `register_notations` text DEFAULT NULL,
  `register_conditions` text DEFAULT NULL,
  `register_principal_place` text DEFAULT NULL,
  `register_other_place` text DEFAULT NULL,
  `register_other_notation_reason` text DEFAULT NULL,
  `register_other_condition_reason` text DEFAULT NULL,
  `register_expiry` text DEFAULT NULL,
  `register_upload_evidence` text DEFAULT NULL,
  `last_verified` text DEFAULT NULL,
  `graduate_student_reg_no` text DEFAULT NULL,
  `graduate_division` text DEFAULT NULL,
  `graduate_reg_type` text DEFAULT NULL,
  `graduate_reg_status` text DEFAULT NULL,
  `graduation_date` text DEFAULT NULL,
  `graduation_upload_evidence` text DEFAULT NULL,
  `overseas_qualified_specify` text DEFAULT NULL,
  `other_overseas_qualified` text DEFAULT NULL,
  `overseas_upload_evidence` text DEFAULT NULL,
  `not_currently_registered_reason` text DEFAULT NULL,
  `education_related_reason` text DEFAULT NULL,
  `returning_practice` text DEFAULT NULL,
  `personal_career` text DEFAULT NULL,
  `other_not_registered_reason` text DEFAULT NULL,
  `not_registered_evidence_file` text DEFAULT NULL,
  `ndis_status` text DEFAULT NULL,
  `ndis_registration_no` text DEFAULT NULL,
  `ndis_registration_evidence` text DEFAULT NULL,
  `medical_provider_no` text DEFAULT NULL,
  `medical_upload_evidence` text DEFAULT NULL,
  `pbs_type` text DEFAULT NULL,
  `pbs_other_nursing` text DEFAULT NULL,
  `prescribe_no` text DEFAULT NULL,
  `prescribe_evidence` text DEFAULT NULL,
  `immunization_state` text DEFAULT NULL,
  `authorizing_body_program` text DEFAULT NULL,
  `date_authorised` text DEFAULT NULL,
  `immuzination_evidence` text DEFAULT NULL,
  `radiation_licence_type` text DEFAULT NULL,
  `licenses_type_other` text DEFAULT NULL,
  `radiation_licenses_no` text DEFAULT NULL,
  `radiation_state_issue` text DEFAULT NULL,
  `radiation_issue_date` text DEFAULT NULL,
  `radiation_expiry_date` text DEFAULT NULL,
  `radiation_evidence` text DEFAULT NULL,
  `radiation_state_data` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`licenses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `vaccination`;
CREATE TABLE `vaccination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `vaccination_front`;
CREATE TABLE `vaccination_front` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vaccination_id` int(11) NOT NULL,
  `immunization_status` int(11) NOT NULL,
  `evidance_type` int(11) DEFAULT NULL,
  `covid_dose` int(11) NOT NULL,
  `is_declare` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vaccination_records` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `vaccine_compliances`;
CREATE TABLE `vaccine_compliances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL COMMENT 'vcc_state',
  `vaccination_id` int(11) NOT NULL,
  `complinace_content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL COMMENT '0-no /1-yes',
  `is_deleted` tinyint(4) NOT NULL COMMENT '0-no /1-yes',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `vcc_level_req`;
CREATE TABLE `vcc_level_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_req` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-inactive/1-active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `vcc_state`;
CREATE TABLE `vcc_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(164) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `policy` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-inactive/1-active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `visa_subclas`;
CREATE TABLE `visa_subclas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `residence_id` int(11) NOT NULL,
  `sublcass_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `subclass_head` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `working_children_check`;
CREATE TABLE `working_children_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `clearance_number` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `wwcc_evidence` varchar(64) NOT NULL,
  `evidence_original_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` enum('1','0','2') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `work_enviornment_preferences`;
CREATE TABLE `work_enviornment_preferences` (
  `prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  `env_name` text NOT NULL,
  `sub_env_id` int(11) NOT NULL,
  `sub_envp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`prefer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `work_evidance`;
CREATE TABLE `work_evidance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evidence_file` varchar(64) NOT NULL,
  `original_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `evidance_type` tinyint(4) NOT NULL COMMENT '1-EligibilityToWork/2-NdisWorker/3-wwcc/4-PoliceCheck/5-SpecializedClearance',
  `type_id` int(11) NOT NULL COMMENT 'this belogns to other tables',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `work_preferences`;
CREATE TABLE `work_preferences` (
  `work_prefer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sector_preferences` text DEFAULT NULL,
  `work_environment_preferences` text DEFAULT NULL,
  `emptype_preferences` text DEFAULT NULL,
  `work_shift_preferences` text DEFAULT NULL,
  `subwork_shift_preferences` text DEFAULT NULL,
  `position_preferences` text DEFAULT NULL,
  `salary_expectations` text NOT NULL,
  `benefits_preferences` text NOT NULL,
  `location_status` text DEFAULT NULL,
  `prefered_location_current` text DEFAULT NULL,
  `prefered_location` text DEFAULT NULL,
  `prefered_distance` text DEFAULT NULL,
  `auto_detect_location` int(11) DEFAULT NULL,
  `countries` text DEFAULT NULL,
  `other_countries` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`work_prefer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `work_shift_preferences`;
CREATE TABLE `work_shift_preferences` (
  `work_shift_id` int(11) NOT NULL AUTO_INCREMENT,
  `shift_name` text DEFAULT NULL,
  `shift_id` int(11) NOT NULL,
  `sub_shift_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`work_shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2025-11-03 13:38:31