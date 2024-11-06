-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: advanced_facturation
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canceled_invoinces`
--

LOCK TABLES `canceled_invoinces` WRITE;
/*!40000 ALTER TABLE `canceled_invoinces` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Stonemason','Consequuntur corporis rem voluptatem. Quos hic magni eos quam. Quas autem eius reprehenderit dicta recusandae. Similique et alias earum ea harum ad.',1,'2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(2,'Fiber Product Cutting Machine Operator','Qui quae in aut doloribus eaque. Nostrum et temporibus rerum dolores error. Reiciendis ut quas et expedita minus. Facilis rem consequuntur sunt.',1,'2024-08-11 03:25:57','2024-08-11 03:25:57',NULL);
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_telephone_unique` (`telephone`),
  UNIQUE KEY `clients_customer_tin_unique` (`customer_TIN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'XXXXXX','4000877565','Gihosha, Bujumbura',NULL,'PERSONNE PHYSIQUE',NULL,NULL,NULL,NULL,'1','1','2024-11-05 12:23:03','2024-11-05 12:23:03',NULL);
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
-- Table structure for table `departements`
--

DROP TABLE IF EXISTS `departements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_departement` varchar(255) NOT NULL,
  `description_departement` longtext DEFAULT NULL,
  `deleted_status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departements`
--

LOCK TABLES `departements` WRITE;
/*!40000 ALTER TABLE `departements` DISABLE KEYS */;
/*!40000 ALTER TABLE `departements` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_orders`
--

LOCK TABLES `detail_orders` WRITE;
/*!40000 ALTER TABLE `detail_orders` DISABLE KEYS */;
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
INSERT INTO `entreprises` VALUES (1,'DOLO PRODUCTION COMPANY LTD','2','4002489104','0053278/23','000','+257 79364090','BUJUMBURA-MAIRIE','MIRANGO II','KAMENGE','NTAHANGWA','14','0','1','0','0','DMC','CONSTRUCTION ','SURL','2','1',1,'2024-08-11 03:25:57','2024-08-11 03:25:57',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow_products`
--

LOCK TABLES `follow_products` WRITE;
/*!40000 ALTER TABLE `follow_products` DISABLE KEYS */;
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
  KEY `hr_fiche_details_commande_id_foreign` (`commande_id`),
  CONSTRAINT `hr_fiche_details_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `hr_commandes` (`id`),
  CONSTRAINT `hr_fiche_details_fiche_id_foreign` FOREIGN KEY (`fiche_id`) REFERENCES `fiches` (`id`),
  CONSTRAINT `hr_fiche_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
-- Table structure for table `hrm_bank`
--

DROP TABLE IF EXISTS `hrm_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `bank_code` varchar(50) DEFAULT NULL,
  `bank_code_transfer` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_bank`
--

LOCK TABLES `hrm_bank` WRITE;
/*!40000 ALTER TABLE `hrm_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_branche`
--

DROP TABLE IF EXISTS `hrm_branche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_branche` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `qualification` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_branche`
--

LOCK TABLES `hrm_branche` WRITE;
/*!40000 ALTER TABLE `hrm_branche` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_branche` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_cotation`
--

DROP TABLE IF EXISTS `hrm_cotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_cotation` (
  `cotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type_cotation` int(11) NOT NULL,
  `note_cotation` text DEFAULT NULL,
  `cotation_status` int(11) DEFAULT 0,
  `confirmation_or_reject_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `rejected_by` int(11) NOT NULL,
  PRIMARY KEY (`cotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_cotation`
--

LOCK TABLES `hrm_cotation` WRITE;
/*!40000 ALTER TABLE `hrm_cotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_cotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_department`
--

DROP TABLE IF EXISTS `hrm_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_department`
--

LOCK TABLES `hrm_department` WRITE;
/*!40000 ALTER TABLE `hrm_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee`
--

DROP TABLE IF EXISTS `hrm_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `maratial_status` varchar(20) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `cni_number` varchar(100) DEFAULT NULL,
  `full_address` text DEFAULT NULL,
  `work_address` varchar(250) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `school_degree` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `leaving_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `code_inss` varchar(50) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:actif,1:inactif',
  `parti_ou_contract_end` int(11) DEFAULT 0 COMMENT '0=existe,1=partie,2=contract fini',
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee`
--

LOCK TABLES `hrm_employee` WRITE;
/*!40000 ALTER TABLE `hrm_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee_bank`
--

DROP TABLE IF EXISTS `hrm_employee_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_bank` (
  `employee_bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_number` varchar(300) NOT NULL,
  `account_money` float DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`employee_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_bank`
--

LOCK TABLES `hrm_employee_bank` WRITE;
/*!40000 ALTER TABLE `hrm_employee_bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee_indeminite`
--

DROP TABLE IF EXISTS `hrm_employee_indeminite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_indeminite` (
  `indeminite_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `type_indeminite_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`indeminite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_indeminite`
--

LOCK TABLES `hrm_employee_indeminite` WRITE;
/*!40000 ALTER TABLE `hrm_employee_indeminite` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee_indeminite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee_payroll`
--

DROP TABLE IF EXISTS `hrm_employee_payroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_payroll` (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `net_salary` decimal(10,0) NOT NULL,
  `brut_salary` float DEFAULT NULL,
  `work_days_per_month` float DEFAULT NULL,
  `work_hours_per_day` int(11) DEFAULT NULL,
  `transport_allowance` varchar(100) DEFAULT NULL,
  `additional_pension` float DEFAULT 0,
  `status` int(11) DEFAULT 1 COMMENT '1 = active; 0 = desactive',
  `payment_type` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_payroll`
--

LOCK TABLES `hrm_employee_payroll` WRITE;
/*!40000 ALTER TABLE `hrm_employee_payroll` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee_payroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee_retenue`
--

DROP TABLE IF EXISTS `hrm_employee_retenue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_retenue` (
  `employee_retenue_id` int(11) NOT NULL AUTO_INCREMENT,
  `retenue_id` varchar(100) NOT NULL,
  `employee_id_in_retenue` int(11) NOT NULL,
  `retenue_amount` int(11) NOT NULL,
  `retenue_month` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`employee_retenue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_retenue`
--

LOCK TABLES `hrm_employee_retenue` WRITE;
/*!40000 ALTER TABLE `hrm_employee_retenue` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee_retenue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_employee_trainer`
--

DROP TABLE IF EXISTS `hrm_employee_trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_employee_trainer` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `maratial_status` varchar(20) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `cni_number` varchar(100) DEFAULT NULL,
  `full_address` text DEFAULT NULL,
  `work_address` varchar(250) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fonction_id` int(11) DEFAULT NULL,
  `school_degree` int(11) DEFAULT NULL,
  `net_salary` text DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `leaving_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `code_inss` varchar(50) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:actif,1:inactif',
  `parti_ou_contract_end` int(11) DEFAULT 0 COMMENT '0=existe,1=partie,2=contract fini',
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_employee_trainer`
--

LOCK TABLES `hrm_employee_trainer` WRITE;
/*!40000 ALTER TABLE `hrm_employee_trainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_employee_trainer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_fonctions`
--

DROP TABLE IF EXISTS `hrm_fonctions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_fonctions` (
  `fonction_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`fonction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_fonctions`
--

LOCK TABLES `hrm_fonctions` WRITE;
/*!40000 ALTER TABLE `hrm_fonctions` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_fonctions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_leave_category`
--

DROP TABLE IF EXISTS `hrm_leave_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_leave_category` (
  `leave_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `color_code` varchar(100) DEFAULT NULL,
  `type_leave_category` int(11) NOT NULL DEFAULT 0 COMMENT '0:unpaid,1:paid',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`leave_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_leave_category`
--

LOCK TABLES `hrm_leave_category` WRITE;
/*!40000 ALTER TABLE `hrm_leave_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_leave_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_loan`
--

DROP TABLE IF EXISTS `hrm_loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `period` int(11) NOT NULL COMMENT 'en mois',
  `loan_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:en attente,1: confirmé,2:en partie paye,3:total paye,4: refuser',
  `slice_amount` float NOT NULL,
  `date_of_demand` varchar(100) NOT NULL,
  `date_of_confirmation` varchar(100) DEFAULT NULL,
  `dead_line_date` varchar(100) NOT NULL,
  `demanded_by` int(11) NOT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_loan`
--

LOCK TABLES `hrm_loan` WRITE;
/*!40000 ALTER TABLE `hrm_loan` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_loan_refund`
--

DROP TABLE IF EXISTS `hrm_loan_refund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_loan_refund` (
  `loan_refund_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `amount_refund` float NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`loan_refund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_loan_refund`
--

LOCK TABLES `hrm_loan_refund` WRITE;
/*!40000 ALTER TABLE `hrm_loan_refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_loan_refund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_paid_leave`
--

DROP TABLE IF EXISTS `hrm_paid_leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_paid_leave` (
  `paid_leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `employee_remplacant` varchar(250) DEFAULT NULL,
  `leave_category_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `period` float DEFAULT NULL,
  `leave_status` int(11) DEFAULT NULL COMMENT '0=pending; 1=confirmed;  2:rejected',
  `request_date` datetime DEFAULT NULL,
  `confirmation_or_reject_date` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `rejected_by` int(11) DEFAULT NULL,
  `confirmation_comment` text DEFAULT NULL,
  `reject_comment` text DEFAULT NULL,
  `read_status` int(11) DEFAULT 0 COMMENT '0=unread; 1=read',
  `notify_status` int(11) DEFAULT 0 COMMENT '0=not notified; 1=already notified',
  PRIMARY KEY (`paid_leave_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_paid_leave`
--

LOCK TABLES `hrm_paid_leave` WRITE;
/*!40000 ALTER TABLE `hrm_paid_leave` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_paid_leave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_retenue_type`
--

DROP TABLE IF EXISTS `hrm_retenue_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_retenue_type` (
  `id_retenue_type` int(11) NOT NULL AUTO_INCREMENT,
  `name_retenue_type` varchar(100) NOT NULL,
  `amount_retenue_type` int(11) NOT NULL DEFAULT 0,
  `createdBy_retenue_type` int(11) NOT NULL,
  `createdAt_retenue_type` datetime NOT NULL,
  `deleteStatus_retenue_type` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_retenue_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_retenue_type`
--

LOCK TABLES `hrm_retenue_type` WRITE;
/*!40000 ALTER TABLE `hrm_retenue_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_retenue_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_salary_payment`
--

DROP TABLE IF EXISTS `hrm_salary_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_salary_payment` (
  `salary_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `basic_salary` decimal(11,0) NOT NULL,
  `gross_salary` decimal(11,0) NOT NULL DEFAULT 0,
  `net_salary` decimal(10,0) NOT NULL,
  `work_days` double NOT NULL DEFAULT 0,
  `regularisation` decimal(10,0) DEFAULT 0,
  `allowance` decimal(11,0) NOT NULL DEFAULT 0,
  `family_allowance` decimal(10,0) NOT NULL DEFAULT 0,
  `deduction` decimal(10,0) NOT NULL DEFAULT 0,
  `advance` decimal(10,0) NOT NULL DEFAULT 0,
  `caisse_sociale` double NOT NULL DEFAULT 0,
  `loan` decimal(10,0) NOT NULL DEFAULT 0,
  `inss` decimal(10,0) NOT NULL,
  `ire` decimal(10,0) NOT NULL,
  `pension_salariale` decimal(11,0) NOT NULL DEFAULT 0,
  `pension_patronale` decimal(11,0) NOT NULL DEFAULT 0,
  `pension_complementaire` decimal(10,0) DEFAULT NULL,
  `mfp_patronal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `mfp_salariale` decimal(10,2) NOT NULL DEFAULT 0.00,
  `risque_prof` decimal(11,0) NOT NULL DEFAULT 0,
  `tax_base` decimal(11,0) NOT NULL DEFAULT 0,
  `month_year` varchar(100) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 0 COMMENT '0:en attente;1:payer',
  `payment_date` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`salary_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_salary_payment`
--

LOCK TABLES `hrm_salary_payment` WRITE;
/*!40000 ALTER TABLE `hrm_salary_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_salary_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_salary_retenue`
--

DROP TABLE IF EXISTS `hrm_salary_retenue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_salary_retenue` (
  `salary_retenue_id` int(11) NOT NULL AUTO_INCREMENT,
  `retenue_type` varchar(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `retenue_month` varchar(200) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`salary_retenue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_salary_retenue`
--

LOCK TABLES `hrm_salary_retenue` WRITE;
/*!40000 ALTER TABLE `hrm_salary_retenue` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_salary_retenue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_settings`
--

DROP TABLE IF EXISTS `hrm_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `content` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_settings`
--

LOCK TABLES `hrm_settings` WRITE;
/*!40000 ALTER TABLE `hrm_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_type_cotation`
--

DROP TABLE IF EXISTS `hrm_type_cotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_type_cotation` (
  `type_cotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `percentage` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`type_cotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_type_cotation`
--

LOCK TABLES `hrm_type_cotation` WRITE;
/*!40000 ALTER TABLE `hrm_type_cotation` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_type_cotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hrm_type_indeminite`
--

DROP TABLE IF EXISTS `hrm_type_indeminite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hrm_type_indeminite` (
  `type_indeminite_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `percentage` float NOT NULL,
  `taxable` int(11) DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`type_indeminite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hrm_type_indeminite`
--

LOCK TABLES `hrm_type_indeminite` WRITE;
/*!40000 ALTER TABLE `hrm_type_indeminite` DISABLE KEYS */;
/*!40000 ALTER TABLE `hrm_type_indeminite` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_mouvement_stocks`
--

LOCK TABLES `obr_mouvement_stocks` WRITE;
/*!40000 ALTER TABLE `obr_mouvement_stocks` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_pointers`
--

LOCK TABLES `obr_pointers` WRITE;
/*!40000 ALTER TABLE `obr_pointers` DISABLE KEYS */;
INSERT INTO `obr_pointers` VALUES (1,1,'4002489104/ws400215013600312/20241105142335/000001','0',NULL,'','Une facture avec le même numéro existe déjà.','','2024-11-05 12:24:34','2024-11-05 12:24:34',NULL),(2,1,'4002489104/ws400215013600312/20241105142335/000001','1',NULL,NULL,NULL,NULL,'2024-11-05 12:24:34','2024-11-05 12:24:34',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_request_bodies`
--

LOCK TABLES `obr_request_bodies` WRITE;
/*!40000 ALTER TABLE `obr_request_bodies` DISABLE KEYS */;
INSERT INTO `obr_request_bodies` VALUES (1,1,'{\"invoice_number\":1,\"invoice_date\":\"2024-11-05 14:23:35\",\"tp_type\":\"2\",\"tp_name\":\"DOLO PRODUCTION COMPANY LTD\",\"tp_TIN\":\"4002489104\",\"tp_trade_number\":\"0053278\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79364090\",\"tp_address_commune\":\"NTAHANGWA\",\"tp_address_quartier\":\"KAMENGE\",\"tp_address_avenue\":\"MIRANGO II\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"CONSTRUCTION \",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"customer_name\":\"XXXXXX\",\"customer_TIN\":\"\",\"customer_address\":\"Gihosha, Bujumbura\",\"vat_customer_payer\":\"1\",\"invoice_type\":\"FN\",\"cancelled_invoice_ref\":\"\",\"invoice_signature\":\"4002489104\\/ws400215013600312\\/20241105142335\\/000001\",\"invoice_identifier\":\"4002489104\\/ws400215013600312\\/20241105142335\\/000001\",\"invoice_signature_date\":\"2024-11-05 14:23:35\",\"invoice_items\":[{\"item_designation\":\"Ifeza hahaahah\",\"item_quantity\":\"1\",\"item_price\":\"10000000\",\"item_ct\":0,\"item_tl\":0,\"item_price_nvat\":10000000,\"vat\":1800000,\"item_price_wvat\":11800000,\"item_total_amount\":11800000,\"item_tsce_tax\":0,\"item_ott_tax\":0}]}','2024-11-05 12:24:34','2024-11-05 12:24:34',NULL);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obr_stock_logs`
--

LOCK TABLES `obr_stock_logs` WRITE;
/*!40000 ALTER TABLE `obr_stock_logs` DISABLE KEYS */;
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
  KEY `order_interets_user_id_foreign` (`user_id`),
  CONSTRAINT `order_interets_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_interets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_interets`
--

LOCK TABLES `order_interets` WRITE;
/*!40000 ALTER TABLE `order_interets` DISABLE KEYS */;
INSERT INTO `order_interets` VALUES (1,1,1,0,'{\"type\":\"VENTE\",\"commissionaire_id\":null,\"client_id\":null,\"partage\":{\"Informaticien\":0,\"Client\":0,\"Commisionnaire\":0,\"Entreprise\":0}}',NULL,'2024-11-05 12:23:35','2024-11-05 12:23:35');
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
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `envoye_obr` varchar(255) DEFAULT NULL,
  `envoye_par` varchar(255) DEFAULT NULL,
  `envoye_time` varchar(255) DEFAULT NULL,
  `invoice_signature` varchar(255) DEFAULT NULL,
  `date_facturation` date DEFAULT NULL,
  `invoice_currency` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,11800000.00,1800000.00,1.00,0.00,10000000.00,'3','FACTURE','a:1:{i:0;a:13:{s:2:\"id\";i:1;s:4:\"name\";s:14:\"Ifeza hahaahah\";s:5:\"rowId\";s:19:\"SERVICE_FACTURATION\";s:5:\"price\";s:8:\"10000000\";s:8:\"quantite\";s:1:\"1\";s:10:\"nombre_sac\";i:0;s:8:\"embalage\";i:0;s:7:\"item_ct\";i:0;s:7:\"item_tl\";i:0;s:15:\"item_price_nvat\";i:10000000;s:3:\"vat\";i:1800000;s:15:\"item_price_wvat\";i:11800000;s:17:\"item_total_amount\";i:11800000;}}','{\"id\":1,\"tp_name\":\"DOLO PRODUCTION COMPANY LTD\",\"tp_type\":\"2\",\"tp_TIN\":\"4002489104\",\"tp_trade_number\":\"0053278\\/23\",\"tp_postal_number\":\"000\",\"tp_phone_number\":\"+257 79364090\",\"tp_address_privonce\":\"BUJUMBURA-MAIRIE\",\"tp_address_avenue\":\"MIRANGO II\",\"tp_address_quartier\":\"KAMENGE\",\"tp_address_commune\":\"NTAHANGWA\",\"tp_address_rue\":\"14\",\"tp_address_number\":\"0\",\"vat_taxpayer\":\"1\",\"ct_taxpayer\":\"0\",\"tl_taxpayer\":\"0\",\"tp_fiscal_center\":\"DMC\",\"tp_activity_sector\":\"CONSTRUCTION \",\"tp_legal_form\":\"SURL\",\"payment_type\":\"2\",\"is_actif\":\"1\",\"user_id\":1,\"created_at\":\"2024-08-11T03:25:57.000000Z\",\"updated_at\":\"2024-08-11T03:25:57.000000Z\",\"deleted_at\":null}','{\"id\":1,\"name\":\"XXXXXX\",\"telephone\":\"4000877565\",\"addresse\":\"Gihosha, Bujumbura\",\"description\":null,\"client_type\":\"PERSONNE PHYSIQUE\",\"is_fournisseur\":null,\"is_commissionaire\":null,\"email\":null,\"customer_TIN\":null,\"vat_customer_payer\":\"1\",\"user_id\":\"1\",\"created_at\":\"2024-11-05T12:23:03.000000Z\",\"updated_at\":\"2024-11-05T12:23:03.000000Z\",\"deleted_at\":null}',NULL,'Gihosha, Bujumbura',1,NULL,NULL,NULL,0,'2024-11-05 12:23:35','2024-11-05 12:24:34',NULL,'1','1','2024-11-05 14:24:34','4002489104/ws400215013600312/20241105142335/000001','2024-11-05','BIF');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
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
  KEY `payment_location_mensuels_maisonlocation_id_foreign` (`maisonlocation_id`),
  CONSTRAINT `payment_location_mensuels_maisonlocation_id_foreign` FOREIGN KEY (`maisonlocation_id`) REFERENCES `maison_locations` (`id`),
  CONSTRAINT `payment_location_mensuels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  KEY `periode_paiment_locations_user_id_foreign` (`user_id`),
  CONSTRAINT `periode_paiment_locations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  KEY `product_details_product_id_foreign` (`product_id`),
  CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_details_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stockes` (`id`),
  CONSTRAINT `product_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_histories`
--

LOCK TABLES `product_histories` WRITE;
/*!40000 ALTER TABLE `product_histories` DISABLE KEYS */;
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
  KEY `product_stocks_user_id_foreign` (`user_id`),
  CONSTRAINT `product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_stocks_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stockes` (`id`),
  CONSTRAINT `product_stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
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
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Consequatur qui mole','Amanda Harding','Labore labore velit','Ex aspernatur sint',0.00,38.00,883.00,0.00,367.00,1041.94,18.00,0.00,0.00,957.00,'2016-02-19','Eligendi in recusand',1,1,'2024-11-05 12:25:11','2024-11-05 12:25:11',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retour_produits`
--

LOCK TABLES `retour_produits` WRITE;
/*!40000 ALTER TABLE `retour_produits` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(2,2,1,NULL,NULL,NULL),(3,3,1,NULL,NULL,NULL),(4,4,1,NULL,NULL,NULL),(5,5,1,NULL,NULL,NULL);
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
INSERT INTO `roles` VALUES (1,'ADMINISTRATEUR','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(2,'CONTROLLEUR','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(3,'COMPTABLE','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(4,'VENTE','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(5,'ENTRE DES PRODUITS EN STOCK','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_details`
--

DROP TABLE IF EXISTS `room_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_file_ref` varchar(255) DEFAULT NULL,
  `amount` double(60,2) NOT NULL,
  `tax` double(60,2) NOT NULL,
  `total_quantity` double(60,2) NOT NULL,
  `amount_tax` double(60,2) NOT NULL,
  `type_facture` varchar(255) DEFAULT NULL,
  `company` text DEFAULT NULL,
  `client` text DEFAULT NULL,
  `canceled_or_connection` text DEFAULT NULL,
  `addresse_client` text DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `commissionaire_id` bigint(20) unsigned DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_details`
--

LOCK TABLES `room_details` WRITE;
/*!40000 ALTER TABLE `room_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room_file`
--

DROP TABLE IF EXISTS `room_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room_file` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_number` varchar(400) NOT NULL,
  `room_tva` varchar(30) NOT NULL,
  `client_id` int(11) NOT NULL,
  `room_id_ref` int(11) NOT NULL,
  `room_date_checkin` varchar(255) NOT NULL,
  `room_date_checkout` varchar(255) NOT NULL,
  `room_file_creator` int(11) NOT NULL,
  `room_file_status` int(11) NOT NULL DEFAULT 0,
  `room_file_delete_status` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room_file`
--

LOCK TABLES `room_file` WRITE;
/*!40000 ALTER TABLE `room_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `room_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `room_name` varchar(400) NOT NULL,
  `room_tva` varchar(30) NOT NULL,
  `room_tc` varchar(30) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `room_price` double NOT NULL,
  `room_capacity` varchar(30) NOT NULL,
  `room_state` int(11) NOT NULL DEFAULT 0,
  `room_description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `room_delete_status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('fGLn91ngfPglTpbrDMfT3oF0kQjI4jnGnb9ZA7oL',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiS2J6VlRjRTN6U1BiTUpORDIwNHo5enI5OE9oeWc5aFplM3dibm90ZyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb2JyX2xvZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCQ5MklYVU5wa2pPMHJPUTVieU1pLlllNG9Lb0VhM1JvOWxsQy8ub2cvYXQyLnVoZVdHL2lnaSI7czoxNzoiY2FuY2VsX3N5bmNyb25pemUiO2I6MDt9',1730809607);
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
INSERT INTO `stockes` VALUES (1,'Jose','Tempora magni est sed veritatis nisi totam. Provident eos veniam quia. Aspernatur ex quia omnis omnis doloremque iure. Ullam tempora nesciunt voluptatibus aliquam quia omnis adipisci.','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL),(2,'STOCK PRINCIPAL','STOCK PRINCIPAL DE BASE','2024-08-11 03:25:57','2024-08-11 03:25:57',NULL);
/*!40000 ALTER TABLE `stockes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'JEAN LIONEL','nijeanlionel@gmail.com','2024-08-11 03:25:57','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,'1CLLlP1kA3gjGMfbCkkDJFIjfii4ccE9vFgxcFzx7bOK5xhZNgOMto4wG1G7',NULL,NULL,'2024-08-11 03:25:57','2024-08-11 03:25:57',NULL);
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

-- Dump completed on 2024-11-05 14:26:56
