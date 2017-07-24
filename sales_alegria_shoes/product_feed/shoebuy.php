<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

function inv_shoebuy() {
	require("../includes/resource/db.php");
	set_time_limit(720);
		/* ************************************************************************ */
		/* ***************** Variables to change for each vendor ****************** */
		/* ************************************************************************ */
		$dateRead = date("m_d_y");
		$date = date("Ymd");
		$name = "shoebuy/alg_inv2.csv";

		//header
		//$line = "Product ID,Variation SKU,Variation Price,Variation Weight,Variation Stock Level,Variation Low Stock Level,Variation Enabled,Variation Image,Size 35-42\r\n";
		$company = "ALG";
		$replenishmentdate = "";
		
		
		
		$file = fopen( $name, "w" );
		$time = date("H_i_s");
		include("resource/connection_mysql.php");
		
		while($row = mysql_fetch_assoc($result)){
			include("resource/variables_mysql.php");

			if ($tmpDis == '0' && $tmpSeason != 'CLOSEOUT') {
				$tmpDisResult = ($tmpDis > '0' ? 'Y' : 'N');

				$line = "Shoebuy,Peppergate F,".$date.",".$tmpStock.",".$tmpItemNo."_".$tmpSize.",".$tmpUPC.",".$tmpDisResult.",,".$tmpWholeSale.",,,,,,,\r\n";

				fputs($file, $line);
				}

			}
					
		
		fclose($file);

		echo 'Shoebuy CSV Created Successfully! Date today: '.$dateRead.'<br /> <br />';
		// echo 'Download: <a href="ftp://lko@ftp.alegriashoes.com/www/sales_alegriashoes_com/product_feed/'.$name.'">Shoebuy CSV for '.$dateRead.'</a><br /><br /><b>***RIGHT CLICK and SAVE-AS to save file to computer!</b>';
}
?>