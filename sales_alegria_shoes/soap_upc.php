<?php 

	header ("Content-Type:text/xml");
	
	$url = "http://sales.alegriashoes.com/soap_upc_server.php";

	$xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
						<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
							<soap:Body>  
								<StockLevel xmlns="http://yourinfo/">
									<UPC>'.$_GET['upc'].'</UPC>
								</StockLevel>
							</soap:Body>
						</soap:Envelope>';

   	$headers = array(
					"Content-type: text/xml;charset=\"utf-8\"",
					"Accept: text/xml",
					"Cache-Control: no-cache",
					"Pragma: no-cache",
					"SOAPAction: http://sales.alegriashoes.com/upc_request", 
					"Content-length: ".strlen($xml_post_string),
    				);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	// converting
	$response = curl_exec($ch); 
	curl_close($ch);
	
	print_r($response);

?>
