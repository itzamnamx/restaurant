<?
	/*****************************************************
	Developer: macdonaldgeek
	Email: admin@restaurantmis.tk
	Phone: +255-657-567401/+254-717-667201/+44-744-0579061
	Twitter: @macdonaldgeek

	COPYRIGHT �2014 RESTAURANT SCRIPT. ALL RIGHTS RESERVED
	******************************************************/
?>
<?php
	//checking connection and connecting to a database
	require_once('../connection/config.php');
	$db_error=false;
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		$db_error=true;
		$error_msg="Failed to connect to server: " . mysql_error();
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		$db_error=true;
		$error_msg="Unable to select database: " . mysql_error();
		}

//--
//-- Database: `rs`
//--

//-- --------------------------------------------------------

//--
//-- Table structure for table `billing_details`
//--
if ($db_error==false){
	$query = "CREATE TABLE IF NOT EXISTS `billing_details` (
	  `billing_id` int(10) NOT NULL AUTO_INCREMENT,
	  `member_id` int(15) NOT NULL,
	  `Street_Address` varchar(100) NOT NULL,
	  `P_O_Box_No` varchar(15) NOT NULL,
	  `City` text NOT NULL,
	  `Mobile_No` varchar(15) NOT NULL,
	  `Landline_No` varchar(15) DEFAULT NULL,
	  PRIMARY KEY (`billing_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `cart_details`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `cart_details` (
	  `cart_id` int(15) NOT NULL AUTO_INCREMENT,
	  `member_id` int(15) NOT NULL,
	  `food_id` int(15) NOT NULL,
	  `quantity_id` int(15) NOT NULL,
	  `total` float NOT NULL,
	  `flag` int(1) NOT NULL,
	  PRIMARY KEY (`cart_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `categories`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `categories` (
	  `category_id` int(15) NOT NULL AUTO_INCREMENT,
	  `category_name` varchar(45) NOT NULL,
	  PRIMARY KEY (`category_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15";
	mysql_query($query);
	
	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `content`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `content` (
	  `content_id` int(1) NOT NULL DEFAULT '1',
	  `display_name` varchar(55) NOT NULL DEFAULT 'undefined',
	  `home_title` varchar(100) NOT NULL DEFAULT 'undefined',
	  `home_subtitle` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `about_description` varchar(2500) NOT NULL DEFAULT 'undefined',
	  `about_mission` varchar(2500) NOT NULL DEFAULT 'undefined',
	  `about_vision` varchar(2500) NOT NULL DEFAULT 'undefined',
	  `contacts` varchar(250) NOT NULL DEFAULT 'undefined',
	  `contact_location` varchar(45) NOT NULL DEFAULT 'undefined',
	  `specials_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `myaccount_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `myprofile_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `inbox_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `tables_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `partyhalls_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `rating_description` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `others_address` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `others_loggedout` varchar(1000) NOT NULL DEFAULT 'undefined',
	  `others_accessdenied` varchar(1000) NOT NULL DEFAULT 'undefined',
	  PRIMARY KEY (`content_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `currencies`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `currencies` (
	  `currency_id` int(5) NOT NULL AUTO_INCREMENT,
	  `currency_symbol` varchar(15) NOT NULL,
	  `flag` int(1) NOT NULL,
	  PRIMARY KEY (`currency_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `food_details`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `food_details` (
	  `food_id` int(15) NOT NULL AUTO_INCREMENT,
	  `food_name` varchar(45) NOT NULL,
	  `food_description` text NOT NULL,
	  `food_price` float NOT NULL,
	  `food_photo` varchar(45) NOT NULL,
	  `food_category` int(15) NOT NULL,
	  PRIMARY KEY (`food_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `members`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `members` (
	  `member_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `firstname` varchar(100) DEFAULT NULL,
	  `lastname` varchar(100) DEFAULT NULL,
	  `login` varchar(100) NOT NULL DEFAULT '',
	  `passwd` varchar(32) NOT NULL DEFAULT '',
	  `question_id` int(5) NOT NULL,
	  `answer` varchar(45) NOT NULL,
	  PRIMARY KEY (`member_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `messages`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `messages` (
	  `message_id` int(15) NOT NULL AUTO_INCREMENT,
	  `message_from` varchar(25) NOT NULL,
	  `message_email` varchar(45) NOT NULL,
	  `message_date` date NOT NULL,
	  `message_time` time NOT NULL,
	  `message_subject` text NOT NULL,
	  `message_text` text NOT NULL,
	  `message_flag` int(1) NOT NULL,
	  PRIMARY KEY (`message_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `orders_details`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `orders_details` (
	  `order_id` int(10) NOT NULL AUTO_INCREMENT,
	  `member_id` int(10) NOT NULL,
	  `billing_id` int(10) NOT NULL,
	  `cart_id` int(15) NOT NULL,
	  `delivery_date` date NOT NULL,
	  `StaffID` int(15) NOT NULL,
	  `flag` int(1) NOT NULL,
	  `time_stamp` time NOT NULL,
	  PRIMARY KEY (`order_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `partyhalls`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `partyhalls` (
	  `partyhall_id` int(5) NOT NULL AUTO_INCREMENT,
	  `partyhall_name` varchar(45) NOT NULL,
	  PRIMARY KEY (`partyhall_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `pizza_admin`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `pizza_admin` (
	  `Admin_ID` int(45) NOT NULL AUTO_INCREMENT,
	  `Username` varchar(45) NOT NULL,
	  `Password` varchar(45) NOT NULL,
	  PRIMARY KEY (`Admin_ID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `polls_details`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `polls_details` (
	  `poll_id` int(15) NOT NULL AUTO_INCREMENT,
	  `member_id` int(15) NOT NULL,
	  `food_id` int(15) NOT NULL,
	  `rate_id` int(5) NOT NULL,
	  PRIMARY KEY (`poll_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `quantities`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `quantities` (
	  `quantity_id` int(5) NOT NULL AUTO_INCREMENT,
	  `quantity_value` int(5) NOT NULL,
	  PRIMARY KEY (`quantity_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `questions`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `questions` (
	  `question_id` int(5) NOT NULL AUTO_INCREMENT,
	  `question_text` text NOT NULL,
	  PRIMARY KEY (`question_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `ratings`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `ratings` (
	  `rate_id` int(5) NOT NULL AUTO_INCREMENT,
	  `rate_name` varchar(15) NOT NULL,
	  PRIMARY KEY (`rate_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `reservations_details`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `reservations_details` (
	  `ReservationID` int(15) NOT NULL AUTO_INCREMENT,
	  `member_id` int(15) NOT NULL,
	  `table_id` int(5) NOT NULL,
	  `partyhall_id` int(5) NOT NULL,
	  `Reserve_Date` date NOT NULL,
	  `Reserve_Time` time NOT NULL,
	  `StaffID` int(15) NOT NULL,
	  `flag` int(1) NOT NULL,
	  `table_flag` int(1) NOT NULL,
	  `partyhall_flag` int(1) NOT NULL,
	  PRIMARY KEY (`ReservationID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `specials`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `specials` (
	  `special_id` int(15) NOT NULL AUTO_INCREMENT,
	  `special_name` varchar(25) NOT NULL,
	  `special_description` text NOT NULL,
	  `special_price` float NOT NULL,
	  `special_start_date` date NOT NULL,
	  `special_end_date` date NOT NULL,
	  `special_photo` varchar(45) NOT NULL,
	  PRIMARY KEY (`special_id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `staff`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `staff` (
	  `StaffID` int(15) NOT NULL AUTO_INCREMENT,
	  `firstname` varchar(25) NOT NULL,
	  `lastname` varchar(25) NOT NULL,
	  `Street_Address` text NOT NULL,
	  `Mobile_Tel` varchar(20) NOT NULL,
	  PRIMARY KEY (`StaffID`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `tables`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `tables` (
	  `table_id` int(5) NOT NULL AUTO_INCREMENT,
	  `table_name` varchar(45) NOT NULL,
	  PRIMARY KEY (`table_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `timezones`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `timezones` (
	  `timezone_id` int(5) NOT NULL AUTO_INCREMENT,
	  `timezone_reference` varchar(45) NOT NULL,
	  `flag` int(1) NOT NULL,
	  PRIMARY KEY (`timezone_id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3";
	mysql_query($query);
	
	//-- --------------------------------------------------------
	
	//--
	//-- Table structure for table `template`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `template` (
	  `template_id` int(1) NOT NULL DEFAULT '1',
	  `site_logo` varchar(45) NOT NULL DEFAULT 'default',
	  `site_background` varchar(45) NOT NULL DEFAULT 'default',
	  `site_header` varchar(45) NOT NULL DEFAULT 'default',
	  `site_center` varchar(45) NOT NULL DEFAULT 'default',
	  `site_footer` varchar(45) NOT NULL DEFAULT 'default',
	  `site_background_color` varchar(15) NOT NULL,
	  `site_center_color` varchar(15) NOT NULL,
	  `site_footer_color` varchar(15) NOT NULL,
	  PRIMARY KEY (`template_id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	mysql_query($query);

	//-- --------------------------------------------------------

	//--
	//-- Table structure for table `users`
	//--

	$query = "CREATE TABLE IF NOT EXISTS `users` (
	  `id` smallint(6) NOT NULL AUTO_INCREMENT,
	  `username` varchar(30) NOT NULL,
	  `password` varchar(32) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2";
	mysql_query($query);
	
	@header("Location: ../administration.php");
}
else{
	@header("Location: ../connection.php");
}
?>