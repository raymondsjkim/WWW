<?php 
// Connects to your Database 
include ("includes/resource/db.php");

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

$query = mysql_query("SELECT * FROM $atable")or die(mysql_error()); 
while($info = mysql_fetch_array( $query )) {
	echo "<pre>" ;
	print_r($info);
	echo "</pre>"; 
	}
?>