-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 09:28 AM
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
-- Database: `homecarefix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_auth`
--

CREATE TABLE `admin_auth` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_auth`
--

INSERT INTO `admin_auth` (`admin_id`, `admin_name`, `admin_pass`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment` datetime NOT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `order_id` varchar(150) NOT NULL,
  `trans_amt` int(11) NOT NULL,
  `trans_status` varchar(200) NOT NULL DEFAULT 'pending',
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `m_to_r` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `user_id`, `appointment`, `booking_status`, `order_id`, `trans_amt`, `trans_status`, `datetime`, `m_to_r`) VALUES
(1, 5, '0000-00-00 00:00:00', 'pending', 'order6602a29c4d5fa', 4710, 'FAILED', '2024-02-26 15:55:33', 1),
(3, 5, '2024-03-29 09:28:00', 'pending', 'order66046ad5baba8', 4604, 'FAILED', '2024-03-28 00:22:11', 1),
(4, 5, '2024-03-29 16:55:00', 'pending', 'order660553ac335af', 4711, 'EXPIRED', '2024-02-28 16:55:38', 1),
(5, 5, '2024-03-29 16:55:00', 'pending', 'order66055aed8fec1', 4711, 'EXPIRED', '2024-03-28 17:26:30', 1),
(6, 5, '2024-03-29 10:44:00', 'pending', 'order66059766d8ae9', 2355, 'EXPIRED', '2024-03-28 21:44:34', 1),
(7, 5, '2024-03-29 10:44:00', 'pending', 'order660597fd4d86a', 2355, 'EXPIRED', '2024-03-28 21:47:02', 1),
(8, 5, '2024-03-29 10:44:00', 'pending', 'order6605986b1fefa', 2355, 'EXPIRED', '2024-03-28 21:48:52', 1),
(9, 5, '2024-03-29 15:49:00', 'pending', 'order66059898d487a', 2355, 'EXPIRED', '2024-03-28 21:49:37', 1),
(10, 5, '2024-03-29 14:58:00', 'confrim', 'order66059acdaa403', 2355, 'PAID', '2024-03-28 21:59:04', 0),
(11, 5, '2024-03-29 11:11:00', 'confrim', 'order66059cd04249c', 5354, 'PAID', '2024-03-28 22:07:42', 0),
(12, 5, '2024-03-30 10:31:00', 'confrim', 'order660683303f844', 9703, 'PAID', '2024-03-29 14:30:36', 0),
(13, 5, '2024-03-30 15:23:00', 'pending', 'order66069dc8355c6', 7066, 'EXPIRED', '2024-03-29 16:24:06', 1),
(14, 5, '2024-03-31 11:03:00', 'confrim', 'order6607a447d9c4e', 2355, 'PAID', '2024-03-30 11:04:02', 0),
(15, 5, '2024-04-02 16:06:00', 'confrim', 'order660a6416a6b87', 4711, 'PAID', '2024-02-01 13:07:00', 0),
(16, 5, '2024-04-05 15:06:00', 'confrim', 'order660e3bee6dc76', 11776, 'PAID', '2024-04-04 11:04:42', 0),
(17, 5, '2024-04-06 09:59:00', 'pending', 'order6610367892419', 2355, 'EXPIRED', '2024-04-05 23:05:57', 1),
(18, 5, '2024-04-06 09:17:00', 'pending', 'order6610390ca99e2', 2355, 'EXPIRED', '2024-04-05 23:16:56', 1),
(19, 5, '2024-04-08 10:30:00', 'confrim', 'order66103bfad44f2', 2356, 'PAID', '2024-04-05 23:29:24', 0),
(20, 5, '2024-04-11 10:35:00', 'pending', 'order66103cda39c6d', 4605, 'EXPIRED', '2024-04-05 23:33:07', 1),
(21, 7, '2024-04-09 14:08:00', 'confrim', 'order6612e6df5ce75', 9059, 'PAID', '2024-02-08 00:03:13', 0),
(22, 5, '2024-04-10 16:08:00', 'pending', 'order6612e80a1165f', 700, 'EXPIRED', '2024-04-08 00:08:03', 1),
(23, 5, '2024-04-09 12:25:00', 'confrim', 'order661385c95b3ba', 2355, 'PAID', '2024-04-08 11:21:06', 0),
(24, 5, '2024-04-13 11:06:00', 'confrim', 'order6618c847e96b3', 700, 'PAID', '2024-04-12 11:06:12', 0),
(25, 5, '2024-04-14 10:25:00', 'confrim', 'order661a1fe068cad', 2355, 'PAID', '2024-04-13 11:32:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_order_service`
--

CREATE TABLE `booking_order_service` (
  `booking_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order_service`
--

INSERT INTO `booking_order_service` (`booking_id`, `service_id`) VALUES
(3, 7),
(3, 14),
(4, 14),
(4, 13),
(5, 14),
(5, 13),
(6, 14),
(7, 14),
(8, 14),
(9, 14),
(10, 14),
(11, 14),
(11, 8),
(12, 8),
(12, 7),
(12, 9),
(12, 14),
(13, 14),
(13, 12),
(13, 13),
(14, 14),
(15, 14),
(15, 13),
(16, 14),
(16, 13),
(16, 12),
(17, 14),
(18, 14),
(19, 13),
(20, 13),
(20, 7),
(21, 14),
(21, 7),
(21, 9),
(22, 15),
(23, 14),
(24, 15),
(25, 14);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(3, 'IMG_4016.jpg'),
(5, 'IMG_5928.jpg'),
(6, 'IMG_9366.jpg'),
(7, 'IMG_4508.jpg'),
(9, 'IMG_3211.jpg'),
(10, 'IMG_5739.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_img` varchar(500) NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_img`, `category_name`, `status`) VALUES
(1, 'IMG_6814.svg', 'Prime Salon for Mens', 0),
(2, 'IMG_1373.svg', 'Salon For Womens', 0),
(3, 'IMG_3017.svg', 'Ac &amp; Appliances Repairing', 0),
(4, 'IMG_1242.svg', 'Cleaning', 0),
(5, 'IMG_3707.svg', 'Electrician, Plumber &amp; Carpenters', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `google_map` varchar(100) NOT NULL,
  `phone1` bigint(30) NOT NULL,
  `phone2` bigint(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fb` varchar(50) NOT NULL,
  `insta` varchar(50) NOT NULL,
  `twt` varchar(50) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `address`, `google_map`, `phone1`, `phone2`, `email`, `fb`, `insta`, `twt`, `iframe`) VALUES
(1, 'Head-office 101-Vip Road, Vesu, Surat', 'https://maps.app.goo.gl/pz9hSg6LPBa6G9MB6', 91955823300, 919824786581, 'sayyedfaizan9558@gmail.com', 'https://www.facebook.com', 'https://www.instagram.com/fyzu_95', 'https://www.x.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d238133.05988591036!2d72.822296!3d21.1592!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563:0xfe4558290938b042!2sSurat, Gujarat!5e0!3m2!1sen!2sin!4v1708079464969!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `nested_categories`
--

CREATE TABLE `nested_categories` (
  `id` int(11) NOT NULL,
  `nested_category` varchar(150) NOT NULL,
  `category_id` int(50) NOT NULL,
  `sub_category_id` int(50) NOT NULL,
  `icon_img` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nested_categories`
--

INSERT INTO `nested_categories` (`id`, `nested_category`, `category_id`, `sub_category_id`, `icon_img`) VALUES
(4, 'Best Seller', 2, 20, 'IMG_8572.png'),
(7, 'Threading and Face Waxing', 2, 20, 'IMG_3002.png'),
(8, 'Facial And Cleanup', 2, 20, 'IMG_7655.jpg'),
(9, 'Blow-dry and Style', 2, 21, 'IMG_6438.jpg'),
(10, 'Mens haircut', 1, 25, 'IMG_2221.png'),
(11, 'Beard Point', 1, 25, 'IMG_6233.jpg'),
(12, 'Ac Maintenance', 3, 29, 'IMG_8268.jpg'),
(13, 'AC Repair', 3, 29, 'IMG_9445.jpeg'),
(14, 'Janitors', 4, 26, 'IMG_6895.jpg'),
(15, 'Full Sofa Clean', 4, 27, 'IMG_8567.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(120) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `nested_id` int(11) NOT NULL,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `price`, `description`, `category_id`, `sub_category_id`, `nested_id`, `removed`) VALUES
(1, 'Hair Color', 2899, '- New Look,\r\n- Wide Range,', 2, 4, 1, 1),
(2, 'Hair Color', 2599, '- Get New look,\r\n- New Colors,\r\n- Shiny Finish,', 2, 4, 2, 1),
(3, 'Hair shiny', 2559, '- new look avaliable,', 2, 4, 2, 1),
(4, 'bouncy look', 5869, '- new points,\r\n- new age,', 2, 4, 1, 1),
(5, 'new form', 5896, '- new gaie kjcndjc,\r\n- dcldsnc,', 2, 4, 1, 1),
(6, 'Hair curly', 299, '- curly look to your hair,\r\n- found your selve beautiful,', 2, 4, 1, 1),
(7, 'Waxing And Facial', 2249, '- Waxing - Full Arms Rica Rollon + Full Legs Rollon,\r\n- Facial + Cleanup - L&#039;Oreal Facewash,\r\n- Threading + Face Waxing - Upper_Lips,', 2, 20, 4, 0),
(8, 'ManiCure And Pedicure', 2999, '- Pedicure - Elsynia Chocolate and Vanilla Pedicure,\r\nIndulge in the ultimate pampering experience without leaving the comfort\r\n- Manicure - Elsynia Chocolate and Vanilla manicure,', 2, 20, 4, 0),
(9, 'Waxing And HairCare', 2100, '- Waxing - Full Arms Rica Rollon,\r\n- Hair Spa + Hair Color,', 2, 20, 4, 0),
(10, 'Full Arms + Full Legs', 2399, '- Waxing - Chocolate Roll on + Full Arms,\r\n- Choco Roll on + Full Legs,', 2, 20, 5, 0),
(11, 'Threading', 149, 'Good Quality Threads for Facial Area Hair Removal And Desire Eyebrow Shape', 2, 20, 7, 0),
(12, 'Sara Fruit Cleanup', 2355, '- Skin Protection From UV Rays,\r\n- Orange Peel Extract goods,', 2, 20, 8, 0),
(13, 'Chreyl By LOreal Facial', 2356, '- Specially Recomended for Dry Skin,\r\n- Included moulded mask and neck and Palm Massage,', 2, 20, 8, 0),
(14, 'O3 + Shiny and Glow Facial', 2355, '- Reduce hyperpigmentation and uneven tone,\r\n- With AvA Formula Facials and Moulded Masks,\r\n- Include 15 min dry- head and Palm Massage,', 2, 20, 8, 0),
(15, 'Blow Dry Striagthen and Smooth', 700, '- For all type of the hair Smooth Straight and classic look,', 2, 21, 9, 0),
(16, 'Classic Men HairCut and Fine', 256, '- Classic Trendy look,\r\n- Fine Cut by proffesional,', 1, 25, 10, 0),
(17, 'Beard Trim and Cut', 249, '- Get Fine cut and angle,\r\n- Beardo look,\r\n- Muscular men cuts,', 1, 25, 11, 0),
(18, 'Classic Beard for Sigma', 255, '- Weeding Beard,\r\n- Cut with sharp and fine blades,', 1, 25, 11, 0),
(19, 'Premium Cuts For men', 350, '- New Cuts with premium equipments,\r\n- Razor sharp cuts,', 1, 25, 10, 0),
(20, 'Ac Maintenance Full Cleaning', 500, '- Get Fresh Air after clean,\r\n- Ac Clean by proffesional,', 3, 29, 12, 0),
(21, 'Outdoor Service', 450, '- Get Full Service with outdoor Cleaning,\r\n- Get Proffesional for work,', 3, 29, 12, 0),
(22, 'Ac Back to life', 785, '- Here is the repair point,\r\n- Hazzle free repairs,\r\n- service at home,', 3, 29, 13, 0),
(23, 'Full House Cleaning Service', 456, '- Get Clean you house,\r\n- Hassle Free Service,\r\n- Cleaned by proffesionals,', 4, 26, 14, 0),
(24, 'Full house cleaning', 785, '- Clean you full house,\r\n- doors and windows too,', 4, 26, 14, 0),
(25, 'Full Sofa Cleaning', 1100, '- Get Clean your Sofa,\r\n- Services at door steps,\r\n- Nice staff,', 4, 27, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `services_images`
--

CREATE TABLE `services_images` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_images`
--

INSERT INTO `services_images` (`id`, `service_id`, `image`, `thumb`) VALUES
(13, 7, 'IMG_1456.jpg', 1),
(14, 8, 'IMG_8405.png', 1),
(15, 9, 'IMG_6049.jpg', 1),
(16, 10, 'IMG_6373.jpg', 1),
(17, 11, 'IMG_7013.jpg', 1),
(18, 12, 'IMG_5267.png', 1),
(19, 13, 'IMG_7915.png', 1),
(20, 14, 'IMG_3387.png', 1),
(21, 15, 'IMG_2884.jpg', 1),
(22, 16, 'IMG_5354.jpg', 1),
(23, 17, 'IMG_6373.jpg', 1),
(24, 18, 'IMG_2519.jpg', 1),
(25, 19, 'IMG_3934.jpg', 1),
(26, 20, 'IMG_3294.jpg', 1),
(28, 21, 'IMG_1663.jpg', 1),
(29, 22, 'IMG_7356.jpg', 1),
(30, 23, 'IMG_2238.jpg', 1),
(31, 24, 'IMG_3246.jpg', 1),
(32, 25, 'IMG_8420.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_about` varchar(550) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_logo`, `site_about`, `shutdown`) VALUES
(1, 'IMG_6322.png', 'HomeCareFix is your ultimate destination for all your home service needs. Whether you are looking for professional cleaning services for your bathroom, salon services right at your doorstep for women, or expert haircutting services for men', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` varchar(250) NOT NULL,
  `sub_icon` varchar(200) NOT NULL,
  `video` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `sub_category`, `sub_icon`, `video`, `status`) VALUES
(20, 2, 'Salon For Women', 'IMG_5870.svg', 'VID_1209.mp4', 0),
(21, 2, 'Hair Studio for Women', 'IMG_3028.svg', 'VID_7983.mp4', 0),
(25, 1, 'Men Classic', 'IMG_8129.svg', 'VID_8588.mp4', 0),
(26, 4, 'Glass Cleaning', 'IMG_3998.svg', 'VID_3198.mp4', 0),
(27, 4, 'Sofa Cleaning', 'IMG_5249.svg', 'VID_6892.mp4', 0),
(28, 4, 'Complete Clean', 'IMG_8998.svg', 'VID_6894.mp4', 0),
(29, 3, 'AC Maintenance', 'IMG_8788.svg', 'VID_8704.mp4', 0),
(30, 3, 'Appliance Repair', 'IMG_6171.svg', 'VID_7012.mp4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `picture` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`id`, `name`, `picture`, `position`, `info`) VALUES
(25, 'Kanaz Willson', 'IMG_2319.jpg', 'CTO at HomeCareFix', 'The brilliant mind behind HomeCareFixs technological advancements. As Chief Technology Officer Kanaz Willson orchestrates the seamless integration of cutting-edge technology into our home service solu'),
(26, 'Mark Son', 'IMG_5779.jpg', 'CEO at HomeCareFix', 'The visionary leader behind HomeCareFix success story. With a passion for delivering exceptional home services and a drive for innovation.Their strategic vision and commitment to customer satisfaction'),
(27, 'Liza Frandnis', 'IMG_3422.jpg', 'COO at Homecarefix', 'Our dedicated Marketing Specialist at HomeCareFix. With a creative flair and a strategic mindset, Liza brings innovative marketing campaigns to life, driving brand awareness and customer engagement to');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(5, 'will jonas', 'sayyedfaizan9558@gmail.com', 'Near Madina masjid\r\nLimbayat', '9558233163', 394210, '$2y$10$OOsYmCuazhBj4xMXY81XkuhdPfE694IUh3ATbJ79xtMkSbHGcwlhy', 1, NULL, NULL, 1, '2024-03-18 23:44:01'),
(7, 'Sayyed Faizan', 'faiz95582331631@gmail.com', '1234 Maple Avenue,\r\nLos Angeles, CA 90001', '6356080306', 394210, '$2y$10$Lk0jcP1o5aKkOg92ClA4IeKOemDr9WjRlzEaQ6p2jbnOVw5qMaN1u', 1, '8f6860132f185ef0f587db4c8618fda8', NULL, 1, '2024-04-07 23:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_inqueries`
--

CREATE TABLE `user_inqueries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_inqueries`
--

INSERT INTO `user_inqueries` (`id`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(30, 'Icealias', 'giya@gmail.com', 'Not Satisfied', 'I&#039;m writing this to say that iam not satisfied with your site you have need to implement more functionality', '2024-02-23', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_auth`
--
ALTER TABLE `admin_auth`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `booking_order_service`
--
ALTER TABLE `booking_order_service`
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nested_categories`
--
ALTER TABLE `nested_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fetching Cat_name1` (`category_id`),
  ADD KEY `Fetching Sub_name` (`sub_category_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_images`
--
ALTER TABLE `services_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fetching Cat_name` (`category_id`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_inqueries`
--
ALTER TABLE `user_inqueries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_auth`
--
ALTER TABLE `admin_auth`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nested_categories`
--
ALTER TABLE `nested_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services_images`
--
ALTER TABLE `services_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_inqueries`
--
ALTER TABLE `user_inqueries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD CONSTRAINT `booking_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_cred` (`id`);

--
-- Constraints for table `booking_order_service`
--
ALTER TABLE `booking_order_service`
  ADD CONSTRAINT `booking_order_service_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_order` (`booking_id`),
  ADD CONSTRAINT `booking_order_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `nested_categories`
--
ALTER TABLE `nested_categories`
  ADD CONSTRAINT `Fetching Cat_name1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `Fetching Sub_name` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `services_images`
--
ALTER TABLE `services_images`
  ADD CONSTRAINT `services_images_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `Fetching Cat_name` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
