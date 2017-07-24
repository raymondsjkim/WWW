<?php
function inv_vendornet(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "vendornet/vendornet.csv";
	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";

	$file = fopen($name, "w");
	$time = date("H_i_s");

	include("resource/connection_mysql.php");

	$line = "REC-TYPE,VENDOR SKU NO,HOST SKU NO,UPC,ON HAND QTY,ON HAND DATE,BACKORDER QTY,BACKORDER DATE,EXPECTED QTY,EXPECTED DATE\r\n";
	fputs($file, $line);

	while($row = mysql_fetch_assoc($result)){
		include("resource/variables_mysql.php");

		$line = "IR,".$tmpItemNo."_".$tmpSize.",,".$tmpUPC.",".$tmpStock.",,,,,\r\n";

		fputs($file, $line);
	}

	fclose($file);
	echo "vendornet created";
}

// inv_vendornet();
?>