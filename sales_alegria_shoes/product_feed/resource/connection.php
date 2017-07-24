<?php
/*	if($company == "PGL"){
		$condition = " ";
	} elseif($company == "ALG") {
		$condition = " ";
		//$condition = " OR inv_data.CLASS_CD = 'ALG-Z1'";
	} else {
		$condition = "";
	}*/
	

	$linkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mssql');
	mssql_select_db($msname, $linkID);
	
	$query = "SELECT *,
	(SELECT MIN(dateadd(day, p.EST_DT, '18001228')) from plog as p where p.prod_cd = inv_data.prod_cd and dateadd(day, p.EST_DT, '18001228') > getdate() group by p.PROD_CD) as 'eta'
	FROM inv JOIN inv_data 
	ON inv.PROD_CD = inv_data.PROD_CD AND inv.ACTIVE = 'Y' 
	WHERE inv_data.WHS_NUM = '01'
	AND (inv_data.CLASS_CD = 'ALG'
	OR inv_data.CLASS_CD = 'ALG1' 
	OR inv_data.CLASS_CD = 'ALG2' 
	OR inv_data.CLASS_CD = 'ALG3' 
	OR inv_data.CLASS_CD = 'ALG4' 
	OR inv_data.CLASS_CD = 'ALG5' 
	OR inv_data.CLASS_CD = 'ALG6' 
	OR inv_data.CLASS_CD = 'ALG7' 
	OR inv_data.CLASS_CD = 'ALG8' 
	OR inv_data.CLASS_CD = 'ALG9' 
	OR inv_data.CLASS_CD = 'ALG10' 
	OR inv_data.CLASS_CD = 'ALG11' 
	OR inv_data.CLASS_CD = 'ALG12' 
	OR inv_data.CLASS_CD = 'ALG13' 
	OR inv_data.CLASS_CD = 'ALG14' 
	OR inv_data.CLASS_CD = 'ALG15' 
	OR inv_data.CLASS_CD = 'ALG16' 
	OR inv_data.CLASS_CD = 'ALGUS' 
	OR inv_data.CLASS_CD = 'ALG-Z1' 
	OR inv_data.CLASS_CD = 'ALG-K' 
	OR inv_data.CLASS_CD = 'AM' 
	OR inv_data.CLASS_CD = 'AM1' 
	OR inv_data.CLASS_CD = 'AM2' 
	OR inv_data.CLASS_CD = 'AM3' 
	OR inv_data.CLASS_CD = 'AM4' 
	OR inv_data.CLASS_CD = 'AM5' 
	OR inv_data.CLASS_CD = 'AM6' 
	OR inv_data.CLASS_CD = 'PGL') 
	ORDER BY inv_data.PROD_CD ASC";
	$result = mssql_query($query, $linkID) or die("Data not found. 1st"); 
	
	//echo $query;

?>