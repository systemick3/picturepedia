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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (3,'Mike #testing',12,48,'2018-01-28 18:27:47','2018-01-28 18:27:47'),(4,'Mike #testing',12,47,'2018-01-28 18:30:53','2018-01-28 18:30:53'),(5,'#testing',12,48,'2018-01-28 18:31:39','2018-01-28 18:31:39'),(6,'#testing',2,47,'2018-01-28 18:32:27','2018-01-28 18:32:27');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

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
  KEY `files_created_at_index` (`created_at`),
  KEY `files_updated_at_index` (`updated_at`),
  KEY `files_status_index` (`status`),
  KEY `files_post_id_foreign` (`post_id`),
  CONSTRAINT `files_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (44,NULL,'default-avatar.png','storage/images/default/','png',3965,1,'2018-01-23 16:57:41','2018-01-23 16:57:41'),(68,NULL,'a71e343b2ccafbaf29a8f65e83b5a72b.png','storage/images/profile/','png',12453,1,'2018-01-26 19:25:52','2018-01-26 19:26:19'),(69,38,'02515304fcf88437327fa0d096612416.jpg','storage/images/','jpg',119638,1,'2018-01-26 19:26:31','2018-01-26 19:28:18'),(70,NULL,'d9129eddc9948398fb88e8320df88aa4.png','storage/images/profile/','png',4144,1,'2018-01-26 19:29:06','2018-01-26 19:29:48'),(71,NULL,'a0a856b269e849de8079b892a4478a1b.jpg','storage/images/profile/','jpg',117073,1,'2018-01-26 19:29:56','2018-01-26 19:30:05'),(72,NULL,'88d4e981a6f2302914a0e3f6fe9aa70e.png','storage/images/profile/','png',12453,1,'2018-01-26 19:30:42','2018-01-26 19:30:55'),(81,47,'1f29360436959c42d68262003ccc73b1.jpeg','storage/images/','jpeg',86811,1,'2018-01-28 17:33:27','2018-01-28 17:33:31'),(82,48,'d9e7798cfc2bf438fb5e2725d3ac97de.jpg','storage/images/','jpg',1011011,1,'2018-01-28 18:23:26','2018-01-28 18:23:31'),(85,NULL,'1e4da4b8134ce96249bd67ae61c1de42.png','storage/images/profile/','png',4144,1,'2018-01-28 19:42:02','2018-01-28 19:42:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (1,2,12,NULL,NULL),(2,13,12,NULL,NULL),(4,12,2,NULL,NULL);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `likes_user_id_foreign` (`user_id`),
  KEY `likes_post_id_foreign` (`post_id`),
  CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(10,'2017_11_18_154607_create_files_table',2),(11,'2018_01_09_150239_remove_user_id_from_files',2),(12,'2018_01_09_150702_create_posts_table',2),(13,'2018_01_09_150822_add_post_id_to_files',2),(17,'2018_01_10_125257_create_follows_table',3),(18,'2018_01_12_103910_add_file_id_to_users',3),(21,'2018_01_12_111638_make_post_id_null_on_users',4),(22,'2018_01_15_164731_add_first_last_name_to_users',5),(24,'2018_01_16_170115_add_description_to_users',6),(25,'2018_01_17_193723_create_likes_table',7),(27,'2018_01_20_094827_create_comments_table',8),(28,'2018_01_23_173320_remove_unique_filepath_index_on_files',9),(30,'2018_01_23_174438_remove_user_cascade_on_file_delete',10);
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (38,2,'Hello World','2018-01-26 19:28:18','2018-01-26 19:28:28'),(47,12,'Yo la tenga.','2018-01-28 17:33:31','2018-01-28 17:33:38'),(48,12,'Yippety doo da. #mike #testing','2018-01-28 18:23:31','2018-01-28 18:23:58');
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
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_file_id_foreign` (`file_id`),
  CONSTRAINT `users_file_id_foreign` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'user_1','User','One','Hey there I\'m user 1','user_1@example.com','$2y$10$/lkndS25GnlKKJhhe/U3g.0kz7nNf6zp.VCL62RE.pyqy7T9CGpY.','4ShEyiRYh2Z2aZIiKOGJqfxN1GCWkZPXIYH6DRVqbudKyvDdce3p7Li4RV1W','2017-12-03 14:57:21','2018-01-26 19:30:42',72),(3,'Mrs. Lilla Hermann','','','','ygutkowski@example.net','$2y$10$lP4DDBGJ3DCkahNyzx5UkOs8S.pm9sRGQUt9UhVuQ06Uo1ja6eDfa','2V1qZGXL3v','2018-01-09 13:22:44','2018-01-09 13:22:44',NULL),(5,'Cecile Koepp','','','','weston53@example.net','$2y$10$LKFadFYaWJuH8QWSTiFhme639Uvr9A/kxH9AS8xX.U.jdIRWzhEPK','f57JEqkBLz','2018-01-09 13:28:34','2018-01-09 13:28:34',NULL),(6,'Ollie Altenwerth','','','','ara.schultz@example.com','$2y$10$ezWh/k9GmO6s1u15JoiKQ.xGfGGldtk0Eevv.P4ACM4GamYmXa5RW','4FcNla2SKb','2018-01-09 13:29:35','2018-01-09 13:29:35',NULL),(7,'Aracely Rohan III','','','','vblock@example.com','$2y$10$GCukp.Yzckddi30.J/e1k.keDahOwZBUJ/z6jqPZoLLn5erxu9J0a','UGSORlRYYr','2018-01-09 13:30:36','2018-01-09 13:30:36',NULL),(10,'Dr. Enid Douglas IV','','','','cletus.bailey@example.org','$2y$10$c8l8jQya.IhOvdZ7ZFhBv.WC/BdwpZ7Sgox2xaQQlbWEoZgUn847O','EyxPgI0IkX','2018-01-16 16:05:01','2018-01-16 16:05:01',NULL),(11,'Jordan Mills','','','','anderson.guadalupe@example.net','$2y$10$Jsg5sNeb7G8o97xblSxoAuInK8oY1OWmGFCH1QRr7lVszkdhr506u','u2Jf2gApQs','2018-01-16 16:13:48','2018-01-16 16:13:48',NULL),(12,'user_2','User','Two','user two dude ok.','user_2@example.com','$2y$10$1KxyHIgUlg0a1iIGF/Ufau6YwUmS8o/LJyqj3Vbyurp6bk8h4BoAq','dGzueiFljeALbBonq1VNGehJNFPkyy2V4mao1WVTSNzmADkJIcJqs60ktahJ','2018-01-23 16:47:05','2018-01-28 19:42:02',85),(13,'systemick','','','','michaelgarthwaite@gmail.com','$2y$10$BZ.0IwLTclsnhYxShMdvEeQ2cPZKl5XyNwJlsg3.qkB4KaqivjIxm',NULL,'2018-01-23 16:47:56','2018-01-23 16:47:56',NULL);
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

-- Dump completed on 2018-02-18 17:07:32
