<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_lifeuniform(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/

	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
		
	$name = "../life_uniform/inventory/alegria_inventory.csv";
	//header
	$line = "UPCCode,InStock\r\n"; 
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
			$line = $tmpUPC.",".$tmpStock."\r\n";
				
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */				
				//////echo $line."<br>";
				fputs($file, $line);
		
	}
	fclose($file);
	echo "LIFE 2 created<br>";
}


//inv_onlineshoes();
?>

