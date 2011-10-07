-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2011 at 10:31 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `afrofunk`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_mapping`
--

DROP TABLE IF EXISTS `address_mapping`;
CREATE TABLE IF NOT EXISTS `address_mapping` (
  `address_type` char(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`address_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address_mapping`
--

INSERT INTO `address_mapping` (`address_type`, `description`) VALUES('BIL', 'Billing address type');
INSERT INTO `address_mapping` (`address_type`, `description`) VALUES('SHP', 'Shipping address type');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(4) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `parent_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `is_active`, `parent_id`) VALUES(1, 'Girls', 1, NULL);
INSERT INTO `category` (`category_id`, `category_name`, `is_active`, `parent_id`) VALUES(2, 'Boys', 1, NULL);
INSERT INTO `category` (`category_id`, `category_name`, `is_active`, `parent_id`) VALUES(3, 'Accessories', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_photo_slice`
--

DROP TABLE IF EXISTS `category_photo_slice`;
CREATE TABLE IF NOT EXISTS `category_photo_slice` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `filename` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `weight` float NOT NULL DEFAULT '0',
  `category_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category_photo_slice`
--

INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(9, '1.png', 1, 0, 1);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(2, '2.png', 1, 1, 1);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(3, '3.png', 1, 2, 1);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(4, '4.png', 1, 0, 2);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(5, '5.png', 1, 0, 2);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(6, '6.png', 1, 0, 3);
INSERT INTO `category_photo_slice` (`id`, `filename`, `is_active`, `weight`, `category_id`) VALUES(7, '7.png', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `color_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(50) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_name`, `weight`) VALUES(1, 'Red', 0);
INSERT INTO `color` (`color_id`, `color_name`, `weight`) VALUES(2, 'Blue', 0);
INSERT INTO `color` (`color_id`, `color_name`, `weight`) VALUES(3, 'Yellow', 0);
INSERT INTO `color` (`color_id`, `color_name`, `weight`) VALUES(4, 'Green', 0);
INSERT INTO `color` (`color_id`, `color_name`, `weight`) VALUES(5, 'Pink', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(4) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `iso_2` char(2) DEFAULT NULL,
  `iso_3` char(3) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(1, 'Afghanistan', 'AF', 'AFG', '93', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(2, 'Albania', 'AL', 'ALB', '355', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(3, 'Algeria', 'DZ', 'DZA', '213', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(4, 'American Samoa', 'AS', 'ASM', '1 684', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(5, 'Andorra', 'AD', 'AND', '376', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(6, 'Angola', 'AO', 'AGO', '244', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(7, 'Anguilla', 'AI', 'AIA', '1 264', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(8, 'Antarctica', 'AQ', 'ATA', '672', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(9, 'Antigua and Barbuda', 'AG', 'ATG', '1 268', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(10, 'Argentina', 'AR', 'ARG', '54', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(11, 'Armenia', 'AM', 'ARM', '374', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(12, 'Aruba', 'AW', 'ABW', '297', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(13, 'Australia', 'AU', 'AUS', '61', 0, 1);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(14, 'Austria', 'AT', 'AUT', '43', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(15, 'Azerbaijan', 'AZ', 'AZE', '994', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(16, 'Bahamas', 'BS', 'BHS', '1 242', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(17, 'Bahrain', 'BH', 'BHR', '973', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(18, 'Bangladesh', 'BD', 'BGD', '880', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(19, 'Barbados', 'BB', 'BRB', '1 246', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(20, 'Belarus', 'BY', 'BLR', '375', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(21, 'Belgium', 'BE', 'BEL', '32', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(22, 'Belize', 'BZ', 'BLZ', '501', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(23, 'Benin', 'BJ', 'BEN', '229', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(24, 'Bermuda', 'BM', 'BMU', '1 441', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(25, 'Bhutan', 'BT', 'BTN', '975', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(26, 'Bolivia', 'BO', 'BOL', '591', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '387', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(28, 'Botswana', 'BW', 'BWA', '267', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(29, 'Brazil', 'BR', 'BRA', '55', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(30, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(31, 'British Virgin Islands', 'VG', 'VGB', '1 284', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(32, 'Brunei', 'BN', 'BRN', '673', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(33, 'Bulgaria', 'BG', 'BGR', '359', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(34, 'Burkina Faso', 'BF', 'BFA', '226', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(35, 'Burma (Myanmar)', 'MM', 'MMR', '95', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(36, 'Burundi', 'BI', 'BDI', '257', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(37, 'Cambodia', 'KH', 'KHM', '855', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(38, 'Cameroon', 'CM', 'CMR', '237', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(39, 'Canada', 'CA', 'CAN', '1', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(40, 'Cape Verde', 'CV', 'CPV', '238', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(41, 'Cayman Islands', 'KY', 'CYM', '1 345', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(42, 'Central African Republic', 'CF', 'CAF', '236', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(43, 'Chad', 'TD', 'TCD', '235', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(44, 'Chile', 'CL', 'CHL', '56', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(45, 'China', 'CN', 'CHN', '86', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(46, 'Christmas Island', 'CX', 'CXR', '61', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(47, 'Cocos (Keeling) Islands', 'CC', 'CCK', '61', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(48, 'Colombia', 'CO', 'COL', '57', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(49, 'Comoros', 'KM', 'COM', '269', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(50, 'Cook Islands', 'CK', 'COK', '682', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(51, 'Costa Rica', 'CR', 'CRC', '506', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(52, 'Croatia', 'HR', 'HRV', '385', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(53, 'Cuba', 'CU', 'CUB', '53', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(54, 'Cyprus', 'CY', 'CYP', '357', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(55, 'Czech Republic', 'CZ', 'CZE', '420', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(56, 'Democratic Republic of the Congo', 'CD', 'COD', '243', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(57, 'Denmark', 'DK', 'DNK', '45', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(58, 'Djibouti', 'DJ', 'DJI', '253', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(59, 'Dominica', 'DM', 'DMA', '1 767', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(60, 'Dominican Republic', 'DO', 'DOM', '1 809', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(61, 'Ecuador', 'EC', 'ECU', '593', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(62, 'Egypt', 'EG', 'EGY', '20', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(63, 'El Salvador', 'SV', 'SLV', '503', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(64, 'Equatorial Guinea', 'GQ', 'GNQ', '240', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(65, 'Eritrea', 'ER', 'ERI', '291', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(66, 'Estonia', 'EE', 'EST', '372', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(67, 'Ethiopia', 'ET', 'ETH', '251', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(68, 'Falkland Islands', 'FK', 'FLK', '500', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(69, 'Faroe Islands', 'FO', 'FRO', '298', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(70, 'Fiji', 'FJ', 'FJI', '679', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(71, 'Finland', 'FI', 'FIN', '358', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(72, 'France', 'FR', 'FRA', '33', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(73, 'French Polynesia', 'PF', 'PYF', '689', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(74, 'Gabon', 'GA', 'GAB', '241', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(75, 'Gambia', 'GM', 'GMB', '220', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(76, 'Georgia', 'GE', 'GEO', '995', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(77, 'Germany', 'DE', 'DEU', '49', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(78, 'Ghana', 'GH', 'GHA', '233', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(79, 'Gibraltar', 'GI', 'GIB', '350', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(80, 'Greece', 'GR', 'GRC', '30', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(81, 'Greenland', 'GL', 'GRL', '299', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(82, 'Grenada', 'GD', 'GRD', '1 473', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(83, 'Guam', 'GU', 'GUM', '1 671', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(84, 'Guatemala', 'GT', 'GTM', '502', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(85, 'Guinea', 'GN', 'GIN', '224', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(86, 'Guinea-Bissau', 'GW', 'GNB', '245', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(87, 'Guyana', 'GY', 'GUY', '592', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(88, 'Haiti', 'HT', 'HTI', '509', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(89, 'Holy See (Vatican City)', 'VA', 'VAT', '39', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(90, 'Honduras', 'HN', 'HND', '504', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(91, 'Hong Kong', 'HK', 'HKG', '852', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(92, 'Hungary', 'HU', 'HUN', '36', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(93, 'Iceland', 'IS', 'IS', '354', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(94, 'India', 'IN', 'IND', '91', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(95, 'Indonesia', 'ID', 'IDN', '62', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(96, 'Iran', 'IR', 'IRN', '98', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(97, 'Iraq', 'IQ', 'IRQ', '964', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(98, 'Ireland', 'IE', 'IRL', '353', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(99, 'Isle of Man', 'IM', 'IMN', '44', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(100, 'Israel', 'IL', 'ISR', '972', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(101, 'Italy', 'IT', 'ITA', '39', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(102, 'Ivory Coast', 'CI', 'CIV', '225', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(103, 'Jamaica', 'JM', 'JAM', '1 876', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(104, 'Japan', 'JP', 'JPN', '81', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(105, 'Jersey', 'JE', 'JEY', '', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(106, 'Jordan', 'JO', 'JOR', '962', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(107, 'Kazakhstan', 'KZ', 'KAZ', '7', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(108, 'Kenya', 'KE', 'KEN', '254', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(109, 'Kiribati', 'KI', 'KIR', '686', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(110, 'Kuwait', 'KW', 'KWT', '965', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(111, 'Kyrgyzstan', 'KG', 'KGZ', '996', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(112, 'Laos', 'LA', 'LAO', '856', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(113, 'Latvia', 'LV', 'LVA', '371', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(114, 'Lebanon', 'LB', 'LBN', '961', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(115, 'Lesotho', 'LS', 'LSO', '266', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(116, 'Liberia', 'LR', 'LBR', '231', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(117, 'Libya', 'LY', 'LBY', '218', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(118, 'Liechtenstein', 'LI', 'LIE', '423', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(119, 'Lithuania', 'LT', 'LTU', '370', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(120, 'Luxembourg', 'LU', 'LUX', '352', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(121, 'Macau', 'MO', 'MAC', '853', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(122, 'Macedonia', 'MK', 'MKD', '389', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(123, 'Madagascar', 'MG', 'MDG', '261', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(124, 'Malawi', 'MW', 'MWI', '265', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(125, 'Malaysia', 'MY', 'MYS', '60', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(126, 'Maldives', 'MV', 'MDV', '960', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(127, 'Mali', 'ML', 'MLI', '223', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(128, 'Malta', 'MT', 'MLT', '356', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(129, 'Marshall Islands', 'MH', 'MHL', '692', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(130, 'Mauritania', 'MR', 'MRT', '222', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(131, 'Mauritius', 'MU', 'MUS', '230', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(132, 'Mayotte', 'YT', 'MYT', '262', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(133, 'Mexico', 'MX', 'MEX', '52', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(134, 'Micronesia', 'FM', 'FSM', '691', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(135, 'Moldova', 'MD', 'MDA', '373', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(136, 'Monaco', 'MC', 'MCO', '377', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(137, 'Mongolia', 'MN', 'MNG', '976', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(138, 'Montenegro', 'ME', 'MNE', '382', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(139, 'Montserrat', 'MS', 'MSR', '1 664', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(140, 'Morocco', 'MA', 'MAR', '212', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(141, 'Mozambique', 'MZ', 'MOZ', '258', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(142, 'Namibia', 'NA', 'NAM', '264', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(143, 'Nauru', 'NR', 'NRU', '674', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(144, 'Nepal', 'NP', 'NPL', '977', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(145, 'Netherlands', 'NL', 'NLD', '31', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(146, 'Netherlands Antilles', 'AN', 'ANT', '599', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(147, 'New Caledonia', 'NC', 'NCL', '687', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(148, 'New Zealand', 'NZ', 'NZL', '64', 0, 1);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(149, 'Nicaragua', 'NI', 'NIC', '505', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(150, 'Niger', 'NE', 'NER', '227', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(151, 'Nigeria', 'NG', 'NGA', '234', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(152, 'Niue', 'NU', 'NIU', '683', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(153, 'Norfolk Island', '', 'NFK', '672', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(154, 'North Korea', 'KP', 'PRK', '850', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(155, 'Northern Mariana Islands', 'MP', 'MNP', '1 670', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(156, 'Norway', 'NO', 'NOR', '47', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(157, 'Oman', 'OM', 'OMN', '968', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(158, 'Pakistan', 'PK', 'PAK', '92', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(159, 'Palau', 'PW', 'PLW', '680', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(160, 'Panama', 'PA', 'PAN', '507', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(161, 'Papua New Guinea', 'PG', 'PNG', '675', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(162, 'Paraguay', 'PY', 'PRY', '595', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(163, 'Peru', 'PE', 'PER', '51', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(164, 'Philippines', 'PH', 'PHL', '63', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(165, 'Pitcairn Islands', 'PN', 'PCN', '870', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(166, 'Poland', 'PL', 'POL', '48', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(167, 'Portugal', 'PT', 'PRT', '351', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(168, 'Puerto Rico', 'PR', 'PRI', '1', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(169, 'Qatar', 'QA', 'QAT', '974', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(170, 'Republic of the Congo', 'CG', 'COG', '242', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(171, 'Romania', 'RO', 'ROU', '40', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(172, 'Russia', 'RU', 'RUS', '7', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(173, 'Rwanda', 'RW', 'RWA', '250', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(174, 'Saint Barthelemy', 'BL', 'BLM', '590', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(175, 'Saint Helena', 'SH', 'SHN', '290', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(176, 'Saint Kitts and Nevis', 'KN', 'KNA', '1 869', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(177, 'Saint Lucia', 'LC', 'LCA', '1 758', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(178, 'Saint Martin', 'MF', 'MAF', '1 599', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(179, 'Saint Pierre and Miquelon', 'PM', 'SPM', '508', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1 784', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(181, 'Samoa', 'WS', 'WSM', '685', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(182, 'San Marino', 'SM', 'SMR', '378', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(183, 'Sao Tome and Principe', 'ST', 'STP', '239', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(184, 'Saudi Arabia', 'SA', 'SAU', '966', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(185, 'Senegal', 'SN', 'SEN', '221', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(186, 'Serbia', 'RS', 'SRB', '381', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(187, 'Seychelles', 'SC', 'SYC', '248', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(188, 'Sierra Leone', 'SL', 'SLE', '232', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(189, 'Singapore', 'SG', 'SGP', '65', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(190, 'Slovakia', 'SK', 'SVK', '421', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(191, 'Slovenia', 'SI', 'SVN', '386', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(192, 'Solomon Islands', 'SB', 'SLB', '677', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(193, 'Somalia', 'SO', 'SOM', '252', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(194, 'South Africa', 'ZA', 'ZAF', '27', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(195, 'South Korea', 'KR', 'KOR', '82', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(196, 'Spain', 'ES', 'ESP', '34', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(197, 'Sri Lanka', 'LK', 'LKA', '94', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(198, 'Sudan', 'SD', 'SDN', '249', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(199, 'Suriname', 'SR', 'SUR', '597', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(200, 'Svalbard', 'SJ', 'SJM', '', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(201, 'Swaziland', 'SZ', 'SWZ', '268', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(202, 'Sweden', 'SE', 'SWE', '46', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(203, 'Switzerland', 'CH', 'CHE', '41', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(204, 'Syria', 'SY', 'SYR', '963', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(205, 'Taiwan', 'TW', 'TWN', '886', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(206, 'Tajikistan', 'TJ', 'TJK', '992', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(207, 'Tanzania', 'TZ', 'TZA', '255', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(208, 'Thailand', 'TH', 'THA', '66', 0, 1);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(209, 'Timor-Leste', 'TL', 'TLS', '670', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(210, 'Togo', 'TG', 'TGO', '228', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(211, 'Tokelau', 'TK', 'TKL', '690', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(212, 'Tonga', 'TO', 'TON', '676', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(213, 'Trinidad and Tobago', 'TT', 'TTO', '1 868', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(214, 'Tunisia', 'TN', 'TUN', '216', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(215, 'Turkey', 'TR', 'TUR', '90', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(216, 'Turkmenistan', 'TM', 'TKM', '993', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(217, 'Turks and Caicos Islands', 'TC', 'TCA', '1 649', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(218, 'Tuvalu', 'TV', 'TUV', '688', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(219, 'Uganda', 'UG', 'UGA', '256', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(220, 'Ukraine', 'UA', 'UKR', '380', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(221, 'United Arab Emirates', 'AE', 'ARE', '971', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(222, 'United Kingdom', 'GB', 'GBR', '44', 0, 1);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(223, 'United States', 'US', 'USA', '1', 0, 1);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(224, 'Uruguay', 'UY', 'URY', '598', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(225, 'US Virgin Islands', 'VI', 'VIR', '1 340', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(226, 'Uzbekistan', 'UZ', 'UZB', '998', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(227, 'Vanuatu', 'VU', 'VUT', '678', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(228, 'Venezuela', 'VE', 'VEN', '58', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(229, 'Vietnam', 'VN', 'VNM', '84', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(230, 'Wallis and Futuna', 'WF', 'WLF', '681', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(231, 'Western Sahara', 'EH', 'ESH', '', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(232, 'Yemen', 'YE', 'YEM', '967', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(233, 'Zambia', 'ZM', 'ZMB', '260', 0, 0);
INSERT INTO `country` (`country_id`, `country_name`, `iso_2`, `iso_3`, `country_code`, `weight`, `is_active`) VALUES(234, 'Zimbabwe', 'ZW', 'ZWE', '263', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(4) NOT NULL AUTO_INCREMENT,
  `color_id` tinyint(2) DEFAULT NULL,
  `size_id` tinyint(2) DEFAULT NULL,
  `product_size_id` int(4) DEFAULT NULL,
  `qty` int(4) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `product_id` int(4) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `color_id` (`color_id`),
  KEY `size_id` (`size_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `color_id`, `size_id`, `product_size_id`, `qty`, `is_active`, `product_id`, `weight`, `date_created`, `date_modified`) VALUES(-3, NULL, NULL, NULL, 0, 1, -3, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `item` (`item_id`, `color_id`, `size_id`, `product_size_id`, `qty`, `is_active`, `product_id`, `weight`, `date_created`, `date_modified`) VALUES(-2, NULL, NULL, NULL, 0, 1, -2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `item` (`item_id`, `color_id`, `size_id`, `product_size_id`, `qty`, `is_active`, `product_id`, `weight`, `date_created`, `date_modified`) VALUES(-1, NULL, NULL, NULL, 0, 1, -1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `item` (`item_id`, `color_id`, `size_id`, `product_size_id`, `qty`, `is_active`, `product_id`, `weight`, `date_created`, `date_modified`) VALUES(5, 1, 1, NULL, 0, 1, 10, 0, '2011-10-01 23:33:11', '2011-10-01 23:33:11');
INSERT INTO `item` (`item_id`, `color_id`, `size_id`, `product_size_id`, `qty`, `is_active`, `product_id`, `weight`, `date_created`, `date_modified`) VALUES(6, 2, 2, NULL, 0, 1, 10, 0, '2011-10-01 23:33:11', '2011-10-01 23:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `name_address`
--

DROP TABLE IF EXISTS `name_address`;
CREATE TABLE IF NOT EXISTS `name_address` (
  `name_address_id` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address_1` varchar(30) NOT NULL,
  `address_2` varchar(30) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) DEFAULT NULL,
  `postcode` varchar(15) NOT NULL,
  `country_id` int(4) NOT NULL,
  `address_type` char(3) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`name_address_id`),
  KEY `address_type` (`address_type`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10001 ;

--
-- Dumping data for table `name_address`
--


-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(4) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `price_total` float NOT NULL DEFAULT '0',
  `bill_name_address_id` int(4) DEFAULT NULL,
  `ship_name_address_id` int(4) DEFAULT NULL,
  `member_id` int(4) DEFAULT NULL,
  `order_status` char(3) NOT NULL DEFAULT 'INI',
  `payment_method` char(3) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_paid` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `member_id` (`member_id`),
  KEY `order_status` (`order_status`),
  KEY `bill_name_address_id` (`bill_name_address_id`),
  KEY `ship_name_address_id` (`ship_name_address_id`),
  KEY `payment_method` (`payment_method`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(2, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-04 23:15:09', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10000, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 00:00:00', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10001, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 12:13:11', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10002, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 01:57:53', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10003, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 04:37:47', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10004, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 06:50:00', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10006, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 22:49:09', NULL, NULL);
INSERT INTO `order` (`order_id`, `first_name`, `last_name`, `email`, `phone`, `mobile`, `price_total`, `bill_name_address_id`, `ship_name_address_id`, `member_id`, `order_status`, `payment_method`, `date_created`, `date_paid`, `date_completed`) VALUES(10007, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'INI', NULL, '2011-10-06 22:49:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

DROP TABLE IF EXISTS `order_item`;
CREATE TABLE IF NOT EXISTS `order_item` (
  `order_item_id` int(4) NOT NULL AUTO_INCREMENT,
  `item_id` int(4) NOT NULL,
  `qty` tinyint(2) NOT NULL DEFAULT '1',
  `order_id` int(4) NOT NULL,
  `price` float NOT NULL,
  `price_discount_amt` float NOT NULL DEFAULT '0',
  `price_discount_percent` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_item_id`),
  KEY `item_id` (`item_id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `item_id`, `qty`, `order_id`, `price`, `price_discount_amt`, `price_discount_percent`) VALUES(6, 6, 2, 10006, 99.99, 10, 0);
INSERT INTO `order_item` (`order_item_id`, `item_id`, `qty`, `order_id`, `price`, `price_discount_amt`, `price_discount_percent`) VALUES(5, 5, 1, 10006, 99.99, 10, 0);
INSERT INTO `order_item` (`order_item_id`, `item_id`, `qty`, `order_id`, `price`, `price_discount_amt`, `price_discount_percent`) VALUES(7, 6, 1, 10007, 99.99, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_status_mapping`
--

DROP TABLE IF EXISTS `order_status_mapping`;
CREATE TABLE IF NOT EXISTS `order_status_mapping` (
  `order_status` char(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `step` tinyint(1) NOT NULL,
  PRIMARY KEY (`order_status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_status_mapping`
--

INSERT INTO `order_status_mapping` (`order_status`, `description`, `step`) VALUES('INI', 'order initial', 0);
INSERT INTO `order_status_mapping` (`order_status`, `description`, `step`) VALUES('PAD', 'order been paid', 1);
INSERT INTO `order_status_mapping` (`order_status`, `description`, `step`) VALUES('COM', 'order is completed, and it can be closed', 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method_mapping`
--

DROP TABLE IF EXISTS `payment_method_mapping`;
CREATE TABLE IF NOT EXISTS `payment_method_mapping` (
  `payment_method` char(3) NOT NULL,
  `description` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_method`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method_mapping`
--

INSERT INTO `payment_method_mapping` (`payment_method`, `description`, `is_active`) VALUES('CRE', 'Credit Card', 1);
INSERT INTO `payment_method_mapping` (`payment_method`, `description`, `is_active`) VALUES('PAP', 'PayPal', 1);
INSERT INTO `payment_method_mapping` (`payment_method`, `description`, `is_active`) VALUES('DDP', 'Direct Deposit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `photo_id` int(4) NOT NULL AUTO_INCREMENT,
  `alternative_text` varchar(100) DEFAULT NULL,
  `filename` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `product_id` int(4) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `product_id` (`product_id`),
  KEY `is_main` (`is_main`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(3, 'test 2', '4_9999.jpg', 1, 0, 4, 0, '2011-04-24 21:32:41');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(32, NULL, '11.jpg', 1, 1, 11, 0, '2011-04-24 23:11:56');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(31, NULL, '8_7050.jpg', 1, 1, 8, 0, '2011-04-24 23:11:53');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(30, NULL, '8.jpg', 1, 0, 8, 0, '2011-04-24 23:11:52');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(29, NULL, '10.jpg', 1, 1, 10, 0, '2011-04-24 23:05:15');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(28, NULL, '3_2585.jpg', 1, 0, 3, 0, '2011-04-24 23:04:26');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(27, NULL, '3.jpg', 1, 1, 3, 0, '2011-04-24 23:04:09');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(23, NULL, '13_9949.jpg', 1, 1, 13, 0, '2011-04-24 22:57:36');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(33, NULL, '12.jpg', 1, 1, 12, 0, '2011-04-24 23:11:58');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(34, NULL, '12_9915.jpg', 1, 0, 12, 0, '2011-04-24 23:25:17');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(36, NULL, '3_2584.jpg', 1, 0, 3, 0, '2011-04-25 13:21:26');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(37, NULL, '4_8346.jpg', 1, 1, 4, 0, '2011-04-25 13:21:28');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(38, NULL, '5.jpg', 1, 1, 5, 0, '2011-04-25 13:21:31');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(39, NULL, '7.jpg', 1, 1, 7, 0, '2011-04-25 13:21:34');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(40, NULL, '8_7344.jpg', 1, 0, 8, 0, '2011-04-25 13:21:37');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(41, NULL, '9.jpg', 1, 1, 9, 0, '2011-04-25 13:21:39');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(42, NULL, '9_3545.jpg', 1, 0, 9, 0, '2011-04-25 13:21:43');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(48, NULL, '12_7682.jpg', 1, 0, 12, 0, '2011-04-25 13:22:00');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(49, NULL, '12_8041.jpg', 1, 0, 12, 0, '2011-04-25 13:22:00');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(50, NULL, '12_9914.jpg', 1, 0, 12, 0, '2011-04-25 13:22:01');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(51, NULL, '13_1926.jpg', 1, 0, 13, 0, '2011-04-25 13:22:03');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(52, NULL, '13_9005.jpg', 1, 0, 13, 0, '2011-04-25 13:22:04');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(53, NULL, '13_5992.jpg', 1, 0, 13, 0, '2011-04-25 13:22:04');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(54, NULL, '13_9124.jpg', 1, 0, 13, 0, '2011-04-25 13:24:13');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(55, NULL, '13_5468.jpg', 1, 0, 13, 0, '2011-04-25 13:24:14');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(56, NULL, '13_0432.jpg', 1, 0, 13, 0, '2011-04-25 13:24:14');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(57, NULL, '12_5461.jpg', 1, 0, 12, 0, '2011-04-25 13:24:16');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(58, NULL, '12_0605.jpg', 1, 0, 12, 0, '2011-04-25 13:24:17');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(59, NULL, '12_5521.jpg', 1, 0, 12, 0, '2011-04-25 13:24:17');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(60, NULL, '12_5614.jpg', 1, 0, 12, 0, '2011-04-25 13:24:18');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(61, NULL, '12_9974.jpg', 1, 0, 12, 0, '2011-04-25 13:24:18');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(67, NULL, '10_9321.jpg', 1, 0, 10, 1, '2011-04-25 13:24:23');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(68, NULL, '10_0734.jpg', 1, 0, 10, 2, '2011-04-25 13:24:24');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(70, NULL, '10_1763.jpg', 1, 0, 10, 5, '2011-04-25 13:24:24');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(72, NULL, '19.jpg', 1, 1, 19, 0, '2011-04-25 13:24:27');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(76, NULL, '9_1018.jpg', 1, 0, 9, 0, '2011-04-25 13:24:31');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(77, NULL, '8_6884.jpg', 1, 0, 8, 0, '2011-04-25 13:24:33');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(78, NULL, '8_2287.jpg', 1, 0, 8, 0, '2011-04-25 13:24:34');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(79, NULL, '8_1804.jpg', 1, 0, 8, 0, '2011-04-25 13:24:34');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(80, NULL, '8_9209.jpg', 1, 0, 8, 0, '2011-04-25 13:24:34');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(82, NULL, '7_1699.jpg', 1, 0, 7, 0, '2011-04-25 13:24:37');
INSERT INTO `photo` (`photo_id`, `alternative_text`, `filename`, `is_active`, `is_main`, `product_id`, `weight`, `date_created`) VALUES(85, NULL, '7_KYb2.jpg', 1, 0, 7, 0, '2011-04-25 13:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(4) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `size_description` varchar(2000) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_discount_amt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int(4) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10000 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(4, 'My Dress', 'test test my dress', NULL, 39.95, 9.00, 1, 1, 2, '2011-04-22 22:15:02', '2011-04-22 22:15:02');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(3, 'Mickey mouse', 'this is a test product', NULL, 49.95, 0.00, 1, 1, 0, '2011-04-22 16:40:08', '2011-04-22 16:40:08');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(10, 'Tokyo t-shirt', 'test test test test test description', NULL, 99.99, 10.00, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(9, 'Add auto Boy', NULL, NULL, 99.99, 0.00, 1, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(7, 'Super man', NULL, NULL, 20.00, 0.00, 1, 2, 0, '2011-04-23 19:36:12', '2011-04-23 19:36:12');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(8, 'Super girl', NULL, NULL, 20.00, 0.00, 1, 1, 0, '2011-04-23 19:36:28', '2011-04-23 19:36:28');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(11, 'Add auto 3', 'test', NULL, 99.99, 10.00, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(12, 'Add auto 4', 'test', NULL, 19.99, 10.00, 1, 1, 0, '2011-04-23 22:20:06', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(13, 'Add auto 5', 'test', NULL, 19.99, 10.00, 1, 1, 0, '2011-04-23 22:31:18', '2011-04-23 22:31:18');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(-1, 'International shipping', NULL, NULL, 30.00, 0.00, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(-2, 'Shipping within Australia', NULL, NULL, 10.00, 0.00, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `product` (`product_id`, `product_name`, `description`, `size_description`, `price`, `price_discount_amt`, `is_active`, `category_id`, `weight`, `date_created`, `date_modified`) VALUES(-3, 'Shipping within New Zealand', NULL, NULL, 20.00, 0.00, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `product_size_id` int(4) NOT NULL AUTO_INCREMENT,
  `size_id` tinyint(2) NOT NULL,
  `product_id` int(4) NOT NULL,
  `chest` decimal(5,2) DEFAULT NULL,
  `waist` decimal(5,2) DEFAULT NULL,
  `burst` decimal(5,2) DEFAULT NULL,
  `shoulder` decimal(5,2) DEFAULT NULL,
  `length` decimal(5,2) DEFAULT NULL,
  `width` decimal(5,2) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`product_size_id`),
  KEY `size_id` (`size_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_size_id`, `size_id`, `product_id`, `chest`, `waist`, `burst`, `shoulder`, `length`, `width`, `height`, `description`) VALUES(1, 2, 4, 1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 'hello test');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_cost`
--

DROP TABLE IF EXISTS `shipping_cost`;
CREATE TABLE IF NOT EXISTS `shipping_cost` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `country_id` int(4) DEFAULT NULL,
  `product_id` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipping_cost`
--

INSERT INTO `shipping_cost` (`id`, `country_id`, `product_id`) VALUES(1, 13, -2);
INSERT INTO `shipping_cost` (`id`, `country_id`, `product_id`) VALUES(2, 148, -3);
INSERT INTO `shipping_cost` (`id`, `country_id`, `product_id`) VALUES(3, NULL, -1);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `size_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(50) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(1, 'S', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(2, 'M', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(3, 'L', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(4, '6', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(5, '7', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(6, '8', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(7, '9', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(8, '10', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(9, '11', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(10, '12', 0);
INSERT INTO `size` (`size_id`, `size_name`, `weight`) VALUES(11, '14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_id` int(4) NOT NULL AUTO_INCREMENT,
  `item_id` int(4) NOT NULL,
  `order_id` int(4) DEFAULT NULL,
  `qty` int(4) NOT NULL,
  `transaction_type` char(3) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `item_id` (`item_id`),
  KEY `order_id` (`order_id`),
  KEY `transaction_type` (`transaction_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `item_id`, `order_id`, `qty`, `transaction_type`, `date_created`) VALUES(1, 123, NULL, 4, 'PIN', '2011-10-01 15:42:23');
INSERT INTO `transaction` (`transaction_id`, `item_id`, `order_id`, `qty`, `transaction_type`, `date_created`) VALUES(2, 321, 999, -2, 'PSA', '2011-10-01 15:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mapping`
--

DROP TABLE IF EXISTS `transaction_mapping`;
CREATE TABLE IF NOT EXISTS `transaction_mapping` (
  `transaction_type` char(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`transaction_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_mapping`
--

INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('PSA', '(-) item sale ', -1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('DMG', '(-) damage item', -1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('PXI', '(+) exhange in', 1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('PXO', '(-) exchange out', -1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('PIN', '(+) new product in', 1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('ADJ', '(-) adjustment', -1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('LOS', '(-) product lost', -1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('PRF', '(+) product refund', 1);
INSERT INTO `transaction_mapping` (`transaction_type`, `description`, `value`) VALUES('POT', '(-) product out', -1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `is_active`) VALUES('tan', '1234', 1);
INSERT INTO `user` (`username`, `password`, `is_active`) VALUES('pat', '1234', 0);
