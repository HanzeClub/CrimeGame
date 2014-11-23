-- phpMyAdmin SQL Dump
-- version 4.0.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 23, 2014 at 02:58 PM
-- Server version: 5.5.38-MariaDB-cll-lve
-- PHP Version: 5.5.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deb65120n6_os`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_guests`
--

CREATE TABLE IF NOT EXISTS `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_guests`
--

INSERT INTO `active_guests` (`ip`, `timestamp`) VALUES
('192.240.198.55', 1416750799),
('192.200.24.193', 1416750843),
('107.168.64.250', 1416750894),
('66.249.78.133', 1416750797),
('66.249.78.140', 1416750798),
('66.249.78.147', 1416750796),
('46.229.164.111', 1416751065),
('94.23.25.214', 1416750960);

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_ip`
--

CREATE TABLE IF NOT EXISTS `banned_ip` (
  `ip` varchar(50) NOT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `config_name` varchar(20) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  UNIQUE KEY `config_name_2` (`config_name`),
  KEY `config_name` (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`config_name`, `config_value`) VALUES
('ACCOUNT_ACTIVATION', '2'),
('TRACK_VISITORS', '1'),
('max_user_chars', '30'),
('min_user_chars', '4'),
('max_pass_chars', '100'),
('min_pass_chars', '4'),
('EMAIL_FROM_NAME', 'osFighter'),
('EMAIL_FROM_ADDR', 'deesoomens@gmail.com'),
('EMAIL_WELCOME', '0'),
('SITE_NAME', 'osFighters'),
('SITE_DESC', 'none'),
('WEB_ROOT', 'http://www.ultimate-survival.net/'),
('ENABLE_CAPTCHA', '0'),
('COOKIE_EXPIRE', '100'),
('COOKIE_PATH', '/'),
('home_page', 'home'),
('ALL_LOWERCASE', '0'),
('Version', '0.1'),
('USER_TIMEOUT', '30'),
('GUEST_TIMEOUT', '5'),
('ACTIVE_THEME', 'FrenzoTheme'),
('RANKS', 'a:4:{i:0;s:6:"Newbie";i:1;s:4:"Thug";i:2;s:4:"Boss";i:3;s:4:"Kast";}'),
('CITIES', 'a:8:{i:0;s:9:"Eindhoven";i:1;s:9:"Amsterdam";i:2;s:6:"London";i:3;s:8:"New York";i:4;s:5:"Paris";i:5;s:6:"Berlin";i:6;s:5:"Milan";i:7;s:6:"Madrid";}'),
('CURRENCY', '&#36;'),
('NUMBER_FORMAT', '2');

-- --------------------------------------------------------

--
-- Table structure for table `crimes`
--

CREATE TABLE IF NOT EXISTS `crimes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `min_payout` int(11) NOT NULL,
  `max_payout` int(11) NOT NULL,
  `change` int(3) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `crimes`
--

INSERT INTO `crimes` (`id`, `name`, `min_payout`, `max_payout`, `change`, `icon`) VALUES
(1, 'Steal from child', 10, 100, 10, 'steal_candy.jpg'),
(2, 'Steal bycile', 50, 150, 25, 'steal_bycile.jpg'),
(3, 'Pickpocket', 150, 300, 40, 'zakkenrollen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `power` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `weight` int(11) NOT NULL,
  `display` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `pid`, `menu`, `link`, `weight`, `display`) VALUES
(1, 1, 'personal', 'home', 0, 1),
(2, 2, 'outgame', 'register', 2, 1),
(3, 3, 'outgame', 'forgot-pass', 3, 1),
(4, 4, 'outgame', 'login', 4, 1),
(5, 5, 'admin', 'admin/files', 0, 1),
(6, 8, 'admin', 'admin/menu', 1, 1),
(7, 9, 'admin', 'admin/crimes', 4, 1),
(8, 10, 'admin', 'admin/settings', 2, 1),
(9, 11, 'admin', 'admin/users', 3, 1),
(10, 12, 'crime', 'crime/crimes', 0, 1),
(11, 13, 'family', 'family', 0, 1),
(12, 14, 'statistics', 'online', 0, 1),
(13, 15, 'personal', 'personal/user-edit', 2, 1),
(14, 16, 'personal', 'personal/user-info', 1, 0),
(15, 17, 'locations', 'locations/airport', 3, 1),
(16, 18, 'personal', 'personal/messages', 0, 1),
(17, 19, 'call-credits', 'call-credits', 0, 1),
(18, 20, 'call-credits', 'call-credits/shop', 0, 1),
(19, 21, 'locations', 'locations/shop', 2, 1),
(20, 22, 'locations', 'locations/jail', 1, 1),
(21, 23, 'locations', 'locations/bank', 0, 1),
(22, 24, 'locations', 'locations/housing-market', 5, 1),
(23, 25, 'locations', 'locations/hospital', 4, 1),
(24, 26, 'extra', 'extra/attack', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `file` varchar(50) NOT NULL,
  `groups` varchar(255) NOT NULL,
  `jail` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `link`, `file`, `groups`, `jail`) VALUES
(1, 'Home', 'home', 'home.php', 'a:0:{}', 0),
(2, 'Register', 'register', 'register.php', 'a:0:{}', 0),
(3, 'Forgot password', 'forgot-pass', 'forgotpass.php', 'a:0:{}', 0),
(4, 'Login', 'login', 'main.php', 'a:0:{}', 1),
(5, 'Files', 'admin/files', 'files.php', 'a:0:{}', 0),
(8, 'Menus', 'admin/menu', 'menus.php', 'a:0:{}', 0),
(9, 'Manage crimes', 'admin/crimes', 'manage_crimes.php', 'a:0:{}', 0),
(10, 'Settings', 'admin/settings', 'settings.php', 'a:0:{}', 0),
(11, 'Users', 'admin/users', 'users.php', 'a:0:{}', 0),
(12, 'Crimes', 'crime/crimes', 'crimes.php', 'a:0:{}', 1),
(13, 'Families', 'family', 'families.php', 'a:0:{}', 0),
(14, 'Online', 'online', 'online.php', 'a:0:{}', 0),
(15, 'User edit', 'personal/user-edit', 'useredit.php', 'a:0:{}', 0),
(16, 'User info', 'personal/user-info', 'userinfo.php', 'a:0:{}', 0),
(17, 'Airport', 'locations/airport', 'airport.php', 'a:0:{}', 1),
(18, 'Messages', 'personal/messages', 'messages.php', 'a:0:{}', 0),
(19, 'Call Credits Market', 'call-credits', 'call-credits.php', 'a:0:{}', 0),
(20, 'Call Credits Shop', 'call-credits/shop', 'call-credits-shop.php', 'a:0:{}', 0),
(21, 'Shop', 'locations/shop', 'shop.php', 'a:0:{}', 1),
(22, 'Jail', 'locations/jail', 'jail.php', 'a:0:{}', 0),
(23, 'Bank', 'locations/bank', 'bank.php', 'a:0:{}', 0),
(24, 'Housing market', 'locations/housing-market', 'housing-market.php', 'a:0:{}', 1),
(25, 'Hospital', 'locations/hospital', 'hospital.php', 'a:0:{}', 1),
(26, 'Attack', 'extra/attack', 'attack.php', 'a:0:{}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `usersalt` varchar(8) NOT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `actkey` varchar(35) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `regdate` int(11) unsigned NOT NULL,
  `groups` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usersalt`, `userid`, `userlevel`, `email`, `timestamp`, `actkey`, `ip`, `regdate`, `groups`) VALUES
(1, 'admin', '12a5534328eec6d44e285b4eda68b4efa1e707cb', 'rtrpCSWD', '37278b5b488d8292597cb2f4afa6b865', 9, 'd.oomens@hotmail.nl', 1416747858, 'Waf60fKlX1mRTBre', '145.100.167.217', 1416386489, 'a:1:{i:0;s:1:"1";}'),
(3, 'demo', '53097e78f22e4ba1e796c39971be5f4d00ae66e6', 'vwxWLF88', '407b8ca30211a60fa5df802adbdc2dfc', 9, 'demo@demo.com', 1416728698, '274AVOSpUZhMFQ8P', '145.100.167.217', 1416391206, ''),
(8, 'mentimjojo', '8a801ac791f74df3d508e80041f0338438e445ad', 'oz8j0Rk3', '387ab285357f49cab397ea6c8d642607', 3, 'timnijborg@hotmail.nl', 1416502689, 'vVgsZkSXDeJElHob', '81.207.171.113', 1416502216, ''),
(7, 'volrisico', 'd7ca81d9a77b3a785719cf4fbd8f0519348988fb', 'HWVv9hao', '0', 1, 'corne.steenbakkers@gmail.com', 1416475596, 'ZRPT86wB0zk1EdVF', '145.100.163.54', 1416475596, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `rank` int(2) NOT NULL,
  `rank_process` int(3) NOT NULL,
  `health` int(3) NOT NULL DEFAULT '100',
  `city` int(3) NOT NULL,
  `money` int(20) NOT NULL DEFAULT '100',
  `bank` int(20) NOT NULL DEFAULT '500',
  `power` int(15) NOT NULL,
  `crime_process` int(5) NOT NULL,
  `credits` int(11) NOT NULL,
  UNIQUE KEY `id` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`uid`, `fid`, `rank`, `rank_process`, `health`, `city`, `money`, `bank`, `power`, `crime_process`, `credits`) VALUES
(1, 0, 3, 8, 100, 1, 582, 10500, 1000, 162, 9),
(3, 0, 0, 0, 100, 0, 100, 500, 0, 0, 0),
(7, 0, 0, 0, 100, 0, 100, 500, 0, 0, 0),
(8, 0, 0, 0, 100, 0, 100, 500, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_time`
--

CREATE TABLE IF NOT EXISTS `users_time` (
  `uid` int(11) NOT NULL,
  `jail` int(11) NOT NULL,
  `crime_time` int(11) NOT NULL,
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_time`
--

INSERT INTO `users_time` (`uid`, `jail`, `crime_time`) VALUES
(1, 1416481529, 1416507566),
(3, 0, 0),
(7, 0, 0),
(8, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
