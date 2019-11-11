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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `acceso` varchar(45) DEFAULT NULL,
  `habilitado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Home','http://web/index.php/home','Página principal','adm:ges:usu',1),(2,'Servicios','http://web/index.php/nuestrosservicios','Servicios ofrecidos','adm:ges:usu',1),(3,'Tienda','http://web/index.php/tienda','Tienda online','adm:ges:usu',1),(4,'Contacto','http://web/index.php/contacto','Datos de contacto','adm:ges:usu',1),(24,'Administración','http://web/index.php/admin','Administración del menú básico','adm:ges',1),(145,'Mi Cuenta','http://web/index.php/micuenta','Datos del usuario logueado ','adm:ges:usu',1),(146,'Prueba Jqgrid','http://web/index.php/jqgrid','Prueba sencilla de jqgrid','ges',1),(161,'Administración (con jqgrid)','http://web/index.php/adminjq','Administración del menú con jqgrid','adm:ges',1),(162,'Log Menú','http://web/index.php/logmenu','Log de acciones de usuarios en la tabla \"menu\"','adm:ges',1),(165,'Log Usuarios','http://web/index.php/logusuarios','Log de acciones de usuarios en la tabla \"usuarios\"','adm:ges',1),(170,'Doc. Codeigniter','https://codeigniter.com/user_guide/index.html','Documentación codeigniter','ges:usu',1),(185,'opc1','http://web/index.php/home','Lorem ipsum dolor sit amet, consectetur adipisicing elit','usu',1),(186,'opc2','http://web/index.php/home','Lorem ipsum dolor sit amet, consectetur adipisicing elit','usu',1),(187,'opc3','http://web/index.php/home','Lorem ipsum dolor sit amet, consectetur adipisicing elit','usu',1),(197,'prueba','prueba','prueba','prueba',1),(203,'foo','foo','foo','foo',1),(209,'op','op','op','op',1),(214,'qq','qq','qq','qq',1),(215,'ee','ee','e','e',1),(216,'f','fses','fe','f',1),(217,'fff','ff','ff','fff',1),(218,'feg','feg','eeee','ergfer',1),(219,'ee','ee','ee','ee',1),(220,'33','33','33','33',1),(221,'sds','sdfs','dfsdf','sdfsdf',1),(222,'weew','weukuy','wderkkyuk','wwe',1),(223,'nuevod','nuevo','nuevoda','df',1),(225,'wrr','rrr','rrr','rrr',1),(226,'rr','rr','rr','rr',1),(227,'fre','er','erreer','ererer',0),(228,'sdf','sdf','sdf','sdf',0),(229,'ewewr','weeew','ssfsf','sdddss',0),(230,'rfrergfererffg','fddfddfgfgfdgdffdgdfgdfg','dfffgdfgdfgfgdfgdfgdfgfdgdfgdfg','dffgd',0),(231,'qaz','nuevo','qaz','nuevo',0),(232,'er','er','er','er',1),(233,'trtt','uuuuuuuuu','uuuuuuu','rtrt',0),(234,'tryw','rtwytyttwqr000','rwtyrtyrtyw','rwty',0),(235,'1234','1234','1234','1234',0),(236,'33','33','33','33',0),(237,'22','22asdas','22asasda','22',0),(238,'rrrrrr','rrrrrrsSDGgs','rrr','rrrrrr',0),(239,'ww','wwgfhf','ww','ww',0),(240,'charrua','charr','charruaadas','char',0),(241,'foo','foo777','foo777','foo',0),(242,'qq','qq11','qq1','qq11',0),(243,'z','zqqq','z','zqqq',0),(244,'ee','ee555555','ee55','ee',0),(245,'33','33','33','33',1),(246,'EE','EE','EE','EE',1),(247,'55','55','55df','55',1),(248,'ee','e','e','e',1),(249,'rr','rr','rr','rr',1),(250,'dd','dd','dd','dd',1),(251,'zzzzzzzzz','zzzzzzzzz','zzzzzzzzz','zzzzzzzzz',1),(252,'222','222','222','222',1),(253,'we','we','we','we',1),(254,'1','12dfsdfs','12','1',0),(255,'montevideo','uy','canelones','uy',0),(256,'nombre','url','desc','1',1),(257,'qq','qq','qq','qq',0),(258,'66','66','66','66',0),(259,'ere','ere11111111111','erweqwwrg','ere',0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
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
