<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

	require("../includes/resource/db.php");
	
	set_time_limit(2);

	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";
	
	$inlinkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $inlinkID) or die("Could not find database1."); 
	
	$query = "truncate table $intable";
	
	
	mysql_query($query, $inlinkID) or die("Could not find database1.");

	
	include("resource/connection.php");//connect to mssqls
	
	while($row = mssql_fetch_array($result)){
				
		include("resource/size_new.php");
		
		include("resource/retailprice.php");
		
		include("resource/variables.php");
		
		include("resource/connection_upc.php");
				
		echo '<pre>'; echo $tmpSeason.'hihi'; echo '</pre>';
	}
					
?>