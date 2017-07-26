<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_allheart(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "allheart/inventory_daily.csv";
	//header
	$line = "UPC,Available,ReplenishmentDate,Discountinued\r\n";
	
	$replenishmentdate = "1/1/1970";
	
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
			if (strlen($tmpCStyle) > 3) {
				//echo $tmpCStyle." has number<br>";
			}else{
				//echo $tmpCStyle." has NO number<br>";
				$line = $tmpUPC.",".$tmpStock.",".$tmpETA.",".$tmpDis."\r\n"; 
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				fputs($file, $line);
			}
		
	}
	fclose($file);
	echo "B created<br>";
}


//inv_allheart();
?>

