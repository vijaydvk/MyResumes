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
-- Table structure for table `sun_general_order_prod_emails`
--

DROP TABLE IF EXISTS `sun_general_order_prod_emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sun_general_order_prod_emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `general_product_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'sun_general_order_prod - general_product_id',
  `email` text COMMENT 'The e-mail address that will be sent to upon submission. This may be an e-mail address, the special key "default" or a numeric value. If a numeric value is used, the value of a component will be substituted on submission.',
  `subject` text COMMENT 'The e-mail subject that will be used. This may be a string, the special key "default" or a numeric value. If a numeric value is used, the value of a component will be substituted on submission.',
  `from_name` text COMMENT 'The e-mail "from" name that will be used. This may be a string, the special key "default" or a numeric value. If a numeric value is used, the value of a component will be substituted on submission.',
  `from_address` text COMMENT 'The e-mail "from" e-mail address that will be used. This may be a string, the special key "default" or a numeric value. If a numeric value is used, the value of a component will be substituted on submission.',
  `template` text COMMENT 'A template that will be used for the sent e-mail. This may be a string or the special key "default", which will use the template provided by the theming layer.',
  `excluded_components` text NOT NULL COMMENT 'A list of components that will not be included in the [submission:values] token. A list of CIDs separated by commas.',
  `html` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Determines if the e-mail will be sent in an HTML format. Requires Mime Mail module.',
  `attachments` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Determines if the e-mail will include file attachments. Requires Mime Mail module.',
  `exclude_empty` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Determines if the e-mail will include component with an empty value.',
  `extra` text NOT NULL COMMENT 'A serialized array of additional options for the e-mail configuration, including value mapping for the TO and FROM addresses for select lists.',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Whether this email is enabled.',
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Holds information regarding e-mails that should be sent...';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sun_general_order_prod_emails`
--

LOCK TABLES `sun_general_order_prod_emails` WRITE;
/*!40000 ALTER TABLE `sun_general_order_prod_emails` DISABLE KEYS */;
INSERT INTO `sun_general_order_prod_emails` VALUES (1,1,'triesman@suncommobile.com','Toner Order',NULL,NULL,NULL,'',0,0,0,'',1),(2,1,'tonerorder@suncommobile.com','Toner Order',NULL,NULL,NULL,'',0,0,0,'',1),(3,2,'marketing@suncommobile.com','Marketing material Order',NULL,NULL,NULL,'',0,0,0,'',1),(4,3,'SupplyChain@suncommobile.com','Store shopping bag Order',NULL,NULL,NULL,'',0,0,0,'',1),(5,4,'SupplyChain@suncommobile.com','Receipt paper Order',NULL,NULL,NULL,'',0,0,0,'',1),(6,5,'SupplyChain@suncommobile.com','Phone price tag paper Order',NULL,NULL,NULL,'',0,0,0,'',1),(7,6,'marketing@suncommobile.com','Refills for price gun Order',NULL,NULL,NULL,'',0,0,0,'',1);
/*!40000 ALTER TABLE `sun_general_order_prod_emails` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-27  9:11:18
