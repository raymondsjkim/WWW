<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("../includes/resource/db.php");
$list = $_POST;

$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
mysql_select_db($database, $linkID) or die("Could not find database."); 

$finalauth = array();
$finaldeauth = array();

function update_status($userid, $boolean) {
		$query = mysql_query("UPDATE accounts SET loggedin='$boolean', agreement='$boolean' WHERE username='$userid'") or die("Could not update MySQL");

		if ($boolean == "1") {
			$msg = "Account updated to 'Logged in and Accepted Terms'!";
			return $msg;
		}
		elseif ($boolean == "0") {
			$msg = "Account updated to 'Not Accepted'!";
			return $msg;
		}
	}

foreach ($list as $key => $value) {

	if ($key === "auth") {
		echo "<div class='span6'>";
		echo "<b>Authorize: </b><br />";
		foreach ($value as $auth) {
			echo $auth."<br />";
			array_push($finalauth, $auth);
			}
		echo "</div><br />";
		}

	elseif ($key === "deauth") {
		echo "<div class='span6'>";
		echo "<b>Unauthorize: </b><br />";
		foreach ($value as $deauth) {
			echo $deauth."<br />";
			array_push($finaldeauth, $deauth);
			}
		echo "</div><br />";
		}
	
	elseif ($value === "Submit") {
		foreach ($finalauth as $key) {
			update_status($key, '1');
			}
		foreach ($finaldeauth as $key) {
			update_status($key, '0');
			}
		}	
}


?>