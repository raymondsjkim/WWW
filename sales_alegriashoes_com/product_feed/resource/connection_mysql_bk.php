<?php
	if($company == "PGL"){
		$condition = "class ='PGL' AND"; //if PGL is the company, show only PGL styles
	} elseif($company == "ALG") {
		$condition = "class !='PGL' AND"; // if ALG is the company, show everything including closeouts, except PGL styles.
		//$condition = " OR inv_data.CLASS_CD = 'ALG-Z1'";
	} else {
		$condition = "class !='ALG-Z1' AND class !='PGL' AND";// if no company is defined, show everything except clostouts and PGL styles.
	}
	

	$linkID = mysql_connect($inhost, $inuser, $inpass) or die ('Error connecting to mysql');
	mysql_select_db($indatabase, $linkID);
	
	if(isset($newproducts)){
		$query = "SELECT * FROM $intable WHERE class = 'ALG4' ORDER BY itemNo ASC";

	} else {
	
		//SAP $query = "SELECT * FROM $intable WHERE class !='Closeout' AND class !='Exclusive/Special Order' AND upc != '' ORDER BY itemNo ASC";
		$query = "SELECT * FROM $intable WHERE $condition upc != '' ORDER BY itemNo ASC";
	}
	$result = mysql_query($query, $linkID) or die("Data not found. 1st"); 
	
	

?>