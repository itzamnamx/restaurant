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
    require_once('auth.php');
	require_once('admin/locale.php');
?>
<?PHP
//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}
?>
<?php
//checking connection and connecting to a database
require_once('connection/config.php');
//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID'];

//selecting all records from the orders_details table. Return an error if there are no records in the table
$result=mysql_query("SELECT * FROM orders_details,cart_details,food_details,categories,quantities,members WHERE members.member_id='$memberId' AND orders_details.member_id='$memberId' AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND food_details.food_category=categories.category_id AND cart_details.quantity_id=quantities.quantity_id LIMIT $startrow, 5")
or die("There are no records to display ... \n" . mysql_error());
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysql_query("SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_items = mysql_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
	$flag=0; //limit messages only received from the administrator
    $messages=mysql_query("SELECT * FROM messages WHERE message_flag='$flag'")
    or die("Something is wrong ... \n" . mysql_error()); 
    //get the number of rows
    $num_messages = mysql_num_rows($messages);
?>
<?php
    //retrive a currency from the currencies table
    //define a default value for flag_1
    $flag_1 = 1;
    $currencies=mysql_query("SELECT * FROM currencies WHERE flag='$flag_1'")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $name ?>:Member Home</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="foodzone.php">Food Zone</a></li>
  <li><a href="specialdeals.php">Special Deals</a></li>
  <li><a href="member-index.php">My Account</a></li>
  <li><a href="contactus.php">Contact Us</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo $name ?></div>
</div>
<div id="center">
<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<a href="member-profile.php">My Profile</a> | <a href="cart.php">Cart[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Inbox[<?php echo $num_messages;?>]</a> | <a href="tables.php">Tables</a> | <a href="partyhalls.php">Party-Halls</a> | <a href="ratings.php">Rate Us</a> | <a href="logout.php">Logout</a>
<p>&nbsp;</p>
<?php echo $account ?>
<h3><a href="foodzone.php">Order More Food!</a></h3>
<hr>
<table border="1" width="900" align="center" style="text-align:center;">
<CAPTION><h2>ORDER HISTORY</h2></CAPTION>
		<tr>
			<td colspan="9" align="right">
				<?PHP
				//create a "Previous" link
				$prev = $startrow - 5;
				//only print a "Previous" link if a "Next" was clicked
				if ($prev >= 0)
				echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"><-Previous</a>';
				
				if ($prev >= 0 AND $prev < 0)
				//create a separator
				echo ' | ';
				
				if ($prev < 0)
				//create a "Next" link
				echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+5).'">Next-></a>';
				?>
			</td>
		</tr>
		<tr>
			<th>Order ID</th>
			<th>Food Photo</th>
			<th>Food Name</th>
			<th>Food Category</th>
			<th>Food Price</th>
			<th>Quantity</th>
			<th>Total Cost</th>
			<th>Delivery Date</th>
			<th>Action(s)</th>
		</tr>

<?php
	//loop through all table rows
	$symbol=mysql_fetch_assoc($currencies); //gets active currency
	while ($row=mysql_fetch_array($result)){
	echo "<tr>";
	echo "<td>" . $row['order_id']."</td>";
	echo '<td><a href=images/'. $row['food_photo']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['food_photo']. ' width="80" height="70"></a></td>';
	echo "<td>" . $row['food_name']."</td>";
	echo "<td>" . $row['category_name']."</td>";
	echo "<td>" . $symbol['currency_symbol']. "" . $row['food_price']."</td>";
	echo "<td>" . $row['quantity_value']."</td>";
	echo "<td>" . $symbol['currency_symbol']. "" . $row['total']."</td>";
	echo "<td>" . $row['delivery_date']."</td>";
	echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Cancel Order</a></td>';
	echo "</tr>";
	}
	mysql_free_result($result);
	mysql_close($link);
?>
		<tr>
			<td colspan="9" align="right">
				<?PHP
				//create a "Previous" link
				$prev = $startrow - 5;
				//only print a "Previous" link if a "Next" was clicked
				if ($prev >= 0)
				echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"><-Previous</a>';
				
				if ($prev >= 0 AND $prev < 0)
				//create a separator
				echo ' | ';
				
				if ($prev < 0)
				//create a "Next" link
				echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+5).'">Next-></a>';
				?>
			</td>
		</tr>
</table>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Home Page</a>  |  <a href="aboutus.php">About Us</a>  |  <a href="specialdeals.php">Special Deals</a>  |  <a href="foodzone.php">Food Zone</a>  |  <a href="#">Affiliate Program</a><br>
  | <a href="admin/index.php" target="_blank">Administrator</a> |</div>
  
  <div class="bottom_addr">&copy; <?php echo date("Y") . " " . $name ?>. All Rights Reserved</div>
</div>
</div>
</body>
</html>
