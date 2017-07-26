<?php
require("../includes/resource/db.php");
set_time_limit(720);
	/* ************************************************************************ */
	/* ***************** Variables to change for each vendor ****************** */
	/* ************************************************************************ */
	$date = date("m_d_y");
	$name = "belk/inventory/belk_inventory".$date.".csv";

	// WHO TO MAIL TO??!!??
	$to = "andrew@peppergate.com, angela@peppergate.com, susana@peppergate.com";
	$subject = $date.' Belk CommerceHub TXT';
	$message = "Download: http://sales.alegriashoes.com/belk/belk.php<br />";
	$message .= "Username: lko<br />";
	$message .= "Password: Pacsun1!<br />";
	$message .= "<br />";
	$message .= "<b>**RIGHT click on link and use options 'Save As' to download the file**</b><br />";
	$message .= "<br />";
	$message .= "<b>INSTRUCTIONS</b><br />";
	$message .= "<b>Download this <a href='http://sales.alegriashoes.com/belk/template_belk.xls'>template</a> if you do not have it. Same username and password as above.</b><br />";
	$message .= "1. Open the TEMPLATE with MS Excel.<br />";
	$message .= "2. Open the BELK_INVENTORY file with MS Excel.<br />";
	$message .= "3. COPY the entire contents of BELK_INVENTORY file.<br />";
	$message .= "3. Click on the first yellow box in the TEMPLATE with the word 'IN' and PASTE the contents of BELK_INVENTORY you just copied.<br />";
	$message .= "4. Upload file to CommerceHub.<br />";
	$message .= "<br />";
	$message .= "<b>INSTRUCTIONS FOR COMMERCEHUB</b><br />";
	$message .= "Hey Angie, I will need some instructions for this or you can personally train Susana<br />";

		$headers = "From: edi_pull@sales.alegriashoes.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	mail ($to, $subject, $message, $headers);
?>