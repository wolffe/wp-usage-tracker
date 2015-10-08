-- phpMyAdmin SQL Dump
--
-- Generation Time: Oct 08, 2015 at 10:41 AM

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `tracker_users`
--

CREATE TABLE IF NOT EXISTS `tracker_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Table structure for table `wp_usage`
--

CREATE TABLE IF NOT EXISTS `wp_usage` (
  `tracker_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` text NOT NULL,
  `item_version` text NOT NULL,
  `wp_version` text NOT NULL,
  `wp_charset` text NOT NULL,
  `wp_url` text NOT NULL,
  `wp_ip` text NOT NULL,
  `wp_email` text NOT NULL,
  `wp_server` text NOT NULL,
  `wp_php` text NOT NULL,
  `wp_mysql` text NOT NULL,
  `wp_memory` text NOT NULL,
  `tracker_version` text NOT NULL,
  `tracker_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tracker_user_id` int(11) NOT NULL,
  PRIMARY KEY (`tracker_id`),
  UNIQUE KEY `tracker_id` (`tracker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
