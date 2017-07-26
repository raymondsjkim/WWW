<?php

	error_reporting(E_ALL);
	ini_set("display_errors", "1");
	
	// User-Modifications Go Here
	$directory = "life_uniform/orders/";
	$subject = "Life Uniform Quick Ship";
	$to = "wilson@peppergate.com, andrew@peppergate.com, faviola@peppergate.com";
	$debug = false;

	// Include Database Credentials
	include "includes/resource/db.php";
	
	// Connect to Database
	$db_connection = mysql_connect($inhost, $inuser, $inpass);
	if ($db_connection) :
		$db_select_connection = mysql_select_db($indatabase, $db_connection);
		if (!$db_select_connection) :
			die ("Could not select database.");
		endif;
	else :
		die ("Could not connect to MySQL.");
	endif;
	
	// Scan Orders Directory
	$files = scandir($directory);

	// Process Files and Organize into Variables
	foreach ($files as $file) :
		$info = pathinfo($file);
		if (!isset($info['extension']) OR $info['extension'] != "OUT") :
			continue;
		else :
			$contents = file_get_contents($directory.$file);
			$lines = preg_split('/\r\n|\r|\n/', $contents);
			$curr_line = 0;
			// name variable for acknowledgement file
			$ack_filename = $info['basename'];
			// echo "<pre>"; print_r($lines); echo "</pre>";
			foreach ($lines as $line) :
				if (!empty($line)) :
					$line = str_replace("~", "", $line);
					$final_lines[$file][$curr_line]['line'] = $line;
					$items = explode("*", $line);
					foreach ($items as $item) :
						if (!empty($item)) :
							$final_lines[$file][$curr_line]['items'][] = $item;
						endif;
					endforeach;
				endif;
				$curr_line++;
			endforeach;
		endif;
	endforeach;

	// Process Variables, Grab Associated Variables
	if (!empty($final_lines)) :
		foreach ($final_lines as $name => $file) :
			$detail = 0;
			foreach ($file as $line) :
				echo "<pre>"; print_r($line); echo "</pre>";
				//print_r($line['items']['0']);
				switch ($line['items']['0']) :
					// Header line
					case "H" :
						$results[$name]['date'] = $line['items']['1'];
						$results[$name]['po_number'] = $line['items']['2'];
						$results[$name]['vendor_number'] = $line['items']['3'];
					break; 
					// Invoice Info
					case "I" :
						$results[$name]['account'] = $line['items']['1'];
						$results[$name]['billing_address1'] = $line['items']['2'];
						$results[$name]['billing_address2'] = $line['items']['3'];
						$results[$name]['billing_city'] = $line['items']['4'];
						$results[$name]['billing_state'] = $line['items']['5'];
						$results[$name]['billing_zip_code'] = $line['items']['6'];
					break;
					// Ship to
					case "S" :
						$results[$name]['shipping_address1'] = $line['items']['1'];
						$results[$name]['shipping_address2'] = $line['items']['2'];
						$results[$name]['shipping_city'] = $line['items']['3'];
						$results[$name]['shipping_state'] = $line['items']['4'];
						$results[$name]['shipping_zip_code'] = $line['items']['5'];
					break;
					// Detail (account for mutiple detail lines)
					case "D" :
						$results[$name]['orders'][$detail]['po1_quantity'] = $line['items']['1'];
						$results[$name]['orders'][$detail]['po1_cost'] = $line['items']['2'];
						$results[$name]['orders'][$detail]['po1_upc'] = $line['items']['3'];
						$detail++;
					break;  
				endswitch;
				echo "<pre>"; print_r($results); echo "</pre>";
			endforeach;


			//rename($directory.$name, $directory."archive/".$name);
			//echo "<pre>"; echo "Moving ".$name." to ".$directory."archives."; echo "</pre>";
		endforeach;
		// echo "<pre>"; print_r($results); echo "</pre>";
	else :
		echo "<pre>Nothing to process, exiting.</pre>";
	endif;

echo $ack_filename;


	// Mail Results 
	
	foreach ($results as $result) :

		$orders_print = '';
		echo "<pre>"; print_r($result['orders']); echo "</pre>";

		foreach ($result['orders'] as $order) :

			//echo "<pre>"; print_r($order['po1_upc']); echo "</pre>";

		// Change UPC to itemNo, size
		$upc = $order['po1_upc'];
		$query = mysql_query("SELECT itemNo, size FROM alg_inventory WHERE upc = '$upc'");
		$result_upc = mysql_fetch_array($query);
		// echo $result_upc['itemNo']." - Size: ".$result_upc['size'];
		// echo "<pre>"; print_r($result_upc); echo "</pre>";
			$orders_print .= '<tr>';
			$orders_print .= '<td>'.$order['po1_quantity'].'</td>';
			$orders_print .= '<td>'.$result_upc['itemNo'].'</td>';	
			$orders_print .= '<td>'.$result_upc['size'].'</td>';
			$orders_print .= '<td>'.$order['po1_cost'].'</td>';
			$orders_print .= '</tr>';
			echo "<pre>"; print_r($orders_print); echo "</pre>";
		endforeach;

		$headers = "From: edi_pull@sales.alegriashoes.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<p><h1>Life Uniform QuickShip</h1></p>';
		$message .= '<p>*** SHIP VIA 2-DAY DELIVERY! ***</p>';

		$message .= '<table width="300" border="0" cellpadding="5">';
			$message .= '<tr>';
			$message .= '<td><b>Date</b></td>';
			$message .= '<td>'.date("m/j/Y", strtotime($result['date'])).'</td>';
			$message .= '</tr>';

			$message .= '<tr>';
			$message .= '<td><b>PO Number</b></td>';
			$message .= '<td>'.$result['po_number'].'</td>';
			$message .= '</tr>';

			$message .= '<tr>';
			$message .= '<td><b>Vendor Number</b></td>';
			$message .= '<td>'.$result['vendor_number'].'</td>';
			$message .= '</tr>';
		$message .= '</table>';
		
		$message .= '<table width="500" border="0" cellpadding="5">';
				$message .= '<tr>';
				$message .= '<td><b>Account</b></td>';
				$message .= '<td>'.$result['account'].'</td>';
				$message .= '</tr>';

				$message .= '<tr>';
				$message .= '<td><b>Billing Address</b></td>';
				$message .= '<td>'.$result['billing_address1'].'<br>'.$result['billing_address2'].'<br>'.$result['billing_city']." ".$result['billing_state'].", ".$result['billing_zip_code'].'</td>';
				$message .= '</tr>';
		$message .= '</table>';

		$message .= '<table width="500" border="0" cellpadding="5">';
			$message .= '<tr>';
			$message .= '<td><b>Shipping Address</b></td>';
			$message .= '<td>'.$result['shipping_address1'].'<br>'.$result['shipping_address2'].'<br>'.$result['shipping_city']." ".$result['shipping_state'].", ".$result['shipping_zip_code'].'</td>';
			$message .= '</tr>';
		$message .= '</table>';

		$message .= '<table width="400" border="1" cellpadding="5">';
			$message .= '<tr>';
			$message .= '<td><b>QTY</b></td>';
			$message .= '<td><b>ItemNo</b></td>';
			$message .= '<td><b>Size</b></td>';
			$message .= '<td><b>Cost</b></td>';
			$message .= '</tr>';
			$message .= $orders_print;
		$message .= '</table>';

		
		echo "<pre>"; echo"$headers"; echo "</pre>";
		echo "<pre>"; print_r($message); echo "</pre>";

		
		if ($debug) :
			$message .= '<pre>DEBUG INFORMATION:</pre>';
			$message .= '<pre>'.print_r($result, 1).'</pre>';
		endif;

		mail ($to, $subject." ".$result['po_number'], $message, $headers);
		

	endforeach;

// Create ackowledgement file
$filename = "ACKNOWLEDGEMENT~.csv";
// Replace ~ with PO number
$filename = str_replace("~", $result['po_number'], $filename);
// echo "<pre>"; print_r($filename); echo "</pre>";

// Create the .csv file
$acknowledgement = fopen($filename, 'w');

// Create array for CSV input
$time = date('n/j/y g:i A');
$filesize = filesize("life_uniform/orders/".$ack_filename);
$list = array(
	array($ack_filename, $time, $filesize)
	);

// print_r($list);

// Array does not include "" text qualifier, gets created in fputcsv.
foreach ($list as $fields) {
	fputcsv($acknowledgement, $fields,',',' ');
}

// Any idea how to get rid of the qualifier?

fclose($acknowledgement);

// Move file in UNIX shell
echo $ack_filename;

exec("mv ./life_uniform/orders/".$ack_filename." ./life_uniform/orders/archive/");
exec("mv ".$filename." ./life_uniform/acknowledgements/")
?>