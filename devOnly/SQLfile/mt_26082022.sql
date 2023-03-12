-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_sistem_dil
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detailtesformatif`
--

DROP TABLE IF EXISTS `detailtesformatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detailtesformatif` (
  `id_detailtesformatif` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tesFormatif` bigint(20) unsigned NOT NULL,
  `nomorUrut_soal` tinyint(3) unsigned NOT NULL,
  `id_pilihanJawaban` bigint(20) unsigned NOT NULL,
  `alasanJawaban` text NOT NULL,
  PRIMARY KEY (`id_detailtesformatif`),
  UNIQUE KEY `id_detailtesformatif` (`id_detailtesformatif`),
  UNIQUE KEY `index_nomorUrutSoal` (`id_tesFormatif`,`nomorUrut_soal`),
  UNIQUE KEY `index_pilSiswa` (`id_pilihanJawaban`),
  CONSTRAINT `detailtesformatif_ibfk_1` FOREIGN KEY (`id_tesFormatif`) REFERENCES `tesformatif` (`id_tesFormatif`) ON UPDATE CASCADE,
  CONSTRAINT `detailtesformatif_ibfk_2` FOREIGN KEY (`id_pilihanJawaban`) REFERENCES `pilihanjawaban` (`id_pilihanJawaban`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailtesformatif`
--

LOCK TABLES `detailtesformatif` WRITE;
/*!40000 ALTER TABLE `detailtesformatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `detailtesformatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indikator`
--

DROP TABLE IF EXISTS `indikator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indikator`
--

LOCK TABLES `indikator` WRITE;
/*!40000 ALTER TABLE `indikator` DISABLE KEYS */;
/*!40000 ALTER TABLE `indikator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_matakuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matakuliah`
--

DROP TABLE IF EXISTS `matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matakuliah` (
  `id_matakuliah` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_mataKuliah` char(15) NOT NULL,
  `nama_mataKuliah` varchar(50) NOT NULL,
  `cpmk` text NOT NULL,
  PRIMARY KEY (`id_matakuliah`),
  UNIQUE KEY `id_matakuliah` (`id_matakuliah`),
  UNIQUE KEY `index_kodeMataKuliah` (`kode_mataKuliah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matakuliah`
--

LOCK TABLES `matakuliah` WRITE;
/*!40000 ALTER TABLE `matakuliah` DISABLE KEYS */;
/*!40000 ALTER TABLE `matakuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materi`
--

DROP TABLE IF EXISTS `materi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
  CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materi`
--

LOCK TABLES `materi` WRITE;
/*!40000 ALTER TABLE `materi` DISABLE KEYS */;
/*!40000 ALTER TABLE `materi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengajar`
--

DROP TABLE IF EXISTS `pengajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengajar` (
  `id_pengajar` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identitas_pengajar` varchar(20) NOT NULL,
  `email_pengajar` varchar(50) NOT NULL,
  `nama_pengajar` varchar(50) NOT NULL,
  `jenisKelamin_Pengajar` tinyint(1) NOT NULL,
  `tanggalLahir_Pengajar` date DEFAULT NULL,
  `pathFileFoto_Pengajar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pengajar`),
  UNIQUE KEY `id_pengajar` (`id_pengajar`),
  UNIQUE KEY `index_identitasPengajar` (`identitas_pengajar`),
  UNIQUE KEY `index_email_pengajar` (`email_pengajar`),
  UNIQUE KEY `index_pathFileFotoPengajar` (`pathFileFoto_Pengajar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengajar`
--

LOCK TABLES `pengajar` WRITE;
/*!40000 ALTER TABLE `pengajar` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengajar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengambilankelas`
--

DROP TABLE IF EXISTS `pengambilankelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengambilankelas` (
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) unsigned NOT NULL,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `status_pengambilanKelas` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_pengambilanKelas`),
  UNIQUE KEY `id_pengambilanKelas` (`id_pengambilanKelas`),
  UNIQUE KEY `index_pengambilanSiswaKelas` (`id_siswa`,`id_kelas`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `pengambilankelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  CONSTRAINT `pengambilankelas_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengambilankelas`
--

LOCK TABLES `pengambilankelas` WRITE;
/*!40000 ALTER TABLE `pengambilankelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengambilankelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengampuan`
--

DROP TABLE IF EXISTS `pengampuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengampuan` (
  `id_pengampuan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `id_pengajar` bigint(20) unsigned NOT NULL,
  `status_pengampuan` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_pengampuan`),
  UNIQUE KEY `id_pengampuan` (`id_pengampuan`),
  UNIQUE KEY `index_kelas_engajar` (`id_kelas`,`id_pengajar`),
  KEY `id_pengajar` (`id_pengajar`),
  CONSTRAINT `pengampuan_ibfk_1` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`) ON UPDATE CASCADE,
  CONSTRAINT `pengampuan_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengampuan`
--

LOCK TABLES `pengampuan` WRITE;
/*!40000 ALTER TABLE `pengampuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengampuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengguna` (
  `email_pengguna` varchar(50) NOT NULL,
  `pass_pengguna` varchar(512) NOT NULL,
  `tipe_pengguna` tinyint(3) unsigned NOT NULL,
  `status_pengguna` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`email_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pilihanjawaban`
--

DROP TABLE IF EXISTS `pilihanjawaban`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pilihanjawaban`
--

LOCK TABLES `pilihanjawaban` WRITE;
/*!40000 ALTER TABLE `pilihanjawaban` DISABLE KEYS */;
/*!40000 ALTER TABLE `pilihanjawaban` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pretes`
--

DROP TABLE IF EXISTS `pretes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pretes` (
  `id_pretes` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL,
  `waktuMulai_pretes` datetime DEFAULT NULL,
  `waktuSelesai_pretes` datetime DEFAULT NULL,
  `nilai_pretes` float DEFAULT NULL,
  PRIMARY KEY (`id_pretes`),
  UNIQUE KEY `id_pretes` (`id_pretes`),
  KEY `index_pretes` (`id_pengambilanKelas`),
  CONSTRAINT `pretes_ibfk_1` FOREIGN KEY (`id_pengambilanKelas`) REFERENCES `pengambilankelas` (`id_pengambilanKelas`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pretes`
--

LOCK TABLES `pretes` WRITE;
/*!40000 ALTER TABLE `pretes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pretes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswa`
--

DROP TABLE IF EXISTS `siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `siswa` (
  `id_siswa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identitas_siswa` varchar(15) NOT NULL,
  `email_siswa` varchar(50) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jenisKelamin_siswa` tinyint(1) NOT NULL,
  `tanggalLahir_siswa` date NOT NULL,
  `pathFileFoto_siswa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `id_siswa` (`id_siswa`),
  UNIQUE KEY `index_email_siswa` (`email_siswa`),
  UNIQUE KEY `index_identitas_Siswa` (`identitas_siswa`) USING BTREE,
  UNIQUE KEY `index_fileFotoSiswa` (`pathFileFoto_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswa`
--

LOCK TABLES `siswa` WRITE;
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soalpilihanganda`
--

DROP TABLE IF EXISTS `soalpilihanganda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soalpilihanganda` (
  `id_soalPilihanGanda` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_indikator` bigint(20) unsigned NOT NULL,
  `soal` text NOT NULL,
  `pathFileGambar_soal` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_soalPilihanGanda`),
  UNIQUE KEY `id_soalPilihanGanda` (`id_soalPilihanGanda`),
  KEY `id_indikator` (`id_indikator`),
  CONSTRAINT `soalpilihanganda_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soalpilihanganda`
--

LOCK TABLES `soalpilihanganda` WRITE;
/*!40000 ALTER TABLE `soalpilihanganda` DISABLE KEYS */;
/*!40000 ALTER TABLE `soalpilihanganda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcpmk`
--

DROP TABLE IF EXISTS `subcpmk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcpmk` (
  `id_subCpmk` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_mataKuliah` bigint(20) unsigned NOT NULL,
  `nomorUrut_subCpmk` tinyint(3) unsigned NOT NULL,
  `narasi_subCpmk` text NOT NULL,
  `pathFile_materiTeks` varchar(50) NOT NULL,
  PRIMARY KEY (`id_subCpmk`),
  UNIQUE KEY `id_subCpmk` (`id_subCpmk`),
  UNIQUE KEY `nomorUrutSubCpmk` (`id_mataKuliah`,`nomorUrut_subCpmk`),
  CONSTRAINT `subcpmk_ibfk_1` FOREIGN KEY (`id_mataKuliah`) REFERENCES `matakuliah` (`id_matakuliah`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcpmk`
--

LOCK TABLES `subcpmk` WRITE;
/*!40000 ALTER TABLE `subcpmk` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcpmk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcpmkpengambilan`
--

DROP TABLE IF EXISTS `subcpmkpengambilan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcpmkpengambilan`
--

LOCK TABLES `subcpmkpengambilan` WRITE;
/*!40000 ALTER TABLE `subcpmkpengambilan` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcpmkpengambilan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sumatif`
--

DROP TABLE IF EXISTS `sumatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sumatif` (
  `id_sumatif` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pengambilanKelas` bigint(20) unsigned NOT NULL,
  `waktuMulai_sumatif` datetime DEFAULT NULL,
  `waktuSelesai_sumatif` datetime DEFAULT NULL,
  `nilai_sumatif` float DEFAULT NULL,
  PRIMARY KEY (`id_sumatif`),
  UNIQUE KEY `id_sumatif` (`id_sumatif`),
  KEY `index_sumatif` (`id_pengambilanKelas`),
  CONSTRAINT `sumatif_ibfk_1` FOREIGN KEY (`id_pengambilanKelas`) REFERENCES `pengambilankelas` (`id_pengambilanKelas`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sumatif`
--

LOCK TABLES `sumatif` WRITE;
/*!40000 ALTER TABLE `sumatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `sumatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tesformatif`
--

DROP TABLE IF EXISTS `tesformatif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tesformatif`
--

LOCK TABLES `tesformatif` WRITE;
/*!40000 ALTER TABLE `tesformatif` DISABLE KEYS */;
/*!40000 ALTER TABLE `tesformatif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variabelsistem`
--

DROP TABLE IF EXISTS `variabelsistem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variabelsistem` (
  `nama_variabelSistem` varchar(32) NOT NULL,
  `nilaiInteger` bigint(20) DEFAULT NULL,
  `nilaiFloat` double DEFAULT NULL,
  `nilaiTeks` varchar(256) DEFAULT NULL,
  `nilaiWaktu` datetime DEFAULT NULL,
  PRIMARY KEY (`nama_variabelSistem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variabelsistem`
--

LOCK TABLES `variabelsistem` WRITE;
/*!40000 ALTER TABLE `variabelsistem` DISABLE KEYS */;
/*!40000 ALTER TABLE `variabelsistem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-26 16:50:39
