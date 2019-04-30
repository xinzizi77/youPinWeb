-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-05-01 11:07:13
-- 服务器版本： 5.7.18-log
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `company_name` varchar(200) DEFAULT NULL,
  `company_type` varchar(200) DEFAULT NULL,
  `company_property` text,
  `company_info` text,
  `charger_man` varchar(200) DEFAULT NULL,
  `company_phone` text,
  `company_place_p` text,
  `company_place_c` text,
  `main_place` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `company`
--

INSERT INTO `company` (`id`, `u_id`, `company_name`, `company_type`, `company_property`, `company_info`, `charger_man`, `company_phone`, `company_place_p`, `company_place_c`, `main_place`) VALUES
(1, 1, '1', '2', '3', '4', '5', '6', '7', '8', '10');

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
  `sex` varchar(11) DEFAULT NULL,
  `birth` datetime DEFAULT NULL,
  `phoneNumber` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`id`, `u_id`, `jobType`, `WorkPlace`, `MoneyWant`, `name`, `sex`, `birth`, `phoneNumber`) VALUES
(1, 1, '1', '2', '3', '4', '1', '2000-01-16 00:00:00', '7'),
(2, 3, '教师', '长沙', '4000', '舒彩华', '2', '1998-07-27 00:00:00', '18056479521');

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
  `sex` int(11) DEFAULT NULL,
  `birth` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_table`
--

INSERT INTO `user_table` (`id`, `email`, `type`, `p_id`, `love_id`, `username`, `password`, `sex`, `birth`, `status`, `update_time`) VALUES
(1, 'admin@admin.com', 'user', '0_version_pictures.jpg', '1|2|3|4|5', 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 1, '2018-03-20 12:57:10'),
(2, '1015110571@qq.com', 'user', '0_version_pictures.jpg', '10690|10687|10691|8363', 'qweqwe', 'c046a7a28200b47e6e7f0bfc0be93cc4', 1, '2018-04-28', 1, '2018-04-04 11:30:44'),
(3, '767718235@qq.com', 'user', '0_version_pictures.jpg', '|11360|11357|11352|11351', '舒彩华77', 'eb670c149e00069e87d9ba07d5e2630a', NULL, NULL, 1, '2018-04-29 11:46:31'),
(4, '691544220@qq.com', 'user', '0_version_pictures.jpg', '11427|11423|11430', 'Vera', 'e99a18c428cb38d5f260853678922e03', NULL, NULL, 1, '2018-04-30 08:46:16');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
