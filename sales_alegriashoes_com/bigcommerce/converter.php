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
echo "Welcome to <b>Alegria BigCommerce Utilities</b>! Follow the workflow below for BigCommerce related necessities.";
echo "<br /><br />";
echo "<br /><br />";

/***********CONVERTER**************/
echo "1. <i>Convert BigCommerce CSV order for OMS import to Peppergate (NOT Shoecabin!)</i>";
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
echo "</html>";
echo "</body>";
?>