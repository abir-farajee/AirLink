-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2020 at 05:30 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(20) NOT NULL,
  `pwd` varchar(30) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `pwd`, `name`, `email`) VALUES
('abir', 'pass1111', 'Harry Roshan', 'harryroshan1997@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` varchar(20) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `username`, `password`, `name`, `email`, `phone_no`, `address`) VALUES
('1', 'abir', '111111', 'Abir Farajee', 'aadith_email', '12345', 'aadith_address');

-- --------------------------------------------------------

--
-- Table structure for table `flight_details`
--

DROP TABLE IF EXISTS `flight_details`;
CREATE TABLE IF NOT EXISTS `flight_details` (
  `flight_no` varchar(10) NOT NULL,
  `from_city` varchar(20) DEFAULT NULL,
  `to_city` varchar(20) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `seats_economy` int(5) DEFAULT NULL,
  `seats_business` int(5) DEFAULT NULL,
  `price_economy` int(10) DEFAULT NULL,
  `price_business` int(10) DEFAULT NULL,
  `jet_id` varchar(10) NOT NULL,
  PRIMARY KEY (`flight_no`,`departure_date`),
  KEY `fk_flight_details_jet_details1_idx` (`jet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flight_details`
--

INSERT INTO `flight_details` (`flight_no`, `from_city`, `to_city`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `seats_economy`, `seats_business`, `price_economy`, `price_business`, `jet_id`) VALUES
('BM101', 'Dhaka', 'Chitagong', '2020-03-28', '2020-03-31', '00:00:00', '04:00:00', 4, 9, 2500, 3000, ''),
('BM101', 'Dhaka', 'Chitagong', '2020-04-01', '2020-04-02', '09:00:00', '32:00:00', 4, 0, 4000, 6000, '10001'),
('BM101', 'Dhaka', 'Noakhali', '2020-04-05', '2020-04-05', '09:00:00', '12:11:00', 4, 2, 2500, 4000, '10002'),
('BM102', 'Dhaka', 'Chitagong', '2020-03-28', '2020-03-29', '12:00:00', '16:00:00', 1, 5, 2500, 3000, '');

-- --------------------------------------------------------

--
-- Table structure for table `jet_details`
--

DROP TABLE IF EXISTS `jet_details`;
CREATE TABLE IF NOT EXISTS `jet_details` (
  `jet_id` varchar(10) NOT NULL,
  `jet_type` varchar(20) DEFAULT NULL,
  `total_capacity` int(5) DEFAULT NULL,
  `active` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`jet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jet_details`
--

INSERT INTO `jet_details` (`jet_id`, `jet_type`, `total_capacity`, `active`) VALUES
('10001', 'Dreamliner', 300, 'Yes'),
('10002', 'Airbus A380', 275, 'Yes'),
('10004', 'Boeing 737', 225, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `passenger_id` int(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `meal_choice` varchar(5) DEFAULT NULL,
  `ticket_id` varchar(15) NOT NULL,
  PRIMARY KEY (`passenger_id`,`ticket_id`),
  KEY `fk_passengers_ticket_details1_idx` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`passenger_id`, `name`, `age`, `gender`, `meal_choice`, `ticket_id`) VALUES
(1, 'Akram', 23, 'Male', 'yes', '4486172'),
(1, 'Akram', 23, 'Male', 'yes', '5254518'),
(1, 'abir', 23, 'Male', 'yes', '6834454'),
(2, 'abir', 22, 'Male', 'no', '4486172'),
(3, 'Nahin', 69, 'Male', 'yes', '4486172');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE IF NOT EXISTS `payment_details` (
  `payment_id` varchar(20) NOT NULL,
  `ticket_id` varchar(15) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` int(6) DEFAULT NULL,
  `payment_mode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_payment_details_ticket_details1_idx` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `ticket_id`, `payment_date`, `payment_amount`, `payment_mode`) VALUES
('358593821', '4418361', '2020-03-30', 6250, 'credit card'),
('603308617', '6834454', '2020-03-30', 2750, 'credit card'),
('814289230', '4486172', '2020-04-04', 12500, 'net banking'),
('874082472', '5254518', '2020-03-30', 3250, 'debit card');

--
-- Triggers `payment_details`
--
DROP TRIGGER IF EXISTS `update_ticket_after_payment`;
DELIMITER $$
CREATE TRIGGER `update_ticket_after_payment` AFTER INSERT ON `payment_details` FOR EACH ROW UPDATE ticket_details
     SET booking_status='CONFIRMED', payment_id= NEW.payment_id
   WHERE ticket_id = NEW.ticket_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_details`
--

DROP TABLE IF EXISTS `ticket_details`;
CREATE TABLE IF NOT EXISTS `ticket_details` (
  `ticket_id` varchar(15) NOT NULL,
  `flight_no` varchar(10) NOT NULL,
  `date_of_reservation` date DEFAULT NULL,
  `journey_date` date NOT NULL,
  `class` varchar(10) DEFAULT NULL,
  `booking_status` varchar(20) DEFAULT NULL,
  `no_of_passengers` int(5) DEFAULT NULL,
  `payment_id` varchar(45) DEFAULT NULL,
  `customer_id` varchar(20) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_ticket_details_flight_details_idx` (`flight_no`,`journey_date`),
  KEY `fk_ticket_details_customer1_idx` (`customer_id`),
  KEY `flight_no_2` (`flight_no`,`journey_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_details`
--

INSERT INTO `ticket_details` (`ticket_id`, `flight_no`, `date_of_reservation`, `journey_date`, `class`, `booking_status`, `no_of_passengers`, `payment_id`, `customer_id`) VALUES
('4418361', 'BM101', '2020-03-30', '2020-04-01', 'Business', 'CONFIRMED', 1, '358593821', '1'),
('4486172', 'BM101', '2020-04-04', '2020-04-05', 'Business', 'CONFIRMED', 3, '814289230', '1'),
('5254518', 'BM101', '2020-03-30', '2020-03-28', 'Business', 'CONFIRMED', 1, '874082472', '1'),
('6834454', 'BM102', '2020-03-30', '2020-03-28', 'Economy', 'CONFIRMED', 1, '603308617', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight_details`
--
ALTER TABLE `flight_details`
  ADD CONSTRAINT `fk_flight_details_jet_details1` FOREIGN KEY (`jet_id`) REFERENCES `jet_details` (`jet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
  ADD CONSTRAINT `fk_passengers_ticket_details1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `fk_payment_details_ticket_details1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_details` (`ticket_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ticket_details`
--
ALTER TABLE `ticket_details`
  ADD CONSTRAINT `fk_ticket_details_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ticket_details_flight_details` FOREIGN KEY (`flight_no`,`journey_date`) REFERENCES `flight_details` (`flight_no`, `departure_date`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
