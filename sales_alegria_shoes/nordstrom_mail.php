<?php
require("includes/resource/db.php");
set_time_limit(720);
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	$date = date("m_d_y");
	$name = "nordstrom/nordstrom_inventory".$date.".csv";

	// WHO TO MAIL TO??!!??
	$to = "andrew@peppergate.com, luke@peppergate.com";
	$subject = $date.' Nordstrom LINGO csv';
	$message = "Download: http://sales.alegriashoes.com/nordstrom.php<br />";
	$message .= "Username: lko<br />";
	$message .= "Password: Pacsun1!<br />";
	$message .= "<br />";
	$message .= "<b>**RIGHT click on link and use options 'Save As' to download the file**</b><br />";
	$message .= "<br />";
	$message .= "Upload file to Lingo, for Nordstrom EDI.<br />";
	$message .= "http://www.myweborders.com/<br />";
	$message .= "Username: peppergate<br />";
	$message .= "Password: trisk13<br />";
	$message .= "<br />";
	$message .= "Instructions to come<br />";

		$headers = "From: edi_pull@sales.alegriashoes.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail ($to, $subject, $message, $headers);
?>