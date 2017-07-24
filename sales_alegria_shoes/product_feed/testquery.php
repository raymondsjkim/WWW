<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require("../includes/resource/db.php");

set_time_limit(3600);

$company = "ALG";
$today = date("Ymd");
$replenishmentdate = "";

include("resource/connection-all.php");//connect to mssqls

$listOfSkuNum = array('');
while($row = mssql_fetch_array($result)){
	$skunum = substr(trim($row['0'], " "), -3);
	// echo "<pre>";
	
	if (preg_match('([a-zA-Z])', $skunum)) {
	}
	else{
		array_push($listOfSkuNum, $skunum);
	}
	// echo "</pre>";
}

$compiledSkuNum = array_unique($listOfSkuNum);
asort($compiledSkuNum);

for ($i=0; $i < 1000; $i++) { 
	echo "<pre>";
	if (array_search($i, $compiledSkuNum) == FALSE) {
	 	print $i;
	 }
	echo "</pre>";
}


?>