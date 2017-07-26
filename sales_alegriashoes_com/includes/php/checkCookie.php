<?php 
// Connects to your Database 
include ("includes/resource/db.php");

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

//checks cookies to make sure they are logged in 
if(isset($_COOKIE['ID_sales'])) 
{ 
	$username 		= $_COOKIE['ID_sales']; 
	$pass 			= $_COOKIE['Key_sales']; 
	$currentUser 	= $_COOKIE['Name_sales']; 
	$adm			= $_COOKIE['Adm_sales'];
	$lvl			= $_COOKIE['Lvl_sales'];
	$sales			= $_COOKIE['Num_sales']; 
	
	$check = mysql_query("SELECT * FROM $atable WHERE username = '$username'")or die(mysql_error()); 
	while($info = mysql_fetch_array( $check )) 
		{ 

//if the cookie has the wrong password, they are taken to the login page 
		if ($pass != md5($info['password'])) { 
			header("Location: login.php"); 
		} 

//otherwise they are shown the admin area 
		else { 
			
		} 
	} 
} else 

//if the cookie does not exist, they are taken to the login screen 
{ 
	header("Location: login.php"); 

} 
?> 