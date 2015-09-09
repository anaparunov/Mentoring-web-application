-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pin
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `code` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `semester_regular` int(11) NOT NULL,
  `semestar_parttime` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `optional` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'Linearna algebra','SSZP06',1,1,5,0),(2,'Fizika','FIZ',1,1,6,0),(3,'Osnove elektrotehnike','SSIT01',1,1,6,1),(4,'Digitalna i mikroprocesorska tehnika','SSIT03',1,1,7,0),(5,'Uporaba računala','SSZP21',1,1,4,0),(6,'Engleski jezik 1','SSZP31',1,1,2,0),(7,'Analiza 1','SSZP07',2,2,7,0),(8,'Osnove elektronike','SSIT02',2,2,6,0),(9,'Arhitektura i organizacija digitalnih računala','SSIT05',2,2,7,1),(10,'Uvod u programiranje','SSIT04',2,2,8,0),(11,'Engleski jezik 2','SSZP32',2,2,2,0),(12,'Primijenjena i numerička matematika','SSZP03',3,3,6,0),(13,'Programske metode i apstrakcije','SSIT06',2,2,8,0),(14,'Baze podataka','SSIT07',2,2,6,0),(15,'Informacijski sustavi','SSIT08',3,3,6,0),(16,'Tehnički Engleski jezik','SSZP33',3,3,4,0),(17,'Računalne mreže','SSIT09',4,4,5,0),(18,'Operacijski sustavi','SSIT10',4,4,5,0),(19,'Strukture podataka i algoritmi','SSIT11',4,4,5,1),(20,'Objektno programiranje','SSIT12',4,4,5,1),(21,'Baze podataka 2','SSIT13',4,4,5,1),(22,'Mrežne usluge i programiranje','SSIT14',4,4,5,0),(23,'Arhitektura osobnih računala','SSIT15',4,4,5,1),(24,'Projektiranje i upravljanje računalnim mrežama','SSIT16',4,4,5,1),(25,'Projektiranje informacijskih sustava','SSIT17',4,4,5,1),(26,'Informatizacija poslovanja','SSIT18',5,5,5,1),(27,'Ekonomika i organizacija poduzeća','SSIT19',5,5,2,0),(28,'Arhitektura poslužiteljskih računala','SSIT20',5,5,5,0),(29,'Digitalni sustavi za obradu signala','SSIT22',5,5,5,1),(30,'Sigurnost računala i podataka','SSIT24',5,5,5,0),(31,'Programski alati na UNIX računalima','SSIT25',5,5,5,0),(32,'Napredno Windows programiranje','SSIT26',5,5,5,0),(33,'Objektno orijentirano modeliranje','SSIT29',5,5,5,0),(34,'Programiranje u Javi','SSIT31',5,5,5,1),(35,'Programiranje na Internetu','SSIT33',5,5,5,1),(36,'Programiranje na Internetu','SSIT33',5,5,5,1),(37,'Elektroničko poslovanje','SSIT35',5,5,5,1),(38,'Elektroničko poslovanje','SSIT35',5,5,5,1),(39,'Multimedijske mreže i sustavi','SSIT39',5,5,5,0),(40,'Njemački','SSZP40',5,5,5,1),(41,'Talijanski','SSZP50',5,5,5,1),(42,'Francuski','SSZP60',5,5,5,1),(43,'Diskretna matematika','SSZP05',6,6,6,0),(44,'Upravljanje poslužiteljskim računalima','SSIT21',6,6,5,1),(45,'Digitalna instrumentacija','SSIT23',6,6,5,1),(46,'Distribuirano objektno programiranje','SSIT27',6,6,5,1),(47,'Distribuirano objektno programiranje','SSIT27',6,6,5,1),(48,'Voñenje projekata i dokumentacija','SSIT28',6,6,5,1),(49,'Programiranje za prenosiva računala','SSIT30',6,6,5,1),(50,'Programiranje u C#','SSIT32',6,6,5,1),(51,'Oblikovanje Web stranica','SSIT34',6,6,5,1),(52,'Društveni informacijski sustavi','SSIT36',6,6,5,1),(53,'Informatizacija proizvodnje','SSIT37',6,6,5,1),(54,'Analiza i obrada podataka','SSIT38',6,6,5,1);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status` tinytext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2B219D70A76ED395` (`user_id`),
  KEY `IDX_2B219D70591CC992` (`course_id`),
  CONSTRAINT `FK_2B219D70591CC992` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2B219D70A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry`
--

LOCK TABLES `entry` WRITE;
/*!40000 ALTER TABLE `entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ana','ana','ana@parunov.com','ana@parunov.com',1,'8re5mjq6zw8w8swwwgwokw8kg0wogg0','$2y$13$8re5mjq6zw8w8swwwgwoku45LMryARPM.rTYdNMdkBKGcI.F5w0Ei','2015-09-06 20:59:59',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,0),(2,'ivana','ivana','ivana','ivana',1,'rttobew87lwkw0goswscksgg4cc040k','$2y$13$rttobew87lwkw0goswscke3at9cRPC7jSJyzhiUnpFJFDX.favKxC','2015-09-06 08:32:16',0,0,NULL,NULL,NULL,'a:1:{i:0;s:12:\"ROLE_STUDENT\";}',0,NULL,0),(3,'stipe','stipe','stipe@locastic.com','stipe@locastic.com',1,'hiygwk5egw00kk0o4wc0wc8o84g8sw4','$2y$13$hiygwk5egw00kk0o4wc0wOBMySbDI3MMzjfKa/XXuCGmHV18bfR46','2015-09-05 09:55:37',0,0,NULL,NULL,NULL,'a:1:{i:0;s:12:\"ROLE_STUDENT\";}',0,NULL,0),(4,'ivan','ivan','ivan@locastic.com','ivan@locastic.com',1,'kcpp32npak0ogkw80g4wggwsok4oog8','$2y$13$kcpp32npak0ogkw80g4wge7XyooFwzh7XinHue8.8GUiyqQCEHa5S',NULL,0,0,NULL,NULL,NULL,'a:1:{i:0;s:12:\"ROLE_STUDENT\";}',0,NULL,0),(5,'stuci','stuci','stuci@locastic.com','stuci@locastic.com',1,'etleq07s700ss80kkwk4k000o4wgwsc','$2y$13$etleq07s700ss80kkwk4kubcLPxHyRzYhzE06.PfuJHiF3PRbKxPi',NULL,0,0,NULL,NULL,NULL,'a:1:{i:0;s:12:\"ROLE_STUDENT\";}',0,NULL,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-06 21:02:48
