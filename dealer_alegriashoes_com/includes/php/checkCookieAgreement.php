<?php 
// Connects to your Database 
include ("includes/resource/db.php");

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

//checks cookies to make sure they are logged in 
if(isset($_COOKIE['agreement_ID'])) { 
	$username = $_COOKIE['agreement_ID']; 
	$pass = $_COOKIE['agreement_Key']; 
	$check = mysql_query("SELECT * FROM $atable WHERE username = '$username'")or die(mysql_error()); 
	while($info = mysql_fetch_array( $check )) { 
//if the cookie has the wrong password, they are taken to the login page 
		if ($pass != $info['password']) { 
			header("Location: login.php"); 
		} 
	} 
}
//if the cookie does not exist, they are taken to the login screen 
else { header("Location: login.php");} 
?> 