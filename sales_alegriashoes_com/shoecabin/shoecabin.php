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
echo "Welcome to <b>Alegria Shoecabin-Shopify Utilities</b>! Follow the workflow below to convert Shopify orders csv to OMS Yahoo import.";
echo "<br /><br />";
echo "<i><small>*right click and select 'Save As...' to save file links!</small></i>";
echo "<br /><br />";
echo "<br /><br />";


/*************CREATE INVENTORY FILE*************/
echo "<i>Step 1: Update Inventory onto Shopify</i>";
echo "<br /><br />";
$inv_file = "../product_feed/alegriashoes_com/alegriashoesinv_nolimit.csv";
// $alegria_inventory = fopen($inv_file, "w");
// while ($row = mysql_fetch_assoc($result)) {
// 	include("../product_feed/resource/variables_mysql.php");
// 	include("./selectedshoes.php");
	
// 	if ($tmpStock > 0) {
// 		$available = "Yes";
// 		}
// 	else {
// 		$available = "No";
// 		}

// 	$line = "IN|"."0".$tmpUpc."|".$available."|".$tmpStock."|||Alegria|".$tmpItemNo."_".$tmpSize."|".$tmpColor."|".$tmpWholeSale."||||||||BELK|\r\n";

// 	foreach ($selectedShoes as $value) {
// 		if ($value == $tmpItemNo) {
// 			fputs($alegria_inventory, $line);
// 		}
// 	}
// }
// fclose($alegria_inventory);

echo "Alegria Shopify inventory created! Download here: <a href='".$inv_file."' download>Inventory for ".$date."</a>";
echo "<br /><br />";
echo "<br /><br />";
/************FIN INVENTORY FILE*****************/



/***********CONVERTER**************/
echo "<i>Step 2: Convert Shopify orders CSV for OMS import</i>";
echo "<br /><br />";
echo "Download todays Orders csv export from Shopify and choose that file to upload below, then click the 'Convert' button";
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




echo "</html>";
echo "</body>";
?>