-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: prueba
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ci_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` int(10) unsigned DEFAULT '0',
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES (1,'111',0,NULL),(3,'111',0,NULL),(4,'127.0.0.1',1572862154,_binary '__ci_last_regenerate|i:1572862154;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 11:09:14\";}'),(5,'ddffgh',0,NULL),(9,'sfgdssdfsdfsddffsdfh',0,NULL),(10,'sfgdsddffsdfh',0,NULL),(11,'127.0.0.1',1572857057,_binary '__ci_last_regenerate|i:1572857057;'),(12,'127.0.0.1',1572857061,_binary '__ci_last_regenerate|i:1572857061;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 09:44:21\";}'),(13,'127.0.0.1',1572857062,_binary '__ci_last_regenerate|i:1572857062;'),(14,'127.0.0.1',1572857066,_binary '__ci_last_regenerate|i:1572857066;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 09:44:26\";}'),(15,'127.0.0.1',1572857067,_binary '__ci_last_regenerate|i:1572857067;'),(16,'127.0.0.1',1572857194,_binary '__ci_last_regenerate|i:1572857193;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 09:46:34\";}'),(17,'127.0.0.1',1572857194,_binary '__ci_last_regenerate|i:1572857194;'),(18,'127.0.0.1',1572857198,_binary '__ci_last_regenerate|i:1572857198;user_data|a:8:{s:2:\"id\";s:1:\"3\";s:10:\"first_name\";s:4:\"Juan\";s:9:\"last_name\";s:15:\"Gomez Sánchez \";s:5:\"email\";s:18:\"jsanchez@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"ges\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 09:46:38\";}'),(19,'127.0.0.1',1572857199,_binary '__ci_last_regenerate|i:1572857199;'),(20,'127.0.0.1',1572862151,_binary '__ci_last_regenerate|i:1572862151;'),(21,'127.0.0.1',1572862154,_binary '__ci_last_regenerate|i:1572862154;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 11:09:14\";}'),(22,'127.0.0.1',1572862155,_binary '__ci_last_regenerate|i:1572862155;'),(23,'127.0.0.1',1572862177,_binary '__ci_last_regenerate|i:1572862177;user_data|a:8:{s:2:\"id\";s:1:\"1\";s:10:\"first_name\";s:7:\"Leandro\";s:9:\"last_name\";s:18:\"Barreiro Uzcategui\";s:5:\"email\";s:19:\"lbarreiro@gmail.com\";s:8:\"password\";s:60:\"$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m\";s:5:\"nivel\";s:3:\"adm\";s:10:\"habilitado\";s:1:\"1\";s:10:\"data_login\";s:18:\"4/11/2019 11:09:37\";}'),(24,'127.0.0.1',1572862178,_binary '__ci_last_regenerate|i:1572862178;'),(25,'127.0.0.1',1572862318,_binary '__ci_last_regenerate|i:1572862318;');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-11  7:07:04
