<?php
function inv_scrubsNBeyond(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "scrubs_n_beyond/scrubs_n_Beyond_SKU-inv.csv";
	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";

	$file = fopen($name, "w");
	$time = date("H_i_s");

	include("resource/connection_mysql.php");

	$line = "SKU,Stock,MSRP\r\n";
	fputs($file, $line);

	while($row = mysql_fetch_assoc($result)){
		include("resource/variables_mysql.php");

		$line = $tmpItemNo."_".$tmpSize.",".$tmpStock.",".$retailMSRP."\r\n";

		fputs($file, $line);
	}

	fclose($file);
	echo "Inventory by SKU for Scrubs N Beyond created - file for ".date("M-d-Y");
	echo "<br /><br />";
	echo "Please download the file <a href='/product_feed/scrubs_n_beyond/scrubs_n_Beyond_SKU-inv.csv' target='_blank' download><b>here</a></b>.";
}

inv_scrubsNBeyond();
?>