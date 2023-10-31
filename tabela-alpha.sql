CREATE DATABASE  IF NOT EXISTS `alpha` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alpha`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: alpha
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrador` (
  `ADM_ID` int NOT NULL AUTO_INCREMENT,
  `ADM_NOME` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADM_EMAIL` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADM_SENHA` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ADM_ATIVO` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ADM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (10,'jamel','jamela@jamela','$2y$10$tpq69ko3q7rTEUWgOvkN.e/m6PBUFfy2.NwrrhsoOjoccvJeEv7fC',NULL),(22,'jamelao','jamela@jamela.com','$2y$10$/C7lglT9mE.J0SZ2/z41rOBdQEettnY0w71G82QRbu.14WgNUnVkq',NULL),(25,'joao gabriel','joao@joao.com','$2y$10$HuisvJONNsPbRy.TMX9FAehCR2YyxLrc1tDxM7BBHGdjPrlaiznvi',NULL),(26,'gabriel','gabriel@gabriel.com','$2y$10$paqtp2wRNs3vQf5Pvok5dehfHLCSszir1tKvh0UAmE9F0Rn3JQPeS',NULL);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `CATEGORIA_ID` int NOT NULL AUTO_INCREMENT,
  `CATEGORIA_NOME` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CATEGORIA_DESC` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `CATEGORIA_ATIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`CATEGORIA_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'console','Computador dedicado para jogos',NULL),(3,'Jogos','Jogos para console',NULL),(4,'teste2','teste2',NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto` (
  `PRODUTO_ID` int NOT NULL AUTO_INCREMENT,
  `PRODUTO_NOME` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PRODUTO_DESC` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PRODUTO_PRECO` decimal(5,2) NOT NULL,
  `PRODUTO_DESCONTO` decimal(5,2) NOT NULL,
  `CATEGORIA_ID` int DEFAULT NULL,
  `PRODUTO_ATIVO` bit(1) DEFAULT NULL,
  PRIMARY KEY (`PRODUTO_ID`),
  KEY `FK_CATEGORIA_CATEGORIA_PRODUTO_idx` (`CATEGORIA_ID`),
  CONSTRAINT `FK_CATEGORIA_CATEGORIA_PRODUTO` FOREIGN KEY (`CATEGORIA_ID`) REFERENCES `categoria` (`CATEGORIA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_estoque`
--

DROP TABLE IF EXISTS `produto_estoque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_estoque` (
  `PRODUTO_ID` int NOT NULL,
  `PRODUTO_QTD` int NOT NULL,
  KEY `FK_PRODUTO_PRODUTO_ESTOQUE_idx` (`PRODUTO_ID`),
  CONSTRAINT `FK_PRODUTO_PRODUTO_ESTOQUE` FOREIGN KEY (`PRODUTO_ID`) REFERENCES `produto` (`PRODUTO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_estoque`
--

LOCK TABLES `produto_estoque` WRITE;
/*!40000 ALTER TABLE `produto_estoque` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_estoque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_imagem`
--

DROP TABLE IF EXISTS `produto_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_imagem` (
  `IMAGEM_ID` int NOT NULL AUTO_INCREMENT,
  `IMAGEM_ORDEM` int NOT NULL,
  `PRODUTO_ID` int NOT NULL,
  `IMAGEM_URL` varchar(8000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`IMAGEM_ID`),
  KEY `FK_PRODUTO_PRODUTO_IMAGEM_idx` (`PRODUTO_ID`),
  CONSTRAINT `FK_PRODUTO_PRODUTO_IMAGEM` FOREIGN KEY (`PRODUTO_ID`) REFERENCES `produto` (`PRODUTO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_imagem`
--

LOCK TABLES `produto_imagem` WRITE;
/*!40000 ALTER TABLE `produto_imagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_imagem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-31 10:41:33
