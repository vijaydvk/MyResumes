-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: suncomportal
-- ------------------------------------------------------
-- Server version	5.5.57

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sun_ebit`
--

DROP TABLE IF EXISTS `sun_ebit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sun_ebit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(25) DEFAULT NULL,
  `market` varchar(25) DEFAULT NULL,
  `dm` varchar(125) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `store_id` varchar(12) DEFAULT NULL,
  `for_Year` int(11) DEFAULT NULL,
  `ebit_total` double DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sun_ebit`
--

LOCK TABLES `sun_ebit` WRITE;
/*!40000 ALTER TABLE `sun_ebit` DISABLE KEYS */;
INSERT INTO `sun_ebit` VALUES (1,'South Central','STX','Victor Morales','WWWhite (S)','100',2010,13582.99,'2010 YTD'),(2,'South Central','STX','Victor Morales','WWWhite (S)','100',2011,19471.05,'2011 YTD'),(3,'South Central','STX','STX - TBD','WWWhite (S)','100',2012,17377.16,'2012 YTD'),(4,'South Central','STX','Victor Morales','WWWhite (S)','100',2013,38628.67,'2013 YTD'),(5,'Central','STX','Victor Morales','WWWhite (S)','100',2014,166301.22,'2014 YTD'),(6,'Central','STX','Victor Morales','WWWhite (S)','100',2015,139075.53,'2015 YTD'),(7,'Central','STX','Robert Castellanos','WWWhite (S)','100',2016,143637.65,'2016 YTD'),(8,'Central','STX','Robert Castellanos','WWWhite (S)','100',2017,30697.57,'As of June 2017');
/*!40000 ALTER TABLE `sun_ebit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-22 10:19:42
