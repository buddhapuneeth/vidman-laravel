-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vidman_db
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

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
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vid_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `instructor` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `vid_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` date NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `update_on` date NOT NULL,
  `updated_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'video_1','Algebra Ex1','MAT267','Scott','http://vidman.proj/videos/video_1',0,'2015-06-09','ravi','0000-00-00','','First Video','search1, first, check, whateveri'),(2,'video_2','Limits','MAT265','Heckman','http://vidman.proj/videos/video_2',0,'2015-06-09','ravi','0000-00-00','','Sec Video','search1, sec, check, whatever'),(3,'video_3','Derivatives','MAT267','Scott','http://vidman.proj/videos/video_3',0,'2015-06-09','ravi','0000-00-00','','Third Video','search1, third, check, whatever'),(4,'video_4','Algebra','MAT267','Scott','http://vidman.proj/videos/video_4',0,'2015-06-09','ravi','0000-00-00','','fourth Video','search2, fourth, check, whatever'),(5,'video_5','Integrals','MAT265','Heckman','http://vidman.proj/videos/video_5',0,'2015-06-09','ravi','0000-00-00','','Fifth Video','search2, fifth, uncheck, whatever'),(6,'video_6','Geometry','MAT267','Scott','http://vidman.proj/videos/video_6',0,'2015-06-09','ravi','0000-00-00','','Sixth Video','search2, six, check, whatever'),(7,'video_7','Geometry','MAT267','Scott','http://vidman.proj/videos/video_7',0,'2015-06-09','ravi','0000-00-00','','Seven Video','search3, seven, uncheck, whatever'),(8,'video_8','Probability','MAT265','Heckman','http://vidman.proj/videos/video_8',0,'2015-06-09','ravi','0000-00-00','','Eight Video','search3, eight, uncheck, whatever'),(9,'video_9','Combinations','MAT267','Scott','http://vidman.proj/videos/video_9',0,'2015-06-09','ravi','0000-00-00','','Nineth Video','search3, nine,uncheck, whatever'),(10,'video_10','Permutations','MAT267','Scott','http://vidman.proj/videos/video_10',0,'2015-06-09','ravi','0000-00-00','','Tenth Video','search3, ten, check, nevermind');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-26  0:34:05
