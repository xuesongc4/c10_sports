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
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(35) NOT NULL,
  `abbr_name` varchar(3) NOT NULL,
  `logo_src` varchar(30) NOT NULL,
  `league_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `league_id` (`league_id`),
  CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Atlanta Hawks','ATL','images/NBA/ATL.png',487),(2,'Boston Celtics','BOS','images/NBA/BOS.png',487),(3,'Brooklyn Nets','BKN','images/NBA/BKN.png',487),(4,'Charlotte Hornets','CHA','images/NBA/CHA.png',487),(5,'Chicago Bulls','CHI','images/NBA/CHI.png',487),(6,'Cleveland Cavaliers','CLE','images/NBA/CLE.png',487),(7,'Dallas Mavericks','DAL','images/NBA/DAL.png',487),(8,'Denver Nuggets','DEN','images/NBA/DEN.png',487),(9,'Detroit Pistons','DET','images/NBA/DET.png',487),(10,'Golden State Warriors','GS','images/NBA/GS.png',487),(11,'Houston Rockets','HOU','images/NBA/HOU.png',487),(12,'Indiana Pacers','IND','images/NBA/IND.png',487),(13,'Los Angeles Clippers','LAC','images/NBA/LAC.png',487),(14,'Los Angeles Lakers','LAL','images/NBA/LAL.png',487),(15,'Memphis Grizzlies','MEM','images/NBA/MEM.png',487),(16,'Miami Heat','MIA','images/NBA/MIA.png',487),(17,'Milwaukee Bucks','MIL','images/NBA/MIL.png',487),(18,'Minnesota Timberwolves','MIN','images/NBA/MIN.png',487),(19,'New Orleans Pelicans','NO','images/NBA/NO.png',487),(20,'New York Knicks','NYK','images/NBA/NYK.png',487),(21,'Oklahoma City Thunder','OKC','images/NBA/OKC.png',487),(22,'Orlando Magic','ORL','images/NBA/ORL.png',487),(23,'Philadelphia 76ers','PHI','images/NBA/PHI.png',487),(24,'Phoenix Suns','PHO','images/NBA/PHO.png',487),(25,'Portland Trail Blazers','POR','images/NBA/POR.png',487),(26,'Sacramento Kings','SAC','images/NBA/SAC.png',487),(27,'San Antonio Spurs','SAS','images/NBA/SAS.png',487),(28,'Toronto Raptors','TOR','images/NBA/TOR.png',487),(29,'Utah Jazz','UTA','images/NBA/UTA.png',487),(30,'Washington Wizards','WAS','images/NBA/WAS.png',487),(31,'Arizona Cardinals','ARI','images/NFL/ARI.png',889),(32,'Atlanta Falcons','ATL','images/NFL/ATL.png',889),(33,'Baltimore Ravens','BAL','images/NFL/BAL.png',889),(34,'Buffalo Bills','BUF','images/NFL/BUF.png',889),(35,'Carolina Panthers','CAR','images/NFL/CAR.png',889),(36,'Chicago Bears','CHI','images/NFL/CHI.png',889),(37,'Cincinnati Bengals','CIN','images/NFL/CIN.png',889),(38,'Cleveland Browns','CLE','images/NFL/CLE.png',889),(39,'Dallas Cowboys','DAL','images/NFL/DAL.png',889),(40,'Denver Broncos','DEN','images/NFL/DEN.png',889),(41,'Detroit Lions','DET','images/NFL/DET.png',889),(42,'Green Bay Packers','GB','images/NFL/GB.png',889),(43,'Houston Texans','HOU','images/NFL/HOU.png',889),(44,'Indianapolis Colts','IND','images/NFL/IND.png',889),(45,'Jacksonville Jaguars','JAC','images/NFL/JAC.png',889),(46,'Kansas City Chiefs','KC','images/NFL/KC.png',889),(47,'Los Angeles Rams','LA','images/NFL/LA.png',889),(48,'Miami Dolphins','MIA','images/NFL/MIA.png',889),(49,'Minnesota Vikings','MIN','images/NFL/MIN.png',889),(50,'New England Patriots','NE','images/NFL/NE.png',889),(51,'New Orleans Saints','NO','images/NFL/NO.png',889),(52,'New York Giants','NYG','images/NFL/NYG.png',889),(53,'New York Jets','NYJ','images/NFL/NYJ.png',889),(54,'Oakland Raiders','OAK','images/NFL/OAK.png',889),(55,'Philadelphia Eagles','PHI','images/NFL/PHI.png',889),(56,'Pittsburgh Steelers','PIT','images/NFL/PIT.png',889),(57,'San Diego Chargers','SD','images/NFL/SD.png',889),(58,'San Francisco 49ers','SF','images/NFL/SF.png',889),(59,'Seattle Seahawks','SEA','images/NFL/SEA.png',889),(60,'Tampa Bay Buccaneers','TB','images/NFL/TB.png',889),(61,'Tennessee Titans','TEN','images/NFL/TEN.png',889),(62,'Washington Redskins','WAS','images/NFL/WAS.png',889),(63,'Baltimore Orioles','BAL','images/MLB/BAL.png',246),(64,'Boston Red Sox','BOS','images/MLB/BOS.png',246),(65,'Chicago White Sox','CHW','images/MLB/CHW.png',246),(66,'Cleveland Indians','CLE','images/MLB/CLE.png',246),(67,'Detroit Tigers','DET','images/MLB/DET.png',246),(68,'Houston Astros','HOU','images/MLB/HOU.png',246),(69,'Kansas City Royals','KC','images/MLB/KC.png',246),(70,'Los Angeles Angels','LAA','images/MLB/LAA.png',246),(71,'Minnesota Twins','MIN','images/MLB/MIN.png',246),(72,'New York Yankees','NYY','images/MLB/NYY.png',246),(73,'Oakland Athletics','OAK','images/MLB/OAK.png',246),(74,'Seattle Mariners','SEA','images/MLB/SEA.png',246),(75,'Tamba Bay Rays','TB','images/MLB/TB.png',246),(76,'Texas Rangers','TX','images/MLB/TX.png',246),(77,'Toronto Blue Jays','TOR','images/MLB/TOR.png',246),(78,'Arizona Diamondbacks','ARI','images/MLB/ARI.png',246),(79,'Atlanta Braves','ATL','images/MLB/ATL.png',246),(80,'Chicago Cubs','CHC','images/MLB/CHC.png',246),(81,'Cincinnati Reds','CIN','images/MLB/CIN.png',246),(82,'Colorado Rockies','COL','images/MLB/COL.png',246),(83,'Los Angeles Dodgers','LAD','images/MLB/LAD.png',246),(84,'Miami Marlins','MIA','images/MLB/MIA.png',246),(85,'Milwaukee Brewers','MIL','images/MLB/MIL.png',246),(86,'New York Mets','NYM','images/MLB/NYM.png',246),(87,'Philadelphia Phillies','PHI','images/MLB/PHI.png',246),(88,'Pittsburgh Pirates','PIT','images/MLB/PIT.png',246),(89,'San Diego Padres','SD','images/MLB/SD.png',246),(90,'San Francisco Giants','SF','images/MLB/SF.png',246),(91,'St. Louis Cardinals','STL','images/MLB/STL.png',246),(92,'Washington Nationals','WAS','images/MLB/WAS.png',246),(93,'Anaheim Ducks','ANH','images/NHL/ANH.png',1460),(94,'Arizona Coyotes','ARI','images/NHL/ARI.png',1460),(95,'Boston Bruins','BOS','images/NHL/BOS.png',1460),(96,'Buffalo Sabres','BUF','images/NHL/BUF.png',1460),(97,'Calgary Flame','CAL','images/NHL/CAL.png',1460),(98,'Carolina Hurricanes','CAR','images/NHL/CAR.png',1460),(99,'Chicago Blackhawks','CHI','images/NHL/CHI.png',1460),(100,'Columbus Blue Jackets','CLS','images/NHL/CLS.png',1460),(101,'Colorado Avalanche','COL','images/NHL/COL.png',1460),(102,'Dallas Stars','DAL','images/NHL/DAL.png',1460),(103,'Detroit Red Wings','DET','images/NHL/DET.png',1460),(104,'Edmonton Oilers','EDM','images/NHL/EDM.png',1460),(105,'Florida Panthers','FLA','images/NHL/FLA.png',1460),(106,'Los Angeles Kings','LA','images/NHL/LA.png',1460),(107,'Minnesota Wild','MIN','images/NHL/MIN.png',1460),(108,'Montreal Canadiens','MON','images/NHL/MON.png',1460),(109,'New Jersey Devils','NJ','images/NHL/NJ.png',1460),(110,'Nashville Predators','NSH','images/NHL/NSH.png',1460),(111,'New York Islanders','NYI','images/NHL/NYI.png',1460),(112,'New York Rangers','NYR','images/NHL/NYR.png',1460),(113,'Ottawa Senators','OTT','images/NHL/OTT.png',1460),(114,'Philadelphia Flyers','PHI','images/NHL/PHI.png',1460),(115,'Pittsburgh Penguins','PIT','images/NHL/PIT.png',1460),(116,'San Jose Sharks','SJ','images/NHL/SJ.png',1460),(117,'St. Louis Blues','STL','images/NHL/STL.png',1460),(118,'Tampa Bay Lightning','TB','images/NHL/TB.png',1460),(119,'Toronoto Maple Leafs','TOR','images/NHL/TOR.png',1460),(120,'Vancouver Canucks','VAN','images/NHL/VAN.png',1460),(121,'Washington Capitals','WAS','images/NHL/WAS.png',1460),(122,'Winnipeg Jets','WIN','images/NHL/WIN.png',1460);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-04 20:52:31
