-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 26, 2017 lúc 03:30 SA
-- Phiên bản máy phục vụ: 5.7.14
-- Phiên bản PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `messenger`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `close_tab_notification`
--

CREATE TABLE `close_tab_notification` (
  `file_name_using` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_chat_with` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `close_tab_notification`
--

INSERT INTO `close_tab_notification` (`file_name_using`, `user_chat_with`, `date_created`) VALUES
('embe1_tai', '', '2017-10-22 20:03:27'),
('ngoc_tai', '', '2017-10-22 20:08:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `last_seen`
--

CREATE TABLE `last_seen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logout_notification`
--

CREATE TABLE `logout_notification` (
  `sendner` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `notificated_to` text COLLATE utf8_unicode_ci,
  `logout_moment` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `logout_notification`
--

INSERT INTO `logout_notification` (`sendner`, `notificated_to`, `logout_moment`) VALUES
('tai', '["ngoc"]', '2014-02-01 10:12:12'),
('tai', '["ngoc"]', '2017-09-26 11:31:10'),
('tai', '["ngoc"]', '2017-09-26 12:20:17'),
('tai', '["ngoc"]', '2017-09-26 12:22:46'),
('tai', '["ngoc"]', '2017-09-27 10:58:32'),
('tai', '["ngoc"]', '2017-09-27 11:01:34'),
('tai', '["ngoc"]', '2017-09-27 11:08:05'),
('tai', '["ngoc"]', '2017-09-27 11:08:32'),
('tai', '["ngoc"]', '2017-09-27 11:11:32'),
('tai', '', '2017-09-27 11:14:54'),
('tai', '', '2017-09-27 11:19:59'),
('tai', '', '2017-09-27 11:27:54'),
('tai', '', '2017-09-27 11:28:45'),
('tai', '', '2017-09-27 11:29:16'),
('tai', '', '2017-10-01 15:50:40'),
('tai', '', '2017-10-01 16:04:15'),
('embe1', '', '2017-10-01 16:04:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `file_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `body` longtext NOT NULL,
  `user_from` text NOT NULL,
  `date_sent` datetime NOT NULL,
  `not_received` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`file_name`, `body`, `user_from`, `date_sent`, `not_received`) VALUES
('embe_tai', 'chuáº©n r&ugrave;i kaka', 'tai', '2017-10-11 22:08:37', ''),
('embe1_ngoc', 'hÆ¡i b&ugrave;n', 'embe1', '2017-10-04 11:38:39', ''),
('embe1_tai', 'cho ngáº¯n láº¡i 1 ch&uacute;t, hihi', 'embe1', '2017-10-22 20:07:18', ''),
('ngoc_tai', 'ok', 'ngoc', '2017-10-22 20:07:56', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `friend_list` text,
  `request_list` text,
  `waiting_list` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `date_created`, `friend_list`, `request_list`, `waiting_list`) VALUES
(5, 'ngoc', 'e10adc3949ba59abbe56e057f20f883e', '2017-09-07 00:00:00', '["tai"]', '', ''),
(7, 'embe', 'e10adc3949ba59abbe56e057f20f883e', '2017-09-15 09:29:58', '', '', ''),
(8, 'embe1', '96e79218965eb72c92a549dd5a330112', '2017-09-15 09:31:09', '["tai"]', '', ''),
(9, 'tai', 'e10adc3949ba59abbe56e057f20f883e', '2017-09-15 10:07:42', '["ngoc", "embe1"]', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `userson`
--

CREATE TABLE `userson` (
  `uvon` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `dt` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `userson`
--

INSERT INTO `userson` (`uvon`, `dt`) VALUES
('tai', 1508727146);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `webchat_lines`
--

CREATE TABLE `webchat_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` varchar(16) NOT NULL,
  `gravatar` varchar(32) NOT NULL,
  `text` varchar(255) NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `webchat_lines`
--

INSERT INTO `webchat_lines` (`id`, `author`, `gravatar`, `text`, `ts`) VALUES
(1, 'embe', '3f009d72559f51e7e454b16e5d0687a1', 'hello', '2017-09-14 14:38:24'),
(2, 'embe', '3f009d72559f51e7e454b16e5d0687a1', 'anyone here', '2017-09-14 14:38:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `webchat_users`
--

CREATE TABLE `webchat_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(16) NOT NULL,
  `gravatar` varchar(32) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `close_tab_notification`
--
ALTER TABLE `close_tab_notification`
  ADD PRIMARY KEY (`file_name_using`);

--
-- Chỉ mục cho bảng `last_seen`
--
ALTER TABLE `last_seen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logout_notification`
--
ALTER TABLE `logout_notification`
  ADD PRIMARY KEY (`logout_moment`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`file_name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Chỉ mục cho bảng `userson`
--
ALTER TABLE `userson`
  ADD PRIMARY KEY (`uvon`);

--
-- Chỉ mục cho bảng `webchat_lines`
--
ALTER TABLE `webchat_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ts` (`ts`);

--
-- Chỉ mục cho bảng `webchat_users`
--
ALTER TABLE `webchat_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `last_activity` (`last_activity`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `last_seen`
--
ALTER TABLE `last_seen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `webchat_lines`
--
ALTER TABLE `webchat_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `webchat_users`
--
ALTER TABLE `webchat_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
