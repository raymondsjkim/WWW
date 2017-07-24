<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_benchmark(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "benchmark/bm_inv.csv";
	//header
	$line = "VendorUPC,QuantityAvailable,DateReported\r\n"; 
	//include PGL
	$company = "ALG";
	$today = date("Ymd");
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
					
					//content/data
					$line = $tmpUPC.",".$tmpStock.",".$today."\r\n"; //data
			
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					////echo $line."<br>";
					fputs($file, $line);
					
		
		
		
	}
	fclose($file);
	echo "C created<br>";
}


// inv_benchmark();
?>

