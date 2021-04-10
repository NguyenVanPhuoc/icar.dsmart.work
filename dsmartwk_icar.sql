-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 08, 2021 lúc 10:33 PM
-- Phiên bản máy phục vụ: 5.7.30
-- Phiên bản PHP: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dsmartwk_icar`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affiates`
--

CREATE TABLE `affiates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `turnover` float NOT NULL,
  `rewards` float NOT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `affiates`
--

INSERT INTO `affiates` (`id`, `turnover`, `rewards`, `post_id`, `created_at`, `updated_at`) VALUES
(6, 150000, 20000, 55, '2021-01-06 22:02:22', '2021-01-06 22:02:22'),
(7, 50000, 7000, 56, '2021-01-06 22:02:46', '2021-01-06 22:02:46'),
(8, 20000, 2000, 57, '2021-01-06 22:03:10', '2021-01-06 22:03:10'),
(9, 10000, 500, 58, '2021-01-06 22:03:51', '2021-01-06 22:03:51'),
(10, 5000, 300, 59, '2021-01-06 22:04:16', '2021-01-06 22:04:16'),
(11, 1000, 50, 60, '2021-01-06 22:04:43', '2021-01-06 22:16:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `cat_ids` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blogs`
--

INSERT INTO `blogs` (`id`, `content`, `cat_ids`, `post_id`, `created_at`, `updated_at`) VALUES
(4, '<p>content news</p>', '{\"13\":\"13\",\"12\":\"12\"}', 43, '2021-01-04 15:16:41', '2021-01-04 15:16:41');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_cats`
--

CREATE TABLE `blog_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `blog_cats`
--

INSERT INTO `blog_cats` (`id`, `content`, `post_id`, `created_at`, `updated_at`) VALUES
(11, 'content news blog category', 38, '2021-01-04 14:22:31', '2021-01-04 14:22:31'),
(12, '<p>services content</p>', 39, '2021-01-04 14:22:44', '2021-01-04 14:22:44'),
(13, '<p>package content</p>', 40, '2021-01-04 14:37:46', '2021-01-04 14:37:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `custom_fields`
--

CREATE TABLE `custom_fields` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `position` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `title`, `value`, `content`, `type`, `width`, `group_id`, `position`, `created_at`, `updated_at`) VALUES
(28, 'Address', 'contact_address', '<h3>Địa chỉ</h3>\r\n<p>14 Nguyễn Văn Cừ, phường Vĩnh Ninh - TP Huế</p>', 'textarea', 4, 16, 1, '2021-01-21 21:11:42', '2021-02-06 14:31:09'),
(67, 'World Wide Companies', 'home_company', '<img src=\"uploads/icon-1.png\" alt=\"\">\r\n<h3>World Wide Companies</h3>\r\n<p>We work with companies such as Car2Go, ZipCar, Turo, ReachNow, Avis, Europcar, Hertz, Sixt and many other promising companies in Asia, Russia and Australia.</p>', 'textarea', 12, 11, 1, '2021-02-03 14:38:45', '2021-02-03 14:39:14'),
(68, 'Certified Business', 'home_business', '<img src=\"uploads/icon-2.png\" alt=\"\">\r\n<h3>Certified Business</h3>\r\n<p>1st car sharing investment company registered in the UK, created taking into account the realities of the modern world.</p>', 'textarea', 12, 11, 2, '2021-02-03 14:38:45', '2021-02-03 14:39:14'),
(69, 'High Level ROI', 'home_roi', '<img src=\"uploads/icon-3.png\" alt=\"\">\r\n<h3>High Level ROI</h3>\r\n<p>The invested funds are paying off more and more every month, since this service is spreading at lightning speed and is becoming more and more popular, since many immediately see the profitability of car sharing.</p>', 'textarea', 12, 11, 3, '2021-02-03 14:38:45', '2021-02-03 14:39:14'),
(70, 'About Us(image)', 'home_about_img', '46', 'image', 3, 11, 5, '2021-02-03 21:53:50', '2021-02-04 16:34:37'),
(71, 'About Us(Text)', 'home_about_text', 'car Digital is a UK registered investment and management company in the car rental and car sharing business. Car sharing is a type of short-term car rental with a per-minute or hourly rate, usually used for short intercity trips. At the same time, the client does not bear any additional overhead costs. Gasoline, insurance, car wash, service - all inclusive. Car sharing is a socially significant project for regional authorities. According to statistics, one car-sharing car is capable of replacing 10-15 personal cars and unloading roads, which is why local authorities always support entrepreneurs who create such a business. If we talk about the prospects of car sharing on a global scale, then there is no reason to expect a slowdown in the growth of this type of transport. According to some estimates, by 2024 the volume of the car sharing market is expected to grow to $ 16.5 billion with an increase in the number of registered users of car sharing to 30 million people; the average annual compound annual growth rate is expected at 34.8% ‌. According to calculations based on the specifics of the user segment of car-sharing (young educated citizens), in most of the largest cities in the world - both those already served by car-sharing services and not yet having this type of transport - there is a potential for the emergence / development / growth of this type of transport, often in the thousands. cars and thousands of registered users.', 'textarea', 9, 11, 6, '2021-02-03 21:53:50', '2021-02-04 16:34:37'),
(72, 'Feature 01 (image)', 'home_feature_img_01', '48', 'image', 3, 11, 9, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(73, 'Feature 01 (text)', 'home_feature_text_01', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 10, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(74, 'Feature 02 (image)', 'home_feature_img_02', '50', 'image', 3, 11, 11, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(75, 'Feature 02 (text)', 'home_feature_text_02', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 12, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(76, 'Feature 03 (image)', 'home_feature_img_03', '51', 'image', 3, 11, 13, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(77, 'Feature 03 (text)', 'home_feature_text_03', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 14, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(78, 'Feature 04 (image)', 'home_feature_img_04', '52', 'image', 3, 11, 15, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(79, 'Feature 04 (text)', 'home_feature_text_04', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 16, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(80, 'Feature 05 (image)', 'home_feature_img_05', '53', 'image', 3, 11, 17, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(81, 'Feature 05 (text)', 'home_feature_text_05', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 18, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(82, 'Feature 06 (image)', 'home_feature_img_06', '54', 'image', 3, 11, 19, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(83, 'Feature 06 (text)', 'home_feature_text_06', 'All cars passed the crash test and meeting a high degree of safety', 'textarea', 9, 11, 20, '2021-02-03 22:24:37', '2021-02-04 16:34:37'),
(84, 'Feature 10 (image)', 'home_feature_img_07', '49', 'image', 3, 11, 21, '2021-02-03 22:25:10', '2021-02-04 16:34:37'),
(85, 'About ICAR Digital LTD', 'home_sec_title_02', 'About <span>ICAR</span> Digital LTD', 'text', 12, 11, 4, '2021-02-04 16:34:37', '2021-02-06 14:21:07'),
(86, 'Investment Plans', 'home_sec_title_03', 'Investment <span>Plans</span>', 'text', 12, 11, 7, '2021-02-04 16:34:37', '2021-02-06 14:21:07'),
(87, 'Affiate Program', 'home_sec_title_04', 'Affiate <span>Program</span>', 'text', 12, 11, 8, '2021-02-04 16:34:37', '2021-02-06 14:21:07'),
(88, 'Online Statistics', 'home_sec_title_05', 'Online <span>Statistics</span>', 'text', 12, 11, 22, '2021-02-04 16:34:37', '2021-02-06 14:21:07'),
(89, 'Day online', 'home_online_01', '<strong>40</strong>\r\n<p>DAYS ONLINE</p>', 'textarea', 6, 11, 23, '2021-02-04 16:34:37', '2021-02-06 14:24:55'),
(90, 'Total Investors', 'home_online_02', '<strong>1252</strong>\r\n<p>TOTAL INVESTORS</p>', 'textarea', 6, 11, 24, '2021-02-04 16:34:37', '2021-02-06 14:24:55'),
(91, 'Total Invested', 'home_online_03', '<strong>$73850.72</strong>\r\n<p>TOTAL INVESTED</p>', 'textarea', 6, 11, 25, '2021-02-04 16:34:37', '2021-02-06 14:24:55'),
(92, 'Total Withdrew', 'home_online_04', '<strong>$58979.85</strong>\r\n<p>TOTAL WITHDREW</p>', 'textarea', 6, 11, 26, '2021-02-04 16:34:37', '2021-02-06 14:24:55'),
(93, 'Hotline', 'contact_hotline', '<h3>Hotline</h3>\r\n<p><a href=\"tel:0905999394\">0905 999 394</a></p>\r\n<p><a href=\"tel:0367292297\">0367 292 297</a></p>', 'textarea', 4, 16, 2, '2021-02-06 14:29:33', '2021-02-06 14:31:09'),
(94, 'Email', 'contact_email', '<h3>Email</h3>\r\n<p><a href=\"mailto:lqviet.it@gmail.com\">lqviet.it@gmail.com</a></p>\r\n<p><a href=\"mailto:support@dsmart.vn\">support@dsmart.vn</a></p>', 'textarea', 4, 16, 3, '2021-02-06 14:29:33', '2021-02-06 14:31:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `custom_field_group`
--

CREATE TABLE `custom_field_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `custom_field_group`
--

INSERT INTO `custom_field_group` (`id`, `title`, `post_id`, `created_at`, `updated_at`) VALUES
(11, 'home', 13, '2021-01-21 15:12:56', '2021-02-06 14:19:49'),
(16, 'Contact us', 14, '2021-01-21 21:11:42', '2021-02-06 14:29:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `faqs`
--

INSERT INTO `faqs` (`id`, `content`, `post_id`, `created_at`, `updated_at`) VALUES
(11, '<p><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How does the Affiliate program work?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">It works on a very simple principle. You provide a referral link to potential clients, and they use it to enter the site. If they register and make a deposit, you receive a bonus of 10% from the amount of their deposit.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How many referral links can I have?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Each user only gets one referral link.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Where can I get my referral link and banners?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You can find a referral link and banners in your investor area. Your referral link is created automatically when you open an account with us.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What are the advantages of the Affiliate program?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">The Affiliate program is your opportunity to get passive income on the platform without investing any personal funds.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Can I withdraw my income that I got from taking part in the Affiliate program?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Yes, you can regularly withdraw your referral income or you can form investments using it.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How will I get my referral commission?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">The commission will be credited to your account automatically, immediately after the deposit has been created by your referral.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Will I get my referral bonus for every additional deposit my referrals make?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Yes, you will get referral bonus on every deposit your referrals make.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Will I get a referral fee for the deposit made by my referral from his/ her account balance?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">No, we only allow referral commissions on investments from outside processors.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What are the ways of referrals attracting?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">We do not restrict you in the ways of referrals attracting. You can use social media, forums, your website, blog and offline promotion. At the same time, we are against spam and strongly recommend you to avoid this way to promote an information about the company.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How can I view the total number of referrals I have?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You need to log into your account and press \'Referrals\'. You will then see the whole list.</span><br></p>', 25, '2021-01-04 13:03:19', '2021-01-04 13:15:52'),
(12, '<p><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How often can I request a withdrawal?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You have no limits. You can withdraw when you have no zero-balance.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What is the minimum withdrawal amount?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Minimum withdrawal is 1 USD for Perfectmoney and 5 USD for Bitcoin, Ethereum, Litecoin and DogeCoin.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">I made two deposits, using two different electronic payment systems. Can I combine the profits from the two deposits into a single withdrawal request?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Regulation of payments does not permit to withdraw funds to electronic payment system, different than the one, deposit was made from. Thus, you cannot combine the profits accrued on your account balance from the two deposits into a single withdrawal request.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How can I reinvest my profits?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You may reinvest your profits in order to earn more instead withdrawing funds. Just specify, that you are going to make a payment from the balance by clicking on the \'Balance\' button before choosing a payment system while investing.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">I did not receive the funds to my wallet, although the withdrawal request has been made more than 3 days ago (72 hours). What should I do?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Please check carefully the details on your account, most likely, the reason for the delay was that at registration you provided the incorrect wallet number of the electronic payment system to which you have created a request a payment of funds. It is also possible that you have created multiple accounts in our system.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Am I able to request the deposit withdrawal before the end of investment period?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">No. The deposit will be included in the total return.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How long does it take for the withdrawals to complete?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Withdrawals are not instantly processed. To ensure maximum protection of your account and funds, we carefully check all requests for withdrawals and process them manually. This process might take up to 72 hours.</span><br></p>', 26, '2021-01-04 13:03:32', '2021-01-04 13:03:32'),
(13, '<p><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What are the risks for ICAR DIGITAL LTD company\'s investors?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">The risks for our investors are minimized due to the professional team and our experience. Each investor will receive a profit according to the terms of the investment plan that was chosen.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How to open a deposit in ICAR DIGITAL LTD?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You can open a deposit in the corresponding menu in your personal account. Please note, we have the right to reverse back any deposit you just created to your account balance without explaining the reasons. In this case, you need to withdraw your funds from the account balance to your wallet.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Which payment methods do you accept?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">We accept a majority of payment methods including Perfect Money, Bitcoin, Ethereum, Litecoin and Dogecoin.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">My deposit was not added instantly, what\'s wrong?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">The reason for this can be that you deposited via Cryptocurrency which require confirmations before getting added.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How many confirmations required for deposit via cryptocurrency before deposit gets added?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Three confirmations are required for cryptocurrency deposits.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Am I able to create several deposits at a time and make profit from them simultaneously?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Yes, you can place money on any number of deposits from a single account and make profit from multiple investment plans.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Can I add extra deposit to the current deposit?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">No, you cannot do this. You can make another deposit.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Is there any charge for a deposit transaction?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">We do not charge for making deposits or withdrawals. Please, consider a charge from payment systems.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"></p>', 27, '2021-01-04 13:03:44', '2021-01-04 13:03:44'),
(14, '<p><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What is the business of the ICAR DIGITAL LTD, and does it have official registration?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">ICAR DIGITAL LTD is a UK investment company&nbsp;</span><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">#12977055</b><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">&nbsp;that has an office in London. We conduct fully legal activities and are engaged in car rental, car sharing investments.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What are the advantages of working with the ICAR DIGITAL LTD company?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">The main advantages of the ICAR DIGITAL LTD project are its profitability, reliability and convenience for clients. Due to the experience of our team and the developed investment strategies, we can guarantee significant increase in your capital within a short time frame.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Do I need to visit the company\'s office in order to become an investor?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">There is no need to visit our office, because cooperation with investors is carried out through a modern investment resource. You just need to register on our site, and after this you will be able to perform investment actions through your personal account.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How may I earn on the ICAR DIGITAL LTD platform?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">You are entitled either to invest and get a regular income from your assets or become partner of the company and earn by involving new investors. Be sure to combine investment with friends in order to get the largest profit while cooperating with the ICAR DIGITAL LTD company.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">What information should I provide to create an account?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">We require our clients to specify the minimum amount of information. We understand the desire of investors to preserve the personal anonymity and confidentiality of their data, so when registering you will need to specify only the information that is necessary to identify you in the system.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">How many accounts in the project can I create?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Using multiple accounts is prohibited by the company, each participant can create only one account in the project. If we find out you have multiple accounts, all your accounts will be blocked, and the funds in these accounts will be frozen.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><b style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Why is it profitable to cooperate with your company?</b><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; background-color: rgb(234, 234, 234);\">Our investment offers are distinguished by the stability and balance as well as high yield. To become familiar with our investment offers and clarify the yield on each investment offer, please visit the \'Investment Plans\' section of our website.</span><br></p>', 28, '2021-01-04 13:03:58', '2021-01-04 13:03:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media`
--

INSERT INTO `media` (`id`, `title`, `slug`, `alt`, `path`, `content`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'favicon', 'favicon', 'favicon', 'favicon.png', NULL, 'png', 1, '2020-12-29 13:53:34', '2020-12-29 13:53:34'),
(3, 'https://icar.dsmart.work/public/public/uploads/', 'logo', NULL, 'logo.png', NULL, 'png', 1, '2020-12-29 13:53:45', '2020-12-29 14:30:51'),
(4, 'https://icar.dsmart.work/public/uploads/', 'img-main', NULL, 'img-main.jpg', NULL, 'jpg', 1, '2021-01-04 08:58:59', '2021-01-06 08:28:15'),
(5, 'img_main', 'img-main-1', 'img_main', 'img-main-1.jpg', NULL, 'jpg', 1, '2021-01-04 08:59:31', '2021-01-04 08:59:32'),
(6, 'img_main', 'img-main-2', 'img_main', 'img-main-2.jpg', NULL, 'jpg', 1, '2021-01-04 09:00:12', '2021-01-04 09:00:12'),
(9, 'img_main', 'img-main-3', 'img_main', 'img-main-3.jpg', NULL, 'jpg', 1, '2021-01-04 13:53:34', '2021-01-04 13:53:34'),
(10, 'img_main', 'img-main-4', 'img_main', 'img-main-4.jpg', NULL, 'jpg', 1, '2021-01-04 13:54:10', '2021-01-04 13:54:10'),
(25, 'https://icar.dsmart.work/public/uploads/', 'p1', NULL, 'p1.png', NULL, 'png', 1, '2021-01-05 07:33:53', '2021-01-06 08:26:33'),
(26, 'header_bg', 'header-bg', 'header_bg', 'header-bg.jpg', NULL, 'jpg', 1, '2021-01-05 07:53:07', '2021-01-05 07:53:07'),
(27, 'https://icar.dsmart.work/public/uploads/', 'p2', NULL, 'p2.png', NULL, 'png', 1, '2021-01-05 08:16:56', '2021-01-06 08:27:15'),
(28, 'p3', 'p3', 'p3', 'p3.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(29, 'p4', 'p4', 'p4', 'p4.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(30, 'p5', 'p5', 'p5', 'p5.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(31, 'p6', 'p6', 'p6', 'p6.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(32, 'p7', 'p7', 'p7', 'p7.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(33, 'p8', 'p8', 'p8', 'p8.png', NULL, 'png', 1, '2021-01-06 08:27:54', '2021-01-06 08:27:54'),
(34, 'ref_ic1', 'ref-ic1', 'ref_ic1', 'ref-ic1.png', NULL, 'png', 1, '2021-01-06 22:01:44', '2021-01-06 22:01:44'),
(35, 'ref_ic2', 'ref-ic2', 'ref_ic2', 'ref-ic2.png', NULL, 'png', 1, '2021-01-06 22:01:44', '2021-01-06 22:01:44'),
(36, 'ref_ic4', 'ref-ic4', 'ref_ic4', 'ref-ic4.png', NULL, 'png', 1, '2021-01-06 22:01:45', '2021-01-06 22:01:45'),
(37, 'ref_ic3', 'ref-ic3', 'ref_ic3', 'ref-ic3.png', NULL, 'png', 1, '2021-01-06 22:01:45', '2021-01-06 22:01:45'),
(38, 'ref_ic5', 'ref-ic5', 'ref_ic5', 'ref-ic5.png', NULL, 'png', 1, '2021-01-06 22:01:45', '2021-01-06 22:01:45'),
(39, 'ref_ic6', 'ref-ic6', 'ref_ic6', 'ref-ic6.png', NULL, 'png', 1, '2021-01-06 22:01:45', '2021-01-06 22:01:45'),
(40, 'default_bg', 'default-bg', 'default_bg', 'default-bg.jpg', NULL, 'jpg', 1, '2021-01-16 15:24:51', '2021-01-16 15:24:51'),
(41, 'f_logo', 'f-logo', 'f_logo', 'f-logo.png', NULL, 'png', 1, '2021-01-19 16:29:24', '2021-01-19 16:29:24'),
(42, 'cert_img', 'cert-img', 'cert_img', 'cert-img.png', NULL, 'png', 1, '2021-01-19 16:29:24', '2021-01-19 16:29:24'),
(43, 'icon-1', 'icon-1', 'icon-1', 'icon-1.png', NULL, 'png', 1, '2021-01-22 16:11:01', '2021-01-22 16:11:01'),
(44, 'icon-2', 'icon-2', 'icon-2', 'icon-2.png', NULL, 'png', 1, '2021-01-22 16:11:01', '2021-01-22 16:11:01'),
(45, 'icon-3', 'icon-3', 'icon-3', 'icon-3.png', NULL, 'png', 1, '2021-01-22 16:11:01', '2021-01-22 16:11:01'),
(46, 'img_main', 'img-main-5', 'img_main', 'img-main-5.jpg', NULL, 'jpg', 1, '2021-01-22 16:22:12', '2021-01-22 16:22:12'),
(47, 'logo', 'logo-1', 'logo', 'logo-1.png', NULL, 'png', 1, '2021-01-22 16:23:15', '2021-01-22 16:23:15'),
(48, 'f1', 'f1', 'f1', 'f1.png', NULL, 'png', 1, '2021-02-03 22:27:05', '2021-02-03 22:27:05'),
(49, 'car_img', 'car-img', 'car_img', 'car-img.png', NULL, 'png', 1, '2021-02-03 22:27:05', '2021-02-03 22:27:05'),
(50, 'f2', 'f2', 'f2', 'f2.png', NULL, 'png', 1, '2021-02-03 22:27:06', '2021-02-03 22:27:06'),
(51, 'f3', 'f3', 'f3', 'f3.png', NULL, 'png', 1, '2021-02-03 22:27:06', '2021-02-03 22:27:06'),
(52, 'f4', 'f4', 'f4', 'f4.png', NULL, 'png', 1, '2021-02-03 22:27:06', '2021-02-03 22:27:06'),
(53, 'f5', 'f5', 'f5', 'f5.png', NULL, 'png', 1, '2021-02-03 22:27:06', '2021-02-03 22:27:06'),
(54, 'f6', 'f6', 'f6', 'f6.png', NULL, 'png', 1, '2021-02-03 22:27:06', '2021-02-03 22:27:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media_cates`
--

CREATE TABLE `media_cates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media_cates`
--

INSERT INTO `media_cates` (`id`, `title`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(1, 'System', 'system', NULL, '2020-12-29 13:24:46', '2020-12-29 13:24:46'),
(3, 'blog', 'blog', NULL, '2021-01-04 08:59:56', '2021-01-04 08:59:56'),
(4, 'plans', 'plans', NULL, '2021-01-06 08:26:02', '2021-01-06 08:26:02'),
(5, 'affiate', 'affiates', NULL, '2021-01-06 22:01:13', '2021-01-23 15:37:51'),
(9, 'Home', 'home-1', NULL, '2021-01-23 15:40:33', '2021-01-23 15:40:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `media_media_cate`
--

CREATE TABLE `media_media_cate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `cate_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `media_media_cate`
--

INSERT INTO `media_media_cate` (`id`, `media_id`, `cate_id`) VALUES
(1, 3, 1),
(2, 25, 4),
(3, 27, 4),
(4, 4, 4),
(5, 4, 3),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(41, 'main menu', 'main-menu', '2021-01-12 21:22:53', '2021-01-13 21:22:34'),
(43, 'menu 2', 'menu-2', '2021-01-13 21:47:25', '2021-01-13 21:47:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_metas`
--

CREATE TABLE `menu_metas` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_custom` text COLLATE utf8mb4_unicode_ci,
  `title_default` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_metas`
--

INSERT INTO `menu_metas` (`id`, `title_custom`, `title_default`, `parent`, `position`, `user_id`, `menu_id`, `type`, `target`, `post_id`, `created_at`, `updated_at`) VALUES
(22, '', 'Home', 0, 1, 1, 41, 'page', '_self', 13, '2021-01-13 16:13:34', '2021-01-13 21:22:35'),
(23, '', 'About us', 0, 2, 1, 41, 'page', '_self', 15, '2021-01-13 16:13:34', '2021-01-13 21:22:35'),
(28, '', 'Investments', 0, 3, 1, 41, 'page', '_self', 61, '2021-01-13 21:33:24', '2021-01-13 21:36:14'),
(29, '', 'Affiliate Program', 0, 4, 1, 41, 'page', '_self', 30, '2021-01-13 21:36:14', '2021-01-13 21:36:14'),
(30, '', 'FAQs', 0, 5, 1, 41, 'page', '_self', 62, '2021-01-13 21:36:14', '2021-01-15 15:40:21'),
(31, '', 'Terms', 0, 6, 1, 41, 'page', '_self', 63, '2021-01-13 21:36:14', '2021-01-13 21:36:14'),
(33, '', 'FAQ', 0, 1, 1, 43, 'page', '_self', 62, '2021-01-13 21:47:25', '2021-01-13 21:47:25'),
(35, '', 'Contact us', 0, 7, 1, 41, 'page', '_self', 14, '2021-01-13 22:15:40', '2021-01-15 15:40:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_12_28_031543_create_sessions_table', 1),
(7, '2020_12_28_032537_create_sessions_table', 2),
(8, '2020_12_28_034936_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(6, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 15),
(6, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 17),
(6, 'App\\Models\\User', 36);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', '3', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(2, 'favicon', '2', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(3, 'site_name', 'iCar', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(4, 'address', '123 ABC XYZ', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(5, 'email', 'lqviet.it@gmail.com', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(6, 'hotline', '0123456789', '2020-12-28 15:10:30', '2021-02-17 15:09:36'),
(7, 'tags', 'iCar Dsmart', '2021-01-06 07:06:33', '2021-02-17 15:09:36'),
(8, 'currency', '$', '2021-01-06 07:06:33', '2021-02-17 15:09:36'),
(9, 'socail', '<a href=\"https://telegram.me/icardigitalgroup\" target=\"_blank\"><i class=\"fab fa-telegram\"></i></a>', '2021-01-19 16:06:45', '2021-02-17 15:09:36'),
(10, 'logo_footer_img_01', NULL, '2021-01-19 16:20:30', '2021-01-19 16:20:30'),
(11, 'logo_footer_text_01', NULL, '2021-01-19 16:20:30', '2021-01-19 16:20:30'),
(12, 'logo_footer_img_02', NULL, '2021-01-19 16:20:30', '2021-01-19 16:20:30'),
(13, 'logo_footer_text_02', NULL, '2021-01-19 16:20:30', '2021-01-19 16:20:30'),
(14, 'footer_img_01', NULL, '2021-01-19 16:27:59', '2021-01-19 16:27:59'),
(15, 'footer_text_01', NULL, '2021-01-19 16:27:59', '2021-01-19 16:27:59'),
(16, 'footer_img_02', NULL, '2021-01-19 16:27:59', '2021-01-19 16:27:59'),
(17, 'footer_text_02', NULL, '2021-01-19 16:27:59', '2021-01-19 16:27:59'),
(18, 'company_info', '<img src=\"https://icar.dsmart.work/uploads/f-logo.png\" alt=\"\">\r\n<p>Company Information</p>', '2021-01-19 16:34:11', '2021-02-17 15:09:36'),
(19, 'vertificate', '<img src=\"https://icar.dsmart.work/uploads/cert-img.png\" alt=\"\">\r\n<p>Certificate</p>\r\n<strong>#12977055</strong>\r\n<ul>\r\n    <li><i class=\"far fa-envelope-open\"></i>support@icar.digital</li>\r\n    <li><i class=\"fas fa-map-marker-alt\"></i>51 51, George Street, Leeds,<br>\r\n    Yorkshire, England, LS6 1BP</li>\r\n</ul>', '2021-01-19 16:34:11', '2021-02-17 15:09:36'),
(20, 'affiliate', '10', '2021-02-17 15:05:40', '2021-02-17 15:09:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'default',
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `content`, `template`, `post_id`, `created_at`, `updated_at`) VALUES
(11, '<p><br></p>', 'home', 13, '2021-01-04 07:52:03', '2021-02-06 14:24:55'),
(12, '<h2 style=\"line-height: 38px; font-size: 28px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif;\">GIẢI PHÁP&nbsp;<span style=\"font-weight: bolder; font-family: robotoBold;\">WEBSITE, APP &amp; CRM</span>&nbsp;DSMART</h2><p style=\"margin-bottom: 10px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px;\">Chúng tôi cung cấp các giải pháp vể thiết kế Website, App &amp; hệ thống CRM quản lý cao cấp – chuẩn SEO – chuyên nghiệp cho tất cả cá nhân, chủ cửa hàng hay doanh nghiệp trên tất cả các lĩnh vực kinh doanh trên toàn thế giới.</p><p style=\"margin-bottom: 10px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px;\">Quý khách vui lòng điền thông tin cần hỗ trợ vào&nbsp;<span style=\"font-weight: bolder; font-family: robotoBold;\">form bên phải</span>&nbsp;hay liên&nbsp;<span style=\"font-weight: bolder; font-family: robotoBold;\">hệ trực tiếp với chúng tôi bằng điện thoại, chat, email,…</span></p><ul style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px;\"><li>Điện thoại:&nbsp;<a href=\"tel:0905999394\" style=\"color: var(--black); font-family: robotoBold;\">0905 999 394</a>&nbsp;–&nbsp;<a href=\"tel:0397292297\" style=\"color: var(--black); font-family: robotoBold;\">0367 292 297</a></li><li>Email:&nbsp;<a href=\"mailto:lqviet.it@gmail.com\" style=\"color: var(--black); font-family: robotoBold;\">lqviet.it@gmail.com</a>&nbsp;–&nbsp;<a href=\"mailto:support@dsmart.vn\" style=\"color: var(--black); font-family: robotoBold;\">support@dsmart.vn</a></li><li>FB:&nbsp;<a href=\"https://www.facebook.com/DSmart-102863397727352/\" style=\"color: var(--black); font-family: robotoBold;\">DSmart</a></li><li>Zalo:&nbsp;<a href=\"http://zaloapp.com/qr/p/af3jqzuyz0rz\" style=\"color: var(--black); font-family: robotoBold;\">Viet Le</a></li></ul><p style=\"margin-bottom: 10px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px;\"><span style=\"font-weight: bolder; font-family: robotoBold;\">DSmart</span>&nbsp;rất vui được tư vấn và hỗ trợ cho quý khách.</p>', 'contact', 14, '2021-01-04 07:52:16', '2021-02-06 14:31:09');
INSERT INTO `pages` (`id`, `content`, `template`, `post_id`, `created_at`, `updated_at`) VALUES
(13, '<div style=\"text-align: center;\"><span style=\"font-size: medium; color: rgb(21, 19, 41); font-family: Oxanium-Medium;\">Icar Digital is a UK registered investment and management company in the car rental and car sharing business. Car sharing is a type of short-term car rental with a per-minute or hourly rate, usually used for short intercity trips. At the same time, the client does not bear any additional overhead costs. Gasoline, insurance, car wash, service - all inclusive. Car sharing is a socially significant project for regional authorities. According to statistics, one car-sharing car is capable of replacing 10-15 personal cars and unloading roads, which is why local authorities always support entrepreneurs who create such a business. If we talk about the prospects of car sharing on a global scale, then there is no reason to expect a slowdown in the growth of this type of transport. According to some estimates, by 2024 the volume of the car sharing market is expected to grow to $ 16.5 billion with an increase in the number of registered users of car sharing to 30 million people; the average annual compound annual growth rate is expected at 34.8% ‌. According to calculations based on the specifics of the user segment of car-sharing (young educated citizens), in most of the largest cities in the world - both those already served by car-sharing services and not yet having this type of transport - there is a potential for the emergence / development / growth of this type of transport, often in the thousands. cars and thousands of registered users.</span><img src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABkAAD/4QMsaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA2LjAtYzAwMiA3OS4xNjQ0NjAsIDIwMjAvMDUvMTItMTY6MDQ6MTcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCAyMS4yIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpBQUM1NEIxMjIwNUMxMUVCQjQxNkM5QTU2MTRGRUVDMCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpBQUM1NEIxMzIwNUMxMUVCQjQxNkM5QTU2MTRGRUVDMCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkFBQzU0QjEwMjA1QzExRUJCNDE2QzlBNTYxNEZFRUMwIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkFBQzU0QjExMjA1QzExRUJCNDE2QzlBNTYxNEZFRUMwIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+4ADkFkb2JlAGTAAAAAAf/bAIQA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\" data-filename=\"img_main.jpg\" style=\"font-size: 1rem; width: 600px;\"></div><p></p>', 'default', 15, '2021-01-04 09:02:04', '2021-01-14 16:24:12');
INSERT INTO `pages` (`id`, `content`, `template`, `post_id`, `created_at`, `updated_at`) VALUES
(15, '<p><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">Please read the following rules carefully before signing in.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">You agree to be of legal age in your country to partake in this program, and in all the cases your minimal age must be 18 years.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">icar.digital is not available to the general public and is opened only to the qualified members of icar.digital, the use of this site is restricted to our members and to individuals personally invited by them. Every deposit is considered to be a private transaction between the icar.digital and its Member.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">As a private transaction, this program is exempt from the US Securities Act of 1933, the US Securities Exchange Act of 1934 and the US Investment Company Act of 1940 and all other rules, regulations and amendments thereof. We are not FDIC insured. We are not a licensed bank or a security firm.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">You agree that all information, communications, materials coming from icar.digital are unsolicited and must be kept private, confidential and protected from any disclosure. Moreover, the information, communications and materials contained herein are not to be regarded as an offer, nor a solicitation for investments in any jurisdiction which deems non-public offers or solicitations unlawful, nor to any person to whom it will be unlawful to make such offer or solicitation.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">All the data giving by a member to icar.digital will be only privately used and not disclosed to any third parties. icar.digital is not responsible or liable for any loss of data.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">You agree to hold all principals and members harmless of any liability. You are investing at your own risk and you agree that a past performance is not an explicit guarantee for the same future performance. You agree that all information, communications and materials you will find on this site are intended to be regarded as an informational and educational matter and not an investment advice.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">We reserve the right to change the rules, commissions and rates of the program at any time and at our sole discretion without notice, especially in order to respect the integrity and security of the members\' interests. You agree that it is your sole responsibility to review the current terms.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">icar.digital is not responsible or liable for any damages, losses and costs resulting from any violation of the conditions and terms and/or use of our website by a member. You guarantee to icar.digital that you will not use this site in any illegal way and you agree to respect your local, national and international laws.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">Don\'t post bad vote on Public Forums and at Gold Rating Site without contacting the administrator of our program FIRST. Maybe there was a technical problem with your transaction, so please always CLEAR the thing with the administrator.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">We will not tolerate SPAM or any type of UCE in this program. SPAM violators will be immediately and permanently removed from the program.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">icar.digital reserves the right to accept or decline any member for membership without explanation.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium; text-align: justify;\">If you do not agree with the above disclaimer, please do not go any further.</span><br></p>', 'default', 29, '2021-01-04 13:16:56', '2021-01-04 13:16:56'),
(16, '<p><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">We have developed the Affiliate program for every member who are ready to act and increase its income.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Affiliate program is a unique opportunity to earn with Icar Digital Limited.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Our affiliate program works by simple principles and it\'s in one level of 10%.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">All you need to do is to attract new investors to our investment program using your personal referral link.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">You can find this link in your account area and provide it to potential clients, so that they can use it to enter the website.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">If they enter, register and make a deposit, you’ll receive a bonus. Use opportunities of the Referral Program. Move to the future and make it better!</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">Apart from our Affiliate program, we also have what we call a Career rewards program which is very much like the Affiliate program.</span><br style=\"margin: 0px; padding: 0px; color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\"><span style=\"color: rgb(21, 19, 41); font-family: Oxanium-Medium; font-size: medium;\">To Become to participate in our career rewards program, the total amount deposited by your referrals</span><br></p>', 'affiliate', 30, '2021-01-04 13:17:23', '2021-01-14 22:03:32'),
(17, '<p><span style=\"color: rgb(34, 34, 34); font-family: Menlo, monospace; font-size: 11px; white-space: pre-wrap;\">Investments content</span><br></p>', 'investments', 61, '2021-01-13 21:22:15', '2021-01-13 21:29:46'),
(18, '<p>FAQs</p>', 'faqs', 62, '2021-01-13 21:24:08', '2021-01-15 15:39:59'),
(19, '<div class=\"item wow fadeInLeft\" data-wow-duration=\"1s\" data-wow-delay=\"0.6s\" style=\"animation-name: fadeInLeft; padding-left: 35px; position: relative; margin-bottom: 15px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.6s;\"><div class=\"number\" style=\"position: absolute; left: 0px; top: 0px; font-size: 20px; font-family: var(--bold);\">01.</div><h3 style=\"font-size: 20px; font-family: var(--bold);\">Thảo luận</h3><div class=\"desc\">Trước tiên bạn hãy cho chúng tôi thông tin của bạn hoăc doanh nghiệp bạn, ngành nghề, yêu cầu cơ bản về trang web để chúng tôi có cơ sở để chuẩn bị những tài liệu liên quan. Tiếp đến chúng tôi sẽ liên lạc với bạn để sắp xếp một cuộc hẹn khoảng 30\' vào thời điểm thuận tiện cho cả hai.</div></div><div class=\"item wow fadeInLeft\" data-wow-duration=\"1s\" data-wow-delay=\"0.7s\" style=\"animation-name: fadeInLeft; padding-left: 35px; position: relative; margin-bottom: 15px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.7s;\"><div class=\"number\" style=\"position: absolute; left: 0px; top: 0px; font-size: 20px; font-family: var(--bold);\">02.</div><h3 style=\"font-size: 20px; font-family: var(--bold);\">Lập kế hoạch</h3><div class=\"desc\">Dựa vào nhu cầu của quý khách đã cung cấp cho chúng tôi. Các chuyên viên tư vấn của chúng tôi sẽ đưa ra các ý tưởng, các giải pháp phù hợp với mong muốn của quý khách. Chúng tôi sẽ tiến hành báo giá và thời gian thực hiện dự án để chuẩn bị cho hợp đồng dự án.</div></div><div class=\"item wow fadeInLeft\" data-wow-duration=\"1s\" data-wow-delay=\"0.8s\" style=\"animation-name: fadeInLeft; padding-left: 35px; position: relative; margin-bottom: 15px; color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.8s;\"><div class=\"number\" style=\"position: absolute; left: 0px; top: 0px; font-size: 20px; font-family: var(--bold);\">03.</div><h3 style=\"font-size: 20px; font-family: var(--bold);\">Lên thiết kế</h3><div class=\"desc\">Đội ngũ thiết kế sẽ dựa vào bản thảo giữa khách hàng và chuyên viên tư vấn đã làm việc. Chúng tôi sẽ tiến hành lên bố cục, phối màu và xử lý hình ảnh một cách thẫm mỹ nhất. Và trong khoản 2 ngày chúng tôi sẽ gửi file hình demo Website/App cho quý khách Duyệt.</div><div class=\"desc\"><span style=\"font-family: var(--bold); font-size: 20px;\">04.</span></div><div class=\"desc\"><div class=\"item wow fadeInRight\" data-wow-duration=\"1s\" data-wow-delay=\"0.8s\" style=\"animation-name: fadeInRight; padding-left: 35px; position: relative; margin-bottom: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.8s;\"><h3 style=\"font-size: 20px; font-family: var(--bold);\">Lập trình</h3><div class=\"desc\">Đội ngũ kỹ thuật viên phân công từng bộ phận thực hiện dựa vào bản thiết kế, kèm theo những tính năng yêu cầu của khách hàng. Chúng tôi tiến hành xây dựng Website/App từ A-Z và đảm bảo website hoạt động mượt mà trước khi chuyển đến bộ phận Tester.</div></div><div class=\"item wow fadeInRight\" data-wow-duration=\"1s\" data-wow-delay=\"0.8s\" style=\"animation-name: fadeInRight; padding-left: 35px; position: relative; margin-bottom: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.8s;\"><div class=\"number\" style=\"position: absolute; left: 0px; top: 0px; font-size: 20px; font-family: var(--bold);\">05.</div><h3 style=\"font-size: 20px; font-family: var(--bold);\">Nhận feedback</h3><div class=\"desc\">Tiếp nhận thông tin yêu cầu của khách hàng từ bản demo. Chúng tôi sẽ có những thay đổi chỉnh sửa cho thẫm mỹ và phù hợp với yêu cầu khách hàng nhất. Chúng tôi sẽ tiến hành hoàn chỉnh trước khi khởi tạo cho Website/App hoạt động trên tên miền chính.</div></div><div class=\"item wow fadeInRight\" data-wow-duration=\"1s\" data-wow-delay=\"0.8s\" style=\"animation-name: fadeInRight; padding-left: 35px; position: relative; margin-bottom: 15px; visibility: visible; animation-duration: 1s; animation-delay: 0.8s;\"><div class=\"number\" style=\"position: absolute; left: 0px; top: 0px; font-size: 20px; font-family: var(--bold);\">06.</div><h3 style=\"font-size: 20px; font-family: var(--bold);\">Hoàn thành</h3><div class=\"desc\">Website/App được thiết kế hoàn chỉnh các và đúng tiến độ. Chúng tôi tiến hành bàn giao Website/App, hướng dẫn quản lý Website/App và tư vấn kèm theo các giải pháp marketing online để đảm bảo rằng sẽ mang lại hiệu quả cao trong chiến dịch kinh doanh của quý khách.</div></div></div></div>', 'default', 63, '2021-01-13 21:24:47', '2021-01-21 14:46:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bigdout401@gmail.com', '$2y$10$HHHLhrCXTyxKGcAUaChfe.f5L19Jc0.mDFyq4zA01mizwHSz/Ayl2', '2021-01-27 16:04:14'),
('vanphuoc260797@gmail.com', '$2y$10$BWJi1c9ZqFwTBiJlguA16ebJ4S9KO9HEdPS6ihcX3oCWl8tl/sFwu', '2021-04-09 13:31:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `group`, `created_at`, `updated_at`) VALUES
(1, 'users.read', 'web', NULL, 'User', '2020-12-30 14:56:57', '2020-12-30 14:56:57'),
(2, 'users.create', 'web', NULL, 'User', '2020-12-30 14:57:26', '2020-12-30 14:57:26'),
(3, 'users.update', 'web', NULL, 'User', '2020-12-30 14:57:55', '2020-12-30 14:57:55'),
(4, 'users.delete', 'web', NULL, 'User', '2020-12-30 14:58:01', '2020-12-30 14:58:01'),
(5, 'pages.create', 'web', NULL, 'Page', '2020-12-30 15:03:11', '2020-12-30 15:03:11'),
(6, 'pages.delete', 'web', NULL, 'Page', '2020-12-30 15:03:17', '2020-12-30 15:03:17'),
(7, 'pages.update', 'web', NULL, 'Page', '2020-12-30 15:03:21', '2020-12-30 15:03:21'),
(8, 'pages.read', 'web', NULL, 'Page', '2020-12-30 15:04:00', '2020-12-30 15:04:00'),
(9, 'media.create', 'web', NULL, 'Media', '2020-12-30 15:05:22', '2020-12-30 15:05:22'),
(10, 'media.read', 'web', NULL, 'Media', '2020-12-30 15:05:27', '2020-12-30 15:05:27'),
(11, 'media.update', 'web', NULL, 'Media', '2020-12-30 15:05:32', '2020-12-30 15:05:32'),
(12, 'media.delete', 'web', NULL, 'Media', '2020-12-30 15:05:44', '2020-12-30 15:05:44'),
(13, 'media_cates.create', 'web', NULL, 'MediaCate', '2020-12-30 15:05:56', '2020-12-30 15:05:56'),
(14, 'media_cates.read', 'web', NULL, 'MediaCate', '2020-12-30 15:06:00', '2020-12-30 15:06:00'),
(15, 'media_cates.update', 'web', NULL, 'MediaCate', '2020-12-30 15:06:03', '2020-12-30 15:06:03'),
(16, 'media_cates.delete', 'web', NULL, 'MediaCate', '2020-12-30 15:06:07', '2020-12-30 15:06:07'),
(17, 'blogs.create', 'web', NULL, 'Blog', '2020-12-30 15:06:34', '2020-12-30 15:06:34'),
(18, 'blogs.read', 'web', NULL, 'Blog', '2020-12-30 15:06:42', '2020-12-30 15:06:42'),
(19, 'blogs.update', 'web', NULL, 'Blog', '2020-12-30 15:06:51', '2020-12-30 15:06:51'),
(20, 'blogs.delete', 'web', NULL, 'Blog', '2020-12-30 15:06:59', '2020-12-30 15:06:59'),
(21, 'blog_cats.create', 'web', NULL, 'BlogCate', '2020-12-30 15:13:26', '2020-12-30 15:13:26'),
(22, 'blog_cats.read', 'web', NULL, 'BlogCate', '2020-12-30 15:13:31', '2020-12-30 15:13:31'),
(23, 'blog_cats.update', 'web', NULL, 'BlogCate', '2020-12-30 15:13:35', '2020-12-30 15:13:35'),
(24, 'blog_cats.delete', 'web', NULL, 'BlogCate', '2020-12-30 15:13:40', '2020-12-30 15:13:40'),
(25, 'options.create', 'web', NULL, 'Option', '2020-12-30 15:14:08', '2020-12-30 15:14:08'),
(26, 'options.read', 'web', NULL, 'Option', '2020-12-30 15:14:13', '2020-12-30 15:14:13'),
(27, 'options.update', 'web', NULL, 'Option', '2020-12-30 15:14:18', '2020-12-30 15:14:18'),
(28, 'options.delete', 'web', NULL, 'Option', '2020-12-30 15:14:21', '2020-12-30 15:14:21'),
(29, 'system.create', 'web', NULL, 'System', '2021-01-04 06:16:02', '2021-01-04 06:16:02'),
(30, 'system.read', 'web', NULL, 'System', '2021-01-04 06:16:10', '2021-01-04 06:16:10'),
(31, 'system.update', 'web', NULL, 'System', '2021-01-04 06:16:19', '2021-01-04 06:16:19'),
(32, 'system.delete', 'web', NULL, 'System', '2021-01-04 06:16:28', '2021-01-04 06:16:28'),
(33, 'role.create', 'web', NULL, 'Roles', '2021-01-04 06:16:41', '2021-01-04 06:16:41'),
(34, 'role.read', 'web', NULL, 'Roles', '2021-01-04 06:16:47', '2021-01-04 06:16:47'),
(35, 'role.update', 'web', NULL, 'Roles', '2021-01-04 06:16:51', '2021-01-04 06:16:51'),
(36, 'role.delete', 'web', NULL, 'Roles', '2021-01-04 06:16:56', '2021-01-04 06:16:56'),
(37, 'plans.create', 'web', NULL, 'Plans', '2021-01-05 07:57:23', '2021-01-05 07:57:23'),
(38, 'plans.read', 'web', NULL, 'Plans', '2021-01-05 07:57:43', '2021-01-05 07:57:43'),
(39, 'plans.update', 'web', NULL, 'Plans', '2021-01-05 07:57:49', '2021-01-05 07:57:49'),
(40, 'plans.delete', 'web', NULL, 'Plans', '2021-01-05 07:57:55', '2021-01-05 07:57:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_deposit` int(10) NOT NULL DEFAULT '0',
  `daily_profit` float UNSIGNED NOT NULL DEFAULT '0',
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `plans`
--

INSERT INTO `plans` (`id`, `min_deposit`, `daily_profit`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 20000, 10, 44, '<p>HYUNDAI<br></p>', '2021-01-05 07:35:02', '2021-01-06 08:29:43'),
(2, 15000, 9, 45, '<p>MERCEDES-BENZ<br></p>', '2021-01-05 08:17:07', '2021-01-06 08:31:05'),
(3, 10000, 8, 46, '<p>BMW<br></p>', '2021-01-06 08:32:37', '2021-01-06 08:32:37'),
(4, 8000, 7, 47, '<p>HONDA<br></p>', '2021-01-06 08:33:24', '2021-01-06 08:33:24'),
(5, 5000, 6, 48, '<p>FORD<br></p>', '2021-01-06 08:34:08', '2021-01-06 08:34:08'),
(6, 1500, 5, 49, '<p>TOYOTA<br></p>', '2021-01-06 08:34:35', '2021-01-06 08:34:35'),
(7, 500, 4, 50, '<p>CHEVROLET<br></p>', '2021-01-06 08:35:06', '2021-01-06 08:35:06'),
(8, 20, 3, 51, '<p>HYUNDAI<br></p>', '2021-01-06 08:35:46', '2021-01-06 08:35:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `plan_user`
--

CREATE TABLE `plan_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '10',
  `detail` text COLLATE utf8mb4_unicode_ci,
  `stop_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `plan_user`
--

INSERT INTO `plan_user` (`id`, `author`, `plan_id`, `user_id`, `amount`, `detail`, `stop_date`, `created_at`, `updated_at`) VALUES
(2, 1, 8, 16, 22, '{\"username\":\"Ho\\u00e0n H\\u1ed3n V\\u0129nh Thu\\u1ef5\",\"email\":\"bigdout401@gmail.com\",\"planname\":\"HYUNDAI\",\"profit\":3}', NULL, '2021-02-03 15:35:36', '2021-02-03 15:35:36'),
(3, 16, 8, 16, 25, '{\"username\":\"Ho\\u00e0n H\\u1ed3n V\\u0129nh Thu\\u1ef5\",\"email\":\"bigdout401@gmail.com\",\"planname\":\"HYUNDAI\",\"profit\":3}', '2021-02-03 00:00:00', '2021-02-03 16:14:14', '2021-02-03 17:16:41'),
(4, 16, 8, 16, 40, '{\"username\":\"Ho\\u00e0ng H\\u1ed3 V\\u0129nh Thu\\u1ef5\",\"email\":\"bigdout401@gmail.com\",\"planname\":\"HYUNDAI\",\"profit\":3}', NULL, '2021-02-22 16:43:26', '2021-02-22 16:43:26'),
(5, 16, 8, 16, 30, '{\"username\":\"Ho\\u00e0ng H\\u1ed3 V\\u0129nh Thu\\u1ef5\",\"email\":\"bigdout401@gmail.com\",\"planname\":\"HYUNDAI\",\"profit\":3}', NULL, '2021-02-22 16:43:48', '2021-02-22 16:43:48'),
(7, 36, 8, 36, 20, '{\"username\":\"Account New\",\"email\":\"kok@gmail.com\",\"planname\":\"HYUNDAI\",\"profit\":3}', NULL, '2021-02-25 17:17:26', '2021-02-25 17:17:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `meta_key` text COLLATE utf8mb4_unicode_ci,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `image_id`, `excerpt`, `meta_key`, `meta_value`, `type`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Home', 'home', 26, '<h1>Fast start from <span>$20</span></h1>\r\n<p>for making profit</p>\r\n<a href=\"#\" class=\"signup\">Sign Up<i class=\"far fa-check-square\"></i></a>', 'icar seo key', 'icar seo content', 'page', 1, 'public', '2021-01-04 07:52:03', '2021-02-06 14:24:55'),
(14, 'Contact us', 'contact', 40, NULL, 'GIẢI PHÁP', 'WEBSITE, APP & CRM DSMART', 'page', 1, 'public', '2021-01-04 07:52:16', '2021-02-06 14:31:09'),
(15, 'About us', 'about-us', NULL, NULL, 'Icar Digital is a UK', 'cars and thousands of registered users.', 'page', 1, 'public', '2021-01-04 09:02:04', '2021-01-14 16:24:12'),
(25, 'Affiliate Program Questions', 'affiliate-program-questions', NULL, NULL, NULL, NULL, 'faqs', 1, 'public', '2021-01-04 13:03:19', '2021-01-04 13:15:52'),
(26, 'Payouts Questions', 'payouts-questions', NULL, NULL, NULL, NULL, 'faqs', 1, 'public', '2021-01-04 13:03:32', '2021-01-04 13:03:32'),
(27, 'Investment Questions', 'investment-questions', NULL, NULL, NULL, NULL, 'faqs', 1, 'public', '2021-01-04 13:03:44', '2021-01-04 13:03:44'),
(28, 'General Questions', 'general-questions', NULL, NULL, NULL, NULL, 'faqs', 1, 'public', '2021-01-04 13:03:57', '2021-01-18 21:52:56'),
(29, 'Rules & Agreements', 'rules-agreements', NULL, NULL, NULL, NULL, 'page', 1, 'public', '2021-01-04 13:16:56', '2021-01-04 13:16:56'),
(30, 'Affiliate Program', 'affiliate-program', NULL, '3333', '222', '2222', 'page', 1, 'public', '2021-01-04 13:17:23', '2021-01-14 22:03:32'),
(38, 'News', 'news', NULL, NULL, NULL, NULL, 'blogCat', 1, 'public', '2021-01-04 14:22:31', '2021-01-04 14:22:31'),
(39, 'services', 'services', NULL, NULL, NULL, NULL, 'blogCat', 1, 'public', '2021-01-04 14:22:44', '2021-01-04 14:22:44'),
(40, 'Packages', 'packages', NULL, NULL, NULL, NULL, 'blogCat', 1, 'public', '2021-01-04 14:37:46', '2021-01-04 14:37:46'),
(41, 'news 1', 'news-1', NULL, NULL, '1111', '222', 'blog', 1, 'draft', '2021-01-04 15:04:13', '2021-01-04 15:04:13'),
(42, 'news 1', 'news-1-1', NULL, NULL, '1111', '222', 'blog', 1, 'draft', '2021-01-04 15:06:44', '2021-01-04 15:06:44'),
(43, 'new s 1', 'new-s-1', NULL, NULL, NULL, NULL, 'blog', 1, 'public', '2021-01-04 15:16:41', '2021-01-04 15:16:41'),
(44, 'FERRARI', 'hyundai', 33, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-05 07:35:02', '2021-01-16 13:53:30'),
(45, 'MERCEDES-BENZ', 'chevrolet', 32, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-05 08:17:07', '2021-01-06 08:31:05'),
(46, 'BMW', 'bmw', 31, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:32:37', '2021-01-06 08:32:37'),
(47, 'HONDA', 'honda', 30, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:33:24', '2021-01-06 08:33:24'),
(48, 'FORD', 'ford', 29, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:34:08', '2021-01-06 08:34:08'),
(49, 'TOYOTA', 'toyota', 28, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:34:35', '2021-01-06 08:34:35'),
(50, 'CHEVROLET', 'chevrolet-1', 27, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:35:06', '2021-01-06 08:35:06'),
(51, 'HYUNDAI', 'hyundai', 25, NULL, NULL, NULL, 'plan', 1, 'public', '2021-01-06 08:35:46', '2021-01-19 14:43:53'),
(55, 'DIAMOND', 'diamond', 39, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:02:22', '2021-01-06 22:02:22'),
(56, 'RUBY', 'ruby', 38, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:02:46', '2021-01-06 22:02:46'),
(57, 'PLATINUM', 'platinum', 36, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:03:10', '2021-01-06 22:03:10'),
(58, 'GOLD', 'gold', 37, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:03:51', '2021-01-06 22:03:51'),
(59, 'SILVER', 'silver', 35, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:04:16', '2021-01-06 22:04:16'),
(60, 'BRONZE', 'bronze', 36, NULL, NULL, NULL, 'affiate', 1, 'public', '2021-01-06 22:04:43', '2021-01-06 22:16:24'),
(61, 'Investments', 'investments', NULL, NULL, NULL, NULL, 'page', 1, 'public', '2021-01-13 21:22:15', '2021-01-13 21:29:46'),
(62, 'FAQs', 'faqs', NULL, NULL, NULL, NULL, 'page', 1, 'public', '2021-01-13 21:24:08', '2021-01-18 21:48:53'),
(63, 'Terms', 'terms', NULL, 'Đội ngũ kỹ thuật viên phân công', 'Đội ngũ kỹ thuật viên', 'Chúng tôi tiến hành xây dựng Website/App từ A-Z', 'page', 1, 'public', '2021-01-13 21:24:47', '2021-01-21 14:46:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` float UNSIGNED NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci COMMENT 'It''s useful when deposit has been deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `referrals`
--

INSERT INTO `referrals` (`id`, `user_id`, `deposit_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(4, 16, 7, 2, '{\"username\":\"Account New\",\"planname\":\"HYUNDAI\",\"amount\":20,\"rate\":\"10\"}', '2021-02-25 22:17:26', '2021-02-25 22:17:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 'Administrator', '2020-12-31 08:46:12', '2020-12-31 09:08:22'),
(6, 'customer', 'web', 'Customer', '2020-12-31 15:03:47', '2020-12-31 15:03:47'),
(7, 'manager', 'web', 'Manager', '2020-12-31 15:06:16', '2020-12-31 15:06:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(9, 6),
(10, 6),
(1, 7),
(17, 7),
(18, 7),
(19, 7),
(20, 7),
(21, 7),
(22, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GrBaBkLScNJdNPIy8yRgEZ3kdOSrPzfXlwggbPCF', NULL, '116.98.248.220', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEx1MTdlNHJYd3hDVHVFSFRtbjlxd0NTZ2lYUzdqRGpNeHVRcjhnSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTM3OiJodHRwczovL2ljYXIuZHNtYXJ0LndvcmsvcmVzZXQtcGFzc3dvcmQvOWJmYjUzNWNhMjVkY2E4MTQzODM1NWYyODhmMGQ2MjIwZmZkNTc5NjNkN2VkMTFhMTFkMzdkNjcwZDdlNmEwYj9lbWFpbD12YW5waHVvYzI2MDc5NyU0MGdtYWlsLmNvbSI7fX0=', 1617935524);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user do action (admin)',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'deposit',
  `content` text COLLATE utf8mb4_unicode_ci,
  `amount` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'request',
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `user_action` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'add/subtract to amount of user!',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='User amount transactions';

--
-- Đang đổ dữ liệu cho bảng `transactions`
--

INSERT INTO `transactions` (`id`, `author`, `user_id`, `type`, `content`, `amount`, `status`, `image`, `user_action`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'withdraw', '<p>sdasdasdasda</p>', 10, 'request', NULL, 'no', '2021-01-12 14:46:22', '2021-01-12 14:46:22'),
(2, 1, 16, 'send', '<p>dasd</p>', 20, 'request', 25, 'no', '2021-01-12 14:48:15', '2021-01-15 01:11:42'),
(5, 1, 16, 'send', '<p>ád</p>', 100, 'complete', NULL, 'no', '2021-01-15 02:09:35', '2021-01-15 02:09:35'),
(8, 1, 16, 'withdraw', 'Withdraw', 10, 'complete', 34, 'no', '2021-01-15 16:18:24', '2021-01-15 16:18:24'),
(9, 16, 16, 'send', 'Please add $20 to my account', 20, 'request', NULL, 'no', '2021-02-23 20:48:56', '2021-02-23 20:48:56'),
(10, 19, 19, 'send', 'Please add me 100$, i sent your account 100$', 100, 'request', NULL, 'no', '2021-02-24 20:58:10', '2021-02-24 20:58:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `displayname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float UNSIGNED NOT NULL DEFAULT '0',
  `referral_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `displayname`, `image`, `address`, `phone`, `last_login`, `amount`, `referral_id`, `created_at`, `updated_at`) VALUES
(1, 'lqviet', 'lqviet.it@gmail.com', NULL, '$2y$10$HgougrZAmSEL/oXEP63BdeL2YppaE0ph9ileB2WrKhhDkacbm/cOO', NULL, NULL, 'rJaJx0SaVif03L1EhwtL0XrP8ovdYxeI3KUGmGFo3HVcORCXd8APZJrJJPJF', NULL, NULL, 'lqviet.it@gmail.com', NULL, NULL, '0123456789', '2021-02-27 13:32:27', 1000, NULL, '2020-12-28 12:34:30', '2021-02-27 18:32:27'),
(2, 'qweqweqwe', '123213@gmail.com', NULL, '$2y$10$YdiHcOBPH5xF2KdDAAi6.Owyvp4AozB0dG7ruEfUaqNW63HxumDoW', NULL, NULL, NULL, NULL, NULL, 'qeweqweqw  weqwq', 3, '213123123', '123123213123', NULL, 0, NULL, '2020-12-30 08:59:16', '2020-12-30 14:39:45'),
(16, 'hoang_thuy', 'bigdout401@gmail.com', NULL, '$2y$10$skGAkMgVNFMenb6vXSSu/.IpvO1u8JNVKf8Vj8/rS.HcnrscqkocC', NULL, NULL, NULL, NULL, NULL, 'Hoàng Hồ Vĩnh Thuỵ', NULL, '123123123123', '01345555555', '2021-02-26 13:40:00', 25, NULL, '2021-01-07 14:08:17', '2021-02-26 18:40:00'),
(17, 'vanphuoc260797', 'vanphuoc260797@gmail.com', NULL, '$2y$10$QTuwjAFRtmfWhIJHfBRnFeypusJ31AS.9qHSpY3BzDIQPe9ED2IRm', NULL, NULL, NULL, NULL, NULL, 'Nguyễn Phước', NULL, '14 nguyễn văn cừ', '0363906700', '2021-04-09 09:29:32', 0, NULL, '2021-02-19 14:48:42', '2021-04-09 13:29:32'),
(19, 'testtest', 'abcccc@gmail.com', NULL, '$2y$10$NXQQFrsqFgpNZs72bvAiAOlvvT/9yXPswXYi9YoEZE1wwVKexXcYq', NULL, NULL, NULL, NULL, NULL, 'TEstt Custom Register', NULL, NULL, NULL, '2021-02-24 15:57:26', 0, NULL, '2021-02-24 20:57:26', '2021-02-24 20:57:26'),
(32, 'tessst', 'ahn@gmail.com', NULL, '$2y$10$ecEDXYgLMrGHVPvsat9fau9pYa9XIe1auQuE3idKxO.Hsmv/ojJce', NULL, NULL, NULL, NULL, NULL, 'Tessssttt Referral', NULL, NULL, NULL, '2021-02-25 09:29:23', 0, NULL, '2021-02-25 14:29:23', '2021-02-25 14:29:23'),
(36, 'account', 'kok@gmail.com', NULL, '$2y$10$GY86nhbzHUa4iTSFQ/ygqewFQNurvmxQrlSLb//k5yLlKGl0pJThO', NULL, NULL, NULL, NULL, NULL, 'Account New', NULL, NULL, '02136546456', '2021-02-26 14:41:59', 58, 16, '2021-02-25 15:14:54', '2021-02-26 19:41:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_metas`
--

CREATE TABLE `user_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_metas`
--

INSERT INTO `user_metas` (`id`, `user_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 16, 'earned_total', '20', '2021-01-16 14:53:38', '2021-01-16 14:53:52');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `affiates`
--
ALTER TABLE `affiates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affiates_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_post_id_foreign` (`post_id`),
  ADD KEY `blogs_cat_id_foreign` (`cat_ids`);

--
-- Chỉ mục cho bảng `blog_cats`
--
ALTER TABLE `blog_cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_cats_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_fields_group_id_foreign` (`group_id`);

--
-- Chỉ mục cho bảng `custom_field_group`
--
ALTER TABLE `custom_field_group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `media_cates`
--
ALTER TABLE `media_cates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `media_media_cate`
--
ALTER TABLE `media_media_cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_media_cate_media_id_foreign` (`media_id`),
  ADD KEY `media_media_cate_cate_id_foreign` (`cate_id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_metas`
--
ALTER TABLE `menu_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_metas_user_id_foreign` (`user_id`),
  ADD KEY `menu_metas_post_id_foreign` (`post_id`),
  ADD KEY `menu_metas_menu_id_foreign` (`menu_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pages_post_id_foreign` (`post_id`) USING BTREE;

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_post_id_foreign` (`post_id`);

--
-- Chỉ mục cho bảng `plan_user`
--
ALTER TABLE `plan_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_user_plan_id_foreign` (`plan_id`),
  ADD KEY `plan_user_user_id_foreign` (`user_id`),
  ADD KEY `plan_user_author_foreign` (`author`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`),
  ADD KEY `posts_image_id_foreign` (`image_id`);

--
-- Chỉ mục cho bảng `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_deposit_id_foreign` (`deposit_id`),
  ADD KEY `referrals_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_author_foreign` (`author`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_image_foreign` (`image`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_image_foreign` (`image`);

--
-- Chỉ mục cho bảng `user_metas`
--
ALTER TABLE `user_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_metas_user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `affiates`
--
ALTER TABLE `affiates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `blog_cats`
--
ALTER TABLE `blog_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `custom_fields`
--
ALTER TABLE `custom_fields`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT cho bảng `custom_field_group`
--
ALTER TABLE `custom_field_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `media_cates`
--
ALTER TABLE `media_cates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `media_media_cate`
--
ALTER TABLE `media_media_cate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `menu_metas`
--
ALTER TABLE `menu_metas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `plan_user`
--
ALTER TABLE `plan_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `user_metas`
--
ALTER TABLE `user_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `affiates`
--
ALTER TABLE `affiates`
  ADD CONSTRAINT `affiates_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `blog_cats`
--
ALTER TABLE `blog_cats`
  ADD CONSTRAINT `blog_cats_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `custom_fields`
--
ALTER TABLE `custom_fields`
  ADD CONSTRAINT `custom_fields_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `custom_field_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `media_media_cate`
--
ALTER TABLE `media_media_cate`
  ADD CONSTRAINT `media_media_cate_cate_id_foreign` FOREIGN KEY (`cate_id`) REFERENCES `media_cates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media_media_cate_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `menu_metas`
--
ALTER TABLE `menu_metas`
  ADD CONSTRAINT `menu_metas_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_metas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `plan_user`
--
ALTER TABLE `plan_user`
  ADD CONSTRAINT `plan_user_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `plan_user_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `plan_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `media` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `plan_user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `referrals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_image_foreign` FOREIGN KEY (`image`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_image_foreign` FOREIGN KEY (`image`) REFERENCES `media` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `user_metas`
--
ALTER TABLE `user_metas`
  ADD CONSTRAINT `user_metas_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
