<?php
ini_set ('display_errors', 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

date_default_timezone_set('America/Los_Angeles');
//set_time_limit(1600);
?>


<?php 

require_once ("includes/php/checkCookie.php"); 
include("includes/resource/db.php");

/************* DO NOT MODIFY **********************/
if (!$_GET["rangeA"]) {
	$range = date("m/d/Y");
} else {
	$range = $_GET["rangeA"];
}

if($lvl == "A") {$select_table = "invoice.SALES_NUM"; } 
else if ($lvl == "B") {$select_table = "invoice.SALES_NUM2"; } 



$baseDate 	= "12/28/1800";

/************* END OF DO NOT MODIFY **********************/

$linkID = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname, $linkID);

$mslinkID = mssql_connect($mshost, $msuser, $mspass) or die ('Error connecting to mssql');
mssql_select_db($msname, $mslinkID);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">

<title>Alegria Sales Center</title>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="includes/js/jquery-ui-1.7.1.custom.min.js" type="text/javascript"></script>
<script src="includes/js/daterangepicker.jQuery.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="includes/js/jquery.guid.js"></script>
<script language="javascript" type="text/javascript" src="includes/js/jquery.dotimeout.js"></script>
<script language="javascript" type="text/javascript" src="includes/js/jquery.shadowon.min.js"></script>

<script language="javascript" type="text/javascript" src="includes/js/thickbox.js"></script>

<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<link href="includes/css/ui.daterangepicker.css" rel="stylesheet" type="text/css"/>
<link href="includes/css/redmond/jquery-ui-1.7.1.custom.css" rel="stylesheet" type="text/css" title="ui-theme" />

<link href="http://www.autopromocenter.com/includes/css/thickbox.css" rel="stylesheet" type="text/css" media="screen" />

<?php
$jd = GregorianToJD(10, 11, 1801);
//echo "$jd\n<br>";
$gregorian = JDToGregorian($jd);
//echo "$gregorian\n<br>";
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
?>