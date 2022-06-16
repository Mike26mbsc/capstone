-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2021 at 03:27 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerkey` int NOT NULL,
  `customerfirstname` varchar(50) NOT NULL,
  `customerlastname` varchar(50) NOT NULL,
  `customerphone` varchar(10) NOT NULL,
  `customeraddress` varchar(255) NOT NULL,
  `customercity` varchar(50) NOT NULL,
  `customerstate` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `customerzip` varchar(5) NOT NULL,
  `customeremail` varchar(50) NOT NULL,
  `customerpassword` varchar(255) NOT NULL,
  `locationkey` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerkey`, `customerfirstname`, `customerlastname`, `customerphone`, `customeraddress`, `customercity`, `customerstate`, `customerzip`, `customeremail`, `customerpassword`, `locationkey`) VALUES
(2, 'bob', 'bobert', '1111111111', '7200 Ocean Blvd', 'Myrtle Beach', 'SC', '29526', 'bob@bobert.com', '$2y$12$V7fyDqmqun5VHds7BURQc.fBHdL8hV4yJg55jWbsbZEB1.zp9VeFe', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeekey` int NOT NULL,
  `employeeusername` varchar(50) NOT NULL,
  `employeetypekey` int NOT NULL,
  `employeefirstname` varchar(50) NOT NULL,
  `employeelastname` varchar(50) NOT NULL,
  `employeephone` varchar(10) NOT NULL,
  `employeeaddress` varchar(255) NOT NULL,
  `employeecity` varchar(50) NOT NULL,
  `employeestate` varchar(2) NOT NULL,
  `employeezip` varchar(5) NOT NULL,
  `employeeemail` varchar(50) NOT NULL,
  `employeepassword` varchar(255) NOT NULL,
  `employeepay` decimal(7,2) NOT NULL,
  `employeedefaultpassword` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeekey`, `employeeusername`, `employeetypekey`, `employeefirstname`, `employeelastname`, `employeephone`, `employeeaddress`, `employeecity`, `employeestate`, `employeezip`, `employeeemail`, `employeepassword`, `employeepay`, `employeedefaultpassword`) VALUES
(1, 'rusty', 1, 'Rusty', 'Shackleford', '5555555555', '1820 Juniper Drive', 'Conway', 'SC', '29526', 'rusty@rustyshack.com', '$2y$12$vwWpulxFRZYV2Yr8TZ2uk.1KMftM7/KS/LbNWaUrXXIVMb6FiBJi2', '1000.00', 1),
(2, 'leeroy', 6, 'Leeroy', 'Jenkins', '4444444444', '69420 Valley of Strength', 'orgrimmar', 'SC', '29526', 'Leeeeeeroy@jenkins.com', '$2y$12$ZJ9UjLlaOdHr6ixYGxfZSuQsCSedMz2yQcOEQB1yhyr93/1b2hlki', '900.00', 1),
(3, 'dale', 5, 'Dale', 'Gribble', '6666666666', 'Rainey St', 'Arlen', 'TX', '29544', 'dale@gribble.com', '$2y$12$SeaN78RAC3kTOIIVN67qUOA.xtW5MxaJ61z4ZQtKpfpGFjjdO8qCa', '900.00', 1),
(7, 'thorg', 2, 'Thorg', 'Battlehammer', '7777777777', '123 Maple Street', 'Orgrimmar', 'GA', '29544', 'Thorg@Trogdor.com', '$2y$12$5puQjMsDW2xscXgkuVBsAOKFtLajgogV.CiEz/wMKqgIznaunFnri', '500.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employeetype`
--

CREATE TABLE `employeetype` (
  `employeetypekey` int NOT NULL,
  `employeetypename` varchar(50) NOT NULL,
  `employeetypedescription` varchar(255) NOT NULL,
  `employeetypepermission` varchar(40) NOT NULL,
  `defaultpay` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employeetype`
--

INSERT INTO `employeetype` (`employeetypekey`, `employeetypename`, `employeetypedescription`, `employeetypepermission`, `defaultpay`) VALUES
(1, 'General Manager', 'The top dog', '1111111111111111111111111111111111111111', '1000.00'),
(2, 'Peon', 'sug sug', '0000010000000000000000000000000000000000', '500.00'),
(5, 'Kitchen Manager', 'Gordon Ramsay up in this joint. ', '1111111111111111111111111111111111111111', '900.00'),
(6, 'FOH Manager', 'Takes all the customer complaints general scapegoat. Master apologizer', '1111111111111111111111111111111111111111', '900.00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationkey` int NOT NULL,
  `locationname` varchar(50) NOT NULL,
  `locationaddress` varchar(255) NOT NULL,
  `locationcity` varchar(50) NOT NULL,
  `locationzip` varchar(5) NOT NULL,
  `locationstate` varchar(2) NOT NULL,
  `locationphone` varchar(10) NOT NULL,
  `locationdescription` varchar(255) NOT NULL,
  `locationopen` time DEFAULT NULL,
  `locationclose` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locationkey`, `locationname`, `locationaddress`, `locationcity`, `locationzip`, `locationstate`, `locationphone`, `locationdescription`, `locationopen`, `locationclose`) VALUES
(3, 'Myrtle Beach EZ Cheesy', '7200 Ocean Blvd', 'Myrtle Beach', '29526', 'SC', '1111111111', 'test insert', '10:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `menuitemkey` int NOT NULL,
  `menutypekey` int NOT NULL,
  `menuitemname` varchar(50) NOT NULL,
  `menuitemprice` decimal(7,2) NOT NULL,
  `menuitemcount` int NOT NULL,
  `menuitemdesc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`menuitemkey`, `menutypekey`, `menuitemname`, `menuitemprice`, `menuitemcount`, `menuitemdesc`) VALUES
(14, 5, 'Coca Cola', '10.00', 0, 'Coke'),
(15, 1, 'Boneless Wings', '10.00', 998, 'Chicken Nuggets with sauce on them'),
(16, 3, 'Steak', '10.00', 1000, 'Med Rare or GTFO'),
(17, 4, 'Blondie', '10.00', 1000, 'Like a brownie but also pancake flavored'),
(18, 6, 'a single almond', '10.00', 1000, 'just one'),
(19, 7, 'Scallops', '10.00', 1000, 'Gordon Ramsay up in this joint. ');

-- --------------------------------------------------------

--
-- Table structure for table `menutype`
--

CREATE TABLE `menutype` (
  `menutypekey` int NOT NULL,
  `menutypename` varchar(50) NOT NULL,
  `menutypedescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menutype`
--

INSERT INTO `menutype` (`menutypekey`, `menutypename`, `menutypedescription`) VALUES
(1, 'Appetizer', 'These are appetizers arent they'),
(3, 'Entree', 'These are Entrees'),
(4, 'Desserts', 'These Are Desserts'),
(5, 'Drinks', 'Thirsty '),
(6, 'Sides', 'Some sides'),
(7, 'Seafood', 'its seafood from the sea');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `orderdetailkey` int NOT NULL,
  `orderkey` int NOT NULL,
  `menuitemkey` int NOT NULL,
  `orderdetailprice` decimal(7,2) NOT NULL,
  `orderdetailcomplete` int NOT NULL,
  `orderdetailnote` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `addneworderitem` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderdetailkey`, `orderkey`, `menuitemkey`, `orderdetailprice`, `orderdetailcomplete`, `orderdetailnote`, `addneworderitem`) VALUES
(134, 72, 15, '10.00', 0, NULL, NULL),
(135, 72, 15, '10.00', 0, NULL, NULL),
(136, 72, 14, '10.00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderkey` int NOT NULL,
  `customerkey` int NOT NULL,
  `orderdate` date NOT NULL,
  `ordertime` time NOT NULL,
  `locationkey` int NOT NULL,
  `ordertype` int NOT NULL,
  `tablekey` int NOT NULL,
  `employeekey` int NOT NULL,
  `ordercomplete` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderkey`, `customerkey`, `orderdate`, `ordertime`, `locationkey`, `ordertype`, `tablekey`, `employeekey`, `ordercomplete`) VALUES
(72, 2, '2021-08-15', '05:41:04', 3, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedulekey` int NOT NULL,
  `employeekey` int DEFAULT NULL,
  `schedulestart` date NOT NULL,
  `sundaystart` time DEFAULT NULL,
  `sundayend` time DEFAULT NULL,
  `mondaystart` time DEFAULT NULL,
  `mondayend` time DEFAULT NULL,
  `tuesdaystart` time DEFAULT NULL,
  `tuesdayend` time DEFAULT NULL,
  `wednesdaystart` time DEFAULT NULL,
  `wednesdayend` time DEFAULT NULL,
  `thursdaystart` time DEFAULT NULL,
  `thursdayend` time DEFAULT NULL,
  `fridaystart` time DEFAULT NULL,
  `fridayend` time DEFAULT NULL,
  `saturdaystart` time DEFAULT NULL,
  `saturdayend` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedulekey`, `employeekey`, `schedulestart`, `sundaystart`, `sundayend`, `mondaystart`, `mondayend`, `tuesdaystart`, `tuesdayend`, `wednesdaystart`, `wednesdayend`, `thursdaystart`, `thursdayend`, `fridaystart`, `fridayend`, `saturdaystart`, `saturdayend`) VALUES
(1, 3, '2021-08-08', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', NULL, NULL, NULL, NULL),
(2, 3, '2021-08-15', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', NULL, NULL),
(4, 1, '2021-08-08', NULL, NULL, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', NULL, NULL),
(5, 1, '2021-08-15', NULL, NULL, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', NULL, NULL),
(6, 2, '2021-08-08', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', NULL, NULL),
(7, 2, '2021-08-15', NULL, NULL, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', '09:00:00', '17:00:00', NULL, NULL),
(8, 7, '2021-08-15', NULL, NULL, '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', '17:00:00', '00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `tablekey` int NOT NULL,
  `locationkey` int NOT NULL,
  `tablename` varchar(50) NOT NULL,
  `tabledescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tablekey`, `locationkey`, `tablename`, `tabledescription`) VALUES
(2, 3, 'Table 22', 'Family of 3, Guy is wearing a shemagh');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `this` int NOT NULL,
  `dbfullname` varchar(255) NOT NULL,
  `dbemail` char(50) NOT NULL,
  `dbpassword` char(100) NOT NULL,
  `dbtechusername` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`this`, `dbfullname`, `dbemail`, `dbpassword`, `dbtechusername`) VALUES
(18, 'd', 'd@d.d', 'bobby', 'bobby'),
(19, 'sysadmin', 'sysadmin@mikeswebsolutions.tk', '$2y$12$smQ9Ol0XCB3MErjILdHR2.LPhXeC7ZvsV076KZT/2qnSrweroFX5K', NULL),
(20, 'q', 'q@q.q', '$2y$12$RLo2o5YQaozX8mdTKWFzxuxP9B4G2fRAkO.yAcCeUdDnSpG4tOk9.', NULL),
(21, 'roscoe bandana', 'roscoe@bandana.com', 'suck it whore', 'rband');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerkey`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeekey`);

--
-- Indexes for table `employeetype`
--
ALTER TABLE `employeetype`
  ADD PRIMARY KEY (`employeetypekey`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationkey`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`menuitemkey`);

--
-- Indexes for table `menutype`
--
ALTER TABLE `menutype`
  ADD PRIMARY KEY (`menutypekey`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`orderdetailkey`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderkey`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedulekey`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`tablekey`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`this`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerkey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeekey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employeetype`
--
ALTER TABLE `employeetype`
  MODIFY `employeetypekey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationkey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `menuitemkey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menutype`
--
ALTER TABLE `menutype`
  MODIFY `menutypekey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `orderdetailkey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderkey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedulekey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `tablekey` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `this` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
