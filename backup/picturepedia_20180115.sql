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
  `post_id` int(10) unsigned DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filepath` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filemime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filesize` bigint(20) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `files_filepath_unique` (`filepath`),
  KEY `files_created_at_index` (`created_at`),
  KEY `files_updated_at_index` (`updated_at`),
  KEY `files_status_index` (`status`),
  KEY `files_post_id_foreign` (`post_id`),
  CONSTRAINT `files_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (7,7,'banner_large.jpg','storage/images/32fbc0434c4eb2cfafc0dfd39758c679.jpg','jpg',119638,1,'2018-01-09 17:46:53','2018-01-09 17:46:56'),(8,8,'banner-head-image-hebrew-jewish.jpeg','storage/images/e259a26d7ce7c1361c14209dc21041e9.jpeg','jpeg',936311,1,'2018-01-10 15:03:16','2018-01-10 15:03:21'),(9,9,'banner-head-image-lsf-alumni.jpeg','storage/images/fd0c14cc8e01b0872a85ad246710849e.jpeg','jpeg',112669,1,'2018-01-10 16:59:47','2018-01-10 16:59:50'),(10,10,'banner-head-image.jpg','storage/images/ecab7065b40d96781ea0148fa26e91fc.jpg','jpg',1011011,1,'2018-01-10 17:02:15','2018-01-10 17:02:18'),(17,NULL,'mikegarthwaite.jpg','storage/images/ad62b8d41d3835ea8144ba867bd12b32.jpg','jpg',35015,1,'2018-01-13 11:04:12','2018-01-13 11:07:50'),(18,NULL,'banner-head-image-campaign-contact.jpg','storage/images/ef956388e0bfaa8eca0670e775876c49.jpg','jpg',425134,1,'2018-01-14 19:31:16','2018-01-14 19:35:56'),(19,NULL,'banner-head-image-campaign-work.jpg','storage/images/837efe3dd672135405d66b7ff6078429.jpg','jpg',415093,1,'2018-01-14 19:36:11','2018-01-14 19:36:15'),(20,NULL,'user_avatar-128.png','storage/images/37dee88010da6c3e8543e8f33d7c3a43.png','png',3192,1,'2018-01-15 15:35:23','2018-01-15 15:35:52'),(21,NULL,'User-128.png','storage/images/e826296f9ea948fe14c7dcf70eafe6e1.png','png',3965,1,'2018-01-15 15:37:25','2018-01-15 15:37:28'),(22,NULL,'default-avatar.png','storage/images/default/default-avatar.png','png',3965,1,'2018-01-15 15:42:11','2018-01-15 15:42:11');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `follower_id` int(10) unsigned NOT NULL,
  `followee_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `follows_follower_id_followee_id_unique` (`follower_id`,`followee_id`),
  KEY `follows_followee_id_foreign` (`followee_id`),
  CONSTRAINT `follows_followee_id_foreign` FOREIGN KEY (`followee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `follows_follower_id_foreign` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (3,1,2,NULL,NULL),(7,9,2,NULL,NULL),(8,9,1,NULL,NULL);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(10,'2017_11_18_154607_create_files_table',2),(11,'2018_01_09_150239_remove_user_id_from_files',2),(12,'2018_01_09_150702_create_posts_table',2),(13,'2018_01_09_150822_add_post_id_to_files',2),(17,'2018_01_10_125257_create_follows_table',3),(18,'2018_01_12_103910_add_file_id_to_users',3),(21,'2018_01_12_111638_make_post_id_null_on_users',4);
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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (7,2,'The systemick background image.','2018-01-09 17:46:53','2018-01-09 17:47:26'),(8,1,'','2018-01-10 15:03:16','2018-01-10 15:03:16'),(9,2,'','2018-01-10 16:59:47','2018-01-10 16:59:47'),(10,2,'Music notes','2018-01-10 17:02:15','2018-01-10 17:02:30');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
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
  `file_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_file_id_foreign` (`file_id`),
  CONSTRAINT `users_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'systemick','michaelgarthwaite@gmail.com','$2y$10$snIKLYRitzOShhCxmAFU4OyqRo7PraVVmLbY4l8DJkR5uz2.hD23O',NULL,'2017-11-30 12:12:04','2017-11-30 12:12:04',NULL),(2,'user_1','michael@systemick.co.uk','$2y$10$/lkndS25GnlKKJhhe/U3g.0kz7nNf6zp.VCL62RE.pyqy7T9CGpY.','4ShEyiRYh2Z2aZIiKOGJqfxN1GCWkZPXIYH6DRVqbudKyvDdce3p7Li4RV1W','2017-12-03 14:57:21','2017-12-03 14:57:21',NULL),(3,'Mrs. Lilla Hermann','ygutkowski@example.net','$2y$10$lP4DDBGJ3DCkahNyzx5UkOs8S.pm9sRGQUt9UhVuQ06Uo1ja6eDfa','2V1qZGXL3v','2018-01-09 13:22:44','2018-01-09 13:22:44',NULL),(5,'Cecile Koepp','weston53@example.net','$2y$10$LKFadFYaWJuH8QWSTiFhme639Uvr9A/kxH9AS8xX.U.jdIRWzhEPK','f57JEqkBLz','2018-01-09 13:28:34','2018-01-09 13:28:34',NULL),(6,'Ollie Altenwerth','ara.schultz@example.com','$2y$10$ezWh/k9GmO6s1u15JoiKQ.xGfGGldtk0Eevv.P4ACM4GamYmXa5RW','4FcNla2SKb','2018-01-09 13:29:35','2018-01-09 13:29:35',NULL),(7,'Aracely Rohan III','vblock@example.com','$2y$10$GCukp.Yzckddi30.J/e1k.keDahOwZBUJ/z6jqPZoLLn5erxu9J0a','UGSORlRYYr','2018-01-09 13:30:36','2018-01-09 13:30:36',NULL),(9,'user_2','user_2@example.com','$2y$10$CKGX.SyWzTe0P.zKJwXqheji7wXFMfavUoV.aluVH1wQYNdPAPxmG',NULL,'2018-01-14 17:43:45','2018-01-15 15:37:25',21);
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

-- Dump completed on 2018-01-15 16:54:39
