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
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nivel` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  `ultimo_archivo_subido` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Leandro','Barreiro Uzcategui','lbarreiro@gmail.com','$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m','adm',1,'proyecto.pdf'),(2,'Maria','Hidalgo Vidal','mhidalgo@gmail.com','$2y$12$nI.6ibRs9eSuXeUOh4dRXucvTbHvw1Y1UnPMYoqQjKoiNU1WCRPlK','usu',1,'proyecto.pdf'),(3,'Juan','Gomez Sánchez ','jsanchez@gmail.com','$2y$12$rocCJv2e7P8AOlfpgAEf5Oqj2uSGCAS0DoUlFFh575fn0orgA/g0m','ges',1,'documentodeprueba.pdf'),(4,'prueba','prueba','error@prueba.com',NULL,'error',1,'prueba2.pdf'),(6,'foo','perez','foo@prueba.es',NULL,'prueba',1,'PruebaSubida.pdf'),(14,'prueba14','prueba14','prueba14',NULL,'rr',0,NULL),(15,'66600','666','66600',NULL,'666',0,NULL),(16,'charrua','charruaeeee','charruaeeee',NULL,'charrua',0,NULL),(17,'foouser777','foouser777','foouser',NULL,'foouser',0,NULL),(18,'ww2','ww22','ww22',NULL,'ww',0,NULL),(19,'x','xsss','xsss',NULL,'x',0,NULL),(20,'jim','morrison','jimbo@mailinator.com',NULL,'prueba',1,'doc.pdf'),(21,'jimi','hendrix','hendrix@hotmail.com',NULL,'pruebahendrix',1,'proyecto.pdf'),(22,'12','1','12',NULL,'1',0,NULL),(23,'charrua','peñarol','charrua',NULL,'peñarol',0,NULL),(24,'w','w','w',NULL,'w',0,NULL),(25,'er','er','er',NULL,'er',0,NULL),(26,'try','tytejw','ytywjwyjwytj',NULL,'tyty',0,'proyecto.pdf'),(27,'q','q','q',NULL,'q',0,NULL),(28,'test','test','test',NULL,'test',0,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-11  7:07:03
