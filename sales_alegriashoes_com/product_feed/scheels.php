<?php
function inv_scheels(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "scheels/scheels_inv.csv";
	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";

	$file = fopen($name, "w");
	$time = date("H_i_s");

	include("resource/connection_mysql.php");

	$line = "CATALOG,SELECTION CODE,SELECTION CODE DESCRIPTION,PRODUCT ID,PRODUCT [ID] DESCRIPTION,UPC,".
			"VENDOR PART NUMBER,VENDOR PART DESCRIPTION,NRF COLOR CODE,PRODUCT COLOR DESCRIPTION,NRF SIZE CODE,".
			"PRODUCT SIZE DESCRIPTION,PRODUCT FABRIC DESCRIPTION,AVAILABLE DATE,DISCONTINUE DATE,MINIMIUM ORDER QTY,".
			"MAXIMUM ORDER QTY,REORDERABLE PRODUCT,SEASONAL AVAILABILITY,COUNTRY OF ORIGIN,INNER PACK QTY,".
			"OUTER PACK QTY,ORDER LEAD TIME,ORDER LEAD TIME CODE,ITEM EXTENDED DESCRIPTION,IMAGE URL,PRICE QUALIFIER 1,".
			"PRICE AMOUNT 1\r\n";
	fputs($file, $line);

	while($row = mysql_fetch_assoc($result)){
		include("resource/variables_mysql.php");

		$nrfSize = $tmpSize + 52110;

		$line = "CATALOG,ALG,Alegria Shoes,".$tmpItemNo."_".$tmpSize.",".$tmpColor.",".$tmpUPC
				.",,,,".$tmpColor.",".$nrfSize.",".$tmpSize.",Leather,,,1,,Y,,China,,,,,,,"
				.$retailMSRP.",".$tmpWholeSale."\r\n";

		$line = str_replace('"', "", $line);

		fputs($file, $line);
	}

	fclose($file);
	echo "scheels created";
}

inv_scheels();
?>