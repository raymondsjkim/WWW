<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_scrubsetc(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "scrubsetc/scrubsetcinv.csv";
	//header
	$line = "Product ID,Name,stock,ETA\r\n";
	$company = "";
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
				
			
				
				
		if (strlen($tmpCStyle) > 3) {
				//echo $tmpCStyle." has number<br>";
			}else{
				//echo $tmpCStyle." has NO number<br>";		
				//content/data
				
		$line = $tmpItemNo."-".$tmpSize.",Alegria ".$tmpName.",".$tmpStock.",".$tmpETA."\r\n";
				
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
		fputs($file, $line);
		}
		
	}
	fclose($file);
	echo "J created<br>";
}


//inv_scrubsetc();
?>

