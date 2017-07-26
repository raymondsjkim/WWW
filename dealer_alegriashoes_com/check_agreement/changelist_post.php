<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../includes/resource/db.php");

$list = $_POST;

$linkID = mysql_connect($host, $user, $pass) or die(mysql_error()); 
mysql_select_db($database, $linkID) or die(mysql_error());


foreach ($list as $key => $value) {
	if ($key == "auth") {
		foreach ($value as $auth) {
			$query_auth = "UPDATE accounts SET loggedin=1, agreement=1 WHERE username=$auth";
			$result_auth = mysql_query($query_auth, $linkID) or die(mysql_error());
			$msg = "Account(s) updated to 'Logged in and Accepted Terms'!";
			}
		}
	}

	elseif ($key == "deauth") {
		foreach ($value as $deauth) {
			$query_deauth = "UPDATE accounts SET loggedin=0, agreement=0 WHERE username=$deauth";
			$result_deauth = mysql_query($query_deauth, $linkID) or die(mysql_error());
			$msg = "Account updated to 'Not Accepted'!";
			}
		}
	}


?>