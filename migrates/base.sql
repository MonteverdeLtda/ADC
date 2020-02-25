-- --------------------------------------------------------
-- Host:                         midgard.dataservix.com
-- Versión del servidor:         5.7.29-0ubuntu0.18.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.3.0.5885
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla admin_procrm.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `economic_activity` int(11) DEFAULT NULL,
  `identification_type` int(11) NOT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `gender` varchar(20) DEFAULT 'other',
  `address` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_communications_parts
CREATE TABLE IF NOT EXISTS `accounts_communications_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `communication` int(11) DEFAULT NULL,
  `message` longtext,
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_contracts
CREATE TABLE IF NOT EXISTS `accounts_contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_contracts_accounts` (`account`),
  CONSTRAINT `FK_accounts_contracts_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_headquarters
CREATE TABLE IF NOT EXISTS `accounts_headquarters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `account` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_accounts_headquarters_addresses` (`address`),
  KEY `FK_accounts_headquarters_accounts` (`account`),
  CONSTRAINT `FK_accounts_headquarters_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_accounts_headquarters_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.accounts_types
CREATE TABLE IF NOT EXISTS `accounts_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `via_principal` int(11) DEFAULT NULL,
  `via_principal_number` varchar(10) NOT NULL,
  `via_principal_letter` varchar(10) NOT NULL,
  `via_principal_quadrant` varchar(10) NOT NULL,
  `via_secondary_number` varchar(10) NOT NULL,
  `via_secondary_letter` varchar(10) NOT NULL,
  `via_secondary_quadrant` varchar(10) NOT NULL,
  `via_end_number` varchar(10) NOT NULL,
  `via_end_extra` varchar(500) NOT NULL,
  `minsize` varchar(500) NOT NULL,
  `complete` varchar(500) NOT NULL,
  `point` point DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_addresses_geo_types_vias` (`via_principal`),
  KEY `FK_addresses_geo_citys` (`city`),
  KEY `FK_addresses_geo_departments` (`department`),
  CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`city`) REFERENCES `geo_citys` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `addresses_ibfk_2` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `addresses_ibfk_3` FOREIGN KEY (`via_principal`) REFERENCES `geo_types_vias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) NOT NULL,
  `names` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.contacts_types
CREATE TABLE IF NOT EXISTS `contacts_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities
CREATE TABLE IF NOT EXISTS `economic_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(350) NOT NULL,
  `session` int(11) NOT NULL,
  `division` int(11) NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_economic_activities_economic_activities_sessions` (`session`),
  KEY `FK_economic_activities_economic_activities_divitions` (`division`),
  CONSTRAINT `FK_economic_activities_economic_activities_divitions` FOREIGN KEY (`division`) REFERENCES `economic_activities_divitions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_economic_activities_economic_activities_sessions` FOREIGN KEY (`session`) REFERENCES `economic_activities_sessions` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=688 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities_divitions
CREATE TABLE IF NOT EXISTS `economic_activities_divitions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.economic_activities_sessions
CREATE TABLE IF NOT EXISTS `economic_activities_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `title` varchar(350) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_citys
CREATE TABLE IF NOT EXISTS `geo_citys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departamento_id` (`department`),
  KEY `id` (`id`),
  CONSTRAINT `FK_geo_citys_geo_departments` FOREIGN KEY (`department`) REFERENCES `geo_departments` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1103 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_departments
CREATE TABLE IF NOT EXISTS `geo_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_types_quadrants
CREATE TABLE IF NOT EXISTS `geo_types_quadrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.geo_types_vias
CREATE TABLE IF NOT EXISTS `geo_types_vias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `group_notification` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_groups_groups` (`group_notification`),
  CONSTRAINT `FK_emvarias_groups_notifications_groups` FOREIGN KEY (`group_notification`) REFERENCES `notifications_groups` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.headquarters
CREATE TABLE IF NOT EXISTS `headquarters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `address` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_headquarters_addresses` (`address`),
  CONSTRAINT `FK_headquarters_addresses` FOREIGN KEY (`address`) REFERENCES `addresses` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.identifications_types
CREATE TABLE IF NOT EXISTS `identifications_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `path_full` text NOT NULL,
  `path_short` varchar(250) NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_media_users` (`create_by`),
  CONSTRAINT `FK_media_users` FOREIGN KEY (`create_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.meditions
CREATE TABLE IF NOT EXISTS `meditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.menus_items
CREATE TABLE IF NOT EXISTS `menus_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `title` varchar(150) DEFAULT '',
  `parent` int(11) DEFAULT '0',
  `tag_id` varchar(150) DEFAULT NULL,
  `tag_class` json DEFAULT NULL,
  `tag_href` varchar(250) DEFAULT NULL,
  `tag_href_parms` json DEFAULT NULL,
  `tag_params` json DEFAULT NULL,
  `icon` varchar(50) DEFAULT '',
  `public` int(1) DEFAULT '0',
  `alls` int(1) DEFAULT '0',
  `guest` int(1) DEFAULT '0',
  `permission` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_nodes_items_menus` (`menu`),
  KEY `permission` (`permission`),
  KEY `tag_href` (`tag_href`),
  CONSTRAINT `menus_items_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2002 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.microroutes
CREATE TABLE IF NOT EXISTS `microroutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `id_ref` varchar(50) DEFAULT NULL,
  `description` text,
  `address_text` text,
  `area_m2` float DEFAULT '0',
  `zone_client` varchar(50) DEFAULT NULL,
  `obs` text,
  `last_executed` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_photographic_routes_lots` (`id`),
  KEY `id_ref` (`id_ref`),
  KEY `microroute_name` (`name`) USING BTREE,
  KEY `FK_microroutes_accounts_contracts` (`contract`),
  KEY `FK_microroutes_accounts` (`account`),
  CONSTRAINT `FK_microroutes_accounts` FOREIGN KEY (`account`) REFERENCES `accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_microroutes_accounts_contracts` FOREIGN KEY (`contract`) REFERENCES `accounts_contracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1207 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT 'default',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications_groups
CREATE TABLE IF NOT EXISTS `notifications_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT 'Grupo sin titulo',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.notifications_groups_users
CREATE TABLE IF NOT EXISTS `notifications_groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_groups_users_groups` (`group`),
  KEY `FK_groups_users_users` (`user`),
  CONSTRAINT `FK_groups_users_groups` FOREIGN KEY (`group`) REFERENCES `notifications_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_groups_users_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
  `file_name` varchar(150) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` varchar(50) NOT NULL,
  `file_path_full` text NOT NULL,
  `file_path_short` varchar(250) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
  `notes` mediumtext,
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.periods
CREATE TABLE IF NOT EXISTS `periods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `start_day` int(11) DEFAULT NULL,
  `start_month` int(11) DEFAULT NULL,
  `end_day` int(11) DEFAULT NULL,
  `end_month` int(11) DEFAULT NULL,
  `start` varchar(50) DEFAULT NULL,
  `end` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.permissions_group
CREATE TABLE IF NOT EXISTS `permissions_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `for_user` int(1) DEFAULT '0',
  `for_account` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.permissions_items
CREATE TABLE IF NOT EXISTS `permissions_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`tag`),
  KEY `id` (`id`),
  KEY `tag KEY` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `size` int(32) NOT NULL,
  `data` mediumblob NOT NULL,
  `type` varchar(50) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

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
  `title` text NOT NULL,
  `parent` int(11) unsigned DEFAULT NULL,
  `request_uri` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT 'post',
  `view` varchar(50) NOT NULL DEFAULT 'wellcome',
  `layout` varchar(50) NOT NULL DEFAULT 'main',
  `mime_type` varchar(100) NOT NULL DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_comments
CREATE TABLE IF NOT EXISTS `schedule_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) NOT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `comment` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_emvarias_schedule_comments_users` (`created_by`),
  KEY `FK_emvarias_schedule_comments_emvarias_schedule` (`schedule`),
  CONSTRAINT `FK_emvarias_schedule_comments_emvarias_schedule` FOREIGN KEY (`schedule`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_emvarias_schedule_comments_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_execution_novelties
CREATE TABLE IF NOT EXISTS `schedule_execution_novelties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT '0',
  `period` int(11) DEFAULT '0',
  `year` year(4) DEFAULT '2000',
  `comment` mediumtext NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla admin_procrm.schedule_log
CREATE TABLE IF NOT EXISTS `schedule_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

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

-- Volcando estructura para tabla admin_procrm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` longtext NOT NULL,
  `identification_type` int(11) DEFAULT NULL,
  `identification_number` varchar(50) DEFAULT NULL,
  `names` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `address` text,
  `department` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `permissions` int(11) DEFAULT '1',
  `bulletin` int(1) DEFAULT NULL,
  `marketing` int(1) DEFAULT NULL,
  `analytic` int(1) DEFAULT NULL,
  `registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_connection` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

