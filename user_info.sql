-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-31 02:00:54
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_info`
--

-- --------------------------------------------------------

--
-- 表的结构 `company`
--

CREATE TABLE `company` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_id` int(11) NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  `company_type` varchar(200) DEFAULT NULL,
  `company_info` text,
  `charger_man` varchar(200) DEFAULT NULL,
  `phoneNumber` text,
  `company_name` varchar(200) DEFAULT NULL,
  `company_phone` text,
  `company_place` text,
  `main_place` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `picture`
--

CREATE TABLE `picture` (
  `id` int(10) UNSIGNED NOT NULL,
  `src` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `picture`
--

INSERT INTO `picture` (`id`, `src`) VALUES
(1, './upload/4_version_pictrues.jpg'),
(2, './upload/16_version_pictrues.jpg'),
(3, './upload/17_version_pictrues.jpg'),
(4, './upload/18_version_pictrues.jpg'),
(5, './upload/19_version_pictrues.jpg'),
(6, './upload/20_version_pictrues.jpg'),
(7, './upload/21_version_pictrues.jpg'),
(8, './upload/22_version_pictrues.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_id` int(11) NOT NULL,
  `jobType` varchar(50) NOT NULL,
  `WorkPlace` varchar(50) NOT NULL,
  `MoneyWant` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sex` int(11) DEFAULT NULL,
  `birth` datetime DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`id`, `u_id`, `jobType`, `WorkPlace`, `MoneyWant`, `name`, `sex`, `birth`, `phoneNumber`) VALUES
(1, 1, '1', '2', '3', '4', 5, '2000-01-16 00:00:00', '7');

-- --------------------------------------------------------

--
-- 表的结构 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` text NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'user',
  `p_id` text,
  `love_id` text,
  `username` text NOT NULL,
  `password` char(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `change_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_table`
--

INSERT INTO `user_table` (`id`, `email`, `type`, `p_id`, `love_id`, `username`, `password`, `status`, `update_time`, `change_time`) VALUES
(1, 'admin@admin.com', 'user', '0_version_pictures.jpg', '1|2|3|4|5', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, '2018-03-20 12:57:10', '2018-03-20 12:57:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
