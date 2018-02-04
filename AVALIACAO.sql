CREATE DATABASE  IF NOT EXISTS `avaliacao1` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `avaliacao1`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: avaliacao1
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `bairro`
--

DROP TABLE IF EXISTS `bairro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bairro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'chave primária',
  `nome` varchar(20) NOT NULL COMMENT 'nome do bairro',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bairro`
--

LOCK TABLES `bairro` WRITE;
/*!40000 ALTER TABLE `bairro` DISABLE KEYS */;
INSERT INTO `bairro` VALUES (1,'Tijuca'),(2,'Barra da Tijuca'),(3,'Madureira'),(4,'Campo Grande');
/*!40000 ALTER TABLE `bairro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filial`
--

DROP TABLE IF EXISTS `filial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filial` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filial`
--

LOCK TABLES `filial` WRITE;
/*!40000 ALTER TABLE `filial` DISABLE KEYS */;
INSERT INTO `filial` VALUES (1,'Tijuca'),(2,'Vargem Grande');
/*!40000 ALTER TABLE `filial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imovel`
--

DROP TABLE IF EXISTS `imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imovel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `codigo` varchar(10) NOT NULL COMMENT 'Código UNICO',
  `tipo_imovel_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Chave estrangeira da tabela `tipo_imovel`',
  `filial_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'Chave estrangeira da tabela `filial`',
  `logradouro_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'Chave estrangeira da tabela de `logradouro`',
  `numero` int(11) DEFAULT NULL COMMENT 'Nº da casa naquele logradouro',
  `tipo_negocio` enum('V','A') NOT NULL DEFAULT 'V' COMMENT 'Venda ou Aluguel',
  `valor_venda` double DEFAULT '0' COMMENT 'Valor de Venda',
  `valor_aluguel` double DEFAULT '0' COMMENT 'Valor de Aluguel',
  `dormitorios` int(11) DEFAULT NULL COMMENT 'Nº de Quartos',
  `area_terreno` double DEFAULT NULL COMMENT 'Área do Terreno',
  `banheiros` int(11) DEFAULT NULL COMMENT 'Nº de Banheiros',
  `vagas_garagem` int(11) DEFAULT NULL COMMENT 'Nº de Vagas de Garagem',
  `titulo_imovel` varchar(255) DEFAULT NULL COMMENT 'Título do imovel. ex: Casa sensacional na Tijuca',
  `descricao` text COMMENT 'Descrição do Imóvel',
  `publicado` enum('S','N') NOT NULL DEFAULT 'S' COMMENT 'Flag de Publicado do site, Sim ou Não (S/N ainda aparece na listagem)',
  `data_expiracao` datetime DEFAULT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'S' COMMENT 'Flag de Ativo (muda para N quando deletado, nao aparece mais na listagem)',
  PRIMARY KEY (`id`),
  KEY `FK_imovel` (`tipo_imovel_id`),
  KEY `FK_imovel_filial` (`filial_id`),
  KEY `FK_imovel_logradouro` (`logradouro_id`),
  CONSTRAINT `FK_imovel` FOREIGN KEY (`tipo_imovel_id`) REFERENCES `tipo_imovel` (`id`),
  CONSTRAINT `FK_imovel_filial` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`),
  CONSTRAINT `FK_imovel_logradouro` FOREIGN KEY (`logradouro_id`) REFERENCES `logradouro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imovel`
--

LOCK TABLES `imovel` WRITE;
/*!40000 ALTER TABLE `imovel` DISABLE KEYS */;
INSERT INTO `imovel` VALUES (1,'ABC2',1,1,1,15,'V',150000,0,1,67,1,0,'Casa Supreendente na Tijuca','Casa sensacional, quartos, banheiros','S','2018-11-11 00:00:00','S'),(2,'CDE3',4,2,3,10,'V',2500,0,3,150,3,0,'Casa Inovadora','','S','2019-11-11 00:00:00','S'),(3,'MANS1',1,1,1,55,'A',0,9999.99,1,11111,1,1,'Paraíso','','S','2018-11-11 00:00:00','S'),(4,'mans2',1,1,1,11,'V',10999.99,0,1,1,1,1,'Casa Inovadora Nova',' ','S','2011-11-11 00:00:00','S');
/*!40000 ALTER TABLE `imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imovel_imagem`
--

DROP TABLE IF EXISTS `imovel_imagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imovel_imagem` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'chave primaria',
  `imovel_id` int(10) unsigned NOT NULL COMMENT 'chave estrangeira da tabela imovel',
  `caminho` tinytext NOT NULL COMMENT 'caminho físico da foto',
  PRIMARY KEY (`id`),
  KEY `FK_imovel_imagem` (`imovel_id`),
  CONSTRAINT `FK_imovel_imagem` FOREIGN KEY (`imovel_id`) REFERENCES `imovel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imovel_imagem`
--

LOCK TABLES `imovel_imagem` WRITE;
/*!40000 ALTER TABLE `imovel_imagem` DISABLE KEYS */;
INSERT INTO `imovel_imagem` VALUES (1,1,'uploads/mini_1.jpg'),(2,2,'uploads/mini_2.jpg'),(3,3,'uploads/mini_3.jpg'),(4,4,'uploads/mini_4.jpg');
/*!40000 ALTER TABLE `imovel_imagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logradouro`
--

DROP TABLE IF EXISTS `logradouro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logradouro` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Chave primária',
  `bairro_id` int(10) unsigned NOT NULL COMMENT 'Chave estrangeira da tabela bairro',
  `tipo` varchar(15) NOT NULL COMMENT 'Tipo do logradouro (ex: Rua, Avenida)',
  `nome` varchar(70) NOT NULL COMMENT 'Nome do logradouro (ex: Barão de Mesquita)',
  PRIMARY KEY (`id`),
  KEY `FK_logradouro_bairro` (`bairro_id`),
  CONSTRAINT `FK_logradouro_bairro` FOREIGN KEY (`bairro_id`) REFERENCES `bairro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logradouro`
--

LOCK TABLES `logradouro` WRITE;
/*!40000 ALTER TABLE `logradouro` DISABLE KEYS */;
INSERT INTO `logradouro` VALUES (1,1,'Rua','Mariz e Barros'),(2,2,'Alameda','Dalton Barreto'),(3,3,'Estrada','do Portela'),(4,4,'Avenida','Cesário de Melo'),(5,1,'Rua','Itaperuna'),(6,1,'Avenida','Maracanã'),(7,2,'Rua','Hanibal Porto');
/*!40000 ALTER TABLE `logradouro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_imovel`
--

DROP TABLE IF EXISTS `tipo_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_imovel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'chave primária',
  `nome` varchar(50) NOT NULL COMMENT 'Nome do tipo do imóvel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_imovel`
--

LOCK TABLES `tipo_imovel` WRITE;
/*!40000 ALTER TABLE `tipo_imovel` DISABLE KEYS */;
INSERT INTO `tipo_imovel` VALUES (1,'Casa'),(2,'Apartamento'),(3,'Cobertura'),(4,'Kitnet'),(5,'Loja');
/*!40000 ALTER TABLE `tipo_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'avaliacao1'
--

--
-- Dumping routines for database 'avaliacao1'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-03 23:44:24
