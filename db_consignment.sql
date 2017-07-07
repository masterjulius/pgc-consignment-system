-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: db_consignment
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `tbl_consignormeta`
--

DROP TABLE IF EXISTS `tbl_consignormeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_consignormeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_value` bigint(20) NOT NULL,
  `meta_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`,`meta_key_id`,`meta_value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_consignormeta`
--

LOCK TABLES `tbl_consignormeta` WRITE;
/*!40000 ALTER TABLE `tbl_consignormeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_consignormeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_consignors`
--

DROP TABLE IF EXISTS `tbl_consignors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_consignors` (
  `consignor_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `consignor_name` varchar(255) NOT NULL,
  `consignor_address` text NOT NULL,
  `consignor_contact_person` text NOT NULL,
  `consignor_contact_person_position` varchar(255) NOT NULL,
  `consignor_contact_info` varchar(45) NOT NULL,
  `consignor_accreditation_details` text NOT NULL,
  `consignor_is_accredited` tinyint(1) NOT NULL DEFAULT '1',
  `consignor_created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `consignor_created_by` bigint(11) NOT NULL DEFAULT '0',
  `consignor_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `consignor_edited_by` bigint(11) NOT NULL DEFAULT '0',
  `consignor_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`consignor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_consignors`
--

LOCK TABLES `tbl_consignors` WRITE;
/*!40000 ALTER TABLE `tbl_consignors` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_consignors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_department`
--

DROP TABLE IF EXISTS `tbl_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(200) NOT NULL,
  `dept_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dept_created_by` int(11) NOT NULL DEFAULT '0',
  `dept_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_department`
--

LOCK TABLES `tbl_department` WRITE;
/*!40000 ALTER TABLE `tbl_department` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_diseasemeta`
--

DROP TABLE IF EXISTS `tbl_diseasemeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_diseasemeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_disease_id` bigint(20) NOT NULL,
  `meta_value` text NOT NULL,
  `meta_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`,`meta_key_id`,`meta_disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_diseasemeta`
--

LOCK TABLES `tbl_diseasemeta` WRITE;
/*!40000 ALTER TABLE `tbl_diseasemeta` DISABLE KEYS */;
INSERT INTO `tbl_diseasemeta` VALUES (1,18,5,'91ef4698c516c377f6e844555d7340ee4aba73c8ca3930cf0c2a1dbdb81518d7d50088b04ef91ad159ce8667213d665bff527e6be4e84b56f639d2eb892e85f5GoV6Tveeyq7LsVDQ2bORE4AQ4APNQhh5/e3CiCviWjUjNQEn0lzhBOHMG4PtJsLtl8tCf8SnggRvMci2TqWqzrcG9hps78AKs3Rrrb0FnBV4ldntgMX4qmvUFzxt3iQ73rf4pBL89VtiuNo/poq7oduVVQXfjZN5tw3u2j9zDbepXAmBhDcSzG2c1/slK67U2djR+t/a7ueDpn3V5VE7chTp0kvLLAPXxDW34auyPiPZGBBoJ+OAFM6GOwxs9i1V7SGtQh1T9SKIaAaX2I+yXQ==','2017-06-27 08:52:57'),(2,17,5,'95cb046ae17a521a546b2bc28aa87a396e4afac1f29242b95360b05845f68f6188c5f88ec55497ebb9bbfc1bb8a614d5ffb1c42de9fd43a30893201fb458fc9e3CN33FK71oHOZbvbLo0aPg/qh6874vJEiLJ+QdzwpTzTmrdUb4w8KjY04+tW7JV0bkmz6wTns5smTKO3WH5daSJ/pedHyADKO2m1Wfjagjm6BXuvcyyNGWFk+X93M/g3x9rucOKsnopO5KnyV406z1fAjdJTLH4HCOCAaD9dCPOw11Jnax2eaLLTk+DOoNBCQuAYwn5UO7rxkn4+9Pb7qtiaIAoskTAtVhR7Di9uWB4YVofJRZocW9nPkN0KImw0VdmOEpijuJvC4Kz+wcziYxQqrGf1TB128KPc844m6xZp+4/R4zEJtiGS33jETlGD2XZu720q3l/YaYd8t1pj6o6b2cp02OSvopSvkJX2CEEX2y680Zs372hWssazJ0MAqUHbW2U22vdftoIgiEBLvhOaUw7EYm5Uk8RXgnGjD8Rgfs6/ZA8ZDsLIOPl9T1xt64R7ZiVPfyD+ddU0UT4B24zkHVZfEEqoPwWFmPIVtSRHvWiJPJAAQ8j5GRJr5tO4','2017-06-27 08:54:35'),(3,19,5,'{\"date_created\":\"2017-06-27 04:40:48\",\"created_by\":\"1\"}','2017-06-27 10:40:48'),(4,20,5,'{\"date_created\":\"2017-06-27 04:40:55\",\"created_by\":\"1\"}','2017-06-27 10:40:55');
/*!40000 ALTER TABLE `tbl_diseasemeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_diseases`
--

DROP TABLE IF EXISTS `tbl_diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_diseases` (
  `disease_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `disease_name` varchar(255) NOT NULL,
  `disease_description` text,
  `disease_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `disease_created_by` bigint(11) NOT NULL,
  `disease_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `disease_edited_by` bigint(11) NOT NULL DEFAULT '0',
  `disease_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_diseases`
--

LOCK TABLES `tbl_diseases` WRITE;
/*!40000 ALTER TABLE `tbl_diseases` DISABLE KEYS */;
INSERT INTO `tbl_diseases` VALUES (3,'shiva\'s','afafaf','2017-06-23 12:10:30',1,'2017-06-23 15:27:41',1,1),(4,'dis','aafajk\r\n','2017-06-23 14:51:09',1,'2017-06-23 14:51:09',0,1),(5,'dddx','afafa vxxxbx jgjg','2017-06-27 08:52:57',1,'2017-06-27 10:40:55',1,1);
/*!40000 ALTER TABLE `tbl_diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_item_brand`
--

DROP TABLE IF EXISTS `tbl_item_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_item_brand` (
  `brand_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `brand_code` varchar(10) NOT NULL DEFAULT '000000',
  `brand_name` varchar(255) NOT NULL,
  `brand_description` text,
  `brand_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brand_created_by` bigint(11) NOT NULL DEFAULT '0',
  `brand_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `brand_edited_by` bigint(11) NOT NULL DEFAULT '0',
  `brand_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_item_brand`
--

LOCK TABLES `tbl_item_brand` WRITE;
/*!40000 ALTER TABLE `tbl_item_brand` DISABLE KEYS */;
INSERT INTO `tbl_item_brand` VALUES (3,'000000','brand z','this is an updated brand','2017-06-20 12:29:23',1,'2017-06-22 12:03:38',1,1),(4,'000000','bc','afaf','2017-06-20 13:15:37',1,'2017-06-21 11:32:17',0,1),(7,'000000','jhashfaskjfh','aafkjkafhakfha','2017-06-20 13:18:44',1,'2017-06-22 16:07:30',1,0),(15,'000000','paf','nfa lajkf','2017-06-20 14:40:12',1,'2017-06-22 15:18:05',1,0),(19,'000000','bfaf','afaf','2017-06-22 16:07:38',1,'2017-06-22 16:07:38',0,1);
/*!40000 ALTER TABLE `tbl_item_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itembrandmeta`
--

DROP TABLE IF EXISTS `tbl_itembrandmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_itembrandmeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_brand_id` bigint(20) NOT NULL,
  `meta_value` text NOT NULL,
  `meta_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`,`meta_brand_id`,`meta_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itembrandmeta`
--

LOCK TABLES `tbl_itembrandmeta` WRITE;
/*!40000 ALTER TABLE `tbl_itembrandmeta` DISABLE KEYS */;
INSERT INTO `tbl_itembrandmeta` VALUES (31,13,7,'{\"date_created\":\"2017-06-22 10:07:30\",\"created_by\":\"1\"}','2017-06-22 16:07:30'),(32,12,19,'003cdc2bd993e21963c082747598f8fa4e996e6cb885a2fa4d840caba475be1166623e4c14d13cc111ba0419cf8fe5f76a99d4719717bd8e2ead3dd711f45855OuV3KzUCzRVKYomms60Ff2hMVaxS1JONSMLA8qnBYw5CsGJiOF2u3BXKeQPmISuT8Z+JAmdZBe/h86Jmc9Rm9Boatc5HQwTbMWdK19UcsFz/Y79opLmZbpIy0Mfai3DHYHvI067cArOyyeHmuthguj6m3si5767Ano9vY0Gt1jbCd9DlTTHHzr2vShDKFxTkwku0lNAg6H/beQib521XuZHzoW9IJzAvFQo6KCcZpjR3YRUlvmOQ+h8lHHlLG7B7','2017-06-22 16:07:38');
/*!40000 ALTER TABLE `tbl_itembrandmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itemmeta`
--

DROP TABLE IF EXISTS `tbl_itemmeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_itemmeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_item_id` bigint(20) NOT NULL,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_value` text NOT NULL,
  `meta_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`,`meta_item_id`,`meta_key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itemmeta`
--

LOCK TABLES `tbl_itemmeta` WRITE;
/*!40000 ALTER TABLE `tbl_itemmeta` DISABLE KEYS */;
INSERT INTO `tbl_itemmeta` VALUES (17,0,23,'7a22a31e8f04ffd0f3797dec5cc635d48818f753fa43d4fdbc20aa1c7ff94d63b586a1492d1c9bdeb041f651bfafeeea3361e7a5fd905cd7708bef9e1cb2a48b5GFKtVsKWz9LaPZNj6txKrkRMWdy3BJmFGolsnPbMRK5pA/66pjsrBTY1Uxj3fVQ3i6gd5oO+TS3RAMwglOrMAU2tzOxBCKu+CNtH4mkjhugX45yd1Y+wR2hJr2uHJ1hS8lqfHeym/bwlMnzktiFZjdX2JwRuey/5A+vgrhtILBZ3+jhiH+1N2kdmf7IosSnUllRMbJcaqC5t4zGrBqIBRW0pJib+1kkUMyn0MRgMyyrXhwQeikbSfS2X5YDHdKxjnb+TYHTKesXgj+VqGz3te2pAdcT/Cg3I3RxEZM12WTf2kLKJmlkScRrdne9bLA5mBW1zITvUai6+/qhDzsQkEoQSf80vFQ9o3gAcQ6FFdgiyDPu5M8uTEbE4+oc3gtL5HWQ1/DRfijQpyDjF6Cas1nsdXwajGTNAekKenTPtwm1tDuY0gINI9M7bbYPdpx37q+w5XQxJffIJ6tjom/AkmodGfCYektig0AE1tZJVpwvBvfTsAQljSgzW7snmkBi/LNPePcPURB+jSLjWYElJp7FG+QD5scuPvvz0RHWksLVyyiADwDn6Y6i6JNdP6euq5HEO6UTLnGBSkVd3vI+A2vWEKhF625KDJeSXn+Tu1M=','2017-06-30 12:01:22'),(18,0,23,'89759637c11a0741fb542be32995f824a50b56400618208a45948de296a0d871354051383d7d07ae60313afaeb3c758fafb5d1e96b1dacf2c485c983e5346316DvAbuhmawlPyatAyOGS08vWlU7uGS0JMxTGhoa/O57t1UUhy0ypVcutH6iFlTsqESeKS6/9lYzUwMe1UQ+oKZ1kzjHnl7J35gKidKcvzIpXP5HXx1zpnarJseXgEGECb1mcRWhQPpl5hm6H+uB2FQr85bkdAO24IWEpY8ftGrR/xeEMy3rdzqbXTGPEwRoVECpADQA0Y8ZxElntyEOJVyQkr6/jtgr5fWO6RoDNNdZ+KXSazIqRdoYMfofjG6jb2j/rxzFBupU3CZNMZ0IgR6hTfVV+FzRu1XTXQgNyWt1ma75fyiFRRbiY0PKtKmsTHzYtdqzqjl4E9S3wLIx5ywOL7KsLpn9ja460nE+7A7xCDb//2+FUP6pxKE4dm91MECa3gFZ/jt30HCb7EJFQHgDqTGqHsdAFsuL6KXzQTXYiw5NHcCUhvBSNZ6G0miaENnm5iavp2GQCanLvmnBw2B7sOrqRI3McBMSmHai2DJ5qq9XfkXcxVbtso5kW+7PCft2YveniKkJtUB8mmLfUuxBxQ1q8jfwZFNvAjQ+uNg04HfRPhbZ3pnvNi30+dlXnwO1aEjR4dM2/hn1amRR/zJ722yAyky4S0+4GvV4pnmgk=','2017-06-30 12:01:33'),(19,0,23,'eaa1fbdda87c23e4952e4b76f71b1cd9e4fd4dad28a35774032b0e5bccabd903f76d09c82011a66f62329895f835fb8033c4bf433f9be1e58869169ca61baff2FQvgpjv4UJ9yRun3MBWbojligcthcfClIWb9cWkA+C7fDWCK3y9MnvtgYrsdkEPk7MvZBoOPRRmwkL6POfQZ8acCBHHq7vih8rWSIk9q5nflW/PeyTYKTbGnjXt78n1kV9eI7sYO2TOj797W9JHvogd9EShuLwl86eAIX2xq7E398VmG2sMbBOwGWXZlOhW3pqh/L1cIvXZ8pWkN3nTVruS3D2/gNsmUp8l0v9yn/VR2YEo49rUconjsz6aO/2qKhyiXPebbzB3B1tb5B0Yp+r1BHaq7yxigPrwbvtSKKHm3vAWM8hEJQ5dx4IsHqTT0mWRGY5fdpNa20Qb+xPgu9lgr8EUTIYb4RJCOG9cbxor598pr3SnznAxj2bLrMrPGbVkYFZtr9LtoKE9Fr7SUqcBY1xs64gg76NF6QOXrDkmH90J8Shoa+4dOE2Z4HR+4Hcx+BKbw++ex1CBbxuS63053Em6RtPjYObPKJxzA5bc4yDjr3ZWb7G9oA8qhlctex4mlaLRicBwhdDJ0ZRYSUiC/m5SRgkYPC5KSXxaapZy/zCZBnH0h1W5sMK4H3+j9TptAj742UHT6BQm7hhB724f6bt2hK9GqOiAkRTCOyzI=','2017-06-30 12:01:42'),(20,0,23,'ea40d43e4670a0b1e14459eadb401caa57930b9f2aaa4607b4e360048c7bd5a1d3a240dd1892a568582be689c6af99f491a0b7f13a84d1fd9f6524042d6a0494PUIk8hWZHTgtibAqEt/mR4B4FL7ggoiXkT3NxUQyaOYWJQQeeLOPQu0kyCeWYUSGD5cE6wq5BNKb0HYs+GA+LN6EbW8L5GlRuZJ/VVE6uRfcZ0Qjj4KZAGm5puLtze1YRzHHBfLalvnDHZeYdrWXKvhGE1NDmCK29FILwU5Y2nivunkWKDQQAC1qijY4gaokwy5yq/qR44o6Z4K9IBipDxFpC++msP9XEeX4aPCkd7dzUHa1hc9UJPr/UT5kQBbSCWqF2y0n27YzGy0PBRK+dgTeXNyRXZ9EVN6ltkdIag0EJbNNj76MJXTctzcCHYU6s4PBvY4hXrDrEEoWy0+imvSddQitkVx7Je0ltInZfi8IdP2R4+S1lanBas7ohca4UIk1rh+NtW3hj0K6MEt9FE7noinBLv39a+rY+bJHX+j2T+6h/dYjL0CEOrh5DIFFKXAfWtFD1xZ/rGJuUpcEqiCqso7JzMf6w3vQZ0+I9fiPoYKvEURX48Wp/RToYjhXY7XWxa5vXn36Lir5RO9q5RVHlwFfH6gIo9W/wEw3I2DUgNzoXwDkxqc+G7uUit/6','2017-06-30 12:33:57');
/*!40000 ALTER TABLE `tbl_itemmeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_items`
--

DROP TABLE IF EXISTS `tbl_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_items` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_type` tinyint(2) NOT NULL DEFAULT '1',
  `item_code` varchar(10) NOT NULL DEFAULT '000000',
  `item_name` varchar(100) NOT NULL,
  `item_disinfects_disease_id` bigint(20) NOT NULL,
  `item_description` text,
  `item_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `item_created_by` bigint(11) NOT NULL DEFAULT '0',
  `item_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_edited_by` bigint(11) NOT NULL DEFAULT '0',
  `item_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`,`item_disinfects_disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_items`
--

LOCK TABLES `tbl_items` WRITE;
/*!40000 ALTER TABLE `tbl_items` DISABLE KEYS */;
INSERT INTO `tbl_items` VALUES (11,1,'000000','zzzz',5,'afafaf','2017-06-29 16:54:34',1,'2017-06-29 16:54:34',1,1),(12,1,'000000','masterjulius',5,'afafaf zvv','2017-06-29 16:55:06',1,'2017-06-30 12:33:57',1,1),(13,1,'000000','jjjjj',4,'qwerty','2017-06-30 09:41:18',1,'2017-06-30 09:41:18',1,1),(21,1,'000000','mvmcm',3,'afaf','2017-06-30 11:38:09',1,'2017-06-30 11:38:09',1,1),(24,1,'000000','mvmcm',4,'afaf','2017-06-30 11:42:56',1,'2017-06-30 11:42:56',1,1),(27,1,'000000','mvmcm',3,'afaf','2017-06-30 11:44:31',1,'2017-06-30 11:44:31',1,1),(28,1,'000000','cccccxxx',5,'afaf','2017-06-30 11:44:46',1,'2017-06-30 12:35:38',1,1),(29,1,'000000','mvmcm',5,'afaf aafafa','2017-06-30 11:45:00',1,'2017-06-30 11:45:00',1,1),(30,1,'000000','mvmcmfaf zvvvz vzv',5,'afaf aafafa afafafa','2017-06-30 11:45:47',1,'2017-06-30 12:01:22',1,1),(38,1,'000000','mvmcmfafafaf',3,'afaf aafafa afafafa','2017-06-30 12:01:22',1,'2017-06-30 12:01:42',1,1),(39,1,'000000','mvmcmfafafaf',5,'afaf aafafa afafafa','2017-06-30 12:01:33',1,'2017-06-30 12:01:33',1,1),(40,1,'000000','mvmcmfafafaf',3,'afaf aafafa afafafa','2017-06-30 12:01:42',1,'2017-06-30 12:01:42',1,1),(41,1,'000000','masterjulius',5,'afafaf zvv','2017-06-30 12:33:57',1,'2017-06-30 12:33:57',1,1),(42,1,'000000','ccccc',5,'afaf','2017-06-30 12:35:05',1,'2017-06-30 12:35:05',1,1),(43,1,'000000','cccccxxx',5,'afaf','2017-06-30 12:35:38',1,'2017-06-30 12:35:38',1,1);
/*!40000 ALTER TABLE `tbl_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_metakeys`
--

DROP TABLE IF EXISTS `tbl_metakeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_metakeys` (
  `key_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key_name` tinytext NOT NULL,
  `key_is_reserved` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_metakeys`
--

LOCK TABLES `tbl_metakeys` WRITE;
/*!40000 ALTER TABLE `tbl_metakeys` DISABLE KEYS */;
INSERT INTO `tbl_metakeys` VALUES (1,'_create_role',1),(2,'_edit_role',1),(3,'_delete_role',1),(4,'_restore_role',1),(5,'_create_user',1),(6,'_edit_user',1),(7,'_delete_user',1),(8,'_restore_user',1),(9,'_assign_role',1),(10,'_edit_assigned_role',1),(11,'_create_brand',1),(12,'_edit_brand',1),(13,'_delete_brand',1),(14,'_restore_brand',1),(15,'_last_login',1),(16,'_last_logout',1),(17,'_create_disease',1),(18,'_edit_disease',1),(19,'_delete_disease',1),(20,'_restore_disease',1),(22,'_create_glossary_item',1),(23,'_edit_glossary_item',1),(24,'_delete_glossary_item',1),(25,'_restore_glossary_item',1);
/*!40000 ALTER TABLE `tbl_metakeys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_rolemeta`
--

DROP TABLE IF EXISTS `tbl_rolemeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_rolemeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_role_id` bigint(20) NOT NULL,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_value` text NOT NULL,
  `meta_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`),
  KEY `meta_role_id` (`meta_role_id`,`meta_key_id`),
  KEY `meta_key_id` (`meta_key_id`),
  CONSTRAINT `tbl_rolemeta_ibfk_1` FOREIGN KEY (`meta_role_id`) REFERENCES `tbl_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_rolemeta_ibfk_2` FOREIGN KEY (`meta_key_id`) REFERENCES `tbl_metakeys` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_rolemeta`
--

LOCK TABLES `tbl_rolemeta` WRITE;
/*!40000 ALTER TABLE `tbl_rolemeta` DISABLE KEYS */;
INSERT INTO `tbl_rolemeta` VALUES (18,18,3,'{\"date_created\":\"2017-06-09 04:00:14\",\"created_by\":\"1\"}','2017-06-09 10:00:14'),(19,16,3,'{\"date_created\":\"2017-06-09 04:00:22\",\"created_by\":\"1\"}','2017-06-09 10:00:22'),(20,15,3,'{\"date_created\":\"2017-06-09 04:12:59\",\"created_by\":\"1\"}','2017-06-09 10:12:59'),(21,13,3,'{\"date_created\":\"2017-06-09 04:14:18\",\"created_by\":\"1\"}','2017-06-09 10:14:18'),(22,1,2,'37651402d680e0a3d86b001da76b18a32828034e4db14106900f581bf1a086b8d0c6820ef11b85e5fbf56b940549fcb71f40c2af69c958e66600578b25ec9c39DEChFfvht4Y2QQhBoUXQPLN74zY+BY4T3yOyAOr7nXnRq21itVDJVLVzxNuB/zSWpaeTSNaW/s4hqIVYif5cDUtHiL00GZ0JjA/SLql5ZIFrXOTmsJk3nZMK9fCST74F93hN64twvAx8RtxPhtiQ75ujuFoDuFyIxmdPZkIz4715KXRZC0N6yGVOuRrfR+VA/52OS/Gl9kZRu6XzNNY0/bPNHe6/crUTUNn7UYL0HNxM1mvsaFcW4znAuankED8k/9LWvwJbMNbPx+ZbpovXwNxlwcZahV169Htg7/SCkYr6EWB7R4epnVKxsZ8NPr36P9snh57srB7TxaZcAI4il6wWqcr6YGDb000D4+MIBI2zUrduH0w6zDwq4zqxJQq2sys+bt99nDCFkzEEvEac5mZttSblPehVlzmMkEshvxWn4W5TC79Cbe3pm+RscP70roEFue3O7K1b5VDJdd7Cgx+cFvDKt+Z8dfdUEBwMsUwhRMSkI5mq919FypBJHdYFyqiP1tqAsKVEDdLvrCREil+UzS/+dQFkmqT//FTKd2+T+1958U9W79Pp0Z6iqF5A2INCA3w/aAnxSpvaFbHZv87/Ask3yWn87gRZ3Q7TZeas7WFJzsx3RAUtA/vBIPdA86haT5abc0vcWUGkUm26uyfKGPzcJcdVphEilJAkm78ZHbVm+Ky1j4OaXT7N0vo552bGu0Y9y4B6aYZ6u6tOGQloW4tEzN96dlWLWPC8Fpg7LanIS/CeWs4Y73rUQCueOFX3x86+CgHcJWcD6sGNUNIwVfuHmoKEeEdoJGMfs9djOCPCTBXcBNMAY8ZYeV4fGInz4rkDj3pHk5kJUQcJ91lJsfE0iZAYtvBieEJKD8/YCKdI1au15wftkQo2x1gEUvVbnTjFf+8IJRuI6IAv2Q==','2017-06-09 10:35:45'),(23,12,3,'{\"date_created\":\"2017-06-09 05:14:47\",\"created_by\":\"1\"}','2017-06-09 11:14:47'),(24,14,3,'{\"date_created\":\"2017-06-13 02:09:40\",\"created_by\":\"1\"}','2017-06-13 08:09:40'),(25,19,3,'{\"date_created\":\"2017-06-14 03:02:58\",\"created_by\":\"1\"}','2017-06-14 09:02:58'),(26,20,1,'2da80e4bf88d4e12a24a3608402fa78245a714ee029bb046297a026d91d62c800d78a832a960ba39214b45a049c47e876eb8ce43b3d78e3807271dac99b06b942v3tCMcnVYrZk/MsWKYaG5UOWYVl+7lu4UMg/hzK2EiMRczvCBZOyqjX2W2PvAzSEc7EiGNVxV/3TP8JRgU0ivjq7O9GKcFiFFhhYIryBH5YPpTAv9HAEAzwyiF4e6hjO0Ly7cP449l8XbwOiVOlVzbD3hcFREeBs+hRUjIxuoGb1V2xiwMjJxSfMDs66RHPmlDBhu+SWlDPPdszIHRrEDTHSog2ULnmCgrpEkFXsEyWbcr3SRicQSc9TkqROeE19pRfQdPfUb10v1Wg7b9pJefdCtIvRTJi6JDOe+0ZHTJDsESLmb+SyKrw0wl4hBUwrKUxRbblVw7OSi5rHKy8JYilxeb7fBNCvTPGDTu5oWWjsGy/09XCZflq+KR9Bmwa6OnrAe3RYrBP1uDuD9OLeINUG0r6U96hN3lZ7XSvqrf+wMKmLvg4FSjP+Gv3lz/h8LajkeG2cr8KLakACnNFZtKSZBUuWy/0PZQqoj+W3qkn7aNeW8Jg0m0qB+sthUp4/DfKVuV0DQmNOzy4DXJJ1lYdS5m2xIr2t+56Ma0l2PCm+A722LWH+PDSsW++w302/ALpvwG4ifl0ybLKjLBfIy4cE4H9X0le4xoyiRM9Fp9TJfERd2GFOGLcjmrGUHunm1QaUubWLRica9Agog7c6RciKVX6N338cUM87JSur52DPv+2+5nPZH+7tvTLZYiR4tbyT7LEtdy66padSaLuh3kcKkM+G5hquQbny23fbLy9Fv2/8IcmWJazAzswuDwmsaUvJMsGNrgOJoHpjoN1uyOjBWDdHge2imBUYfFMpJIX4IQffB1CDNU4ncSXY+ca4o3YpI6gLg/YEmJbJMHTQJB6kqNsxVgf+QHFexzNT+eiG/em8PrRTYwf7wUSXqCE8TFhr4/xgkMrq2UC2mSuiF/e5atje3Y+9FU7kwlrElpWNzelnaULk3HP7WX/uTtR','2017-06-14 10:20:07'),(27,1,2,'3c3905a14246416a3efee7879234b93096982a95700afedb43a08df45e3e6f84557c5c24c88172c1b5726578f4707321e1654b4fdbebe2dfd861298bb42168e21Hwj2VPXQLbc7Psz9DuI5OD731eIbpC4v832BikucF9DR4ew7uaoShukoOeWtmFNzMQBVV0i2kUpdhpSOjrS1XkJO7C+kS/fDSnm3BR/MNPq9jXdVTN/vsmQwgVID7XeBFDyKLXQKNG5tLuijAeTBv1SdQtos2BdoSXcV93OV/4I3thToIZd/hosXW9QLPRIrTNqSjXnUZaIYKMRu1E+wKjOaj2jDL1mB+LsqW8ZpsWX5wBwWvd5ANiyfGAA63m6IGDmqgxn2klbnA/iIwrQZNKeg1Tviw89XPnjxp+tVCTBNAuHm6G3qefVVb7ceNXfzj/FV7eP6bUYgFVPlmWqnmSA32d5qnvvaiPZZiLVyQySUaXDacTN46WIlDwov/i8FM9DkM1WWqHrT6U8qIj7i8OCGxuEdTir9T5XK/jVUaLWgjC/m8LFJhVWifWA3ZukYdOYJf30FduetElYAEkvU3NXnASYMbtESxckOitXmAQOSD34bW9xzb0OjYpsup38rWbi8vJrvdtaAoQRxKxW5UKf10XEv5a5uL0ab/74Sa1PmkRg0uAXLqXvgrK7VDK2VUivBfcyzaaR2zlCshUqp/5n5nFZDl/lJ1WzqDzhnQx2JqZR3NCgY29HFx4GdBTFoTTbXvJv8s9Rb2zrmpZE7JEwKzSJYZX3iUXloSEZ6ueT4Jsq7NxNdP4YBYxP880ZuCWkZaOOBynhKkZl/jWAHeG8PF+MWwFAAdbHN8Niwr/SEoMIPB3zq47iNTM8flGmVuf4nrMcuCg5fUKvZ0Kj9TkYDhJ8gGiqvpUzRYXskzWdggsM0SdVl+Qwh6di1Msynjav83EfmxiPgmTB3n+oTmj0YpxTI9KPONhX2cQZshNe8aybaOp1dypO0oE1OuCuFoWx18qPvPSlqkhFWFxJ8o9DHt+ffeGZxe74vfChKVjf5AM381hx9pAqqCqI2eW0Jot44Gmfnmq1AWqFpKPQEJN9jaWfTd29qaj8vTiW17pDjngf9HZTMfxqc84B9a8SyaF2ye3YkbgS6THb8iyJrlrMjHxIcTksbxBU6YViEAk=','2017-06-15 11:50:07'),(28,21,1,'c6fa5e19af07ab903d1f6a88970a5edee8fdad556d38191c56fccc8d0270be328ee150591df72156c7cd2942b6e7713418203edab1f6772067091b072346bc2eI//eyTlkPLLC/Lpqos6kLxmLPeGXt+D2vdLzlBAYD1xNfwdLbjcHn+VdIeN8kaZVbZPJo/DxU7bto3+FZo064+Go1FOqgzv8EbyuBRVR2iej/DV+HjOtJ+xuAAgEfJRoTYzFuYNIUEnv0dYXNkuLI1bW2hub1vPFB+FcBku9j2VevVl1m94viNijL957LmvRvV7xvxpq7UmEC6mLmCfDjmLLzlkz4XVxp4Ef9zGWbptAP25pHk/xsFH69pVmAWg4HpXjnf99UFNfi69mihORIQcR6sW5XbrlplpHcu/FsJf41izLmp4ib1BgeW7CkShcg5zM/H9wcuIafXDSeSfCO1NQOgOBTJaihTTrer9Up7VNJPDgluTDAXdjHWxHIQrG3ekQ+6O5o9zYWP5dTd/hotyHZIaUlGVxACg93TpPhiu/z5IboC6ifHsmqvkzJA8ts5Owh8CSnTWH/AtMcCYtr6eCykrxNtRlapMovzVjLNnfxg5wmhUDteG+HnDSkEhhwKdjFsx6yS2YnBz6UgLyHoJQzlfxzmxicRuEhzsVMOqEZo4Vnyxa7+5Ggk95f4xZIt68CyV+YhyNc2duESxzJfcyNWbnTq7Ck3xHW/w1qkXu/FlUahKCIY/mbH7ichQWxUFQ11uedHRkbbxwc3TNHhzOO3Dj6bQrWjbYZLFJA6WLKxwbsykJVcSrZfDxlWyaj3t2l/Kz1cBrlx3cyVnh52m9s2yiIUFsItQdh9qDUBHg3luWp9mppObfFBy6Fsi2B9H20AbwN7ShPeoPI8SGlmxfJEip8Z1nvwiDApCRrma0a9V8vX0GX5De9wsMF1dOBYcGy6YI8bXNs1eNWDkE9Me/tFxVECrvfH0ubt1+LSz89kHf4OyuLktwfvGg7tef','2017-06-15 12:02:27'),(29,19,4,'{\"date_created\":\"2017-06-15 06:10:56\",\"created_by\":\"1\"}','2017-06-15 12:10:56'),(30,19,3,'{\"date_created\":\"2017-06-15 06:11:06\",\"created_by\":\"1\"}','2017-06-15 12:11:06'),(31,12,4,'{\"date_created\":\"2017-06-15 06:24:49\",\"created_by\":\"1\"}','2017-06-15 12:24:49'),(32,12,3,'{\"date_created\":\"2017-06-15 06:24:57\",\"created_by\":\"1\"}','2017-06-15 12:24:57'),(33,1,2,'f5b3bd6e342630724eeaf5b01b6128b9f3af6225f8da67a3c110efd82550ecf94ff06bf09aa51c8bcbe12ddf64f600a29019dc63a63ff65e6eea639c27e7808cRXxjvFwBGAioQq9EeC2EnffS9gY5VMqQqF+56VCfPgwMIYQSJKboSYN5nBmwqZRzbmyt/xzEIZB8Td3LzK0W/fB70Fvdrv+akwHf9yC0HsBC6InpZh2WmkTjLbE+cdf84Jz6zBwZwyQ9+eVrvzdbVd2TpelzhJzBUwXU9EmnhksVVAm5CP5sNCxLvL94550f/5Vu7wg9lhYHA9MP2t0HAVZF6SL27dh2wdOFcm4Co/D0bU1YFvxVwiXETFMMWlo4kKnPPnb50dr9LE20sC+jSXk1O2ox/HrOCzg/KJCmZIkzWR9Xv19dr+frVrRBTY72fVa6rXFaHV+xA4b52V0q1otaEB/f9YQ9fkJT5GAMAlOeznGKjLalUzaPCXA9xCxp4a4XtiM7S/8K+bgyGDu1PxWKrnxQfeAqzyO5qakhrA7RrejPTyXfpuNQKkyIrIOy7AjWQ4QtgOE1iD4Q4Ub4XzBRbHNrUD87v/uDbiLKHvvicChqDCvp2yUlth1A0n92kNp+TXjiqsoBfQuT1b62c/sPBZc6rvnw/JLd5QDCuShrcgJYriEHnEfjFwua+qq/guwLpI/ydCGFGtsoMAS+lPuScqz05mVL0l5IY9weO1R8ox67WAvngcEzx14SLZXf+VK+ZJ2nTIm4JvpYiG0hMInokw1kF7mjaZ1TVIdzh2je7wwsVdovnJIQaBA8/xEzbp0QyKxdarGTMBO5xsEsjAecwYYDfWUEnOofrna4MXTlWBIdr7PwVQrvIH1nSsUWBEoVaiqcGXlhkpkZ7VBOxgmK0DJi5ZIgkJErMQPmPxTUqqQLkSTX9wFLy/CwEmv8YHST369FmxtdRBx2yFFFcU7ppKl3O0TW7WmEVb1JeIIblA7NEc5shNfYHgHH/Uo8cT0Ib8umGkNhyA1TBFrUD0X4cqO+3WxkeiMDTn+7n6UhlfK861zxNtbqZUUa85dZDmA5xBhOR7V3y5P6fA3s5hxTb++XoF5nnigLyu9ud7NPnbucrE2vfn/ggQVcKeV5P/Vde5cNAnxxTUDkXWv8eYPAaWSNHeR7QEETK7eOs8KmxzqBsiVJn+pyxvJfGFNb','2017-06-15 16:52:44'),(34,1,2,'b54d2bc7db7c77e56e7a6176e20e51259903fb74db0d58c28a6670f1ee1844810cfb1f66bc078ee30fcf87e02c4bdd4a07f200df7af4c41c7adf93347d232d47QVfCtTw7OLQgpQMPEhiJzHFcn00zgH0fRiRqW5eNFHzoaRWy/zK0Z7lZCiBIFLEAqp0J47LJAh2QDMd4eEpc5D9Wb6y7df7UZYOfyCVijk1vAS3Q7gIt393x6tXOzU6Qd3HvrG4iA/wtUv3+w3i3YKnFHyA7jyfrTq1xcjNHmpDZjtnyVM6DEAN6aGUqqmCu629WFxXGnkUv+F4LUdK6UQLio6mwU8syCLJi7CyLCQSZH6pkN07YatIrk+9qYU3MW4mYbSNtI/VND8RGXZitSEOpeSbwEPoRqceTuU668ZtZLzN6ALggBbhLqSVsWEdEDiAjh8LGsrbeml6aqowYii7D8x56sQQu2BMTKiNDo84Q5+hMNysloASKTe7nFKMrsMhZreOllG+tHqJC6huZgiDxHT28/9sd/YWqdug0tXqT/DmxgKIzhrjglyBx18BpKOzd9TRr5XliPNF3s1sHu6fWaj0iWHLtW7kpxEXeD/2Q7lF9HqYO0JNRvLapQHWBno5hms1yTK4vPdy4wPzS5FJoXY2CZ3vQdb5tXQ+IFueuC7/j5frxsUwaoGwF/SynIE7fLi4QoY8eh8ayaEtoJogljPnNVSTgD4q+NH+j0uI58vML0GLs1n75ku6cQeUkkyCHTaABbMfJ+bBHgjoqaIfwIiAP2753JxX4oMMytP+1668J6KCRQ3ejR3GYB926upp6GG6eBb0T667KpEUdYv52r7gMwyIsqo5p6GzQHpm2bLebUiH+CrVCphor/vh2vtJp9x494iVQsvnYyx7iZyzJgHrUMSfQUoT2zjzNrcZNhBg9ljxd/ytdSQsTkQa1MThALzrHMC2P+juPp1UrUGRq39vUN8TW0OIahrrRoz3gYtsy25Qe8iMe5AmIxO5UCljz7s03hihj0oCu3Qgz51uYzxNJo2OtM5cD9iXRoXaCyIaemdcoquZijmtg0MkG7c5gAGliOEDCActzRYzA/sjyna5rEz+jhaYLu1xsfZ0SjOOSHhYKHnIuoKojAI6ucOM56DRKOyVQvmPanuYsIn30egtaOPyGlGJONtWuZnxViSw/yD5PWJv7WDMtmwZ7','2017-06-15 16:52:50'),(35,1,2,'e46d667f1644ede9e867c9880fac1080f513263b702ab64d6ef7d5df7cc1b99fdc41186bde3462584a82af72c991517f8f7e947494cea815074937c105c09787LCMBiPtpZqnlu2068UzmycDxqrcUlGiQgR40XVodyHdig9Qu/j927W1ohiPwGir7BbR6UXhLJqxQkG3KVjxUAoJyupMRaSQtbK0VdoHvFUkKfXnS/9NPgD5AhLHnCKKZvL2W9oVWD+NBUPX1/6eZ8qXtjghtmsC9v0ymKiw3ZstHibFkcThrscp8przHjIyYX2RrQmGUqAb82F3y+Hv4817cz+UE4Myy2e1ewQaBnLqRSkleBPSVMp4x0eoN1NaKgkUJhAJ/4mK5CwtnsBsvJ4cgSYCYT2NID6e5ge2c5wkWXLQMl5UDhvsF64Yx1BPRyvNofh5nvhDlzzakBhvrTFfokCbISuIPuw55Zus6TXhDrgbmZreE2BD8R2NyRI0M3YsRHl22hPPiT8A2MtoBW/qb1jyfoyPkz+r9ix8ZbWR8M9AL7cmc+0wPnYEC2650h8wBMyp0axteMIBUp1STLwc3uQ1JPs1AO0G4RC9P7IBC+cCYchpny73LGraxoax17A402HYX7NWDPeBE1v8Vt8sbvXzJyOcfxPy0/WUr/oLUHgKxPKeGt77Hask8jEGdyRJE+1QkmirdRhhCp+PE29N0yLqPsV8CSq7N/LhHTtSoJ56VUDvecAer6rczDuzxaiq3gp+8JFO3G9l/ODN2ibiodQ+oCmogifcchg7utyKdL46sQ/FcynQvsVWa45jtgxrvDFKP3/UFCzlepeNDHyfbo7DId5+g1+w4jmSrtMYPDvI0HqWks7tvjV8+3WUQscZefRb4YSNvGNizUflOtuYHQQ7SpqvdiNQsz3vEa0ly8JNMzzyCQMAyUSEdvwXhuRl55bX/z7yCkGcM9pYs9CnLXesTdHDqYf4u0sVxCc04R9vyOUkdBZNPeG/EJ4qUe0iVinM7iYaoo7R+ExO0UyLPWTPhqkZ8/RScpuq1knRGnfK3l+ZhiByRUFZIijVCXkMsOEUsXcS8IGPX49CWFf0ZbaI8IGn3G3Yx+t10tV4vVfnTXnQPme9j85r+2CBuS8ISW/IPiX53IvA2QNb6yf9JVLf9ttdU/r4ZYk6U6V6+UB5sg6YqfdQre+c5ZuhmGjJGuWA2WbiSBjphGrab5I+aDW287SnsikNm0/V3gqURu7zsVzDe+oGaGxWnbkKN','2017-06-15 16:53:30'),(36,1,2,'78001d1b7f98388588c20fd1d9efdda0c5cc698f3a068d1db7bcb8c06f7dff3ee73e91f9848ff1add46535c608c0c91bf5aa945f379a81604149bd2bc213f40fsOcIz2wkeOjmP49clIT7q/a/QQTAPdYa0NhlmhqV0BsYUBTHHHmiC7NmJOqI17WV0VhbOCqfgFA51YyHIc6WGeSUIlhr3edhK3t8txepdWB+d4029U9juD8eVeRPg5GGDy4VQ3s84mu4b/VE2bsuqXtSLR4N7LzA91iUQqZtEbE7jcsgYRuQ2U66uyponSlHRylrhV7vH8I01qwiidaYv0qKOnuIA+i9aqVjMZOY3ylW+isDIRVDOcBY1uWPcQNXP8dgMXG5Z7awjW7z2cpYF1SSP7UPEnTDzpDGfloJ7bcdpW9DnK6UNodag1vR5pglHt6Et62+FK9FiS0qDthRuEnDeHjB03qlNIOx3wbOfdbGooSyCEMwGDT8sWyRKpsOBx+d4RsVJz+Z4zxp6ZXjnmVNERPLayNIf2M3hBhLX0mQZWbkLm2Gc1wdKuK9rsKzg7kb12mhyaLe8fFFtA9AdAU32JP0jihP1uGDaeSnLJVKPbPye0ivBAmrplwudpnLStaeCODxRPavYr53gUh51KeiQBazpbhd5LaAhfgpX+RR6/aMmb4SucIb+BD9WDcx/xQq2D7rcwQ+AHoiHYdU7Mh//jB/7ZrOQAZl289nl/Y33dy0IE6/MKC0EQIWh1pfOzEANhayOhc310anQvN8cRn5aq617hhZU4NwT3wNr2Fxo7JoyGu43aYikZrlfx/SDMHASZtTrJXbImsA7/qXgpmXQyWJd1xGq8wpEh7OSdqn1m8p0KWJYRrEC7ZSStdzBupfVnFnV1Z21e1Ymk1Fjgr1Ww6qMnOIQOI4vX0Y9k/bym8Ey/zdG0lJc2M6NBcDYOCeRGGNKyYCrujfM5QlKSczfzQtseHCMBvrC6jk7hd8MvfA4oHZ0x2X4W6Kvd5nD8dXDNLc3sypZipv9p6DcwKuYBNryWgzbd2rwHO/qLWdV2zbCj7p6zqBIwoGOBRzleSMEcSjT+JPSILSJkXT5ffkKtAs2NsNLoUjxy1SfVlMWNm+D1xDexYmT8g4t5oW+eNA7WiX5XQ5Xw/yTvBH7QI2ZeyDYh9sQilLL5ITQGLGk2baOZvHXX++PGzswn1nYrr75O/xc65+PRoEt+FZRf3SL5COD365HxGqDbK+1i6GdQso5XG+4gHjxXjbdbQ7','2017-06-15 16:53:31');
/*!40000 ALTER TABLE `tbl_rolemeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `role_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `role_description` text NOT NULL,
  `role_value` text NOT NULL,
  `role_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_created_by` bigint(20) NOT NULL DEFAULT '0',
  `role_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role_edited_by` bigint(20) NOT NULL DEFAULT '0',
  `role_is_default` tinyint(1) NOT NULL DEFAULT '1',
  `role_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`),
  KEY `role_edited_by` (`role_edited_by`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Administrator','This is the default administrator role of this backbone of this system.','78001d1b7f98388588c20fd1d9efdda0c5cc698f3a068d1db7bcb8c06f7dff3ee73e91f9848ff1add46535c608c0c91bf5aa945f379a81604149bd2bc213f40fsOcIz2wkeOjmP49clIT7q/a/QQTAPdYa0NhlmhqV0BsYUBTHHHmiC7NmJOqI17WV0VhbOCqfgFA51YyHIc6WGeSUIlhr3edhK3t8txepdWB+d4029U9juD8eVeRPg5GGDy4VQ3s84mu4b/VE2bsuqXtSLR4N7LzA91iUQqZtEbE7jcsgYRuQ2U66uyponSlHRylrhV7vH8I01qwiidaYv0qKOnuIA+i9aqVjMZOY3ylW+isDIRVDOcBY1uWPcQNXP8dgMXG5Z7awjW7z2cpYF1SSP7UPEnTDzpDGfloJ7bcdpW9DnK6UNodag1vR5pglHt6Et62+FK9FiS0qDthRuEnDeHjB03qlNIOx3wbOfdbGooSyCEMwGDT8sWyRKpsOBx+d4RsVJz+Z4zxp6ZXjnmVNERPLayNIf2M3hBhLX0mQZWbkLm2Gc1wdKuK9rsKzg7kb12mhyaLe8fFFtA9AdAU32JP0jihP1uGDaeSnLJVKPbPye0ivBAmrplwudpnLStaeCODxRPavYr53gUh51KeiQBazpbhd5LaAhfgpX+RR6/aMmb4SucIb+BD9WDcx/xQq2D7rcwQ+AHoiHYdU7Mh//jB/7ZrOQAZl289nl/Y33dy0IE6/MKC0EQIWh1pfOzEANhayOhc310anQvN8cRn5aq617hhZU4NwT3wNr2Fxo7JoyGu43aYikZrlfx/SDMHASZtTrJXbImsA7/qXgpmXQyWJd1xGq8wpEh7OSdqn1m8p0KWJYRrEC7ZSStdzBupfVnFnV1Z21e1Ymk1Fjgr1Ww6qMnOIQOI4vX0Y9k/bym8Ey/zdG0lJc2M6NBcDYOCeRGGNKyYCrujfM5QlKSczfzQtseHCMBvrC6jk7hd8MvfA4oHZ0x2X4W6Kvd5nD8dXDNLc3sypZipv9p6DcwKuYBNryWgzbd2rwHO/qLWdV2zbCj7p6zqBIwoGOBRzleSMEcSjT+JPSILSJkXT5ffkKtAs2NsNLoUjxy1SfVlMWNm+D1xDexYmT8g4t5oW+eNA7WiX5XQ5Xw/yTvBH7QI2ZeyDYh9sQilLL5ITQGLGk2baOZvHXX++PGzswn1nYrr75O/xc65+PRoEt+FZRf3SL5COD365HxGqDbK+1i6GdQso5XG+4gHjxXjbdbQ7','2017-05-29 14:20:03',0,'2017-06-15 16:53:31',1,1,1),(11,'Rock and Rollo','afaf','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 14:56:41',1,'0000-00-00 00:00:00',0,1,1),(12,'Weew','fafa','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 15:32:13',1,'2017-06-15 12:24:57',1,1,0),(13,'desolation','','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 15:34:50',1,'2017-06-09 10:14:18',1,1,0),(14,'shitness','vzbx','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 15:36:03',1,'2017-06-13 08:09:40',1,1,0),(15,'shitness','vzbx','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 15:36:35',1,'2017-06-09 10:12:59',1,1,0),(16,'shitness','vzbx','aff0b457acdf54d7bf041aaa3fb6c942a0d6e5b0af02ebbe7573f5760d0097e633403a78c93a5d52ae547abb62da6e3aaee9853acfc9d8c404bdaed820b2ce34ra8RY2P0jLnXfZDB03BoYg5WPKcQ9kzKH02XNYISYUMGTYpng0OWJ4w4JvtTdDLJPlNAbik1EUpmSNUQL1qLidLpscn0cxSXR+4LjKHmo81PoJVnTPlwURyVZxyfSqPtk0jqrVKPK7fdlepd89h7ewLszjPc//MtJGba9DT/qRtWFkI2/GmCEWDnQWIW8SBgwhhIBhvfXqPdjb8EbpOW9runpI58LZPfO6IU/HIU4Y+V26uqGP5b/eMVay8496/GgH+6qHZcKmKaBtsvDItVO8bXR9JYAGgzIZw6ag8NJaQIU1qxge4PM0yinHmirc/Ups6ocKvC9/McDGs/uM0m/FJjGRsNW99EaVCaZur8wY2SwKzvkJqjebrS6YQUyLXKPQZN+tYwDnMTogcJPbJ3gwMS0u+iGRN8WII73WY+rHYW97I9hqtx4IbD6kAoubvsov10IYYmNvBhF+GKaBdpdy3o/5YTj09Aor9rJgMB/yZMh/68rZdEt3g11CjkxkQ2S6c/dS1RtfOoC3DA4fdFjSh8k8CPVDSKGsLXMBcpaSY=','2017-06-08 15:36:44',1,'2017-06-09 10:00:22',1,1,0),(17,'Lamb of God','Laid to rest. control yourself your better alone. destroy yourself.','4404f1cf2769ff774e3861516702872fb14d7ca9222b76033dd9aba694d522815f79164ef89c036535a7580bac04b39fc3d6c401b67cb97e7fde963f75b76c34LSLuexRSCMrW6ncfKidyUraT2xFtRG8NBd4JcaGWXzilVSGivnoVuKIjd5t9CPPzSeU6t9YEoumcKCWBPD+qDzu89X4UbRfUqImcooY9GV76AVe8R3R9MVRx9DZwXPsQnPqdYmHT+YciuNb7OOrOhi8Vd23T+JLpjx3baEyhfVXl2z3I8/HuDU4KoG3wehtLD+Iw4/pVkMSZefL4l6V8pSG5485XTFuTukQwqHm8U6j661yZ0FgIeEIPvcbmaJTYvwFqBkogEK86WWp/kwzhvkZcPud0soeh2piDOPzgUIF5kfw8Fd9nmT/kAWPyiZp1ATcvCOqINok1bWW0T6g4YZqCtvv9u76VDDrGAqwYYe3h6Pc+Er7An/31RqHQv0ZtbHlD4UveaykGg+MjvQ7fCgW+fKbNvoJSDE1MvpUMJPfIPrsCkqpM01IzBCgIBYANrG8We6ZnsP79cEX7PyVY6pX7HMXiDJKp8KLkJNw3F/IJ709yVhoM4jcggfrXoK4mncn1jIfc93KE0qRNyrCMyfHpHAI4SbxrhoIzjbv4AxLizLpmnmv6HC7DtNe5j3elxd6fgYUtto9IiaURplcckT5C7sEJU/naUX0UtSVmpwaGeS2+ligrAcTNl2a0KW/y','2017-06-08 15:59:10',1,'0000-00-00 00:00:00',0,1,1),(18,'fap fap','the description','2688ebb607fe307be22b49ce0cb6c9e24edcbdb0bc50fb52447e77d19cb6acc895772f1a27da2d1f2ac6d32e2fa876ad98ed3733cfce8a4eb57bdf59717c7200AOIRMRS8ihlWpRzARC5B/rJfB9yg1Emaua4udGw+49PTChjPgm4En9iQsfcghC5vW8JMtZu2MfuGhkAxYLSliXhh+zFVnPJMEHjduCZePNEOlC6gsqHx2S66/oh+PsI8g+83M6c0s1BjdYq/yMuAKemSDrkRuIt5zStA7AAXYHNv28EYXa/U5zFaHcKBJNusA1V1+v2UkIioHcSpa/DUu1QkAGLFrsfmPSHyhE42pmyDpqhTtUr1F+d9ZL6BBi9R+ZSDJe8DkaSVxwLZS5mizIJ1lldOW25HLuROR3plkBznuX4Yyx1W4atWEsURcuqSXc0ycPS3t/mswIIIcN4u5I6nsGdS0iP0pwQW/Pv4pf6AiqsgHyN7V6hQJ7IKDFvARAKLmdbHDXOSXxO2RZ+sFus2ZxgZYhukjF+nllolm4v+FG9Ct4xPts63s76gVv6yv6+9Csrmghut2hOTWwf714j/trz778NXATM09izdZUmOYk+knHk20WBC86yNou2A1vlkSb1KY3B7Q0yw32uFMlqxe1UTqBXcTCyuBLnCIbXOy8w+7906CnA3qA1YTekgYu2iFp3vs5pBkgDyGaTcpWKfYIkn7vPvgy2jAXcm+2qysg+on9401L+EDSW9Skdfi1koRnWlNuNWau6U9lwqkadUm9bED07BYJHzGasYdsmRVVK+e5cMwy8ZjGrc1vWDSgwoUqNfXjcW+LVOmDSYgwQBE8SrWzrKxr2u3aY1HsfJQakGWDb3lX5947HVUueg','2017-06-09 08:57:24',1,'2017-06-09 10:00:14',1,1,0),(19,'boombastic','telefantastic','89728f42abefe2a46c3a6478c736ee9198980a0a840bffb981868bd7cccdc928fe33688973c0f586fac7400d8a7aff03870ef9195fd4fc71e503752beb5c4f47ED46ab2MaRljxR2Z7f+PTyb7R+TdKjmQK3xrtr78mmM0IPFH7KuF//iMimauympZROcRyDaC0uCwnoco7k9ubTGU+hEVeHbiQu8vcIzwXj5CkYpgABUYWC9mf6K7Y6k4N68FOooIlA9iGXvmrumv8Nqv3wfJAqOVj7N4H14V9UBhPqbEygPr3/BLpqLvEzexTD+dk1VA1kAN6sDbJwP9i5WtUe9BvR7nOkdRQmM2IY78njJHGZ1Z22jKy5/3rJS1Kl8isTgPIucQ9uDAk8hEBA82/ejT3cb9NhDGZpHP926xRkGFkTk4wrI2hA+BC+0+iiB4b/HmCpxCQKVvjBdpotEcnystNkN0dGqD762b0lC4R74g43k3oCKHH/5XlShao1eNURGTgsqcix5hgc7O0rDiZNKi1sDnbI60Qfpkmgw3KuPi06TTBdlcmVqrTVOZK4le8X58K45p7vnIgPWyOlV9pu5eeNa2uSPxuqPr5mLreibrHwmHxXnRSIS88/aZlpAv6IbidlsulygXeZ8DrMw+qnOCTa1tn/QGDMdiEMYL7c+Tglnh0NYErB00vzRko23Tg5cP3Q8Xj5XImiv2spGDpBRIox85jIKH0H8XlTBJOyXYwh86aofhwi/6jlPUO7cTWnWpmfonHzEoKOxXO0zutVjYivSEmR+z9fMUK8YyCcf3sFQmULiq9+d+HQfB510BOOVqItmXCIea+g1Lo9vB0bDP6GpLa8VL9gICQC+ixIyquYck3MNnUPIq5Z/r','2017-06-09 08:59:41',1,'2017-06-15 12:11:06',1,1,0),(20,'Hoe','affaf','2da80e4bf88d4e12a24a3608402fa78245a714ee029bb046297a026d91d62c800d78a832a960ba39214b45a049c47e876eb8ce43b3d78e3807271dac99b06b942v3tCMcnVYrZk/MsWKYaG5UOWYVl+7lu4UMg/hzK2EiMRczvCBZOyqjX2W2PvAzSEc7EiGNVxV/3TP8JRgU0ivjq7O9GKcFiFFhhYIryBH5YPpTAv9HAEAzwyiF4e6hjO0Ly7cP449l8XbwOiVOlVzbD3hcFREeBs+hRUjIxuoGb1V2xiwMjJxSfMDs66RHPmlDBhu+SWlDPPdszIHRrEDTHSog2ULnmCgrpEkFXsEyWbcr3SRicQSc9TkqROeE19pRfQdPfUb10v1Wg7b9pJefdCtIvRTJi6JDOe+0ZHTJDsESLmb+SyKrw0wl4hBUwrKUxRbblVw7OSi5rHKy8JYilxeb7fBNCvTPGDTu5oWWjsGy/09XCZflq+KR9Bmwa6OnrAe3RYrBP1uDuD9OLeINUG0r6U96hN3lZ7XSvqrf+wMKmLvg4FSjP+Gv3lz/h8LajkeG2cr8KLakACnNFZtKSZBUuWy/0PZQqoj+W3qkn7aNeW8Jg0m0qB+sthUp4/DfKVuV0DQmNOzy4DXJJ1lYdS5m2xIr2t+56Ma0l2PCm+A722LWH+PDSsW++w302/ALpvwG4ifl0ybLKjLBfIy4cE4H9X0le4xoyiRM9Fp9TJfERd2GFOGLcjmrGUHunm1QaUubWLRica9Agog7c6RciKVX6N338cUM87JSur52DPv+2+5nPZH+7tvTLZYiR4tbyT7LEtdy66padSaLuh3kcKkM+G5hquQbny23fbLy9Fv2/8IcmWJazAzswuDwmsaUvJMsGNrgOJoHpjoN1uyOjBWDdHge2imBUYfFMpJIX4IQffB1CDNU4ncSXY+ca4o3YpI6gLg/YEmJbJMHTQJB6kqNsxVgf+QHFexzNT+eiG/em8PrRTYwf7wUSXqCE8TFhr4/xgkMrq2UC2mSuiF/e5atje3Y+9FU7kwlrElpWNzelnaULk3HP7WX/uTtR','2017-06-14 10:20:07',1,'2017-06-14 10:20:07',0,1,1),(21,'Bin','afaf','c6fa5e19af07ab903d1f6a88970a5edee8fdad556d38191c56fccc8d0270be328ee150591df72156c7cd2942b6e7713418203edab1f6772067091b072346bc2eI//eyTlkPLLC/Lpqos6kLxmLPeGXt+D2vdLzlBAYD1xNfwdLbjcHn+VdIeN8kaZVbZPJo/DxU7bto3+FZo064+Go1FOqgzv8EbyuBRVR2iej/DV+HjOtJ+xuAAgEfJRoTYzFuYNIUEnv0dYXNkuLI1bW2hub1vPFB+FcBku9j2VevVl1m94viNijL957LmvRvV7xvxpq7UmEC6mLmCfDjmLLzlkz4XVxp4Ef9zGWbptAP25pHk/xsFH69pVmAWg4HpXjnf99UFNfi69mihORIQcR6sW5XbrlplpHcu/FsJf41izLmp4ib1BgeW7CkShcg5zM/H9wcuIafXDSeSfCO1NQOgOBTJaihTTrer9Up7VNJPDgluTDAXdjHWxHIQrG3ekQ+6O5o9zYWP5dTd/hotyHZIaUlGVxACg93TpPhiu/z5IboC6ifHsmqvkzJA8ts5Owh8CSnTWH/AtMcCYtr6eCykrxNtRlapMovzVjLNnfxg5wmhUDteG+HnDSkEhhwKdjFsx6yS2YnBz6UgLyHoJQzlfxzmxicRuEhzsVMOqEZo4Vnyxa7+5Ggk95f4xZIt68CyV+YhyNc2duESxzJfcyNWbnTq7Ck3xHW/w1qkXu/FlUahKCIY/mbH7ichQWxUFQ11uedHRkbbxwc3TNHhzOO3Dj6bQrWjbYZLFJA6WLKxwbsykJVcSrZfDxlWyaj3t2l/Kz1cBrlx3cyVnh52m9s2yiIUFsItQdh9qDUBHg3luWp9mppObfFBy6Fsi2B9H20AbwN7ShPeoPI8SGlmxfJEip8Z1nvwiDApCRrma0a9V8vX0GX5De9wsMF1dOBYcGy6YI8bXNs1eNWDkE9Me/tFxVECrvfH0ubt1+LSz89kHf4OyuLktwfvGg7tef','2017-06-15 12:02:27',1,'2017-06-15 12:02:27',0,1,1);
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usermeta`
--

DROP TABLE IF EXISTS `tbl_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usermeta` (
  `meta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_user_id` bigint(11) NOT NULL,
  `meta_key_id` bigint(20) NOT NULL,
  `meta_value` text NOT NULL,
  `meta_date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`meta_id`),
  KEY `usermeta_user_id` (`meta_user_id`),
  KEY `meta_key_id` (`meta_key_id`),
  CONSTRAINT `tbl_usermeta_ibfk_1` FOREIGN KEY (`meta_key_id`) REFERENCES `tbl_metakeys` (`key_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_usermeta_ibfk_2` FOREIGN KEY (`meta_user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usermeta`
--

LOCK TABLES `tbl_usermeta` WRITE;
/*!40000 ALTER TABLE `tbl_usermeta` DISABLE KEYS */;
INSERT INTO `tbl_usermeta` VALUES (21,66,7,'{\"date_created\":\"2017-06-15 03:31:13\",\"created_by\":\"1\"}','2017-06-15 09:31:13'),(31,69,7,'{\"date_created\":\"2017-06-19 05:41:18\",\"created_by\":\"1\"}','2017-06-19 11:41:18'),(32,70,5,'cb1eca1ef679e65dfb3528a69fedb2d722318ad075d845829108a6c516721d27f97b127a98b7651a7a2183b1630cf90fa33032466076d020ffbd532d95db5016bdBWODQ96Mu24ryhboo5Qbk+/JsXc2c6xajbS5jPXpI1Sg3kXgQtP/5DsFrNVZFPckO6O6ENHpf6HBXZ/6SNdv1Gu1ssSj3yLpgmYy1OAKfuFngSyJbJFUxv67T8/2YtFwjK3aT0A/0Wn5zfFy4CU/RZ60GJZWQtcCcbIg2iMN2ULP5VXq73srWtkgu/hlwYAUkSw86BeO9455/Z1vRJV45QjiJyRqM4i/QM0jw8Ozi77E3VtZJ5bFxmbuoB5ASwwONgjQypSCNM+ZLKVodKXQ==','2017-06-19 11:42:56'),(33,70,6,'255a6f0964874adcfaa1ed2a98e10037104b3c12395798ceb631b605cdae36e04e171172e974cd5b17f60fb40584c5327f9b2b27651b097f8caec8183077a2818spYQgwF1/rOIoXZda7ARBry4enag4ru4yHzTSSDs4Ypho5b60kc6UcTjpLSSDVrOfoMZcaSjOVgQyM0AXJxoJJzFPXsPKAZ67eMsDwaO6VHTdu816J5j74USOO1DAr7+9TwdLPBNBRyTdibGT3O/1K3RTMJBXJfURG6Yvj+oTCku4X9/59nALOxqfoeKPQo/9o0huM7Q8f1ub7IbIFwtPU8zGcFM+iN+DRdFCX9KPlXalGgdzA2kdOGb+SvUG764p4tadM5Z+I9fJSgxCH6oA==','2017-06-19 11:43:10'),(34,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-22 02:30:40\" }','2017-06-22 08:30:40'),(35,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-23 02:38:24\" }','2017-06-23 08:38:25'),(36,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-23 02:39:59\" }','2017-06-23 08:39:59'),(37,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-23 08:50:52\" }','2017-06-23 14:50:52'),(38,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.109 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-27 02:36:07\" }','2017-06-27 08:36:07'),(39,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-27 03:14:59\" }','2017-06-27 09:14:59'),(40,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-27 05:48:08\" }','2017-06-27 11:48:08'),(41,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-27 09:59:20\" }','2017-06-27 15:59:20'),(42,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-28 06:40:31\" }','2017-06-28 12:40:31'),(43,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-28 10:48:19\" }','2017-06-28 16:48:19'),(44,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-29 02:39:52\" }','2017-06-29 08:39:52'),(45,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-29 09:39:45\" }','2017-06-29 15:39:45'),(46,1,15,'{ \"ip_address\" : \"127.0.0.1\", \"user_agent\" : \"Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\", \"session_datas\" : { \"session_id\" : 1, \"user_name\"	: \"admin\" }, \"date\" : \"2017-06-30 02:13:27\" }','2017-06-30 08:13:27');
/*!40000 ALTER TABLE `tbl_usermeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `user_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(120) NOT NULL,
  `user_roles` text NOT NULL,
  `user_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_created_by` int(11) NOT NULL DEFAULT '0',
  `user_edited_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_edited_by` bigint(20) NOT NULL DEFAULT '0',
  `user_is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`user_created_by`),
  KEY `user_created_date` (`user_created_date`),
  KEY `user_created_by` (`user_created_by`),
  KEY `user_edited_by` (`user_edited_by`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'admin','$6$rounds=5000$@eVrY49(`a sMV6|$yVP8.1jAIUswya9cCVmenu3f80YM8crxXM3M4in7hCvCrMW52crho8J1Vnt6DVSC3NUyrN2BW54viz9lUnlLE0','072f1ea8f0597dba2ae507be622f102a757087f83d3b33b371c33defdea6705865ad834525a89321a78b894ff4a942434caf65b8dc4a9e48a752e66fb002fe4etm02AJOLkKCvMR8A5yajl0D/NnWTlEaMElzQ9eRyAjvno+Y8gdbP9tTvo7LumMXo','2017-06-06 11:36:15',0,'2017-06-19 08:34:33',1,1),(66,'afaf','$6$rounds=5000$@eVrY49(`a sMV6|$yVP8.1jAIUswya9cCVmenu3f80YM8crxXM3M4in7hCvCrMW52crho8J1Vnt6DVSC3NUyrN2BW54viz9lUnlLE0','7cfb3b15eff097f87a1d481b12ec6b9e92aa7dfc9c285f5dc763eb0c76c6d90dd5a5d5fd10172a9157928f2786da8c472b796ff02b5eb9e51901fc54d799fb3fQ3A1Vp7fyUCePP+YpdbbQvRRGQDvpc+6n5Ya6zkOozRXNRco3ejO8IOR8tQizuXe','2017-06-14 16:53:04',1,'2017-06-15 09:31:13',1,0),(67,'nathan','$6$rounds=5000$@eVrY49(`a sMV6|$p5bggQTL/.M3xfPnJGCe6mMSTStnZ9PBTjE9tIohrHFQYDRlozjblQYzTD4vhlYMrrcbz1cQGuG0L0sWG1Ncy1','0171b7e3920a0c303ca6d3d8655ce6554eafc17328ee47a51b83c09f90413b7cf798485a67e48f3e8210c5fa7cf4e7fb3ab0244c1d0c766421c795d4fe8ca0861ey0mD3bIwusgU2toZsRD2mvF9i8tCXbGa3nz56+l9ocJTKMp7+Xedf0NDVBk0RN','2017-06-19 10:19:04',1,'2017-06-19 10:19:04',0,1),(68,'oliver','$6$rounds=5000$@eVrY49(`a sMV6|$p5bggQTL/.M3xfPnJGCe6mMSTStnZ9PBTjE9tIohrHFQYDRlozjblQYzTD4vhlYMrrcbz1cQGuG0L0sWG1Ncy1','9d898a870656ec99bd04df9dec2f16105f3702fe0b35339ed88b11c7307182e18c76285842654fd9ef03e28008ac594e7fcebca96ce51833a2af4ca71710064aWPMWnh+i63++yshLK8uiu/cC0MBAa+v0FW5UPxDrDFhFdhzk/1oG9E0paFwyEP0C','2017-06-19 10:26:12',1,'2017-06-19 10:26:12',0,1),(69,'masterjulius','$6$rounds=5000$@eVrY49(`a sMV6|$p5bggQTL/.M3xfPnJGCe6mMSTStnZ9PBTjE9tIohrHFQYDRlozjblQYzTD4vhlYMrrcbz1cQGuG0L0sWG1Ncy1','f17180e50ba73a74b83a7872c2733ba8297f54596f401090a57526cd90325213bceddba619a617e8e12c02cfb4c0533c56329e7d53412328c0006238b75e3c25BdG1YWPjoNiG3q5jIjiQAWMVnM9Kcz6++k2r/dFNGRJJjAnV5iPnujY9KnFGHOnk','2017-06-19 11:37:05',1,'2017-06-19 11:41:18',1,0),(70,'masterjulius','$6$rounds=5000$@eVrY49(`a sMV6|$p5bggQTL/.M3xfPnJGCe6mMSTStnZ9PBTjE9tIohrHFQYDRlozjblQYzTD4vhlYMrrcbz1cQGuG0L0sWG1Ncy1','765b73b12a07c3a235451f5bc12f8129b96e6f98b4c6bf6de4998c818a881cac17931386cb6d07f2a5279a56be88a40febdcb5bca9580486a0ab856b18725657XR1NoJV9fctiLCTjqls2S7Bhu5XFCPRrunvcpewBjzc2542ZXAKXuREr5gw5vP5k','2017-06-19 11:42:56',1,'2017-06-19 11:43:10',1,1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-04  8:52:58
