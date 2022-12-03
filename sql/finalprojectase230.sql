-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 06:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalprojectase230`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_contractorslist`
--

CREATE TABLE `t_contractorslist` (
  `Contractor_ID` int(10) UNSIGNED NOT NULL,
  `Contractor_Name` varchar(50) DEFAULT NULL,
  `Contractor_Description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_grouppermissions`
--

CREATE TABLE `t_grouppermissions` (
  `GID` int(5) UNSIGNED NOT NULL,
  `GROUP_NAME` varchar(50) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_user` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_grouppermissions`
--

INSERT INTO `t_grouppermissions` (`GID`, `GROUP_NAME`, `is_admin`, `is_user`, `is_deleted`, `createdate`, `modifieddate`) VALUES
(1, 'Admin', 1, 1, 0, '2022-12-01 15:57:10', NULL),
(2, 'User', 0, 1, 0, '2022-12-01 15:57:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_materialslist`
--

CREATE TABLE `t_materialslist` (
  `Material_ID` int(10) UNSIGNED NOT NULL,
  `Material_Name` varchar(50) DEFAULT NULL,
  `Material_Description` varchar(255) DEFAULT NULL,
  `Material_Cost` float(10,2) UNSIGNED DEFAULT 0.00,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_materialslist`
--

INSERT INTO `t_materialslist` (`Material_ID`, `Material_Name`, `Material_Description`, `Material_Cost`, `is_deleted`, `createdate`, `modifieddate`) VALUES
(1, '9 inch Pipe', 'Testing the edit', 1.00, 0, '2022-12-02 12:43:54', '2022-12-03 10:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `t_project`
--

CREATE TABLE `t_project` (
  `Project_ID` int(10) UNSIGNED NOT NULL,
  `Project_Name` varchar(50) DEFAULT NULL,
  `Project_Description` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `Created_By` int(10) UNSIGNED NOT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `Contractor_ID` int(10) UNSIGNED DEFAULT NULL,
  `Location_ID` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_projectfinancials`
--

CREATE TABLE `t_projectfinancials` (
  `PFID` int(10) UNSIGNED NOT NULL,
  `PMID` int(10) UNSIGNED NOT NULL,
  `Quantity_Used` int(10) UNSIGNED DEFAULT 0,
  `Paid_Amount` float(10,2) UNSIGNED DEFAULT 0.00,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_projectlocation`
--

CREATE TABLE `t_projectlocation` (
  `Location_ID` int(10) UNSIGNED NOT NULL,
  `Project_ID` int(10) UNSIGNED NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(25) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `ZipCode` int(5) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_projectmaterials`
--

CREATE TABLE `t_projectmaterials` (
  `PMID` int(10) UNSIGNED NOT NULL,
  `Project_ID` int(10) UNSIGNED NOT NULL,
  `Material_ID` int(10) UNSIGNED NOT NULL,
  `Quantity` int(10) UNSIGNED DEFAULT NULL,
  `Project_Cost` float(10,2) UNSIGNED DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `UID` int(10) UNSIGNED NOT NULL,
  `GID` int(5) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `createdate` datetime DEFAULT current_timestamp(),
  `modifieddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`UID`, `GID`, `email`, `password`, `firstname`, `lastname`, `is_deleted`, `createdate`, `modifieddate`) VALUES
(2, 2, 'admin@nku.edu', '$2y$10$c0Ec17ZSDPjEIJfU4a5CheMeL.CyGaJhU5YtqYvaACrtELqY3GHsW', NULL, NULL, 0, '2022-12-01 16:05:27', NULL),
(3, 1, 'smithbe64@gmail.com', '$2y$10$.MH7vIipHBG2xBJxccyLZuicUqpP9gDkinQ/TllpUePyZJFlhK.Ou', 'Benjamin', 'Smith', 0, '2022-12-01 23:02:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_contractorslist`
--
ALTER TABLE `t_contractorslist`
  ADD PRIMARY KEY (`Contractor_ID`);

--
-- Indexes for table `t_grouppermissions`
--
ALTER TABLE `t_grouppermissions`
  ADD PRIMARY KEY (`GID`);

--
-- Indexes for table `t_materialslist`
--
ALTER TABLE `t_materialslist`
  ADD PRIMARY KEY (`Material_ID`);

--
-- Indexes for table `t_project`
--
ALTER TABLE `t_project`
  ADD PRIMARY KEY (`Project_ID`),
  ADD KEY `Created_By` (`Created_By`),
  ADD KEY `Contractor_ID` (`Contractor_ID`),
  ADD KEY `Location_ID` (`Location_ID`);

--
-- Indexes for table `t_projectfinancials`
--
ALTER TABLE `t_projectfinancials`
  ADD PRIMARY KEY (`PFID`),
  ADD KEY `PMID` (`PMID`);

--
-- Indexes for table `t_projectlocation`
--
ALTER TABLE `t_projectlocation`
  ADD PRIMARY KEY (`Location_ID`),
  ADD KEY `Project_ID` (`Project_ID`);

--
-- Indexes for table `t_projectmaterials`
--
ALTER TABLE `t_projectmaterials`
  ADD PRIMARY KEY (`PMID`),
  ADD KEY `Project_ID` (`Project_ID`),
  ADD KEY `Material_ID` (`Material_ID`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`UID`),
  ADD KEY `GID` (`GID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_contractorslist`
--
ALTER TABLE `t_contractorslist`
  MODIFY `Contractor_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_grouppermissions`
--
ALTER TABLE `t_grouppermissions`
  MODIFY `GID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_materialslist`
--
ALTER TABLE `t_materialslist`
  MODIFY `Material_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_project`
--
ALTER TABLE `t_project`
  MODIFY `Project_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_projectfinancials`
--
ALTER TABLE `t_projectfinancials`
  MODIFY `PFID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_projectlocation`
--
ALTER TABLE `t_projectlocation`
  MODIFY `Location_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_projectmaterials`
--
ALTER TABLE `t_projectmaterials`
  MODIFY `PMID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `UID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_project`
--
ALTER TABLE `t_project`
  ADD CONSTRAINT `t_project_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `t_user` (`UID`),
  ADD CONSTRAINT `t_project_ibfk_2` FOREIGN KEY (`Contractor_ID`) REFERENCES `t_contractorslist` (`Contractor_ID`),
  ADD CONSTRAINT `t_project_ibfk_3` FOREIGN KEY (`Location_ID`) REFERENCES `t_projectlocation` (`Location_ID`);

--
-- Constraints for table `t_projectfinancials`
--
ALTER TABLE `t_projectfinancials`
  ADD CONSTRAINT `t_projectfinancials_ibfk_1` FOREIGN KEY (`PMID`) REFERENCES `t_projectmaterials` (`PMID`);

--
-- Constraints for table `t_projectlocation`
--
ALTER TABLE `t_projectlocation`
  ADD CONSTRAINT `t_projectlocation_ibfk_1` FOREIGN KEY (`Project_ID`) REFERENCES `t_project` (`Project_ID`);

--
-- Constraints for table `t_projectmaterials`
--
ALTER TABLE `t_projectmaterials`
  ADD CONSTRAINT `t_projectmaterials_ibfk_1` FOREIGN KEY (`Project_ID`) REFERENCES `t_project` (`Project_ID`),
  ADD CONSTRAINT `t_projectmaterials_ibfk_2` FOREIGN KEY (`Material_ID`) REFERENCES `t_materialslist` (`Material_ID`);

--
-- Constraints for table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_ibfk_1` FOREIGN KEY (`GID`) REFERENCES `t_grouppermissions` (`GID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
