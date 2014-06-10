-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 05:10 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `playground`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`) VALUES
(1, 'Computing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category_course`
--

CREATE TABLE IF NOT EXISTS `category_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category_course`
--

INSERT INTO `category_course` (`id`, `category_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `image`) VALUES
(1, 'PHP', 'desc', 'php-med-trans.png'),
(3, 'jQuery', 'desc', 'jQuery-logo.jpeg'),
(4, 'MySQL', 'desc', 'mysql-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `course_topic`
--

CREATE TABLE IF NOT EXISTS `course_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `course_topic`
--

INSERT INTO `course_topic` (`id`, `course_id`, `topic_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE IF NOT EXISTS `security_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `security_question`
--

INSERT INTO `security_question` (`id`, `question`) VALUES
(1, 'Mother''s maiden name'),
(2, 'First primary school'),
(3, 'Favourite restaurant'),
(4, 'First pet''s name'),
(5, 'Place where you were born');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `difficulty` int(1) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `difficulty`, `description`, `content`) VALUES
(1, 'Variables', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', ''),
(2, 'Functions', 1, 'Organizing your code into named functions is a fundamental process of any program. In this tutorial, you''ll learn how to do just that.', ''),
(3, 'Require and Include', 1, 'Learn how to call other files to enhance your code.', ''),
(4, 'MVC Overview', 2, 'MVC is an architectural pattern used by any major website on the internet today. In this tutorial, we will be looking at what MVC is and the concepts that make it a success.', ''),
(5, 'Models', 3, 'The first letter of the MVC acronym, models are commonly referred to as the ''business logic'' behind your application. In this tutorial we will break down the jargon and understand exactly what a model is and how they are used.', ''),
(6, 'Views', 3, 'Views, quite simply, are what is displayed to the user on a web page. We will go through organization of a view and look at how we typically pass through information from the controller.', ''),
(7, 'Controllers', 3, 'Controllers are the ''glue'' that binds the models and views together. The models call the data, the views display the data, and the controllers control which data is passed back and forth.', ''),
(8, 'The construct function', 3, 'The special ''construct'' function is sometimes not understood properly. We will look at use-cases and when to use the construct.', ''),
(9, 'Dependency Injection', 4, 'Dependency Injection is part of a design principle that aims to make code clear and efficient. This is a more advanced concept for people that are very comfortable with PHP.', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `role` enum('default','admin') NOT NULL,
  `is_over_13` varchar(11) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `security_question_id` int(11) NOT NULL,
  `security_question_answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `security_question_id` (`security_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `role`, `is_over_13`, `company`, `email`, `password`, `security_question_id`, `security_question_answer`) VALUES
(1, 'Ciaran', 'Reen', 'admin', 'true', 'CE', 'ciaranreen@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 1, 'Reen');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_course`
--
ALTER TABLE `category_course`
  ADD CONSTRAINT `category_course__course_id_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_course__category_id_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD CONSTRAINT `course_topic_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_topic_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `security_question_key` FOREIGN KEY (`security_question_id`) REFERENCES `security_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `course_id_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
