-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: db_tatasika
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaire` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `id_publication` int NOT NULL,
  `id_compte` int NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_publication` (`id_publication`),
  KEY `id_compte` (`id_compte`),
  CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaire`
--

LOCK TABLES `commentaire` WRITE;
/*!40000 ALTER TABLE `commentaire` DISABLE KEYS */;
INSERT INTO `commentaire` VALUES (15,31,8,'SAA£AµA','2024-09-24 02:20:14'),(16,31,5,'SAlama','2024-09-24 02:20:51'),(17,31,5,'kaza','2024-09-24 03:44:55'),(18,35,5,'cometraz','2024-09-24 04:05:26'),(19,31,5,'uyuuyuyuoijhuh','2024-09-24 04:51:24'),(20,41,5,'test','2024-09-28 10:05:23'),(21,41,5,'kaiza','2024-09-29 17:08:56'),(22,42,5,'commentaire','2024-09-29 17:10:04'),(23,42,8,'tsy eee','2024-09-29 17:11:00'),(24,46,5,'azez','2024-09-29 21:30:59'),(25,31,5,'ok tsy special','2024-09-29 21:31:22'),(26,42,5,'zer','2024-09-29 22:02:37'),(27,31,5,'zer','2024-09-29 22:03:08');
/*!40000 ALTER TABLE `commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compte`
--

DROP TABLE IF EXISTS `compte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compte`
--

LOCK TABLES `compte` WRITE;
/*!40000 ALTER TABLE `compte` DISABLE KEYS */;
INSERT INTO `compte` VALUES (5,'Toavina','','toavina@gmail.com','$2y$10$FgoVProvwd5YvpNEjDCMmeUuBEiWpD9zpojXHUf7m6F170ZoZpUve'),(6,'Sylvianno','','sylvianno@gmail.com','$2y$10$NN/ZevWj6AwsOgsljGHdQuVPYJeDdgm1i8v.qjoR.UjzPB7t4Rdoa'),(7,'Jina','','jina@gmail.com','$2y$10$xTKzpRSVdzYrrutuLj7EeOJZOe0UNWm5u9stQS0m4miC/wn/Rkl82'),(8,'Test','test','test@gmail.com','$2y$10$Wwuaf76600wl9GvC7QwCo.tpklKEnZ/jGbltkHiiFUs5MKA.HBHRC');
/*!40000 ALTER TABLE `compte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication`
--

DROP TABLE IF EXISTS `publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publication` (
  `id_publication` int NOT NULL AUTO_INCREMENT,
  `id_compte` int NOT NULL,
  `contenu` text NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publication`),
  KEY `Fk_idCompte` (`id_compte`),
  CONSTRAINT `Fk_idCompte` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication`
--

LOCK TABLES `publication` WRITE;
/*!40000 ALTER TABLE `publication` DISABLE KEYS */;
INSERT INTO `publication` VALUES (31,8,'Rien de special\r\n','2024-09-24 02:20:01'),(35,5,'RAsoa','2024-09-24 04:02:45'),(36,5,'Tatasika\r\n','2024-09-24 04:03:58'),(37,5,'Testsueyu','2024-09-24 04:54:10'),(38,5,'gyg','2024-09-24 04:58:35'),(39,5,'yuu','2024-09-24 04:58:42'),(40,5,'toavina@gmail.com','2024-09-28 07:15:48'),(41,5,'yuys\r\n','2024-09-28 07:17:42'),(42,5,'eeeeeeeeeeeeeeeeeeeeeeeeee\r\n','2024-09-29 17:09:22'),(43,8,'toavina','2024-09-29 17:24:59'),(44,5,'\"\'é\"\'','2024-09-29 17:26:20'),(45,5,'azez','2024-09-29 20:34:23'),(46,5,'azer','2024-09-29 21:26:41'),(47,5,'okay','2024-09-29 22:06:24'),(48,5,'aze','2024-09-29 22:08:05'),(49,5,'AZE\r\nAZ','2024-09-29 22:08:27');
/*!40000 ALTER TABLE `publication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reaction_commentaire`
--

DROP TABLE IF EXISTS `reaction_commentaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reaction_commentaire` (
  `id_reaction_commentaire` int NOT NULL AUTO_INCREMENT,
  `id_commentaire` int NOT NULL,
  `id_compte` int NOT NULL,
  `type` enum('like','love','haha','angry') NOT NULL,
  PRIMARY KEY (`id_reaction_commentaire`),
  KEY `id_commentaire` (`id_commentaire`),
  KEY `id_compte` (`id_compte`),
  CONSTRAINT `reaction_commentaire_ibfk_1` FOREIGN KEY (`id_commentaire`) REFERENCES `commentaire` (`id_commentaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reaction_commentaire_ibfk_2` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reaction_commentaire`
--

LOCK TABLES `reaction_commentaire` WRITE;
/*!40000 ALTER TABLE `reaction_commentaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `reaction_commentaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reaction_publication`
--

DROP TABLE IF EXISTS `reaction_publication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reaction_publication` (
  `id_reaction_publication` int NOT NULL AUTO_INCREMENT,
  `id_publication` int NOT NULL,
  `id_compte` int NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id_reaction_publication`),
  KEY `id_publication` (`id_publication`),
  KEY `id_compte` (`id_compte`),
  CONSTRAINT `reaction_publication_ibfk_1` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id_publication`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reaction_publication_ibfk_2` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reaction_publication`
--

LOCK TABLES `reaction_publication` WRITE;
/*!40000 ALTER TABLE `reaction_publication` DISABLE KEYS */;
INSERT INTO `reaction_publication` VALUES (2,31,5,'like');
/*!40000 ALTER TABLE `reaction_publication` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-30  1:54:10
