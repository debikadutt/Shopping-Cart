-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2011 at 09:11 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pprice` decimal(7,2) NOT NULL,
  `pqty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`order_id`, `product_id`, `pname`, `pprice`, `pqty`) VALUES
(1, 1, 'Shirt', '50.00', 1),
(2, 2, 'Saree', '80.00', 1),
(2, 3, 'The 13th Warrior', '35.00', 4),
(3, 1, 'Shirt', '50.00', 1),
(4, 4, 'Delta Force', '30.00', 1),
(5, 2, 'Saree', '80.00', 1),
(5, 4, 'Delta Force', '30.00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `description`) VALUES
(1, 0, 'Cloth', 'Category Description'),
(2, 0, 'DVD', 'Category Description'),
(3, 1, 'Gents', 'Category Description'),
(4, 1, 'Ladies', 'Category Description'),
(5, 2, 'Movie', 'Category Description'),
(6, 2, 'Game', 'Category Description');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `oreference` varchar(25) NOT NULL,
  `ostst` tinyint(4) NOT NULL DEFAULT '0',
  `shipaddr` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `oreference`, `ostst`, `shipaddr`) VALUES
(1, 1, 'ORD2267795', 1, 'gbfcg fgf gff'),
(2, 1, 'ORD8664822', 0, 'ygygyg bjhhjh'),
(3, 1, 'ORD5327690', 0, 'kolkata'),
(4, 1, 'ORD8739691', 1, ' m mmnmnmnmnmn'),
(5, 1, 'ORD9558647', 0, 'fdfd ghg bgvh');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `quantity`) VALUES
(1, 3, 'Shirt', 'Desc Shirt', '50.00', 5),
(2, 4, 'Saree', 'Desc Saree', '80.00', 5),
(3, 5, 'The 13th Warrior', 'Desc Movie', '35.00', 6),
(4, 6, 'Delta Force', 'Desc Game', '30.00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'akash', 'akash'),
(2, 'admin', 'admin'),
(3, 'user', 'password');
