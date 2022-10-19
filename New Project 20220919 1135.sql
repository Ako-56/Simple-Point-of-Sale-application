-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.73-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema apos
--

CREATE DATABASE IF NOT EXISTS apos;
USE apos;

--
-- Definition of table `counters`
--

DROP TABLE IF EXISTS `counters`;
CREATE TABLE `counters` (
  `Code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(145) DEFAULT NULL,
  `Location` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counters`
--

/*!40000 ALTER TABLE `counters` DISABLE KEYS */;
INSERT INTO `counters` (`Code`,`Name`,`Location`) VALUES 
 (1,'Thika TMall ','Thika One'),
 (2,'The Junction','Ngong'),
 (3,'Thika 2','Thika');
/*!40000 ALTER TABLE `counters` ENABLE KEYS */;


--
-- Definition of table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
CREATE TABLE `discounts` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT NULL,
  `Offer` varchar(145) DEFAULT NULL,
  `Amount` double DEFAULT NULL,
  `AddedBy` int(10) unsigned DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` (`Id`,`Code`,`Offer`,`Amount`,`AddedBy`,`Status`) VALUES 
 (1,1000134,'Happy Hour',10,NULL,'Current'),
 (2,4567009,'Happy Hour',2,NULL,'Current'),
 (3,123456,'happy hour',2,NULL,'Current');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;


--
-- Definition of table `hive`
--

DROP TABLE IF EXISTS `hive`;
CREATE TABLE `hive` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT NULL,
  `Tno` varchar(145) DEFAULT NULL,
  `Quantity` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hive`
--

/*!40000 ALTER TABLE `hive` DISABLE KEYS */;
/*!40000 ALTER TABLE `hive` ENABLE KEYS */;


--
-- Definition of table `itemcategory`
--

DROP TABLE IF EXISTS `itemcategory`;
CREATE TABLE `itemcategory` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Category` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemcategory`
--

/*!40000 ALTER TABLE `itemcategory` DISABLE KEYS */;
INSERT INTO `itemcategory` (`Id`,`Category`) VALUES 
 (4,'Food Stuffs'),
 (5,'Beaverages'),
 (6,'Oilk');
/*!40000 ALTER TABLE `itemcategory` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `RefId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(145) DEFAULT NULL,
  `Items` varchar(145) DEFAULT NULL,
  `Href` varchar(45) DEFAULT NULL,
  `Seqns` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`RefId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`RefId`,`Title`,`Items`,`Href`,`Seqns`) VALUES 
 (11,'8','Add Menu Items','menu.php',1),
 (12,'8','Assign Rights','assign.php',2),
 (13,'9','Add Counter','counter.php',1),
 (14,'9','Add Operator','operators.php',2),
 (15,'10','Item Categories','categories.php',1),
 (16,'10','Add Suppliers','suppliers.php',2),
 (17,'10','Add Sale Items','items.php',3),
 (18,'10','Add Stock','stocktake.php',4),
 (19,'10','Discounts & Offers','offers.php',5),
 (20,'10','Stock Trail/Reoder Report','stocktrail.php',6),
 (21,'10','Products Catalogue','catalogue.php',7),
 (22,'10','Return Inwards','returnin.php',8),
 (23,'10','Return Outwards','rout.php',9),
 (24,'11','Make Sales','sale.php',1),
 (25,'12','Sale Per Item Report','peritem.php',1),
 (26,'12','Profit & Loss','profit.php',2),
 (27,'12','Sell Per Counter Report','percounter.php',3),
 (28,'12','Sell Per Employee Report','perempl.php',4);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `menu_group`
--

DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) DEFAULT NULL,
  `Default` varchar(45) DEFAULT 'Closed',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_group`
--

/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
INSERT INTO `menu_group` (`Id`,`Title`,`Default`) VALUES 
 (8,'Settings','Closed'),
 (9,'Employee Settings','Closed'),
 (10,'Stock Settings','Closed'),
 (11,'Sales','Closed'),
 (12,'Reports','Closed');
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;


--
-- Definition of table `operators`
--

DROP TABLE IF EXISTS `operators`;
CREATE TABLE `operators` (
  `Num` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(145) DEFAULT NULL,
  `Pin` varchar(45) DEFAULT NULL,
  `Phone` int(10) unsigned DEFAULT NULL,
  `Address` varchar(145) DEFAULT NULL,
  `IdNo` varchar(45) DEFAULT NULL,
  `Counter` int(10) unsigned DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Username` varchar(45) DEFAULT NULL,
  `Ops` int(10) unsigned DEFAULT '2',
  PRIMARY KEY (`Num`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operators`
--

/*!40000 ALTER TABLE `operators` DISABLE KEYS */;
INSERT INTO `operators` (`Num`,`Name`,`Pin`,`Phone`,`Address`,`IdNo`,`Counter`,`Password`,`Username`,`Ops`) VALUES 
 (1,'Alex Mutuku Katumbi','A43545K',232323,'Thika','23456789',1,NULL,'lexy',2),
 (2,'John Tutuh Mungai','A435549',32342343,'Nairobi','3434343',2,'1234','tutuh',2),
 (3,'James Kiarie','Z234343P',234234443,'thika','32435435',3,NULL,'mash',2),
 (4,'Favikon','A4432434X',1234567,'thika','232434',3,'1234','favikons',1);
/*!40000 ALTER TABLE `operators` ENABLE KEYS */;


--
-- Definition of table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `Code` int(10) unsigned NOT NULL DEFAULT '0',
  `ItemName` varchar(145) DEFAULT NULL,
  `Category` int(11) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`Code`,`ItemName`,`Category`) VALUES 
 (123456,'Easy Black',6),
 (1000134,'Pembe Unga',4),
 (4567009,'Sprite 2Litres',5);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


--
-- Definition of table `returnin`
--

DROP TABLE IF EXISTS `returnin`;
CREATE TABLE `returnin` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT NULL,
  `Reason` varchar(145) DEFAULT NULL,
  `TranNo` int(10) unsigned DEFAULT NULL,
  `AuthorizedBy` int(10) unsigned DEFAULT NULL,
  `Pieces` int(10) unsigned DEFAULT NULL,
  `Conditions` varchar(45) DEFAULT NULL,
  `Sdate` date DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `AuthorizedBy` (`AuthorizedBy`),
  CONSTRAINT `product_name_ibfk_1` FOREIGN KEY (`AuthorizedBy`) REFERENCES `operators` (`Num`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnin`
--

/*!40000 ALTER TABLE `returnin` DISABLE KEYS */;
/*!40000 ALTER TABLE `returnin` ENABLE KEYS */;


--
-- Definition of table `returnout`
--

DROP TABLE IF EXISTS `returnout`;
CREATE TABLE `returnout` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT NULL,
  `Reason` varchar(145) DEFAULT NULL,
  `Sdate` date DEFAULT NULL,
  `AuthorizedBy` int(10) unsigned DEFAULT NULL,
  `Pieces` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `AuthorizedBy` (`AuthorizedBy`),
  CONSTRAINT `product_name_ibfk_2` FOREIGN KEY (`AuthorizedBy`) REFERENCES `operators` (`Num`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returnout`
--

/*!40000 ALTER TABLE `returnout` DISABLE KEYS */;
INSERT INTO `returnout` (`Id`,`Code`,`Reason`,`Sdate`,`AuthorizedBy`,`Pieces`) VALUES 
 (1,1000134,'Unsealed															','2022-09-07',NULL,2),
 (2,1000134,'Broken																','2022-09-07',NULL,1),
 (3,123456,'spoilt			','2022-09-09',NULL,2);
/*!40000 ALTER TABLE `returnout` ENABLE KEYS */;


--
-- Definition of table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TranNo` int(10) unsigned DEFAULT NULL,
  `Code` int(10) unsigned DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Quantity` int(10) unsigned DEFAULT NULL,
  `Tax` double DEFAULT NULL,
  `Sdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Counter` int(10) unsigned DEFAULT NULL,
  `Employee` int(10) unsigned DEFAULT NULL,
  `StockId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Employee` (`Employee`),
  KEY `StockId` (`StockId`),
  CONSTRAINT `product_name_ibfk_3` FOREIGN KEY (`Employee`) REFERENCES `operators` (`Num`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`StockId`) REFERENCES `stocks` (`StockId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`Id`,`TranNo`,`Code`,`Price`,`Quantity`,`Tax`,`Sdate`,`Counter`,`Employee`,`StockId`) VALUES 
 (18,1,123456,98,1,NULL,'2022-09-12 10:46:59',3,4,4),
 (19,1,1000134,90,1,NULL,'2022-09-12 10:47:00',3,4,3),
 (20,1,4567009,148,4,NULL,'2022-09-12 10:47:00',3,4,2),
 (21,2,123456,98,1,NULL,'2022-09-12 10:47:00',2,2,4),
 (22,2,1000134,90,1,NULL,'2022-09-12 10:47:00',2,2,3),
 (23,2,4567009,148,1,NULL,'2022-09-12 10:47:00',2,2,2);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;


--
-- Definition of table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `StockId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Code` int(10) unsigned DEFAULT '0',
  `Sdate` date DEFAULT NULL,
  `Bprice` double DEFAULT NULL,
  `Sprice` double DEFAULT NULL,
  `Quantity` int(10) unsigned DEFAULT NULL,
  `StockedBy` varchar(45) DEFAULT NULL,
  `Supplier` int(10) unsigned DEFAULT NULL,
  `Pieces` int(10) unsigned DEFAULT NULL,
  `Status` varchar(45) DEFAULT NULL,
  `Edate` date DEFAULT NULL,
  PRIMARY KEY (`StockId`),
  KEY `stocks_ibfk_1` (`Code`),
  CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`Code`) REFERENCES `products` (`Code`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`StockId`,`Code`,`Sdate`,`Bprice`,`Sprice`,`Quantity`,`StockedBy`,`Supplier`,`Pieces`,`Status`,`Edate`) VALUES 
 (2,4567009,'2022-09-07',600,900,10,NULL,1,6,'Current','2022-09-30'),
 (3,1000134,'2022-09-09',1000,1200,10,NULL,2,12,'Current','2022-09-30'),
 (4,123456,'2022-09-09',1000,1200,10,NULL,3,12,'Current','2022-09-30');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;


--
-- Definition of table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `Code` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(145) DEFAULT NULL,
  `Address` varchar(145) DEFAULT NULL,
  `Phone` varchar(145) DEFAULT NULL,
  `Representative` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`Code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` (`Code`,`Name`,`Address`,`Phone`,`Representative`) VALUES 
 (1,'Cocacola company','100 Thika','3332323','John'),
 (2,'Pembe Flour Mills','200 Thika','234343','Alex'),
 (3,'Unilever','thika','235545','john');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;


--
-- Definition of table `user_rights`
--

DROP TABLE IF EXISTS `user_rights`;
CREATE TABLE `user_rights` (
  `User` int(10) unsigned NOT NULL DEFAULT '0',
  `GNames` varchar(145) DEFAULT NULL,
  `GItems` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rights`
--

/*!40000 ALTER TABLE `user_rights` DISABLE KEYS */;
INSERT INTO `user_rights` (`User`,`GNames`,`GItems`) VALUES 
 (1,'8,9,10,11,12,12','11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28'),
 (2,'11,12','24,27,28');
/*!40000 ALTER TABLE `user_rights` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
