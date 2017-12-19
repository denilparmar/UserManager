CREATE DATABASE  IF NOT EXISTS `usermanager` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `usermanager`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--

-- ------------------------------------------------------
-- Server version	5.6.37-log

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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `perm_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perm_desc` varchar(50) NOT NULL,
  PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'CREATE'),(2,'READ'),(3,'UPDATE'),(4,'DELETE');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_perm`
--

DROP TABLE IF EXISTS `role_perm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_perm` (
  `role_id` int(11) NOT NULL,
  `perm_id` int(10) unsigned NOT NULL,
  KEY `role_id` (`role_id`),
  KEY `perm_id` (`perm_id`),
  CONSTRAINT `role_perm_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  CONSTRAINT `role_perm_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `permissions` (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_perm`
--

LOCK TABLES `role_perm` WRITE;
/*!40000 ALTER TABLE `role_perm` DISABLE KEYS */;
INSERT INTO `role_perm` VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,1),(2,2),(2,3);
/*!40000 ALTER TABLE `role_perm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Record Manager'),(3,'User');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdetails`
--

DROP TABLE IF EXISTS `userdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdetails` (
  `UserID` varchar(120) NOT NULL,
  `UserName` varchar(150) NOT NULL,
  `FirstName` varchar(150) DEFAULT NULL,
  `LastName` varchar(150) DEFAULT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(1000) DEFAULT NULL,
  `Active` int(11) DEFAULT '1',
  `role_id` int(11) NOT NULL,
  `crd_by` varchar(120) DEFAULT NULL,
  `crd_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserName`,`Email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdetails`
--

LOCK TABLES `userdetails` WRITE;
/*!40000 ALTER TABLE `userdetails` DISABLE KEYS */;
INSERT INTO `userdetails` VALUES ('MGFSHT','ADMIN','Denil','Parmar','denilparmar@gmail.com','ded654c5f27572c091e88c17f5bb6bdbb8a223e4ce6342d1a2b967286c85e0b5e',1,1,NULL,'2017-04-12 20:18:12'),('7T4LON','BILLY','billy','joe','bj@gmail.com','cc34eac616820738970d572e9dd1edd5d727b0545872c51185264ebb5119d0e83',1,1,NULL,'2017-12-15 00:41:06'),('OEYLED','BILQUIS','Bilquis','Siddique','bilquis.siddique@gmail.com','cb02931cc597238de5f46edb35ad89bff2f5121c11054ad46a057caacac5f9a87',1,1,NULL,'2017-11-21 13:34:14'),('JBJJ7U','DENILP','Denil','Parmar','denilparmar@gmail.com',NULL,1,2,'NV1W6L','2017-11-20 04:04:04'),('QE2OWP','JAMES_H','James R','Hetfield','jh@gmail.com',NULL,1,2,'MGFSHT','2017-04-12 20:19:09'),('6YAU1G','JOHN','john','doe','john@yahoo.com','04cd593797d9466edd8b172d8d8e974d424e2b23996e80059a4463c81f58eb460',1,1,NULL,'2017-11-21 14:32:35'),('YW9GFO','JOHN_D','John','Doe','jh@gmail.com','8a61ee0b78b342e6fca2c271959021407574b189e7754c2cb0deef9b7248ae8ab',1,1,NULL,'2017-04-12 20:25:14'),('JBDZUN','KIRK_H','Kirk','Hamett','kh@gmail.com',NULL,1,3,'MGFSHT','2017-04-12 20:23:45'),('X1MXJ3','LARS_U','Lars','Ulrich','lu@gmail.com',NULL,1,2,'MGFSHT','2017-04-12 20:24:28'),('ZH1FM4','MIKE','mike','sbc','mk@gmail.com',NULL,1,2,'EQDU2Q','2017-12-15 00:39:49'),('400GTZ','ROCKY_USERNAME','Rocky_fname','Lname','Rocky@gmail.com',NULL,1,3,'75E2OL','2017-11-20 04:41:19'),('SQHA5X','SRIRAM_CHOUDARY','Sriram Choudary','Pasam','sp1981@pace.edu','c37ec0f52fd2ca12ea5cb9a2c39396c23f639aa0d029460d1a67c994d657a7b7a',1,1,NULL,'2017-12-19 17:16:43'),('75E2OL','SRI_TEST@PACE.EDU','Sriram','P','pasam_sriram@yahoo.com','ea043fed48292fd129065567535252fc6cb9ebd4496f29316eb929266cb63d9ac',1,1,NULL,'2017-11-20 04:40:00'),('7NJ92K','TEST1','Honest','Abe','honest_abe@pace.edu',NULL,1,1,'SQHA5X','2017-12-19 17:46:46'),('1SZHP1','TEST3','Teddy updated ','Roosevelt','ted_roose@pace.edu',NULL,1,3,'SQHA5X','2017-12-19 17:48:42'),('EQDU2Q','TOM','tom','petty','tpetty@asu.com','eb2a4e63a6d6f106ad9c7cb7dc607edb1e6f2293745a3147a474b85de719c0d1e',1,1,NULL,'2017-12-15 00:39:03'),('D4T9AY','USECASE2','Use','Case','usecase2@gmail.com',NULL,1,2,'75E2OL','2017-11-20 04:42:16'),('ZITH8L','USER','User','User','user@abc.com','35bf07483e9e0cdce5f67706c50c6cccece5afd14b41b32d98680f99e5288d49f',1,1,NULL,'2017-11-21 14:05:43');
/*!40000 ALTER TABLE `userdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'usermanager'
--

--
-- Dumping routines for database 'usermanager'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-19 16:42:30
