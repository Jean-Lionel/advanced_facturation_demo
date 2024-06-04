-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juin 2024 à 22:14
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `magasin_hr`
--

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_departement` varchar(255) NOT NULL,
  `description_departement` longtext DEFAULT NULL,
  `deleted_status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `name_departement`, `description_departement`, `deleted_status`, `created_at`, `updated_at`) VALUES
(1, 'DAF', 'Departement DAF', '0', '2023-10-23 00:11:10', NULL),
(2, 'DRC', 'Departement DRC', '0', '2023-10-23 00:11:10', NULL),
(3, 'D E', 'DE Departement', '0', '2023-10-23 00:11:10', NULL),
(4, 'CDC', 'Departement', '1', '2023-10-23 00:11:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_bank`
--

CREATE TABLE `hrm_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_code` varchar(50) DEFAULT NULL,
  `bank_code_transfer` varchar(50) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `hrm_bank`
--

INSERT INTO `hrm_bank` (`bank_id`, `bank_name`, `bank_code`, `bank_code_transfer`, `created_by`, `created_date`) VALUES
(1, 'FINBANK', '537011', '', 1, '2022-02-08 00:00:00'),
(2, 'Banque de Credit du Burundi', '0079458-29', '', 1, '2022-02-08 00:00:00'),
(3, 'Interbank', '20004-18123-00000717601-43', '', 1, '2022-02-08 00:00:00'),
(4, 'CRDB bank', '01500800424300', '', 1, '2022-02-08 00:00:00'),
(5, 'Ecobank', '38125000900', '', 1, '2022-02-08 00:00:00'),
(6, 'Bancobu', '0011097-01-05', '', 1, '2022-02-08 00:00:00'),
(7, 'Banque de Gestion et Finance', '3695-1-90', '', 1, '2022-02-08 00:00:00'),
(8, 'Mutec', '4761/01/71', '', 1, '2022-02-08 00:00:00'),
(9, 'CCEM', '', '20004-18123-00000717601-43', 1, '2022-02-08 00:00:00'),
(10, 'KCB', '6600048018', '', 1, '2022-02-08 00:00:00'),
(11, 'FENACOBU', '', '20004-18123-00000717601-43', 1, '2022-02-08 00:00:00'),
(12, 'BANQUE COMMUNAUTAIRE ET AGRICOLE DU BURUNDI', '20100377101-17', '20004-18123-00000717601-43', 1, '2022-02-08 00:00:00'),
(13, 'UMUCO', '5749', '20004-18123-00000717601-43', 1, '2022-02-08 00:00:00'),
(14, 'TWITEZIMBERE MICROFINANCE', '18650/1', '0079458-29', 1, '2022-02-08 00:00:00'),
(15, 'HAUGE Family Microfinance', '13120-00100047043-10', '0079458-29', 1, '2022-02-08 00:00:00'),
(16, 'BBCI', '1016971', '20004-18123-00000717601-43', 1, '2022-02-08 00:00:00'),
(17, 'EDEN MICROFINANCE', '078083201.01-86', '0011097-01-05', 1, '2022-02-08 00:00:00'),
(18, 'Ihéla Credit Union', '12345', NULL, 1, '2023-08-16 20:24:54'),
(21, 'DEAS', '4334637233', NULL, 18, '2023-11-18 13:29:44'),
(22, 'BCR', '5489334893', NULL, 18, '2023-11-20 07:20:24');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_branche`
--

CREATE TABLE `hrm_branche` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `qualification` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_branche`
--

INSERT INTO `hrm_branche` (`id`, `title`, `qualification`, `created_by`, `created_at`) VALUES
(1, 'Bujumbura', '', 1, '2023-09-15 14:58:07'),
(4, 'Gitega', '', 1, '2023-09-15 15:00:04'),
(8, 'Karusi', '', 2, '2023-10-31 11:33:57');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_cotation`
--

CREATE TABLE `hrm_cotation` (
  `cotation_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type_cotation` int(11) NOT NULL,
  `note_cotation` text DEFAULT NULL,
  `cotation_status` int(11) DEFAULT 0,
  `confirmation_or_reject_date` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `confirmed_by` int(11) DEFAULT NULL,
  `rejected_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hrm_cotation`
--

INSERT INTO `hrm_cotation` (`cotation_id`, `employee_id`, `type_cotation`, `note_cotation`, `cotation_status`, `confirmation_or_reject_date`, `created_date`, `created_by`, `confirmed_by`, `rejected_by`) VALUES
(1, 1, 1, 'Il a ete tres Performant', 1, '2023-11-14 17:49:03', '2023-11-14 17:48:50', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_department`
--

CREATE TABLE `hrm_department` (
  `department_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_department`
--

INSERT INTO `hrm_department` (`department_id`, `title`, `created_by`, `created_date`) VALUES
(7, 'Direction', 18, '2023-11-24 08:42:32'),
(9, 'Commerciale', 18, '2023-11-24 08:43:52'),
(11, 'Test', 1, '2024-06-04 21:33:46');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee`
--

CREATE TABLE `hrm_employee` (
  `employee_id` int(11) NOT NULL,
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
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_employee`
--

INSERT INTO `hrm_employee` (`employee_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `maratial_status`, `father_name`, `mother_name`, `nationality`, `cni_number`, `full_address`, `work_address`, `phone`, `email`, `fonction_id`, `school_degree`, `comment`, `joining_date`, `leaving_date`, `status`, `code_inss`, `contract_id`, `created_date`, `created_by`, `deleted_status`, `parti_ou_contract_end`, `modified_date`, `modified_by`, `deleted_date`, `deleted_by`) VALUES
(1, 'Jean Marie', 'Matwi', '1985-03-01', 'homme', NULL, NULL, NULL, NULL, '3333098/GT/17', NULL, 'Master En Economie', '71023456', NULL, 3, 4, NULL, '2022-01-01', NULL, 1, '00998', NULL, '2023-10-18 00:00:00', 1, 0, 0, '2023-10-19 00:00:00', 1, NULL, NULL),
(2, 'Cynthia', 'Bukuru', '2023-10-28', 'Femme', NULL, NULL, NULL, NULL, '3330011-19-11', NULL, 'Bac 3', '68001234', NULL, 2, 4, NULL, '2023-01-01', '1970-01-01 00:00:00', 1, NULL, NULL, '2023-10-23 00:00:00', 1, 0, 0, NULL, NULL, NULL, NULL),
(3, 'Jean Claude', 'Ntunzwenayo', '1985-05-01', 'homme', NULL, NULL, NULL, NULL, '123463333-22', NULL, 'Bac 3', '76606060', NULL, 9, 4, NULL, '2022-01-01', '1970-01-01 00:00:00', 1, NULL, NULL, '2023-10-23 00:00:00', 1, 0, 0, NULL, NULL, NULL, NULL),
(4, 'Désire', 'Bucumi', '1980-10-01', 'homme', NULL, 'Kizimbwe Nelson', 'Madia Nadine', NULL, '220005-5666-78', NULL, 'NGOZI,MARANGARA', '79090101', NULL, 8, 4, NULL, '2022-01-01', NULL, 1, '54655', NULL, '2023-10-23 00:00:00', 1, 0, 0, '2024-01-22 00:00:00', 20, NULL, NULL),
(5, 'Jerome', 'Manirakiza', '1997-06-13', 'homme', NULL, 'JJJJjj', 'dcccc', NULL, '8549839432', NULL, 'GITEGA,GITEGA', '7834873484', NULL, 2, 4, NULL, '2023-12-15', '1970-01-01 00:00:00', 1, NULL, NULL, '2023-11-03 00:00:00', 2, 0, 0, '2023-11-15 00:00:00', 2, NULL, NULL),
(6, 'Pascal', 'Minanii', '1995-11-11', 'homme', NULL, 'Bigirimana Jerome', 'Nahimana Agnes', NULL, '4984589495', NULL, 'GITEGA,GITEGA', '45645457', NULL, 9, 4, NULL, '2022-07-01', '1970-01-01 00:00:00', 1, '44345', NULL, '2023-11-15 00:00:00', 2, 0, 0, '2023-11-15 00:00:00', 1, NULL, NULL),
(8, 'Jean', 'Matwi', '2024-06-13', 'homme', NULL, 'Matwi Jean', 'Matwi Jeanne', NULL, '23456/22', 'kigobe', NULL, '67889990', NULL, 2, NULL, NULL, '2024-06-01', '1970-01-01 00:00:00', 0, '32209', NULL, '2024-06-03 00:00:00', 1, 0, 0, NULL, NULL, NULL, NULL),
(9, 'Jean', 'Matwi', '2024-06-13', 'homme', NULL, 'Matwi Jean', 'Matwi Jeanne', NULL, '23456/22', 'kigobe', NULL, '67889990', NULL, 2, NULL, NULL, '2024-06-01', '1970-01-01 00:00:00', 1, '32209', NULL, '2024-06-03 00:00:00', 1, 0, 0, '2024-06-03 00:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee_bank`
--

CREATE TABLE `hrm_employee_bank` (
  `employee_bank_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_number` varchar(300) NOT NULL,
  `account_money` float DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_employee_bank`
--

INSERT INTO `hrm_employee_bank` (`employee_bank_id`, `bank_id`, `employee_id`, `account_number`, `account_money`, `created_date`, `created_by`) VALUES
(1, 6, 1, '12345670033', NULL, '2023-10-18 00:00:00', 1),
(2, 3, 2, '1234000987', NULL, '2023-10-23 00:00:00', 1),
(3, 5, 3, '1234560009990', NULL, '2023-10-23 00:00:00', 1),
(4, 6, 4, '124044555-44-12', NULL, '2023-10-23 00:00:00', 1),
(5, 2, 5, '89443993483487', NULL, '2023-11-03 00:00:00', 2),
(6, 1, 6, '4346457568556856', NULL, '2023-11-15 00:00:00', 2),
(7, 9, 7, '738', NULL, '2023-11-15 00:00:00', 1),
(8, 4, 9, '12345678-12', NULL, '2024-06-03 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee_indeminite`
--

CREATE TABLE `hrm_employee_indeminite` (
  `indeminite_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type_indeminite_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee_payroll`
--

CREATE TABLE `hrm_employee_payroll` (
  `payroll_id` int(11) NOT NULL,
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
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_employee_payroll`
--

INSERT INTO `hrm_employee_payroll` (`payroll_id`, `employee_id`, `basic_salary`, `net_salary`, `brut_salary`, `work_days_per_month`, `work_hours_per_day`, `transport_allowance`, `additional_pension`, `status`, `payment_type`, `created_date`, `created_by`) VALUES
(1, 1, 520000, 784656, 910000, NULL, NULL, '1,2', 30000, 1, NULL, '2023-11-14 17:49:03', 1),
(2, 2, 300000, 469560, 525000, NULL, NULL, '1,2', NULL, 1, NULL, '2023-10-22 20:00:00', 1),
(3, 3, 350000, 543630, 612500, NULL, NULL, '1,2', NULL, 1, NULL, '2023-10-22 20:00:00', 1),
(4, 4, 1500000, 2426100, 3000000, NULL, NULL, '1,2,4', NULL, 1, NULL, '2024-01-22 08:24:18', 1),
(5, 5, 1105000, 1401399, 1671250, NULL, NULL, '1,2,4,5', 200000, 1, NULL, '2023-11-15 07:29:01', 2),
(6, 6, 1105000, 1799709, 2210000, NULL, NULL, '1,2,4', NULL, 1, NULL, '2023-11-15 12:08:42', 2),
(7, 7, 1105000, 1775178, 2099500, NULL, NULL, '1,2,5', NULL, 1, NULL, '2023-11-14 22:00:00', 1),
(8, 9, 120000, 196080, 210000, NULL, NULL, '1,2', NULL, 1, NULL, '2024-06-02 22:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee_retenue`
--

CREATE TABLE `hrm_employee_retenue` (
  `employee_retenue_id` int(11) NOT NULL,
  `retenue_id` varchar(100) NOT NULL,
  `employee_id_in_retenue` int(11) NOT NULL,
  `retenue_amount` int(11) NOT NULL,
  `retenue_month` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_employee_retenue`
--

INSERT INTO `hrm_employee_retenue` (`employee_retenue_id`, `retenue_id`, `employee_id_in_retenue`, `retenue_amount`, `retenue_month`, `created_by`, `created_at`) VALUES
(3, '1', 1, 10000, '10-2023', 1, '2023-10-25 14:17:42'),
(6, '1', 9, 60000, '01-1970', 1, '2024-06-04 14:37:54');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_employee_trainer`
--

CREATE TABLE `hrm_employee_trainer` (
  `employee_id` int(11) NOT NULL,
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
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_employee_trainer`
--

INSERT INTO `hrm_employee_trainer` (`employee_id`, `first_name`, `last_name`, `date_of_birth`, `gender`, `maratial_status`, `father_name`, `mother_name`, `nationality`, `cni_number`, `full_address`, `work_address`, `phone`, `email`, `fonction_id`, `school_degree`, `net_salary`, `joining_date`, `leaving_date`, `status`, `code_inss`, `contract_id`, `created_date`, `created_by`, `deleted_status`, `parti_ou_contract_end`, `modified_date`, `modified_by`, `deleted_date`, `deleted_by`) VALUES
(1, 'Kevin', 'Muhindu', '2000-01-01', 'homme', NULL, 'Muhindu Jean', 'Muhindu Jeanne', NULL, '6542/01/120', NULL, 'KARUZI,BUHIGA', '71202020', NULL, NULL, 8, '100000', '2024-01-01', '1970-01-01 00:00:00', 1, 'Hopital de Buhiga', NULL, '2024-03-16 00:00:00', 20, 0, 0, '2024-03-25 00:00:00', 20, NULL, NULL),
(2, 'Kevin2', 'Muhindu', '2000-01-01', 'homme', NULL, 'Muhindu Jean', 'Muhindu Jeanne', NULL, '6542/01/120', NULL, 'KARUZI,BUHIGA', '71202020', NULL, NULL, 8, '100000', '2024-01-01', '1970-01-01 00:00:00', 0, NULL, NULL, '2024-03-16 00:00:00', 20, 0, 0, '2024-03-16 00:00:00', 20, NULL, NULL),
(3, 'Moise', 'Bukuru', '1991-11-11', 'homme', NULL, 'Bukuru Déo', 'Bukuru Jeanne', NULL, '123463333-22', NULL, 'BUJUMBURA RURAL,KABEZI', '61040502', NULL, NULL, 1, '100000', '2024-01-01', '1970-01-01 00:00:00', 1, 'Hopital de Kabezi', NULL, '2024-03-25 00:00:00', 20, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_fonctions`
--

CREATE TABLE `hrm_fonctions` (
  `fonction_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_fonctions`
--

INSERT INTO `hrm_fonctions` (`fonction_id`, `department_id`, `title`, `created_by`, `created_date`) VALUES
(1, 9, 'Caissier(e)', 1, '2022-06-28 13:48:55'),
(2, 9, 'Comptable', 1, '2022-10-07 08:26:36'),
(3, 9, 'DAF', 1, '2023-08-14 21:15:20'),
(8, 9, 'Directeur Génerale', 1, '2023-10-17 07:34:01'),
(9, 9, 'Informaticien', 1, '2023-10-23 11:37:22'),
(11, 9, 'Caissière', 1, '2024-06-04 21:15:30');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_leave_category`
--

CREATE TABLE `hrm_leave_category` (
  `leave_category_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `color_code` varchar(100) DEFAULT NULL,
  `type_leave_category` int(11) NOT NULL DEFAULT 0 COMMENT '0:unpaid,1:paid',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_leave_category`
--

INSERT INTO `hrm_leave_category` (`leave_category_id`, `category`, `color_code`, `type_leave_category`, `created_date`, `created_by`) VALUES
(1, 'Congé annuel', '#ad252b', 0, '2022-08-17 07:18:34', 1),
(2, 'Congé de maternités', '#f782c1', 0, '2022-08-17 07:19:49', 1),
(6, 'Congé de circonstance', NULL, 0, '2023-10-17 08:20:47', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_loan`
--

CREATE TABLE `hrm_loan` (
  `loan_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `period` int(11) NOT NULL COMMENT 'en mois',
  `loan_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:en attente,1: confirmé,2:en partie paye,3:total paye,4: refuser',
  `slice_amount` float NOT NULL,
  `date_of_demand` varchar(100) NOT NULL,
  `date_of_confirmation` varchar(100) DEFAULT NULL,
  `dead_line_date` varchar(100) NOT NULL,
  `demanded_by` int(11) NOT NULL,
  `confirmed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `hrm_loan`
--

INSERT INTO `hrm_loan` (`loan_id`, `employee_id`, `total_amount`, `period`, `loan_status`, `slice_amount`, `date_of_demand`, `date_of_confirmation`, `dead_line_date`, `demanded_by`, `confirmed_by`) VALUES
(1, 1, 40000, 2, 3, 20000, '2022-10-11 17:28:46', '2022-10-11 17:29:12', '2022-12-11', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_loan_refund`
--

CREATE TABLE `hrm_loan_refund` (
  `loan_refund_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `amount_refund` float NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `hrm_loan_refund`
--

INSERT INTO `hrm_loan_refund` (`loan_refund_id`, `loan_id`, `amount_refund`, `created_at`, `created_by`) VALUES
(1, 1, 20000, '2022-11-11', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_paid_leave`
--

CREATE TABLE `hrm_paid_leave` (
  `paid_leave_id` int(11) NOT NULL,
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
  `notify_status` int(11) DEFAULT 0 COMMENT '0=not notified; 1=already notified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_paid_leave`
--

INSERT INTO `hrm_paid_leave` (`paid_leave_id`, `employee_id`, `employee_remplacant`, `leave_category_id`, `comment`, `start_date`, `end_date`, `period`, `leave_status`, `request_date`, `confirmation_or_reject_date`, `created_by`, `confirmed_by`, `rejected_by`, `confirmation_comment`, `reject_comment`, `read_status`, `notify_status`) VALUES
(3, 1, NULL, 1, NULL, '2023-11-01', '2023-11-24', 18, 1, '2023-10-21 00:00:00', '2023-11-15 07:51:34', 1, 2, NULL, NULL, NULL, 0, 0),
(5, 4, NULL, 1, NULL, '2023-11-21', '2023-11-30', 8, 1, '2023-11-15 00:00:00', '2024-06-04 11:41:41', 2, 1, NULL, NULL, NULL, 0, 0),
(6, 3, '4', 6, NULL, '2023-11-17', '2023-11-30', 10, 1, '2023-11-16 00:00:00', '2023-11-24 05:48:08', 1, 1, NULL, NULL, NULL, 0, 0),
(7, 9, NULL, 6, NULL, '2024-06-07', '2024-06-07', 1, 0, '2024-06-04 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, 0, 0),
(8, 9, NULL, 6, NULL, '2024-06-06', '2024-06-06', 1, 0, '2024-06-04 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, 0, 0),
(9, 1, NULL, 1, NULL, '2024-06-07', '2024-06-30', 16, 0, '2024-06-04 00:00:00', NULL, 1, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_retenue_type`
--

CREATE TABLE `hrm_retenue_type` (
  `id_retenue_type` int(11) NOT NULL,
  `name_retenue_type` varchar(100) NOT NULL,
  `amount_retenue_type` int(11) NOT NULL DEFAULT 0,
  `createdBy_retenue_type` int(11) NOT NULL,
  `createdAt_retenue_type` datetime NOT NULL,
  `deleteStatus_retenue_type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_retenue_type`
--

INSERT INTO `hrm_retenue_type` (`id_retenue_type`, `name_retenue_type`, `amount_retenue_type`, `createdBy_retenue_type`, `createdAt_retenue_type`, `deleteStatus_retenue_type`) VALUES
(1, 'Sanctions administratives', 0, 1, '2022-10-15 11:16:38', 0),
(6, 'Avance sur salaire', 0, 1, '2024-06-04 20:49:22', 0);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_salary_payment`
--

CREATE TABLE `hrm_salary_payment` (
  `salary_payment_id` int(11) NOT NULL,
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
  `delete_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_salary_payment`
--

INSERT INTO `hrm_salary_payment` (`salary_payment_id`, `employee_id`, `basic_salary`, `gross_salary`, `net_salary`, `work_days`, `regularisation`, `allowance`, `family_allowance`, `deduction`, `advance`, `caisse_sociale`, `loan`, `inss`, `ire`, `pension_salariale`, `pension_patronale`, `pension_complementaire`, `mfp_patronal`, `mfp_salariale`, `risque_prof`, `tax_base`, `month_year`, `statut`, `payment_date`, `created_by`, `created_date`, `modify_by`, `modify_date`, `delete_by`, `delete_date`, `delete_status`) VALUES
(6, 1, 400000, 700000, 609520, 0, 0, 300000, 0, 0, 0, 5000, 0, 47400, 49080, 18000, 27000, NULL, 27600.00, 18400.00, 2400, 363600, '11-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:43:47', NULL, NULL, NULL, NULL, NULL),
(7, 2, 300000, 525000, 464560, 0, 0, 225000, 0, 0, 0, 5000, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '11-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:43:47', NULL, NULL, NULL, NULL, NULL),
(8, 3, 350000, 612500, 538630, 0, 0, 262500, 0, 0, 0, 5000, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '11-2023', 0, NULL, 2, '2023-11-03 10:43:47', NULL, NULL, NULL, NULL, NULL),
(9, 4, 1500000, 2625000, 2169100, 0, 0, 1125000, 0, 0, 0, 5000, 0, 47400, 363900, 18000, 27000, NULL, 103500.00, 69000.00, 2400, 1413000, '11-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:43:47', NULL, NULL, NULL, NULL, NULL),
(10, 5, 955000, 1671250, 1396399, 0, 0, 716250, 0, 0, 0, 5000, 0, 47400, 207921, 18000, 27000, NULL, 65895.00, 43930.00, 2400, 893070, '11-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:43:47', NULL, NULL, NULL, NULL, NULL),
(11, 1, 400000, 700000, 609520, 0, 0, 300000, 0, 0, 0, 5000, 0, 47400, 49080, 18000, 27000, NULL, 27600.00, 18400.00, 2400, 363600, '12-2023', 1, '2024-06-04 20:01:18', 2, '2023-11-03 10:47:53', NULL, NULL, NULL, NULL, NULL),
(12, 2, 300000, 525000, 464560, 0, 0, 225000, 0, 0, 0, 5000, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '12-2023', 1, '2024-06-04 20:04:01', 2, '2023-11-03 10:47:53', NULL, NULL, NULL, NULL, NULL),
(13, 3, 350000, 612500, 468630, 0, 0, 262500, 0, 0, 0, 5000, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '12-2023', 1, '2024-01-22 07:16:08', 2, '2023-11-03 10:47:53', 20, NULL, NULL, NULL, NULL),
(14, 4, 1500000, 2625000, 2169100, 0, 0, 1125000, 0, 0, 0, 5000, 0, 47400, 363900, 18000, 27000, NULL, 103500.00, 69000.00, 2400, 1413000, '12-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:47:53', NULL, NULL, NULL, NULL, NULL),
(15, 5, 955000, 1671250, 1396399, 0, 0, 716250, 0, 0, 0, 5000, 0, 47400, 207921, 18000, 27000, NULL, 65895.00, 43930.00, 2400, 893070, '12-2023', 1, '2023-11-03 10:50:30', 2, '2023-11-03 10:47:53', NULL, NULL, NULL, NULL, NULL),
(16, 1, 400000, 700000, 609520, 0, 0, 300000, 0, 0, 0, 5000, 0, 47400, 49080, 18000, 27000, NULL, 27600.00, 18400.00, 2400, 363600, '01-2024', 0, NULL, 2, '2023-11-03 10:51:32', NULL, NULL, NULL, NULL, NULL),
(17, 2, 300000, 525000, 464560, 0, 0, 225000, 0, 0, 0, 5000, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '01-2024', 1, '2023-11-03 10:52:31', 2, '2023-11-03 10:51:32', NULL, NULL, NULL, NULL, NULL),
(18, 3, 350000, 612500, 538630, 0, 0, 262500, 0, 0, 0, 5000, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '01-2024', 1, '2023-11-03 10:52:31', 2, '2023-11-03 10:51:32', NULL, NULL, NULL, NULL, NULL),
(19, 4, 1500000, 2625000, 2169100, 0, 0, 1125000, 0, 0, 0, 5000, 0, 47400, 363900, 18000, 27000, NULL, 103500.00, 69000.00, 2400, 1413000, '01-2024', 1, '2023-11-03 10:52:31', 2, '2023-11-03 10:51:32', NULL, NULL, NULL, NULL, NULL),
(20, 5, 955000, 1671250, 1396399, 0, 0, 716250, 0, 0, 0, 5000, 0, 47400, 207921, 18000, 27000, NULL, 65895.00, 43930.00, 2400, 893070, '01-2024', 1, '2023-11-03 10:52:31', 2, '2023-11-03 10:51:32', NULL, NULL, NULL, NULL, NULL),
(21, 1, 520000, 910000, 779656, 0, 0, 390000, 0, 0, 0, 5000, 0, 47400, 83424, 18000, 27000, NULL, 35880.00, 23920.00, 2400, 478080, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(22, 2, 300000, 525000, 464560, 0, 0, 225000, 0, 0, 0, 5000, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(23, 3, 350000, 612500, 538630, 0, 0, 262500, 0, 0, 0, 5000, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(24, 4, 1500000, 3000000, 2533600, 0, 0, 1500000, 0, 0, 0, 5000, 0, 47400, 359400, 18000, 27000, NULL, 126000.00, 84000.00, 2400, 1398000, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(25, 5, 1105000, 2375750, 2038693, 0, 0, 1270750, 0, 0, 0, 5000, 0, 47400, 245547, 18000, 27000, NULL, 102765.00, 68510.00, 2400, 1018490, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(26, 6, 1182350, 2364701, 2006048, 0, 0, 1182351, 0, 0, 0, 5000, 0, 47400, 269441, 18000, 27000, NULL, 99317.00, 66212.00, 2400, 1098138, '04-2024', 0, NULL, 2, '2023-11-15 07:57:23', NULL, NULL, NULL, NULL, NULL),
(27, 1, 520000, 910000, 779656, 0, 0, 390000, 0, 0, 0, 5000, 0, 47400, 83424, 18000, 27000, NULL, 35880.00, 23920.00, 2400, 478080, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(28, 2, 300000, 525000, 464560, 0, 0, 225000, 0, 0, 0, 5000, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(29, 3, 350000, 612500, 538630, 0, 0, 262500, 0, 0, 0, 5000, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(30, 4, 1500000, 3000000, 2533600, 0, 0, 1500000, 0, 0, 0, 5000, 0, 47400, 359400, 18000, 27000, NULL, 126000.00, 84000.00, 2400, 1398000, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(31, 5, 1105000, 2375750, 2038693, 0, 0, 1270750, 0, 0, 0, 5000, 0, 47400, 245547, 18000, 27000, NULL, 102765.00, 68510.00, 2400, 1018490, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(32, 6, 1105000, 2375750, 2038693, 0, 0, 1270750, 0, 0, 0, 5000, 0, 47400, 245547, 18000, 27000, NULL, 102765.00, 68510.00, 2400, 1018490, '02-2024', 0, NULL, 2, '2023-11-15 08:15:25', NULL, NULL, NULL, NULL, NULL),
(40, 1, 520000, 910000, 784656, 0, 0, 390000, 0, 0, 0, 0, 0, 47400, 83424, 18000, 27000, NULL, 35880.00, 23920.00, 2400, 478080, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(41, 2, 300000, 525000, 469560, 0, 0, 225000, 0, 0, 0, 0, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(42, 3, 350000, 612500, 543630, 0, 0, 262500, 0, 0, 0, 0, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(43, 4, 1500000, 3000000, 2426100, 0, 0, 1500000, 0, 0, 0, 0, 0, 47400, 471900, 18000, 27000, NULL, 126000.00, 84000.00, 2400, 1773000, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(44, 5, 1105000, 2375750, 1960818, 0, 0, 1270750, 0, 0, 0, 0, 0, 47400, 328422, 18000, 27000, NULL, 102765.00, 68510.00, 2400, 1294740, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(45, 6, 1105000, 2210000, 1799709, 0, 0, 1105000, 0, 0, 0, 0, 0, 47400, 330411, 18000, 27000, NULL, 92820.00, 61880.00, 2400, 1301370, '01-1970', 0, NULL, 1, '2024-06-04 19:32:02', NULL, NULL, NULL, NULL, NULL),
(46, 9, 120000, 210000, 136080, 0, 0, 90000, 0, 0, 0, 0, 0, 23400, 0, 8400, 12600, NULL, 8280.00, 5520.00, 2400, 106080, '01-1970', 0, NULL, 1, '2024-06-04 19:32:03', NULL, NULL, NULL, NULL, NULL),
(47, 1, 520000, 910000, 784656, 0, 0, 390000, 0, 0, 0, 0, 0, 47400, 83424, 18000, 27000, NULL, 35880.00, 23920.00, 2400, 478080, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(48, 2, 300000, 525000, 469560, 0, 0, 225000, 0, 0, 0, 0, 0, 47400, 23640, 18000, 27000, NULL, 20700.00, 13800.00, 2400, 268200, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(49, 3, 350000, 612500, 543630, 0, 0, 262500, 0, 0, 0, 0, 0, 47400, 34770, 18000, 27000, NULL, 24150.00, 16100.00, 2400, 315900, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(50, 4, 1500000, 3000000, 2426100, 0, 0, 1500000, 0, 0, 0, 0, 0, 47400, 471900, 18000, 27000, NULL, 126000.00, 84000.00, 2400, 1773000, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(51, 5, 1105000, 2375750, 1960818, 0, 0, 1270750, 0, 0, 0, 0, 0, 47400, 328422, 18000, 27000, NULL, 102765.00, 68510.00, 2400, 1294740, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(52, 6, 1105000, 2210000, 1799709, 0, 0, 1105000, 0, 0, 0, 0, 0, 47400, 330411, 18000, 27000, NULL, 92820.00, 61880.00, 2400, 1301370, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL),
(53, 9, 120000, 210000, 196080, 0, 0, 90000, 0, 0, 0, 0, 0, 23400, 0, 8400, 12600, NULL, 8280.00, 5520.00, 2400, 106080, '06-2024', 0, NULL, 1, '2024-06-04 19:45:31', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_salary_retenue`
--

CREATE TABLE `hrm_salary_retenue` (
  `salary_retenue_id` int(11) NOT NULL,
  `retenue_type` varchar(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `retenue_month` varchar(200) NOT NULL,
  `created_date` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `hrm_salary_retenue`
--

INSERT INTO `hrm_salary_retenue` (`salary_retenue_id`, `retenue_type`, `employee_id`, `amount`, `retenue_month`, `created_date`, `created_by`) VALUES
(4, '1', 1, 10000, '10-2023', '2023-10-25 14:24:22', 1),
(5, '1', 3, 70000, '12-2023', '2023-11-03 10:47:53', 2),
(7, '1', 9, 60000, '01-1970', '2024-06-04 19:32:02', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_settings`
--

CREATE TABLE `hrm_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `content` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hrm_settings`
--

INSERT INTO `hrm_settings` (`id`, `name`, `created_by`, `created_at`, `content`) VALUES
(1, 'caisse sociale', 1, '2023-11-15 12:31:03', '5000');

-- --------------------------------------------------------

--
-- Structure de la table `hrm_type_cotation`
--

CREATE TABLE `hrm_type_cotation` (
  `type_cotation_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `percentage` float NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hrm_type_cotation`
--

INSERT INTO `hrm_type_cotation` (`type_cotation_id`, `title`, `percentage`, `created_date`, `created_by`) VALUES
(1, 'Excellence', 7, '2023-11-15 07:52:57', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hrm_type_indeminite`
--

CREATE TABLE `hrm_type_indeminite` (
  `type_indeminite_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `percentage` float NOT NULL,
  `taxable` int(11) DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `hrm_type_indeminite`
--

INSERT INTO `hrm_type_indeminite` (`type_indeminite_id`, `title`, `percentage`, `taxable`, `created_date`, `created_by`) VALUES
(1, 'Logement', 60, 0, '2023-10-17 07:05:46', 1),
(2, 'Déplacement', 15, 0, '2023-10-17 07:06:17', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hrm_bank`
--
ALTER TABLE `hrm_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Index pour la table `hrm_branche`
--
ALTER TABLE `hrm_branche`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hrm_cotation`
--
ALTER TABLE `hrm_cotation`
  ADD PRIMARY KEY (`cotation_id`);

--
-- Index pour la table `hrm_department`
--
ALTER TABLE `hrm_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Index pour la table `hrm_employee`
--
ALTER TABLE `hrm_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Index pour la table `hrm_employee_bank`
--
ALTER TABLE `hrm_employee_bank`
  ADD PRIMARY KEY (`employee_bank_id`);

--
-- Index pour la table `hrm_employee_indeminite`
--
ALTER TABLE `hrm_employee_indeminite`
  ADD PRIMARY KEY (`indeminite_id`);

--
-- Index pour la table `hrm_employee_payroll`
--
ALTER TABLE `hrm_employee_payroll`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Index pour la table `hrm_employee_retenue`
--
ALTER TABLE `hrm_employee_retenue`
  ADD PRIMARY KEY (`employee_retenue_id`);

--
-- Index pour la table `hrm_employee_trainer`
--
ALTER TABLE `hrm_employee_trainer`
  ADD PRIMARY KEY (`employee_id`);

--
-- Index pour la table `hrm_fonctions`
--
ALTER TABLE `hrm_fonctions`
  ADD PRIMARY KEY (`fonction_id`);

--
-- Index pour la table `hrm_leave_category`
--
ALTER TABLE `hrm_leave_category`
  ADD PRIMARY KEY (`leave_category_id`);

--
-- Index pour la table `hrm_loan`
--
ALTER TABLE `hrm_loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Index pour la table `hrm_loan_refund`
--
ALTER TABLE `hrm_loan_refund`
  ADD PRIMARY KEY (`loan_refund_id`);

--
-- Index pour la table `hrm_paid_leave`
--
ALTER TABLE `hrm_paid_leave`
  ADD PRIMARY KEY (`paid_leave_id`);

--
-- Index pour la table `hrm_retenue_type`
--
ALTER TABLE `hrm_retenue_type`
  ADD PRIMARY KEY (`id_retenue_type`);

--
-- Index pour la table `hrm_salary_payment`
--
ALTER TABLE `hrm_salary_payment`
  ADD PRIMARY KEY (`salary_payment_id`);

--
-- Index pour la table `hrm_salary_retenue`
--
ALTER TABLE `hrm_salary_retenue`
  ADD PRIMARY KEY (`salary_retenue_id`);

--
-- Index pour la table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hrm_type_cotation`
--
ALTER TABLE `hrm_type_cotation`
  ADD PRIMARY KEY (`type_cotation_id`);

--
-- Index pour la table `hrm_type_indeminite`
--
ALTER TABLE `hrm_type_indeminite`
  ADD PRIMARY KEY (`type_indeminite_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `hrm_bank`
--
ALTER TABLE `hrm_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `hrm_branche`
--
ALTER TABLE `hrm_branche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hrm_cotation`
--
ALTER TABLE `hrm_cotation`
  MODIFY `cotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `hrm_department`
--
ALTER TABLE `hrm_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `hrm_employee`
--
ALTER TABLE `hrm_employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `hrm_employee_bank`
--
ALTER TABLE `hrm_employee_bank`
  MODIFY `employee_bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hrm_employee_indeminite`
--
ALTER TABLE `hrm_employee_indeminite`
  MODIFY `indeminite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `hrm_employee_payroll`
--
ALTER TABLE `hrm_employee_payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `hrm_employee_retenue`
--
ALTER TABLE `hrm_employee_retenue`
  MODIFY `employee_retenue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `hrm_employee_trainer`
--
ALTER TABLE `hrm_employee_trainer`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `hrm_fonctions`
--
ALTER TABLE `hrm_fonctions`
  MODIFY `fonction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `hrm_leave_category`
--
ALTER TABLE `hrm_leave_category`
  MODIFY `leave_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `hrm_loan`
--
ALTER TABLE `hrm_loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `hrm_loan_refund`
--
ALTER TABLE `hrm_loan_refund`
  MODIFY `loan_refund_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `hrm_paid_leave`
--
ALTER TABLE `hrm_paid_leave`
  MODIFY `paid_leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `hrm_retenue_type`
--
ALTER TABLE `hrm_retenue_type`
  MODIFY `id_retenue_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `hrm_salary_payment`
--
ALTER TABLE `hrm_salary_payment`
  MODIFY `salary_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `hrm_salary_retenue`
--
ALTER TABLE `hrm_salary_retenue`
  MODIFY `salary_retenue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `hrm_settings`
--
ALTER TABLE `hrm_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `hrm_type_cotation`
--
ALTER TABLE `hrm_type_cotation`
  MODIFY `type_cotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `hrm_type_indeminite`
--
ALTER TABLE `hrm_type_indeminite`
  MODIFY `type_indeminite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
