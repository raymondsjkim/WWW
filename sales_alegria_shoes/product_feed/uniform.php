<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_uniform(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "uniform/uniform.csv";
	//header
	//$line = "Product ID,Variation SKU,Variation Price,Variation Weight,Variation Stock Level,Variation Low Stock Level,Variation Enabled,Variation Image,Size 35-42\r\n";
	//$line ="Product SKU,Product UPC,Stock Level\r\n";
	$company = "ALG";
	$replenishmentdate = "";
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

	
	include("resource/connection_mysql.php");
	
	
	
	//fputs($file, $line);
	
	while($row = mysql_fetch_assoc($result)){
		
			
			include("resource/variables_mysql.php");
			$sku = explode("-", $tmpItemNo);
			echo count($sku);
			echo "<pre>";
			print_r($sku);
			echo "</pre>";
			
			//split $tmpItemNo from full xxx-xxx-xxx to separate variables
			if (count($sku) == 3 && $sku[0] == "ALG") {
				$tmpItemNo = $sku[1]."-".$sku[2];
			}
			if (count($sku) < 3) {
				$skunum = $sku[1];
			}
			else {
				$skunum = $sku[2];
			}
			
			//collection for column 5
			if ($sku[0] == "AM") {
				$collection = $sku[0]."-".$sku[1];
			}
			elseif (count($sku) == 2) {
				$collection = $sku[0];
			}
			else {
				$collection = $sku[1];
			}

			// shoes for column 4
			$shoe = array('ABB', 'ALL' , 'BEL' , 'CIN' , 'DAY' , 'DEB' , 'KAI' , 'KEL' , 'KHL' , 'KYR' , 'PAL' , 'SAY' , 'SON' , 'TAY');
			$boot = array('AVA', 'AVR' , 'CAM' , 'CAT' , 'RAI');
			$clog = array('ALG', 'DON' , 'KAY' , 'SEV');
			$sandal = array('CAR', 'DIA' , 'ELL' , 'ETT' , 'HUL' , 'KAR' , 'KLE' , 'KON' , 'MOL' , 'PES' , 'SED' , 'STO' , 'TAN' , 'TUS' , 'VER' , 'VIO' , 'ZAN');
			$wedge = array('COC', 'ALL' , 'ISA' , 'LAN' , 'LAR' , 'LIL' , 'LOL');

			$amshoe = array('OZ' , 'SCH' , 'SPO' , 'HEW' , 'ALE' , 'AAR' , 'FOX' , 'BAR' , 'ART' , 'FRA');
			$amsandal = array('MAR' , 'CUR' , 'ANT' , 'ANG' , 'ARU');
			$amclog = array('CHA');
			$amboot = array('LEW' , 'ADE' , 'PAC' , 'JON'  );	

			if (count($sku) == "2") {
				$shoetype = "CLOG";
			}
			elseif (count($sku) == "3" && $sku[0] == "ALG") {
				foreach ($shoe as $key) {
					if ($sku[1] == $key) {
						$shoetype = "SHOES";
					}
				}
				foreach ($boot as $key) {
					if ($sku[1] == $key) {
						$shoetype = "BOOTS";
					}
				}
				foreach ($clog as $key) {
					if ($sku[1] == $key) {
						$shoetype = "CLOG";
					}
				}
				foreach ($sandal as $key) {
					if ($sku[1] == $key) {
						$shoetype = "SANDALS";
					}
				}
				foreach ($wedge as $key) {
					if ($sku[1] == $key) {
						$shoetype = "WEDGE";
					}
				}
			}

			elseif (count($sku) == "3" && $sku[0] == "AM") {
				foreach ($amshoe as $key) {
					if ($sku[1] == $key) {
						$shoetype = "SHOES";
					}
				}
				foreach ($amsandal as $key) {
					if ($sku[1] == $key) {
						$shoetype = "SANDALS";
					}
				}
				foreach ($amclog as $key) {
					if ($sku[1] == $key) {
						$shoetype = "CLOG";
					}
				}
			foreach ($amboots as $key) {
					if ($sku[1] == $key) {
						$shoetype = "BOOTS";
					}
				}
			}

	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
			
				//echo $tmpCStyle." has NO number<br>";
				$line = $tmpItemNo.",".$skunum.",".$tmpSize.",".$shoetype." ,".$collection.",".$tmpWholeSale.",".$retailMSRP.",".$tmpUpc.", , , ,".$tmpColor.",".$tmpColor."-".$tmpSize. "\r\n";
				fputs($file, $line);
			
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				
		
		
	}
	fclose($file);
	echo "uniform created<br>";
}


//inv_alegriashoes();
?>

