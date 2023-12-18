-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2023 at 11:22 AM
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
-- Database: `jaflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

-- Create Farmer Table
CREATE TABLE Farmer (
    'farm_id' SERIAL,
    'farm_name' CHAR(50) NOT NULL,
    'rice_type' CHAR(20) NOT NULL,
    'rice_price' FLOAT NOT NULL
    -- Add other attributes as needed
);
-- Create Factory Table
CREATE TABLE factory (
    farm_id INT NOT NULL,
    order_id INT NOT NULL,
    expected_delivery DATE NOT NULL,
    status VARCHAR(20),
);

-- Create Customer Table
CREATE TABLE Customer (
    order_id SERIAL,
    customer_name VARCHAR(50) NOT NULL,
    ordered_rice_type CHAR(20) NOT NULL,
    customer_address VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    date_ordered DATE NOT NULL,
    PRIMARY KEY (order_id)
    -- Add other attributes as needed
);

-- Create Delivery Table
CREATE TABLE Delivery (
    delivery_driver_id SERIAL NOT NULL,
    delivery_status VARCHAR (20) ,
    order_id INT NOT NULL,
    PRIMARY KEY (delivery_driver_id)
    -- Add other attributes as needed
);

-- Add Foreign Key Constraint to Factory Table
ALTER TABLE factory
ADD CONSTRAINT fk_factory_farm_id FOREIGN KEY (farm_id) REFERENCES Farmer(farmer_id);

DELIMITER //
CREATE TRIGGER insert_factory_trigger
AFTER INSERT ON customer
FOR EACH ROW
BEGIN
  INSERT INTO factory (order_id) VALUES (NEW.order_id);
END;
//
DELIMITER ;

DELIMITER //

CREATE TRIGGER update_factory_delivery_trigger
AFTER UPDATE ON Factory
FOR EACH ROW
BEGIN
  IF NEW.delivery_status = 'Sent' AND OLD.delivery_status != 'Sent' THEN
    INSERT INTO Delivery (delivery_id)
    VALUES (NEW.delivery_id);
  END IF;
END;
//
DELIMITER ;

DROP TRIGGER old_insert_factory_trigger;






CREATE TABLE `members` (
  `UID` int(11) NOT NULL,
  `email` char(30) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `BirthYear` decimal(4,0) DEFAULT NULL,
  `SubscriptionYear` decimal(4,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`UID`, `email`, `Gender`, `BirthYear`, `SubscriptionYear`) VALUES
(100, 'purina@gmail.com', 'F', 2001, 2017),
(101, 'richy107@hotmail.com', 'F', 1980, 2018),
(102, 'Alex1999@yahoo.com', 'M', 1999, 2018),
(103, 'TomJones777@gmail.com', 'M', 2003, 2019);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`UID`);
ALTER TABLE `Farmer`
  ADD PRIMARY KEY (`farm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
