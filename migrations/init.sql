-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Oct 09, 2023 at 07:38 AM
-- Server version: 8.1.0
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(6, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `product_id`, `quantity`) VALUES
(1, 1, -1),
(1, 13, 1),
(1, 17, 3),
(1, 22, 21),
(1, 27, 1),
(2, 1, 3),
(2, 5, 1),
(2, 6, 1),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `cart_id` int NOT NULL,
  `recipient_name` varchar(200) NOT NULL,
  `recipient_phone_number` varchar(20) NOT NULL,
  `delivery_address` varchar(500) NOT NULL,
  `payment_id` int NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `receive_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`cart_id`, `recipient_name`, `recipient_phone_number`, `delivery_address`, `payment_id`, `order_date`, `receive_date`) VALUES
(2, 'budi', '12', '111P', 1, '2023-10-09 05:14:58', '2023-10-09 12:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_date`, `payment_method`, `amount`) VALUES
(1, '2023-10-09 05:14:58', 'ewallet', 3299000),
(2, '2023-10-09 06:51:04', 'cod', 1099000),
(3, '2023-10-09 06:54:29', 'cod', 2198000),
(4, '2023-10-09 06:58:40', 'cod', 1099000),
(5, '2023-10-09 07:00:03', 'cod', 3297000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `sold` int NOT NULL,
  `thumbnail_url` varchar(2047) DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_modified_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `stock`, `sold`, `thumbnail_url`, `create_date`, `last_modified_date`) VALUES
(1, 'yezi', 'sepatu zaman purba', 1099000, 10, 1, NULL, '2023-10-03 03:42:19', '2023-10-09 07:00:23'),
(2, 'vitajimin', 'vitamin buat orang sakit', 68000, 10, 0, NULL, '2023-10-03 05:28:43', '2023-10-03 05:28:43'),
(3, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:33', '2023-10-03 11:26:42'),
(4, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:41', '2023-10-03 11:26:42'),
(5, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:57', '2023-10-03 11:26:42'),
(6, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:57', '2023-10-03 11:26:42'),
(7, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:57', '2023-10-03 11:26:42'),
(8, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:57', '2023-10-03 11:26:42'),
(9, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:42:57', '2023-10-03 11:26:42'),
(10, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(11, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(12, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(13, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(14, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(15, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(16, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(17, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(18, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(19, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:11', '2023-10-03 11:26:42'),
(20, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(21, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(22, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(23, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(24, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(25, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(26, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(27, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(28, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(29, 'item1', 'untuk menguji pagination', 1000, 1, 0, NULL, '2023-10-03 06:43:13', '2023-10-03 11:26:42'),
(30, 'Kentang goreng', 'kentang digoreng', 1000, 100, 0, '/storage/images/4bb86b6ff9c3287058b8326f8bf9dafe.jpeg', '2023-10-09 07:35:58', '2023-10-09 07:35:58'),
(31, 'ban mobil', 'ban buat mobil', 65000, 39, 0, '/storage/images/2f8969982d117857ead2a4e33a4398b2.jpeg', '2023-10-09 07:37:25', '2023-10-09 07:37:25'),
(32, 'beras 1 kg no root', 'beras itu kalau dimasak jadi nasi', 9000, 30, 0, '/storage/images/23451378f91d41e707d2a596ee731e8d.jpeg', '2023-10-09 07:38:06', '2023-10-09 07:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `product_id` int NOT NULL,
  `ordering_id` int NOT NULL,
  `media_url` varchar(2047) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`product_id`, `ordering_id`, `media_url`) VALUES
(1, 1, '/storage/images/product/media/Spongebob_sepatu_satu.png'),
(1, 2, '/storage/images/product/media/Spongebob_sepatu_dua.png'),
(1, 3, '/storage/videos/Ini adalah video.mp4'),
(30, 1, '/storage/images/4bb86b6ff9c3287058b8326f8bf9dafe.jpeg'),
(30, 2, '/storage/images/e3e34bf51e34e0b62024bbf11bedea9f.jpeg'),
(31, 1, '/storage/images/2f8969982d117857ead2a4e33a4398b2.jpeg'),
(32, 1, '/storage/images/23451378f91d41e707d2a596ee731e8d.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 1),
(2, 2),
(1, 3),
(1, 4),
(30, 4),
(31, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(50) NOT NULL,
  `tag_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `tag_description`) VALUES
(1, 'sepatu', 'Alas kaki yang umumnya menutupi seluruh bagian mulai dari jari, punggung kaki hingga tumit.'),
(2, 'vitamin', 'Pelengkap kebutuhan vitamin tubuh'),
(3, 'pakaian', 'barang yang dikenakan pada tubuh'),
(4, 'item', 'just item');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `picture_url` varchar(2047) NOT NULL,
  `access_type` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `fullname`, `picture_url`, `access_type`) VALUES
(1, 'yugtah', 'ini passwordnya belum di hash, tolong jangan ditiru', 'yug tah', '', 0),
(2, 'budi', '$2y$10$zfmUiPcrFq6dVnan04aWCeUU8C5s4BfNQ872uyaiAQEOVjaeij7SG', 'budi', '488e5a667d9c211c8073d530dc8b4828.png', 0),
(3, 'admin', '$2y$10$Nj8InqeaUKeF4lpu8Xm4XOeFF3PrOCd68ECzqO3v.JvoeIg1yk/lO', 'admin', 'cff630681f7d47348704a68332f1077d.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`product_id`,`ordering_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
