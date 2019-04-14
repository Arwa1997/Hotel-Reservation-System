-- phpMyAdmin SQL Dump

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `rating` int(5) DEFAULT NULL,
  `blacklisted` tinyint(1) NOT NULL,
  `black_list_start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Stars` int(5) NOT NULL,
  `image` varchar(255) DEFAULT NULL COMMENT 'here we save the image path',
  `Approved` tinyint(1) NOT NULL DEFAULT '0',
  `amount_owed` decimal(10,2) NOT NULL COMMENT 'amount owed by the hotel to the broker',
  `amound_paid` decimal(10,2) NOT NULL COMMENT 'amound paid to the broker per month',
  `suspended` tinyint(1) NOT NULL,
  `activation_start_date` date NOT NULL,
  `premium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `password`, `Location`, `Stars`, `image`, `Approved`, `amount_owed`, `amound_paid`, `suspended`, `activation_start_date`, `premium`) VALUES
(20, 'Raw7eya', 202, '123 Avenue St.', 3, 'ownerbg.jpg', 1, '0.00', '0.00', 0, '0000-00-00', 0),
(21, 'Fat7eya', 202, '123 Avenue St.', 3, 'background.jpg', 1, '0.00', '0.00', 0, '0000-00-00', 0),
(22, 'Arwa', 202, '123 Avenue St.', 2, 'guestbg.jpg', 1, '0.00', '0.00', 0, '0000-00-00', 0),
(23, 'Ashgan', 202, '123 Avenue St.', 5, 'guestbg.jpg', 1, '0.00', '0.00', 0, '0000-00-00', 0),
(24, 'Sami', 202, '123 Avenue St.', 3, 'ownerbg.jpg', 1, '0.00', '0.00', 0, '0000-00-00', 0),
(25, 'Lobna', 202, '123 Avenue St.', 4, 'background.jpg', 0, '0.00', '0.00', 0, '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `number` bigint(20) NOT NULL,
  `guestID` int(11) NOT NULL,
  `roomType` varchar(50) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date DEFAULT NULL,
  `hotelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roomss`
--

CREATE TABLE `roomss` (
  `roomType` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `noOfRooms` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `hotelID` int(11) NOT NULL,
  `facilitieis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomss`
--

INSERT INTO `roomss` (`roomType`, `price`, `noOfRooms`, `image`, `hotelID`, `facilitieis`) VALUES
(1, '0', 12, '', 24, ''),
(1, '0', 12, '', 24, ''),
(2, '0', 14, '', 24, ''),
(2, '0', 14, '', 24, ''),
(3, '0', 13, '', 24, ''),
(3, '0', 14, '', 24, ''),
(3, '0', 14, '', 24, ''),
(1, '0', 14, '', 24, ''),
(2, '0', 12, '', 24, ''),
(1, '0', 1, '', 24, ''),
(1, '0', 1, '', 24, ''),
(1, '0', 15, '', 24, ''),
(1, '0', 15, '', 24, ''),
(2, '0', 1, '', 24, ''),
(1, '0', 15, '', 22, ''),
(1, '0', 15, '', 22, ''),
(1, '0', 15, '', 22, ''),
(2, '0', 12, '', 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`TypeID`, `TypeName`) VALUES
(1, 'Single'),
(2, 'Double'),
(3, 'Triple');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`number`),
  ADD KEY `FK1` (`roomType`),
  ADD KEY `FK2` (`guestID`),
  ADD KEY `FK3` (`hotelID`);

--
-- Indexes for table `roomss`
--
ALTER TABLE `roomss`
  ADD KEY `roomType` (`roomType`),
  ADD KEY `hotelID` (`hotelID`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `number` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`roomType`) REFERENCES `rooms` (`roomType`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`guestID`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `FK3` FOREIGN KEY (`hotelID`) REFERENCES `hotel` (`id`);

--
-- Constraints for table `roomss`
--
ALTER TABLE `roomss`
  ADD CONSTRAINT `roomss_ibfk_1` FOREIGN KEY (`roomType`) REFERENCES `roomtype` (`TypeID`),
  ADD CONSTRAINT `roomss_ibfk_2` FOREIGN KEY (`hotelID`) REFERENCES `hotel` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
