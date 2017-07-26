<?php

function update_db(){
	require("../includes/resource/db.php");
	
	set_time_limit(3600);

	$company = "ALG";
	$today = date("Ymd");
	$replenishmentdate = "";

	$inlinkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $inlinkID) or die("Could not find database1."); 
	
	$query = "truncate table $intable";
	mysql_query($query, $inlinkID);

	$alegriamens = array('AM',
						'AM1',
						'AM2',
						'AM3',
						'AM4',
						'AM5',
						'AM6',
						'AM7',
						'AM8',
						'AM9',
						'AM10',
						'AM11',
						'AM12',
						'AM13',
						'AM14',
						'AM15');

	include("resource/connection.php");//connect to mssqls
	
	fputs($file, $line);
	
	while($row = mssql_fetch_array($result)){
		if (strpos(trim($row['CLASS_CD'], " "), "US") !== FALSE) {
			/* *************************** Alegria inventory for US Sizing ************************** */
			//loop through size 34 to 43
			for($x = 1; $x < 13 ; $x++){
				include("resource/size_usa_women.php");
				include("resource/variables.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}
		} elseif (trim($row['CLASS_CD'], "ALG") > 7 and trim($row['CLASS_CD'], " ") != "ALG-Z1" and !in_array(trim($row['CLASS_CD']), $alegriamens) ) {
			/* *************************** Alegria inventory for new Sizing ************************** */
			//loop through size 34 to 43
			for($x = 1; $x < 11 ; $x++){
				include("resource/size_new.php");
				include("resource/variables.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}

		} elseif (trim($row['CLASS_CD'], " ") != "PGL" and trim($row['CLASS_CD'], " ") != "ALG-K" and !in_array(trim($row['CLASS_CD']), $alegriamens) ){
			/* *************************** Alegria inventory for old Sizing ************************** */
			//loop through size 35 to 42
			for($x = 1; $x < 12 ; $x++){
				include("resource/size.php");
				include("resource/variables.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}
		
		} elseif(trim($row['CLASS_CD'], " ") == "PGL"){
			/* *************************** PG LITE INVENTORY ************************** */	
			for($x = 1; $x < 16 ; $x++){
				include("resource/size_pgl.php");
				include("resource/variables.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}

		} elseif(trim($row['CLASS_CD'], " ") == "ALG-K"){
			/* *************************** Alegria Kids INVENTORY ************************** */	
			for($x = 1; $x < 8 ; $x++){
				include("resource/size_alg-k.php");
				include("resource/variables-k.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}
			
		} elseif(in_array(trim($row['CLASS_CD']), $alegriamens)){
			/* *************************** ALEGRIA MEN INVENTORY ************************** */	
			for($x = 1; $x < 10 ; $x++){
				include("resource/siza_am-men.php");
				include("resource/variables.php");
				include("resource/connection_upc.php");
				while($row1 = mssql_fetch_array($result1)){
					$tmpUPC	= trim($row1['UPC_CD']," ");
					$replaceQuery = "REPLACE INTO $intable VALUES ('','".$tmpItemNo."','".trim($row['CLASS_CD'], ' ')."','".trim($row['DESCRIP'], ' ')."','"
								.$tmpSize."','".$tmpUPC."', '".$tmpStock."', '".$tmpWholeSale."', '".$tmpRetail."', '', '".$tmpDis."', '".$row['eta']."','"
								.$tmpSeason."')";
					if ($tmpSeason != "EXCLUSIV") {
						mysql_query($replaceQuery, $inlinkID);
					}
				}
			}			
		}					
	}
	echo "DB created<br>";
}
?>

