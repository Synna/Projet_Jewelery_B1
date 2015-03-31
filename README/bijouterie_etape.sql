CREATE DATABASE  IF NOT EXISTS `bijouterie` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `bijouterie`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: bijouterie
-- ------------------------------------------------------
-- Server version	5.6.12-log

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
-- Table structure for table `etape`
--

DROP TABLE IF EXISTS `etape`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etape` (
  `idEtape` int(11) NOT NULL AUTO_INCREMENT,
  `idProjet` int(11) NOT NULL,
  `TpsH` int(11) NOT NULL,
  `NomEtape` varchar(45) COLLATE utf8_bin NOT NULL,
  `IDEmploye` int(11) NOT NULL,
  `Note` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idEtape`),
  UNIQUE KEY `idEtape_UNIQUE` (`idEtape`),
  KEY `fk_projet_idx` (`idProjet`),
  KEY `fk-emp_idx` (`IDEmploye`),
  CONSTRAINT `fk-emp` FOREIGN KEY (`IDEmploye`) REFERENCES `employer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_projet` FOREIGN KEY (`idProjet`) REFERENCES `projet` (`idProjet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etape`
--

LOCK TABLES `etape` WRITE;
/*!40000 ALTER TABLE `etape` DISABLE KEYS */;
INSERT INTO `etape` VALUES (5,4,10,'Fondrie',2,''),(6,4,50,'Polisage',8,''),(7,4,40,'sertisage',9,''),(8,4,0,'Controle qualiter',1,''),(9,6,58,'Commander',4,' LE SAV DES FOURNISSEUR C4EST DE LA MERDEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE akulamatata'),(10,7,54,'Commande',7,' les 7 nais mon fait chier'),(11,7,200,'Blabla',6,' fgdf'),(12,7,1,'Suicide',1,' '),(13,5,56,'Kikou lol',2,'TEST'),(14,8,5,'Archi',4,' GOGOGOGO'),(15,8,17,'Fonte, Forme, Finition',2,' FINIIIIIIII'),(16,5,2,'dessin',1,' HIHLJ');
/*!40000 ALTER TABLE `etape` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-04  9:09:00
