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
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (44,NULL,'default-avatar.png','storage/images/default/','png',3965,1,'2018-01-23 16:57:41','2018-01-23 16:57:41'),(68,NULL,'a71e343b2ccafbaf29a8f65e83b5a72b.png','storage/images/profile/','png',12453,1,'2018-01-26 19:25:52','2018-01-26 19:26:19'),(69,38,'02515304fcf88437327fa0d096612416.jpg','storage/images/','jpg',119638,1,'2018-01-26 19:26:31','2018-01-26 19:28:18'),(70,NULL,'d9129eddc9948398fb88e8320df88aa4.png','storage/images/profile/','png',4144,1,'2018-01-26 19:29:06','2018-01-26 19:29:48'),(71,NULL,'a0a856b269e849de8079b892a4478a1b.jpg','storage/images/profile/','jpg',117073,1,'2018-01-26 19:29:56','2018-01-26 19:30:05'),(72,NULL,'88d4e981a6f2302914a0e3f6fe9aa70e.png','storage/images/profile/','png',12453,1,'2018-01-26 19:30:42','2018-01-26 19:30:55'),(81,47,'1f29360436959c42d68262003ccc73b1.jpeg','storage/images/','jpeg',86811,1,'2018-01-28 17:33:27','2018-01-28 17:33:31'),(82,48,'d9e7798cfc2bf438fb5e2725d3ac97de.jpg','storage/images/','jpg',1011011,1,'2018-01-28 18:23:26','2018-01-28 18:23:31'),(85,NULL,'1e4da4b8134ce96249bd67ae61c1de42.png','storage/images/profile/','png',4144,1,'2018-01-28 19:42:02','2018-01-28 19:42:14'),(86,49,'56452a8c02825dd7da05cd9abda12009.jpeg','storage/images/','jpeg',86811,1,'2018-02-18 17:31:57','2018-02-18 17:32:02'),(87,50,'0c4b85eacc8d36d5ea99bb2d4aa4615f.jpg','storage/images/','jpg',1011011,1,'2018-02-18 17:40:06','2018-02-18 17:40:09'),(88,51,'9049efee2305099a5e11629fef5a6e82.jpeg','storage/images/','jpeg',89719,1,'2018-02-18 17:41:46','2018-02-18 17:41:50'),(89,52,'f3f0daf62eeeb65450530ab25ddb7a14.jpg','storage/images/','jpg',119638,1,'2018-02-18 17:43:55','2018-02-18 17:44:08'),(90,53,'da5ca58bc896b286adff8a33be15acc2.jpeg','storage/images/','jpeg',86811,1,'2018-02-18 17:48:36','2018-02-18 17:48:39'),(91,54,'a286124503d9544e6433e6433025b7d8.jpg','storage/images/','jpg',119638,1,'2018-02-18 18:01:03','2018-02-18 18:01:10'),(92,55,'2b9bb3fb5641a03ad32f74d6045e885c.jpeg','storage/images/','jpeg',86811,1,'2018-02-18 18:02:34','2018-02-18 18:02:37'),(93,56,'fefc6e65c511acec8edf7d7580303190.jpeg','storage/images/','jpeg',185092,1,'2018-02-18 18:09:38','2018-02-18 18:09:42'),(94,57,'01230ad933df7ae05f60e166b2be9c7e.jpg','storage/images/','jpg',119638,1,'2018-02-18 18:30:04','2018-02-18 18:30:06'),(95,58,'779f8e93bb4235922d67263540ff6d39.jpg','storage/images/','jpg',1011011,1,'2018-02-19 19:01:05','2018-02-19 19:01:09'),(96,59,'a33088f2df8515d246757a273e1d996e.jpeg','storage/images/','jpeg',86811,1,'2018-02-19 19:03:39','2018-02-19 19:03:47'),(97,60,'e718be2cd5aae5cc3677a4d2549dd770.jpeg','storage/images/','jpeg',86811,1,'2018-02-19 19:09:09','2018-02-19 19:09:12'),(98,61,'7270216abb3299833295e0349a4f883b.jpg','storage/images/','jpg',119638,1,'2018-02-19 19:11:08','2018-02-19 19:11:12'),(99,62,'091e6757f8275c1cf45b9368da047b77.jpg','storage/images/','jpg',1011011,1,'2018-02-19 19:12:35','2018-02-19 19:12:38'),(100,64,'260228e69b5b2b9bfd6f75dc02807681.jpeg','storage/images/','jpeg',89719,1,'2018-02-19 19:13:30','2018-02-19 19:19:39'),(101,65,'76a45acbacbbb1b1dafa986e94c01be9.jpg','storage/images/','jpg',119638,1,'2018-02-19 19:22:19','2018-02-19 19:22:22'),(102,66,'d9725284d8f49665c3b645cfe5dcc0e9.jpg','storage/images/','jpg',1011011,1,'2018-02-19 19:27:30','2018-02-19 19:27:35'),(103,66,'e718be2cd5aae5cc3677a4d2549dd770.jpeg','storage/images/','jpeg',86811,1,'2018-02-25 16:17:37','2018-02-25 16:17:37'),(104,66,'f3f0daf62eeeb65450530ab25ddb7a14.jpg','storage/images/','jpg',119638,1,'2018-02-25 16:19:02','2018-02-25 16:19:02'),(105,64,'f3f0daf62eeeb65450530ab25ddb7a14.jpg','storage/images/','jpg',119638,1,'2018-02-27 09:59:36','2018-02-27 09:59:36'),(106,64,'d9725284d8f49665c3b645cfe5dcc0e9.jpg','storage/images/','jpg',1011011,1,'2018-02-27 10:00:26','2018-02-27 10:00:26'),(107,NULL,'5643ead820f70e6e49752e2ecc6ee5d4.jpg','storage/images/','jpg',119638,1,'2018-02-27 10:12:55','2018-02-27 10:12:55'),(108,67,'eb45e70bf85e837b79c0054668c228e7.jpg','storage/images/','jpg',119638,1,'2018-02-27 11:46:45','2018-02-27 11:46:50'),(109,70,'cc653ad4d1df6ad02d8756cc8be354de.jpg','storage/images/','jpg',1011011,1,'2018-02-27 11:47:27','2018-02-27 11:56:51'),(110,71,'357df476a891c6880543c9c1278cd5a8.jpg','storage/images/','jpg',119638,1,'2018-02-27 12:33:07','2018-02-27 12:33:11'),(111,72,'8f5ba424fc68d2072ae0a18e82d7fd78.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 12:40:19','2018-02-27 12:40:24'),(112,73,'57a1c04601ed522188db7e84bcb0d215.jpg','storage/images/','jpg',1011011,1,'2018-02-27 12:43:37','2018-02-27 12:43:40'),(113,74,'b1d5565bd38e563f86fdd2029f66f04c.jpg','storage/images/','jpg',119638,1,'2018-02-27 12:45:41','2018-02-27 12:45:44'),(114,75,'d77b07dd28170e858afb1f0bd3892ab9.jpg','storage/images/','jpg',1011011,1,'2018-02-27 12:48:25','2018-02-27 12:48:30'),(115,76,'25d3faddd935d10429b28823067c3c2b.jpg','storage/images/','jpg',119638,1,'2018-02-27 12:49:54','2018-02-27 12:49:58'),(116,77,'ca11199938136ec47fe06e446dbccbef.jpg','storage/images/','jpg',119638,1,'2018-02-27 12:50:43','2018-02-27 12:50:46'),(117,78,'8a4b43ccaf0fa01af9b2c7620eb6ee19.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 12:54:48','2018-02-27 12:54:51'),(118,79,'278eff61e2a5a4406f68b1eca80f9790.jpg','storage/images/','jpg',119638,1,'2018-02-27 12:56:18','2018-02-27 12:56:24'),(119,80,'6b62b5c1d489722ff1445850c83e89ae.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 12:57:41','2018-02-27 12:57:45'),(120,81,'598c83cbdb0ad0ceddcfdf5b724a8c12.jpg','storage/images/','jpg',1011011,1,'2018-02-27 13:02:25','2018-02-27 13:02:29'),(121,83,'81c6419d4174a63c45c4ad28a2fb7b33.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 13:59:08','2018-02-27 14:00:10'),(122,84,'7500fd90bae846ac52c277783c5cf876.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:07:42','2018-02-27 14:07:45'),(123,85,'ee9b651c13851b363e2ad25424625905.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:08:13','2018-02-27 14:08:16'),(124,86,'5d3ae9001298d53e89778134479815aa.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:14:12','2018-02-27 14:14:26'),(125,86,'57cbe7555d2d425dadd97b9d3c3e1791.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:14:47','2018-02-27 14:14:51'),(126,86,'ae1e2e1357cdf00294a3f47b45fba216.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:15:24','2018-02-27 14:15:28'),(127,87,'3e9296fc22717dd8f17232939346c5c8.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:17:49','2018-02-27 14:17:52'),(128,87,'737cc2b7e5e6b9b55d0f3e2fec790c29.jpeg','storage/images/','jpeg',779421,1,'2018-02-27 14:18:07','2018-02-27 14:24:48'),(129,88,'ff294debe4e33c6f1ee2172b444458d9.jpeg','storage/images/','jpeg',89719,1,'2018-02-27 14:27:37','2018-02-27 14:27:41'),(130,88,'0f3d0968f1d2d463343a2434bcc66de6.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:27:53','2018-02-27 14:27:57'),(131,89,'fad557a40215ac98a1755f05491e5932.jpeg','storage/images/','jpeg',89719,1,'2018-02-27 14:37:02','2018-02-27 14:37:06'),(132,89,'cdc729cd5e3128dbfd0fbd6dea65feb6.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:37:18','2018-02-27 14:37:29'),(133,90,'a333d2034c7c9eff0adf60646a313438.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:43:03','2018-02-27 14:43:07'),(134,90,'392ec1db5221608c03a687ae0fb5926e.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:43:17','2018-02-27 14:43:33'),(135,90,'13130de1d7a782c53d2207d8c993aa26.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:43:46','2018-02-27 14:43:50'),(136,90,'a17fc793b8920ac01b6e2ae85a7d4573.jpeg','storage/images/','jpeg',89719,1,'2018-02-27 14:44:03','2018-02-27 14:44:06'),(137,90,'d900d96ef65a7c808483ff83390d4dc0.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:44:16','2018-02-27 14:44:19'),(138,90,'ef3cf0386f21e0275bc3e7a0ba030b3a.jpeg','storage/images/','jpeg',185092,1,'2018-02-27 14:44:33','2018-02-27 14:44:36'),(139,91,'9bafaac35589e63797da4cd463f75952.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:46:18','2018-02-27 14:46:22'),(140,91,'4cb0cd112abfa1b55ce4f1b947d0ff88.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:46:31','2018-02-27 14:46:34'),(141,91,'84201cd2875a12cc7f4b202ece1ad853.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:46:46','2018-02-27 14:46:48'),(142,91,'a083f3dcf0eacfabe17084ec60512351.jpeg','storage/images/','jpeg',89719,1,'2018-02-27 14:47:00','2018-02-27 14:47:03'),(143,91,'dbd5500b96ad6aeb60309644f59fdf18.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:47:16','2018-02-27 14:47:19'),(144,91,'0b252e8000c9f3d79f4ec69649589230.jpeg','storage/images/','jpeg',185092,1,'2018-02-27 14:47:28','2018-02-27 14:47:31'),(145,92,'cf66c9c76d3a63dc8044c4d05d2486e4.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:49:47','2018-02-27 14:49:51'),(146,92,'7172739582495068f23887f55851f149.jpeg','storage/images/','jpeg',779421,1,'2018-02-27 14:50:08','2018-02-27 14:50:10'),(147,93,'284f593638ace42104090c83d9677562.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:51:05','2018-02-27 14:51:07'),(148,93,'2ced73cf24387a6ce83f4036ca4e0d95.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:51:22','2018-02-27 14:51:25'),(149,93,'da5c8691361e30a9785d50c156fd3a38.jpeg','storage/images/','jpeg',779421,1,'2018-02-27 14:51:36','2018-02-27 14:51:39'),(150,94,'af0e847038f1db0eb46f9e5bec805468.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:52:19','2018-02-27 14:52:22'),(151,94,'271b5ad47c3eb7b1571f692cd99b2646.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:52:30','2018-02-27 14:52:34'),(152,94,'18d0ba9b901fe4a04dc8f6f0c32b45c8.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:52:44','2018-02-27 14:52:46'),(153,94,'6828194124451cfbda9ad5cd10219227.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:52:59','2018-02-27 14:53:01'),(154,95,'b3245a49137433fc48c4dabd32c4ae8d.jpg','storage/images/','jpg',119638,1,'2018-02-27 14:53:50','2018-02-27 14:53:53'),(155,95,'47103d8166adacaa5920758ddd2acd2d.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:54:04','2018-02-27 14:54:08'),(156,95,'56059725e94d7b01a1281fb5cc5cea93.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 14:54:17','2018-02-27 14:54:20'),(157,95,'b00c1597fa36aecfeafe5e8195983add.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:54:30','2018-02-27 14:54:33'),(158,95,'3b7a2c76198a1888386662cdce4c312d.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:54:53','2018-02-27 14:54:55'),(159,96,'dc1b83ccb8c4e228dde4908e48067952.jpg','storage/images/','jpg',1011011,1,'2018-02-27 14:55:15','2018-02-27 14:55:18'),(160,96,'ee4d15d3247176265ac339bb1a74ff1e.jpeg','storage/images/','jpeg',779421,1,'2018-02-27 14:55:27','2018-02-27 14:55:30'),(161,96,'2478abc67e22ab2e4820e7ed049251e1.jpeg','storage/images/','jpeg',185092,1,'2018-02-27 14:55:38','2018-02-27 14:55:41'),(162,96,'52aff9b76851bb852fc7b5e950e134ef.jpeg','storage/images/','jpeg',113930,1,'2018-02-27 14:55:49','2018-02-27 14:55:52'),(163,96,'f161c6823f2963f28bce310eca6a0e7f.jpeg','storage/images/','jpeg',89719,1,'2018-02-27 14:56:05','2018-02-27 14:56:08'),(164,97,'691deeb8ddedb909fea850d202b2d9d8.jpg','storage/images/','jpg',119638,1,'2018-02-27 17:27:21','2018-02-27 17:27:24'),(165,97,'228c37a06895268c615ced699728a018.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 17:31:28','2018-02-27 17:31:32'),(166,98,'df4f04fd01588656cc1a134bf77c715e.jpg','storage/images/','jpg',1011011,1,'2018-02-27 17:43:11','2018-02-27 17:43:15'),(167,98,'ae3f94e998776916c36e0dd69042e872.jpeg','storage/images/','jpeg',779421,1,'2018-02-27 17:43:58','2018-02-27 17:44:01'),(168,98,'c8eb2fa5792da049bc2d2a77e6a34bf2.jpg','storage/images/','jpg',1011011,1,'2018-02-27 17:46:45','2018-02-27 17:46:48'),(169,98,'a765e96f22f657048d5c67a916fa119b.jpeg','storage/images/','jpeg',86811,1,'2018-02-27 17:47:04','2018-02-27 17:47:07');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
INSERT INTO `follows` VALUES (1,2,12,NULL,NULL),(2,13,12,NULL,NULL),(4,12,2,NULL,NULL),(5,2,14,NULL,NULL),(6,12,14,NULL,NULL),(7,13,14,NULL,NULL),(8,2,15,NULL,NULL),(9,3,15,NULL,NULL),(10,5,15,NULL,NULL),(11,6,15,NULL,NULL);
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hashtags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hashtag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hashtags_hashtag_unique` (`hashtag`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hashtags`
--

LOCK TABLES `hashtags` WRITE;
/*!40000 ALTER TABLE `hashtags` DISABLE KEYS */;
INSERT INTO `hashtags` VALUES (1,'systemick',2,'2018-02-18 18:01:42','2018-02-18 18:30:39'),(2,'testing',2,'2018-02-18 18:01:42','2018-02-19 19:27:57'),(3,'banner',1,'2018-02-18 18:01:42','2018-02-18 18:30:39'),(4,'language',0,'2018-02-18 18:03:18','2018-02-18 18:03:18'),(5,'columns',0,'2018-02-18 18:10:06','2018-02-18 18:10:06'),(6,'tested',0,'2018-02-18 18:30:39','2018-02-18 18:30:39'),(7,'music',1,'2018-02-19 19:27:57','2018-02-19 19:27:57'),(8,'multiple',1,'2018-02-27 14:15:49','2018-02-27 14:15:49');
/*!40000 ALTER TABLE `hashtags` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(10,'2017_11_18_154607_create_files_table',2),(11,'2018_01_09_150239_remove_user_id_from_files',2),(12,'2018_01_09_150702_create_posts_table',2),(13,'2018_01_09_150822_add_post_id_to_files',2),(17,'2018_01_10_125257_create_follows_table',3),(18,'2018_01_12_103910_add_file_id_to_users',3),(21,'2018_01_12_111638_make_post_id_null_on_users',4),(22,'2018_01_15_164731_add_first_last_name_to_users',5),(24,'2018_01_16_170115_add_description_to_users',6),(25,'2018_01_17_193723_create_likes_table',7),(27,'2018_01_20_094827_create_comments_table',8),(28,'2018_01_23_173320_remove_unique_filepath_index_on_files',9),(30,'2018_01_23_174438_remove_user_cascade_on_file_delete',10),(33,'2018_02_18_170132_create_hashtags_table',11);
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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (38,2,'Hello World','2018-01-26 19:28:18','2018-01-26 19:28:28'),(47,12,'Yo la tenga.','2018-01-28 17:33:31','2018-01-28 17:33:38'),(48,12,'Yippety doo da. #mike #testing','2018-01-28 18:23:31','2018-01-28 18:23:58'),(49,2,'Testing hashtag creation #language #testing','2018-02-18 17:32:02','2018-02-18 17:38:09'),(50,2,'More testing hashtags #testing #hashtag','2018-02-18 17:40:09','2018-02-18 17:40:50'),(51,2,'qrfqe qerqe #camera #testing','2018-02-18 17:41:50','2018-02-18 17:42:15'),(52,2,'Testing saving #systemick #testing','2018-02-18 17:44:08','2018-02-18 17:44:33'),(53,2,'Bi multilingualism #language #tested','2018-02-18 17:48:39','2018-02-18 17:49:10'),(54,2,'Testing hashtag creation #systemick #testing #banner','2018-02-18 18:01:10','2018-02-18 18:01:42'),(55,2,'Second hashtag test #systemick #testing #language','2018-02-18 18:02:37','2018-02-18 18:03:18'),(56,2,'Testing hashtag refactor #testing #columns','2018-02-18 18:09:42','2018-02-18 18:10:06'),(57,2,'Testing short search #banner #systemick #tested','2018-02-18 18:30:06','2018-02-18 18:30:39'),(58,2,'Musical notes #music #testing','2018-02-19 19:01:09','2018-02-19 19:01:32'),(59,2,'Bi multilingualism #words #testing','2018-02-19 19:03:47','2018-02-19 19:04:16'),(60,2,'More words #words #testing','2018-02-19 19:09:12','2018-02-19 19:09:29'),(61,2,'#bannner #testing #computer','2018-02-19 19:11:12','2018-02-19 19:11:41'),(62,2,'#music #testing','2018-02-19 19:12:38','2018-02-19 19:12:55'),(63,2,'#testing #camera','2018-02-19 19:13:33','2018-02-19 19:18:26'),(64,2,'#testing #camera','2018-02-19 19:19:39','2018-02-19 19:19:57'),(65,2,'#camera','2018-02-19 19:22:22','2018-02-19 19:24:16'),(66,2,'#music #testing','2018-02-19 19:27:35','2018-02-19 19:27:57'),(67,2,'qergqeqfq','2018-02-27 11:46:50','2018-02-27 11:47:16'),(68,2,'','2018-02-27 11:52:35','2018-02-27 11:52:35'),(69,2,'','2018-02-27 11:55:07','2018-02-27 11:55:07'),(70,2,'','2018-02-27 11:56:51','2018-02-27 11:56:51'),(71,12,'Hello World','2018-02-27 12:33:11','2018-02-27 12:33:29'),(72,12,'','2018-02-27 12:40:24','2018-02-27 12:40:24'),(73,12,'','2018-02-27 12:43:40','2018-02-27 12:43:40'),(74,12,'','2018-02-27 12:45:44','2018-02-27 12:45:44'),(75,12,'','2018-02-27 12:48:30','2018-02-27 12:48:30'),(76,12,'','2018-02-27 12:49:58','2018-02-27 12:49:58'),(77,12,'Hey ya','2018-02-27 12:50:46','2018-02-27 12:51:00'),(78,12,'Hello world','2018-02-27 12:54:51','2018-02-27 12:55:12'),(79,12,'Yo la tenga','2018-02-27 12:56:24','2018-02-27 12:56:42'),(80,12,'Yo la tenga.','2018-02-27 12:57:45','2018-02-27 12:58:02'),(81,12,'This is mike.','2018-02-27 13:02:29','2018-02-27 13:04:20'),(82,12,'','2018-02-27 13:59:11','2018-02-27 13:59:11'),(83,12,'Yey ya','2018-02-27 14:00:10','2018-02-27 14:01:03'),(84,12,'','2018-02-27 14:07:45','2018-02-27 14:07:45'),(85,12,'','2018-02-27 14:08:16','2018-02-27 14:08:16'),(86,12,'Hello World #multiple','2018-02-27 14:14:26','2018-02-27 14:15:49'),(87,12,'','2018-02-27 14:17:52','2018-02-27 14:17:52'),(88,12,'Hey world','2018-02-27 14:27:41','2018-02-27 14:28:19'),(89,12,'Hello there.','2018-02-27 14:37:06','2018-02-27 14:37:59'),(90,12,'','2018-02-27 14:43:07','2018-02-27 14:43:07'),(91,12,'Hello with 6 pictures','2018-02-27 14:46:22','2018-02-27 14:48:15'),(92,12,'Hello with 2 pictures','2018-02-27 14:49:51','2018-02-27 14:50:32'),(93,12,'','2018-02-27 14:51:07','2018-02-27 14:51:07'),(94,12,'','2018-02-27 14:52:22','2018-02-27 14:52:22'),(95,12,'','2018-02-27 14:53:53','2018-02-27 14:53:53'),(96,12,'','2018-02-27 14:55:18','2018-02-27 14:55:18'),(97,12,'eqrgqergfqe','2018-02-27 17:27:24','2018-02-27 17:40:40'),(98,12,'','2018-02-27 17:43:15','2018-02-27 17:43:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'user_1','User','One','Hey there I\'m user 1','user_1@example.com','$2y$10$/lkndS25GnlKKJhhe/U3g.0kz7nNf6zp.VCL62RE.pyqy7T9CGpY.','qqXVo74AQGcDpGO6H8ZoHJqsOjNxpRpfWwmyWwQciLrG2RjIkeivALzcCTG1','2017-12-03 14:57:21','2018-01-26 19:30:42',72),(3,'Mrs. Lilla Hermann','','','','ygutkowski@example.net','$2y$10$lP4DDBGJ3DCkahNyzx5UkOs8S.pm9sRGQUt9UhVuQ06Uo1ja6eDfa','2V1qZGXL3v','2018-01-09 13:22:44','2018-01-09 13:22:44',NULL),(5,'Cecile Koepp','','','','weston53@example.net','$2y$10$LKFadFYaWJuH8QWSTiFhme639Uvr9A/kxH9AS8xX.U.jdIRWzhEPK','f57JEqkBLz','2018-01-09 13:28:34','2018-01-09 13:28:34',NULL),(6,'Ollie Altenwerth','','','','ara.schultz@example.com','$2y$10$ezWh/k9GmO6s1u15JoiKQ.xGfGGldtk0Eevv.P4ACM4GamYmXa5RW','4FcNla2SKb','2018-01-09 13:29:35','2018-01-09 13:29:35',NULL),(7,'Aracely Rohan III','','','','vblock@example.com','$2y$10$GCukp.Yzckddi30.J/e1k.keDahOwZBUJ/z6jqPZoLLn5erxu9J0a','UGSORlRYYr','2018-01-09 13:30:36','2018-01-09 13:30:36',NULL),(10,'Dr. Enid Douglas IV','','','','cletus.bailey@example.org','$2y$10$c8l8jQya.IhOvdZ7ZFhBv.WC/BdwpZ7Sgox2xaQQlbWEoZgUn847O','EyxPgI0IkX','2018-01-16 16:05:01','2018-01-16 16:05:01',NULL),(11,'Jordan Mills','','','','anderson.guadalupe@example.net','$2y$10$Jsg5sNeb7G8o97xblSxoAuInK8oY1OWmGFCH1QRr7lVszkdhr506u','u2Jf2gApQs','2018-01-16 16:13:48','2018-01-16 16:13:48',NULL),(12,'user_2','User','Two','user two dude ok.','user_2@example.com','$2y$10$1KxyHIgUlg0a1iIGF/Ufau6YwUmS8o/LJyqj3Vbyurp6bk8h4BoAq','nFMkULZOuCU7Xmq0dEKtYENoA3vWwZWCmFcNBYXCBz418ieQ3kz7YRnlrqYm','2018-01-23 16:47:05','2018-01-28 19:42:02',85),(13,'systemick','','','','michaelgarthwaite@gmail.com','$2y$10$BZ.0IwLTclsnhYxShMdvEeQ2cPZKl5XyNwJlsg3.qkB4KaqivjIxm',NULL,'2018-01-23 16:47:56','2018-01-23 16:47:56',NULL),(14,'test_1','','','','test_1@example.com','$2y$10$G8lkOZ1nnlBBNuOYRovMd.Pfa4Q8iPvvAcmp0Xr2S0/aS52CZSSym',NULL,'2018-02-19 19:29:47','2018-02-19 19:29:47',NULL),(15,'test_2','','','','test_2@example.com','$2y$10$dUeb/1Zjo.BPKe95/29G8.iO67SYVWKxhEnxqp1Tqcr5v0SNcXYp2',NULL,'2018-02-21 19:16:57','2018-02-21 19:16:57',NULL),(16,'Jamal Pacocha','','','','joany.bashirian@example.org','$2y$10$Ktugdyqd5Q3zq/IE7eZISuibkSOX5xKx6ntFqTdq5f8ibrwxPcORe','MFgR9SPRaK','2018-02-28 11:23:39','2018-02-28 11:23:39',NULL),(17,'aeargfqergfqe','','','','ergfqergqe@example.com','$2y$10$YRfJJeNvuEZO8rgImf7l1.iQk1mCobvwtIu0i94BNnBpFveyyUTxi','sUHmYxm7EoHwryfeiYLdOHMejzUQN36HIgjZ7aKqhJBNZT0fl2kZPpe8qZf0','2018-02-28 17:06:31','2018-02-28 17:06:31',NULL),(27,'test_3','','','','KlOQT7u2MktXOjl@example.com','$2y$10$P5POeidEu32bZFt.d8j/3uCF28nxdcQHo6eb6pky7hLJYpNJqX6hO',NULL,'2018-02-28 19:11:27','2018-02-28 19:11:27',NULL),(28,'test_3','','','','snzcKazYEa6CB7Z@example.com','$2y$10$M/krUQsJFxB4D2RzRREyQ.LzRDiJ5Iqb0wwmwZlfanCUzwcOWIquS',NULL,'2018-02-28 19:15:01','2018-02-28 19:15:01',NULL);
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

-- Dump completed on 2018-02-28 19:21:30
