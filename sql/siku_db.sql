-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 05:27 AM
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
-- Database: `siku_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `total_price` float(6,2) NOT NULL DEFAULT 0.00,
  `order_status` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `email`, `address`, `address2`, `country`, `state`, `zipcode`, `total_price`, `order_status`, `created_at`, `updated_at`) VALUES
(4, '3refdw', 'tred', 'tredw@trial.com', 'trfew', 'trfew', 'United States', 'California', '5321', 19.00, 'confirmed', '2023-06-10 05:23:47', '2023-06-10 05:23:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` float(6,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `qty`, `total_price`) VALUES
(4, 4, 1, 'Beany bed', 9.50, 1, 9.50),
(5, 4, 2, 'Blue T-shirt', 9.50, 1, 9.50);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `full_description` text DEFAULT NULL,
  `price` double(4,2) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_slug`, `short_description`, `full_description`, `price`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Beany bed', 'bed', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 9.50, 0, 1, '2023-06-05 22:02:17', '2023-06-05 22:02:21'),
(2, 'keeple chair', 'chair', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 9.50, 0, 1, '2023-06-05 22:02:50', '2023-06-05 22:02:53'),
(3, 'flap table', 'table', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 9.50, 0, 1, '2023-06-05 22:03:21', '2023-06-05 22:03:24'),
(4, 'sicle shelf', 'shelf', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis omnis suscipit esse ipsam officia. Quis sint nihil magnam explicabo veniam hic. Vitae nam iusto reiciendis ratione sed suscipit, aspernatur repudiandae.', 9.50, 0, 1, '2023-06-05 22:03:50', '2023-06-05 22:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img`, `display_order`, `is_featured`) VALUES
(1, 1, 'Frame-22.svg', 1, 1),
(2, 1, 'Frame-1753.svg', 2, 0),
(3, 1, 'Frame-1754.svg', 3, 0),
(4, 1, 'Frame-1755.svg', 4, 0),
(5, 2, 'Frame-1758.svg', 1, 1),
(6, 2, 'Frame-1760.svg', 2, 0),
(7, 3, 'Frame-1768.svg', 1, 1),
(8, 4, 'Frame-1775.svg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 16:21:51', '02-06-2023 08:47:38 PM', 0),
(25, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 16:22:07', NULL, 0),
(26, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 16:22:47', NULL, 0),
(27, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 19:16:27', NULL, 1),
(28, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 19:18:24', NULL, 1),
(29, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 19:29:55', NULL, 1),
(30, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 19:56:26', '02-06-2023 08:56:39 PM', 1),
(31, 'amykamsi@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-02 19:58:05', NULL, 1),
(32, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 15:57:10', NULL, 0),
(33, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 15:57:16', '07-06-2023 10:07:51 AM', 0),
(34, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 15:57:27', '06-06-2023 05:00:05 PM', 1),
(35, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:06:59', '06-06-2023 05:07:26 PM', 1),
(36, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:13:52', '06-06-2023 05:14:01 PM', 1),
(37, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:22:54', NULL, 1),
(38, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:23:12', NULL, 1),
(39, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:24:43', NULL, 1),
(40, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:25:20', '06-06-2023 05:25:28 PM', 1),
(41, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:31:15', NULL, 1),
(42, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:40:03', NULL, 1),
(43, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:42:06', '06-06-2023 05:42:16 PM', 1),
(44, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 16:43:05', '06-06-2023 05:43:12 PM', 1),
(45, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 17:30:01', NULL, 1),
(46, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-06 17:40:33', NULL, 1),
(47, 'testm', 0x3a3a3100000000000000000000000000, '2023-06-07 06:41:11', NULL, 0),
(48, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-07 06:41:27', NULL, 1),
(49, 'anuj.lpu1@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-07 09:07:57', NULL, 0),
(50, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-07 09:08:12', NULL, 1),
(51, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-08 20:33:55', NULL, 1),
(52, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-09 21:18:50', NULL, 1),
(53, 'testmail@gmail.com', 0x3a3a3100000000000000000000000000, '2023-06-10 02:32:25', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` longtext DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `billingAddress` longtext DEFAULT NULL,
  `billingState` varchar(255) DEFAULT NULL,
  `billingCity` varchar(255) DEFAULT NULL,
  `billingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contactno`, `password`, `shippingAddress`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingState`, `billingCity`, `billingPincode`, `regDate`, `updationDate`) VALUES
(1, 'Amy Kamsi', 'amykamsi@gmail.com', 8092345617, 'usertest', 'Ikeja, Lagos', 'Lagos', 'Lagos', 220033, 'Ikeja Lagos', 'Lagos State', 'Ikeja', 220233, '2023-06-02 16:06:04', '06/02/2023 05:05 PM'),
(2, 'hgfwd', 'amykamsi@gmail.com', 9994857754988887, 'a6105c0a611b41b08f1209506350279e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 16:44:27', NULL),
(4, 'Amy Kamsi', 'amykamsi@gmail.com', 654327654876, 'a6105c0a611b41b08f1209506350279e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 19:02:52', NULL),
(5, 'Amy Kamsi', 'amykamsir@gmail.com', 2345678923, 'a6105c0a611b41b08f1209506350279e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02 19:15:49', NULL),
(6, 'This name', 'testmail@gmail.com', 12345678999, 'c1ec646da9fc9f665cf1edb86824979d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-06 15:55:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
