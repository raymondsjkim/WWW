<?php
function inv_rnshoes() {
	
	require("../includes/resource/db.php");
	set_time_limit(720);

	//file location
	$name = "rnshoes/rnshoes.csv";
	//header
	$line = "ProductSKU,ProductUPC,StockLevel,WholesalePrice,RetailPrice\r\n";

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

		$line = $tmpItemNo."-".$tmpSize.",".$tmpUPC.",".$tmpStock.",".$tmpWholeSale.",".$retailMSRP."\r\n";
		fputs($file, $line);
	}
	fclose($file);
	echo "rnshoes created<br>";

}

?>