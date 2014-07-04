-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2014 at 05:29 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.2

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
-- Table structure for table `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `points` int(10) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id`, `name`, `points`, `topic_id`) VALUES
(1, 'Complete your first topic', 100, NULL),
(2, 'Pass the Variable Code Pass ', 300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent`) VALUES
(1, 'Computing', 0),
(3, 'Maths', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `category_course`
--

INSERT INTO `category_course` (`id`, `category_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(5, 3, 7),
(6, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `votes_up` int(11) NOT NULL,
  `votes_down` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `topic_id`, `user_id`, `parent`, `created`, `votes_up`, `votes_down`) VALUES
(1, 'test', 1, 1, 0, '2014-07-04 15:58:19', 61, 18),
(2, 'Hello this is a test comment', 1, 1, 0, '2014-07-04 11:25:58', 2, 1),
(11, 'child test', 1, 1, 1, '2014-07-04 13:19:35', 10, 8),
(12, '', 1, 1, 1, '2014-07-04 12:09:28', 5, 10),
(13, 'HERE we are', 1, 1, 1, '2014-07-04 13:02:59', 4, 2),
(14, 'What a great tutorial!', 1, 1, 2, '2014-07-04 11:26:38', 2, 3),
(15, 'Great tut!', 1, 1, 2, '2014-07-04 11:22:33', 2, 0),
(17, 'ferwgerg', 1, 1, 0, '2014-06-16 11:45:15', 0, 0),
(18, 'hbtfdghergh', 3, 1, 0, '2014-06-16 11:45:38', 0, 0),
(19, 'regergerg', 2, 1, 0, '2014-06-16 11:45:54', 0, 0),
(20, 'ftjhrthjrth', 2, 1, 19, '2014-06-16 11:46:05', 0, 0),
(21, 'fthrtfhrth', 1, 1, 2, '2014-07-04 11:26:41', 1, 1),
(22, 'dthrtryth', 1, 1, 1, '2014-07-04 11:25:47', 2, 1),
(23, 'erhgtregerg', 1, 1, 17, '2014-07-04 13:40:27', 1, 0),
(24, 'No, your comment is awesome', 3, 1, 18, '2014-06-25 16:22:19', 0, 0),
(25, 'Test comment', 5, 1, 0, '2014-07-04 14:00:31', 1, 0),
(26, 'Test comment', 5, 1, 0, '2014-07-04 15:46:02', 1, 0),
(27, 'yeah mate', 1, 3, 1, '2014-07-04 16:11:37', 0, 0),
(28, 'test', 1, 3, 0, '2014-07-04 16:11:59', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `image`) VALUES
(1, 'PHP', 'Back end language that powers most of the websites today', 'php-med-trans.png'),
(3, 'jQuery', 'Powerful front end Javascript library, used across the industry', 'jQuery-logo.jpeg'),
(4, 'MySQL', 'The most popular database used today to store information', 'mysql-logo.png'),
(5, 'Intro To Programming', 'In this course we will be looking at the fundamental principles behind programming. Do not skip this if you have never programmed before. This is a precursor to any other course in Computing.', 'intro.jpg'),
(7, 'Algebra', '', ''),
(8, 'Algorithms', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

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
(17, 1, 24),
(18, 1, 25),
(19, 4, 11),
(20, 8, 10),
(21, 7, 9);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE IF NOT EXISTS `donation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `month` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `user_id`, `amount`, `month`) VALUES
(1, 1, '15.50', 'January'),
(2, 1, '37.86', 'February'),
(3, 1, '15.50', 'January');

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
-- Table structure for table `test_question`
--

CREATE TABLE IF NOT EXISTS `test_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `answer_one` varchar(255) NOT NULL,
  `answer_two` varchar(255) NOT NULL,
  `answer_three` varchar(255) NOT NULL,
  `answer_four` varchar(255) NOT NULL,
  `correct_answer` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `test_question`
--

INSERT INTO `test_question` (`id`, `question`, `topic_id`, `answer_one`, `answer_two`, `answer_three`, `answer_four`, `correct_answer`) VALUES
(1, 'Which character is used at the start of a valid variable?', 4, '%', '&', '$', 'None', 'C'),
(2, 'Which of these is a valid variable?', 4, '$&number', '$_number', '$7number', '&$number', 'D'),
(3, 'Which of these is a valid variable?', 4, '$&number', '$_number', '$7number', '&$number', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `difficulty` int(1) NOT NULL,
  `description` text NOT NULL,
  `content` mediumtext NOT NULL,
  `author` varchar(55) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `difficulty`, `description`, `content`, `author`, `added`) VALUES
(1, 'Introduction', 1, 'An introduction to the PHP course', '<h2>What is PHP?</h2>\r\n<p>PHP is a programming language used for developing web applications. At the time of writing, it is the <em>most used language on the web</em>. It is what is known as a <em>back end language</em>, which is to say it used for developing the functionality of web applications</p>\r\n<p>Look at this site, for example. What you actually see, the headers, the writing you are reading now, the layout, that is what is know as <em>front end</em> or how a site looks and feels. Back end is how the <em>site works</em>. The topics you see, the login system, the registration, is all done through the magical use of PHP. With PHP, you can create <em>feature-rich applications</em>.</p>\r\n<h2>Who is this course for?</h2>\r\n<p>Like all the courses on our site, this course is aimed from beginners to intermediate PHP programmers.</p>\r\n<h2>How will I learn?</h2>\r\n<p>The main feature of this course is the fact it is taught in an <em>object-orientated way</em>. This might scare some people, but it shouldn''t. Most universities teach PHP in a procedural way which is not right. Not one ''big'' site in the world uses procedural PHP to power their site. When you started learning to write, you didn''t learn Ye Olde English way first, then move onto the modern version. The same applies for programming, which is why we will be learning from the ground up in an object orientated style.</p>\r\n<p>There are code passes to gain points on each topic, additional exercises, and further reading on some topics as well</p>', 'Ciaran Reen', '2014-07-03 07:25:00'),
(2, 'Variables', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>\n<p>Okay, so let''s start right at the top, just what is a variable? A variable is not something that is unique to any particular language,\n    but rather a critical building block of all programs. There is a reason that variables are one of the most commonly found ''first lessons''\n    when learning to program.</p>\n<p>All you need to know at this point is that a variable can <em>store information</em>. Think of a draw in your room. You will have a draw for your socks,\n    maybe, and a draw for your t-shirts, a draw for your games, and so on. These draws <em>store things</em>. At this point, think of variables like your draws.</p>\n\n<h2>A PHP variable</h2>\n<p><code>$aVariable</code></p>\n<p>There''s a PHP variable. We know this because of the prepended dollar sign. <em>Every time</em> you see a dollar sign at the start of a\n    word you will know that that is a variable you are looking at. But back to the first part, I said variables <em>store information</em>. But how? This weird dollar-signed\n    word doesn''t look like it''s doing anything. Well, we have to <em>assign it a value to store</em>. So let''s take our draw example again. We have a draw that stores\n    socks. We want to store some socks in this variable. Let''s do that.\n<p><code>$socks = ''socks''</code></p>\n<p>So just what''s going on here? Well, it''s quite simple, really. First, I re-worded the actual variable name. Why did I do this? Well, a variable should <em>always\n        be self-descriptive</em>. That is to say, someone should know what a variable is being used for just by looking at it. In my first example <code>$aVariable</code>\n    I was showing what a variable looked like. So that name was apt for that task. Likewise, I am now assigning a variable to store a string called ''socks''. So, the first thing to do\n    is change the variable name accordingly.</p>\n<p>The next thing is to <em>assign it a value</em>. First, let me explain the ''='' sign. Most of you will come from a traditional maths background where ''='' means\n    ''equals''. In programming, ''equals'' is denoted by two ''=='' signs. So if I were to say ''2 + 2 = 4'' in programming it would be ''2 + 2 == 4''. We will go into operators\n    in another tutorial, so if you don''t quite understand yet don''t worry.</p>\n<p>The single equals sign in programming means ''assign''. It is commonly referred to as the <em>assignment operator</em>. So in the <code>$socks = ''socks''</code> we are\n    <em>assigning</em> the value of <code>''socks''</code> to the <em>variable</em> called <code>$socks</code>. Now, any time we want to change this variable, we simply change the\n    name <code>''socks''</code> part and the variable''s value will change accordingly.</p>\n<h2>Using variables</h2>\n<p>What we have discussed so far isn''t really any help, as you can''t <em>do anything</em> with that socks variable. All it does is hold a static value with no real way\n    of doing anything with it. So let''s see variables in action, in some real world examples.</p>\n<p>First, create a new file in the root of your site directory (explained in Getting Started tutorial) and call it <strong>test.php</strong>. Type the following in that file.\n    (You can copy and paste, but it is <em>much more beneficial to type it out</em>, you''ll learn quicker that way and the information will stick).\n<pre><code><span><</span>?php\n        $tutorial = ''PHP Variables'';\n        $site = ''code-playground.com'';\n        $output = ''Can\\''t talk, I''m doing the '' . $tutorial . '' tutorial on '' . $site;\n        print $output;\n        ?></code></pre>\n<p>So what''s going on here? It''s easy. First, we define that this is a PHP script by opening with the classic <em>PHP tags</em>: <code><span><</span>?php</code>. Next, we define a variable\n    called <code>$tutorial</code> and assign it a value of <code>''PHP Variables''</code>. Then we do the same but with a variable called <code>$site</code> and a value of <code>code-playground.com</code>.\n    Don''t forget, these could be anything at all, it just makes sense to assign these values. If we assigned <code>$tutorial</code> a value of <code>''socks</code> it wouldn''t make much sense. On the next\n    line we construct a sentence using a string and our assigned variables.<p>\n<p>There''s a new, important symbol here: the <strong>fullstop</strong>. Some of you will know what this does through an educated guess, but anyway, it is called the <em>concatenation operator</em>.\n    What''s that? Don''t let the big word fool you, all it does is <em>join things together</em>. So it will join the variable values into the sentence to form a final sentence of\n<p><code>''Can''t talk, I''m doing the PHP Variables tutorial on code-playground.com''</code></p>\n<p>But why take my word? Let''s run this script and you can see for yourself. That''s what the <code>print</code> function does, btw: it prints whatever you specify out. Okay, so open your browser and\n    navigate to <strong>localhost/test.php</strong> and you should see the output displayed on the page!</p>\n<p>This is exciting. With this knowledge you have acquired one of the fundamental practices of coding today and in its history.</p>\n<h2>Other nuggets of information</h2>\n<ul>\n    <li>Variables can be started with a letter or an underscore. Numbers and other special symbols are not valid variables</li>\n    <li>You can <em>reference variables</em> (more on that in another tutorial) by typing an &amp; character before the dollar sign</li>\n</ul>\n<h2>Exercises</h2>\n<ol>\n    <li>Play around with the variables in <strong>test.php</strong> to things more exciting. Output the result.</li>\n    <li>Add more variables and add these to the output string. Output the result.</li>\n    <li>Use legal and illegal variables (explained above). Output the result. What do you notice when you use illegal variables?</li>\n</ol>', 'Ciaran Reen', '2014-07-03 13:24:23'),
(3, 'Functions', 2, 'In this tutorial you will be learning how to use another crucial part of a PHP program and particularly Object Orientated programming: Functions', '<h2>What is a function?</h2>\n<p>Let''s start from the top again: just what is a function? A function is a grouped piece of code, essentially. This might not seem clear at first,\n    so let me show you an example of an function.</p>\n<pre><code>public function getSocksFromDrawer()\n{\n     //do something\n     $blueSocks = ''found!'';\n     return $blueSocks;\n}\n    </code></pre>\n<p>So, what''s going on in the above code? Well, first we define the <em>visibility</em> of the function. We will go into this topic in another tutorial, but all you\nneed to know right now is that it makes the function accessible from anywhere in the program. Try to ignore this for now - like I said, we''ll cover it later.</p>\n<p>Next is the function itself. The name of the function, <code>getSocksFromDrawer()</code> should be <em>self-descriptive</em>, just like variables. When looking at this function,\nsomeone can see that this function will get some socks from a drawer. Wonderful.</p>\n<p>Next we have some <em>curly braces</em>. These define the <em>meat of the function</em>, where the code executes. All the function does at the moment is return some\nblue socks that have the value of <code>''found''</code>. For the rest of this tutorial, we will work with this function and another one, and create a program which will\nget socks and store them.</p>\n<h2>Separation of logic</h2>\n<p>Coding is all about logic. Functions provide a great way to <em>separate logic</em> from each other. There is a rule that <em>for every new task a program needs to\nperform, a function should be written for it</em>. In the example above, let''s say we needed to get t-shirts from a drawer, we could incorporate that into the <code>getSocksFromDrawer()</code>\nfunction, but that wouldn''t make sense. Instead, a new function would be written called <code>getTShirtsFromDrawer()</code>. This is an example of <em>separation of logic</em>.</p>\n<p>A real world example would be a login/logout system, which we will build in another tutorial. The separation would be two functions, one which logs the user in (<code>login()</code>)\nand one which logs the user out (<code>logout()</code>).</p>\n<h2>Expanding our function</h2>\n<p>Let''s expand this function to only return socks that have been found.</p>\n<pre><code>public function getSocksFromDrawer()\n{\n     $blueSocks = ''found!'';\n     $redSocks = ''found!'';\n     $pinkSocks = ''found!'';\n     if ($pinkSocks === ''found!'')\n     {\n         return $pinkSocks;\n     }\n}\n</code></pre>\n<p>Now our function has some logic inside it. We <em>declare</em> three <em>variables</em> and assign them values of found. For the moment, we only want <code>$pinkSocks</code>\n,so we need to check that they have been found. So we essentially say <strong>if pink socks have been found then return them</strong>. It''s that simple.\nWe''ll leave this function here for now and move onto another one so we can get these pink socks.</p>\n<h2>Calling functions</h2>\n<p>Let''s get those pink socks! See if you can see what this function does, then we''ll go through it.</p>\n<pre><code>\n        public function findPinkSocks()\n        {\n            $pinkSocks = $this->getSocksFromDrawer();\n            print $pinkSocks;\n        }\n        </code></pre>\n<p>We''ve introduced another key element of PHP programs here: the keyword <code>$this</code>. This is a <em>reserved</em> word, meaning you can''t declare it as a normal\nvariable. So what does it do? Well, let''s break it down further. We had one goal when writing this function: <em>to get some pink socks</em>. The function to get those socks\nis in <em>this</em> file and we need to access it. That''s exactly what <code>$this</code> does. It basically says, <strong>okay, let''s look in this file for a function</strong>.\n<p>We then call the <code>getSocksFromDrawer()</code> function. But what does that do? Any time you <em>call</em> a function it will return the return value in that function.\nSo, in the <code>getSocksFromDrawer()</code> function, we can see that we are returning the <code>$pinkSocks</code> variable. When we write <code>$this->getSocksFromDrawer();</code>\nand it assign it to the variable <code>$pinkSocks</code>, that variable now holds a value of ''found!''</p>\n<h2>Expanding our function further</h2>\n<p>This is what the completed file might look like at the moment. (This won''t work, we''re missing a few things, but we''re just covering functions for now).</p>\n<pre><code><span><</span>?php\n        class functionTest()\n        {\n\n            public function getSocksFromDrawer()\n            {\n                $blueSocks = ''found!'';\n                $redSocks = ''found!'';\n                $pinkSocks = ''found!'';\n                if ($pinkSocks === ''found!'')\n                {\n                    return $pinkSocks;\n                }\n            }\n\n            public function findPinkSocks()\n            {\n                $pinkSocks = $this->getSocksFromDrawer();\n                print $pinkSocks;\n            }\n        }\n        ?>\n    </code></pre>\n<p>However, you might of noticed that this <em>doesn''t really make that much sense</em>. The reason is the <code>getSocksFromDrawer()</code> function should return\nany of the socks, not just pink ones, as the name suggests. Let''s do that.</p>\n<pre><code>public function getSocksFromDrawer($socks)\n{\n    $blueSocks = ''blue socks'';\n    $redSocks = ''red socks'';\n    $pinkSocks = ''pink socks'';\n\n    if ($socks === $blueSocks)\n    {\n        return $blueSocks;\n    }\n    elseif ($socks === $redSocks)\n    {\n        return $redSocks;\n    }\n    elseif ($socks === $pinkSocks)\n    {\n        return $pinkSocks;\n    }\n    else\n    {\n        return ''No matching socks were found!'';\n    {\n}\n    </code></pre>\n<p>It might seem like there''s a lot going on here, but it''s simple. There is another important concept introduced here: parameters. If you look in the parentheses ''()''\non the function name then you''ll see a <code>$socks</code> variable has crept in. This means that <em>this function accepts one param</em>. I''ll refer to them as params\nfrom now on, because that''s what they are commonly called (and args as well, short for argument). What''s a param? It just means that when you <em>call this function</em>\n(in our case <code>$this->getSocksFromDrawer();</code>) you need to pass something into the parentheses. For example, we could write this:</p>\n<p><code>$this->getSocksFromDrawer(''pink socks'');</code></p>\n<p>This make the <code>$socks</code> param equal ''pink socks''. Now we can see what the code does. It essentially checks each of the socks and sees if any of their values\nmatches our ''pink socks'' param. On the third check, <code>elseif ($socks === $pinkSocks)</code> we have a match and we get the <code>$pinkSocks</code> variable returned.\nOur function does what it says it will do now: it gets some socks from the drawer, and if it can''t find them, it tells us so. Here''s the completed code, you can copy this\ninto a file (or <em>write it out</em>!) and load your browser at <strong>localhost/filename.php</strong> to see some output! Don''t worry about the line at the bottom for now,\n    or the construct function, they''re covered in another tutorial.</p>\n<pre><code><span><</span>?php\n        class functionTest\n        {\n            public function __construct()\n            {\n                $this->findPinkSocks();\n            }\n\n            public function getSocksFromDrawer($socks)\n            {\n                $blueSocks = ''blue socks'';\n                $redSocks = ''red socks'';\n                $pinkSocks = ''pink socks'';\n                if ($blueSocks === $socks)\n                {\n                    return $blueSocks;\n                }\n                if ($redSocks === $socks)\n                {\n                    return $redSocks;\n                }\n                if ($pinkSocks === $socks)\n                {\n                    return $pinkSocks;\n                }\n            }\n\n            public function findPinkSocks()\n            {\n                $pinkSocks = $this->getSocksFromDrawer(''pink socks'');\n                print $pinkSocks;\n            }\n        }\n        $functionTest = new functionTest();\n        ?>\n    </code></pre>\n<h2>Recap</h2>\n<ul>\n    <li>Functions are found in all object orientated programs, and form the basis for MVC frameworks.</li>\n    <li>As a rule of thumb, each function should do one task and one task only.</li>\n    <li>Functions should be self-descriptive.</li>\n    <li>Functions can return things, such as variables, back to the calling function.</li>\n    <li>Functions can take params, or arguments, and use them in the function.</li>\n    <li>The <code>$this</code> keyword is used to access functions in that class.</li>\n</ul>\n<h2>Other key nuggets of information</h2>\n<ul>\n    <li>Functions can be <code>public</code>, <code>protected</code>, or <code>private</code>.</li>\n    <li>Functions must have be inside a class. Find out more in the Class topic.</li>\n</ul>\n<h2>Exercises</h2>\n<ol>\n    <li>Change the value of the argument being passed into the <code>$this->getSocksFromDrawer(''pink socks'');</code> part. What do you get back?\n        Is the output expected?</li>\n    <li>Pass in an incorrect argument in the same function. What gets returned in the browser?</li>\n    <li>Make new functions below <code>findPinkSocks()</code> to get all the other socks. To make them appear in your browser, add them to the construct\n        function at the top.</li>\n</ol>', 'Ciaran Reen', '2014-07-03 14:22:09'),
(4, 'Variable Scope', 2, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-02 04:14:11'),
(5, 'The construct function', 2, 'In this tutorial we will be covering the reserved __construct function', '<h2>The construct function? Why so special?</h2>\n<p>So the construct function is special. Why so? Well, it helps if you think of creating programs as <em>building them</em>, which is essentially what you\nare doing. Thinking like this, the construct becomes semi-self-explanatory. When a class is called by <em>instantiating it</em>, the construct function\nis run right away. Again, the best way is to show, so let''s dive into some examples. Trust me, it''s easy.</p>\n<h2>A constructor example</h2>\n<p>Let''s take some arbitrary class called JackInTheBox. JackInTheBox has many functions but now we want to connect to a database which is in another class. We know\nwe instantiate JackInTheBox by writing this:</p>\n<code>$jackInTheBox = new JackInTheBox();</code>\n<p>We now have access to all the public methods in that class. But those classes need access to a database connection. We could write a new function to do this.</p>\n<pre class="pre-default-code"><code>\n        <span class="main-highlight">public function</span> openDatabaseConn() {\n            <span class="comment">//Run some code to connect to database</span>\n        }\n        </code></pre>\n<p>But this isn''t good practice. Realistically, a website will be <em>constantly connected to a db</em>. So this function will have to be manually run every time\nthe class is called. What if we could run this code automatically when the class is called? Enter the constructor. This is how I think of the constructor: <em>When\nthe class is called, the constructor <strong>constructs</strong> the core functionality of the class, ready for rest of that class to use</em>. So basically,\nif something needs to be run every time a class is loaded, stick it in the construct.</p>\n<p>Our JackInTheBox class could look like this now</p>\n\n<pre class="pre-default-code">\n    <code>\n        <span class="main-highlight">class</span> JackInTheBox <span class="main-highlight">extends</span> Db\n        {\n            <span class="main-highlight">public function</span> __construct()\n            {\n                <span class="main-highlight">parent::</span>__construct();\n                <span class="var">$this->db</span> = <span class="main-highlight">new</span> Db();\n            }\n\n            <span class="comment">//Rest of the functions here</span>\n        }\n        </code>\n    </pre>\n<p>Let me explain what''s going on here. First, we extend another class, which basically means we have access to all the methods in that class (see abstract and interface\nclasses for more info). Then <em>as soon as JackInTheBox is called, the construct function is run</em>. We can see in this function we load a new Db object and save it\nto a variable, giving us access to all the necessary functionality needed to connect to a db (assuming it is correct in the Db class).\n<h2>Mum, where''s my mum gone?!</h2>\n<p>The first line in that construct might of confused people a little bit <code>parent::__construct();</code>, so I thought I''d make a separate section to clarify it. This is a special method that is rather\nimportant, and it''s really simple. All it does is call the parent classes construct function (in this case the class we extend, Db). Let''s make a dummy db class to see it\nin action.\n<pre class="pre-default-code"><code>\n<span class="comment">//Start of file JackInTheBox.php</span>\n\n<span class="main-highlight">class</span> JackInTheBox <span class="main-highlight">extends</span> Db\n{\n     <span class="main-highlight">public function</span> __construct()\n    {\n        <span class="main-highlight">parent::</span>__construct();\n        <span class="var">$this->db</span> = <span class="main-highlight">new</span> Db();\n    }\n\n    <span class="comment">//Rest of the functions here</span>\n    }\n\n    <span class="comment">//End of file JackInTheBox.php</span>\n\n\n    <span class="comment">//Start of file Db.php</span>\n\n<span class="main-highlight">class</span> Db\n{\n    <span class="main-highlight">public function</span> __construct()\n    {\n        <span class="comment">//Some code to run the db connection here</span>\n    }\n}\n<span class="comment">//End of file JackInTheBox.php</span>\n</code>\n</pre>\n<p>This is really good as well, as we''ve written some clean code. The Db file connects to the Db, which is a <em>separation of concerns</em> from the JackInTheBox\nclass, which should only contain methods connected to that entity (maybe scaring people). Even better, now suppose we have a new class, <code>class Toolbar</code>\nthat needs to connect to a Db, well - you guessed it - we can just extend the Db class again. So now, <em>any class</em> that needs to have a Db connection can connect to\nthe Db class and they have access to it. When you have a big application with tens of classes all connecting to the same database (only in very rare instances will this not happen)\nthe construct becomes really handy, so get used to using it, comrade.</p>\n<h2>Recap</h2>\n<ul>\n    <li>The construct function is called as soon as a class is instantiated.</li>\n    <li>The construct function must be prepended with two underscores.</li>\n    <li>The <code>parent::__construct();</code> can be used to call the parent classes construct.</li>\n    <li>Use the construct function when you run the same code every time a class is called.</li>\n    </ul>\n<h2>Exercises</h2>\n<ol>\n    <li>Create a file, call it whatever you want, and make a class inside.</li>\n    <li>Do the same, but with different names for the file and class.</li>\n    <li>Make a construct function in the first file, which calls the parent construct, and then saves it in a variable. Don''t forget to extend the class.</li>\n    <li>In the second file, create a construct function which prints out a statement</li>\n    <li>Run the first file in your browser, do you get the printed statement from the second file?</li>\n', 'Ciaran Reen', '2014-06-24 20:26:35'),
(6, 'Require and Include', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-06-24 15:34:57'),
(7, 'Dependency Injection', 4, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-04 09:19:25'),
(8, 'Getting Started', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-03 10:52:40'),
(9, 'Introduction to Algebra', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-03 08:31:34'),
(10, 'Introduction to Algorithms', 3, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-01 12:29:33'),
(11, 'Defining a database schema', 1, 'In this tutorial you will be learning how to use the building blocks of any PHP program: Variables.', '<h2>What is a variable?</h2>', 'Ciaran Reen', '2014-07-01 19:30:24'),
(24, 'Classes', 2, 'In this tutorial, we will be learning about classes in PHP', '', 'Ciaran Reen', '2014-07-03 19:24:26'),
(25, 'Setters and Getters', 3, 'Setters and Getters in PHP are key to objects in classes.', '', 'Ciaran Reen', '2014-07-01 09:29:32'),
(26, 'Abstracts and Interfaces', 3, 'Abstract classes and Interface classes are extended classes that literally do that, they extend the functionality of your code and provide a hierarchical structure. ', '', 'Ciaran Reen', '2014-06-30 14:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `role` enum('default','admin') NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_over_13` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `security_question_id` int(11) NOT NULL,
  `security_question_answer` varchar(255) NOT NULL,
  `points` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `security_question_id` (`security_question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `username`, `role`, `avatar`, `is_over_13`, `email`, `password`, `security_question_id`, `security_question_answer`, `points`) VALUES
(1, 'Ciaran', 'Reen', 'ciaranreen', 'admin', NULL, 'true', 'ciaranreen@gmail.com', '$1$omK1hO1Y$WIWEFZLjZXZ9QHf0pA1zK0', 1, 'Reen', 100000),
(3, 'Ciarann', 'Test', 'testbro', 'default', NULL, 'true', 'test@gmail.com', '$1$iF1xKkIY$duNvcmQlZ0L.QfDMkmDbw1', 1, 'fdgdrgf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_badge`
--

CREATE TABLE IF NOT EXISTS `user_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `earned` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `badge_id` (`badge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_badge`
--

INSERT INTO `user_badge` (`id`, `user_id`, `badge_id`, `earned`) VALUES
(2, 1, 2, '2014-06-25 03:18:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE IF NOT EXISTS `user_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `comment_id` (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Users who have voted on comments' AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`id`, `user_id`, `comment_id`) VALUES
(1, 1, 1),
(2, 1, 11),
(3, 1, 23),
(4, 1, 25),
(15, 1, 26),
(16, 3, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `badge_topic_topic_id_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_course`
--
ALTER TABLE `category_course`
  ADD CONSTRAINT `category_course__category_id_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `category_course__course_id_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_topic_id_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  ADD CONSTRAINT `comment_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `course_topic`
--
ALTER TABLE `course_topic`
  ADD CONSTRAINT `course_topic_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `course_topic_topic_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints for table `test_question`
--
ALTER TABLE `test_question`
  ADD CONSTRAINT `test_question_topic_topic_id_id` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `security_question_key` FOREIGN KEY (`security_question_id`) REFERENCES `security_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `badge_user_user_id_id_` FOREIGN KEY (`badge_id`) REFERENCES `badge` (`id`),
  ADD CONSTRAINT `user_badge_badge_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `user_comment_comment_id_id` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `user_comment_user_id_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
