-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 07:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `discount` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `image`, `quantity`, `discount`) VALUES
(159, 1, '------- FOOD BUNDLE B -------Mushroom Pizza, Margherita Pizza, Overload Pizza, 2 Large Merca Fries, Merca Bucket Meal & 1.5L of Coke\r\n', '1970', 'foodbundleB.png', 1, '0.20');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employeenumber` varchar(255) NOT NULL,
  `employeename` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `civilstatus` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `employeestatus` varchar(255) NOT NULL,
  `picture` text NOT NULL,
  `contactnumber` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` varchar(20) NOT NULL,
  `paydate` date DEFAULT NULL,
  `dependent` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employeenumber`, `employeename`, `gender`, `birthdate`, `nationality`, `civilstatus`, `department`, `designation`, `employeestatus`, `picture`, `contactnumber`, `email`, `age`, `paydate`, `dependent`) VALUES
(1, '1234', 'Lopits  n/a Quillopo', 'Gender', '2000-01-05', 'Filipino', 'Single', 'DCS', 'Computer Science', 'Employed', 'WIN_20221204_23_02_04_Pro.jpg', '09989291436', 'enriquejr.quillopo@gmail.com', '22', '2022-12-03', '2a'),
(2, '201910582', 'Im Nayeon Quillopo', 'Gender', '2000-11-21', 'Filipino', 'Single', 'DCS', 'Information Technology', 'Employed', 'nabong.jpg', '09366946652', 'quillopoenrique@gmail.com', '22', '2022-10-05', NULL),
(6, '5', 'asdas a asdasd', 'male', '2000-02-02', 'Filipino', 'Single', 'DCS', 'Computer Science', 'Employed', 'jehyu.jpg', '09366946652', 'merca@herrhr', '22', NULL, '2a'),
(7, '12345', 'Angelica Joy N/A Glory', 'female', '2001-02-07', 'Filipino', 'Single', 'DCS', 'Instructor', 'Employed', 'author-2.jpg', '09989291436', 'enriquejr.quillopo@cvsu.edu.ph', '21', NULL, '3a');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(200) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `fname`, `lname`, `age`, `username`, `email`, `pass`, `usertype`) VALUES
(9, 'Mark', 'Dado', 22, 'cashier1@merca', 'cashier1@merca.com', 'cashier1!', 'cashier1'),
(10, 'Enrique', 'Quillopo', 22, 'hr@merca', 'hr@merca.com', 'hrmerca1!', 'hr'),
(11, 'Christian', 'Acedillo', 22, 'cashier2@merca', 'cashier2@merca.com', 'cashier2!', 'cashier2'),
(12, 'Arthur', 'Morgan', 34, 'superadmin@merca', 'superadmin@merca.com', 'superadmin1!', 'superadmin'),
(13, 'Lopits', 'Quillopo', 18, 'enriquejr.quillopo', 'enriquejr.eq@gmail.com', 'Lopits1!', 'hr');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `employeeid_fk` int(11) NOT NULL,
  `basicincome` float NOT NULL,
  `honorarium` float NOT NULL,
  `otherincome` float NOT NULL,
  `grossincome` float NOT NULL,
  `netincome` float NOT NULL,
  `totaldeduction` float NOT NULL,
  `sss` float NOT NULL,
  `philhealth` float NOT NULL,
  `pagibig` float NOT NULL,
  `tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `employeeid_fk`, `basicincome`, `honorarium`, `otherincome`, `grossincome`, `netincome`, `totaldeduction`, `sss`, `philhealth`, `pagibig`, `tax`) VALUES
(1, 1, 18450, 3075, 15129, 36654, 28464.7, 8189.26, 1125, 1466.16, 100, 0),
(2, 1, 4500, 900, 900, 6300, 5340.5, 959.5, 292.5, 252, 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `discount` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `discount`) VALUES
(1, '------- FOOD BUNDLE A -------Classic Pizza, Ham & Cheese Pizza, Pepperoni Pizza, 2 Large Merca Fries, Merca Bucket Meal & 1.5L of Coke\r\n', '1580', 'foodbundleA.png', '0.20'),
(2, '------- FOOD BUNDLE B -------Mushroom Pizza, Margherita Pizza, Overload Pizza, 2 Large Merca Fries, Merca Bucket Meal & 1.5L of Coke\r\n', '1970', 'foodbundleB.png', '0.20'),
(3, '------- FOOD BUNDLE C -------Veggie Pizza, Hawaiian Pizza, Supreme Pizza, 2 Large Merca Fries, Merca Bucket Meal & 1.5L of Coke\r\n', '2170', 'foodbundleC.png', '0.20'),
(4, 'Classic Pizza', '200', 'product1.png', '0.00'),
(5, 'Ham and Cheese', '250', 'product2.png', '0.00'),
(6, 'Pepperoni', '300', 'product3.png', '0.00'),
(7, 'Mushroom Pizza', '320', 'product4.png', '0.00'),
(8, 'Margherita Pizza', '370', 'product5.png', '0.00'),
(9, 'Overload Pizza', '450', 'product6.png', '0.00'),
(10, 'Veggie Pizza', '340', 'product7.png', '0.00'),
(11, 'Hawaiian Pizza', '400', 'product8.png', '0.00'),
(12, 'Supreme Pizza', '600', 'product9.png', '0.00'),
(13, 'Merca Fries (L)', '75', 'fries.png', '0.00'),
(14, 'Merca Bucket Meal', '600', 'bucketmeal.png', '0.00'),
(15, 'Coke 1.5 L', '80', 'coke.png', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_pos_a`
--

CREATE TABLE `sales_pos_a` (
  `SalesNumber` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DiscountAmount` int(11) NOT NULL,
  `DiscountedAmount` int(11) NOT NULL,
  `CashFromCustomer` int(11) NOT NULL,
  `ChangeToTheCustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_pos_a`
--

INSERT INTO `sales_pos_a` (`SalesNumber`, `ItemName`, `Price`, `Quantity`, `DiscountAmount`, `DiscountedAmount`, `CashFromCustomer`, `ChangeToTheCustomer`) VALUES
(1, 'bacon cheese', 500, 1, 50, 450, 500, 50),
(2, 'Hawaiian supreme', 600, 1, 75, 525, 550, 25);

-- --------------------------------------------------------

--
-- Table structure for table `sales_pos_b`
--

CREATE TABLE `sales_pos_b` (
  `SalesNumber` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DiscountAmount` int(11) NOT NULL,
  `DiscountedAmount` int(11) NOT NULL,
  `TotalQuantity` int(11) NOT NULL,
  `TotalDiscountGiven` int(11) NOT NULL,
  `TotalDiscountedAmount` int(11) NOT NULL,
  `CashFromCustomer` int(11) NOT NULL,
  `ChangeToTheCustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_pos_b`
--

INSERT INTO `sales_pos_b` (`SalesNumber`, `ItemName`, `Price`, `Quantity`, `DiscountAmount`, `DiscountedAmount`, `TotalQuantity`, `TotalDiscountGiven`, `TotalDiscountedAmount`, `CashFromCustomer`, `ChangeToTheCustomer`) VALUES
(1, 'pepperoni', 350, 1, 30, 320, 1, 30, 320, 500, 180),
(2, 'vegetarian supreme', 550, 1, 50, 500, 1, 50, 500, 500, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `emp_idfk` (`employeeid_fk`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_pos_a`
--
ALTER TABLE `sales_pos_a`
  ADD PRIMARY KEY (`SalesNumber`);

--
-- Indexes for table `sales_pos_b`
--
ALTER TABLE `sales_pos_b`
  ADD PRIMARY KEY (`SalesNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales_pos_a`
--
ALTER TABLE `sales_pos_a`
  MODIFY `SalesNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_pos_b`
--
ALTER TABLE `sales_pos_b`
  MODIFY `SalesNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
