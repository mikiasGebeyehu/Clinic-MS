-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2024 at 08:29 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `phonenumber` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `profile`, `phonenumber`, `email`) VALUES
(2, 'admin', '$2y$10$lpU1C2ifQ1BM3x60InxgAOF.QSJ.dKul.tWTEkYkALwrXNk8toA2m', '', '+251-923-243-7235', 'adminadmin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `appointment_date` varchar(100) NOT NULL,
  `symptoms` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_booked` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `username`, `phonenumber`, `appointment_date`, `symptoms`, `status`, `date_booked`) VALUES
(17, 'Patient1', '0923412483', '2024-03-08', 'i cannot eat any food specially that have high protient', 'discharged', '2024-08-20 19:39:05'),
(18, 'Patient1', '0923412483', '2024-04-07', 'i cannot eat any food', 'discharged', '2024-08-20 20:41:09'),
(19, 'Patient1', '0923412483', '2024-05-07', 'i cannot eat any food', 'discharged', '2024-08-23 13:43:37'),
(20, 'Patient1', '0923412483', '2024-08-01', 'over heat', 'discharged', '2024-08-23 14:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `date_send` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) DEFAULT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(50) DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `uname`, `password`, `email`, `phonenumber`, `status`) VALUES
(2569, 'belachew tetachew', '89234123', 'alebe@gmail.com', '09234124', 'rejected'),
(1234, 'ashenafi belihu', '0987', 'miniye@gmail.com', '09234124', 'approved'),
(32087, 'alemitu delash', '$2y$10$RLD7Tlfoq5bxA6cym0Ma8OMqi2zG886pz8tMLZeB.Rf', 'mikiasgebeyehumgs@gmail.com', '092341276', 'rejected'),
(4, 'alemu adelaw', '$2y$10$9RGFFyWNz9k5QCju.ZTEr.FEbypAoNq78EGLfYvaIdF', 'alebe@gmail.com', '097483590', 'rejected'),
(9, 'Mikias Gebeyehu', '$2y$10$bPGX5K7JZVREX7shAz..y.kj4pdJ47NFvoBsxXwIXd/', 'mikiasgebeyehu1234@gmail.com', '+251-936-276-8723', 'approved'),
(12, 'doctor1', '$2y$10$nsfKMqg6HkBmug7eaCOIKe4Sk8GNfPBgbdEs6wFECwN', 'Doctor@gmail.com', '+251-282-784-9384', 'rejected'),
(4, 'alemu anagawu', '$2y$10$kaho4KCa7ggbvYjutFClUeTc6.rCC4k3tsYWEB8dLC1', 'henu@gmail.com', '09546367', 'rejected'),
(2, 'doctor2', 'Doctor2', 'benn@gmail.com', '+251-838-739-8489', 'approved'),
(7, 'doctor4', 'Doctor4', 'miniye@gmail.com', '096235626', 'approved'),
(12, 'doctor1', 'doctor1', 'Doctor@gmail.com', '+251-282-784-9384', 'rejected'),
(7, 'doctor', '0123', 'Doctor@gmail.com', '+251-936-276-8723', 'approved'),
(0, 'abcd', '0000', 'minilu@gmail.com', '09786273884', 'approved'),
(0, 'alemu anagawu', '2222', 'miniye@gmail.com', '+251-282-784-9384', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `patient` varchar(100) NOT NULL,
  `date_discharge` varchar(100) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_check` varchar(100) NOT NULL,
  `advice` varchar(100) NOT NULL,
  `med_pre` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `doctor`, `patient`, `date_discharge`, `amount_paid`, `description`, `date_check`, `advice`, `med_pre`, `message`) VALUES
(18, 'doctor1', 'patient3', '2024-08-01 10:15:29', '282', 'MRI and metformin value', '', 'drink water ', 'metFormin', 'notice the patient to take it twice in day only'),
(19, 'doctor', 'patient3', '2024-08-20 18:44:27', '477', 'value of morphin', '', 'drink water ', 'metFormin', 'take it the medicine two times a day'),
(21, 'ashenafi belihu', 'Patient1', '2024-08-23 14:46:24', '30', 'value of morphin', '', 'drink water ', 'metFormin', 'take it  medicine two times a day');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `date_send` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message`, `username`, `date_send`, `receiver`, `image`) VALUES
('how are you now', 'ashenafi belihu', '2024-08-20 22:16:28', 'Patient1', ''),
('how are you now', 'ashenafi belihu', '2024-08-20 22:11:14', 'patient2', ''),
('hi mqn', 'doctor', '2024-09-01 15:57:50', 'Patient1', ''),
('how are you now', 'doctor', '2024-08-20 22:15:01', 'patient3', ''),
('ohhh i have fever', 'patient1', '2024-08-20 22:17:09', 'ashenafi belihu', ''),
('hi', 'patient1', '2024-08-23 14:43:38', 'belachew tetachew', ''),
('hi doctor', 'patient1', '2024-09-01 15:59:17', 'doctor', ''),
('im okey now', 'patient3', '2024-08-20 22:15:52', 'doctor', '');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(30) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `date_reg` varchar(100) NOT NULL,
  `diseases` varchar(100) NOT NULL,
  `bloodtype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `uname`, `email`, `password`, `phonenumber`, `profile`, `date_reg`, `diseases`, `bloodtype`) VALUES
(0, 'alemu anagawu', 'minilu@gmail.com', '$2y$10$ZFHJ4ugKkdA5.q51W91LHuQnOa7LohH6Q1loxQcB2de4nLIhOjjmW', '+251-282-784-9384', '', '2024-09-11 21:51:04', 'mental health', 'AB+'),
(1, 'Patient1', 'Patient1@gmail.com', '$2y$10$hHFneQRoociDEKH9emD4n..M4pOKowElesj2cNcmiJ4SfphjS610a', '0923412483', 'beyeberu.jpg', '2024-07-02 14:59:46', 'nerve-disorder', 'O-'),
(2, 'patient2', 'patient2at@gmail.com', '$2y$10$H2foVhe2E8rTg.rv23LIJu3EZZVwLhu/d3XKjmfhp22t2Xt3bhbOC', '095463676', '', '2024-07-02 14:59:46', 'heart', 'AB+'),
(3, 'patient3', 'patient3at@gmail.com', '$2y$10$axbL3Gb.is237WMmj8QB7uBl.vsk36h82YdpgdmpBPVQ/YaLdCUJ.', '095463674', 'Medihane ALEM.jpg', '2024-07-04 14:59:46', 'cholera', 'A+'),
(4, 'patient4', 'patient3at@gmail.com', '$2y$10$NCcdBxgXtHyGdodsPHlwgeVTpfpoF4q/6I2yclieyBiy.8p5IWYP2', '095463675', '', '2024-07-02 14:59:46', 'spinal cord', 'B-'),
(5, 'patient5', 'patient5@gmail.com', '$2y$10$uUwrNyvK8KCDuqDFc.7rlOdD55LyxCtjRObGwr6hlid5EiwIVTWra', '095463237', 'beyeberu.jpg', '2024-06-27 09:13:33', 'dihoarea', 'AB-'),
(6, 'patient6', 'alebe@gmail.com', '$2y$10$GB9ie3UQvDLK327T3kWQ2uvJK8X2zPqNT3iZhzWb3R1qsKEVSi4/W', '096736472', '', '2024-07-03 07:22:19', 'cardio', 'O+'),
(7, 'patient7', 'henu@gmail.com', '$2y$10$XSxbQm95bvS9N0GkBwTMG.ohFwGq8ACtCUIRKYZRl8O9u5aPFXa6m', '096234726', '', '2024-07-03 08:50:53', 'emergency', 'B-'),
(8, 'Patient8', 'miniye@gmail.com', '$2y$10$G7dF9N6aLXzjUvuBmS/PPOyAIL0MVlWKSUWYc98hQArxcYfIrFRoK', '092341248', '', '2024-07-03 08:53:01', 'cardio', 'O+'),
(9, 'Patient9', 'mikiasgebeyehu@gmail.com', '$2y$10$NZaoOsnPIlwtMBMR36QOQu98GCJ9L3DfDJUEtL1y1DMIYjCot4FHK', '09347254', '', '2024-07-03 08:53:58', 'nerve-disorder', 'AB-'),
(10, 'Patient10', 'miniye@gmail.com', '$2y$10$SGuRZiTquUK.69aqQheILeEybNQfZTWHhQdsTn35IokW1V5.1INyK', '093745727', '', '2024-07-03 08:56:17', 'emergency', 'AB+'),
(11, 'Patient11', 'mikiasgebeyehumgs@gmail.com', '$2y$10$fKAfNDMXYYLx2/p//nKMp.tTel9iGsCVTbmg8s1BuOAGUuqErh5ny', '+251-936-276-8723', '', '2024-07-03 08:58:27', 'heart atack', 'AB-'),
(12, 'Patient12', 'minilu@gmail.com', '$2y$10$r1aM50CnpX46iVvVfsfAeuiDJLEPBOrZE4W8SUZHf.j7AtDmLBi7S', '095463673', '', '2024-07-03 09:00:49', 'heart atack', 'B-'),
(13, 'Patient13', 'minilu@gmail.com', '$2y$10$WJXRl12NV9rt0aiRUqR6p.DXjMlp3b7sdeuM.owx7dzeTe3rnF58G', '0923412483', '', '2024-07-03 09:04:56', 'emergency', 'O+'),
(14, 'patient14', 'Patient14@gmail.com', '$2y$10$mOr3XG6lZRQ8iG803iQw6uwrH2xWRxBUPvi8Ap7RUtUCsFx5DdwmO', '+251-936-276-8723', '', '2024-07-03 09:08:21', 'nerve-disorder', 'A-');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

CREATE TABLE `pharmacist` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`id`, `fullname`, `phonenumber`, `password`, `email`, `status`) VALUES
(0, 'simon worku', '0923412483', '1234', 'simon@gmail.com', 'approved'),
(1, 'pharmacy1', '+251-282-784-9384', '$2y$10$8whGewtzUrZ.BmPlGnVvZevNUtOptExVjnYTOUjDJkEUCoruWxO7O', 'minilu@gmail.com', 'approved'),
(3, 'pharmacy2', '+251-282-784-8942', '$2y$10$NLek36yu8kV1bYF5mcCJpeLtZjwk2XY0VE1xvDQ4sv6MFqenVfaL2', 'alebe@gmail.com', 'approved'),
(4, 'pharmacy2', '0945754647', 'poiu', 'minilu@gmail.com', 'approved'),
(9, 'mghs', '+251-282-784-9384', '$2y$10$Ro.7okjU2fxuN9oeFDkZWesWI.gkex3jRxOXpj7.DEObFyAwOSivm', 'mikiasgebeyehumgs@gmail.com', 'approved'),
(12, 'pharmacy', '095463673', '$2y$10$CSvx/O/yt0YQffMqDarWJeJpXJCeaRDLnhQyoCsW0ahGT6/pAP0kC', 'mikiasgebeyehumgs@gmail.com', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `medicine_id` int(100) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `date_enter` varchar(100) NOT NULL,
  `expire_date` varchar(100) NOT NULL,
  `pharmacist_rec` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`medicine_id`, `medicine_name`, `date_enter`, `expire_date`, `pharmacist_rec`, `amount`, `quantity`, `description`) VALUES
(1, 'Metformin', '2024-12-03', '2027-12-31', 'pharmacy', '477', 5, 'An Antidiabetic of which is prescribed to treat type 2 diabetes, at least, 48.3 million prescription'),
(2, 'Diclophynac', '2024-09-07', '2026-12-07', 'pharmacy', '30', 93, 'An anti biotic of which is prevent to treat type 2 diabetes, at least, 48.3 million prescriptions ar');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `date_send` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `message`, `username`, `date_send`) VALUES
(2, 'overheat', 'i\'m overheat now', 'patient3', ''),
(4, 'time', 'there is unpunctual doctor in the clinic', 'patient1', '2024-08-20 18:40:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`username`,`receiver`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacist`
--
ALTER TABLE `pharmacist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
