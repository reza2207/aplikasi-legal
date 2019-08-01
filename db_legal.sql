-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2019 at 03:59 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_legal`
--

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `vendor_id` varchar(14) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `telp_1` varchar(50) NOT NULL,
  `telp_2` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bidang_usaha` varchar(50) NOT NULL,
  `npwp` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `unit` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pks`
--

CREATE TABLE `pks` (
  `ppks_id` varchar(12) NOT NULL,
  `vendor_id` varchar(12) NOT NULL,
  `no_pks` varchar(50) NOT NULL,
  `tgl_pks` date NOT NULL,
  `jenis_kerjasama` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `nilai_kerjasama` varchar(15) NOT NULL,
  `unit` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tdr`
--

CREATE TABLE `tdr` (
  `tdr_id` varchar(15) NOT NULL,
  `vendor_id` varchar(15) NOT NULL,
  `no_tdr` varchar(15) NOT NULL,
  `tgl_tdr` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE `tes` (
  `idtes` int(3) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('admin','user','superuser') NOT NULL,
  `recovery_q` varchar(200) NOT NULL,
  `answer_rec` varchar(200) NOT NULL,
  `profil_pict` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `bidang_usaha` (`bidang_usaha`);

--
-- Indexes for table `pks`
--
ALTER TABLE `pks`
  ADD PRIMARY KEY (`ppks_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `tdr`
--
ALTER TABLE `tdr`
  ADD PRIMARY KEY (`tdr_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `tes`
--
ALTER TABLE `tes`
  ADD PRIMARY KEY (`idtes`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tes`
--
ALTER TABLE `tes`
  MODIFY `idtes` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
