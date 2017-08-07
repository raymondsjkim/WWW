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
	float:left;width:220px;margin-top:0px;
}
#contact-wrapper div.catalogCol {
	
	margin-top:0px;
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
		$occupation = trim($_POST['occupation']);
		$email 		= trim($_POST['email']);
		$subject 	= trim($_POST['subject']);
		$phone 		= trim($_POST['phone']);
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
		$emailTo[1] = "sales@alegriashoes.com";
		$emailTo[2] = "sales@alegriashoes.com";
		$emailTo[3] = "sales@alegriashoes.com";
		$emailTo[4] = "returns@alegriashoes.com";
		$emailTo[5] = "returns@alegriashoes.com";
		$emailTo[6] = "returns@alegriashoes.com";
		
		$subj[1] = "General Question";
		$subj[2] = "Product Inquiry";
		$subj[3] = "Order Assistance";
		$subj[4] = "Product Warranty Assistance";
		$subj[5] = "Return Authorization Request";
		$subj[6] = "Feedback";
		
		$emailTo = "$emailTo[$subject]";
		$body = "Name: $firstname $lastname \n\nOccupation: $occupation \n\nEmail: $email \n\nPhone: $phone \n\n$message";
		$headers  = "From: $firstname $lastname <$email>\r\n";//"From: $firstname $lastname <$email>\nReply-To: $email";
		$headers .= "Reply-To: $email";
		
		mail($emailTo, $subj[$subject], $body, $headers, "-f".$emailTo[$subject]);
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
		//print $query;		
		mysql_close();
		
		$firstname = "";
		$lastname = "";
		$occupation = "";
		$email = "";
		$address = "";
		$city = "";
		$state = "";
		$zip = "";
		$phone = "";
		$message = "";
	}
}
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" type="text/javascript"></script>
<script src="../includes/js/jquery.validate.pack.js" type="text/javascript"></script>
<script src="../includes/js/jquery.maskedinput-1.2.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("#phone").mask("(999) 999-9999");//,{placeholder:" "}

	$("#contactform").validate({
		rules: {
			subject: "required",
			firstname: "required",
			lastname: "required",
			occupation: "required",
			
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
			subject: "Please select a subject",	
			firstname: "Please enter your First Name",
			lastname: "Please enter your Last Name",
			occupation: "Please enter your Occupation",
			phone: "Please enter a valid Phone Number",
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
	<div class="techText_title">Email Form</div>
	<?php if(isset($hasError)) { //If errors are found ?>
		<p class="error">Please check if you've filled all the fields with valid information. Thank you.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
		<p class="confirm"><strong>Email Successfully Sent!</strong><br>
		Thank you <strong><?php echo $name;?></strong> for contacing us! Your email was successfully sent and we will be in touch with you within 2 business days.</p>
	<?php } ?>

	<form method="post" action="main.php" id="contactform">
		<div>
			<label for="subject"><strong>Choose a Subject *</strong></label>
			
            <select name="subject" id="subject" class="required">
            		<option value=''>- Please Choose a Subject -</option>
					<option value='1'>General Question</option>
					<option value='2'>Product Inquiry</option>
                    <option value='3'>Order Assistance</option>
					<option value='4'>Product Warranty Assistance</option>
					<option value='5'>Return Authorization Request</option>
					<option value='6'>Feedback</option>
			</select>
		</div>
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
		    <label for="occupation"><strong>Occupation *</strong></label>
			<input type="text" size="50" name="occupation" id="occupation" value="<?php echo $occupation?>" class="required" />
		</div>
		<div>
			<label for="email"><strong>Email *</strong></label>
			<input type="text" size="50" name="email" id="email" value="<?php echo $email?>" class="required email" />
		</div>
        <div>
			<label for="email"><strong>Confirm Email *</strong></label>
			<input type="text" size="50" name="confirm_email" id="confirm_email" class="required email" />
		</div>
       </div>
       <div class="catalogCol">
    	<div>
			<label for="phone"><strong>Phone Number</strong></label>
			<input type="text" size="50" name="phone" id="phone" value="<?php echo $phone ?>" />
		</div>
		
		
		<div>
			<label for="message"><strong>Message: *</strong></label>
			<textarea rows="10" cols="50" name="message" id="message" class="required"><?php echo $message?></textarea>
		</div>
        </div>
	    <input id="submit" type="submit" value="SEND MESSAGE" name="submit" />
	</form>
	</div><!-- EOD contact-wrapper -->
