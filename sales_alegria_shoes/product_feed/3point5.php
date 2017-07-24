<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

function inv_3point5() {
	require("../includes/resource/db.php");
	set_time_limit(720);
		/* ************************************************************************ */
		/* ***************** Variables to change for each vendor ****************** */
		/* ************************************************************************ */
		$dateRead = date("m_d_y");
		$date = date("Ymd");
		$name = "3point5/alegriashoes.refresh.csv";

		//header
		$line = "FULFILLMENT,SKU,QUANTITY\r\n";
		$company = "ALG";
		$replenishmentdate = "";
		
		
		
		$file = fopen( $name, "w" );
		$time = date("H_i_s");
		fputs($file, $line);
		include("resource/connection_mysql.php");
		
		while($row = mysql_fetch_assoc($result)){
			include("resource/variables_mysql.php");


			$tmpDisResult = ($tmpDis > '0' ? 'Y' : 'N');

			$line = "US,".$tmpItemNo." ".$tmpSize.",".$tmpStock."\r\n";

			fputs($file, $line);

			}
					
		
		fclose($file);

		echo '3point5 CSV Created Successfully! Date today: '.$dateRead.'<br /> <br />';
		// echo 'Download: <a href="ftp://lko@ftp.alegriashoes.com/www/sales_alegriashoes_com/product_feed/'.$name.'">3point5 CSV for '.$dateRead.'</a><br /><br /><b>***RIGHT CLICK and SAVE-AS to save file to computer!</b>';
}

// inv_3point5();
?>