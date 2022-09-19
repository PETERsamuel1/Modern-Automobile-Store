-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2021 at 06:54 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `idno` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `registered_date` varchar(20) NOT NULL,
  `profile_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `idno`, `phone`, `email`, `password`, `registered_date`, `profile_photo`) VALUES
(1, 'Peter', 'Samuel', '33466987', '0706209779', 'ptahsamuel@gmail.com', '$2y$08$cPb8KCGkt4ITUt4825Mktu7nwWCis/zPQV10Nof5TVFLFRX5WwKoe', '1613202274', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_added` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`id`, `user_id`, `product_id`, `product_quantity`, `total_amount`, `ip_address`, `status`, `date_added`) VALUES
(14, 3, 12, '1', '1', '::1', 'Unpaid', '1635952314');

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`id`, `category_name`, `status`, `date_created`) VALUES
(1, 'Sedan', 'Active', '27/08/2021'),
(2, 'Sports Car', 'Active', '27/08/2021'),
(3, 'Convertible', 'Active', '27/08/2021');

-- --------------------------------------------------------

--
-- Table structure for table `contact_table`
--

CREATE TABLE `contact_table` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_phone` varchar(100) NOT NULL,
  `contact_message` varchar(255) NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_table`
--

INSERT INTO `contact_table` (`id`, `contact_name`, `contact_email`, `contact_phone`, `contact_message`, `date_created`) VALUES
(1, 'Peter Samuel', 'ptahsamuel@gmail.com', '0706209779', 'I have not received the spare part i requested and payed', '1635943717');

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `apartment` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postcode` varchar(100) NOT NULL,
  `registered_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`id`, `firstname`, `lastname`, `phone`, `email`, `password`, `address`, `apartment`, `country`, `city`, `postcode`, `registered_date`) VALUES
(1, 'Peter', 'Samuel', '0706209770', 'fromtuk@gmail.com', '', 'Kimathi street', '', 'Kenya', 'Nairobi', '345 Nairobi', '1614593695'),
(3, 'Peter', 'Samuel', '0706209779', 'petersamuelsam6@gmail.com', '$2y$08$ttFBTZNntVMXMCqsAWsirubz.DKfc2oJWX158jaa2YJeXKehi.cPe', '339 Kitui', '', 'Kenya', 'Nairobi', '339', '1630068929'),
(4, 'ken', 'mwaniki', '07309897', 'ken@gmail.com', '$2y$08$VoN40rJGfUlntUMo/2eMWeoTx4RcNVowrX9b684jUCz8lXUmM0JLy', '', '', '', '', '', '1633004863');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_payments`
--

CREATE TABLE `mobile_payments` (
  `transLoID` int(11) NOT NULL,
  `TransactionType` varchar(10) NOT NULL,
  `TransID` varchar(10) NOT NULL,
  `TransTime` varchar(14) NOT NULL,
  `TransAmount` varchar(6) NOT NULL,
  `BusinessShortCode` varchar(6) NOT NULL,
  `BillRefNumber` varchar(6) NOT NULL,
  `InvoiceNumber` varchar(6) NOT NULL,
  `OrgAccountBalance` varchar(10) NOT NULL,
  `ThirdPartyTransID` varchar(10) NOT NULL,
  `MSISDN` varchar(14) NOT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `MiddleName` varchar(10) DEFAULT NULL,
  `LastName` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_image` varchar(455) NOT NULL,
  `price` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`id`, `category_id`, `product_name`, `product_image`, `price`, `description`, `quantity`, `status`, `date_created`) VALUES
(1, 1, 'Engine Block', '175969cylinder-block-ls-based-gm-small-block-engine-car-short-block-png-favpng-Vwxp0eUgc40GZGzuzGn4UsvKV.jpg', '35000', '6 cylinder block engine', '10', 'Active', '27/08/2021'),
(2, 1, 'Piston', '233556depositphotos_10168108-stock-photo-piston-and-conrod-3d.jpg', '6000', '8 inch piston', '78', 'Active', '27/08/2021'),
(3, 1, 'Cylinder engine block', '389536Cylinder_block_for_V6_Diesel.jpg', '41000', 'Cylinder block', '89', 'Active', '27/08/2021'),
(4, 2, 'Crankshaft', '279712crankshaft.png', '27000', 'Best crankshaft', '10', 'Active', '27/08/2021'),
(5, 3, 'Camshaft', '875914main-qimg-81a6c7813e613134d8829cf6996a6bf6.png', '17000', 'Best camshaft', '19', 'Active', '27/08/2021'),
(6, 1, 'Headlight', '736034HTB1uXj7XLvsK1Rjy0Fiq6zwtXXaS.jpg', '3200', 'Quality car headlight', '70', 'Active', '27/08/2021'),
(7, 1, 'Car tire', '992647car tire1.jpg', '7200', 'Large tracks car tire', '90', 'Active', '27/08/2021'),
(8, 1, 'Radial OTR tire', '443518car tire2.png', '4500', 'Tire Radial OTR tire GLR09', '23', 'Active', '27/08/2021'),
(10, 1, 'Car rim', '719835rim.jpg', '9500', 'Best steel rim', '67', 'Active', '27/08/2021'),
(11, 1, 'Porsche car rim', '278479rim1.png', '6700', 'Porsche car rim', '86', 'Active', '27/08/2021'),
(12, 2, 'Car rim stainless steel', '275775rim2.jpg', '1', 'Best stainless steel car rim', '87', 'Active', '27/08/2021'),
(13, 2, 'Engine part', '733723HLB1kpwvU6DpK1RjSZFrq6y78VXai.jpg', '2000', 'Best engine part', '78', 'Active', '28/08/2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartproduct_cpfk_1` (`product_id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_table`
--
ALTER TABLE `contact_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_payments`
--
ALTER TABLE `mobile_payments`
  ADD PRIMARY KEY (`transLoID`),
  ADD UNIQUE KEY `TransID` (`TransID`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_table_cifk_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_table`
--
ALTER TABLE `contact_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mobile_payments`
--
ALTER TABLE `mobile_payments`
  MODIFY `transLoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD CONSTRAINT `cartproduct_cpfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`id`);

--
-- Constraints for table `product_table`
--
ALTER TABLE `product_table`
  ADD CONSTRAINT `product_table_cifk_1` FOREIGN KEY (`category_id`) REFERENCES `category_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
