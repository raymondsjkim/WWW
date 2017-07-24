<?php require_once ("includes/php/checkCookie.php"); ?>

<?php 

$products 	= $_GET['q'];
$totalQty 	= $_GET['totalQty'];
$totalAmt 	= $_GET['totalAmt'];
$username	= $_COOKIE['ID_my_site'];
$backorder = array();


include("includes/resource/db.php");

//If the form is submitted

function multiexplode ($delimiters,$string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

if(isset($_POST['submit'])) {
	
	$linkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
	mysql_select_db($indatabase, $linkID) or die("Could not find database."); 
	//$area			= trim($_COOKIE['area']);
	
	//$section		= $area."_dealer";
	$linebreak		= array("<br>","<BR>","<br/>","<BR/>");
	
	
	$poNumber 		= $_POST['poNumber'];
	$acctNumber 	= $_POST['acctNumber'];
	$bizName		= $_POST['bizName'];
	$contact		= $_POST['contact'];
	$date	 		= date('m-d-Y');
	$tmpOrder2		= $_POST['order'];
	$tmpOrder		= str_replace($linebreak, "\n",$_POST['order']);
	$order		 	= str_replace($linebreak, "</td>\n</tr>\n<tr>\n<td style='border: 1px solid #666; border-top: 0px; text-align: right;'>",$_POST['order']);

	//Add backorder checking to this terrible, terrible code... sigh
	//Clean up $tmpOrder array
	$orderDelimiters = array('<SPAN class=itemid>',
							'<SPAN class=itemQty> ',
							'<SPAN class=unitprice>',
							'</SPAN>',
							'<span class="itemid">',
							'<span class="itemQty"> ',
							'<span class="unitprice">',
							'</span>');
	$orderArray = explode(",", str_replace($orderDelimiters, ",", $tmpOrder));

	$itemSku = array();
	$backorderVerifier = array();
	$backorderItem = array();
	$backorderSku = array();
	$x = 0;
	
	// Change array of $tmpOrder with HTML to itemNo, size, orderQty
	foreach ($orderArray as $sku) {
		//echo $sku;
		if (strpos($sku, '_') !== false) {
			$itemSku['sku'.$x] = explode('_', $sku);
		}
		elseif (strpos($sku, 'x') !== false) {
			$sku = str_replace('x ','',$sku);
			$itemSku['sku'.$x][] = $sku;
			$x += 1;
		}

	}

	//Search for size in db of ordered items.
	//CHANGE DB QUERY OUT OF LOOP!!!
	foreach ($itemSku as $sku) {
	$query = "SELECT itemNo, size
		FROM $intable
		WHERE '$sku[0]' = itemNo
		AND '$sku[1]' = size
		AND '$sku[2]' > inStock";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	// echo "<pre>";print_r($row);echo "</pre>";

	if ($row) {
		$backorderItem[] = $row['itemNo']."_".$row['size'];
		}
	
	}
	// echo "<pre>";print_r($backorderItem);echo "</pre>";

	foreach ($backorderItem as $key) {
		$insertBackorder = '<span style="color:#ED2939;"><b>*BACK-ORDERED* </b></span>';
		$order = substr_replace($order, $insertBackorder, strripos($order, $key), 0);
	}
	// CONTINUE TO ORIGINAL - don't ask I did the best I could :(

	$order		 	= str_replace("_", "</td>\n<td align='center' style='border: 1px solid #666; border-top: 0px; border-left: 0px;'>",$order);
	$order		 	= str_replace(" x ", "</td>\n<td align='center' style='border: 1px solid #666; border-top: 0px; border-left: 0px;'>",$order);
	$order		 	= str_replace("$", "</td>\n<td align='left' style='border: 1px solid #666; border-top: 0px; border-left: 0px;padding-left:10px;'>$",$order);













	$dealerPhone	= $_POST['dealerPhone'];
	//$dealerState	= $_POST['dealerState'];
	//$dealerZip		= $_POST['dealerZip'];
	//$dealerContact	= $_POST['dealerContact'];
	$dealerEmail	= trim($_POST['dealerEmail']);
	//$distributor	= $_POST['distributor'];
	$totalQty2		= $_POST['totalQty'];
	$totalAmt2 		= $_POST['totalAmt'];
	$message		= $_POST['message'];

	if(!isset($hasError)) {
	
		// enter to database //
	   $linkID = mysql_connect($inhost, $inuser, $inpass) or die("Could not connect to host."); 
		mysql_select_db($indatabase, $linkID) or die("Could not find database."); 
				
		
		
			  $find[] = 'â€œ';  // left side double smart quote
			  $find[] = 'â€';  // right side double smart quote
			  $find[] = 'â€˜';  // left side single smart quote
			  $find[] = 'â€™';  // right side single smart quote
			  $find[] = 'â€¦';  // elipsis
			  $find[] = 'â€”';  // em dash
			  $find[] = 'â€“';  // en dash
			
			  $replace[] = '"';
			  $replace[] = '"';
			  $replace[] = "'";
			  $replace[] = "'";
			  $replace[] = "...";
			  $replace[] = "-";
			  $replace[] = "-";
			
			  $message = str_replace($find, $replace, $message);	
			  
			  $message = addslashes($message);		
		
				
		$query = "INSERT INTO $inorder VALUES ('','$date','$acctNumber', '$poNumber','$contact', '$dealerEmail', '$dealerPhone', '$message', '$tmpOrder2', '$totalQty2')";
		mysql_query($query);
		
		//print $query;		
		//mysql_close();
		//mysql_connect($host,$user,$pass);
		//@mysql_select_db($database) or die( "Unable to select database");
			
	//$query = "INSERT INTO $section VALUES ('','','$dealer', '$dealerSite', '$dealerPhone', '$dealerAdd','$dealerCity','$dealerState','$dealerZip','$dealerContact','$dealerEmail')";
	//mysql_real_escape_string($info, $query);
	
		//$resultaaa = mysql_query($query);
		//if (!$resultaaa) {
		//	die('Invalid query: ' . mysql_error());
		//}
		$name_1 = "Faviola Lopez";  
		$name_2 = "Ben";  
		$name_3 = "Luke";
		
		$email_1 = $dealerEmail; 
		$email_2 = "benjamin@peppergate.com";  
		$email_3 = "faviola@peppergate.com"; 
		$email_4 = "andrew@peppergate.com";
		 
		$emailTo = $email_1 . ',' . $email_2 . ',' . $email_3;  //Put your own email address here info@alegrishoes.com 

		
		$body = '<html><body style="font-family:Arial, Helvetica, sans-serif;font-size:10px;text-align:center;">';
		
		$body .= '<table width="500" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">
						<tr style="background-color: #ee2375;height: 70px;">
						<td colspan="2"><img src="http://assets.alegriashoes.com/images/logo_dealer.gif" alt="Alegria Shoes" /></td>
					</tr>
					
					<tr>
					  <td colspan="2"><br />
					    <h2 style="font-size:16px;color:#000;">
					    Thank you for your order</h2>

				        <p>Your order has been received and is being processed by our customer service team.  <br />
<br />

				        Do <strong><u>NOT</u></strong> reply to this email. If you have questions regarding this order, please call us at 1-800-468-5191 Mon - Fri 8 a.m - 5 p.m. PST for assistance.<br />
<br />
						Thank you for your business!<br /><br />

                        </p></td>
					</tr>	 

 					<tr>
                    	<td width="47%">
                        	<table style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">	
                                <tr>
                                    <td width="110" height="20" valign="top"><strong>Alegria Order #</strong></td>
                                    <td width="142" valign="top">'.mysql_insert_id().'</td>
                              </tr>
                               <tr>
                                    <td width="110" height="37" valign="top"><strong>Date</strong></td>
                                    <td width="142" valign="top">'.$date.'</td>
                              </tr>
                                 
                                  <tr>
                                    <td valign="top" height="20"><strong>Customer #</strong></td>
                                    <td valign="top"><strong>'.$acctNumber.'</strong></td>
                                  </tr>
								  <tr>
                                    <td valign="top" height="20"><strong>Business Name</strong></td>
                                    <td valign="top"><strong>'.$bizName.'</strong></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" height="20"><strong>PO #</strong></td>
                                    <td valign="top">'.$poNumber.'</td>
                                  </tr>
							</table>						
                        
                        </td>
                        <td valign="top" width="53%">
                        		<table width="100%" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">	
                        			  <tr>
                                        <td width="37%" height="65" valign="top"><strong>Billing Contact Info</strong></td>
                                        <td width="63%" valign="top">'.$contact.'<br>
                                          '.$dealerPhone.'<br>
                                          '.$dealerEmail.'</td>
                                  </tr>
                                      <tr>
                                        <td valign="top"><strong>Instructions</strong></td>
                                        <td valign="top">'.$message.'</td>
                                      </tr>
                                 </table>     
                        
                        </td>
                     </tr>
						<td colspan="2"><br>';
		$body .= '<table width="540" cellspacing="0" cellpadding="2" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">
					  <tr style="background:#CCCCCC;">
						<td width="220" style="border: 1px solid #666;"><strong>Item No.</strong></td>
						<td width="80" style="border: 1px solid #666;border-left:0px;" align="center"><strong>Size</strong></td>
						<td width="80" style="border: 1px solid #666;border-left:0px;" align="center"><strong>Qty</strong></td>
						<td width="80" style="border: 1px solid #666;border-left:0px;padding-left:10px;" align="left"><strong>Unit Price</strong></td>
						<td width="80" style="border: 1px solid #666;border-left:0px;padding-left:10px;" align="left"><strong>Amount</strong></td>
					  </tr>
					  <tr>
						<td style="border: 1px solid #666;border-top:0px;">
						'.$order.'
						</td>
						<td style="border: 1px solid #666;border-top:0px;" align="center"><strong>Sub Total:</strong></td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;" align="center"><strong>'.$totalQty2.'</strong></td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;" align="left"><strong>&nbsp;</strong></td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;padding-left:10px;" align="left"><strong>$'.$totalAmt2.'</strong>
						</td>
					  </tr>
					  <tr>
					  	<td></td>
					  	<td style="border: 1px solid #666;border-top:0px;border-right:0px;" align="center"><strong>Shipping</strong></td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;border-right:0px;">&nbsp;</td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;">&nbsp;</td>
						<td style="border: 1px solid #666;border-top:0px;border-left:0px;padding-left:10px;" align="left"><strong>TBD</strong></td>
					  </tr>
					</table>';
		$body .= '</td></tr>
				</table><br><br>';
		$body .= '</body></html>';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		
		$headers .= "From: Alegria Shoes <noreply@alegriashoes.com>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		//$headers .= "Cc: $name_1 <$email_1>\r\n";
		//$headers .= "Cc: $name_2 <$email_2>\r\n";
		$headers .= "Bcc: $emailTo";
		//$headers .= "Reply-To: $dealerEmail";
		
		mail($dealerEmail, "Alegria Online Order #".mysql_insert_id()." Received", $body, $headers, "-f".$dealerEmail.",".$emailTo);
		
		   //exit;
	   
	   mysql_close();
	   $emailSent = true;


	   // TESTING!!!!
	   // echo "<p>Please excuse the issue, you've reached an error. Your order was placed but the system was updating. Please check your email for the final order receipt. Thank you!</p>";
	   // echo "<pre>"; print_r($itemSku); echo "</pre>";
	   //exit;

	}
}	else {
	$poNumber 		= "";
	$bizName		= "";
	$acctNumber 	= "";
	$contact		= "";
	$date	 		= "";
	$order		 	= "";
	$dealerPhone	= "";
	$dealerEmail	= "";
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Inventory Submit</title>

<!-- link href="../includes/css/thickbox.css" rel="stylesheet" type="text/css"/>
<link href="../includes/css/entry.css" rel="stylesheet" type="text/css"/>
<link href="../includes/css/myAdmin.css" rel="stylesheet" type="text/css"/ -->

<style type="text/css">
.emphasisText{text-align:right;width:560px;padding-bottom:20px;font-size:11px;}
body{font-family:Arial, Helvetica, sans-serif;}
.catalogCol div {
	margin:0 0 10px 0;
}
form#contactform{
	width:580px;
}
.catalogCol{
	float:left;width:280px;
}
label {
	display:block;
	float:none;
	font-size:13px;
	width:auto;
	color:#666;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:3px;
	font-size:12px;
	color:#333;
	width:200px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:3px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:200px;
	font-size:12px;
}
form#contactform label.error {
	color:#DD0000;
	padding-top:3px;
	font-size:11px;
}
form#contactform input.error, 
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}
#finalOrderReview{font-size:12px;display:table;border-bottom:1px solid #000;padding-bottom:10px;width:300px;}

form#contactform input#submit{width:140px;height:30px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;font-size:14px;font-weight:bold;}
.HelpText{font-size:11px;color:#777777;}
.itemid, .itemQty, .finalTotal, .unitprice{font-size:12px;display:block;float:left;}
.itemid{width:110px;padding-right:10px;}
.itemQty{width:40px;}
.unitprice{width:60px;}

#finalTotalTitle{display:block;width:110px;float:left;}

#finalQty{display:block;width:20px;float:left;}
.finalTotal{display:block;float:left;}

.floatleft{text-align:left;font-weight:bold;}
.disable {
	border: 1px solid #999;
	background-color: #ddd;
}
</style>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $httpURL ?>includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="<?php echo $httpURL ?>includes/js/jquery-ui-1.8.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $httpURL ?>includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>


<script type="text/javascript">
$(document).ready(function(){
	/*jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, ""); 
		return this.optional(element) || phone_number.length > 9 &&
		phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
	}, "Please specify a valid phone number");
*/
//$("#acctNumber").mask("a9999*");//,{placeholder:" "}
$("#dealerPhone").mask("999-999-9999");//,{placeholder:" "}
	$("#contactform").validate({
		rules: {
			//poNumber: "required",
			acctNumber: {
				required: true,
				 maxlength: 6
			},
			bizName:"required",
			contact: "required",
			dealerEmail: {
				required: true,
				email: true
			},
			confirm_email: {
				required: true,
				minlength: 5,
				equalTo: "#email",
				email: true
			},
			dealerPhone: {
      			required: true
    		}
		},
		messages: {
			//poNumber: "Please enter your PO #",
			bizName: "Please enter your business name",
			acctNumber: "Please enter your account number",
			contact: "Please enter the billing contact person",
			dealerPhone: "Please enter the billing phone number"
		
			
			//agree: "Please accept our policy"
		},
		submitHandler: function(form) {
        	$("#submit").attr('disabled', 'disabled');
			$("#submit").css("background","#ddd");
			$("#submit").val("SUBMITTING");
			form.submit();

   		} 
	});
	

});
</script>
</head>
<body>


<form action="<?php echo $httpURL ?>inventory_submit.php" method="post" name="entryForm" id="contactform">
						<input type="hidden" value="" id="order" name="order"/>
                        <input type="hidden" value="<?php echo $totalQty ?>" id="totalQty" name="totalQty"/>
                        <input type="hidden" value="<?php echo $totalAmt ?>" id="totalAmt" name="totalAmt"/>
<div id="contactForm">
				
						
					
						<div class="emphasisText">
								Required Fields *
								
						</div>
<!-- begins -->
 <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
            
           <script type="text/javascript">
				<!--
				parent.location = "http://dealer.alegriashoes.com/inventory_confirmation.php"
				//-->
			</script>

            <!-- p class="confirm"><strong>Order Successfully Sent! We'll follow up with you shortly.</strong>
           </p -->
        <?php } ?>
						<div class="catalogCol">
	
							<div>
								<label for="name"><strong>*Customer Number</strong></label>

									<input type='text' name='acctNumber' id='acctNumber' value='<?php echo $username; ?>' class="required" /><br />
									<span style="font-size:10px">e.g. A9999</span>
									
								
							</div>
                            <div>
								<label for="site"><strong>*Business Name</strong></label>

									<input type='text' name='bizName' id='bizName' class="required" />
									
								
							</div>
							<div>
								<label for="site"><strong>Customer Purchase Order Number (Optional)</strong></label>

									<input type='text' name='poNumber' id='poNumber' class="" />
									
								
							</div>
							
							<div>
								<label for="address"><strong>*Business Contact Person</strong></label>

									<input type='text' name='contact' id='contact' class="required" />
									
								
							</div>
							<div>
								<label for="city"><strong>*Business Phone Number</strong></label>

									<input type='text'  name='dealerPhone' id='dealerPhone' class="required" />
									
								
							</div>
							<div>
								<label for="email"><strong>*Business Email Address</strong></label>

									<input type='text' name='dealerEmail'  id="email" class="required"/>
									
								
							</div>
                            <div>
                                <label for="emailcontact"><strong>*Confirm Email Address</strong></label>
                                <input type="text" name="confirm_email" id="confirm_email" class="required email" />
                            </div>
                          
                            <div>
								<label for="email"><strong>Special Instructions</strong></label>

									<textarea rows="3" cols="50" name="message" id="message" class=""></textarea><br />
<span class="HelpText">i.e. If you are shipping to an alternate address different than your default shipping address, such as <b>chain stores</b>;<br /><br />

If you need a partial shipment to ship asap;<br /><br />
If you wish to local pick up at our warehouse in Pomona.</span>
									
								 
							</div>
                       </div>
                       <div class="catalogCol">   
							<div>
                            	<label for="emailcontact"><strong>Order Review </strong></label>
								
                                <div>
                                	<div class="itemid">Item No.</div>
                                    <div class="itemQty">Qty</div>
                                    <div class="unitprice">Unit Price</div>
                                    <div class="unitprice">Amount</div>
                                </div>
                                <div id="finalOrderReview">
								
									<?php echo $products ?>
                                </div>
                               
                                <div id="finalOrderTotal">
                                    
                                	<div class="itemid floatleft"><strong>Sub Total:</strong></div>
                                    <div class="itemQty"><strong><?php echo $totalQty ?></strong></div>
                                    <div class="unitprice">&nbsp;</div>
                                    <div class="unitprice"><strong>$<?php echo $totalAmt ?></strong></div>
                                </div>
                                <div>
                                	<div class="itemid floatleft"><strong>Shipping:</strong></div>
                                    <div class="itemQty">&nbsp;</div>
                                    <div class="unitprice">&nbsp;</div>
                                    <div class="unitprice"><strong>TBD</strong></div>
                                </div>
								
							</div>
                          
							<div>
								<label for="submit"><strong>&nbsp;</strong></label>

									<!-- START:SUBMIT BUTTON TABLE-->
									<input name="submit" type="submit" class="formBtn" value='SUBMIT ORDER' id="submit"><br />

									<span class="HelpText">Please Click ONCE Only to avoid duplicate orders.<br/>If you need to make changes to the order, please close this window and adjust the order.<br /><br />*Please do <b>not</b> contact our office for questions regarding back orders.*</span>
									<!-- START:SUBMIT BUTTON TABLE -->
								
							</div>
					 </div> 
							
							<!-- ends -->

</div></form>
<script type="text/javascript">



$(document).ready(function(){
		
		
		
		var e2 = $('#finalOrderReview');
		e2.html(e2.html().replace(/ALG/ig, "<span class='itemid'>ALG"));
		var e3 = $('#finalOrderReview');
		e3.html(e3.html().replace(/ x /ig, "</span><span class='itemQty'> x "));
		var e4 = $('#finalOrderReview');
		e4.html(e4.html().replace(/[\$]/ig, "</span><span class='unitprice'>$"));
		var e5 = $('#finalOrderReview');
		e5.html(e5.html().replace(/Remove/ig, "</span><br>"));

		var text = $('#finalOrderReview').html();
		$("#order").val(text);
		
		
		

});
</script>
<?php include("includes/php/google.analytics.php"); ?>
</body>
</html>
