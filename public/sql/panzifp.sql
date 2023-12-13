-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2023 at 11:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panzifp`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectations`
--

CREATE TABLE `affectations` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `cath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affectations`
--

INSERT INTO `affectations` (`id`, `reference`, `signature`, `agent`, `projet`, `cath`, `poste`, `lieu`, `description`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AFCT-323454125952', 2345, 3406, 2, '2', 'Suivi et Evaluation', 'BUKAVU', 'dd', 1, 1, '2023-12-09 11:23:58', '2023-12-09 11:23:58'),
(2, 'AFCT-323451444641', 2345, 3405, 3, '2', 'Magasinier', 'BUKAVU', 'vg', 1, 1, '2023-12-09 11:24:59', '2023-12-09 11:44:20'),
(3, 'AFCT-323451963831', 2345, 3404, 3, '2', 'Directrice Log', 'BUKAVU', 'jjj', 1, 1, '2023-12-09 11:25:56', '2023-12-09 11:44:45'),
(4, 'AFCT-323452696701', 2345, 3403, 3, '2', 'Chargé des achats', 'BUKAVU', 'pl', 1, 1, '2023-12-09 11:26:39', '2023-12-09 11:45:05'),
(5, 'AFCT-323459282581', 2345, 3402, 3, '2', 'DAF', 'BUKAVU', 'hf', 1, 1, '2023-12-09 11:27:30', '2023-12-09 11:45:26'),
(6, 'AFCT-323459689521', 2345, 3401, 3, '2', 'Chef Comptable', 'BUKAVU', 'c', 1, 1, '2023-12-09 11:28:00', '2023-12-09 11:45:47'),
(7, 'AFCT-323456146851', 2345, 3400, 3, '2', 'Secretaire Executive', 'BUKAVU', 'DD', 1, 1, '2023-12-09 11:28:30', '2023-12-09 11:46:07'),
(8, 'AFCT-323456259841', 2345, 3399, 3, '2', 'Directeur de Programme', 'BUKAVU', 'ff', 1, 1, '2023-12-09 11:28:54', '2023-12-09 11:46:25'),
(9, 'AFCT-323458367162', 2345, 3398, 2, '1', 'Chef de projet', 'BUKAVU', 'cc', 1, 1, '2023-12-09 11:29:31', '2023-12-09 11:29:31'),
(10, 'AFCT-323452440592', 2345, 3397, 2, '2', 'Departement Apprentissage', 'BUKAVU', 'dd', 1, 1, '2023-12-09 11:30:10', '2023-12-09 11:30:10'),
(11, 'AFCT-323453141972', 2345, 3396, 2, '2', 'Comptable Senior', 'BUKAVU', 'rr', 1, 1, '2023-12-09 11:30:31', '2023-12-09 11:30:31'),
(12, 'AFCT-323452822451', 2345, 3395, 3, '2', 'Comptable Moyen', 'BUKAVU', 'cc', 1, 1, '2023-12-09 11:31:29', '2023-12-11 08:13:07'),
(13, 'AFCT-323456465393', 2345, 3407, 3, '2', 'Caissière', 'BUKAVU', 'TFR', 1, 1, '2023-12-09 13:50:50', '2023-12-09 13:50:50'),
(14, 'AFCT-323455679063', 2345, 3408, 3, '2', 'Co-Responsable RH', 'BUKAVU', 'H', 1, 1, '2023-12-09 20:09:18', '2023-12-09 20:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint UNSIGNED NOT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` bigint UNSIGNED NOT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etatcivil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `tax_identification_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `signature`, `matricule`, `firstname`, `lastname`, `middlename`, `service`, `fonction`, `gender`, `etatcivil`, `phone`, `email`, `email_verified_at`, `lieu`, `birthdate`, `tax_identification_number`, `adress`, `country`, `region`, `description`, `active`, `created_at`, `updated_at`) VALUES
(3394, NULL, 'FP-ST000000D', 'David', 'Tino', NULL, 100, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-12-09 10:43:01', '2023-12-09 10:43:01'),
(3395, '2345', 'FP-I5096B', 'Iddy', 'Byawa', 'Lukuba', 101, '3', 'Masculin', NULL, '0851750338', 'iddy.byawa@panzi.org', NULL, 'BUKAVU', '2023-12-09', NULL, 'Bkv', 'RDC', 'South Kivu', 'd', 1, '2023-12-09 11:00:14', '2023-12-09 11:00:14'),
(3396, '2345', 'FP-N4353M', 'Neema', 'Mugisho', 'Marthe', 101, '3', 'Feminin', NULL, '0851750331', 'marthe.mugisho@panzi.org', NULL, 'BUKAVU', '2023-12-21', NULL, 'GD', 'RDC', 'South Kivu', 'D', 1, '2023-12-09 11:01:37', '2023-12-09 11:01:37'),
(3397, '2345', 'FP-I7685B', 'Irenge', 'Bulalo', 'Justin', 200, '3', 'Masculin', NULL, '0851750339', 'justin.irenge@panzi.org', NULL, 'BUKAVU', '2023-12-01', NULL, 'Bukavu/Sud-Kivu/RDC', 'RDC', 'South Kivu', 'D', 1, '2023-12-09 11:04:12', '2023-12-09 11:04:12'),
(3398, '2345', 'FP-H8981M', 'Habamungu', 'Mutunzi', 'Emery', 200, '3', 'Masculin', NULL, '0851750332', 'emery.habamungu@panzi.org', NULL, 'BUKAVU', '2023-12-05', NULL, 'Bukavu/Sud-Kivu/RDC', 'RDC', 'South Kivu', 'F', 1, '2023-12-09 11:05:57', '2023-12-09 11:05:57'),
(3399, '2345', 'FP-R9829N', 'Rutega', 'Nkwale', 'Bertin', 200, '1', 'Masculin', NULL, '0851750333', 'bertin.rutega@panzi.org', NULL, 'BUKAVU', '2023-11-08', NULL, 'Bukavu/Sud-Kivu/RDC', 'RDC', 'South Kivu', 'J', 1, '2023-12-09 11:07:01', '2023-12-09 11:07:01'),
(3400, '2345', 'FP-V5923G', 'Vanessa', 'Goscinny', '', 100, '1', 'Feminin', NULL, '0851750335', 'vanessa.goscinny@panzi.org', NULL, 'BUKAVU', '2023-12-15', NULL, 'Bukavu/Sud-Kivu/RDC', 'RDC', 'South Kivu', 'g', 1, '2023-12-09 11:09:02', '2023-12-09 11:09:43'),
(3401, '2345', 'FP-J7095B', 'Judith', 'Bafuka', 'J', 101, '2', 'Feminin', NULL, '0851750334', 'judith.bafuka@panzi.org', NULL, 'BUKAVU', '2023-11-28', NULL, 'BUKAVU', 'RDC', 'SUD KIVU', 'K', 1, '2023-12-09 11:11:49', '2023-12-09 11:11:49'),
(3402, '2345', 'FP-Y8418S', 'Yves', 'Shangalume', '', 101, '1', 'Masculin', NULL, '0851750337', 'yves.shangalume@panzi.org', NULL, 'BUKAVU', '2023-12-07', NULL, 'BKV', 'RDC', 'SUD KIVU', 'T', 1, '2023-12-09 11:13:38', '2023-12-09 11:14:04'),
(3403, '2345', 'FP-S8730B', 'Socrate', 'Balibuno', 'S', 103, '3', 'Masculin', NULL, '0851750330', 'socrate.balibuno@panzi.org', NULL, 'BUKAVU', '2023-12-09', NULL, 'BKV', 'RDC', 'SUD KIVU', 'T', 1, '2023-12-09 11:15:59', '2023-12-09 11:15:59'),
(3404, '2345', 'FP-K2067K', 'Kaboyi', 'Kira', 'Marie-grace', 103, '1', 'Feminin', NULL, '0851750228', 'marie-grace.kaboyi@panzi.org', NULL, 'BKV', '2023-12-12', NULL, 'BKV', 'RDC', 'SUD KIVU', 'G', 1, '2023-12-09 11:17:16', '2023-12-09 11:17:16'),
(3405, '2345', 'FP-M3386M', 'Mapenzi', 'Mirango', 'Matheless', 103, '3', 'Masculin', NULL, '0851750227', 'mapenzi.mirango@panzi.org', NULL, 'BUKAVU', '2023-12-20', NULL, 'BKV', 'RDC', 'SUD KIVU', 'I', 1, '2023-12-09 11:18:28', '2023-12-09 11:18:28'),
(3406, '2345', 'FP-M8754M', 'Musarasa', 'Mukanire', 'Pascal', 200, '3', 'Masculin', NULL, '0851750226', 'pascal.mukanire@panzi.org', NULL, 'BUKAVU', '2023-12-06', NULL, 'BKV', 'RDC', 'SUD KIVU', 'J', 1, '2023-12-09 11:20:17', '2023-12-09 11:20:17'),
(3407, '2345', 'FP-N3507B', 'Nabintu', 'Birindwa', 'Julie', 101, '3', 'Feminin', NULL, '098765423', 'julie.birindwa@panzi.org', NULL, 'BUKAVU', '2023-11-27', NULL, 'Bkv', 'RDC', 'SUD KIVU', 'tf', 1, '2023-12-09 13:50:25', '2023-12-09 13:50:25'),
(3408, '2345', 'FP-A4623B', 'Anuarite', 'Buhendwa', 'Anuarite', 102, '1', 'Feminin', NULL, '098765434', 'anuarite.buhendwa@panzi.org', NULL, 'BUKAVU', '2023-10-04', NULL, 'BKV', 'RDC', 'South Kivu', 'J', 1, '2023-12-09 20:01:22', '2023-12-09 20:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `agent_missions`
--

CREATE TABLE `agent_missions` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ms` bigint UNSIGNED NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `reference`, `signature`, `product`, `marque`, `model`, `description`, `unite`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ART-T12345943712L', 2345, 1, 'Lenovo', 'Thinkpad Carbon X1', 'I5 16GB RAM 500 SSD', 'pièce', 1, '2023-12-09 12:17:44', '2023-12-09 12:17:44'),
(2, 'ART-P12345325274H', 2345, 1, 'HP', 'Probook 650', 'I3 8GB RAM', 'pièce', 1, '2023-12-09 12:19:03', '2023-12-09 12:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `bailleurs`
--

CREATE TABLE `bailleurs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min1` double(25,2) NOT NULL,
  `min2` double(25,2) NOT NULL,
  `min3` double(25,2) NOT NULL,
  `max1` double(25,2) NOT NULL,
  `max2` double(25,2) NOT NULL,
  `max3` double(25,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bailleurs`
--

INSERT INTO `bailleurs` (`id`, `reference`, `signature`, `name`, `phone`, `email`, `min1`, `min2`, `min3`, `max1`, `max2`, `max3`, `active`, `created_at`, `updated_at`) VALUES
(1, 'BLL-F2345184606Fo', 2345, 'Fondation Panzi RDC', '0851750338', 'info@panzi.org', 1.00, 1001.00, 5001.00, 1000.00, 5000.00, 2000.00, 1, '2023-12-09 11:21:35', '2023-12-09 11:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `bcs`
--

CREATE TABLE `bcs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `da` bigint UNSIGNED NOT NULL,
  `personne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bcs`
--

INSERT INTO `bcs` (`id`, `reference`, `signature`, `da`, `personne`, `lieu`, `delai`, `comment`, `niv1`, `niv2`, `active`, `created_at`, `updated_at`) VALUES
(1, 'BC-841095-FP235', 2348, 1, 'LARAVAZ', 'FONDATION PANZI', '7JOURS', 'RAS', 1, 1, 1, '2023-12-09 13:16:09', '2023-12-09 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `bes`
--

CREATE TABLE `bes` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `montant` double(20,2) NOT NULL,
  `montantTL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bps`
--

CREATE TABLE `bps` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `beneficiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(20,2) NOT NULL,
  `montantTL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateP` date NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `niv3` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bps`
--

INSERT INTO `bps` (`id`, `reference`, `signature`, `bc`, `projet`, `beneficiaire`, `type`, `montant`, `montantTL`, `categorie`, `dateP`, `comment`, `niv1`, `niv2`, `niv3`, `active`, `created_at`, `updated_at`) VALUES
(1, 'BP-2384874-FP1638', 2356, '1', 2, '3', '3', 8350.00, 'Huit mille Trois Cents Cinquante dollas', '2', '2023-12-09', 'Payement achet fourniture de bureau', 1, 1, 1, 1, '2023-12-09 13:24:00', '2023-12-09 13:28:48'),
(2, 'BP-5512573-FP2181', 2356, '2', 2, '1', '2', 500.00, 'Cinq Cent dollars', '5', '2023-12-09', 'Appro Caisse', 1, 1, 1, 1, '2023-12-09 13:53:46', '2023-12-09 14:16:48'),
(3, 'BP-3947707-FP1774', 2356, '1', 2, '2355', '1', 250.00, 'Deux cent Cinquante dollars', '3', '2023-12-09', 'Mission', 1, 1, 1, 1, '2023-12-09 15:04:36', '2023-12-09 15:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `brs`
--

CREATE TABLE `brs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `bc` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `fournisseur` bigint UNSIGNED NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bordereau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brs`
--

INSERT INTO `brs` (`id`, `reference`, `signature`, `bc`, `projet`, `fournisseur`, `lieu`, `personne`, `bordereau`, `etat`, `comment`, `niv1`, `active`, `created_at`, `updated_at`) VALUES
(1, 'BR-71361-FP429', 2347, 1, 2, 3, 'FONDATION PANZI', 'Xmen', 'BL54356', 'Partiel', 'Livraison Partielle', 0, 1, '2023-12-09 13:20:16', '2023-12-09 13:20:16'),
(2, 'BR-21226-FP467', 2347, 1, 2, 3, 'FONDATION PANZI', 'Xmen', 'BL54356', 'Totale', 'RAS', 0, 1, '2023-12-09 13:22:06', '2023-12-09 13:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `br_oders`
--

CREATE TABLE `br_oders` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `br` bigint UNSIGNED NOT NULL,
  `bc` bigint UNSIGNED NOT NULL,
  `produit` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `br_oders`
--

INSERT INTO `br_oders` (`id`, `reference`, `br`, `bc`, `produit`, `quantite`, `observation`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ODR-BR-32009-FP408', 1, 1, 2, 4, 'RAS', 1, '2023-12-09 13:20:16', '2023-12-09 13:20:16'),
(2, 'ODR-BR-46578-FP414', 1, 1, 1, 2, 'RAS', 1, '2023-12-09 13:20:16', '2023-12-09 13:20:16'),
(3, 'ODR-BR-71037-FP530', 2, 1, 2, 1, 'RAS', 1, '2023-12-09 13:22:06', '2023-12-09 13:22:06'),
(4, 'ODR-BR-34526-FP946', 2, 1, 1, 1, 'RAS', 1, '2023-12-09 13:22:06', '2023-12-09 13:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `reference`, `signature`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CAT-A2345781376', 2345, 'Accesoire informatique', 'ras', 1, '2023-12-09 12:14:24', '2023-12-09 12:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `cheques`
--

CREATE TABLE `cheques` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `bp` bigint UNSIGNED NOT NULL,
  `beneficiare` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(20,2) NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cheques`
--

INSERT INTO `cheques` (`id`, `reference`, `agent`, `projet`, `bp`, `beneficiare`, `numero`, `lieu`, `montant`, `motif`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CQ-283440-FP986', 2356, 2, 2, 'Caisse projet', '2345', 'BUKAVU', 500.00, 'Appro Caisse', 1, '2023-12-09 14:18:05', '2023-12-09 15:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proprietaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` double(20,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id`, `reference`, `signature`, `intitule`, `numero`, `type`, `proprietaire`, `banque`, `adresse`, `solde`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CMPT-1235965-FP949', 2356, 'Fondation Panzi/Maison Dorcas', '1626253373837363', '1', '2', 'TMB', 'Bukavu', 0.00, 1, '2023-12-09 13:30:49', '2023-12-09 13:30:49'),
(2, 'CMPT-3426513-FP917', 2356, 'papeterie THB', '2345567889', '3', '3', 'TMB', 'Bukavu', 0.00, 1, '2023-12-09 13:34:02', '2023-12-09 13:34:02'),
(3, 'CMPT-3464755-FP295', 2348, 'Hosana Ets', '88776654433', '3', '1', 'TMB', 'Bukavu', 0.00, 1, '2023-12-09 13:38:49', '2023-12-09 13:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `conges`
--

CREATE TABLE `conges` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `dure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contrats`
--

CREATE TABLE `contrats` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `salaire` double(20,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contrats`
--

INSERT INTO `contrats` (`id`, `reference`, `signature`, `agent`, `projet`, `type`, `debut`, `fin`, `salaire`, `description`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CTR-12711-FP532', 2345, 3406, 2, 'CDD', '2023-01-01', '2023-12-31', 2470.00, 'RAS', 1, 1, '2023-12-09 11:39:23', '2023-12-09 11:39:23'),
(2, 'CTR-99675-FP214', 2345, 3405, 1, 'CDD', '2023-01-01', '2023-12-31', 750.00, 'RAS', 1, 1, '2023-12-09 11:40:27', '2023-12-09 11:40:27'),
(3, 'CTR-25698-FP917', 2345, 3404, 3, 'CDD', '2023-01-01', '2023-12-31', 2000.00, 'RAS', 1, 1, '2023-12-09 11:49:30', '2023-12-09 11:49:30'),
(4, 'CTR-79298-FP706', 2345, 3403, 3, 'CDD', '2023-01-01', '2023-12-31', 800.00, 'RAS', 1, 1, '2023-12-09 11:52:24', '2023-12-09 11:52:24'),
(5, 'CTR-94904-FP173', 2345, 3402, 3, 'CDD', '2023-01-01', '2023-12-31', 4500.00, 'RAS', 1, 1, '2023-12-09 11:53:40', '2023-12-09 11:53:40'),
(6, 'CTR-87857-FP977', 2345, 3401, 3, 'CDD', '2023-01-01', '2023-12-31', 2400.00, 'RAS', 1, 1, '2023-12-09 11:55:04', '2023-12-09 11:55:04'),
(7, 'CTR-63769-FP436', 2345, 3400, 3, 'CDD', '2023-01-01', '2023-12-31', 6000.00, NULL, 1, 1, '2023-12-09 11:56:19', '2023-12-09 11:56:19'),
(8, 'CTR-37277-FP331', 2345, 3399, 3, 'CDD', '2023-01-01', '2023-12-30', 3000.00, NULL, 1, 1, '2023-12-09 11:57:08', '2023-12-09 11:57:08'),
(9, 'CTR-43502-FP706', 2345, 3398, 2, 'CDD', '2023-01-01', '2023-12-31', 2000.00, NULL, 1, 1, '2023-12-09 11:58:00', '2023-12-09 11:58:00'),
(10, 'CTR-23059-FP153', 2345, 3397, 2, 'CDD', '2023-01-01', '2023-12-31', 1200.00, NULL, 1, 1, '2023-12-09 11:58:52', '2023-12-09 11:58:52'),
(11, 'CTR-70431-FP351', 2345, 3396, 3, 'CDD', '2023-01-01', '2023-12-31', 1500.00, NULL, 1, 1, '2023-12-09 11:59:50', '2023-12-09 11:59:50'),
(12, 'CTR-62084-FP166', 2345, 3395, 3, 'CDD', '2023-01-01', '2023-12-31', 1200.00, NULL, 1, 1, '2023-12-09 12:01:08', '2023-12-09 12:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` bigint UNSIGNED NOT NULL,
  `from` bigint UNSIGNED NOT NULL,
  `to` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `decharges`
--

CREATE TABLE `decharges` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `bp` bigint UNSIGNED NOT NULL,
  `beneficiare` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(20,2) NOT NULL,
  `montantTL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `decharges`
--

INSERT INTO `decharges` (`id`, `reference`, `signature`, `projet`, `bp`, `beneficiare`, `qualite`, `piece`, `phone`, `institution`, `montant`, `montantTL`, `motif`, `active`, `created_at`, `updated_at`) VALUES
(6, 'DCG-844534-FP504', 2358, 2, 3, 'Justin Bulalo', 'Apprentissage', '51416', '097653467', 'Fondation Panzi', 250.00, 'Deux cent Cinquante dollars', 'Mission Supervision', 1, '2023-12-09 15:14:18', '2023-12-09 15:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `dem_aches`
--

CREATE TABLE `dem_aches` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `eb` bigint UNSIGNED NOT NULL,
  `amount` double(20,2) NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `niv3` tinyint(1) NOT NULL DEFAULT '0',
  `niv4` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dem_aches`
--

INSERT INTO `dem_aches` (`id`, `reference`, `signature`, `eb`, `amount`, `motif`, `comment`, `niv1`, `niv2`, `niv3`, `niv4`, `active`, `created_at`, `updated_at`) VALUES
(1, 'DA-79973-FP427', 2349, 1, 1.00, 'Appui fonctionnement du bureau', 'Ras', 1, 1, 1, 1, 1, '2023-12-09 13:04:30', '2023-12-09 13:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `dis`
--

CREATE TABLE `dis` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `di_oders`
--

CREATE TABLE `di_oders` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `di` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `et_bes`
--

CREATE TABLE `et_bes` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `categorie` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `niv3` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `et_bes`
--

INSERT INTO `et_bes` (`id`, `reference`, `agent`, `projet`, `categorie`, `comment`, `niv1`, `niv2`, `niv3`, `active`, `created_at`, `updated_at`) VALUES
(1, 'EB-58279-FP998', 2355, 2, 1, 'RAS', 1, 1, 0, 1, '2023-12-09 12:25:56', '2023-12-09 13:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `catProduct` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `reference`, `signature`, `catProduct`, `name`, `adresse`, `email`, `phone`, `tva`, `secteur`, `type`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'FRN-H12348200224Ho', 2348, 1, 'Hosana', 'BKV', 'hs@gmail.com', '098745427', NULL, 'Fournisseurs commerciaux', 'Revete/distribution/fourniture de services', 'RAS', 1, '2023-12-09 13:10:14', '2023-12-09 13:10:14'),
(2, 'FRN-O12348116196Om', 2348, 1, 'Oman', 'BKV', 'om@gmail.com', '097546763', NULL, 'Fournisseurs commerciaux', 'Revete/distribution/fourniture de services', 'RAS', 1, '2023-12-09 13:10:44', '2023-12-09 13:10:44'),
(3, 'FRN-T12348999876TH', 2348, 1, 'THB', 'Bkv', 'thb@gmail.com', '0987563464', NULL, 'Fournisseurs commerciaux', 'Revete/distribution/fourniture de services', 'RAS', 1, '2023-12-09 13:11:28', '2023-12-09 13:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `fourn_prices`
--

CREATE TABLE `fourn_prices` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `fournisseur` bigint UNSIGNED NOT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lignes`
--

CREATE TABLE `lignes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `libele` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lignes`
--

INSERT INTO `lignes` (`id`, `code`, `niveau`, `parent`, `libele`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '0', '  COUTS DIRECTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(2, '2', '1', '0', '  COUTS INDIRECTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(3, '11', '2', '1', '   PILIER MEDICAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(4, '12', '2', '1', '   PILIER PSYCHOSOCIAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(5, '13', '2', '1', '   PILIER LEGAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(6, '14', '2', '1', '   PILIER REINSERTION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(7, '15', '2', '1', '   PILIER TRANSVERSAL PLAIDOYER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(8, '16', '2', '1', '   PILIER TRANSVERSAL RECHERCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(9, '21', '2', '2', '   CHARGE DU PERSONNEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(10, '22', '2', '2', '   MISSIONS ET VOYAGES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(11, '23', '2', '2', '   PARC ET CHARROI AUTOMOBILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(12, '24', '2', '2', '   FRAIS ADMINISTARTIFS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(13, '25', '2', '2', '   FRAIS D\'ENTREPRISE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(14, '26', '2', '2', '   BATIMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(15, '1101', '3', '11', '    PRISE EN CHARGE DES SVS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(16, '1102', '3', '11', '    PRISE EN CHARGE DES PROLAPSUS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(17, '1103', '3', '11', '    PRISE EN CHARGE DES FISTULES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(18, '1104', '3', '11', '    FORMATIONS ET RECYCLAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(19, '1105', '3', '11', '    REPARATION EN OUTREACH', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(20, '1106', '3', '11', '    AUTRES PATHOLOGIES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(21, '1107', '3', '11', '    CLINIQUE MOBILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(22, '1108', '3', '11', '    CONSTRUCTION ET REHABILITATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(23, '1109', '3', '11', '    EPIDEMIES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(24, '1110', '3', '11', '    APPUI AUX STRUCTURES PARTENAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(25, '1111', '3', '11', '    REMUNERATION STAFF PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(26, '1201', '3', '12', '    PRISE EN CHARGE PSYCHOSOCIALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(27, '1202', '3', '12', '    MISSION D\'ACCOMPAGNEMENT, SUIVI ET SUPPERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(28, '1203', '3', '12', '    FORMATIONS ET RECYCLAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(29, '1204', '3', '12', '    AIRE DES JEUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(30, '1205', '3', '12', '    MUSICOTHERAPIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(31, '1206', '3', '12', '    REMUNERATION STAFF PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(32, '1301', '3', '13', '    SUIVI JURIDIQUE ET JUDICIAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(33, '1302', '3', '13', '    AUDIENCE FORAINE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(34, '1303', '3', '13', '    ACTIVITES PRE AUDIENCE FORAINE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(35, '1304', '3', '13', '    FORMATIONS ET RECYCLAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(36, '1305', '3', '13', '    MEDIATION ET CONCILIATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(37, '1306', '3', '13', '    REMUNERATION STAFF PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(38, '1401', '3', '14', '    FORMATION ET RECYCLAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(39, '1402', '3', '14', '    SUPERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(40, '1403', '3', '14', '    SUIVI', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(41, '1404', '3', '14', '    FORMATION DE BENEFICIAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(42, '1405', '3', '14', '    PRISE EN CHARGE DE CENTRE NOBELA,VSLA,MUSO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(43, '1406', '3', '14', '    ACTIVITES AGRO PASTORALES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(44, '1407', '3', '14', '    TRANSFORMATION AGRO ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(45, '1408', '3', '14', '    CONSTRUCTION ET REHABILITATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(46, '1409', '3', '14', '    KITS DE REINSERTION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(47, '1410', '3', '14', '    HEBERGEMENT ET CENTRE DE TRANSIT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(48, '1411', '3', '14', '    SCOLARISATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(49, '1412', '3', '14', '    REPARATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(50, '1413', '3', '14', '    REUNION ET ATELIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(51, '1414', '3', '14', '    REMUNERATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(52, '1501', '3', '15', '    REUNION ET ATELIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(53, '1502', '3', '15', '    SENSIBILISATION ORDINAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(54, '1503', '3', '15', '    FORMATIONS ET RECYCLAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(55, '1504', '3', '15', '    MEDIATISATION ET VISIBILITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(56, '1505', '3', '15', '    SUPPORTS DE SENSIBILISATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(57, '1506', '3', '15', '    EVENEMENTS ET GRANDES MANIFESTATIONS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(58, '1507', '3', '15', '    REMUNERATION STAFF PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(59, '1601', '3', '16', '    ENQUETES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(60, '1602', '3', '16', '    ETUDE DE BASE ET DU MARCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(61, '1603', '3', '16', '    RECHERCHE A POSTERIORI', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(62, '1604', '3', '16', '    PUBLICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(63, '1605', '3', '16', '    REMUNERATION STAFF PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(64, '2101', '3', '21', '    REMUNERATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(65, '2102', '3', '21', '    SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(66, '2103', '3', '21', '    IMPOTS ET TAXES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(67, '2104', '3', '21', '    GRATIFICATIONS ET PRIMES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(68, '2105', '3', '21', '    FORMATION DU PERSONNEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(69, '2201', '3', '22', '    MISSIONS ET VOYAGES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(70, '2301', '3', '23', '    VEHICULES ET MOTOS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(71, '2401', '3', '24', '    FRAIS COMMUNICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(72, '2402', '3', '24', '    SERVICES INFORMATIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(73, '2403', '3', '24', '    PUBLICITE ET MEDIA', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(74, '2404', '3', '24', '    ASSISTANCE SOCIALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(75, '2405', '3', '24', '    VISITES ET EVENEMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(76, '2406', '3', '24', '    AUTRES EQUIPEMENT ET MATERIELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(77, '2407', '3', '24', '    FRAIS DE SECURITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(78, '2408', '3', '24', '    FRAIS D\'EXEPEDITION COURIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(79, '2409', '3', '24', '    FOURNITURES DE BUREAU', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(80, '2410', '3', '24', '    FRAIS DE SUPERVISION ORGANISATIONS PUBLIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(81, '2411', '3', '24', '    FRAIS INSTITUTIONNEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(82, '2412', '3', '24', '    IMPREVU', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(83, '2501', '3', '25', '    CONSULTANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(84, '2502', '3', '25', '    PENALITES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(85, '2503', '3', '25', '    FRAIS BANCAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(86, '2504', '3', '25', '    AUDIT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(87, '2505', '3', '25', '    FRAIS LEGAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(88, '2506', '3', '25', '    ASSURANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(89, '2601', '3', '26', '    ENTRETEIN BATIMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(90, '2602', '3', '26', '    CANTONAGE ET ENTRETIEN ROUTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(91, '2603', '3', '26', '    ENTRETIEN ESPACE ET JARDINAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(92, '2604', '3', '26', '    GENERATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(93, '110101', '4', '1101', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(94, '110102', '4', '1101', '     FORFAIT PATHOLOGIES ASSOCIEES ET SOINS DES ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(95, '110103', '4', '1101', '     EXAMENS LABO,ANALYSE ET EXAMENS PARACLINIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(96, '110104', '4', '1101', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(97, '110105', '4', '1101', '     AIDE ALIMENTAIRE ACCOMPANGANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(98, '110106', '4', '1101', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(99, '110107', '4', '1101', '     NETTOYAGE MAISON D\'ATTENTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(100, '110108', '4', '1101', '     FRAIS DE TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(101, '110109', '4', '1101', '     FRAIS DE TRANSP DES ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(102, '110110', '4', '1101', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(103, '110201', '4', '1102', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(104, '110202', '4', '1102', '     FORFAIT PATHOLOGIES ASSOCIEES ET SOINS DES ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(105, '110203', '4', '1102', '     EXAMENS LABO,ANALYSE ET EXAMENS PARACLINIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(106, '110204', '4', '1102', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(107, '110205', '4', '1102', '     AIDE ALIMENTAIRE ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(108, '110206', '4', '1102', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(109, '110207', '4', '1102', '     FRAIS DE TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(110, '110208', '4', '1102', '     FRAIS DE TRANSPORT DES ACCOMPAGNANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(111, '110209', '4', '1102', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(112, '110301', '4', '1103', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(113, '110302', '4', '1103', '     FORFAIT PATHOLOGIES ASSOCIEES ET SOINS DES ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(114, '110303', '4', '1103', '     EXAMENS LABO,ANALYSE ET EXAMENS PARACLINIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(115, '110304', '4', '1103', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(116, '110305', '4', '1103', '     AIDE ALIMENTAIRE ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(117, '110306', '4', '1103', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(118, '110307', '4', '1103', '     FRAIS DE TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(119, '110308', '4', '1103', '     FRAIS DE TRANSPORT DES ACCOMPAGNANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(120, '110309', '4', '1103', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(121, '110401', '4', '1104', '     HONORAIRES ET PRIMES FORMATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(122, '110402', '4', '1104', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(123, '110403', '4', '1104', '     FRAIS TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(124, '110404', '4', '1104', '     FRAIS DE LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(125, '110405', '4', '1104', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(126, '110406', '4', '1104', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(127, '110407', '4', '1104', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(128, '110501', '4', '1105', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(129, '110502', '4', '1105', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(130, '110503', '4', '1105', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(131, '110504', '4', '1105', '     FRAIS DE TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(132, '110505', '4', '1105', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(133, '110506', '4', '1105', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(134, '110507', '4', '1105', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(135, '110508', '4', '1105', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(136, '110509', '4', '1105', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(137, '110601', '4', '1106', '     ACHAT MEDICAMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(138, '110602', '4', '1106', '     MATERIELS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(139, '110603', '4', '1106', '     FORFAIT SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(140, '110604', '4', '1106', '     FORFAIT PATHOLOGIES ASSOCIEES ET SOINS DES ACCOMP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(141, '110605', '4', '1106', '     EXAMENS LABO,ANALYSE ET EXAMENS PARACLINIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(142, '110606', '4', '1106', '     AIDE ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(143, '110607', '4', '1106', '     AIDE ALIMENTAIRE ACCOMPANGANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(144, '110608', '4', '1106', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(145, '110609', '4', '1106', '     FRAIS DE TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(146, '110701', '4', '1107', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(147, '110702', '4', '1107', '     FRAIS TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(148, '110703', '4', '1107', '     MEDICAMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(149, '110704', '4', '1107', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(150, '110705', '4', '1107', '     MATERIELS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(151, '110706', '4', '1107', '     FRAIS D\'ENTREPOSAGE ET MANUTENTION MEDICAMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(152, '110707', '4', '1107', '     SOINS MEDICAUX DES MALADES REFERES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(153, '110708', '4', '1107', '     APPUIS DIVERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(154, '110709', '4', '1107', '     SUPERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(155, '110710', '4', '1107', '     KIT D\'HYGIENE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(156, '110801', '4', '1108', '     CONSTRUCTION ET REHABILITATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(157, '110901', '4', '1109', '     COVID', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(158, '110902', '4', '1109', '     EBOLA', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(159, '110903', '4', '1109', '     HEPATITE B', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(160, '110904', '4', '1109', '     COLERA', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(161, '110905', '4', '1109', '     FIEVRE JAUNE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(162, '110906', '4', '1109', '     AUTRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(163, '111001', '4', '1110', '     APPUI AU  FONCTIONNEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(164, '111002', '4', '1110', '     APPUI A L\'EQUIPEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(165, '111003', '4', '1110', '     AUTRES APPUIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(166, '111101', '4', '1111', '     SUPERVISEUR MEDICAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(167, '111102', '4', '1111', '     DES INFIRMIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(168, '111103', '4', '1111', '     ANESTHESISTES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(169, '111104', '4', '1111', '     MEDECIN SPECIALISTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(170, '111105', '4', '1111', '     MEDECIN GENERALISTES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(171, '111106', '4', '1111', '     ASSISTANTS CHIRURGIENS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(172, '111107', '4', '1111', '     PHARMACIEN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(173, '111108', '4', '1111', '     TECHNICIEN DE LABO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(174, '111109', '4', '1111', '     HYGIENISTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(175, '111110', '4', '1111', '     POINT FOCAL CLINIQUE MOBILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(176, '111111', '4', '1111', '     AUTRES CHARGES LIEES A LA REM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(177, '120101', '4', '1201', '     PEC PSYCHO  INDIVIDUELLE DES CAS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(178, '120102', '4', '1201', '     COUT D\'INTERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(179, '120103', '4', '1201', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(180, '120201', '4', '1202', '     COORDINATION PILIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(181, '120202', '4', '1202', '     PLURIDISCILINAIRES DE SUVI DES CAS INDIVIDUELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(182, '120203', '4', '1202', '     AUTRES ASSISTANCE PYSCHOSOCIAL AUX MALADES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(183, '120204', '4', '1202', '     VISITE DE SUIVI A DOMICILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(184, '120205', '4', '1202', '     ACTIVITE D\'ERGOTHERAPIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(185, '120206', '4', '1202', '     SORTIE RECREATIVE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(186, '120207', '4', '1202', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(187, '120301', '4', '1203', '     HONORAIRES ET PRIMES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(188, '120302', '4', '1203', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(189, '120303', '4', '1203', '     FRAIS TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(190, '120304', '4', '1203', '     FRAIS DE LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(191, '120305', '4', '1203', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(192, '120306', '4', '1203', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(193, '120307', '4', '1203', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(194, '120308', '4', '1203', '     AUTRE FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(195, '120401', '4', '1204', '     ALIMENTATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(196, '120402', '4', '1204', '     KIT D\'HYGIEN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(197, '120403', '4', '1204', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(198, '120404', '4', '1204', '     EQUIPEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(199, '120405', '4', '1204', '     ENTRETIEN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(200, '120406', '4', '1204', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(201, '120501', '4', '1205', '     MUSICOTHERAPIE ET THERAPIE DE MASSE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(202, '120502', '4', '1205', '     ACHAT ET INSTALLATION STUDIO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(203, '120503', '4', '1205', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(204, '120504', '4', '1205', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(205, '120505', '4', '1205', '     CONCERT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(206, '120506', '4', '1205', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(207, '120601', '4', '1206', '     PSYCHOLOGUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(208, '120602', '4', '1206', '     ASISTANTE PSYCHOSOCIALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(209, '120603', '4', '1206', '     ENSEIGNANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(210, '120604', '4', '1206', '     ENCADREUSES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(211, '120605', '4', '1206', '     CHARGE DE LA PROTECTION DE L\'ENFANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(212, '120606', '4', '1206', '     ART THERAPEUTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(213, '120607', '4', '1206', '     REMUNERATION PHYSIOTHERAPEUTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(214, '120608', '4', '1206', '     HONORAIRES CONSULTANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(215, '130101', '4', '1301', '     ASSURER LE SUIVI DES NOUVEAUX DOSSIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(216, '130102', '4', '1301', '     ASSURER LE SUIVI DES ANCIENS DOSSIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(217, '130103', '4', '1301', '     SUIVI JUDICIAIRE DES CAS COMPLIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(218, '130104', '4', '1301', '     SUIVI  A DOMICILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(219, '130105', '4', '1301', '     PRISE EN CHARGES DES  SURVIVANTS, TEMOINS, ACC/PROC ORDINAIR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(220, '130201', '4', '1302', '     FRAIS LEGAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(221, '130202', '4', '1302', '     FRAIS D\'OBTENTION GROSSE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(222, '130203', '4', '1302', '     FRAIS DE SIGNIFICATION DE JUGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(223, '130204', '4', '1302', '     FRAIS DE CONSITUTION PARTIE CIVILE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(224, '130205', '4', '1302', '     FRAIS DE PRISE EN CHARGE VICTIME ET LEUR DEPENDANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(225, '130206', '4', '1302', '     FRAIS DE PRISE EN CHARGE DES TEMOINS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(226, '130207', '4', '1302', '     FRAIS DE HUISSARIAT ET LEVE COPIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(227, '130208', '4', '1302', '     PRISE EN CHARGES DES JUGES ET MAGISTRATS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(228, '130209', '4', '1302', '     PRISE EN CHARGE GREFFIERS ET HUISSIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(229, '130210', '4', '1302', '     PRISE EN CHARGE POLICIER ET ESCORTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(230, '130211', '4', '1302', '     PRISE EN CHARGE DES PREVENUS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(231, '130212', '4', '1302', '     PRISE EN CHARGE INTERPRETES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(232, '130213', '4', '1302', '     APPUI LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(233, '130214', '4', '1302', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(234, '130301', '4', '1303', '     ACTIVITES PRE-FORAINE : SENSIBILISATION DE MASSE e FOURNITUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(235, '130302', '4', '1303', '     PRISE EN CHARGE DES SURVIVANTS ,TEMOINS, ACC/ AUDIENC FORAIN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(236, '130303', '4', '1303', '     ACTIVITES PRE-FORAINES:SENSIBILISATION CAS COMPLIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(237, '130304', '4', '1303', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(238, '130401', '4', '1304', '     HONORAIRES ET PRIMES FORMATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(239, '130402', '4', '1304', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(240, '130403', '4', '1304', '     FRAIS TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(241, '130404', '4', '1304', '     FRAIS DE LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(242, '130405', '4', '1304', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(243, '130406', '4', '1304', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(244, '130407', '4', '1304', '     LOCATION SALLE DE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(245, '130408', '4', '1304', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(246, '130501', '4', '1305', '     MEDIATION ET CONCILIATION DES CAS AUTRES QUES LES VIOL SEX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(247, '130601', '4', '1306', '     HONORAIRE AVOCAT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(248, '130602', '4', '1306', '     HOINORAIRE PARAJURISTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(249, '130603', '4', '1306', '     HONORAIRE DEFENSEUR JUDICIAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(250, '130604', '4', '1306', '     HONORAIRE CONSULTANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(251, '140101', '4', '1401', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(252, '140102', '4', '1401', '     OUTILS ET MATERIELS DE FORMATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(253, '140103', '4', '1401', '     PRIME FORMATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(254, '140104', '4', '1401', '     CEREMONIE DE CLOTURE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(255, '140105', '4', '1401', '     RESTAURATION DES PARTICIPANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(256, '140106', '4', '1401', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(257, '140107', '4', '1401', '     LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(258, '140108', '4', '1401', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(259, '140201', '4', '1402', '     SUPERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(260, '140202', '4', '1402', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(261, '140203', '4', '1402', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(262, '140301', '4', '1403', '     SUIVI', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(263, '140302', '4', '1403', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(264, '140303', '4', '1403', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(265, '140401', '4', '1404', '     INTRANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(266, '140402', '4', '1404', '     EQUIPEMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(267, '140403', '4', '1404', '     CEREMONIE DE CLOTURE ET REMISE DES BREVETS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(268, '140404', '4', '1404', '     ENTRETIEN DES EQUIPEMENTS DE FORMATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(269, '140405', '4', '1404', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(270, '140501', '4', '1405', '     MISE EN PLACE DES CENTRES NOBELA, VSLA, MUSO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(271, '140502', '4', '1405', '     APPUI CENTRE NOBELA, VSLA, MUSO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(272, '140503', '4', '1405', '     APPUI COMMUNAUTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(273, '140504', '4', '1405', '     RENFORCEMENT DE CAPACITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(274, '140601', '4', '1406', '     TECHNIQUES CULTURALES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(275, '140602', '4', '1406', '     ENTRETIEN DES CHAMPS DE DEMONSTRATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(276, '140603', '4', '1406', '     DISTRIBUTION DES SEMENCES ET PLANTULES DANS LES CHAMPS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(277, '140604', '4', '1406', '     ACTIVITES DANS LE CHAMPS DES BENEFICIAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(278, '140605', '4', '1406', '     RECOLTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(279, '140606', '4', '1406', '     CULTURE FOURAGEE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(280, '140607', '4', '1406', '     ACQUISITION ET LOCATION CHAMPS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(281, '140608', '4', '1406', '     SEMENCES POUR LES CHAMPS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(282, '140609', '4', '1406', '     ACQUISITION PROUITS PHYTO SANITAIRES, ZOOTECHNIQUES ET GENIT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(283, '140701', '4', '1407', '     TRANSFORMATION ALIMENTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(284, '140702', '4', '1407', '     ACHAT FRUITS ET AUTRES PRODUITS TRANSFORMATION AGRO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(285, '140703', '4', '1407', '     ACHAT MOULIN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(286, '140704', '4', '1407', '     ACHAT AUTRES MATIERES PREMIERES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(287, '140705', '4', '1407', '     ACHAT AUTRES EQUIPEMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(288, '140801', '4', '1408', '     AMENAGEMENT ESPACE POUR ELEVAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(289, '140802', '4', '1408', '     CONSTRUCTION  ARTISANALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(290, '140803', '4', '1408', '     ATELIER DE MENUISERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(291, '140804', '4', '1408', '     ABRIS POUR LES BENEFICIAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(292, '140805', '4', '1408', '     CONSTRUCTION HANGAR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(293, '140806', '4', '1408', '     CONSTRUCTION CENTRES SOCIAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(294, '140807', '4', '1408', '     AUTRES CONSTRUCTION ET AMENAGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(295, '140901', '4', '1409', '     KITS ET MATERIEL DE REINSERTION PROFESSIONNELS INDIVIDUELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(296, '140902', '4', '1409', '     KITS COLLECTIFS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(297, '141001', '4', '1410', '     RESTAURATION DES BENEFICIAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(298, '141002', '4', '1410', '     KITS D\'HYGIENES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(299, '141003', '4', '1410', '     TRANSPORT BENEFICIAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(300, '141101', '4', '1411', '     KIT ET FOURNITURES SCOLAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(301, '141102', '4', '1411', '     FRAIS SCOLAIRES ET ACADEMIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(302, '141103', '4', '1411', '     ACTIVITES INTER SCOLAIRES PARASCOLAIRES ET EXTRASCOLAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(303, '141104', '4', '1411', '     PRISE EN CHARGE DES BOURSIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(304, '141201', '4', '1412', '     INDIVIDUELLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(305, '141202', '4', '1412', '     COLLECTIVE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(306, '141203', '4', '1412', '     ASSISTANCE TECHNIQUE FONDS DE REPARATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(307, '141301', '4', '1413', '     INTERVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(308, '141302', '4', '1413', '     VALIDATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(309, '141401', '4', '1414', '     FORMATEUR EN INFORMATIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(310, '141402', '4', '1414', '     FORMATEUR EN METIERSPROFESSIONNELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(311, '141403', '4', '1414', '     FORMATEUR EN BIJOUTERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(312, '141404', '4', '1414', '     FORMATEUR EN ALPHABETISATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(313, '141405', '4', '1414', '     FORMATEUR EN VANNERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(314, '141406', '4', '1414', '     FORMATEUR EN MENUISERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(315, '141407', '4', '1414', '     FORMATEUR EN COUPE ET COUTURE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(316, '141408', '4', '1414', '     FORMATEUR EN SAPONIFICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(317, '141409', '4', '1414', '     FORMATEUR EN BRODERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(318, '141410', '4', '1414', '     FORMATEUR EN PATISSERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(319, '141411', '4', '1414', '     FORMATEUR EN ART CULINAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(320, '141412', '4', '1414', '     AUTRES FORMATEURS EN METIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(321, '141413', '4', '1414', '     CUISINIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(322, '141414', '4', '1414', '     ANIMATEURS DE MUSO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(323, '141415', '4', '1414', '     RESPONSABLE VOLET APPUI AUX OBC ET ONG LOCALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(324, '141416', '4', '1414', '     RESPONSABLE VOLET APPUI AUX AVEC', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(325, '141417', '4', '1414', '     SUPERVISEUR POINTS FOCAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(326, '141418', '4', '1414', '     SUPERVISEUR OBC', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(327, '141419', '4', '1414', '     SUPERVISEUR EMAP', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(328, '141420', '4', '1414', '     ANIMATEUR AVEC', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(329, '141421', '4', '1414', '     ASSISTANT VOLET SOUTIEN AUX OBCS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(330, '141422', '4', '1414', '     ASSISTANT VOLET APPUI AUX AVECS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(331, '141423', '4', '1414', '     POINTS FOCAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(332, '141424', '4', '1414', '     ANIMATEURS TERRAINS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(333, '141425', '4', '1414', '     EXPERT EN EDUCATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(334, '141426', '4', '1414', '     ENSEIGNANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(335, '141427', '4', '1414', '     AGRONOMES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(336, '141428', '4', '1414', '     CHEF DE DEPARTEMENT FORMATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(337, '141429', '4', '1414', '     CHEF DE DEPARTEMENT HEBERGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(338, '141430', '4', '1414', '     AGENT COMMUNAUTAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(339, '141431', '4', '1414', '     ARCHITECTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(340, '141432', '4', '1414', '     VETERINAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(341, '141433', '4', '1414', '     FORMATEUR MAROQUINERIE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(342, '141434', '4', '1414', '     FORMATEUR EN ART CULINAIRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(343, '141435', '4', '1414', '     MENUISIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(344, '150101', '4', '1501', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(345, '150102', '4', '1501', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(346, '150103', '4', '1501', '     HEBERGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(347, '150104', '4', '1501', '     MATERIELS ET OUTILS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(348, '150105', '4', '1501', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(349, '150106', '4', '1501', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(350, '150201', '4', '1502', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(351, '150202', '4', '1502', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(352, '150203', '4', '1502', '     APPUI LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(353, '150204', '4', '1502', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(354, '150205', '4', '1502', '     LOCATION SALLE/ESPACE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(355, '150206', '4', '1502', '     LOGEMENT DES PARTICIPANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(356, '150207', '4', '1502', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(357, '150301', '4', '1503', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(358, '150302', '4', '1503', '     OUTILS ET MATERIELS DE FORMATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(359, '150303', '4', '1503', '     PRIME FORMATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(360, '150304', '4', '1503', '     RESTAURATION DES PARTICIPANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(361, '150305', '4', '1503', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(362, '150306', '4', '1503', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(363, '150401', '4', '1504', '     SPOT ET PUBLICITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(364, '150402', '4', '1504', '     EMISSION RADIO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(365, '150403', '4', '1504', '     EMISSION TELEVISION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(366, '150404', '4', '1504', '     AUTRES VISIBILITES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(367, '150405', '4', '1504', '     COUVERTURE MEDIATIQUE MISSION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(368, '150501', '4', '1505', '     DEVELOPPEMENT DES SUPPORTS DE SENSIBILISATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(369, '150601', '4', '1506', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(370, '150602', '4', '1506', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(371, '150603', '4', '1506', '     APPUI LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(372, '150604', '4', '1506', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(373, '150605', '4', '1506', '     LOCATION SALLE/ESPACE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(374, '150606', '4', '1506', '     LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(375, '150607', '4', '1506', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(376, '150701', '4', '1507', '     CHARGE DE SENSIBILISATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(377, '150702', '4', '1507', '     HONORAIRES CONSULTANTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(378, '160101', '4', '1601', '     IDENTIFICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(379, '160102', '4', '1601', '     AUTRES ENQUETES ET RECHERCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(380, '160201', '4', '1602', '     ETUDE DE BASE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(381, '160202', '4', '1602', '     ETUDE DU MARCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(382, '160301', '4', '1603', '     ETUDE D\'IMPACT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(383, '160302', '4', '1603', '     AUTRES RECHERCHES A POSTERIORI', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(384, '160401', '4', '1604', '     FRAIS PUBLICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(385, '160501', '4', '1605', '     CONSULTANTS CHERCHEURS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(386, '160502', '4', '1605', '     PRIME ENQUETEURS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(387, '160503', '4', '1605', '     ASSISTANT DE RECHERCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(388, '210101', '4', '2101', '     ASSISTANT PCA', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(389, '210102', '4', '2101', '     DIRECTEUR ADMINISTRATIF ET FINANCIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(390, '210103', '4', '2101', '     SECRETAIRE EXECUTIVE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(391, '210104', '4', '2101', '     DIRECTEUR DE PROGRAMME', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(392, '210105', '4', '2101', '     DIRECTEUR DE PROGRAMME ADJOINT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(393, '210106', '4', '2101', '     FOUNDRAISER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(394, '210107', '4', '2101', '     CHEF DE PILIER MEDICAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(395, '210108', '4', '2101', '     CHEF DE PILIER PSYCHOSOCIAL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(396, '210109', '4', '2101', '     CHEF DE PILIER REINSERTION SOCI ECONOMIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(397, '210110', '4', '2101', '     CHEF DE PILIER JURIDIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(398, '210111', '4', '2101', '     CONTROLEUR INTERNE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(399, '210112', '4', '2101', '     AUDITEURS INTERNES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(400, '210113', '4', '2101', '     CHEF COMPTABLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(401, '210114', '4', '2101', '     COORDINATEURS DE PROJETS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(402, '210115', '4', '2101', '     ASSISTANT COORDINATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(403, '210116', '4', '2101', '     COMPTABLES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(404, '210117', '4', '2101', '     CAISSIERES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(405, '210118', '4', '2101', '     CHARGE DE COMMUNICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(406, '210119', '4', '2101', '     CHEF DE LIAISON COMMUNICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(407, '210120', '4', '2101', '     AGENT DE COMMUNICATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(408, '210121', '4', '2101', '     EXPERT EN PLAIDOYER ET GENRE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(409, '210122', '4', '2101', '     EXPERT PLAIDOYER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(410, '210123', '4', '2101', '     DIRECTEUR LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(411, '210124', '4', '2101', '     DIRECTEUR ADJOINT LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(412, '210125', '4', '2101', '     ASSISTANT LOGISTIQUE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(413, '210126', '4', '2101', '     CHARGE DES ACHATS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(414, '210127', '4', '2101', '     CHARGE DES CHARROI', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(415, '210128', '4', '2101', '     RESPONSABLE DES RESSOURCES HUMAINES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(416, '210129', '4', '2101', '     IT MANAGER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(417, '210130', '4', '2101', '     ASSISTANT IT MANAGER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(418, '210131', '4', '2101', '     CHARGE DE SECURITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(419, '210132', '4', '2101', '     GARDE DU CORPS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(420, '210133', '4', '2101', '     CHARGE DE SUIVI ET EVALUATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(421, '210134', '4', '2101', '     EXPERT EN RECHERCHE OPERATIONNELLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(422, '210135', '4', '2101', '     ASSISTANT DE RECHERCHE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(423, '210136', '4', '2101', '     CHAUFFEURS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(424, '210137', '4', '2101', '     OFFICE MANAGER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(425, '210138', '4', '2101', '     SECRETAIRE DE DIRECTION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(426, '210139', '4', '2101', '     MAGAZINIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(427, '210140', '4', '2101', '     ASSISTANT MAGAZINIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(428, '210141', '4', '2101', '     JARDINIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(429, '210142', '4', '2101', '     MENAGERE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(430, '210143', '4', '2101', '     PLOMBIER', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(431, '210144', '4', '2101', '     CHEF DE GARDIEN', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(432, '210145', '4', '2101', '     GARDIENS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(433, '210201', '4', '2102', '     SOINS MEDICAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(434, '210301', '4', '2103', '     IMPOTS ET TAXES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(435, '210401', '4', '2104', '     GRATIFICATIONS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(436, '210402', '4', '2104', '     PRIMES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(437, '210501', '4', '2105', '     LOCATION SALLE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(438, '210502', '4', '2105', '     RESTAURATION', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(439, '210503', '4', '2105', '     LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(440, '210504', '4', '2105', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(441, '210505', '4', '2105', '     OUTILS ET MATERIELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(442, '210506', '4', '2105', '     HONORAIRE FORMATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(443, '220101', '4', '2201', '     PERDIEM', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(444, '220102', '4', '2201', '     LOGEMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(445, '220103', '4', '2201', '     TRANSPORT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(446, '220104', '4', '2201', '     AUTRES FRAIS DE VOYAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(447, '230101', '4', '2301', '     ACQUISITION VEHICULES ET MOTOS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(448, '230102', '4', '2301', '     ENTRETIEN VEHICULE ET MOTO', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(449, '230103', '4', '2301', '     CARBURANT ET LIBRIFIANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(450, '230104', '4', '2301', '     DOCUMENTS DE BORD', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(451, '230105', '4', '2301', '     ASSURANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(452, '230106', '4', '2301', '     AUTRES FRAIS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(453, '240101', '4', '2401', '     TELEPHONE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(454, '240102', '4', '2401', '     INTERNET', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(455, '240201', '4', '2402', '     LOYER SERVEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(456, '240202', '4', '2402', '     LICENCE LOGICIEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(457, '240203', '4', '2402', '     EQUIPEMENTS ET MATERIELS INFORMATIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(458, '240204', '4', '2402', '     AUTRES COUTS SERVICES INFORMATIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(459, '240301', '4', '2403', '     PUBLICITE ET MEDIA', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(460, '240401', '4', '2504', '     ASSISTANCE SOCIALE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(461, '240501', '4', '2405', '     VISITES ET EVENEMENTS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(462, '240601', '4', '2406', '     ACQUISITION AUTRES EQUIMENT ET MATERIELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(463, '240602', '4', '2406', '     ENTRETIEN AUTRES EQUIMENT ET MATERIELS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(464, '240701', '4', '2407', '     FRAIS DE SECURITE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(465, '240801', '4', '2408', '     FRAIS D\'EXEPEDITION COURIERS', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(466, '240901', '4', '2409', '     FOURNITURES DE BUREAU', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(467, '241001', '4', '2410', '     FRAIS DE SUPERVISION ORGANISATIONS PUBLIQUES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(468, '241101', '4', '2411', '     FRAIS INSTITUTIONNEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(469, '241201', '4', '2412', '     IMPREVU', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(470, '250101', '4', '2501', '     CONSULTANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(471, '250201', '4', '2502', '     PENALITES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(472, '250301', '4', '2503', '     FRAIS BANCAIRES', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(473, '250401', '4', '2504', '     EXTERNE INOPPINE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(474, '250402', '4', '2504', '     EXTERNE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(475, '250403', '4', '2504', '     INSTITUTIONNEL', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(476, '250501', '4', '2505', '     FRAIS LEGAUX', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(477, '250601', '4', '2506', '     ASSURANCE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(478, '260101', '4', '2601', '     ENTRETIEN BATIMENT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(479, '260201', '4', '2602', '     CANTONAGE ET ENTRETIEN ROUTE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(480, '260301', '4', '2603', '     ENTRETIEN ESPACE ET JARDINAGE', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(481, '260401', '4', '2604', '     CARBURANT ET LUBRIFUANT', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(482, '260402', '4', '2604', '     ENTRETIEN GENERATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00'),
(483, '260403', '4', '2604', '     ACQUISITION GENERATEUR', '2023-06-01 22:00:00', '2023-06-01 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `liste_paies`
--

CREATE TABLE `liste_paies` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `sAgent` bigint UNSIGNED NOT NULL,
  `pymt` bigint UNSIGNED NOT NULL,
  `contrat` bigint UNSIGNED NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `month` date NOT NULL,
  `SB` double(20,2) NOT NULL,
  `jp` int NOT NULL DEFAULT '22',
  `ne` int NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `liste_paies`
--

INSERT INTO `liste_paies` (`id`, `reference`, `agent`, `sAgent`, `pymt`, `contrat`, `signature`, `month`, `SB`, `jp`, `ne`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AG-PYMNT-37235-FP196', 3406, 14, 1, 1, 2359, '2023-11-01', 2470.00, 22, 7, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(2, 'AG-PYMNT-10398-FP112', 3405, 13, 1, 2, 2359, '2023-11-01', 750.00, 22, 6, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(3, 'AG-PYMNT-74766-FP821', 3404, 12, 1, 3, 2359, '2023-11-01', 2000.00, 18, 3, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(4, 'AG-PYMNT-49819-FP945', 3403, 11, 1, 4, 2359, '2023-11-01', 800.00, 22, 0, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(5, 'AG-PYMNT-83198-FP133', 3402, 10, 1, 5, 2359, '2023-11-01', 4500.00, 22, 5, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(6, 'AG-PYMNT-84783-FP439', 3401, 8, 1, 6, 2359, '2023-11-01', 2400.00, 20, 3, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(7, 'AG-PYMNT-17828-FP763', 3400, 7, 1, 7, 2359, '2023-11-01', 6000.00, 22, 0, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(8, 'AG-PYMNT-31900-FP199', 3399, 5, 1, 8, 2359, '2023-11-01', 3000.00, 22, 9, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(9, 'AG-PYMNT-30982-FP581', 3398, 4, 1, 9, 2359, '2023-11-01', 2000.00, 22, 6, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(10, 'AG-PYMNT-61461-FP946', 3397, 3, 1, 10, 2359, '2023-11-01', 1200.00, 12, 3, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(11, 'AG-PYMNT-29554-FP746', 3396, 2, 1, 11, 2359, '2023-11-01', 1500.00, 22, 3, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11'),
(12, 'AG-PYMNT-56631-FP958', 3395, 1, 1, 12, 2359, '2023-11-01', 1200.00, 22, 0, 1, 1, '2023-12-11 07:34:11', '2023-12-11 07:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `livre_caisses`
--

CREATE TABLE `livre_caisses` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entree` double(20,2) DEFAULT '0.00',
  `sortie` double(20,2) DEFAULT '0.00',
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `conversation_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_02_11_131146_create_services_table', 1),
(5, '2023_02_12_091038_create_agents_table', 1),
(6, '2023_02_13_000000_create_users_table', 1),
(7, '2023_02_13_091038_create_bailleurs_table', 1),
(8, '2023_02_13_091039_create_projets_table', 1),
(9, '2023_02_13_091040_create_affectations_table', 1),
(10, '2023_02_14_000000_create_categories_table', 1),
(11, '2023_02_14_000000_create_products_table', 1),
(12, '2023_02_14_000001_create_articles_table', 1),
(13, '2023_02_15_000002_create_et_bes_table ', 1),
(14, '2023_02_15_000002_create_product_oder_table', 1),
(15, '2023_02_15_083823_create_dem_aches_table', 1),
(16, '2023_03_28_062123_create_valid_ebs_table', 1),
(17, '2023_03_28_062207_create_valid_das_table', 1),
(18, '2023_04_18_120202_create_prices_table', 1),
(19, '2023_04_18_120244_create_fournisseurs_table', 1),
(20, '2023_05_05_113546_create_proformas_table', 1),
(21, '2023_05_19_080045_create_pvs_table', 1),
(22, '2023_05_19_080922_create_signature_pvs_table', 1),
(23, '2023_05_19_080949_create_prix_pvs_table', 1),
(24, '2023_05_21_151509_create_bcs_table', 1),
(25, '2023_05_22_081703_create_valid_bcs_table', 1),
(26, '2023_05_26_072617_create_brs_table', 1),
(27, '2023_05_26_134843_create_br_oders_table', 1),
(28, '2023_05_31_091833_create_fourn_prices_table', 1),
(29, '2023_06_02_063556_create_lignes_table', 1),
(30, '2023_06_20_112337_create_stocks_table', 1),
(31, '2023_06_21_075546_create_dis_table', 1),
(32, '2023_06_21_075606_create_di_oders_table', 1),
(33, '2023_06_21_092942_create_valid_dis_table', 1),
(34, '2023_06_26_134447_create_conversations_table', 1),
(35, '2023_06_26_134640_create_messages_table', 1),
(36, '2023_07_07_064548_create_bps_table', 1),
(37, '2023_07_07_104922_create_valid_bps_table', 1),
(38, '2023_08_23_072134_create_nds_table', 1),
(39, '2023_08_23_072312_create_nd_oders_table', 1),
(40, '2023_08_23_072708_create_valid_nds_table', 1),
(41, '2023_08_30_060916_create_ops_table', 1),
(42, '2023_08_30_061021_create_cheques_table', 1),
(43, '2023_08_31_131540_create_comptes_table', 1),
(44, '2023_08_31_140915_create_decharges_table', 1),
(45, '2023_09_07_140507_create_bes_table', 1),
(46, '2023_09_07_140649_create_r_caisses_table', 1),
(47, '2023_09_11_063155_create_trs_table', 1),
(48, '2023_09_11_063156_create_tr_oders_table', 1),
(49, '2023_09_11_114019_create_valid_trs_table', 1),
(50, '2023_09_18_064625_create_missions_table', 1),
(51, '2023_09_18_064820_create_conges_table', 1),
(52, '2023_09_18_070659_create_agent_missions_table', 1),
(53, '2023_09_25_054909_create_mouvements_table', 1),
(54, '2023_09_25_084526_create_valid_mvnts_table', 1),
(55, '2023_09_25_084555_create_valid_conges_table', 1),
(56, '2023_10_04_072135_create_livre_caisses_table', 1),
(57, '2023_11_06_071630_create_tauxes_table', 1),
(58, '2023_11_22_165217_create_contrats_table', 1),
(59, '2023_11_22_165407_create_part_contrats_table', 1),
(60, '2023_11_30_193921_create_statut_agents_table', 1),
(61, '2023_12_02_150816_create_payement_agents_table', 1),
(62, '2023_12_02_151833_create_liste_paies_table', 1),
(63, '2023_12_05_090533_create_valid_paies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `tr` bigint UNSIGNED NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `dure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `itinéraire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mouvements`
--

CREATE TABLE `mouvements` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `depart` time NOT NULL,
  `retour` time NOT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nds`
--

CREATE TABLE `nds` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nd_oders`
--

CREATE TABLE `nd_oders` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nd` bigint UNSIGNED NOT NULL,
  `unite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `prix` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ops`
--

CREATE TABLE `ops` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `bp` bigint UNSIGNED NOT NULL,
  `beneficiare` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compteB` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banqueB` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` double(20,2) NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `part_contrats`
--

CREATE TABLE `part_contrats` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `contrat` bigint UNSIGNED NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `pourcentage` double(10,2) NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_contrats`
--

INSERT INTO `part_contrats` (`id`, `reference`, `signature`, `projet`, `contrat`, `debut`, `fin`, `pourcentage`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PRT-CTR-99040-FP705', 2345, 2, 1, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:39:23', '2023-12-09 11:39:23'),
(2, 'PRT-CTR-30538-FP790', 2345, 1, 2, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:40:27', '2023-12-09 11:40:27'),
(3, 'PRT-CTR-23875-FP586', 2345, 3, 3, '2023-01-01', '2023-12-31', 50.00, 1, 1, '2023-12-09 11:49:30', '2023-12-09 11:49:30'),
(4, 'PRT-CTR-15920-FP452', 2345, 1, 3, '2023-01-01', '2023-12-31', 50.00, 1, 1, '2023-12-09 11:49:30', '2023-12-09 11:49:30'),
(5, 'PRT-CTR-60537-FP681', 2345, 3, 4, '2023-01-01', '2023-12-31', 30.00, 1, 1, '2023-12-09 11:52:24', '2023-12-09 11:52:24'),
(6, 'PRT-CTR-65612-FP418', 2345, 1, 4, '2023-01-01', '2023-12-31', 70.00, 1, 1, '2023-12-09 11:52:24', '2023-12-09 11:52:24'),
(7, 'PRT-CTR-57657-FP984', 2345, 3, 5, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:53:40', '2023-12-09 11:53:40'),
(8, 'PRT-CTR-50595-FP967', 2345, 3, 6, '2023-01-01', '2023-12-31', 40.00, 1, 1, '2023-12-09 11:55:04', '2023-12-09 11:55:04'),
(9, 'PRT-CTR-51004-FP844', 2345, 1, 6, '2023-01-01', '2023-12-31', 60.00, 1, 1, '2023-12-09 11:55:04', '2023-12-09 11:55:04'),
(10, 'PRT-CTR-28010-FP700', 2345, 3, 7, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:56:19', '2023-12-09 11:56:19'),
(11, 'PRT-CTR-66525-FP866', 2345, 3, 8, '2023-01-01', '2023-12-30', 100.00, 1, 1, '2023-12-09 11:57:08', '2023-12-09 11:57:08'),
(12, 'PRT-CTR-30878-FP982', 2345, 2, 9, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:58:00', '2023-12-09 11:58:00'),
(13, 'PRT-CTR-35620-FP138', 2345, 2, 10, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 11:58:52', '2023-12-09 11:58:52'),
(14, 'PRT-CTR-41220-FP600', 2345, 3, 11, '2023-01-01', '2023-12-31', 20.00, 1, 1, '2023-12-09 11:59:50', '2023-12-09 11:59:50'),
(15, 'PRT-CTR-71215-FP808', 2345, 2, 11, '2023-01-01', '2023-12-31', 80.00, 1, 1, '2023-12-09 11:59:50', '2023-12-09 11:59:50'),
(16, 'PRT-CTR-90479-FP962', 2345, 3, 12, '2023-01-01', '2023-12-31', 100.00, 1, 1, '2023-12-09 12:01:08', '2023-12-09 12:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payement_agents`
--

CREATE TABLE `payement_agents` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `taux` bigint UNSIGNED NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payement_agents`
--

INSERT INTO `payement_agents` (`id`, `reference`, `signature`, `taux`, `month`, `type`, `niv1`, `niv2`, `statut`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PYMT-AG-2023-11-012359465331', 2359, 987, '2023-11-01', 'CDD', 1, 1, 1, 1, '2023-12-11 07:31:59', '2023-12-11 07:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `prix` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `reference`, `signature`, `product`, `debut`, `fin`, `prix`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PRX-12345154243', 2345, 1, '2023-12-08', '2023-12-31', 1200.00, 1, '2023-12-09 12:19:45', '2023-12-09 12:19:45'),
(2, 'PRX-22345311693', 2345, 2, '2023-12-08', '2023-12-31', 800.00, 1, '2023-12-09 12:20:13', '2023-12-09 12:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `prix_pvs`
--

CREATE TABLE `prix_pvs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `pv` bigint UNSIGNED NOT NULL,
  `produit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proforma` bigint UNSIGNED NOT NULL,
  `prix` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prix_pvs`
--

INSERT INTO `prix_pvs` (`id`, `reference`, `signature`, `pv`, `produit`, `proforma`, `prix`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PRPV-77178-FP805', 2348, 1, '2', 1, 1200.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(2, 'PRPV-41799-FP898', 2348, 1, '2', 2, 1000.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(3, 'PRPV-75877-FP530', 2348, 1, '2', 3, 950.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(4, 'PRPV-11074-FP726', 2348, 1, '1', 1, 1500.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(5, 'PRPV-64241-FP935', 2348, 1, '1', 2, 1200.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(6, 'PRPV-86373-FP897', 2348, 1, '1', 3, 1200.00, 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `categorie` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `reference`, `signature`, `categorie`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PRD-L12345450382', 2345, 1, 'Laptop', 'Ordinateur portable', 1, '2023-12-09 12:15:13', '2023-12-09 12:16:31'),
(2, 'PRD-E12345248154', 2345, 1, 'Ecran', 'ras', 1, '2023-12-09 12:15:56', '2023-12-09 12:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_oders`
--

CREATE TABLE `product_oders` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `etatBes` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL,
  `ligne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_oders`
--

INSERT INTO `product_oders` (`id`, `reference`, `product`, `etatBes`, `quantite`, `ligne`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'CMD-907820', 1, 1, 5, '210505', '2', 1, '2023-12-09 12:25:56', '2023-12-09 12:59:23'),
(2, 'CMD-390981', 1, 1, 3, '150302', '1', 1, '2023-12-09 12:25:56', '2023-12-09 12:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `proformas`
--

CREATE TABLE `proformas` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `da` bigint UNSIGNED NOT NULL,
  `fournisseur` bigint UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proformas`
--

INSERT INTO `proformas` (`id`, `reference`, `signature`, `da`, `fournisseur`, `numero`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PROF-47815-FP588', 2348, 1, 1, '6547839', NULL, 1, '2023-12-09 13:12:11', '2023-12-09 13:12:11'),
(2, 'PROF-14595-FP158', 2348, 1, 2, '654', NULL, 1, '2023-12-09 13:12:11', '2023-12-09 13:12:11'),
(3, 'PROF-52024-FP319', 2348, 1, 3, '8909', NULL, 1, '2023-12-09 13:12:11', '2023-12-09 13:12:11');

-- --------------------------------------------------------

--
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id` bigint UNSIGNED NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `bailleur` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateD` date NOT NULL,
  `dateF` date DEFAULT NULL,
  `contex` text COLLATE utf8mb4_unicode_ci,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projets`
--

INSERT INTO `projets` (`id`, `signature`, `bailleur`, `reference`, `name`, `dateD`, `dateF`, `contex`, `domaine`, `active`, `created_at`, `updated_at`) VALUES
(1, 2345, 1, 'PJ-A9758', 'TUMAINI', '2023-12-05', '2024-05-30', 'FR', NULL, 1, '2023-12-09 11:22:26', '2023-12-09 11:41:48'),
(2, 2345, 1, 'PJ-M3384', 'Maison Dorcas', '2023-12-06', '2024-03-20', 'ss', NULL, 1, '2023-12-09 11:22:53', '2023-12-09 11:22:53'),
(3, 2345, 1, 'PJ-A8707', 'Administration', '2008-01-01', '2040-12-31', 'RAS', NULL, 1, '2023-12-09 11:42:45', '2023-12-09 11:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `pvs`
--

CREATE TABLE `pvs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `da` bigint UNSIGNED NOT NULL,
  `fournisseur` bigint UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `justification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pvs`
--

INSERT INTO `pvs` (`id`, `reference`, `signature`, `da`, `fournisseur`, `titre`, `dateC`, `observation`, `justification`, `active`, `created_at`, `updated_at`) VALUES
(1, 'PV-65276-FP586', 2348, 1, 3, 'Achat Fourniture de Bureau', '2023-12-09', 'Meilleur prix', 'Bonne qualité', 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `r_caisses`
--

CREATE TABLE `r_caisses` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `solde` double(30,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `r_caisses`
--

INSERT INTO `r_caisses` (`id`, `reference`, `projet`, `solde`, `created_at`, `updated_at`) VALUES
(1, 'RC-A1869', 1, 0.00, '2023-12-09 11:22:26', '2023-12-09 11:22:26'),
(2, 'RC-M6349', 2, 0.00, '2023-12-09 11:22:53', '2023-12-09 11:22:53'),
(3, 'RC-A6985', 3, 0.00, '2023-12-09 11:42:45', '2023-12-09 11:42:45'),
(6, 'RC-28403', 2, 500.00, '2023-12-09 15:02:42', '2023-12-09 15:02:42'),
(7, 'RC-237984', 2, 250.00, '2023-12-09 15:14:18', '2023-12-09 15:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `reference`, `niveau`, `parent`, `name`, `created_at`, `updated_at`) VALUES
(100, 'SRV-ADM0000111A', '1', '0', 'Administration', '2023-12-09 10:43:00', '2023-12-09 10:43:00'),
(101, 'SRV-ADM0000123F', '2', '100', 'Finance', '2023-12-09 10:43:00', '2023-12-09 10:43:00'),
(102, 'SRV-ADM0000321R', '2', '100', 'Resources Humaines', '2023-12-09 10:43:01', '2023-12-09 10:43:01'),
(103, 'SRV-ADM0000987FL', '2', '100', 'Logistique', '2023-12-09 10:43:01', '2023-12-09 10:43:01'),
(104, 'SRV-ADM0000518IT', '2', '100', 'IT', '2023-12-09 10:43:01', '2023-12-09 10:43:01'),
(200, 'SRV-PRG0000222P', '1', '0', 'Programme', '2023-12-09 10:43:00', '2023-12-09 10:43:00'),
(201, 'SRV-PRG0000123F', '2', '200', 'Suivie Evaluation', '2023-12-09 10:43:01', '2023-12-09 10:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `signature_pvs`
--

CREATE TABLE `signature_pvs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pv` bigint UNSIGNED NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signature_pvs`
--

INSERT INTO `signature_pvs` (`id`, `reference`, `pv`, `agent`, `active`, `created_at`, `updated_at`) VALUES
(1, 'AGPV-92014-FP815', 1, '3404', 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(2, 'AGPV-43469-FP290', 1, '3401', 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51'),
(3, 'AGPV-82168-FP245', 1, '3403', 1, '2023-12-09 13:14:51', '2023-12-09 13:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `statut_agents`
--

CREATE TABLE `statut_agents` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `etatcivil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enfant` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statut_agents`
--

INSERT INTO `statut_agents` (`id`, `reference`, `signature`, `agent`, `etatcivil`, `enfant`, `active`, `created_at`, `updated_at`) VALUES
(1, 'STFP-I8598B', 2345, 3395, 'Marie(e)', 0, 1, '2023-12-09 11:00:14', '2023-12-09 11:00:14'),
(2, 'STFP-N3248M', 2345, 3396, 'Marie(e)', 3, 1, '2023-12-09 11:01:37', '2023-12-09 11:01:37'),
(3, 'STFP-I3200B', 2345, 3397, 'Marie(e)', 3, 1, '2023-12-09 11:04:12', '2023-12-09 11:04:12'),
(4, 'STFP-H3408M', 2345, 3398, 'Marie(e)', 6, 1, '2023-12-09 11:05:57', '2023-12-09 11:05:57'),
(5, 'STFP-R9016N', 2345, 3399, 'Marie(e)', 9, 1, '2023-12-09 11:07:01', '2023-12-09 11:07:01'),
(6, 'STFP-V5256G', 2345, 3400, 'Celibataire', 0, 0, '2023-12-09 11:09:02', '2023-12-09 11:09:43'),
(7, 'STFP-V8884G', 2345, 3400, 'Celibataire', 0, 1, '2023-12-09 11:09:43', '2023-12-09 11:09:43'),
(8, 'STFP-J8745B', 2345, 3401, 'Marie(e)', 3, 1, '2023-12-09 11:11:49', '2023-12-09 11:11:49'),
(9, 'STFP-Y5943S', 2345, 3402, 'Marie(e)', 5, 0, '2023-12-09 11:13:38', '2023-12-09 11:14:04'),
(10, 'STFP-Y1798S', 2345, 3402, 'Marie(e)', 5, 1, '2023-12-09 11:14:04', '2023-12-09 11:14:04'),
(11, 'STFP-S3910B', 2345, 3403, 'Celibataire', 0, 1, '2023-12-09 11:15:59', '2023-12-09 11:15:59'),
(12, 'STFP-K7875K', 2345, 3404, 'Marie(e)', 3, 1, '2023-12-09 11:17:16', '2023-12-09 11:17:16'),
(13, 'STFP-M3231M', 2345, 3405, 'Marie(e)', 6, 1, '2023-12-09 11:18:28', '2023-12-09 11:18:28'),
(14, 'STFP-M8028M', 2345, 3406, 'Marie(e)', 7, 1, '2023-12-09 11:20:17', '2023-12-09 11:20:17'),
(15, 'STFP-N9918B', 2345, 3407, 'Marie(e)', 4, 1, '2023-12-09 13:50:25', '2023-12-09 13:50:25'),
(16, 'STFP-A4002B', 2345, 3408, 'Marie(e)', 4, 0, '2023-12-09 20:01:22', '2023-12-09 20:05:35'),
(17, 'STFP-A1052B', 2345, 3408, 'Marie(e)', 5, 1, '2023-12-09 20:05:35', '2023-12-09 20:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product` bigint UNSIGNED NOT NULL,
  `project` bigint UNSIGNED NOT NULL,
  `quantite` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `reference`, `product`, `project`, `quantite`, `active`, `created_at`, `updated_at`) VALUES
(1, 'ST-ART-46057-FP631', 2, 2, 5, 1, '2023-12-09 13:20:16', '2023-12-09 13:22:06'),
(2, 'ST-ART-59547-FP441', 1, 2, 3, 1, '2023-12-09 13:20:16', '2023-12-09 13:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `tauxes`
--

CREATE TABLE `tauxes` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `taux` double(20,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tauxes`
--

INSERT INTO `tauxes` (`id`, `user`, `taux`, `active`, `created_at`, `updated_at`) VALUES
(987, 2345, 2004.77, 1, '2023-12-11 09:12:04', '2023-12-11 09:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `trs`
--

CREATE TABLE `trs` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `projet` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `niv1` tinyint(1) NOT NULL DEFAULT '0',
  `niv2` tinyint(1) NOT NULL DEFAULT '0',
  `niv3` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trs`
--

INSERT INTO `trs` (`id`, `reference`, `agent`, `projet`, `type`, `titre`, `niv1`, `niv2`, `niv3`, `active`, `created_at`, `updated_at`) VALUES
(1, 'TR-37711-FP398', 2355, 2, '1', 'Mission Supervision', 1, 1, 1, 1, '2023-12-09 13:43:22', '2023-12-09 13:47:58');

-- --------------------------------------------------------

--
-- Table structure for table `tr_oders`
--

CREATE TABLE `tr_oders` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tr` bigint UNSIGNED NOT NULL,
  `unite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `ligne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_oders`
--

INSERT INTO `tr_oders` (`id`, `reference`, `libelle`, `tr`, `unite`, `quantite`, `ligne`, `prix`, `active`, `created_at`, `updated_at`) VALUES
(1, 'TR-ODR-1562980', 'Achat materiel de com', 1, 'pièce', 5, '140202', 50.00, 1, '2023-12-09 13:43:22', '2023-12-09 13:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `reference`, `agent`, `name`, `email`, `email_verified_at`, `password`, `role`, `image`, `signature`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(2345, 'US-ST000000D', 3394, 'David Tino', 'test@panzi.com', '2023-12-09 10:43:01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sup', NULL, NULL, 1, 'hM7Z14kZz6envPzacwvqvWxS28D0qdMe5Gprz2bzpuSQgvGYd3Kh6FWKGWon', '2023-12-09 10:43:01', '2023-12-09 10:43:01'),
(2346, 'US-M3406449550M', 3406, 'Musarasa Mukanire', 'Pascal', NULL, '$2y$10$i6GIRoR.VbMkp5dtCjNksuxip/1I31.Lq8tzf/jqbf6PFp7vTjsyq', 'PERS', NULL, 'img/signatures/frXnIsp4cmEzQqHsdYuPH8VfFdZdLAUKzyHF5NNG.png', 1, NULL, '2023-12-09 11:35:36', '2023-12-09 11:35:36'),
(2347, 'US-M3405749726M', 3405, 'Mapenzi Mirango', 'Mapenzi', NULL, '$2y$10$Dw3.Wubnzw/CsOzHB5bTCO6duMoW8AtT7gOO53rpi0sF47ZlPLn1q', 'MAG', NULL, 'img/signatures/Mi3KzuQ9xje1PghOr8NCcUI7wgOESOmCJfAoM17Y.png', 1, NULL, '2023-12-09 12:02:43', '2023-12-09 12:02:43'),
(2348, 'US-K3404856952K', 3404, 'Kaboyi Kira', 'Marie-Grace', NULL, '$2y$10$GjrlwCcdA1syBJUULkFdQubf3XytktBJX020uJh4Hl2rRpVvXyWzm', 'LOG1', NULL, 'img/signatures/u2p7cHFnPXkPiSNAbGnb3ttKFWGG2wEbpxplOKKn.png', 1, NULL, '2023-12-09 12:03:20', '2023-12-09 12:03:20'),
(2349, 'US-B3403421102S', 3403, 'Socrate Balibuno', 'Socrate', NULL, '$2y$10$.pPF1YeBTM.UvETZO7Av9utK0APfLG6Kodd7/vOZ5YE81yeaph.Ki', 'LOG2', NULL, 'img/signatures/eRTYRbocLsoK2BihYDesXVo5BsnC9mbtViGIQJz1.png', 1, NULL, '2023-12-09 12:04:24', '2023-12-09 12:04:24'),
(2350, 'US-S3402269328Y', 3402, 'Yves Shangalume', 'Yves', NULL, '$2y$10$W9GFLSwRxhheC3NgR0L4SeJPw07grWB86B7p/Nda9SnwJvsruH9Om', 'D.A.F', NULL, 'img/signatures/FpZZaHyl47T6VqpUN0rERHa9N2EyV7vpunyXAyg2.png', 1, NULL, '2023-12-09 12:05:52', '2023-12-09 12:05:52'),
(2351, 'US-B3401469573J', 3401, 'Judith Bafuka', 'Judith', NULL, '$2y$10$HyKdv367PrRnOJibfaUDx.2rW8FlDLsza9tZFzn/tkRmg.N1hAVY.', 'COMPT1', NULL, 'img/signatures/jfolrgNnpCz38kYNh05zwuy3cHyOM58enaZwcWzh.png', 1, NULL, '2023-12-09 12:06:23', '2023-12-09 12:06:23'),
(2352, 'US-G3400382958V', 3400, 'Vanessa Goscinny', 'Vanessa', NULL, '$2y$10$EwpSevsteRCyRD2/VaZ76ODNrAT.bOSiBr7WIdCu1vsgjSn5yJqFu', 'S.E', NULL, 'img/signatures/KozKx0V3USysLl5PgLH83MwFLPJYfpW7MdYkL19Z.png', 1, NULL, '2023-12-09 12:06:56', '2023-12-09 12:06:56'),
(2353, 'US-N3399105100R', 3399, 'Rutega Nkwale', 'Bertin', NULL, '$2y$10$jUovuinfWk5pV8YoiKOW8e0Rdw7V1B.LyUD204hEg04OiKYffFDL2', 'D.P', NULL, 'img/signatures/JCCyfBHgBDqtloehiu2sVEgpJLxxV4SLuQJwXd85.png', 1, NULL, '2023-12-09 12:07:26', '2023-12-09 12:07:26'),
(2354, 'US-M3398914281H', 3398, 'Habamungu Mutunzi', 'Emery', NULL, '$2y$10$XyEACxOi5kx0fm2FKvXvyuam50TV.INgrXnaN7rnFx8nRtHMuNExq', 'C.P', NULL, 'img/signatures/FsfjqeX9ZuvKAJtfmAThbVspWugUdZJOu0gYkfch.png', 1, NULL, '2023-12-09 12:08:20', '2023-12-09 12:08:20'),
(2355, 'US-B3397835533I', 3397, 'Irenge Bulalo', 'Justin', NULL, '$2y$10$5FaKeVpeQukURZVwXzx54.FZXnybJ4W4GBuOSe27.fQMzCTT.sLGK', 'PERS', NULL, 'img/signatures/HexHLGl4QiZGWbpnbrtzjnxjtqjzoIFpOJ7R5P7P.png', 1, NULL, '2023-12-09 12:09:23', '2023-12-09 12:09:23'),
(2356, 'US-M3396617417N', 3396, 'Neema Mugisho', 'Neema', NULL, '$2y$10$lQuN2yplSZkdiKVwqmTwA.GfH4YVQXl0otDlVPs1ZZ4Ieo7fvoqzi', 'COMPT2', NULL, 'img/signatures/d4OU18qYof0iRheKmcJILoEGWPGgblp0sA3lVVy4.png', 1, NULL, '2023-12-09 12:10:33', '2023-12-09 12:10:33'),
(2357, 'US-B3395170106I', 3395, 'Iddy Byawa', 'Iddy', NULL, '$2y$10$meOV4u.bc1d.ItmJpgena.Y.kaVRStG6Z6IyH.B5IZ/.tOeSmtyNu', 'COMPT2', NULL, 'img/signatures/dfrlFsYbOPanJX0lZ9NwDDoFhUf4ri3BV2GIxNCi.png', 1, NULL, '2023-12-09 12:11:10', '2023-12-09 12:11:10'),
(2358, 'US-B3407569278N', 3407, 'Nabintu Birindwa', 'julie', NULL, '$2y$10$t7gBzp03UA.XDZd2auklTOygFlZDdy5Ai3vFTcjdawrvJBZ5YTgBu', 'CAISS', NULL, 'img/signatures/je6x21HG2Klg6O0zJgktUTtRBpymvgMeR1jT1PgM.png', 1, NULL, '2023-12-09 13:51:22', '2023-12-09 13:51:22'),
(2359, 'US-B3408800277A', 3408, 'Anuarite Buhendwa', 'Anuarite', NULL, '$2y$10$boBfMOyBWrjOq0LLGaCP5.B3J3Ey9.ndRm0/y3YeTlKW9snYlP6J.', 'R.H', NULL, 'img/signatures/HVshQLybQ5RMqJXtFcOXMhcStq521S6oGMnYOWCO.png', 1, NULL, '2023-12-09 20:08:40', '2023-12-09 20:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `valid_bcs`
--

CREATE TABLE `valid_bcs` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `bc` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_bcs`
--

INSERT INTO `valid_bcs` (`id`, `user`, `bc`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2350, 1, 1, '1', 'Tout es prevu', '2023-12-09 13:16:56', '2023-12-09 13:16:56'),
(2, 2352, 1, 1, '2', 'Tout es prevu', '2023-12-09 13:17:23', '2023-12-09 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `valid_bps`
--

CREATE TABLE `valid_bps` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `bp` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_bps`
--

INSERT INTO `valid_bps` (`id`, `user`, `bp`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2354, 1, 1, '1', 'Tout es prevu', '2023-12-09 13:26:50', '2023-12-09 13:26:50'),
(2, 2350, 1, 1, '2', 'Tout es prevu', '2023-12-09 13:27:50', '2023-12-09 13:27:50'),
(3, 2352, 1, 1, '3', 'Tout es prevu', '2023-12-09 13:28:48', '2023-12-09 13:28:48'),
(4, 2354, 2, 1, '1', 'Tout es prevu', '2023-12-09 14:14:39', '2023-12-09 14:14:39'),
(5, 2350, 2, 1, '2', 'Tout es prevu', '2023-12-09 14:16:23', '2023-12-09 14:16:23'),
(6, 2352, 2, 1, '3', 'Tout es prevu', '2023-12-09 14:16:48', '2023-12-09 14:16:48'),
(7, 2354, 3, 1, '1', 'Tout es prevu', '2023-12-09 15:06:41', '2023-12-09 15:06:41'),
(8, 2351, 3, 1, '2', 'Tout es prevu', '2023-12-09 15:07:38', '2023-12-09 15:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `valid_conges`
--

CREATE TABLE `valid_conges` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `conge` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valid_das`
--

CREATE TABLE `valid_das` (
  `id` bigint UNSIGNED NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `da` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_das`
--

INSERT INTO `valid_das` (`id`, `signature`, `user`, `da`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2348, 2348, 1, 1, '1', 'Tout es prevu', '2023-12-09 13:05:21', '2023-12-09 13:05:21'),
(2, 2356, 2356, 1, 1, '2', 'Tout es prevu', '2023-12-09 13:06:01', '2023-12-09 13:06:01'),
(3, 2354, 2354, 1, 1, '3', 'Tout es prevu', '2023-12-09 13:06:55', '2023-12-09 13:06:55'),
(4, 2350, 2350, 1, 1, '4', 'Tout es prevu', '2023-12-09 13:07:49', '2023-12-09 13:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `valid_dis`
--

CREATE TABLE `valid_dis` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `di` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valid_ebs`
--

CREATE TABLE `valid_ebs` (
  `id` bigint UNSIGNED NOT NULL,
  `signature` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `eb` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_ebs`
--

INSERT INTO `valid_ebs` (`id`, `signature`, `user`, `eb`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2356, 2356, 1, 1, '1', 'Tout es prevu', '2023-12-09 12:59:54', '2023-12-09 12:59:54'),
(2, 2354, 2354, 1, 1, '2', 'Tout es prevu', '2023-12-09 13:03:29', '2023-12-09 13:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `valid_mvnts`
--

CREATE TABLE `valid_mvnts` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `mvnt` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valid_nds`
--

CREATE TABLE `valid_nds` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `nd` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `valid_paies`
--

CREATE TABLE `valid_paies` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `paie` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_paies`
--

INSERT INTO `valid_paies` (`id`, `user`, `paie`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2351, 1, 1, '1', 'Tout es prevu', '2023-12-11 07:43:08', '2023-12-11 07:43:08'),
(2, 2350, 1, 1, '2', 'Tout es prevu', '2023-12-11 07:43:58', '2023-12-11 07:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `valid_trs`
--

CREATE TABLE `valid_trs` (
  `id` bigint UNSIGNED NOT NULL,
  `user` bigint UNSIGNED NOT NULL,
  `tr` bigint UNSIGNED NOT NULL,
  `resp` tinyint(1) NOT NULL,
  `niv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_trs`
--

INSERT INTO `valid_trs` (`id`, `user`, `tr`, `resp`, `niv`, `motif`, `created_at`, `updated_at`) VALUES
(1, 2356, 1, 1, '1', 'Tout es prevu', '2023-12-09 13:46:09', '2023-12-09 13:46:09'),
(2, 2354, 1, 1, '2', 'Tout es prevu', '2023-12-09 13:47:11', '2023-12-09 13:47:11'),
(3, 2350, 1, 1, '3', 'Tout es prevu', '2023-12-09 13:47:58', '2023-12-09 13:47:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affectations_reference_unique` (`reference`),
  ADD KEY `affectations_signature_foreign` (`signature`),
  ADD KEY `affectations_agent_foreign` (`agent`),
  ADD KEY `affectations_projet_foreign` (`projet`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_matricule_unique` (`matricule`),
  ADD UNIQUE KEY `agents_phone_unique` (`phone`),
  ADD UNIQUE KEY `agents_email_unique` (`email`),
  ADD KEY `agents_service_foreign` (`service`);

--
-- Indexes for table `agent_missions`
--
ALTER TABLE `agent_missions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agent_missions_reference_unique` (`reference`),
  ADD KEY `agent_missions_ms_foreign` (`ms`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_reference_unique` (`reference`),
  ADD KEY `articles_signature_foreign` (`signature`),
  ADD KEY `articles_product_foreign` (`product`);

--
-- Indexes for table `bailleurs`
--
ALTER TABLE `bailleurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bailleurs_reference_unique` (`reference`),
  ADD UNIQUE KEY `bailleurs_phone_unique` (`phone`),
  ADD UNIQUE KEY `bailleurs_email_unique` (`email`),
  ADD KEY `bailleurs_signature_foreign` (`signature`);

--
-- Indexes for table `bcs`
--
ALTER TABLE `bcs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bcs_reference_unique` (`reference`),
  ADD KEY `bcs_signature_foreign` (`signature`),
  ADD KEY `bcs_da_foreign` (`da`);

--
-- Indexes for table `bes`
--
ALTER TABLE `bes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bes_reference_unique` (`reference`),
  ADD KEY `bes_signature_foreign` (`signature`),
  ADD KEY `bes_projet_foreign` (`projet`),
  ADD KEY `bes_agent_foreign` (`agent`);

--
-- Indexes for table `bps`
--
ALTER TABLE `bps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bps_reference_unique` (`reference`),
  ADD KEY `bps_signature_foreign` (`signature`),
  ADD KEY `bps_projet_foreign` (`projet`);

--
-- Indexes for table `brs`
--
ALTER TABLE `brs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brs_reference_unique` (`reference`),
  ADD KEY `brs_signature_foreign` (`signature`),
  ADD KEY `brs_bc_foreign` (`bc`),
  ADD KEY `brs_projet_foreign` (`projet`),
  ADD KEY `brs_fournisseur_foreign` (`fournisseur`);

--
-- Indexes for table `br_oders`
--
ALTER TABLE `br_oders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `br_oders_reference_unique` (`reference`),
  ADD KEY `br_oders_br_foreign` (`br`),
  ADD KEY `br_oders_bc_foreign` (`bc`),
  ADD KEY `br_oders_produit_foreign` (`produit`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_reference_unique` (`reference`),
  ADD KEY `categories_signature_foreign` (`signature`);

--
-- Indexes for table `cheques`
--
ALTER TABLE `cheques`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cheques_reference_unique` (`reference`),
  ADD UNIQUE KEY `cheques_numero_unique` (`numero`),
  ADD KEY `cheques_agent_foreign` (`agent`),
  ADD KEY `cheques_projet_foreign` (`projet`),
  ADD KEY `cheques_bp_foreign` (`bp`);

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `comptes_reference_unique` (`reference`),
  ADD UNIQUE KEY `comptes_numero_unique` (`numero`),
  ADD KEY `comptes_signature_foreign` (`signature`);

--
-- Indexes for table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conges_reference_unique` (`reference`),
  ADD KEY `conges_signature_foreign` (`signature`),
  ADD KEY `conges_agent_foreign` (`agent`);

--
-- Indexes for table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contrats_reference_unique` (`reference`),
  ADD KEY `contrats_signature_foreign` (`signature`),
  ADD KEY `contrats_agent_foreign` (`agent`),
  ADD KEY `contrats_projet_foreign` (`projet`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_from_foreign` (`from`),
  ADD KEY `conversations_to_foreign` (`to`);

--
-- Indexes for table `decharges`
--
ALTER TABLE `decharges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `decharges_reference_unique` (`reference`),
  ADD KEY `decharges_signature_foreign` (`signature`),
  ADD KEY `decharges_projet_foreign` (`projet`),
  ADD KEY `decharges_bp_foreign` (`bp`);

--
-- Indexes for table `dem_aches`
--
ALTER TABLE `dem_aches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dem_aches_reference_unique` (`reference`),
  ADD KEY `dem_aches_signature_foreign` (`signature`),
  ADD KEY `dem_aches_eb_foreign` (`eb`);

--
-- Indexes for table `dis`
--
ALTER TABLE `dis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dis_reference_unique` (`reference`),
  ADD KEY `dis_agent_foreign` (`agent`),
  ADD KEY `dis_projet_foreign` (`projet`);

--
-- Indexes for table `di_oders`
--
ALTER TABLE `di_oders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `di_oders_reference_unique` (`reference`),
  ADD KEY `di_oders_product_foreign` (`product`),
  ADD KEY `di_oders_di_foreign` (`di`);

--
-- Indexes for table `et_bes`
--
ALTER TABLE `et_bes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `et_bes_reference_unique` (`reference`),
  ADD KEY `et_bes_agent_foreign` (`agent`),
  ADD KEY `et_bes_projet_foreign` (`projet`),
  ADD KEY `et_bes_categorie_foreign` (`categorie`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fournisseurs_reference_unique` (`reference`),
  ADD KEY `fournisseurs_signature_foreign` (`signature`),
  ADD KEY `fournisseurs_catproduct_foreign` (`catProduct`);

--
-- Indexes for table `fourn_prices`
--
ALTER TABLE `fourn_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fourn_prices_reference_unique` (`reference`),
  ADD KEY `fourn_prices_signature_foreign` (`signature`),
  ADD KEY `fourn_prices_fournisseur_foreign` (`fournisseur`);

--
-- Indexes for table `lignes`
--
ALTER TABLE `lignes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lignes_code_unique` (`code`);

--
-- Indexes for table `liste_paies`
--
ALTER TABLE `liste_paies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `liste_paies_reference_unique` (`reference`),
  ADD KEY `liste_paies_agent_foreign` (`agent`),
  ADD KEY `liste_paies_sagent_foreign` (`sAgent`),
  ADD KEY `liste_paies_pymt_foreign` (`pymt`),
  ADD KEY `liste_paies_contrat_foreign` (`contrat`),
  ADD KEY `liste_paies_signature_foreign` (`signature`);

--
-- Indexes for table `livre_caisses`
--
ALTER TABLE `livre_caisses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `livre_caisses_reference_unique` (`reference`),
  ADD KEY `livre_caisses_signature_foreign` (`signature`),
  ADD KEY `livre_caisses_projet_foreign` (`projet`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_conversation_id_foreign` (`conversation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `missions_reference_unique` (`reference`),
  ADD KEY `missions_signature_foreign` (`signature`),
  ADD KEY `missions_tr_foreign` (`tr`);

--
-- Indexes for table `mouvements`
--
ALTER TABLE `mouvements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mouvements_reference_unique` (`reference`),
  ADD KEY `mouvements_signature_foreign` (`signature`),
  ADD KEY `mouvements_agent_foreign` (`agent`);

--
-- Indexes for table `nds`
--
ALTER TABLE `nds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nds_reference_unique` (`reference`),
  ADD KEY `nds_agent_foreign` (`agent`),
  ADD KEY `nds_projet_foreign` (`projet`);

--
-- Indexes for table `nd_oders`
--
ALTER TABLE `nd_oders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nd_oders_reference_unique` (`reference`),
  ADD KEY `nd_oders_nd_foreign` (`nd`);

--
-- Indexes for table `ops`
--
ALTER TABLE `ops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ops_reference_unique` (`reference`),
  ADD UNIQUE KEY `ops_numero_unique` (`numero`),
  ADD KEY `ops_agent_foreign` (`agent`),
  ADD KEY `ops_projet_foreign` (`projet`),
  ADD KEY `ops_bp_foreign` (`bp`);

--
-- Indexes for table `part_contrats`
--
ALTER TABLE `part_contrats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `part_contrats_reference_unique` (`reference`),
  ADD KEY `part_contrats_signature_foreign` (`signature`),
  ADD KEY `part_contrats_projet_foreign` (`projet`),
  ADD KEY `part_contrats_contrat_foreign` (`contrat`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payement_agents`
--
ALTER TABLE `payement_agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payement_agents_reference_unique` (`reference`),
  ADD KEY `payement_agents_signature_foreign` (`signature`),
  ADD KEY `payement_agents_taux_foreign` (`taux`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prices_reference_unique` (`reference`),
  ADD KEY `prices_signature_foreign` (`signature`),
  ADD KEY `prices_product_foreign` (`product`);

--
-- Indexes for table `prix_pvs`
--
ALTER TABLE `prix_pvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prix_pvs_reference_unique` (`reference`),
  ADD KEY `prix_pvs_signature_foreign` (`signature`),
  ADD KEY `prix_pvs_pv_foreign` (`pv`),
  ADD KEY `prix_pvs_proforma_foreign` (`proforma`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_reference_unique` (`reference`),
  ADD KEY `products_signature_foreign` (`signature`),
  ADD KEY `products_categorie_foreign` (`categorie`);

--
-- Indexes for table `product_oders`
--
ALTER TABLE `product_oders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_oders_reference_unique` (`reference`),
  ADD KEY `product_oders_product_foreign` (`product`),
  ADD KEY `product_oders_etatbes_foreign` (`etatBes`);

--
-- Indexes for table `proformas`
--
ALTER TABLE `proformas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proformas_reference_unique` (`reference`),
  ADD KEY `proformas_signature_foreign` (`signature`),
  ADD KEY `proformas_da_foreign` (`da`),
  ADD KEY `proformas_fournisseur_foreign` (`fournisseur`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projets_reference_unique` (`reference`),
  ADD KEY `projets_signature_foreign` (`signature`),
  ADD KEY `projets_bailleur_foreign` (`bailleur`);

--
-- Indexes for table `pvs`
--
ALTER TABLE `pvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pvs_reference_unique` (`reference`),
  ADD KEY `pvs_signature_foreign` (`signature`),
  ADD KEY `pvs_da_foreign` (`da`),
  ADD KEY `pvs_fournisseur_foreign` (`fournisseur`);

--
-- Indexes for table `r_caisses`
--
ALTER TABLE `r_caisses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `r_caisses_reference_unique` (`reference`),
  ADD KEY `r_caisses_projet_foreign` (`projet`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_reference_unique` (`reference`);

--
-- Indexes for table `signature_pvs`
--
ALTER TABLE `signature_pvs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `signature_pvs_reference_unique` (`reference`),
  ADD KEY `signature_pvs_pv_foreign` (`pv`);

--
-- Indexes for table `statut_agents`
--
ALTER TABLE `statut_agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statut_agents_reference_unique` (`reference`),
  ADD KEY `statut_agents_signature_foreign` (`signature`),
  ADD KEY `statut_agents_agent_foreign` (`agent`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stocks_reference_unique` (`reference`),
  ADD KEY `stocks_product_foreign` (`product`),
  ADD KEY `stocks_project_foreign` (`project`);

--
-- Indexes for table `tauxes`
--
ALTER TABLE `tauxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tauxes_user_foreign` (`user`);

--
-- Indexes for table `trs`
--
ALTER TABLE `trs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trs_reference_unique` (`reference`),
  ADD KEY `trs_agent_foreign` (`agent`),
  ADD KEY `trs_projet_foreign` (`projet`);

--
-- Indexes for table `tr_oders`
--
ALTER TABLE `tr_oders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tr_oders_reference_unique` (`reference`),
  ADD KEY `tr_oders_tr_foreign` (`tr`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_reference_unique` (`reference`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_agent_foreign` (`agent`);

--
-- Indexes for table `valid_bcs`
--
ALTER TABLE `valid_bcs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_bcs_user_foreign` (`user`),
  ADD KEY `valid_bcs_bc_foreign` (`bc`);

--
-- Indexes for table `valid_bps`
--
ALTER TABLE `valid_bps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_bps_user_foreign` (`user`),
  ADD KEY `valid_bps_bp_foreign` (`bp`);

--
-- Indexes for table `valid_conges`
--
ALTER TABLE `valid_conges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_conges_user_foreign` (`user`),
  ADD KEY `valid_conges_conge_foreign` (`conge`);

--
-- Indexes for table `valid_das`
--
ALTER TABLE `valid_das`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_das_signature_foreign` (`signature`),
  ADD KEY `valid_das_user_foreign` (`user`),
  ADD KEY `valid_das_da_foreign` (`da`);

--
-- Indexes for table `valid_dis`
--
ALTER TABLE `valid_dis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_dis_user_foreign` (`user`),
  ADD KEY `valid_dis_di_foreign` (`di`);

--
-- Indexes for table `valid_ebs`
--
ALTER TABLE `valid_ebs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_ebs_signature_foreign` (`signature`),
  ADD KEY `valid_ebs_user_foreign` (`user`),
  ADD KEY `valid_ebs_eb_foreign` (`eb`);

--
-- Indexes for table `valid_mvnts`
--
ALTER TABLE `valid_mvnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_mvnts_user_foreign` (`user`),
  ADD KEY `valid_mvnts_mvnt_foreign` (`mvnt`);

--
-- Indexes for table `valid_nds`
--
ALTER TABLE `valid_nds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_nds_user_foreign` (`user`),
  ADD KEY `valid_nds_nd_foreign` (`nd`);

--
-- Indexes for table `valid_paies`
--
ALTER TABLE `valid_paies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_paies_user_foreign` (`user`),
  ADD KEY `valid_paies_paie_foreign` (`paie`);

--
-- Indexes for table `valid_trs`
--
ALTER TABLE `valid_trs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `valid_trs_user_foreign` (`user`),
  ADD KEY `valid_trs_tr_foreign` (`tr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affectations`
--
ALTER TABLE `affectations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3409;

--
-- AUTO_INCREMENT for table `agent_missions`
--
ALTER TABLE `agent_missions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bailleurs`
--
ALTER TABLE `bailleurs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bcs`
--
ALTER TABLE `bcs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bes`
--
ALTER TABLE `bes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bps`
--
ALTER TABLE `bps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brs`
--
ALTER TABLE `brs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `br_oders`
--
ALTER TABLE `br_oders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cheques`
--
ALTER TABLE `cheques`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conges`
--
ALTER TABLE `conges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decharges`
--
ALTER TABLE `decharges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dem_aches`
--
ALTER TABLE `dem_aches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dis`
--
ALTER TABLE `dis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `di_oders`
--
ALTER TABLE `di_oders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `et_bes`
--
ALTER TABLE `et_bes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fourn_prices`
--
ALTER TABLE `fourn_prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lignes`
--
ALTER TABLE `lignes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=484;

--
-- AUTO_INCREMENT for table `liste_paies`
--
ALTER TABLE `liste_paies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `livre_caisses`
--
ALTER TABLE `livre_caisses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mouvements`
--
ALTER TABLE `mouvements`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nds`
--
ALTER TABLE `nds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nd_oders`
--
ALTER TABLE `nd_oders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ops`
--
ALTER TABLE `ops`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `part_contrats`
--
ALTER TABLE `part_contrats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payement_agents`
--
ALTER TABLE `payement_agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prix_pvs`
--
ALTER TABLE `prix_pvs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_oders`
--
ALTER TABLE `product_oders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `proformas`
--
ALTER TABLE `proformas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pvs`
--
ALTER TABLE `pvs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_caisses`
--
ALTER TABLE `r_caisses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `signature_pvs`
--
ALTER TABLE `signature_pvs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `statut_agents`
--
ALTER TABLE `statut_agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tauxes`
--
ALTER TABLE `tauxes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=988;

--
-- AUTO_INCREMENT for table `trs`
--
ALTER TABLE `trs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tr_oders`
--
ALTER TABLE `tr_oders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2360;

--
-- AUTO_INCREMENT for table `valid_bcs`
--
ALTER TABLE `valid_bcs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `valid_bps`
--
ALTER TABLE `valid_bps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `valid_conges`
--
ALTER TABLE `valid_conges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `valid_das`
--
ALTER TABLE `valid_das`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `valid_dis`
--
ALTER TABLE `valid_dis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `valid_ebs`
--
ALTER TABLE `valid_ebs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `valid_mvnts`
--
ALTER TABLE `valid_mvnts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `valid_nds`
--
ALTER TABLE `valid_nds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `valid_paies`
--
ALTER TABLE `valid_paies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `valid_trs`
--
ALTER TABLE `valid_trs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectations`
--
ALTER TABLE `affectations`
  ADD CONSTRAINT `affectations_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `affectations_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `affectations_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `agents`
--
ALTER TABLE `agents`
  ADD CONSTRAINT `agents_service_foreign` FOREIGN KEY (`service`) REFERENCES `services` (`id`);

--
-- Constraints for table `agent_missions`
--
ALTER TABLE `agent_missions`
  ADD CONSTRAINT `agent_missions_ms_foreign` FOREIGN KEY (`ms`) REFERENCES `missions` (`id`);

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_product_foreign` FOREIGN KEY (`product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `articles_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `bailleurs`
--
ALTER TABLE `bailleurs`
  ADD CONSTRAINT `bailleurs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `bcs`
--
ALTER TABLE `bcs`
  ADD CONSTRAINT `bcs_da_foreign` FOREIGN KEY (`da`) REFERENCES `dem_aches` (`id`),
  ADD CONSTRAINT `bcs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `bes`
--
ALTER TABLE `bes`
  ADD CONSTRAINT `bes_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `bes_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `bes_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `bps`
--
ALTER TABLE `bps`
  ADD CONSTRAINT `bps_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `bps_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `brs`
--
ALTER TABLE `brs`
  ADD CONSTRAINT `brs_bc_foreign` FOREIGN KEY (`bc`) REFERENCES `bcs` (`id`),
  ADD CONSTRAINT `brs_fournisseur_foreign` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseurs` (`id`),
  ADD CONSTRAINT `brs_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `brs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `br_oders`
--
ALTER TABLE `br_oders`
  ADD CONSTRAINT `br_oders_bc_foreign` FOREIGN KEY (`bc`) REFERENCES `bcs` (`id`),
  ADD CONSTRAINT `br_oders_br_foreign` FOREIGN KEY (`br`) REFERENCES `brs` (`id`),
  ADD CONSTRAINT `br_oders_produit_foreign` FOREIGN KEY (`produit`) REFERENCES `articles` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `cheques`
--
ALTER TABLE `cheques`
  ADD CONSTRAINT `cheques_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cheques_bp_foreign` FOREIGN KEY (`bp`) REFERENCES `bps` (`id`),
  ADD CONSTRAINT `cheques_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `comptes`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `conges_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `contrats_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `contrats_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_from_foreign` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `conversations_to_foreign` FOREIGN KEY (`to`) REFERENCES `users` (`id`);

--
-- Constraints for table `decharges`
--
ALTER TABLE `decharges`
  ADD CONSTRAINT `decharges_bp_foreign` FOREIGN KEY (`bp`) REFERENCES `bps` (`id`),
  ADD CONSTRAINT `decharges_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `decharges_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `dem_aches`
--
ALTER TABLE `dem_aches`
  ADD CONSTRAINT `dem_aches_eb_foreign` FOREIGN KEY (`eb`) REFERENCES `et_bes` (`id`),
  ADD CONSTRAINT `dem_aches_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `dis`
--
ALTER TABLE `dis`
  ADD CONSTRAINT `dis_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dis_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `di_oders`
--
ALTER TABLE `di_oders`
  ADD CONSTRAINT `di_oders_di_foreign` FOREIGN KEY (`di`) REFERENCES `dis` (`id`),
  ADD CONSTRAINT `di_oders_product_foreign` FOREIGN KEY (`product`) REFERENCES `articles` (`id`);

--
-- Constraints for table `et_bes`
--
ALTER TABLE `et_bes`
  ADD CONSTRAINT `et_bes_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `et_bes_categorie_foreign` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `et_bes_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD CONSTRAINT `fournisseurs_catproduct_foreign` FOREIGN KEY (`catProduct`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `fournisseurs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `fourn_prices`
--
ALTER TABLE `fourn_prices`
  ADD CONSTRAINT `fourn_prices_fournisseur_foreign` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseurs` (`id`),
  ADD CONSTRAINT `fourn_prices_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `liste_paies`
--
ALTER TABLE `liste_paies`
  ADD CONSTRAINT `liste_paies_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `liste_paies_contrat_foreign` FOREIGN KEY (`contrat`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `liste_paies_pymt_foreign` FOREIGN KEY (`pymt`) REFERENCES `payement_agents` (`id`),
  ADD CONSTRAINT `liste_paies_sagent_foreign` FOREIGN KEY (`sAgent`) REFERENCES `statut_agents` (`id`),
  ADD CONSTRAINT `liste_paies_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `livre_caisses`
--
ALTER TABLE `livre_caisses`
  ADD CONSTRAINT `livre_caisses_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `livre_caisses_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`),
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `missions_tr_foreign` FOREIGN KEY (`tr`) REFERENCES `trs` (`id`);

--
-- Constraints for table `mouvements`
--
ALTER TABLE `mouvements`
  ADD CONSTRAINT `mouvements_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `mouvements_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `nds`
--
ALTER TABLE `nds`
  ADD CONSTRAINT `nds_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nds_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `nd_oders`
--
ALTER TABLE `nd_oders`
  ADD CONSTRAINT `nd_oders_nd_foreign` FOREIGN KEY (`nd`) REFERENCES `nds` (`id`);

--
-- Constraints for table `ops`
--
ALTER TABLE `ops`
  ADD CONSTRAINT `ops_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ops_bp_foreign` FOREIGN KEY (`bp`) REFERENCES `bps` (`id`),
  ADD CONSTRAINT `ops_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `part_contrats`
--
ALTER TABLE `part_contrats`
  ADD CONSTRAINT `part_contrats_contrat_foreign` FOREIGN KEY (`contrat`) REFERENCES `contrats` (`id`),
  ADD CONSTRAINT `part_contrats_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `part_contrats_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `payement_agents`
--
ALTER TABLE `payement_agents`
  ADD CONSTRAINT `payement_agents_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payement_agents_taux_foreign` FOREIGN KEY (`taux`) REFERENCES `tauxes` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_product_foreign` FOREIGN KEY (`product`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `prices_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `prix_pvs`
--
ALTER TABLE `prix_pvs`
  ADD CONSTRAINT `prix_pvs_proforma_foreign` FOREIGN KEY (`proforma`) REFERENCES `proformas` (`id`),
  ADD CONSTRAINT `prix_pvs_pv_foreign` FOREIGN KEY (`pv`) REFERENCES `pvs` (`id`),
  ADD CONSTRAINT `prix_pvs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categorie_foreign` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_oders`
--
ALTER TABLE `product_oders`
  ADD CONSTRAINT `product_oders_etatbes_foreign` FOREIGN KEY (`etatBes`) REFERENCES `et_bes` (`id`),
  ADD CONSTRAINT `product_oders_product_foreign` FOREIGN KEY (`product`) REFERENCES `articles` (`id`);

--
-- Constraints for table `proformas`
--
ALTER TABLE `proformas`
  ADD CONSTRAINT `proformas_da_foreign` FOREIGN KEY (`da`) REFERENCES `dem_aches` (`id`),
  ADD CONSTRAINT `proformas_fournisseur_foreign` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseurs` (`id`),
  ADD CONSTRAINT `proformas_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_bailleur_foreign` FOREIGN KEY (`bailleur`) REFERENCES `bailleurs` (`id`),
  ADD CONSTRAINT `projets_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `pvs`
--
ALTER TABLE `pvs`
  ADD CONSTRAINT `pvs_da_foreign` FOREIGN KEY (`da`) REFERENCES `dem_aches` (`id`),
  ADD CONSTRAINT `pvs_fournisseur_foreign` FOREIGN KEY (`fournisseur`) REFERENCES `fournisseurs` (`id`),
  ADD CONSTRAINT `pvs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `r_caisses`
--
ALTER TABLE `r_caisses`
  ADD CONSTRAINT `r_caisses_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `signature_pvs`
--
ALTER TABLE `signature_pvs`
  ADD CONSTRAINT `signature_pvs_pv_foreign` FOREIGN KEY (`pv`) REFERENCES `pvs` (`id`);

--
-- Constraints for table `statut_agents`
--
ALTER TABLE `statut_agents`
  ADD CONSTRAINT `statut_agents_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`),
  ADD CONSTRAINT `statut_agents_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_product_foreign` FOREIGN KEY (`product`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_project_foreign` FOREIGN KEY (`project`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tauxes`
--
ALTER TABLE `tauxes`
  ADD CONSTRAINT `tauxes_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `trs`
--
ALTER TABLE `trs`
  ADD CONSTRAINT `trs_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `trs_projet_foreign` FOREIGN KEY (`projet`) REFERENCES `projets` (`id`);

--
-- Constraints for table `tr_oders`
--
ALTER TABLE `tr_oders`
  ADD CONSTRAINT `tr_oders_tr_foreign` FOREIGN KEY (`tr`) REFERENCES `trs` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_agent_foreign` FOREIGN KEY (`agent`) REFERENCES `agents` (`id`);

--
-- Constraints for table `valid_bcs`
--
ALTER TABLE `valid_bcs`
  ADD CONSTRAINT `valid_bcs_bc_foreign` FOREIGN KEY (`bc`) REFERENCES `bcs` (`id`),
  ADD CONSTRAINT `valid_bcs_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_bps`
--
ALTER TABLE `valid_bps`
  ADD CONSTRAINT `valid_bps_bp_foreign` FOREIGN KEY (`bp`) REFERENCES `bps` (`id`),
  ADD CONSTRAINT `valid_bps_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_conges`
--
ALTER TABLE `valid_conges`
  ADD CONSTRAINT `valid_conges_conge_foreign` FOREIGN KEY (`conge`) REFERENCES `conges` (`id`),
  ADD CONSTRAINT `valid_conges_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_das`
--
ALTER TABLE `valid_das`
  ADD CONSTRAINT `valid_das_da_foreign` FOREIGN KEY (`da`) REFERENCES `dem_aches` (`id`),
  ADD CONSTRAINT `valid_das_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `valid_das_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_dis`
--
ALTER TABLE `valid_dis`
  ADD CONSTRAINT `valid_dis_di_foreign` FOREIGN KEY (`di`) REFERENCES `dis` (`id`),
  ADD CONSTRAINT `valid_dis_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_ebs`
--
ALTER TABLE `valid_ebs`
  ADD CONSTRAINT `valid_ebs_eb_foreign` FOREIGN KEY (`eb`) REFERENCES `et_bes` (`id`),
  ADD CONSTRAINT `valid_ebs_signature_foreign` FOREIGN KEY (`signature`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `valid_ebs_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_mvnts`
--
ALTER TABLE `valid_mvnts`
  ADD CONSTRAINT `valid_mvnts_mvnt_foreign` FOREIGN KEY (`mvnt`) REFERENCES `mouvements` (`id`),
  ADD CONSTRAINT `valid_mvnts_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_nds`
--
ALTER TABLE `valid_nds`
  ADD CONSTRAINT `valid_nds_nd_foreign` FOREIGN KEY (`nd`) REFERENCES `nds` (`id`),
  ADD CONSTRAINT `valid_nds_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_paies`
--
ALTER TABLE `valid_paies`
  ADD CONSTRAINT `valid_paies_paie_foreign` FOREIGN KEY (`paie`) REFERENCES `liste_paies` (`id`),
  ADD CONSTRAINT `valid_paies_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `valid_trs`
--
ALTER TABLE `valid_trs`
  ADD CONSTRAINT `valid_trs_tr_foreign` FOREIGN KEY (`tr`) REFERENCES `trs` (`id`),
  ADD CONSTRAINT `valid_trs_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
