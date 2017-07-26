<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_info_wil(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "info_wil/inventory_daily.csv";
	//header
	$line = "Style,Color,Size,UPC,Cost\r\n";
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
					
					//content/data
					//$line = "3835,".$tmpItemNo.",".$tmpClass.",".$tmpUPC.",".$tmpStock.",0,,".$tmpETA.",".$tmpDis.",\r\n"; 
					$line = $tmpUPC.",".$tmpItemNo.",".$tmpSize.",".$tmpWholeSale.",\r\n";//data

			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					//echo $line."<br>";
					fputs($file, $line);
					
			
		
	}
	fclose($file);
	echo "info_wil created<br>";
}


//inv_csn();
?>

