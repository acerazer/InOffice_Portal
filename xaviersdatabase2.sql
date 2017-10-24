-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2017 at 06:07 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xaviersdatabase2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bonafide_tbl`
--

CREATE TABLE `bonafide_tbl` (
  `GR_NO` varchar(100) NOT NULL,
  `REASON` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lc_tbl`
--

CREATE TABLE `lc_tbl` (
  `LC_NO` int(11) NOT NULL,
  `LAST_SCHL_STD` varchar(200) NOT NULL,
  `CONDUCT` varchar(200) NOT NULL,
  `LV_DT` date NOT NULL,
  `PROGRESS` varchar(200) NOT NULL,
  `CURR_STD_WHEN` varchar(200) NOT NULL,
  `LV_RSN` varchar(200) NOT NULL,
  `REMARKS` varchar(200) NOT NULL,
  `LC_DT` date NOT NULL,
  `MONTH` varchar(50) NOT NULL,
  `YEAR` varchar(50) NOT NULL,
  `GR_NO` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lc_tbl`
--

INSERT INTO `lc_tbl` (`LC_NO`, `LAST_SCHL_STD`, `CONDUCT`, `LV_DT`, `PROGRESS`, `CURR_STD_WHEN`, `LV_RSN`, `REMARKS`, `LC_DT`, `MONTH`, `YEAR`, `GR_NO`) VALUES
(1, 'ST. PETER\'S SCHOOL', 'GOOD', '2017-05-03', 'GOOD', 'STD-8 (EIGHTH) SINCE JUNE 2016', 'CHANGE OF RESIDENCE', 'CHANGE OF RESIDENCE', '2017-05-05', 'undefined', 'undefined', '1234'),
(2, 'CHRIST CHURCH', 'EXCELLENT', '2017-06-01', 'GOOD', 'STD-10 (TENTH) SINCE JUNE 2016', 'PASSED SSC EXAM', 'PASSED SSC EXAM', '2017-05-06', 'undefined', 'undefined', '4567');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `GR_NO` varchar(100) NOT NULL,
  `ADM_DT` date NOT NULL,
  `ADM_CLS` int(2) NOT NULL,
  `UDISE_NO` varchar(100) NOT NULL,
  `OTH_UDISE_NO` varchar(100) NOT NULL,
  `STD_ID` varchar(200) NOT NULL,
  `FNAME` varchar(100) NOT NULL,
  `LNAME` varchar(100) NOT NULL,
  `HOUSE` varchar(100) NOT NULL,
  `CURR_CLS` int(2) NOT NULL,
  `ROLL_NO` int(3) NOT NULL,
  `DOB` date NOT NULL,
  `FATHER_NAME` varchar(100) NOT NULL,
  `MOTHER_NAME` varchar(100) NOT NULL,
  `NATIONALITY` varchar(100) NOT NULL,
  `MOTHER_TONGUE` varchar(50) NOT NULL,
  `RELIGION` varchar(100) NOT NULL,
  `CASTE` varchar(100) NOT NULL,
  `SUB_CASTE` varchar(100) NOT NULL,
  `BIRTH_PLC` varchar(100) NOT NULL,
  `TALUKA` varchar(100) NOT NULL,
  `AADHAR` varchar(16) NOT NULL,
  `DIVS` varchar(20) NOT NULL,
  `ADDRESS` varchar(200) NOT NULL,
  `DISTRICT` varchar(100) NOT NULL,
  `STATE` varchar(100) NOT NULL,
  `COUNTRY` varchar(100) NOT NULL,
  `TEL` bigint(12) NOT NULL,
  `EMAIL` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`GR_NO`, `ADM_DT`, `ADM_CLS`, `UDISE_NO`, `OTH_UDISE_NO`, `STD_ID`, `FNAME`, `LNAME`, `HOUSE`, `CURR_CLS`, `ROLL_NO`, `DOB`, `FATHER_NAME`, `MOTHER_NAME`, `NATIONALITY`, `MOTHER_TONGUE`, `RELIGION`, `CASTE`, `SUB_CASTE`, `BIRTH_PLC`, `TALUKA`, `AADHAR`, `DIVS`, `ADDRESS`, `DISTRICT`, `STATE`, `COUNTRY`, `TEL`, `EMAIL`) VALUES
('4567', '2017-05-01', 10, '27230100534', '', '111213141516', 'JAMES', 'THOMAS', 'TAGORE', 10, 4, '1989-10-14', 'STANLEY', 'MARY', 'INDIAN', 'ENGLISH', 'CHRISTIAN', 'CHRISTIAN', '', 'MUMBAI', 'MUMBAI', '123456789012', '1', 'SAAKLI STREET', 'MUMBAI', 'MAHARASHTRA', 'INDIA', 12345678, ''),
('1234', '2017-05-01', 4, '27230100534', '', '12345678901234567899', 'MOHAMMED SOHEL', 'SHAIKH', 'NEHRU', 6, 12, '2017-05-02', 'MOHAMMED SALIM', 'MUNIRA', 'INDIAN', 'URDU', 'MUSLIM', 'DAWOODI BOHRA', 'BOHRA', 'MUMBAI', 'MUMBAI', '123456789012', '1', 'MUMBAI', 'MUMBAI', 'MAHARASHTRA', 'INDIA', 12345678, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lc_tbl`
--
ALTER TABLE `lc_tbl`
  ADD PRIMARY KEY (`LC_NO`),
  ADD KEY `LC_NO` (`LC_NO`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`GR_NO`),
  ADD KEY `GR_NO` (`GR_NO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
