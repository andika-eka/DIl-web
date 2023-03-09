/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - dil_backup
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `detailtesformatif` */

DROP TABLE IF EXISTS `detailtesformatif`;

CREATE TABLE `detailtesformatif` (
  `id_detailTesFormatif` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tesFormatif` bigint(20) unsigned NOT NULL,
  `nomorUrut_soal` tinyint(3) unsigned NOT NULL,
  `id_pilihanJawaban` bigint(20) unsigned NOT NULL,
  `alasanJawaban` text NOT NULL,
  PRIMARY KEY (`id_detailTesFormatif`),
  UNIQUE KEY `id_detailTesFormatif` (`id_detailTesFormatif`),
  UNIQUE KEY `index_nomorUrutSoal` (`id_tesFormatif`,`nomorUrut_soal`),
  UNIQUE KEY `index_pilSiswa` (`id_pilihanJawaban`),
  CONSTRAINT `detailtesformatif_ibfk_1` FOREIGN KEY (`id_tesFormatif`) REFERENCES `tesformatif` (`id_tesFormatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detailtesformatif_ibfk_2` FOREIGN KEY (`id_pilihanJawaban`) REFERENCES `pilihanjawaban` (`id_pilihanJawaban`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detailtesformatif` */

/*Table structure for table `indikator` */

DROP TABLE IF EXISTS `indikator`;

CREATE TABLE `indikator` (
  `id_indikator` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_subCpmk` bigint(20) unsigned NOT NULL,
  `nomorUrut_indikator` tinyint(4) unsigned NOT NULL,
  `narasi_indikator` text NOT NULL,
  `pertemuanKe` tinyint(3) unsigned NOT NULL,
  `level_indikator` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_indikator`),
  UNIQUE KEY `id_indikator` (`id_indikator`),
  UNIQUE KEY `nomorUrutIndikator` (`id_subCpmk`,`nomorUrut_indikator`),
  CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`id_subCpmk`) REFERENCES `subcpmk` (`id_subCpmk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `indikator` */

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_matakuliah` bigint(20) unsigned NOT NULL,
  `tahun_kelas` year(4) NOT NULL,
  `semester_kelas` tinyint(3) unsigned NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `tanggalBuat_kelas` date NOT NULL,
  `tanggalMulai_kelas` date NOT NULL,
  `tanggalSelesai_kelas` date NOT NULL,
  `status_kelas` tinyint(3) unsigned NOT NULL,
  `jenis_kelas` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_kelas`),
  UNIQUE KEY `id_kelas` (`id_kelas`),
  UNIQUE KEY `index_kelas_unik` (`id_matakuliah`,`tahun_kelas`,`semester_kelas`,`nama_kelas`),
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

/*Table structure for table `matakuliah` */

DROP TABLE IF EXISTS `matakuliah`;

CREATE TABLE `matakuliah` (
  `id_matakuliah` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_mataKuliah` char(15) NOT NULL,
  `nama_mataKuliah` varchar(50) NOT NULL,
  `cpmk` text NOT NULL,
  PRIMARY KEY (`id_matakuliah`),
  UNIQUE KEY `id_matakuliah` (`id_matakuliah`),
  UNIQUE KEY `index_kodeMataKuliah` (`kode_mataKuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matakuliah` */

/*Table structure for table `materi` */

DROP TABLE IF EXISTS `materi`;

CREATE TABLE `materi` (
  `id_materi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_indikator` bigint(20) unsigned NOT NULL,
  `nomorUrut_materi` tinyint(3) unsigned NOT NULL,
  `nama_materi` varchar(50) NOT NULL,
  `pathFile_materi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_materi`),
  UNIQUE KEY `id_materi` (`id_materi`),
  UNIQUE KEY `index_nomorUrutMateri` (`id_indikator`,`nomorUrut_materi`),
  KEY `id_indikator` (`id_indikator`) USING BTREE,
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `materi` */

/*Table structure for table `pengajar` */

DROP TABLE IF EXISTS `pengajar`;

CREATE TABLE `pengajar` (
  `id_pengajar` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identitas_pengajar` varchar(20) DEFAULT NULL,
  `email_pengajar` varchar(50) DEFAULT NULL,
  `nama_pengajar` varchar(50) DEFAULT NULL,
  `jenisKelamin_Pengajar` tinyint(1) DEFAULT NULL,
  `tanggalLahir_Pengajar` date DEFAULT NULL,
  `pathFileFoto_Pengajar` varchar(100) DEFAULT NULL,
  `account_active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_pengajar`),
  UNIQUE KEY `id_pengajar` (`id_pengajar`),
  UNIQUE KEY `index_identitasPengajar` (`identitas_pengajar`),
  UNIQUE KEY `index_email_pengajar` (`email_pengajar`),
  UNIQUE KEY `index_pathFileFotoPengajar` (`pathFileFoto_Pengajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengajar` */

/*Table structure for table `pengambilankelas` */

DROP TABLE IF EXISTS `pengambilankelas`;

CREATE TABLE `pengambilankelas` (
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) unsigned NOT NULL,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `status_pengambilanKelas` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_pengambilanKelas`),
  UNIQUE KEY `id_pengambilanKelas` (`id_pengambilanKelas`),
  UNIQUE KEY `index_pengambilanSiswaKelas` (`id_siswa`,`id_kelas`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `pengambilankelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengambilankelas_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengambilankelas` */

/*Table structure for table `pengampuan` */

DROP TABLE IF EXISTS `pengampuan`;

CREATE TABLE `pengampuan` (
  `id_pengampuan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `id_pengajar` bigint(20) unsigned NOT NULL,
  `status_pengampuan` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_pengampuan`),
  UNIQUE KEY `id_pengampuan` (`id_pengampuan`),
  UNIQUE KEY `index_kelas_engajar` (`id_kelas`,`id_pengajar`),
  KEY `id_pengajar` (`id_pengajar`),
  CONSTRAINT `pengampuan_ibfk_1` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengampuan_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengampuan` */

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `email_pengguna` varchar(50) NOT NULL,
  `pass_pengguna` varchar(512) NOT NULL,
  `tipe_pengguna` tinyint(3) unsigned NOT NULL,
  `status_pengguna` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`email_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengguna` */

/*Table structure for table `pilihanjawaban` */

DROP TABLE IF EXISTS `pilihanjawaban`;

CREATE TABLE `pilihanjawaban` (
  `id_pilihanJawaban` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_soalPilihanGanda` bigint(20) unsigned NOT NULL,
  `noUrut_pilihan` tinyint(3) unsigned NOT NULL,
  `teks_pilihan` text NOT NULL,
  `status_pilihan` tinyint(1) NOT NULL,
  `pathFileGambar_pilihan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pilihanJawaban`),
  UNIQUE KEY `id_pilihanJawaban` (`id_pilihanJawaban`),
  UNIQUE KEY `index_nomorUrutPilihan` (`id_soalPilihanGanda`,`noUrut_pilihan`),
  CONSTRAINT `pilihanjawaban_ibfk_1` FOREIGN KEY (`id_soalPilihanGanda`) REFERENCES `soalpilihanganda` (`id_soalPilihanGanda`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pilihanjawaban` */

/*Table structure for table `pretes` */

DROP TABLE IF EXISTS `pretes`;

CREATE TABLE `pretes` (
  `id_pretes` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL,
  `waktuMulai_pretes` datetime DEFAULT NULL,
  `waktuSelesai_pretes` datetime DEFAULT NULL,
  `nilai_pretes` float DEFAULT NULL,
  PRIMARY KEY (`id_pretes`),
  UNIQUE KEY `id_pretes` (`id_pretes`),
  KEY `index_pretes` (`id_pengambilanKelas`),
  CONSTRAINT `pretes_ibfk_1` FOREIGN KEY (`id_pengambilanKelas`) REFERENCES `pengambilankelas` (`id_pengambilanKelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pretes` */

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identitas_siswa` varchar(15) DEFAULT NULL,
  `email_siswa` varchar(50) DEFAULT NULL,
  `nama_siswa` varchar(50) DEFAULT NULL,
  `jenisKelamin_siswa` tinyint(1) DEFAULT NULL,
  `tanggalLahir_siswa` date DEFAULT NULL,
  `pathFileFoto_siswa` varchar(100) DEFAULT NULL,
  `account_active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `id_siswa` (`id_siswa`),
  UNIQUE KEY `index_email_siswa` (`email_siswa`),
  UNIQUE KEY `index_identitas_Siswa` (`identitas_siswa`) USING BTREE,
  UNIQUE KEY `index_fileFotoSiswa` (`pathFileFoto_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

/*Table structure for table `soalpilihanganda` */

DROP TABLE IF EXISTS `soalpilihanganda`;

CREATE TABLE `soalpilihanganda` (
  `id_soalPilihanGanda` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_indikator` bigint(20) unsigned NOT NULL,
  `soal` text NOT NULL,
  `pathFileGambar_soal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_soalPilihanGanda`),
  UNIQUE KEY `id_soalPilihanGanda` (`id_soalPilihanGanda`),
  KEY `id_indikator` (`id_indikator`),
  CONSTRAINT `soalpilihanganda_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `soalpilihanganda` */

/*Table structure for table `subcpmk` */

DROP TABLE IF EXISTS `subcpmk`;

CREATE TABLE `subcpmk` (
  `id_subCpmk` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_mataKuliah` bigint(20) unsigned NOT NULL,
  `nomorUrut_subCpmk` tinyint(3) unsigned NOT NULL,
  `taksnomi_bloom` tinyint(3) unsigned NOT NULL,
  `narasi_subCpmk` text NOT NULL,
  `pathFile_materiTeks` varchar(50) NOT NULL,
  PRIMARY KEY (`id_subCpmk`),
  UNIQUE KEY `id_subCpmk` (`id_subCpmk`),
  UNIQUE KEY `nomorUrutSubCpmk` (`id_mataKuliah`,`nomorUrut_subCpmk`),
  CONSTRAINT `subcpmk_ibfk_1` FOREIGN KEY (`id_mataKuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `subcpmk` */

/*Table structure for table `subcpmkpengambilan` */

DROP TABLE IF EXISTS `subcpmkpengambilan`;

CREATE TABLE `subcpmkpengambilan` (
  `id_subcpmkpengambilan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL,
  `id_subCPMK` bigint(20) unsigned NOT NULL,
  `waktuMulai_Pengambilan` datetime DEFAULT NULL,
  `waktuSelesai_Pengambilan` datetime DEFAULT NULL,
  `status_subcpmkpengambilan` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_subcpmkpengambilan`),
  UNIQUE KEY `id_subcpmkpengambilan` (`id_subcpmkpengambilan`),
  UNIQUE KEY `index_pengambilan_CPMK` (`id_pengambilanKelas`,`id_subCPMK`),
  KEY `id_subCPMK` (`id_subCPMK`),
  CONSTRAINT `subcpmkpengambilan_ibfk_1` FOREIGN KEY (`id_pengambilanKelas`) REFERENCES `pengambilankelas` (`id_pengambilanKelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subcpmkpengambilan_ibfk_2` FOREIGN KEY (`id_subCPMK`) REFERENCES `subcpmk` (`id_subCpmk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Status:';

/*Data for the table `subcpmkpengambilan` */

/*Table structure for table `sumatif` */

DROP TABLE IF EXISTS `sumatif`;

CREATE TABLE `sumatif` (
  `id_sumatif` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL,
  `waktuMulai_sumatif` datetime DEFAULT NULL,
  `waktuSelesai_sumatif` datetime DEFAULT NULL,
  `nilai_sumatif` float DEFAULT NULL,
  PRIMARY KEY (`id_sumatif`),
  UNIQUE KEY `id_sumatif` (`id_sumatif`),
  KEY `index_sumatif` (`id_pengambilanKelas`),
  CONSTRAINT `sumatif_ibfk_1` FOREIGN KEY (`id_pengambilanKelas`) REFERENCES `pengambilankelas` (`id_pengambilanKelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sumatif` */

/*Table structure for table `tesformatif` */

DROP TABLE IF EXISTS `tesformatif`;

CREATE TABLE `tesformatif` (
  `id_tesFormatif` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_subCpmkPengambilan` bigint(20) unsigned NOT NULL,
  `pengulangan_tesFormatif` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `waktuMulai_TesFormatif` datetime DEFAULT NULL,
  `waktuSelesai_tesFormatif` datetime DEFAULT NULL,
  `nilai_tesFormatif` float DEFAULT NULL,
  `status_TesFormatif` tinyint(3) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_tesFormatif`),
  UNIQUE KEY `id_tesFormatif` (`id_tesFormatif`),
  UNIQUE KEY `index_pengulanganTesFormatif` (`id_subCpmkPengambilan`,`pengulangan_tesFormatif`),
  CONSTRAINT `tesformatif_ibfk_1` FOREIGN KEY (`id_subCpmkPengambilan`) REFERENCES `subcpmkpengambilan` (`id_subcpmkpengambilan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tesformatif` */

/*Table structure for table `variabelsistem` */

DROP TABLE IF EXISTS `variabelsistem`;

CREATE TABLE `variabelsistem` (
  `nama_variabelSistem` varchar(32) NOT NULL,
  `nilaiInteger` bigint(20) DEFAULT NULL,
  `nilaiFloat` double DEFAULT NULL,
  `nilaiTeks` varchar(256) DEFAULT NULL,
  `nilaiWaktu` datetime DEFAULT NULL,
  PRIMARY KEY (`nama_variabelSistem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `variabelsistem` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
