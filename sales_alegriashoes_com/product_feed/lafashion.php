<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_lafashion(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "lafashion/alegriashoesinv.csv";
	//header
	$line = "productcode,stockstatus,upc_code\r\n"; 
	$replenishmentdate = "";
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	
	include("resource/connection_mysql.php");
	
	
	
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
			
			$tmpUPC		= trim($row['upc']," ");
			$tmpStock	= $row['inStock'];
			$tmpSize	= $row['size'];
			$pId		= $row['productID'];
			$tmpItemNo	= $row['itemNo'];
			$tmpUpc		= $row['upc'];
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
	if (strlen($tmpCStyle) > 3) {
				//echo $tmpCStyle." has number<br>";
	}else{
				//echo $tmpCStyle." has NO number<br>";
			//content/data
			$line = $tmpItemNo."-".$tmpSize.",".$tmpStock.",".$tmpUPC."\r\n"; 
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				fputs($file, $line);
	}		
		
	}
	fclose($file);
	echo "E created<br>";
}


//inv_lafashion();
?>

