/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.11 : Database - esxstable
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`esxstable` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `esxstable`;

/*Table structure for table `addon_account` */


/*Table structure for table `bans` */

CREATE TABLE `bans` (
  `id` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `steam` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `fecha` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `tiempo` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `admin` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `razon` varchar(400) CHARACTER SET utf8mb4 NOT NULL,
  `baneado` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `panel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Table structure for table `bansperm` */

CREATE TABLE `bansperm` (
  `id` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `steam` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `fecha` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `admin` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `razon` varchar(400) CHARACTER SET utf8mb4 NOT NULL,
  `baneado` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `panel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Table structure for table `billing` */

/*Table structure for table `panel_coches` */

CREATE TABLE `panel_coches` (
  `nombre` text CHARACTER SET utf8,
  `hash` text CHARACTER SET utf8,
  `tipo` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `panel_donadores` */

CREATE TABLE `panel_donadores` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `staff` text CHARACTER SET utf8 NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo` text CHARACTER SET utf8 NOT NULL,
  `user` text CHARACTER SET utf8,
  `license` longtext CHARACTER SET utf8 NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1032 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `panel_logusers` */

CREATE TABLE `panel_logusers` (
  `STAFF` text CHARACTER SET utf8 NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TIPO` text CHARACTER SET utf8 NOT NULL,
  `USER` text CHARACTER SET utf8,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LICENCIA` longtext CHARACTER SET utf8 NOT NULL,
  `RAZON` longtext CHARACTER SET utf8,
  KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3778 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `panel_negros` */

CREATE TABLE `panel_negros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` text CHARACTER SET utf8,
  `inicio` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `final` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `tiempo` longtext CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4071 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `panel_servers` */

CREATE TABLE `panel_servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET latin1 NOT NULL,
  `ip` text CHARACTER SET latin1 NOT NULL,
  `puerto` int(11) NOT NULL,
  `rcon` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `panel_tickets` */

CREATE TABLE `panel_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff` text CHARACTER SET utf8 NOT NULL,
  `usuario` text CHARACTER SET utf8 NOT NULL,
  `steamid` text CHARACTER SET utf8,
  `licencia` text CHARACTER SET utf8 NOT NULL,
  `razon` longtext CHARACTER SET utf8 NOT NULL,
  `comentarios` longtext CHARACTER SET utf8,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tiempo` text CHARACTER SET utf8 NOT NULL,
  `tipo` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff2` text CHARACTER SET utf8,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38718 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

/*Table structure for table `panel_users` */

CREATE TABLE `panel_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` longtext CHARACTER SET latin1 NOT NULL,
  `PASS` longtext CHARACTER SET latin1 NOT NULL,
  `STEAMID` longtext CHARACTER SET latin1,
  `LICENCIA` longtext CHARACTER SET latin1,
  `RANGO` text CHARACTER SET latin1 NOT NULL,
  `lvRANGO` int(11) NOT NULL DEFAULT '2',
  `ACTIVO` tinyint(1) NOT NULL DEFAULT '0',
  `tiempo` longtext CHARACTER SET latin1,
  `servicio` int(11) DEFAULT NULL,
  `sesionA` text CHARACTER SET latin1,
  `LastIP` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10000165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



CREATE TABLE `users` (
  `identifier` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `lastLogin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `isDonator` int(11) DEFAULT '0',
  `bank` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '',
  `isDead` int(11) NOT NULL DEFAULT '0',
  `job` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'unemployed',
  `job_grade` int(11) DEFAULT '0',
  `license` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `skin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `loadout` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT '{"x":-384.84,"y":6123.48,"z":31.48}',
  `permission_level` int(11) DEFAULT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `phone_number` int(11) DEFAULT NULL,
  `last_property` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `groupid` int(1) DEFAULT '0',
  `animal` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `addicted` tinyint(3) DEFAULT '0',
  `conectado` tinyint(3) DEFAULT '0',
  `puerto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `firstLogin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `skills` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `gift` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
