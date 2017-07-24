<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function inv_tss(){
	require("../includes/resource/db.php");
	set_time_limit(720);
	/*
	echo substr(sprintf('%o', fileperms('shoebuy/')), -4);
	echo substr(sprintf('%o', fileperms('shoebuy/peppergate-ip.csv')), -4)."<br>";
	*/
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	$name = "theshoestore/tssinv.csv";
	//header
	$line = "id,name,stock\r\n";
	$company = "";
	$replenishmentdate = "";
	
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	$file = fopen( $name, "w" );
	
	$time = date("H_i_s");

		
	include("resource/connection_mysql.php");
	
	
	
	fputs($file, $line);
	$tmpTotalStock = 0;
	while($row = mysql_fetch_assoc($result)){
		
		if(strpos($row['color'], 'Exclusive') === false){ 
			if(strpos($row['color'], 'Scrubwear') === false){	
			
			include("resource/variables_mysql.php");
			
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */	
				$itemarray = explode("-", $tmpItemNo);
				
				
				if($tmpClass != "ALG5"){
					if(count($itemarray) == 3 ){//and $row['class'] == "ALG4"
						$tmpItemNo = $itemarray[1]."-".$itemarray[2];
						//echo $tmpItemNo."<br>";
					} else {
						$tmpItemNo = $tmpItemNo;
					}
				}
	
				
				if ($tmpStock <= 15){ $tmpStock = 0;} else { $tmpStock = $tmpStock;}
				
				
				$tmpTotalStock += $tmpStock;
				
				//content/data
				if ($tmpSize == 42){
				
					$line = $tmpItemNo."-".$tmpSize.",,".$tmpStock."\r\n".$tmpItemNo.",,".$tmpTotalStock."\r\n";
					//echo $line."<br>";
					$tmpTotalStock = 0;
				}else{
					$line = $tmpItemNo."-".$tmpSize.",,".$tmpStock."\r\n";
					//echo $line."<br>";
				}
				
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
				//echo $line."<br>";
				if (strlen($tmpCStyle) > 3) {
					//echo $tmpCStyle." has number<br>";
				}else{
					//echo $tmpCStyle." has NO number<br>";
					
					fputs($file, $line);
				}
			}
		}
	}
	fclose($file);
	echo "I created<br>";
}


//inv_tss();
?>

