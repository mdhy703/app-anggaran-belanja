/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 5.7.11 : Database - anggaran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`anggaran` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `anggaran`;

/*Table structure for table `anggaran` */

DROP TABLE IF EXISTS `anggaran`;

CREATE TABLE `anggaran` (
  `id_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `judul_anggaran` varchar(255) DEFAULT NULL,
  `nominal` float DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `jenis` enum('H','B') DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id_anggaran`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `anggaran` */

insert  into `anggaran`(`id_anggaran`,`judul_anggaran`,`nominal`,`tanggal`,`tgl_selesai`,`jenis`,`status`,`ket`) values (1,'Belanja Kebutuhan Makanan Februari 2018',150000000,'2018-04-25','2018-02-28',NULL,'Terlaksana','Sudah terlaksana'),(3,'Biaya Konsumsi Bulan Maret 2018',200000000,'2018-02-28','2018-03-31',NULL,'Tunggu','no'),(4,'Kebutuhan Konsumsi Januari 2018',100000000,'2018-01-01','2018-05-31',NULL,'Tunggu','');

/*Table structure for table `detail_realisasi` */

DROP TABLE IF EXISTS `detail_realisasi`;

CREATE TABLE `detail_realisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_realisasi` int(11) DEFAULT NULL,
  `id_suplayer` varchar(10) DEFAULT NULL,
  `nama_pembelian` varchar(255) DEFAULT NULL,
  `harga` float DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `detail_realisasi` */

insert  into `detail_realisasi`(`id`,`id_realisasi`,`id_suplayer`,`nama_pembelian`,`harga`,`jumlah`,`subtotal`) values (1,1,'Sup01','asasf',19000,10,190000),(2,1,'mkmksm','dasd',25000,8,200000),(3,2,'Sup01','Buah-buahan',15000,20,300000),(4,2,'Sup01','Beras',200000,10,2000000),(10,4,'Sup01','Mie Indomie (DUS)',75000,40,3000000),(9,4,'Sup01','Beras',220000,20,4400000),(7,1,'SUP012','Tahu Tempe',12000,150,1800000),(11,4,'Sup01','Gula',12000,100,1200000);

/*Table structure for table `donasi` */

DROP TABLE IF EXISTS `donasi`;

CREATE TABLE `donasi` (
  `id_donasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_donatur` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nominal` float DEFAULT NULL,
  PRIMARY KEY (`id_donasi`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `donasi` */

insert  into `donasi`(`id_donasi`,`id_donatur`,`tanggal`,`nominal`) values (1,1,'2018-02-01',12000000),(3,1,'2018-01-01',10000000),(4,2,'2018-01-01',5000000),(5,2,'2018-02-02',9000000),(6,1,'2018-03-02',11000000),(7,2,'2018-03-03',12000000);

/*Table structure for table `donatur` */

DROP TABLE IF EXISTS `donatur`;

CREATE TABLE `donatur` (
  `id_donatur` int(11) NOT NULL AUTO_INCREMENT,
  `nama_donatur` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_donatur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `donatur` */

insert  into `donatur`(`id_donatur`,`nama_donatur`,`alamat`,`no_hp`) values (1,'Pt. Wira Karya Sakti','Tungkal','0742-000111'),(2,'PT. PERTAMINA','Kenali Bawah','0741-111100');

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` varchar(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id_petugas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `petugas` */

insert  into `petugas`(`id_petugas`,`nama`,`jk`,`no_hp`,`ket`) values ('P1209','AMir','L','074123344','Bekerja'),('P03','Hamzah ','L','085344556677','Cek');

/*Table structure for table `realisasi` */

DROP TABLE IF EXISTS `realisasi`;

CREATE TABLE `realisasi` (
  `id_realisasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggaran` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_petugas` varchar(10) DEFAULT NULL,
  `nominal` float DEFAULT NULL,
  PRIMARY KEY (`id_realisasi`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `realisasi` */

insert  into `realisasi`(`id_realisasi`,`id_anggaran`,`tanggal`,`id_petugas`,`nominal`) values (1,1,'2018-05-03','P03',2190000),(2,1,'2018-02-01','P03',2300000),(4,4,'2018-01-01','P03',8600000);

/*Table structure for table `suplayer` */

DROP TABLE IF EXISTS `suplayer`;

CREATE TABLE `suplayer` (
  `id_suplayer` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(20) DEFAULT NULL,
  `ket` text,
  PRIMARY KEY (`id_suplayer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `suplayer` */

insert  into `suplayer`(`id_suplayer`,`nama`,`alamat`,`no_hp`,`ket`) values ('Sup01','Supliayer 1','Jl. Lingkar Barat - Palmerah','0741-111100','null'),('mkmksm','Albert Shop ID','Jl. Jaya raya','0741-999999','reseller'),('SUP012','Toko Maju Jaya','Jl. HMO Bafadhal','0741-223344','Suplayer Beras');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(99) DEFAULT NULL,
  `password` varchar(99) DEFAULT NULL,
  `level` char(5) DEFAULT NULL,
  `loggin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id_user`,`username`,`password`,`level`,`loggin`) values (2,'admin','admin','0',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
