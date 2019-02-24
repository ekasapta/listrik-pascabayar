-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 11:49 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listrikpascabayar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `KodeLogin` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`KodeLogin`, `Username`, `Password`, `NamaLengkap`, `Level`) VALUES
(1, 'PLG100000000', 'PLG100000000', 'Kadek Eka Sapta Wijaya', 'Pelanggan'),
(3, 'admin', 'admin', 'Eka Sapta', 'Admin'),
(6, 'petugas', 'petugas', 'Petugas 1', 'Petugas'),
(7, 'PLG100000001', 'PLG100000001', 'Eka Sapta', 'Pelanggan'),
(9, 'PLG100000002', 'PLG100000002', 'John Doe', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `KodePelanggan` int(11) NOT NULL,
  `NoPelanggan` varchar(100) NOT NULL,
  `NoMeter` varchar(100) NOT NULL,
  `KodeTarif` int(11) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Telp` varchar(16) NOT NULL,
  `Alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`KodePelanggan`, `NoPelanggan`, `NoMeter`, `KodeTarif`, `NamaLengkap`, `Telp`, `Alamat`) VALUES
(1, 'PLG100000000', '081231239', 1, 'Kadek Eka Sapta Wijaya', '081239221327', 'Jln. Nangka Selatan No.126'),
(3, 'PLG100000001', '123982312', 5, 'Eka Sapta', '08123213123', 'Jln. Nangka Selatan'),
(5, 'PLG100000002', '293102930', 1, 'John Doe', '081239221327', 'Jln. Nangka Selatan No.126\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `KodePembayaran` int(11) NOT NULL,
  `KodeTagihan` int(11) NOT NULL,
  `TglBayar` date NOT NULL,
  `JumlahTagihan` double(10,0) NOT NULL,
  `BuktiPembayaran` varchar(255) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`KodePembayaran`, `KodeTagihan`, `TglBayar`, `JumlahTagihan`, `BuktiPembayaran`, `Status`) VALUES
(5, 5, '2019-02-12', 2010, 'TGH100000001_69BGJ3YV_1549995078.jpg', '2'),
(6, 7, '2019-02-07', 112010, 'TGH100000003_NKM8ILJV_1549995156.jpg', '2'),
(9, 9, '2019-02-12', 40120, 'TGH100000004_QCX490YH_1550006714.jpg', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `KodeTagihan` int(11) NOT NULL,
  `NoTagihan` varchar(100) NOT NULL,
  `NoPelanggan` varchar(100) NOT NULL,
  `TahunTagih` int(20) NOT NULL,
  `BulanTagih` varchar(20) NOT NULL,
  `JumlahPemakaian` varchar(100) NOT NULL,
  `TotalBayar` double(10,0) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`KodeTagihan`, `NoTagihan`, `NoPelanggan`, `TahunTagih`, `BulanTagih`, `JumlahPemakaian`, `TotalBayar`, `Status`) VALUES
(5, 'TGH100000001', 'PLG100000000', 2019, '2', '20', 250021, '2'),
(7, 'TGH100000003', 'PLG100000001', 2019, '1', '120', 24120, '2'),
(9, 'TGH100000004', 'PLG100000001', 2019, '2', '200', 40120, '2'),
(17, 'TGH100000005', 'PLG100000002', 2019, '1', '20', 250021, '0'),
(18, 'TGH100000006', 'PLG100000002', 2019, '2', '30', 350031, '0'),
(21, 'TGH100000007', 'PLG100000002', 2019, '3', '23', 280024, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `KodeTarif` int(11) NOT NULL,
  `Daya` varchar(50) NOT NULL,
  `TarifPerKwh` double(10,0) NOT NULL,
  `Beban` double(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`KodeTarif`, `Daya`, `TarifPerKwh`, `Beban`) VALUES
(1, '20011', 10001, 50001),
(5, '100', 200, 120);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`KodeLogin`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`KodePelanggan`),
  ADD KEY `NoPelanggan` (`NoPelanggan`),
  ADD KEY `KodeTarif` (`KodeTarif`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`KodePembayaran`),
  ADD KEY `KodeTagihan` (`KodeTagihan`);

--
-- Indexes for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`KodeTagihan`),
  ADD KEY `NoPelanggan` (`NoPelanggan`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`KodeTarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `KodeLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `KodePelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `KodePembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `KodeTagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `KodeTarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD CONSTRAINT `tb_pelanggan_ibfk_1` FOREIGN KEY (`NoPelanggan`) REFERENCES `tb_login` (`Username`),
  ADD CONSTRAINT `tb_pelanggan_ibfk_2` FOREIGN KEY (`KodeTarif`) REFERENCES `tb_tarif` (`KodeTarif`);

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`KodeTagihan`) REFERENCES `tb_tagihan` (`KodeTagihan`);

--
-- Constraints for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD CONSTRAINT `tb_tagihan_ibfk_1` FOREIGN KEY (`NoPelanggan`) REFERENCES `tb_pelanggan` (`NoPelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
