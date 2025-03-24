-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: advanced_facturation_dev
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banques`
--

DROP TABLE IF EXISTS `banques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canceled_invoinces`
--

LOCK TABLES `canceled_invoinces` WRITE;
/*!40000 ALTER TABLE `canceled_invoinces` DISABLE KEYS */;
INSERT INTO `canceled_invoinces` VALUES (1,2,'4002484527/ws400243831700502/20250320103618/000002','EROR DE PRIX','1','2025-03-20 08:46:15','2025-03-20 08:46:18',NULL);
/*!40000 ALTER TABLE `canceled_invoinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'PRODUITS',NULL,2,'2025-03-20 08:05:31','2025-03-20 08:05:31',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_histories`
--

DROP TABLE IF EXISTS `client_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'SAVONOR','22255636','CHANIQUE',NULL,'PERSONNE PHYSIQUE',NULL,NULL,NULL,NULL,'0','1',NULL,'2025-03-20 08:18:15','2025-03-20 08:18:15',NULL),(2,'IMENA','66852741','KAYANZA',NULL,'PERSONNE PHYSIQUE',NULL,NULL,NULL,NULL,'0','1',NULL,'2025-03-20 08:33:34','2025-03-20 08:33:34',NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande_details`
--

DROP TABLE IF EXISTS `commande_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depenses`
--

LOCK TABLES `depenses` WRITE;
/*!40000 ALTER TABLE `depenses` DISABLE KEYS */;
INSERT INTO `depenses` VALUES (1,'PIPE',500.00,NULL,1,'2025-03-20 08:47:56','2025-03-20 08:47:56',NULL);
/*!40000 ALTER TABLE `depenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_orders`
--

DROP TABLE IF EXISTS `detail_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_orders`
--

LOCK TABLES `detail_orders` WRITE;
/*!40000 ALTER TABLE `detail_orders` DISABLE KEYS */;
INSERT INTO `detail_orders` VALUES (1,1,10.00,2.00,150.00,NULL,'01','pet bottles','Piece','2025-03-20',1,1,'2025-03-20 08:21:11','2025-03-20 08:21:11',NULL),(2,2,120.00,272.00,120.00,NULL,'001','bouteille','piece','2025-03-20',2,1,'2025-03-20 08:36:29','2025-03-20 08:36:29',NULL);
/*!40000 ALTER TABLE `detail_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_paiment_dettes`
--

DROP TABLE IF EXISTS `detail_paiment_dettes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `entreprise_histories`
--

DROP TABLE IF EXISTS `entreprise_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprises`
--

LOCK TABLES `entreprises` WRITE;
/*!40000 ALTER TABLE `entreprises` DISABLE KEYS */;
INSERT INTO `entreprises` VALUES (1,'NDORI V PLUS HOLDING LIMITED','2','4002484527','0052842/23','000','+257 79563004','BUBANZA','BURINGA','BURINGA','GIHANGA','14','0','1','0','0','DMC','FABRICATION DE PRODUITS EN CAOUTCHOUC ET PLASIQUE','SURL','2','1',1,'2025-01-28 11:46:36','2025-02-06 08:45:46',NULL);
/*!40000 ALTER TABLE `entreprises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_products`
--

LOCK TABLES `follow_products` WRITE;
/*!40000 ALTER TABLE `follow_products` DISABLE KEYS */;
INSERT INTO `follow_products` VALUES (1,'EN','200','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":200,\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":\"100\",\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:09:16.000000Z\",\"deleted_at\":null,\"category\":{\"id\":4,\"title\":\"PRODUITS\",\"description\":null,\"stock_id\":2,\"created_at\":\"2025-03-20T08:05:31.000000Z\",\"updated_at\":\"2025-03-20T08:05:31.000000Z\",\"deleted_at\":null,\"stock\":{\"id\":2,\"name\":\"STOCK PRINCIPAL\",\"description\":\"STOCK PRINCIPAL DE BASE\",\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-01-28T11:46:36.000000Z\",\"deleted_at\":null}}}',2,1,'2025-03-20 08:11:16','2025-03-20 08:11:16',NULL),(2,'EN','200','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":400,\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":\"100\",\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:11:16.000000Z\",\"deleted_at\":null,\"category\":{\"id\":4,\"title\":\"PRODUITS\",\"description\":null,\"stock_id\":2,\"created_at\":\"2025-03-20T08:05:31.000000Z\",\"updated_at\":\"2025-03-20T08:05:31.000000Z\",\"deleted_at\":null,\"stock\":{\"id\":2,\"name\":\"STOCK PRINCIPAL\",\"description\":\"STOCK PRINCIPAL DE BASE\",\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-01-28T11:46:36.000000Z\",\"deleted_at\":null}}}',2,1,'2025-03-20 08:11:29','2025-03-20 08:11:29',NULL),(3,'EI','2','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":\"2\",\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":\"100\",\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:11:29.000000Z\",\"deleted_at\":null}',2,1,'2025-03-20 08:13:50','2025-03-20 08:13:50',NULL),(4,'EAJ','500','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":502,\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":\"100\",\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:13:50.000000Z\",\"deleted_at\":null,\"category\":{\"id\":4,\"title\":\"PRODUITS\",\"description\":null,\"stock_id\":2,\"created_at\":\"2025-03-20T08:05:31.000000Z\",\"updated_at\":\"2025-03-20T08:05:31.000000Z\",\"deleted_at\":null,\"stock\":{\"id\":2,\"name\":\"STOCK PRINCIPAL\",\"description\":\"STOCK PRINCIPAL DE BASE\",\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-01-28T11:46:36.000000Z\",\"deleted_at\":null}}}',2,1,'2025-03-20 08:14:33','2025-03-20 08:14:33',NULL),(5,'SV','10','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":492,\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":100,\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:14:33.000000Z\",\"deleted_at\":null,\"product_details\":[{\"id\":1,\"user_id\":1,\"stock_id\":2,\"product_id\":2,\"prix_revient\":100,\"quantite\":200,\"quantite_restant\":190,\"description\":\"NEW PRODUCT\",\"created_at\":\"2025-03-20T08:10:58.000000Z\",\"updated_at\":\"2025-03-20T08:17:02.000000Z\",\"deleted_at\":null},{\"id\":2,\"user_id\":1,\"stock_id\":2,\"product_id\":2,\"prix_revient\":100,\"quantite\":200,\"quantite_restant\":200,\"description\":\"NEW PRODUCT\",\"created_at\":\"2025-03-20T08:11:17.000000Z\",\"updated_at\":\"2025-03-20T08:11:17.000000Z\",\"deleted_at\":null},{\"id\":3,\"user_id\":1,\"stock_id\":2,\"product_id\":2,\"prix_revient\":100,\"quantite\":500,\"quantite_restant\":500,\"description\":\"NEW PRODUCT\",\"created_at\":\"2025-03-20T08:14:33.000000Z\",\"updated_at\":\"2025-03-20T08:14:33.000000Z\",\"deleted_at\":null}]}',2,1,'2025-03-20 08:17:02','2025-03-20 08:17:02',NULL),(6,'EN','12','{\"id\":1,\"code_product\":\"01\",\"name\":\"pet bottles\",\"marque\":\"NA\",\"unite_mesure\":\"Piece\",\"quantite\":12,\"quantite_alert\":3,\"price\":150,\"price_ttc\":0,\"price_max\":\"100\",\"price_tvac\":177,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2025-03-20T08:04:47.000000Z\",\"updated_at\":\"2025-03-20T08:04:47.000000Z\",\"deleted_at\":null,\"category\":null}',1,1,'2025-03-20 08:19:41','2025-03-20 08:19:41',NULL),(7,'VENTE','10','{\"id\":1,\"code_product\":\"01\",\"name\":\"pet bottles\",\"marque\":\"NA\",\"unite_mesure\":\"Piece\",\"quantite\":2,\"quantite_alert\":3,\"price\":150,\"price_ttc\":0,\"price_max\":100,\"price_tvac\":177,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":2,\"created_at\":\"2025-03-20T08:04:47.000000Z\",\"updated_at\":\"2025-03-20T08:20:50.000000Z\",\"deleted_at\":null}',1,1,'2025-03-20 08:21:11','2025-03-20 08:21:11',NULL),(8,'EN','50000','{\"id\":3,\"code_product\":\"002\",\"name\":\"PREFORM\",\"marque\":\"NA\",\"unite_mesure\":\"Piece\",\"quantite\":50000,\"quantite_alert\":2500,\"price\":290,\"price_ttc\":0,\"price_max\":\"230\",\"price_tvac\":342.2,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":230,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:23:40.000000Z\",\"updated_at\":\"2025-03-20T08:23:40.000000Z\",\"deleted_at\":null,\"category\":{\"id\":4,\"title\":\"PRODUITS\",\"description\":null,\"stock_id\":2,\"created_at\":\"2025-03-20T08:05:31.000000Z\",\"updated_at\":\"2025-03-20T08:05:31.000000Z\",\"deleted_at\":null,\"stock\":{\"id\":2,\"name\":\"STOCK PRINCIPAL\",\"description\":\"STOCK PRINCIPAL DE BASE\",\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-01-28T11:46:36.000000Z\",\"deleted_at\":null}}}',3,1,'2025-03-20 08:24:53','2025-03-20 08:24:53',NULL),(9,'VENTE','120','{\"id\":2,\"code_product\":\"001\",\"name\":\"bouteille\",\"marque\":\"NA\",\"unite_mesure\":\"piece\",\"quantite\":272,\"quantite_alert\":20,\"price\":120,\"price_ttc\":0,\"price_max\":100,\"price_tvac\":141.6,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":100,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:09:16.000000Z\",\"updated_at\":\"2025-03-20T08:36:18.000000Z\",\"deleted_at\":null}',2,1,'2025-03-20 08:36:29','2025-03-20 08:36:29',NULL);
/*!40000 ALTER TABLE `follow_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hr_chambres`
--

DROP TABLE IF EXISTS `hr_chambres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maison_locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `montant` double NOT NULL DEFAULT 0,
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  KEY `members_user_id_foreign` (`user_id`),
  CONSTRAINT `members_organisation_id_foreign` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`),
  CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  `item_product_detail_id` varchar(255) DEFAULT NULL,
  `is_send_to_obr` varchar(255) DEFAULT NULL,
  `is_sent_at` datetime DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_mouvement_stocks`
--

LOCK TABLES `obr_mouvement_stocks` WRITE;
/*!40000 ALTER TABLE `obr_mouvement_stocks` DISABLE KEYS */;
INSERT INTO `obr_mouvement_stocks` VALUES (1,'ws400243831700502','2','bouteille',200,'piece',100,'BIF','EN',NULL,NULL,'2025-03-20 10:10:58',NULL,'1','2025-03-20 10:45:44',1,'2025-03-20 08:10:58','2025-03-20 08:45:44',NULL),(2,'ws400243831700502','2','bouteille',200,'piece',100,'BIF','EN',NULL,NULL,'2025-03-20 10:11:17',NULL,'1','2025-03-20 10:45:47',1,'2025-03-20 08:11:17','2025-03-20 08:45:47',NULL),(3,'ws400243831700502','2','bouteille',2,'piece',100,'BIF','EI',NULL,NULL,'2025-03-20 10:13:50',NULL,'1','2025-03-20 10:45:49',1,'2025-03-20 08:13:50','2025-03-20 08:45:49',NULL),(4,'ws400243831700502','2','bouteille',500,'piece',100,'BIF','EAJ',NULL,NULL,'2025-03-20 10:14:33',NULL,'1','2025-03-20 10:45:52',1,'2025-03-20 08:14:33','2025-03-20 08:45:52',NULL),(5,'ws400243831700502','2','bouteille',10,'piece',100,'BIF','SV',NULL,'vol de 10 piece','2025-03-20 10:17:02','1','1','2025-03-20 10:45:55',1,'2025-03-20 08:17:02','2025-03-20 08:45:55',NULL),(6,'ws400243831700502','1','pet bottles',12,'Piece',100,'BIF','EN',NULL,NULL,'2025-03-20 10:19:29',NULL,'1','2025-03-20 10:45:58',1,'2025-03-20 08:19:29','2025-03-20 08:45:58',NULL),(7,'ws400243831700502','1','pet bottles',10,'Piece',100,'BIF','SN','1',NULL,'2025-03-20 10:20:50','4','1','2025-03-20 10:46:00',1,'2025-03-20 08:20:50','2025-03-20 08:46:00',NULL),(8,'ws400243831700502','3','PREFORM',50000,'Piece',230,'BIF','EN',NULL,NULL,'2025-03-20 10:24:32',NULL,'1','2025-03-20 10:46:03',1,'2025-03-20 08:24:32','2025-03-20 08:46:03',NULL),(9,'ws400243831700502','2','bouteille',120,'piece',100,'BIF','SN','2',NULL,'2025-03-20 10:36:18','1','1','2025-03-20 10:46:06',1,'2025-03-20 08:36:18','2025-03-20 08:46:06',NULL),(10,'ws400243831700502','2','bouteille',120,'piece',100,'BIF','ER','2','EROR DE PRIX','2025-03-20 10:46:12','1','1','2025-03-20 10:46:15',1,'2025-03-20 08:46:12','2025-03-20 08:46:15',NULL);
/*!40000 ALTER TABLE `obr_mouvement_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_pointers`
--

DROP TABLE IF EXISTS `obr_pointers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_pointers`
--

LOCK TABLES `obr_pointers` WRITE;
/*!40000 ALTER TABLE `obr_pointers` DISABLE KEYS */;
INSERT INTO `obr_pointers` VALUES (1,1,'4002484527/ws400243831700502/20250320102050/000001','0',NULL,'','Une facture avec le même numéro existe déjà.','','2025-03-20 08:46:08','2025-03-20 08:46:08',NULL),(2,1,'4002484527/ws400243831700502/20250320102050/000001','1',NULL,NULL,NULL,NULL,'2025-03-20 08:46:08','2025-03-20 08:46:08',NULL),(3,2,'4002484527/ws400243831700502/20250320103618/000002','0',NULL,'','Une facture avec le même numéro existe déjà.','','2025-03-20 08:46:11','2025-03-20 08:46:11',NULL),(4,2,'4002484527/ws400243831700502/20250320103618/000002','1',NULL,NULL,NULL,NULL,'2025-03-20 08:46:12','2025-03-20 08:46:12',NULL),(5,2,'4002484527/ws400243831700502/20250320103618/000002','0',NULL,'4002484527/ws400243831700502/20250320103618/000002','Identifiant de la facture inconnu','X','2025-03-20 08:46:18','2025-03-20 08:46:18',NULL);
/*!40000 ALTER TABLE `obr_pointers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_request_bodies`
--

DROP TABLE IF EXISTS `obr_request_bodies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obr_request_bodies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `request_body` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_request_bodies`
--

LOCK TABLES `obr_request_bodies` WRITE;
/*!40000 ALTER TABLE `obr_request_bodies` DISABLE KEYS */;
INSERT INTO `obr_request_bodies` VALUES (1,1,'{\"invoice_id\":1,\"invoice_number\":\"000001\",\"invoice_date\":\"2025-03-20 10:20:50\",\"tp_type\":\"2\",\"tp_name\":\"NDORI V PLUS HOLDING LIMITED\",\"tp_TIN\":\"4002484527\",\"tp_trade_number\":\"0052842\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79563004\",\"tp_address_commune\":\"GIHANGA\",\"tp_address_quartier\":\"BURINGA\",\"tp_address_avenue\":\"BURINGA\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"FABRICATION DE PRODUITS EN CAOUTCHOUC ET PLASIQUE\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"SAVONOR\",\"customer_TIN\":\"\",\"customer_address\":\"CHANIQUE\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002484527\\/ws400243831700502\\/20250320102050\\/000001\",\"invoice_identifier\":\"4002484527\\/ws400243831700502\\/20250320102050\\/000001\",\"invoice_signature_date\":\"2025-03-20 10:20:50\",\"invoice_items\":[{\"item_designation\":\"pet bottles\",\"item_quantity\":10,\"item_price\":150,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":1500,\"vat\":270,\"item_price_wvat\":1770,\"item_total_amount\":1770,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2025-03-20 08:46:07','2025-03-20 08:46:07',NULL),(2,2,'{\"invoice_id\":2,\"invoice_number\":\"000002\",\"invoice_date\":\"2025-03-20 10:36:18\",\"tp_type\":\"2\",\"tp_name\":\"NDORI V PLUS HOLDING LIMITED\",\"tp_TIN\":\"4002484527\",\"tp_trade_number\":\"0052842\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79563004\",\"tp_address_commune\":\"GIHANGA\",\"tp_address_quartier\":\"BURINGA\",\"tp_address_avenue\":\"BURINGA\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"FABRICATION DE PRODUITS EN CAOUTCHOUC ET PLASIQUE\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"IMENA\",\"customer_TIN\":\"\",\"customer_address\":\"KAYANZA\",\"vat_customer_payer\":\"0\",\"invoice_type\":\"FN\",\"cancelled_invoice_ref\":\"\",\"invoice_ref\":\"\",\"invoice_signature\":\"4002484527\\/ws400243831700502\\/20250320103618\\/000002\",\"invoice_identifier\":\"4002484527\\/ws400243831700502\\/20250320103618\\/000002\",\"invoice_signature_date\":\"2025-03-20 10:36:18\",\"invoice_items\":[{\"item_designation\":\"bouteille\",\"item_quantity\":120,\"item_price\":120,\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":14400,\"vat\":2592,\"item_price_wvat\":16992,\"item_total_amount\":16992,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2025-03-20 08:46:10','2025-03-20 08:46:10',NULL),(3,2,'{\"invoice_identifier\":\"4002484527\\/ws400243831700502\\/20250320103618\\/000002\",\"cn_motif\":\"EROR DE PRIX\"}','2025-03-20 08:46:16','2025-03-20 08:46:16',NULL);
/*!40000 ALTER TABLE `obr_request_bodies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obr_stock_logs`
--

DROP TABLE IF EXISTS `obr_stock_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_stock_logs`
--

LOCK TABLES `obr_stock_logs` WRITE;
/*!40000 ALTER TABLE `obr_stock_logs` DISABLE KEYS */;
INSERT INTO `obr_stock_logs` VALUES (1,'1','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:44','2025-03-20 08:45:44',NULL),(2,'2','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:47','2025-03-20 08:45:47',NULL),(3,'3','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:49','2025-03-20 08:45:49',NULL),(4,'4','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:52','2025-03-20 08:45:52',NULL),(5,'5','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:55','2025-03-20 08:45:55',NULL),(6,'6','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:45:58','2025-03-20 08:45:58',NULL),(7,'7','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:46:00','2025-03-20 08:46:00',NULL),(8,'8','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:46:03','2025-03-20 08:46:03',NULL),(9,'9','1','L\'opération s\'est effectué avec succès! ','[]','2025-03-20 08:46:06','2025-03-20 08:46:06',NULL);
/*!40000 ALTER TABLE `obr_stock_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_interets`
--

DROP TABLE IF EXISTS `order_interets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `envoye_obr` varchar(255) DEFAULT NULL,
  `envoye_par` varchar(255) DEFAULT NULL,
  `envoye_time` varchar(255) DEFAULT NULL,
  `invoice_signature` varchar(255) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `update_info` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1770.00,270.00,10.00,0.20,1500.00,'3',NULL,NULL,'FN','a:1:{i:0;a:17:{s:2:\"id\";i:1;s:4:\"name\";s:11:\"pet bottles\";s:5:\"rowId\";s:32:\"7f0789cf01c4de0607a423535fcd9c7d\";s:5:\"price\";d:150;s:12:\"unite_mesure\";s:5:\"Piece\";s:13:\"price_revient\";d:100;s:8:\"quantite\";d:10;s:10:\"nombre_sac\";d:0.2;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:1500;s:16:\"interet_unitaire\";d:50;s:13:\"interet_total\";d:500;s:3:\"vat\";d:270;s:15:\"item_price_wvat\";d:1770;s:17:\"item_total_amount\";d:1770;}}','{\"id\":1,\"tp_name\":\"NDORI V PLUS HOLDING LIMITED\",\"tp_type\":\"2\",\"tp_TIN\":\"4002484527\",\"tp_trade_number\":\"0052842\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79563004\",\"tp_address_privonce\":\"BUBANZA\",\"tp_address_avenue\":\"BURINGA\",\"tp_address_quartier\":\"BURINGA\",\"tp_address_commune\":\"GIHANGA\",\"tp_address_rue\":\"14\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"FABRICATION DE PRODUITS EN CAOUTCHOUC ET PLASIQUE\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-02-06T08:45:46.000000Z\",\"deleted_at\":null}','{\"id\":1,\"name\":\"SAVONOR\",\"telephone\":\"22255636\",\"addresse\":\"CHANIQUE\",\"description\":null,\"client_type\":\"PERSONNE PHYSIQUE\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":null,\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2025-03-20T08:18:15.000000Z\",\"updated_at\":\"2025-03-20T08:18:15.000000Z\",\"deleted_at\":null}',NULL,'CHANIQUE',1,1,NULL,NULL,0,'2025-03-20 08:20:50','1','2025-03-20 08:46:08',NULL,'1','1','2025-03-20 10:46:08','4002484527/ws400243831700502/20250320102050/000001','2025-03-20',NULL),(2,16992.00,2592.00,120.00,2.40,14400.00,'2',NULL,NULL,'FN','a:1:{i:0;a:17:{s:2:\"id\";i:2;s:4:\"name\";s:9:\"bouteille\";s:5:\"rowId\";s:32:\"082599203a91f6fc1e08c6b2394261a5\";s:5:\"price\";d:120;s:12:\"unite_mesure\";s:5:\"piece\";s:13:\"price_revient\";d:100;s:8:\"quantite\";d:120;s:10:\"nombre_sac\";d:2.4;s:8:\"embalage\";i:50;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";d:14400;s:16:\"interet_unitaire\";d:20;s:13:\"interet_total\";d:2400;s:3:\"vat\";d:2592;s:15:\"item_price_wvat\";d:16992;s:17:\"item_total_amount\";d:16992;}}','{\"id\":1,\"tp_name\":\"NDORI V PLUS HOLDING LIMITED\",\"tp_type\":\"2\",\"tp_TIN\":\"4002484527\",\"tp_trade_number\":\"0052842\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79563004\",\"tp_address_privonce\":\"BUBANZA\",\"tp_address_avenue\":\"BURINGA\",\"tp_address_quartier\":\"BURINGA\",\"tp_address_commune\":\"GIHANGA\",\"tp_address_rue\":\"14\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"FABRICATION DE PRODUITS EN CAOUTCHOUC ET PLASIQUE\",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2025-01-28T11:46:36.000000Z\",\"updated_at\":\"2025-02-06T08:45:46.000000Z\",\"deleted_at\":null}','{\"id\":2,\"name\":\"IMENA\",\"telephone\":\"66852741\",\"addresse\":\"KAYANZA\",\"description\":null,\"client_type\":\"PERSONNE PHYSIQUE\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":null,\"vat_customer_payer\":\"0\",\"user_id\":\"1\",\"commissionnaire_id\":null,\"created_at\":\"2025-03-20T08:33:34.000000Z\",\"updated_at\":\"2025-03-20T08:33:34.000000Z\",\"deleted_at\":null}',NULL,'KAYANZA',1,2,NULL,NULL,1,'2025-03-20 08:36:18',NULL,'2025-03-20 08:46:18',NULL,'1','1','2025-03-20 10:46:11','4002484527/ws400243831700502/20250320103618/000002','2025-03-20',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation_members`
--

DROP TABLE IF EXISTS `organisation_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisation_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organisation_id` bigint(20) unsigned NOT NULL,
  `member_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `organisation_members_organisation_id_foreign` (`organisation_id`),
  KEY `organisation_members_member_id_foreign` (`member_id`),
  CONSTRAINT `organisation_members_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `organisation_members_organisation_id_foreign` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organisations_user_id_foreign` (`user_id`),
  CONSTRAINT `organisations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periode_paiment_locations`
--

LOCK TABLES `periode_paiment_locations` WRITE;
/*!40000 ALTER TABLE `periode_paiment_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `periode_paiment_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
INSERT INTO `product_details` VALUES (1,1,2,2,100,200,190,'NEW PRODUCT','2025-03-20 08:10:58','2025-03-20 08:46:12',NULL),(2,1,2,2,100,200,200,'NEW PRODUCT','2025-03-20 08:11:17','2025-03-20 08:11:17',NULL),(3,1,2,2,100,500,500,'NEW PRODUCT','2025-03-20 08:14:33','2025-03-20 08:14:33',NULL),(4,1,1,1,100,12,2,'NEW PRODUCT','2025-03-20 08:19:29','2025-03-20 08:20:50',NULL),(5,1,2,3,230,50000,50000,'NEW PRODUCT','2025-03-20 08:24:32','2025-03-20 08:24:32',NULL);
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_histories`
--

DROP TABLE IF EXISTS `product_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `content` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_histories`
--

LOCK TABLES `product_histories` WRITE;
/*!40000 ALTER TABLE `product_histories` DISABLE KEYS */;
INSERT INTO `product_histories` VALUES (1,3,'{\"id\":3,\"code_product\":\"002\",\"name\":\"PREFORM\",\"marque\":\"NA\",\"unite_mesure\":\"Piece\",\"quantite\":50000,\"quantite_alert\":2500,\"price\":290,\"price_ttc\":0,\"price_max\":230,\"price_tvac\":342.2,\"taux_tva\":18,\"item_ott_tax\":0,\"item_tsce_tax\":0,\"price_min\":230,\"date_expiration\":\"2025-03-20\",\"description\":null,\"user_id\":1,\"category_id\":4,\"created_at\":\"2025-03-20T08:23:40.000000Z\",\"updated_at\":\"2025-03-20T08:24:53.000000Z\",\"deleted_at\":null}',1,'2025-03-20 08:28:28','2025-03-20 08:28:28',NULL);
/*!40000 ALTER TABLE `product_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_stocks`
--

DROP TABLE IF EXISTS `product_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'01','pet bottles','NA','Piece',2.00,3.00,150.00,0.00,100.00,177.00,18.00,0.00,0.00,100.00,'2025-03-20',NULL,1,2,'2025-03-20 08:04:47','2025-03-20 08:20:50',NULL),(2,'001','bouteille','NA','piece',392.00,20.00,120.00,0.00,100.00,141.60,18.00,0.00,0.00,100.00,'2025-03-20',NULL,1,4,'2025-03-20 08:09:16','2025-03-20 08:46:12',NULL),(3,'002','PREFORM','NA','Piece',50000.00,2500.00,290.00,0.00,230.00,342.20,18.00,0.00,0.00,230.00,'2025-03-20',NULL,1,4,'2025-03-20 08:23:40','2025-03-20 08:24:53',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proformats`
--

DROP TABLE IF EXISTS `proformats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retour_produits`
--

LOCK TABLES `retour_produits` WRITE;
/*!40000 ALTER TABLE `retour_produits` DISABLE KEYS */;
INSERT INTO `retour_produits` VALUES (1,2,'bouteille',2,120,'EROR DE PRIX',1,'2025-03-20 08:46:12','2025-03-20 08:46:12',NULL);
/*!40000 ALTER TABLE `retour_produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(2,2,1,NULL,NULL,NULL),(3,3,1,NULL,NULL,NULL),(4,4,1,NULL,NULL,NULL),(5,5,1,NULL,NULL,NULL),(6,1,2,NULL,NULL,NULL),(7,2,2,NULL,NULL,NULL),(8,3,2,NULL,NULL,NULL),(9,4,2,NULL,NULL,NULL),(10,5,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMINISTRATEUR','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(2,'CONTROLLEUR','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(3,'COMPTABLE','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(4,'VENTE','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(5,'ENTRE DES PRODUITS EN STOCK','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `sessions` VALUES ('GCsSptDD0zYe3fOr2M6EAoeFnZWHrkJcrPguEfOU',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiTkRFMW95VXJGT0I0UUhpTW9iQWpRN1hzUmptTWl2SGtISkl0Ynl1QiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmFwcG9ydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ5MklYVU5wa2pPMHJPUTVieU1pLlllNG9Lb0VhM1JvOWxsQy8ub2cvYXQyLnVoZVdHL2lnaSI7czoxNzoiY2FuY2VsX3N5bmNyb25pemUiO2I6MDtzOjQ6ImNhcnQiO2E6MDp7fX0=',1742460385),('Iw5MZ1hRc9sRov2KQFRSsRMql82CdG3MeIZkQYyf',1,'192.168.215.114','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoiRGJ1eWRxRFo5VDdteHVNSzJxVDBhZExLazJrQlRrYXQ0RTBUT0ZBUSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQzOiJodHRwOi8vMTkyLjE2OC4yMTUuMjMwOjgwMDAvYmFja3VwX2RhdGFiYXNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJDkySVhVTnBrak8wck9RNWJ5TWkuWWU0b0tvRWEzUm85bGxDLy5vZy9hdDIudWhlV0cvaWdpIjtzOjE3OiJjYW5jZWxfc3luY3Jvbml6ZSI7YjowO3M6NDoiY2FydCI7YTowOnt9fQ==',1742460809);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shoppingcart`
--

DROP TABLE IF EXISTS `shoppingcart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
-- Table structure for table `stocker_users`
--

DROP TABLE IF EXISTS `stocker_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockes`
--

LOCK TABLES `stockes` WRITE;
/*!40000 ALTER TABLE `stockes` DISABLE KEYS */;
INSERT INTO `stockes` VALUES (1,'Janelle','Beatae eos et atque molestias excepturi nesciunt inventore. Quod a ut quia eius temporibus in itaque consequatur. Incidunt aut et similique perspiciatis.','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(2,'STOCK PRINCIPAL','STOCK PRINCIPAL DE BASE','2025-01-28 11:46:36','2025-01-28 11:46:36',NULL);
/*!40000 ALTER TABLE `stockes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_members_user_id_foreign` (`user_id`),
  CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_user`
--

DROP TABLE IF EXISTS `team_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = utf8 */;
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
  KEY `transaction_files_transaction_id_foreign` (`transaction_id`),
  CONSTRAINT `transaction_files_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  CONSTRAINT `transaction_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_types_user_id_foreign` (`user_id`),
  CONSTRAINT `transaction_types_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `member_id` bigint(20) unsigned NOT NULL,
  `transaction_type_id` bigint(20) unsigned NOT NULL,
  `montant` double(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `date_transaction` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_member_id_foreign` (`member_id`),
  KEY `transactions_transaction_type_id_foreign` (`transaction_type_id`),
  CONSTRAINT `transactions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `transactions_transaction_type_id_foreign` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_types` (`id`),
  CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
INSERT INTO `users` VALUES (1,'JEAN LIONEL','nijeanlionel@gmail.com','2025-01-28 11:46:36','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'r4ZxLsVvewnAjrabTGNgs8b3xF6a5PZfWJd0oSPCYdpGTaC4UDsrsc2YHxEP',NULL,NULL,'2025-01-28 11:46:36','2025-01-28 11:46:36',NULL),(2,'Poissonnerie Nouvelle','poissonnerienouvelle@gmail.com',NULL,'$2y$10$GQvmp4utOL9UfQqrGRkol.S7bIZYimSs12apOUfozORMKi5ZGG9t2',NULL,NULL,NULL,NULL,NULL,'2025-02-03 15:23:43','2025-02-03 15:23:43',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-20 10:53:50
