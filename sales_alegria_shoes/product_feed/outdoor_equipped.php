<?php
function inv_outdoor_equipped() {
	
	require("../includes/resource/db.php");
	set_time_limit(720);

	//file location
	$name = "outdoor_equipped/outdoor_equipped.csv";
	//header
	$line = "itemNo,color,size,upc,inStock,wholesalePrice,retailPrice,eta\r\n";

	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	include("resource/connection_mysql.php");
	$file = fopen( $name, "w" );
	$time = date("H_i_s");

	fputs($file, $line);

	while ($row = mysql_fetch_assoc($result)) {
		include("resource/variables_mysql.php");

		$line = $tmpItemNo.",".$tmpColor.",".$tmpSize.",".$tmpUPC.",".$tmpStock.",".$tmpWholeSale.",".$retailMSRP.",".$tmpETA."\r\n";
		fputs($file, $line);
	}
	fclose($file);
	echo "outdoor_equipped created<br>";

}

?>