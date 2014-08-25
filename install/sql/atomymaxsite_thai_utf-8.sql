-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: atomymaxsite
-- ------------------------------------------------------
-- Server version 5.5.37-0ubuntu0.14.04.1

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
-- Table structure for table `web_activeuser`
--

DROP TABLE IF EXISTS `web_activeuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_activeuser` (
  `ct_no` int(11) NOT NULL AUTO_INCREMENT,
  `ct_yyyy` int(4) NOT NULL DEFAULT '0',
  `ct_mm` int(2) NOT NULL DEFAULT '0',
  `ct_dd` int(2) NOT NULL DEFAULT '0',
  `ct_ip` varchar(15) NOT NULL DEFAULT '',
  `ct_count` int(2) NOT NULL DEFAULT '0',
  `ct_time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ct_no`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_activeuser`
--

LOCK TABLES `web_activeuser` WRITE;
/*!40000 ALTER TABLE `web_activeuser` DISABLE KEYS */;
INSERT INTO `web_activeuser` VALUES (1,2014,7,3,'192.168.56.1',1,1404403857),(2,2014,8,19,'192.168.56.1',1,1408462277);
/*!40000 ALTER TABLE `web_activeuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_admin`
--

DROP TABLE IF EXISTS `web_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(150) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `picture` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `level` (`level`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_admin`
--

LOCK TABLES `web_admin` WRITE;
/*!40000 ALTER TABLE `web_admin` DISABLE KEYS */;
INSERT INTO `web_admin` VALUES (1,'admin','81dc9bdb52d04dc20036dbd8313ed055','นายชัดสกร พิกุลทอง','admin@mail.com',1,'admin_1291354356_adm-04.jpg');
/*!40000 ALTER TABLE `web_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_alumnus`
--

DROP TABLE IF EXISTS `web_alumnus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_alumnus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `alum_id` varchar(10) NOT NULL DEFAULT '',
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `nic_name` varchar(20) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `age` char(2) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `picture` varchar(30) DEFAULT '0',
  `numid` varchar(13) DEFAULT NULL,
  `schid` varchar(5) DEFAULT NULL,
  `yearfin` varchar(4) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `amper` varchar(40) NOT NULL,
  `province` varchar(20) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `WORK` varchar(100) DEFAULT NULL,
  `hobby` varchar(100) DEFAULT NULL,
  `COMMENT` varchar(100) DEFAULT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `icq` varchar(10) DEFAULT '0',
  `msn` varchar(50) DEFAULT '0',
  `yahoo` varchar(30) DEFAULT '0',
  `qq` varchar(10) DEFAULT '0',
  `cam` char(1) DEFAULT '0',
  `mic` char(1) DEFAULT '0',
  `emo` char(3) DEFAULT NULL,
  `worksta` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alum_id` (`alum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_alumnus`
--

LOCK TABLES `web_alumnus` WRITE;
/*!40000 ALTER TABLE `web_alumnus` DISABLE KEYS */;
INSERT INTO `web_alumnus` VALUES (1,'0001','วิทูรย์','บุญเฉลียว','แป๊บ','10/04/2527','26','1','','1440500003615','','2530','vituru_59@hotmail.com','http://','6/202 ม.5','คลองสาววา','กรุงเทพมหานคร','','บริษัท ณฐโชคปัญญาทรัพย์ จำกัด','ทำอาหาร','สวัสดีเพื่อนๆๆทุกคนครับ','144.gif','0','0','0','0','0','0','e1','บริษัท ณฐโชคปัญญาทรัพย์ จำกัด','0873384517','10510'),(2,'0002','โชคทวี','ศรีแพงเลิศ','ไดร์','31/03/2530','24','1','','1440500089471','','2541','tapache@HOTMAIL.COM','http://','66/9','ชื่นชม','มหาสารคาม','ทำงาน','กรุงเทพ','เล่นดนตรี','สวัสดีงับ','member.png','0','0','0','0','0','0','e1','กรุงเทพ','0831513034','44160'),(3,'0003','นาย รุ่งโรจน์','แข็งฤทธิ์','โรจน์','10/11/2528','26','1','','1440500017918','','2540','www.rungrot@hotmait.com','http://','35/27 ถ.นวมินทร์','บึงกุ่ม','กรุงเทพมหานคร','','กรุงเทพ','นอน','สวัสดีครับ','member.png','0','0','0','0','0','0','e1','กรุงเทพ','0851505114','10230');
/*!40000 ALTER TABLE `web_alumnus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_block`
--

DROP TABLE IF EXISTS `web_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `blockname` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `sfile` varchar(10) NOT NULL,
  `code` text,
  `pblock` char(10) DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '1',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_block`
--

LOCK TABLES `web_block` WRITE;
/*!40000 ALTER TABLE `web_block` DISABLE KEYS */;
INSERT INTO `web_block` VALUES (1,'mainmenu','เมนูหลัก','mainmenu','php','','left',1,1),(2,'member','ระบบสมาชิก','member','php','','left',2,1),(15,'news4','ข่าวสารทั่วไป','shownews4','php','','center',5,1),(28,'webboard','กระดานถามตอบ','webboard','php','','user1',1,1),(32,'news1','ข่าวประชาสัมพันธ์','shownews1','php','','user2',4,1);
/*!40000 ALTER TABLE `web_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_config`
--

DROP TABLE IF EXISTS `web_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_config` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `posit` varchar(100) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posit` (`posit`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_config`
--

LOCK TABLES `web_config` WRITE;
/*!40000 ALTER TABLE `web_config` DISABLE KEYS */;
INSERT INTO `web_config` VALUES (1,'title','atomymaxsite'),(2,'url','http://localhost.dev/atomymaxsite'),(3,'path','/var/www/atomymaxsite'),(4,'footer1','atomymaxsite'),(5,'footer2','atomymaxsite'),(6,'email','admin@mail.com'),(7,'templates','cli3'),(8,'iso','utf-8');
/*!40000 ALTER TABLE `web_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_config_category`
--

DROP TABLE IF EXISTS `web_config_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_config_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_config_category`
--

LOCK TABLES `web_config_category` WRITE;
/*!40000 ALTER TABLE `web_config_category` DISABLE KEYS */;
INSERT INTO `web_config_category` VALUES (1,'หัวเวปภาพเล็ก'),(2,'หัวเวปภาพใหญ่'),(3,'ท้ายเวป');
/*!40000 ALTER TABLE `web_config_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_gallery`
--

DROP TABLE IF EXISTS `web_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(10) NOT NULL DEFAULT '',
  `posted` varchar(100) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  `enable_comment` tinyint(1) NOT NULL DEFAULT '0',
  `pageview` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_gallery`
--

LOCK TABLES `web_gallery` WRITE;
/*!40000 ALTER TABLE `web_gallery` DISABLE KEYS */;
INSERT INTO `web_gallery` VALUES (1,'1','admin','1310841751',1,1,0,'DSCN0923a.jpg'),(2,'1','admin','1310841751',1,1,0,'DSCN0925a.jpg'),(3,'1','admin','1310841751',1,2,0,'DSCN0928a.jpg'),(4,'1','admin','1310841751',1,1,0,'DSCN0931a.jpg');
/*!40000 ALTER TABLE `web_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_gallery_category`
--

DROP TABLE IF EXISTS `web_gallery_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_gallery_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `category_detail` text NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_gallery_category`
--

LOCK TABLES `web_gallery_category` WRITE;
/*!40000 ALTER TABLE `web_gallery_category` DISABLE KEYS */;
INSERT INTO `web_gallery_category` VALUES (1,'ทำบุญเข้าพรรษา','ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554','1310840961',14);
/*!40000 ALTER TABLE `web_gallery_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_gallery_comment`
--

DROP TABLE IF EXISTS `web_gallery_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_gallery_comment` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(7) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `gallery_id` (`gallery_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_gallery_comment`
--

LOCK TABLES `web_gallery_comment` WRITE;
/*!40000 ALTER TABLE `web_gallery_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_gallery_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_groups`
--

DROP TABLE IF EXISTS `web_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `description` text NOT NULL,
  `news_add` tinyint(4) NOT NULL DEFAULT '0',
  `news_edit` tinyint(4) NOT NULL DEFAULT '0',
  `news_del` tinyint(4) NOT NULL DEFAULT '0',
  `newscat_add` tinyint(4) NOT NULL DEFAULT '0',
  `newscat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `newscat_del` tinyint(4) NOT NULL DEFAULT '0',
  `admin_add` tinyint(4) NOT NULL DEFAULT '0',
  `admin_edit` tinyint(4) NOT NULL DEFAULT '0',
  `admin_del` tinyint(4) NOT NULL DEFAULT '0',
  `group_add` tinyint(4) NOT NULL DEFAULT '0',
  `group_edit` tinyint(4) NOT NULL DEFAULT '0',
  `group_del` tinyint(4) NOT NULL DEFAULT '0',
  `links_add` tinyint(4) NOT NULL DEFAULT '0',
  `links_edit` tinyint(4) NOT NULL DEFAULT '0',
  `links_del` tinyint(4) NOT NULL DEFAULT '0',
  `article_add` tinyint(4) NOT NULL DEFAULT '0',
  `article_edit` tinyint(4) NOT NULL DEFAULT '0',
  `article_del` tinyint(4) NOT NULL DEFAULT '0',
  `articlecat_add` tinyint(4) NOT NULL DEFAULT '0',
  `articlecat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `articlecat_del` tinyint(4) NOT NULL DEFAULT '0',
  `contact_add` tinyint(4) NOT NULL DEFAULT '0',
  `contact_edit` tinyint(4) NOT NULL DEFAULT '0',
  `contact_del` tinyint(4) NOT NULL DEFAULT '0',
  `calendar_add` tinyint(4) NOT NULL DEFAULT '0',
  `calendar_edit` tinyint(4) NOT NULL DEFAULT '0',
  `calendar_del` tinyint(4) NOT NULL DEFAULT '0',
  `webboard_add` tinyint(4) NOT NULL DEFAULT '0',
  `webboard_edit` tinyint(4) NOT NULL DEFAULT '0',
  `webboard_del` tinyint(4) NOT NULL DEFAULT '0',
  `editortalk_edit` tinyint(4) NOT NULL DEFAULT '0',
  `aboutus_edit` tinyint(4) NOT NULL DEFAULT '0',
  `minepass_edit` tinyint(4) NOT NULL DEFAULT '0',
  `page_add` tinyint(4) NOT NULL DEFAULT '0',
  `page_edit` tinyint(4) NOT NULL DEFAULT '0',
  `page_del` tinyint(4) NOT NULL DEFAULT '0',
  `research_add` tinyint(4) NOT NULL DEFAULT '0',
  `research_edit` tinyint(4) NOT NULL DEFAULT '0',
  `research_del` tinyint(4) NOT NULL DEFAULT '0',
  `researchcat_add` tinyint(4) NOT NULL DEFAULT '0',
  `researchcat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `researchcat_del` tinyint(4) NOT NULL DEFAULT '0',
  `download_add` tinyint(4) NOT NULL DEFAULT '0',
  `download_edit` tinyint(4) NOT NULL DEFAULT '0',
  `download_del` tinyint(4) NOT NULL DEFAULT '0',
  `downloadcat_add` tinyint(4) NOT NULL DEFAULT '0',
  `downloadcat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `downloadcat_del` tinyint(4) NOT NULL DEFAULT '0',
  `member_add` tinyint(4) NOT NULL DEFAULT '0',
  `member_edit` tinyint(4) NOT NULL DEFAULT '0',
  `member_del` tinyint(4) NOT NULL DEFAULT '0',
  `config_add` tinyint(4) NOT NULL DEFAULT '0',
  `config_edit` tinyint(4) NOT NULL DEFAULT '0',
  `config_del` tinyint(4) NOT NULL DEFAULT '0',
  `block_add` tinyint(4) NOT NULL DEFAULT '0',
  `block_edit` tinyint(4) NOT NULL DEFAULT '0',
  `block_del` tinyint(4) NOT NULL DEFAULT '0',
  `poll_add` tinyint(4) NOT NULL DEFAULT '0',
  `poll_edit` tinyint(4) NOT NULL DEFAULT '0',
  `poll_del` tinyint(4) NOT NULL DEFAULT '0',
  `gbook_edit` tinyint(4) NOT NULL DEFAULT '0',
  `gbook_del` tinyint(4) NOT NULL DEFAULT '0',
  `gallery_add` tinyint(4) NOT NULL DEFAULT '0',
  `gallery_edit` tinyint(4) NOT NULL DEFAULT '0',
  `gallery_del` tinyint(4) NOT NULL DEFAULT '0',
  `gallery_detail` int(4) NOT NULL DEFAULT '0',
  `gallerycat_add` tinyint(4) NOT NULL DEFAULT '0',
  `gallerycat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `gallerycat_del` tinyint(4) NOT NULL DEFAULT '0',
  `video_add` tinyint(4) NOT NULL DEFAULT '0',
  `video_edit` tinyint(4) NOT NULL DEFAULT '0',
  `video_del` tinyint(4) NOT NULL DEFAULT '0',
  `videocat_add` tinyint(4) NOT NULL DEFAULT '0',
  `videocat_edit` tinyint(4) NOT NULL DEFAULT '0',
  `videocat_del` tinyint(4) NOT NULL DEFAULT '0',
  `ipblock_add` tinyint(4) NOT NULL DEFAULT '0',
  `ipblock_edit` tinyint(4) NOT NULL DEFAULT '0',
  `ipblock_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_groups`
--

LOCK TABLES `web_groups` WRITE;
/*!40000 ALTER TABLE `web_groups` DISABLE KEYS */;
INSERT INTO `web_groups` VALUES (1,'Webmaster','webmaster',1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(2,'Admin','admin',1,1,1,1,1,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1),(3,'staff','staff',1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,0,0,0,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,1,1,1,0,0,0,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `web_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_ipblock`
--

DROP TABLE IF EXISTS `web_ipblock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_ipblock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_ipblock`
--

LOCK TABLES `web_ipblock` WRITE;
/*!40000 ALTER TABLE `web_ipblock` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_ipblock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_mail`
--

DROP TABLE IF EXISTS `web_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_mail` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `subject` varchar(120) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `form_mail` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_mail`
--

LOCK TABLES `web_mail` WRITE;
/*!40000 ALTER TABLE `web_mail` DISABLE KEYS */;
INSERT INTO `web_mail` VALUES (1,'สุขสันต์วันเกิด','สุขสันต์วันเกิด ขอให้มีความสุขมากๆ นะครับผม จาก maxtom.sytes.net','vt9vm@hotmail.com');
/*!40000 ALTER TABLE `web_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_member`
--

DROP TABLE IF EXISTS `web_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_member` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `nic_name` varchar(20) NOT NULL,
  `date` int(2) NOT NULL DEFAULT '0',
  `month` int(2) NOT NULL DEFAULT '0',
  `year` varchar(4) NOT NULL DEFAULT '',
  `age` varchar(10) NOT NULL DEFAULT '',
  `sex` varchar(8) NOT NULL DEFAULT '',
  `address` varchar(150) NOT NULL DEFAULT '',
  `amper` varchar(40) NOT NULL DEFAULT '',
  `province` varchar(40) NOT NULL DEFAULT '',
  `zipcode` varchar(15) NOT NULL DEFAULT '',
  `phone` varchar(10) NOT NULL DEFAULT '',
  `education` varchar(30) NOT NULL DEFAULT '',
  `work` varchar(30) NOT NULL DEFAULT '',
  `office` varchar(200) NOT NULL,
  `user` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `member_pic` varchar(50) NOT NULL,
  `signup` varchar(40) NOT NULL DEFAULT '',
  `lastlog` varchar(28) NOT NULL,
  `dtnow` varchar(28) NOT NULL,
  `blog` varchar(5) DEFAULT NULL,
  `post` int(6) NOT NULL,
  `topic` int(6) NOT NULL,
  `signature` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_member`
--

LOCK TABLES `web_member` WRITE;
/*!40000 ALTER TABLE `web_member` DISABLE KEYS */;
INSERT INTO `web_member` VALUES (1,'web1','นายชัดสกร พิกุลทอง','',23,3,'2516','36','ชาย','152 หมู่ 2 ต.หนองครก','เมือง','ศรีสะเกษ','33000','0899469997','ปริญญาโท','ครู/อาจารย์','โรงเรียนเขวาไร่ศึกษา','admin','81dc9bdb52d04dc20036dbd8313ed055','admin@mail.com','admin_1291354356_adm-04.jpg','30/11/2552','14/06/10 - 20:41','23/06/10 - 17:45','1',0,0,'<img src=\"icon/sigtom.jpg\">');
/*!40000 ALTER TABLE `web_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_menu`
--

DROP TABLE IF EXISTS `web_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `icon` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_menu`
--

LOCK TABLES `web_menu` WRITE;
/*!40000 ALTER TABLE `web_menu` DISABLE KEYS */;
INSERT INTO `web_menu` VALUES (1,'การตั้งค่า config','19.png','?name=admin&file=config'),(2,'ผู้ดูแลระบบ','chart.png','?name=admin&file=user'),(3,'สมาชิก','8.png','?name=admin&file=member'),(4,'Filemanager','20.png','?name=admin&file=filemanager'),(5,'Block','16.png','?name=admin&file=block'),(6,'Video','9.png','?name=admin&file=video'),(7,'Block IP','14.png','?name=admin&file=ipblock'),(8,'ข่าวประชาสัมพันธ์','2.png','?name=admin&file=news'),(9,'สาระความรู้','5.png','?name=admin&file=knowledge'),(10,'ดาวน์โหลด','9.png','?name=admin&file=download'),(11,'Blog','14.png','?name=admin&file=blog'),(12,'ทำเนียบบุคลากร','10.png','?name=admin&file=personnel'),(13,'ผลงานทางวิชาการ','3.png','?name=admin&file=research'),(14,'Gallery','12.png','?name=admin&file=gallery'),(15,'ศิษย์เก่า','11.png','?name=admin&file=alumnus'),(16,'Webboard','history.png','?name=admin&file=webboard'),(17,'สมุดเยี่ยม','users.png','?name=admin&file=gbook'),(18,'ปฏิทินกิจกรรม','4.png','?name=admin&file=calendar'),(19,'ฝากข้อความ','18.png','?name=admin&file=smiletag'),(20,'สุ่มรูปภาพ','13.png','?name=admin&file=uploads'),(21,'Poll','plugin.png','?name=admin&file=poll'),(22,'โครงการ','17.png','?name=admin/workboard&file=index&op=WorkBoardIndex'),(23,'รายการเมนู','7.png','?name=admin&file=page'),(24,'Backup','history.png','?name=admin&file=backupindex'),(25,'ออกจากระบบ','21.png','?name=admin&file=logout');
/*!40000 ALTER TABLE `web_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_news`
--

DROP TABLE IF EXISTS `web_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(10) NOT NULL DEFAULT '',
  `topic` varchar(255) NOT NULL DEFAULT '',
  `headline` varchar(255) NOT NULL DEFAULT '',
  `detail` text NOT NULL,
  `posted` varchar(100) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  `update_date` varchar(50) NOT NULL DEFAULT '',
  `enable_comment` tinyint(1) NOT NULL DEFAULT '0',
  `pageview` int(11) NOT NULL DEFAULT '0',
  `attach` varchar(100) NOT NULL,
  `pic` int(1) DEFAULT NULL,
  `ran` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_news`
--

LOCK TABLES `web_news` WRITE;
/*!40000 ALTER TABLE `web_news` DISABLE KEYS */;
INSERT INTO `web_news` VALUES (1,'2','วันต่อต้านยาเสพติด 2554','ประเทศไทย&nbsp; ในการประชุมเมื่อวันที่ 14 มิถุนายน 2531 ซึ่งที่ประชุมคณะรัฐมนตรีได้มีมติให้กำหนดวันที่ 26 มิถุนายน ของทุกปี เป็นวันต่อต้านยาเสพติดโดยเริ่มตั้งแต่ปี พ.ศ. 2531เป็นต้นมา','<img align=\"left\" alt=\"\" height=\"150\" src=\"UserFiles/Image/PIC_3836.jpg\" width=\"200\" />ประเทศไทย&nbsp; ในการประชุมเมื่อวันที่ 14 มิถุนายน 2531 ซึ่งที่ประชุมคณะรัฐมนตรีได้มีมติให้กำหนดวันที่ 26 มิถุนายน ของทุกปี เป็นวันต่อต้านยาเสพติดโดยเริ่มตั้งแต่ปี พ.ศ. 2531เป็นต้นมา<br />\r\n<br />\r\nรูปภาพเพิ่มเติม<br />\r\n<a href=\"http://banphue.sytes.net/?name=gallery&amp;op=gallery_detail&amp;id=12\">http://banphue.sytes.net/&shy;name=gallery&amp;op=gallery_detail&amp;id=12</a>&nbsp;','admin','1309600387','1309600387',1,9,'',1,0),(2,'2','รณรงค์เลือกตั้ง ส.ส. 3 ก.ค.2554','การเลือกตั้ง ส.ส.ที่จะมีขึ้น&nbsp; ในวันที่ 3 กรกฎาคม 2554 จำนวนสมาชิกสภาผู้แทนราษฎร ทั้งประเทศรวม 500 คน แบ่งเป็น ส.ส. แบบแบ่งเขตเลือกตั้งจำนวน 375 คน และ ส.ส.แบบบัญชีรายชื่อจำนวน 125 คน&nbsp;&nbsp;โรงเรียนจัดการรณรงค์ขั้นในวันที่ 26 มิถุนายน 2554','<img align=\"left\" alt=\"\" height=\"150\" src=\"UserFiles/Image/P6230724.jpg\" width=\"200\" />การเลือกตั้ง ส.ส.ที่จะมีขึ้น&nbsp; ในวันที่ 3 กรกฎาคม 2554 นับเป็นการเลือกตั้ง ส.ส.ครั้งแรกภายหลังจากการประกาศใช้รัฐธรรมนูญแห่งราชอาณาจักรไทย แก้ไขเพิ่มเติม (ฉบับที่ 1)พุทธศักราช 2554 ซึ่งมีการแก้ไขเพิ่มเติมบทบัญญัติในส่วน&nbsp;&nbsp;&nbsp; ที่เกี่ยวข้องกับจำนวนสมาชิกสภาผู้แทนราษฎร ทั้งประเทศรวม 500 คน แบ่งเป็น ส.ส. แบบแบ่งเขตเลือกตั้งจำนวน 375 คน และ ส.ส.แบบบัญชีรายชื่อจำนวน 125 คน โดยมีเจตนารมณ์ที่คำนึงถึงสิทธิและความเสมอภาคในการเลือกตั้ง ไม่ว่าจะอยู่ในภูมิลำเนาใด พื้นที่ใด&nbsp; &nbsp;&nbsp;เขตใด ก็จะมีสิทธิที่เท่าเทียมกันในการไปใช้สิทธิเลือก ส.ส. จึงกำหนดให้ผู้มีสิทธิเลือกตั้งทุกคนทุกเขตเลือกตั้ง เลือกส.ส.แบบแบ่งเขตเลือกตั้งและแบบบัญชีรายชื่อได้อย่างละหนึ่งหมายเลขอย่างเท่าเทียมกันทั่วประเทศ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรงเรียนจัดการรณรงค์ขั้นในวันที่ 26 มิถุนายน 2554&nbsp;&nbsp; <br />\r\n<br />\r\nรูปภาพเพิ่มเติม<br />\r\n<a href=\"http://banphue.sytes.net/?name=gallery&amp;op=gallery_detail&amp;id=13\">http://banphue.sytes.net/&shy;name=gallery&amp;op=gallery_detail&amp;id=13</a>&nbsp;','admin','1309601125','1309601125',1,14,'',1,0),(3,'2','ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ','กองลูกเสือโรงเรียนสามัญ โรงเรียนบ้านผือได้ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ วันที่ 1 กรกฏาคม 2554 ณ ค่ายลูกเสือชั่วคราวโรงเรียนเชียงยืนพิทยาคม อ.ชื่นชม จ.มหาสารคาม','<img align=\"left\" alt=\"\" height=\"150\" src=\"UserFiles/Image/P6270821.jpg\" width=\"200\" />กองลูกเสือโรงเรียนสามัญ โรงเรียนบ้านผือได้ร่วมกิจกรรมวันคล้ายวันสถาปนาคณะลูกเสือแห่งชาติ วันที่ 1 กรกฏาคม 2554 ณ ค่ายลูกเสือชั่วคราวโรงเรียนเชียงยืนพิทยาคม อ.ชื่นชม จ.มหาสารคาม ซึ่งกิจกรรม มีพิธีสดุดีล้นเกล้ารัชกาลที่ 6 ผู้ให้กำเนิดลูกเสือไทย มีการเดินสวนสนาม และบำเพ็ญประโยชน์<br />\r\nรูปภาพเพิ่มเติมที่<br />\r\n<a href=\"http://banphue.sytes.net/index.php?name=gallery&amp;op=gallery_detail&amp;id=15\">http://banphue.sytes.net/index.php&shy;name=gallery&amp;op=gallery_detail&amp;id=15</a>&nbsp;<br />\r\n','admin','1310038120','1310038120',1,15,'',1,0),(4,'2','เข้าค่ายภาษาอังกฤษ','โดยความร่วมมือระหว่างโรงเรียนบ้านผือ โรงเรียนบ้านจานโนนสูง โรงเรียนบ้านโคกข่า และคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยมหาสารคาม ได้จัดทำโครงการเข้าค่ายภาษาอังกฤษขึ้น ในวันที่ 9 กรกฎาคม 2554 ณ หอประชุมโรงเรียนบ้านจานโนนสูง<br />\r\n','<img align=\"left\" alt=\"\" height=\"150\" src=\"UserFiles/Image/S4204327a.jpg\" width=\"200\" />โดยความร่วมมือระหว่างโรงเรียนบ้านผือ โรงเรียนบ้านจานโนนสูง โรงเรียนบ้านโคกข่า และคณะมนุษยศาสตร์และสังคมศาสตร์ มหาวิทยาลัยมหาสารคาม ได้จัดทำโครงการเข้าค่ายภาษาอังกฤษขึ้น ในวันที่ 9 กรกฎาคม 2554 ณ หอประชุมโรงเรียนบ้านจานโนนสูง<br />\r\n','admin','1310216972','1310216972',1,15,'',1,0),(5,'2','ทำบุญเนื่องในโอกาสวันอาสาฬหบูชาและเข้าพรรษา','ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554<br />\r\n','ครู นักเรียนได้ร่วมกันถวายเทียนพรรษา ถวายสังฑทาน บำเพ็ญประโยชน์โดยการทำความสะอาดวัดบ้านผือ เนื่องในโอกาสวันอาสาฬหบูชาและวันเข้าพรรษา ในวันที่ 14 กรกฎาคม 2554<br />\r\n<br />\r\nดูภาพเพิ่มเติมได้ที่<br />\r\n<a href=\"http://banphue.sytes.net/index.php?name=gallery&amp;op=gallery_detail&amp;id=17\">http://banphue.sytes.net/index.php&shy;name=gallery&amp;op=gallery_detail&amp;id=17</a>&nbsp;<br />\r\n','admin','1310842320','1310842320',1,20,'',1,0);
/*!40000 ALTER TABLE `web_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_news_category`
--

DROP TABLE IF EXISTS `web_news_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `sort` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_news_category`
--

LOCK TABLES `web_news_category` WRITE;
/*!40000 ALTER TABLE `web_news_category` DISABLE KEYS */;
INSERT INTO `web_news_category` VALUES (1,'ข่าวประชาสัมพันธ์',1,'Doc.png'),(2,'ข่าวสารทั่วไป',2,'Apps.png'),(3,'การฝึกอบรม/ศึกษาดูงาน',3,'Picture.png');
/*!40000 ALTER TABLE `web_news_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_news_comment`
--

DROP TABLE IF EXISTS `web_news_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_news_comment` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `news_id` int(7) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_news_comment`
--

LOCK TABLES `web_news_comment` WRITE;
/*!40000 ALTER TABLE `web_news_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_news_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_page`
--

DROP TABLE IF EXISTS `web_page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `menuname` varchar(50) NOT NULL,
  `detail` text,
  `menugr` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `sort` int(5) DEFAULT '1',
  `proto` varchar(50) NOT NULL,
  `links` varchar(150) DEFAULT NULL,
  `target` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_page`
--

LOCK TABLES `web_page` WRITE;
/*!40000 ALTER TABLE `web_page` DISABLE KEYS */;
INSERT INTO `web_page` VALUES (1,'personnel','ทำเนียบบุคลากร',NULL,'mainmenu',1,5,'','index.php?name=personnel&file=detail','_top'),(2,'gallery','ประมวลภาพกิจกรรม',NULL,'mainmenu',1,6,'','index.php?name=gallery','_top'),(3,'gbook','สมุดเยี่ยม',NULL,'mainmenu',1,7,'','index.php?name=gbook','_top'),(4,'calendar','ปฏิทินกิจกรรม',NULL,'mainmenu',1,8,'','index.php?name=calendar','_top'),(5,'news','ข่าวสาร/ประชาสัมพันธ์',NULL,'mainmenu',1,9,'','index.php?name=news','_top'),(6,'knowledge','สาระความรู้',NULL,'mainmenu',1,10,'','index.php?name=knowledge','_top'),(7,'workboard','โครงการ/งาน',NULL,'mainmenu',1,11,'','index.php?name=workboard','_top'),(8,'webboard','กระดานข่าว',NULL,'mainmenu',1,12,'','index.php?name=webboard','_top'),(9,'Downloads','ดาวน์โหลด',NULL,'mainmenu',1,13,'','index.php?name=download','_top'),(10,'research','ผลงานทางวิชาการ',NULL,'mainmenu',1,14,'','index.php?name=research','_top'),(11,'alumnus','สมาคมศิษย์เก่า',NULL,'mainmenu',1,15,'','index.php?name=alumnus','_top'),(12,'ติดต่อเรา','contact',NULL,'mainmenu',1,16,'','index.php?name=contact','_top'),(13,'Blog','blog',NULL,'mainmenu',1,17,'','index.php?name=blog','_top'),(14,'ที่ตั้งโรงเรียน','ที่ตั้งโรงเรียน','<p style=\"text-align: center\">\r\n <span style=\"font-size: 16px\"><strong>ที่ตั้งโรงเรียน<br />\r\n </strong></span></p>\r\n<center>\r\n  <iframe frameborder=\"0\" height=\"450\" marginheight=\"0\" marginwidth=\"0\" scrolling=\"no\" src=\"http://maps.google.co.th/maps/ms?hl=th&amp;ie=UTF8&amp;msa=0&amp;msid=112899538573060308323.000496a7e9ada6b8025a5&amp;t=h&amp;ll=16.499659,103.106024&amp;spn=0.004598,0.00589&amp;z=17&amp;output=embed\" width=\"550\"></iframe><br />\r\n <small>ดู <a href=\"http://maps.google.co.th/maps/ms?hl=th&amp;ie=UTF8&amp;msa=0&amp;msid=112899538573060308323.000496a7e9ada6b8025a5&amp;t=h&amp;ll=16.499659,103.106024&amp;spn=0.004598,0.00589&amp;z=17&amp;source=embed\" style=\"text-align: left; color: #0000ff\">โรงเรียนบ้านผือ</a> ในแผนที่ขนาดใหญ่กว่า</small></center>\r\n','mainmenu',1,3,'',NULL,''),(15,'ประวัติโรงเรียน','ประวัติโรงเรียน','<p>\r\n  &nbsp;</p>\r\n<center>\r\n  <span style=\"font-size: 16px\"><strong>ประวัติโรงเรียน</strong></span></center>\r\n<p>\r\n <span style=\"font-size: 16px\">โรงเรียนบ้านผือ&nbsp;&nbsp; ตั้งอยู่หมู่ที่&nbsp; 7&nbsp; ตำบลหนองกุง&nbsp; อำเภอชื่นชม&nbsp; จังหวัดมหาสารคาม&nbsp; ตั้งขึ้นเมื่อ&nbsp;&nbsp; พ.ศ.&nbsp; 2496&nbsp;&nbsp; โดย&nbsp; นายอำเภอเป็นผู้จัดตั้ง&nbsp; ด้วยงบประมาณของกระทรวงศึกษาธิการ&nbsp; ซึ่งมีนายบุญช่วย&nbsp; แสงไกร&nbsp; เป็นครูใหญ่คนแรก&nbsp; โดยใช้ศาลาวัดโพธิ์ศรีบ้านผือเป็นสถานศึกษา&nbsp;&nbsp; ต่อมาเมื่อวันที่&nbsp; 20&nbsp; กรกฎาคม&nbsp;&nbsp;&nbsp; 2516&nbsp;&nbsp; นายบุญทัน&nbsp;&nbsp; ศรีแพงเลิศ&nbsp; ผู้ใหญ่บ้านพร้อมดร้อมด้วยคณะกรรมการหมู่บ้านได้มอบที่ดินเพื่อใช้เป็นสถานที่ก่อตั้งโรงเรียน&nbsp; ทางราชการได้ใช้งบประมาณเพื่อก่อสร้างอาคารเรียนขึ้นและย้ายนักเรียนจากศาลาวัดโพธิ์ศรีบ้านผือมาที่โรงเรียนแห่งนี้จนถึงปัจจุบัน&nbsp; <br />\r\n  <br />\r\n  &nbsp;ปัจจุบันโรงเรียนบ้านผือ&nbsp;&nbsp; เปิดเรียนตั้งแต่ระดับชั้นอนุบาลจนถึงชั้นประถมศึกษาปีที่&nbsp; 6&nbsp; มีข้าราชการครูทั้งหมด&nbsp;&nbsp;8&nbsp; คน&nbsp; ครูอัตราจ้าง&nbsp; 1&nbsp; คน&nbsp; พนักงานบริการ&nbsp;&nbsp; 1&nbsp; คน&nbsp;&nbsp; นักเรียน&nbsp; 139&nbsp; คน&nbsp; มีนายชัดสกร พิกุลทอง&nbsp; เป็นผู้อำนวยการโรงเรียน<br />\r\n <br />\r\n  </span></p>\r\n<p style=\"text-align: center\">\r\n <span style=\"font-size: 16px\"><span style=\"color: #00f\"><span style=\"font-size: 16px\"><strong>คำขวัญขงโรงเรียน<br />\r\n  </strong></span></span></span></p>\r\n<p>\r\n <span style=\"font-size: 16px\">&nbsp;</span></p>\r\n<p style=\"text-align: center\">\r\n <span style=\"font-size: 16px\"><span style=\"font-size: 16px\">วิชาการเด่น<br />\r\n เน้นจริยธรรม&nbsp; นำกีฬา<br />\r\n พัฒนาชุมชน</span></span></p>\r\n<p style=\"text-align: center\">\r\n  <span style=\"font-size: 16px\"><span style=\"font-size: 16px\"><br />\r\n  <strong><span style=\"color: #00f\">ปรัชญาของโรงเรียน<br />\r\n </span></strong></span><br />\r\n &ldquo; ความสำเร็จของศิษย์&nbsp; คือ&nbsp; ความภูมิใจของครู &ldquo;</span></p>\r\n<p style=\"text-align: center\">\r\n  <span style=\"font-size: 16px\"><span style=\"font-size: 16px\">&nbsp;</span></span></p>\r\n<p style=\"text-align: center\">\r\n  <span style=\"font-size: 16px\"><span style=\"font-size: 16px\"><span style=\"color: #00f\"><strong>สีประจำโรงเรียน<br />\r\n </strong></span><br />\r\n  &ldquo; ขาว &ndash; น้ำเงิน &rdquo;<br />\r\n </span></span></p>\r\n','mainmenu',1,4,'',NULL,''),(16,'video','video','โมดูลแสดง video','mainmenu',1,18,'','index.php?name=video','_top');
/*!40000 ALTER TABLE `web_page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_random`
--

DROP TABLE IF EXISTS `web_random`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_random` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `rm_news` int(5) NOT NULL,
  `rm_image` varchar(255) NOT NULL,
  `rm_topic` varchar(255) NOT NULL,
  `rm_detail` varchar(255) NOT NULL,
  `rm_link` varchar(255) NOT NULL,
  `width` int(50) NOT NULL,
  `height` int(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(50) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_random`
--

LOCK TABLES `web_random` WRITE;
/*!40000 ALTER TABLE `web_random` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_random` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_templates`
--

DROP TABLE IF EXISTS `web_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_templates` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `temname` varchar(200) NOT NULL,
  `picname` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `width` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `sort` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `temname` (`temname`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_templates`
--

LOCK TABLES `web_templates` WRITE;
/*!40000 ALTER TABLE `web_templates` DISABLE KEYS */;
INSERT INTO `web_templates` VALUES (1,'cli3','topmini.png','image/x-png','1000','112',1),(2,'cli3','topbig.png','image/x-png','1000','268',2),(3,'cli3','footer.png','image/x-png','1000','79',3),(4,'atomy','banner1.png','image/x-png','996','36',1),(5,'atomy','banner.png','image/x-png','996','152',2),(6,'atomy','barfoot.png','image/x-png','996','94',3);
/*!40000 ALTER TABLE `web_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_useronline`
--

DROP TABLE IF EXISTS `web_useronline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_useronline` (
  `post_date` int(50) NOT NULL,
  `useronline` varchar(50) NOT NULL,
  `timeout` int(50) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_useronline`
--

LOCK TABLES `web_useronline` WRITE;
/*!40000 ALTER TABLE `web_useronline` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_useronline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_webboard`
--

DROP TABLE IF EXISTS `web_webboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_webboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` int(3) NOT NULL DEFAULT '0',
  `topic` varchar(255) NOT NULL DEFAULT '',
  `detail` text NOT NULL,
  `picture` varchar(50) NOT NULL DEFAULT '',
  `post_name` varchar(50) NOT NULL DEFAULT '',
  `is_member` int(7) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  `post_update` varchar(50) NOT NULL DEFAULT '',
  `pin_date` varchar(50) NOT NULL,
  `pageview` int(5) NOT NULL DEFAULT '0',
  `enable_show` int(2) NOT NULL,
  `att` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`category`),
  KEY `id` (`id`),
  KEY `post_date` (`post_date`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_webboard`
--

LOCK TABLES `web_webboard` WRITE;
/*!40000 ALTER TABLE `web_webboard` DISABLE KEYS */;
INSERT INTO `web_webboard` VALUES (1,1,'โหลดเวอร์ชัน 2.5','รอเวอร์ชัน 2.5 ครับ&nbsp; ตัวอย่างตามนี้&nbsp; <a href=\"http://banphue.sytes.net\">http://banphue.sytes.net</a><br /><br />\r\n<br /><br />\r\nจะเปิดให้โหลดได้ตอนไหนครับ<br /><br />\r\nกำหนดวันไหนได้ครับ','','ครูเอ็กซ์',0,'182.52.184.117','1300329304','1309885042','',315,0,''),(2,1,'atomymaxsite2.5','<p><br />\r\n ท่าน ผอ. จะเปิดให้อัปเดทไหมครับ&nbsp; ถ้าได้เป็นวันไหนหรอครับ<br /><br />\r\n <br /><br />\r\n  (สมาชิกเก่า)</p><br />\r\n','','kikkok_2531',0,'223.207.174.147','1309885338','1309885338','',81,0,'');
/*!40000 ALTER TABLE `web_webboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_webboard_category`
--

DROP TABLE IF EXISTS `web_webboard_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_webboard_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `category_des` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `status` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_webboard_category`
--

LOCK TABLES `web_webboard_category` WRITE;
/*!40000 ALTER TABLE `web_webboard_category` DISABLE KEYS */;
INSERT INTO `web_webboard_category` VALUES (1,'ห้องนั่งเล่น','',1,0),(2,'สอบถาม พูดคุยเกี่ยวกับการเรียนการสอน','',2,0);
/*!40000 ALTER TABLE `web_webboard_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_webboard_comment`
--

DROP TABLE IF EXISTS `web_webboard_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_webboard_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(7) NOT NULL DEFAULT '0',
  `detail` text NOT NULL,
  `picture` varchar(50) NOT NULL DEFAULT '',
  `post_name` varchar(50) NOT NULL DEFAULT '',
  `is_member` int(7) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) NOT NULL DEFAULT '',
  `post_date` varchar(50) NOT NULL DEFAULT '',
  `att` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_webboard_comment`
--

LOCK TABLES `web_webboard_comment` WRITE;
/*!40000 ALTER TABLE `web_webboard_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `web_webboard_comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-22 16:13:33
