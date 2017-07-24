<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_shoeAndCo(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "shoeAndCo/shoeAndCo.csv";
	//header
	//$line = "Product ID,Variation SKU,Variation Price,Variation Weight,Variation Stock Level,Variation Low Stock Level,Variation Enabled,Variation Image,Size 35-42\r\n";
	$line ="Product SKU,Product UPC,Stock Level,Wholesale Price,MSRP\r\n";
	$company = "ALG";
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	
	include("resource/connection_mysql.php");
	
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
		include("resource/variables_mysql.php");

		$line = $tmpItemNo."-".$tmpSize.",".$tmpUpc.",".$tmpStock.","
				.$tmpWholeSale.",".$retailMSRP."\r\n";
		fputs($file, $line);
	
	}
	fclose($file);
	echo "shoeAndCo created<br>";
}


// inv_shoeAndCo();
?>

