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
	require_once('locale.php');
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
    
//retrive categories from the categories table
$categories=mysql_query("SELECT * FROM categories")
or die("There are no records to display ... \n" . mysql_error()); 

//retrieve quantities from the quantities table
$quantities=mysql_query("SELECT * FROM quantities")
or die("Something is wrong ... \n" . mysql_error()); 

//retrieve currencies from the currencies table (deleting)
$currencies=mysql_query("SELECT * FROM currencies")
or die("Something is wrong ... \n" . mysql_error()); 

//retrieve currencies from the currencies table (updating)
$currencies_1=mysql_query("SELECT * FROM currencies")
or die("Something is wrong ... \n" . mysql_error()); 

//retrieve polls from the ratings table
$ratings=mysql_query("SELECT * FROM ratings")
or die("Something is wrong ... \n" . mysql_error());

//retrieve timezones from the timezones table (deleting)
$timezones=mysql_query("SELECT * FROM timezones")
or die("Something is wrong ... \n" . mysql_error()); 

//retrieve timezones from the timezones table (updating)
$timezones_1=mysql_query("SELECT * FROM timezones")
or die("Something is wrong ... \n" . mysql_error());  

//retrieve tables from the tables table
$tables=mysql_query("SELECT * FROM tables")
or die("Something is wrong ... \n" . mysql_error());

//retrieve partyhalls from the partyhalls table
$partyhalls=mysql_query("SELECT * FROM partyhalls")
or die("Something is wrong ... \n" . mysql_error());

//retrieve questions from the questions table
$questions=mysql_query("SELECT * FROM questions")
or die("Something is wrong ... \n" . mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Options</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Options </h1>
<a href="index.php">Home</a> | <a href="categories.php">Categories</a> | <a href="foods.php">Foods</a> | <a href="accounts.php">Accounts</a> | <a href="orders.php">Orders</a> | <a href="reservations.php">Reservations</a> | <a href="specials.php">Specials</a> | <a href="allocation.php">Staff</a> | <a href="messages.php">Messages</a> | <a href="options.php"> > Options < </a> | <a href="content.php">Content</a> | <a href="template.php">Template</a> | <a href="logout.php">Logout</a>
</div>
<div id="container">
<fieldset><legend>Manage Categories</legend>
	<table align="center" width="910">
	<tr>
	<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
	<td>
	  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Category</td>
			<td><input type="text" name="name" class="textfield" maxlength="15" placeholder="name the category" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</td>
	</form>
	<td>
	<form name="categoryForm" id="categoryForm" action="delete-category.php" method="post" onsubmit="return categoriesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Category</td>
			<td><select name="category" id="category">
			<option value="select">- select category -
			<?php 
			//loop through categories table rows
			while ($row=mysql_fetch_array($categories)){
			echo "<option value=$row[category_id]>$row[category_name]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Quantities</legend>
	<table align="center" width="910">
	<tr>
	<form name="quantityForm" id="quantityForm" action="quantities-exec.php" method="post" onsubmit="return quantitiesValidate(this)">
	<td>
	  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Quantity</td>
			<td><input type="number" name="name" class="textfield" maxlength="2" min="1" max="99" placeholder="1" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</td>
	</form>
	<td>
	<form name="quantityForm" id="quantityForm" action="delete-quantity.php" method="post" onsubmit="return quantitiesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Quantity</td>
			<td><select name="quantity" id="quantity">
			<option value="select">- select quantity -
			<?php 
			//loop through quantities table rows
			while ($row=mysql_fetch_array($quantities)){
			echo "<option value=$row[quantity_id]>$row[quantity_value]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Currencies</legend>
	<table align="center" width="910">
	<tr>
	<td>
	<form name="currencyForm" id="currencyForm" action="currencies-exec.php" method="post" onsubmit="return currenciesValidate(this)">
	  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Currency</td>
			<td><input type="text" name="name" class="textfield" maxlength="5" placeholder="provide currency symbol" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</form>
	</td>
	<td>
	<form name="currencyForm" id="currencyForm" action="delete-currency.php" method="post" onsubmit="return currenciesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Currency</td>
			<td><select name="currency" id="currency">
			<option value="select">- select currency -
			<?php 
			//loop through currencies table rows
			while ($row=mysql_fetch_array($currencies)){
			echo "<option value=$row[currency_id]>$row[currency_symbol]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	<td>
	<form name="currencyForm" id="currencyForm" action="activate-currency.php" method="post" onsubmit="return currenciesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Currency</td>
			<td><select name="currency" id="currency">
			<option value="select">- select currency -
			<?php 
			//loop through currencies table rows
			while ($row=mysql_fetch_array($currencies_1)){
			echo "<option value=$row[currency_id]>$row[currency_symbol]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Update" value="Activate" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Ratings</legend>
	<table align="center" width="910">
	<tr>
	<form name="ratingForm" id="ratingForm" action="ratings-exec.php" method="post" onsubmit="return ratingsValidate(this)">
	<td>
	  <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Rate Level</td>
			<td><input type="text" name="name" id="name" class="textfield" maxlength="10" placeholder="i.e. Excellent, Good, Average, etc" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</td>
	</form>
	<td>
	<form name="ratingForm" id="ratingForm" action="delete-rating.php" method="post" onsubmit="return ratingsValidate(this)">
	  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Rate Level</td>
			<td><select name="rating" id="rating">
			<option value="select">- select level -
			<?php 
			//loop through ratings table rows
			while ($row=mysql_fetch_array($ratings)){
			echo "<option value=$row[rate_id]>$row[rate_name]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Time Zones</legend>
	<table align="center" width="910">
	<tr>
	<td>
	<form name="timezoneForm" id="timezoneForm" action="timezone-exec.php" method="post" onsubmit="return timezonesValidate(this)">
	  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Time Zone</td>
			<td><input type="text" name="name" class="textfield" maxlength="20" placeholder="provide restaurant Time Zone" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</form>
	</td>
	<td>
	<form name="timezoneForm" id="timezoneForm" action="delete-timezone.php" method="post" onsubmit="return timezonesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Time Zone</td>
			<td><select name="timezone" id="timezone">
			<option value="select">- select Time Zone -
			<?php 
			//loop through timezones table rows
			while ($row=mysql_fetch_array($timezones)){
			echo "<option value=$row[timezone_id]>$row[timezone_reference]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	<td>
	<form name="timezoneForm" id="timezoneForm" action="activate-timezone.php" method="post" onsubmit="return timezonesValidate(this)">
	  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Time Zone</td>
			<td><select name="timezone" id="timezone">
			<option value="select">- select Time Zone -
			<?php 
			//loop through timezones table rows
			while ($row=mysql_fetch_array($timezones_1)){
			echo "<option value=$row[timezone_id]>$row[timezone_reference]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Update" value="Activate" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Tables</legend>
	<table align="center" width="910">
	<tr>
	<form name="tableForm" id="tableForm" action="tables-exec.php" method="post" onsubmit="return tablesValidate(this)">
	<td>
	  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>Table Name/Number</td>
			<td><input type="text" name="name" class="textfield" maxlength="15" placeholder="i.e. West, East, Africa, 007, Whatever, etc" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</td>
	</form>
	<td>
	<form name="tableForm" id="tableForm" action="delete-table.php" method="post" onsubmit="return tablesValidate(this)">
	  <table width="350" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>Table Name/Number</td>
			<td><select name="table" id="table">
			<option value="select">- select table -
			<?php 
			//loop through tables table rows
			while ($row=mysql_fetch_array($tables)){
			echo "<option value=$row[table_id]>$row[table_name]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Party-Halls</legend>
	<table align="center" width="910">
	<tr>
	<form name="partyhallForm" id="partyhallForm" action="partyhalls-exec.php" method="post" onsubmit="return partyhallsValidate(this)">
	<td>
	  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
		<tr>
			<td>PartyHall Name/Number</td>
			<td><input type="text" name="name" class="textfield" maxlength="15" placeholder="i.e. West, East, Africa, 007, Charlie, Whatever, etc" required/></td>
			<td><input type="submit" name="Insert" value="Add" /></td>
		</tr>
	  </table>
	</td>
	</form>
	<td>
	<form name="partyhallForm" id="partyhallForm" action="delete-partyhall.php" method="post" onsubmit="return partyhallsValidate(this)">
	  <table width="370" border="0" align="center" cellpadding="2" cellspacing="0">
		<tr>
			<td>PartyHall Name/Number</td>
			<td><select name="partyhall" id="partyhall">
			<option value="select">- select partyhall -
			<?php 
			//loop through partyhalls table rows
			while ($row=mysql_fetch_array($partyhalls)){
			echo "<option value=$row[partyhall_id]>$row[partyhall_name]"; 
			}
			?>
			</select></td>
			<td><input type="submit" name="Delete" value="Remove" /></td>
		</tr>
	  </table>
	</form>
	</td>
	</tr>
	</table>
</fieldset>
<hr>
<fieldset><legend>Manage Questions</legend>
<table align="center" width="910">
<tr>
<form name="questionForm" id="questionForm" action="questions-exec.php" method="post" onsubmit="return questionsValidate(this)">
<td>
  <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Question</td>
        <td><input type="text" name="name" class="textfield" maxlength="25" placeholder="create a security question (used to reset password)" required/></td>
        <td><input type="submit" name="Insert" value="Add" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="questionForm" id="questionForm" action="delete-question.php" method="post" onsubmit="return questionsValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Question</td>
        <td><select name="question" id="question">
        <option value="select">- select question -
        <?php 
        //loop through quantities table rows
        while ($row=mysql_fetch_array($questions)){
        echo "<option value=$row[question_id]>$row[question_text]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Remove" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
</fieldset>
<hr>
</div>
<div id="footer">
<div class="bottom_addr">&copy; <?php echo date("Y") . " " . $name ?>. All Rights Reserved</div>
</div>
</div>
</body>
</html>
