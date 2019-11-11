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
-- Table structure for table `archivo`
--

DROP TABLE IF EXISTS `archivo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `archivo` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `nombre_origen` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `fk_id_usuario` (`id_usuario`),
  CONSTRAINT `FK_id_usuario_archivo` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivo`
--

LOCK TABLES `archivo` WRITE;
/*!40000 ALTER TABLE `archivo` DISABLE KEYS */;
INSERT INTO `archivo` VALUES (241,'prueba21.pdf','prueba2.pdf','application/pdf','C:/web/updates/6/prueba21.pdf',44.24,'2019-10-30 07:46:36',6),(242,'prueba22.pdf','prueba2.pdf','application/pdf','C:/web/updates/6/prueba22.pdf',44.24,'2019-10-30 07:47:14',6),(243,'prueba.pdf','prueba.pdf','application/pdf','C:/web/updates/1/prueba.pdf',44.82,'2019-10-30 07:51:29',1),(244,'prueba2.pdf','prueba2.pdf','application/pdf','C:/web/updates/4/prueba2.pdf',44.24,'2019-10-30 07:53:29',4),(245,'prueba3.pdf','prueba.pdf','application/pdf','C:/web/updates/6/prueba3.pdf',44.82,'2019-10-30 07:55:44',6),(246,'Il8NcMy1TR.pdf','Il8NcMy1TR.pdf','application/pdf','C:/web/updates/6/Il8NcMy1TR.pdf',44.82,'2019-10-30 07:55:49',6),(247,'PQldHoWNaq.pdf','PQldHoWNaq.pdf','application/pdf','C:/web/updates/2/PQldHoWNaq.pdf',44.24,'2019-10-30 07:56:22',2),(248,'ntFehgSw7U.pdf','prueba.pdf','application/pdf','C:/web/updates/20/ntFehgSw7U.pdf',44.82,'2019-10-30 08:00:45',20),(249,'jkIeRBKpOD.pdf','prueba.pdf','application/pdf','C:/web/updates/6/jkIeRBKpOD.pdf',44.82,'2019-10-30 08:14:54',6),(250,'KJBLyFbRXI.pdf','prueba.pdf','application/pdf','C:/web/updates/1/KJBLyFbRXI.pdf',44.82,'2019-10-30 08:16:35',1),(251,'bpZuheaLM0.pdf','prueba.pdf','application/pdf','C:/web/updates/1/bpZuheaLM0.pdf',44.82,'2019-10-30 08:25:16',1),(252,'KyRVepaqNb.pdf','prueba.pdf','application/pdf','C:/web/updates/21/KyRVepaqNb.pdf',44.82,'2019-10-30 09:34:13',21),(253,'Zcqy01xd2h.pdf','prueba.pdf','application/pdf','C:/web/updates/21/Zcqy01xd2h.pdf',44.82,'2019-10-30 09:35:15',21),(254,'mcJgbhrXkz.pdf','prueba.pdf','application/pdf','C:/web/updates/21/mcJgbhrXkz.pdf',44.82,'2019-10-30 09:35:41',21),(255,'DCzR7TVtb3.pdf','prueba.pdf','application/pdf','C:/web/updates/21/DCzR7TVtb3.pdf',44.82,'2019-10-30 09:36:51',21),(256,'b403sq6nal.pdf','prueba2.pdf','application/pdf','C:/web/updates/6/b403sq6nal.pdf',44.24,'2019-10-30 09:39:36',6),(257,'HZFBkAzUyp.pdf','prueba.pdf','application/pdf','C:/web/updates/6/HZFBkAzUyp.pdf',44.82,'2019-10-30 09:43:13',6),(258,'yzspSLuJIv.pdf','prueba.pdf','application/pdf','C:/web/updates/6/yzspSLuJIv.pdf',44.82,'2019-10-30 09:45:54',6),(259,'Cdb9NOr7wu.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/2/Cdb9NOr7wu.pdf',44.24,'2019-10-30 10:13:22',2),(260,'hCkwmTLD1Z.pdf','doc.pdf','application/pdf','C:/web/updates/20/hCkwmTLD1Z.pdf',44.82,'2019-10-30 11:08:24',20),(261,'uio4bRDOUj.pdf','doc.pdf','application/pdf','C:/web/updates/6/uio4bRDOUj.pdf',44.82,'2019-10-30 11:09:47',6),(262,'p8VateKZ2Y.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/21/p8VateKZ2Y.pdf',44.24,'2019-10-30 11:11:58',21),(263,'GrqM5vPw0o.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/3/GrqM5vPw0o.pdf',44.24,'2019-10-30 12:12:02',3),(264,'4SgiMdPtmn.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/4SgiMdPtmn.pdf',44.24,'2019-10-31 13:57:19',6),(265,'nm7U1rzbXy.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/nm7U1rzbXy.pdf',44.24,'2019-11-04 06:04:13',6),(266,'rCU0TjGhg2.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/rCU0TjGhg2.pdf',44.24,'2019-11-04 07:22:36',6),(267,'hTlZcv5BNR.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/hTlZcv5BNR.pdf',44.24,'2019-11-04 07:26:22',6),(268,'KRiNd7WBx0.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/KRiNd7WBx0.pdf',44.24,'2019-11-04 07:26:50',6),(269,'GPfXmzach5.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/GPfXmzach5.pdf',44.24,'2019-11-04 07:27:00',6),(270,'IFxUqT7JLE.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/IFxUqT7JLE.pdf',44.24,'2019-11-04 07:27:22',6),(271,'MqQrJUTSdD.pdf','documentodeprueba.pdf','application/pdf','C:/web/updates/6/MqQrJUTSdD.pdf',44.24,'2019-11-04 07:29:14',6),(272,'QMXRsPUr47.pdf','doc.pdf','application/pdf','C:/web/updates/6/QMXRsPUr47.pdf',44.24,'2019-11-04 07:29:42',6),(273,'Q5WOP1Ih6T.pdf','proyecto.pdf','application/pdf','C:/web/updates/6/Q5WOP1Ih6T.pdf',44.24,'2019-11-04 08:15:56',6),(274,'xdG6a5PU2e.pdf','proyecto.pdf','application/pdf','C:/web/updates/1/xdG6a5PU2e.pdf',44.24,'2019-11-04 08:17:26',1),(275,'Tg82EiV5Uu.pdf','proyecto.pdf','application/pdf','C:/web/updates/2/Tg82EiV5Uu.pdf',44.24,'2019-11-04 12:18:25',2),(276,'Fq3oMPcINV.docx','PREUBA.docx','application/vnd.openxmlformats-officedocument','C:/web/updates/21/Fq3oMPcINV.docx',11.54,'2019-11-04 12:20:03',21),(277,'zL2mfx9p5o.pdf','proyecto.pdf','application/pdf','C:/web/updates/2/zL2mfx9p5o.pdf',44.24,'2019-11-04 12:59:26',2),(278,'lpuawxIHz0.pdf','proyecto.pdf','application/pdf','C:/web/updates/26/lpuawxIHz0.pdf',44.24,'2019-11-05 06:16:16',26),(279,'gPdcZL4nxb.pdf','proyecto.pdf','application/pdf','C:/web/updates/21/gPdcZL4nxb.pdf',44.24,'2019-11-05 06:25:18',21),(280,'bsMYWwZdAE.pdf','PruebaSubida.pdf','application/pdf','C:/web/updates/6/bsMYWwZdAE.pdf',44.24,'2019-11-06 11:02:58',6);
/*!40000 ALTER TABLE `archivo` ENABLE KEYS */;
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
