-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 12:02 AM
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

--
-- Dumping data for table `t_contractorslist`
--

INSERT INTO `t_contractorslist` (`Contractor_ID`, `Contractor_Name`, `Contractor_Description`, `is_deleted`, `createdate`, `modifieddate`) VALUES
(1, 'Big Guy LLC', 'Highly awarded contractor with over 30 years of experience.', 0, '2022-12-10 02:51:21', NULL),
(2, 'Happy Contractor Company', 'Customer service is our top priority!', 0, '2022-12-10 02:51:57', NULL),
(3, 'Trusted Company', 'All of your construction needs in one place!', 0, '2022-12-10 02:56:53', NULL),
(4, 'First LLC', 'Top rated contractor with low cost service.', 1, '2022-12-10 12:21:37', '2022-12-11 03:47:25'),
(5, 'Fixer Upper', 'TV stars looking for a new remodeling project.', 0, '2022-12-10 19:31:12', NULL),
(6, 'Best Way LLC', 'Local contractors with great reviews.', 0, '2022-12-11 12:59:44', '2022-12-11 17:51:32');

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
(1, '9 inch Pipe', 'Testing the edit', 1.00, 1, '2022-12-02 12:43:54', '2022-12-11 03:47:46'),
(3, '12 inch pipe', 'larger pipe used for water mains', 1000.00, 0, '2022-12-10 11:39:12', NULL),
(6, 'Steel Bars', 'Steel bars for the use of soldering together on a construction project.', 1500.00, 0, '2022-12-10 19:29:55', NULL),
(7, 'Nuts and Bolts', 'Various array of connectors.', 0.10, 0, '2022-12-11 12:57:59', NULL),
(8, 'Wrench', 'tools for fastening', 10.00, 0, '2022-12-11 13:00:10', NULL),
(9, 'Hammer', 'The most basic of tools.', 8.00, 0, '2022-12-11 13:00:27', '2022-12-11 17:53:37'),
(10, 'Drill', 'Power Tool', 120.00, 0, '2022-12-11 13:03:51', NULL);

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
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `ZipCode` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_project`
--

INSERT INTO `t_project` (`Project_ID`, `Project_Name`, `Project_Description`, `is_deleted`, `createdate`, `Created_By`, `modifieddate`, `Contractor_ID`, `Address`, `City`, `State`, `ZipCode`) VALUES
(2, 'Boone County Remodel', 'A remodel of the Boone County Metropolitan area.', 0, '2022-12-10 02:58:40', 4, NULL, 3, '8847 IL-76', 'Belvidere', 'IL', 61008),
(3, 'Hamilton County Remodel', '    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dol', 1, '2022-12-10 02:58:40', 4, '2022-12-11 04:01:08', 1, '123 Main St', 'Cincinnati', 'OH', 45248),
(14, 'City of Cincinnati Restoration Project', 'project to revitalize the historical districts in the City of Cincinnati', 0, '2022-12-11 12:18:45', 4, NULL, 5, '801 Plum St.', 'Cincinnati', 'OH', 45202),
(15, 'Florence Tank Upgrade', 'Upgrading the Florence Y\'All water tank.', 0, '2022-12-11 12:33:57', 4, NULL, 2, '500 Mall Circle Rd', 'Florence', 'KY', 41042),
(19, 'Kings Island Project', 'New rollercoaster being added to the amusement park.', 0, '2022-12-11 12:55:19', 4, NULL, 3, '6300 Kings Island Drive', 'Kings Island', 'OH', 45034);

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
  `modifieddate` datetime DEFAULT NULL,
  `Quantity_Used` int(10) NOT NULL DEFAULT 0,
  `Paid_Amount` float(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_projectmaterials`
--

INSERT INTO `t_projectmaterials` (`PMID`, `Project_ID`, `Material_ID`, `Quantity`, `Project_Cost`, `is_deleted`, `createdate`, `modifieddate`, `Quantity_Used`, `Paid_Amount`) VALUES
(1, 2, 1, 100, 20.00, 0, '2022-12-10 17:32:50', NULL, 0, 0.00),
(2, 2, 6, 100, 1200.50, 0, '2022-12-10 19:38:24', NULL, 0, 0.00),
(5, 2, 3, 10, 100.00, 0, '2022-12-11 04:13:50', NULL, 0, 0.00),
(6, 15, 3, 64, 64.00, 1, '2022-12-11 12:44:44', '2022-12-11 16:12:16', 0, 64.00),
(7, 15, 3, 1, 150.00, 1, '2022-12-11 12:45:09', '2022-12-11 12:52:00', 0, 0.00),
(8, 15, 3, 1, 150.00, 1, '2022-12-11 12:51:32', '2022-12-11 12:52:06', 0, 0.00),
(9, 15, 6, 1, 300.00, 0, '2022-12-11 12:52:24', '2022-12-11 16:11:00', 2, 200.00),
(10, 19, 10, 1, 100.00, 0, '2022-12-11 13:04:01', NULL, 0, 0.00),
(11, 19, 7, 1000, 0.05, 0, '2022-12-11 13:04:14', NULL, 0, 0.00),
(12, 15, 8, 1, 12.00, 0, '2022-12-11 16:12:06', '2022-12-11 16:12:24', 1, 12.00);

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
(2, 2, 'admin@nku.edu', '$2y$10$c0Ec17ZSDPjEIJfU4a5CheMeL.CyGaJhU5YtqYvaACrtELqY3GHsW', NULL, NULL, 1, '2022-12-01 16:05:27', '2022-12-11 03:46:38'),
(3, 1, 'smithbe64@gmail.com', '$2y$10$.MH7vIipHBG2xBJxccyLZuicUqpP9gDkinQ/TllpUePyZJFlhK.Ou', 'Benjamin', 'Smith', 0, '2022-12-01 23:02:14', NULL),
(4, 1, 'smithb77@mymail.nku.edu', '$2y$10$F8k5LL5Ax6hi.Uxh5Xd4ZO4Isd0w1t48MKEjRi5aFgIFUfSgYHiKa', 'Ben', 'Smith', 0, '2022-12-10 02:06:57', NULL),
(5, 2, 'darkcreed64@gmail.com', '$2y$10$LVAijP7MpbDhc93b7GVqo.msPdoEv4onBKFXZUu0msxlZDbTMvw7.', 'Donnie', 'Darko', 0, '2022-12-11 04:01:44', '2022-12-11 17:46:53');

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
  ADD KEY `Contractor_ID` (`Contractor_ID`);

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
  MODIFY `Contractor_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_grouppermissions`
--
ALTER TABLE `t_grouppermissions`
  MODIFY `GID` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_materialslist`
--
ALTER TABLE `t_materialslist`
  MODIFY `Material_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_project`
--
ALTER TABLE `t_project`
  MODIFY `Project_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_projectmaterials`
--
ALTER TABLE `t_projectmaterials`
  MODIFY `PMID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `UID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_project`
--
ALTER TABLE `t_project`
  ADD CONSTRAINT `t_project_ibfk_1` FOREIGN KEY (`Created_By`) REFERENCES `t_user` (`UID`),
  ADD CONSTRAINT `t_project_ibfk_2` FOREIGN KEY (`Contractor_ID`) REFERENCES `t_contractorslist` (`Contractor_ID`);

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
