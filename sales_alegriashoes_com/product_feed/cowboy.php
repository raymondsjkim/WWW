<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_cowboy(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "cowboy/alegriashoesinv.csv";
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
			if ($tmpStock <= 5){ $tmpStock = 0;} else { $tmpStock = $tmpStock;}
			
			/*if ($tmpSize == 35){ $sizeChart = "Size: Euro 35 / US 5 - 5.5";}
			if ($tmpSize == 36){ $sizeChart = "Size: Euro 36 / US 6 - 6.5";}
			if ($tmpSize == 37){ $sizeChart = "Size: Euro 37 / US 7 - 7.5";}
			if ($tmpSize == 38){ $sizeChart = "Size: Euro 38 / US 8 - 8.5";}
			if ($tmpSize == 39){ $sizeChart = "Size: Euro 39 / US 9 - 9.5";}
			if ($tmpSize == 40){ $sizeChart = "Size: Euro 40 / US 10";}
			if ($tmpSize == 41){ $sizeChart = "Size: Euro 41 / US 10.5";}
			if ($tmpSize == 42){ $sizeChart = "Size: Euro 42 / US 11";}
			*/
			if ($tmpSize == 35){ $sizeChart = "[S]Size=Euro 35 / US 5 - 5.5";}
			if ($tmpSize == 36){ $sizeChart = "[S]Size=Euro 36 / US 6 - 6.5";}
			if ($tmpSize == 37){ $sizeChart = "[S]Size=Euro 37 / US 7 - 7.5";}
			if ($tmpSize == 38){ $sizeChart = "[S]Size=Euro 38 / US 8 - 8.5";}
			if ($tmpSize == 39){ $sizeChart = "[S]Size=Euro 39 / US 9 - 9.5";}
			if ($tmpSize == 40){ $sizeChart = "[S]Size=Euro 40 / US 10";}
			if ($tmpSize == 41){ $sizeChart = "[S]Size=Euro 41 / US 10.5";}
			if ($tmpSize == 42){ $sizeChart = "[S]Size=Euro 42 / US 11";}
			if ($tmpSize == 12){ $sizeChart = "[S]Size=US 12";}
			if ($tmpSize == 13){ $sizeChart = "[S]Size=US 13";}
			if ($tmpSize == 1){ $sizeChart = "[S]Size=US 1";}
			if ($tmpSize == 2){ $sizeChart = "[S]Size=US 2";}
			if ($tmpSize == 3){ $sizeChart = "[S]Size=US 3";}
			if ($tmpSize == 4){ $sizeChart = "[S]Size=US 4";}
			if ($tmpSize == 5){ $sizeChart = "[S]Size=US 5";}
			//content/data
			//$line = $pId.",".$tmpItemNo."-".$tmpSize.",,,".$tmpStock.",5,1,,".$sizeChart."\r\n";
			if (strlen($tmpCStyle) > 3) {
				//echo $tmpCStyle." has number<br>";
			}else{
				//echo $tmpCStyle." has NO number<br>";
				$line = $tmpItemNo."-".$tmpSize.",".$tmpUpc.",".$tmpStock."\r\n";
				fputs($file, $line);
			}
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				
		
		
	}
	fclose($file);
	echo "Z created<br>";
}


//inv_alegriashoes();
?>

