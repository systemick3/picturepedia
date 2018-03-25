-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: picturepedia
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filemime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filesize` bigint(20) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `files_filepath_unique` (`filepath`),
  KEY `files_user_id_foreign` (`user_id`),
  KEY `files_created_at_index` (`created_at`),
  KEY `files_updated_at_index` (`updated_at`),
  KEY `files_status_index` (`status`),
  CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (7,1,'banner_large.jpg','storage/images/4ca0dc6b674e23bb140ea130a701a366.jpg','jpg',119638,1,'2017-11-30 12:38:54','2017-11-30 12:42:58'),(8,2,'banner-head-image-about-where.jpeg','storage/images/d4b65abb3afb58b25f68374ac3f85629.jpeg','jpeg',198717,1,'2017-12-03 14:57:35','2017-12-03 14:57:48'),(9,2,'banner-head-image-campaign-contact.jpg','storage/images/578489804881fc946f774efcb636bcf9.jpg','jpg',425134,1,'2017-12-03 15:04:17','2017-12-03 15:04:20'),(10,1,'banner-head-image-campaign-priorities.jpeg','storage/images/79707edbe6bcf0ae580a76c5837495eb.jpeg','jpeg',314278,1,'2017-12-03 15:37:51','2017-12-03 15:37:54'),(11,2,'banner-head-image-about-how.jpeg','storage/images/0cef322a79d8e26adf464154b4972c52.jpeg','jpeg',178304,1,'2017-12-03 16:11:59','2017-12-03 16:12:02'),(12,2,'banner-head-image-campaign-priorities.jpeg','storage/images/63243282b8bc6590c720a8a3a22371a2.jpeg','jpeg',314278,1,'2017-12-03 16:28:02','2017-12-03 16:28:05'),(13,1,'banner_large.jpg','storage/images/2bdc21ae0d2509751b110264104005d1.jpg','jpg',119638,1,'2017-12-03 16:42:03','2017-12-03 16:42:06'),(14,2,'banner_large.jpg','storage/images/4460c160ca0ae72265dbf2ba7e5aa089.jpg','jpg',119638,1,'2017-12-03 16:48:38','2017-12-03 16:48:41'),(15,2,'banner-head-image.jpg','storage/images/f5df1f310058fa511452f5bea4d2e24a.jpg','jpg',1011011,1,'2017-12-03 16:50:03','2017-12-03 16:50:06'),(16,2,'banner_large.jpg','storage/images/88e942ccb1de98ddadc90956b710a6a8.jpg','jpg',119638,1,'2017-12-03 16:52:03','2017-12-03 16:52:06'),(17,2,'banner-head-image-campaign-priorities.jpeg','storage/images/3448bda259e7c7b56ae6786b023a9e73.jpeg','jpeg',314278,1,'2017-12-03 16:57:47','2017-12-03 16:57:50'),(18,2,'banner-head-image-campaign-contact.jpg','storage/images/c9e81aefe23d959f13f6f0a178f5bd8a.jpg','jpg',425134,1,'2017-12-03 16:59:31','2017-12-03 16:59:34'),(19,2,'banner-head-image-campaign-contact.jpg','storage/images/04c021cdad56c64435102691ef7550c7.jpg','jpg',425134,1,'2017-12-03 17:00:23','2017-12-03 17:03:54'),(20,2,'banner_large.jpg','storage/images/853c3bf1ac5338dfd2832860a6054cbf.jpg','jpg',119638,1,'2017-12-03 17:04:31','2017-12-03 17:04:33'),(21,2,'banner-head-image-what.jpeg','storage/images/4d6da5a7321d3e3773268c02bf299178.jpeg','jpeg',101716,1,'2017-12-03 17:10:12','2017-12-03 17:10:15'),(22,2,'banner-head-image-campaign-involved.jpg','storage/images/6fc4e30cd2c0459a4565bcdf0051ee6b.jpg','jpg',361475,1,'2017-12-03 17:14:26','2017-12-03 17:14:29'),(23,2,'banner_large.jpg','storage/images/98255a3fb9b2d301a585ad8871eadfc2.jpg','jpg',119638,1,'2017-12-03 17:16:07','2017-12-03 17:16:10'),(24,2,'banner-head-image-about-how.jpeg','storage/images/dafb43e13ed4cb8af19f7078e118aa68.jpeg','jpeg',178304,1,'2017-12-03 17:18:24','2017-12-03 17:19:30'),(25,2,'banner_large.jpg','storage/images/4984527b9d1b05ce94d1adf94e53fdf7.jpg','jpg',119638,1,'2017-12-06 16:07:10','2017-12-06 16:07:14'),(26,2,'banner-head-image-about-how.jpeg','storage/images/dd42edeac64268420317d120ad724605.jpeg','jpeg',178304,1,'2017-12-06 16:11:52','2017-12-06 16:23:42'),(27,1,'banner-head-image-campaign-contact.jpg','storage/images/82b9b346c3bb4519f4cfc77245128178.jpg','jpg',425134,1,'2017-12-06 16:31:04','2017-12-06 16:31:08'),(28,2,'banner-head-image-campaign-work.jpg','storage/images/cebcaded23cd72169577da471608bea7.jpg','jpg',415093,1,'2017-12-06 16:32:49','2017-12-06 16:32:51'),(29,2,'banner-head-image-procurement.jpeg','storage/images/d25ccc4fc3ede43f6f395dba42af3cb7.jpeg','jpeg',779421,1,'2017-12-06 16:47:40','2017-12-06 16:47:50'),(30,2,'banner-head-image-about-who-we-are.jpeg','storage/images/82723a729657534862135cbd684984e4.jpeg','jpeg',165844,1,'2017-12-06 16:51:55','2017-12-06 16:51:57'),(31,2,'banner-head-image-campaign.jpeg','storage/images/f1cc2b45b925cd6d4e8473778b05c3a1.jpeg','jpeg',405626,1,'2017-12-06 17:06:49','2017-12-06 17:06:52'),(32,2,'banner-head-image-campaign-festival.jpg','storage/images/d8266445023a8bd5f426ba6b2bba91d7.jpg','jpg',353092,1,'2017-12-06 17:39:38','2017-12-06 17:39:41'),(33,2,'banner-head-image-campaign-priorities.jpeg','storage/images/2dc6a8a3929833d950e81386f51c491e.jpeg','jpeg',314278,1,'2017-12-06 17:54:13','2017-12-06 18:06:50'),(34,2,'banner_large.jpg','storage/images/c5e799f327ed6dd4ac5d53b867c36842.jpg','jpg',119638,1,'2017-12-06 18:14:31','2017-12-06 18:14:34'),(35,2,'banner_large.jpg','storage/images/576eade131db996640fd2ea6102c9e99.jpg','jpg',119638,1,'2017-12-06 18:19:39','2017-12-06 18:19:42'),(36,2,'banner-head-image-about-why.jpeg','storage/images/55d9ce1d1bb189f4ed19b3ed6a26a4bb.jpeg','jpeg',137041,1,'2017-12-06 18:26:00','2017-12-06 18:26:03'),(37,2,'banner-head-image-about-how.jpeg','storage/images/cbce004b8aea153678f2c6a06c1c808a.jpeg','jpeg',178304,1,'2017-12-11 11:02:33','2017-12-11 11:02:45'),(38,2,'banner_large.jpg','storage/images/b6989379bdc4dbe271a3fdb0ab8cbfa4.jpg','jpg',119638,1,'2017-12-11 11:05:09','2017-12-11 11:05:09'),(39,2,'banner-head-image-about-where.jpeg','storage/images/1cdba1af91e0baaee1e17f3324f54ab6.jpeg','jpeg',198717,1,'2017-12-11 11:08:24','2017-12-11 11:14:39'),(40,2,'banner-head-image-about-why.jpeg','storage/images/2703db3095238d28798eee0ecdb740d6.jpeg','jpeg',137041,1,'2017-12-11 11:19:26','2017-12-11 11:19:39'),(41,2,'banner-head-image-about.jpeg','storage/images/8e50a298f8493278d0eb5c4aff83003b.jpeg','jpeg',160201,1,'2017-12-11 11:39:06','2017-12-11 11:39:10'),(42,2,'banner-head-image-campaign-contact.jpg','storage/images/04f42eb872eae46bae9b105c6c1c0130.jpg','jpg',425134,1,'2017-12-11 11:45:22','2017-12-11 11:45:25'),(43,2,'banner_large.jpg','storage/images/9fef99ff2625f31cd72907d41b9d51b9.jpg','jpg',119638,1,'2017-12-11 11:46:36','2017-12-11 11:46:39'),(44,2,'banner-head-image-campaign-thinkers.jpg','storage/images/2e01106318c27b30a2bfeae0abc9d496.jpg','jpg',405626,1,'2017-12-11 11:47:56','2017-12-11 11:47:59'),(45,2,'banner-head-image-campaign-festival.jpg','storage/images/1234e254dee3b056f7cfd380728de5e9.jpg','jpg',353092,1,'2017-12-11 11:56:05','2017-12-11 11:56:08'),(46,2,'banner-head-image-chamber.jpg','storage/images/8f8434183ce7cec5b8d9baf9e2558a5b.jpg','jpg',1011011,1,'2017-12-11 11:58:48','2017-12-11 11:58:51'),(47,2,'banner-head-image-campaign.jpg','storage/images/9c1997781009822d88f58d67e8a595ea.jpg','jpg',128662,1,'2017-12-11 12:11:05','2017-12-11 12:11:08'),(48,2,'banner-head-image-campaign-festival.jpg','storage/images/78c4ac25f70d690ccff42aec190e2503.jpg','jpg',353092,1,'2017-12-11 12:16:28','2017-12-11 12:16:31'),(49,2,'banner-head-image-campaign-priorities.jpeg','storage/images/3530bf9483d29acdcebf5415c43ccfd0.jpeg','jpeg',314278,1,'2017-12-11 12:17:35','2017-12-11 12:17:40'),(50,2,'banner-head-image-campaign-contact.jpg','storage/images/a5e932818693aeafeeb0f0882ddea870.jpg','jpg',425134,1,'2017-12-11 12:23:44','2017-12-11 12:23:47'),(51,2,'banner-head-image-about.jpeg','storage/images/865426fbfafeeb560257308de463dbf1.jpeg','jpeg',160201,1,'2017-12-11 13:08:56','2017-12-11 13:08:59'),(52,2,'banner-head-image-about-why.jpeg','storage/images/60b0ec9c3946ca7f740836617667eb30.jpeg','jpeg',137041,1,'2017-12-11 13:22:19','2017-12-11 13:22:22'),(53,2,'banner-head-image-about-why.jpeg','storage/images/83ac0c40f2c4602ac0e008bc6520d4de.jpeg','jpeg',137041,1,'2017-12-11 13:24:51','2017-12-11 13:24:54'),(54,2,'banner-head-image-medical-school-about.jpeg','storage/images/68f77676b613973964ca4af04c2573a7.jpeg','jpeg',43014,1,'2017-12-11 13:28:23','2017-12-11 13:28:29'),(55,2,'banner-head-image-campaign-priorities.jpeg','storage/images/592b90b678f7d8d738fa88bd29c4c9b7.jpeg','jpeg',314278,1,'2018-01-09 10:32:29','2018-01-09 10:32:46'),(56,1,'banner-head-image-campaign-contact.jpg','storage/images/9e313b836418f63b2cdb4336311a0238.jpg','jpg',425134,1,'2018-01-09 10:45:44','2018-01-09 10:45:47'),(57,2,'banner-head-image-campaign-priorities.jpeg','storage/images/c947c23be0502a23cf1b02c6a066f877.jpeg','jpeg',314278,1,'2018-01-09 10:51:14','2018-01-09 10:51:17'),(58,2,'banner-head-image-bi-multilingualism.jpeg','storage/images/f7c3fe9742e027035b471fdeb86cc775.jpeg','jpeg',86811,1,'2018-01-09 10:54:02','2018-01-09 10:54:07'),(59,2,'banner-head-image-drc.png','storage/images/044e842d1d1d5792e2043e67161a8439.png','png',1745675,1,'2018-01-09 10:55:31','2018-01-09 10:55:34');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_11_18_154607_create_files_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'systemick','michaelgarthwaite@gmail.com','$2y$10$snIKLYRitzOShhCxmAFU4OyqRo7PraVVmLbY4l8DJkR5uz2.hD23O',NULL,'2017-11-30 12:12:04','2017-11-30 12:12:04'),(2,'user_1','michael@systemick.co.uk','$2y$10$/lkndS25GnlKKJhhe/U3g.0kz7nNf6zp.VCL62RE.pyqy7T9CGpY.','4ShEyiRYh2Z2aZIiKOGJqfxN1GCWkZPXIYH6DRVqbudKyvDdce3p7Li4RV1W','2017-12-03 14:57:21','2017-12-03 14:57:21'),(3,'Mrs. Lilla Hermann','ygutkowski@example.net','$2y$10$lP4DDBGJ3DCkahNyzx5UkOs8S.pm9sRGQUt9UhVuQ06Uo1ja6eDfa','2V1qZGXL3v','2018-01-09 13:22:44','2018-01-09 13:22:44'),(4,'user_2','user_2@systemick.co.uk','$2y$10$/SyhewlId0m4cbu5DYSyY.0pquXr9w13e8Sfg/MsDW1W.cplvy/RS',NULL,'2018-01-09 13:27:54','2018-01-09 13:27:54'),(5,'Cecile Koepp','weston53@example.net','$2y$10$LKFadFYaWJuH8QWSTiFhme639Uvr9A/kxH9AS8xX.U.jdIRWzhEPK','f57JEqkBLz','2018-01-09 13:28:34','2018-01-09 13:28:34'),(6,'Ollie Altenwerth','ara.schultz@example.com','$2y$10$ezWh/k9GmO6s1u15JoiKQ.xGfGGldtk0Eevv.P4ACM4GamYmXa5RW','4FcNla2SKb','2018-01-09 13:29:35','2018-01-09 13:29:35'),(7,'Aracely Rohan III','vblock@example.com','$2y$10$GCukp.Yzckddi30.J/e1k.keDahOwZBUJ/z6jqPZoLLn5erxu9J0a','UGSORlRYYr','2018-01-09 13:30:36','2018-01-09 13:30:36');
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

-- Dump completed on 2018-01-09 14:55:17
