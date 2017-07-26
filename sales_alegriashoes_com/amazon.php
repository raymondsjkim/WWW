<?php
require("includes/resource/db.php");
set_time_limit(720);
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	$date = date("m_d_y");
	$name = "amazon/amazon_inventory".$date.".csv";

	//header
	//$line = "Product ID,Variation SKU,Variation Price,Variation Weight,Variation Stock Level,Variation Low Stock Level,Variation Enabled,Variation Image,Size 35-42\r\n";
	$line ="Customer Code,UPC/EAN/GTIN,Vendor Item# / ISBN,Item Size,Item Color,Customer Item#,Item UOM,Item Description,Case Pack,# of Inner,Unit Item Weight,On Hand Quantity,Committed Quantity,On Order Quantity,Arrival Date,Unit Cost,Retail Price,% of Price Multiplier,Default Item Information on Order?,Override Cost on Order?,Certificate Number,Case Length,Case Width,Case Height,Case UOM,Integration Xref,Case Group Code,Country of Origin,NRF Size Code,NRF Color Code,NRF Description\r\n";
	$company = "ALG";
	$replenishmentdate = "";
	
	// UPDATE MANUALLY FOR EACH NEW SHOE SENT BY NORDSTROM
	
	
	$file = fopen( $name, "w" );
	$time = date("H_i_s");
	include("product_feed/resource/connection_mysql.php");
	
	fputs($file, $line);
	while($row = mysql_fetch_assoc($result)){
		include("product_feed/resource/variables_mysql.php");
		
		$zeroStock = ($tmpStock < 1 ? "12/31/2039" : "");

		$line = "AMAZON,".$tmpUPC.",,".$tmpSize.",,,EA,".$tmpColor.",,,,".$tmpStock.",,,".$zeroStock.",".$tmpWholeSale.",,,Y,N,,,,,,,,,,,\r\n";

		fputs($file, $line);
		}
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				
		
		
	
	fclose($file);
	echo 'Amazon CSV Created Successfully! Date today: '.$date.'<br /> <br />';
	echo 'Download: <a href="ftp://lko@ftp.alegriashoes.com/www/sales_alegriashoes_com/amazon/amazon_inventory'.$date.'.csv">Amazon CSV for '.$date.'</a><br /><br /><b>***RIGHT CLICK and SAVE-AS to save file to computer!</b>';