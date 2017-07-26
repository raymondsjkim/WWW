<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	// User-Modifications Go Here
	$directory = "orders/";
	$orders_oms = "orders_oms/";
	$algdate = date("m/d/y");
	$date = date("m-d-y");
	$alegria_file_path = $orders_oms."shoebuy_oms_".$date.".csv";
	$debug = false;
	// Include Database Credentials
	include "../includes/resource/db.php";
	
	// Connect to Database
	$db_connection = mysql_connect($inhost, $inuser, $inpass);
	if ($db_connection) {
		$db_select_connection = mysql_select_db($indatabase, $db_connection);
		if (!$db_select_connection) {
			die ("Could not select database.");
		}
	}
	else {
		die ("Could not connect to MySQL.");
	}
	
	// Scan Orders Directory and create OMS doc

	$alegria_file = fopen($alegria_file_path, "w");
	$files = scandir($directory);

	$header = "S/O No.,S/O Date,Customer ID,Ship To,Shipping Address,Shipping Address Line 2,Shipping City,Shipping State,Shipping Zip,UPC,Order Qty\r\n";
	fputs($alegria_file, $header);

	foreach ($files as $file) {
		$info = pathinfo($file);

		if (!isset($info['extension']) OR $info['extension'] != "txt") {
			continue;
		}
		else {

			$contents = file_get_contents($directory.$file);
			$lines = explode("\r\n", $contents);
			// echo "<pre>";
			// print_r($lines);
			// echo "</pre>";
			foreach ($lines as $line) {
				$order_info = explode("|", $line);
				
				echo "<pre>";
				print_r($order_info);
				echo "</pre>";
				if (isset($order_info['1'])) {
					$csv_line = $order_info['0'].",".$algdate.",A3314,".$order_info['6'].",".$order_info['7'].",".$order_info['8'].",".$order_info['9'].",".$order_info['10'].",".$order_info['11'].",".$order_info['17'].",".$order_info['15']."\r\n";
					fputs($alegria_file, $csv_line);
				}
			}

		}
	rename("orders/".$file, "orders/archive/bkup_".$file);
	}
	fclose($alegria_file);	
?>