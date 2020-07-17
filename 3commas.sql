-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2018 at 01:10 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3commas`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `api_key` text,
  `secret_key` text,
  `deal_count` int(11) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--
-- --------------------------------------------------------

--
-- Table structure for table `bots`
--

CREATE TABLE `bots` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `completed_deals_usd_profit` int(11) DEFAULT NULL,
  `active_deals_usd_profit` int(11) DEFAULT NULL,
  `total_usd_profit` int(11) DEFAULT NULL,
  `pairs` varchar(1000) DEFAULT NULL,
  `take_profit` double DEFAULT NULL,
  `base_order_volume` double DEFAULT NULL,
  `safety_order_volume` double DEFAULT NULL,
  `max_active_deals` int(11) DEFAULT NULL,
  `safety_order_step_percentage` double DEFAULT NULL,
  `martingale_volume_coefficient` double DEFAULT NULL,
  `martingale_step_coefficient` double DEFAULT NULL,
  `strategy_list` varchar(1000) DEFAULT NULL,
  `take_profit_type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `max_safety_orders` int(11) DEFAULT NULL,
  `active_safety_orders_count` int(11) DEFAULT NULL,
  `is_enabled` tinyint(1) DEFAULT NULL,
  `active_deals_count` int(11) DEFAULT NULL,
  `deletable?` tinyint(1) DEFAULT NULL,
  `strategy` varchar(255) DEFAULT NULL,
  `base_order_volume_type` varchar(255) DEFAULT NULL,
  `safety_order_volume_type` varchar(255) DEFAULT NULL,
  `api_key_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bots`
--
-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE `deals` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `bot_id` int(11) DEFAULT NULL,
  `bot_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `pair` varchar(255) DEFAULT NULL,
  `take_profit` double DEFAULT NULL,
  `base_order_volume` double DEFAULT NULL,
  `safety_order_volume` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `final_profit` double DEFAULT NULL,
  `usd_final_profit` double DEFAULT NULL,
  `final_profit_percentage` double DEFAULT NULL,
  `actual_profit` double DEFAULT NULL,
  `actual_usd_profit` double DEFAULT NULL,
  `actual_profit_percentage` double DEFAULT NULL,
  `safety_order_step_percentage` double DEFAULT NULL,
  `martingale_coefficient` int(11) DEFAULT NULL,
  `take_profit_type` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `max_safety_orders` int(11) DEFAULT NULL,
  `active_safety_orders_count` int(11) DEFAULT NULL,
  `closed_at` varchar(255) DEFAULT NULL,
  `bought_volume` double DEFAULT NULL,
  `bought_amount` double DEFAULT NULL,
  `from_currency` varchar(255) DEFAULT NULL,
  `to_currency` varchar(255) DEFAULT NULL,
  `from_currency_id` int(11) DEFAULT NULL,
  `to_currency_id` int(11) DEFAULT NULL,
  `sold_volume` double DEFAULT NULL,
  `sold_amount` double DEFAULT NULL,
  `cancellable?` tinyint(1) DEFAULT NULL,
  `panic_sellable?` tinyint(1) DEFAULT NULL,
  `bought_average_price` double DEFAULT NULL,
  `take_profit_price` double DEFAULT NULL,
  `current_price` double DEFAULT NULL,
  `finished?` tinyint(1) DEFAULT NULL,
  `failed_message` varchar(255) DEFAULT NULL,
  `completed_safety_orders_count` int(11) DEFAULT NULL,
  `current_active_safety_orders` int(11) DEFAULT NULL,
  `reserved_base_coin` double DEFAULT NULL,
  `reserved_second_coin` double DEFAULT NULL,
  `deal_has_error` tinyint(1) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `base_order_volume_type` varchar(255) DEFAULT NULL,
  `safety_order_volume_type` varchar(255) DEFAULT NULL,
  `api_key_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deals`
--
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--
--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deals`
--
ALTER TABLE `deals`
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
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
