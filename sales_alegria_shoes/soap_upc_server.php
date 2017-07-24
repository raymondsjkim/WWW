<?php


	if (!isset($HTTP_RAW_POST_DATA)) :
		$HTTP_RAW_POST_DATA = "";
	endif;

	file_put_contents('soap_logger.txt', PHP_EOL.$HTTP_RAW_POST_DATA.PHP_EOL, FILE_APPEND);
	file_put_contents('soap_logger.txt', PHP_EOL.print_r($_REQUEST, 1).PHP_EOL, FILE_APPEND);

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

	function StockLevel($upc) { 
		$query = "SELECT inStock, discontinue, eta FROM alg_inventory WHERE upc = '".mysql_real_escape_string($upc)."'";
		$data = mysql_query($query);
		if (mysql_num_rows($data) > 0) :
			$stock_level = mysql_result($data, 0, "inStock");
			$discontinued = mysql_result($data, 0, "discontinue");
			$eta = mysql_result($data, 0, "eta");
			if ($discontinued != "0") :
				return array("StockLevel" => "*DISC", "DateAvailable" => "");
			else :
				if ($stock_level < 5) :
					if (empty($eta)) :
						return array("StockLevel" => "OUTOFSTOCK", "DateAvailable" => $eta);
					else :
						$realeta = date("m/d/Y", strtotime($eta));
						return array("StockLevel" => "OUTOFSTOCK", "DateAvailable" => $realeta);
					endif;
				else :
					return array("StockLevel" => "INSTOCK", "DateAvailable" => "");
				endif;
			endif;
		else :
			return array("StockLevel" => "INVALID", "DateAvailable" => "");
		endif;
	}
	
	$UPC_CODE = explode("<UPC>", $HTTP_RAW_POST_DATA);
	$UPC_CODE = explode("</UPC>", $UPC_CODE['1']);
	$UPC_CODE = $UPC_CODE['0'];
	
	$results = StockLevel($UPC_CODE);
		
	header ("Content-Type:text/xml");
	$return = '<?xml version="1.0" encoding="utf-8"?>';
	$return .= '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">';
	$return .= '<soap:Body>';
	$return .= '<StockLevelResponse>';
	$return .= '<StockLevelResult>';
	$return .= '<UPC>'.$UPC_CODE.'</UPC>';
	$return .= '<StockLevel>'.$results['StockLevel'].'</StockLevel>';
	$return .= '<DateAvailable>'.$results['DateAvailable'].'</DateAvailable>';
	$return .= '</StockLevelResult>';
	$return .= '</StockLevelResponse>';
	$return .= '</soap:Body>';
	$return .= '</soap:Envelope>';
	header ("Content-length: ".strlen($return)."");
	
	print $return;
	
	/* Disabled SOAP.. WSDL is a PAIN
	$server = new SoapServer(null, array('uri' => "urn://sales.alegriashoes.com/soap_upc_server.php", 'soap_version' => SOAP_1_2));
	$server->addFunction("StockLevel"); 
	$server->handle();
	*/

?>