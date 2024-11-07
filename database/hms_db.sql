-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2022 at 07:06 AM
-- Server version: 8.0.30-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `adminEmail` varchar(50) NOT NULL,
  `adminPassword` text NOT NULL,
  `adminPhone` varchar(15) DEFAULT NULL,
  `adminType` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminEmail`, `adminPassword`, `adminPhone`, `adminType`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$9eMdX8hfXb58/pJjXv7U7ud0mOScRRd3lRy1iEk/paqYjbq4Sg53q', '09254325731', 'master'),
(5, 'John Mark', 'jm@gmail.com', '$2y$10$XlytG1SoQylSE6No4RnTyOqCXkDsuEMH5ytANIZjqnkHujIF1PpAO', '097883738312', NULL),
(7, 'Harry Cake', 'hc@gmail.com', '$2y$10$ED3Io80Giov7f5mCXJmnmOfCmj7f.cVPAkhyXm5fZ9alAzqTKS4CO', '09823723782', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `doctorId` int DEFAULT NULL,
  `appt_date` date DEFAULT NULL,
  `appt_stime` time DEFAULT NULL,
  `appt_etime` time DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `yourMessage` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentId`, `userId`, `doctorId`, `appt_date`, `appt_stime`, `appt_etime`, `phoneNumber`, `yourMessage`) VALUES
(1, 3, 1, '2022-04-26', '09:00:00', '09:30:00', '0978267373', 'I wanna contact you'),
(3, 5, 1, '2022-04-26', '09:30:00', '10:00:00', '098838', 'yo this is appt by Linn Linn'),
(5, 5, 5, '2022-04-25', '10:30:00', '11:00:00', '9328839832', 'this is another doctor meeting'),
(6, 1, 1, '2022-04-28', '13:00:00', '13:30:00', '0937328732823', ''),
(7, 3, 1, '2022-04-29', '15:30:00', '16:00:00', '093873763873', '');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `articleId` int NOT NULL,
  `title` text,
  `subtitle` text,
  `category` varchar(200) DEFAULT NULL,
  `article` text,
  `uploadDate` date DEFAULT NULL,
  `doctorId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleId`, `title`, `subtitle`, `category`, `article`, `uploadDate`, `doctorId`) VALUES
(2, 'In publishing and graphic design ', 'In publishing and graphic design, Lorem ipsum is a placeholder text', 'Fitness', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2022-04-05', 3),
(3, 'Lorem ipsum', 'In publishing and graphic design, Lorem ipsum is a placeholder textIn publishing and graphic design, Lorem ipsum is a placeholder textIn publishing and graphic design, Lorem ipsum is a placeholder text design, Lorem ipsum is a placeholder text', 'Health', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.', '2022-04-09', 4);

-- --------------------------------------------------------

--
-- Table structure for table `bookingroom`
--

CREATE TABLE `bookingroom` (
  `brId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `bookingCode` varchar(100) DEFAULT NULL,
  `useDate` date DEFAULT NULL,
  `roomId` int DEFAULT NULL,
  `reqInfo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingroom`
--

INSERT INTO `bookingroom` (`brId`, `userId`, `bookingCode`, `useDate`, `roomId`, `reqInfo`) VALUES
(3, 5, 'BR-20220319-63F80', '2022-03-24', 12, '3,3'),
(4, 1, 'BR-20220416-F229B', '2022-04-18', NULL, '6,3');

-- --------------------------------------------------------

--
-- Table structure for table `bookingservice`
--

CREATE TABLE `bookingservice` (
  `bsId` int NOT NULL,
  `userId` int NOT NULL,
  `serviceId` int NOT NULL,
  `bookingCode` varchar(100) NOT NULL,
  `operationDate` date NOT NULL,
  `operationTime` time NOT NULL,
  `noofPatient` int NOT NULL,
  `estimatedCost` int NOT NULL,
  `bookingNote` text,
  `investigationResult` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorId` int NOT NULL,
  `doctorName` varchar(30) NOT NULL,
  `doctorEmail` varchar(50) NOT NULL,
  `doctorPassword` text NOT NULL,
  `doctorPhone` varchar(15) DEFAULT NULL,
  `education` text,
  `introduction` text,
  `specialityId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorId`, `doctorName`, `doctorEmail`, `doctorPassword`, `doctorPhone`, `education`, `introduction`, `specialityId`) VALUES
(1, 'Dr. Aung Nay Oo', 'ano@gmail.com', '$2y$10$1zlT//kKbdkMRV6TLtL./.PVNqvtcqzui5Fv6hYTC2zez.DuyetWG', '09767855436', 'M.B.B.S (Ygn)', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. ', 4),
(3, 'Asso Prof. Dr Nay Nay', 'nn@gmail.com', '$2y$10$eoPTqFpaf/dHN0.FODZo.eyHzrCT3lZb1WFdXO9Et4L.KtlBzojEm', '0973783848', 'M.B.BS (Ygn)', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. ', 3),
(4, 'Prof. Dr. Moe Htet', 'mh@gmail.com', '$2y$10$co3ySCNR53IgniM9Pkrn3usHiyuMZkF2nPOHGhAK8ZJyQ0GrOUoF6', '09389383938', 'M.B.B.S (Ygn)', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. ', 1),
(5, 'Dr. Aung Aung', 'aa@gmail.com', '$2y$10$OMhY6c2Pt2S.aM0NfmaGR.VotcAS/D4CySE2CxCL7VswTv8Lb4RuC', '09328832873', 'M.B.B.S (Ygn)', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. ', 5),
(6, 'Asso. Prof. Dr Linn Maung', 'lm@gmail.com', '$2y$10$Xag/LPR5lgAab1aZfIGCouXbMnSes5iDb7oq4uXLXtU9keGpGbJYu', '098283283298', 'M.B.B.S (Ygn)', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available. ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicineId` int NOT NULL,
  `medicineName` varchar(200) DEFAULT NULL,
  `medicineImg` varchar(100) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `madein` varchar(100) DEFAULT NULL,
  `ingredient` text,
  `price` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicineId`, `medicineName`, `medicineImg`, `size`, `madein`, `ingredient`, `price`, `quantity`, `description`) VALUES
(1, 'Actein 600 mg Effervescent Tablet', 'medicineImg/m1.webp', '10 Capsules 1 Card, 4 Card 1 Box', 'Taiwan', 'Acetylcysteine 600 mg', 1600, 43, 'Actein 600 mg is used to reduce the viscosity of the secretion of mucous membrane of respiratory tract. It can be used in adjuvant treatment in certain clinical conditions characterized by the presence of thick & viscous mucoid secretions such as chronic and acute bronchopulmonary diseases.\r\nDosage. Actein 600 mg is used to reduce the viscosity of the secretion of mucous membrane of respiratory tract. It can be used in adjuvant treatment in certain clinical conditions characterized by the presence of thick & viscous mucoid secretions such as chronic and acute bronchopulmonary diseases.\r\nDosage'),
(2, 'Ascoril Syrup', 'medicineImg/m2.webp', 'Selling Unit 1 Bottle', 'India', 'Salbutamol ,Bromhexine, Guaifenesin , menthol', 3000, 45, ''),
(3, 'Chericof Lozenge', 'medicineImg/m3.webp', 'Selling Unit 1 Card (4 Lozenges), 1 Box (4x5 Cards)', 'India', 'Amymetacresol 0.6 mg, 2,4-dichloro benzyl alcohol 1.2 mg', 800, 3, 'Chericof lozenge is an antiseptic lozenges for relief of sore throat for children & adults.Chericof lozenge is an antiseptic lozenges for relief of sore throat for children & adults.Chericof lozenge is an antiseptic lozenges for relief of sore throat for children & adults.'),
(4, 'Decolgen Forte', 'medicineImg/m4.webp', '1 Box 910 x10 Cards', 'Philippines', 'Acetaminophen 500 mg, Phenylpropanolamine HCl 25 mg, Chlorpheniramine maleate 2 mg', 1100, 26, 'For effective control of the common cold; allergic and vasomotor rhinitis, hay fever, influenza catarrh, sinusitis and other related respiratory disorders. For effective control of the common cold; allergic and vasomotor rhinitis, hay fever, influenza catarrh, sinusitis and other related respiratory disorders'),
(5, 'V.Rohto Vitamin', 'medicineImg/m5.jpg', '1 Pcs (13 ml) 1 Pcs (13 ml)', 'Vietnam', 'Potassium L-Aspartate 130 mg, Pyridoxine hydrochloride 13 mg, Sodium Chondroitin Sulfate 13 mg, d-alpha-Tocopherol Acetate 6.5 mg, Chlorpheniramine Maleate 3.9 mg', 4300, 67, 'V.Rohto Vitamin prevents eye diseases from swimming or due to entry of dust or sweat into eyes, and is used in ophthalmitis due to UV or other light rays (e.g. Snow blindness), Blepharitis, and blurred vision. V.Rohto Vitamin prevents eye diseases from swimming or due to entry of dust or sweat into eyes, and is used in ophthalmitis due to UV or other light rays (e.g. Snow blindness), Blepharitis, and blurred vision. V.Rohto Vitamin prevents eye diseases from swimming or due to entry of dust or sweat into eyes, and is used in ophthalmitis due to UV or other light rays (e.g. Snow blindness), Blepharitis, and blurred vision');

-- --------------------------------------------------------

--
-- Table structure for table `ordermed`
--

CREATE TABLE `ordermed` (
  `orderId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `deliveryMethod` varchar(10) DEFAULT NULL,
  `total` int DEFAULT NULL,
  `deliveredStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermed`
--

INSERT INTO `ordermed` (`orderId`, `userId`, `orderDate`, `deliveryMethod`, `total`, `deliveredStatus`) VALUES
(2, 5, '2022-04-01', 'standard', 8500, 1),
(3, 3, '2022-04-03', 'standard', 9000, 1),
(4, 1, '2022-04-16', 'faster', 6200, 1),
(5, 3, '2022-04-24', 'standard', 3100, 1),
(6, 3, '2022-06-21', 'faster', 7500, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ordermedicine`
--

CREATE TABLE `ordermedicine` (
  `ordermedicineId` int NOT NULL,
  `orderId` int DEFAULT NULL,
  `medicineId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordermedicine`
--

INSERT INTO `ordermedicine` (`ordermedicineId`, `orderId`, `medicineId`, `quantity`) VALUES
(3, 2, 1, 1),
(4, 2, 4, 1),
(5, 2, 5, 1),
(6, 3, 1, 2),
(7, 3, 5, 1),
(8, 4, 4, 2),
(9, 5, 1, 1),
(10, 6, 3, 3),
(11, 6, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int NOT NULL,
  `roomNumber` varchar(10) DEFAULT NULL,
  `roomNote` text,
  `bookedStatus` tinyint(1) DEFAULT NULL,
  `wardId` int DEFAULT NULL,
  `rtId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `roomNumber`, `roomNote`, `bookedStatus`, `wardId`, `rtId`) VALUES
(2, 'R010', '', 0, 1, 1),
(3, 'R011', '', 0, 1, 3),
(4, 'R012', '', 0, 1, 4),
(5, 'R013', '', 0, 1, 1),
(6, 'R014', '', 0, 1, 2),
(7, 'R015', '', 0, 1, 2),
(8, 'R016', '', 0, 1, 3),
(9, 'R020', '', 0, 3, 1),
(10, 'R021', '', 0, 3, 2),
(11, 'R022', '', 0, 3, 2),
(12, 'R023', '', 1, 3, 3),
(13, 'R024', '', 0, 3, 4),
(14, 'R025', '', 0, 3, 3),
(15, 'R026', '', 0, 3, 4),
(16, 'R030', '', 0, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `rtId` int NOT NULL,
  `rtName` varchar(50) DEFAULT NULL,
  `rtSize` int DEFAULT NULL,
  `rtRate` int DEFAULT NULL,
  `rtImg` varchar(50) DEFAULT NULL,
  `rtFaci` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`rtId`, `rtName`, `rtSize`, `rtRate`, `rtImg`, `rtFaci`) VALUES
(1, 'Royal Suite', 1033, 350000, 'roomtypeImg/royal_suite.jpg', 'Luxury Interiors||Separate Living Room and Patient||Room Sofa bed for relatives||Refrigerator, Microwave, Dishware, Pantry||Drinking Water, Dining Table, Kettle||Smart TV, Wifi Free||2 Private Bathroom||'),
(2, 'VIP Room', 840, 300000, 'roomtypeImg/vip.jpg', 'Luxury Interiors||Separate Living Room Patient||Room Sofa bed for relatives||Refrigerator, Microwave, Dishware, Pantry|| Drinking Water, Dining Table||Smart TV, Free Wifi||1 Private Bathroom||'),
(3, 'Deluxe Room', 420, 250000, 'roomtypeImg/deluxe.jpg', 'Luxury Interiors||Room Sofa bed for relatives||Refrigerator, Microwave, Dishware, Pantry|| Drinking Water, Dining Table||Smart TV, Free Wifi|| Bathroom Amenities & Hair Dryer||'),
(4, 'Normal Suite', 400, 120000, 'roomtypeImg/normal.jpg', 'Normal Clean and Facilitated inside ||Room Sofa bed for relatives|| Drinking Water, Dining Table, Kettle||Refrigerator||Free Wifi||');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleId` int NOT NULL,
  `dayOfSchedule` enum('sun','mon','tue','wed','thur','fri','sat') DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `doctorId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleId`, `dayOfSchedule`, `startTime`, `endTime`, `doctorId`) VALUES
(1, 'tue', '09:00:00', '15:00:00', 1),
(2, 'thur', '13:00:00', '16:00:00', 1),
(3, 'fri', '15:30:00', '19:00:00', 1),
(4, 'mon', '10:30:00', '18:00:00', 5),
(5, 'fri', '09:00:00', '12:00:00', 5),
(6, 'wed', '09:00:00', '18:00:00', 4),
(7, 'thur', '09:00:00', '17:00:00', 4),
(8, 'fri', '10:00:00', '18:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceId` int NOT NULL,
  `serviceName` varchar(100) NOT NULL,
  `serviceDescription` text NOT NULL,
  `serviceImg` varchar(70) NOT NULL,
  `sec1` varchar(100) DEFAULT NULL,
  `sec1Desp` text,
  `sec2` varchar(100) DEFAULT NULL,
  `sec2Desp` text,
  `sec3` varchar(100) DEFAULT NULL,
  `sec3Desp` text,
  `bookable` tinyint(1) DEFAULT NULL,
  `cost` int DEFAULT NULL,
  `stId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceId`, `serviceName`, `serviceDescription`, `serviceImg`, `sec1`, `sec1Desp`, `sec2`, `sec2Desp`, `sec3`, `sec3Desp`, `bookable`, `cost`, `stId`) VALUES
(4, 'OBSTETRICIAN AND GYNECOLOGY', 'Obstetrician and Gynecology Clinic at Ar Yu International Hospital provides a total quality care to every woman for overall wellbeing and medical needs at every stage of their lives. Our OG clinic brings well experienced specialists that offer a complete range of therapeutic, diagnostics, treatment and surgical requirements to meet special needs of women.', 'serviceImg/Obstetricsa-Gynecology_800x436px_WEB.jpg', 'Treatments & Services', ' Cervical Cancer Treatment (on pre and early stage) by specialist|| Colposcopy Screening for Cervical Cancer|| HPV Vaccination|| Loop Electrosurgical Excision Procedure (LEEP)||', 'Obstetric and Gynecological Endoscopies', ' Abnormal Vaginal Bleeding|| Blocked Fallopian Tubes||Breast Lumps||', 'Other Diagnosis and Treatments', ' Abnormal Leukorrhea||', 1, 400000, 3),
(5, 'EAR, NOSE & THROAT', 'Ear Nose and Throat Clinic (ENT) at Ar Yu International Hospital provides a full range of medical and surgical services for pediatric and adult patients with head and neck disorders and diseases. Diagnostic and treatment services for disease and conditions associated with ear, nose and throatEar Nose and Throat Clinic (ENT) at Ar Yu International Hospital provides a full range of medical and surgical services for pediatric and adult patients with head and neck disorders and diseases. Diagnostic and treatment services for disease and conditions associated with ear, nose and throat', 'serviceImg/nose-examination.jpg', 'Treatments & Services', ' Ear and hearing disorders, including otitis, ear pain, pressure in the ear, hearing problems, ringing in the ear|| Oral cavity, throat and larynx (voice box) disorders, including tonsillitis, pharyngitis, persistent coughing, voice disorder, and thyroid dysfunction||', 'Facilities', ' Continuous Positive Airway Pressure(CPAP)||Fiber Optic Laryngoscopy||', '', '||', 1, 300000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `servicetype`
--

CREATE TABLE `servicetype` (
  `stId` int NOT NULL,
  `stServicetype` varchar(30) NOT NULL,
  `stDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicetype`
--

INSERT INTO `servicetype` (`stId`, `stServicetype`, `stDescription`) VALUES
(1, 'Imaging Service', ''),
(2, 'Clinical Service', ''),
(3, 'Specialist Service', ''),
(4, 'Patient Service', '');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `specialityId` int NOT NULL,
  `speciality` varchar(200) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`specialityId`, `speciality`, `description`) VALUES
(1, 'Cardiologist', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.'),
(2, 'Hepatologist', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.'),
(3, 'General And Colorectal Surgeon', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.'),
(4, 'Mexilo-Facial Surgeon', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.'),
(5, 'Rehab Med', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.'),
(6, 'Rheumatologist', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int NOT NULL,
  `staffName` varchar(30) NOT NULL,
  `staffEmail` varchar(50) NOT NULL,
  `staffPassword` text NOT NULL,
  `staffPhone` varchar(15) DEFAULT NULL,
  `staffAddress` text,
  `reqStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `staffName`, `staffEmail`, `staffPassword`, `staffPhone`, `staffAddress`, `reqStatus`) VALUES
(1, 'Mg Mg', 'mgmg@gmail.com', '$2y$10$9EixSmt3wel0AShQzTsqse0OZfkw3ppNT8cTOBRgHzBh5OmmdYjce', '09254325731', 'dagon township, yangon', 1),
(3, 'Swe Swe', 'sweswe@gmail.com', '$2y$10$0AmOvPUebTmDE4b2gQBJoOdu9Q2119xy4nK8MWFEr48Ei60I/kAQC', '09736356353', 'alone, yangon', 0),
(4, 'Moe Moe', 'moemoe@gmail.com', '$2y$10$LQyzQmdYBY7Jh3vAbjZtCuA3cWetjB02Un/e3qIwVzpwNUBQTHJi.', '093337873', 'south dagon', 1),
(5, 'Kyaw Kyaw', 'kyawkyaw@gmail.com', '$2y$10$J0hah/Pz0Boighvuvo.PXOaPxWfrzz1cbmTejbhwVeIB23uZpxaFS', '09883828245', 'yangon', 1),
(6, 'Nyan Win Naing', 'nwn@gmail.com', '$2y$10$bcpHFWAqU6ufzA1RRcQEg.GJPResug4cu6m4SVD0yk1KgIDeNIj7q', '092377328328', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonialId` int NOT NULL,
  `userId` int DEFAULT NULL,
  `testimonial` text,
  `uploadDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonialId`, `userId`, `testimonial`, `uploadDate`) VALUES
(1, 1, 'Awesome Webiste!', '2022-03-05'),
(2, 3, 'It helps a lots all about for health.', '2022-03-06'),
(3, 3, 'All functions work excellentðŸŽ‰', '2022-03-06'),
(4, 1, 'It is awesome website', '2022-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` text NOT NULL,
  `userPhone` varchar(15) NOT NULL,
  `userAddress` text NOT NULL,
  `userDob` date NOT NULL,
  `userBloodType` varchar(5) NOT NULL,
  `userNrc` varchar(20) NOT NULL,
  `userNote` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPassword`, `userPhone`, `userAddress`, `userDob`, `userBloodType`, `userNrc`, `userNote`) VALUES
(1, 'Min', 'min@gmail.com', '$2y$10$OJggdlf.s6CZp/KcAOqEBuFyNnyTy7IQns56UjxVbB26TV1ksWEbO', '09254325731', 'dagon township, yangon', '2002-01-28', 'A', '12/DaDaDa(N)111111', 'Penicillin allergy'),
(3, 'Ko', 'ko@gmail.com', '$2y$10$taFvZ7jErI/Sh6HP1sgIE.Jx7BBSc2o0FAYQHG7xfndsECUwKmu0.', '09783373782', 'mingalardon, yangon', '2019-02-27', 'B', '11/GAGAGA(N)000000', 'skin allergy\r\n'),
(5, 'Linn Linn', 'linn@gmail.com', '$2y$10$42aJ0Kwo9Knt8qHysTbgs.vLEQd45C1cTZW8a4tqYQeh.1WhdHUOK', '09999999999', 'mongo', '2022-03-04', 'O', '11/DaTaTa(N)111222', 'something');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `wardId` int NOT NULL,
  `wardName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`wardId`, `wardName`) VALUES
(1, 'Medical Ward'),
(3, 'Surgical Ward'),
(6, 'OG Ward'),
(7, 'Child Ward'),
(8, 'ENT Ward');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `adminEmail` (`adminEmail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `bookingroom`
--
ALTER TABLE `bookingroom`
  ADD PRIMARY KEY (`brId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indexes for table `bookingservice`
--
ALTER TABLE `bookingservice`
  ADD PRIMARY KEY (`bsId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `serviceId` (`serviceId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorId`),
  ADD UNIQUE KEY `doctorEmail` (`doctorEmail`),
  ADD KEY `specialityId` (`specialityId`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicineId`);

--
-- Indexes for table `ordermed`
--
ALTER TABLE `ordermed`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `ordermedicine`
--
ALTER TABLE `ordermedicine`
  ADD PRIMARY KEY (`ordermedicineId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `medicineId` (`medicineId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`),
  ADD KEY `wardId` (`wardId`),
  ADD KEY `rtId` (`rtId`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`rtId`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleId`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceId`),
  ADD UNIQUE KEY `serviceName` (`serviceName`),
  ADD KEY `stId` (`stId`);

--
-- Indexes for table `servicetype`
--
ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`stId`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`specialityId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`),
  ADD UNIQUE KEY `staffEmail` (`staffEmail`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonialId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`wardId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `articleId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookingroom`
--
ALTER TABLE `bookingroom`
  MODIFY `brId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookingservice`
--
ALTER TABLE `bookingservice`
  MODIFY `bsId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicineId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ordermed`
--
ALTER TABLE `ordermed`
  MODIFY `orderId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordermedicine`
--
ALTER TABLE `ordermedicine`
  MODIFY `ordermedicineId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `rtId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `servicetype`
--
ALTER TABLE `servicetype`
  MODIFY `stId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `specialityId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonialId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ward`
--
ALTER TABLE `ward`
  MODIFY `wardId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);

--
-- Constraints for table `bookingroom`
--
ALTER TABLE `bookingroom`
  ADD CONSTRAINT `bookingroom_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `bookingroom_ibfk_2` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`);

--
-- Constraints for table `bookingservice`
--
ALTER TABLE `bookingservice`
  ADD CONSTRAINT `bookingservice_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `bookingservice_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `service` (`serviceId`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`specialityId`) REFERENCES `speciality` (`specialityId`);

--
-- Constraints for table `ordermed`
--
ALTER TABLE `ordermed`
  ADD CONSTRAINT `ordermed_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `ordermedicine`
--
ALTER TABLE `ordermedicine`
  ADD CONSTRAINT `ordermedicine_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `ordermed` (`orderId`),
  ADD CONSTRAINT `ordermedicine_ibfk_2` FOREIGN KEY (`medicineId`) REFERENCES `medicine` (`medicineId`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`wardId`) REFERENCES `ward` (`wardId`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`rtId`) REFERENCES `roomtype` (`rtId`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`doctorId`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`stId`) REFERENCES `servicetype` (`stId`);

--
-- Constraints for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `testimonial_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
