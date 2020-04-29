-- --------------------------------------------------------
-- Host:                         181.129.103.142
-- Versión del servidor:         5.7.29-0ubuntu0.18.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla admin_procrm.aa_districts
CREATE TABLE IF NOT EXISTS `aa_districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `zone` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_districts_districts_zones` (`zone`),
  CONSTRAINT `FK_districts_districts_zones` FOREIGN KEY (`zone`) REFERENCES `aa_zones` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_groups
CREATE TABLE IF NOT EXISTS `aa_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `max_area_for_day` double DEFAULT NULL,
  `operators` int(11) DEFAULT '0',
  `drivers` int(11) DEFAULT '0',
  `scythes` int(11) DEFAULT '0',
  `auxiliary` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_groups_managers
CREATE TABLE IF NOT EXISTS `aa_groups_managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `FK_emvarias_groups_managers_emvarias_groups` (`group`) USING BTREE,
  KEY `FK_emvarias_groups_managers_users` (`user`) USING BTREE,
  CONSTRAINT `FK_aa_groups_managers_aa_groups` FOREIGN KEY (`group`) REFERENCES `aa_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_aa_groups_managers_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_groups_microroutes
CREATE TABLE IF NOT EXISTS `aa_groups_microroutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `microroute` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_aa_groups_microroutes_aa_groups` (`group`),
  KEY `FK_aa_groups_microroutes_aa_microroutes` (`microroute`),
  CONSTRAINT `FK_aa_groups_microroutes_aa_groups` FOREIGN KEY (`group`) REFERENCES `aa_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_aa_groups_microroutes_aa_microroutes` FOREIGN KEY (`microroute`) REFERENCES `aa_microroutes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1298 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_groups_staff
CREATE TABLE IF NOT EXISTS `aa_groups_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `FK_emvarias_groups_managers_emvarias_groups` (`group`) USING BTREE,
  CONSTRAINT `aa_groups_staff_ibfk_1` FOREIGN KEY (`group`) REFERENCES `aa_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_microroutes
CREATE TABLE IF NOT EXISTS `aa_microroutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `repeat_ini` int(11) DEFAULT '0',
  `repeat_current` int(11) DEFAULT '0',
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `id_ref` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `address_text` text CHARACTER SET utf8,
  `area_m2` float DEFAULT '0',
  `obs` text CHARACTER SET utf8,
  `last_executed` date DEFAULT NULL,
  `interval_days` int(11) DEFAULT '7',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_photographic_routes_lots` (`id`) USING BTREE,
  KEY `id_ref` (`id_ref`) USING BTREE,
  KEY `microroute_name` (`name`) USING BTREE,
  KEY `FK_microroutes_accounts_contracts` (`contract`) USING BTREE,
  KEY `FK_microroutes_accounts` (`account`) USING BTREE,
  KEY `FK_aa_microroutes_aa_zones` (`zone`),
  CONSTRAINT `FK_aa_microroutes_aa_zones` FOREIGN KEY (`zone`) REFERENCES `aa_zones` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `aa_microroutes_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `aa_microroutes_ibfk_2` FOREIGN KEY (`contract`) REFERENCES `accounts_contracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1207 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_periods
CREATE TABLE IF NOT EXISTS `aa_periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `start_day` int(11) DEFAULT NULL,
  `start_month` int(11) DEFAULT NULL,
  `end_day` int(11) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `start` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `end` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.aa_zones
CREATE TABLE IF NOT EXISTS `aa_zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `obs` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `names` varchar(50) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `economic_activity` int(11) DEFAULT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 NOT NULL,
  `gender` varchar(20) CHARACTER SET utf8 DEFAULT 'other',
  `address` text CHARACTER SET utf8,
  `notifications_group` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `email_key` (`email`),
  KEY `FK_users_identifications_types` (`identification_type`),
  KEY `FK_accounts_accounts_types` (`type`),
  KEY `FK_accounts_users` (`created_by`),
  KEY `FK_accounts_users_2` (`updated_by`),
  KEY `FK_accounts_economic_activities` (`economic_activity`),
  KEY `FK_accounts_notifications_groups` (`notifications_group`),
  CONSTRAINT `FK_accounts_accounts_types` FOREIGN KEY (`type`) REFERENCES `accounts_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_economic_activities` FOREIGN KEY (`economic_activity`) REFERENCES `economic_activities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_notifications_groups` FOREIGN KEY (`notifications_group`) REFERENCES `notifications_groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_communications
CREATE TABLE IF NOT EXISTS `accounts_communications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `is_closed` int(1) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_communications_accounts` (`account`),
  KEY `FK_accounts_communications_users` (`updated_by`),
  KEY `FK_accounts_communications_users_2` (`created_by`),
  CONSTRAINT `FK_accounts_communications_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_communications_users` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_communications_users_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_communications_parts
CREATE TABLE IF NOT EXISTS `accounts_communications_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `communication` int(11) DEFAULT NULL,
  `message` longtext CHARACTER SET utf8,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_communications_parts_users` (`created_by`),
  KEY `FK_accounts_communications_parts_users_2` (`updated_by`),
  KEY `FK_accounts_communications_parts_accounts` (`account`),
  KEY `FK_accounts_communications_parts_accounts_communications` (`communication`),
  CONSTRAINT `FK_accounts_communications_parts_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_communications_parts_accounts_communications` FOREIGN KEY (`communication`) REFERENCES `accounts_communications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_communications_parts_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_communications_parts_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_contacts
CREATE TABLE IF NOT EXISTS `accounts_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_contacts_accounts` (`account`),
  KEY `FK_accounts_contacts_contacts` (`contact`),
  KEY `FK_accounts_contacts_contacts_types` (`type`),
  CONSTRAINT `FK_accounts_contacts_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_contacts_contacts` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_contacts_contacts_types` FOREIGN KEY (`type`) REFERENCES `contacts_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_contracts
CREATE TABLE IF NOT EXISTS `accounts_contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT '0',
  `name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_contracts_accounts` (`account`),
  CONSTRAINT `FK_accounts_contracts_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_headquarters
CREATE TABLE IF NOT EXISTS `accounts_headquarters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `account` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_headquarters_addresses` (`address`),
  KEY `FK_accounts_headquarters_accounts` (`account`),
  CONSTRAINT `FK_accounts_headquarters_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_headquarters_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_types
CREATE TABLE IF NOT EXISTS `accounts_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_users
CREATE TABLE IF NOT EXISTS `accounts_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `permissions` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_users_permissions_group` (`permissions`),
  KEY `FK_accounts_users_accounts` (`account`),
  KEY `FK_accounts_users_users` (`user`),
  CONSTRAINT `FK_accounts_users_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_users_permissions_group` FOREIGN KEY (`permissions`) REFERENCES `permissions_group` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_users_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `via_principal` int(11) DEFAULT NULL,
  `via_principal_number` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_principal_letter` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_principal_quadrant` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_secondary_number` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_secondary_letter` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_secondary_quadrant` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_end_number` varchar(10) CHARACTER SET utf8 NOT NULL,
  `via_end_extra` varchar(500) CHARACTER SET utf8 NOT NULL,
  `minsize` varchar(500) CHARACTER SET utf8 NOT NULL,
  `complete` varchar(500) CHARACTER SET utf8 NOT NULL,
  `point` point DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_addresses_geo_types_vias` (`via_principal`),
  KEY `FK_addresses_geo_citys` (`city`),
  KEY `FK_addresses_geo_departments` (`department`),
  CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `addresses_ibfk_3` FOREIGN KEY (`via_principal`) REFERENCES `geo_types_vias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.candidates
CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `salary` float DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `avatar` int(11) DEFAULT '168',
  `notes` varchar(2500) DEFAULT NULL,
  `create` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `email_key` (`email`),
  KEY `FK_users_identifications_types` (`identification_type`),
  KEY `FK_users_geo_departments` (`department`),
  KEY `FK_users_geo_citys` (`city`),
  KEY `FK_candidates_pictures` (`avatar`),
  KEY `FK_candidates_status_marital` (`marital_status`),
  CONSTRAINT `FK_candidates_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_candidates_status_marital` FOREIGN KEY (`marital_status`) REFERENCES `status_marital` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `candidates_ibfk_2` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `candidates_ibfk_3` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=795 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.candidates_experience
CREATE TABLE IF NOT EXISTS `candidates_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate` int(11) NOT NULL,
  `business` varchar(250) CHARACTER SET utf8 NOT NULL,
  `position` varchar(250) CHARACTER SET utf8 NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date DEFAULT NULL,
  `functions` varchar(1000) CHARACTER SET utf8 DEFAULT 'Sin informacion',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_candidates_experience_candidates` (`candidate`),
  CONSTRAINT `FK_candidates_experience_candidates` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2872 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.candidates_files
CREATE TABLE IF NOT EXISTS `candidates_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate` int(11) NOT NULL,
  `media` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_candidates_files_candidates` (`candidate`),
  KEY `FK_candidates_files_media` (`media`),
  CONSTRAINT `FK_candidates_files_candidates` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidates_files_media` FOREIGN KEY (`media`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=806 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.candidates_studies
CREATE TABLE IF NOT EXISTS `candidates_studies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `level` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_candidates_studies_candidates` (`candidate`),
  KEY `FK_candidates_studies_study_levels` (`level`),
  KEY `FK_candidates_studies_study_status` (`status`),
  CONSTRAINT `FK_candidates_studies_candidates` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_candidates_studies_study_levels` FOREIGN KEY (`level`) REFERENCES `study_levels` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_candidates_studies_study_status` FOREIGN KEY (`status`) REFERENCES `study_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1124 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.companies_areas
CREATE TABLE IF NOT EXISTS `companies_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.companies_sectors
CREATE TABLE IF NOT EXISTS `companies_sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) CHARACTER SET utf8 NOT NULL,
  `names` varchar(50) CHARACTER SET utf8 NOT NULL,
  `surname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text CHARACTER SET utf8,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `email_key` (`email`),
  KEY `FK_users_identifications_types` (`identification_type`),
  KEY `FK_contacts_users` (`created_by`),
  KEY `FK_contacts_users_2` (`updated_by`),
  CONSTRAINT `FK_contacts_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_contacts_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `contacts_ibfk_3` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.contacts_types
CREATE TABLE IF NOT EXISTS `contacts_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.driving_licenses
CREATE TABLE IF NOT EXISTS `driving_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities
CREATE TABLE IF NOT EXISTS `economic_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(350) CHARACTER SET utf8 NOT NULL,
  `session` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `class` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_economic_activities_economic_activities_sessions` (`session`),
  KEY `FK_economic_activities_economic_activities_divitions` (`division`),
  CONSTRAINT `FK_economic_activities_economic_activities_divitions` FOREIGN KEY (`division`) REFERENCES `economic_activities_divitions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_economic_activities_economic_activities_sessions` FOREIGN KEY (`session`) REFERENCES `economic_activities_sessions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=688 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities_divitions
CREATE TABLE IF NOT EXISTS `economic_activities_divitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities_sessions
CREATE TABLE IF NOT EXISTS `economic_activities_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `title` varchar(350) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `box` int(11) DEFAULT NULL,
  `message_id` mediumtext,
  `uid` int(11) DEFAULT NULL,
  `status` mediumtext,
  `subject` mediumtext,
  `from` mediumtext,
  `from_email` mediumtext,
  `to` mediumtext,
  `date` mediumtext,
  `message` mediumtext,
  `size` mediumtext,
  `msgno` int(11) DEFAULT NULL,
  `recent` int(1) DEFAULT '0',
  `flagged` int(1) DEFAULT '0',
  `answered` int(1) DEFAULT '0',
  `deleted` int(1) DEFAULT '0',
  `seen` int(1) DEFAULT '0',
  `draft` int(1) DEFAULT '1',
  `send` int(1) DEFAULT '0',
  `attachments` mediumtext,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.emails_attachments
CREATE TABLE IF NOT EXISTS `emails_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` int(11) NOT NULL,
  `attachment` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emails_attachments_emails` (`email`),
  KEY `FK_emails_attachments_attachments` (`attachment`),
  CONSTRAINT `FK_emails_attachments_attachments` FOREIGN KEY (`attachment`) REFERENCES `attachments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_emails_attachments_emails` FOREIGN KEY (`email`) REFERENCES `emails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.emails_boxes
CREATE TABLE IF NOT EXISTS `emails_boxes` (
  `label` varchar(150) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host` varchar(150) NOT NULL,
  `port` varchar(150) NOT NULL,
  `user` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `args_add` varchar(150) NOT NULL,
  `last_sync` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `actived` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.emails_users
CREATE TABLE IF NOT EXISTS `emails_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `send_enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_users_mails_users` (`user`),
  KEY `FK_users_mails_mails` (`email`),
  CONSTRAINT `FK_users_mails_mails` FOREIGN KEY (`email`) REFERENCES `emails_boxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_mails_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(100) NOT NULL,
  `nationality` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `place_birth_country` int(11) NOT NULL,
  `place_birth_department` int(11) NOT NULL,
  `place_birth_city` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL DEFAULT 'other',
  `status_marital` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` int(11) NOT NULL,
  `driving_license` int(11) NOT NULL,
  `own_vehicle` int(1) NOT NULL,
  `disability` int(1) NOT NULL,
  `photo` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `military_card` int(1) NOT NULL,
  `military_card_number` varchar(50) DEFAULT NULL,
  `military_card_dm` varchar(150) DEFAULT NULL,
  `notes` text,
  `eps` int(11) NOT NULL,
  `arl` int(11) NOT NULL,
  `afp` int(11) NOT NULL,
  `ccf` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_employees_identifications_types` (`identification_type`),
  KEY `FK_employees_status_marital` (`status_marital`),
  KEY `FK_employees_addresses` (`address`),
  KEY `FK_employees_driving_licenses` (`driving_license`),
  KEY `FK_employees_pictures` (`photo`),
  KEY `FK_employees_employees_status` (`status`),
  KEY `FK_employees_geo_countries` (`nationality`),
  KEY `FK_employees_geo_countries_2` (`place_birth_country`),
  KEY `FK_employees_geo_departments` (`place_birth_department`),
  KEY `FK_employees_geo_citys` (`place_birth_city`),
  KEY `FK_employees_military_cards` (`military_card`),
  KEY `FK_employees_membership_entities` (`eps`),
  KEY `FK_employees_membership_entities_2` (`arl`),
  KEY `FK_employees_membership_entities_3` (`afp`),
  KEY `FK_employees_membership_entities_4` (`ccf`),
  CONSTRAINT `FK_employees_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_driving_licenses` FOREIGN KEY (`driving_license`) REFERENCES `driving_licenses` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_employees_status` FOREIGN KEY (`status`) REFERENCES `employees_status` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_geo_citys` FOREIGN KEY (`place_birth_city`) REFERENCES `geo_citys` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_geo_countries` FOREIGN KEY (`nationality`) REFERENCES `geo_countries` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_geo_countries_2` FOREIGN KEY (`place_birth_country`) REFERENCES `geo_countries` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_geo_departments` FOREIGN KEY (`place_birth_department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_membership_entities` FOREIGN KEY (`eps`) REFERENCES `membership_entities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_membership_entities_2` FOREIGN KEY (`arl`) REFERENCES `membership_entities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_membership_entities_3` FOREIGN KEY (`afp`) REFERENCES `membership_entities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_membership_entities_4` FOREIGN KEY (`ccf`) REFERENCES `membership_entities` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_military_cards` FOREIGN KEY (`military_card`) REFERENCES `military_cards` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_pictures` FOREIGN KEY (`photo`) REFERENCES `pictures` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_status_marital` FOREIGN KEY (`status_marital`) REFERENCES `status_marital` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees_contacts
CREATE TABLE IF NOT EXISTS `employees_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `phones` varchar(250) NOT NULL,
  `is_emergency` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `email_key` (`email`) USING BTREE,
  KEY `FK_users_identifications_types` (`identification_type`) USING BTREE,
  KEY `FK_employees_contacts_employees` (`employee`),
  CONSTRAINT `FK_employees_contacts_employees` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_contacts_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees_experiences
CREATE TABLE IF NOT EXISTS `employees_experiences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `company` varchar(250) NOT NULL,
  `company_sector` int(11) NOT NULL DEFAULT '0',
  `position` varchar(250) NOT NULL,
  `area` int(11) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date DEFAULT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_employees_experiences_employees` (`employee`),
  KEY `FK_employees_experiences_companies_sectors` (`company_sector`),
  KEY `FK_employees_experiences_companies_areas` (`area`),
  CONSTRAINT `FK_employees_experiences_companies_areas` FOREIGN KEY (`area`) REFERENCES `companies_areas` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_experiences_companies_sectors` FOREIGN KEY (`company_sector`) REFERENCES `companies_sectors` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_experiences_employees` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees_family_groups
CREATE TABLE IF NOT EXISTS `employees_family_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `relationship` int(11) NOT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(250) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `birthdate` date NOT NULL,
  `notes` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_employees_family_groups_employees` (`employee`),
  KEY `FK_employees_family_groups_family_relationships` (`relationship`),
  KEY `FK_employees_family_groups_identifications_types` (`identification_type`),
  CONSTRAINT `FK_employees_family_groups_employees` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_family_groups_family_relationships` FOREIGN KEY (`relationship`) REFERENCES `family_relationships` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_family_groups_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees_status
CREATE TABLE IF NOT EXISTS `employees_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.employees_studies
CREATE TABLE IF NOT EXISTS `employees_studies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `educational_center` varchar(250) NOT NULL,
  `level_study` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_employees_studies_employees` (`employee`),
  KEY `FK_employees_studies_study_levels` (`level_study`),
  KEY `FK_employees_studies_study_status` (`status`),
  CONSTRAINT `FK_employees_studies_employees` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_studies_study_levels` FOREIGN KEY (`level_study`) REFERENCES `study_levels` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_employees_studies_study_status` FOREIGN KEY (`status`) REFERENCES `study_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.family_relationships
CREATE TABLE IF NOT EXISTS `family_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden
CREATE TABLE IF NOT EXISTS `garden` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_comercial` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name_comun` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `name_botanico` varchar(250) CHARACTER SET utf8 DEFAULT NULL COMMENT '(especie de género)',
  `picture` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `attendance` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Columna 1` (`id`),
  KEY `FK_garden_pictures` (`picture`),
  CONSTRAINT `FK_garden_pictures` FOREIGN KEY (`picture`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden_attributes
CREATE TABLE IF NOT EXISTS `garden_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden` int(11) NOT NULL,
  `filter` int(11) NOT NULL,
  `attribute` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_inputs_options_garden_inputs` (`filter`),
  KEY `FK_garden_attributes_garden` (`garden`),
  KEY `FK_garden_attributes_garden_filters_attributes` (`attribute`),
  CONSTRAINT `FK_garden_attributes_garden` FOREIGN KEY (`garden`) REFERENCES `garden` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_garden_attributes_garden_filters_attributes` FOREIGN KEY (`attribute`) REFERENCES `garden_filters_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_garden_inputs_options_garden_inputs` FOREIGN KEY (`filter`) REFERENCES `garden_filters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden_comun_names
CREATE TABLE IF NOT EXISTS `garden_comun_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_comun_names_garden` (`garden`),
  CONSTRAINT `FK_garden_comun_names_garden` FOREIGN KEY (`garden`) REFERENCES `garden` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden_filters
CREATE TABLE IF NOT EXISTS `garden_filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) CHARACTER SET latin1 NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `description` varchar(500) CHARACTER SET latin1 NOT NULL,
  `type` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden_filters_attributes
CREATE TABLE IF NOT EXISTS `garden_filters_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter` int(11) NOT NULL,
  `text` varchar(250) CHARACTER SET latin1 NOT NULL,
  `more` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_inputs_options_garden_inputs` (`filter`),
  CONSTRAINT `FK_garden_filters_v_garden_fields` FOREIGN KEY (`filter`) REFERENCES `garden_filters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.garden_gallery
CREATE TABLE IF NOT EXISTS `garden_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garden` int(11) NOT NULL,
  `picture` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_garden_gallery_garden` (`garden`),
  KEY `FK_garden_gallery_pictures` (`picture`),
  CONSTRAINT `FK_garden_gallery_garden` FOREIGN KEY (`garden`) REFERENCES `garden` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_garden_gallery_pictures` FOREIGN KEY (`picture`) REFERENCES `pictures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_citys
CREATE TABLE IF NOT EXISTS `geo_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `department` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_id` (`department`),
  KEY `id` (`id`),
  CONSTRAINT `FK_geo_citys_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1103 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_countries
CREATE TABLE IF NOT EXISTS `geo_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(80) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_departments
CREATE TABLE IF NOT EXISTS `geo_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `FK_geo_departments_geo_countries` (`country`),
  CONSTRAINT `FK_geo_departments_geo_countries` FOREIGN KEY (`country`) REFERENCES `geo_countries` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_types_quadrants
CREATE TABLE IF NOT EXISTS `geo_types_quadrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `code` varchar(5) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_types_vias
CREATE TABLE IF NOT EXISTS `geo_types_vias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `code` varchar(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `group_notification` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_groups_groups` (`group_notification`),
  CONSTRAINT `FK_emvarias_groups_notifications_groups` FOREIGN KEY (`group_notification`) REFERENCES `notifications_groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.groups_managers
CREATE TABLE IF NOT EXISTS `groups_managers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_groups_managers_emvarias_groups` (`group`),
  KEY `FK_emvarias_groups_managers_users` (`user`),
  CONSTRAINT `FK_emvarias_groups_managers_emvarias_groups` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_groups_managers_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.headquarters
CREATE TABLE IF NOT EXISTS `headquarters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `address` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_headquarters_addresses` (`address`),
  CONSTRAINT `FK_headquarters_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.identifications_types
CREATE TABLE IF NOT EXISTS `identifications_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.lots
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `id_ref` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `address_text` text CHARACTER SET utf8,
  `area_m2` float DEFAULT '0',
  `zone_client` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obs` text CHARACTER SET utf8,
  `last_executed` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_photographic_routes_lots` (`id`) USING BTREE,
  KEY `id_ref` (`id_ref`) USING BTREE,
  KEY `microroute_name` (`name`) USING BTREE,
  KEY `FK_microroutes_accounts_contracts` (`contract`) USING BTREE,
  KEY `FK_microroutes_accounts` (`account`) USING BTREE,
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`contract`) REFERENCES `accounts_contracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1214 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `size` varchar(50) CHARACTER SET utf8 NOT NULL,
  `path_full` text CHARACTER SET utf8 NOT NULL,
  `path_short` varchar(250) CHARACTER SET utf8 NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users` (`create_by`),
  CONSTRAINT `FK_media_users` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=893 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.media_events
CREATE TABLE IF NOT EXISTS `media_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users_media` (`media`),
  KEY `FK_media_users_users` (`event`),
  CONSTRAINT `FK_media_events_events` FOREIGN KEY (`event`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_media_events_media` FOREIGN KEY (`media`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.media_users
CREATE TABLE IF NOT EXISTS `media_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users_media` (`media`),
  KEY `FK_media_users_users` (`user`),
  CONSTRAINT `FK_media_users_media` FOREIGN KEY (`media`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_media_users_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=727 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.meditions
CREATE TABLE IF NOT EXISTS `meditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.membership_entities
CREATE TABLE IF NOT EXISTS `membership_entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET latin1 NOT NULL,
  `code` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `phones` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8 NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.menus_items
CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 DEFAULT '',
  `parent` int(11) DEFAULT '0',
  `tag_id` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `tag_class` json DEFAULT NULL,
  `tag_href` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `tag_href_parms` json DEFAULT NULL,
  `tag_params` json DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `public` int(1) DEFAULT '0',
  `alls` int(1) DEFAULT '0',
  `guest` int(1) DEFAULT '0',
  `permission` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_nodes_items_menus` (`menu`),
  KEY `permission` (`permission`),
  KEY `tag_href` (`tag_href`),
  CONSTRAINT `menus_items_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10008 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.microroutes
CREATE TABLE IF NOT EXISTS `microroutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `id_ref` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8,
  `address_text` text CHARACTER SET utf8,
  `area_m2` float DEFAULT '0',
  `zone_client` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `obs` text CHARACTER SET utf8,
  `last_executed` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photographic_routes_lots` (`id`),
  KEY `id_ref` (`id_ref`),
  KEY `microroute_name` (`name`) USING BTREE,
  KEY `FK_microroutes_accounts_contracts` (`contract`),
  KEY `FK_microroutes_accounts` (`account`),
  CONSTRAINT `FK_microroutes_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_microroutes_accounts_contracts` FOREIGN KEY (`contract`) REFERENCES `accounts_contracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1214 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.military_cards
CREATE TABLE IF NOT EXISTS `military_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(100) CHARACTER SET utf8 DEFAULT 'default',
  `datajson` json DEFAULT NULL,
  `read` int(1) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_notifications_users` (`created_by`),
  KEY `FK_notifications_users_3` (`updated_by`),
  KEY `FK_notifications_users_2` (`user`),
  CONSTRAINT `FK_notifications_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_notifications_users_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_notifications_users_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications_groups
CREATE TABLE IF NOT EXISTS `notifications_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 DEFAULT 'Grupo sin titulo',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications_groups_users
CREATE TABLE IF NOT EXISTS `notifications_groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_groups_users_groups` (`group`),
  KEY `FK_groups_users_users` (`user`),
  CONSTRAINT `FK_groups_users_groups` FOREIGN KEY (`group`) REFERENCES `notifications_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_groups_users_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.novelties_files
CREATE TABLE IF NOT EXISTS `novelties_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novelty` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `group` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `date_report` date NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `file_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `file_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `file_size` varchar(50) CHARACTER SET utf8 NOT NULL,
  `file_path_full` text CHARACTER SET utf8 NOT NULL,
  `file_path_short` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users` (`created_by`),
  KEY `FK_emvarias_reports_photographic_files_users` (`updated_by`),
  KEY `FK_emvarias_reports_photographic_photographic_groups` (`group`),
  KEY `FK_emvarias_reports_photographic_photographic_periods` (`period`),
  KEY `FK_emvarias_novelties_files_emvarias_novelties_generals` (`novelty`),
  CONSTRAINT `FK_emvarias_novelties_files_emvarias_novelties_generals` FOREIGN KEY (`novelty`) REFERENCES `novelties_generals` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `novelties_files_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `novelties_files_ibfk_3` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `novelties_files_ibfk_4` FOREIGN KEY (`period`) REFERENCES `periods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `novelties_files_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.novelties_generals
CREATE TABLE IF NOT EXISTS `novelties_generals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_report` date NOT NULL,
  `group` int(11) DEFAULT NULL,
  `period` int(11) DEFAULT NULL,
  `year` year(4) NOT NULL,
  `lat` double DEFAULT '0',
  `lng` double DEFAULT '0',
  `notes` mediumtext CHARACTER SET utf8,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_reports_novelty_emvarias_groups` (`group`),
  KEY `FK_emvarias_reports_novelty_emvarias_periods` (`period`),
  KEY `FK_emvarias_reports_novelty_users_2` (`updated_by`),
  KEY `FK_emvarias_reports_novelty_users` (`created_by`),
  CONSTRAINT `FK_emvarias_reports_novelty_emvarias_groups` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_novelty_emvarias_periods` FOREIGN KEY (`period`) REFERENCES `periods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_novelty_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_novelty_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.periods
CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `start_day` int(11) DEFAULT NULL,
  `start_month` int(11) DEFAULT NULL,
  `end_day` int(11) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `start` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `end` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_permissions_permissions_group` (`group`),
  KEY `FK_permissions_permissions` (`permission`),
  CONSTRAINT `FK_permissions_permissions` FOREIGN KEY (`permission`) REFERENCES `permissions_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_permissions_permissions_group` FOREIGN KEY (`group`) REFERENCES `permissions_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.permissions_group
CREATE TABLE IF NOT EXISTS `permissions_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `for_user` int(1) DEFAULT '0',
  `for_account` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.permissions_items
CREATE TABLE IF NOT EXISTS `permissions_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`),
  KEY `id` (`id`),
  KEY `tag KEY` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `size` int(32) NOT NULL,
  `data` mediumblob NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=678 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.reports_photographic
CREATE TABLE IF NOT EXISTS `reports_photographic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `type` varchar(1) NOT NULL DEFAULT 'O',
  `group` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `file_name` varchar(150) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` varchar(50) NOT NULL,
  `file_path_full` mediumtext NOT NULL,
  `file_path_short` varchar(250) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users` (`create_by`),
  KEY `FK_emvarias_reports_photographic_files_users` (`updated_by`),
  KEY `FK_emvarias_reports_photographic_photographic_groups` (`group`),
  KEY `FK_emvarias_reports_photographic_photographic_periods` (`period`),
  KEY `FK_emvarias_reports_photographic_files_emvarias_microroutes` (`schedule`),
  CONSTRAINT `FK_emvarias_reports_photographic_files_emvarias_microroutes` FOREIGN KEY (`schedule`) REFERENCES `schedule` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_photographic_files_users` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_photographic_photographic_groups` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_reports_photographic_photographic_periods` FOREIGN KEY (`period`) REFERENCES `periods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reports_photographic_ibfk_1` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8505 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.requests
CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  `description` varchar(1000) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_requests_accounts` (`account`),
  KEY `FK_requests_users` (`create_by`),
  KEY `FK_requests_users_2` (`update_by`),
  KEY `FK_requests_accounts_contacts` (`contact`),
  KEY `FK_requests_requests_status` (`status`),
  CONSTRAINT `FK_requests_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_accounts_contacts` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_requests_status` FOREIGN KEY (`status`) REFERENCES `requests_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_users` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_users_2` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.requests_addresses
CREATE TABLE IF NOT EXISTS `requests_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_requests_addresses_requests` (`request`),
  KEY `FK_requests_addresses_addresses` (`address`),
  CONSTRAINT `FK_requests_addresses_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_addresses_requests` FOREIGN KEY (`request`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.requests_contacts
CREATE TABLE IF NOT EXISTS `requests_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` int(11) NOT NULL DEFAULT '0',
  `contact` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_requests_contacts_requests` (`request`),
  KEY `FK_requests_contacts_contacts` (`contact`),
  CONSTRAINT `FK_requests_contacts_contacts` FOREIGN KEY (`contact`) REFERENCES `contacts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_contacts_requests` FOREIGN KEY (`request`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.requests_services
CREATE TABLE IF NOT EXISTS `requests_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request` int(11) NOT NULL,
  `service` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_requests_services_requests` (`request`),
  KEY `FK_requests_services_services` (`service`),
  CONSTRAINT `FK_requests_services_requests` FOREIGN KEY (`request`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_requests_services_services` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.requests_status
CREATE TABLE IF NOT EXISTS `requests_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) CHARACTER SET utf8 NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 NOT NULL,
  `color` varchar(16) CHARACTER SET utf8 NOT NULL,
  `porcentage` varchar(16) CHARACTER SET utf8 NOT NULL,
  `calendar_enabled` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.routes
CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_actived` int(1) NOT NULL DEFAULT '0',
  `is_hidden` int(1) NOT NULL DEFAULT '0',
  `is_searchable` int(1) NOT NULL DEFAULT '0',
  `permission_access` int(11) DEFAULT NULL,
  `title` text CHARACTER SET utf8 NOT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  `request_uri` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT 'post',
  `view` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'wellcome',
  `layout` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'main',
  `mime_type` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_status_date` (`type`,`created`,`id`),
  KEY `post_parent` (`parent`),
  KEY `post_author` (`created_by`),
  KEY `FK_routes_permissions_items` (`permission_access`),
  CONSTRAINT `FK_routes_permissions_items` FOREIGN KEY (`permission_access`) REFERENCES `permissions_items` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule
CREATE TABLE IF NOT EXISTS `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `microroute` int(11) DEFAULT NULL,
  `period` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `date_executed_schedule` date NOT NULL,
  `date_executed_schedule_end` date DEFAULT NULL,
  `date_executed` date DEFAULT NULL,
  `time_executed` time DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `time_approved` time DEFAULT NULL,
  `date_novelty` date DEFAULT NULL,
  `time_novelty` time DEFAULT NULL,
  `is_executed` int(1) DEFAULT '0',
  `is_approved` int(1) DEFAULT '0',
  `in_novelty` int(1) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_schedule_emvarias_periods` (`period`),
  KEY `FK_emvarias_schedule_emvarias_groups` (`group`),
  KEY `FK_emvarias_schedule_users` (`created_by`),
  KEY `FK_emvarias_schedule_users_2` (`updated_by`),
  KEY `FK_emvarias_schedule_emvarias_lots` (`microroute`) USING BTREE,
  CONSTRAINT `FK_schedule_groups` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_microroutes` FOREIGN KEY (`microroute`) REFERENCES `microroutes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_periods` FOREIGN KEY (`period`) REFERENCES `periods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_schedule_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1071 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_comments
CREATE TABLE IF NOT EXISTS `schedule_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `comment` mediumtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_schedule_comments_users` (`created_by`),
  KEY `FK_emvarias_schedule_comments_emvarias_schedule` (`schedule`),
  CONSTRAINT `FK_emvarias_schedule_comments_emvarias_schedule` FOREIGN KEY (`schedule`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_comments_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_execution_novelties
CREATE TABLE IF NOT EXISTS `schedule_execution_novelties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT '0',
  `period` int(11) DEFAULT '0',
  `year` year(4) DEFAULT '2000',
  `comment` mediumtext CHARACTER SET utf8 NOT NULL,
  `status` int(11) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_schedule_execution_novelties_emvarias_schedule` (`schedule`),
  KEY `FK_emvarias_schedule_execution_novelties_emvarias_groups` (`group`),
  KEY `FK_emvarias_schedule_execution_novelties_emvarias_periods` (`period`),
  KEY `FK_emvarias_schedule_execution_novelties_users` (`created_by`),
  KEY `FK_emvarias_schedule_execution_novelties_users_2` (`updated_by`),
  CONSTRAINT `FK_emvarias_schedule_execution_novelties_emvarias_groups` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_execution_novelties_emvarias_periods` FOREIGN KEY (`period`) REFERENCES `periods` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_execution_novelties_emvarias_schedule` FOREIGN KEY (`schedule`) REFERENCES `schedule` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_execution_novelties_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_execution_novelties_users_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_log
CREATE TABLE IF NOT EXISTS `schedule_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) DEFAULT NULL,
  `action` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `data_in` json DEFAULT NULL,
  `data_out` json DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_schedule_log_emvarias_schedule` (`schedule`),
  KEY `FK_emvarias_schedule_log_users` (`created_by`),
  CONSTRAINT `FK_emvarias_schedule_log_emvarias_schedule` FOREIGN KEY (`schedule`) REFERENCES `schedule` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_log_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(11) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  `medition` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_services_services_meditions` (`medition`),
  KEY `FK_services_services_categories` (`category`),
  CONSTRAINT `FK_services_services_categories` FOREIGN KEY (`category`) REFERENCES `services_categories` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_services_services_meditions` FOREIGN KEY (`medition`) REFERENCES `meditions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.services_categories
CREATE TABLE IF NOT EXISTS `services_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.short_links
CREATE TABLE IF NOT EXISTS `short_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `hash` varchar(50) CHARACTER SET latin1 NOT NULL,
  `link` text CHARACTER SET latin1 NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_short_links_users` (`created_by`),
  CONSTRAINT `FK_short_links_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.short_links_users
CREATE TABLE IF NOT EXISTS `short_links_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short_link` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `short_link` (`short_link`),
  KEY `user` (`user`),
  CONSTRAINT `FK_short_links_users_short_links` FOREIGN KEY (`short_link`) REFERENCES `short_links` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_short_links_users_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.status_marital
CREATE TABLE IF NOT EXISTS `status_marital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.study_levels
CREATE TABLE IF NOT EXISTS `study_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.study_status
CREATE TABLE IF NOT EXISTS `study_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8 NOT NULL,
  `password` longtext CHARACTER SET utf8 NOT NULL,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `names` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `surname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` text CHARACTER SET utf8,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8 NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `permissions` int(11) DEFAULT '1',
  `bulletin` int(1) DEFAULT NULL,
  `marketing` int(1) DEFAULT NULL,
  `analytic` int(1) DEFAULT NULL,
  `registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_connection` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `key_recovery` text CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE_username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`),
  KEY `FK_username` (`username`),
  KEY `email_key` (`email`),
  KEY `FK_users_pictures` (`avatar`),
  KEY `FK_users_identifications_types` (`identification_type`),
  KEY `FK_users_geo_departments` (`department`),
  KEY `FK_users_geo_citys` (`city`),
  KEY `FK_users_permissions_group` (`permissions`),
  CONSTRAINT `FK_users_geo_citys` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_users_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_users_identifications_types` FOREIGN KEY (`identification_type`) REFERENCES `identifications_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_users_permissions_group` FOREIGN KEY (`permissions`) REFERENCES `permissions_group` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_users_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_attachments
CREATE TABLE IF NOT EXISTS `z_heskv1_attachments` (
  `att_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `saved_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `download_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`att_id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_audit_trail
CREATE TABLE IF NOT EXISTS `z_heskv1_audit_trail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `entity_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `language_key` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_audit_trail_to_replacement_values
CREATE TABLE IF NOT EXISTS `z_heskv1_audit_trail_to_replacement_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `audit_trail_id` int(11) NOT NULL,
  `replacement_index` int(11) NOT NULL,
  `replacement_value` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_banned_emails
CREATE TABLE IF NOT EXISTS `z_heskv1_banned_emails` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `banned_by` smallint(5) unsigned NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_banned_ips
CREATE TABLE IF NOT EXISTS `z_heskv1_banned_ips` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ip_from` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_to` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_display` varchar(100) CHARACTER SET utf8 NOT NULL,
  `banned_by` smallint(5) unsigned NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_calendar_event
CREATE TABLE IF NOT EXISTS `z_heskv1_calendar_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `all_day` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_calendar_event_reminder
CREATE TABLE IF NOT EXISTS `z_heskv1_calendar_event_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `email_sent` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_categories
CREATE TABLE IF NOT EXISTS `z_heskv1_categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `cat_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `autoassign` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `type` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `priority` enum('0','1','2','3') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `manager` int(11) NOT NULL DEFAULT '0',
  `background_color` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '#FFFFFF',
  `usage` int(11) NOT NULL DEFAULT '0',
  `foreground_color` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'AUTO',
  `display_border_outline` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `mfh_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mfh_category_group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_custom_fields
CREATE TABLE IF NOT EXISTS `z_heskv1_custom_fields` (
  `id` tinyint(3) unsigned NOT NULL,
  `use` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `place` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'text',
  `req` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `category` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `order` smallint(5) unsigned NOT NULL DEFAULT '10',
  `mfh_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `useType` (`use`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_custom_nav_element
CREATE TABLE IF NOT EXISTS `z_heskv1_custom_nav_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` text CHARACTER SET utf8,
  `font_icon` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `place` int(11) NOT NULL,
  `url` varchar(500) CHARACTER SET utf8 NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_custom_nav_element_to_text
CREATE TABLE IF NOT EXISTS `z_heskv1_custom_nav_element_to_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nav_element_id` int(11) NOT NULL,
  `language` varchar(200) CHARACTER SET utf8 NOT NULL,
  `text` varchar(200) CHARACTER SET utf8 NOT NULL,
  `subtext` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_custom_statuses
CREATE TABLE IF NOT EXISTS `z_heskv1_custom_statuses` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `can_customers_change` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `order` smallint(5) unsigned NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_kb_articles
CREATE TABLE IF NOT EXISTS `z_heskv1_kb_articles` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` smallint(5) unsigned NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `votes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `html` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `sticky` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `art_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `history` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attachments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`),
  KEY `sticky` (`sticky`),
  KEY `type` (`type`),
  FULLTEXT KEY `subject` (`subject`,`content`,`keywords`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_kb_attachments
CREATE TABLE IF NOT EXISTS `z_heskv1_kb_attachments` (
  `att_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `saved_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `real_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `download_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_kb_categories
CREATE TABLE IF NOT EXISTS `z_heskv1_kb_categories` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` smallint(5) unsigned NOT NULL,
  `articles` smallint(5) unsigned NOT NULL DEFAULT '0',
  `articles_private` smallint(5) unsigned NOT NULL DEFAULT '0',
  `articles_draft` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cat_order` smallint(5) unsigned NOT NULL,
  `type` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_logging
CREATE TABLE IF NOT EXISTS `z_heskv1_logging` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `severity` int(11) NOT NULL,
  `location` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stack_trace` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_logins
CREATE TABLE IF NOT EXISTS `z_heskv1_logins` (
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `last_attempt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_mail
CREATE TABLE IF NOT EXISTS `z_heskv1_mail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` smallint(5) unsigned NOT NULL,
  `to` smallint(5) unsigned NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `deletedby` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `to` (`to`,`read`,`deletedby`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_mfh_calendar_business_hours
CREATE TABLE IF NOT EXISTS `z_heskv1_mfh_calendar_business_hours` (
  `day_of_week` int(11) NOT NULL,
  `start_time` varchar(5) CHARACTER SET utf8 NOT NULL,
  `end_time` varchar(5) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_mfh_category_groups
CREATE TABLE IF NOT EXISTS `z_heskv1_mfh_category_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_mfh_category_groups_i18n
CREATE TABLE IF NOT EXISTS `z_heskv1_mfh_category_groups_i18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_group_id` int(11) NOT NULL,
  `language` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_mfh_service_message_to_location
CREATE TABLE IF NOT EXISTS `z_heskv1_mfh_service_message_to_location` (
  `service_message_id` int(11) NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_notes
CREATE TABLE IF NOT EXISTS `z_heskv1_notes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ticket` mediumint(8) unsigned NOT NULL,
  `who` smallint(5) unsigned NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `attachments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticketid` (`ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_online
CREATE TABLE IF NOT EXISTS `z_heskv1_online` (
  `user_id` smallint(5) unsigned NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tmp` int(11) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `user_id` (`user_id`),
  KEY `dt` (`dt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_pending_verification_emails
CREATE TABLE IF NOT EXISTS `z_heskv1_pending_verification_emails` (
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ActivationKey` varchar(500) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_permission_templates
CREATE TABLE IF NOT EXISTS `z_heskv1_permission_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `heskprivileges` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `categories` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_pipe_loops
CREATE TABLE IF NOT EXISTS `z_heskv1_pipe_loops` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hits` smallint(1) unsigned NOT NULL DEFAULT '0',
  `message_hash` char(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `email` (`email`,`hits`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_quick_help_sections
CREATE TABLE IF NOT EXISTS `z_heskv1_quick_help_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_replies
CREATE TABLE IF NOT EXISTS `z_heskv1_replies` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `replyto` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attachments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `staffid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `rating` enum('1','5') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `read` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `html` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `replyto` (`replyto`),
  KEY `dt` (`dt`),
  KEY `staffid` (`staffid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_reply_drafts
CREATE TABLE IF NOT EXISTS `z_heskv1_reply_drafts` (
  `owner` smallint(5) unsigned NOT NULL,
  `ticket` mediumint(8) unsigned NOT NULL,
  `message` mediumtext CHARACTER SET utf8 NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `owner` (`owner`),
  KEY `ticket` (`ticket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_reset_password
CREATE TABLE IF NOT EXISTS `z_heskv1_reset_password` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user` smallint(5) unsigned NOT NULL,
  `hash` char(40) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(45) CHARACTER SET utf8 NOT NULL,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_service_messages
CREATE TABLE IF NOT EXISTS `z_heskv1_service_messages` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` smallint(5) unsigned NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `style` enum('0','1','2','3','4') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `type` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mfh_language` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ALL',
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_settings
CREATE TABLE IF NOT EXISTS `z_heskv1_settings` (
  `Key` varchar(200) CHARACTER SET utf8 NOT NULL,
  `Value` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_stage_tickets
CREATE TABLE IF NOT EXISTS `z_heskv1_stage_tickets` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `trackid` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(1000) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `category` smallint(5) unsigned NOT NULL DEFAULT '1',
  `priority` enum('0','1','2','3') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `subject` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstreply` timestamp NULL DEFAULT NULL,
  `closedat` timestamp NULL DEFAULT NULL,
  `articles` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `openedby` mediumint(8) DEFAULT '0',
  `firstreplyby` smallint(5) unsigned DEFAULT NULL,
  `closedby` mediumint(8) DEFAULT NULL,
  `replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `staffreplies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `owner` smallint(5) unsigned NOT NULL DEFAULT '0',
  `time_worked` time NOT NULL DEFAULT '00:00:00',
  `lastreplier` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `replierid` smallint(5) unsigned DEFAULT NULL,
  `archive` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `locked` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `attachments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `merged` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `history` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom1` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom2` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom3` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom4` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom5` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom6` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom7` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom8` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom9` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom10` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom11` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom12` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom13` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom14` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom15` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom16` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom17` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom18` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom19` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom20` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` mediumint(8) DEFAULT NULL,
  `latitude` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'E-0',
  `longitude` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT 'E-0',
  `html` enum('0','1') CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `user_agent` text CHARACTER SET utf8,
  `screen_resolution_width` int(11) DEFAULT NULL,
  `screen_resolution_height` int(11) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `overdue_email_sent` enum('0','1') CHARACTER SET utf8 DEFAULT NULL,
  `custom21` mediumtext CHARACTER SET utf8,
  `custom22` mediumtext CHARACTER SET utf8,
  `custom23` mediumtext CHARACTER SET utf8,
  `custom24` mediumtext CHARACTER SET utf8,
  `custom25` mediumtext CHARACTER SET utf8,
  `custom26` mediumtext CHARACTER SET utf8,
  `custom27` mediumtext CHARACTER SET utf8,
  `custom28` mediumtext CHARACTER SET utf8,
  `custom29` mediumtext CHARACTER SET utf8,
  `custom30` mediumtext CHARACTER SET utf8,
  `custom31` mediumtext CHARACTER SET utf8,
  `custom32` mediumtext CHARACTER SET utf8,
  `custom33` mediumtext CHARACTER SET utf8,
  `custom34` mediumtext CHARACTER SET utf8,
  `custom35` mediumtext CHARACTER SET utf8,
  `custom36` mediumtext CHARACTER SET utf8,
  `custom37` mediumtext CHARACTER SET utf8,
  `custom38` mediumtext CHARACTER SET utf8,
  `custom39` mediumtext CHARACTER SET utf8,
  `custom40` mediumtext CHARACTER SET utf8,
  `custom41` mediumtext CHARACTER SET utf8,
  `custom42` mediumtext CHARACTER SET utf8,
  `custom43` mediumtext CHARACTER SET utf8,
  `custom44` mediumtext CHARACTER SET utf8,
  `custom45` mediumtext CHARACTER SET utf8,
  `custom46` mediumtext CHARACTER SET utf8,
  `custom47` mediumtext CHARACTER SET utf8,
  `custom48` mediumtext CHARACTER SET utf8,
  `custom49` mediumtext CHARACTER SET utf8,
  `custom50` mediumtext CHARACTER SET utf8,
  PRIMARY KEY (`id`),
  KEY `trackid` (`trackid`),
  KEY `archive` (`archive`),
  KEY `categories` (`category`),
  KEY `statuses` (`status`),
  KEY `owner` (`owner`),
  KEY `openedby` (`openedby`,`firstreplyby`,`closedby`),
  KEY `dt` (`dt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_statuses
CREATE TABLE IF NOT EXISTS `z_heskv1_statuses` (
  `ID` int(11) NOT NULL,
  `TextColor` text CHARACTER SET utf8 NOT NULL,
  `IsNewTicketStatus` int(1) NOT NULL DEFAULT '0',
  `IsClosed` int(1) NOT NULL DEFAULT '0',
  `IsClosedByClient` int(1) NOT NULL DEFAULT '0',
  `IsCustomerReplyStatus` int(1) NOT NULL DEFAULT '0',
  `IsStaffClosedOption` int(1) NOT NULL DEFAULT '0',
  `IsStaffReopenedStatus` int(1) NOT NULL DEFAULT '0',
  `IsDefaultStaffReplyStatus` int(1) NOT NULL DEFAULT '0',
  `LockedTicketStatus` int(1) NOT NULL DEFAULT '0',
  `IsAutocloseOption` int(11) NOT NULL DEFAULT '0',
  `Closable` varchar(10) CHARACTER SET utf8 NOT NULL,
  `Key` text CHARACTER SET utf8,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_std_replies
CREATE TABLE IF NOT EXISTS `z_heskv1_std_replies` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reply_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_temp_attachment
CREATE TABLE IF NOT EXISTS `z_heskv1_temp_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `saved_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `type` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_text_to_status_xref
CREATE TABLE IF NOT EXISTS `z_heskv1_text_to_status_xref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_tickets
CREATE TABLE IF NOT EXISTS `z_heskv1_tickets` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `trackid` varchar(13) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category` smallint(5) unsigned NOT NULL DEFAULT '1',
  `priority` enum('0','1','2','3') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '3',
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dt` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `lastchange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firstreply` timestamp NULL DEFAULT NULL,
  `closedat` timestamp NULL DEFAULT NULL,
  `articles` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `openedby` mediumint(8) DEFAULT '0',
  `firstreplyby` smallint(5) unsigned DEFAULT NULL,
  `closedby` mediumint(8) DEFAULT NULL,
  `replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `staffreplies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `owner` smallint(5) unsigned NOT NULL DEFAULT '0',
  `assignedby` mediumint(8) DEFAULT NULL,
  `time_worked` time NOT NULL DEFAULT '00:00:00',
  `lastreplier` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `replierid` smallint(5) unsigned DEFAULT NULL,
  `archive` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `locked` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `attachments` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `merged` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `history` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom1` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom2` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom3` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom4` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom5` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom6` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom7` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom8` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom9` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom10` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom11` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom12` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom13` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom14` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom15` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom16` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom17` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom18` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom19` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom20` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` mediumint(8) DEFAULT NULL,
  `custom21` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom22` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom23` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom24` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom25` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom26` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom27` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom28` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom29` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom30` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom31` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom32` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom33` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom34` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom35` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom36` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom37` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom38` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom39` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom40` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom41` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom42` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom43` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom44` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom45` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom46` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom47` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom48` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom49` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `custom50` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'E-0',
  `longitude` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'E-0',
  `html` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `screen_resolution_width` int(11) DEFAULT NULL,
  `screen_resolution_height` int(11) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `overdue_email_sent` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trackid` (`trackid`),
  KEY `archive` (`archive`),
  KEY `categories` (`category`),
  KEY `statuses` (`status`),
  KEY `owner` (`owner`),
  KEY `openedby` (`openedby`,`firstreplyby`,`closedby`),
  KEY `dt` (`dt`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_ticket_templates
CREATE TABLE IF NOT EXISTS `z_heskv1_ticket_templates` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `message` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tpl_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_users
CREATE TABLE IF NOT EXISTS `z_heskv1_users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pass` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isadmin` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `signature` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `language` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `afterreply` enum('0','1','2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `autostart` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `autoreload` smallint(5) unsigned NOT NULL DEFAULT '0',
  `notify_customer_new` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_customer_reply` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `show_suggested` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_new_unassigned` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_new_my` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_reply_unassigned` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_reply_my` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_assigned` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_pm` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_note` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `default_list` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `autoassign` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `heskprivileges` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ratingneg` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ratingpos` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `active` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `notify_note_unassigned` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `default_calendar_view` int(11) NOT NULL DEFAULT '0',
  `notify_overdue_unassigned` enum('0','1') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `permission_template` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autoassign` (`autoassign`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_user_api_tokens
CREATE TABLE IF NOT EXISTS `z_heskv1_user_api_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.z_heskv1_verified_emails
CREATE TABLE IF NOT EXISTS `z_heskv1_verified_emails` (
  `Email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
