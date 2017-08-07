<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:480px;
	
	background:#f1f1f1;
	padding:5px 0px 10px 20px;
	text-align:left;
}
#contact-wrapper p.error{
	color:#DD0000;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper p.confirm{
	color:#ee2375;
	font-size:12px;
	line-height:140%;
}
#contact-wrapper form{
	width:250px;
}
#contact-wrapper div {
	
	margin:1em 0;
}
#contact-wrapper label {
	display:block;
	float:none;
	font-size:13px;
	width:auto;
	color:#666;
}
form#contactform{
	width:480px;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:4px;
	font-size:13px;
	color:#333;
	width:200px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:4px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:200px;
	font-size:13px;
}
form#contactform select {
	font-size:12px;
	padding:3px;
}

form#contactform label.error {
	color:#DD0000;
	padding-top:3px;
	font-size:11px;
}
form#contactform input.error,
form#contactform select.error, 
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}
.catalogCol{
	float:left;width:220px;margin-top:0px;margin-bottom:20px;
}
#contact-wrapper div.catalogCol {
	
	margin-top:0px;margin-bottom:0px;
}


#catalogAddress label{width:200px;}

#catalogAddress div input{width:200px;}

form#contactform input#submit{width:140px;height:42px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;}

</style>


            
            
  <?php
  
  
  require("../includes/resource/db.php");
  
  

  
//If the form is submitted
if(isset($_POST['submit'])) {
	
		$firstname 	= trim($_POST['firstname']);
		$lastname 	= trim($_POST['lastname']);
		
		$email 		= trim($_POST['email']);
		
		$order 		= stripslashes(trim($_POST['order']));
		$items	 	= stripslashes(trim($_POST['items']));
		$reason 	= trim($_POST['reason']);
		$action 	= trim($_POST['action']);
		$message	= stripslashes(trim($_POST['message']));
		$date	 	= date('m-d-Y');
	//$phone = trim($_POST['phone']);
	//If there is no error, send the email
	if(!isset($hasError)) {
	//echo $subject;
		//if ( $subject == "Request Catalog"){
			//$emailTo = 'leok@lexi-solutions.com'; //sandra@peppergate.com
		//} else {
		//	$emailTo = 'test@happylookslike.com'; 
		//}
		
		$emailTo = "sales@alegriashoes.com";//
		
		
		$subj[1] = "AlegriaShoes.com Exchange Request";
		$subj[2] = "AlegriaShoes.com Refund Request";
		//$subj[3] = "Order Assistance";
		//$subj[4] = "Feedback";
		$followupaction[1] = "exchanged";
		$followupaction[2] = "returned";
		
		$emailTo = "$emailTo"; //Put your own email address here info@alegrishoes.com
		
		$body = '<html><body style="font-family:Arial, Helvetica, sans-serif;font-size:10px;text-align:center;">';
		
		$body .= '<table width="500" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">
						<tr style="background-color: #ee2375;height: 70px;">
						<td colspan="2"><img src="http://assets.alegriashoes.com/images/logo_dealer.gif" alt="Alegria Shoes" /></td>
					</tr>
					
					<tr>
					  <td colspan="2"><br />
					    <h2 style="font-size:16px;color:#000;">'.$subj[$action].'</h2>

				       
                       </td>
					</tr>	 

 					<tr>
                    	<td width="70%">
                        	<table style="font-family:Arial, Helvetica, sans-serif;font-size:11px;">	
                                 <tr>
                                    <td width="130" height="37" valign="top"><strong>Date</strong></td>
                                    <td width="200" valign="top">'.$date.'</td>
                              </tr>
								<tr>
                                    <td width="130" height="45" valign="top"><strong>Customer Info</strong></td>
                                    <td width="200" valign="top">'.$firstname.' '.$lastname.'<br />'.$email.'</td>
                              </tr>
                              
                                 
                                  <tr>
                                    <td valign="top" height="20"><strong>Order ID</strong></td>
                                    <td valign="top"><strong>'.$order.'</strong></td>
                                  </tr>
                                  <tr>
                                    <td valign="top" height="20"><strong>Item(s) to be '.$followupaction[$action].'</strong></td>
                                    <td valign="top">'.$items.'</td>
                                  </tr>
								  <tr>
                                    <td valign="top" height="20"><strong>Return/Exchange Reason</strong></td>
                                    <td valign="top"><strong>'.$reason.'</strong></td>
                                  </tr>
								  <tr>
                                        <td valign="top"><strong>Instructions</strong></td>
                                        <td valign="top">'.$message.'</td>
                                      </tr>
							</table>						
                        </td>
                       </tr>
						';
		
		$body .= '</table><br><br>';
		$body .= '</body></html>';
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		
		
		$headers .= "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		
		mail($emailTo, $subj[$action], $body, $headers, "-f".$emailTo);
		$emailSent = true;
		
		// Enter data to database //
		$linkID = mysql_connect($host, $user, $pass) or die("Could not connect to host."); 
		mysql_select_db($database, $linkID) or die("Could not find database."); 
				
		
		
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
		
				
		$query = "INSERT INTO $ctable VALUES ('','$firstname','$lastname', '$occupation','$email', '$subj[$subject]', '$address', '$city', '$state', '$zip', '$phone', '$message', '')";
		mysql_query($query);
		print $query;		
		mysql_close();

		$firstname = "";
		$lastname = "";
		$order = "";
		$email = "";
		$items = "";
		$reason = "";
		$action = "";
		
		$message = "";
	}
	
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="../includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="../includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

	//$("#order").mask("999");//,{placeholder:" "}

	$("#contactform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			order: "required",
			items: "required",
			reason: "required",
			action: "required",
			email: {
				required: true,
				email: true
			},
			confirm_email: {
				required: true,
				minlength: 5,
				equalTo: "#email",
				email: true
			}
			
			/* topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required" */
		},
		messages: {
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			order: "Please enter your Order ID",
			
			reason: "Please select a Reason",
			items: "Please enter items(s) to be returned or exchanged",
			action: "Please select an Action",
			
			email: "Please enter a valid Email Address",
			
			confirm_email: {
				equalTo: "Please enter the same email as above"
			}
			//agree: "Please accept our policy"
		}
	});
});
</script>


	<div id="contact-wrapper">
	<div class="techText_title">Return / Exchange Request Form</div>
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Request Successfully Sent!</strong><br>
		Thank you <strong><?php echo $name;?></strong> for submitting a Return / Exchange Request! We will reply with further instruction shortly.</p>
	<?php } ?>

	<form method="post" action="main.php" id="contactform">
		
        <div class="catalogCol">
        <div>
		    <label for="name"><strong>First Name *</strong></label>
			<input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
		</div>
		<div>
		    <label for="name"><strong>Last Name *</strong></label>
			<input type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
		</div>
        
       
		
       </div>
       <div class="catalogCol" style="width:240px;">
       <div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
		</div>
        
        </div>
        
        <div class="catalogColWide"> 
    
        <div>
		    <label for="order"><strong>Order ID *</strong></label>
			<input type="text" size="50" name="order" id="order" value="<?php echo $order?>" class="required" />
		</div>
        <div>
			<label for="subject"><strong>Return or Exchange? *</strong></label>
			
            <select name="action" id="action" class="required" >
            		<option value=''>- Please Choose an Action -</option>
					<option value='1'>Exchange</option>
					<option value='2'>Refund</option>
			</select>
		</div>
         <div>
		    <label for="order"><strong>Return/Exchange Item(s) *</strong></label>
			<input type="text" size="50" name="items" id="items" value="<?php echo $order?>" class="required" />
		</div>

    	<div>
			<label for="subject"><strong>Return/Exchange Reason *</strong></label>
			
            <select name="reason" id="reason" class="required" >
            		<option value=''>- Please Choose a Reason -</option>
					<option value='Size - Too Big'>Size - Too Big</option>
					<option value='Size - Too Small'>Size - Too Small</option>
                    <option value='Fit - Too Tight'>Fit - Too Tight</option>
					<option value='Fit - Too Wide'>Fit - Too Wide</option>
                    <option value='Fit - Uncomfortable'>Fit - Uncomfortable</option>
                    <option value='Actual Product Different From Website'>Actual Product Different From Website</option>
                    <option value='Wrong Product Received'>Wrong Product Received</option>
                    <option value='There Was A Problem With The Product/Defective Product'>There Was A Problem With The Product/Defective Product</option>
                    <option value='I Found a Better Deal'>I Found a Better Deal</option>
                    <option value='I Dont Like It'>I Don't Like It</option>
			</select>
		</div>
        
		
		
		<div>
			<label for="message"><strong>Comments:</strong></label>
			<textarea rows="4" cols="50" name="message" id="message"><?php echo $message?></textarea><br />
If you are exchanging the item, you can enter the style number and size of the item you wish to exchange to. 
		</div>
        
       
	    <input id="submit" type="submit" value="SEND MESSAGE" name="submit" />
        </div>
	</form>
	</div><!-- EOD contact-wrapper -->
