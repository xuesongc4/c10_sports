-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: dev_sports_betting
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bets`
--

DROP TABLE IF EXISTS `bets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bets` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `amount` smallint(5) unsigned NOT NULL,
  `settled` tinyint(1) NOT NULL,
  `bet_type_id` tinyint(3) unsigned NOT NULL,
  `game_id` bigint(20) unsigned NOT NULL,
  `side` tinyint(1) NOT NULL,
  `line` varchar(15) NOT NULL,
  `odds` smallint(6) NOT NULL,
  `time_placed` datetime NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`user_id`),
  KEY `game_id` (`game_id`),
  KEY `bet_type_id` (`bet_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=519 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bets`
--

LOCK TABLES `bets` WRITE;
/*!40000 ALTER TABLE `bets` DISABLE KEYS */;
INSERT INTO `bets` VALUES (20,1,100,3,1,201,1,'-2.5',-105,'0000-00-00 00:00:00',''),(21,3,100,3,1,201,1,'-2.5',-105,'0000-00-00 00:00:00',''),(22,3,100,3,2,201,1,'-130',-130,'0000-00-00 00:00:00',''),(23,3,100,1,3,201,0,'43',-105,'0000-00-00 00:00:00',''),(24,3,100,1,1,204,1,'-7.5',106,'0000-00-00 00:00:00',''),(25,3,100,3,2,204,1,'-300',-300,'0000-00-00 00:00:00',''),(26,3,100,1,3,204,1,'44.5',-113,'0000-00-00 00:00:00',''),(27,3,100,3,1,207,0,'-6',-109,'0000-00-00 00:00:00',''),(28,3,100,3,2,207,0,'217',217,'0000-00-00 00:00:00',''),(29,3,100,3,3,207,0,'41',-106,'0000-00-00 00:00:00',''),(30,3,100,1,1,200,0,'-3.5',-102,'0000-00-00 00:00:00',''),(31,3,100,1,2,200,0,'167',167,'0000-00-00 00:00:00',''),(32,3,100,1,3,200,0,'44',-102,'0000-00-00 00:00:00',''),(33,3,100,3,1,203,0,'7',-102,'0000-00-00 00:00:00',''),(34,3,100,3,2,203,0,'-290',-290,'0000-00-00 00:00:00',''),(35,3,100,1,3,203,1,'48.5',100,'0000-00-00 00:00:00',''),(36,3,100,2,1,205,0,'3',-105,'0000-00-00 00:00:00',''),(37,3,100,3,2,205,0,'-153',-153,'0000-00-00 00:00:00',''),(38,3,100,3,3,205,0,'44.5',-101,'0000-00-00 00:00:00',''),(39,3,100,3,1,199,0,'3.5',-107,'0000-00-00 00:00:00',''),(40,3,100,3,2,199,0,'-190',-190,'0000-00-00 00:00:00',''),(41,3,100,1,3,199,0,'53',100,'0000-00-00 00:00:00',''),(42,3,100,3,1,193,0,'-7.5',-120,'0000-00-00 00:00:00',''),(43,3,100,1,2,193,1,'-307',-307,'0000-00-00 00:00:00',''),(44,3,100,1,3,193,0,'54',-114,'0000-00-00 00:00:00',''),(45,3,100,3,1,198,1,'-4',-103,'0000-00-00 00:00:00',''),(46,3,100,3,2,198,1,'-193',-193,'0000-00-00 00:00:00',''),(47,3,100,1,3,198,0,'47',-104,'0000-00-00 00:00:00',''),(48,3,100,1,1,194,0,'-2',-109,'0000-00-00 00:00:00',''),(49,3,100,1,2,194,0,'107',107,'0000-00-00 00:00:00',''),(50,3,100,3,3,194,1,'43.5',-102,'0000-00-00 00:00:00',''),(51,3,100,1,1,206,1,'-7',104,'0000-00-00 00:00:00',''),(52,3,100,3,2,206,1,'-285',-285,'0000-00-00 00:00:00',''),(53,3,100,3,3,206,1,'44',-114,'0000-00-00 00:00:00',''),(55,4,100,3,1,201,1,'-2.5',-108,'0000-00-00 00:00:00',''),(56,4,100,1,1,204,1,'-7.5',106,'0000-00-00 00:00:00',''),(57,4,100,3,2,207,0,'217',217,'0000-00-00 00:00:00',''),(58,4,100,3,2,200,1,'-184',-184,'0000-00-00 00:00:00',''),(59,4,100,3,1,203,0,'7.5',111,'0000-00-00 00:00:00',''),(60,4,100,2,1,205,0,'3',-100,'0000-00-00 00:00:00',''),(61,4,100,1,3,199,0,'53',100,'0000-00-00 00:00:00',''),(62,4,100,3,1,199,0,'3.5',-107,'0000-00-00 00:00:00',''),(63,4,100,1,1,193,1,'-7.5',111,'0000-00-00 00:00:00',''),(64,3,100,3,1,242,1,'-5.5',-100,'0000-00-00 00:00:00',''),(65,3,100,3,1,240,1,'-3',-107,'0000-00-00 00:00:00',''),(66,3,100,3,1,239,0,'-5.5',102,'0000-00-00 00:00:00',''),(67,3,100,3,1,237,1,'-4.5',-106,'0000-00-00 00:00:00',''),(68,3,100,1,1,241,0,'-3',-106,'0000-00-00 00:00:00',''),(69,3,100,3,1,244,1,'-2.5',-109,'0000-00-00 00:00:00',''),(70,3,100,1,1,238,1,'-4.5',-113,'0000-00-00 00:00:00',''),(71,4,100,3,2,201,1,'-130',-130,'0000-00-00 00:00:00',''),(72,3,100,2,1,206,1,'-6',102,'2016-11-08 01:07:06',''),(73,3,100,3,2,206,1,'-230',-230,'2016-11-08 01:07:13',''),(74,3,100,3,3,206,1,'43',-100,'2016-11-08 01:07:20',''),(75,3,100,1,1,258,0,'-10.5',-119,'2016-11-08 05:08:17',''),(76,3,100,3,3,258,0,'45.5',-105,'2016-11-08 05:08:26',''),(77,3,100,1,1,263,0,'0',-102,'2016-11-08 05:08:45',''),(78,3,100,1,3,263,1,'50.5',-105,'2016-11-08 05:08:58',''),(79,3,100,1,1,262,1,'-2',-102,'2016-11-08 05:09:25',''),(80,3,100,1,3,262,1,'40',-110,'2016-11-08 05:09:37',''),(81,3,100,3,1,259,0,'1.5',-110,'2016-11-08 05:09:54',''),(82,3,100,1,3,259,0,'42.5',-105,'2016-11-08 05:10:01',''),(83,3,100,1,1,264,0,'-3',-105,'2016-11-08 05:10:16',''),(84,3,100,3,3,264,1,'42.5',-110,'2016-11-08 05:10:27',''),(85,3,100,1,1,260,1,'-3',-110,'2016-11-08 05:10:41',''),(86,3,100,1,3,260,1,'44',-108,'2016-11-08 05:10:51',''),(87,3,100,1,1,261,1,'-1.5',-110,'2016-11-08 05:11:05',''),(88,3,100,3,3,261,0,'48.5',-105,'2016-11-08 05:11:13',''),(89,3,100,1,1,265,0,'2.5',-108,'2016-11-08 05:11:31',''),(90,3,100,1,3,265,0,'49',-105,'2016-11-08 05:11:40',''),(91,3,100,1,1,267,1,'-3.5',-109,'2016-11-08 05:11:58',''),(92,3,100,1,1,267,1,'-3.5',-109,'2016-11-08 05:12:06',''),(93,3,100,3,3,267,1,'48.5',-100,'2016-11-08 05:12:35',''),(94,3,100,1,1,268,1,'-13.5',-105,'2016-11-08 05:13:01',''),(95,3,100,3,3,268,0,'48',-110,'2016-11-08 05:13:10',''),(96,3,100,3,1,269,0,'-2.5',102,'2016-11-08 05:14:21',''),(97,3,100,3,3,269,1,'49.5',-100,'2016-11-08 05:14:33',''),(98,3,100,1,1,271,1,'-2.5',100,'2016-11-08 05:14:45',''),(99,3,100,3,3,271,0,'47',-105,'2016-11-08 05:14:55',''),(102,4,100,3,1,258,1,'-10.5',108,'2016-11-08 23:37:26',''),(103,4,100,1,2,263,0,'0',0,'2016-11-08 23:37:44',''),(104,4,100,1,1,271,1,'-2.5',100,'2016-11-08 23:38:17',''),(105,4,100,3,1,269,0,'-2.5',102,'2016-11-08 23:38:26',''),(106,4,100,1,3,262,1,'40',-110,'2016-11-08 23:38:49',''),(107,4,100,1,1,260,1,'-3',-110,'2016-11-08 23:39:38',''),(108,1,100,1,1,262,1,'-2',-102,'2016-11-09 00:44:38',''),(109,4,100,3,1,263,1,'0',-108,'2016-11-13 00:01:26',''),(110,3,100,1,1,289,1,'-8',-105,'2016-11-13 17:46:53',''),(111,3,100,3,2,289,1,'-357',-357,'2016-11-13 17:46:59',''),(112,3,100,1,2,290,1,'-424',-424,'2016-11-13 17:47:09',''),(113,3,100,3,1,279,1,'-4.5',-110,'2016-11-13 17:47:17',''),(114,3,100,3,1,281,1,'-5.5',-105,'2016-11-13 17:48:08',''),(115,4,100,3,1,315,0,'-7.5',-114,'2016-11-14 21:20:14',''),(116,3,100,3,1,271,1,'1',-110,'2016-11-15 00:23:02',''),(117,3,100,3,2,271,1,'-103',-103,'2016-11-15 00:23:08',''),(118,3,100,3,3,271,0,'47.5',-105,'2016-11-15 00:23:12',''),(119,3,100,3,1,312,0,'-3.5',-117,'2016-11-15 07:06:00',''),(120,3,100,3,3,312,0,'51',-113,'2016-11-15 07:06:06',''),(121,3,100,1,1,317,0,'0',-104,'2016-11-15 07:06:15',''),(122,3,100,3,3,317,1,'41',-111,'2016-11-15 07:06:24',''),(123,3,100,3,3,314,0,'47',-114,'2016-11-15 07:06:28',''),(124,3,100,3,1,314,1,'-6.5',-105,'2016-11-15 07:06:34',''),(125,3,100,1,1,319,0,'-7.5',-123,'2016-11-15 07:06:45',''),(126,3,100,3,3,319,0,'45',103,'2016-11-15 07:06:49',''),(127,3,100,3,1,315,0,'-7.5',-114,'2016-11-15 07:06:56',''),(128,3,100,3,3,315,0,'44.5',-108,'2016-11-15 07:06:59',''),(129,3,100,3,1,320,0,'8',-102,'2016-11-15 07:07:04',''),(130,3,100,3,3,320,0,'49',-103,'2016-11-15 07:07:06',''),(131,3,100,1,1,313,0,'-3',-103,'2016-11-15 07:07:15',''),(132,3,100,3,3,313,0,'52',-106,'2016-11-15 07:07:18',''),(133,3,100,1,1,321,1,'-1',-110,'2016-11-15 07:07:27',''),(134,3,100,1,3,321,1,'40.5',-105,'2016-11-15 07:07:30',''),(135,3,100,2,1,322,0,'13',-100,'2016-11-15 07:07:38',''),(136,3,100,3,3,322,0,'50.5',-105,'2016-11-15 07:07:41',''),(137,3,100,1,3,323,1,'44.5',-103,'2016-11-15 07:07:46',''),(138,3,100,3,1,323,1,'-6.5',-108,'2016-11-15 07:07:49',''),(139,3,100,1,1,324,0,'-2.5',105,'2016-11-15 07:07:54',''),(140,3,100,1,3,324,0,'50.5',-105,'2016-11-15 07:07:57',''),(141,3,100,3,1,325,1,'-5',-107,'2016-11-15 07:08:02',''),(142,3,100,3,3,325,1,'46',-105,'2016-11-15 07:08:08',''),(143,4,100,3,3,312,0,'51.5',-109,'2016-11-15 22:04:00',''),(144,4,100,1,1,317,0,'0',-104,'2016-11-15 22:04:09',''),(145,4,100,3,2,313,1,'-155',-155,'2016-11-15 22:04:29',''),(146,4,100,2,1,322,0,'13',-100,'2016-11-15 22:04:40',''),(147,4,100,3,3,322,0,'50.5',-105,'2016-11-15 22:04:47',''),(148,4,100,3,1,314,1,'-6.5',-105,'2016-11-15 22:05:03',''),(149,3,100,1,1,337,0,'5.5',-110,'2016-11-17 01:42:25',''),(150,3,100,1,1,337,0,'5.5',-110,'2016-11-17 01:52:51',''),(151,3,100,3,2,337,0,'-225',-225,'2016-11-17 01:52:54',''),(152,3,100,1,1,337,0,'5.5',-110,'2016-11-17 01:53:06',''),(153,3,100,3,1,336,1,'-4.5',-102,'2016-11-17 01:53:14',''),(154,3,100,3,1,312,0,'-3.5',-110,'2016-11-17 01:53:29',''),(155,3,100,3,1,325,1,'-5.5',-106,'2016-11-17 01:53:49',''),(156,3,100,1,1,338,1,'-12.5',-105,'2016-11-17 02:12:06',''),(157,3,100,3,3,338,1,'200',-110,'2016-11-17 02:16:12',''),(158,3,100,1,3,337,0,'197.5',-106,'2016-11-17 02:16:26',''),(159,3,100,3,3,312,0,'52.5',-108,'2016-11-17 23:39:44',''),(160,1,100,3,1,342,1,'-5',-107,'2016-11-17 23:41:46',''),(161,1,100,3,2,342,1,'-195',-195,'2016-11-17 23:44:21',''),(162,4,100,3,1,320,0,'7.5',-105,'2016-11-18 19:30:03',''),(163,4,100,3,1,325,1,'-6',-101,'2016-11-18 19:30:20',''),(164,4,100,3,2,323,1,'-265',-265,'2016-11-18 19:31:19',''),(165,4,100,3,1,347,0,'7',-105,'2016-11-18 21:47:43',''),(166,4,100,1,1,347,1,'7',-105,'2016-11-18 21:47:49',''),(167,4,100,3,1,353,0,'-7.5',100,'2016-11-18 21:48:02',''),(168,4,100,1,1,353,1,'-7.5',-110,'2016-11-18 21:48:05',''),(169,3,100,3,1,361,0,'-4.5',-106,'2016-11-19 18:55:58',''),(170,3,100,1,3,357,0,'181',-105,'2016-11-19 18:56:17',''),(171,3,100,1,1,316,1,'-7.5',-101,'2016-11-19 18:56:46',''),(172,3,100,1,3,316,1,'43',-102,'2016-11-19 18:56:55',''),(173,3,100,3,2,316,1,'-320',-320,'2016-11-19 18:56:59',''),(174,3,100,1,1,318,1,'-2.5',-104,'2016-11-19 18:57:10',''),(175,3,100,1,2,318,1,'-125',-125,'2016-11-19 18:57:15',''),(176,3,100,1,3,318,1,'47',-104,'2016-11-19 18:57:19',''),(177,1,100,3,1,318,0,'-2.5',-106,'2016-11-19 23:05:44',''),(178,3,100,1,1,316,1,'-7.5',-101,'2016-11-20 03:47:32',''),(179,3,100,1,1,370,0,'3',-109,'2016-11-20 03:48:04',''),(180,3,100,1,1,317,0,'-2.5',-105,'2016-11-20 05:43:59',''),(181,3,100,3,1,325,1,'-6',-100,'2016-11-21 20:51:54',''),(182,3,100,3,3,325,1,'45',-106,'2016-11-21 20:52:00',''),(183,3,100,3,2,325,1,'-240',-240,'2016-11-21 20:52:03',''),(184,3,100,1,3,325,0,'45',-104,'2016-11-21 21:14:30',''),(185,3,100,1,3,325,0,'45',-104,'2016-11-21 21:17:00',''),(186,3,100,1,3,381,1,'42.5',-101,'2016-11-21 21:17:35',''),(187,3,100,3,3,395,1,'48.5',-102,'2016-11-21 21:19:44',''),(188,3,100,1,3,376,0,'194',-116,'2016-11-21 21:21:07',''),(189,3,100,3,3,375,0,'198',100,'2016-11-21 21:22:37',''),(190,3,100,1,2,325,0,'241',241,'2016-11-21 23:29:55',''),(191,3,100,3,2,325,1,'-272',-272,'2016-11-21 23:35:27',''),(192,3,100,3,1,380,0,'-16',-109,'2016-11-22 01:09:11',''),(193,3,100,3,2,380,1,'-4200',-4200,'2016-11-22 01:09:19',''),(194,3,100,1,3,380,0,'184.5',-107,'2016-11-22 01:09:30',''),(195,3,100,1,3,373,0,'208.5',-106,'2016-11-22 01:09:45',''),(196,3,100,3,2,373,1,'-450',-450,'2016-11-22 01:09:49',''),(197,3,100,3,1,373,0,'-8.5',-100,'2016-11-22 01:09:59',''),(198,5,100,1,1,373,1,'-8.5',-110,'2016-11-22 02:21:39',''),(199,3,100,1,1,381,0,'-2.5',102,'2016-11-22 06:29:49',''),(200,3,100,1,2,381,0,'121',121,'2016-11-22 06:29:56',''),(201,3,100,3,1,395,0,'-7.5',-123,'2016-11-22 06:30:06',''),(202,3,100,1,1,387,0,'-4',-105,'2016-11-22 06:30:30',''),(203,3,100,1,3,387,0,'50.5',-105,'2016-11-22 06:30:42',''),(204,3,100,1,1,384,1,'3',111,'2016-11-22 06:30:48',''),(205,3,100,1,3,384,0,'43',-105,'2016-11-22 06:30:54',''),(206,3,100,3,1,388,0,'-7.5',-105,'2016-11-22 06:31:05',''),(207,3,100,3,3,388,1,'45.5',-105,'2016-11-22 06:31:13',''),(208,3,100,3,3,385,1,'45.5',-105,'2016-11-22 06:31:21',''),(209,3,100,2,1,385,1,'-7',-105,'2016-11-22 06:31:27',''),(210,3,100,3,1,386,1,'-4.5',-105,'2016-11-22 06:31:37',''),(211,3,100,1,3,386,1,'40.5',-102,'2016-11-22 06:31:44',''),(212,3,100,3,1,390,0,'7',105,'2016-11-22 06:32:12',''),(213,3,100,3,3,390,0,'44.5',103,'2016-11-22 06:32:16',''),(214,3,100,3,1,389,1,'-7.5',109,'2016-11-22 06:32:25',''),(215,3,100,1,3,389,0,'45.5',-105,'2016-11-22 06:32:32',''),(216,3,100,1,1,391,0,'5',-109,'2016-11-22 06:32:41',''),(217,3,100,1,3,391,1,'45',-105,'2016-11-22 06:32:48',''),(218,3,100,1,1,394,0,'7.5',-105,'2016-11-22 06:33:00',''),(219,3,100,1,3,394,1,'47',-101,'2016-11-22 06:33:12',''),(220,3,100,3,1,393,0,'-3.5',-120,'2016-11-22 06:33:23',''),(221,3,100,3,3,393,1,'39.5',-105,'2016-11-22 06:33:34',''),(222,3,100,1,1,397,0,'-2',-110,'2016-11-22 06:34:04',''),(223,3,100,1,1,399,0,'2',-110,'2016-11-22 06:34:12',''),(224,3,100,1,1,398,0,'1',-108,'2016-11-22 06:34:19',''),(225,5,100,3,1,404,1,'6',-105,'2016-11-23 23:22:48',''),(226,5,100,3,1,412,1,'-2',-113,'2016-11-23 23:22:55',''),(227,1,100,3,1,404,1,'6',-105,'2016-11-23 23:23:31',''),(228,1,100,3,1,412,1,'-2',-113,'2016-11-23 23:23:45',''),(229,5,100,1,1,381,0,'-1.5',-110,'2016-11-24 04:10:06',''),(230,5,100,1,1,382,1,'10',-127,'2016-11-24 04:10:19',''),(231,5,100,1,1,385,1,'-7.5',-102,'2016-11-24 04:10:44',''),(232,5,100,1,1,386,0,'-3.5',-107,'2016-11-24 04:10:55',''),(233,5,100,2,1,392,0,'-3',-108,'2016-11-24 04:11:05',''),(234,5,100,3,1,394,1,'7.5',-116,'2016-11-24 04:11:11',''),(235,4,100,3,1,382,0,'10',118,'2016-11-24 23:51:25',''),(236,4,100,3,1,382,0,'10',118,'2016-11-24 23:51:44',''),(237,4,100,3,3,382,0,'48',100,'2016-11-24 23:51:52',''),(238,0,100,1,2,385,0,'289',289,'2016-11-25 05:17:11',''),(239,3,100,3,1,414,0,'3',-109,'2016-11-25 18:00:30',''),(240,3,100,3,2,414,0,'-152',-152,'2016-11-25 18:00:34',''),(241,3,100,3,3,414,1,'200.5',-110,'2016-11-25 18:00:38',''),(242,3,100,3,1,415,0,'1.5',-110,'2016-11-25 18:00:45',''),(243,3,100,3,1,421,0,'3',-105,'2016-11-25 18:01:00',''),(244,3,100,3,1,427,0,'3',-110,'2016-11-25 18:01:09',''),(245,3,100,3,1,428,0,'12.5',-110,'2016-11-25 18:01:15',''),(246,1,100,1,2,424,1,'109',109,'2016-11-26 00:05:32',''),(247,1,100,3,1,426,1,'-4',-108,'2016-11-26 00:05:40',''),(248,1,100,1,1,428,1,'13.5',-104,'2016-11-26 00:05:46',''),(249,3,100,3,1,383,0,'2.5',-112,'2016-11-27 09:03:33',''),(250,3,100,3,2,383,0,'-140',-140,'2016-11-27 09:03:36',''),(251,3,100,1,1,392,1,'-3.5',110,'2016-11-27 09:03:45',''),(252,3,100,3,2,392,1,'-177',-177,'2016-11-27 09:03:49',''),(253,3,100,3,3,392,1,'50',100,'2016-11-27 09:03:53',''),(254,3,100,1,1,434,0,'12',-106,'2016-11-27 09:04:07',''),(255,3,100,1,1,440,1,'2',103,'2016-11-27 09:04:20',''),(256,3,100,1,1,450,0,'3.5',102,'2016-11-30 02:48:22',''),(257,3,100,3,2,450,0,'-190',-190,'2016-11-30 02:48:29',''),(258,4,100,3,1,478,1,'-6',102,'2016-11-30 20:30:44',''),(259,3,100,1,1,474,0,'8.5',-105,'2016-11-30 22:44:06',''),(260,4,100,1,1,450,0,'3',-110,'2016-12-01 20:09:58',''),(261,4,100,1,1,450,0,'3',-110,'2016-12-01 20:10:02',''),(262,3,100,3,1,481,0,'-11',-104,'2016-12-01 20:51:30',''),(263,3,100,1,2,481,0,'534',534,'2016-12-01 20:51:33',''),(264,3,100,1,3,481,1,'193.5',-105,'2016-12-01 20:51:37',''),(265,3,100,1,1,481,1,'-11',-106,'2016-12-01 20:51:40',''),(266,3,100,3,2,481,1,'-650',-650,'2016-12-01 20:51:44',''),(267,3,100,3,3,481,0,'193.5',-105,'2016-12-01 20:51:47',''),(268,3,100,3,1,482,0,'4.5',-104,'2016-12-01 20:51:51',''),(269,3,100,3,2,482,0,'-180',-180,'2016-12-01 20:51:54',''),(270,3,100,1,3,482,1,'216.5',-105,'2016-12-01 20:51:58',''),(271,3,100,1,1,482,1,'4.5',-106,'2016-12-01 20:52:10',''),(272,3,100,1,2,482,1,'162',162,'2016-12-01 20:52:13',''),(273,3,100,3,3,482,0,'216.5',-105,'2016-12-01 20:52:17',''),(274,3,100,1,1,484,0,'1.5',-105,'2016-12-01 20:52:24',''),(275,3,100,1,2,484,0,'-115',-115,'2016-12-01 20:52:27',''),(276,3,100,3,3,484,1,'187',-107,'2016-12-01 20:52:30',''),(277,3,100,3,1,484,1,'1.5',-105,'2016-12-01 20:52:33',''),(278,3,100,3,2,484,1,'104',104,'2016-12-01 20:52:37',''),(279,3,100,3,1,483,0,'-4',-105,'2016-12-01 20:53:09',''),(280,3,100,3,2,483,0,'156',156,'2016-12-01 20:53:15',''),(281,3,100,1,3,483,1,'214.5',-113,'2016-12-01 20:53:19',''),(282,4,100,3,2,450,0,'-160',-160,'2016-12-01 20:53:19',''),(283,3,100,1,1,483,1,'-4',-105,'2016-12-01 20:53:22',''),(284,3,100,1,2,483,1,'-173',-173,'2016-12-01 20:53:25',''),(285,3,100,3,3,483,0,'214.5',102,'2016-12-01 20:53:28',''),(286,3,100,3,1,485,0,'-10',-108,'2016-12-01 20:53:34',''),(287,3,100,3,2,485,0,'431',431,'2016-12-01 20:53:38',''),(288,4,100,1,3,450,1,'44',-113,'2016-12-01 20:53:40',''),(289,3,100,3,3,485,1,'189',-105,'2016-12-01 20:53:49',''),(290,3,100,1,1,485,1,'-10',-102,'2016-12-01 20:53:52',''),(291,3,100,1,2,485,1,'-510',-510,'2016-12-01 20:53:56',''),(292,3,100,1,3,485,0,'189',-105,'2016-12-01 20:54:00',''),(293,3,100,3,1,486,0,'-11',-102,'2016-12-01 20:54:12',''),(294,3,100,3,2,486,0,'516',516,'2016-12-01 20:54:17',''),(295,3,100,3,3,486,1,'231',-104,'2016-12-01 20:54:23',''),(296,3,100,1,1,486,1,'-11',-108,'2016-12-01 20:54:27',''),(297,3,100,1,2,486,1,'-625',-625,'2016-12-01 20:54:38',''),(298,3,100,1,3,486,0,'231',-106,'2016-12-01 20:54:42',''),(299,0,100,1,1,450,0,'3',-110,'2016-12-01 22:59:58',''),(300,0,100,3,2,450,0,'-160',-160,'2016-12-01 23:00:07',''),(301,0,100,3,3,450,0,'44',102,'2016-12-01 23:00:14',''),(302,1,100,3,2,457,1,'-690',-690,'2016-12-03 05:27:51',''),(303,1,100,1,1,454,0,'-2',-108,'2016-12-03 21:22:54',''),(304,4,100,3,1,455,0,'-6.5',-102,'2016-12-04 17:53:33',''),(305,4,100,3,1,460,0,'-3.5',-117,'2016-12-04 17:53:44',''),(306,4,100,3,1,459,1,'-3',-102,'2016-12-04 17:54:01',''),(307,4,100,3,1,459,1,'-3',-102,'2016-12-04 17:54:06',''),(308,4,100,3,1,451,0,'3.5',104,'2016-12-04 17:54:54',''),(309,4,100,3,1,451,0,'3.5',104,'2016-12-04 17:55:02',''),(310,4,100,1,2,453,0,'246',246,'2016-12-04 17:55:16',''),(311,3,100,3,1,459,1,'-3',-102,'2016-12-04 18:43:15',''),(312,3,100,1,1,460,1,'-3.5',106,'2016-12-04 18:43:31',''),(313,3,100,3,1,461,1,'-2.5',-113,'2016-12-04 18:43:42',''),(314,3,100,1,1,462,0,'-7',-113,'2016-12-04 18:43:58',''),(315,3,100,1,1,463,0,'-7.5',-102,'2016-12-04 18:44:37',''),(316,3,100,1,3,463,0,'44',-105,'2016-12-04 18:44:44',''),(317,3,100,1,1,508,1,'-7.5',-105,'2016-12-04 18:51:38',''),(318,3,100,1,3,508,1,'195.5',-103,'2016-12-04 18:51:49',''),(319,3,100,3,1,505,1,'-6.5',-110,'2016-12-04 18:52:01',''),(320,3,100,3,1,506,1,'-2.5',-106,'2016-12-04 18:52:13',''),(321,4,100,1,2,463,0,'310',310,'2016-12-04 21:28:28',''),(322,4,100,3,1,523,1,'-2.5',-115,'2016-12-07 23:45:51',''),(323,4,100,3,1,523,1,'-2.5',-115,'2016-12-07 23:45:56',''),(324,4,100,3,1,519,0,'2',-105,'2016-12-07 23:46:02',''),(325,4,100,3,1,519,0,'2',-105,'2016-12-07 23:46:05',''),(326,4,100,1,2,517,0,'148',148,'2016-12-07 23:46:31',''),(327,4,100,3,1,520,1,'-1',-107,'2016-12-07 23:46:42',''),(328,4,100,1,1,530,0,'-1.5',-100,'2016-12-07 23:46:52',''),(329,4,100,1,1,526,0,'3',-115,'2016-12-07 23:47:01',''),(330,4,100,3,3,526,0,'47.5',-105,'2016-12-07 23:47:06',''),(331,4,100,3,2,521,1,'-325',-325,'2016-12-07 23:47:40',''),(332,4,100,3,2,521,1,'-325',-325,'2016-12-07 23:47:49',''),(333,5,100,3,1,526,1,'3',111,'2016-12-09 05:48:41',''),(334,4,100,3,1,518,0,'5',-105,'2016-12-09 05:50:33',''),(335,4,100,3,3,527,1,'45.5',-105,'2016-12-09 05:51:17',''),(336,4,100,1,1,573,1,'-1.5',269,'2016-12-10 01:42:39',''),(337,4,100,1,1,573,1,'-1.5',269,'2016-12-10 01:42:46',''),(338,4,100,1,2,526,0,'-185',-185,'2016-12-12 00:29:47',''),(339,5,100,3,1,679,1,'1.5',-105,'2016-12-16 21:03:09',''),(340,5,100,3,2,678,1,'-260',-260,'2016-12-16 21:04:24',''),(341,4,100,1,2,617,1,'114',114,'2016-12-17 03:22:39',''),(342,4,100,3,2,621,1,'-444',-444,'2016-12-18 03:16:09',''),(343,4,100,3,2,621,1,'-444',-444,'2016-12-18 03:16:15',''),(344,4,100,3,2,621,1,'-444',-444,'2016-12-18 03:16:25',''),(345,1,100,3,1,712,1,'-12.5',-113,'2016-12-18 23:24:55',''),(346,3,100,1,1,725,0,'2.5',-109,'2016-12-20 21:23:14',''),(347,4,100,3,1,739,1,'-4',-102,'2016-12-21 06:48:35',''),(348,4,100,1,1,738,1,'-4.5',-108,'2016-12-21 06:48:42',''),(349,4,100,3,3,738,1,'44',-100,'2016-12-21 06:48:48',''),(350,4,100,3,1,734,1,'-3.5',-107,'2016-12-21 06:49:20',''),(351,4,100,3,1,734,1,'-3.5',-107,'2016-12-21 06:49:24',''),(352,4,100,3,1,734,1,'-3.5',-107,'2016-12-21 06:49:31',''),(353,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:39',''),(354,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:42',''),(355,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:46',''),(356,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:50',''),(357,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:53',''),(358,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:49:57',''),(359,4,100,1,1,728,0,'-3',-107,'2016-12-21 06:50:01',''),(360,4,100,3,1,730,1,'-6.5',-105,'2016-12-21 06:50:10',''),(361,4,100,1,1,732,0,'4.5',-110,'2016-12-21 06:50:35',''),(362,4,100,3,3,732,1,'43.5',-114,'2016-12-21 06:50:40',''),(363,4,100,1,1,725,0,'2.5',-109,'2016-12-21 06:50:48',''),(364,4,100,1,1,725,0,'2.5',-109,'2016-12-21 06:50:52',''),(365,0,100,1,1,817,0,'7',-100,'2016-12-25 22:59:24',''),(366,0,100,1,1,817,0,'7',-100,'2016-12-25 22:59:29',''),(367,0,100,1,1,817,0,'7',-100,'2016-12-25 22:59:34',''),(368,0,100,1,1,817,0,'7',-100,'2016-12-25 22:59:43',''),(369,4,100,1,1,848,1,'2.5',-100,'2016-12-27 03:14:07',''),(370,4,100,1,1,848,1,'2.5',-100,'2016-12-27 03:14:16',''),(371,3,100,1,1,828,0,'3.5',-104,'2016-12-29 09:09:49',''),(372,3,100,1,1,832,1,'-4.5',-109,'2016-12-29 09:09:57',''),(373,3,100,1,1,834,0,'-5',103,'2016-12-29 09:10:10',''),(374,3,100,1,3,834,0,'41',-102,'2016-12-29 09:10:17',''),(375,3,100,1,1,827,0,'-3',106,'2016-12-29 09:10:27',''),(376,3,100,1,3,827,0,'40.5',-108,'2016-12-29 09:10:34',''),(377,3,100,1,1,836,1,'-6',102,'2016-12-29 09:10:42',''),(378,3,100,3,3,836,1,'43.5',-105,'2016-12-29 09:10:46',''),(379,17,100,1,2,969,0,'456',456,'2017-01-05 23:20:14',''),(380,17,100,3,1,969,1,'-10',-107,'2017-01-05 23:20:26',''),(381,17,100,1,3,969,0,'217.5',-108,'2017-01-05 23:20:32',''),(382,17,100,1,3,974,1,'204.5',-108,'2017-01-05 23:20:58',''),(383,17,100,3,2,979,0,'127',127,'2017-01-05 23:21:29',''),(384,17,100,1,1,982,1,'-1.5',256,'2017-01-05 23:21:38',''),(385,17,100,3,2,979,0,'127',127,'2017-01-05 23:22:58',''),(386,17,100,3,2,979,0,'127',127,'2017-01-05 23:23:04',''),(387,4,100,3,2,933,1,'-195',-195,'2017-01-07 20:26:15',''),(388,4,100,1,3,933,0,'37',102,'2017-01-07 20:26:23',''),(389,4,100,1,3,933,0,'37',102,'2017-01-07 20:26:27',''),(390,4,100,1,3,934,1,'44',102,'2017-01-07 20:26:36',''),(391,4,100,1,2,934,0,'330',330,'2017-01-07 20:28:32',''),(392,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:28:56',''),(393,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:00',''),(394,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:05',''),(395,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:09',''),(396,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:13',''),(397,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:17',''),(398,4,100,3,2,935,1,'-550',-550,'2017-01-07 20:29:22',''),(399,4,100,1,2,936,0,'201',201,'2017-01-07 20:30:24',''),(400,4,100,1,2,936,0,'201',201,'2017-01-07 20:30:29',''),(401,4,100,3,3,936,1,'44.5',-105,'2017-01-07 20:31:35',''),(402,4,100,3,2,1034,0,'-100',-100,'2017-01-09 21:29:10',''),(403,4,100,3,2,1034,0,'-100',-100,'2017-01-09 21:29:14',''),(404,5,100,1,2,1019,0,'195',195,'2017-01-10 22:08:01',''),(405,5,100,1,1,1019,0,'-4.5',-100,'2017-01-10 23:13:48',''),(406,5,100,3,2,1029,1,'-1200',-1200,'2017-01-10 23:13:52',''),(407,5,100,1,1,1029,0,'-15.5',-115,'2017-01-10 23:13:58',''),(408,5,100,1,1,1029,0,'-15.5',-115,'2017-01-10 23:14:04',''),(409,4,100,3,2,1030,0,'109',109,'2017-01-11 05:33:11',''),(410,4,100,3,2,1030,0,'109',109,'2017-01-11 05:33:15',''),(411,4,100,3,1,1019,1,'-4.5',-110,'2017-01-11 05:33:52',''),(412,4,100,1,2,1031,1,'-209',-209,'2017-01-11 05:34:10',''),(413,4,100,1,2,1031,1,'-209',-209,'2017-01-11 05:34:20',''),(414,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:34:28',''),(415,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:34:31',''),(416,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:34:35',''),(417,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:22',''),(418,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:25',''),(419,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:28',''),(420,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:31',''),(421,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:35',''),(422,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:38',''),(423,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:42',''),(424,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:35:53',''),(425,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:36:07',''),(426,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:36:13',''),(427,4,100,3,2,1029,1,'-1200',-1200,'2017-01-11 05:37:47',''),(428,4,100,1,1,1019,0,'-6',-104,'2017-01-14 20:01:48',''),(429,5,100,1,2,1125,0,'186',186,'2017-01-19 19:53:12',''),(430,5,100,3,1,1126,1,'-6',-100,'2017-01-19 19:53:17',''),(431,4,100,1,2,1162,1,'-103',-103,'2017-01-20 02:17:57',''),(432,4,100,1,1,1126,0,'-6',-110,'2017-01-20 02:18:44',''),(433,4,100,3,3,1125,1,'60',-105,'2017-01-20 02:19:21',''),(434,4,100,1,1,1170,1,'-1.5',113,'2017-01-20 02:21:08',''),(435,4,100,3,2,1170,1,'-271',-271,'2017-01-20 02:21:16',''),(436,5,100,1,1,1226,1,'3',-113,'2017-01-24 05:18:46',''),(437,5,100,3,3,1226,1,'58',-105,'2017-01-24 05:19:22',''),(438,5,200,1,1,1236,1,'-1.5',-105,'2017-01-24 08:43:43',''),(439,5,300,1,2,1226,1,'139',139,'2017-01-24 18:22:29',''),(440,5,100,1,3,1234,0,'207.5',-102,'2017-01-24 20:29:53',''),(441,5,100,3,1,1257,0,'9',-112,'2017-01-25 09:49:53',''),(442,5,100,1,1,1244,0,'4',-110,'2017-01-25 09:50:00',''),(443,5,100,3,2,1249,1,'-136',-136,'2017-01-25 09:50:20',''),(444,3,500,3,1,1226,0,'3',-104,'2017-01-25 23:30:19',''),(445,5,100,1,2,1260,1,'-152',-152,'2017-01-26 08:04:18',''),(446,5,100,1,1,1261,0,'-6.5',-113,'2017-01-26 08:04:25',''),(448,4,500,1,2,1226,1,'137',137,'2017-01-26 21:13:47',''),(449,3,500,3,1,1263,1,'-9.5',-100,'2017-01-27 00:41:23',''),(450,3,100,1,1,1260,1,'-3.5',-100,'2017-01-27 00:41:33',''),(451,4,500,3,2,1276,0,'-337',-337,'2017-01-27 19:45:19',''),(452,4,500,1,1,1282,0,'5.5',-110,'2017-01-27 19:45:35',''),(453,4,200,3,2,1283,1,'103',103,'2017-01-27 19:45:58',''),(454,5,100,2,1,1285,1,'-4',-107,'2017-01-27 23:48:57',''),(455,4,300,3,2,1291,1,'151',151,'2017-01-28 19:54:36',''),(456,4,500,3,1,1292,0,'-1',-105,'2017-01-28 19:54:55',''),(457,4,500,3,2,1288,1,'-753',-753,'2017-01-28 19:55:11',''),(458,4,500,3,1,1288,1,'-11.5',-110,'2017-01-28 19:55:22',''),(459,4,500,3,2,1288,1,'-753',-753,'2017-01-28 19:55:39',''),(460,4,400,3,3,1290,1,'188.5',-106,'2017-01-28 19:56:06',''),(461,4,400,3,3,1226,1,'58.5',102,'2017-02-02 20:14:41',''),(462,4,500,3,2,1341,1,'-2600',-2600,'2017-02-02 20:15:15',''),(463,4,100,3,2,1341,1,'-2600',-2600,'2017-02-02 20:15:21',''),(464,4,500,3,2,1341,1,'-2600',-2600,'2017-02-02 20:15:27',''),(465,4,500,3,2,1340,1,'-665',-665,'2017-02-02 20:15:43',''),(466,4,500,3,2,1350,0,'-365',-365,'2017-02-02 20:16:16',''),(467,4,300,1,1,1347,0,'1.5',193,'2017-02-02 20:16:40',''),(468,4,500,3,1,1424,0,'1.5',-103,'2017-02-08 17:13:53',''),(469,4,500,3,2,1421,0,'-625',-625,'2017-02-08 17:14:23',''),(470,4,300,3,2,1428,1,'-337',-337,'2017-02-08 17:14:55',''),(471,4,100,1,2,1419,1,'400',400,'2017-02-08 17:15:09',''),(472,4,200,3,1,1432,0,'-10',-103,'2017-02-09 23:01:15',''),(473,4,300,3,2,1434,0,'109',109,'2017-02-09 23:01:29',''),(474,5,100,3,1,1488,0,'3.5',-108,'2017-02-13 18:53:06',''),(475,5,400,1,1,1497,1,'-1.5',227,'2017-02-13 18:53:22',''),(476,5,100,1,1,1575,1,'3.5',-110,'2017-02-24 00:50:24',''),(477,5,100,3,1,1621,0,'-7.5',-102,'2017-02-27 21:24:38',''),(478,5,500,1,1,1624,0,'1',-106,'2017-02-27 21:24:57',''),(479,4,500,1,2,1643,0,'-244',-244,'2017-02-28 19:38:03',''),(480,4,300,3,1,1632,1,'1.5',-103,'2017-02-28 19:38:26',''),(481,4,100,1,1,1633,1,'4',-108,'2017-02-28 19:38:52',''),(482,3,500,1,1,1643,0,'6',-101,'2017-02-28 23:22:21',''),(483,3,100,1,1,1644,0,'-4.5',-105,'2017-02-28 23:22:33',''),(484,3,100,3,1,1632,1,'1.5',-103,'2017-02-28 23:22:40',''),(485,3,100,3,1,1633,0,'4',-102,'2017-02-28 23:22:50',''),(486,4,300,1,2,1650,1,'-168',-168,'2017-03-01 09:47:51',''),(487,4,500,1,1,1658,1,'-1.5',-109,'2017-03-01 09:48:09',''),(488,4,300,1,2,1649,1,'-116',-116,'2017-03-01 09:48:35',''),(489,4,500,1,1,1646,0,'1',-104,'2017-03-01 09:48:44',''),(490,4,300,3,1,1680,0,'7.5',-105,'2017-03-03 20:08:29',''),(491,4,500,3,2,1680,0,'-343',-343,'2017-03-03 20:08:46',''),(492,4,500,3,2,1684,0,'-265',-265,'2017-03-03 20:08:59',''),(493,4,200,1,1,1703,0,'10',-107,'2017-03-05 20:26:05',''),(494,4,300,3,2,1714,1,'-665',-665,'2017-03-05 20:26:20',''),(495,4,300,1,2,1705,0,'-104',-104,'2017-03-05 20:26:39',''),(496,4,300,3,1,1706,0,'6.5',-102,'2017-03-05 20:27:25',''),(497,4,100,3,1,1818,0,'-7',-106,'2017-03-13 18:00:18',''),(498,4,100,1,3,1815,1,'195.5',-105,'2017-03-13 18:00:27',''),(499,4,200,1,2,1826,0,'108',108,'2017-03-13 18:00:41',''),(500,4,100,1,3,1826,0,'214.5',-100,'2017-03-13 18:00:53',''),(501,4,500,3,2,1908,0,'-825',-825,'2017-03-19 16:53:50',''),(502,4,500,3,2,1907,1,'-1155',-1155,'2017-03-19 16:54:07',''),(503,4,400,3,1,1925,0,'1',-103,'2017-03-20 17:13:08',''),(504,4,200,3,2,1918,1,'-432',-432,'2017-03-20 17:13:22',''),(505,4,300,3,2,1919,1,'-665',-665,'2017-03-20 17:14:15',''),(506,4,200,3,1,1941,1,'-2.5',-100,'2017-03-21 23:36:02',''),(507,4,300,3,1,1928,0,'5',-104,'2017-03-21 23:36:12',''),(508,4,500,3,2,1957,1,'-385',-385,'2017-03-23 19:48:51',''),(509,4,500,1,2,1956,0,'-212',-212,'2017-03-23 19:48:59',''),(510,4,500,3,2,1958,1,'-900',-900,'2017-03-23 19:49:22',''),(511,4,300,3,1,2233,0,'5.5',-106,'2017-05-19 21:04:20',''),(512,3,500,1,1,2252,0,'5.5',-104,'2017-06-09 18:29:32',''),(513,3,500,3,3,2252,1,'227',-110,'2017-06-09 18:29:51',''),(514,5,300,1,1,2252,0,'5.5',-104,'2017-06-09 18:35:33',''),(515,5,300,1,1,2252,0,'5.5',-104,'2017-06-09 18:44:55',''),(516,4,500,3,1,2258,1,'-4',-106,'2017-09-11 00:21:50',''),(517,4,400,2,1,2317,1,'5',-105,'2017-10-06 00:11:24',''),(518,4,300,1,3,2317,1,'54',-109,'2017-10-06 00:11:40','');
/*!40000 ALTER TABLE `bets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-04 20:51:36