/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 8.0.23 : Database - doctorappointment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`doctorappointment` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `doctorappointment`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `account_id` int unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Pending',
  `type` varchar(512) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL,
  `role` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `accounts` */

insert  into `accounts`(`account_id`,`status`,`type`,`created_at`,`role`) values 
(1,'Pending','patient','2021-03-13 11:37:58',''),
(3,'Pending','patient','2021-03-20 22:12:42',''),
(6,'Pending','doctor','2021-07-13 21:37:58',''),
(12,'Pending','patient','2020-03-13 11:37:58',''),
(42,'Pending','patient','2021-03-18 11:23:59',''),
(45,'Active','patient','2021-03-18 11:23:59',''),
(147,'Active','patient','2021-03-21 10:42:30',''),
(148,'Active','patient','2021-03-21 11:42:10',''),
(149,'Pending','patient','2021-03-22 18:26:02',''),
(160,'Active','patient','2021-03-22 19:41:23',''),
(206,'Pending','patient','2021-03-22 21:36:42',''),
(212,'Pending','patient','2021-03-22 22:00:07',''),
(230,'Pending','patient','2021-03-22 22:50:17',''),
(295,'Pending','patient','2021-03-23 12:27:12',''),
(307,'Active','doctor','2021-03-23 13:24:15',''),
(310,'Pending','doctor','2021-03-23 14:07:13',''),
(315,'Pending','patient','2021-03-23 15:52:13',''),
(325,'Pending','patient','2021-03-23 16:10:54',''),
(330,'Pending','doctor','2021-03-23 16:19:24',''),
(331,'Pending','doctor','2021-03-24 16:11:36',''),
(333,'Pending','patient','2021-03-24 16:12:06',''),
(341,'Pending','patient','2021-03-24 16:36:28',''),
(351,'Pending','doctor','2021-03-31 12:42:18',''),
(356,'Pending','doctor','2021-04-01 13:57:21',''),
(361,'Pending','doctor','2021-04-01 14:11:11',''),
(362,'Pending','doctor','2021-04-01 14:21:47',''),
(363,'Pending','doctor','2021-04-01 14:22:37',''),
(364,'Pending','doctor','2021-04-01 14:26:00',''),
(365,'Pending','doctor','2021-04-01 14:29:14',''),
(366,'Pending','doctor','2021-04-01 14:29:30',''),
(367,'Pending','doctor','2021-04-01 14:49:43',''),
(368,'Pending','doctor','2021-04-01 14:54:28',''),
(369,'Pending','doctor','2021-04-01 15:06:02',''),
(370,'Pending','doctor','2021-04-01 15:08:35',''),
(371,'Active','doctor','2021-04-01 15:09:11',''),
(372,'Pending','patient','2021-04-01 16:37:47',''),
(373,'Pending','patient','2021-04-01 16:38:18',''),
(374,'Active','patient','2021-04-01 16:39:40',''),
(375,'Active','patient','2021-04-01 17:12:16',''),
(376,'Pending','doctor','2021-04-01 17:13:37',''),
(377,'Pending','patient','2021-04-01 17:13:55',''),
(378,'Pending','patient','2021-04-02 08:58:29',''),
(379,'Active','patient','2021-04-02 08:58:44','user'),
(380,'Active','doctor','2021-04-02 09:06:54','admin'),
(381,'Pending','doctor','2021-04-02 13:46:33','admin'),
(434,'Pending','patient','2021-06-23 12:49:05','user'),
(435,'Pending','doctor','2021-06-23 12:49:18','user'),
(436,'Pending','patient','2021-06-23 12:49:59','user'),
(437,'Active','patient','2021-06-25 08:56:28','user');

/*Table structure for table `appointmentdetails` */

DROP TABLE IF EXISTS `appointmentdetails`;

CREATE TABLE `appointmentdetails` (
  `app_detail_id` int unsigned NOT NULL AUTO_INCREMENT,
  `p` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prescription` varchar(1024) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` varchar(512) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `appointment_id` int unsigned NOT NULL,
  PRIMARY KEY (`app_detail_id`),
  KEY `fk_appointment_detail` (`appointment_id`),
  CONSTRAINT `fk_appointment_detail` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `appointmentdetails` */

insert  into `appointmentdetails`(`app_detail_id`,`p`,`prescription`,`type`,`appointment_id`) values 
(1,'Something bad happened.LOL HGHGHG','Something bad hap463463pened.LOL HGHGHG','blood sample',1),
(6,'Fever','Paracetamol','Normal examination',5),
(7,'Fever','Paracetamol','Normal examination',4);

/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `appointment_id` int unsigned NOT NULL AUTO_INCREMENT,
  `scheduled_at` timestamp NOT NULL,
  `reserved_at` timestamp NOT NULL,
  `office` int unsigned NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `doctor_id` int unsigned NOT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `fk_patient_appointment` (`patient_id`),
  KEY `fk_doctor_appointment` (`doctor_id`),
  CONSTRAINT `fk_doctor_appointment` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`),
  CONSTRAINT `fk_patient_appointment` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `appointments` */

insert  into `appointments`(`appointment_id`,`scheduled_at`,`reserved_at`,`office`,`patient_id`,`doctor_id`) values 
(1,'2025-03-13 11:37:58','2024-03-13 11:37:58',50,172,1),
(2,'2021-07-13 21:37:58','2021-06-13 21:37:58',13,2,2),
(4,'2021-03-13 11:37:58','2021-04-07 22:23:47',10,161,41),
(5,'2021-03-13 11:37:58','2021-04-07 22:29:08',10,172,41);

/*Table structure for table `doctors` */

DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `doctor_id` int unsigned NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(256) COLLATE utf8_bin NOT NULL,
  `doctor_surname` varchar(256) COLLATE utf8_bin NOT NULL,
  `doctor_email` varchar(512) COLLATE utf8_bin NOT NULL,
  `password` varchar(512) COLLATE utf8_bin NOT NULL,
  `account_id` int unsigned NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `token_expire` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  UNIQUE KEY `uq_email` (`doctor_email`),
  KEY `fk_doctor_account_id` (`account_id`),
  CONSTRAINT `fk_doctor_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `doctors` */

insert  into `doctors`(`doctor_id`,`doctor_name`,`doctor_surname`,`doctor_email`,`password`,`account_id`,`token`,`token_expire`) values 
(1,'John ','D2oe','zz','0',6,'42b94ccdf0aflzna39b6e9628e7cc752',NULL),
(2,'enes','pasiiiic','a44','66',307,'42b94ccdf0afae4a39b6e9628e7cc752',NULL),
(5,'anes','anees','anes@gmail','66',310,'3318494f73adccf8a1f7a308f19dd068',NULL),
(6,'samija','kustura','saMIJA@gmail','aa22',330,'34591f627fc735fa9bd4e564a03cf5fc',NULL),
(7,'doctor','dooctor','doctor@gmail.com','a322a22',331,'b76a5f6d6824abdb4868d86d0eeec812',NULL),
(19,'doctor','dooctor','a46nbn','a322a22',351,'b2df1a0551355a99a3f26068c58e394d',NULL),
(41,'ajdin','pasic','rixxjok@gmail.com','b3cd915d758008bd19d0f2428fbb354a',380,'7849cfe9673aea6e8b832aca38d4bdfc','2021-06-26 21:42:13'),
(42,'hajd','hajdic','mirza.krupic@stu.ibu.edu.ba','857f25dfbe630389e5725ee8602a93e9',381,'48c149e045f13c303e48b60628b33f5e','2021-05-17 09:55:35');

/*Table structure for table `patients` */

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `patient_id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(256) COLLATE utf8_bin NOT NULL,
  `patient_surname` varchar(256) COLLATE utf8_bin NOT NULL,
  `patient_email` varchar(512) COLLATE utf8_bin NOT NULL,
  `password` varchar(512) COLLATE utf8_bin NOT NULL,
  `account_id` int unsigned NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `token_expire` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`patient_id`),
  UNIQUE KEY `uq_email` (`patient_email`),
  KEY `fk_patient_account_id` (`account_id`),
  CONSTRAINT `fk_patient_account_id` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `patients` */

insert  into `patients`(`patient_id`,`patient_name`,`patient_surname`,`patient_email`,`password`,`account_id`,`token`,`token_expire`) values 
(2,'VLADIMIR','Doe','a','0',1,'',NULL),
(4,'BAnur','Poplata','b','0',3,'',NULL),
(7,'Canur','Mirnesicccc','d','0',12,'',NULL),
(10,'Anees','Bnadzovic','halid.beslic@stu.ibu.edu.ba','probaa44',42,'',NULL),
(11,'Amar','Ahmic','adem@gmail.com','adem123',45,'1f98ef75c9078d5166b307227b1d2935',NULL),
(13,'Anur','Nesmic','nesim@gmail.com','nesim123',147,'1d9a3574425e15a47f18f51e8cdeee2b',NULL),
(14,'Anur','VESKIC','vesko@gmail.com','vesko123',148,'cbb09254892ef2e1b27ebe50770cfd47',NULL),
(15,'mija','mijic','mijao@gmail.com','mija123',149,'6c13eb38b0d46ee75ff1a6ca5be8e654',NULL),
(25,'fksarajevo','fksarajevooo','sar@gmail.com','99',160,'9ffd41c19c408cd361b0b79d6ba9263c',NULL),
(69,'fkrajevo','fksao','an','969',206,'b2e5ec32b251f37ccf86b8f5d35fd154',NULL),
(75,'kupus','kupuus','wwa','19',212,'7121ad0326506e3600b56359cf966006',NULL),
(93,'staro','elejzo','abc','19',230,'d370b3bd2e39c23978b9e99993da714f',NULL),
(150,'enes','enees','amiig','66',295,'192c519b519439bdbc449d4e2a7ce0db',NULL),
(156,'enes','enees','ann','66',315,'b378b322cc8076d41961f1e7f83ce887',NULL),
(157,'enes','enees','ancilln','66',325,'7237bfc877348332e47358578e668e3e',NULL),
(158,'enes','enees','pacijent@mail.','66',333,'8a6a6614aedc4430867e016d71f8bcc7',NULL),
(161,'John ','Doe','eneciloza@gmail','66',341,'bf74faeb1329beb099193da516dfdf81',NULL),
(172,'ajdin','pasic','rixxjok@gmail.com','47bce5c74f589f4867dbd57e9ca9f808',379,'62f67e1791244f91e0d931529dd51bfd','2021-06-27 09:27:59'),
(175,'ajdin','Pasic','ajdin.pasic@stu.ibu.edu.ba','81dc9bdb52d04dc20036dbd8313ed055',437,'b653b36b0ab59c01a399a0abbb43c6a3',NULL);

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `payment_id` int unsigned NOT NULL AUTO_INCREMENT,
  `amount` int unsigned NOT NULL,
  `payment_date` timestamp NOT NULL,
  `serial_number` varchar(512) COLLATE utf8_bin NOT NULL,
  `patient_id` int unsigned NOT NULL,
  `appointment_id` int unsigned NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_appointment_id` (`appointment_id`),
  KEY `fk_patient_id` (`patient_id`),
  CONSTRAINT `fk_appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`),
  CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `payments` */

insert  into `payments`(`payment_id`,`amount`,`payment_date`,`serial_number`,`patient_id`,`appointment_id`) values 
(1,100,'2021-03-13 11:37:58','N77T10',172,1),
(3,2550,'2021-06-19 14:28:44','XC466H',172,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
