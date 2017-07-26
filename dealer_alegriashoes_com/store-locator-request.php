<?php require_once ("includes/php/checkCookie.php"); ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="googlebot" content="noindex, noarchive, nofollow">
<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
<title>Store Locator Request</title>  
<link href="includes/css/myAdmin.css" rel="stylesheet" type="text/css"/>
<style type="text/css">

#contact-wrapper {
	font-family:Arial, Helvetica, sans-serif;
	width:610px;
	
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
	width:700px;
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

	width:600px;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	font-family:Arial, Helvetica, sans-serif;
	border-style:solid;
	border-width:1px;
	padding:4px;
	font-size:13px;
	color:#333;
	width:260px;
}
form#contactform textarea {
	font-family:Arial, Helvetica, sans-serif;
	font-size:100%;
	padding:4px;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	width:260px;
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
form#contactform textarea.error{
	
	border:1px solid #DD0000;
}
.catalogCol{
	float:left;width:300px;margin-top:0px;
}
#contact-wrapper div.catalogCol {
	
	margin-top:0px;
}
#catalogAddress label{width:300px;}

#catalogAddress div input{width:300px;}

form#contactform input#submit{width:140px;height:42px;padding:0;margin:0;background:#883878;color:#FFF;font-weight:bold;}

.contentRow .areaHeader{margin-top: 10px;padding-top: 10px;}

form#contactform input.radio {width:15px;}

</style>


            
            
  <?php
  
  
  //require("../includes/resource/db.php");
  
  

  
//If the form is submitted
if(isset($_POST['submit'])) {
		
		$date	 		= date('m-d-Y');
		
		$firstname 	= trim($_POST['firstname']);
		$lastname 	= trim($_POST['lastname']);
		$customerID = trim($_POST['customerID']);
		$biz		= trim($_POST['biz']);
		$email 		= trim($_POST['email']);
		$website	= trim($_POST['website']);
		//$subject 	= trim($_POST['subject']);
		$chain 		= trim($_POST['chain']);
		$message 	= stripslashes(trim($_POST['message']));
		
	//$phone = trim($_POST['phone']);
	//If there is no error, send the email
	if(!isset($hasError)) {
	//echo $subject;
		//if ( $subject == "Request Catalog"){
			//$emailTo = 'leok@lexi-solutions.com'; //sandra@peppergate.com
		//} else {
		//	$emailTo = 'test@happylookslike.com'; 
		//}
		$emailTo[1] = "benjamin@peppergate.com";
		//$emailTo[2] = "sofia@peppergate.com";
		//$emailTo[3] = "sales@alegriashoes.com";
		//$emailTo[4] = "sofia@peppergate.com";
		
		$subj[1] = "Store Locator Request";
		//$subj[2] = "Product Inquiry";
		//$subj[3] = "Order Assistance";
		//$subj[4] = "Feedback";
		
		$emailTo = "$emailTo[1]"; //Put your own email address here sofia@peppergate.com
		
		$body = '<table width="400" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="100" height="50" valign="top">Date:</td>
					<td width="300" valign="top">'.$date.'</td>
				  </tr>
				 
				  <tr>
					<td valign="top" height="30">Business Name:</td>
					<td valign="top"><strong>'.$biz.'</strong></td>
				  </tr>
				  <tr>
					<td valign="top" height="30">Website:</td>
					<td valign="top"><strong>'.$website.'</strong></td>
				  </tr>
				  <tr>
					<td valign="top" height="30">Customer ID:</td>
					<td valign="top">'.$customerID.'</td>
				  </tr>
				  <tr>
					<td valign="top" height="30">Chain Store:</td>
					<td valign="top">'.$chain.'</td>
				  </tr>
				  <tr>
					<td valign="top" height="65">Contact Info:</td>
					<td valign="top">'.$firstname.' '.$lastname.'<br>
					  '.$email.'</td>
				  </tr>
				  <tr>
					<td valign="top">Message:</td>
					<td valign="top">'.$message.'</td>
				  </tr>
				  
				</table><br><br>';
		
		
		
		
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		
		$headers .= "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		mail($emailTo, $subj[1], $body, $headers, "-f".$emailTo);
		$emailSent = true;
		
		// Enter data to database //
		/*
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
		//print $query;		
		mysql_close();
		*/
		$firstname = "";
		$lastname = "";
		$customerID = "";
		$email = "";
		$website = "";
		$customerID= "";
		$biz = "";
		$chain = "";
		$message = "";
	}
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("#phone").mask("(999) 999-9999");//,{placeholder:" "}

	$("#contactform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			customerID: "required",
			chain: "required",
			biz: "required",
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
			customerID: "Please enter your Customer ID",
			chain: "Please select if your store is chain store",
			biz: "Please enter your Business/Store Name",
			email: "Please enter a valid Email Address",
			
			confirm_email: {
				equalTo: "Please enter the same email as above"
			}
			//agree: "Please accept our policy"
		},
		

		errorPlacement: function(error, element) {
			if (element.attr("name") == "chain" ){
			   error.insertAfter("#chainNo");
			 }else{
			   error.insertAfter(element);
			 }
		}
		
	});
});
</script>
</head>

<body>

<div id="Container">
	
		
        
		<div id="Outer">
			<div id="Header">
				<?php include("navigation/topNav.php"); ?>
			</div>
						
		
            <div id="Wrapper">
                <div class="contentRow">
                    <div class="areaHeader" >Dealer Locator Request Form</div>
                    <p>If your store(s) hasn't been listed in AlegriaShoes.com Store Locator, please fill out the following form to provide us your Customer ID and Business name so we can add your store(s) to our store locator. 
              </div>
	<div id="contact-wrapper">
	
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Request Successfully Sent!</strong><br>
		Thank you <strong><?php echo $name;?></strong> for submitting your request! We will process your information shortly.</p>
	<?php } ?>

	<form method="post" action="store-locator-request.php" id="contactform">
		<!-- div>
			<label for="subject"><strong>Choose a Subject *</strong></label>
		    <select name="subject" id="subject">
              <option value='1'>General Question</option>
              <option value='2'>Product Inquiry</option>
              <option value='3'>Order Assistance</option>
              <option value='4'>Feedback</option>
            </select>
		</div -->
        <div class="catalogCol">
        <div>
		    <label for="name"><strong>First Name *</strong></label>
			<input type="text" size="50" name="firstname" id="firstname" value="<?php echo $firstname?>" class="required" />
		</div>
		<div>
		    <label for="name"><strong>Last Name *</strong></label>
			<input type="text" size="50" name="lastname" id="lastname" value="<?php echo $lastname?>" class="required" />
		</div>
        <div>
		    <label for="occupation"><strong>Customer ID *</strong></label>
			<input type="text" size="50" name="customerID" id="customerID" value="<?php echo $customerID?>" class="required" />
		</div>
        <div>
			<label for="email"><strong>Business/Store Name *</strong></label>
			<input type="text" size="50" name="biz" id="biz" value="<?php echo $biz?>" class="required" />
		</div>
        <div>
			<label for="email"><strong>Website</strong></label>
			<input type="text" size="50" name="website" id="website" value="<?php echo $website?>"/>
		</div>
        <div>
			<label for="phone"><strong>Chain Store? *</strong></label>
           <input type="radio" class="radio" name="chain" value="Yes" <?php if ($chain == "Yes"){echo "checked";} ?>> Yes  <input type="radio" class="radio" name="chain" value="No" <?php if ($chain == "No"){echo "checked";} ?>> No <span id="chainNo"></span>
        </div>
		
       </div>
       <div class="catalogCol">
    	<div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
		</div>
		
		
		<div>
			<label for="message"><strong>Message: (optional)</strong></label>
			<textarea rows="8" cols="50" name="message" id="message" ><?php echo $message?></textarea>
		</div>
        </div>
	    <input id="submit" type="submit" value="SUBMIT REQUEST" name="submit" />
	</form>
	</div><!-- EOD contact-wrapper -->
				</div><!-- EOF Wrapper -->
 		</div><!-- EOf Outer -->
 </div><!-- EOf Container -->
 <?php include("includes/php/google.analytics.php"); ?>
 </body>
</html>