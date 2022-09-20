-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 09:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `customer_username` varchar(250) NOT NULL,
  `customer_email` varchar(250) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_username`, `customer_email`, `customer_password`, `customer_address`) VALUES
(20, 'admin', 'admin', 'admin@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', ''),
(30, 'Stefan Samardzic', 'stefan6', 'stefan@gmail.com', '$2y$10$v7qneMyVumekJQX/VxYWmeY7WmD5Dimydyx.1uSiD8hY/wT2jyxMC', 'Francuska 1'),
(31, 'Stefan Samardzic', 'stefan187', 'stefan187@gmail.com', '$2y$10$jXc.z4um1wBzqnr9Tj9ace9/9Zv5Pf7JAmlJTOt53LK6OpkdT.jj.', 'Narodnih heroja 12'),
(35, 'Stefan Samardzic', 'stefan00', 'stefan00@gmail.com', '$2y$10$rplQureWfUAUQt/BMoljj.JGjUNVwmIGJSx5B3ZtXcm8mJyGgFxXq', 'Francuska 1'),
(37, 'Nikola Nikolic', 'nikola1', 'nikola@gmail.com', '$2y$10$jz2lf1Me9vJKFOb.3GFlleVP4HG3dN.b0TvD.Mj76iE84Y2f8EzhC', 'Beogradska 15'),
(39, 'John Doe', 'johndoe1', 'johndoe1@yahoo.com', '$2y$10$nir7joJmgpAAsxU2VO2oK.R1aflETgMhgGl54yMRM3fq.UnQRMsl.', 'Omladinskih brigada 38'),
(40, 'Marko Markovic', 'marko1', 'marko@gmail.com', '$2y$10$AxGbJsWZZtCfrc0hZNDzoOVQKWs6Xe4iMbnR8Sarh5bWhuC3zCfgm', 'Obalskih radnika 2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `apartment` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment` varchar(4) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `grand_total`, `address`, `apartment`, `email`, `phone`, `payment`, `created`, `status`) VALUES
(20, 30, 40.09, 'narodnih heroja 12', 0, '', '', 'cash', '2022-08-19 22:50:23', 'Delivered'),
(21, 30, 80.18, 'narodnih heroja 12', 0, '', '', 'cash', '2022-08-19 22:50:48', 'Delivered'),
(23, 30, 120.80, 'narodnih heroja 12', 0, '', '', 'cash', '2022-08-19 23:00:22', 'Delivered'),
(24, 31, 19.85, 'narodnih heroja 12', 0, '', '', 'cash', '2022-08-22 01:42:51', 'On the way'),
(25, 31, 20.24, 'narodnih heroja 12', 2, '', '', 'card', '2022-08-22 01:44:04', 'On the way'),
(72, 30, 21.35, 'narodnih heroja 12', 0, '', '', 'card', '2022-09-03 12:12:45', 'Pending'),
(73, 30, 21.35, 'narodnih heroja 12', 0, '', '', 'card', '2022-09-03 12:16:27', 'Pending'),
(74, 30, 21.35, 'narodnih heroja 12', 1, '', '', 'card', '2022-09-03 12:16:40', 'Pending'),
(75, 30, 21.35, 'narodnih heroja 12', 1, '', '', 'cash', '2022-09-03 12:16:43', 'Pending'),
(78, 30, 25.10, 'narodnih heroja 12', 11, '', '', 'cash', '2022-09-07 21:41:44', 'Pending'),
(85, 35, 20.15, 'Francuska 2', 3, '', '+381 69 585-7757', 'cash', '2022-09-09 17:10:49', 'Pending'),
(86, 30, 20.15, 'adresa 1', 0, 'samardzicstefan6@gmail.com', '', 'card', '2022-09-10 15:55:08', 'Pending'),
(87, 30, 31.60, 'adresa 1', 12, 'samardzicstefan6@gmail.com', '', 'cash', '2022-09-10 15:56:24', 'Pending'),
(89, 31, 50.20, 'Omladinskih brigada 38', 2, 'stefan187@gmail.com', '+381 69 585-7757', 'card', '2022-09-10 16:06:38', 'Pending'),
(90, 35, 21.35, 'Francuska 1', 1, 'stefan00@gmail.com', '+381 69 585-7757', 'card', '2022-09-10 16:11:20', 'On the way'),
(91, 31, 40.20, 'narodnih heroja 12', 1, 'stefan187@gmail.com', '+381 69 585-7757', 'card', '2022-09-16 12:09:56', 'Pending'),
(92, 31, 13.35, 'narodnih heroja 12', 1, 'stefan187@gmail.com', '+381 69 585-7757', 'card', '2022-09-16 12:10:35', 'Pending'),
(93, 31, 20.15, 'narodnih heroja 12', 1, 'stefan187@gmail.com', '+381 69 585-7757', 'cash', '2022-09-16 12:11:34', 'Pending'),
(101, 30, 40.30, 'Francuska 2', 0, 'samardzicstefan6@gmail.com', '', 'card', '2022-09-16 19:28:53', 'Pending'),
(103, 35, 18.25, 'Francuska 1', 1, 'stefan00@gmail.com', '+381 69 585-7757', 'cash', '2022-09-17 16:04:12', 'Pending'),
(105, 31, 13.35, 'narodnih heroja 12', 12, 'stefan187@gmail.com', '+381 69 585-7757', 'cash', '2022-09-17 16:06:44', 'Pending'),
(106, 31, 20.10, 'Narodnih heroja 12', 12, 'stefan187@gmail.com', '+381 69 585-7757', 'card', '2022-09-17 16:11:02', 'Pending'),
(109, 35, 13.35, 'Francuska 1', 0, 'stefan00@gmail.com', '', 'card', '2022-09-17 16:16:00', 'Pending'),
(111, 35, 25.10, 'Francuska 1', 0, 'stefan00@gmail.com', '', 'cash', '2022-09-17 16:17:03', 'Pending'),
(114, 35, 20.15, 'Francuska 1', 0, 'stefan00@gmail.com', '', 'cash', '2022-09-17 16:26:52', 'Pending'),
(116, 35, 33.50, 'Francuska 1', 0, 'stefan00@gmail.com', '', 'cash', '2022-09-17 16:32:30', 'Pending'),
(117, 35, 33.50, 'Francuska 1', 0, 'stefan00@gmail.com', '', 'cash', '2022-09-17 16:34:33', 'Pending'),
(118, 39, 20.15, 'Omladinskih brigada 38', 11, 'johndoe1@yahoo.com', '', 'card', '2022-09-17 16:39:03', 'Delivered'),
(124, 39, 20.15, 'Omladinskih brigada 38', 3, 'johndoe1@yahoo.com', '+381 69 585-7757', 'card', '2022-09-17 16:47:58', 'Delivered'),
(126, 39, 19.85, 'Omladinskih brigada 38', 0, 'johndoe1@yahoo.com', '', 'card', '2022-09-17 16:51:20', 'Pending'),
(128, 39, 20.10, 'Omladinskih brigada 38', 0, 'johndoe1@yahoo.com', '', 'cash', '2022-09-17 16:57:54', 'Pending'),
(129, 40, 19.85, 'Obalskih radnika 2', 0, 'marko@gmail.com', '', 'cash', '2022-09-17 16:59:17', 'Pending'),
(130, 35, 19.40, 'Omladinskih brigada 3', 12, 'stefan00@gmail.com', '', 'cash', '2022-09-18 12:38:39', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(7, 20, 1, 1),
(8, 20, 10, 1),
(9, 21, 1, 2),
(10, 21, 10, 2),
(11, 23, 9, 2),
(12, 23, 13, 2),
(13, 23, 9, 2),
(14, 24, 10, 1),
(15, 25, 1, 1),
(65, 73, 1, 1),
(66, 74, 1, 1),
(67, 75, 1, 1),
(69, 78, 15, 1),
(76, 85, 9, 1),
(77, 86, 9, 1),
(78, 87, 19, 1),
(79, 87, 23, 1),
(81, 89, 15, 2),
(82, 90, 1, 1),
(83, 91, 13, 2),
(84, 92, 19, 1),
(85, 93, 9, 1),
(93, 101, 9, 2),
(95, 103, 23, 1),
(97, 105, 18, 1),
(98, 106, 13, 1),
(101, 109, 19, 1),
(103, 111, 15, 1),
(106, 114, 9, 1),
(108, 116, 14, 1),
(109, 116, 18, 1),
(110, 117, 14, 1),
(111, 118, 14, 1),
(117, 124, 14, 1),
(119, 126, 10, 1),
(121, 128, 13, 1),
(122, 129, 10, 1),
(123, 130, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `product_category` varchar(250) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_category`, `product_description`, `product_price`) VALUES
(1, 'Cheeseburger', 'cheeseburger.png', 'Burgers', 'Beef, ketchup, mustard, pickles, onions', 21.35),
(9, 'Diavola', 'pepperonipizza.jpg', 'Pizzas', 'Pepperoni, cheese', 20.15),
(10, 'Capricciosa', 'capricciosa.jpg', 'Pizzas', 'Ham, cheese, mushrooms', 19.85),
(13, 'Chicken burger', 'chickenburger.PNG', 'Burgers', 'Chicken, lettuce, tomatoes, mayo', 20.1),
(14, 'Caesar salad', 'caesar-salad.jpg', 'Salads', 'Chicken, iceberg, tomatoes, croutons, cheese', 20.15),
(15, 'Stake salad', 'stake-salad.jpg', 'Salads', 'Beef stake, baby spinach, cherry tomatoes, orient dressing', 25.1),
(18, 'Ferrero cake', 'ferrero.jpg', 'Cakes', 'Hazel mousse, chocolate', 13.35),
(19, 'Kinder cake', 'kinder-bueno.jpg', 'Cakes', 'Choco brownie, bueno mousse', 13.35),
(23, 'Cheesecake', 'cheesecake.jpg', 'Cakes', 'Granola biscuit, mascarpone cheese, strawberry topping', 18.25),
(24, 'Turkey burger', 'turkey-burger.jpg', 'Burgers', 'Turkey, mayo, mustard, arugula, tomato, onion, cucumber', 19.4),
(25, 'Margherita', 'margherita.jpg', 'Pizzas', 'Tomato sauce, mozzarella', 18.15),
(26, 'Salmon salad', 'salmon-salad.jpg', 'Salads', 'Salmon, zucchini, baby salad mix, greek yoghurt dressing', 21.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
