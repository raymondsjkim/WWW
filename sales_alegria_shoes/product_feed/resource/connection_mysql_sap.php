<?php
	if($company == "PGL"){
		$condition = " OR class = 'PGL'";
	} elseif($company == "ALG") {
		$condition = " OR class = 'ALG-Z1'";
		//$condition = " OR inv_data.CLASS_CD = 'ALG-Z1'";
	} else {
		$condition = "";
	}
	

	$linkID = mysql_connect($inhost, $inuser, $inpass) or die ('Error connecting to mysql');
	mysql_select_db($indatabase, $linkID);
	
	if(isset($newproducts)){
		$query = "SELECT * FROM $intable WHERE class = 'ALG4' ORDER BY itemNo ASC";

	} else {
	
		$query = "SELECT * FROM $intable WHERE class !='Closeout' AND class !='Exclusive/Special Order' AND upc != '' ORDER BY itemNo ASC";
	}
	$result = mysql_query($query, $linkID) or die("Data not found. 1st"); 
	
	

?>