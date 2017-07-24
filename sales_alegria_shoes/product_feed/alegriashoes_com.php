<?php


function inv_alegriashoes_com(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "alegriashoes_com/alegriashoesinv_nolimit.csv";
	//header
	//$line = "Product ID,Variation SKU,Variation Price,Variation Weight,Variation Stock Level,Variation Low Stock Level,Variation Enabled,Variation Image,Size 35-42\r\n";
	$line ="Product SKU,Product UPC,Stock Level\r\n";
	$company = "ALG";
	$replenishmentdate = "";
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	
	include("resource/connection_mysql.php");
	
	
	
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
			
			include("resource/variables_mysql.php");
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
			if ($tmpStock < 1){ $tmpStock = 0;} else { $tmpStock = $tmpStock;}

				$line = $tmpItemNo."-".$tmpSize.",".$tmpUpc.",".$tmpStock."\r\n";
				fputs($file, $line);
			
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				
		
		
	}
	fclose($file);
	echo "alegriashoes.com created<br>";
}


// inv_alegriashoes_com();
?>

