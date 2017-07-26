<?php
/*header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=extraction.csv");
header("Pragma: no-cache");
header("Expires: 0");
*/


function update_db(){
	require("../includes/resource/db.php");
	
	set_time_limit(3600);

	
	
	
	
	
	
	
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	
	//$name = "benchmark/bm_inv.csv";
	//header
	//$line = "VendorUPC,QuantityAvailable,DateReported\r\n"; 
	//include PGL
	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";
	
	$inlinkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $inlinkID) or die("Could not find database1."); 
	
	
	$query = "truncate table $intable";
	
	
	mysql_query($query, $inlinkID);
	/* ************************************************************************ */
	/* ************** EOF Variables to change for each vendor ***************** */
	/* ************************************************************************ */
	
	
	
	//$file = fopen( $name, "w" );
	
	//$time = date("H_i_s");

	
	include("resource/connection.php");//connect to mssqls
	
	
	
	fputs($file, $line);
	
	while($row = mssql_fetch_array($result)){
		
		if (trim($row['CLASS_CD'], "ALG") > 7 and trim($row['CLASS_CD'], " ") != "ALG-Z1" and trim($row['CLASS_CD'], " ") != "AM%") {
						//loop through size 35 to 42
			for($x = 1; $x < 11 ; $x++){
				
				include("resource/size_new.php");
				
				include("resource/retailprice.php");
				
				include("resource/variables.php");
				
				include("resource/connection_upc.php");
				
				
				while($row1 = mssql_fetch_array($result1)){
				
					$tmpUPC		=trim($row1['UPC_CD']," ");

					//echo '<pre>'; echo $row['eta']; echo '</pre>';
					
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	

 					$tmpWholeSale = $tmpWholeSale -5;

					//content/data
					$query = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','".$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."')";
					
				//echo $query."<br/>";
					mysql_query($query, $inlinkID);
					//echo $data[0]." ".$data[60]." added<br/>";
			
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					////echo $line."<br>";
					//fputs($file, $line);
					
				}
			}

	}	elseif (trim($row['CLASS_CD'], " ") != "PGL" and trim($row['CLASS_CD'], " ") != "ALG-K" and trim($row['CLASS_CD'], " ") != "AM%"){

			//loop through size 35 to 42
			for($x = 1; $x < 12 ; $x++){
				
				include("resource/size.php");
				
				include("resource/retailprice.php");
				
				include("resource/variables.php");
				
				include("resource/connection_upc.php");
				
				
				while($row1 = mssql_fetch_array($result1)){
				
					$tmpUPC		=trim($row1['UPC_CD']," ");

					//echo '<pre>'; echo $row['eta']; echo '</pre>';
					
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	

 					$tmpWholeSale = $tmpWholeSale -5;

					//content/data
					$query = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','".$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."')";
					
				//echo $query."<br/>";
					mysql_query($query, $inlinkID);
					//echo $data[0]." ".$data[60]." added<br/>";
			
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					////echo $line."<br>";
					//fputs($file, $line);
					
				}
			}
		
		} elseif(trim($row['CLASS_CD'], " ") == "PGL"){
			
			/* *************************** PG LITE INVENTORY ************************** */	
			for($x = 1; $x < 16 ; $x++){
					
				include("resource/size_pgl.php");
					
				include("resource/retailprice.php");
				
				include("resource/variables.php");
				
				include("resource/connection_upc.php");
				
				
				while($row1 = mssql_fetch_array($result1)){
				
					$tmpUPC		=trim($row1['UPC_CD']," ");
				
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	
					
					//content/data
					//$line = $tmpUPC.",".$tmpStock.",".$today."\r\n"; //data
					
					$query = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','".$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '".$pID."', '".$tmpDis."', '".$row['eta']."')";
					
				//echo $query."<br/>";
					mysql_query($query, $inlinkID);
					
					
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					////echo $line."<br>";
					
				
				}
			}
			
		} elseif(trim($row['CLASS_CD'], " ") == "ALG-K"){
			
			/* *************************** Alegria Kids INVENTORY ************************** */	
			for($x = 1; $x < 8 ; $x++){
					
				include("resource/size_alg-k.php");
					
				include("resource/retailprice.php");
				
				include("resource/variables-k.php");
				
				include("resource/connection_upc.php");
				
				
				while($row1 = mssql_fetch_array($result1)){
				
					$tmpUPC		=trim($row1['UPC_CD']," ");
				
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	
					
					//content/data
					//$line = $tmpUPC.",".$tmpStock.",".$today."\r\n"; //data
					
					$query = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','".$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '".$pID."', '".$tmpDis."', '".$row['eta']."')";
					
				//echo $query."<br/>";
					mysql_query($query, $inlinkID);
					
					//echo $inlinkID."<br/>";
					
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					////echo $line."<br>";
					
				
				}
			}
			
		} elseif(trim($row['CLASS_CD'], " ") == "AM%"){
			
			/* *************************** ALEGRIA MEN INVENTORY ************************** */	
			for($x = 1; $x < 10 ; $x++){
					
				include("resource/siza_am-men.php");
					
				include("resource/retailprice.php");
				
				include("resource/variables.php");
				
				include("resource/connection_upc.php");
				
				
				while($row1 = mssql_fetch_array($result1)){
				
					$tmpUPC		=trim($row1['UPC_CD']," ");
				
			/* ************************************************************************ */
			/* ***************** Variables to change for each vendor ****************** */
			/* ************************************************************************ */	
					
					//content/data
					//$line = $tmpUPC.",".$tmpStock.",".$today."\r\n"; //data
					
					$query = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','".$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '".$pID."', '".$tmpDis."', '".$row['eta']."')";
					
				//echo $query."<br/>";
					mysql_query($query, $inlinkID);
					//echo $inlinkID."<br/>";
					
			/* ************************************************************************ */
			/* ************** EOF Variables to change for each vendor ***************** */
			/* ************************************************************************ */
					//echo $line."<br>";
					
				
				}
			}			
		}			
					
		
		
	}
	//fclose($file);
	echo "DB created<br>";
}


//update_db();
?>

