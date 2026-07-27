-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: advanced_navephar
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `assurance_clients`
--

DROP TABLE IF EXISTS `assurance_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assurance_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `assurance_id` bigint(20) unsigned NOT NULL,
  `expire_date` date NOT NULL,
  `par_client` double(64,4) NOT NULL,
  `par_assurance` double(64,4) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assurance_clients`
--

LOCK TABLES `assurance_clients` WRITE;
/*!40000 ALTER TABLE `assurance_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `assurance_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assurances`
--

DROP TABLE IF EXISTS `assurances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assurances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `addresse` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assurances`
--

LOCK TABLES `assurances` WRITE;
/*!40000 ALTER TABLE `assurances` DISABLE KEYS */;
/*!40000 ALTER TABLE `assurances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banques`
--

DROP TABLE IF EXISTS `banques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banques` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banques_user_id_foreign` (`user_id`),
  CONSTRAINT `banques_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banques`
--

LOCK TABLES `banques` WRITE;
/*!40000 ALTER TABLE `banques` DISABLE KEYS */;
/*!40000 ALTER TABLE `banques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bienvenu_historiques`
--

DROP TABLE IF EXISTS `bienvenu_historiques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bienvenu_historiques` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compte_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `mode_payement` varchar(400) NOT NULL,
  `title` varchar(400) NOT NULL,
  `montant` double NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bienvenu_historiques_compte_id_foreign` (`compte_id`),
  KEY `bienvenu_historiques_client_id_foreign` (`client_id`),
  CONSTRAINT `bienvenu_historiques_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `bienvenu_historiques_compte_id_foreign` FOREIGN KEY (`compte_id`) REFERENCES `comptes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bienvenu_historiques`
--

LOCK TABLES `bienvenu_historiques` WRITE;
/*!40000 ALTER TABLE `bienvenu_historiques` DISABLE KEYS */;
/*!40000 ALTER TABLE `bienvenu_historiques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canceled_invoinces`
--

DROP TABLE IF EXISTS `canceled_invoinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `canceled_invoinces` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `invoice_signature` text NOT NULL,
  `motif` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canceled_invoinces`
--

LOCK TABLES `canceled_invoinces` WRITE;
/*!40000 ALTER TABLE `canceled_invoinces` DISABLE KEYS */;
INSERT INTO `canceled_invoinces` VALUES (1,2,'4002017723/ws400201772301326/20260715105333/000002','Erreur de calcul','1','2026-07-15 08:54:25','2026-07-15 08:54:30',NULL),(2,5,'4002017723/ws400201772301326/20260723083549/000005','Erreur','1','2026-07-23 06:36:26','2026-07-23 06:36:28',NULL);
/*!40000 ALTER TABLE `canceled_invoinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_stock_id_foreign` (`stock_id`),
  CONSTRAINT `categories_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stockes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'DEFAUT',NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_histories`
--

DROP TABLE IF EXISTS `client_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `content` text NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_histories`
--

LOCK TABLES `client_histories` WRITE;
/*!40000 ALTER TABLE `client_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_maisons`
--

DROP TABLE IF EXISTS `client_maisons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_maisons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `maisonlocation_id` bigint(20) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `montant` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_maisons_user_id_foreign` (`user_id`),
  KEY `client_maisons_client_id_foreign` (`client_id`),
  KEY `client_maisons_maisonlocation_id_foreign` (`maisonlocation_id`),
  CONSTRAINT `client_maisons_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `client_maisons_maisonlocation_id_foreign` FOREIGN KEY (`maisonlocation_id`) REFERENCES `maison_locations` (`id`),
  CONSTRAINT `client_maisons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_maisons`
--

LOCK TABLES `client_maisons` WRITE;
/*!40000 ALTER TABLE `client_maisons` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_maisons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `addresse` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `client_type` varchar(255) DEFAULT NULL,
  `is_fournisseur` varchar(255) DEFAULT NULL,
  `is_commissionaire` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `customer_TIN` varchar(255) DEFAULT NULL,
  `vat_customer_payer` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `commissionnaire_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_telephone_unique` (`telephone`),
  UNIQUE KEY `clients_customer_tin_unique` (`customer_TIN`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (3,'ALUMINIUM HOLDING','00','Bujumbura',NULL,'PERSONNE MORAL',NULL,NULL,NULL,'4001762659','0','1',NULL,'2026-06-08 17:34:35','2026-06-08 17:34:35',NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande_details`
--

DROP TABLE IF EXISTS `commande_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commande_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `commande_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `quantite` double NOT NULL DEFAULT 0,
  `quantite_livre` double NOT NULL DEFAULT 0,
  `price_commande` double NOT NULL DEFAULT 0,
  `price_livraison` double NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_details_user_id_foreign` (`user_id`),
  KEY `commande_details_commande_id_foreign` (`commande_id`),
  KEY `commande_details_client_id_foreign` (`client_id`),
  KEY `commande_details_product_id_foreign` (`product_id`),
  CONSTRAINT `commande_details_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `commande_details_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`),
  CONSTRAINT `commande_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `commande_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande_details`
--

LOCK TABLES `commande_details` WRITE;
/*!40000 ALTER TABLE `commande_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `commande_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commandes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `stock_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `type_commande` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `stock_demandant` bigint(20) unsigned DEFAULT NULL,
  `stock_livrant` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commandes_user_id_foreign` (`user_id`),
  KEY `commandes_stock_id_foreign` (`stock_id`),
  KEY `commandes_client_id_foreign` (`client_id`),
  CONSTRAINT `commandes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `commandes_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stockes` (`id`),
  CONSTRAINT `commandes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commandes`
--

LOCK TABLES `commandes` WRITE;
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_details`
--

DROP TABLE IF EXISTS `commission_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commission_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `compte_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `montant` double NOT NULL,
  `activite` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commission_details_compte_id_foreign` (`compte_id`),
  KEY `commission_details_client_id_foreign` (`client_id`),
  KEY `commission_details_order_id_foreign` (`order_id`),
  KEY `commission_details_user_id_foreign` (`user_id`),
  CONSTRAINT `commission_details_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `commission_details_compte_id_foreign` FOREIGN KEY (`compte_id`) REFERENCES `comptes` (`id`),
  CONSTRAINT `commission_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `commission_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_details`
--

LOCK TABLES `commission_details` WRITE;
/*!40000 ALTER TABLE `commission_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `commission_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comptes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `montant` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comptes_client_id_foreign` (`client_id`),
  CONSTRAINT `comptes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comptes`
--

LOCK TABLES `comptes` WRITE;
/*!40000 ALTER TABLE `comptes` DISABLE KEYS */;
/*!40000 ALTER TABLE `comptes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depenses`
--

DROP TABLE IF EXISTS `depenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `depenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `montant` double(64,2) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depenses`
--

LOCK TABLES `depenses` WRITE;
/*!40000 ALTER TABLE `depenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `depenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_orders`
--

DROP TABLE IF EXISTS `detail_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantite` double(62,2) NOT NULL,
  `quantite_stock` double(62,2) NOT NULL,
  `price_unitaire` double(62,2) NOT NULL,
  `embalage` double(62,2) DEFAULT NULL,
  `code_product` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `unite_mesure` varchar(255) DEFAULT NULL,
  `date_expiration` date NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_orders`
--

LOCK TABLES `detail_orders` WRITE;
/*!40000 ALTER TABLE `detail_orders` DISABLE KEYS */;
INSERT INTO `detail_orders` VALUES (1,1,3.00,97.00,70000.00,NULL,'0001','Danzol','bouteille','2026-06-27',3,1,'2026-06-08 17:40:22','2026-06-08 17:40:22',NULL),(2,1,5.00,92.00,70000.00,NULL,'0001','Danzol','bouteille','2026-06-27',4,1,'2026-06-08 17:49:20','2026-06-08 17:49:20',NULL),(3,1,2.00,90.00,70000.00,NULL,'0001','Danzol','bouteille','2026-06-27',5,1,'2026-06-08 18:01:36','2026-06-08 18:01:36',NULL),(4,1,2.00,88.00,70000.00,NULL,'0001','Danzol','bouteille','2026-06-27',0,1,'2026-06-08 19:06:23','2026-06-08 19:06:23',NULL),(5,5,20.00,480.00,150000.00,NULL,'0002','Pompes ? air, ? main ou ? pied','piece','2026-06-08',0,1,'2026-06-08 19:14:11','2026-06-08 19:14:11',NULL),(6,1,10.00,90.00,50000.00,NULL,'0001','Prococ Wdp','piece','2026-07-31',1,1,'2026-07-15 08:52:33','2026-07-15 08:52:33',NULL),(7,1,5.00,85.00,50000.00,NULL,'0001','Prococ Wdp','piece','2026-07-31',2,1,'2026-07-15 08:53:33','2026-07-15 08:53:33',NULL),(8,2,10.00,490.00,20000.00,NULL,'0003','Pompes ? air, ? main ou ? pied','NMB','2026-07-23',4,1,'2026-07-23 06:34:21','2026-07-23 06:34:21',NULL),(9,2,5.00,485.00,20000.00,NULL,'0003','Pompes ? air, ? main ou ? pied','NMB','2026-07-23',5,1,'2026-07-23 06:35:49','2026-07-23 06:35:49',NULL),(10,1,20.00,70.00,50000.00,NULL,'0001','Prococ Wdp','piece','2026-07-31',6,1,'2026-07-23 07:39:59','2026-07-23 07:39:59',NULL);
/*!40000 ALTER TABLE `detail_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_paiment_dettes`
--

DROP TABLE IF EXISTS `detail_paiment_dettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_paiment_dettes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `paiement_dette_id` bigint(20) unsigned NOT NULL,
  `montant` double(64,2) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_paiment_dettes`
--

LOCK TABLES `detail_paiment_dettes` WRITE;
/*!40000 ALTER TABLE `detail_paiment_dettes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_paiment_dettes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embalage_mouvements`
--

DROP TABLE IF EXISTS `embalage_mouvements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `embalage_mouvements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `embalage_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `date_retour` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `embalage_mouvements_embalage_id_foreign` (`embalage_id`),
  KEY `embalage_mouvements_client_id_foreign` (`client_id`),
  KEY `embalage_mouvements_user_id_foreign` (`user_id`),
  CONSTRAINT `embalage_mouvements_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `embalage_mouvements_embalage_id_foreign` FOREIGN KEY (`embalage_id`) REFERENCES `embalages` (`id`),
  CONSTRAINT `embalage_mouvements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalage_mouvements`
--

LOCK TABLES `embalage_mouvements` WRITE;
/*!40000 ALTER TABLE `embalage_mouvements` DISABLE KEYS */;
/*!40000 ALTER TABLE `embalage_mouvements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embalages`
--

DROP TABLE IF EXISTS `embalages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `embalages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `quantity` double NOT NULL DEFAULT 0,
  `type_embalage_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `embalages_type_embalage_id_foreign` (`type_embalage_id`),
  CONSTRAINT `embalages_type_embalage_id_foreign` FOREIGN KEY (`type_embalage_id`) REFERENCES `type_embalages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalages`
--

LOCK TABLES `embalages` WRITE;
/*!40000 ALTER TABLE `embalages` DISABLE KEYS */;
/*!40000 ALTER TABLE `embalages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise_histories`
--

DROP TABLE IF EXISTS `entreprise_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entreprise_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `entreprise_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `tp_name` varchar(255) NOT NULL,
  `tp_type` varchar(255) NOT NULL,
  `tp_TIN` varchar(255) NOT NULL,
  `tp_trade_number` varchar(255) DEFAULT NULL,
  `tp_postal_number` varchar(255) DEFAULT NULL,
  `tp_phone_number` varchar(255) DEFAULT NULL,
  `tp_address_privonce` varchar(255) DEFAULT NULL,
  `tp_address_commune` varchar(255) DEFAULT NULL,
  `tp_address_quartier` varchar(255) DEFAULT NULL,
  `tp_address_avenue` varchar(255) DEFAULT NULL,
  `tp_address_rue` varchar(255) DEFAULT NULL,
  `tp_address_number` varchar(255) DEFAULT NULL,
  `vat_taxpayer` varchar(255) DEFAULT NULL,
  `ct_taxpayer` varchar(255) DEFAULT NULL,
  `tl_taxpayer` varchar(255) DEFAULT NULL,
  `tp_fiscal_center` varchar(255) DEFAULT NULL,
  `tp_activity_sector` varchar(255) DEFAULT NULL,
  `tp_legal_form` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise_histories`
--

LOCK TABLES `entreprise_histories` WRITE;
/*!40000 ALTER TABLE `entreprise_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `entreprise_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entreprises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tp_name` varchar(255) NOT NULL,
  `tp_type` varchar(255) NOT NULL,
  `tp_TIN` varchar(255) NOT NULL,
  `tp_trade_number` varchar(255) DEFAULT NULL,
  `tp_postal_number` varchar(255) DEFAULT NULL,
  `tp_phone_number` varchar(255) DEFAULT NULL,
  `tp_address_privonce` varchar(255) DEFAULT NULL,
  `tp_address_avenue` varchar(255) DEFAULT NULL,
  `tp_address_quartier` varchar(255) DEFAULT NULL,
  `tp_address_commune` varchar(255) DEFAULT NULL,
  `tp_address_rue` varchar(255) DEFAULT NULL,
  `tp_address_number` varchar(255) DEFAULT NULL,
  `vat_taxpayer` varchar(255) DEFAULT NULL,
  `ct_taxpayer` varchar(255) DEFAULT NULL,
  `tl_taxpayer` varchar(255) DEFAULT NULL,
  `tp_fiscal_center` varchar(255) DEFAULT NULL,
  `tp_activity_sector` varchar(255) DEFAULT NULL,
  `tp_legal_form` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `is_actif` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `tp_email` varchar(255) DEFAULT NULL,
  `tp_website` varchar(255) DEFAULT NULL,
  `tp_logo` varchar(255) DEFAULT NULL,
  `tp_bank` varchar(255) DEFAULT NULL,
  `tp_account_number` varchar(255) DEFAULT NULL,
  `tp_facebook` varchar(255) DEFAULT NULL,
  `tp_twitter` varchar(255) DEFAULT NULL,
  `tp_instagram` varchar(255) DEFAULT NULL,
  `tp_youtube` varchar(255) DEFAULT NULL,
  `tp_whatsapp` varchar(255) DEFAULT NULL,
  `tp_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprises`
--

LOCK TABLES `entreprises` WRITE;
/*!40000 ALTER TABLE `entreprises` DISABLE KEYS */;
INSERT INTO `entreprises` VALUES (1,'Navephar','2','4002017723','37731/22','000','79261449','Bujumbura Mairie','Avenue Oua','Industriel','Ngagara','Muyinga','32','0','0','0','DMC','Importation et vente des produits veterinaires','SURL','2','1',1,'2025-12-05 13:05:33','2025-12-05 13:27:45',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `entreprises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `env_settings`
--

DROP TABLE IF EXISTS `env_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `env_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `env_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `env_settings`
--

LOCK TABLES `env_settings` WRITE;
/*!40000 ALTER TABLE `env_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `env_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follow_products`
--

DROP TABLE IF EXISTS `follow_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `follow_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `quantite` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_products`
--

LOCK TABLES `follow_products` WRITE;
/*!40000 ALTER TABLE `follow_products` DISABLE KEYS */;
INSERT INTO `follow_products` VALUES (1,'EN','100','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Danzol\",\"marque\":null,\"unite_mesure\":\"bouteille\",\"quantite\":100,\"quantite_alert\":5,\"price\":70000,\"price_ttc\":0,\"price_max\":\"50000\",\"price_tvac\":70000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":50000,\"date_expiration\":\"2026-06-27\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T17:39:14.000000Z\",\"updated_at\":\"2026-06-08T17:39:14.000000Z\",\"deleted_at\":null,\"category\":{\"id\":2,\"title\":\"DEFAUT\",\"description\":null,\"stock_id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"stock\":{\"id\":1,\"name\":\"STOCK\\r\\n\",\"description\":null,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}}}',1,1,'2026-06-08 17:39:32','2026-06-08 17:39:32',NULL),(2,'VENTE','3','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Danzol\",\"marque\":null,\"unite_mesure\":\"bouteille\",\"quantite\":97,\"quantite_alert\":5,\"price\":70000,\"price_ttc\":0,\"price_max\":50000,\"price_tvac\":70000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":50000,\"date_expiration\":\"2026-06-27\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T17:39:14.000000Z\",\"updated_at\":\"2026-06-08T17:40:22.000000Z\",\"deleted_at\":null}',1,1,'2026-06-08 17:40:22','2026-06-08 17:40:22',NULL),(3,'VENTE','5','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Danzol\",\"marque\":null,\"unite_mesure\":\"bouteille\",\"quantite\":92,\"quantite_alert\":5,\"price\":70000,\"price_ttc\":0,\"price_max\":50000,\"price_tvac\":70000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":50000,\"date_expiration\":\"2026-06-27\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T17:39:14.000000Z\",\"updated_at\":\"2026-06-08T17:49:20.000000Z\",\"deleted_at\":null}',1,1,'2026-06-08 17:49:20','2026-06-08 17:49:20',NULL),(4,'VENTE','2','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Danzol\",\"marque\":null,\"unite_mesure\":\"bouteille\",\"quantite\":90,\"quantite_alert\":5,\"price\":70000,\"price_ttc\":0,\"price_max\":50000,\"price_tvac\":70000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":50000,\"date_expiration\":\"2026-06-27\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T17:39:14.000000Z\",\"updated_at\":\"2026-06-08T18:01:35.000000Z\",\"deleted_at\":null}',1,1,'2026-06-08 18:01:36','2026-06-08 18:01:36',NULL),(5,'VENTE','2','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Danzol\",\"marque\":null,\"unite_mesure\":\"bouteille\",\"quantite\":88,\"quantite_alert\":5,\"price\":70000,\"price_ttc\":0,\"price_max\":50000,\"price_tvac\":70000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":50000,\"date_expiration\":\"2026-06-27\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T17:39:14.000000Z\",\"updated_at\":\"2026-06-08T19:06:23.000000Z\",\"deleted_at\":null}',1,1,'2026-06-08 19:06:23','2026-06-08 19:06:23',NULL),(6,'VENTE','20','{\"id\":5,\"code_product\":\"0002\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"piece\",\"quantite\":480,\"quantite_alert\":20,\"price\":150000,\"price_ttc\":0,\"price_max\":100000,\"price_tvac\":150000,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100000,\"date_expiration\":\"2026-06-08\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-06-08T19:12:52.000000Z\",\"updated_at\":\"2026-06-08T19:14:11.000000Z\",\"deleted_at\":null}',5,1,'2026-06-08 19:14:11','2026-06-08 19:14:11',NULL),(7,'EN','100','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Prococ Wdp\",\"marque\":null,\"unite_mesure\":\"piece\",\"quantite\":100,\"quantite_alert\":5,\"price\":50000,\"price_ttc\":0,\"price_max\":\"30000\",\"price_tvac\":59000,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":30000,\"date_expiration\":\"2026-07-31\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-15T08:51:28.000000Z\",\"updated_at\":\"2026-07-15T08:51:28.000000Z\",\"deleted_at\":null,\"category\":{\"id\":2,\"title\":\"DEFAUT\",\"description\":null,\"stock_id\":1,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null,\"stock\":{\"id\":1,\"name\":\"STOCK\\r\\n\",\"description\":null,\"created_at\":null,\"updated_at\":null,\"deleted_at\":null}}}',1,1,'2026-07-15 08:51:41','2026-07-15 08:51:41',NULL),(8,'VENTE','10','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Prococ Wdp\",\"marque\":null,\"unite_mesure\":\"piece\",\"quantite\":90,\"quantite_alert\":5,\"price\":50000,\"price_ttc\":0,\"price_max\":30000,\"price_tvac\":59000,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":30000,\"date_expiration\":\"2026-07-31\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-15T08:51:28.000000Z\",\"updated_at\":\"2026-07-15T08:52:33.000000Z\",\"deleted_at\":null}',1,1,'2026-07-15 08:52:33','2026-07-15 08:52:33',NULL),(9,'VENTE','5','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Prococ Wdp\",\"marque\":null,\"unite_mesure\":\"piece\",\"quantite\":85,\"quantite_alert\":5,\"price\":50000,\"price_ttc\":0,\"price_max\":30000,\"price_tvac\":59000,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":30000,\"date_expiration\":\"2026-07-31\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-15T08:51:28.000000Z\",\"updated_at\":\"2026-07-15T08:53:33.000000Z\",\"deleted_at\":null}',1,1,'2026-07-15 08:53:33','2026-07-15 08:53:33',NULL),(10,'VENTE','10','{\"id\":2,\"code_product\":\"0003\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"NMB\",\"quantite\":490,\"quantite_alert\":20,\"price\":20000,\"price_ttc\":0,\"price_max\":15000,\"price_tvac\":23600,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":15000,\"date_expiration\":\"2026-07-23\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-23T06:31:51.000000Z\",\"updated_at\":\"2026-07-23T06:34:20.000000Z\",\"deleted_at\":null}',2,1,'2026-07-23 06:34:21','2026-07-23 06:34:21',NULL),(11,'VENTE','5','{\"id\":2,\"code_product\":\"0003\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"NMB\",\"quantite\":485,\"quantite_alert\":20,\"price\":20000,\"price_ttc\":0,\"price_max\":15000,\"price_tvac\":23600,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":15000,\"date_expiration\":\"2026-07-23\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-23T06:31:51.000000Z\",\"updated_at\":\"2026-07-23T06:35:49.000000Z\",\"deleted_at\":null}',2,1,'2026-07-23 06:35:49','2026-07-23 06:35:49',NULL),(12,'VENTE','20','{\"id\":1,\"code_product\":\"0001\",\"name\":\"Prococ Wdp\",\"marque\":null,\"unite_mesure\":\"piece\",\"quantite\":70,\"quantite_alert\":5,\"price\":50000,\"price_ttc\":0,\"price_max\":30000,\"price_tvac\":59000,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":30000,\"date_expiration\":\"2026-07-31\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-15T08:51:28.000000Z\",\"updated_at\":\"2026-07-23T07:39:58.000000Z\",\"deleted_at\":null}',1,1,'2026-07-23 07:39:59','2026-07-23 07:39:59',NULL);
/*!40000 ALTER TABLE `follow_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_chambres`
--

DROP TABLE IF EXISTS `hr_chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hr_chambres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hr_chambres_user_id_foreign` (`user_id`),
  CONSTRAINT `hr_chambres_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_chambres`
--

LOCK TABLES `hr_chambres` WRITE;
/*!40000 ALTER TABLE `hr_chambres` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_chambres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_commandes`
--

DROP TABLE IF EXISTS `hr_commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hr_commandes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `is_paid_at` varchar(255) DEFAULT NULL,
  `total_command` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hr_commandes_user_id_foreign` (`user_id`),
  KEY `hr_commandes_order_id_foreign` (`order_id`),
  CONSTRAINT `hr_commandes_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `hr_commandes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_commandes`
--

LOCK TABLES `hr_commandes` WRITE;
/*!40000 ALTER TABLE `hr_commandes` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_fiche_details`
--

DROP TABLE IF EXISTS `hr_fiche_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hr_fiche_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `fiche_id` bigint(20) unsigned NOT NULL,
  `commande_id` bigint(20) unsigned NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hr_fiche_details_user_id_foreign` (`user_id`),
  KEY `hr_fiche_details_fiche_id_foreign` (`fiche_id`),
  KEY `hr_fiche_details_commande_id_foreign` (`commande_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_fiche_details`
--

LOCK TABLES `hr_fiche_details` WRITE;
/*!40000 ALTER TABLE `hr_fiche_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_fiche_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_fiches`
--

DROP TABLE IF EXISTS `hr_fiches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hr_fiches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hr_fiches_user_id_foreign` (`user_id`),
  CONSTRAINT `hr_fiches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hr_fiches`
--

LOCK TABLES `hr_fiches` WRITE;
/*!40000 ALTER TABLE `hr_fiches` DISABLE KEYS */;
/*!40000 ALTER TABLE `hr_fiches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maison_locations`
--

DROP TABLE IF EXISTS `maison_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maison_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `montant` double NOT NULL DEFAULT 0,
  `avance` double NOT NULL DEFAULT 0,
  `tax` double NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maison_locations_user_id_foreign` (`user_id`),
  CONSTRAINT `maison_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maison_locations`
--

LOCK TABLES `maison_locations` WRITE;
/*!40000 ALTER TABLE `maison_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `maison_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_organisation`
--

DROP TABLE IF EXISTS `member_organisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_organisation` (
  `member_id` bigint(20) unsigned NOT NULL,
  `organisation_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_organisation`
--

LOCK TABLES `member_organisation` WRITE;
/*!40000 ALTER TABLE `member_organisation` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_organisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `organisation_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_email_unique` (`email`),
  KEY `members_organisation_id_foreign` (`organisation_id`),
  KEY `members_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2020_05_21_100000_create_teams_table',1),(7,'2020_05_21_200000_create_team_user_table',1),(8,'2020_11_24_051629_stockes',1),(9,'2020_11_25_030235_create_sessions_table',1),(10,'2020_11_25_045137_create_categories_table',1),(11,'2020_11_25_045154_create_products_table',1),(12,'2020_11_26_052858_create_clients_table',1),(13,'2020_11_27_045033_create_orders_table',1),(14,'2020_11_29_060103_create_detail_orders_table',1),(15,'2020_12_04_083706_create_depenses_table',1),(16,'2020_12_06_043719_create_follow_products_table',1),(17,'2020_12_09_043956_create_roles_table',1),(18,'2020_12_09_044905_create_role_users_table',1),(19,'2020_12_27_101655_create_paiement_dettes_table',1),(20,'2020_12_27_145440_create_detail_paiment_dettes_table',1),(21,'2021_03_25_043343_create_services_table',1),(22,'2022_10_21_061625_create_entreprises_table',1),(23,'2022_10_21_062333_create_entreprise_histories_table',1),(24,'2022_10_21_062724_create_product_histories_table',1),(25,'2022_10_23_051420_create_obr_declarations_table',1),(26,'2022_10_23_051526_create_obr_pointers_table',1),(27,'2022_10_23_052309_add_is_sended_to_obr_to_orders_table',1),(28,'2023_08_08_153827_create_obr_mouvement_stocks_table',1),(29,'2023_08_09_152248_create_retour_produits_table',1),(30,'2023_08_10_052320_create_jobs_table',1),(31,'2023_08_10_070637_create_obr_stock_logs_table',1),(32,'2024_01_11_112433_create_obr_request_bodies_table',1),(33,'2024_01_12_102005_create_canceled_invoinces_table',1),(34,'2024_03_31_065640_create_comptes_table',1),(35,'2024_04_03_053059_create_product_stocks_table',1),(36,'2024_04_04_074104_create_shoppingcart_table',1),(37,'2024_04_09_071626_create_commandes_table',1),(38,'2024_04_09_071627_create_commande_details_table',1),(39,'2024_04_17_065209_create_product_details_table',1),(40,'2024_04_17_120704_create_bienvenu_historiques_table',1),(41,'2024_05_10_055022_create_commission_details_table',1),(42,'2024_05_10_055336_create_order_interets_table',1),(43,'2024_05_18_084409_create_hr_chambres_table',1),(44,'2024_05_18_084549_create_hr_fiches_table',1),(45,'2024_05_18_085631_create_hr_commandes_table',1),(46,'2024_05_18_085632_create_hr_fiche_details_table',1),(47,'2024_05_18_090016_create_banques_table',1),(48,'2024_06_09_045400_create_maison_locations_table',1),(49,'2024_06_09_045652_create_client_maisons_table',1),(50,'2024_06_09_050020_create_payment_location_mensuels_table',1),(51,'2024_07_12_064350_create_periode_paiment_locations_table',1),(52,'2024_07_24_054302_create_client_histories_table',1),(53,'2024_08_28_062723_create_proformats_table',1),(54,'2024_12_19_100057_create_obr_cofigurations_table',1),(55,'2025_02_13_075230_create_stocker_users_table',1),(56,'2025_03_19_081153_create_organisations_table',1),(57,'2025_03_19_081154_create_members_table',1),(58,'2025_03_19_081155_create_organisation_members_table',1),(59,'2025_03_19_081156_create_transaction_types_table',1),(60,'2025_03_19_081157_create_transactions_table',1),(61,'2025_03_19_081158_create_transaction_files_table',1),(62,'2025_03_19_081159_create_notifications_table',1),(63,'2025_03_19_081200_create_member_organisation_table',1),(64,'2025_03_24_092310_add_fiels_to_entreprises_table',1),(65,'2025_06_09_064107_create_versements_table',1),(66,'2025_06_09_064108_create_versement_types_table',1),(67,'2025_06_12_061557_create_type_embalages_table',1),(68,'2025_06_12_061558_create_embalages_table',1),(69,'2025_06_12_061559_create_embalage_mouvements_table',1),(70,'2025_07_07_065436_create_stock_controls_table',1),(71,'2025_11_27_144431_create_assurances_table',1),(72,'2025_11_27_151620_create_assurance_clients_table',1),(73,'2025_11_27_183818_add_insurance_fields_to_orders_table',1),(74,'2025_12_04_071137_create_env_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `message` text NOT NULL,
  `description` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_cofigurations`
--

DROP TABLE IF EXISTS `obr_cofigurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_cofigurations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `config_type` varchar(255) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_cofigurations`
--

LOCK TABLES `obr_cofigurations` WRITE;
/*!40000 ALTER TABLE `obr_cofigurations` DISABLE KEYS */;
/*!40000 ALTER TABLE `obr_cofigurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_declarations`
--

DROP TABLE IF EXISTS `obr_declarations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_declarations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_declarations`
--

LOCK TABLES `obr_declarations` WRITE;
/*!40000 ALTER TABLE `obr_declarations` DISABLE KEYS */;
/*!40000 ALTER TABLE `obr_declarations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_mouvement_stocks`
--

DROP TABLE IF EXISTS `obr_mouvement_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_mouvement_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `system_or_device_id` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_designation` varchar(255) NOT NULL,
  `item_quantity` double NOT NULL,
  `item_measurement_unit` varchar(255) NOT NULL,
  `item_purchase_or_sale_price` double NOT NULL,
  `item_purchase_or_sale_currency` varchar(255) NOT NULL,
  `item_movement_type` enum('EN','ER','EI','EAJ','ET','EAU','SN','SP','SV','SD','SC','SAJ','ST','SAU') NOT NULL,
  `item_movement_invoice_ref` varchar(255) DEFAULT NULL,
  `item_movement_description` varchar(255) DEFAULT NULL,
  `item_movement_date` varchar(255) DEFAULT NULL,
  `is_importation` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `reference_dmc` varchar(255) DEFAULT NULL,
  `rubrique_tarifaire` varchar(255) DEFAULT NULL,
  `numero_paquet` varchar(255) DEFAULT NULL,
  `description_paquet` varchar(255) DEFAULT NULL,
  `item_product_detail_id` varchar(255) DEFAULT NULL,
  `is_send_to_obr` varchar(255) DEFAULT NULL,
  `is_sent_at` datetime DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `item_price` double(10,2) NOT NULL DEFAULT 0.00,
  `item_cost_price` double(10,2) NOT NULL DEFAULT 0.00,
  `item_cost_price_currency` varchar(11) DEFAULT NULL,
  `nombre_par_paquet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_mouvement_stocks`
--

LOCK TABLES `obr_mouvement_stocks` WRITE;
/*!40000 ALTER TABLE `obr_mouvement_stocks` DISABLE KEYS */;
INSERT INTO `obr_mouvement_stocks` VALUES (1,'ws400201772301326','1','Prococ Wdp',100,'piece',30000,'BIF','EN',NULL,NULL,'2026-07-15 10:51:41','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2026-07-15 10:51:52',1,'2026-07-15 08:51:41','2026-07-15 08:51:52',NULL,0.00,30000.00,NULL,NULL),(2,'ws400201772301326','1','Prococ Wdp',10,'piece',30000,'BIF','SN','1',NULL,'2026-07-15 10:52:33','0',NULL,NULL,NULL,NULL,NULL,NULL,'1','1','2026-07-15 10:52:48',1,'2026-07-15 08:52:33','2026-07-15 08:52:48',NULL,0.00,30000.00,NULL,NULL),(3,'ws400201772301326','1','Prococ Wdp',5,'piece',30000,'BIF','SN','2',NULL,'2026-07-15 10:53:33','0',NULL,NULL,NULL,NULL,NULL,NULL,'1','1','2026-07-15 10:53:55',1,'2026-07-15 08:53:33','2026-07-15 08:53:55',NULL,0.00,30000.00,NULL,NULL),(4,'ws400201772301326','1','Prococ Wdp',5,'piece',30000,'BIF','ER','2','Erreur de calcul','2026-07-15 10:54:25','0',NULL,NULL,NULL,NULL,NULL,NULL,'1','1','2026-07-15 10:54:34',1,'2026-07-15 08:54:25','2026-07-15 08:54:34',NULL,0.00,30000.00,NULL,NULL),(5,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',500,'NMB',0,'0','EN','','desc','2026-07-23 08:31:51','1','',NULL,'2026BIPORC259','84142000000','150','NMB','2',NULL,NULL,1,'2026-07-23 06:31:51','2026-07-23 06:31:51',NULL,0.00,15000.00,'BIF',50),(6,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',10,'NMB',15000,'BIF','SN','4',NULL,'2026-07-23 08:34:21','0',NULL,NULL,NULL,NULL,NULL,NULL,'2','1','2026-07-23 08:34:37',1,'2026-07-23 06:34:21','2026-07-23 06:34:37',NULL,0.00,15000.00,NULL,NULL),(7,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',0,'NMB',15000,'BIF','SN','4',NULL,'2026-07-23 08:34:21','0',NULL,NULL,NULL,NULL,NULL,NULL,'3','1','2026-07-23 08:34:38',1,'2026-07-23 06:34:21','2026-07-23 06:34:38',NULL,0.00,15000.00,NULL,NULL),(8,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',5,'NMB',15000,'BIF','SN','5',NULL,'2026-07-23 08:35:49','0',NULL,NULL,NULL,NULL,NULL,NULL,'2','1','2026-07-23 08:36:02',1,'2026-07-23 06:35:49','2026-07-23 06:36:02',NULL,0.00,15000.00,NULL,NULL),(9,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',0,'NMB',15000,'BIF','SN','5',NULL,'2026-07-23 08:35:49','0',NULL,NULL,NULL,NULL,NULL,NULL,'3','1','2026-07-23 08:36:04',1,'2026-07-23 06:35:49','2026-07-23 06:36:04',NULL,0.00,15000.00,NULL,NULL),(10,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',5,'NMB',15000,'BIF','ER','5','Erreur','2026-07-23 08:36:26','0',NULL,NULL,NULL,NULL,NULL,NULL,'2','1','2026-07-23 08:36:46',1,'2026-07-23 06:36:26','2026-07-23 06:36:46',NULL,0.00,15000.00,NULL,NULL),(11,'ws400201772301326','2','Pompes ? air, ? main ou ? pied',0,'NMB',15000,'BIF','ER','5','Erreur','2026-07-23 08:36:26','0',NULL,NULL,NULL,NULL,NULL,NULL,'3','1','2026-07-23 08:36:47',1,'2026-07-23 06:36:26','2026-07-23 06:36:47',NULL,0.00,15000.00,NULL,NULL),(12,'ws400201772301326','1','Prococ Wdp',20,'piece',30000,'BIF','SN','6',NULL,'2026-07-23 09:39:59','0',NULL,NULL,NULL,NULL,NULL,NULL,'1','1','2026-07-23 09:46:32',1,'2026-07-23 07:39:59','2026-07-23 07:46:32',NULL,0.00,30000.00,NULL,NULL);
/*!40000 ALTER TABLE `obr_mouvement_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_pointers`
--

DROP TABLE IF EXISTS `obr_pointers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_pointers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `invoice_signature` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `electronic_signature` text DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `result` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_pointers`
--

LOCK TABLES `obr_pointers` WRITE;
/*!40000 ALTER TABLE `obr_pointers` DISABLE KEYS */;
INSERT INTO `obr_pointers` VALUES (1,1,'4002017723/ws400201772301326/20260715105232/000001','1',NULL,'QogTalFkQD3TyliJFXkaeQ9K8DphqiK2+H9bZcqweL0kZCU86dN9Biw+i2t9mwjdw4/PGYCb/otvWx6fspvub4Tplp2TXeDuwB5tPiOe9mhK4gAoPSNQxXXwr96RMh9XgX6XoOXo5sfWE/ATO6Gu5TPR92ob+NEh49MuKfVaZy9gkjSU3NFk+AGjxJP1XmpqumUY1DEuerWRYXM1Vl4tz6TIB7RB3VNMeg1PcCjX8gEoVvaJHP12ZB4tfnbrlvStXukHYFAI35Kngv5YY3++YAPGWNJb1Id0V4VsNT8FZP/nm4hGLgMlTxI4d3sLsLkTQEtS/84ehJX0h7jQPptEcQ==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000001\",\"invoice_registered_number\":\"22538586\",\"invoice_registered_date\":\"2026-07-15 10:52:58\"}','2026-07-15 08:53:00','2026-07-15 08:53:00',NULL),(2,2,'4002017723/ws400201772301326/20260715105333/000002','1',NULL,'X+sHX9O9Ixbpd1KJ+qgDc8x5UQgpO+NffuBJTZCrvX+4YbLsMC+4Sq6ZY0XkT9s/1EoJPNAFZSZvRzOdy4s70pNKx2c4g28sa5uzKyBR/ALPl7Whs5A+2ixohK9Sfa1H+W6BA5RMiDpOpqhwz0dC2cFKI+rKpVHSocZw75KbJqqrcbxqMaGVrvXNs9U7nkkjdtq4SA2K9UIsjTVTOhsxDmTJqpizARhZNC12N4npXaJfVdouwb+8KDtHXaqY8G4r+/SJs9FiLnmKNWmBULva+CXTEXuuOTVVOz83G2xdOzMqQEK3fuuvjIh08szDvnfpcRLKUz8Pfu47MlRZ9bBORg==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000002\",\"invoice_registered_number\":\"22538587\",\"invoice_registered_date\":\"2026-07-15 10:54:04\"}','2026-07-15 08:54:05','2026-07-15 08:54:05',NULL),(3,2,'4002017723/ws400201772301326/20260715105333/000002','1',NULL,'4002017723/ws400201772301326/20260715105333/000002','La facture avec l\'identifiant 4002017723/ws400201772301326/20260715105333/000002 a été annulée avec succès! ','X','2026-07-15 08:54:30','2026-07-15 08:54:30',NULL),(4,3,'4002017723/ws400201772301326/20260722150616/000003','1',NULL,'O/oB0llkVud2LRHGj/3LgHqo9KoVKt28JzpCUih2yoaA+1J0s7IFcU9LfhUDCCHNY7X9JmwYy6UtttLur10L7zcUDbqgllYUBF9YYbxAmeRmbfWj8y+Tisj3ljzzrTd8+6rINVVyfmTSVMgihm0XEKXWsSugimdbSoGKKmfcegKRWm60eOIMiwIJxM9T9koLJpcx0quCy+OijnCKlrfg0zOI1EA3CdrBlqsDKu/FNkipkEkoPSmx33GN5ja0b2Ux4cIFdd6x6JNDP4dGJ4WM2aF8gh+vyTu55yk6SUzATl5OAiTz/4jVfU4L8FvqZlWzg0hyyYUzEr1PL4yXW4bTRw==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000003\",\"invoice_registered_number\":\"22540965\",\"invoice_registered_date\":\"2026-07-22 15:10:49\"}','2026-07-22 13:10:48','2026-07-22 13:10:48',NULL),(5,4,'4002017723/ws400201772301326/20260723083420/000004','1',NULL,'icKprEbbgycLPyhAKk+/pC25HTUJBm0giqtcDKETdHHlDhr11rc3NplRckEX75e1e0YVTSJlbhTINNSVva6gId7Q4vQe9Zdl1C6pThwYi9AIlpl0ZUzVjkkFVS3g/FIbmYJyjy8qIIVovWN2im8ZmNatK02OceL7Qy1Y68+Al7eqANGZU+TAv1A2fnESB9BInyuL8QU06JO4YSK924CptCF4bdlzmAdXnIUW2Cru01xZ1sRUC70ywPKGRLKvfUaCu2TzV0Dw//52C9tgzjL1nZ19h9LwebYKwTs87GaHSsKK8iwCkaOY0P/vxpDb+P3KnO4tTEOrnVPl9ZMewKMagw==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000004\",\"invoice_registered_number\":\"22541088\",\"invoice_registered_date\":\"2026-07-23 08:34:40\"}','2026-07-23 06:34:40','2026-07-23 06:34:40',NULL),(6,5,'4002017723/ws400201772301326/20260723083549/000005','1',NULL,'dhlji+/8VTC8+6QvG1pNpsRbiW2LeJmQ+QpuXeFtBAXTtjST+/ZX0poIl7flIr12P+hIh+4w7wz4f9J7VOH7ga2j3Nw/cgifd3DhXhGd+Xg/t/DfknnGNJIaZ358n73lvHMlotSxH0G2KGLUJYp5aGN+6fcZjxeeAmwqk61sI/Ju2zRLDAvzqlwW/5kmmQ5kW/j71x6kabnOzvVvrjiYQu1uIMM08MhJwDCFx4ow6GUcAEaz0ZelabuSWVFAU/jF0XjTPAoHaxeGa4zQ0UUjdS/yDBVghoy6P93vsN90GQIWjJVVxPLQ/q/8XCEFU6pg1Zm1mHMnbjq25j6Sm48kYA==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000005\",\"invoice_registered_number\":\"22541090\",\"invoice_registered_date\":\"2026-07-23 08:36:07\"}','2026-07-23 06:36:07','2026-07-23 06:36:07',NULL),(7,5,'4002017723/ws400201772301326/20260723083549/000005','1',NULL,'4002017723/ws400201772301326/20260723083549/000005','La facture avec l\'identifiant 4002017723/ws400201772301326/20260723083549/000005 a été annulée avec succès! ','X','2026-07-23 06:36:28','2026-07-23 06:36:28',NULL),(8,6,'4002017723/ws400201772301326/20260723093958/000006','1',NULL,'DlTohlZABAxDVzQhyEXLhokKhQqzZYm7GNrmItHk7rde+keMyL2aD99H/64xaNbb202AeXHPu3c/HcV7TKzM0w//CoyuJRyvpvuM7M1v9EDDJ8yNIjIjyAENkPkZ4/7WocS/R4J7u0BK7qSeIcbFJ33Dub8OQZ46ioieica4u7Z0ITnX0M7fJqeAX0zKVHp3BlphABw2pZer4aMzZwGYtsU/DLdgcgmaP+8pyqbR1AP07TPww94ACF7RLic6bRrKN2hrwUmVdUn0IfS6U1enxRs0+LSlRTkXdoiEF6MIACl9XsuuhIWUFtT+K5sZ8Y1uSpPN+IgJ0pIagsSzc+NOBA==','La facture a été ajoutée avec succès!','{\"invoice_number\":\"000006\",\"invoice_registered_number\":\"22541096\",\"invoice_registered_date\":\"2026-07-23 09:46:35\"}','2026-07-23 07:46:34','2026-07-23 07:46:34',NULL);
/*!40000 ALTER TABLE `obr_pointers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_request_bodies`
--

DROP TABLE IF EXISTS `obr_request_bodies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_request_bodies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `request_body` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_request_bodies`
--

LOCK TABLES `obr_request_bodies` WRITE;
/*!40000 ALTER TABLE `obr_request_bodies` DISABLE KEYS */;
INSERT INTO `obr_request_bodies` VALUES (1,1,'{\"invoice_id\":1,\"invoice_number\":\"000001\",\"invoice_date\":\"2026-07-15 10:52:32\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260715105232\\/000001\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260715105232\\/000001\",\"invoice_signature_date\":\"2026-07-15 10:52:32\",\"invoice_items\":[{\"item_designation\":\"Prococ Wdp\",\"item_quantity\":10,\"item_price\":50000,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":500000,\"vat\":90000,\"item_price_wvat\":590000,\"item_total_amount\":590000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-15 08:52:58','2026-07-15 08:52:58',NULL),(2,2,'{\"invoice_id\":2,\"invoice_number\":\"000002\",\"invoice_date\":\"2026-07-15 10:53:33\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260715105333\\/000002\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260715105333\\/000002\",\"invoice_signature_date\":\"2026-07-15 10:53:33\",\"invoice_items\":[{\"item_designation\":\"Prococ Wdp\",\"item_quantity\":5,\"item_price\":50000,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":250000,\"vat\":45000,\"item_price_wvat\":295000,\"item_total_amount\":295000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-15 08:54:02','2026-07-15 08:54:02',NULL),(3,2,'{\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260715105333\\/000002\",\"cn_motif\":\"Erreur de calcul\"}','2026-07-15 08:54:28','2026-07-15 08:54:28',NULL),(4,3,'{\"invoice_id\":3,\"invoice_number\":\"000003\",\"invoice_date\":\"2026-07-22 15:06:16\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260722150616\\/000003\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260722150616\\/000003\",\"invoice_signature_date\":\"2026-07-22 15:06:16\",\"invoice_items\":[{\"item_designation\":\"Service de consultation\",\"item_quantity\":\"1\",\"item_price\":\"200000\",\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":200000,\"vat\":36000,\"item_price_wvat\":236000,\"item_total_amount\":236000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-22 13:10:48','2026-07-22 13:10:48',NULL),(5,4,'{\"invoice_id\":4,\"invoice_number\":\"000004\",\"invoice_date\":\"2026-07-23 08:34:20\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260723083420\\/000004\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260723083420\\/000004\",\"invoice_signature_date\":\"2026-07-23 08:34:20\",\"invoice_items\":[{\"item_designation\":\"Pompes ? air, ? main ou ? pied\",\"item_quantity\":10,\"item_price\":20000,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":200000,\"vat\":36000,\"item_price_wvat\":236000,\"item_total_amount\":236000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-23 06:34:40','2026-07-23 06:34:40',NULL),(6,5,'{\"invoice_id\":5,\"invoice_number\":\"000005\",\"invoice_date\":\"2026-07-23 08:35:49\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260723083549\\/000005\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260723083549\\/000005\",\"invoice_signature_date\":\"2026-07-23 08:35:49\",\"invoice_items\":[{\"item_designation\":\"Pompes ? air, ? main ou ? pied\",\"item_quantity\":5,\"item_price\":20000,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":100000,\"vat\":18000,\"item_price_wvat\":118000,\"item_total_amount\":118000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-23 06:36:06','2026-07-23 06:36:06',NULL),(7,5,'{\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260723083549\\/000005\",\"cn_motif\":\"Erreur\"}','2026-07-23 06:36:28','2026-07-23 06:36:28',NULL),(8,6,'{\"invoice_id\":6,\"invoice_number\":\"000006\",\"invoice_date\":\"2026-07-23 09:39:58\",\"tp_type\":\"2\",\"tp_name\":\"Navephar\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_commune\":\"Ngagara\",\"tp_address_quartier\":\"Industriel\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"ALUMINIUM HOLDING\",\"customer_TIN\":\"4001762659\",\"customer_address\":\"Bujumbura\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cn_motif\":\"\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002017723\\/ws400201772301326\\/20260723093958\\/000006\",\"invoice_identifier\":\"4002017723\\/ws400201772301326\\/20260723093958\\/000006\",\"invoice_signature_date\":\"2026-07-23 09:39:58\",\"invoice_items\":[{\"item_designation\":\"Prococ Wdp\",\"item_quantity\":20,\"item_price\":50000,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":1000000,\"vat\":180000,\"item_price_wvat\":1180000,\"item_total_amount\":1180000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2026-07-23 07:46:34','2026-07-23 07:46:34',NULL);
/*!40000 ALTER TABLE `obr_request_bodies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_stock_logs`
--

DROP TABLE IF EXISTS `obr_stock_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obr_stock_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `movement_id` varchar(255) NOT NULL,
  `success` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `result` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_stock_logs`
--

LOCK TABLES `obr_stock_logs` WRITE;
/*!40000 ALTER TABLE `obr_stock_logs` DISABLE KEYS */;
INSERT INTO `obr_stock_logs` VALUES (1,'1','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-15 08:51:52','2026-07-15 08:51:52',NULL),(2,'2','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-15 08:52:48','2026-07-15 08:52:48',NULL),(3,'3','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-15 08:53:55','2026-07-15 08:53:55',NULL),(4,'4','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-15 08:54:34','2026-07-15 08:54:34',NULL),(5,'6','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-23 06:34:37','2026-07-23 06:34:37',NULL),(6,'7','0','Le mouvement de stock a deja ete enregistre dans le systeme','[]','2026-07-23 06:34:38','2026-07-23 06:34:38',NULL),(7,'8','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-23 06:36:02','2026-07-23 06:36:02',NULL),(8,'9','0','Le mouvement de stock a deja ete enregistre dans le systeme','[]','2026-07-23 06:36:04','2026-07-23 06:36:04',NULL),(9,'10','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-23 06:36:46','2026-07-23 06:36:46',NULL),(10,'11','0','Le mouvement de stock a deja ete enregistre dans le systeme','[]','2026-07-23 06:36:47','2026-07-23 06:36:47',NULL),(11,'12','1','L\'opération s\'est effectué avec succès! ','[]','2026-07-23 07:46:32','2026-07-23 07:46:32',NULL);
/*!40000 ALTER TABLE `obr_stock_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_interets`
--

DROP TABLE IF EXISTS `order_interets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_interets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `montant` double NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_interets_order_id_foreign` (`order_id`),
  KEY `order_interets_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_interets`
--

LOCK TABLES `order_interets` WRITE;
/*!40000 ALTER TABLE `order_interets` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_interets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(60,2) NOT NULL,
  `tax` double(60,2) NOT NULL,
  `total_quantity` double(60,2) NOT NULL,
  `total_sacs` double(60,2) NOT NULL,
  `amount_tax` double(60,2) NOT NULL,
  `type_paiement` varchar(255) NOT NULL,
  `type_facture` varchar(255) DEFAULT NULL,
  `invoice_currency` varchar(255) DEFAULT NULL,
  `invoice_type` varchar(255) DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `products` text NOT NULL,
  `company` text DEFAULT NULL,
  `client` text DEFAULT NULL,
  `canceled_or_connection` text DEFAULT NULL,
  `addresse_client` text DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `commissionaire_id` bigint(20) unsigned DEFAULT NULL,
  `maison_id` bigint(20) unsigned DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `update_info` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `envoye_obr` varchar(255) DEFAULT NULL,
  `envoye_par` varchar(255) DEFAULT NULL,
  `envoye_time` varchar(255) DEFAULT NULL,
  `invoice_signature` varchar(255) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `par_client` double DEFAULT 0,
  `par_assurance` double DEFAULT 0,
  `par_client_pourcentage` double DEFAULT 0,
  `par_assurance_pourcentage` double DEFAULT 0,
  `assurance_id` int(11) DEFAULT 0,
  `assurance_name` varchar(255) DEFAULT NULL,
  `supplement` varchar(255) DEFAULT NULL,
  `cn_motif` text DEFAULT NULL,
  `invoice_ref` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,590000.00,90000.00,10.00,0.20,500000.00,'2','FACTURE','BIF','FN','1','a:1:{i:0;a:17:{s:2:\"id\";i:1;s:4:\"name\";s:10:\"Prococ Wdp\";s:5:\"rowId\";s:32:\"7f0789cf01c4de0607a423535fcd9c7d\";s:5:\"price\";d:50000;s:12:\"unite_mesure\";s:5:\"piece\";s:13:\"price_revient\";d:30000;s:8:\"quantite\";d:10;s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:500000;s:16:\"interet_unitaire\";d:20000;s:13:\"interet_total\";d:200000;s:3:\"vat\";d:90000;s:15:\"item_price_wvat\";d:590000;s:17:\"item_total_amount\";d:590000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,0,NULL,'2026-07-15 08:52:32','2026-07-15 08:53:00',NULL,'1','1','2026-07-15 10:52:59','4002017723/ws400201772301326/20260715105232/000001','2026-07-15',0,0,0,0,0,NULL,NULL,NULL,NULL),(2,295000.00,45000.00,5.00,0.10,250000.00,'1','FACTURE','BIF','FN',NULL,'a:1:{i:0;a:17:{s:2:\"id\";i:1;s:4:\"name\";s:10:\"Prococ Wdp\";s:5:\"rowId\";s:32:\"7f0789cf01c4de0607a423535fcd9c7d\";s:5:\"price\";d:50000;s:12:\"unite_mesure\";s:5:\"piece\";s:13:\"price_revient\";d:30000;s:8:\"quantite\";d:5;s:10:\"nombre_sac\";d:0.1;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:250000;s:16:\"interet_unitaire\";d:20000;s:13:\"interet_total\";d:100000;s:3:\"vat\";d:45000;s:15:\"item_price_wvat\";d:295000;s:17:\"item_total_amount\";d:295000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,1,NULL,'2026-07-15 08:53:33','2026-07-15 08:54:30',NULL,'1','1','2026-07-15 10:54:05','4002017723/ws400201772301326/20260715105333/000002','2026-07-15',0,0,0,0,0,NULL,NULL,NULL,NULL),(3,236000.00,36000.00,1.00,0.00,200000.00,'2','FACTURE','BIF','FN',NULL,'a:1:{i:0;a:13:{s:2:\"id\";s:6:\"ITEM_1\";s:4:\"name\";s:23:\"Service de consultation\";s:5:\"rowId\";s:19:\"SERVICE_FACTURATION\";s:5:\"price\";s:6:\"200000\";s:8:\"quantite\";s:1:\"1\";s:10:\"nombre_sac\";i:0;s:8:\"embalage\";i:0;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";i:200000;s:3:\"vat\";i:36000;s:15:\"item_price_wvat\";i:236000;s:17:\"item_total_amount\";i:236000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,0,NULL,'2026-07-22 13:06:16','2026-07-22 13:10:48',NULL,'1','1','2026-07-22 15:10:48','4002017723/ws400201772301326/20260722150616/000003','2026-07-22',0,0,0,0,0,'','0',NULL,NULL),(4,236000.00,36000.00,10.00,0.20,200000.00,'1','FACTURE','BIF','FN',NULL,'a:1:{i:0;a:17:{s:2:\"id\";i:2;s:4:\"name\";s:30:\"Pompes ? air, ? main ou ? pied\";s:5:\"rowId\";s:32:\"082599203a91f6fc1e08c6b2394261a5\";s:5:\"price\";d:20000;s:12:\"unite_mesure\";s:3:\"NMB\";s:13:\"price_revient\";d:15000;s:8:\"quantite\";d:10;s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:200000;s:16:\"interet_unitaire\";d:5000;s:13:\"interet_total\";d:50000;s:3:\"vat\";d:36000;s:15:\"item_price_wvat\";d:236000;s:17:\"item_total_amount\";d:236000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,0,NULL,'2026-07-23 06:34:20','2026-07-23 06:34:40',NULL,'1','1','2026-07-23 08:34:40','4002017723/ws400201772301326/20260723083420/000004','2026-07-23',0,0,0,0,0,NULL,NULL,NULL,NULL),(5,118000.00,18000.00,5.00,0.10,100000.00,'1','FACTURE','BIF','FN',NULL,'a:1:{i:0;a:17:{s:2:\"id\";i:2;s:4:\"name\";s:30:\"Pompes ? air, ? main ou ? pied\";s:5:\"rowId\";s:32:\"082599203a91f6fc1e08c6b2394261a5\";s:5:\"price\";d:20000;s:12:\"unite_mesure\";s:3:\"NMB\";s:13:\"price_revient\";d:15000;s:8:\"quantite\";d:5;s:10:\"nombre_sac\";d:0.1;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:100000;s:16:\"interet_unitaire\";d:5000;s:13:\"interet_total\";d:25000;s:3:\"vat\";d:18000;s:15:\"item_price_wvat\";d:118000;s:17:\"item_total_amount\";d:118000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,1,NULL,'2026-07-23 06:35:49','2026-07-23 06:36:28',NULL,'1','1','2026-07-23 08:36:07','4002017723/ws400201772301326/20260723083549/000005','2026-07-23',0,0,0,0,0,NULL,NULL,NULL,NULL),(6,1180000.00,180000.00,20.00,0.40,1000000.00,'2','FACTURE','BIF','FN',NULL,'a:1:{i:0;a:17:{s:2:\"id\";i:1;s:4:\"name\";s:10:\"Prococ Wdp\";s:5:\"rowId\";s:32:\"7f0789cf01c4de0607a423535fcd9c7d\";s:5:\"price\";d:50000;s:12:\"unite_mesure\";s:5:\"piece\";s:13:\"price_revient\";d:30000;s:8:\"quantite\";d:20;s:10:\"nombre_sac\";d:0.4;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1000000;s:16:\"interet_unitaire\";d:20000;s:13:\"interet_total\";d:400000;s:3:\"vat\";d:180000;s:15:\"item_price_wvat\";d:1180000;s:17:\"item_total_amount\";d:1180000;}}','{\"id\":1,\"tp_name\":\"Navephar\",\"tp_type\":\"2\",\"tp_TIN\":\"4002017723\",\"tp_trade_number\":\"37731\\/22\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"79261449\",\"tp_address_privonce\":\"Bujumbura Mairie\",\"tp_address_avenue\":\"Avenue Oua\",\"tp_address_quartier\":\"Industriel\",\"tp_address_commune\":\"Ngagara\",\"tp_address_rue\":\"Muyinga\",\"tp_address_number\":\"32\",\"vat_taxpayer\":\"0\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"Importation et vente des produits veterinaires\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-12-05T12:05:33.000000Z\",\"updated_at\":\"2025-12-05T12:27:45.000000Z\",\"deleted_at\":null,\"tp_email\":null,\"tp_website\":null,\"tp_logo\":null,\"tp_bank\":null,\"tp_account_number\":null,\"tp_facebook\":null,\"tp_twitter\":null,\"tp_instagram\":null,\"tp_youtube\":null,\"tp_whatsapp\":null,\"tp_address\":null}','{\"id\":3,\"name\":\"ALUMINIUM HOLDING\",\"telephone\":\"00\",\"addresse\":\"Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE MORAL\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":\"4001762659\",\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2026-06-08T17:34:35.000000Z\",\"updated_at\":\"2026-06-08T17:34:35.000000Z\",\"deleted_at\":null}',NULL,'Bujumbura',1,3,NULL,NULL,0,NULL,'2026-07-23 07:39:58','2026-07-23 07:46:34',NULL,'1','1','2026-07-23 09:46:34','4002017723/ws400201772301326/20260723093958/000006','2026-07-23',0,0,0,0,0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation_members`
--

DROP TABLE IF EXISTS `organisation_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organisation_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organisation_id` bigint(20) unsigned NOT NULL,
  `member_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_members_organisation_id_foreign` (`organisation_id`),
  KEY `organisation_members_member_id_foreign` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation_members`
--

LOCK TABLES `organisation_members` WRITE;
/*!40000 ALTER TABLE `organisation_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `organisation_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organisations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations`
--

LOCK TABLES `organisations` WRITE;
/*!40000 ALTER TABLE `organisations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paiement_dettes`
--

DROP TABLE IF EXISTS `paiement_dettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paiement_dettes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `montant` double(64,2) DEFAULT NULL,
  `montant_restant` double(64,2) DEFAULT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'NON PAYE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paiement_dettes`
--

LOCK TABLES `paiement_dettes` WRITE;
/*!40000 ALTER TABLE `paiement_dettes` DISABLE KEYS */;
/*!40000 ALTER TABLE `paiement_dettes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_location_mensuels`
--

DROP TABLE IF EXISTS `payment_location_mensuels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_location_mensuels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `maisonlocation_id` bigint(20) unsigned NOT NULL,
  `client_maison_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `total_payment_mensuel` text DEFAULT NULL,
  `order_id` bigint(20) unsigned DEFAULT NULL,
  `periode_paiement_id` bigint(20) unsigned DEFAULT NULL,
  `type_paiement` text DEFAULT NULL,
  `montant` double NOT NULL DEFAULT 0,
  `date_paiement` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_location_mensuels_user_id_foreign` (`user_id`),
  KEY `payment_location_mensuels_maisonlocation_id_foreign` (`maisonlocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_location_mensuels`
--

LOCK TABLES `payment_location_mensuels` WRITE;
/*!40000 ALTER TABLE `payment_location_mensuels` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_location_mensuels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periode_paiment_locations`
--

DROP TABLE IF EXISTS `periode_paiment_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periode_paiment_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `periode_paiment_locations_year_month_unique` (`year`,`month`),
  KEY `periode_paiment_locations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periode_paiment_locations`
--

LOCK TABLES `periode_paiment_locations` WRITE;
/*!40000 ALTER TABLE `periode_paiment_locations` DISABLE KEYS */;
INSERT INTO `periode_paiment_locations` VALUES (1,1,'2026','07',NULL,NULL,'2026-07-27 08:06:51','2026-07-27 08:06:51');
/*!40000 ALTER TABLE `periode_paiment_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `stock_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `prix_revient` double DEFAULT NULL,
  `quantite` double DEFAULT NULL,
  `quantite_restant` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_details_user_id_foreign` (`user_id`),
  KEY `product_details_stock_id_foreign` (`stock_id`),
  KEY `product_details_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
INSERT INTO `product_details` VALUES (1,1,1,1,30000,100,70,'NEW PRODUCT','2026-07-15 08:51:41','2026-07-23 07:39:59',NULL),(2,1,1,2,15000,500,490,NULL,'2026-07-23 06:31:51','2026-07-23 06:36:26',NULL),(3,1,1,2,15000,500,500,NULL,'2026-07-23 06:31:51','2026-07-23 06:31:51',NULL);
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_histories`
--

DROP TABLE IF EXISTS `product_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_histories`
--

LOCK TABLES `product_histories` WRITE;
/*!40000 ALTER TABLE `product_histories` DISABLE KEYS */;
INSERT INTO `product_histories` VALUES (1,5,'{\"id\":5,\"code_product\":\"0\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"NMB\",\"quantite\":500,\"quantite_alert\":20,\"price\":0,\"price_ttc\":0,\"price_max\":0,\"price_tvac\":0,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":0,\"date_expiration\":\"2026-06-08\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2026-06-08T19:12:52.000000Z\",\"updated_at\":\"2026-06-08T19:12:52.000000Z\",\"deleted_at\":null}',1,'2026-06-08 19:13:44','2026-06-08 19:13:44',NULL),(2,2,'{\"id\":2,\"code_product\":\"0\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"NMB\",\"quantite\":500,\"quantite_alert\":20,\"price\":0,\"price_ttc\":0,\"price_max\":0,\"price_tvac\":0,\"taux_tva\":0,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":0,\"date_expiration\":\"2026-07-23\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":1,\"created_at\":\"2026-07-23T06:31:51.000000Z\",\"updated_at\":\"2026-07-23T06:31:51.000000Z\",\"deleted_at\":null}',1,'2026-07-23 06:32:45','2026-07-23 06:32:45',NULL),(3,2,'{\"id\":2,\"code_product\":\"0003\",\"name\":\"Pompes ? air, ? main ou ? pied\",\"marque\":\"Pompes ? air, ? main ou ? pied\",\"unite_mesure\":\"NMB\",\"quantite\":500,\"quantite_alert\":20,\"price\":16949.15,\"price_ttc\":0,\"price_max\":15000,\"price_tvac\":20000,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":15000,\"date_expiration\":\"2026-07-23\",\"description\":\"Pompes ? air, ? main ou ? pied\",\"user_id\":1,\"category_id\":2,\"created_at\":\"2026-07-23T06:31:51.000000Z\",\"updated_at\":\"2026-07-23T06:32:45.000000Z\",\"deleted_at\":null}',1,'2026-07-23 06:33:30','2026-07-23 06:33:30',NULL);
/*!40000 ALTER TABLE `product_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_stocks`
--

DROP TABLE IF EXISTS `product_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `stock_id` bigint(20) unsigned NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `quantity_alert` double NOT NULL DEFAULT 0,
  `prix_revient` double NOT NULL DEFAULT 0,
  `quantite_alert` double NOT NULL DEFAULT 0,
  `prix_vente` double NOT NULL DEFAULT 0,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_stocks_product_id_stock_id_unique` (`product_id`,`stock_id`),
  KEY `product_stocks_stock_id_foreign` (`stock_id`),
  KEY `product_stocks_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_stocks`
--

LOCK TABLES `product_stocks` WRITE;
/*!40000 ALTER TABLE `product_stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code_product` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `unite_mesure` varchar(255) DEFAULT NULL,
  `quantite` double(62,2) NOT NULL DEFAULT 0.00,
  `quantite_alert` double(62,2) NOT NULL DEFAULT 0.00,
  `price` double(62,2) NOT NULL DEFAULT 0.00,
  `price_ttc` double(62,2) NOT NULL DEFAULT 0.00,
  `price_max` double(62,2) NOT NULL DEFAULT 0.00,
  `price_tvac` double(62,2) NOT NULL DEFAULT 0.00,
  `taux_tva` double(62,2) NOT NULL DEFAULT 0.00,
  `item_ott_tax` double(62,2) NOT NULL DEFAULT 0.00,
  `item_tsce_tax` double(62,2) NOT NULL DEFAULT 0.00,
  `price_min` double(62,2) NOT NULL DEFAULT 0.00,
  `date_expiration` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'0001','Prococ Wdp',NULL,'piece',70.00,5.00,50000.00,0.00,30000.00,59000.00,18.00,0.00,0.00,30000.00,'2026-07-31',NULL,1,2,'2026-07-15 08:51:28','2026-07-23 07:39:58',NULL),(2,'0003','Pompes ? air, ? main ou ? pied','Pompes ? air, ? main ou ? pied','NMB',490.00,20.00,20000.00,0.00,15000.00,23600.00,18.00,0.00,0.00,15000.00,'2026-07-23','Pompes ? air, ? main ou ? pied',1,2,'2026-07-23 06:31:51','2026-07-23 06:36:26',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proformats`
--

DROP TABLE IF EXISTS `proformats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proformats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(60,2) NOT NULL,
  `tax` double(60,2) NOT NULL,
  `total_quantity` double(60,2) NOT NULL,
  `total_sacs` double(60,2) NOT NULL,
  `amount_tax` double(60,2) NOT NULL,
  `type_paiement` varchar(255) NOT NULL,
  `type_facture` varchar(255) DEFAULT NULL,
  `products` text NOT NULL,
  `company` text DEFAULT NULL,
  `client` text DEFAULT NULL,
  `canceled_or_connection` text DEFAULT NULL,
  `addresse_client` text DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `commissionaire_id` bigint(20) unsigned DEFAULT NULL,
  `maison_id` bigint(20) unsigned DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `envoye_obr` varchar(255) DEFAULT NULL,
  `envoye_par` varchar(255) DEFAULT NULL,
  `envoye_time` varchar(255) DEFAULT NULL,
  `invoice_currency` varchar(255) DEFAULT NULL,
  `invoice_signature` varchar(255) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proformats`
--

LOCK TABLES `proformats` WRITE;
/*!40000 ALTER TABLE `proformats` DISABLE KEYS */;
/*!40000 ALTER TABLE `proformats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retour_produits`
--

DROP TABLE IF EXISTS `retour_produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `retour_produits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `order_id` bigint(20) unsigned NOT NULL,
  `quantite` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retour_produits`
--

LOCK TABLES `retour_produits` WRITE;
/*!40000 ALTER TABLE `retour_produits` DISABLE KEYS */;
INSERT INTO `retour_produits` VALUES (1,1,'Danzol',5,2,'Erreur',1,'2026-06-08 19:18:10','2026-06-08 19:18:10',NULL),(2,1,'Prococ Wdp',2,5,'Erreur de calcul',1,'2026-07-15 08:54:25','2026-07-15 08:54:25',NULL),(3,2,'Pompes ? air, ? main ou ? pied',5,5,'Erreur',1,'2026-07-23 06:36:26','2026-07-23 06:36:26',NULL);
/*!40000 ALTER TABLE `retour_produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(2,1,2,NULL,NULL,NULL),(3,2,2,NULL,NULL,NULL),(4,3,2,NULL,NULL,NULL),(5,4,2,NULL,NULL,NULL),(6,5,2,NULL,NULL,NULL),(7,6,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMINISTRATEUR','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(2,'CONTROLLEUR','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(3,'COMPTABLE','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(4,'VENTE','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(5,'ENTRE DES PRODUITS EN STOCK','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(6,'JOURNAL','2025-12-05 13:05:33','2025-12-05 13:05:33',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `montant` double(64,2) NOT NULL,
  `quantite` double(64,2) NOT NULL,
  `total` double(64,2) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('evKO2nPvLC9BSZyoUm6HCfvRrdokVCsgzH1RrOsh',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibW5QTTFNQjc3ZG1KZ0gyVjJpSnNneEsxM011ZTJiVHBPNjZ1Qms3ZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1785138525),('YX1Mx3xmspNy0ilxCTrXb03TNtjPvTzOUB4rlZGS',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiMkpUQ2pTaE41UG5uaEU3bXo4UGdNbERNVmdIM1NXUERCYWNpemVoRCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb2JyX2xvZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ5MklYVU5wa2pPMHJPUTVieU1pLlllNG9Lb0VhM1JvOWxsQy8ub2cvYXQyLnVoZVdHL2lnaSI7czo0OiJjYXJ0IjthOjE6e3M6NzoiZGVmYXVsdCI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7czozMjoiMDgyNTk5MjAzYTkxZjZmYzFlMDhjNmIyMzk0MjYxYTUiO086MzI6Ikdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtIjo5OntzOjU6InJvd0lkIjtzOjMyOiIwODI1OTkyMDNhOTFmNmZjMWUwOGM2YjIzOTQyNjFhNSI7czoyOiJpZCI7aToyO3M6MzoicXR5IjtpOjE7czo0OiJuYW1lIjtzOjMwOiJQb21wZXMgPyBhaXIsID8gbWFpbiBvdSA/IHBpZWQiO3M6NToicHJpY2UiO2Q6MjAwMDA7czo3OiJvcHRpb25zIjtPOjM5OiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbU9wdGlvbnMiOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7czo4OiJlbWJhbGFnZSI7aTo1MDtzOjc6InRheFJhdGUiO2Q6MTg7fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9czo0OToiAEdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtAGFzc29jaWF0ZWRNb2RlbCI7czoxODoiQXBwXE1vZGVsc1xQcm9kdWN0IjtzOjQxOiIAR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AdGF4UmF0ZSI7ZDoxODtzOjQxOiIAR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AaXNTYXZlZCI7YjowO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319fQ==',1785142201);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) NOT NULL,
  `instance` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identifier`,`instance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shoppingcart`
--

LOCK TABLES `shoppingcart` WRITE;
/*!40000 ALTER TABLE `shoppingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoppingcart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_controls`
--

DROP TABLE IF EXISTS `stock_controls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_controls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `old_quantity` double(64,2) NOT NULL DEFAULT 0.00,
  `new_quantity` double(64,2) NOT NULL DEFAULT 0.00,
  `sold_quantity` double(64,2) NOT NULL DEFAULT 0.00,
  `price` double(64,2) NOT NULL DEFAULT 0.00,
  `total` double(64,2) NOT NULL DEFAULT 0.00,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_controls_product_id_foreign` (`product_id`),
  KEY `stock_controls_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_controls`
--

LOCK TABLES `stock_controls` WRITE;
/*!40000 ALTER TABLE `stock_controls` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_controls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocker_users`
--

DROP TABLE IF EXISTS `stocker_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocker_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `stock_id` bigint(20) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocker_users`
--

LOCK TABLES `stocker_users` WRITE;
/*!40000 ALTER TABLE `stocker_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocker_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockes`
--

DROP TABLE IF EXISTS `stockes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stockes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockes`
--

LOCK TABLES `stockes` WRITE;
/*!40000 ALTER TABLE `stockes` DISABLE KEYS */;
INSERT INTO `stockes` VALUES (1,'STOCK\r\n',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `stockes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_user`
--

DROP TABLE IF EXISTS `team_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_user`
--

LOCK TABLES `team_user` WRITE;
/*!40000 ALTER TABLE `team_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_files`
--

DROP TABLE IF EXISTS `transaction_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `transaction_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_files_user_id_foreign` (`user_id`),
  KEY `transaction_files_transaction_id_foreign` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_files`
--

LOCK TABLES `transaction_files` WRITE;
/*!40000 ALTER TABLE `transaction_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_types`
--

DROP TABLE IF EXISTS `transaction_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_types_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_types`
--

LOCK TABLES `transaction_types` WRITE;
/*!40000 ALTER TABLE `transaction_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `member_id` bigint(20) unsigned NOT NULL,
  `transaction_type_id` bigint(20) unsigned NOT NULL,
  `montant` double(64,4) NOT NULL,
  `description` text DEFAULT NULL,
  `date_transaction` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_member_id_foreign` (`member_id`),
  KEY `transactions_transaction_type_id_foreign` (`transaction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_embalages`
--

DROP TABLE IF EXISTS `type_embalages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_embalages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_embalages`
--

LOCK TABLES `type_embalages` WRITE;
/*!40000 ALTER TABLE `type_embalages` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_embalages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'JEAN LIONEL','nijeanlionel@gmail.com','2025-12-05 13:05:33','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'SjNMvwM1UrVGwr9p5OeGTEVlk1zzjuWT8sYlGKPdnpFBLZZydv6g9QB8rjPX',NULL,NULL,'2025-12-05 13:05:33','2025-12-05 13:05:33',NULL),(2,'Admin','admin@gmail.com',NULL,'$2y$10$S1cl1LavjETELLAsEAko1eMsG.zgF0a1DDMtHOlX/oecwsO9eUjny',NULL,NULL,NULL,NULL,NULL,'2025-12-05 13:20:15','2025-12-05 13:20:15',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versement_types`
--

DROP TABLE IF EXISTS `versement_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versement_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versement_types`
--

LOCK TABLES `versement_types` WRITE;
/*!40000 ALTER TABLE `versement_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `versement_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versements`
--

DROP TABLE IF EXISTS `versements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `versements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `description` text DEFAULT NULL,
  `montant` double NOT NULL,
  `versement_type_id` bigint(20) unsigned DEFAULT NULL,
  `date_transaction` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `versements_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versements`
--

LOCK TABLES `versements` WRITE;
/*!40000 ALTER TABLE `versements` DISABLE KEYS */;
/*!40000 ALTER TABLE `versements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-27 10:50:12
