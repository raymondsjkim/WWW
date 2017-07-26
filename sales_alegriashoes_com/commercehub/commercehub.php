<?php
echo "<html>";
echo "<body>";

error_reporting(E_ALL);
ini_set("display_errors", 1);

//set global variables
require("../includes/resource/db.php");
set_time_limit(720);
$company = "ALG";
$replenishmentdate = "";
include("../product_feed/resource/connection_mysql.php");
$date = date("y_m_d");

//WELCOME MESSAGE
echo "<br /><br />";
echo "Welcome to <b>Alegria CommerceHub Utilities</b>! Follow the workflow below for Belk CommerceHub related necessities.";
echo "<br /><br />";
echo "<i><small>*right click and select 'Save As...' to save file links!</small></i>";
echo "<br /><br />";
echo "<br /><br />";


/*************CREATE INVENTORY FILE*************/
echo "<i>Step 1: Update Inventory onto CommerceHub.com</i>";
echo "<br /><br />";
$inv_file = "./inventory/inv_commercehub_".$date.".csv";
$alegria_inventory = fopen($inv_file, "w");
while ($row = mysql_fetch_assoc($result)) {
	include("../product_feed/resource/variables_mysql.php");
	include("./selectedshoes.php");
	
	if ($tmpStock > 0) {
		$available = "Yes";
		}
	else {
		$available = "No";
		}

	$line = "IN|"."0".$tmpUpc."|".$available."|".$tmpStock."|||Alegria|".$tmpItemNo."_".$tmpSize."|".$tmpColor."|".$tmpWholeSale."||||||||BELK|\r\n";

	foreach ($selectedShoes as $value) {
		if ($value == $tmpItemNo) {
			fputs($alegria_inventory, $line);
		}
	}
}
fclose($alegria_inventory);

echo "Alegria CommerceHub inventory created! Download here: <a href='".$inv_file."'>Inventory for ".$date."</a>";
echo "<br /><br />";
echo "<br /><br />";
/************FIN INVENTORY FILE*****************/



/***********CONVERTER**************/
echo "<i>Step 2: Convert Belk CommerceHub CSV order for OMS import</i>";
echo "<br /><br />";
?>
<!-- Uploader for CommerceHub CSV  -->
		<form enctype="multipart/form-data" action="convert_oms.php" method="POST" target="DoSubmit" 
			onsubmit="DoSubmit = window.open('about:blank','DoSubmit','width=400,height=350');">
			
			<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
				Choose a File to Upload: <input name="uploaded_file" type="file" /><br />
			<input type="submit" value="Convert File" />

		</form>
<!-- End Uploader for CommerceHub CSV -->
<?
echo "<br /><br />";
echo "<br /><br />";
/***********END CONVERTER***********/




/************CREATE SHIPPING CONFIRM***************/
// echo "<i>Step 3: Upload Shipping Confirmation to CommerceHub</i>";
// echo "<br /><br />";
// $transaction_date = date("Ymd");
// $ship_path = "ship_confirm/confirmations/ship_confirm_".$date.".csv";
// $ship_file = fopen($ship_path, "w");

/***CREATE VARIABLES AND ARRAY FROM COMMERCEHUB ORDER***/
// $index = -1;
// $itemnum = 0;
// $order_array = array();
// $file = file_get_contents($newname);

// $lines = explode("\n", "$file");
// array_pop($lines);

// foreach ($lines as $line) {
// if (substr($line, 3, 1) == "P") {
//   $index ++;
//   $itemnum = 0;
//   $type = "header";
// }
// elseif (substr($line, 3, 1) == "O") {
//   $type = "item".$itemnum;
//   $itemnum ++;
// }
// $order_array['order'.$index][$type] = explode("|", $line);
// }
// /**************VARIABLES CREATED***********************/

// foreach ($order_array as $line => $value) {
// 	//PEPPERGATE VARIALBES
// 	$so_num = "";


// 	// HEADER VARIABLES
// 	$transactionID = $value['header']['2'];
// 	$merchantID = $value['header']['3'];

// 	$ship_header = "OS|CS||".$merchantID."|".$so_num."|".$transaction_date."|Belk||||||||||||5||||||||||\r\n";
// 	fputs($ship_file, $ship_header);
	
// 	// MESSAGE VARIABLES 
// 	/*number of "messages" within a header*/
// 	$itemnum = "0";
// 	$item_count = (count($value) - 1);

// 	while ($itemnum < $item_count) {
// 		$merchantLineItem = $value['item'.$itemnum]['5'];
// 		$upc = $value['item'.$itemnum]['10'];
// 		$quantity = $value['item'.$itemnum]['26'];
// 		$cost = $value['item'.$itemnum]['33'];

// 		$ship_message = "OS|CD||".$merchantLineItem."||".$upc."|".$quantity."|v_ship|||".$cost."|||||||||||\r\n";
// 		fputs($ship_file, $ship_message);

// 		$itemnum ++;
// 	}

// 	// PACKAGE DETAIL VARIABLES
// 	$ship_code = "FXSP";
// 	$tracking_number = "";

// 	$ship_package = "OS|PD|".$ship_code."|".$transaction_date."|".$tracking_number."|||||||||||||||||||||||||||||||||||||||\r\n";
// 	fputs($ship_file, $ship_package);


// }


// fclose($ship_file);
// echo "Alegria CommerceHub Shipping Confirmation file created! Download here: <a href='".$ship_path."'>Shipping Confirm for ".$date."</a>";
// echo "<br /><br />";
// echo "<br /><br />";
/**************FINISH SHIPPING CONFIRM***************/


echo "</html>";
echo "</body>";
?>