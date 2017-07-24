<?php
function inv_dscoNordstrom(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "dsco-nordstrom/dsco-nordstrom-inv.csv";
	$company = "ALG";
	$today = date("m/d/Y");
	$replenishmentdate = "";

	$file = fopen($name, "w");
	$time = date("H_i_s");

	include("resource/connection_mysql.php");

	$line = "sku,UPC,title,quantity_available,status,cost,currency_code,quantity_on_order,estimated_availability_date,pgid,date\r\n";
	fputs($file, $line);

	while($row = mysql_fetch_assoc($result)){
		include("resource/variables_mysql.php");

		$tmpStatus = "";
		if ($tmpDis == 1) {
			$tmpStatus = "discontinued";
		}

		$line = $tmpUPC.",".$tmpUPC.",".$tmpColor.",".$tmpStock.",".$tmpStatus.",".$tmpWholeSale.","."USD".",,,A1152B".",".$today."\r\n";

		fputs($file, $line);
	}

	fclose($file);
	echo "Inventory for DSCO-Nordstrom created - file for ".date("M-d-Y");
	echo "<br /><br />";
	echo "Please download the file <a href='/product_feed/dsco-nordstrom/dsco-nordstrom-inv.csv' target='_blank' download><b>here</a></b>.";
}

inv_dscoNordstrom();
?>