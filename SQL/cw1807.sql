-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 15, 2024 lúc 03:00 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cw1807`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'adm1', 'pass1', 'admin', '2024-11-12 07:28:20'),
(2, 'adm2', 'pass2', 'admin', '2024-11-12 07:28:20'),
(3, 'usr1', 'pass3', 'user', '2024-11-12 07:28:20'),
(4, 'usr2', 'pass4', 'user', '2024-11-12 07:28:20'),
(5, 'usr3', 'pass5', 'user', '2024-11-12 07:28:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `account_id`, `full_name`, `email`, `phone_number`, `address`, `created_at`) VALUES
(1, 1, 'John Admin', 'admin1@example.com', '1234567890', '123 Admin Street', '2024-11-12 07:28:33'),
(2, 2, 'Jane Admin', 'admin2@example.com', '0987654321', '456 Admin Lane', '2024-11-12 07:28:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customize_package`
--

CREATE TABLE `customize_package` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `included_devices` varchar(255) DEFAULT NULL,
  `call_minutes` int(11) DEFAULT NULL,
  `message_count` int(11) DEFAULT NULL,
  `data_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devices`
--

CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sales_count` int(11) DEFAULT 0,
  `rating_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `devices`
--

INSERT INTO `devices` (`device_id`, `name`, `description`, `price`, `stock`, `image`, `category`, `sales_count`, `rating_id`) VALUES
(1, 'iPhone 13', 'A high-end smartphone with A15 Bionic chip and dual camera.', 999.99, 100, 'image_iphone13', 'Phone', 120, 5),
(2, 'Samsung Galaxy S21', 'Smartphone with AMOLED 120Hz display and high-quality camera.', 799.99, 120, 'image_galaxys21', 'Phone', 85, 4),
(3, 'Xiaomi Mi 11', 'Affordable smartphone with strong performance and good camera.', 599.99, 150, 'image_mi11', 'Phone', 200, 7),
(4, 'Oppo Reno6', 'Smartphone with stylish design and AI portrait camera.', 499.99, 180, 'image_reno6', 'Phone', 45, 12),
(5, 'Vivo V21', 'Smartphone with 44MP selfie camera and AMOLED display.', 399.99, 140, 'image_v21', 'Phone', 150, 6),
(6, 'iPad Pro', 'High-end tablet with Liquid Retina display and M1 chip.', 1099.99, 80, 'image_ipadpro', 'Tablet', 30, 3),
(7, 'Samsung Galaxy Tab S7', 'Tablet with AMOLED display and S Pen support.', 699.99, 90, 'image_tabs7', 'Tablet', 75, 8),
(8, 'Huawei MatePad 11', 'Tablet with 120Hz display and stylus support.', 499.99, 110, 'image_matepad11', 'Tablet', 300, 10),
(9, 'Lenovo Tab P11', 'Tablet with large display and Dolby Atmos speakers.', 399.99, 130, 'image_tabp11', 'Tablet', 60, 2),
(10, 'Xiaomi Pad 5', 'Tablet with high performance and high-resolution display.', 349.99, 140, 'image_pad5', 'Tablet', 100, 9),
(11, 'MacBook Air M1', 'Ultra-thin laptop with M1 chip and long battery life.', 999.99, 60, 'image_macbookairm1', 'Laptop', 40, 13),
(12, 'Dell XPS 13', 'Premium laptop with InfinityEdge display and strong performance.', 1199.99, 50, 'image_xps13', 'Laptop', 55, 1),
(13, 'HP Spectre x360', '2-in-1 laptop with beautiful design and high performance.', 1099.99, 70, 'image_spectrex360', 'Laptop', 110, 14),
(14, 'Asus ROG Zephyrus G14', 'Gaming laptop with high performance and 120Hz display.', 1399.99, 40, 'image_rogzephyrusg14', 'Laptop', 25, 11),
(15, 'Lenovo ThinkPad X1 Carbon', 'Durable business laptop with excellent keyboard.', 1299.99, 80, 'image_x1carbon', 'Laptop', 90, 17),
(16, 'TP-Link Archer AX50', 'High-speed Wi-Fi 6 router for home use.', 149.99, 200, 'image_archerax50', 'Router', 35, 16),
(17, 'Asus RT-AX88U', 'Gaming router with low latency and Wi-Fi 6.', 299.99, 150, 'image_rt_ax88u', 'Router', 95, 19),
(18, 'Netgear Nighthawk RAX120', 'High-performance Wi-Fi 6 router for office.', 399.99, 100, 'image_nighthawkrax120', 'Router', 10, 20),
(19, 'Linksys MR9600', 'Wi-Fi 6 router with mesh network expansion capability.', 249.99, 180, 'image_mr9600', 'Router', 60, 15),
(20, 'D-Link DIR-X5460', 'Affordable Wi-Fi 6 router with high speed.', 129.99, 220, 'image_dirx5460', 'Router', 70, 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `device_id` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `included_devices` varchar(255) DEFAULT NULL,
  `included_services` varchar(255) DEFAULT NULL,
  `rating_id` int(11) DEFAULT NULL,
  `sales_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `package`
--

INSERT INTO `package` (`package_id`, `name`, `description`, `price`, `service_id`, `device_id`, `category`, `image`, `included_devices`, `included_services`, `rating_id`, `sales_count`) VALUES
(1, 'Phone Essentials', 'Package including a smartphone and basic call & message service.', 299.99, 1, 1, 'Phone', NULL, 'iPhone 13 - A high-end smartphone with A15 Bionic chip and dual camera.', 'Basic Package - A basic package offering essential services', 5, 120),
(2, 'Laptop Pro Bundle', 'Advanced laptop with premium support service.', 1199.99, 2, 12, 'Laptop', NULL, 'Dell XPS 13 - Premium laptop with InfinityEdge display and strong performance.', 'Premium Package - A premium package with additional features', 4, 85),
(3, 'Tablet Family Pack', 'Tablet with family data plan for entertainment.', 499.99, 3, 6, 'Tablet', NULL, 'iPad Pro - High-end tablet with Liquid Retina display and M1 chip.', 'Family Package - A family-oriented package with multiple user support', 7, 200),
(4, 'Router Starter Kit', 'Home router with basic internet service.', 199.99, 4, 4, 'Router', NULL, 'Oppo Reno6 - Smartphone with stylish design and AI portrait camera.', 'Business Package - A package designed for small to medium businesses', 12, 45),
(5, 'Phone Business Combo', 'Phone with business-oriented data and messaging service.', 699.99, 5, 2, 'Phone', NULL, 'Samsung Galaxy S21 - Smartphone with AMOLED 120Hz display and high-quality camera.', 'Standard Package - An affordable package for individual users', 6, 150),
(6, 'Laptop Student Bundle', 'Affordable laptop with educational service access.', 799.99, 6, 13, 'Laptop', NULL, 'HP Spectre x360 - 2-in-1 laptop with beautiful design and high performance.', 'Deluxe Package - A deluxe package with exclusive features', 3, 30),
(7, 'Tablet Entertainment Pack', 'High-resolution tablet with streaming services.', 599.99, 7, 7, 'Tablet', NULL, 'Samsung Galaxy Tab S7 - Tablet with AMOLED display and S Pen support.', 'Ultimate Package - The ultimate package with all available features', 8, 75),
(8, 'Router Pro Setup', 'High-speed router with advanced internet service.', 299.99, 8, 4, 'Router', NULL, 'Oppo Reno6 - Smartphone with stylish design and AI portrait camera.', 'Student Package - A package with discounts and special offers for students', 10, 300),
(9, 'Phone Travel Kit', 'Smartphone with international roaming support.', 499.99, 9, 3, 'Phone', NULL, 'Xiaomi Mi 11 - Affordable smartphone with strong performance and good camera.', 'Starter Package - A starter package for new customers', 2, 60),
(10, 'Laptop Gaming Bundle', 'Gaming laptop with high-performance features.', 1399.99, 10, 14, 'Laptop', NULL, 'Asus ROG Zephyrus G14 - Gaming laptop with high performance and 120Hz display.', 'Enterprise Package - A package designed for large organizations with additional support', 9, 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `package_detail`
--

CREATE TABLE `package_detail` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('Phone','Laptop','Tablet','Router') DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `device_include` varchar(255) DEFAULT NULL,
  `call_minutes` int(11) DEFAULT 0,
  `sms_count` int(11) DEFAULT 0,
  `data_volume` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `package_detail`
--

INSERT INTO `package_detail` (`id`, `package_id`, `name`, `description`, `price`, `category`, `image`, `device_include`, `call_minutes`, `sms_count`, `data_volume`) VALUES
(1, 1, 'Phone Essentials Detail', 'Detailed package including smartphone and basic call & message service.', 299.99, 'Phone', 'image_phone_essentials.png', 'iPhone 13', 100, 50, 5.00),
(2, 2, 'Laptop Pro Bundle Detail', 'Detailed package with a premium laptop and support service.', 1199.99, 'Laptop', 'image_laptop_pro.png', 'Dell XPS 13', 0, 0, 0.00),
(3, 3, 'Tablet Family Pack Detail', 'Family package with tablet and data plan for entertainment.', 499.99, 'Tablet', 'image_tablet_family.png', 'iPad Pro', 0, 0, 10.00),
(4, 4, 'Router Starter Kit Detail', 'Basic home router package with essential internet service.', 199.99, 'Router', 'image_router_starter.png', 'TP-Link Archer AX50', 0, 0, 20.00),
(5, 5, 'Phone Business Combo Detail', 'Business phone package with data and messaging services.', 699.99, 'Phone', 'image_phone_business.png', 'Samsung Galaxy S21', 200, 100, 15.00),
(6, 6, 'Laptop Student Bundle Detail', 'Affordable laptop for students with educational access.', 799.99, 'Laptop', 'image_laptop_student.png', 'HP Spectre x360', 0, 0, 0.00),
(7, 7, 'Tablet Entertainment Pack Detail', 'High-resolution tablet with streaming services for entertainment.', 599.99, 'Tablet', 'image_tablet_entertainment.png', 'Samsung Galaxy Tab S7', 0, 0, 12.00),
(8, 8, 'Router Pro Setup Detail', 'Advanced router setup with high-speed internet service.', 299.99, 'Router', 'image_router_pro.png', 'Asus RT-AX88U', 0, 0, 50.00),
(9, 9, 'Phone Travel Kit Detail', 'Phone package with international roaming support.', 499.99, 'Phone', 'image_phone_travel.png', 'Xiaomi Mi 11', 300, 150, 10.00),
(10, 10, 'Laptop Gaming Bundle Detail', 'Gaming laptop bundle with high-performance features.', 1399.99, 'Laptop', 'image_laptop_gaming.png', 'Asus ROG Zephyrus G14', 0, 0, 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `star_rating` decimal(2,1) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`id`, `star_rating`, `comment`) VALUES
(1, 5.0, 'Excellent product! Highly recommend!'),
(2, 4.5, 'Very good quality, but delivery was slow.'),
(3, 3.5, 'Average experience, nothing special.'),
(4, 2.5, 'Not satisfied with the product.'),
(5, 1.5, 'Disappointed, product did not match description.'),
(6, 4.0, 'Good value for money!'),
(7, 3.0, 'It’s okay, but I expected more.'),
(8, 2.0, 'Poor quality, I wouldn’t buy again.'),
(9, 5.0, 'Absolutely love it! Will buy again!'),
(10, 4.5, 'Great product, just a bit pricey.'),
(11, 3.5, 'Decent, but there are better options.'),
(12, 2.5, 'Mediocre, not what I hoped for.'),
(13, 1.0, 'Terrible experience, very unhappy.'),
(14, 4.0, 'Satisfied overall, minor issues.'),
(15, 3.0, 'It works, but could be improved.'),
(16, 2.0, 'Not worth the money.'),
(17, 5.0, 'Fantastic! Exceeded my expectations!'),
(18, 4.5, 'Almost perfect, just a few flaws.'),
(19, 3.5, 'Fairly good, but not exceptional.'),
(20, 1.5, 'Very disappointing, I expected better.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `rating_id` int(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `package_type` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sales_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `service`
--

INSERT INTO `service` (`service_id`, `name`, `description`, `price`, `rating_id`, `stock`, `package_type`, `image`, `sales_count`) VALUES
(1, 'Basic Package', 'A basic package offering essential services.', 49.99, 4, 100, 'Call & Message', 'image1', 120),
(2, 'Premium Package', 'A premium package with additional features.', 149.99, 7, 50, 'Data & Message', 'image2', 85),
(3, 'Family Package', 'A family-oriented package with multiple user support.', 89.99, 15, 75, 'Call, Data & Message', 'image3', 200),
(4, 'Business Package', 'A package designed for small to medium businesses.', 199.99, 12, 30, 'Call, Data & Message', 'image4', 45),
(5, 'Standard Package', 'An affordable package for individual users.', 59.99, 2, 200, 'Call & Message', 'image5', 150),
(6, 'Deluxe Package', 'A deluxe package with exclusive features.', 249.99, 9, 40, 'Data & Message', 'image6', 30),
(7, 'Ultimate Package', 'The ultimate package with all available features.', 499.99, 5, 15, 'Call, Data & Message', 'image7', 10),
(8, 'Student Package', 'A package with discounts and special offers for students.', 29.99, 10, 150, 'Call, Data & Message', 'image8', 75),
(9, 'Starter Package', 'A starter package for new customers.', 19.99, 3, 250, 'Call & Message', 'image9', 300),
(10, 'Enterprise Package', 'A package designed for large organizations with advanced features.', 999.99, 8, 20, 'Call, Data & Message', 'image10', 60);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_detail`
--

CREATE TABLE `service_detail` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `call_minutes` int(11) DEFAULT NULL,
  `data_volume` varchar(50) DEFAULT NULL,
  `message_count` int(11) DEFAULT NULL,
  `package_type` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `service_detail`
--

INSERT INTO `service_detail` (`id`, `service_id`, `name`, `description`, `price`, `stock`, `call_minutes`, `data_volume`, `message_count`, `package_type`, `image`) VALUES
(1, 1, 'Basic Package', 'A basic package offering essential services.', 49.99, 100, 100, NULL, 50, 'Call & Message', 'image1'),
(2, 2, 'Premium Package', 'A premium package with additional features.', 149.99, 50, NULL, '5GB', 200, 'Data & Message', 'image2'),
(3, 3, 'Family Package', 'A family-oriented package with multiple user support.', 89.99, 75, 200, '3GB', 100, 'Call, Data & Message', 'image3'),
(4, 4, 'Business Package', 'A package designed for small to medium businesses.', 199.99, 30, 500, '10GB', 500, 'Call, Data & Message', 'image4'),
(5, 5, 'Standard Package', 'An affordable package for individual users.', 59.99, 200, 150, NULL, 75, 'Call & Message', 'image5'),
(6, 6, 'Deluxe Package', 'A deluxe package with exclusive features.', 249.99, 40, NULL, '15GB', 400, 'Data & Message', 'image6'),
(7, 7, 'Ultimate Package', 'The ultimate package with all available features.', 499.99, 15, 1000, '50GB', 1000, 'Call, Data & Message', 'image7'),
(8, 8, 'Student Package', 'A package with discounts and special offers for students.', 29.99, 150, 120, '1.5GB', 80, 'Call, Data & Message', 'image8'),
(9, 9, 'Starter Package', 'A starter package for new customers.', 19.99, 250, 60, NULL, 30, 'Call & Message', 'image9'),
(10, 10, 'Enterprise Package', 'A package designed for large organizations with advanced features.', 999.99, 20, 2000, '100GB', 1500, 'Call, Data & Message', 'image10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `credit_card_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_info`
--

INSERT INTO `user_info` (`user_id`, `account_id`, `full_name`, `email`, `phone_number`, `address`, `credit_card_number`, `created_at`, `image`) VALUES
(1, 3, 'Alice User', 'user1@example.com', '1112223333', '789 User Blvd', '4111111111111111', '2024-11-12 07:29:09', NULL),
(2, 4, 'Bob User', 'user2@example.com', '4445556666', '101 User Drive', '4222222222222222', '2024-11-12 07:29:09', NULL),
(3, 5, 'Charlie User', 'user3@example.com', '7778889999', '202 User Avenue', '4333333333333333', '2024-11-12 07:29:09', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `account_id` (`account_id`);

--
-- Chỉ mục cho bảng `customize_package`
--
ALTER TABLE `customize_package`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `fk_devices_rating` (`rating_id`);

--
-- Chỉ mục cho bảng `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `fk_package_device` (`device_id`),
  ADD KEY `fk_package_service` (`service_id`),
  ADD KEY `fk_package_rating` (`rating_id`);

--
-- Chỉ mục cho bảng `package_detail`
--
ALTER TABLE `package_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `fk_service_rating` (`rating_id`);

--
-- Chỉ mục cho bảng `service_detail`
--
ALTER TABLE `service_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`service_id`);

--
-- Chỉ mục cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customize_package`
--
ALTER TABLE `customize_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `package_detail`
--
ALTER TABLE `package_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `service_detail`
--
ALTER TABLE `service_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin_info`
--
ALTER TABLE `admin_info`
  ADD CONSTRAINT `admin_info_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `fk_devices_rating` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`);

--
-- Các ràng buộc cho bảng `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `fk_package_device` FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`),
  ADD CONSTRAINT `fk_package_rating` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`),
  ADD CONSTRAINT `fk_package_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `package_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `package_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `devices` (`device_id`);

--
-- Các ràng buộc cho bảng `package_detail`
--
ALTER TABLE `package_detail`
  ADD CONSTRAINT `package_detail_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `package` (`package_id`);

--
-- Các ràng buộc cho bảng `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_rating_id` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`),
  ADD CONSTRAINT `fk_service_rating` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`id`);

--
-- Các ràng buộc cho bảng `service_detail`
--
ALTER TABLE `service_detail`
  ADD CONSTRAINT `service_detail_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

--
-- Các ràng buộc cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
