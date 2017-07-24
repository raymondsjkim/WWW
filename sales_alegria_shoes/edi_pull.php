<?php

	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	// User-Modifications Go Here
	$directory = "uniform_edi/orders/";
	$basedir = "uniform_edi/";
	$subject = "Uniform Solution Order";
	$to = "andrew@peppergate.com, faviola@peppergate.com";
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

	function multiexplode ($delimiters,$string) {
	    $ready = str_replace($delimiters, $delimiters[0], $string);
	    $launch = explode($delimiters[0], $ready);
	    return  $launch;
	}
		
	// Process Files and Organize into Variables
	foreach ($files as $file) :
		$info = pathinfo($file);

		if (!isset($info['extension']) OR $info['extension'] != "txt") :
			continue;
		else :


			$contents = file_get_contents($directory.$file);
			$lines = preg_split('/\r\n|\r|\n/', $contents);
			$curr_line = 0;
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

		// Create ack file

		$filename = str_replace('.txt', '_ack.txt', $info['basename']);
		$filename_ponumber = multiexplode(array("_", "."), $info['basename']);
		$filename_ponumber = $filename_ponumber[2];

		$acknowledgement = fopen($filename, 'w');
		$line = "V1.0,".$filename_ponumber.",A,,,".date("m/d/y").",,";
		fputs($acknowledgement, $line);

		fclose($acknowledgement);
		rename($filename, $basedir.'acknowledge/'.$filename);
		
		endif;
	endforeach;
		
	// Process Variables, Grab Associated Variables
	if (!empty($final_lines)) :
		foreach ($final_lines as $name => $file) :
			$po1_count = 0;
			foreach ($file as $line) :
				//echo "<pre>"; print_r($line); echo "</pre>";
				switch ($line['items']['0']) :
					case "BEG" :
						$results[$name]['po_release'] = $line['items']['2'];
						$results[$name]['po_number'] = $line['items']['3'];
						if (is_numeric($line['items']['4'])) :
							$results[$name]['po_date'] = $line['items']['4'];
						elseif (is_numeric($line['items']['5'])) :
							$results[$name]['po_date'] = $line['items']['5'];
						endif;
					break;
					case "DTM" :
						if ($line['items']['1'] == "010") :
							$results[$name]['start_ship_date'] = $line['items']['2'];
						elseif ($line['items']['1'] == "001") :
							$results[$name]['cancel_date'] = $line['items']['2'];
						endif;
					break;
					case "N1" :
						if ($line['items']['1'] == "BT") :
							$results[$name]['bt_acctno'] = $line['items']['2'];
							if (isset($line['items']['4'])) :
								$results[$name]['bt_store'] = $line['items']['4'];
							endif;
						elseif ($line['items']['1'] == "ST") :
							$results[$name]['st_name'] = $line['items']['2'];
							if (isset($line['items']['3']) AND $line['items']['3'] == "92") :
								$results[$name]['st_storeno'] = $line['items']['4'];
							endif;
						endif;
					break;
					case "TD5" :
						$results[$name]['td5_ship_method'] = $line['items']['2'];
					break;
					case "REF" :
						if ($line['items']['1'] == "PD") :
							$results[$name]['pd_promo_code'] = $line['items']['2'];
						endif;
					break;
					case "PO1" :
						$results[$name]['orders'][$po1_count]['po1_line_itemno'] = $line['items']['1'];
						$results[$name]['orders'][$po1_count]['po1_quantity'] = $line['items']['2'];
						if ($line['items']['4'] == "UP") :
							$results[$name]['orders'][$po1_count]['po1_upc_number'] = $line['items']['5'];
							$query = "SELECT itemNO FROM alg_inventory WHERE upc = '".mysql_real_escape_string($line['items']['5'])."'";
							$data = mysql_query($query);
							if (mysql_num_rows($data) > 0) :
								$results[$name]['orders'][$po1_count]['po1_sku_number'] = mysql_result($data, 0, "itemNO");
							endif;
						endif;
						$po1_count++;
					break;
					case "CTT" :
						$results[$name]['ctt_total_line_items'] = $line['items']['1'];
						$results[$name]['ctt_total_quantity'] = $line['items']['2'];
					break;
					case "N2" :
						$results[$name]['st_name2'] = $line['items']['1'];
					break;
					case "N3" :
						$results[$name]['drop_ship_addr1'] = $line['items']['1'];
						if (isset($line['items']['2'])) :
							$results[$name]['drop_ship_addr2'] = $line['items']['2'];
						endif;
					break;
					case "N4" :
						$results[$name]['drop_ship_city'] = $line['items']['1'];
						$results[$name]['drop_ship_state'] = $line['items']['2'];
						$results[$name]['drop_ship_postal_code'] = $line['items']['3'];
					break;
				endswitch;
			endforeach;
			rename($directory.$name, $directory."archive/".$name);
			// echo "<pre>"; echo "Moving ".$name." to ".$directory."archives."; echo "</pre>";
		endforeach;
		echo "<pre>"; print_r($results); echo "</pre>";
	else :
		// echo "<pre>Nothing to process, exiting.</pre>";
	endif;
	
	// Mail Results
	foreach ($results as $result) :
		if (empty($result['st_name'])) :
			$result['st_name'] = "N/A";
		endif;
		if (empty($result['drop_ship_addr1'])) :
			$result['drop_ship_addr1'] = "N/A";
		endif;
		if (empty($result['start_ship_date'])) :
			$result['start_ship_date'] = "N/A";
		endif;
		if (empty($result['cancel_date'])) :
			$result['cancel_date'] = "N/A";
		endif;
		$orders_print = '';
		foreach ($result['orders'] as $order) :

		// Change UPC to itemNo, size
		$upc = $order['po1_upc_number'];
		$query = mysql_query("SELECT size FROM alg_inventory WHERE upc = '$upc'");
		$result_upc = mysql_fetch_array($query);

			$orders_print .= '<tr>';
			$orders_print .= '<td>'.$order['po1_quantity'].'</td>';
			$orders_print .= '<td>'.$order['po1_sku_number'].'</td>';
			$orders_print .= '<td>'.$result_upc['size'].'</td>';
			$orders_print .= '</tr>';
			//echo "<pre>"; print_r($orders_print); echo "</pre>";
  		endforeach;
		$headers = "From: edi_pull@sales.alegriashoes.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = '<p><h1>Uniform Solution Order</h1></p>';
		$message .= '<table width="250" border="0" cellpadding="5">';
		$message .= '<tr>';
		$message .= '<td><b>Account #</b></td>';
		$message .= '<td>'.$result['bt_acctno'].'</td>';
		$message .= '</tr>';
		$message .= '</table>';
		$message .= '<table width="250" border="0" cellpadding="5">';
		$message .= '<tr>';
		$message .= '<td><b>Purchase Order #</b></td>';
		$message .= '<td>'.$result['po_number'].'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td><b>Drop Ship Name</b></td>';
		$message .= '<td>'.$result['st_name'].'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td><b>Drop Ship Address</b></td>';
		$message .= '<td>'.$result['drop_ship_addr1']." ".$result['drop_ship_addr2'].'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td><b>PO Date #</b></td>';
		$message .= '<td>'.date("m/j/Y", strtotime($result['po_date'])).'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td><b>Ship Date #</b></td>';
		$message .= '<td>'.date("m/j/Y", strtotime($result['start_ship_date'])).'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td><b>Cancel Date #</b></td>';
		$message .= '<td>'.date("m/j/Y", strtotime($result['cancel_date'])).'</td>';
		$message .= '</tr>';
		$message .= '</table>';
		$message .= '<p>&nbsp;</p>';
		$message .= '<table width="500" border="1" cellpadding="5">';
		$message .= '<tr>';
		$message .= '<td><b>Quantity</b></td>';
		$message .= '<td><b>SKU#</b></td>';
		$message .= '<td><b>Size</b></td>';
		$message .= '</tr>';
		$message .= $orders_print;
		$message .= '<tr>';
		$message .= '<td>&nbsp;</td>';
		$message .= '<td><b>Total Qty</b></td>';
		$message .= '<td>'.$result['ctt_total_quantity'].'</td>';
		$message .= '</tr>';
		$message .= '</table>';
		if ($debug) :
			$message .= '<pre>DEBUG INFORMATION:</pre>';
			$message .= '<pre>'.print_r($result, 1).'</pre>';
		endif;
		mail ($to, $subject." ".$result['po_number'], $message, $headers);
	endforeach;

?>