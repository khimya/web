-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2020 at 06:08 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hd_wallpaper_buyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `email`, `image`) VALUES
(1, 'admin', 'admin', 'viaviwebtech@gmail.com', 'profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cid` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`, `category_image`, `status`) VALUES
(1, 'Abstract', '66832_Abstract_Category_400_200.jpg', 1),
(2, 'Baby', '8312_beby_category_1_400_200.jpg', 1),
(3, 'Bike', '49067_Bike_Category_400_200.jpg', 1),
(4, 'Bird', '38144_Bird.jpg', 1),
(5, 'Car', '177_Car_Category_400_200.jpg', 1),
(6, 'Celebrities', '66450_fashion_1.jpg', 1),
(7, 'Love', '93863_Love_Category1_400_200.jpg', 1),
(8, 'Nature', '99528_nature.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `color_id` int(10) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `color_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`color_id`, `color_name`, `color_code`, `color_status`) VALUES
(1, 'Red', '#FF0000', 1),
(2, 'Green', '#079D00', 1),
(3, 'Yellow', '#D5E919', 1),
(4, 'Dark Pink', '#E9173B', 1),
(5, 'Sky Blue', '#17C3E9', 1),
(6, 'Blue', '#176BE9', 1),
(7, 'Purple', '#AE0BE9', 1),
(8, 'Gray', '#C3BBBC', 1),
(9, 'Violet', '#857AE9', 1),
(10, 'Midnight Blue', '#00397A', 1),
(11, 'Popti', '#A9D65D', 1),
(12, 'Wood', '#B08E65', 1),
(13, 'Cyan', '#75E9DE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_home_banner`
--

CREATE TABLE `tbl_home_banner` (
  `id` int(11) NOT NULL,
  `banner_name` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating_gif`
--

CREATE TABLE `tbl_rating_gif` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `onesignal_app_id` text NOT NULL,
  `onesignal_rest_key` text NOT NULL,
  `envato_buyer_name` varchar(200) NOT NULL,
  `envato_purchase_code` text NOT NULL,
  `envato_buyer_email` varchar(150) NOT NULL,
  `envato_purchased_status` int(1) NOT NULL DEFAULT 1,
  `package_name` varchar(150) NOT NULL,
  `ios_bundle_identifier` varchar(200) NOT NULL,
  `app_api_key` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `app_logo` varchar(255) NOT NULL,
  `app_email` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `app_author` varchar(255) NOT NULL,
  `app_contact` varchar(255) NOT NULL,
  `app_website` varchar(255) NOT NULL,
  `app_description` text NOT NULL,
  `app_developed_by` varchar(255) NOT NULL,
  `app_privacy_policy` text NOT NULL,
  `item_type` varchar(255) NOT NULL DEFAULT 'Portrait',
  `gif_on_off` varchar(255) NOT NULL DEFAULT 'true',
  `home_latest_limit` int(2) NOT NULL DEFAULT 10,
  `home_most_viewed_limit` int(2) NOT NULL DEFAULT 10,
  `home_most_rated_limit` int(2) NOT NULL DEFAULT 10,
  `home_limit` int(3) NOT NULL DEFAULT 10,
  `home_landscape_limit` int(2) NOT NULL DEFAULT 10,
  `home_square_limit` int(2) NOT NULL DEFAULT 10,
  `api_latest_limit` int(3) NOT NULL DEFAULT 15,
  `api_cat_order_by` varchar(255) NOT NULL DEFAULT 'category_name',
  `api_cat_post_order_by` varchar(255) NOT NULL DEFAULT 'DESC',
  `api_gif_post_order_by` varchar(255) NOT NULL DEFAULT 'DESC',
  `publisher_id` text NOT NULL,
  `interstital_ad` varchar(255) NOT NULL,
  `interstital_ad_id` varchar(255) NOT NULL,
  `interstital_ad_click` varchar(255) NOT NULL,
  `banner_ad` varchar(255) NOT NULL,
  `banner_ad_id` varchar(255) NOT NULL,
  `facebook_interstital_ad` varchar(255) NOT NULL,
  `facebook_interstital_ad_id` varchar(255) NOT NULL,
  `facebook_interstital_ad_click` varchar(255) NOT NULL,
  `facebook_banner_ad` varchar(255) NOT NULL,
  `facebook_banner_ad_id` varchar(255) NOT NULL,
  `facebook_native_ad` varchar(255) NOT NULL,
  `facebook_native_ad_id` varchar(255) NOT NULL,
  `facebook_native_ad_click` varchar(255) NOT NULL,
  `admob_nathive_ad` varchar(255) NOT NULL,
  `admob_native_ad_id` varchar(255) NOT NULL,
  `admob_native_ad_click` varchar(255) NOT NULL,
  `publisher_id_ios` varchar(500) NOT NULL,
  `app_id_ios` varchar(500) NOT NULL,
  `interstital_ad_ios` varchar(500) NOT NULL,
  `interstital_ad_id_ios` varchar(500) NOT NULL,
  `interstital_ad_click_ios` varchar(500) NOT NULL,
  `banner_ad_ios` varchar(500) NOT NULL,
  `banner_ad_id_ios` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `onesignal_app_id`, `onesignal_rest_key`, `envato_buyer_name`, `envato_purchase_code`, `envato_buyer_email`, `envato_purchased_status`, `package_name`, `ios_bundle_identifier`, `app_api_key`, `app_name`, `app_logo`, `app_email`, `app_version`, `app_author`, `app_contact`, `app_website`, `app_description`, `app_developed_by`, `app_privacy_policy`, `item_type`, `gif_on_off`, `home_latest_limit`, `home_most_viewed_limit`, `home_most_rated_limit`, `home_limit`, `home_landscape_limit`, `home_square_limit`, `api_latest_limit`, `api_cat_order_by`, `api_cat_post_order_by`, `api_gif_post_order_by`, `publisher_id`, `interstital_ad`, `interstital_ad_id`, `interstital_ad_click`, `banner_ad`, `banner_ad_id`, `facebook_interstital_ad`, `facebook_interstital_ad_id`, `facebook_interstital_ad_click`, `facebook_banner_ad`, `facebook_banner_ad_id`, `facebook_native_ad`, `facebook_native_ad_id`, `facebook_native_ad_click`, `admob_nathive_ad`, `admob_native_ad_id`, `admob_native_ad_click`, `publisher_id_ios`, `app_id_ios`, `interstital_ad_ios`, `interstital_ad_id_ios`, `interstital_ad_click_ios`, `banner_ad_ios`, `banner_ad_id_ios`) VALUES
(1, '', '', '', '', '', 0, '', '', 'YtmpgwcUzCbeh1JlsK0gR0njtXm9g9lAUt4pzsPZhsH8a', 'HD Wallpaper App', 'Icon144.png', 'info@viaviweb.com', '1.0.0', 'Viavi Webtech', '+91 9227777522', 'www.viaviweb.com', '<p><strong>&ldquo;HD Wallpaper&rdquo;</strong> is a cool new app that brings all the best HD wallpapers and backgrounds to your Android device.</p>\r\n\r\n<p>Each high resolution image has been perfectly formatted fit to the phone display and comes with a host of user friendly features. The stunning UI allows you easily tap and swipe your way through the multiple image galleries. To develop similar app with your name you can contact us via skype or whatsapp.<br />\r\n<br />\r\n<strong>Skype:</strong> viaviwebtech<br />\r\n<strong>WhatsApp:</strong> +919227777522</p>\r\n', 'Viavi Webtech', '<p><strong>We are committed to protecting your privacy</strong></p>\r\n\r\n<p>We collect the minimum amount of information about you that is commensurate with providing you with a satisfactory service. This policy indicates the type of processes that may result in data being collected about you. Your use of this website gives us the right to collect that information.&nbsp;</p>\r\n\r\n<p><strong>Information Collected</strong></p>\r\n\r\n<p>We may collect any or all of the information that you give us depending on the type of transaction you enter into, including your name, address, telephone number, and email address, together with data about your use of the website. Other information that may be needed from time to time to process a request may also be collected as indicated on the website.</p>\r\n\r\n<p><strong>Information Use</strong></p>\r\n\r\n<p>We use the information collected primarily to process the task for which you visited the website. Data collected in the UK is held in accordance with the Data Protection Act. All reasonable precautions are taken to prevent unauthorised access to this information. This safeguard may require you to provide additional forms of identity should you wish to obtain information about your account details.</p>\r\n\r\n<p><strong>Cookies</strong></p>\r\n\r\n<p>Your Internet browser has the in-built facility for storing small files - &quot;cookies&quot; - that hold information which allows a website to recognise your account. Our website takes advantage of this facility to enhance your experience. You have the ability to prevent your computer from accepting cookies but, if you do, certain functionality on the website may be impaired.</p>\r\n\r\n<p><strong>Disclosing Information</strong></p>\r\n\r\n<p>We do not disclose any personal information obtained about you from this website to third parties unless you permit us to do so by ticking the relevant boxes in registration or competition forms. We may also use the information to keep in contact with you and inform you of developments associated with us. You will be given the opportunity to remove yourself from any mailing list or similar device. If at any time in the future we should wish to disclose information collected on this website to any third party, it would only be with your knowledge and consent.&nbsp;</p>\r\n\r\n<p>We may from time to time provide information of a general nature to third parties - for example, the number of individuals visiting our website or completing a registration form, but we will not use any information that could identify those individuals.&nbsp;</p>\r\n\r\n<p>In addition Dummy may work with third parties for the purpose of delivering targeted behavioural advertising to the Dummy website. Through the use of cookies, anonymous information about your use of our websites and other websites will be used to provide more relevant adverts about goods and services of interest to you. For more information on online behavioural advertising and about how to turn this feature off, please visit youronlinechoices.com/opt-out.</p>\r\n\r\n<p><strong>Changes to this Policy</strong></p>\r\n\r\n<p>Any changes to our Privacy Policy will be placed here and will supersede this version of our policy. We will take reasonable steps to draw your attention to any changes in our policy. However, to be on the safe side, we suggest that you read this document each time you use the website to ensure that it still meets with your approval.</p>\r\n\r\n<p><strong>Contacting Us</strong></p>\r\n\r\n<p>If you have any questions about our Privacy Policy, or if you want to know what information we have collected about you, please email us at hd@dummy.com. You can also correct any factual errors in that information or require us to remove your details form any list under our control.</p>\r\n', 'Portrait', 'true', 20, 20, 20, 10, 10, 10, 20, 'category_name', 'DESC', 'ASC', 'pub-8356404931736973', 'true', 'ca-app-pub-3940256099942544/1033173712', '5', 'true', 'ca-app-pub-3940256099942544/6300978111', '', '', '', '', '', '', '', '', '', '', '', 'pub-8356404931736973', 'ca-app-pub-8356404931736973~5938963872', 'true', 'ca-app-pub-8356404931736973/9495065509', '5', 'true', 'ca-app-pub-8356404931736973/7383907483');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smtp_settings`
--

CREATE TABLE `tbl_smtp_settings` (
  `id` int(5) NOT NULL,
  `smtp_host` varchar(150) NOT NULL,
  `smtp_email` varchar(150) NOT NULL,
  `smtp_password` text NOT NULL,
  `smtp_secure` varchar(20) NOT NULL,
  `port_no` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_smtp_settings`
--

INSERT INTO `tbl_smtp_settings` (`id`, `smtp_host`, `smtp_email`, `smtp_password`, `smtp_secure`, `port_no`) VALUES
(1, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_report`
--

CREATE TABLE `tbl_user_report` (
  `user_report_id` int(10) NOT NULL,
  `report_for` varchar(30) NOT NULL,
  `user_id` int(5) NOT NULL,
  `parent_id` int(5) NOT NULL,
  `user_message` longtext NOT NULL,
  `seneded_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_report_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallpaper`
--

CREATE TABLE `tbl_wallpaper` (
  `id` int(11) NOT NULL,
  `featured` int(1) NOT NULL DEFAULT 0,
  `cat_id` int(11) NOT NULL,
  `wallpaper_type` varchar(255) NOT NULL DEFAULT 'none',
  `image_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `wall_tags` text NOT NULL,
  `wall_colors` text NOT NULL,
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` decimal(11,0) DEFAULT 0,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_download` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wallpaper`
--

INSERT INTO `tbl_wallpaper` (`id`, `featured`, `cat_id`, `wallpaper_type`, `image_date`, `image`, `wall_tags`, `wall_colors`, `total_rate`, `rate_avg`, `total_views`, `total_download`) VALUES
(1, 0, 4, 'Landscape', '2019-01-18', '6609_54559_Bird_landscap_6.jpg', 'Bird, Landscape ', '', 0, '0', 0, 0),
(2, 0, 1, 'Landscape', '2019-01-18', '49406_7419_Abstract_11.jpg', 'Abstract', '', 0, '0', 0, 0),
(3, 0, 2, 'Landscape', '2019-01-18', '45306_2_Baby_13.jpg', 'Baby,girl', '', 0, '0', 0, 0),
(4, 0, 3, 'Portrait', '2019-01-18', '27498_10101_Bike_6.jpg', 'bike,race', '', 0, '0', 0, 0),
(5, 0, 3, 'Landscape', '2019-01-18', '34109_16372_Bike_18.jpg', 'bike, Landscape,girl', '', 0, '0', 0, 0),
(6, 0, 6, 'Landscape', '2019-01-18', '2048_59621_Celebrities_1.jpg', 'beauty,fashion', '', 0, '0', 0, 0),
(7, 0, 6, 'Square', '2019-01-18', '4248_34560_fashion_1.jpg', 'beauty,fashion', '', 0, '0', 0, 0),
(8, 0, 7, 'Portrait', '2019-01-18', '71599_4842_Love_16.jpg', 'love', '', 0, '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wallpaper_gif`
--

CREATE TABLE `tbl_wallpaper_gif` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `gif_tags` text NOT NULL,
  `total_views` int(11) NOT NULL DEFAULT 0,
  `total_rate` int(11) NOT NULL DEFAULT 0,
  `rate_avg` decimal(11,2) NOT NULL DEFAULT 0.00,
  `total_download` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_wallpaper_gif`
--

INSERT INTO `tbl_wallpaper_gif` (`id`, `image`, `gif_tags`, `total_views`, `total_rate`, `rate_avg`, `total_download`) VALUES
(1, '17670_4.gif', 'cartoon', 90, 0, '0.00', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating_gif`
--
ALTER TABLE `tbl_rating_gif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_report`
--
ALTER TABLE `tbl_user_report`
  ADD PRIMARY KEY (`user_report_id`);

--
-- Indexes for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wallpaper_gif`
--
ALTER TABLE `tbl_wallpaper_gif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `color_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_home_banner`
--
ALTER TABLE `tbl_home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rating_gif`
--
ALTER TABLE `tbl_rating_gif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_smtp_settings`
--
ALTER TABLE `tbl_smtp_settings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user_report`
--
ALTER TABLE `tbl_user_report`
  MODIFY `user_report_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wallpaper`
--
ALTER TABLE `tbl_wallpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_wallpaper_gif`
--
ALTER TABLE `tbl_wallpaper_gif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
