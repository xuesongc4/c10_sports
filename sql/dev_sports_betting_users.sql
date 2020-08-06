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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test@test','test','a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),(2,'blah@blah','blah','5bf1fd927dfb8679496a2e6cf00cbe50c1c87145'),(3,'jason@jason.com','joebab','877c87cc9c2518f8f74964a9454d73f8bb86ffd6'),(4,'kyle@kyle','kyle','3c25b01657254677d3e1a8fd1f0742c5d489bd39'),(5,'guest@guest.com','guest','35675e68f4b5af7b995d9205ad0fc43842f16450'),(6,'xuesongc4@yahoo.com','xuesongc','38c0e100dce95d9a1fa19b82abec0e1f08d1d19a'),(7,'bro@bro.com','tonybromo','36dc3e31538a18b606f20f185133da3db31c8aa1'),(8,'','showtime','356a192b7913b04c54574d18c28d46e6395428ab'),(9,'haha','haha','637d1f5c6e6d1be22ed907eb3d223d858ca396d8'),(10,'','moneybags','da4b9237bacccdf19c0760cab7aec4a8359010b0'),(11,'','treyy','77de68daecd823babbb58edb1c8e14d7106e83bb'),(12,'','ford','1b6453892473a467d07372d45eb05abc2031647a'),(13,'','fiver','ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4'),(14,'asdf','onemore','3da541559918a808c2402bba5012f6c60b27661c'),(15,'lfz@lfz.com','lfz','7d2cd92da6d313da0e5e679606a4a217a780c2ba'),(16,'pigman@pig.man','pigman','48181acd22b3edaebc8a447868a7df7ce629920a'),(17,'bob@bob.bob','bob','48181acd22b3edaebc8a447868a7df7ce629920a'),(18,'9er@99.999','niner','0ade7c2cf97f75d009975f4d720d1fa6c19f4897'),(19,'a','ayyyy','86f7e437faa5a7fce15d1ddcb9eaeaea377667b8'),(20,'a','noscript','86f7e437faa5a7fce15d1ddcb9eaeaea377667b8'),(21,'bob','bob','48181acd22b3edaebc8a447868a7df7ce629920a'),(22,'s','twoface','a0f1490a20d0211c997b44bc357e1972deab8ae3'),(23,'z','zinger','395df8f7c51f007019cb30201c49e884b46b92fa'),(24,'dan@lee.sit','garg','669a2ec8dbfce7435b1809d924a9a9c9beca3fe0'),(25,'hi@hi.hi','coolio','e8869c77ee7a2d65d119c2226d3dc692bb38e547'),(26,'console@log.log','consolelog','e8869c77ee7a2d65d119c2226d3dc692bb38e547'),(27,'dan@lee.site','site','c099a42a5555825cdb50df0c04932bcd29613457');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-04 20:51:56
