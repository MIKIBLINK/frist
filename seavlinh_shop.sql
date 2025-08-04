-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2025 at 07:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seavlinh_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders`
(
  `id` int
(11) NOT NULL,
  `user_id` int
(11) NOT NULL,
  `order_details` longtext CHARACTER
SET utf8mb4
COLLATE utf8mb4_bin NOT NULL CHECK
(json_valid
(`order_details`)),
  `total_amount` decimal
(10,2) NOT NULL,
  `payment_method` varchar
(50) NOT NULL,
  `status` varchar
(50) DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp
()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`
id`,
`user_id
`, `order_details`, `total_amount`, `payment_method`, `status`, `order_date`) VALUES
(2, 1, '[{\"id\":\"Latte-3.00\",\"name\":\"Latte\",\"price\":3,\"quantity\":4},{\"id\":\"Caramel-Macchiato-3.00\",\"name\":\"Caramel Macchiato\",\"price\":3,\"quantity\":1},{\"id\":\"Vanilla-Fruit-Cake-25.00\",\"name\":\"Vanilla Fruit Cake\",\"price\":25,\"quantity\":4},{\"id\":\"Birthday-Chocolate-Dripping-Cake-50.00\",\"name\":\"Birthday Chocolate Dripping Cake\",\"price\":50,\"quantity\":2},{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1},{\"id\":\"Ciabatta-Bread-3.00\",\"name\":\"Ciabatta Bread\",\"price\":3,\"quantity\":1}]', 222.00, 'Cash on Delivery', 'Pending', '2025-07-29 01:01:28'),
(3, 1, '[{\"id\":\"Espresso-2.00\",\"name\":\"Espresso\",\"price\":2,\"quantity\":1},{\"id\":\"Latte-3.00\",\"name\":\"Latte\",\"price\":3,\"quantity\":1},{\"id\":\"Cappuccino-3.00\",\"name\":\"Cappuccino\",\"price\":3,\"quantity\":1},{\"id\":\"Americano-3.00\",\"name\":\"Americano\",\"price\":3,\"quantity\":1},{\"id\":\"Frappuccino-3.00\",\"name\":\"Frappuccino\",\"price\":3,\"quantity\":1},{\"id\":\"Cold-Brew-3.00\",\"name\":\"Cold Brew\",\"price\":3,\"quantity\":1},{\"id\":\"Vanilla-Fruit-Cake-25.00\",\"name\":\"Vanilla Fruit Cake\",\"price\":25,\"quantity\":1},{\"id\":\"Fruit-Overload-Cake-30.00\",\"name\":\"Fruit Overload Cake\",\"price\":30,\"quantity\":1},{\"id\":\"Rainbow-Sprinkles-Cake-32.00\",\"name\":\"Rainbow Sprinkles Cake\",\"price\":32,\"quantity\":1}]', 104.00, 'KHQR', 'Transporting', '2025-07-29 01:02:28'),
(4, 2, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":2},{\"id\":\"French-Toast-Bread-3.00\",\"name\":\"French Toast Bread\",\"price\":3,\"quantity\":2},{\"id\":\"Espresso-2.00\",\"name\":\"Espresso\",\"price\":2,\"quantity\":6},{\"id\":\"Caramel-Macchiato-3.00\",\"name\":\"Caramel Macchiato\",\"price\":3,\"quantity\":1},{\"id\":\"Hot-Chocolate-3.00\",\"name\":\"Hot Chocolate\",\"price\":3,\"quantity\":1},{\"id\":\"Vanilla-Fruit-Cake-25.00\",\"name\":\"Vanilla Fruit Cake\",\"price\":25,\"quantity\":1},{\"id\":\"Blueberry-Cream-Cake-35.00\",\"name\":\"Blueberry Cream Cake\",\"price\":35,\"quantity\":1}]', 92.00, 'Cash on Delivery', 'Transporting', '2025-07-29 02:58:13'),
(5, 3, '[{\"id\":\"Latte-3.00\",\"name\":\"Latte\",\"price\":3,\"quantity\":1},{\"id\":\"Hot-Chocolate-3.00\",\"name\":\"Hot Chocolate\",\"price\":3,\"quantity\":1},{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 10.00, 'Cash on Delivery', 'Pending', '2025-07-29 02:59:17'),
(6, 2, '[{\"name\":\"Vanilla Cake\",\"price\":25,\"quantity\":2},{\"name\":\"Espresso\",\"price\":2,\"quantity\":3}]', 59.00, 'Cash on Delivery', 'Pending', '2025-07-25 10:00:00'),
(7, 3, '[{\"name\":\"Mocha\",\"price\":3,\"quantity\":4}]', 12.00, 'KHQR', 'Complete', '2025-07-26 14:30:00'),
(8, 4, '[{\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":5}]', 20.00, 'Cash on Delivery', 'Transporting', '2025-07-27 09:15:00'),
(9, 5, '[{\"name\":\"Cappuccino\",\"price\":3,\"quantity\":2},{\"name\":\"Fruit Cake\",\"price\":30,\"quantity\":1}]', 36.00, 'Cash on Delivery', 'Complete', '2025-07-28 16:45:00'),
(10, 2, '[{\"name\":\"Latte\",\"price\":3,\"quantity\":3}]', 9.00, 'QR', 'Pending', '2025-07-28 18:20:00'),
(11, 9, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 4.00, 'QR', 'Pending', '2025-07-29 03:31:17'),
(12, 1, '[{\"id\":\"Latte-3.00\",\"name\":\"Latte\",\"price\":3,\"quantity\":1},{\"id\":\"Caramel-Macchiato-3.00\",\"name\":\"Caramel Macchiato\",\"price\":3,\"quantity\":1}]', 6.00, 'QR', 'Pending', '2025-07-29 09:22:30'),
(13, 1, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 4.00, 'QR', 'Pending', '2025-07-29 09:22:58'),
(14, 1, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 4.00, 'QR', 'Pending', '2025-07-29 09:53:49'),
(15, 10, '[{\"id\":\"Espresso-2.00\",\"name\":\"Espresso\",\"price\":2,\"quantity\":1},{\"id\":\"Chocolate-Truffle-Cake-20.00\",\"name\":\"Chocolate Truffle Cake\",\"price\":20,\"quantity\":1},{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 26.00, 'Cash on Delivery', 'Transporting', '2025-07-29 09:56:23'),
(16, 1, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1},{\"id\":\"Espresso-2.00\",\"name\":\"Espresso\",\"price\":2,\"quantity\":2},{\"id\":\"Chocolate-Truffle-Cake-20.00\",\"name\":\"Chocolate Truffle Cake\",\"price\":20,\"quantity\":1}]', 28.00, 'Cash on Delivery', 'Pending', '2025-08-04 22:37:44'),
(17, 11, '[{\"id\":\"Whole-Wheat-Bread-4.00\",\"name\":\"Whole Wheat Bread\",\"price\":4,\"quantity\":1}]', 4.00, 'Cash on Delivery', 'Pending', '2025-08-04 22:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products`
(
  `id` int
(11) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal
(10,2) NOT NULL,
  `stock` int
(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp
()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`
id`,
`name
`, `description`, `price`, `stock`, `created_at`) VALUES
(1, 'testing', 'new [project', 14.00, 10, '2025-07-29 03:54:57'),
(2, 'test product', 'add porduct testing', 12.00, 10, '2025-08-04 16:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings`
(
  `setting_key` varchar
(255) NOT NULL,
  `setting_value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`
setting_key`,
`setting_value
`) VALUES
('maintenance_mode', '0'),
('shop_name', 'My Awesome Shop'),
('welcome_message', 'Welcome to our online store!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
  `id` int
(11) NOT NULL,
  `phone_number` varchar
(20) NOT NULL,
  `name` varchar
(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp
()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`
id`,
`phone_number
`, `name`, `address`, `created_at`) VALUES
(1, '0966840522', 'ww', 'Phnom phenh dsdawesz', '2025-07-28 18:00:13'),
(2, '012345678', 'chanchakriya', 'Phnom phenh 287 TK', '2025-07-28 19:58:13'),
(3, '022555566', 'hello', 'kpt weatern testing', '2025-07-28 19:59:17'),
(4, '0961234567', 'Sophea', 'Phnom Penh, Cambodia', '2025-07-28 20:04:01'),
(5, '0977654321', 'Vannak', 'Siem Reap, Cambodia', '2025-07-28 20:04:01'),
(6, '0989876543', 'Ratha', 'Battambang, Cambodia', '2025-07-28 20:04:01'),
(7, '0965554444', 'Channa', 'Kampong Cham, Cambodia', '2025-07-28 20:04:01'),
(8, '0973332222', 'Srey Leak', 'Sihanoukville, Cambodia', '2025-07-28 20:04:01'),
(9, '01223698745', 'ww', 'Phnom phenh', '2025-07-28 20:31:17'),
(10, '0125555888', 'ya ya', 'phnom penh tk 278', '2025-07-29 02:56:23'),
(11, '09668405222', 'Yaaya', 'Phnom phenh Tk', '2025-08-04 15:56:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
ADD PRIMARY KEY
(`id`),
ADD KEY `user_id`
(`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
ADD PRIMARY KEY
(`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
ADD PRIMARY KEY
(`setting_key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id`),
ADD UNIQUE KEY `phone_number`
(`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY
(`user_id`) REFERENCES `users`
(`id`) ON
DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
