-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2020 at 05:14 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `assigned_to` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IT', '2019-09-22 13:29:47', '2019-09-22 15:23:54', NULL),
(2, 'Network', '2019-09-22 13:33:17', '2019-09-22 13:33:17', NULL),
(3, 'Culture', '2019-09-22 14:17:48', '2019-10-07 16:20:56', NULL),
(4, 'Sales', '2020-01-10 23:42:23', '2020-01-10 23:42:23', NULL),
(5, 'Customers', '2020-01-23 15:53:49', '2020-01-23 15:53:49', '2020-01-23 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `e_sub_task`
--

CREATE TABLE `e_sub_task` (
  `id` int(10) NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL DEFAULT 'Not Done',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_sub_task`
--

INSERT INTO `e_sub_task` (`id`, `task_id`, `name`, `Status`, `created_at`, `updated_at`) VALUES
(1, 25, 'new', 'Done', '2020-02-13 10:57:51', '2020-02-13 18:57:50'),
(3, 25, 'jimmy', 'Done', '2020-02-15 12:52:53', '2020-02-15 23:52:53'),
(4, 28, 'hi', 'Done', '2020-02-15 12:56:07', '2020-02-15 23:56:07'),
(5, 28, 'bnv', 'Done', '2020-02-17 17:00:05', '2020-02-18 04:00:05'),
(6, 28, 'jkui', 'Done', '2020-02-19 16:34:33', '2020-02-20 03:34:33'),
(7, 28, 'jkukj', 'Done', '2020-02-19 16:35:31', '2020-02-20 03:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_01_12_140835_add_created_by_column', 1),
(2, '2020_01_12_141708_change_column_name', 2);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2019-09-22 15:05:25', '2019-09-22 15:05:25'),
(2, 'User', '2019-09-22 15:05:25', '2019-09-22 15:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 4, 1),
(2, 5, 2),
(3, 3, 2),
(4, 7, 2),
(7, 11, 2),
(9, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `priority` varchar(10) NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `Status` varchar(10) DEFAULT '0',
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '3',
  `startDate` varchar(20) NOT NULL,
  `endDate` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `priority`, `department_id`, `user_id`, `description`, `Status`, `created_by`, `startDate`, `endDate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 'ongea', 'High', 1, 3, 'ASAP', '1', 7, '2020-02-10', '2020-02-15', '2020-02-10 19:16:09', '2020-02-20 04:09:29', '2020-02-20 04:09:29'),
(26, 'Fua', 'High', 1, 3, 'NOW', '1', 7, '2020-02-10', '2020-02-14', '2020-02-10 23:42:20', '2020-02-20 04:09:34', '2020-02-20 04:09:34'),
(28, 'wow', 'High', 1, 3, 'wow', '1', 7, '2020-02-13', '2020-02-27', '2020-02-13 22:31:28', '2020-02-20 04:09:25', '2020-02-20 04:09:25'),
(30, 'new', 'High', 1, 3, 'new', '1', 7, '2020-02-19', '2020-02-24', '2020-02-20 04:10:45', '2020-03-03 03:01:52', NULL),
(31, 'Niaje Mwamba', 'High', 1, 3, 'jiminho hapaaa', '0', 3, '2020-03-02', '2020-03-10', '2020-03-03 03:03:17', '2020-03-03 03:09:25', '2020-03-03 03:09:25'),
(32, 'Review the Mail', 'High', 3, 7, 'Review it ASAP', '0', 3, '2020-03-02', '2020-03-10', '2020-03-03 03:06:19', '2020-03-03 03:06:19', NULL),
(33, 'HHH', 'High', 1, 3, 'FFFFFFFFFFFFFFFFFFFFFFFFF', '0', 3, '2020-03-02', '2020-03-09', '2020-03-03 03:07:58', '2020-03-03 03:09:20', '2020-03-03 03:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` text NOT NULL,
  `middle_name` text NOT NULL,
  `last_name` text NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `department_id`, `phone_no`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'James', 'Paul', 'Kilenga', 1, '0768984763', 'jiminho360@gmail.com', '$2y$10$6UMfiNUzkvxOc2LTafd3HOL0.HRjG58Piql1ujQQPfLA/XxQgKeX.', '1579619019.jpg', 'zSz46ThHEyUjkZiNx3bLgJhtB6AM5HssAoXa4mlDfsyJJqkkIuPScUhTluX7', '2019-10-04 16:55:30', '2020-01-21 23:03:39', NULL),
(4, 'Hamidu', 'Rajabu', 'Kobelo', 1, '0768456382', 'hamidu@gmail.com', '$2y$10$TdfQBB.1kc79Xbw03r3/NuCk47t1P4d/L9BCEQLR029/CdpMDophm', '1582128838.jpg', 'H9zVwdbhNvH0AQnWwO1v4hOxxtTmapeondrJd9E4jHSt7LctMMgbDobGqJky', '2019-10-05 12:18:33', '2020-02-20 03:13:58', NULL),
(5, 'Joyce', 'Charles', 'Kibendo', 2, '0786953895', 'joy@gmail.com', '$2y$10$6UMfiNUzkvxOc2LTafd3HOL0.HRjG58Piql1ujQQPfLA/XxQgKeX.', '1580188110.png', '2CD8Gy085Z7cBvxPi9PYMt3kiTl96X7HBzoMP1Pp3wtPWn2Em9dmGcngwLw0', '2019-10-05 12:19:44', '2020-01-28 13:08:34', NULL),
(6, 'Joel', 'Jackson', 'Mushi', 2, '0684924533', 'joel@gmail.com', '$2y$10$kjmG9EIKl2B5hgXbe330Z.HjUCcdnyChtxoLtsT.ozrrqTUiE/NMu', '1579549650.jpg', 'v81mUkFxv7H4ZlV6qohIdKFiCHoR8jt6kPwXX4dFtto04z0TxSssqLdG4GEt', '2019-10-05 12:20:30', '2020-01-21 03:47:30', NULL),
(7, 'Godfrey', 'Bahati', 'Charles', 3, '0786546372', 'godfreybahati14@gmail.com', '$2y$10$evDknAptwcVn4aMY4TxHdeN6xmsXF1XMXPzQ806Kyq3sv1i.xFYha', '1581066467.png', '9PCMTYiQzHfv1nrt39hM74nRFmZgqVUkdu7LQesI1LSOKYoqyIw7FfobzJo9', '2019-10-05 13:10:48', '2020-02-07 17:07:48', NULL),
(11, 'John', 'Paul', 'Richard', 4, '0789654372', 'john@gmail.com', '$2y$10$IXIXj/Z4mObDOB7cQTx/Mug0VrLRVSfRAp6DSci2bkZ3eeRxP03oC', 'default.jpg', '8Yd4QXIkfoUBtxYl86l4tkBWfjh1yyjnvDzoXkG6dnZj1c24AVxuI44DdjGd', '2020-02-11 18:45:04', '2020-02-11 18:45:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_sub_task`
--
ALTER TABLE `e_sub_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `e_sub_task`
--
ALTER TABLE `e_sub_task`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `e_sub_task`
--
ALTER TABLE `e_sub_task`
  ADD CONSTRAINT `e_sub_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
