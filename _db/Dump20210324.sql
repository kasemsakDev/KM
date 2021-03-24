-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: us-cdbr-east-03.cleardb.com    Database: heroku_3994a86bca8479f
-- ------------------------------------------------------
-- Server version	5.6.50-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `WorkID` int(11) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`Category_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'PMQA หมวด 1 การนำองค์การ',1,1,'admin add data',NULL,NULL,NULL,NULL),(2,'PMQA หมวด 2 การวางแผนเชิงยุทธศาสตร์',2,1,'Admin AddData',NULL,NULL,NULL,NULL),(3,'PMQA หมวด 3 การให้ความสำคัญกับผู้รับบริการและผู้มีส่วนได้ส่วนเสียของ ฐานทัพเรือ สัตหีบ ทหารเรือ',3,1,'Admin Add',NULL,NULL,NULL,NULL),(4,'PMQA หมวด 4 การวัด การวิเคราะห์และการจัดการความรู้',4,1,'Admin Add',NULL,NULL,NULL,NULL),(6,'PMQA หมวด 5 การมุ่งเน้นบุคลากร',5,1,'Admin Add',NULL,NULL,NULL,NULL),(7,'PMQA หมวด 6 การมุ่งเน้นระบบปฏิบัติการ',6,1,'Admin Add',NULL,NULL,NULL,NULL),(8,'PMQA หมวด 7 ผลลัพธ์การดำเนินการ',7,1,NULL,NULL,NULL,NULL,NULL),(9,'Testหมวดที่7',7,1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filecategory`
--

DROP TABLE IF EXISTS `filecategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filecategory` (
  `FileCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(11) DEFAULT NULL,
  `SubCategoryID` int(11) DEFAULT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `FileType` varchar(11) DEFAULT NULL,
  `FileData` tinyint(4) DEFAULT NULL,
  `UrlPath` varchar(500) DEFAULT NULL,
  `FilePath` varchar(1000) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`FileCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filecategory`
--

LOCK TABLES `filecategory` WRITE;
/*!40000 ALTER TABLE `filecategory` DISABLE KEYS */;
INSERT INTO `filecategory` VALUES (3,9,7,'Section 10 Company and User.txt','txt',NULL,'','Section 10 Company and User.txt',1,NULL,NULL,NULL,NULL,NULL),(4,9,0,'temp.txt','txt',NULL,'','temp.txt',1,NULL,NULL,NULL,NULL,NULL),(5,9,7,'WWW.google.com','url',NULL,'WWW.google.com',NULL,1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `filecategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_agency`
--

DROP TABLE IF EXISTS `km_agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_agency` (
  `AgencyID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`AgencyID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_agency`
--

LOCK TABLES `km_agency` WRITE;
/*!40000 ALTER TABLE `km_agency` DISABLE KEYS */;
INSERT INTO `km_agency` VALUES (1,'กรรมวิธีข้อมูล  ฐานทัพเรือ สัตหีบ',1,NULL,NULL,NULL,NULL,NULL),(3,'Test01',0,NULL,NULL,NULL,NULL,NULL),(4,'Test',1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `km_agency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_indicator`
--

DROP TABLE IF EXISTS `km_indicator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_indicator` (
  `IndicatorID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเอกสาร อัตโนมัติ',
  `PurposeID` int(11) DEFAULT NULL COMMENT 'รหัสวัถุประสงค์',
  `AgencyID` int(11) DEFAULT NULL COMMENT 'ตัวเลขเอกสาร',
  `Number` varchar(50) DEFAULT NULL COMMENT 'ชื่อเป้าประสงค์',
  `Name` varchar(100) DEFAULT NULL COMMENT '% งาน',
  `Progressive` int(11) DEFAULT NULL COMMENT 'id หน่วยงาน',
  `IsActive` tinyint(4) DEFAULT NULL COMMENT 'สถาณะ',
  `Remark` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `CreateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้สร้าง',
  `CreateOn` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `UpdateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้แก้ไข',
  `UpdateOn` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`IndicatorID`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_indicator`
--

LOCK TABLES `km_indicator` WRITE;
/*!40000 ALTER TABLE `km_indicator` DISABLE KEYS */;
INSERT INTO `km_indicator` VALUES (34,74,1,'1.1.1','ทดสอบ',NULL,1,NULL,3,'2021-03-08 13:34:32',3,'2021-03-08 13:34:32'),(104,74,1,'1.1.2','ทดสอบ 1.1.2',NULL,1,NULL,3,'2021-03-08 15:09:19',3,'2021-03-08 15:09:19'),(114,74,1,'1.1.3','ต้องเป็น .3',NULL,1,NULL,3,'2021-03-08 15:09:34',3,'2021-03-08 15:09:34'),(124,84,1,'1.2.1','ต้องเป็น 1.2.1',NULL,1,NULL,3,'2021-03-08 15:09:50',3,'2021-03-08 15:09:50'),(134,84,1,'1.2.2','ต้องเป็น 1.2.2',NULL,1,NULL,3,'2021-03-08 15:10:12',3,'2021-03-08 15:10:12'),(144,74,1,'1.1.4','ต้องได้ 1.1.4',NULL,1,NULL,3,'2021-03-08 15:28:32',3,'2021-03-08 15:28:32'),(174,104,1,'4.1.1','ทำสอบ เพื่อความแน่ใจ',NULL,1,NULL,3,'2021-03-08 15:33:52',3,'2021-03-08 15:33:52'),(184,104,1,'4.1.2','ต้องเป็น 4.1.2',NULL,1,NULL,3,'2021-03-08 15:39:37',3,'2021-03-08 15:39:37'),(194,124,1,'5.1.1','หัวข้อที่ 5.1.1',NULL,1,NULL,3,'2021-03-08 15:45:52',3,'2021-03-08 15:45:52'),(204,134,1,'5.2.1','หัวข้อที่ 5.2.1',NULL,1,NULL,3,'2021-03-08 15:46:13',3,'2021-03-08 15:46:13'),(214,124,1,'5.1.2','หัวข้อที่ 5.1.2',NULL,1,NULL,3,'2021-03-08 15:46:35',3,'2021-03-08 15:46:35'),(224,144,1,'6.1.1','ต่อไป 1',NULL,1,NULL,3,'2021-03-09 14:45:06',3,'2021-03-09 14:45:06'),(234,144,1,'6.1.2','ต่อไป 2',NULL,1,NULL,3,'2021-03-09 14:45:51',3,'2021-03-09 14:45:51');
/*!40000 ALTER TABLE `km_indicator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_issue`
--

DROP TABLE IF EXISTS `km_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_issue` (
  `IssueID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเอกสาร อัตโนมัติ',
  `Number` varchar(50) NOT NULL COMMENT 'เลขเอกสาร',
  `Name` varchar(100) DEFAULT NULL COMMENT 'ชื่อประเด็นยุทธศาสตร์',
  `Progressive` int(11) DEFAULT NULL COMMENT '% งาน',
  `AgencyID` int(11) DEFAULT NULL COMMENT 'id หน่วยงาน',
  `IsActive` tinyint(4) DEFAULT NULL COMMENT 'สถาณะ',
  `Remark` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `CreateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้สร้าง',
  `CreateOn` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `UpdateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้แก้ไข',
  `UpdateOn` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`IssueID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_issue`
--

LOCK TABLES `km_issue` WRITE;
/*!40000 ALTER TABLE `km_issue` DISABLE KEYS */;
INSERT INTO `km_issue` VALUES (54,'1','ทดสอบระบบที่ 1 ',NULL,1,1,NULL,3,'2021-03-08 13:15:15',3,'2021-03-08 13:15:15'),(64,'2','ทดสอบระบบที่ 2 ',NULL,1,1,NULL,3,'2021-03-08 13:15:54',3,'2021-03-08 13:15:54'),(74,'3','ทดสอบระบบที่ 3 ',NULL,1,1,NULL,3,'2021-03-08 13:16:06',3,'2021-03-08 13:16:06'),(84,'4','Test',NULL,1,1,NULL,3,'2021-03-08 13:21:29',3,'2021-03-08 13:21:29'),(94,'5','หัวข้อที่ 5 ',NULL,1,1,NULL,3,'2021-03-08 15:44:24',3,'2021-03-08 15:44:24'),(104,'6','Test 3-9',NULL,1,1,NULL,3,'2021-03-09 14:44:01',3,'2021-03-09 14:44:01');
/*!40000 ALTER TABLE `km_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_project`
--

DROP TABLE IF EXISTS `km_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_project` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `StrategyID` int(11) DEFAULT NULL,
  `AgencyID` int(11) DEFAULT NULL,
  `Number` varchar(50) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Progressive` int(11) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_project`
--

LOCK TABLES `km_project` WRITE;
/*!40000 ALTER TABLE `km_project` DISABLE KEYS */;
INSERT INTO `km_project` VALUES (14,14,1,'5.1.1.1.1','ต้องเป็น 5.1.1.1.1',NULL,1,NULL,3,'2021-03-09 10:31:10',3,'2021-03-09 10:31:10'),(24,14,1,'5.1.1.1.2','ต้องเป็น 5.1.1.1.2',NULL,1,NULL,3,'2021-03-09 10:31:23',3,'2021-03-09 10:31:23'),(34,54,1,'5.2.1.2.1','ต้องเป็น 5.2.1.2.1',NULL,1,NULL,3,'2021-03-09 10:31:45',3,'2021-03-09 10:31:45'),(44,74,1,'6.1.1.1.1','ต่อไป 1 ',NULL,1,NULL,3,'2021-03-09 14:48:31',3,'2021-03-09 14:48:31'),(54,74,1,'6.1.1.1.2','ต่อไป 2',NULL,1,NULL,3,'2021-03-09 14:48:33',3,'2021-03-09 14:48:33');
/*!40000 ALTER TABLE `km_project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_purpose`
--

DROP TABLE IF EXISTS `km_purpose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_purpose` (
  `PurposeID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเอกสาร อัตโนมัติ',
  `IssueID` int(11) DEFAULT NULL COMMENT 'รหัสวัถุประสงค์',
  `Number` varchar(50) DEFAULT NULL COMMENT 'ตัวเลขเอกสาร',
  `Name` varchar(100) DEFAULT NULL COMMENT 'ชื่อเป้าประสงค์',
  `Progressive` int(11) DEFAULT NULL COMMENT '% งาน',
  `AgencyID` int(11) DEFAULT NULL COMMENT 'id หน่วยงาน',
  `IsActive` tinyint(4) DEFAULT NULL COMMENT 'สถาณะ',
  `Remark` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `CreateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้สร้าง',
  `CreateOn` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `UpdateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้แก้ไข',
  `UpdateOn` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`PurposeID`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_purpose`
--

LOCK TABLES `km_purpose` WRITE;
/*!40000 ALTER TABLE `km_purpose` DISABLE KEYS */;
INSERT INTO `km_purpose` VALUES (74,54,'1.1','ทดสอบระบบที่ 1.1',NULL,1,1,NULL,3,'2021-03-08 13:16:23',3,'2021-03-08 13:16:23'),(84,54,'1.2','ทดสอบระบบที่ 1.2',NULL,1,1,NULL,3,'2021-03-08 13:16:43',3,'2021-03-08 13:16:43'),(94,64,'2.1','ทดสอบระแบบที่ 2.1',NULL,1,1,NULL,3,'2021-03-08 13:17:14',3,'2021-03-08 13:17:14'),(104,84,'4.1','test001',NULL,1,1,NULL,3,'2021-03-08 13:21:58',3,'2021-03-08 13:21:58'),(114,74,'3.1','ต้องเป็น 3.1 ',NULL,1,1,NULL,3,'2021-03-08 15:32:34',3,'2021-03-08 15:32:34'),(124,94,'5.1','หัวข้อที่ 5.1',NULL,1,1,NULL,3,'2021-03-08 15:44:54',3,'2021-03-08 15:44:54'),(134,94,'5.2','หัวข้อที่ 5.2',NULL,1,1,NULL,3,'2021-03-08 15:45:13',3,'2021-03-08 15:45:13'),(144,104,'6.1','ต่อไป',NULL,1,1,NULL,3,'2021-03-09 14:44:38',3,'2021-03-09 14:44:38');
/*!40000 ALTER TABLE `km_purpose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_role`
--

DROP TABLE IF EXISTS `km_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_role` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_role`
--

LOCK TABLES `km_role` WRITE;
/*!40000 ALTER TABLE `km_role` DISABLE KEYS */;
INSERT INTO `km_role` VALUES (1,'Admin',1,'Admin ',NULL,NULL,NULL,NULL),(2,'Test01',0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `km_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_strategy`
--

DROP TABLE IF EXISTS `km_strategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_strategy` (
  `StrategyID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสเอกสาร อัตโนมัติ',
  `IndicatorID` int(11) DEFAULT NULL COMMENT 'รหัสวัถุประสงค์',
  `AgencyID` int(11) DEFAULT NULL COMMENT 'ตัวเลขเอกสาร',
  `Number` varchar(50) DEFAULT NULL COMMENT 'ชื่อเป้าประสงค์',
  `Name` varchar(100) DEFAULT NULL COMMENT '% งาน',
  `Progressive` int(11) DEFAULT NULL COMMENT 'id หน่วยงาน',
  `IsActive` tinyint(4) DEFAULT NULL COMMENT 'สถาณะ',
  `Remark` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `CreateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้สร้าง',
  `CreateOn` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `UpdateBy` int(11) DEFAULT NULL COMMENT 'ชื่อผู้แก้ไข',
  `UpdateOn` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`StrategyID`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_strategy`
--

LOCK TABLES `km_strategy` WRITE;
/*!40000 ALTER TABLE `km_strategy` DISABLE KEYS */;
INSERT INTO `km_strategy` VALUES (14,194,1,'5.1.1.1','ต้องเป็น 5.1.1.1',NULL,1,NULL,3,'2021-03-09 09:07:18',3,'2021-03-09 09:07:18'),(34,194,1,'5.1.1.2','ต้องเป็น 5.1.1.2',NULL,1,NULL,3,'2021-03-09 09:20:55',3,'2021-03-09 09:20:55'),(44,204,1,'5.2.1.1','ต้องเป็น 5.2.1.1',NULL,1,NULL,3,'2021-03-09 09:21:18',3,'2021-03-09 09:21:18'),(54,204,1,'5.2.1.2','ต้องเป็น 5.2.1.2',NULL,1,NULL,3,'2021-03-09 09:21:39',3,'2021-03-09 09:21:39'),(64,104,1,'1.1.2.1','ต้องเป็น 1.1.2.1',NULL,1,NULL,3,'2021-03-09 09:21:55',3,'2021-03-09 09:21:55'),(74,224,1,'6.1.1.1','ต่อไป',NULL,1,NULL,3,'2021-03-09 14:48:09',3,'2021-03-09 14:48:09');
/*!40000 ALTER TABLE `km_strategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_sunit`
--

DROP TABLE IF EXISTS `km_sunit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_sunit` (
  `SunitID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) DEFAULT NULL,
  `AgencyID` int(11) DEFAULT NULL,
  `AgencyList` varchar(100) DEFAULT NULL,
  `Number` varchar(50) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`SunitID`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_sunit`
--

LOCK TABLES `km_sunit` WRITE;
/*!40000 ALTER TABLE `km_sunit` DISABLE KEYS */;
INSERT INTO `km_sunit` VALUES (44,14,1,'1 ','5.1.1.1.1.1','ต้องเป็น 5.1.1.1.1.1',1,NULL,3,'2021-03-09 10:40:42',3,'2021-03-09 10:40:42'),(54,14,1,'1 ','5.1.1.1.1.2','ต้องเป็น 5.1.1.1.1.2',1,NULL,3,'2021-03-09 10:42:23',3,'2021-03-09 10:42:23'),(64,24,1,'1 ','5.1.1.1.2.1','ต้องเป็น 5.1.1.1.2.1',1,NULL,3,'2021-03-09 10:42:56',3,'2021-03-09 10:42:56');
/*!40000 ALTER TABLE `km_sunit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_sunitdetail`
--

DROP TABLE IF EXISTS `km_sunitdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_sunitdetail` (
  `SunitDetailID` int(11) NOT NULL AUTO_INCREMENT,
  `SunitID` int(11) DEFAULT NULL,
  `Number` varchar(50) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Progressive` int(11) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`SunitDetailID`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_sunitdetail`
--

LOCK TABLES `km_sunitdetail` WRITE;
/*!40000 ALTER TABLE `km_sunitdetail` DISABLE KEYS */;
INSERT INTO `km_sunitdetail` VALUES (74,44,'5.1.1.1.1.1.1','ต้องเป็น 5.1.1.1.1.1.1',25,1,NULL,3,'2021-03-09 10:57:36',3,'2021-03-09 10:57:36'),(84,44,'5.1.1.1.1.1.2','ต้องเป็น 5.1.1.1.1.1.2',25,1,NULL,3,'2021-03-09 10:59:14',3,'2021-03-09 10:59:14'),(94,44,'5.1.1.1.1.1.3','ต้องเป็น 5.1.1.1.1.2.3',25,1,NULL,3,'2021-03-09 10:59:44',3,'2021-03-09 10:59:44'),(104,54,'5.1.1.1.1.2.1','ต้องเป็น 5.1.1.1.1.2.1',100,1,NULL,3,'2021-03-09 11:00:15',3,'2021-03-09 11:00:15'),(114,64,'5.1.1.1.2.1.1','Test',10,1,NULL,3,'2021-03-21 20:58:11',3,'2021-03-21 20:58:11'),(124,64,'5.1.1.1.2.1.2','Test001',10,1,NULL,3,'2021-03-21 21:06:45',3,'2021-03-21 21:06:45'),(134,64,'5.1.1.1.2.1.3','Test001',10,1,NULL,3,'2021-03-21 21:12:05',3,'2021-03-21 21:12:05'),(144,64,'5.1.1.1.2.1.4','Test',10,1,NULL,3,'2021-03-21 21:14:10',3,'2021-03-21 21:14:10'),(154,64,'5.1.1.1.2.1.5','Test001',10,1,NULL,3,'2021-03-21 21:18:24',3,'2021-03-21 21:18:24'),(164,64,'5.1.1.1.2.1.6','Test001',10,1,NULL,3,'2021-03-21 21:20:04',3,'2021-03-21 21:20:04'),(174,64,'5.1.1.1.2.1.7','Test001',10,1,NULL,3,'2021-03-21 21:22:31',3,'2021-03-21 21:22:31'),(184,64,'5.1.1.1.2.1.8','Test001',10,1,NULL,3,'2021-03-21 21:23:47',3,'2021-03-21 21:23:47'),(194,64,'5.1.1.1.2.1.9','Test001',10,1,NULL,3,'2021-03-21 21:25:50',3,'2021-03-21 21:25:50'),(204,64,'5.1.1.1.2.1.10','Test001',10,1,NULL,3,'2021-03-21 21:26:25',3,'2021-03-21 21:26:25'),(214,44,'5.1.1.1.1.1.4','Test001',10,1,NULL,3,'2021-03-24 02:24:13',3,'2021-03-24 02:24:13');
/*!40000 ALTER TABLE `km_sunitdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_upload`
--

DROP TABLE IF EXISTS `km_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_upload` (
  `UploadID` int(11) NOT NULL AUTO_INCREMENT,
  `SunitDetailID` int(11) DEFAULT NULL,
  `FileName` varchar(100) DEFAULT NULL,
  `FileType` varchar(100) DEFAULT NULL,
  `FileData` varbinary(8000) DEFAULT NULL,
  `FilePath` varchar(1000) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `km_uploadcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`UploadID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_upload`
--

LOCK TABLES `km_upload` WRITE;
/*!40000 ALTER TABLE `km_upload` DISABLE KEYS */;
INSERT INTO `km_upload` VALUES (14,184,'WIN_20200713_10_36_54_Pro.jpg',NULL,NULL,'Upload/WIN_20200713_10_36_54_Pro.jpg',1,NULL,3,'2021-03-21 21:23:47',3,'2021-03-21 21:23:47',NULL),(24,204,'WIN_20200713_10_36_54_Pro.jpg',NULL,NULL,'Upload/WIN_20200713_10_36_54_Pro.jpg',1,NULL,3,'2021-03-21 21:26:25',3,'2021-03-21 21:26:25',NULL),(34,204,'WIN_20200713_14_19_33_Pro.jpg',NULL,NULL,'Upload/WIN_20200713_14_19_33_Pro.jpg',1,NULL,3,'2021-03-21 21:26:25',3,'2021-03-21 21:26:25',NULL),(44,214,'WIN_20200713_10_36_54_Pro.jpg',NULL,NULL,'Upload/WIN_20200713_10_36_54_Pro.jpg',1,NULL,3,'2021-03-24 02:24:13',3,'2021-03-24 02:24:13',NULL),(54,214,'WIN_20200713_14_19_33_Pro.jpg',NULL,NULL,'Upload/WIN_20200713_14_19_33_Pro.jpg',1,NULL,3,'2021-03-24 02:24:13',3,'2021-03-24 02:24:13',NULL);
/*!40000 ALTER TABLE `km_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `km_user`
--

DROP TABLE IF EXISTS `km_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `km_user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `AgencyID` int(11) DEFAULT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `km_user`
--

LOCK TABLES `km_user` WRITE;
/*!40000 ALTER TABLE `km_user` DISABLE KEYS */;
INSERT INTO `km_user` VALUES (2,1,1,'AdminTest01','$2y$10$k4svhorGFgflKNH8uwc7fOTfkjQmtJhkivxz58pwKowVeECIdts1u',1,NULL,0,'2021-02-10 09:33:18',0,'2021-02-10 09:33:18'),(3,1,1,'Admin1','$2y$10$n1Ak5YR1T.VMuK73KLuX1OtLVdTsAOXNcUym0SNVVpTVjHi3UhDAG',1,NULL,0,'2021-02-10 09:47:56',0,'2021-02-10 09:47:56'),(4,1,1,'Anna','$2y$10$sDqU013Na/evApb4DrXAGuLsjq2x4u6NrjPnk.9rMsiSoIgLYIQfi',1,NULL,3,'2021-02-10 13:32:04',3,'2021-02-10 13:32:04'),(5,1,1,'kasmesak','$2y$10$8sS8HEzXcU60GfTkTD9QGOZ5LEwy01h2FAhUKwzHtftDVzdWncJ5.',1,NULL,3,'2021-02-10 16:23:29',3,'2021-02-10 16:23:29');
/*!40000 ALTER TABLE `km_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmqa_concept`
--

DROP TABLE IF EXISTS `pmqa_concept`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pmqa_concept` (
  `ConceptFileID` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(100) NOT NULL,
  `FileType` varchar(100) CHARACTER SET utf16 NOT NULL,
  `FileData` varbinary(8000) NOT NULL,
  `UrlPath` varchar(500) NOT NULL,
  `FilePath` varchar(100) NOT NULL,
  `IsActive` tinyint(4) NOT NULL,
  `Remark` varchar(100) NOT NULL,
  `CreateBy` int(11) NOT NULL,
  `CreateOn` datetime NOT NULL,
  `UpdateBy` int(11) NOT NULL,
  `UpdateOn` datetime NOT NULL,
  PRIMARY KEY (`ConceptFileID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmqa_concept`
--

LOCK TABLES `pmqa_concept` WRITE;
/*!40000 ALTER TABLE `pmqa_concept` DISABLE KEYS */;
INSERT INTO `pmqa_concept` VALUES (3,'Test01','','','','ยุทธศาสตร์ ฐท.สส-หน้า-6_page-0001.jpg',1,'Test01',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00'),(4,'Test02','','','','ยุทธศาสตร์ ฐท.สส-หน้า-6_page-0001.jpg',0,'Test02',0,'0000-00-00 00:00:00',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pmqa_concept` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmqa_document`
--

DROP TABLE IF EXISTS `pmqa_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pmqa_document` (
  `DocumentFileID` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(100) DEFAULT NULL,
  `FileType` varchar(100) DEFAULT NULL,
  `FileData` varbinary(8000) DEFAULT NULL,
  `FilePath` varchar(1000) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`DocumentFileID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmqa_document`
--

LOCK TABLES `pmqa_document` WRITE;
/*!40000 ALTER TABLE `pmqa_document` DISABLE KEYS */;
INSERT INTO `pmqa_document` VALUES (1,'Repository.docx','docx',NULL,'Repository.docx',1,'Repository.docx',NULL,NULL,NULL,NULL),(2,'206-21-768x432.jpg','jpg',NULL,'206-21-768x432.jpg',1,'206-21-768x432.jpg',NULL,NULL,NULL,NULL),(3,'docss01.jpg','jpg',NULL,'docss01.jpg',0,'docss01.jpg',NULL,NULL,NULL,NULL),(4,'maxresdefault.jpg','jpg',NULL,'maxresdefault.jpg',1,'maxresdefault.jpg',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pmqa_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmqa_home`
--

DROP TABLE IF EXISTS `pmqa_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pmqa_home` (
  `HomeFileID` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(100) DEFAULT NULL,
  `FileType` varchar(100) DEFAULT NULL,
  `FileData` varchar(8000) DEFAULT NULL,
  `FilePath` varchar(1000) DEFAULT NULL,
  `IsActive` tinytext,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`HomeFileID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmqa_home`
--

LOCK TABLES `pmqa_home` WRITE;
/*!40000 ALTER TABLE `pmqa_home` DISABLE KEYS */;
INSERT INTO `pmqa_home` VALUES (8,'Test01',NULL,NULL,'ยุทธศาสตร์ ฐท.สส-หน้า-1_page-0001.jpg','1','Test01',NULL,NULL,NULL,NULL),(9,'Test02',NULL,NULL,'ยุทธศาสตร์ ฐท.สส-หน้า-6_page-0001.jpg','0','Test002',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pmqa_home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmqa_organization`
--

DROP TABLE IF EXISTS `pmqa_organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pmqa_organization` (
  `OrganizationFileID` int(11) NOT NULL AUTO_INCREMENT,
  `FileName` varchar(100) DEFAULT NULL,
  `HeadText` varchar(100) DEFAULT NULL,
  `TitleText` varchar(100) DEFAULT NULL,
  `FileType` varchar(100) DEFAULT NULL,
  `FileData` varchar(8000) DEFAULT NULL,
  `FilePath` varchar(1000) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`OrganizationFileID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmqa_organization`
--

LOCK TABLES `pmqa_organization` WRITE;
/*!40000 ALTER TABLE `pmqa_organization` DISABLE KEYS */;
INSERT INTO `pmqa_organization` VALUES (1,'งานทร.txt',NULL,NULL,'txt',NULL,'งานทร.txt',1,'งานทร.txt',NULL,NULL,NULL,NULL),(2,'efef.txt',NULL,NULL,'txt',NULL,'efef.txt',0,'efef.txt',NULL,NULL,NULL,NULL),(3,'งานทร.txt',NULL,NULL,'txt',NULL,'งานทร.txt',0,'งานทร.txt',NULL,NULL,NULL,NULL),(4,'Repository.docx',NULL,NULL,'docx',NULL,'Repository.docx',1,'Repository.docx',NULL,NULL,NULL,NULL),(5,'migration update in filed.txt',NULL,NULL,'txt',NULL,'migration update in filed.txt',1,'migration update in filed.txt',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pmqa_organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategory` (
  `SubCategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Category_ID` int(11) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`SubCategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,3,'การดำเนินงานของ PMQA หมวด 3 การให้ความสำคัญกับผู้รับบริการและผู้มีส่วนได้ส่วนเสียของฐานทัพเรือ สัตหี',1,NULL,NULL,NULL,NULL,NULL),(2,3,'สารสนเทศผู้รับบริการและผู้มีส่วนได้ส่วนเสีย ในปัจจุบัน และ อนาคต ของกรมแพทย์ทหารเรือ',1,'Admin Add',NULL,NULL,NULL,NULL),(3,4,'การวัด การวิเคราะห์ และการปรับปรุงผลการดำเนินการของส่วนราชการ',1,'Admin Add',NULL,NULL,NULL,NULL),(4,4,'การจัดการความรู้ สารสนเทศและเทคโนโลยีสารสนเทศ',1,'Admin Add',NULL,NULL,NULL,NULL),(5,5,'ขีดความสามารถและอัตราด้านบุคลากร',1,'Admin Add',NULL,NULL,NULL,NULL),(6,6,'PMQA หมวด 6 การมุ่งเน้นระบบปฏิบัติการ',1,'Admin Add',NULL,NULL,NULL,NULL),(7,9,'test หัวข้อ 007',1,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useradmin`
--

DROP TABLE IF EXISTS `useradmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `useradmin` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้ใช้งานสำหรับจัดการ',
  `FullName` varchar(100) NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `Password` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `IsActive` tinyint(4) NOT NULL COMMENT 'สถาณะ',
  `Remark` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ',
  `CreateBy` int(11) DEFAULT NULL COMMENT 'ผู้สร้างเอกสาร',
  `CreateOn` datetime DEFAULT NULL COMMENT 'วันที่สร้าง',
  `UpdateBy` int(11) DEFAULT NULL COMMENT 'ผู้แก้ไขเอกสาร',
  `UpdateOn` datetime DEFAULT NULL COMMENT 'วันที่แก้ไข',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useradmin`
--

LOCK TABLES `useradmin` WRITE;
/*!40000 ALTER TABLE `useradmin` DISABLE KEYS */;
INSERT INTO `useradmin` VALUES (1,'Admin','admin1234',1,'default ',NULL,NULL,NULL,NULL),(8,'ทดสอบไทย01','admin1234',1,'Test01',NULL,NULL,NULL,NULL),(9,'idที่999999','admin12345',1,'Testidที่9',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `useradmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workview`
--

DROP TABLE IF EXISTS `workview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workview` (
  `WorkID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `IsActive` tinyint(4) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateOn` datetime DEFAULT NULL,
  `UpdateBy` int(11) DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  PRIMARY KEY (`WorkID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workview`
--

LOCK TABLES `workview` WRITE;
/*!40000 ALTER TABLE `workview` DISABLE KEYS */;
INSERT INTO `workview` VALUES (1,'หมวด 1 ',1,'admin add',NULL,NULL,NULL,NULL),(2,'หมวด 2',1,'admin add',NULL,NULL,NULL,NULL),(3,'หมวด 3',1,'admin add',NULL,NULL,NULL,NULL),(4,'หมวด 4',1,'admin add',NULL,NULL,NULL,NULL),(5,'หมวด 5',1,'admin add',NULL,NULL,NULL,NULL),(6,'หมวด 6',1,'admin add',NULL,NULL,NULL,NULL),(7,'หมวด 7',1,'admin add',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `workview` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-24  9:53:02
