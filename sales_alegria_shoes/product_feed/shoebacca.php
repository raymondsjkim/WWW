<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_shoebacca(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "shoebacca/inventory_daily.csv";
	//header
	$line = "Inventory Reference,Inventory Date,Vendor Number,Buyer Part Number,UPC,Product Description,Qty\r\n";
	//include PGL
	$company = "ALG";
	
	$replenishmentdate = "";
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");
	$today = date("ymd");
	$todaycode = date("Ymd");
	
	include("resource/connection_mysql.php");
	
	
	
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
			
		include("resource/variables_mysql2.php");
			
					if($tmpETA == "1/1/1970"){$tmpETA = "";}
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	
					if ($tmpSeason != 'CLOSEOUT') {
					//content/data
					//$line = "3835,".$tmpItemNo.",".$tmpClass.",".$tmpUPC.",".$tmpStock.",0,,".$tmpETA.",".$tmpDis.",\r\n"; 
						$line = $today.",".$todaycode.",1936304,".$tmpItemNo.",".$tmpUPC.",".$tmpColor.",".$tmpStock.",\r\n";//data
			
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					//echo $line."<br>";
						fputs($file, $line);
					}
			
		
	}
	fclose($file);
	echo "Shoebacca created<br>";
}


//inv_csn();
?>

