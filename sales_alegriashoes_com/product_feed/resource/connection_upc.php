<?

	$query1 = "SELECT * FROM prod_upc WHERE PROD_CD = '$tmpItemNo' AND SIZE_NUM = '$tmpSize'";
	$result1 = mssql_query($query1, $linkID) or die("Data not found. upc"); 

?>