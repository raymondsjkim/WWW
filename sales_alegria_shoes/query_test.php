<?php
require("includes/resource/db.php");
set_time_limit(720);
include("product_feed/resource/connection_mysql.php");
// $query = "SELECT itemNo, color from $intable WHERE $condition upc != '' and discontinue != '1' group by itemNo order by itemNo ASC";
// $result = mysql_query($query, $linkID) or die("Data not found. 1st"); 

// while ($row = mysql_fetch_assoc($result)) {
// 	echo '<pre>'; print_r( $row); echo '</pre>';
// }

	// $tmpItemNo = "ALG-ALL-572";

	// //get stock number
	// $querystock = "SELECT size as stock_size, itemNo as stock_itemNo, inStock as stock_inStock from $intable WHERE $condition upc != '' and discontinue != '1' and itemNo like '$tmpItemNo' order by itemNo asc";
	// $resultstock = mysql_query($querystock, $linkID) or die("Data not found. QueryStock");
	// $stock_qty = array();

	// while ($rowstock = mysql_fetch_assoc($resultstock)) {

	// 	if ($rowstock['stock_size'] == '34')	{
	// 	array_push($stock_qty, array($rowstock['stock_size'] => $rowstock['stock_inStock']));
	// 	}

	// 	else{
	// 	for ($i=35; $i < 48; $i++) { 
	// 		if ($i == 35) {
	// 		array_push($stock_qty, array('34' => '0'));
	// 		}

	// 		if ($rowstock['stock_size'] == $i) {
	// 			array_push($stock_qty, array($rowstock['stock_size'] => $rowstock['stock_inStock']));
	// 		}}
	// 	}
	// }


	// echo '<pre>'; print_r($stock_qty); echo '</pre>';

	// echo $stock_qty['0']['34'];
 
$query = "SELECT * FROM $inaccount WHERE USR = '$username'";
$resultID = mysql_query($query, $linkID) or die("Data not found."); 

while ($info = mysql_fetch_array($resultID)) {
	echo "<pre>";
	print_r($info);
	echo "</pre>";
}

?>