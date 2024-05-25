-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 03:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifood`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemName` varchar(50) NOT NULL,
  `ItemPrice` int(11) NOT NULL,
  `ItemQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemName`, `ItemPrice`, `ItemQuantity`) VALUES
('Burger', 30, 20),
('Dessert', 15, 20),
('flafel', 5, 20),
('Healthy Lunch', 20, 20),
('Hummus', 10, 20),
('Kabsa', 60, 20),
('Pasta', 20, 20),
('Pizza', 25, 12),
('Shawerma', 25, 20),
('Spaghetti', 22, 20),
('Steak', 50, 20),
('Strawberry Desserts', 18, 20);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderNumber` int(10) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `serialoi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderNumber`, `ItemName`, `Quantity`, `serialoi`) VALUES
(9, 'Burger', 4, 15),
(9, 'Pizza', 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `CustomerName` varchar(50) NOT NULL,
  `Total` int(11) NOT NULL,
  `serialo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`CustomerName`, `Total`, `serialo`) VALUES
('najjar24', 170, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `UserLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserName`, `Password`, `FullName`, `PhoneNumber`, `UserLevel`) VALUES
('ali74', '$2y$10$rAo9msBrBHOntpj0VgEzpumGoXBfaze0gShdqCQjYodtIEAzBP5Qu', 'Ali Samara', '0599456789', 1),
('anwar65', '$2y$10$D.TQgnRpr9La9i12zc1Teej89dtuvvnTUtZMipTEQAZs3MPVBhGZO', 'Mohammad Anwar', '0597123456', 2),
('hamad77', '$2y$10$GGvB.S8gA43BG3eCx.yGKunuci8XXM1CkTDH3V.exlthqLw8dE4Nu', 'Hamad Ahmad', '0599666444', 1),
('najjar24', '$2y$10$SIngK9rfImkrvk1NXT2QSe7joJ8RDJUsME9VJzsZ0roaVle86aLWe', 'Mohammad Najjar', '0569123456', 1),
('yaseen87', '$2y$10$5cPM5Lh52kJ81LFaTMymDe6vmvbrjg2UmizvFRlwDRuZcxSrpcW3W', 'Qassam Yaseen', '0599111111', 2),
('yazeed', '$2y$10$NVpIqc3PQUFQFYKyiSgV/uHGs5sKBthepFMKySy/9jUi5sQ1QuQHa', 'Yazeed Shami', '0599111777', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemName`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`serialoi`),
  ADD KEY `NameOfItem` (`ItemName`),
  ADD KEY `NumberOfOrder` (`OrderNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`serialo`),
  ADD KEY `CustomerIsUser` (`CustomerName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `serialoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `serialo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `NameOfItem` FOREIGN KEY (`ItemName`) REFERENCES `items` (`ItemName`),
  ADD CONSTRAINT `NumberOfOrder` FOREIGN KEY (`OrderNumber`) REFERENCES `orders` (`serialo`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `CustomerIsUser` FOREIGN KEY (`CustomerName`) REFERENCES `users` (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
