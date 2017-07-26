<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $httpURL ?>includes/js/jquery.validate.pack.js" type="text/javascript"></script>
</head>
<body>

<?php
include("includes/resource/db.php");



function daysDifference($d1, $d2)
{
   //explode the date by "-" and storing to array
   $date_parts1=explode("/", $d1);
   $date_parts2=explode("/", $d2);
   //gregoriantojd() Converts a Gregorian date to Julian Day Count
   $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
   $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
   return $end_date - $start_date;
   
}

$baseDate 	= "12/28/1800";

$endDate 	= daysDifference($baseDate, date("m/d/Y"));
$beginDate 	= $endDate - 366;

echo $beginDate."<br>";
echo $endDate."<br>";

$selTable 	= $_GET["table"];




$linkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mysql');
mssql_select_db($msname, $linkID);

$query_invoice 	= "SELECT *"
				." FROM invoice"
				." WHERE invoice.INVS_DT BETWEEN $beginDate AND $endDate" 
				." AND invoice.INVS_CD = '1'";

$result_invoice	= mssql_query($query_invoice, $linkID) or die("Data not found. invoice"); 


//$invArray = array();
$dayArray = array();
while($row = mssql_fetch_array($result_invoice)){

	//array_push($invArray, $row['INVS_NUM']);
	
	$tmpArray = array();
	// array: month of the day of sale, subtotal of sale of that day. 
	array_push($tmpArray, $row['INVS_DT'], $row['INVS_NUM'], $row['CUS_ID'], $row['INVS_AMT'], $row['INVS_CD'], $row['SALES_NUM'], $row['CUS_NM']);
	
	array_push($dayArray, $tmpArray);
}

print_r ($dayArray);
?>
<!-- iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Falegriashoes&amp;width=235&amp;connections=3&amp;stream=true&amp;header=false&amp;height=555" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:235px; height:479px; border-bottom:1px solid #666;background:#FFF;color:#FFF;" allowTransparency="true"></iframe -->

</body></html>