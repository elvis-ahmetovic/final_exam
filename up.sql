-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 10:49 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `up`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

CREATE TABLE `administration` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Admin',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`id`, `username`, `password`) VALUES
(1, 'Admin', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_publisher` int(11) DEFAULT NULL,
  `admin_publisher` int(1) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `user_publisher`, `admin_publisher`, `deleted`) VALUES
(1, 'Fitness', NULL, 1, 0),
(2, 'Aerobic', NULL, 1, 0),
(3, 'Swimming', NULL, 1, 0),
(4, 'Skiing', NULL, 1, 0),
(5, 'Martial Arts', 13, NULL, 0),
(6, 'Tennis', NULL, 1, 0),
(7, 'Condition', NULL, 1, 0),
(8, 'Shooting', NULL, 1, 0),
(19, 'Cycling', 13, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `price` float(4,2) NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `titleMsg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `textMsg` text COLLATE utf8_unicode_ci NOT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id`, `userId`, `categoryId`, `price`, `phone`, `titleMsg`, `textMsg`, `regDate`) VALUES
(2, 1, 1, 20.00, '132456789', 'There are many variations', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', '2020-11-02 09:43:32'),
(3, 2, 2, 20.00, '987654321', 'If you are going to use a passage', ' If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', '2020-11-02 09:43:57'),
(4, 3, 3, 19.00, '456123789', 'All the Lorem Ipsum generators', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.', '2020-11-02 09:44:28'),
(13, 29, 2, 18.00, '061111222', 'Duis tempus metus', 'Duis tempus metus id justo pulvinar sodales. Curabitur at augue placerat, consequat lectus eu, pellentesque justo. Etiam egestas finibus velit, ut sagittis ante fringilla nec. Curabitur elementum.', '2020-11-02 09:45:13'),
(16, 30, 6, 45.00, '111222333', 'Curabitur elementum', 'Curabitur elementum, lacus sit amet maximus lacinia, felis mauris dignissim nisl, at luctus nulla lorem vitae nisl. Pellentesque faucibus nulla eu tempor viverra. Aenean iaculis suscipit metus, ut hendrerit augue varius fermentum. Duis tincidunt, velit a malesuada imperdiet, est tortor bibendum turpis, vel cursus eros lacus nec felis.', '2020-11-02 09:45:30'),
(17, 44, 4, 30.00, '061245879', 'In consequat augue nec', 'In consequat augue nec blandit placerat. Vestibulum eleifend massa nulla, ut molestie lorem blandit ut. Etiam ultrices neque massa, vitae facilisis nisi eleifend sed. Curabitur blandit rutrum nisl. Aenean at orci sagittis, efficitur massa et, porttitor dolor. Nulla placerat velit quis arcu efficitur fermentum. Quisque ac arcu risus.', '2020-11-02 09:45:49'),
(18, 45, 5, 20.00, '061122455', 'Etiam finibus rutrum varius', 'Donec non velit ante. Etiam eu lacus ut lorem pretium tempus quis at felis. Phasellus posuere, orci vel interdum eleifend, sem arcu ullamcorper tellus, et aliquam quam elit in orci. Nunc nisl mi, interdum eget dolor ut, tincidunt luctus mi. Suspendisse potenti. Ut egestas nunc eget metus rutrum rutrum. Nam vitae laoreet quam. Donec bibendum dui nisi, quis sagittis leo hendrerit ac. In ac hendrerit ligula, sed gravida dui.', '2020-11-02 09:46:16'),
(19, 31, 8, 19.00, '064546455', 'Sed scelerisque', 'Curabitur dictum semper sollicitudin. In urna neque, tincidunt quis semper sed, sollicitudin non augue. Pellentesque porttitor mauris ac lacus tempus, vitae pellentesque ex convallis. Donec blandit mauris vitae massa pellentesque mattis.', '2020-11-02 09:46:39'),
(28, 46, 19, 22.50, '0644567853', 'Ut pellentesque turpis', 'Aliquam erat volutpat. Mauris rhoncus nulla mauris, id porta neque consequat in. Maecenas quis nulla feugiat, gravida est at, semper augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, dui nec dapibus rutrum, lorem sem bibendum metus, eu efficitur nisl lacus a magna. Vivamus id augue orci. Integer iaculis id orci a tempor.', '2020-11-02 09:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `sendDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(1) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `participant_1` int(11) NOT NULL,
  `participant_2` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversationId` int(11) NOT NULL,
  `msg_from` int(11) NOT NULL,
  `msg_to` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `sendTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motivation_msgs`
--

CREATE TABLE `motivation_msgs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `user_publisher` int(11) DEFAULT NULL,
  `admin_publisher` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `motivation_msgs`
--

INSERT INTO `motivation_msgs` (`id`, `title`, `text`, `user_publisher`, `admin_publisher`) VALUES
(1, 'You are your own biggest project', 'There is only one corner of the universe you can be certain of improving, and that´s your own self.', NULL, 1),
(2, 'Start somewhere', 'Don´t judge each day by the harvest you reap but by the seeds that you plant.', NULL, 1),
(3, 'Get over the mental block', 'Do not give up, the beginning is always the hardest.', NULL, 1),
(4, 'Take it day by day', 'Smile and let everyone know that today, you´re a lot stronger then you were yesterday.', NULL, 1),
(5, 'Embrace challenges with poise', 'When life puts you in tough situations, don´t say \"why me\" just say \"try me\".', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `coachId` int(11) NOT NULL,
  `noteBody` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noimage.png',
  `regDate` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `coachStatus` int(1) NOT NULL DEFAULT '0',
  `adminStatus` int(1) NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `username`, `email`, `password`, `city`, `birthDate`, `gender`, `avatar`, `regDate`, `coachStatus`, `adminStatus`, `banned`) VALUES
(1, 'Cristian', 'Magnussen', 'Cris', 'cristian.magnussen@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Copnehagen', '7/8/1980', 'male', 'avatar14.jpg', '2020-04-28 20:24:46.658150', 1, 0, 0),
(2, 'Nail', 'McNally', 'mc_nail', 'mc.nail@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Glazgow', '4/5/1988', 'male', 'avatar8.png', '2020-04-20 20:30:30.936133', 1, 0, 0),
(3, 'Monica', 'Paloski', 'molly', 'monica.mollyy@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Venezia', '11/5/1991', 'female', 'avatar1.png', '2020-04-15 16:01:21.432806', 1, 0, 0),
(29, 'Maria', 'Gutierez', 'maria_g', 'gutierezmaria@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'La Paz', '17/4/1989', 'female', 'neira.png', '2020-04-15 11:53:56.450414', 1, 0, 0),
(30, 'Diana', 'Banaszewski', 'dixie', 'diana_banaszewski@hotmil.com', 'e10adc3949ba59abbe56e057f20f883e', 'Katowice', '31/12/1988', 'female', 'dixi.png', '2020-05-01 15:23:28.362061', 1, 0, 1),
(31, 'John', 'Arnold', 'johnny', 'johnarnold@live.com', 'e10adc3949ba59abbe56e057f20f883e', 'London', '4/7/1988', 'male', 'prim.jpg', '2020-04-15 16:06:39.884694', 1, 0, 0),
(44, 'Mario', 'Reyes', 'mario.r', 'mario.reyes@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Buenos Aires', '17/5/1990', 'male', 'mario.png', '2020-03-19 12:18:35.194861', 1, 0, 0),
(45, 'Luiz', 'Romario', 'roma', 'luiz.romario@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Rio de Janeiro', '14/5/1989', 'male', 'kisspng-ninja-ico-icon-black-ninja-5a6dee087cdc18.5588411915171538005114.jpg', '2020-04-14 12:14:45.283613', 1, 0, 0),
(46, 'akira', 'shingo', 'akira', 'akira.shingo@live.com', 'e10adc3949ba59abbe56e057f20f883e', 'osaka', '12/7/1995', 'female', '844c7240760693.578c9a46dd92f.gif', '2020-05-06 13:25:50.255581', 1, 0, 0),
(48, 'fabio', 'ravanelli', 'fabio', 'fabioravanelli@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Pescara', '14/5/2000', 'male', 'noimage.png', '2020-05-06 13:21:48.502657', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_publisher`) USING BTREE,
  ADD KEY `admin` (`admin_publisher`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `coach_ibfk_4` (`categoryId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_1` (`participant_1`),
  ADD KEY `participant_2` (`participant_2`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`msg_from`),
  ADD KEY `conversationId` (`conversationId`),
  ADD KEY `msg_to` (`msg_to`);

--
-- Indexes for table `motivation_msgs`
--
ALTER TABLE `motivation_msgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_publisher`),
  ADD KEY `admin` (`admin_publisher`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coachId` (`coachId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administration`
--
ALTER TABLE `administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motivation_msgs`
--
ALTER TABLE `motivation_msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`user_publisher`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `categories_ibfk_3` FOREIGN KEY (`admin_publisher`) REFERENCES `administration` (`id`);

--
-- Constraints for table `coach`
--
ALTER TABLE `coach`
  ADD CONSTRAINT `coach_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `coach_ibfk_4` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`participant_1`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`participant_2`) REFERENCES `user` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`msg_from`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`conversationId`) REFERENCES `conversations` (`id`),
  ADD CONSTRAINT `messages_ibfk_4` FOREIGN KEY (`msg_to`) REFERENCES `user` (`id`);

--
-- Constraints for table `motivation_msgs`
--
ALTER TABLE `motivation_msgs`
  ADD CONSTRAINT `motivation_msgs_ibfk_1` FOREIGN KEY (`admin_publisher`) REFERENCES `administration` (`id`),
  ADD CONSTRAINT `motivation_msgs_ibfk_2` FOREIGN KEY (`user_publisher`) REFERENCES `user` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`coachId`) REFERENCES `coach` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
