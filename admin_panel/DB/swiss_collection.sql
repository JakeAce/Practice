-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 11:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swiss_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `preferred_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `service`, `preferred_date`, `created_at`) VALUES
(1, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:34:09'),
(2, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:35:50'),
(3, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:39:41'),
(4, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:40:03'),
(5, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:40:37'),
(6, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:41:40'),
(7, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:42:18'),
(8, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:42:50'),
(9, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:43:05'),
(10, 'jake', 'aa@gmail.com', 'Local Hardware Store', '2222-09-29', '2025-05-23 11:46:45'),
(11, 'goerge', 'lope98@gmail.com', 'Online Retailers (Amazon, eBay)', '5555-05-05', '2025-05-23 11:50:10'),
(12, 'goerge', 'lope98@gmail.com', 'Online Retailers (Amazon, eBay)', '5555-05-05', '2025-05-23 11:54:15'),
(13, 'jag', 'dd@gmail.com', 'Online Retailers (Amazon, eBay)', '2222-02-22', '2025-05-23 11:54:53'),
(14, 'jake', 'jake@gmail.com', 'Online Retailers (Amazon, eBay)', '0000-00-00', '2025-05-23 21:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Crowfoot Wrench Set'),
(2, 'Ratcheting Wrench Set'),
(10, 'Wrenches'),
(11, 'Socket Set'),
(12, 'Pliers'),
(13, 'Screwdrivers'),
(14, 'Hammers '),
(15, 'Pry Bar');

-- --------------------------------------------------------

--
-- Table structure for table `costumer`
--

CREATE TABLE `costumer` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `registered_at` date NOT NULL DEFAULT current_timestamp(),
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `costumer`
--

INSERT INTO `costumer` (`user_id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `registered_at`, `isAdmin`, `user_address`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$j9OXXIYS0CG5AYuks62YMeDvuIpo2hZEN4CqfJfujt1yPMnoUq5C6', '9810283472', '2022-04-10', 1, 'newroad'),
(2, 'Test ', 'Firstuser', 'test@gmail.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '980098322', '2022-04-10', 0, 'matepani-12'),
(9, 'Jake', 'Ace', 'jakeace09123@gmail.com', '$2y$10$XumVC74UHITFveTxhV8n3e6xYdrpIyQzPsJ0goqKoRqF.r9wu0zwu', '0933406421', '2025-05-10', 0, 'Sudipen la Union'),
(10, 'hhh', 'hhh', 'hh@gmail.com', '$2y$10$QEuXNrGzi7p/Zd4dvcqp9.pRettVDoofZU7xjMobTAxabMTaYDlbi', '12322443', '2025-05-22', 0, '@JohnManabeng'),
(11, 'fds', 'sd', 'fs@gmail.com', '$2y$10$AmX7ueKyVmaW1OdTpbRtwO7Zu45pL5GcmJQG7krYzaSJQxax4luVO', '1234', '2025-05-22', 0, '@JohnManabeng'),
(12, 'sds', 'sdas', 'ss@gmail.com', '$2y$10$Wdu1hINSFhAqkGMFCgNZw.6/XWtean35NNEb0ixkEj1ZstRD/P776', '124334', '2025-05-22', 0, '@JohnManabeng'),
(13, 'sAS', 'Sasa', 'sA@GMAIL.COM', '$2y$10$S2FFBmaa9twa8Ta4HqHtfuIEIrpxCVrGjkBbbFsPq31S9OwKUgage', '11111', '2025-05-22', 0, '@JohnManabeng'),
(14, 'fsd', 'dsd', 'sd@gmail.com', '$2y$10$2sXdBaN4e4b1wfpdCt15e.07KC20Dj/5Sjr3zM4VH7UKy5TOcoxpe', '11111', '2025-05-22', 0, '@JohnManabeng'),
(15, 'asds', 'dsasd', 'dasds@gmail.com', '$2y$10$7p/8BcgFL5nQxunyt6Tss.ZKZCx0bKfWIwhbY4tpJJtNduyvaVM1W', '123', '2025-05-22', 0, '@JohnManabeng'),
(16, 'Jake', 'Ace', 'kill09123@gmail.com', '$2y$10$wAsDtzFhIRup5lbdiN2ZhOXvc2W/HLspFXJ52hY9pjsgNTDTc6.f2', '', '2025-05-23', 0, ''),
(17, 'Jake', 'Ace', 'kill09123@gmail.com', '$2y$10$X/ww/qzEsbnQDq96oFaQHeqAZM4j5IijhjrLeHDYvUbi2enAov5lu', '', '2025-05-23', 0, ''),
(18, 'Jake', 'Ace', 'kill09123@gmail.com', '$2y$10$dIaz2jp776DqmnCY5gaWIebxj/tZRB/krefwEGED.GOtLbgl1416y', '', '2025-05-23', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivered_to` varchar(150) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `deliver_address` varchar(255) NOT NULL,
  `pay_method` varchar(50) NOT NULL,
  `pay_status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `delivered_to`, `phone_no`, `deliver_address`, `pay_method`, `pay_status`, `order_status`, `order_date`) VALUES
(1, 2, 'Jake Ace', '9802234675', 'Matepani-12', 'Cash', 0, 1, '2022-04-10'),
(3, 2, 'Test  Firstuser', '980098322', 'matepani-12', 'Credit Card', 0, 1, '2022-04-18'),
(4, 2, 'goerge', '0933406421', 'San Fernando', 'Cash', 0, 1, '2025-05-24'),
(5, 2, 'jakeeee ee', '1234', 'Apaleng', 'Credit Card', 0, 1, '2025-05-24'),
(7, 2, 'John Buis Manabeng', '0933406421', 'Apaleng', 'Credit Card', 0, 0, '2025-05-24'),
(8, 2, 'John Buis Manabeng', '0933406421', 'Apaleng', 'Credit Card', 0, 0, '2025-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `variation_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 500),
(3, 3, 3, 1, 890);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `uploaded_date` date NOT NULL DEFAULT current_timestamp(),
  `top_sale` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_image`, `price`, `category_id`, `uploaded_date`, `top_sale`) VALUES
(2, 'Pliers', 'Pliers are another essential tool used in motor repair and mechanical work. They are versatile tools that provide a strong grip for a wide range of tasks', './uploads/OIP (2).jpeg', 890, 1, '2022-04-04', 1),
(5, 'Hammers', 'A hammer is a tool used to strike objects—whether to loosen, install, remove, or shape parts. In motor repair, different types of hammers are used depending on the job.', './uploads/OIP (3).jpeg', 400, 14, '2022-04-04', 0),
(8, 'Wrenches', 'Wrenches are essential tools in motor repair and general mechanical work. They are used for tightening or loosening nuts, bolts, and other fasteners.', './uploads/OIP.jpeg', 900, 10, '2025-05-10', 1),
(9, 'Socket Set', 'It use for tighten bolts and nut and is the main part of wrench it like the bullet of wrench', './uploads/OIP (1).jpeg', 1000, 11, '2025-05-10', 1),
(10, 'Screwdrivers', 'It use to loosing nuts and it can be use tighten them when it is needed', './uploads/71bvsGSdbZL.jpg', 500, 13, '2025-05-10', 0),
(12, 'Ratcheting Wrench Set', 'A ratcheting wrench is a type of wrench that combines the standard wrench with a ratcheting mechanism on one end (usually the closed or box end). ', './uploads/spin_prod_240907901.jpeg', 800, 2, '2025-05-10', 0),
(13, 'Crowfoot Wrench Set', 'A crowfoot wrench is an open-end wrench head without a handle. Instead of a handle, it has a square hole so you can attach it to a ratchet, torque wrench, or extension bar.', './uploads/R.jpeg', 1000, 1, '2025-05-10', 0),
(14, 'Pry Bar', 'A pry bar (also called a lever bar or crowbar) is a strong metal tool designed to apply leverage to lift, move, or separate parts.', './uploads/61aY14E8BGL.jpg', 1000, 15, '2025-05-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_size_variation`
--

CREATE TABLE `product_size_variation` (
  `variation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size_variation`
--

INSERT INTO `product_size_variation` (`variation_id`, `product_id`, `size_id`, `quantity_in_stock`) VALUES
(1, 1, 4, 5),
(2, 2, 3, 9),
(3, 2, 2, 3),
(6, 3, 3, 6),
(7, 4, 2, 8),
(8, 5, 4, 8),
(9, 6, 2, 10),
(10, 7, 2, 10),
(13, 0, 0, 4),
(14, 1, 1, 1),
(15, 2, 4, 400),
(16, 5, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Jake', 'Ace', 'lopezjoule09123@gmail.com', '$2y$10$Tfu6fdR/qx.exze9MxEaIOR.YEpNJit0e5WRowtitfgjyKT1Frq7y'),
(2, 'Jake', 'Ace', 'manabeng09123@gmail.com', '$2y$10$.8GOAHSvnilolCgcTXv6Zuv9DVTHHN9pq8SW85gURgFG7R9YPKCRu'),
(3, 'Jake', 'Ace', 'kill09123@gmail.com', '$2y$10$f4moQD1F/bf/TsisFpsbPO98Alw9Mz/rcp5Mlv8QuT.ZVsCKMAHay'),
(4, 'kayber', 'lopez', 'lopez09123@gmail.com', '$2y$10$aHUB/uU/xt4FpEVHQtl51uEXU/qYn4GAIjEPO4PbygTLzyTTutyIC');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `product_id`, `review_desc`) VALUES
(1, 2, 2, 'Comfortable and stylish. I loved it.'),
(2, 2, 5, 'Perfect dress for summer.');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`) VALUES
(1, 'S'),
(2, 'L'),
(3, 'M'),
(4, 'Free'),
(6, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `tool_requests`
--

CREATE TABLE `tool_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tool` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tool_requests`
--

INSERT INTO `tool_requests` (`id`, `name`, `email`, `tool`, `supplier`, `message`, `request_date`) VALUES
(1, 'goerge', 'jake09123@gmail.com', 'Torque Wrench', 'Automotive Parts Store', '', '2025-05-23 21:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `registered_at` date NOT NULL DEFAULT current_timestamp(),
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `user_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `contact_no`, `registered_at`, `isAdmin`, `user_address`) VALUES
(2, 'Test ', 'Firstuser', 'test@gmail.com', '$2y$10$DJOdhZy1InHTKQO6whfyJexVTZCDTlmIYGCXQiPTv7l82AdC9bWHO', '980098322', '2022-04-10', 0, 'matepani-12'),
(20, 'ddd', 'dddddd', 'ddd@gamail.com', '$2y$10$cJIdmPAk5MrCt9UrkhwluONgy1iR1nstpjv2SoAFt65cwFK.XvXmu', '1111', '2025-05-23', 0, '@JohnManabeng'),
(21, 'kayber', 'lopez', 'lopez09123@gmail.com', '$2y$10$0eOSQvP0sQ4VgjLVsJ5GH.i3bHDEpQrZQoXp4BMmQ3KJS8vTn3Y52', '0933406421', '2025-05-23', 1, 'Apaleng'),
(22, 'kayber', 'lopez', 'jake09123@gmail.com', '$2y$10$dDStjLGS7kDhOnVQxBOXUO1AyDXznBHhQ4etBNBPZrZYJtbTlV9Fq', '0933406421', '2025-05-23', 1, 'Apaleng'),
(23, 'John', 'Manabeng', 'manabeng09123@gmail.com', '$2y$10$.lyQabT5Bf8yZuWHhh3q7OrlRPEHtVcy25/zp7sUqmYMwETtqGvh.', '0933406421', '2025-05-23', 0, 'Apaleng');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `uc_cart` (`user_id`,`variation_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `variation_id` (`variation_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_size_variation`
--
ALTER TABLE `product_size_variation`
  ADD PRIMARY KEY (`variation_id`),
  ADD UNIQUE KEY `uc_ps` (`product_id`,`size_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `tool_requests`
--
ALTER TABLE `tool_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`),
  ADD UNIQUE KEY `uc_wish` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `costumer`
--
ALTER TABLE `costumer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product_size_variation`
--
ALTER TABLE `product_size_variation`
  MODIFY `variation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tool_requests`
--
ALTER TABLE `tool_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`variation_id`) REFERENCES `product_size_variation` (`variation_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`variation_id`) REFERENCES `product_size_variation` (`variation_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
