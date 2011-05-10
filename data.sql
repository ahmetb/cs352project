-- MySQL dump 10.11
--
-- Host: db.myschoolog.com    Database: airlinee
-- ------------------------------------------------------
-- Server version	5.1.53-log

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
-- Table structure for table `airport`
--

DROP TABLE IF EXISTS `airport`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `city` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city` (`city`),
  CONSTRAINT `airport_ibfk_2` FOREIGN KEY (`city`) REFERENCES `city` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `airport`
--

LOCK TABLES `airport` WRITE;
/*!40000 ALTER TABLE `airport` DISABLE KEYS */;
INSERT INTO `airport` VALUES (7,'ESB','Esenboga',11),(9,'LTBA','Ataturk',13),(10,'CDG','Charles De Gaulle',14),(11,'GOX','Sabiha Gokcen',13),(12,'LHR','Heathrow',16);
/*!40000 ALTER TABLE `airport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `flight_id` int(11) NOT NULL,
  `payment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `flight_id` (`flight_id`),
  KEY `payment` (`payment`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`payment`) REFERENCES `payment` (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (5,6,4,'2011-05-05 08:39:28',13,5),(6,5,4,'2011-05-05 08:40:05',13,6),(7,1,4,'2011-05-05 08:43:39',13,7),(8,22,4,'2011-05-05 08:44:14',13,8),(9,21,4,'2011-05-05 08:50:00',13,9),(10,22,4,'2011-05-05 13:20:48',15,10),(11,1,8,'2011-05-07 04:44:24',40,11),(12,2,8,'2011-05-07 04:45:09',40,12);
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_luggage`
--

DROP TABLE IF EXISTS `booking_luggage`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `booking_luggage` (
  `booking_id` int(11) NOT NULL,
  `luggage_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`,`luggage_id`),
  KEY `luggage_id` (`luggage_id`),
  CONSTRAINT `booking_luggage_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_luggage_ibfk_2` FOREIGN KEY (`luggage_id`) REFERENCES `luggage` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `booking_luggage`
--

LOCK TABLES `booking_luggage` WRITE;
/*!40000 ALTER TABLE `booking_luggage` DISABLE KEYS */;
INSERT INTO `booking_luggage` VALUES (8,5),(8,6),(6,7),(6,8),(6,9);
/*!40000 ALTER TABLE `booking_luggage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (11,'Ankara'),(13,'Istanbul'),(14,'Paris'),(15,'Seattle'),(16,'Londra');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (4,'ali','1ed4e9c786146cab3d5c9914da0de3fa','5051111111'),(5,'c1','a9f7e97965d6cf799a529102a973b8b9','c1'),(6,'fatma','38ab93488e52710515c3095a83a92bcf','4334'),(7,'yasar','cd6aa2d5e0fd792808c07baa56515ef2','0999'),(8,'huseyin','47420f155ac69934958e5e8f1a251649','675');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight`
--

DROP TABLE IF EXISTS `flight`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(10) NOT NULL,
  `departure_date` datetime NOT NULL,
  `fare` float DEFAULT '0',
  `route` int(11) NOT NULL,
  `plane` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `route` (`route`),
  KEY `plane` (`plane`),
  CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`route`) REFERENCES `route` (`id`) ON DELETE CASCADE,
  CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`plane`) REFERENCES `plane` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `flight`
--

LOCK TABLES `flight` WRITE;
/*!40000 ALTER TABLE `flight` DISABLE KEYS */;
INSERT INTO `flight` VALUES (13,'TK707','2011-06-04 10:30:00',59,7,5),(14,'TK703','2011-05-08 23:50:00',132,19,6),(15,'TK803','2011-06-01 10:15:00',99,21,5),(16,'TK118','2011-09-04 14:50:00',739,20,6),(17,'TK674','2011-05-04 22:00:00',689,26,5),(18,'TK912','2011-05-09 12:50:00',49,8,6),(19,'TK121','2011-05-19 09:10:00',450,12,7),(20,'TK332','2011-06-01 23:00:00',79,21,8),(21,'TK721','2011-07-29 22:30:00',479,13,5),(22,'TK804','2011-08-08 15:45:00',687,13,7),(23,'ZS445','2011-07-14 21:50:00',789,18,8),(24,'ZS444','2011-06-29 17:25:00',556,18,7),(25,'ZS443','2011-08-19 16:05:00',445,26,6),(26,'YT231','2011-11-08 10:43:00',39,21,7),(27,'YT245','2011-11-23 05:40:00',900,8,6),(28,'KM2010','2011-05-08 17:25:00',112,22,5),(29,'KT606','2011-05-10 13:30:00',29,8,5),(30,'FL450','2011-05-11 18:40:00',675,16,7),(31,'TH5560','2011-05-12 14:55:00',119,27,6),(32,'RT1313','2011-05-13 13:13:00',13,7,8),(33,'FD001','2011-05-14 07:20:00',220,15,6),(34,'TH101','2011-05-15 11:11:00',15,25,6),(35,'UK330','2011-05-16 16:25:00',329,22,5),(36,'EB202','2011-05-17 23:59:00',239,19,7),(37,'TK404','2011-05-18 04:10:00',159,19,6),(38,'SG730','2011-05-20 06:30:00',499,26,8),(39,'HC209','2011-05-21 08:00:00',470,23,8),(40,'EG701','2011-05-22 09:25:00',30,21,6),(41,'EB204','2011-05-23 10:35:00',162,14,6),(42,'QW307','2011-05-24 10:05:00',505,18,5),(43,'HC403','2011-05-25 14:15:00',239,24,5),(44,'TH4021','2011-05-26 19:07:00',450,20,5),(45,'TH5033','2011-05-27 17:12:00',533,13,8),(46,'HC208','2011-05-28 21:55:00',703,17,8),(47,'YT232','2011-05-29 19:30:00',129,28,5);
/*!40000 ALTER TABLE `flight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight_crew`
--

DROP TABLE IF EXISTS `flight_crew`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flight_crew` (
  `flight_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `role` enum('ASST','CPT','HOST') NOT NULL,
  PRIMARY KEY (`flight_id`,`staff_id`),
  KEY `staff_id` (`staff_id`),
  CONSTRAINT `flight_crew_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE,
  CONSTRAINT `flight_crew_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `flight_staff` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `flight_crew`
--

LOCK TABLES `flight_crew` WRITE;
/*!40000 ALTER TABLE `flight_crew` DISABLE KEYS */;
INSERT INTO `flight_crew` VALUES (13,8,'CPT'),(13,9,'ASST'),(13,11,'HOST'),(14,8,'ASST'),(14,10,'CPT'),(14,18,'HOST'),(15,15,'ASST'),(15,16,'CPT'),(15,18,'HOST'),(16,10,'ASST'),(16,16,'CPT'),(16,18,'HOST'),(17,8,'CPT'),(17,9,'ASST'),(17,14,'HOST'),(18,10,'ASST'),(18,15,'CPT'),(18,17,'HOST'),(19,9,'ASST'),(19,12,'HOST'),(19,16,'CPT'),(20,9,'ASST'),(20,10,'CPT'),(20,14,'HOST'),(21,10,'ASST'),(21,12,'HOST'),(21,16,'CPT'),(22,8,'CPT'),(22,10,'ASST'),(22,17,'HOST'),(23,9,'ASST'),(23,13,'HOST'),(23,15,'CPT'),(24,9,'ASST'),(24,13,'HOST'),(24,16,'CPT'),(25,10,'CPT'),(25,14,'HOST'),(25,15,'ASST'),(26,10,'ASST'),(26,12,'HOST'),(26,16,'CPT'),(27,9,'CPT'),(27,14,'HOST'),(27,16,'ASST'),(28,9,'CPT'),(28,10,'ASST'),(28,13,'HOST'),(29,9,'CPT'),(29,10,'ASST'),(29,11,'HOST'),(30,9,'ASST'),(30,11,'HOST'),(30,15,'CPT'),(31,10,'ASST'),(31,13,'HOST'),(31,16,'CPT'),(32,8,'CPT'),(32,10,'ASST'),(32,13,'HOST'),(33,8,'ASST'),(33,9,'CPT'),(33,14,'HOST'),(34,8,'ASST'),(34,12,'HOST'),(34,15,'CPT'),(35,9,'CPT'),(35,10,'ASST'),(35,18,'HOST'),(36,8,'ASST'),(36,11,'HOST'),(36,16,'CPT'),(37,8,'ASST'),(37,10,'CPT'),(37,17,'HOST'),(38,9,'ASST'),(38,16,'CPT'),(38,17,'HOST'),(39,8,'ASST'),(39,13,'HOST'),(39,15,'CPT'),(40,8,'ASST'),(40,15,'CPT'),(40,17,'HOST'),(41,10,'CPT'),(41,16,'ASST'),(41,17,'HOST'),(42,10,'CPT'),(42,12,'HOST'),(42,15,'ASST'),(43,9,'CPT'),(43,12,'HOST'),(43,16,'ASST'),(44,8,'ASST'),(44,13,'HOST'),(44,16,'CPT'),(45,10,'ASST'),(45,11,'HOST'),(45,16,'CPT'),(46,10,'CPT'),(46,12,'HOST'),(46,15,'ASST'),(47,9,'CPT'),(47,10,'ASST'),(47,12,'HOST');
/*!40000 ALTER TABLE `flight_crew` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flight_staff`
--

DROP TABLE IF EXISTS `flight_staff`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `flight_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary` float DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `type` enum('PILOT','HOSTESS') NOT NULL,
  `date_joined` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `flight_staff`
--

LOCK TABLES `flight_staff` WRITE;
/*!40000 ALTER TABLE `flight_staff` DISABLE KEYS */;
INSERT INTO `flight_staff` VALUES (8,7000,'P. Baris','PILOT','2008-05-01 00:00:00'),(9,6500,'P. Savas','PILOT','2009-06-20 00:00:00'),(10,7750,'P. Onur','PILOT','2006-10-17 00:00:00'),(11,1500,'H.Ebru','HOSTESS','2011-05-04 00:00:00'),(12,1300,'H.Michel','HOSTESS','2011-05-04 00:00:00'),(13,1400,'H.Oyku','HOSTESS','2011-05-04 00:00:00'),(14,1780,'H.Seda','HOSTESS','2011-05-04 00:00:00'),(15,6750,'P. Ahmet','PILOT','2009-04-18 00:00:00'),(16,8000,'P. Sabit','PILOT','2001-02-10 00:00:00'),(17,1600,'H.Gabriel','HOSTESS','2011-05-04 00:00:00'),(18,1150,'H. Meltem','HOSTESS','2011-04-01 00:00:00');
/*!40000 ALTER TABLE `flight_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ground_staff`
--

DROP TABLE IF EXISTS `ground_staff`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ground_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salary` float DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` enum('EXEC','SALES') DEFAULT 'SALES',
  `date_joined` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground_staff`
--

LOCK TABLES `ground_staff` WRITE;
/*!40000 ALTER TABLE `ground_staff` DISABLE KEYS */;
INSERT INTO `ground_staff` VALUES (1,12000,'admin','21232f297a57a5a743894a0e4a801fc3','EXEC','1991-12-26 00:00:00'),(7,15000,'ceo','55161575f3e05dfb61145c5d63d67d29','EXEC','1994-10-04 00:00:00'),(8,3000,'sales','9ed083b1436e5f40ef984b28255eef18','SALES','2011-05-04 00:00:00'),(9,3400,'salesman','1ee726b084cffbc96a6163d65f885d64','SALES','2011-05-04 00:00:00');
/*!40000 ALTER TABLE `ground_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `luggage`
--

DROP TABLE IF EXISTS `luggage`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `luggage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weight` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `luggage`
--

LOCK TABLES `luggage` WRITE;
/*!40000 ALTER TABLE `luggage` DISABLE KEYS */;
INSERT INTO `luggage` VALUES (5,10),(6,10),(7,5),(8,5),(9,4);
/*!40000 ALTER TABLE `luggage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `payment` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `amount` float DEFAULT '0',
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (5,'2011-05-05 08:39:28',59),(6,'2011-05-05 08:40:05',59),(7,'2011-05-05 08:43:39',59),(8,'2011-05-05 08:44:14',59),(9,'2011-05-05 08:50:00',59),(10,'2011-05-05 13:20:48',99),(11,'2011-05-07 04:44:24',30),(12,'2011-05-07 04:45:09',30);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plane`
--

DROP TABLE IF EXISTS `plane`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `plane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `plane`
--

LOCK TABLES `plane` WRITE;
/*!40000 ALTER TABLE `plane` DISABLE KEYS */;
INSERT INTO `plane` VALUES (5,'Hezarfen',25,'Boeing 737-300'),(6,'Kartal',2,'F16'),(7,'Tango',35,'Boeing 737-758'),(8,'Aksu',10,'NASA 747');
/*!40000 ALTER TABLE `plane` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departure` int(11) NOT NULL,
  `destination` int(11) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `departure` (`departure`),
  KEY `destination` (`destination`),
  CONSTRAINT `route_ibfk_1` FOREIGN KEY (`departure`) REFERENCES `airport` (`id`) ON DELETE CASCADE,
  CONSTRAINT `route_ibfk_2` FOREIGN KEY (`destination`) REFERENCES `airport` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
INSERT INTO `route` VALUES (7,7,9,120),(8,9,7,120),(12,9,10,180),(13,9,12,190),(14,9,11,15),(15,10,9,180),(16,10,7,195),(17,10,12,75),(18,10,11,185),(19,7,10,205),(20,7,12,215),(21,7,11,45),(22,12,9,190),(23,12,10,85),(24,12,11,200),(25,11,9,10),(26,11,10,300),(27,11,7,45),(28,11,12,190);
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `route_listing`
--

DROP TABLE IF EXISTS `route_listing`;
/*!50001 DROP VIEW IF EXISTS `route_listing`*/;
/*!50001 CREATE TABLE `route_listing` (
  `id` int(11),
  `route_name` varchar(201),
  `departure` int(11),
  `destination` int(11),
  `duration` int(11)
) */;

--
-- Final view structure for view `route_listing`
--

/*!50001 DROP TABLE `route_listing`*/;
/*!50001 DROP VIEW IF EXISTS `route_listing`*/;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`airlinee`@`%.%.%.%` SQL SECURITY DEFINER */
/*!50001 VIEW `route_listing` AS (select `r`.`id` AS `id`,concat(`f`.`name`,'-',`t`.`name`) AS `route_name`,`f`.`id` AS `departure`,`t`.`id` AS `destination`,`r`.`duration` AS `duration` from ((`route` `r` join `airport` `f`) join `airport` `t`) where ((`r`.`departure` = `f`.`id`) and (`r`.`destination` = `t`.`id`))) */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-05-10 14:21:16
