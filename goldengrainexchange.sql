-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2023 at 05:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goldengrainexchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `completed_orders`
--

CREATE TABLE `completed_orders` (
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `ordered_rice_type` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `ordered_rice_type` char(20) NOT NULL,
  `customer_address` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_ordered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `customer`
--
DELIMITER $$
CREATE TRIGGER `insert_factory_trigger` AFTER INSERT ON `customer` FOR EACH ROW BEGIN
  -- Insert into factory to get a factory_id
  INSERT INTO factory (order_id) VALUES (NEW.order_id);

  -- Insert into delivery with the same order_id
  INSERT INTO delivery (order_id) VALUES (NEW.order_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_status` varchar(20) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Triggers `delivery`
--
DELIMITER $$
CREATE TRIGGER `delivery_status_trigger` AFTER UPDATE ON `delivery` FOR EACH ROW BEGIN
    IF NEW.delivery_status = 'Delivered' THEN
        INSERT INTO completed_orders (delivery_id, customer_name, ordered_rice_type, quantity)
        SELECT NEW.delivery_id, c.customer_name, c.ordered_rice_type, c.quantity
        FROM customer c
        WHERE c.order_id = NEW.order_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `factory`
--

CREATE TABLE `factory` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `expected_delivery` date NOT NULL,
  `delivery_status` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `farmer`
--

CREATE TABLE `farmer` (
  `listing_id` bigint(20) UNSIGNED NOT NULL,
  `farm_name` char(50) NOT NULL,
  `rice_type` char(20) NOT NULL,
  `rice_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `farmer`
--

INSERT INTO `farmer` (`listing_id`, `farm_name`, `rice_type`, `rice_price`) VALUES
(19, 'Kris rice farm', 'Jasmine rice', 6.99),
(21, 'Enzo benz farm', 'Sticky rice', 11.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `fk_delivery_order_id` (`order_id`);

--
-- Indexes for table `factory`
--
ALTER TABLE `factory`
  ADD KEY `fk_factory_order_id` (`order_id`);

--
-- Indexes for table `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`listing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `farmer`
--
ALTER TABLE `farmer`
  MODIFY `listing_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `fk_delivery_order_id` FOREIGN KEY (`order_id`) REFERENCES `customer` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `factory`
--
ALTER TABLE `factory`
  ADD CONSTRAINT `fk_factory_order_id` FOREIGN KEY (`order_id`) REFERENCES `customer` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
