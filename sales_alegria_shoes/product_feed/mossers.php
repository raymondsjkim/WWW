<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_mossers(){
	require("../includes/resource/db.php");
	set_time_limit(720);

	$name = "mossers/alegria_inv.csv";
	//header
	$line = "SKU,UPC,Description,MSRP,Stock\r\n"; 
	$replenishmentdate = "";	
	$file = fopen( $name, "w" );
	$time = date("H_i_s");

	include("resource/connection_mysql.php");
	fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
			
		include("resource/variables_mysql.php");
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
	if ($tmpDis == '0' && $tmpSeason != 'CLOSEOUT') {

		$line = $tmpItemNo.",".$tmpUPC.",".$tmpColor.",".$retailMSRP.",".$tmpStock."\r\n";
				
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
		fputs($file, $line);
		}
		
	}
	fclose($file);
	echo "Mossers created<br>";
}


//inv_planetshoes();
?>

