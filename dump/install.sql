# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.47)
# Database: modou
# Generation Time: 2011-05-01 11:07:36 +0800
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table feedbacks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedbacks`;

CREATE TABLE `feedbacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `people_id` int(11) unsigned DEFAULT NULL,
  `message` text NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `ua` text,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table peoples
# ------------------------------------------------------------

DROP TABLE IF EXISTS `peoples`;

CREATE TABLE `peoples` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `douban_id` int(11) unsigned NOT NULL,
  `username` varchar(40) DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `homepage` varchar(100) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX_DBID` (`douban_id`),
  KEY `INDEX_USERNAME` (`username`),
  KEY `INDEX_LOCATION` (`location`),
  KEY `INDEX_LASTLOGIN` (`last_login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='moDou User Table';



# Dump of table user_agents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_agents`;

CREATE TABLE `user_agents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `people_id` int(11) unsigned NOT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `platform` varchar(100) DEFAULT NULL,
  `is_mobile` int(1) unsigned DEFAULT '0',
  `ua` text,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='moDou User Agents Table';






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
